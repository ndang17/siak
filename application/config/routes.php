 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'c_login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['navigation/(:num)'] = 'c_departement/navigation/$1';
$route['profile'] = 'c_dashboard/profile';


// === AUTH ===
$route['uath/authUserPassword'] = 'c_login/authUserPassword';
$route['auth/authGoogle'] = 'c_login/authGoogle';
// $route['auth/gen_pass'] = 'c_login/gen_pass';
$route['auth/logMeOut'] = 'c_login/logMeOut';
$route['sendmail'] = 'c_login/sendmail';

$route['authEmp/(:any)/(:any)'] = 'c_login/genratePassword2/$1/$2';

$route['gen/(:any)/(:any)'] = 'c_login/gen/$1/$2';


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
//$route['academic/kurikulum/getClassGroup'] = 'page/academic/c_kurikulum/getClassGroup';


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

$route['academic/semester-antara'] = 'page/academic/c_semester_antara';
$route['academic/semester-antara/details/(:num)'] = 'page/academic/c_semester_antara/loadDetails/$1';


$route['academic/ketersediaan-dosen'] = 'page/academic/c_akademik/ketersediaan_dosen';
$route['academic/ModalKetersediaanDosen'] = 'page/academic/c_akademik/Modal_KetersediaanDosen';

$route['academic/jadwal'] = 'page/academic/c_jadwal';

$route['academic/study-planning'] = 'page/academic/c_study_planning';


$route['academic/reference'] = 'page/academic/C_reference';

$route['academic/__setPageJadwal'] = 'page/academic/c_jadwal/setPageJadwal';

// --- Modal Academic ----
$route['academic/modal-tahun-akademik-detail-prodi'] = 'page/academic/c_akademik/modal_tahun_akademik_detail_prodi';
$route['academic/modal-tahun-akademik-detail-lecturer'] = 'page/academic/c_akademik/modal_tahun_akademik_detail_lecturer';

// ======= human-resources ======
$route['human-resources/lecturers'] = 'page/database/c_database/lecturers';
$route['human-resources/employees'] = 'page/database/c_database/employees';

// ====== Database =====
$route['database/lecturers'] = 'page/database/c_database/lecturers';
$route['database/lecturer-details/(:any)'] = 'page/database/c_database/lecturersDetails/$1';
$route['database/loadpagelecturersDetails'] = 'page/database/c_database/loadpagelecturersDetails';
$route['database/students'] = 'page/database/c_database/students';
$route['database/showStudent'] = 'page/database/c_database/showStudent';
$route['database/employees'] = 'page/database/c_database/employees';


