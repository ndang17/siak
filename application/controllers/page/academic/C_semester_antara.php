<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_semester_antara extends MY_Controller {

    function __construct()
    {
        parent::__construct();
//        $this->session->set_userdata('departement_nav', 'academic');
        $this->load->model('akademik/m_matakuliah');
    }


    public function temp($content)
    {
        parent::template($content);
    }

    public function index()
    {
        $department = parent::__getDepartement();
//        $data['data_mk'] = $this->m_matakuliah->__getAllMK();
        $content = $this->load->view('page/'.$department.'/semesterantara/semester_antara','',true);
        $this->temp($content);
    }

    public function loadDetails($SA_ID){
        $department = parent::__getDepartement();
        $data['SA_ID'] =$SA_ID;
        $this->load->view('page/'.$department.'/semesterantara/details_sa',$data);

    }


}
