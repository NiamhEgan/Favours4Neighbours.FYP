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
	public function faq1()
	{
		$homeViewData = ["username" => ""];
		$data = [
			'mainContent' => view("HomeView", $homeViewData),
			'title' => "Favours 4 Neighbours",
			'navTemplate' => "nav-admin.php",
		];
		echo view('MasterPage', $data);
	}
	public function login1()
	{
		$homeViewData = ["username" => ""];
		$data = [
			'mainContent' => view("HomeView", $homeViewData),
			'title' => "Favours 4 Neighbours",
		];
		echo view('MasterPage', $data);
	}
	public function signup1()
	{
		$homeViewData = ["username" => ""];
		$data = [
			'mainContent' => view("HomeView", $homeViewData),
			'title' => "Favours 4 Neighbours",
		];
		echo view('MasterPage', $data);
	}
}
