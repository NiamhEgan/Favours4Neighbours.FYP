<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Libraries\ViewManager;
use App\Models\CountyRepository;
use App\Models\JobApplicationRepository;
use App\Models\JobApplicationStatus;
use App\Models\JobCategoryRepository;
use App\Models\JobRepository;
use App\Models\JobStatus;
use App\Models\UserRepository;
use Exception;

class Jobs extends BaseController
{
	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->countyRepository = new CountyRepository();
		$this->jobApplicationRepository = new JobApplicationRepository();
		$this->jobCategoryRepository = new JobCategoryRepository();
		$this->jobRepository = new JobRepository();
		$this->userRepository = new UserRepository();
		$this->session = \Config\Services::session();

		helper('ArrayTransformer');
	}

	public function apply($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);
			if ($job == null)
				return ViewManager::load404ErrorViewIntoClientMasterPage("No job found for Job #:$jobId");
			else
				return $this->getApplyView($jobId);
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}
	public function getApplyView($jobId)
	{
		$userId = $this->session->get("UserId");
		$jobApplication = $this->jobApplicationRepository
			->where('Job', $jobId)
			->where('Applicant', $userId)
			->find();

		if ($jobApplication == null) {
			$jobApplicationValuesArray = [
				'Job' => $jobId,
				'Applicant' =>  $userId,
				//'Status'=> JobApplicationStatus::Pending,
			];
			$this->jobApplicationRepository->insert($jobApplicationValuesArray);
			return $this->index();
		} else {
			$data = ['message' => 'you have alreay applied for this job'];
			return ViewManager::loadViewIntoClientMasterPage('Application', 'Message', $data);
		}
	}
	public function accept($jobApplicationId)
	{
		if ($this->isLoggedIn()) {
			$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
			if ($jobApplication == null)
				return ViewManager::load404ErrorViewIntoClientMasterPage("No Job Application found for Job Application #:$jobApplicationId");
			else {
				//TODO: return $this->getAcceptView($jobApplicationId);
				$this->executeAcceptJobApplication($jobApplicationId);
				return ViewManager::loadViewIntoClientMasterPage('', 'message', ['message' => 'Application has been accepted.']);
			}
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}

	public function create()
	{
		if ($this->isLoggedIn()) {
			return $this->getCreateView();
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}
	//
	// Private Functions: get views
	//
	private function getCreateView()
	{
		$data = [
			"asssignedToDataSource" => transformObjectArrayWithNullValue($this->userRepository->findAll(), "Id", "Username"),
			"jobCategoryDataSource" => transformObjectArray($this->jobCategoryRepository->findAll(), "Id", "JobCategory"),
			"jobCountyDataSource" => transformObjectArray($this->countyRepository->findAll(), "ID_county", "county"),
		];
		if ($this->request->getPost("CreateButton") !== null) {
			return $this->executeInsert($data);
		}

		return ViewManager::loadViewIntoClientMasterPage('Create Job', 'JobCreateView', $data);
	}

	//
	// Private Functions
	//
	private function executeAcceptJobApplication($jobApplicationId)
	{
		$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
		$jobApplication["Status"] = JobApplicationStatus::Accepted;
		$commandResult = $this->jobApplicationRepository->update($jobApplicationId, $jobApplication);

		$job = $this->jobRepository->find($jobApplication["Job"]);
		$job["AssignedTo"] = $jobApplication['Applicant'];

		$commandResult = $this->jobRepository->update($job["Id"], $job);
	}
	public function reject($jobApplicationId)
	{
		if ($this->isLoggedIn()) {
			$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
			if ($jobApplication == null)
				return ViewManager::load404ErrorViewIntoClientMasterPage("No Job Application found for Job Application #:$jobApplicationId");
			else {
				//TODO: return $this->getAcceptView($jobApplicationId);
				$this->executeRejectJobApplication($jobApplicationId);
				return ViewManager::loadViewIntoClientMasterPage('', 'message', ['message' => 'Application has been rejected.']);
			}
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}


	public function executeRejectJobApplication($jobApplicationId)
	{
		$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
		$jobApplication["Status"] = JobApplicationStatus::Rejected;
		$commandResult = $this->jobApplicationRepository->update($jobApplicationId, $jobApplication);

		$job = $this->jobRepository->find($jobApplication["Job"]);
		$job["AssignedTo"] = $jobApplication['Applicant'];

		$commandResult = $this->jobRepository->update($job["Id"], $job);
	}

	public function close($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);

			if ($job == null) {
				echo ViewManager::load404ErrorViewIntoClientMasterPage("No Job found for $jobId");
			} else if ($job["CreatedBy"] != $this->session->get("UserId")) {
				echo ViewManager::load403ErrorViewIntoClientMasterPage();
			} else {
				return $this->executeCloseJob($jobId);
			}
		} else {
			echo  ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}

	private function executeCloseJob($jobId)
	{

		$jobValuesArray = [
			'JobStatus' => JobStatus::Closed,
		];
		$this->jobRepository->update($jobId, $jobValuesArray);
		$data = ['message' => "Job: $jobId has been closed"];
		echo ViewManager::loadViewIntoClientMasterPage('Application', 'Message', $data);
	}

	public function index()
	{
		if ($this->isLoggedIn()) {
			$userId = $this->session->get("UserId");
			$jobs = $this->db->query("Call GetAvailableJobsView(?)", $userId)->getResult();
			$data = [
				"jobs" => $jobs,
			];
			echo ViewManager::loadViewIntoClientMasterPage('My Jobs', 'AvailableJobsView', $data);
		} else {
			echo  ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}
	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null);
	}

	private function executeDelete($jobId)
	{
		$createJobValuesArray = $this->createJobValuesArrayFromPostArray();
		try {
			$commandResult = $this->jobRepository->save($createJobValuesArray, $jobId);
			return redirect()->to("/client/jobs");
		} catch (Exception $e) {
			$data = [
				'errors' => $this->jobRepository->errors(),
			];
			echo ViewManager::loadViewIntoClientMasterPage('My Jobs', 'AvailableJobsView', $data);
		}
	}
	public function delete($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);
			if ($job == null) {
				echo ViewManager::load404ErrorViewIntoClientMasterPage("No Job found for $jobId");
			} else if ($job["userID"] != $this->session->get("UserId")) {
				echo ViewManager::load403ErrorViewIntoClientMasterPage();
			} else {
				$this->executeDelete($jobId);
			}
		} else {
			echo  ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}
	public function view($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);

			if ($job == null) {
				echo ViewManager::load404ErrorViewIntoClientMasterPage("No Job found for $jobId");
			} else if ($job["CreatedBy"] != $this->session->get("UserId")) {
				echo ViewManager::load403ErrorViewIntoClientMasterPage();
			} else {
				return $this->getView($jobId, $job);
			}
		} else {
			echo  ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}
	public function viewtender($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);

			if ($job == null) {
				echo ViewManager::load404ErrorViewIntoClientMasterPage("No Job found for $jobId");
			} else {
				return $this->getTenderView($jobId, $job);
			}
		} else {
			echo  ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}
	public function edit($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);

			if ($job == null) {
				echo "Not found error";
			} else if ($job["CreatedBy"] != $this->session->get("UserId")) {
				echo "User permission error";
			} else {
				return $this->getEditView($jobId, $job);
			}
		} else {
			echo ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}



	private function getTenderView($jobId, $job)
	{
		$data = [
			"job" => $job,
		];

		return ViewManager::loadViewIntoClientMasterPage('View Job', 'JobTenderView', $data);
	}


	private function getView($jobId, $job)
	{
		$jobApplications = $this->db->query("Call GetJobApplicationsViewByJob(?)", $jobId)->getResult();

		$data = [
			"job" => $job,
			"jobApplications" => $jobApplications,
		];

		return ViewManager::loadViewIntoClientMasterPage('View Job', 'JobView', $data);
	}
	private function getEditView($jobId, $job)
	{
		$data = [
			"asssignedToDataSource" => transformObjectArrayWithNullValue($this->userRepository->findAll(), "Id", "Username"),
			"jobCategoryDataSource" => transformObjectArray($this->jobCategoryRepository->findAll(), "Id", "JobCategory"),
			"jobCountyDataSource" => transformObjectArray($this->countyRepository->findAll(), "ID_county", "county"),
		];
		if ($this->request->getPost("SaveButton") !== null) {
			$job = $this->executeSave($data, $jobId);
		}
		$data["job"] = $job;

		return ViewManager::loadViewIntoClientMasterPage('Edit Job', 'JobEditView', $data);
	}
	private function executeSave(&$data, $jobId)
	{
		$jobValuesArray = $this->createJobValuesArrayFromPostArray();
		try {
			$commandResult = $this->jobRepository->update($jobId, $jobValuesArray);
			$data["message"] = "Job Saved";
		} catch (Exception $e) {
			$data['errors'] = $this->jobRepository->errors();
		}
		return $this->jobRepository->find($jobId);
	}
	private function executeInsert(&$data)
	{
		$jobValuesArray = $this->createJobValuesArrayForNewJobFromPostArray();
		try {
			$commandResult = $this->jobRepository->insert($jobValuesArray);
			$data["message"] = "Job Saved";
			return redirect()->to("/client/jobs/edit/" . $commandResult);
		} catch (Exception $e) {
			$data['errors'] = $this->jobRepository->errors();
			return ViewManager::loadViewIntoClientMasterPage('Create Job', 'JobCreateView', $data);
		}
	}


	private function createJobValuesArrayFromPostArray()
	{
		return [
			//"CreatedBy" =>  $this->session->get("UserId"),
			"AssignedTo" => $this->request->getPost("AssignedTo"),
			"DurationEstimate" => $this->request->getPost("DurationEstimate"),
			"EquipmentRequired" => $this->request->getPost("EquipmentRequired"),
			"JobCategory" => $this->request->getPost("JobCategory"),
			"JobCounty" => $this->request->getPost("JobCounty"),
			"JobDetails" => $this->request->getPost("JobDetails"),
			"JobPrice" => $this->request->getPost("JobPrice"),
			"JobStatus" => $this->request->getPost("JobStatus"),
		];
	}
	private function createJobValuesArrayForNewJobFromPostArray()
	{
		return [
			"CreatedBy" => $this->session->get("UserId"),
			"DurationEstimate" => $this->request->getPost("DurationEstimate"),
			"EquipmentRequired" => $this->request->getPost("EquipmentRequired"),
			"JobCategory" => $this->request->getPost("JobCategory"),
			"JobCounty" => $this->request->getPost("JobCounty"),
			"JobDetails" => $this->request->getPost("JobDetails"),
			"JobPrice" => $this->request->getPost("JobPrice"),
			"JobStatus" => JobStatus::Open,
		];
	}
	public function myjobs()
	{
		if ($this->isLoggedIn()) {
			$userID = $this->session->get("UserId");

			$jobs = $this->db->query("Call GetMyJobs(?)", $userID)->getResult();

			$data = [
				"jobs" => $jobs,

			];

			return ViewManager::loadViewIntoClientMasterPage('My Jobs', 'MyJobsView', $data);
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}

	public function mycompletedjobs()
	{
		if ($this->isLoggedIn()) {
			$userID = $this->session->get("UserId");
			$jobs = $this->db->query("Call GetMyCompletedJobs(?)", $userID)->getResult();
			$data = ["jobs" => $jobs];

			return ViewManager::loadViewIntoClientMasterPage('My Completed Jobs', 'MyCompletedJobsView', $data);
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}
}
