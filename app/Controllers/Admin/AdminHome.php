<?php

namespace App\Controllers;

use App\Libraries\AdminViewManager;

class Home extends BaseController
{
	public function sampleMVC()
	{
		$modelData = ['message' => "Hello", 'time' => 'April 28, 2021'];
		$viewName = 'sampleMVC';
		echo view($viewName, $modelData);
	}
	public function index()
	{
		return AdminViewManager::loadView('Home', 'AdminHomeView');
	}
	public function faq()
	{
		return AdminViewManager::loadView('FAQ', 'HomeView');
	}
}
