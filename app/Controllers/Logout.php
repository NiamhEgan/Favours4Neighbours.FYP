<?php

namespace App\Controllers;

use App\Models\UserRepository;

class Logout extends BaseController
{
	protected $session;



	public function logout()
	{
		$this->session->destroy();

	
		
	}
	public function index()
	{
		
		echo view('LogoutView');

	}




	

	


}
