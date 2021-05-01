<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Libraries\ClientViewManager;
use App\Models\CountyRepository;
use App\Models\JobApplicationRepository;
use App\Models\JobApplicationStatus;
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
			return ClientViewManager::load403Error();
		}
	}
	//
	//	Private Functions
	//
	private function getMyApplicationsView($userId)
	{
		$jobApplicationsAccepted = $this->db->query("Call GetJobApplicationsAcceptedViewByApplicant(?)", $userId)->getResult();
		$jobApplicationsPending = $this->db->query("Call GetJobApplicationsPendingViewByApplicant(?)", $userId)->getResult();
		$jobApplicationsRejected = $this->db->query("Call GetJobApplicationsRejectedViewByApplicant(?)", $userId)->getResult();
		$jobApplicationsWithdrawn = $this->db->query("Call GetJobApplicationsWithdrawnViewByApplicant(?)", $userId)->getResult();

		$data = [
			'jobApplicationsAccepted' => $jobApplicationsAccepted,
			'jobApplicationsPending' => $jobApplicationsPending,
			'jobApplicationsRejected' => $jobApplicationsRejected,
			'jobApplicationsWithdrawn' => $jobApplicationsWithdrawn,
		];
		return ClientViewManager::loadView('My Applications', 'MyApplicationsView', $data);
	}

	public function recievedapplications()
	{
		if ($this->isLoggedIn()) {
			$userId = $this->session->get("UserId");
			return $this->getRecievedApplicationsView($userId);
		} else {
			return ClientViewManager::load403Error();
		}
	}


	private function getRecievedApplicationsView($userId)
	{
		$jobApplications = $this->db->query("Call GetJobApplicationsRecievedView(?)", $userId)
			->getResult();
		$data = [
			'recievedApplications' => $jobApplications,
		];
		return ClientViewManager::loadView('Recieved Applications', 'RecievedApplicationsView', $data);
	}

	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null);
	}

	public function rejectapplications()
	{
	}

	//ToDo not working 
	public function complete($jobId)
	{
		if ($this->isLoggedIn()) {
			$job = $this->jobRepository->find($jobId);

			if ($job == null) {
				echo ClientViewManager::load404Error("No Job found for $jobId");
			} else if ($job["CreatedBy"] != $this->session->get("UserId")) {
				echo ClientViewManager::load403Error();
			} else {
				return $this->executeCloseJob($jobId);
			}
		} else {
			echo  ClientViewManager::load403Error();
		}
	}

	private function executeCloseJob($jobId)
	{

		$jobValuesArray = [
			'JobStatus' => JobStatus::Closed,
		];
		$this->jobRepository->update($jobId, $jobValuesArray);
		$data = ['message' => "Job: $jobId has been Completed"];
		echo ClientViewManager::loadView('Application', 'Message', $data);
	}

	public function accept($jobApplicationId)
	{
		if ($this->isLoggedIn()) {
			$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
			if ($jobApplication == null)
				return ClientViewManager::load404Error("No Job Application found for Job Application #:$jobApplicationId");
			else {
				$this->executeAcceptJobApplication($jobApplication ,$jobApplicationId);
				return ClientViewManager::loadView('', 'Message', ['message' => 'Application has been accepted.']);
			}
		} else {
			return ClientViewManager::load403Error();
		}
	}

	private function executeAcceptJobApplication($jobApplication, $jobApplicationId)
	{
		$jobApplication['Status'] = JobApplicationStatus::Accepted;
		$commandResult = $this->jobApplicationRepository->update($jobApplicationId, $jobApplication);

		$job = $this->jobRepository->find($jobApplication['Job']);
		$job['AssignedTo'] = $jobApplication['Applicant'];

		$commandResult = $this->jobRepository->update($job['Id'], $job);
	}


	public function reject($jobApplicationId)
	{
		if ($this->isLoggedIn()) {
			$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
			if ($jobApplication == null)
				return ClientViewManager::load404Error("No Job Application found for Job Application #:$jobApplicationId");
			else {
				$this->executeRejectJobApplication($jobApplication ,$jobApplicationId);
				return ClientViewManager::loadView('', 'Message', ['message' => 'Application has been rejected.']);
			}
		} else {
			return ClientViewManager::load403Error();
		}
	}


	private function executeRejectJobApplication($jobApplication ,$jobApplicationId)
	{
		$jobApplication['Status'] = JobApplicationStatus::Rejected;
		$commandResult = $this->jobApplicationRepository->update($jobApplicationId, $jobApplication);
	}

	public function withdraw($jobApplicationId)
	{
		if ($this->isLoggedIn()) {
			$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
			if ($jobApplication == null)
				return ClientViewManager::load404Error("No Job Application found for Job Application #:$jobApplicationId");
			else {
				$this->executeWithdrawJobApplication($jobApplication, $jobApplicationId);
				return ClientViewManager::loadView('', 'message', ['message' => 'Application has been Withdrawn.']);
			}
		} else {
			return ClientViewManager::load403Error();
		}
	}


	private function executeWithdrawJobApplication($jobApplication ,$jobApplicationId)
	{
		$jobApplication['Status'] = JobApplicationStatus::Withdrawn;
		$commandResult = $this->jobApplicationRepository->update($jobApplicationId, $jobApplication);
	}

	public function apply($jobId)
	{
		//TODO SEcure Method
		$userId = $this->session->get("UserId");
		$jobApplication = $this->jobApplicationRepository
			->where('Job', $jobId)
			->where('Applicant', $userId)
			->find();

		if ($jobApplication == null) {
			$jobApplicationValuesArray = [
				'Job' => $jobId,
				'Applicant' =>  $userId,
			];
			$this->jobApplicationRepository->insert($jobApplicationValuesArray);
			return $this->index();
		} else {
			$data = ['message' => 'you have alreay applied'];
			echo ClientViewManager::loadView('Application', 'Message', $data);
		}
	}
}
