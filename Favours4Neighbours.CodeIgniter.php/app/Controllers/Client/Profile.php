<?php

namespace App\Controllers\Client;

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
	public function edit()
	{
		if ($this->isLoggedIn()) {
			$userId = $this->session->get("UserId");
			$user = $this->userRepository->find($userId);


			$data = [
				"user" => $user,
			];
			$masterData = [
				'mainContent' => view("MyProfileEditView", $data),
				'navTemplate' => "nav-admin.php",
				'title' => "Favours 4 Neighbours: My Profile",
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
	public function index()
	{
		if ($this->isLoggedIn()) {
			$userId = $this->session->get("UserId");
			$user = $this->userRepository->find($userId);

			$data = [
				"user" => $user,
			];
			$masterData = [
				'mainContent' => view("MyProfileView", $data),
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
	
	private function executeSave(&$data, $userId)
	{
		$jobValuesArray = $this->createJobValuesArrayFromPostArray();
		try {
			$commandResult = $this->userRepository->update($userId, $jobValuesArray);
			$data["message"] = "Profile Saved";
		} catch (Exception $e) {
			$data['errors'] = $this->userRepository->errors();
		}
		return $this->userRepository->find($userId);
	}
	
	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null);
	}

	
}
