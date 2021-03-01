<?php

namespace App\Controllers;

use App\Models\UserRepository;


class Login extends BaseController
{
	public function __construct() {
		$this->UserRepository = new UserRepository();
	}
	public function index()
	{
		$data = [
			'mainContent' => view("LoginView"),
			'title' => "Favours 4 Neighbours",
		];
		echo view('MasterPage', $data);
	}
	public function demo()
	{
		$demoUserId = 100; //	Admin
		$user  = $this->UserRepository->find($demoUserId);

		var_dump($user);
		if ($user != null) {
			//$this->websitemanager->createUserSession($user->Id, $user->Username);
			//redirect("/home");
			$data = [
				'mainContent' => "Login Success",
				'title' => "Favours 4 Neighbours",
			];
			echo view('MasterPage', $data);

		} else {
			$loginData = [
				"error" => "Incorrect login details entered",
				"username" => "Admin Demo"
			];
			$data = [
				'mainContent' => view("LoginView", $loginData),
				'title' => "Favours 4 Neighbours",
			];
			echo view('MasterPage', $data);
		}
	}
}
