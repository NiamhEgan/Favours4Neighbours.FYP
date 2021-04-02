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
		helper(["form"]);
		if ($this->request->getVar("RegisterButton") !== null) {
			$userValuesArray = $this->createUserValuesArrayFromPostArray();
			try {
				$commandResult = $this->UserRepository->insert($userValuesArray);
				return redirect()->to("/login");
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
			"AddressLine1" => $this->request->getVar("AddressLine1"),
			"AddressLine2" => $this->request->getVar("AddressLine2"),
			"Eircode" => $this->request->getVar("Eircode"),
			"email" => $this->request->getVar("email"),
			"FirstName" => $this->request->getVar("FirstName"),
			"Gender" => $this->request->getVar("Gender"),
			"Password" => $this->request->getVar("Password"),
			"Surname" => $this->request->getVar("Surname"),
			"Telephone" => $this->request->getVar("Telephone"),
			"Username" => $this->request->getVar("Username"),
		];
	}
}
