<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jadwal extends MY_Controller {

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
        $content = $this->load->view('page/'.$department.'/jadwal/tab_menu',$data,true);
        $this->temp($content);
    }

    public function setPageJadwal(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);


        $page = $data_arr['page'];

        $department = parent::__getDepartement();
        $path = 'page/'.$department.'/jadwal';

        $this->cekFileView($path,$page);

    }

    private function cekFileView($path,$file)
    {

        $data = false;
        if (file_exists(APPPATH."views/".$path."/{$file}.php"))
        {
            $data = $this->load->view($path.'/'.$file);
//            $data = true;
        }

        return $data;
    }

}
