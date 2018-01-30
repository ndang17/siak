<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_tahun_akademik extends MY_Controller {

    function __construct()
    {
        parent::__construct();
//        $this->session->set_userdata('departement_nav', 'academic');
        $this->load->model('akademik/m_tahun_akademik');
    }


    public function temp($content)
    {
        parent::template($content);
    }

    public function tahun_akademik()
    {
        $data['department'] = parent::__getDepartement();

//        print_r($data['kurikulum']);
        $content = $this->load->view('page/'.$data['department'].'/tahunakademik/tahun_akademik',$data,true);
        $this->temp($content);
    }

    public function tahun_akademik_table(){
        $data['department'] = parent::__getDepartement();
        $data['semester'] = $this->m_tahun_akademik->__getSemester();
        $this->load->view('page/'.$data['department'].'/tahunakademik/tahun_akademik_table',$data);
    }

    public function page_detail_tahun_akademik(){
        $data['department'] = parent::__getDepartement();
        $data['ID'] = $this->input->post('ID');
        $this->load->view('page/'.$data['department'].'/tahunakademik/detail_tahun_akademik',$data);


    }

    public function tahun_akademik_detail($detail)
    {
        $data['department'] = parent::__getDepartement();
        $data['semester'] = $detail;
//        print_r($data['kurikulum']);
        $content = $this->load->view('page/'.$data['department'].'/tahun_akademik_detail',$data,true);
        $this->temp($content);
    }

    public function tahun_akademik_detail2(){
        $data_json = $this->input->post('data_json');
        $data['department'] = parent::__getDepartement();

        $data['data_json'] = $data_json;

        $this->load->view('page/'.$data['department'].'/tahun_akademik_detail',$data);
    }

    public function tahun_akademik_detail_date(){
        $data_json = $this->input->post('data_json');
        $data['department'] = parent::__getDepartement();

        $data['data_json'] = $data_json;

        $this->load->view('page/'.$data['department'].'/tahun_akademik_detail_date',$data);
    }


    // ==== Modal ====
    public function modal_tahun_akademik(){

        $data['action'] = $this->input->post('action');
        $data['id'] = $this->input->post('id');
        $data['department'] = parent::__getDepartement();
        $data['tahun'] = '';
        $data['itemTahunAkademik'] = [];

        $data['ProgramCampusID'] = '';
        $data['semester'] = '';
        if($data['action']!='add'){
            $data['itemTahunAkademik'] = $this->m_tahun_akademik->__getDataTahunAkademik($data['id']);
            if(count($data['itemTahunAkademik'])>0){
                $exp = explode(' ',$data['itemTahunAkademik'][0]['Name']);
                $data['tahun'] = trim($exp[0]);
                $data['ProgramCampusID'] = $data['itemTahunAkademik'][0]['ProgramCampusID'];
                $data['semester'] = substr($data['itemTahunAkademik'][0]['YearCode'],-1);
            }
        }

//        print_r($data['itemTahunAkademik']);

        $this->load->view('page/'.$data['department'].'/tahunakademik/modal_tahun_akademik',$data);

    }

}
