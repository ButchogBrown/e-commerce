<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'users';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['signup'] = 'users/signup';
$route['login'] = 'users/login';
$route['catalogue'] = 'users/show_catalogue';
$route['logout'] = 'users/logout';