<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admission extends MY_Controller {
    public $data = array();

    function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_master');
        $this->load->model('admission/m_admission');
        $this->load->model('m_sendemail');
        $this->data['department'] = parent::__getDepartement();
    }


    public function temp($content)
    {
        parent::template($content);
    }

    public function getInputToken()
    {
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);
        return $data_arr;
    }

    public function index()
    {
        $data['department'] = parent::__getDepartement();
        $content = "test";
        $this->temp($content);
        
    }

    public function verifikasi_dokumen_calon_mahasiswa()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/proses_calon_mahasiswa/verifikasi_dokumen_calon_mahasiswa',$this->data,true);
        $this->temp($content);
    }

    public function pagination_calon_mahasiswa($page= null)
    {
        $input =  $this->getInputToken();
        $tahun = $input['selectTahun'];
        $nama = $input['NamaCandidate'];
        $status = $input['selectStatus'];

        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = "#";
        $config["total_rows"] =  $this->m_admission->count_calon_mahasiswa();
        $config["per_page"] = 2;
        $config["uri_segment"] = 6;
        $config["use_page_numbers"] = TRUE;
        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config['next_link'] = '&gt;';
        $config["next_tag_open"] = '<li>';
        $config["next_tag_close"] = '</li>';
        $config["prev_link"] = "&lt;";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='#'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $config["num_links"] = 1;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(6);
        $start = ($page - 1) * $config["per_page"];
        $this->data['datadb'] = $this->m_admission->selectDataCalonMahasiswa($config["per_page"], $start,$tahun,$nama,$status);
       $content = $this->load->view('page/'.$this->data['department'].'/proses_calon_mahasiswa/page_verifikasi_dokumen',$this->data,true);

        $output = array(
        'pagination_link'  => $this->pagination->create_links(),
        'register_document_table'   => $content,
        );
        echo json_encode($output);
        
    }

    public function proses_document()
    {
    $max_execution_time = 1000;
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', $max_execution_time); //60 seconds = 1 minutes
      $input = $this->getInputToken();
      $action = $input['action'];
      $data = $input['data_passing'];
      $data_arr = explode(",", $data);
      $Status = "Reject";
      if ($action ==  'approve') {
        $Status = "Done";
      }
      else
      {
        $Status = "Reject";
      }

      $this->m_admission->updateStatusVeriDokumen($data_arr,$Status);
      $temp = explode(";", $data_arr[0]);
      $ID_register_document = $temp[0];
      if ($ID_register_document == 'nothing') {
          $temp = explode(";", $data_arr[1]);
          $ID_register_document = $temp[0];
      }
      $this->m_admission->data['ID_register_document'] = $ID_register_document;
      $keyURL = $this->m_admission->getKeylinkURLFormulirRegistration();
      $keyURL = $this->m_admission->data['callback'];

      // send email
      if ($Status == "Reject") {
          $text = 'Dear Candidate,<br><br>
                      You have document not approved yet, Please send your valid document.<br>
                      '.$this->GlobalVariableAdi['url_registration']."formulir-registration/".$keyURL['url'].'
                  ';
          $to = $keyURL['email'];
          $subject = "Link Formulir Registration Podomoro University";
          $sendEmail = $this->m_sendemail->sendEmail($to,$subject,null,null,null,null,$text);        
      }
      else
      { 
        // check status if all done
        $check = $this->m_admission->checkAllstatusDoneVeriDoc($ID_register_document);
        if ($check) {
            $text = 'Dear Candidate,<br><br>
                        You have finished your all required document.<br>
                        '.$this->GlobalVariableAdi['url_registration']."formulir-registration/".$keyURL['url'].'
                    ';
            $to = $keyURL['email'];
            $subject = "Link Formulir Registration Podomoro University";
            $sendEmail = $this->m_sendemail->sendEmail($to,$subject,null,null,null,null,$text);   
        }

      }

    }

    public function distribusi_formulir_offline()
    {
      $content = $this->load->view('page/'.$this->data['department'].'/distribusi_formulir/formulir_offline',$this->data,true);
      $this->temp($content);
    }

    public function distribusi_formulir_online()
    {
      $content = $this->load->view('page/'.$this->data['department'].'/distribusi_formulir/formulir_online',$this->data,true);
      $this->temp($content);
    }

    public function pagination_formulir_online($page= null)
    {
       $input =  $this->getInputToken();
       // print_r($input);
       $tahun = $input['selectTahun'];
       $NomorFormulir = $input['NomorFormulir'];
       $status = $input['selectStatus'];

       $this->load->library('pagination');
       $config = array();
       $config["base_url"] = "#";
       $config["total_rows"] =  $this->m_admission->totalDataFormulir_online();
       $config["per_page"] = 15;
       $config["uri_segment"] = 5;
       $config["use_page_numbers"] = TRUE;
       $config["full_tag_open"] = '<ul class="pagination">';
       $config["full_tag_close"] = '</ul>';
       $config["first_tag_open"] = '<li>';
       $config["first_tag_close"] = '</li>';
       $config["last_tag_open"] = '<li>';
       $config["last_tag_close"] = '</li>';
       $config['next_link'] = '&gt;';
       $config["next_tag_open"] = '<li>';
       $config["next_tag_close"] = '</li>';
       $config["prev_link"] = "&lt;";
       $config["prev_tag_open"] = "<li>";
       $config["prev_tag_close"] = "</li>";
       $config["cur_tag_open"] = "<li class='active'><a href='#'>";
       $config["cur_tag_close"] = "</a></li>";
       $config["num_tag_open"] = "<li>";
       $config["num_tag_close"] = "</li>";
       $config["num_links"] = 1;

       $this->pagination->initialize($config);
       $page = $this->uri->segment(5);
       $start = ($page - 1) * $config["per_page"];
       $this->data['datadb'] = $this->m_admission->selectDataDitribusiFormulirOnline($config["per_page"], $start,$tahun,$NomorFormulir,$status);
      $content = $this->load->view('page/'.$this->data['department'].'/distribusi_formulir/tabel_formulir_online',$this->data,true);

       $output = array(
       'pagination_link'  => $this->pagination->create_links(),
       'tabel_formulir_online'   => $content,
       );
       echo json_encode($output);
    }

    public function pagination_formulir_offline($page= null)
    {
       $input =  $this->getInputToken();
       // print_r($input);
       $tahun = $input['selectTahun'];
       $NomorFormulir = $input['NomorFormulir'];
       $NamaStaffAdmisi = $input['NamaStaffAdmisi'];
       $status = $input['selectStatus'];

       $this->load->library('pagination');
       $config = array();
       $config["base_url"] = "#";
       $config["total_rows"] =  $this->m_admission->totalDataFormulir_offline();
       $config["per_page"] = 15;
       $config["uri_segment"] = 5;
       $config["use_page_numbers"] = TRUE;
       $config["full_tag_open"] = '<ul class="pagination">';
       $config["full_tag_close"] = '</ul>';
       $config["first_tag_open"] = '<li>';
       $config["first_tag_close"] = '</li>';
       $config["last_tag_open"] = '<li>';
       $config["last_tag_close"] = '</li>';
       $config['next_link'] = '&gt;';
       $config["next_tag_open"] = '<li>';
       $config["next_tag_close"] = '</li>';
       $config["prev_link"] = "&lt;";
       $config["prev_tag_open"] = "<li>";
       $config["prev_tag_close"] = "</li>";
       $config["cur_tag_open"] = "<li class='active'><a href='#'>";
       $config["cur_tag_close"] = "</a></li>";
       $config["num_tag_open"] = "<li>";
       $config["num_tag_close"] = "</li>";
       $config["num_links"] = 1;

       $this->pagination->initialize($config);
       $page = $this->uri->segment(5);
       $start = ($page - 1) * $config["per_page"];
       $this->data['datadb'] = $this->m_admission->selectDataDitribusiFormulirOffline($config["per_page"], $start,$tahun,$NomorFormulir,$NamaStaffAdmisi,$status);
      $content = $this->load->view('page/'.$this->data['department'].'/distribusi_formulir/tabel_formulir_offline',$this->data,true);

       $output = array(
       'pagination_link'  => $this->pagination->create_links(),
       'tabel_formulir_offline'   => $content,
       );
       echo json_encode($output);
    }

    public function submit_sellout_formulir_offline()
    {
      $input = $this->getInputToken();
      $action = $input['action'];
      $data = $input['data_passing'];
      $data_arr = explode(",", $data);
      $this->m_admission->updateSelloutFormulir($data_arr);
    }

    public function set_jadwal_ujian()
    {
      $content = $this->load->view('page/'.$this->data['department'].'/proses_calon_mahasiswa/set_jadwal_ujian',$this->data,true);
      $this->temp($content);
    }

    public function set_jadwal_ujian_load_table()
    {
       $content = $this->load->view('page/'.$this->data['department'].'/proses_calon_mahasiswa/set_jadwal_ujian_load_table',$this->data,true);
       echo json_encode($content);
    }

    public function set_jadwal_ujian_load_table_getJsonApi()
    {
      $generate = $this->m_admission->getJadwalUjian();
      return print_r(json_encode($generate));
    }

    public function set_jadwal_ujian_save()
    {
      $max_execution_time = 1000;
      ini_set('memory_limit', '-1');
      ini_set('max_execution_time', $max_execution_time); //60 
      $result = array('msg' => '');
      $input = $this->getInputToken();
      $ID_ProgramStudy = $input['program_study'];
      $DateTimeTest = $input['datetime_ujian'];
      $Lokasi = $input['Lokasi'];
      // $check = $this->m_admission->checKjadwalMasihActive($ID_ProgramStudy,$DateTimeTest);

      // save data di register_jadwal_ujian dan return array ID nya
      // get Data ID ujian_perprody
      $arr_ID_ujian_per_prody = $this->m_admission->get_arr_ID_ujian_per_prody($ID_ProgramStudy);
      $result['msg'] = $arr_ID_ujian_per_prody['result'];
      if ($result['msg'] == '') {
        $proses = $this->m_admission->saveDataJadwalUjian_returnArr($arr_ID_ujian_per_prody,$DateTimeTest,$Lokasi);

        // get ID formulir berdasarkan ID_ProgramStudy
        $arr_ID_register_formulir = $this->m_admission->getID_register_formulir_programStudy_arr($proses);
        if (count($arr_ID_register_formulir) > 0) {
          // insert data di register_formulir_jadwal_ujian
          // gunakan try catch untuk continue data karena unique
          $this->m_admission->saveDataregister_formulir_jadwal_ujian($arr_ID_register_formulir);

        }
      }
      
      return print_r(json_encode($result));

    }

    public function daftar_jadwal_ujian()
    {
      $content = $this->load->view('page/'.$this->data['department'].'/proses_calon_mahasiswa/daftar_jadwal_ujian',$this->data,true);
      $this->temp($content);
    }

    public function daftar_jadwal_ujian_load_data_now()
    {
      $generate = $this->m_admission->daftar_jadwal_ujian_load_data_now();
      return print_r(json_encode($generate));
    }

    public function daftar_jadwal_ujian_load_data_paging($page= null)
    {
        $input =  $this->getInputToken();
        $Nama = $input['Nama'];
        $FormulirCode = $input['FormulirCode'];

        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = "#";
        $config["total_rows"] =  1000;
        $config["per_page"] = 5;
        $config["uri_segment"] = 6;
        $config["use_page_numbers"] = TRUE;
        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config['next_link'] = '&gt;';
        $config["next_tag_open"] = '<li>';
        $config["next_tag_close"] = '</li>';
        $config["prev_link"] = "&lt;";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='#'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $config["num_links"] = 1;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(6);
        $start = ($page - 1) * $config["per_page"];
        $this->data['datadb'] = $this->m_admission->daftar_jadwal_ujian_load_data_paging($config["per_page"], $start,$Nama,$FormulirCode);
       $this->data['no'] = $start + 1;
       $content = $this->load->view('page/'.$this->data['department'].'/proses_calon_mahasiswa/daftar_jadwal_ujian_load_data_paging',$this->data,true);

        $output = array(
        'pagination_link'  => $this->pagination->create_links(),
        'loadtable'   => $content,
        );
        echo json_encode($output);
        
    }

    public function set_nilai_ujian()
    {
      $content = $this->load->view('page/'.$this->data['department'].'/proses_calon_mahasiswa/set_nilai_ujian',$this->data,true);
      $this->temp($content);
    }

    public function set_nilai_ujian_load_data_paging($page = null)
    {
       $input =  $this->getInputToken();
       $Nama = $input['selectPrody'];
       $selectPrody = $input['selectPrody'];

       $this->load->library('pagination');
       $config = array();
       $config["base_url"] = "#";
       $config["total_rows"] =  1000;
       $config["per_page"] = 5;
       $config["uri_segment"] = 6;
       $config["use_page_numbers"] = TRUE;
       $config["full_tag_open"] = '<ul class="pagination">';
       $config["full_tag_close"] = '</ul>';
       $config["first_tag_open"] = '<li>';
       $config["first_tag_close"] = '</li>';
       $config["last_tag_open"] = '<li>';
       $config["last_tag_close"] = '</li>';
       $config['next_link'] = '&gt;';
       $config["next_tag_open"] = '<li>';
       $config["next_tag_close"] = '</li>';
       $config["prev_link"] = "&lt;";
       $config["prev_tag_open"] = "<li>";
       $config["prev_tag_close"] = "</li>";
       $config["cur_tag_open"] = "<li class='active'><a href='#'>";
       $config["cur_tag_close"] = "</a></li>";
       $config["num_tag_open"] = "<li>";
       $config["num_tag_close"] = "</li>";
       $config["num_links"] = 1;

       $this->pagination->initialize($config);
       $page = $this->uri->segment(6);
       $start = ($page - 1) * $config["per_page"];
       $this->data['datadb'] = $this->m_admission->daftar_set_nilai_ujian_load_data_paging($config["per_page"], $start,$selectPrody);
       $this->data['mataujian'] = $this->m_admission->select_mataUjian($selectPrody);
       $this->data['grade'] = json_encode($this->m_admission->showData('db_academic.grade'));
      $this->data['no'] = $start + 1;
      $content = $this->load->view('page/'.$this->data['department'].'/proses_calon_mahasiswa/daftar_nilai_ujian_load_data_paging',$this->data,true);

       $output = array(
       'pagination_link'  => $this->pagination->create_links(),
       'loadtable'   => $content,
       );
       echo json_encode($output);
    }

    public function set_nilai_ujian_save()
    {
      $input = $this->getInputToken();
      $this->m_admission->saveDataNilaiUjian($input);
      echo json_encode( array('msg' => 'Data berhasil disimpan') );
    }
}
