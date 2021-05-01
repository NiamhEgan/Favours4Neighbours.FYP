<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminViewManager;
use App\Models\CountyRepository;
use App\Models\JobApplicationRepository;
use App\Models\JobCategoryRepository;
use App\Models\JobRepository;
use App\Models\UserRepository;
use App\Models\UserStatus;
use Exception;

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


	public function edit($userId)
	{
		if ($this->isLoggedIn()) {
			$user = $this->userRepository->find($userId);

			if ($user == null) {
				echo AdminViewManager::load404Error("No User found for $userId");
			} else {
				return $this->getEditView($userId, $user);
			}
		} else {
			echo  AdminViewManager::load403Error();
		}
	}
	public function index()
	{
		if ($this->isLoggedIn()) {
			$users = $this->userRepository->findAll();
			$data = ['users' => $users,];
			echo AdminViewManager::loadView('Users', 'UsersView', $data);
		} else {
			echo AdminViewManager::load403Error();
		}
	}
	public function search()
	{
		if ($this->isLoggedIn()) {
			return $this->getSearchView();
		} else {
			echo AdminViewManager::load403Error();
		}
	}
	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null && $this->session->get("UserIsAdmin") == 1);
	}

	public function view($userId)
	{
		if ($this->isLoggedIn()) {
			$user = $this->userRepository->find($userId);

			if ($user == null) {
				echo AdminViewManager::load404Error("No User found for $userId");
			} else {
				//TODO: View
				return $this->getView($userId, $user);
			}
		} else {
			echo  AdminViewManager::load403Error();
		}
	}



	private function getEditView($userId, $user)
	{
		$data = [
			'countyDataSource' => transformObjectArray($this->countyRepository->findAll(), "ID_county", "county"),
		];
		if ($this->request->getVar("SaveButton") !== null) {
			$user = $this->executeSave($data, $userId);
		} else {
			$user = $this->userRepository->find($userId);
		}
		$data['user'] = $user;

		return AdminViewManager::loadView('Edit ' . $user['Username'], 'AdminUserEditView', $data);
	}
	private function getSearchView()
	{
		if ($this->request->getVar('SearchButton') !== null) {
			$data = $this->executeSearch();
			return AdminViewManager::loadView('Search Users', 'AdminSearchUsersView', $data);
		} else
			return AdminViewManager::loadView('Search Users', 'AdminSearchUsersView');
	}

	private function executeSearch()
	{
		$searchValue = $this->request->getVar('SearchValue');
		$users = $this->db->query('Call SearchUser(?)', $searchValue)->getResult();
		return ['users' => $users];
	}

	private function executeSave(&$data, $userId)
	{
		//TODO: Check user isn't diabling themselves?
		$valuesArray = $this->createUserValuesArrayFromPostArray();
		try {
			$commandResult = $this->userRepository->update($userId, $valuesArray);
			$data["message"] = "User Updated";
		} catch (Exception $e) {
			$data['errors'] = $this->userRepository->errors();
		}
		return $this->userRepository->find($userId);
	}

	private function createUserValuesArrayFromPostArray()
	{
		return [
			'Active' => $this->request->getVar('Active'),
			'AddressLine1' => $this->request->getVar('AddressLine1'),
			'AddressLine2' => $this->request->getVar('AddressLine2'),
			'Eircode' => $this->request->getVar('Eircode'),
			'email' => $this->request->getVar('email'),
			'FirstName' => $this->request->getVar('FirstName'),
			'Gender' => $this->request->getVar('Gender'),
			'IsAdmin' => $this->request->getVar('IsAdmin'),
			'Surname' => $this->request->getVar('Surname'),
			'Telephone' => $this->request->getVar('Telephone'),
		];
	}


	public function enable($userId)
	{
		if ($this->isLoggedIn()) {
			$user = $this->userRepository->findall($userId);

			if ($user == null) {
				echo AdminViewManager::load404Error("No User found for $userId");
			} else {
				$data=[];
				$this->executeSetUserActive($data, $userId, 1);
				echo $this->suspendedUsers();
			}
		} else {
			echo  AdminViewManager::load403Error();
		}
	}
	private function executeSetUserActive(&$data, $userId, $active)
	{
		$valuesArray = ['Active' => $active];
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

	public function resetPassword()
	{
	}
	public function suspendedUsers()
	{
		if ($this->isLoggedIn()) {
			$users = $this->userRepository
				->where('Active', UserStatus::Suspended)
				->findAll();
			$data = ['users' => $users,];
			echo AdminViewManager::loadView('Users', 'SuspendedUsersView', $data);
		} else {
			echo AdminViewManager::load403Error();
		}
	}
}
