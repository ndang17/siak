<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '652219708720-41f1g925avki3tgq344kc4f7867kbppd.apps.googleusercontent.com';
$config['google']['client_secret']    = 'SpE7Nz0B43RjtkTKsSADBTjC';
$config['google']['redirect_uri']     = base_url().'auth/authGoogle/';
$config['google']['application_name'] = 'Login to Podomoro Academic Learning System';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();
