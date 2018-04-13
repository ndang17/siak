<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_study_planning extends MY_Controller {

    function __construct()
    {
        parent::__construct();
//        $this->session->set_userdata('departement_nav', 'academic');
//        $this->load->model('m_kurikulum');
    }

    public function temp($content)
    {
        parent::template($content);
    }

    public function index()
    {
        $department = parent::__getDepartement();
        $data = '';
        $content = $this->load->view('page/'.$department.'/studyplanning/tab_menu',$data,true);
        $this->temp($content);
    }

    public function setPageJadwal(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);


        $page = $data_arr['page'];
        $ScheduleID = $data_arr['ScheduleID'];

        $department = parent::__getDepartement();
        $path = 'page/'.$department.'/jadwal';

        $this->cekFileView($path,$page,$ScheduleID);

    }

    private function cekFileView($path,$file,$ScheduleID)
    {

        $data = false;
        if (file_exists(APPPATH."views/".$path."/{$file}.php"))
        {
            $dataView['ScheduleID'] = $ScheduleID;
            $data = $this->load->view($path.'/'.$file,$dataView);

        }

        return $data;
    }

}
