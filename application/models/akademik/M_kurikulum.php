<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kurikulum extends CI_Model {

    public function __getKurikulum()
    {
        $data = $this->db->query('SELECT c.*,e.Name AS UpdateByName FROM db_akademik.curriculum c 
                                            JOIN db_employees.employees e 
                                            ON (c.UpdateBy=e.NIP) ORDER BY ID DESC');

        return $data->result_array();
    }

    public function __getLastKurikulum(){

        $data = $this->db->query('SELECT * FROM db_akademik.curriculum ORDER BY ID DESC LIMIT 1');

        return $data->result_array();
    }




}
