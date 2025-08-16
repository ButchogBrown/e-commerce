<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model {

    //function to get all products
	public function getAllProduct() {
		$this->db->select('products.*, categories.product');
		$this->db->from('products');
		$this->db->where('stock !=', 0);
		$this->db->join('categories', 'products.category_id = categories.category_id');
		$this->db->order_by('products.created_at', 'DESC');
		return $this->db->get()->result_array();
	}
	
	public function getProduct($product_id) {
		$this->db->select('products.*');
		$this->db->from('products');
		$this->db->where('product_id', $product_id);
		return $this->db->get()->row_array();
	}

	public function categoryCount() {
		$this->db->select('categories.*, count(products.product_id) as category_count, ');
		$this->db->from('products');
		$this->db->join('categories', 'products.category_id = categories.category_id');
		$this->db->group_by('products.category_id');
		$this->db->order_by('categories.category_id', 'asc');
		return $this->db->get()->result_array();
	}

	public function getByCategory($type) {
	
		$this->db->select('products.*');
		$this->db->from('products');
		$this->db->where('products.category_id', $type);
		return $this->db->get()->result_array();
	}

	public function getSearchProduct($search_data) {
		$this->db->select('products.product_id, products.product_name, products.price');
		$this->db->from('products');
		$this->db->like('products.product_name', $search_data);
		$this->db->or_like('products.description', $search_data);
		
		return $this->db->get()->result_array();
	}

	public function updateyQuantity($product_id, $old_quantity) {
		$data = $this->getProduct($product_id);
		$product['stock'] = $data['stock'] - $old_quantity;

		$this->db->where('product_id', $product_id)
			->update('products', $product);
		return;
	}

}
