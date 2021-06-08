<?php

class Dashboard extends Controller
{

	function __construct()
	{
		$this->helper = new Helper;
	}

	public function index()
	{
		$data =
			[
				'title' => 'System Permintaan Alat',
				'dashboard' => 'active',

			];
		$this->view('templates/header', $data);
		$this->view('dashboard/index', $data);
		$this->view('templates/footer', $data);
	}
}
