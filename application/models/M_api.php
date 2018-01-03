<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_api extends CI_Model {


    public function __getKurikulumByYear($year)
    {
        $data = $this->db->query('SELECT c.*,e.Name AS UpdateByName FROM db_akademik.curriculum c 
                                            JOIN db_employees.employees e 
                                            ON (c.UpdateBy=e.NIP) WHERE c.Year="'.$year.'" LIMIT 1');

        return $data->result_array();
    }

    public function __getGradeByIDKurikulum($IDKurikulum){
        $data = $this->db->query('SELECT * FROM db_akademik.grade WHERE CurriculumID = "'.$IDKurikulum.'" ');
        return $data->result_array();
    }




}
