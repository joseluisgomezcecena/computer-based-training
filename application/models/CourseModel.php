<?php

class CourseModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}


	public function get_courses($id = NULL)
	{
		if ($id === NULL)
		{
			$query = $this->db->get('courses');
			return $query->result_array();
		}else{
			$query = $this->db->get_where('courses', array('course_id' => $id));
			return $query->row_array();
		}

		//$last_query = $this->db->last_query();
		//print_r($last_query);

	}


	public function get_courses_pending($id = NULL)
	{

		$result = array();

		$this->db->select('*');
		$this->db->from('course_user');
		$this->db->join('courses', 'courses.course_id = course_user.course_id');
		$this->db->where('course_user.user_id=',  $id );
		$this->db->where('course_user.completed=',  0 );
		$this->db->order_by('course_user.course_user_id', 'DESC');
		$query = $this->db->get();


		$cursos = $query->result_array();

		foreach ($cursos as $curso)
		{
			$course_id = $curso['course_id'];
			$course_name = $curso['course_name'];
			$course_user_date = $curso['created_at'];

			$this->db->select('*');
			$this->db->from('content');
			$this->db->where('course_id=',  $course_id );
			$query_num = $this->db->get();
			$num_rows = $query_num->num_rows();
			if($num_rows > 0)
			{
				$this->db->select('*');
				$this->db->from('content');
				$this->db->where('course_id=',  $course_id );
				$this->db->order_by('content_id', 'ASC');
				$this->db->limit(1);
				$query_thumb = $this->db->get();
				$thumbnails = $query_thumb->row_array();
				$thumbnail = $thumbnails['thumbnail'];

				$result[] = array(
					'course_id' => $course_id,
					'course_name' => $course_name,
					'thumbnail' => $thumbnail,
					'number'=> $num_rows,
					'created_at' => $course_user_date
				);
			}
		}

		return $result;
	}

	public function get_pending_number($id = NULL)
	{

		$this->db->select('*');
		$this->db->from('course_user');
		$this->db->join('courses', 'courses.course_id = course_user.course_id');
		$this->db->where('course_user.user_id=',  $id );
		$this->db->where('course_user.completed=',  0 );
		$query = $this->db->get();
		return	$query->num_rows();

	}






	public function index_content()
	{
		$this->db->select('*');
		$this->db->from('courses');
		$this->db->join('content', 'courses.course_id = content.course_id');
		$query = $this->db->get();
		return $query->result_array();
	}



	public function index_course_content($id)
	{
		$this->db->select('*');
		$this->db->from('content');
		$this->db->where('course_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}




	public function store_courses()
	{
		$authdb = $this->load->database('authdb', TRUE);

		$data = array(
			'course_name' => $this->input->post('course_name'),
		);
		$this->db->insert('courses', $data);
		$course_id = $this->db->insert_id();


		$departments = $this->input->post('departments[]');

		foreach ($departments as $department) {
			$authdb->select('*');
			$authdb->from('users');
			$authdb->where('user_department_id', $department);
			$query = $authdb->get();
			$users = $query->result_array();

			foreach ($users as $user) {
				$data = array(
					'course_id' => $course_id,
					'user_id' => $user['user_id'],
				);
				$this->db->insert('course_user', $data);
			}
		}

		$users = $this->input->post('users[]');

		foreach ($users as $user) {
			$data = array(
				'course_id' => $course_id,
				'user_id' => $user,
			);
			$this->db->insert('course_user', $data);
		}

		return $course_id;
	}




	public function update($id)
	{
		$data = array(
			'course_name' => $this->input->post('course_name'),
		);
		$this->db->where('course_id', $id);
		return $this->db->update('courses', $data);
	}




	public function delete($id)
	{
		$this->db->where('course_id', $id);
		$this->db->delete('courses');
		return true;
	}




	public function check_course_exists($course)
	{
		$query = $this->db->get_where('courses', array('course_name' => $course));

		if(empty($query->row_array()))
		{
			return true;
		}
		else
		{
			return false;
		}
	}



}
