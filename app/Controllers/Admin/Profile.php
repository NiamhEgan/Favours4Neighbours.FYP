<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserRepository;
use App\Libraries\AdminViewManager;
use App\Models\CountyRepository;
use Exception;


class Profile extends BaseController
{
	public function __construct()
	{
		$this->session = \Config\Services::session();

		$this->userRepository = new UserRepository();
		$this->countyRepository = new CountyRepository();
		helper('ArrayTransformer');
	}

	public function index()
	{
		if ($this->isLoggedIn()) {
			$userId = $this->session->get('UserId');
			$user = $this->userRepository->find($userId);
			$data = ['profile' => $user,];
			return AdminViewManager::loadView('Profile', 'AdminProfileView', $data);
		} else {
			echo  AdminViewManager::load403Error();
		}
	}

	public function edit()
	{
		if ($this->isLoggedIn()) {
			return $this->getEditView();
		} else {
			return AdminViewManager::load403Error();
		}
	}

	private function getEditView()
	{
		$userId = $this->session->get('UserId');
		$user = null;
		$data = [
			"countyDataSource" => transformObjectArray($this->countyRepository->findAll(), "ID_county", "county"),
		];
		if ($this->request->getVar('SaveButton') !== null) {
			$user = $this->executeSave($data, $userId);
			
		} else {
			$user = $this->userRepository->find($userId);
		}
		$data['user'] = $user;

		return AdminViewManager::loadView('Edit Profile', 'AdminProfileEditView', $data);
	}

	private function executeSave(&$data, $userId)
	{
		$valuesArray = $this->createUserValuesArrayFromPostArray();
		try {
			$commandResult = $this->userRepository->update($userId, $valuesArray);
			$data["message"] = "Profile Saved";
		} catch (Exception $e) {
			$data['errors'] = $this->userRepository->errors();
		}
		return $this->userRepository->find($userId);
	}

	private function createUserValuesArrayFromPostArray()
	{
		return [
			"AddressLine1" => $this->request->getVar("AddressLine1"),
			"AddressLine2" => $this->request->getVar("AddressLine2"),
			"Eircode" => $this->request->getVar("Eircode"),
			"email" => $this->request->getVar("email"),
			"FirstName" => $this->request->getVar("FirstName"),
			"Gender" => $this->request->getVar("Gender"),
			"Surname" => $this->request->getVar("Surname"),
			"Telephone" => $this->request->getVar("Telephone"),
		];
	}
	//
	//	Private functions
	//
	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null && $this->session->get("UserIsAdmin") == 1);
	}
}
