<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akademik extends CI_Model {


    public function __getDataConf($table){
        $data = $this->db->query('SELECT * FROM db_academic.'.$table.' ORDER BY ID ASC');

        return $data->result_array();
    }

    public function __getKetersediaanDosen($ID){
        $data = $this->db->query('SELECT la.SemesterID, la.ID AS laID, lad.ID AS ladID, la.MKID, la.MKCode, em.NIP, s.Name AS Semester, em.Name AS NameLecturer, mk.Name AS NameMK, lad.DayID, lad.Start, lad.End  FROM db_academic.lecturers_availability_detail lad
                                        LEFT JOIN db_academic.lecturers_availability la ON (lad.LecturersAvailabilityID = la.ID)
                                        LEFT JOIN db_employees.employees em ON (la.LecturerID = em.NIP)
                                        LEFT JOIN db_academic.mata_kuliah mk ON (la.MKID = mk.ID AND la.MKCode = mk.MKCode)
                                        LEFT JOIN db_academic.semester s ON (la.SemesterID = s.ID)
                                        WHERE lad.ID ="'.$ID.'" LIMIT 1');
        return $data->result_array();
    }

    public function getdataClassGroup(){
        $data = $this->db->query('SELECT cg.*,ps.Name AS ProdiName FROM db_academic.class_group cg
                                      LEFT JOIN db_academic.program_study ps 
                                      ON (cg.BaseProdiID = ps.ID) 
                                      ORDER BY cg.ID ASC');

        return $data->result_array();
    }


    public function getSelectOptionClassGroup(){
        $data = $this->db->query('SELECT ID,Name AS ProdiName FROM db_academic.program_study')
            ->result_array();

        $result = [];

        if(count($data)>0){
            for($i=0;$i<count($data);$i++){

                $result[$i] = array(
                    'optgroup' => array(
                        'ProdiName' => $data[$i]['ProdiName'],
                        'ID' => $data[$i]['ID']
                    ),
                    'options' => $this->getOptionClassGroup($data[$i]['ID'])
                );

            }
        }

        return $result;

    }

    private function getOptionClassGroup($ID){
        $data = $this->db->query('SELECT * FROM db_academic.class_group WHERE BaseProdiID = "'.$ID.'" ');
        return $data->result_array();
    }


}
