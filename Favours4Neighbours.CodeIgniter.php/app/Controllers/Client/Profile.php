<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\UserRepository;

class Profile extends BaseController
{
	protected $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->session->start();

		$this->UserRepository = new UserRepository();
	}


	public function index()
	{
		if ($this->isLoggedIn()) {
			$userId =$this->session->get("UserId");
			$profile = $this->UserRepository->find($userId);

			$data = [
				"profile" => $profile,
			];
			$masterData = [
				'mainContent' => view("ProfileView", $data),
				'navTemplate' => "nav-admin.php",
				'title' => "Favours 4 Neighbours: Profile",
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
	public function delete($jobId)
	{
		if ($this->isLoggedIn()) {

			$job = $this->JobRepository->find($jobId);

			if ($job == null) {
				//error
			} else if ($job["CreatedBy"] != $this->session->get("UserId")) {
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
			"CreatedBy" =>  $this->session->get("UserId"),
			"jobDetails" => $this->request->getPost("jobDetails"),
			"JobStatus" => $this->request->getPost("JobStatus"),
			"EquipmentRequired" => $this->request->getPost("EquipmentRequired"),
			"DurationEstimate" => $this->request->getPost("DurationEstimate"),
			"JobPrice" => $this->request->getPost("JobPrice"),
			"DateCreated" => $this->request->getPost("DateCreated"),//DateTime.Now()
		];
	}
}
