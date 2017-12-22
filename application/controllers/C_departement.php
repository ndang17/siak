<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_departement extends MY_Controller {



	public function temp($content)
	{
		$id_departement = 1;
		parent::template($content);
	}

	public function index()
	{
		$content = $this->load->view('dashboard/dashboard','',true);
		$this->temp($content);
	}

  public function navigation($id_departement)
  {
		$navigation['navigation'] = $this->db->query('SELECT * FROM db_navigation.menu WHERE id_departement ='.$id_departement)->result_array();
		$data['navigation'] = $this->load->view('template/menu/navigation',$navigation,true);
  }


}
