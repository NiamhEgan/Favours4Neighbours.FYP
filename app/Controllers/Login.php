<?php

namespace App\Controllers;

use App\Libraries\ViewManager;
use App\Models\UserRepository;

class Login extends BaseController
{
	public function __construct()
	{
		$this->UserRepository = new UserRepository();
		$this->session = \Config\Services::session();
		$this->session->start();
	}

	public function index()
	{
		if ($this->request->getVar("LoginButton") !== null) {
			$this->handleLogin();
		} else {
			$this->loadPage();
		}
	}
	private function handleLogin()
	{
		$password = $this->request->getVar("Password");
		$hashedPassword = $this->UserRepository->createPasswordHash($password);

		$username = $this->request->getVar("Username");

		$user = $this->UserRepository->where('Username', $username)
			->where('Password',  $hashedPassword)
			->first();

		if ($user != null) {
			if ($user["Active"] == 1) {
				//login
				$this->loginUser($user);
			} else {
				$this->loadPageWithError("User $username has been disabled. Please contact the system administrator.");
			}
		} else {
			$this->loadPageWithError("Not user found for your credientials");
		}
	}
	public function logout()
	{
		$this->session->destroy();
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
		$this->session->set("UserId", $user["Id"]);
		$this->session->set("Username", $user["Username"]);

		redirect()->to("/client/profile");

		$data = ['username' => $user["Username"]];
		echo ViewManager::loadViewIntoClientMasterPage('Favours 4 Neighbours', 'HomeView', $data);
	}
	private function loadPageWithError($errorMessage)
	{
		$data = [
			'errors' => $errorMessage,
		];
		echo ViewManager::loadViewIntoMasterPage('Favours 4 Neighbours', 'LoginView', $data);
	}
	private function loadPage()
	{
		echo ViewManager::loadViewIntoMasterPage('Favours 4 Neighbours', 'LoginView');
	}
}
