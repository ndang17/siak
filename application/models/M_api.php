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

    public function __getGradeByIDKurikulum($CurriculumID){
        $data = $this->db->query('SELECT * FROM db_akademik.grade WHERE CurriculumID = "'.$CurriculumID.'" ');
        return $data->result_array();
    }

    public function __getMataKuliahByIDKurikulum($CurriculumID){
        $data = $this->db->query('SELECT ps.Name AS ProdiName, ps.NameEng AS ProdiNameEng, 
                                          mk.MKCode, mk.Name AS NameMK, mk.NameEng AS NameMKEng, 
                                          cd.Semester , cd.TotalSKS,
                                          em.Name AS NameLecturer
                                    FROM db_akademik.mata_kuliah mk 
                                    JOIN db_akademik.curriculum_details cd ON (mk.ID = cd.MKID)
                                    JOIN db_akademik.program_study ps ON (cd.ProdiID = ps.ID)
                                    JOIN db_employees.employees em ON (cd.LecturerNIP = em.NIP)
                                    WHERE cd.CurriculumID="'.$CurriculumID.'" ORDER BY ProdiName');
        return $data->result_array();
    }

    public function __getBaseProdi()
    {
        $data = $this->db->query('SELECT * FROM db_akademik.program_study');
        return $data->result_array();
    }

    public function __getMKByID($ID){
        $data = $this->db->query('SELECT * FROM db_akademik.mata_kuliah WHERE ID = "'.$ID.'" LIMIT 1');
        return $data->result_array();
    }

    public function __getLecturer(){
        $data = $this->db->query('SELECT * FROM db_employees.employees WHERE PositionMain = "14.7"');
        return $data->result_array();
    }

    public function __getAllMK(){
        $data = $this->db->query('SELECT mk.*,pg.Code FROM db_akademik.mata_kuliah mk JOIN db_akademik.program_study pg ON (mk.BaseProdiID = pg.ID)');
        return $data->result_array();
    }

}
