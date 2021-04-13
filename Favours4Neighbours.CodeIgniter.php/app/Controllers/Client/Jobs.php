<?php

namespace App\Controllers\Client;

use App\Models\JobRepository;
use App\Controllers\BaseController;

class Jobs extends BaseController
{
	protected $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->session->start();

		$this->JobRepository = new JobRepository();
		$this->db = \Config\Database::connect();
	}

	public function index()
	{
		echo view('templates/header');
		if ($this->isLoggedIn()) {
			$jobs = $this->JobRepository->findAll();

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

	public function new()
	{
		if ($this->request->getPost("CreateButton") !== null) {
			$createJobValuesArray = $this->createJobValuesArrayFromPostArray();
			try {
				$commandResult = $this->JobRepository->insert($createJobValuesArray);
				return redirect()->to("/login");
			} catch (Exception $e) {
				$data = [
					'mainContent' => view("CreateJobView"),
					'title' => "Favours 4 Neighbours: Create Job",
					'errors' => $this->JobRepository->errors(),
				];
				return view('MasterPage', $data);
			}
		} else
			$data = [
				'mainContent' => view("CreateJobView"),
				'title' => "Favours 4 Neighbours: Create Job",
			];
		return view('MasterPage', $data);
	}


	private function executeDelete()
	{
		if ($this->request->getPost("CreateButton") !== null) {
			$createJobValuesArray = $this->createJobValuesArrayFromPostArray();
			try {
				$commandResult = $this->JobRepository->insert($createJobValuesArray);
				return redirect()->to("/login");
			} catch (Exception $e) {
				$data = [
					'mainContent' => view("CreateJobView"),
					'title' => "Favours 4 Neighbours: Create Job",
					'errors' => $this->JobRepository->errors(),
				];
				return view('MasterPage', $data);
			}
		}
	}
	public function delete($userID)
	{
		if ($this->isLoggedIn()) {

			$job = $this->JobRepository->find($userID);

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



	private function createJobValuesArrayFromPostArray()
	{
		return [
			"userID" =>  $this->session->get("UserId"),
			"JobDetails" => $this->request->getPost("JobDetails"),
			"JobStatus" => $this->request->getPost("JobStatus"),
			"EquipmentRequired" => $this->request->getPost("EquipmentRequired"),
			"DurationEstimate" => $this->request->getPost("DurationEstimate"),
			"JobPrice" => $this->request->getPost("JobPrice"),
			"DateCreated" => $this->request->getPost("DateCreated"), //DateTime.Now()
		];
	}
	public function myjobs()
	{
		if ($this->isLoggedIn()) {
			$userID = $this->session->get("UserId");
			$jobs = $this->db->query('Call myjobs;')->getResult();
			/*$this->JobRepository
				->join('User U', 'U.Id = AssignedTo', "left")
				->join('jobcategory JC', 'JC.Id = Job.JobCategory', "left")
				->where("CreatedBy", $userID)
				->findAll();*/


		var_dump($jobs);
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
