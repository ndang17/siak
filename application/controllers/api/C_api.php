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
//    public function getKurikulumByYear2(){
//
//        $year = $this->input->get('year');
//
//        $data['detail'] = $this->m_api->__getKurikulumByYear($year);
//
//        $result = null;
//
//        if($data['detail']!=null){
//            $data['grade'] = $this->m_api->__getGradeByIDKurikulum($data['detail'][0]['ID']);
//            $data['mk'] = $this->m_api->__getMataKuliahByIDKurikulum($data['detail'][0]['ID']);
//            $result = $data;
//        }
//
//
//        return print_r(json_encode($result));
//    }

    public function getKurikulumByYear(){

//        $year = $this->input->get('year');

        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        $result = $this->m_api->__getKurikulumByYear($data_arr['year'],$data_arr['ProdiID']);

        return print_r(json_encode($result));
    }

    public function getProdi(){
        $data = $this->m_api->__getBaseProdi();
        return print_r(json_encode($data));
    }

    public function getProdiSelectOption(){
        $data = $this->m_api->__getBaseProdiSelectOption();
        return print_r(json_encode($data));
    }

    public function getKurikulumSelectOption(){
        $data = $this->m_api->__getKurikulumSelectOption();
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

    public function setLecturersAvailability(){

        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);
//        print_r($data_arr);

        if($data_arr['action']=='add'){
            $dataInsert = (array) $data_arr['dataForm'];
            $this->db->insert('db_akademik.lecturers_availability',$dataInsert);
            return print_r($this->db->insert_id());
        } else if($data_arr['action']=='edit'){

            $update_lad = (array) $data_arr['dataForm_lad'];
            $this->db->where('ID', $data_arr['ladID']);
            $this->db->update('db_akademik.lecturers_availability_detail',$update_lad);

            return print_r(1);
        } else if($data_arr['action']=='delete'){

            // Cek apakah ID lebih dari satu
            $dataCek = $this->m_api->__cekTotalLAD($data_arr['laID']);

            if(count($dataCek)==1){
                $this->db->where('ID', $data_arr['laID']);
                $this->db->delete('db_akademik.lecturers_availability');

                $this->db->where('ID', $data_arr['ladID']);
                $this->db->delete('db_akademik.lecturers_availability_detail');
            } else {
                $this->db->where('ID', $data_arr['ladID']);
                $this->db->delete('db_akademik.lecturers_availability_detail');
            }


            return print_r(1);

        }

    }

    public function setLecturersAvailabilityDetail($action){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = $this->jwt->decode($token,$key);

//        print_r($data_arr);
        if($action=='insert'){
            $this->db->insert('db_akademik.lecturers_availability_detail',$data_arr);
            return $this->db->insert_id();
        }
    }

    public function changeTahunAkademik(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);


        $data['department'] = parent::__getDepartement();
        $data['dosen'] = $this->m_tahun_akademik->__getKetersediaanDosenByTahunAkademik($data_arr['ID']);
        print_r(json_encode($data['dosen']));
//        $this->load->view('page/'.$data['department'].'/ketersediaan_dosen_detail',$data);
    }


    //-------- Kurikulum -----
    public function insertKurikulum(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        // Cek Tahun
        $data = $this->m_api->cekTahunKurikulum($data_arr['Year']);
        if(count($data)>0){
            return print_r(0);
        } else {
            $this->db->insert('db_akademik.curriculum',$data_arr);
            return print_r(1);
        }

    }

    public function geteducationLevel(){
        $data = $this->m_api->__geteducationLevel();
        return print_r(json_encode($data));
    }

    public function getDosenSelectOption(){
        $data = $this->m_api->__getDosenSelectOption();
        return print_r(json_encode($data));
    }

    public function crudKurikulum(){

        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

//        print_r($data_arr);
//        exit;
        if($data_arr['action']=='add'){
            $insert = (array) $data_arr['data_insert'];
            $this->db->insert('db_akademik.'.$data_arr['table'],$insert);
            $insert_id = $this->db->insert_id();
            return print_r($insert_id);
        } else if($data_arr['action']=='edit'){
            $dataupdate = (array) $data_arr['data_insert'];
            $this->db->where('ID', $data_arr['ID']);
            $this->db->update('db_akademik.'.$data_arr['table'],$dataupdate);
            return print_r(1);
        } else if($data_arr['action']=='delete'){
            $this->db->where('ID', $data_arr['ID']);
            $this->db->delete('db_akademik.'.$data_arr['table']);
            return print_r(1);
        } else if($data_arr['action']=='read'){
            $data = $this->m_api->__getItemKuriklum($data_arr['table']);
            return print_r(json_encode($data));
        }
    }

    public function crudDetailMK(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if($data_arr['action']=='add'){
            $insert = (array) $data_arr['dataForm'];
            $this->db->insert('db_akademik.curriculum_details',$insert);
            $insert_id = $this->db->insert_id();

            return print_r($insert_id);
        } else if($data_arr['action']=='edit'){
            $update = (array) $data_arr['dataForm'];
            $this->db->where('ID', $data_arr['ID']);
            $this->db->update('db_akademik.curriculum_details',$update);
//            print_r($data_arr);

            $this->db->where('CurriculumDetailID', $data_arr['ID']);
            $this->db->delete('db_akademik.precondition');

            $insert_id = $data_arr['ID'];
        }

        if($data_arr['DataPraSyart']!=''){
            for($i=0;$i<count($data_arr['DataPraSyart']);$i++){

                $ex = explode(".",$data_arr['DataPraSyart'][$i]);

                $data_Pra = array(
                    'CurriculumDetailID' => $insert_id,
                    'MKID' => trim($ex[0]),
                    'MKCode' => trim($ex[1])
                );
                $this->db->insert('db_akademik.precondition',$data_Pra);
            }
        }
    }

    public function getdetailKurikulum(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            $CDID = $data_arr['CDID'];
            $data = $this->m_api->__getdetailKurikulum($CDID);

            return print_r(json_encode($data));
        }

    }

    public function genrateMKCode(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            $ID = $data_arr['ID'];
            $data = $this->m_api->__genrateMKCode($ID);

            return print_r(json_encode($data));
        }

    }

    public function cekMKCode(){
        $MKCode = $this->input->post('MKCode');
        $data = $this->m_api->__cekMKCode($MKCode);
        return print_r(json_encode($data));
    }

    public function crudMetaKuliah(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            if($data_arr['action']=='add'){
                $dataInsert = (array) $data_arr['dataForm'];
                $this->db->insert('db_akademik.mata_kuliah',$dataInsert);
                $insert_id = $this->db->insert_id();

                return print_r($insert_id);
            }
            else if($data_arr['action']=='edit')
            {
                $dataInsert = (array) $data_arr['dataForm'];
                $this->db->where('ID', $data_arr['ID']);
                $this->db->update('db_akademik.mata_kuliah',$dataInsert);

                return print_r(1);
            }
            else if($data_arr['action']=='delete')
            {
                $this->db->where('ID', $data_arr['ID']);
                $this->db->delete('db_akademik.mata_kuliah');
                return print_r(1);
            }
        }
    }




}
