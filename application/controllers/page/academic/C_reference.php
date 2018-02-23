<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_reference extends MY_Controller {

    function __construct()
    {
        parent::__construct();
//        $this->load->model('akademik/m_tahun_akademik');
    }


    public function temp($content)
    {
        parent::template($content);
    }

    public function index()
    {
        $data['department'] = parent::__getDepartement();
        $content = $this->load->view('page/'.$data['department'].'/reference/tab_reference',$data,true);
        $this->temp($content);
    }

}
