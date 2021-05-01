<?php

namespace App\Controllers;

use App\Libraries\PublicViewManager;
use App\Libraries\ViewManager;
use App\Models\JobRepository;

class Jobs extends BaseController
{
	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->JobRepository = new JobRepository();
	}

	public function index()
	{
		if ($this->isLoggedIn()) {
			return redirect()->to("/client/jobs");
		} else {
			$jobs = $this->JobRepository->findAll();

			$data = ['jobs' => $jobs,];

			return PublicViewManager::loadView('Available Jobs', 'JobsView', $data);
		}
	}
	private function isLoggedIn()
	{
		return ($this->session->get("UserId") !== null);
	}
}
