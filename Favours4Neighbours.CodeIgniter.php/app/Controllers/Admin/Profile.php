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
				'mainContent' => view("MyProfileView", $data),
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
	public function edit()
	{
		if ($this->isLoggedIn()) {
			$user = $this->UserRepository->find($this->session->get("UserId"));

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

	//
	//	Private functions
	//
	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null);
	}
}
