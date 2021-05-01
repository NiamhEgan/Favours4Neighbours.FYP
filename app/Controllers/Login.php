<?php

namespace App\Controllers;

use App\Libraries\PublicViewManager;
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
	private function loginUser($user)
	{
		$this->session->set("UserId", $user["Id"]);
		$this->session->set("Username", $user["Username"]);

		redirect()->to("/client/profile");

		$data = ['username' => $user["Username"]];
		echo PublicViewManager::loadView('Login', 'HomeView', $data);
	}
	private function loadPageWithError($errorMessage)
	{
		$data = [
			'errors' => $errorMessage,
		];
		echo PublicViewManager::loadView('Login', 'LoginView', $data);
	}
	private function loadPage()
	{
		echo PublicViewManager::loadView('Login', 'LoginView');
	}
}
