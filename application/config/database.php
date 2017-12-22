<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$active_group = 'default';
$active_record = TRUE;

//$db['default']['hostname'] = 'localhost';
//$db['default']['username'] = 'root';
//$db['default']['password'] = '';
//$db['default']['database'] = 'siak4';
//$db['default']['dbdriver'] = 'mysqli';// support with MYSQl,POSTGRE SQL, ORACLE,SQL SERVER
//$db['default']['dbprefix'] = '';
//$db['default']['pconnect'] = TRUE;
//$db['default']['db_debug'] = FALSE;
//$db['default']['cache_on'] = FALSE;
//$db['default']['cachedir'] = '';
//$db['default']['char_set'] = 'utf8';
//$db['default']['dbcollat'] = 'utf8_general_ci';
//$db['default']['swap_pre'] = '';
//$db['default']['autoinit'] = TRUE;
//$db['default']['stricton'] = FALSE;

$db['default'] = array(
    'dsn'	=> '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'siak4',
    'dbdriver' => 'mysqli', // support with MYSQl,POSTGRE SQL, ORACLE,SQL SERVER
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

$db['server'] = array(
    'dsn'	=> '',
    'hostname' => '10.1.30.88',
    'username' => 'it',
    'password' => 'itypap888',
    'database' => 'siak4',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

/* End of file database.php */
/* Location: ./application/config/database.php */
