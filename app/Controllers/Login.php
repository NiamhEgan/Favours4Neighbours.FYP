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
			return $this->handleLogin();
		} else {
			return $this->loadPage();
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
				return $this->loginUser($user);
			} else {
				return $this->loadPageWithError("User $username has been disabled. Please contact the system administrator.");
			}
		} else {
			return $this->loadPageWithError("Not user found for your credientials");
		}
	}
	public function logout()
	{
		$this->session->destroy();
	}
	private function loginUser($user)
	{
		$this->session->set("UserIsAdmin", $user['IsAdmin']);
		$this->session->set("UserId", $user["Id"]);
		$this->session->set("Username", $user["Username"]);

		return redirect()->to("/client/profile");
	}
	private function loadPageWithError($errorMessage)
	{
		$data = [
			'errors' => $errorMessage,
		];
		return PublicViewManager::loadView('Login', 'LoginView', $data);
	}
	private function loadPage()
	{
		return PublicViewManager::loadView('Login', 'LoginView');
	}
}
