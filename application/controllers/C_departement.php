<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_departement extends MY_Controller {



	public function temp($content)
	{
		$id_departement = 1;
		parent::template($content,$id_departement);
	}

	public function index()
	{
		$content = $this->load->view('dashboard/dashboard','',true);
		$this->temp($content);
	}

  public function navigation($id_departement)
  {
    // $id_departement = 1;
    $content = $this->load->view('dashboard/dashboard','',true);
		// $this->temp($content);
		parent::template($content,$id_departement);
  }


}
