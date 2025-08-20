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
		$this->load->model('Image');
	}

	public function index() {
		$user_data = $this->session->userdata('user_data');
		$data['cart_items'] = $this->Cart->getAllCartItem($user_data['user_id']);
		$data['cart_count'] = count($data['cart_items']);
		$data['images'] = $this->Image->getAllImage($data['cart_items']);
		
		$this->load->view('cart', $data);
	}

	
	public function addToCart($product_id) {

		$quantity = $this->input->post('quantity', true);
		$product_data = $this->Product->getProduct($product_id);
		$user_data = $this->session->userdata('user_data');

		$data['user_id'] = $user_data['user_id'];
		$data['product_id'] =  $product_data['product_id'];
		
		//checks if the user cart has already this item
		$in_cart = $this->Cart->inCart($data['user_id'], $data['product_id']);

		//function when its the first the item being added by the user
		if($quantity <= $product_data['stock'] && empty($in_cart)) {
			$data['created_at'] =  date('Y-m-d H:i:s');
			$data['total_amount'] = $product_data['price'] * $quantity;
			$data['quantity'] = $quantity;
			
			$this->Cart->store($data);
			$this->session->set_flashdata('success', 'Heads up: Stock isn’t locked in yet — grab it before it’s gone!');
			redirect('product/'.$data['product_id']);
		} 
		else if ($quantity <= $product_data['stock'] && $in_cart) {
			if ( ($total_quantity =  $quantity + $in_cart['quantity']) <= $product_data['stock']) {
				$data['quantity'] = $total_quantity;
				$data['total_amount'] = $product_data['price'] * $total_quantity;
				$data['updated_at'] = date('Y-m-d H:i:s');
				
				$this->Cart->updateCart($data);
				$this->session->set_flashdata('success', 'Heads up: Stock isn’t locked in yet — grab it before it’s gone!');
				redirect('product/'.$data['product_id']);
			} else {
				$this->session->set_flashdata('error', 'Looks like you’ve already got all we have left in stock in your cart.');
				redirect('product/'.$data['product_id']);
			}
		}
		else {
			$this->session->set_flashdata('error', 'Not enough Stock!');
			redirect('product/'.$data['product_id']);
		}

	}

	public function remove($cart_id) {
		$this->Cart->destroy($cart_id);
		$this->index();
	}
}
