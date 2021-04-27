<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminViewManager;
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
	//
	//	Private functions
	//
	private function handleLogin()
	{
		$password = $this->request->getVar("Password");
		$hashedPassword = $this->UserRepository->createPasswordHash($password);
		$username = $this->request->getVar("Username");

		$adminuser = $this->UserRepository->where('Username', $username)

			->where('Password',  $hashedPassword)
			->first();

		if ($adminuser != null) {
			if ($adminuser["Active"] == 1 && $adminuser["IsAdmin"] == 1) {
				return $this->loginUser($adminuser);
			} else {
				return $this->loadPageWithError("User $username has been disabled. Please contact the system administrator.");
			}
		} else {
			return $this->loadPageWithError("Not user found for your credientials");
		}
	}
	private function loginUser($user)
	{
		$this->session->set("UserIsAdmin", $user['IsAdmin']);
		$this->session->set("UserId", $user["Id"]);
		$this->session->set("Username", $user["Username"]);

		return redirect()->to('/admin/profile');
	}
	private function loadPageWithError($errorMessage)
	{
		$data = ['errors' => $errorMessage];
		return $this->loadPage($data);
	}
	private function loadPage($data = [])
	{
		return AdminViewManager::loadView('Admin Login', 'LoginView');
	}
}
