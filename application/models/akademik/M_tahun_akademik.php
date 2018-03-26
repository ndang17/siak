<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tahun_akademik extends CI_Model {

    public function __getSemester()
    {
        $data = $this->db->query('SELECT s.*, ps.Name AS ProgramName , e.Name AS NameEmployee 
                                            FROM db_academic.semester s
                                            LEFT JOIN db_employees.employees e ON (s.UpdateBy = e.NIP)
                                            LEFT JOIN db_academic.programs_campus ps ON (s.ProgramCampusID = ps.ID)
                                                                                 
                                             ORDER BY s.ID DESC');

        return $data->result_array();
    }

    public function __getKetersediaanDosenByTahunAkademik($ID){
        $data = $this->db->query('SELECT la.*,lad.*, e.Name AS LecturerName, mk.Name AS MKName , mk.NameEng AS MKNameEng FROM db_academic.lecturers_availability la 
					JOIN db_academic.lecturers_availability_detail lad ON (la.ID = lad.LecturersAvailabilityID) 
                    JOIN db_employees.employees e ON (la.LecturerID = e.NIP)
                    JOIN db_academic.mata_kuliah mk ON (la.MKID = mk.ID)
                    WHERE la.SemesterID = "'.$ID.'" ');
        return $data->result_array();
    }

    public function __getDataTahunAkademik($ID){
        $data = $this->db->query('SELECT * FROM db_academic.semester WHERE ID ="'.$ID.'" ');
        return $data->result_array();
    }


}
