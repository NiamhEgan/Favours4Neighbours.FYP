<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminViewManager;
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
			echo AdminViewManager::loadView('Users', 'UsersView', $data);
		} else {
			echo  AdminViewManager::load403Error();
		}
	}
	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null);
	}

	public function view($userId)
	{
		if ($this->isLoggedIn()) {
			$user = $this->userRepository->findall($userId);

			if ($user == null) {
				echo AdminViewManager::load404Error("No User found for $userId");
			} else {
				return $this->getView($userId, $user);
			}
		} else {
			echo  AdminViewManager::load403Error();
		}
	}

	public function suspendUser($userId)
	{
		if ($this->isLoggedIn()) {
			$user = $this->userRepository->findall($userId);

			if ($user == null) {
				echo AdminViewManager::load404Error("No User found for $userId");
			} else {
				return $this->getView($userId, $user);
			}
		} else {
			echo  AdminViewManager::load403Error();
		}
	}
	private function executeSuspend(&$data, $userId)
	{
		$valuesArray = $this->createUserValuesArrayFromPostArray();
		try {
			$commandResult = $this->userRepository->update($userId, $valuesArray);
			$data["message"] = "User Suspended";
		} catch (Exception $e) {
			$data['errors'] = $this->userRepository->errors();
		}
		return $this->userRepository->find($userId);
	}

	public function enableUser($userId)
	{
		if ($this->isLoggedIn()) {
			$user = $this->userRepository->findall($userId);

			if ($user == null) {
				echo AdminViewManager::load404Error("No User found for $userId");
			} else {
				return $this->getView($userId, $user);
			}
		} else {
			echo  AdminViewManager::load403Error();
		}
	}
	private function executeEnable(&$data, $userId)
	{
		$valuesArray = $this->createUserValuesArrayFromPostArray();
		try {
			$commandResult = $this->userRepository->update($userId, $valuesArray);
			$data["message"] = "User Enabled";
		} catch (Exception $e) {
			$data['errors'] = $this->userRepository->errors();
		}
		return $this->userRepository->find($userId);
	}

	public function searchUser()
	{
		helper('array');
		$data = [
			"countyDataSource" => transformObjectArray($this->CountyRepository->findAll(), "ID_county", "county")
		];
		if ($this->request->getVar("SearchButton") !== null) {
			$userValuesArray = $this->createUserValuesArrayFromPostArray();
			try {
				$commandResult = $this->UserRepository->insert($userValuesArray);
				return redirect()->to("admin/login");
			} catch (Exception $e) {
				$data['errors'] = $this->UserRepository->errors();
			}
		} else
		return AdminViewManager::loadView('Users', 'SearchUsersView', $data);
	}

}
