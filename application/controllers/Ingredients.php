<?php
class Ingredients extends CI_Controller
{
	public function index()
	{
		$data['ingredients'] = $this->IngredientModel->get_ingredients();
		$data['title'] = 'Ingredients archive';

		$this->load->view('templates/header');
		$this->load->view('templates/topnav');
		$this->load->view('templates/sidebar');
		$this->load->view('templates/wrapper');
		$this->load->view('ingredients/index', $data); //loading page and data
		$this->load->view('templates/footer');

	}

	public function create()
	{

		$data['title'] = 'Create a new ingredient';

		$this->form_validation->set_rules('ingredient_name', 'Nombre del Ingrediente', 'required');

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
			$this->load->view('ingredients/create', $data); //loading page and data
			$this->load->view('templates/footer');
		}
		else
		{
			$this->IngredientModel->store_ingredient();
			$this->session->set_flashdata('created', 'Se ha guardado el ingrediente.');
			redirect(base_url() . 'ingredients/create');
		}
	}


	public function edit($id = NULL)
	{
		$data['title'] = 'Edit a size';

		$this->form_validation->set_rules('size_name', 'Title', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$data['size'] = $this->SizeModel->get_size($id);
			$this->load->view('templates/header', $data);
			$this->load->view('sizes/edit', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->SizeModel->set_size($id);
			$this->load->view('templates/header', $data);
			$this->load->view('sizes/success');
			$this->load->view('templates/footer');
		}
	}

}
