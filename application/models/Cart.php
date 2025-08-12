<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Model {
	public function store($data) {
		$this->db->insert('carts',$data);
	}
}
