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
$route['profile/(:any)'] = 'dashboard/c_dashboard/profile/$1';
$route['change-departement'] = 'dashboard/c_dashboard/change_departement';


// === Academic ===
$route['academic/kurikulum'] = 'page/academic/c_kurikulum/kurikulum';
$route['academic/kurikulum-detail'] = 'page/academic/c_kurikulum/kurikulum_detail';

$route['tes'] = 'page/academic/c_kurikulum/tes';


$route['academic/kurikulum-detail-mk'] = 'page/academic/c_kurikulum/kurikulum_detail_mk';
$route['academic/matakuliah'] = 'page/academic/c_matakuliah/mata_kuliah';

$route['academic/tahun-akademik'] = 'page/academic/c_tahun_akademik/tahun_akademik';
$route['academic/tahun-akademik/(:any)'] = 'page/academic/c_tahun_akademik/tahun_akademik_detail/$1';

$route['academic/tahun-akademik-detail'] = 'page/academic/c_tahun_akademik/tahun_akademik_detail2';
$route['academic/tahun-akademik-detail-date'] = 'page/academic/c_tahun_akademik/tahun_akademik_detail_date';


$route['academic/ketersediaan-dosen'] = 'page/academic/c_akademik/ketersediaan_dosen';

$route['academic/jadwal'] = 'page/academic/c_jadwal';

$route['academic/__setPageJadwal'] = 'page/academic/c_jadwal/setPageJadwal';

// --- Modal Academic ----
$route['academic/modal-tahun-akademik-detail-prodi'] = 'page/academic/c_akademik/modal_tahun_akademik_detail_prodi';
$route['academic/modal-tahun-akademik-detail-lecturer'] = 'page/academic/c_akademik/modal_tahun_akademik_detail_lecturer';




// ====== Database =====
$route['database/lecturers'] = 'page/database/c_database/lecturers';
$route['database/students'] = 'page/database/c_database/students';
$route['database/employees'] = 'page/database/c_database/employees';


// ====== API ======
$route['api/__getKurikulumByYear'] = 'api/c_api/getKurikulumByYear';
$route['api/__getBaseProdi'] = 'api/c_api/getProdi';
$route['api/__getBaseProdiSelectOption'] = 'api/c_api/getProdiSelectOption';
$route['api/__getMKByID'] = 'api/c_api/getMKByID';
$route['api/__getSemester'] = 'api/c_api/getSemester';
$route['api/__getLecturer'] = 'api/c_api/getLecturer';
$route['api/__getAllMK'] = 'api/c_api/getAllMK';

$route['api/__setLecturersAvailability/(:any)'] = 'api/c_api/setLecturersAvailability/$1';
$route['api/__setLecturersAvailabilityDetail/(:any)'] = 'api/c_api/setLecturersAvailabilityDetail/$1';

$route['api/__changeTahunAkademik'] = 'api/c_api/changeTahunAkademik';


