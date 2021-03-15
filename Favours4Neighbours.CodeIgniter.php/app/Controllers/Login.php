<?php

namespace App\Controllers;

use App\Models\UserRepository;

class Login extends BaseController
{
	public function __construct()
	{
		$this->UserRepository = new UserRepository();
	}
	public function index()
	{
		if ($this->request->getPost("LoginButton") !== null) {
			$this->handleLogin();
		} else {
			$this->loadPage();
		}
	}
	private function handleLogin()
	{
		$password = $this->request->getPost("Password");
		$hashedPassword = $this->UserRepository->createPasswordHash($password);

		$username = $this->request->getPost("Username");

		$user = $this->UserRepository->where('Username', $username)
			->where('Password',  $hashedPassword)
			->first();

		if ($user != null) {
			if ($user["Active"] == 1) {
				//login
				$this->loginUser($user);
			} else {
				$this->loadPageWithError("User " . $username . " has been disabled. Please contact the system administrator.");
			}
		} else {
			$this->loadPageWithError("Not user found for your credientqqls");
		}
	}
	private function handleLogin1()
	{
		$password = $this->request->getPost("Password");
		$username = $this->request->getPost("Username");

		$user = $this->UserRepository->where('Username', $username)->first();

		if ($user == null) {
			$this->loadPageWithError("Invalid user credentials");
		} else if ($user["Active"] == 0) {
			$this->loadPageWithError("User " . $username . " has been disabled. Please contact the system administrator.");
		} else {
			$validPassword = password_verify($password, $user["Password"]);
			if ($validPassword == true)
			$this->loginUser($user);
			else {
				$this->loadPageWithError("Invalid user credentials");
			}
		}
	}
	private function loginUser($user)
	{
		// create session user
		$data = [
			'mainContent' => view("HomeView", ['username' => $user["Username"]]),
			'title' => "Favours 4 Neighbours",
		];
		echo view('MasterPage', $data);
	}
	private function loadPageWithError($errorMessage)
	{
		$data = [
			'errors' => $errorMessage,
			'mainContent' => view("LoginView"),
			'title' => "Favours 4 Neighbours",
		];
		echo view('MasterPage', $data);
	}
	private function loadPage()
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
