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
$route['dashboard'] = 'c_dashboard';
$route['change-departement'] = 'c_dashboard/change_departement';


// === Academic ===
$route['academic/kurikulum'] = 'page/academic/c_kurikulum/kurikulum';
$route['academic/kurikulum-detail'] = 'page/academic/c_kurikulum/kurikulum_detail';
$route['academic/kurikulum-detail-mk'] = 'page/academic/c_kurikulum/kurikulum_detail_mk';
$route['academic/matakuliah'] = 'page/academic/c_matakuliah/mata_kuliah';

$route['academic/tahun-akademik'] = 'page/academic/c_tahun_akademik/tahun_akademik';
$route['academic/tahun-akademik-detail'] = 'page/academic/c_tahun_akademik/tahun_akademik_detail';
$route['academic/tahun-akademik-detail-date'] = 'page/academic/c_tahun_akademik/tahun_akademik_detail_date';


$route['academic/ketersediaan-dosen'] = 'page/academic/c_akademik/ketersediaan_dosen';

// --- Modal Academic ----
$route['academic/modal-tahun-akademik-detail-prodi'] = 'page/academic/c_akademik/modal_tahun_akademik_detail_prodi';
$route['academic/modal-tahun-akademik-detail-lecturer'] = 'page/academic/c_akademik/modal_tahun_akademik_detail_lecturer';







// ====== API ======
$route['api/__getKurikulumByYear'] = 'api/c_api/getKurikulumByYear';

