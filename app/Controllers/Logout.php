<?php

namespace App\Controllers;

use App\Libraries\PublicViewManager;

class Logout extends BaseController
{
	public function __construct()
	{
		$this->session = \Config\Services::session();
	}
	public function index()
	{
		$this->session->destroy();
		return PublicViewManager::loadView('Logout', 'LogoutView');
	}
}
