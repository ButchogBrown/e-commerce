<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';
use Stripe\Stripe;
use Stripe\Checkout\Session;
class StripeController extends CI_Controller
{
	


    public function index()
    {
        // Set API key for static Stripe methods
        \Stripe\Stripe::setApiKey('sk_test_51PGJHFIv8FrCSCa2oj5mRHMzOQqkCVgPTJVhREgqdV0wNPDeNkQwUUEm1pRdHU88iBQFZ3dD0hEqj79H5meHk89R00jBxyoHcy');
		header('Content-Type: application/json');

		$YOUR_DOMAIN = 'http://localhost';

		$checkout_session = \Stripe\Checkout\Session::create([
			'line_items' => [[
				'price_data' => [
					'currency' => 'usd',
					'product_data' => [
						'name' => 'Test Product',
					],
					'unit_amount' => 500, // amount in cents (500 = $5.00)
				],
				'quantity' => 1,
			]],
			'mode' => 'payment',
			'success_url' => $YOUR_DOMAIN . '/success.html',
			'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
		]);


		header("HTTP/1.1 303 See Other");
		header("Location: " . $checkout_session->url);
	}
}
