<?php

namespace App\Controllers;

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
				'title' => "Favours 4 Neighbours: Admin Profile",
			];
			return view('MasterPageAdmin', $masterData);
		} else {
			$masterData = [
				'mainContent' => view("403"),
				'title' => "Favours 4 Neighbours: Unauthorised access",
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
				'title' => "Favours 4 Neighbours: My Profile",
			];
			return view('MasterPageAdmin', $masterData);
		} else {
			$masterData = [
				'mainContent' => view("403"),
				'title' => "Favours 4 Neighbours: Unauthorised access",
			];
			return view('MasterPageAdmin', $masterData);
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
