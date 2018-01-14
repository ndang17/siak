<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends MY_Controller {



    public function temp($content)
    {
        parent::template($content);
    }

    public function index()
    {
        $data['department'] = parent::__getDepartement();
        $content = $this->load->view('dashboard/dashboard',$data,true);
        $this->temp($content);
    }

    public function change_departement(){
        $dpt = $this->input->post('departement');
        parent::__setDepartement($dpt);
    }

    public function profile($username=''){
        $data['']=123;
        $content = $this->load->view('dashboard/profile','',true);
        $this->temp($content);
    }


}
