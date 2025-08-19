<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends CI_Model {

    public function getAllImage($product) {
		$images = [];
		foreach($product as $data) {
			$images[$data['product_id']] = $this->db->select('images.*')
				->from('images')
				->where('product_id', $data['product_id'])
				->get()->result_array();
		}
		return $images;
	}
}
