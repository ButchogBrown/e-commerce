<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    public function insert_user($data) {
		$data['is_admin'] = 0;
		$data['created_at'] = date('Y-m-d H:i:s');;
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		unset($data['confirm_password']);

		$this->db->insert('users', $data);

		return $data;
    }

	public function get_user($email) {
		$this->db->where('email', $email);
		return $this->db->get('users')->row_array();
	}
}
