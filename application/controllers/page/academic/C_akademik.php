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
