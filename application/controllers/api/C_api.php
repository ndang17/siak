<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_api extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
        $this->load->model('m_api');
    }



    // ========= API =========
    public function getKurikulumByYear(){

        $year = $this->input->get('year');

        $data['detail'] = $this->m_api->__getKurikulumByYear($year);

        $result = null;

        if($data['detail']!=null){
            $data['grade'] = $this->m_api->__getGradeByIDKurikulum($data['detail'][0]['ID']);
            $data['mk'] = $this->m_api->__getMataKuliahByIDKurikulum($data['detail'][0]['ID']);
            $result = $data;
        }


        return print_r(json_encode($result));
    }

    private function getGradeByIDKurikulum($ID){

    }






}
