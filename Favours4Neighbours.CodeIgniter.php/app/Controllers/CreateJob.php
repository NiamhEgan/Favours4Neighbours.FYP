<?php

namespace App\Controllers;

use App\Models\JobRepository;
use phpDocumentor\Reflection\Types\This;

class CreateJob extends BaseController
{
	public function __construct()
	{
		$this->JobRepository = new JobRepository();
	}
	public function index()
	{
		if ($this->request->getPost("CreateButton") !== null) {
			$createJobValuesArray = $this->createJobValuesArrayFromPostArray();
			try {
				$commandResult = $this->JobRepository->insert($createJobValuesArray);
				redirect("Login/index");
			} catch (Exception $e) {
				$data = [
					'mainContent' => view("CreateJobView"),
					'title' => "Favours 4 Neighbours: Create Job",
					'errors' => $this->JobRepository->errors(),
				];
				return view('MasterPage', $data);
			}
		} else
			$data = [
				'mainContent' => view("CreateJobView"),
				'title' => "Favours 4 Neighbours: Create Job",
			];
		return view('MasterPage', $data);
	}

	private function createJobValuesArrayFromPostArray()
	{
		return [
			
		
			"CreatedBy" => $this->request->getPost("CreatedBy"),
			"jobDetails" => $this->request->getPost("jobDetails"),
			"JobStatus" => $this->request->getPost("JobStatus"),
			"EquipmentRequired" => $this->request->getPost("EquipmentRequired"),
			"DurationEstimate" => $this->request->getPost("DurationEstimate"),
			"JobPrice" => $this->request->getPost("JobPrice"),
			"DateCreated" => $this->request->getPost("DateCreated"),
		
			
		];
	}

	
}
