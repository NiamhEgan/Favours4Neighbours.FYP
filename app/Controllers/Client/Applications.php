<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Libraries\ViewManager;
use App\Models\CountyRepository;
use App\Models\JobApplicationRepository;
use App\Models\JobCategoryRepository;
use App\Models\JobRepository;
use App\Models\UserRepository;
use App\Models\JobStatus;

class Applications extends BaseController
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
		return $this->myapplications();
	}
	public function myapplications()
	{
		if ($this->isLoggedIn()) {
			$userId = $this->session->get("UserId");
			return $this->getMyApplicationsView($userId);
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}

	private function getMyApplicationsView($userId)
	{
		$jobApplications = $this->db->query("Call GetJobApplicationsViewByApplicant(?)", $userId)->getResult();
		$data = [
			'jobApplications' => $jobApplications,
		];
		return ViewManager::loadViewIntoClientMasterPage('My Applications', 'MyApplicationsView', $data);
	}

	public function recievedapplications()
	{
		if ($this->isLoggedIn()) {
			$userId = $this->session->get("UserId");
			return $this->getRecievedApplicationsView($userId);
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}


	private function getRecievedApplicationsView($userId)
	{
		$jobApplications = $this->db->query("Call GetJobApplicationsRecievedView(?)", $userId)
			->getResult();
		$data = [
			'recievedApplications' => $jobApplications,
		];
		return ViewManager::loadViewIntoClientMasterPage('Recieved Applications', 'RecievedApplicationsView', $data);
	}

	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null);
	}

	public function rejectapplications()
	{
	}


	public function complete($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);

			if ($job == null) {
				echo ViewManager::load404ErrorViewIntoClientMasterPage("No Job found for $jobId");
			} else if ($job["CreatedBy"] != $this->session->get("UserId")) {
				echo ViewManager::load403ErrorViewIntoClientMasterPage();
			} else {
				return $this->executeCloseJob($jobId);
			}
		} else {
			echo  ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}

	private function executeCloseJob($jobId)
	{

		$jobValuesArray = [
			'JobStatus' => JobStatus::Closed,
		];
		$this->jobRepository->update($jobId, $jobValuesArray);
		$data = ['message' => "Job: $jobId has been Completed"];
		echo ViewManager::loadViewIntoClientMasterPage('Application', 'Message', $data);
	}
}
