<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Libraries\ViewManager;
use App\Models\CountyRepository;
use App\Models\JobApplicationRepository;
use App\Models\JobCategoryRepository;
use App\Models\JobRepository;
use App\Models\UserRepository;

class Jobs extends BaseController
{
	protected $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->session->start();

		$this->countyRepository = new CountyRepository();
		$this->jobApplicationRepository = new JobApplicationRepository();
		$this->jobCategoryRepository = new JobCategoryRepository();
		$this->jobRepository = new JobRepository();
		$this->userRepository = new UserRepository();

		$this->db = \Config\Database::connect();

		helper('ArrayTransformer');
	}

	public function accept($jobApplicationId)
	{
		$this->executeAcceptJobApplication($jobApplicationId);
		echo "view";
	}
	private  function executeAcceptJobApplication($jobApplicationId)
	{
		$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
		$jobApplication["Status"] = 2; //TODO DEfine status later
		$commandResult = $this->jobApplicationRepository->update($jobApplicationId, $jobApplication);

		$job = $this->jobRepository->find($jobApplication["Job"]);
		$job["AssignedTo"] = $jobApplication["User"];

		$commandResult = $this->jobRepository->update($job["Id"], $job);
	}
	public function reject($jobApplicationId)
	{
		$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
		$jobApplication["Status"] = 3; //TODO DEfine status later
	}
	public function apply($jobId)
	{
		$jobApplicationValuesArray = [
			"Job" => $jobId,
			"User" =>  $this->session->get("UserId"),
		];
		$this->jobApplicationRepository->insert($jobApplicationValuesArray);

		return $this->index();
	}


	public function index()
	{
		if ($this->isLoggedIn()) {
			$userId = $this->session->get("UserId");
			$jobs = $this->db->query("Call GetAvailableJobsView(?)", $userId)->getResult();
			$data = [
				"jobs" => $jobs,
			];
			echo ViewManager::loadViewIntoClientMasterPage('Favours 4 Neighbours: My Jobs', 'AvailableJobsView', $data);
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
			echo ViewManager::loadViewIntoClientMasterPage('Favours 4 Neighbours: My Jobs', 'AvailableJobsView', $data);
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
			$masterData = [
				'mainContent' => view("403"),
				'title' => "Favours 4 Neighbours: Unauthorised access",
			];
			return view('MasterPage', $masterData);
		}
	}
	public function create()
	{
		if ($this->isLoggedIn()) {
			return $this->getCreateView();
		} else {
			$masterData = [
				'mainContent' => view("403"),
				'title' => "Favours 4 Neighbours: Unauthorised access",
			];
			return view('MasterPage', $masterData);
		}
	}
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

		return ViewManager::loadViewIntoClientMasterPage('Favours 4 Neighbours: Create Job', 'JobCreateView', $data);
	}


	private function getTenderView($jobId, $job)
	{
		$data = [
			"job" => $job,
		];

		return ViewManager::loadViewIntoClientMasterPage('Favours 4 Neighbours: View Job', 'JobTenderView', $data);
	}
	private function getView($jobId, $job)
	{
		$jobApplications = $this->db->query("Call GetJobApplicationsViewByJob(?)", $jobId)->getResult();

		$data = [
			"job" => $job,
			"jobApplications" => $jobApplications,
		];

		return ViewManager::loadViewIntoClientMasterPage('Favours 4 Neighbours: View Job', 'JobView', $data);
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

		return ViewManager::loadViewIntoClientMasterPage('Favours 4 Neighbours: Edit Job', 'JobEditView', $data);
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
			"JobStatus" => $this->request->getPost("JobStatus"),
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
			$masterData = [
				'mainContent' => view("MyJobsView", $data),
				'navTemplate' => "nav-admin.php",
				'title' => "Favours 4 Neighbours: My Jobs",
			];
			return view('MasterPage', $masterData);
		} else {
			$masterData = [
				'mainContent' => view("403"),
				'title' => "Favours 4 Neighbours: Unauthorised access",
			];
			return view('MasterPage', $masterData);
		}
	}
}
