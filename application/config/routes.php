<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'c_login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['navigation/(:num)'] = 'c_departement/navigation/$1';
$route['profile'] = 'c_dashboard/profile';


// === AUTH ===
$route['uath-login'] = 'auth/c_auth/get_auth';

$route['db/(:any)'] = 'auth/c_auth/db/$1';


// === Dashboard ===
$route['dashboard'] = 'dashboard/c_dashboard';


