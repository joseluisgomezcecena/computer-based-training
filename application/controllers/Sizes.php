<?php
class Sizes extends CI_Controller
{
	public function index()
	{
		$data['sizes'] = $this->SizeModel->get_sizes();
		$data['title'] = 'Sizes archive';

		$this->load->view('templates/header');
		$this->load->view('templates/topnav');
		$this->load->view('templates/sidebar');
		$this->load->view('templates/wrapper');
		$this->load->view('sizes/index', $data); //loading page and data
		$this->load->view('templates/footer');

	}

	public function create()
	{

		$data['title'] = 'Create a new size';

		$this->form_validation->set_rules('size_name', 'Title', 'required');

		$this->form_validation->set_error_delimiters(
			'<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong class="uppercase"><bdi>Error</bdi></strong> &nbsp;',
			'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
		);


		if ($this->form_validation->run() === FALSE)
		{

			$this->load->view('templates/header');
			$this->load->view('templates/topnav');
			$this->load->view('templates/sidebar');
			$this->load->view('templates/wrapper');
			$this->load->view('sizes/create', $data); //loading page and data
			$this->load->view('templates/footer');

		}
		else
		{
			$this->SizeModel->store_size();
			$this->session->set_flashdata('created', 'Se ha guardado el tamaño.');
			redirect(base_url() . 'sizes/create');
		}
	}


	public function edit($id = NULL)
	{

		$data['title'] = 'Edit a size';
		$data['size'] = $this->SizeModel->get_size($id);


		$this->form_validation->set_rules('size_name', 'Title', 'required');

		$this->form_validation->set_error_delimiters(
			'<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong class="uppercase"><bdi>Error</bdi></strong> &nbsp;',
			'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
		);


		if ($this->form_validation->run() === FALSE)
		{

			$this->load->view('templates/header');
			$this->load->view('templates/topnav');
			$this->load->view('templates/sidebar');
			$this->load->view('templates/wrapper');
			$this->load->view('sizes/edit', $data); //loading page and data
			$this->load->view('templates/footer');

		}
		else
		{
			$this->SizeModel->store_size($id);
			$this->session->set_flashdata('updated', 'Se ha guardado el tamaño.');
			redirect(base_url() . 'sizes/edit/' . $id);
		}
	}






	public function delete($id = NULL)
	{

		$data['title'] = 'Delete a size';
		$data['size'] = $this->SizeModel->get_size($id);


		$this->form_validation->set_rules('size_name', 'Title', 'required');

		$this->form_validation->set_error_delimiters(
			'<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong class="uppercase"><bdi>Error</bdi></strong> &nbsp;',
			'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
		);


		if ($this->form_validation->run() === FALSE)
		{

			$this->load->view('templates/header');
			$this->load->view('templates/topnav');
			$this->load->view('templates/sidebar');
			$this->load->view('templates/wrapper');
			$this->load->view('sizes/delete', $data); //loading page and data
			$this->load->view('templates/footer');

		}
		else
		{
			$this->SizeModel->delete_size($id);
			$this->session->set_flashdata('deleted', 'Se ha eliminado el tamaño.');
			redirect(base_url() . 'sizes');
		}
	}


}