// --- Admission ----
// --- Master ----
$route['admission/master-sma'] = 'page/admission/c_master/sma';
$route['admission/master-sma/integration'] = 'page/admission/c_master/sma_integration';
$route['admission/master-sma/table'] = 'page/admission/c_master/sma_table';
$route['admission/master-config/set-email'] = 'page/admission/c_master/config_set_email';
$route['admission/master-config/testing_email'] = 'page/admission/c_master/testing_email';
$route['admission/master-config/save_email'] = 'page/admission/c_master/save_email';
$route['admission/master-config/total-account'] = 'page/admission/c_master/total_account';
$route['admission/master-config/loadTableTotalAccount'] = 'page/admission/c_master/load_table_total_account';
$route['admission/master-config/modalform/(:any)'] = 'page/admission/c_master/modalform/$1';
$route['admission/master-config/submit_count_account'] = 'page/admission/c_master/submit_count_account';
$route['admission/master-config/email-to'] = 'page/admission/c_master/email_to';
$route['admission/master-config/loadTableEmailTo'] = 'page/admission/c_master/load_table_email_to';
$route['admission/master-config/submit_email_to'] = 'page/admission/c_master/submit_email_to';
$route['admission/master-config/lama-pembayaran'] = 'page/admission/c_master/lama_pembayaran';
$route['admission/master-config/loadTableMaster/(:any)'] = 'page/admission/c_master/load_table_master/$1';
$route['admission/master-config/submit_lama_pembayaran'] = 'page/admission/c_master/submit_lama_pembayaran';
$route['admission/master-registration/harga-formulir/online'] = 'page/admission/c_master/harga_formulir_online';
$route['admission/master-config/submit_harga_formulir_online'] = 'page/admission/c_master/submit_harga_formulir_online';
$route['admission/master-registration/harga-formulir/offline'] = 'page/admission/c_master/harga_formulir_offline';
$route['admission/master-config/submit_harga_formulir_offline'] = 'page/admission/c_master/submit_harga_formulir_offline';
$route['admission/master-global/wilayah'] = 'page/admission/c_master/global_wilayah';
$route['admission/master-config/loadTableMasterNoAction/(:any)'] = 'page/admission/c_master/loadTableMasterNoAction/$1';
$route['admission/master-global/jenis-tempat-tinggal'] = 'page/admission/c_master/jenis_tempat_tinggal';
$route['admission/master-config/submit_jenis_tempat_tinggal'] = 'page/admission/c_master/submit_jenis_tempat_tinggal';
$route['admission/master-global/pendapatan'] = 'page/admission/c_master/pendapatan';
$route['admission/master-config/submit_Pendapatan'] = 'page/admission/c_master/submit_pendapatan';
$route['admission/master-global/agama'] = 'page/admission/c_master/agama';
$route['admission/master-global/loadTableMasterAgama'] = 'page/admission/c_master/load_table_master_agama';
$route['admission/master-global/tipe-sekolah'] = 'page/admission/c_master/tipe_sekolah';
$route['admission/master-global/loadTableMasterTipeSekolah'] = 'page/admission/c_master/load_table_tipe_sekolah';
$route['admission/master-registration/document-checklist'] = 'page/admission/c_master/document_checklist';
$route['admission/master-registration/submit_document_checklist'] = 'page/admission/c_master/submit_document_checklist';
$route['admission/master-registration/number-formulir/online'] = 'page/admission/c_master/formulir_online';
$route['admission/master-registration/loadDataFormulirOnline'] = 'page/admission/c_master/loadDataFormulirOnline';
$route['admission/master-registration/getJsonFormulirOnline'] = 'page/admission/c_master/get_json_formulir_online';
$route['admission/master-registration/GenerateFormulirOnline'] = 'page/admission/c_master/generate_formulir_online';
$route['admission/master-registration/number-formulir/offline'] = 'page/admission/c_master/formulir_offline';
$route['admission/master-registration/loadDataFormulirOffline'] = 'page/admission/c_master/loadDataFormulirOffline';
$route['admission/master-registration/getJsonFormulirOffline'] = 'page/admission/c_master/get_json_formulir_offline';
$route['admission/master-registration/GenerateFormulirOffline'] = 'page/admission/c_master/generate_formulir_offline';
$route['admission/master-registration/jacket-size'] = 'page/admission/c_master/jacket_size';
$route['admission/master-register/submit_jacket_size'] = 'page/admission/c_master/submit_jacket_size';
$route['admission/master-global/jurusan-sekolah'] = 'page/admission/c_master/jurusan_sekolah';
$route['admission/master-config/submit_jurusan_sekolah'] = 'page/admission/c_master/submit_jurusan_sekolah';
$route['admission/master-registration/ujian-masuk-per-prody'] = 'page/admission/c_master/ujian_masuk_per_prody';
$route['admission/master-registration/ujian-masuk-per-prody/modalform'] = 'page/admission/c_master/modalform_ujian_masuk_per_prody';
$route['admission/master-registration/ujian-masuk-per-prody/loadTable'] = 'page/admission/c_master/table_ujian_masuk_per_prody';

$route['admission/master-registration/ujian-masuk-per-prody/submit'] = 'page/admission/c_master/submit_ujian_masuk_per_prody';


