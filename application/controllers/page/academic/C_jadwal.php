<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jadwal extends MY_Controller {

    function __construct()
    {
        parent::__construct();
//        $this->session->set_userdata('departement_nav', 'academic');
        $this->load->model('m_kurikulum');
    }


    public function temp($content)
    {
        parent::template($content);
    }

    public function contentTabs($contenttabs){
        $department = parent::__getDepartement();
        $data['contenttabs'] = $contenttabs;
        $content = $this->load->view('page/'.$department.'/jadwal',$data,true);
        $this->temp($content);
    }


    public function index()
    {
        $department = parent::__getDepartement();
        $contenttabs = $this->load->view('page/'.$department.'/jadwal_tab_jadwal','',true);
        $this->contentTabs($contenttabs);
    }

    public function groubKelas(){
        $department = parent::__getDepartement();
        $contenttabs = $this->load->view('page/'.$department.'/jadwal_tab_groupkelas','',true);
        $this->contentTabs($contenttabs);
    }




}
