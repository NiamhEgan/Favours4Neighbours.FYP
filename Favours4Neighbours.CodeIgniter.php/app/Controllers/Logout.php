<?php

namespace App\Controllers;

use App\Models\UserRepository;

class Logout extends BaseController
{
	protected $session;

	public function __construct()
	{
		$this->UserRepository = new UserRepository();
		$this->session = \Config\Services::session();
		$this->session->start();
	}

	public function loadPage()
	{
		$data = [
			'mainContent' => view("LogoutView"),
			'title' => "Favours 4 Neighbours",
		];
		echo view('MasterPage', $data);
	}

	public function logout()
	{
		$this->session->destroy();
	}
	

	


}
