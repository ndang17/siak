<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_akademik extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->session->set_userdata('departement_nav', 'academic');
        $this->load->model('m_kurikulum');
    }


    public function temp($content)
    {
        parent::template($content);
    }

    public function tahun_akademik()
    {
        $data['department'] = parent::__getDepartement();
        $data['kurikulum'] = $this->m_kurikulum->__getKurikulum();
//        print_r($data['kurikulum']);
        $data['last_kurikulum'] = $data['kurikulum'][0]['Year'];
        $content = $this->load->view('page/'.$data['department'].'/tahun_akademik',$data,true);
        $this->temp($content);
    }

    public function tahun_akademik_detail(){
        $data_json = $this->input->post('data_json');
        $data['department'] = parent::__getDepartement();

        $data['data_json'] = $data_json;

        $this->load->view('page/'.$data['department'].'/tahun_akademik_detail',$data);
    }

    public function ketersediaan_dosen()
    {
        $department = parent::__getDepartement();
        $content = $this->load->view('page/'.$department.'/ketersediaan_dosen','',true);
        $this->temp($content);
    }


    // ===== MODAL ======

    public function modal_tahun_akademik_detail_prodi(){
        $data['department'] = parent::__getDepartement();
        $this->load->view('page/'.$data['department'].'/modal/modal_tahun_akademik_detail_prodi',$data);
    }

    public function modal_tahun_akademik_detail_lecturer(){
        $data['department'] = parent::__getDepartement();
        $this->load->view('page/'.$data['department'].'/modal/modal_tahun_akademik_detail_lecturer',$data);
    }

    // ===== /MODAL =====










}
