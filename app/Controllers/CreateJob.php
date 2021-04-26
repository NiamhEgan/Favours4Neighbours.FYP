<?php

namespace App\Controllers;

use App\Libraries\ViewManager;
use App\Models\JobRepository;
use App\Models\JobCategoryRepository;
use Exception;

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
		$data = [
			'jobcategoryDataSource' => $this->transformCategoryArray($this->JobCategoryRepository->findAll(), "id", "jobcategory")

		];

		if ($this->request->getPost("CreateButton") !== null) {
			$createJobValuesArray = $this->createJobValuesArrayFromPostArray();

			try {
				$this->JobRepository->insert($createJobValuesArray);
				return redirect()->to("/login");
			} catch (Exception $e) {
				$data['errors'] = $this->JobRepository->errors();
			}
		}
		return ViewManager::loadViewIntoClientMasterPage('Create Job', 'JobCreateView', $data);
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
