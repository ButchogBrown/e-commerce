<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct() {

		parent::__construct();
		
		$this->load->model('User');

		$this->load->helper(array('form', 'array'));
		$this->load->library('form_validation');
		$this->load->library('session');

	}

	public function index(){

		$this->load->view('login');
	}

	public function signup() {
		$this->load->view('signup');
	}

	public function registerUser() {
		// validate all input
		$this->form_validation->set_rules('first_name', 'First name', 'trim|required|min_length[5]|max_length[12]');
		$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

		if ($this->form_validation->run() == false) {
			$this->load->view('signup'); 
		} else {
			$user_data = $this->User->insert_user($_POST);
			$this->session->set_flashdata('success', "Welcome, " .$this->input->post('first_name'). "! Your account is ready.");
			$this->session->set_userdata('user_data', $user_data);

			redirect('catalogue');
		}
	}

	public function show_catalogue() {
		if ($this->session->userdata('user_data')) {
			$this->load->view('catalogue');
		} else {
			$this->session->set_flashdata('error', 'You must be logged in to access the catalogue.');
			redirect('login');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('/');
	}

	public function login() {
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true) {
			$email = $this->input->post('email', true);
			$password = $this->input->post('password', true);

			$user_data = $this->User->get_user($email);
			if($user_data && password_verify($password, $user_data['password']) && $user_data['is_admin'] == 0) {
				$this->session->set_userdata('user_data', $user_data);
				$this->session->set_flashdata('success', "Welcome, " . $user_data['first_name']. "! You have successfully logged in.");
				redirect('catalogue');
			} else if ($user_data && password_verify($password, $user_data['password']) && $user_data['is_admin'] == 1 ) {
				$this->load->view('admin_orders');
			} else {
				$this->session->set_flashdata('error', 'Invalid email or password.');
				redirect('/');
			}

		} else {
			echo "hello chug";
		}

	}
	
}
