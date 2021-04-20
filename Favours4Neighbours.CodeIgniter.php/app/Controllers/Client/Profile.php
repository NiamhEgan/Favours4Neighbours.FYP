<?php

namespace App\Controllers\Client;

use App\Libraries\ViewManager;
use App\Controllers\BaseController;
use App\Models\UserRepository;

class Profile extends BaseController
{
	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->session->start();

		$this->userRepository = new UserRepository();
	}

	public function changepassword()
	{
		if ($this->isLoggedIn()) {
			return $this->getChangePasswordView();
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}

		if ($this->isLoggedIn()) {
			$masterData = [
				'mainContent' => view("MyProfileChangePasswordView"),
				'navTemplate' => "nav-admin.php",
				'title' => "Favours 4 Neighbours: My Profile Change Password",
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
	private function getChangePasswordView()
	{
		$data = [];
		if ($this->request->getVar("ChangePasswordButton") !== null) {
			$user = $this->executeChangePassword($data);
		}
		$data['user'] = $user;

		return ViewManager::loadViewIntoClientMasterPage('Favours 4 Neighbours: Edit Profile', 'MyProfileEditView', $data);
	}
	private function executeChangePassword(&$data)
	{
		$newPassword = $this->request->getVar("newPassword");
		$newPasswordConfirmed = $this->request->getVar("newPasswordConfirmed");

		
		$currentPassword = $this->request->getVar("CurrentPassword");
		
		$userId = $this->session->get("UserId");
		$hashedPassword = $this->UserRepository->createPasswordHash($currentPassword);
		$user = $this->UserRepository->where('Id', $userId)
			->where('Password',  $hashedPassword)
			->first();



		if ($user != null) {

			$hashedNewPassword = $this->UserRepository->createPasswordHash($newPassword);
			$valuesArray = ['Password' => $hashedNewPassword];
			try {
				$commandResult = $this->userRepository->update($userId, $valuesArray);
				$data["message"] = "Password Changed";
			} catch (Exception $e) {
				$data['errors'] = $this->userRepository->errors();
			}
		} else {
			$data['errors'] = "invalid Passowrd";
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

	public function edit()
	{
		if ($this->isLoggedIn()) {
			$userId = $this->session->get("UserId");
			$user = $this->userRepository->find($userId);
			return $this->getEditView($userId, $user);
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}
	public function index()
	{
		if ($this->isLoggedIn()) {
			$userId = $this->session->get("UserId");
			$user = $this->userRepository->find($userId);
			$data = [
				"user" => $user,
			];

			return ViewManager::loadViewIntoClientMasterPage('Favours 4 Neighbours: Profile', 'MyProfileView', $data);
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}
	private function getEditView($userId, $user)
	{
		$data = [
			//"countyDataSource" => $this->transformObjectArray($this->countyRepository->findAll(), "ID_county", "county"),
		];
		if ($this->request->getVar("SaveButton") !== null) {
			$user = $this->executeSave($data, $userId);
		}
		$data['user'] = $user;

		return ViewManager::loadViewIntoClientMasterPage('Favours 4 Neighbours: Edit Profile', 'MyProfileEditView', $data);
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
