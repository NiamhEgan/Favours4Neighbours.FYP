<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Libraries\ClientViewManager;
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
		//TODO: accpetedJobApplications, rejectedJobApplications
		$data = [
			'jobApplications' => $jobApplications,
			'accpetedJobApplications' => $jobApplications,
			'rejectedJobApplications' => $jobApplications,
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
		return ViewManager::loadViewIntoClientMasterPage('Recieved Applications', 'RecievedApplicationsView', $data);
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

	public function accept($jobApplicationId)
	{
		$this->executeAcceptJobApplication($jobApplicationId);
		echo "view";
	}

	public function create()
	{
		if ($this->isLoggedIn()) {
			return $this->getCreateView();
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}
	private function executeAcceptJobApplication($jobApplicationId)
	{
		$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
		$jobApplication["Status"] = JobApplicationStatus::Accepted;
		$commandResult = $this->jobApplicationRepository->update($jobApplicationId, $jobApplication);

		$job = $this->jobRepository->find($jobApplication["Job"]);
		$job["AssignedTo"] = $jobApplication['Applicant'];

		$commandResult = $this->jobRepository->update($job["Id"], $job);
	}
	

	public function reject($jobApplicationId)
	{
		if ($this->isLoggedIn()) {
			$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
			if ($jobApplication == null)
				return ViewManager::load404ErrorViewIntoClientMasterPage("No Job Application found for Job Application #:$jobApplicationId");
			else {
				//TODO: return $this->getAcceptView($jobApplicationId);
				$this->executeRejectJobApplication($jobApplicationId);
				return ViewManager::loadViewIntoClientMasterPage('', 'message', ['message' => 'Application has been rejected.']);
			}
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}


	public function executeRejectJobApplication($jobApplicationId)
	{
		$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
		$jobApplication["Status"] = JobApplicationStatus::Rejected;
		$commandResult = $this->jobApplicationRepository->update($jobApplicationId, $jobApplication);

		$job = $this->jobRepository->find($jobApplication["Job"]);
		$job["AssignedTo"] = $jobApplication['Applicant'];

		$commandResult = $this->jobRepository->update($job["Id"], $job);
	}

	public function withdraw($jobApplicationId)
	{
		if ($this->isLoggedIn()) {
			$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
			if ($jobApplication == null)
				return ViewManager::load404ErrorViewIntoClientMasterPage("No Job Application found for Job Application #:$jobApplicationId");
			else {
				//TODO: return $this->getWithdrawnView($jobApplicationId);
				$this->executeRejectJobApplication($jobApplicationId);
				return ViewManager::loadViewIntoClientMasterPage('', 'message', ['message' => 'Application has been Withdrawn.']);
			}
		} else {
			return ViewManager::load403ErrorViewIntoClientMasterPage();
		}
	}


	public function executeWithdrawJobApplication($jobApplicationId)
	{
		$jobApplication = $this->jobApplicationRepository->find($jobApplicationId);
		$jobApplication["Status"] = JobApplicationStatus::Withdrawn;
		$commandResult = $this->jobApplicationRepository->update($jobApplicationId, $jobApplication);

		$job = $this->jobRepository->find($jobApplication["Job"]);
		$job["AssignedTo"] = $jobApplication['Applicant'];

		$commandResult = $this->jobRepository->update($job["Id"], $job);
	}


	public function apply($jobId)
	{
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
			echo ViewManager::loadViewIntoClientMasterPage('Application', 'Message', $data);
		}
	}

}
