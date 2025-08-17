<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends CI_Model {
	public function store($data) {
		$this->db->insert('shippings', $data);
		return $this->recentData();
	}

	public function recentData() {
		$query =  $this->db->select('shippings.shipping_id')
				->from('shippings')
				->order_by('shipping_id', 'desc')
				->get()->row_array();
		return $query;
		
	}
}
