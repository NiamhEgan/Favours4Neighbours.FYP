<?php

namespace App\Controllers;

use App\Libraries\PublicViewManager;

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
		return PublicViewManager::loadView('Home', 'HomeView');
	}
	public function faq()
	{
		return PublicViewManager::loadView('FAQ', 'HomeView');
	}
}
