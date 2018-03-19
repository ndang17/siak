<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admission extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('akademik/m_akademik');
    }


    public function temp($content)
    {
        parent::template($content);
    }

    public function index()
    {
        $data['department'] = parent::__getDepartement();
        $content = "test";
        $this->temp($content);
        
    }

}
