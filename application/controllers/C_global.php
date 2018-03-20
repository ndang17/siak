<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_global extends CI_Controller {

    private $data = array();

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_sendemail');
        $this->load->model('m_api');
        $this->load->library('JWT');
        $this->load->model('master/m_master');
    }

    public function getInputToken()
    {
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);
        return $data_arr;
    }

    public function load_data_registration_upload()
    {
        $content = $this->load->view('page/load_data_registration_upload',$this->data,true);
        echo $content;
    }

}
