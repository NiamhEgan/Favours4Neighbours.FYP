<?php

namespace App\Controllers;

use App\Libraries\ViewManager;
use App\Models\JobRepository;

class Jobs extends BaseController
{
	protected $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->session->start();

		$this->JobRepository = new JobRepository();
	}

	public function index()
	{
		echo view('templates/header');
		if ($this->isLoggedIn()) {
			return redirect()->to("/client/jobs");
		} else {
			$jobs = $this->JobRepository->findAll();

			$data = [
				"jobs" => $jobs,
			];

			return ViewManager::loadViewIntoClientMasterPage('Available Jobs', 'JobsView', $data);
		}
	}
	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null);
	}
}
