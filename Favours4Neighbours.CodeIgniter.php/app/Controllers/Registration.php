<?php

namespace App\Controllers;

use App\Models\UserRepository;
use phpDocumentor\Reflection\Types\This;

class Registration extends BaseController
{
	public function __construct()
	{
		$this->UserRepository = new UserRepository();
	}
	public function index()
	{
		if ($this->request->getPost("RegisterButton") !== null) {
			$userValuesArray = $this->createUserValuesArrayFromPostArray();
			try {
				$commandResult = $this->UserRepository->insert($userValuesArray);
				redirect("Login/index");
			} catch (Exception $e) {
				$data = [
					'mainContent' => view("RegistrationView"),
					'title' => "Favours 4 Neighbours: Registration",
					'errors' => $this->UserRepository->errors(),
				];
				return view('MasterPage', $data);
			}
		} else
			$data = [
				'mainContent' => view("RegistrationView"),
				'title' => "Favours 4 Neighbours: Registration",
			];
		return view('MasterPage', $data);
	}

	private function createUserValuesArrayFromPostArray()
	{
		return [
			"AddressLine1" => $this->request->getPost("AddressLine1"),
			"AddressLine2" => $this->request->getPost("AddressLine2"),
			"Eircode" => $this->request->getPost("Eircode"),
			"email" => $this->request->getPost("email"),
			"FirstName" => $this->request->getPost("FirstName"),
			"Gender" => $this->request->getPost("Gender"),
			"Password" => $this->request->getPost("Password"),
			"Surname" => $this->request->getPost("Surname"),
			"Telephone" => $this->request->getPost("Telephone"),
			"Username" => $this->request->getPost("Username"),
		];
	}
}
