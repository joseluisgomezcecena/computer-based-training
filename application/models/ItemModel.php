<?php

class ItemModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}


	public function get_items()
	{
		$query = $this->db->get('items');
		return $query->result_array();
	}


	public function get_items_data()
	{
		$this->db->select('*');
		$this->db->from('items');
		$query = $this->db->get();

		return $items = $query->result_array();

	}


	public function get_details($postData)
	{

		$this->db->select('*');
		$this->db->from('items');
		$this->db->where('items.item_id', $postData['item_id']);
		$item = $this->db->get()->row_array();

		$this->db->select('*');
		$this->db->from('item_size');
		$this->db->join('sizes', 'sizes.size_id = item_size.size_id');
		$this->db->where('item_size.item_id', $postData['item_id']);
		$sizes = $this->db->get()->result_array();


		return array(
			'item' => $item,
			'sizes' => $sizes,
		);

	}





	public function get_item($postData)
	{

		$this->db->select('*');
		$this->db->from('items');
		$this->db->where('items.item_id', $postData['item_id']);
		$item = $this->db->get()->row_array();

		return array(
			'item' => $item,
		);

	}



	public function store_item($sizes)
	{

		$data = array(
			'item_name' => $this->input->post('item_name'),
			'item_image' => $this->input->post('item_name'),
		);

		$this->db->insert('items', $data);
		$item_id = $this->db->insert_id();

		if($this->input->post('ingredients[]') != NULL)
		{
			$ingredients = $this->input->post('ingredients[]');
			foreach($ingredients as $ingredient){
				$data = array(
					'item_id' => $item_id,
					'ingredient_id' => $ingredient,
				);
				$this->db->insert('item_ingredient', $data);
			}
		}

		foreach ($sizes as $size) {
			$data = array(
				'item_id' => $item_id,
				'size_id' => $size['size_id'],
				'price' => $this->input->post('price_' . $size['size_id']),
			);
			$this->db->insert('item_size', $data);

			$last_one = $this->db->last_query();
			print_r($last_one);
		}

	}

}
