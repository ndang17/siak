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

    public function __getMKFromKurikulum($year){

        // Mendapatkan Kurikulum
        $detail_kurikulum = $this->Kurikulum($year);

        // Mendapatkan Total Semester Yang ada dalam kurikulum ini
        $semester = $this->Semester($detail_kurikulum['ID']);
//        $semester_detail = [];
        for($i=0;$i<count($semester);$i++){
            $semester[$i]['DetailSemester'] = $this->DetailMK($detail_kurikulum['ID'],$semester[$i]['Semester']);
        }

        $result = array(
            'DetailKurikulum' => $detail_kurikulum,
            'MataKuliah' => $semester
        );

        return $result;
    }

    private function Kurikulum($year){
        $data = $this->db->query('SELECT * FROM db_akademik.curriculum WHERE Year ="'.$year.'" LIMIT 1');
        return $data->result_array()[0];
    }

    private function Semester($CurriculumID){
        $data = $this->db->query('SELECT cd.Semester 
                                      FROM db_akademik.curriculum_details cd 
                                      WHERE cd.CurriculumID="'.$CurriculumID.'" GROUP BY cd.Semester;');

        return $data->result_array();
    }

    private function DetailMK($CurriculumID,$Semester){
        $data = $this->db->query('SELECT ps.Name AS ProdiName, ps.NameEng AS ProdiNameEng, 
                                           mk.MKCode, mk.Name AS NameMK, mk.NameEng AS NameMKEng, 
                                           cd.Semester , cd.TotalSKS,
                                           em.Name AS NameLecturer
                                                FROM db_akademik.curriculum_details cd 
                                                JOIN db_akademik.mata_kuliah mk ON (cd.MKID = mk.ID)
                                                JOIN db_akademik.program_study ps ON (cd.ProdiID = ps.ID)
                                                JOIN db_employees.employees em ON (cd.LecturerNIP = em.NIP)
                                                WHERE cd.CurriculumID="'.$CurriculumID.'" AND cd.Semester="'.$Semester.'"
                                                ORDER BY mk.MKCode ASC');

        return $data->result_array();
    }


}
