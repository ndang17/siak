<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tahun_akademik extends CI_Model {

    public function __getSemester()
    {
        $data = $this->db->query('SELECT * FROM db_akademik.semester');

        return $data->result_array();
    }


}
