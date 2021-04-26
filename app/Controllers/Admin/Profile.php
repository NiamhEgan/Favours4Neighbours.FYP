<?php

namespace App\Controllers\Admin;

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

	public function index()
	{
		if ($this->isLoggedIn()) {
			$user = $this->UserRepository->find($this->session->get("UserId"));

			$data = [
				"user" => $user,
			];
			$masterData = [
				'mainContent' => view("AdminProfileView", $data),
				'navTemplate' => "nav-admin.php",
				'title' => "Admin Profile",
			];
			return view('MasterPageAdmin', $masterData);
		} else {
			$masterData = [
				'mainContent' => view("403"),
				'title' => "Unauthorised access",
			];
			return view('MasterPageAdmin', $masterData);
		}
	}
	public function edit()
	{
		if ($this->isLoggedIn()) {
			$user = $this->UserRepository->find($this->session->get("UserId"));

			$data = [
				"user" => $user,
			];
			$masterData = [
				'mainContent' => view("AdminProfileEditView", $data),
				'navTemplate' => "nav-admin.php",
				'title' => "My Profile",
			];
			return view('MasterPageAdmin', $masterData);
		} else {
			$masterData = [
				'mainContent' => view("403"),
				'title' => "Unauthorised access",
			];
			return view('MasterPageAdmin', $masterData);
		}
	}

	//
	//	Private functions
	//
	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null && $this->session->get("UserIsAdmin") == 1);
	}
}
