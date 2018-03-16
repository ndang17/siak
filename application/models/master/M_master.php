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
  	$query=$this->db->query($sql, array());

  }

  public function delete_count_account($ID)
  {
  	$sql = "delete from db_admission.count_account where ID = ".$ID;
  	$query=$this->db->query($sql, array());
  }

  public function inserData_email_to($email_to,$fungsi)
  {
    $dataSave = array(
            'EmailTo' => $email_to,
            'Function' => $fungsi,
            'CreateAT' => date('Y-m-d'),
    );
    $this->db->insert('db_admission.email_to', $dataSave);
  }

  public function editData_email_to($email_to,$fungsi,$ID)
  {
    $sql = "update db_admission.email_to set EmailTo = ? , Function = ? where ID = ".$ID;
    $query=$this->db->query($sql, array($email_to,$fungsi));
  }

  public function delete_email_to($ID)
  {
    $sql = "delete from db_admission.email_to where ID = ".$ID;
    $query=$this->db->query($sql, array());
  }

  public function getActive_email_to($ID,$Active)
  {
    if ($Active == 0) {
      $sql = "update db_admission.email_to set Active = 1 where ID = ".$ID;
      /*$sql2 = "update db_admission.email_to set Active = 0 where ID != ".$ID;
      $query2=$this->db->query($sql2, array());*/
    }
    else
    {
      $sql = "update db_admission.email_to set Active = 0 where ID = ".$ID;
    }
    $query=$this->db->query($sql, array());
  }

  public function inserData_lama_pembayaran($Longtime)
  {
    $dataSave = array(
            'Longtime' => $Longtime,
            'CreateAT' => date('Y-m-d'),
    );
    $this->db->insert('db_admission.deadline_register', $dataSave);

    $sql = "select a.ID from db_admission.deadline_register as a where a.active = 1 order by a.ID desc limit 1";
    $query=$this->db->query($sql, array())->result_array();
    $ID = $query[0]['ID'];

    $sql = "update db_admission.deadline_register set Active = 0 where ID != ".$ID;
    $query=$this->db->query($sql, array());
  }

  public function editData_lama_pembayaran($Longtime,$ID)
  {
    $sql = "update db_admission.deadline_register set Longtime = ? where ID = ".$ID;
    $query=$this->db->query($sql, array($Longtime));
  }

  public function delete_id_table($ID,$table)
  {
    $sql = "delete from db_admission.".$table." where ID = ".$ID;
    $query=$this->db->query($sql, array());
  }

  public function getActive_id_active_table($ID,$Active,$table)
  {
    if ($Active == 0) {
      $sql = "update db_admission.".$table." set Active = 1 where ID = ".$ID;
      $sql2 = "update db_admission.".$table." set Active = 0 where ID != ".$ID;
      $query2=$this->db->query($sql2, array());
    }
    else
    {
      $sql = "update db_admission.".$table." set Active = 0 where ID = ".$ID;
    }
    $query=$this->db->query($sql, array());
  }

  public function inserData_harga_formulir($PriceFormulir)
  {
    $dataSave = array(
            'PriceFormulir' => $PriceFormulir,
            'CreateAT' => date('Y-m-d'),
    );
    $this->db->insert('db_admission.price_formulir', $dataSave);

    $sql = "select a.ID from db_admission.price_formulir as a where a.active = 1 order by a.ID desc limit 1";
    $query=$this->db->query($sql, array())->result_array();
    $ID = $query[0]['ID'];

    $sql = "update db_admission.price_formulir set Active = 0 where ID != ".$ID;
    $query=$this->db->query($sql, array());
  }

  public function editData_harga_formulir($PriceFormulir,$ID)
  {
    $sql = "update db_admission.price_formulir set PriceFormulir = ? where ID = ".$ID;
    $query=$this->db->query($sql, array($PriceFormulir));
  }

  public function getActive_id_activeAll_table($ID,$Active,$table)
  {
    if ($Active == 0) {
      $sql = "update db_admission.".$table." set Active = 1 where ID = ".$ID;
    }
    else
    {
      $sql = "update db_admission.".$table." set Active = 0 where ID = ".$ID;
    }
    $query=$this->db->query($sql, array());
  }

  public function inserData_jenis_tempat_tinggal($jenis_tempat_tinggal)
  {
    $dataSave = array(
            'JenisTempatTinggal' => ucwords($jenis_tempat_tinggal),
            'CreateAT' => date('Y-m-d'),
    );
    $this->db->insert('db_admission.register_jtinggal_m', $dataSave);
  }

  public function editData_jenis_tempat_tinggal($jenis_tempat_tinggal,$ID)
  {
    $sql = "update db_admission.register_jtinggal_m set JenisTempatTinggal = ? where ID = ".$ID;
    $query=$this->db->query($sql, array($jenis_tempat_tinggal));
  }

  public function inserData_pendapatan($Income)
  {
    $dataSave = array(
            'Income' => ucwords($Income),
            'CreateAT' => date('Y-m-d'),
    );
    $this->db->insert('db_admission.register_income_m', $dataSave);
  }

  public function editData_pendapatan($Income,$ID)
  {
    $sql = "update db_admission.register_income_m set Income = ? where ID = ".$ID;
    $query=$this->db->query($sql, array($Income));
  }

  public function inserData_document_checklist($DocumentChecklist)
  {
    $dataSave = array(
            'DocumentChecklist' => ucwords($DocumentChecklist),
            'CreateAT' => date('Y-m-d'),
    );
    $this->db->insert('db_admission.reg_doc_checklist', $dataSave);
  }

  public function editData_document_checklist($DocumentChecklist,$ID)
  {
    $sql = "update db_admission.reg_doc_checklist set DocumentChecklist = ? where ID = ".$ID;
    $query=$this->db->query($sql, array($DocumentChecklist));
  }

}
