<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kurikulum extends MY_Controller {

    function __construct()
    {
        parent::__construct();
//        $this->session->set_userdata('departement_nav', 'academic');
        $this->load->model('akademik/m_kurikulum');
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


    public function add_semester(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            $data['department'] = parent::__getDepartement();
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

        $table = 'courses_groups';
        if($data_arr['action']=='ConfJenisKurikulum') {
            $table = 'curriculum_types';
        }
        $data['conf'] = $this->m_kurikulum->__getDataConf($table);

        $data['department'] = parent::__getDepartement();
        $data['table'] = $table;

        $this->load->view('page/'.$data['department'].'/kurikulum/kurikulum_conf',$data);

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


    // ========= API =========
    public function __getKurikulumByYear(){

    }






}