$route['admission/proses-calon-mahasiswa/verifikasi-dokumen'] = 'page/admission/c_admission/verifikasi_dokumen_calon_mahasiswa';
$route['admission/proses-calon-mahasiswa/verifikasi-dokument/register_document_table/pagination/(:num)'] = 'page/admission/c_admission/pagination_calon_mahasiswa/$1';
$route['admission/proses-calon-mahasiswa/verifikasi-dokument/proses_document'] = 'page/admission/c_admission/proses_document';

$route['admission/distribusi-formulir/formulir-offline'] = 'page/admission/c_admission/distribusi_formulir_offline';
$route['admission/distribusi-formulir/formulir-offline/pagination/(:num)'] = 'page/admission/c_admission/pagination_formulir_offline/$1';
$route['admission/distribusi-formulir/formulir-offline/submit_sellout'] = 'page/admission/c_admission/submit_sellout_formulir_offline/$1';


// ---Finance----
$route['finance/penerimaan-pembayaran/verifikasi-pembayaran/registration_online'] =  'page/finance/c_finance/verfikasi_pembayaran_registration_online';
$route['finance/confirmed-verifikasi-pembayaran-registration_online'] =  'page/finance/c_finance/confirmed_verfikasi_pembayaran_registration_online';


// ---global---
$route['loadDataRegistrationUpload'] =  'api/C_global/load_data_registration_upload';
$route['loadDataRegistrationVerified'] =  'api/C_global/load_data_registration_verified';


// ====== API ======
$route['api/__getKurikulumByYear'] = 'api/c_api/getKurikulumByYear';
$route['api/__getBaseProdi'] = 'api/c_api/getProdi';
$route['api/__getBaseProdiSelectOption'] = 'api/c_api/getProdiSelectOption';
$route['api/__getBaseProdiSelectOptionAll'] = 'api/c_api/getProdiSelectOptionAll';
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

$route['api/__crudSchedule'] = 'api/c_api/crudSchedule';

$route['api/__crudProgramCampus'] = 'api/c_api/crudProgramCampus';
$route['api/__crudSemester'] = 'api/c_api/crudSemester';

$route['api/__getAllStudents'] = 'api/c_api/getAllStudents';

$route['api/__crudeStudent'] = 'api/c_api/crudeStudent';
$route['api/__getClassGroup'] = 'api/c_api/getClassGroup';

$route['api/__crudClassroom'] = 'api/c_api/crudClassroom';
$route['api/__crudGrade'] = 'api/c_api/crudGrade';
$route['api/__crudRangeCredits'] = 'api/c_api/crudRangeCredits';
//$route['api/__crudStdSemester'] = 'api/c_api/crudStdSemester';
$route['api/__crudTimePerCredit'] = 'api/c_api/crudTimePerCredit';
$route['api/__checkSchedule'] = 'api/c_api/checkSchedule';

$route['api/__crudCourseOfferings'] = 'api/c_api/crudCourseOfferings';
$route['api/__crudLecturer'] = 'api/c_api/crudLecturer';
$route['api/__crudStudyPlanning'] = 'api/c_api/crudStudyPlanning';

// get data SMA dan SMK per Wilayah
$route['api/__insertWilayahURLJson'] = 'api/c_api/insertWilayahURLJson';
$route['api/__insertSchoolURLJson'] = 'api/c_api/insertSchoolURLJson';
$route['api/__getWilayahURLJson'] = 'api/c_api/getWilayahURLJson';
$route['api/__getSMAWilayah'] = 'api/c_api/getSMAWilayah';

// get data untuk finance
$route['api/__getDataRegisterUpload'] = 'api/c_api/getDataRegisterUpload';
$route['api/__getDataRegisterVerified'] = 'api/c_api/getDataRegisterVerified';

 $route['rest/__checkDateKRS'] = 'api/c_rest/checkDateKRS';
 $route['rest/__getDetailKRS'] = 'api/c_rest/getDetailKRS';