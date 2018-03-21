<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_rest extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        $this->load->model('m_api');
        $this->load->model('akademik/m_tahun_akademik');
        $this->load->library('JWT');
        $this->load->library('google');
    }

    private function cekAuthAPI($dataAuth){

        $auth = (array) $dataAuth;

        if($auth['user']=='students'){
            $db = 'db_academic.auth_students';
        } else {
            $db = 'db_employees.employees';
        }

        $data = $this->db->get_where($db, array('Password' => $auth['token']))->result_array();

        if(count($data)>0){
            return true;
        } else {
            return false;
        }

    }

    function checkDateKRS(){
        $token = $this->input->post('token');
        $key = "s3Cr3T-G4N";
        $dataToken = (array) $this->jwt->decode($token,$key);

        $cekUser = $this->cekAuthAPI($dataToken['auth']);

        if($cekUser){
            $data = $this->m_api->__checkDateKRS($dataToken['date']);

            return print_r(json_encode($data));
        } else {
            $msg = array(
                'msg' => 'Error'
            );
            return print_r(json_encode($msg));
        }


    }





}
