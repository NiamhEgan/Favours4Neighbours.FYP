<?php

namespace App\Controllers;

use App\Libraries\PublicViewManager;
use App\Models\UserRepository;
use App\Models\CountyRepository;
use Exception;

class Registration extends BaseController
{
	public function __construct()
	{
		$this->UserRepository = new UserRepository();
		$this->CountyRepository = new CountyRepository();
		helper('array');
		helper('ArrayTransformer');
	}
	public function index()
	{
		$data = ['countyDataSource' => transformObjectArray($this->CountyRepository->findAll(), "ID_county", "county")];
		if ($this->request->getVar("RegisterButton") !== null) {
			$userValuesArray = $this->createUserValuesArrayFromPostArray();
			try {
				$commandResult = $this->UserRepository->insert($userValuesArray);
				return redirect()->to("/login");
			} catch (Exception $e) {
				$data['errors'] = $this->UserRepository->errors();
				return PublicViewManager::loadView('Registration', 'RegistrationView', $data);
			}
		} else
			return PublicViewManager::loadView('Registration', 'RegistrationView', $data);
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
