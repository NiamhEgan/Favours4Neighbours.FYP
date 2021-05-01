<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Libraries\ClientViewManager;
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
				return ClientViewManager::load404Error("No job found for Job #:$jobId");
			else
				return $this->getApplyView($jobId);
		} else {
			return ClientViewManager::load403Error();
		}
	}

	public function close($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);

			if ($job == null) {
				echo ClientViewManager::load404Error("No Job found for $jobId");
			} else if ($job["CreatedBy"] != $this->session->get("UserId")) {
				echo ClientViewManager::load403Error();
			} else {
				return $this->executeCloseJob($jobId);
			}
		} else {
			echo  ClientViewManager::load403Error();
		}
	}

	public function getApplyView($jobId)
	{
		$userId = $this->session->get('UserId');
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
			return ClientViewManager::loadView('', 'message', ['message' => 'You have applied for a job! Best of Luck!.']);
		} else {
			$data = ['message' => 'you have alreay applied for this job'];
			return ClientViewManager::loadView('Application', 'Message', $data);
		}
	}
	public function accept($jobApplicationId)
	{
		if ($this->isLoggedIn()) {
			$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
			if ($jobApplication == null)
				return ClientViewManager::load404Error("No Job Application found for Job Application #:$jobApplicationId");
			else {
				$this->executeAcceptJobApplication($jobApplicationId);
				return ClientViewManager::loadView('', 'message', ['message' => 'Application has been accepted.']);
			}
		} else {
			return ClientViewManager::load403Error();
		}
	}

	public function create()
	{
		if ($this->isLoggedIn()) {
			return $this->getCreateView();
		} else {
			return ClientViewManager::load403Error();
		}
	}
	public function delete($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);
			if ($job == null) {
				echo ClientViewManager::load404Error("No Job found for $jobId");
			} else if ($job["userID"] != $this->session->get("UserId")) {
				echo ClientViewManager::load403Error();
			} else {
				$this->executeDelete($jobId);
			}
		} else {
			echo  ClientViewManager::load403Error();
		}
	}
	public function view($jobId)
	{
		if ($this->isLoggedIn()) {

			$job = $this->db->query('Call GetJobViewById(?)', $jobId)->getRowArray();

			if ($job == null) {
				echo ClientViewManager::load404Error("No Job found for $jobId");
			} else if ($job['CreatedBy'] != $this->session->get('UserId')) {
				echo ClientViewManager::load403Error();
			} else {
				return $this->getView($jobId, $job);
			}
		} else {
			echo  ClientViewManager::load403Error();
		}
	}
	public function viewtender($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->db->query("Call GetJobViewById(?)", $jobId)->getRow();
			if ($job == null) {
				echo ClientViewManager::load404Error("No Job found for $jobId");
			} else {
				return $this->getTenderView($job);
			}
		} else {
			echo  ClientViewManager::load403Error();
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
			echo ClientViewManager::load403Error();
		}
	}
	public function index()
	{
		if ($this->isLoggedIn()) {
			$userId = $this->session->get("UserId");
			$jobs = $this->db->query("Call GetAvailableJobsView(?)", $userId)->getResult();
			$data = [
				"jobs" => $jobs,
			];
			echo ClientViewManager::loadView('My Jobs', 'AvailableJobsView', $data);
		} else {
			echo  ClientViewManager::load403Error();
		}
	}
	public function myjobs()
	{
		if ($this->isLoggedIn()) {
			$userID = $this->session->get("UserId");

			$jobs = $this->db->query("Call GetMyJobs(?)", $userID)->getResult();

			$data = [
				"jobs" => $jobs,

			];

			return ClientViewManager::loadView('My Jobs', 'MyJobsView', $data);
		} else {
			return ClientViewManager::load403Error();
		}
	}

	public function mycompletedjobs()
	{
		if ($this->isLoggedIn()) {
			$userID = $this->session->get("UserId");
			$jobs = $this->db->query("Call GetMyCompletedJobs(?)", $userID)->getResult();
			$data = ["jobs" => $jobs];

			return ClientViewManager::loadView('My Completed Jobs', 'MyCompletedJobsView', $data);
		} else {
			return ClientViewManager::load403Error();
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

		return ClientViewManager::loadView('Create Job', 'JobCreateView', $data);
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
				return ClientViewManager::load404Error("No Job Application found for Job Application #:$jobApplicationId");
			else {
				//TODO: return $this->getAcceptView($jobApplicationId);
				$this->executeRejectJobApplication($jobApplicationId);

				return ClientViewManager::loadView('', 'message', ['message' => 'This Application has been rejected.']);
			}
		} else {
			return ClientViewManager::load403Error();
		}
	}


	private function executeRejectJobApplication($jobApplicationId)
	{
		$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
		$jobApplication["Status"] = JobApplicationStatus::Rejected;
		$commandResult = $this->jobApplicationRepository->update($jobApplicationId, $jobApplication);

		$job = $this->jobRepository->find($jobApplication["Job"]);
		$job["AssignedTo"] = $jobApplication['Applicant'];

		$commandResult = $this->jobRepository->update($job["Id"], $job);
	}


	private function executeCloseJob($jobId)
	{

		$jobValuesArray = [
			'JobStatus' => JobStatus::Closed,
		];
		$this->jobRepository->update($jobId, $jobValuesArray);
		$data = ['message' => "Job: $jobId has been closed"];
		echo ClientViewManager::loadView('Application', 'Message', $data);
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
			echo ClientViewManager::loadView('My Jobs', 'AvailableJobsView', $data);
		}
	}




	private function getTenderView($job)
	{
		$data = ["job" => $job];

		return ClientViewManager::loadView('View Job', 'JobTenderView', $data);
	}


	private function getView($jobId, $job)
	{
		$jobApplications = $this->db->query("Call GetJobApplicationsViewByJob(?)", $jobId)->getResult();

		$data = [
			"job" => $job,
			"jobApplications" => $jobApplications,
		];

		return ClientViewManager::loadView('View Job', 'JobView', $data);
	}
	private function getEditView($jobId, $job)
	{
		$data = [
			"asssignedToDataSource" => transformObjectArrayWithNullValue($this->userRepository->findAll(), "Id", "Username"),
			"jobCategoryDataSource" => transformObjectArray($this->jobCategoryRepository->findAll(), "Id", "JobCategory"),
			"jobCountyDataSource" => transformObjectArray($this->countyRepository->findAll(), "ID_county", "county"),
			'jobStatusDataSource' => [1 => 'Completed', 2 => 'Open'],
		];
		if ($this->request->getPost("SaveButton") !== null) {
			$job = $this->executeSave($data, $jobId);
		}
		$data['job'] = $job;

		return ClientViewManager::loadView('Edit Job', 'JobEditView', $data);
	}
	private function executeSave(&$data, $jobId)
	{
		$jobValuesArray = $this->createJobValuesArrayFromPostArray();
		try {
			$commandResult = $this->jobRepository->update($jobId, $jobValuesArray);
			$data['message'] = 'Job Saved';
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
			return ClientViewManager::loadView('', 'message', ['message' => 'Job has been created.']);
			//return redirect()->to("/client/jobs/edit/" . $commandResult);
		} catch (Exception $e) {
			$data['errors'] = $this->jobRepository->errors();
			return ClientViewManager::loadView('Create Job', 'JobCreateView', $data);
		}
	}


	private function createJobValuesArrayFromPostArray()
	{
		return [
			//"CreatedBy" =>  $this->session->get("UserId"),
			'AssignedTo' => $this->request->getPost('AssignedTo') == '' ? null : $this->request->getPost('AssignedTo'),
			'DurationEstimate' => $this->request->getPost('DurationEstimate'),
			'EquipmentRequired' => $this->request->getPost('EquipmentRequired'),
			'JobCategory' => $this->request->getPost('JobCategory'),
			'JobCounty' => $this->request->getPost('JobCounty'),
			'JobDetails' => $this->request->getPost('JobDetails'),
			'JobPrice' => $this->request->getPost('JobPrice'),
			'JobStatus' => $this->request->getPost('JobStatus'),
		];
	}
	private function createJobValuesArrayForNewJobFromPostArray()
	{
		return [
			'CreatedBy' => $this->session->get('UserId'),
			'DurationEstimate' => $this->request->getPost('DurationEstimate'),
			'EquipmentRequired' => $this->request->getPost('EquipmentRequired'),
			'JobCategory' => $this->request->getPost('JobCategory'),
			'JobCounty' => $this->request->getPost('JobCounty'),
			'JobDetails' => $this->request->getPost('JobDetails'),
			'JobPrice' => $this->request->getPost('JobPrice'),
			'JobStatus' => JobStatus::Open,
		];
	}
}
