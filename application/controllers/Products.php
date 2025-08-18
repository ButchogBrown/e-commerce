<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Product');
		$this->load->model('Cart');

		$this->load->helper('form');
		$this->load->library('form_validation');

	}

	public function index() {
		if ($this->session->userdata('user_data')) {

			//get all the product form the product model
			$user_data = $this->session->userdata('user_data');
			$data['product_data'] = $this->Product->getAllProduct();
			$data['category_count'] = $this->Product->categoryCount();
			$data['allProducts'] = count($data['product_data']);
			$data['cart_count'] = $this->Cart->cartCount($user_data['user_id']);

 			$this->load->view('catalogue', $data);

		} else {
			$this->session->set_flashdata('error', 'You must be logged in to access the catalogue.');
			redirect('login');
		}
	}

	public function getProductByCategory() {
		$category_type = $this->input->post('category_type', true);
		$user_data = $this->session->userdata('user_data');

		if($category_type == 0){
			$this->index();
		} else {
			$data['product_data'] = $this->Product->getByCategory($category_type);
			$data['category_count'] = $this->Product->categoryCount();
			$data['allProducts'] = count($this->Product->getAllProduct());
			$data['cart_count'] = $this->Cart->cartCount($user_data['user_id']);

 			$this->load->view('catalogue', $data);
		}
	}

	public function searchProduct() {
		$search_data = $this->input->post('search');
		$user_data = $this->session->userdata('user_data');
		$data['product_data'] = $this->Product->getSearchProduct($search_data);
		$data['category_count'] = $this->Product->categoryCount();
		$data['allProducts'] = count($this->Product->getAllProduct());
		$data['cart_count'] = $this->Cart->cartCount($user_data['user_id']);

 		$this->load->view('catalogue', $data);
	}

	public function showProductCard($product_id) {
		$user_data = $this->session->userdata('user_data');
		$data['product_data'] = $this->Product->getProduct($product_id);
		$data['category'] = $this->Product->getByCategory($data['product_data']['category_id']);
		$data['cart_count'] = $this->Cart->cartCount($user_data['user_id']);

		$this->load->view('product_view', $data);
	}

	//display admin product view
	public function displayProducts() {
		$data['product_data'] = $this->Product->getAllProduct();
		$data['category_count'] = $this->Product->categoryCount();
		$data['allProducts'] = count($data['product_data']);
		// var_dump($data['product_data']);
		$this->load->view('admin_products', $data);
	}

	public function adminProductCategory() {
		$category_type = $this->input->post('category_type', true);

		if($category_type == 0){
			$this->displayProducts();
		} else {
			$data['product_data'] = $this->Product->getByCategory($category_type);
			$data['category_count'] = $this->Product->categoryCount();
			$data['allProducts'] = count($this->Product->getAllProduct());
			// var_dump($data['product_data']);
 			$this->load->view('admin_products', $data);
		}
	}

	public function destroy() {
		$product_id = $this->input->post('product_id', true);
		$this->Product->destroy($product_id);
		$this->Cart->deleteByProductId($product_id);
		
	}

	public function addProduct() {
		echo "helo";
	} 
	
	
}
