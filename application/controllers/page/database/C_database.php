<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_database extends MY_Controller {

    function __construct()
    {
        parent::__construct();
//        $this->session->set_userdata('departement_nav', 'academic');
        $this->load->model('database/m_database');
//        $this->load->library('JWT');
    }


    public function temp($content)
    {
        parent::template($content);
    }


    public function lecturers()
    {
        $dt = array(
            'ID' => 123,
            'Name' => 'Nandang Mulyadi'
        );
        $key = 'PUCUY';
        $data['jwt'] = $this->jwt->encode($dt,$key);

        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTMzNywidXNlcm5hbWUiOiJOYW5kYW5nIE11bHlhZGkifQ.1aZjVTXydpoZtYjWUnumzEHiaQJ8tLCYJ-dmbiBKCbQ';
        $key2 = 'Nandang Mulyadi';
        $data['jwt_'] = $this->jwt->decode($token,$key2);

//        print_r($data['jwt']);
//        print_r($data['jwt_']);
//        exit;
        $content = $this->load->view('page/database/lecturers',$data,true);
        $this->temp($content);
    }

    public function lecturersDetails($NIP){
        $data['NIP']=$NIP;
        $content = $this->load->view('page/database/lecturer/lecturer_menu',$data,true);
        $this->temp($content);
    }

    public function loadpagelecturersDetails(){
        $page = $this->input->post('page');
        $data['NIP'] = $this->input->post('NIP');
        $this->load->view('page/database/lecturer/'.$page,$data);
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


    // Modal Show Detail Mahasiswa
    public function showStudent(){
        $data['token'] = $this->input->post('token');
        $this->load->view('page/database/modal/modal_detail_student',$data);
    }



}
