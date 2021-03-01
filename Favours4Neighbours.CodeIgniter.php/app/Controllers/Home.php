<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$homeViewData = ["username" => "Niamh"];
		$data = [
			'mainContent' => view("HomeView", $homeViewData),
			'title' => "Favours 4 Neighbours",
		];
		echo view('MasterPage', $data);
	}

	public function aboutus()
	{
		return view('welcome_message3');
	}

}
