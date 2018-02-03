<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'c_login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['navigation/(:num)'] = 'c_departement/navigation/$1';
$route['profile'] = 'c_dashboard/profile';


// === AUTH ===
$route['uath-login'] = 'auth/c_auth/get_auth';
$route['auth/authGoogle'] = 'c_login/authGoogle';
$route['auth/gen_pass'] = 'c_login/gen_pass';

$route['db/(:any)'] = 'auth/c_auth/db/$1';


// === Dashboard ===
$route['dashboard'] = 'dashboard/c_dashboard';
$route['profile/(:any)'] = 'dashboard/c_dashboard/profile/$1';
$route['change-departement'] = 'dashboard/c_dashboard/change_departement';


// === Academic ===
$route['academic/kurikulum'] = 'page/academic/c_kurikulum/kurikulum';
$route['academic/kurikulum-detail'] = 'page/academic/c_kurikulum/kurikulum_detail';
$route['academic/kurikulum/add-kurikulum'] = 'page/academic/c_kurikulum/add_kurikulum';
$route['academic/kurikulum/loadPageDetailMataKuliah'] = 'page/academic/c_kurikulum/loadPageDetailMataKuliah';

$route['academic/kurikulum/data-conf'] = 'page/academic/c_kurikulum/getDataConf';
$route['academic/kurikulum/getClassGroup'] = 'page/academic/c_kurikulum/getClassGroup';
$route['academic/kurikulum/getClassroom'] = 'page/academic/c_kurikulum/getClassroom';


$route['academic/kurikulum-detail-mk'] = 'page/academic/c_kurikulum/kurikulum_detail_mk';
$route['academic/matakuliah'] = 'page/academic/c_matakuliah/mata_kuliah';
$route['academic/dataTableMK'] = 'page/academic/c_matakuliah/dataTableMK';

$route['academic/tahun-akademik'] = 'page/academic/c_tahun_akademik/tahun_akademik';
$route['academic/tahun-akademik-table'] = 'page/academic/c_tahun_akademik/tahun_akademik_table';
$route['academic/detail-tahun-akademik'] = 'page/academic/c_tahun_akademik/page_detail_tahun_akademik';
$route['academic/modal-tahun-akademik'] = 'page/academic/c_tahun_akademik/modal_tahun_akademik';
$route['academic/tahun-akademik/(:any)'] = 'page/academic/c_tahun_akademik/tahun_akademik_detail/$1';

$route['academic/tahun-akademik-detail'] = 'page/academic/c_tahun_akademik/tahun_akademik_detail2';
$route['academic/tahun-akademik-detail-date'] = 'page/academic/c_tahun_akademik/tahun_akademik_detail_date';


$route['academic/ketersediaan-dosen'] = 'page/academic/c_akademik/ketersediaan_dosen';
$route['academic/ModalKetersediaanDosen'] = 'page/academic/c_akademik/Modal_KetersediaanDosen';

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
$route['api/__geteducationLevel'] = 'api/c_api/geteducationLevel';

$route['api/__getMKByID'] = 'api/c_api/getMKByID';
$route['api/__getSemester'] = 'api/c_api/getSemester';
$route['api/__getLecturer'] = 'api/c_api/getLecturer';
$route['api/__getAllMK'] = 'api/c_api/getAllMK';

$route['api/__setLecturersAvailability'] = 'api/c_api/setLecturersAvailability';
$route['api/__setLecturersAvailabilityDetail/(:any)'] = 'api/c_api/setLecturersAvailabilityDetail/$1';

$route['api/__changeTahunAkademik'] = 'api/c_api/changeTahunAkademik';

$route['api/__insertKurikulum'] = 'api/c_api/insertKurikulum';
$route['api/__getKurikulumSelectOption'] = 'api/c_api/getKurikulumSelectOption';


$route['api/__getDosenSelectOption'] = 'api/c_api/getDosenSelectOption';

$route['api/__crudKurikulum'] = 'api/c_api/crudKurikulum';
$route['api/__crudDetailMK'] = 'api/c_api/crudDetailMK';

$route['api/__getdetailKurikulum'] = 'api/c_api/getdetailKurikulum';
$route['api/__genrateMKCode'] = 'api/c_api/genrateMKCode';
$route['api/__cekMKCode'] = 'api/c_api/cekMKCode';

$route['api/__crudMataKuliah'] = 'api/c_api/crudMataKuliah';

$route['api/__crudTahunAkademik'] = 'api/c_api/crudTahunAkademik';

$route['api/__crudDataDetailTahunAkademik'] = 'api/c_api/crudDataDetailTahunAkademik';

$route['api/__getAcademicYearOnPublish'] = 'api/c_api/getAcademicYearOnPublish';
$route['api/__getTimePerCredits'] = 'api/c_api/getTimePerCredits';





