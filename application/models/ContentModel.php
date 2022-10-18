<?php

class ContentModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}


	public function create($target_file, $screenshot)
	{

		$data = array(
			'course_id' => $this->input->post('course_id'),
			'title' => $this->input->post('title'),
			'url' => $target_file,
			'thumbnail' => $screenshot,
			'description' => $this->input->post('description'),
		);


		$query =  $this->db->insert('content', $data);

		$last_query = $this->db->last_query();
		print_r($last_query);
		return $query;
	}


	public function get_content($id = NULL)
	{
		if ($id === NULL)
		{
			$query = $this->db->get('content');
			$last_query = $this->db->last_query();
			print_r($last_query);
			return $query->result_array();
		}else{
			$this->db->order_by('order', 'ASC');
			$query = $this->db->get_where('content', array('course_id' => $id));
			return $query->result_array();
		}
	}



	/*
     * Update file data into the database
     * @param array the data for inserting into the table
     * @param int the row id
     */
	public function update($id,$data = array()){
		if(!array_key_exists('updated_at', $data)){
			$data['updated_at'] = date("Y-m-d H:i:s");
		}
		$update = $this->db->update('content', $data, array('content_id' => $id));
		return $update?true:false;
	}


}
