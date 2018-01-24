<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akademik extends CI_Model {


    public function __getDataConf($table){
        $data = $this->db->query('SELECT * FROM db_akademik.'.$table.' ORDER BY ID ASC');

        return $data->result_array();
    }

    public function __getKetersediaanDosen($ID){
        $data = $this->db->query('SELECT la.MKID, la.MKCode, em.NIP, s.Name AS Semester, em.Name AS NameLecturer, mk.Name AS NameMK, lad.DayID, lad.Start, lad.End  FROM db_akademik.lecturers_availability_detail lad
                                        LEFT JOIN db_akademik.lecturers_availability la ON (lad.LecturersAvailabilityID = la.ID)
                                        LEFT JOIN db_employees.employees em ON (la.LecturerID = em.NIP)
                                        LEFT JOIN db_akademik.mata_kuliah mk ON (la.MKID = mk.ID AND la.MKCode = mk.MKCode)
                                        LEFT JOIN db_akademik.semester s ON (la.SemesterID = s.ID)
                                        WHERE lad.ID ="'.$ID.'" LIMIT 1');
        return $data->result_array();
    }




}