<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminViewManager;
use App\Models\CountyRepository;
use App\Models\JobApplicationRepository;
use App\Models\JobCategoryRepository;
use App\Models\JobRepository;
use App\Models\JobStatus;
use App\Models\UserRepository;
use Exception;

class Jobs extends BaseController
{
	protected $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->session->start();

		$this->countyRepository = new CountyRepository();
		$this->jobApplicationRepository = new JobApplicationRepository();
		$this->jobCategoryRepository = new JobCategoryRepository();
		$this->jobRepository = new JobRepository();
		$this->userRepository = new UserRepository();

		$this->db = \Config\Database::connect();

		helper('ArrayTransformer');
	}

	public function index()
	{
		if ($this->isLoggedIn()) {
			$userId = $this->session->get("UserId");
			$jobs = $this->db->query("Call GetAvailableJobsView(?)", $userId)->getResult();
			$data = [
				"jobs" => $jobs,
			];
			echo AdminViewManager::loadView('Current Active Jobs', 'AdminAvailableJobsView', $data);
		} else {
			echo  AdminViewManager::load403Error();
		}
	}
	
	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null);
	}

	public function completedjobs()
	{
		if ($this->isLoggedIn()) {

			$jobs = $this->db->query('Call GetAllCompletedJobs()')->getResult();
			$data = ['jobs' => $jobs];

			return AdminViewManager::loadView('Completed Jobs', 'CompletedJobsView', $data);
		} else {
			return AdminViewManager::load403Error();
		}
	}

	public function close($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);

			if ($job == null) {
				echo AdminViewManager::load40Error("No Job found for $jobId");
			} else if ($job["CreatedBy"] != $this->session->get("UserId")) {
				echo AdminViewManager::load403Error();
			} else {
				return $this->executeCloseJob($jobId);
			}
		} else {
			echo  AdminViewManager::load403Error();
		}
	}

	private function executeCloseJob($jobId)
	{
		$jobValuesArray = [
			'JobStatus' => JobStatus::Closed,
		];
		$this->jobRepository->update($jobId, $jobValuesArray);
		$data = ['message' => "Job: $jobId has been closed"];
		echo AdminViewManager::loadView('Application', 'Message', $data);
	}

	private function executeDelete($jobId)
	{
		$createJobValuesArray = $this->createJobValuesArrayFromPostArray();
		try {
			$commandResult = $this->jobRepository->save($createJobValuesArray, $jobId);
			return redirect()->to("/client/jobs");
		} catch (Exception $e) {
			$data = [
				'errors' => $this->jobRepository->errors(),
			];
			echo AdminViewManager::loadView('My Jobs', 'AvailableJobsView', $data);
		}
	}
	public function delete($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);
			if ($job == null) {
				echo AdminViewManager::load404Error("No Job found for $jobId");
			} else if ($job["userID"] != $this->session->get("UserId")) {
				echo AdminViewManager::load403Error();
			} else {
				$this->executeDelete($jobId);
			}
		} else {
			echo  AdminViewManager::load403Error();
		}
	}
	public function view($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);

			if ($job == null) {
				echo AdminViewManager::load404Error("No Job found for $jobId");
			} else if ($job["CreatedBy"] != $this->session->get("UserId")) {
				echo AdminViewManager::load403Error();
			} else {
				//TODO: View
				return $this->getView($jobId, $job);
			}
		} else {
			echo  AdminViewManager::load403Error();
		}
	}


	private function createJobValuesArrayFromPostArray()
	{
		return [
			//"CreatedBy" =>  $this->session->get("UserId"),
			"AssignedTo" => $this->request->getPost("AssignedTo"),
			"DurationEstimate" => $this->request->getPost("DurationEstimate"),
			"EquipmentRequired" => $this->request->getPost("EquipmentRequired"),
			"JobCategory" => $this->request->getPost("JobCategory"),
			"JobCounty" => $this->request->getPost("JobCounty"),
			"JobDetails" => $this->request->getPost("JobDetails"),
			"JobPrice" => $this->request->getPost("JobPrice"),
			"JobStatus" => $this->request->getPost("JobStatus"),
		];
	}
	private function createJobValuesArrayForNewJobFromPostArray()
	{
		return [
			"CreatedBy" => $this->session->get("UserId"),
			"DurationEstimate" => $this->request->getPost("DurationEstimate"),
			"EquipmentRequired" => $this->request->getPost("EquipmentRequired"),
			"JobCategory" => $this->request->getPost("JobCategory"),
			"JobCounty" => $this->request->getPost("JobCounty"),
			"JobDetails" => $this->request->getPost("JobDetails"),
			"JobPrice" => $this->request->getPost("JobPrice"),
			"JobStatus" => $this->request->getPost("JobStatus"),
		];
	}
}
