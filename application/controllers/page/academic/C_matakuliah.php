<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_matakuliah extends MY_Controller {

    function __construct()
    {
        parent::__construct();
//        $this->session->set_userdata('departement_nav', 'academic');
        $this->load->model('m_matakuliah');
    }


    public function temp($content)
    {
        parent::template($content);
    }

    public function mata_kuliah()
    {
        $department = parent::__getDepartement();
        $data['data_mk'] = $this->m_matakuliah->__getAllMK();
        $content = $this->load->view('page/'.$department.'/mata_kuliah',$data,true);
        $this->temp($content);
    }

}
