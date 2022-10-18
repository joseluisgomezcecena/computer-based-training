<?php

class Pages extends CI_Controller
{
	public function view($page = 'home')
	{
		if(!file_exists(APPPATH . 'views/pages/' . $page . '.php'))
		{
			show_404();
		}

		$data['title'] = ucfirst($page);

		//load header, page & footer
		$this->load->view('templates/header');
		//$this->load->view('templates/topnav');
		//$this->load->view('templates/sidebar');
		//$this->load->view('templates/wrapper');
		$this->load->view('pages/' . $page, $data); //loading page and data
		$this->load->view('templates/footer');
	}

}
