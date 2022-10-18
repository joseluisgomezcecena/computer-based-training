<?php

class Admins extends  CI_Controller
{
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/topnav');
		$this->load->view('templates/sidebar');
		$this->load->view('templates/wrapper');
		$this->load->view('admins/index');
		$this->load->view('templates/footer');
	}
}
