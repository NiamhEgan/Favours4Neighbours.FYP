<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Libraries\ClientViewManager;
use App\Models\CountyRepository;
use App\Models\UserRepository;
use Exception;

class Profile extends BaseController
{
	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->countyRepository = new CountyRepository();
		$this->userRepository = new UserRepository();
		helper('ArrayTransformer');
	}

	public function changepassword()
	{
		if ($this->isLoggedIn()) {
			return $this->getChangePasswordView();
		} else {
			return ClientViewManager::load403Error();
		}
	}
	public function edit()
	{
		if ($this->isLoggedIn()) {
			return $this->getEditView();
		} else {
			return ClientViewManager::load403Error();
		}
	}
	public function index()
	{
		if ($this->isLoggedIn()) {
			return $this->getIndexView();
		} else {
			return ClientViewManager::load403Error();
		}
	}

	private function getChangePasswordView()
	{
		$data = [];
		if ($this->request->getVar("ChangePasswordButton") !== null) {
			$this->executeChangePassword($data);
		}
		return ClientViewManager::loadView('Change Password', 'MyProfileChangePasswordView', $data);
	}
	private function getEditView()
	{
		$userId = $this->session->get("UserId");
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

		return ClientViewManager::loadView('Edit Profile', 'MyProfileEditView', $data);
	}
	private function getIndexView()
	{
		$userId = $this->session->get('UserId');
		$user = $this->userRepository->find($userId);
		$data = [
			"user" => $user,
		];

		return ClientViewManager::loadView('Profile', 'MyProfileView', $data);
	}

	private function executeChangePassword(&$data)
	{
		$newPassword = $this->request->getVar("NewPassword");
		$newPasswordConfirmed = $this->request->getVar("ConfirmNewPassword");

		if ($newPassword !=	$newPasswordConfirmed) {
			$data['errors'] = "Passwords do not match";
			return;
		}


		$currentPassword = $this->request->getVar("CurrentPassword");

		$userId = $this->session->get("UserId");
		$hashedPassword = $this->userRepository->createPasswordHash($currentPassword);
		$user = $this->userRepository->where('Id', $userId)
			->where('Password',  $hashedPassword)
			->first();



		if ($user != null) {
			$valuesArray = ['Password' => $newPassword];
			try {
				$commandResult = $this->userRepository->update($userId, $valuesArray);
				$data["message"] = "Password Changed";
			} catch (Exception $e) {
				$data['errors'] = $this->userRepository->errors();
			}
		} else {
			$data['errors'] = "invalid Passowrd";
		}
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
	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null);
	}
}
