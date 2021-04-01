<?php

namespace App\Controllers;

//use App\Models\JobRepository;
use phpDocumentor\Reflection\Types\This;

class Jobs extends BaseController
{

	public function index()
	{
		echo '<h2> this is where the jobs will go </h2>';
	}

	public function createNew(){
		return view('JobsView');
	}

	public function saveJob(){
		echo '<pre>';
		print_r($_POST);
		echo '<pre>';

	}
	
}
