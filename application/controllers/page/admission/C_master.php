<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_master extends MY_Controller {

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

    public function sma()
    {
        $data['department'] = parent::__getDepartement();
        $content = $this->load->view('page/'.$data['department'].'/master/sma',$data,true);
        //$content = "test";
        $this->temp($content);
        //echo "test";
    }

    public function sma_integration()
    {
        $data['department'] = parent::__getDepartement();
        $content = $this->load->view('page/'.$data['department'].'/master/sma_integration',$data,true);
        //$content = "test";
        $this->temp($content);

    }

}
