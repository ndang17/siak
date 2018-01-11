<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tahun_akademik extends CI_Model {

    public function __getSemester()
    {
        $data = $this->db->query('SELECT s.*, e.Name AS NameEmployee FROM db_akademik.semester s
                                            JOIN db_employees.employees e ON (s.UpdateBy = e.NIP)
                                             ORDER BY s.ID DESC');

        return $data->result_array();
    }


}
