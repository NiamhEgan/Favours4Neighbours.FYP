<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Libraries\ClientViewManager;
use App\Models\CountyRepository;
use App\Models\JobApplicationRepository;
use App\Models\JobCategoryRepository;
use App\Models\JobRepository;
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
		if ($this->isLoggedIn()) {
			$users = $this->userRepository->findAll();
			$data = ['users' => $users,];
			echo ClientViewManager::loadView('Users', 'UsersView', $data);
		} else {
			echo ClientViewManager::load403Error();
		}
	}
	private function isLoggedIn()
	{
		return ($this->session->get('UserId') !== null);
	}

	public function view($userId)
	{
		if ($this->isLoggedIn()) {
			$user = $this->userRepository->find($userId);

			if ($user == null) {
				echo ClientViewManager::load404Error("No User found for $userId");
			} else {
				return $this->getView($userId, $user);
			}
		} else {
			echo  ClientViewManager::load403Error();
		}
	}

	private function getView($userId, $user)
	{
		$jobsCompleted = $this->db->query("Call GetJobsCompletedByApplicant(?)", $userId)->getResult();

		$data = [
			"user" => $user,
			"jobs" => $jobsCompleted,
		];

        //TODO: use Myprofile view and JobView to make
		return ClientViewManager::loadView('User', 'UserView', $data);
	}}
