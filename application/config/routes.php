<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'users';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['signup'] = 'users/signup';
$route['login'] = 'users/login';
$route['admin_login'] = 'orders/adminLogin';
$route['catalogue'] = 'products';
$route['logout'] = 'users/logout';

$route['category'] = 'products/getProductByCategory';
$route['search'] = 'products/searchProduct';
$route['product/(:any)'] = 'products/showProductCard/$1';

$route['cart/(:any)'] = 'carts/addToCart/$1';
$route['cart'] = 'carts';
$route['cart/count'] = 'carts/cartCount';
$route['cart/remove/(:any)'] = 'carts/remove/$1';

$route['order'] = 'orders';
$route['stripe'] = 'StripeController/index';

$route['products'] = 'orders/displayProducts';
$route['select_status'] = 'orders/selectStatus';
$route['change_status'] = 'orders/changeOrderStatus';
