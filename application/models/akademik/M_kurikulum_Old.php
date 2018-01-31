<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kurikulumOld extends CI_Model {


//    public function __getLastKurikulum(){
//
//        $data = $this->db->query('SELECT * FROM db_academic.curriculum ORDER BY ID DESC LIMIT 1');
//
//        return $data->result_array();
//    }

    public function __getDataConf($table){
        $data = $this->db->query('SELECT * FROM db_academic.'.$table.' ORDER BY ID ASC');

        return $data->result_array();
    }




}
