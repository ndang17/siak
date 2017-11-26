<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('master/m_master');
  }

  public function template($content,$id_departement)
  {

    $data['include'] = $this->load->view('template/include','',true);

    $data_departement ['departement'] = $this->m_master->get_departement();
    $data_nav['departement'] = $this->load->view('template/menu/departement',$data_departement,true);

		$data['header'] = $this->load->view('template/header',$data_nav,true);

    $navigation['navigation'] = $this->db->query('SELECT * FROM db_navigation.menu WHERE id_departement ='.$id_departement)->result_array();
		$data['navigation'] = $this->load->view('template/menu/navigation',$navigation,true);
		$this->load->view('template/template',$data);

  }


}
