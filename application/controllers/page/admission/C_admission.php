<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admission extends MY_Controller {
    public $data = array();

    function __construct()
    {
        parent::__construct();
        $this->load->model('master/m_master');
        $this->load->model('admission/m_admission');
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

        $this->load->library('pagination');
        $config = array();
          $config["base_url"] = "#";
          $config["total_rows"] =  $this->m_admission->count_calon_mahasiswa();
          $config["per_page"] = 1;
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
        $this->data['datadb'] = $this->m_admission->selectDataCalonMahasiswa($config["per_page"], $start);
       $content = $this->load->view('page/'.$this->data['department'].'/proses_calon_mahasiswa/page_verifikasi_dokumen',$this->data,true);

        $output = array(
        'pagination_link'  => $this->pagination->create_links(),
        'register_document_table'   => $content,
        );
        echo json_encode($output);
        
    }

}
