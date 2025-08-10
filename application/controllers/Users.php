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
			$this->User->insert_user($_POST);
			$this->session->set_flashdata('success', "Welcome, " .$this->input->post('first_name'). "! Your account is ready.");
			$this->load->view('catalogue');
		}
	}

	public function login() {
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('success', 'User registered successfully!');
			$this->load->view('login');
		} else {
			echo "hello chug!";
		}

	}
	
}
