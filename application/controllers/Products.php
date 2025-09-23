<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product');
        $this->load->model('Cart');
		$this->load->model('Image');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('user_data')) {
				//get all the product form the product model
				$user_data = $this->session->userdata('user_data');
				$data['product_data'] = $this->Product->getAllProduct();
				$data['category_count'] = $this->Product->categoryCount();
				$data['allProducts'] = count($data['product_data']);
				$data['cart_count'] = $this->Cart->cartCount($user_data['user_id']);
				$data['images'] = $this->Image->getAllImage($data['product_data']);

				// var_dump($data['images']);
				$this->load->view('catalogue', $data);
        } else {
            $this->session->set_flashdata('error', 'You must be logged in to access the catalogue.');
            redirect('login');
        }
    }

    public function getProductByCategory()
    {
        $category_type = $this->input->post('category_type', true);
        $user_data = $this->session->userdata('user_data');

        if ($category_type == 0) {
           	$data['product_data'] = $this->Product->getAllProduct();
        } else {
            $data['product_data'] = $this->Product->getByCategory($category_type);
        }
		$data['category_count'] = $this->Product->categoryCount();
        $data['allProducts'] = count($this->Product->getAllProduct());
        $data['cart_count'] = $this->Cart->cartCount($user_data['user_id']);
		$data['images'] = $this->Image->getAllImage($data['product_data']);
		$data['message'] = 'No products here yet — please check back later!';
		$this->direction($data);
		// $this->load->view('partials/item_list', $data);
    }
	public function direction($data) {
		if (empty($data['product_data'])) {

			$this->load->view('partials/error_card', array('error_message' => $data['message']));
		} else {
			$this->load->view('partials/item_list', $data);
		}


	}
    public function searchProduct()
    {
        $search_data = $this->input->post('search');
        $user_data = $this->session->userdata('user_data');
        $data['product_data'] = $this->Product->getSearchProduct($search_data);
        $data['category_count'] = $this->Product->categoryCount();
        $data['allProducts'] = count($this->Product->getAllProduct());
        $data['cart_count'] = $this->Cart->cartCount($user_data['user_id']);
		$data['images'] = $this->Image->getAllImage($data['product_data']);
		$data['message'] = 'No result found.';

		$this->direction($data);
       
    }

    public function showProductCard($product_id)
    {
        $user_data = $this->session->userdata('user_data');
        $data['product_data'] = $this->Product->getProduct($product_id);
        $data['category'] = $this->Product->getByCategory($data['product_data']['category_id']);
        $data['cart_count'] = $this->Cart->cartCount($user_data['user_id']);
		$data['images'] = $this->Image->getImage($data['product_data']['product_id']);
		$data['image_category'] = $this->Image->getAllImage($data['category']);
		// var_dump($data['image_category']);
        $this->load->view('product_view', $data);
    }

    //display admin product view
    public function displayProducts()
    {
        $data['product_data'] = $this->Product->adminGetAllProduct();
        $data['category_count'] = $this->Product->categoryCount();
        $data['allProducts'] = count($data['product_data']);
		$data['images'] = $this->Image->getAllImage($data['product_data']);
        // var_dump($data['category_count']);
        $this->load->view('admin_products', $data);
    }

	public function showProducts($message)
    {
        $data['product_data'] = $this->Product->adminGetAllProduct();
        $data['category_count'] = $this->Product->categoryCount();
        $data['allProducts'] = count($data['product_data']);
		$data['images'] = $this->Image->getAllImage($data['product_data']);
        // var_dump($data['product_data']);
		if(!empty($data['product_data'])) {
			$html = $this->load->view('partials/admin_product_list', $data, true);
		} else {
			$html = $this->load->view('partials/error_card', array('error_message' => 'Nothing find'), true);
		}
		echo json_encode([
			'html' => $html,
			'success' => $message,
			'category_count' => $data['category_count']
		]);
    }
	

    public function adminProductCategory()
    {
        $category_type = $this->input->post('category_type', true);

        if ($category_type == 0) {
            $data['product_data'] = $this->Product->getAllProduct();
        } else {
            $data['product_data'] = $this->Product->getByCategory($category_type);
        }
		$data['category_count'] = $this->Product->categoryCount();
        $data['allProducts'] = count($this->Product->getAllProduct());
		$data['images'] = $this->Image->getAllImage($data['product_data']);
		
		if(empty($data['product_data'])) {
			$this->load->view('partials/error_card', array('error_message' => 'No product in this category'));
		} else {
			$this->load->view('partials/admin_product_list', $data);
		}
        
    }

    public function destroy()
    {
        $product_id = $this->input->post('product_id', true);
        $this->Product->destroy($product_id);
        $this->Cart->deleteByProductId($product_id);
		// $this->session->set_flashdata('success', 'Successfully deleted producnt!');
		
		$data['product_data'] = $this->Product->adminGetAllProduct();
        $data['category_count'] = $this->Product->categoryCount();
        $data['allProducts'] = count($data['product_data']);
		$data['images'] = $this->Image->getAllImage($data['product_data']);

		if(empty($data['product_data'])) {
			$html = $this->load->view('partials/error_card', array('error_message' => 'No products found'), true);
			echo json_encode([
				'html' => $html,
				'success' => false, 
				'category_count' => $data['category_count'],
				'allProduct' => $data['allProducts']
			]);
		} else {
			$html = $this->load->view('partials/admin_product_list', $data, true);
			echo json_encode([
				'html' => $html,
				'success' => true,
				'category_count' => $data['category_count'],
				'allProduct' => $data['allProducts']	
			]);
			
		}
    }

    public function addProduct()
    {
		// phpinfo();
        $product_data = [
            'product_name' => $this->input->post('product_name', true),
            'description' => $this->input->post('description', true),
            'stock' => $this->input->post('inventory', true),
            'price' => $this->input->post('price', true),
            'sold' => 0,
            'category_id' => $this->input->post('selectpicker', true),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->form_validation->set_rules('product_name', 'Name of the Vegetable', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('selectpicker', 'Category', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('inventory', 'Inventory', 'trim|required');

        if ($this->form_validation->run() == false) {
            // form validation failed
			echo validation_errors();
			var_dump($_FILES);
            $this->session->set_flashdata('error', 'Something went wrong. Please check your input.');
			$this->displayProducts();
        } else {
            $product_id = $this->Product->addProduct($product_data);
			$this->doUpload($_FILES, $product_id);
        }
    }

    public function doUpload($files, $product_id)
    {
		$data = [];
		$error = [];

		$count = count($files['image']['name']);
		for($i = 0; $i < $count; $i++) {

			if ( !empty($_FILES['image']['name'][$i])) {
				$_FILES['image']['name']     = $files['image']['name'][$i];
				$_FILES['image']['type']     = $files['image']['type'][$i];
				$_FILES['image']['tmp_name'] = $files['image']['tmp_name'][$i];
				$_FILES['image']['error']    = $files['image']['error'][$i];
				$_FILES['image']['size']     = $files['image']['size'][$i];

				$config['upload_path'] = FCPATH . 'assets/images/uploads/';
        		$config['allowed_types'] = 'gif|jpg|png|svg';
				$config['max_size'] = 10240;

				$this->load->library('upload', $config);

				if ( !$this->upload->do_upload('image') ) {		
					$error[] = ['error' => $this->upload->display_errors()];
					
					// $this->load->view('upload_form', $error);
				} else {
					$data = $this->upload->data();
					$path = 'assets/images/uploads/'.$data['file_name'];

					$this->Product->addImage($path, $product_id);
				}
			}
		}
		$message = empty($error) ? true : false;
		$this->showProducts($message);
      
    }

	public function editProduct($product_id) {
		$data = [
			'product_name' => $this->input->post('product_name', true),
			'description' => $this->input->post('description', true),
			'category_id' => $this->input->post('selectpicker', true),
			'price' => $this->input->post('price', true),
			'stock' => $this->input->post('inventory', true),
			'sold' => 0,
			'created_at' => date('Y-m-d H:i:s'),
			
		];

		$this->form_validation->set_rules('product_name', 'Product name', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('selectpicker', 'Category', 'trim|required');
		$this->form_validation->set_rules('price', 'Price', 'trim|required');
		$this->form_validation->set_rules('inventory', 'Inventory', 'trim|required');

		if( $this->form_validation->run() == false ) {
			$message = false;
		} else {
			$this->Product->updateProduct($data, $product_id);
			$message = true;
			
		}
		$this->showProducts($message);

	}

	public function adminProducntSearch(){
		$search = $this->input->post('search', true);

		$data['product_data'] = $this->Product->adminProductSearch($search);
        $data['category_count'] = $this->Product->categoryCount();
        $data['allProducts'] = count($data['product_data']);
		$data['images'] = $this->Image->getAllImage($data['product_data']);
		
		if(empty($data['product_data'])) {
			$this->load->view('partials/error_card', array('error_message' => 'No result found.'));
		} else {
			$this->load->view('partials/admin_product_list', $data);
		}
        
	}
}
