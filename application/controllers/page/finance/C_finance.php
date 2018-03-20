<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_finance extends MY_Controller {

    private $data = array();

    function __construct()
    {
        parent::__construct();
        $this->data['department'] = parent::__getDepartement();
    }


    public function temp($content)
    {
        parent::template($content);
    }

    public function getInputToken()
    {
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);
        return $data_arr;
    }

    public function index()
    {
        $data['department'] = parent::__getDepartement();
        $content = "test";
        $this->temp($content);
    }

    public function verfikasi_pembayaran_registration_online()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/penerimaan_pembayaran/verfikasi_pembayaran_registration_online',$this->data,true);
        $this->temp($content);
    }


}
