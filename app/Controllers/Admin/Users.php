<?php

namespace App\Controllers\Admin;

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
			echo ViewManager::loadViewIntoAdminMasterPage('Users', 'UsersView', $data);
		} else {
			echo  ViewManager::load403ErrorViewIntoAdminMasterPage();
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
				echo ViewManager::load404ErrorViewIntoMasterPageAdmin("No User found for $userId");
			} else {
				return $this->getView($userId, $user);
			}
		} else {
			echo  ViewManager::load403ErrorViewIntoAdminMasterPage();
		}
	}

	public function suspendUser($userId)
	{
		if ($this->isLoggedIn()) {
			$user = $this->userRepository->findall($userId);

			if ($user == null) {
				echo ViewManager::load404ErrorViewIntoMasterPageAdmin("No User found for $userId");
			} else {
				return $this->getView($userId, $user);
			}
		} else {
			echo  ViewManager::load403ErrorViewIntoAdminMasterPage();
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
				echo ViewManager::load404ErrorViewIntoMasterPageAdmin("No User found for $userId");
			} else {
				return $this->getView($userId, $user);
			}
		} else {
			echo  ViewManager::load403ErrorViewIntoAdminMasterPage();
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
}
