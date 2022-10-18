<?php

class AuthDBModel extends  CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_users()
	{
		$authdb = $this->load->database('authdb', TRUE);

		$authdb->select('*');
		$authdb->from('users');
		$query = $authdb->get();

		return $query->result_array();
	}


	public function get_departments()
	{
		$authdb = $this->load->database('authdb', TRUE);

		$authdb->select('*');
		$authdb->from('departments');
		$query = $authdb->get();
		return $query->result_array();
	}


}
