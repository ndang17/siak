<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_api extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
        $this->load->model('m_api');
        $this->load->model('akademik/m_tahun_akademik');
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

    public function getProdi(){
        $data = $this->m_api->__getBaseProdi();
        return print_r(json_encode($data));
    }

    public function getMKByID(){
        $ID = $this->input->post('idMK');
        $data = $this->m_api->__getMKByID($ID);
        return print_r(json_encode($data));
    }

    public function getSemester(){
        $data = $this->m_tahun_akademik->__getSemester();
        return print_r(json_encode($data));
    }

    public function getLecturer(){
        $data = $this->m_api->__getLecturer();
        return print_r(json_encode($data));
    }

    public function getAllMK(){
        $data = $this->m_api->__getAllMK();
        return print_r(json_encode($data));
    }

    public function setLecturersAvailability($action){

        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = $this->jwt->decode($token,$key);
//        print_r($data_arr);

        if($action=='insert'){
            $this->db->insert('db_akademik.lecturers_availability',$data_arr);
            return print_r($this->db->insert_id());
        }

    }

    public function setLecturersAvailabilityDetail($action){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = $this->jwt->decode($token,$key);

        print_r($data_arr);
        if($action=='insert'){
            $this->db->insert('db_akademik.lecturers_availability_detail',$data_arr);
            return $this->db->insert_id();
        }
    }



}
