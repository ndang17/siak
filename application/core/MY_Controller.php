<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $departement = $this->__getDepartement();
        if($departement==''){
            $this->session->set_userdata('departement_nav', 'academic');
        }

        $this->session->set_userdata('nip', '2017090');

        $this->load->model('master/m_master');
        $this->load->library('JWT');
    }

    public function template($content)
    {

        $data['include'] = $this->load->view('template/include','',true);

        $data['header'] = $this->menu_header();
        $data['navigation'] = $this->menu_navigation();
        $data['crumbs'] = $this->crumbs();

        $data['content'] = $content;

        $this->load->view('template/template',$data);

    }

    public function blank_temp($content){
        $data['include'] = $this->load->view('template/include','',true);
        $data['content'] = $content;


        $this->load->view('template/blank',$data);
    }


    private function menu_header(){
//        $data_departement ['departement'] = $this->m_master->get_departement();
//        $data_nav['departement'] = $this->load->view('template/menu/departement',$data_departement,true);

        $nav_departement['departement'] = $this->__getDepartement();
        $data['page_departement'] = $this->load->view('template/navigation_departement',$nav_departement,true);
        $page = $this->load->view('template/header',$data,true);
        return $page;
    }
    private function menu_navigation(){

        $data['departement'] = $this->__getDepartement();
        $page = $this->load->view('page/'.$data['departement'].'/menu_navigation','',true);
        return $page;
    }

    private function crumbs(){
        $data['crumbs_departement'] = $this->session->userdata('departement_nav');
        $data['segment'] = $this->uri->segment_array();
        $page = $this->load->view('template/crumbs',$data,true);
        return $page;
    }


    //==== Get Set ===
    public function __getDepartement(){
        return $this->session->userdata('departement_nav');
    }

    public function __setDepartement($dpt)
    {
        $this->session->set_userdata('departement_nav', ''.$dpt);
    }


}
