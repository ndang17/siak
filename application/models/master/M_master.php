<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model {

  public function get_departement()
  {
    $data = $this->db->query('SELECT * FROM db_navigation.departement ORDER BY priority ASC');

    return $data->result_array();
  }

  public function showData($tabel)
  {
  	$sql = "select * from ".$tabel; 
  	$query=$this->db->query($sql, array());
  	return $query->result();
  }

  public function showDataActive($tabel)
  {
  	$sql = "select * from ".$tabel." where active = 1"; 
  	$query=$this->db->query($sql, array());
  	return $query->result();
  }

  public function caribasedprimary($tabel,$fieldPrimary,$valuePrimary)
  {
  	$sql = "select * from ".$tabel." where ".$fieldPrimary." = ?"; 
  	$query=$this->db->query($sql, array($valuePrimary));
  	return $query->result_array();
  }

  public function getColumnTable($table)
  {
  	$arr = array();
  	$sql = "SHOW COLUMNS FROM ".$table; 
  	$query=$this->db->query($sql, array())->result();
  	$temp = array();
  	foreach ($query as $key) {
  		$temp[] = $key->Field;
  	}
  	$arr = array('query' => $query,'field' => $temp); 
  	return $arr;
  }

  public function inserData_count_account($CountAccount)
  {
  	$dataSave = array(
  	        'CountAccount' => $CountAccount,
  	        'CreateAT' => date('Y-m-d'),
  	);
  	$this->db->insert('db_admission.count_account', $dataSave);

  	$sql = "select a.ID from db_admission.count_account as a where a.active = 1 order by a.ID desc limit 1";
  	$query=$this->db->query($sql, array())->result_array();
  	$ID = $query[0]['ID'];

  	$sql = "update db_admission.count_account set Active = 0 where ID != ".$ID;
  	$query=$this->db->query($sql, array());

  }

  public function editData_count_account($CountAccount,$ID)
  {
  	$sql = "update db_admission.count_account set CountAccount = ? where ID = ".$ID;
  	$query=$this->db->query($sql, array($CountAccount));
  }

  public function getActive_count_account($ID,$Active)
  {
  	if ($Active == 0) {
  		$sql = "update db_admission.count_account set Active = 1 where ID = ".$ID;
  		$sql2 = "update db_admission.count_account set Active = 0 where ID != ".$ID;
  		$query2=$this->db->query($sql2, array());
  	}
  	else
  	{
  		$sql = "update db_admission.count_account set Active = 0 where ID = ".$ID;
  	}
  	$query=$this->db->query($sql, array($CountAccount));

  }

  public function delete_count_account($ID)
  {
  	$sql = "delete from db_admission.count_account where ID = ".$ID;
  	$query=$this->db->query($sql, array($CountAccount));
  }


}
