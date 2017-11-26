<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model {

  public function get_departement()
  {
    $data = $this->db->query('SELECT * FROM db_navigation.departement ORDER BY priority ASC');

    return $data->result_array();
  }


}
