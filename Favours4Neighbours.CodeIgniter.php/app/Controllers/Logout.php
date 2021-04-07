<?php

namespace App\Controllers;

use App\Models\UserRepository;

class Logout extends BaseController
{
	protected $session;



	public function logout()
	{
		$this->session->destroy();

		return redirect()->to('/login');
	}
	public function index()
	{
		echo view('templates/header');
		echo view('LogoutView');

	}




	

	


}
