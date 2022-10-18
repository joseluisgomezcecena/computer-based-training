<?php

class Orders extends CI_Controller
{

	public function create()
	{
		$data['title'] = 'Create Order';
		$data['items'] = $this->ItemModel->get_items_data();

		$this->load->view('templates/header');
		$this->load->view('templates/topnav');
		$this->load->view('templates/sidebar');
		$this->load->view('templates/wrapper');
		$this->load->view('orders/create', $data);
		$this->load->view('templates/footer');
	}



	public function get_item_data()
	{
		// POST data
		$postData = $this->input->post();

		// load model
		$this->load->model('ItemModel');

		// get data
		$data = $this->ItemModel->get_details($postData);
		echo json_encode($data);
	}



	public function get_item()
	{
		// POST data
		$postData = $this->input->post();

		// load model
		$this->load->model('ItemModel');

		// get data
		$data = $this->ItemModel->get_item($postData);
		echo json_encode($data);
	}




}
