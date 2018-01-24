<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_akademik extends MY_Controller {

    function __construct()
    {
        parent::__construct();
//        $this->session->set_userdata('departement_nav', 'academic');
        $this->load->model('akademik/m_akademik');
    }


    public function temp($content)
    {
        parent::template($content);
    }


    public function ketersediaan_dosen()
    {
        $department = parent::__getDepartement();
        $content = $this->load->view('page/'.$department.'/ketersediaandosen/ketersediaan_dosen','',true);
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

    public function Modal_KetersediaanDosen(){

        $ID = $this->input->post('ID');
        $data['department'] = parent::__getDepartement();
        $data['dataDosen'] = $this->m_akademik->__getKetersediaanDosen($ID);
        $this->load->view('page/'.$data['department'].'/ketersediaandosen/modal_ketersediaan_dosen',$data);

    }
    // ===== /MODAL =====










}
