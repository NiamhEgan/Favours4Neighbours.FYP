<?php

namespace App\Controllers\Client;

use App\Models\CountyRepository;
use App\Models\JobCategoryRepository;
use App\Models\JobRepository;
use App\Models\UserRepository;

use App\Controllers\BaseController;

class Jobs extends BaseController
{
	protected $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->session->start();

		$this->countyRepository = new CountyRepository();
		$this->jobCategoryRepository = new JobCategoryRepository();
		$this->jobRepository = new JobRepository();
		$this->userRepository = new UserRepository();


		$this->db = \Config\Database::connect();
	}

	public function index()
	{
		echo view('templates/header');
		if ($this->isLoggedIn()) {
			$jobs = $this->jobRepository->findAll();

			$data = [
				"jobs" => $jobs,
			];
			$masterData = [
				'mainContent' => view("JobsView", $data),
				'title' => "Favours 4 Neighbours: Create Job",
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
	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null);
	}

	private function executeDelete()
	{
		if ($this->request->getPost("CreateButton") !== null) {
			$createJobValuesArray = $this->createJobValuesArrayFromPostArray();
			try {
				$commandResult = $this->jobRepository->insert($createJobValuesArray);
				return redirect()->to("/login");
			} catch (Exception $e) {
				$data = [
					'mainContent' => view("CreateJobView"),
					'title' => "Favours 4 Neighbours: Create Job",
					'errors' => $this->jobRepository->errors(),
				];
				return view('MasterPage', $data);
			}
		}
	}
	public function delete($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);

			if ($job == null) {
				//error
			} else if ($job["userID"] != $this->session->get("UserId")) {
				//error
			} else {
				$this->executeDelete();
			}
		} else {
			//error
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
	private function transformObjectArray($objectArray, $objectKeyName, $objectValueName)
	{
		$dataArray = [];
		foreach ($objectArray as $objectItem) {
			$key = $objectItem[$objectKeyName];
			$dataArray[$key] = $objectItem[$objectValueName];
		}
		return $dataArray;
	}
	private function transformObjectArrayWithNullValue($objectArray, $objectKeyName, $objectValueName)
	{
		$dataArray = [];
		$dataArray[""] = "";
		foreach ($objectArray as $objectItem) {
			$key = $objectItem[$objectKeyName];
			$dataArray[$key] = $objectItem[$objectValueName];
		}
		return $dataArray;
	}
	private function getCreateView()
	{
		$data = [
			"countyDataSource" => $this->transformObjectArray($this->countyRepository->findAll(), "ID_county", "county"),
			"asssignedToDataSource" => $this->transformObjectArrayWithNullValue($this->userRepository->findAll(), "Id", "Username"),
			"jobCategoryDataSource" => $this->transformObjectArray($this->jobCategoryRepository->findAll(), "Id", "JobCategory"),
		];
		if ($this->request->getPost("CreateButton") !== null) {
			$jobId = $this->executeInsert($data);
		}

		$masterData = [
			'mainContent' => view("CreateJobView", $data),
			'navTemplate' => "nav-admin.php",
			'title' => "Favours 4 Neighbours: Create Job",
		];
		return view('MasterPage', $masterData);
	}

	private function getEditView($jobId, $job)
	{
		$data = [
			"countyDataSource" => $this->transformObjectArray($this->countyRepository->findAll(), "ID_county", "county"),
			"asssignedToDataSource" => $this->transformObjectArrayWithNullValue($this->userRepository->findAll(), "Id", "Username"),
			"jobCategoryDataSource" => $this->transformObjectArrayWithNullValue($this->userRepository->findAll(), "Id", "Username"),
		];
		if ($this->request->getPost("SaveButton") !== null) {
			$job = $this->executeSave($data, $jobId);
		}
		$data["job"] = $job;

		$masterData = [
			'mainContent' => view("JobEditView", $data),
			'navTemplate' => "nav-admin.php",
			'title' => "Favours 4 Neighbours: Edit Job",
		];
		return view('MasterPage', $masterData);
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
		} catch (Exception $e) {
			$data['errors'] = $this->jobRepository->errors();
		}
		return $this->jobRepository->find($jobId);
	}


	private function createJobValuesArrayFromPostArray()
	{
		return [
			"CreatedBy" =>  $this->session->get("UserId"),
			"JobDetails" => $this->request->getPost("JobDetails") . "asas",
			"JobStatus" => $this->request->getPost("JobStatus") . "as",
			"EquipmentRequired" => $this->request->getPost("EquipmentRequired") . "as",
			"DurationEstimate" => $this->request->getPost("DurationEstimate") . "as",
			"JobPrice" => $this->request->getPost("JobPrice"),
		];
	}
	private function createJobValuesArrayForNewJobFromPostArray()
	{
		return [
			"CreatedBy" => $this->request->getPost("CreatedBy"),
			"JobDetails" => $this->request->getPost("JobDetails"),
			"JobStatus" => $this->request->getPost("JobStatus"),
			"EquipmentRequired" => $this->request->getPost("EquipmentRequired"),
			"DurationEstimate" => $this->request->getPost("DurationEstimate"),
			"JobPrice" => $this->request->getPost("JobPrice"),
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
