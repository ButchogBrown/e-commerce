<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('form_validation');

		$this->load->model('Product');
		$this->load->model('Cart');
	}

	public function index() {
		$this->load->view('cart');
	}
	public function addToCart($product_id) {

		$quantity = $this->input->post('quantity', true);
		$product_data = $this->Product->getProduct($product_id);
		$user_data = $this->session->userdata('user_data');

		$data['user_id'] = $user_data['user_id'];
		$data['product_id'] =  $product_data['product_id'];
		

		if($quantity < $product_data['stock']) {
			$data['created_at'] =  date('Y-m-d H:i:s');
			$data['total_amount'] = $product_data['price'] * $quantity;

			$this->Cart->store($data);

			redirect('product/'.$data['product_id']);
		}

	}
}
