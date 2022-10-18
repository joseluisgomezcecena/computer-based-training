<?php

class IngredientModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	public function get_ingredients()
	{
		$query = $this->db->get('ingredients');
		return $query->result_array();
	}



	public function get_ingredient($id)
	{
		$query = $this->db->get_where('ingredients', array('ingredient_id' => $id));
		return $query->row();
	}



	public function store_ingredient()
	{
		$data  =  array(
			'ingredient_name' => $this->input->post('ingredient_name'),
		);
		$this->db->insert('ingredients', $data);
	}




	public function update_ingredient($id)
	{
		$data  =  array(
			'ingredient_name' => $this->input->post('ingredient_name'),
		);
		$this->db->update('ingredients', $data, array('ingredient_id' => $id));
	}



	public function delete_ingredient($id)
	{
		$this->db->delete('ingredients', array('ingredient_id' => $id));
	}

}
