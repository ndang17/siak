<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_database extends MY_Controller {

    function __construct()
    {
        parent::__construct();
//        $this->session->set_userdata('departement_nav', 'academic');
        $this->load->model('database/m_database');
    }


    public function temp($content)
    {
        parent::template($content);
    }


    public function lecturers()
    {
        $content = $this->load->view('page/database/lecturers','',true);
        $this->temp($content);
    }

    public function students()
    {

        $content = $this->load->view('page/database/students','',true);
        $this->temp($content);
    }

    public function employees()
    {

        $content = $this->load->view('page/database/employees','',true);
        $this->temp($content);
    }



}
