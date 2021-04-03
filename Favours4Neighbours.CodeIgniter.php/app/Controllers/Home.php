<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$homeViewData = ["username" => ""];
		$data = [
			'mainContent' => view("HomeView", $homeViewData),
			'title' => "Favours 4 Neighbours",
		];
		echo view('MasterPage', $data);
		

	}

	

}
