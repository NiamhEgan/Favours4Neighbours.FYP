<?php

namespace App\Controllers;

use App\Models\JobRepository; 
use App\Models\JobCategoryRepository;


class CreateJob extends BaseController
{
	public function __construct()
	{
		$this->JobRepository = new JobRepository();
		$this->JobRepository = new JobCategoryRepository();
	}
	private function transformCategoryArray($objectArray, $objectKeyName, $objectValueName)
	{
		$dataArray = [];
		foreach ($objectArray as $jobCategory) {
			$key = $jobCategory[$objectKeyName];
			$dataArray[$key] = $jobCategory[$objectValueName];
		}
		return $dataArray;
	}

	public function index()
	{
		helper('array');
		$mainData = [
			"jobcategoryDataSource" =>$this->transformCategoryArray($this->JobCategoryRepository->findAll(), "id", "jobcategory")
		
		];

		if ($this->request->getPost("CreateButton") !== null) {
		$createJobValuesArray = $this->createJobValuesArrayFromPostArray();
	
		try {
			$commandResult = $this->JobRepository->insert($createJobValuesArray);
				return redirect()->to("/login");

			} catch (Exception $e) {
				echo view('templates/header');
				$data = [
					'mainContent' => view("CreateJobView", $mainData),
					'title' => "Favours 4 Neighbours: Create Job",
					'navTemplate' => "nav-admin.php",
					'errors' => $this->JobRepository->errors(),
				];
				return view('MasterPage', $data);
			}
			} else
			$data = [
				'mainContent' => view("CreateJobView"),
				'title' => "Favours 4 Neighbours: Create Job",
				'navTemplate' => "nav-admin.php",
			];
		return view('MasterPage', $data);
	}

	private function createJobValuesArrayFromPostArray()
	{
		
		return [
			
		
			"CreatedBy" => $this->request->getPost("CreatedBy"),
			
			"JobDetails" => $this->request->getPost("JobDetails"),
			"JobStatus" => $this->request->getPost("JobStatus"),
			"EquipmentRequired" => $this->request->getPost("EquipmentRequired"),
			"DurationEstimate" => $this->request->getPost("DurationEstimate"),
			"JobPrice" => $this->request->getPost("JobPrice"),
			"DateCreated" => $this->request->getPost("DateCreated"),
		
		
			
		];
	}

	
}
