<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Model {
	public function store($data) {
		$this->db->insert('carts',$data);
	}

	public function getAllCartItem($user_id) {
		return $this->db->select('carts.cart_id, carts.total_amount, carts.product_id, carts.quantity, products.product_name, products.price, products.stock')
				->from('carts')
				->join('products', 'carts.product_id = products.product_id')
				->where('user_id', $user_id)
				->get()->result_array();		
	}
	
	public function inCart($user_id, $product_id) {
		return $this->db->select('quantity')
				->where('user_id', $user_id)
				->where('product_id', $product_id)
				->get('carts')->row_array();
	}

	public function updateCart($data) {
		var_dump($data);
		$this->db->where('user_id', $data['user_id'])
			->where('product_id', $data['product_id'])
			->update('carts', [
				'total_amount' => $data['total_amount'],
				'quantity' => $data['quantity'],
				'updated_at' => $data['updated_at']
			]);
		return 0;
	}

	public function cartCount($user_id) {
		$this->db->select('count(user_id) as cart_count');
		$this->db->from('carts');
		$this->db->where('user_id', $user_id);
		return $this->db->get()->row()->cart_count;
	}

	public function destroy($cart_id) {
		$this->db->delete('carts', array('cart_id' => $cart_id));
		return;
	}

	public function getPrice($cart_id, $quantity) {
		$query = $this->db->select('products.price, products.product_id, products.product_name')
			->from('carts')
			->join('products', 'products.product_id = carts.product_id')
			->where('carts.cart_id', $cart_id)
			->get()->row_array();

		$query['total_amount'] = $query['price'] * $quantity;
		return $query;
	}

	public function deleteByProductId($product_id) {
		$this->db->where('product_id', $product_id)
			->delete('carts');
	}

}
