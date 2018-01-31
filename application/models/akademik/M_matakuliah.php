<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_matakuliah extends CI_Model {

    public function __getAllMK()
    {
        $data = $this->db->query('SELECT mk.ID AS mkID, mk.MKCode, mk.Name, mk.NameEng, ps.Code,
                                ps.Name AS NameProdi, ps.NameEng AS NameProdiEng
                                  FROM db_academic.mata_kuliah mk
                                  JOIN db_academic.program_study ps ON (mk.BaseProdiID = ps.ID)');

        return $data->result_array();
    }



}
