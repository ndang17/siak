<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();



        if($this->session->userdata('loggedIn')){
            $departement = $this->__getDepartement();
            if($departement==''){
//                $this->session->set_userdata('departementNavigation', 'academic');
            }
        } else {
            redirect(base_url());
        }

//        $this->session->set_userdata('nip', '2017090');
//        $this->session->set_userdata('timePerCredits', '50');

//        $this->load->model('master/m_master');
        $this->load->library('JWT');
        $this->load->library('google');
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

        $exp_name = explode(" ",$this->session->userdata('Name'));
        $data['name']= (count($exp_name)>0) ? $exp_name[0] : $this->session->userdata('Name');

        $page = $this->load->view('template/header',$data,true);
        return $page;
    }
    private function menu_navigation(){

        $data['departement'] = $this->__getDepartement();
        $page = $this->load->view('page/'.$data['departement'].'/menu_navigation','',true);
        return $page;
    }

    private function crumbs(){
        $data['crumbs_departement'] = $this->session->userdata('departementNavigation');
        $data['segment'] = $this->uri->segment_array();
        $page = $this->load->view('template/crumbs',$data,true);
        return $page;
    }


    //==== Get Set ===
    public function __getDepartement(){
        return $this->session->userdata('departementNavigation');
    }

    public function __setDepartement($dpt)
    {
        $this->session->set_userdata('departementNavigation', ''.$dpt);
    }

//    public function setTimePerCredits(){
//        $data = $this->db->query('SELECT * FROM db_academic.time_per_credits LIMIT 1')
//            ->result_array();
//
//        $this->session->set_userdata('timePerCredits', $data[0]['Time']);
//
////        return print_r();
//    }


}
