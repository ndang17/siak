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
        $action = $this->input->post('action');
        $data['department'] = parent::__getDepartement();

        $this->load->view('page/'.$data['department'].'/tahunakademik/modal_tahun_akademik',$data);
    }

}
