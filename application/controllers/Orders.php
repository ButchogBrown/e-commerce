<?php 
defined('BASEPATH')OR exit ('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';
use Stripe\Stripe;
use Stripe\Checkout\Session;
class Orders extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->model('Order');
		$this->load->model('Product');
		$this->load->model('Cart');
		$this->load->model('Shipping');
	}

	public function cart() {
		$user_data = $this->session->userdata('user_data');
		$data['cart_items'] = $this->Cart->getAllCartItem($user_data['user_id']);
		$data['cart_count'] = count($data['cart_items']);

		$this->load->view('cart', $data);
	}
	public function index() {
		$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
		$this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
		$this->form_validation->set_rules('address_2', 'Address 2', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('zip_code', 'Zip Code', 'trim|required');

		$carts_id = $this->input->post('carts_id', true);
		$qauntity = $this->input->post('quantity', true);

		if($this->form_validation->run() == false) {
			$this->cart();
		}
		else {
			$sum = 0;
			$datas = [];
			for($i = 0; $i < count($carts_id); $i++) {
				$data = $this->Cart->getPrice($carts_id[$i], $qauntity[$i]);
				$datas[] = $data;
				$sum += $data['total_amount'];
				$this->Product->updateyQuantity($data['product_id'], $qauntity[$i]);
				$this->Cart->destroy($carts_id[$i]);
			}
			$shipping_data = $this->shippingDetails($_POST);
			$this->Order->store($sum, $shipping_data['shipping_id']);
			$this->stripePayment($qauntity, $datas);
			
			
		}
	}

	public function shippingDetails($data) {
		$data = [
			'first_name' => $this->input->post('first_name', true),
			'last_name' => $this->input->post('last_name', true),
			'address1' => $this->input->post('address_1', true),
			'address2' => $this->input->post('address_2', true),
			'city' => $this->input->post('city', true),
			'state' => $this->input->post('state', true),
			'zip' => $this->input->post('zip_code', true),
			'created_at' => date('Y-m-d H:i:s'),
		];

		return $this->Shipping->store($data);
	}

	public function stripePayment($quantity, $data) {

		var_dump($data, $quantity);
		$line_items = [];
		for($i = 0; $i < count($quantity); $i++) {
			$line_items[] = [
				'price_data' => [
					'currency' => 'usd',
					'product_data' => [
						'name' => $data[$i]['product_name'],
					],
					'unit_amount' => $data[$i]['price'] * 100,
				] ,
				'quantity' => $quantity[$i]
			];
		}
		
		\Stripe\Stripe::setApiKey('sk_test_51PGJHFIv8FrCSCa2oj5mRHMzOQqkCVgPTJVhREgqdV0wNPDeNkQwUUEm1pRdHU88iBQFZ3dD0hEqj79H5meHk89R00jBxyoHcy');
		header('Content-Type: application/json');

		$this->session->set_flashdata('success', 'Successful Purchase');
		$checkout_session = \Stripe\Checkout\Session::create([
			'line_items' => $line_items,
			'mode' => 'payment',
			'success_url' => base_url('catalogue'),
			'cancel_url' => base_url('cart'),
		]);


		header("HTTP/1.1 303 See Other");
		header("Location: " . $checkout_session->url);
	}

	public function adminLogin() {
		$data['category_details'] = $this->Order->numberOfOrder();
		$data['order_data'] = $this->Order->getAllOrder();
		$data['total_number_of_order'] = count($data['order_data']);
		
		$this->load->view('admin_orders', $data);

	}

	public function displayProducts() {

		$this->load->view('admin_products');
	}
	

	public function selectStatus() {

		$status_id = $this->input->post('status', true);
		if ( (int)$status_id === 5) {
			
			redirect('admin_login');
		} else {

			$data['order_data'] = $this->Order->getOrder($status_id);
		}
		$data['category_details'] = $this->Order->numberOfOrder();
		$get_all =  $this->Order->getAllOrder();
		$data['total_number_of_order'] = count($get_all);
		$this->load->view('admin_orders', $data);
	}

	public function changeOrderStatus() {
		$new_status = (int)$this->input->post('change_status', true);
		$order_id = $this->input->post('order_id', true);
		
		$current_status = (int)$this->Order->fecthOrder($order_id);

		if ( $new_status > $current_status && ($current_status + 2) > $new_status) {
			$this->Order->updateStatus($order_id, $new_status);
			$this->session->set_flashdata('success', 'Order status updated successfully.');
		} else {
			$this->session->set_flashdata('error', 'Invalid status change! You cannot skip or go backwards');
		}
		redirect('admin_login');
		
	}
}
