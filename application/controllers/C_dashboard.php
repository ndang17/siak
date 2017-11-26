<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends MY_Controller {



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


}
