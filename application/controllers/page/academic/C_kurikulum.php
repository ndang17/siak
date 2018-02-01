<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kurikulum extends MY_Controller {

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

    public function kurikulum()
    {
        $data['department'] = parent::__getDepartement();

//        $content = $this->load->view('page/'.$data['department'].'/kurikulum',$data,true);
        $content = $this->load->view('page/'.$data['department'].'/kurikulum/kurikulum',$data,true);
        $this->temp($content);
    }

    public function kurikulum_detail(){

        $token = $this->input->post('token');
        $data['department'] = parent::__getDepartement();
        $data['token'] = $token;
        $this->load->view('page/'.$data['department'].'/kurikulum/kurikulum_detail',$data);
    }


    //==== Modal Kurikulum =====
    public function add_kurikulum(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            $data['department'] = parent::__getDepartement();
            $data['token'] = $token;
            $data['kurikulum'] = $data_arr;
            $this->load->view('page/'.$data['department'].'/kurikulum/modal_add_kurikulum',$data);
        } else {
            echo '<h3>Data Is Empty!</h3>';
        }


    }


    public function loadPageDetailMataKuliah(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            $data['department'] = parent::__getDepartement();
            $data['CDID'] = $data_arr['CDID'];
            $data['action'] = $data_arr['Action'];
            $data['semester'] = $data_arr['Semester'];
            $this->load->view('page/'.$data['department'].'/kurikulum/modal_add_semester',$data);
        } else {
            echo '<h3>Data Is Empty!</h3>';
        }

    }

    public function getDataConf(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        $table='';
        if($data_arr['action']=='ConfJenisKurikulum') {
            $table = 'curriculum_types';
        } else if($data_arr['action']=='ConfJenisKelompok'){
            $table = 'courses_groups';
        } else if($data_arr['action']=='ConfProgram'){
            $table = 'programs_campus';
        }
        $data['conf'] = $this->m_akademik->__getDataConf($table);

        $data['department'] = parent::__getDepartement();
        $data['table'] = $table;

        $this->load->view('page/'.$data['department'].'/kurikulum/kurikulum_conf',$data);

    }

    public function getClassGroup(){

        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        $data['department'] = parent::__getDepartement();

        if($data_arr['action']=='read'){
            $data['dataClassGroup'] = $this->m_akademik->getdataClassGroup();
            $this->load->view('page/'.$data['department'].'/kurikulum/modal_class_group',$data);
        } else if($data_arr['action']=='add'){
            $dataForm = (array) $data_arr['dataForm'];
            $this->db->insert('db_academic.class_group',$dataForm);
            $insert_id = $this->db->insert_id();

            return print_r($insert_id);
        } else if($data_arr['action']=='delete') {
            $this->db->where('ID', $data_arr['ID']);
            $this->db->delete('db_academic.class_group');
            return print_r(1);
        } else if($data_arr['action']=='edit'){
            $dataForm = (array) $data_arr['dataForm'];
            $this->db->where('ID', $data_arr['ID']);
            $this->db->update('db_academic.class_group',$dataForm);
            return print_r(1);
        }


    }

    public function getClassroom(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        $data['department'] = parent::__getDepartement();

        if($data_arr['action']=='read'){
            $data['dataClassroom'] = $this->m_akademik->getdataClassroom();
            $this->load->view('page/'.$data['department'].'/kurikulum/modal_classroom',$data);
        } else if($data_arr['action']=='add') {
            $dataForm = (array) $data_arr['dataForm'];
            $cekRoom = $this->m_akademik->cekClassroom($dataForm['Room']);

            if(count($cekRoom)>0){
                return 0;
            } else {
                $this->db->insert('db_academic.classroom',$dataForm);
                $insert_id = $this->db->insert_id();

                return print_r($insert_id);
            }

        } else if($data_arr['action']=='delete') {
            $this->db->where('ID', $data_arr['ID']);
            $this->db->delete('db_academic.classroom');
            return print_r(1);
        } else if($data_arr['action']=='edit'){
            $dataForm = (array) $data_arr['dataForm'];
            $this->db->where('ID', $data_arr['ID']);
            $this->db->update('db_academic.classroom',$dataForm);
            return print_r(1);
        }
    }







    public function kurikulum_detail2(){
        $data_json = $this->input->post('data_json');
        $data['department'] = parent::__getDepartement();

        $data['data_json'] = $data_json;

        $this->load->view('page/'.$data['department'].'/kurikulum_detail',$data);
    }

    public function kurikulum_detail_mk(){
        $data_json = $this->input->post('data_json');
        $data['department'] = parent::__getDepartement();

        $data['data_json'] = $data_json;

        $this->load->view('page/'.$data['department'].'/kurikulum_detail_mk',$data);
    }









}
