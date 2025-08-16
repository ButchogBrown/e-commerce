<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Order extends CI_Model {
	
	public function store($total_amount, $shipping_id) {
		$user = $this->session->userdata('user_data');
		$data = [
			'total_amount' => $total_amount,
			'status_id' => 1,
			'user_id' => $user['user_id'],
			'created_at' => date('Y-m-d H:i:s'),
		];
		$this->db->insert('orders' ,$data);
		return;
	}
}
