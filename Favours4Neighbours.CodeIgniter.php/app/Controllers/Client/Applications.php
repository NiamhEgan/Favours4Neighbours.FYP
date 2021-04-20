<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\CountyRepository;
use App\Models\JobApplicationRepository;
use App\Models\JobCategoryRepository;
use App\Models\JobRepository;
use App\Models\UserRepository;

class Applications extends BaseController
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
	}

	
	public function index()
	{
		if ($this->isLoggedIn()) {
			$userID = $this->session->get("UserId");

			$jobApplications = $this->db->query("Call GetJobApplicationsViewByUser(?)", $userID)->getResult();

			$data = [
				"jobApplications" => $jobApplications,

			];
			$masterData = [
				'mainContent' => view("MyApplicationsView", $data),
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
	public function myapplications()
	{
		if ($this->isLoggedIn()) {
			$userID = $this->session->get("UserId");

			$jobApplications = $this->db->query("Call GetJobApplicationsViewByUser(?)", $userID)->getResult();

			$data = [
				"jobApplications" => $jobApplications,

			];
			$masterData = [
				'mainContent' => view("MyApplicationsView", $data),
				'title' => "Favours 4 Neighbours: My Applications",
				'navTemplate' => "nav-admin.php",
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

	public function rejectapplications(){

		
	}
	
}
