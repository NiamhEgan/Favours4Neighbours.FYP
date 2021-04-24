<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Libraries\ViewManager;
use App\Models\CountyRepository;
use App\Models\JobApplicationRepository;
use App\Models\JobCategoryRepository;
use App\Models\JobRepository;
use App\Models\JobStatus;
use App\Models\UserRepository;

class Users extends BaseController
{
	protected $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();

		$this->countyRepository = new CountyRepository();
		$this->jobApplicationRepository = new JobApplicationRepository();
		$this->jobCategoryRepository = new JobCategoryRepository();
		$this->jobRepository = new JobRepository();
		$this->userRepository = new UserRepository();

		$this->db = \Config\Database::connect();

		helper('ArrayTransformer');
	}

	public function index()
	{
        //???
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

	public function view($userId)
	{
		if ($this->isLoggedIn()) {
			$user = $this->userRepository->find($userId);

			if ($user == null) {
				echo ViewManager::load404ErrorViewIntoClientMasterPage("No User found for $userId");
			} else {
				return $this->getView($userId, $user);
			}
		} else {
			echo  ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}

	private function getView($userId, $user)
	{
        //Change query to get jobs completed GetJobsCompletedByAssignedUserView()
		$jobsCompleted = $this->db->query("Call GetJobsCompletedByAssignedUserView(?)", $userId)->getResult();

		$data = [
			"user" => $user,
			"jobsCompleted" => $jobsCompleted,
		];

        // use Myprofile view and JobView to make
		return ViewManager::loadViewIntoClientMasterPage('Favours 4 Neighbours: User', 'UserView', $data);
	}}
