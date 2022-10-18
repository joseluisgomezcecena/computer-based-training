<?php

class  SizeModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_sizes()
	{
		$query = $this->db->get('sizes');
		return $query->result_array();
	}

	public function get_size($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('sizes');
			return $query->result_array();
		}

		$query = $this->db->get_where('sizes', array('size_id' => $id));
		return $query->row_array();
	}



	public function store_size($id = NULL)
	{
		if(!empty($this->input->post('notes')))
		{
			$notes = $this->input->post('notes');
		}
		else
		{
			$notes = "N/A";
		}

		$data = array(
			'size_name' => $this->input->post('size_name'),
			'notes' => $notes
		);

		if($id == NULL)
		{
			return $this->db->insert('sizes', $data);
		}
		else
		{
			return $this->db->update('sizes', $data, array('size_id' => $id));
		}

	}



	public function delete_size($id)
	{
		$this->db->where('size_id', $id);
		return $this->db->delete('sizes');
	}
}
