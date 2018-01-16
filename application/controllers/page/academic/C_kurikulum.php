<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kurikulum extends MY_Controller {

    function __construct()
    {
        parent::__construct();
//        $this->session->set_userdata('departement_nav', 'academic');
        $this->load->model('akademik/m_kurikulum');
    }


    public function temp($content)
    {
        parent::template($content);
    }

    public function kurikulum()
    {
        $data['department'] = parent::__getDepartement();
        $data['kurikulum'] = $this->m_kurikulum->__getKurikulum();
//        print_r($data['kurikulum']);
        $data['last_kurikulum'] = $data['kurikulum'][0]['Year'];
//        $content = $this->load->view('page/'.$data['department'].'/kurikulum',$data,true);
        $content = $this->load->view('page/'.$data['department'].'/kurikulum/kurikulum',$data,true);
        $this->temp($content);
    }

    public function kurikulum_detail(){

        $data['department'] = parent::__getDepartement();
        $this->load->view('page/'.$data['department'].'/kurikulum/kurikulum_detail',$data);
    }

    public function tes(){
        $data = $this->m_kurikulum->__getMKFromKurikulum(2016);

        print_r($data);
    }

    public function kurikulum_detail2(){
        $data_json = $this->input->post('data_json');
        $data['department'] = parent::__getDepartement();

        $data['data_json'] = $data_json;

        $this->load->view('page/'.$data['department'].'/kurikulum_detail',$data);
    }

    public function kurikulum_detail_mk(){
        $data_json = $this->input->post('data_json');
        $data['department'] = parent::__getDepartement();

        $data['data_json'] = $data_json;

        $this->load->view('page/'.$data['department'].'/kurikulum_detail_mk',$data);
    }


    // ========= API =========
    public function __getKurikulumByYear(){

    }






}
