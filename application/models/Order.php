<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Order extends CI_Model {
	
	public function store($total_amount, $shipping_id) {
		$user = $this->session->userdata('user_data');
		$data = [
			'total_amount' => $total_amount,
			'shipping_id' => $shipping_id,
			'status_id' => 1,
			'user_id' => $user['user_id'],
			'created_at' => date('Y-m-d H:i:s'),
		];
		$this->db->insert('orders' ,$data);
		return;
	}

	public function numberOfOrder() {

		return $this->db->select('status.*, count(orders.order_id) as status_count')
			->from('status')
			->join('orders', 'orders.status_id = status.status_id', 'left')
			->group_by('status.status_id')
			->order_by('status.status_id')
			->get()->result_array();
	}

	public function getAllOrder() {
		return $this->db->select('orders.*, shippings.*')
				->from('orders')
				->join('shippings', 'orders.shipping_id = shippings.shipping_id')
				->get()->result_array();
	}

	public function getOrder($status_id) {
		return $this->db->select('orders.*, shippings.*')
				->from('orders')
				->join('shippings', 'orders.shipping_id = shippings.shipping_id')
				->where('orders.status_id', $status_id)
				->get()->result_array();

	}

	public function fecthOrder($order_id) {
		$query = $this->db->select('orders.status_id')
				->from('orders')
				->where('order_id', $order_id)
				->get()->row_array();
		return $query['status_id'];
	}

	public function updateStatus($order_id, $new_status) {
		$this->db->where('order_id', $order_id)
			->update('orders', array('status_id'=> $new_status));
	}
}
