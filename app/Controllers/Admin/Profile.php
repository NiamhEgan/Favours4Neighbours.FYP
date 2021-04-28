<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserRepository;
use App\Libraries\AdminViewManager;

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
			$userId = $this->session->get('UserId');
			$user = $this->userRepository->find($userId);
			$data = ['profile' => $user,];
			return AdminViewManager::loadView('Profile', 'AdminProfileView', $data);
		} else {
			echo  AdminViewManager::load403Error();
		}
	}
	public function edit()
	{
		if ($this->isLoggedIn()) {
			$userId = $this->session->get('UserId');
			$user = $this->userRepository->find($userId);

			$data = [
				'profile' => $user,
			];

			return AdminViewManager::loadView('Edit Profile', 'AdminProfileEditView', $data);
		} else {
			echo  AdminViewManager::load403Error();
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
