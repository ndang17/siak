<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_api extends CI_Model {


//    public function __getKurikulumByYear2($year)
//    {
//        $data = $this->db->query('SELECT c.*,e.Name AS UpdateByName FROM db_akademik.curriculum c
//                                            JOIN db_employees.employees e
//                                            ON (c.UpdateBy=e.NIP) WHERE c.Year="'.$year.'" LIMIT 1');
//
//        return $data->result_array();
//    }

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

    public function __getBaseProdiSelectOption()
    {
        $data = $this->db->query('SELECT ID,Code,Name,NameEng FROM db_akademik.program_study');
        return $data->result_array();
    }

    public function __getMKByID($ID){
        $data = $this->db->query('SELECT mk.*, ps.Code AS ProdiCode FROM db_akademik.mata_kuliah mk
                                    LEFT JOIN db_akademik.program_study ps ON (mk.BaseProdiID = ps.ID)
                                    WHERE mk.ID = "'.$ID.'" LIMIT 1');
        return $data->result_array();
    }

    public function __getLecturer(){
        $data = $this->db->query('SELECT * FROM db_employees.employees WHERE PositionMain = "14.7"');
        return $data->result_array();
    }

    public function __getAllMK(){
        $data = $this->db->query('SELECT mk.*,pg.Code, pg.Name AS NameProdi 
                                    FROM db_akademik.mata_kuliah mk 
                                    JOIN db_akademik.program_study pg 
                                    ON (mk.BaseProdiID = pg.ID)');
        return $data->result_array();
    }


    // ==== KURIKULUM ====
    public function __getKurikulumByYear($year,$ProdiID){

        // Mendapatkan Kurikulum
        $detail_kurikulum = $this->Kurikulum($year);

        if($detail_kurikulum!=''){

            // Mendapatkan Total Semester Yang ada dalam kurikulum ini
            $semester = $this->Semester($detail_kurikulum['ID']);
            $grade = $this->Grade($detail_kurikulum['ID']);

            for($i=0;$i<count($semester);$i++){
                $semester[$i]['DetailSemester'] = $this->DetailMK($detail_kurikulum['ID'],$semester[$i]['Semester'],$ProdiID);
            }

            $result = array(
                'DetailKurikulum' => $detail_kurikulum,
                'Grade' => $grade,
                'MataKuliah' => $semester
            );
        } else {
            $result = false;
        }

        return $result;
    }

    private function Kurikulum($year){
        $data = $this->db->query('SELECT c.*,e.Name AS CreateByName, e2.Name AS UpdateByName FROM db_akademik.curriculum c
                                              JOIN db_employees.employees e ON (c.CreateBy = e.NIP) 
                                              JOIN db_employees.employees e2 ON (c.UpdateBy = e2.NIP) 
                                              WHERE c.Year ="'.$year.'" LIMIT 1');

        if(count($data->result_array())>0){
            return $data->result_array()[0];
        } else {
            return false;
        }

    }

    private function Semester($CurriculumID){
        $data = $this->db->query('SELECT cd.Semester 
                                      FROM db_akademik.curriculum_details cd 
                                      WHERE cd.CurriculumID="'.$CurriculumID.'" GROUP BY cd.Semester;');

        return $data->result_array();
    }

    private function Grade($CurriculumID) {
        $data = $this->db->query('SELECT g.* FROM db_akademik.grade g WHERE g.CurriculumID = "'.$CurriculumID.'" ORDER BY g.Grade ASC ');

        return $data->result_array();
    }

    private function DetailMK($CurriculumID,$Semester,$ProdiID){
        if($ProdiID!=''){
            $data = $this->db->query('SELECT ps.Name AS ProdiName, ps.NameEng AS ProdiNameEng, 
                                           mk.MKCode, mk.Name AS NameMK, mk.NameEng AS NameMKEng, 
                                           cd.ID AS CDID, cd.CurriculumID, cd.Semester , cd.TotalSKS, cd.SKSTeori, 
                                           cd.SKSPraktikum, cd.SKSPraktikLapangan,
                                           em.Name AS NameLecturer
                                                FROM db_akademik.curriculum_details cd 
                                                LEFT JOIN db_akademik.mata_kuliah mk ON (cd.MKID = mk.ID)
                                                LEFT JOIN db_akademik.program_study ps ON (cd.ProdiID = ps.ID)
                                                LEFT JOIN db_employees.employees em ON (cd.LecturerNIP = em.NIP)
                                                WHERE cd.CurriculumID="'.$CurriculumID.'" 
                                                AND cd.Semester="'.$Semester.'"
                                                AND cd.ProdiID="'.$ProdiID.'"
                                                ORDER BY mk.MKCode ASC');
        } else {
            $data = $this->db->query('SELECT ps.Name AS ProdiName, ps.NameEng AS ProdiNameEng, 
                                           mk.MKCode, mk.Name AS NameMK, mk.NameEng AS NameMKEng, 
                                           cd.ID AS CDID, cd.CurriculumID, cd.Semester , cd.TotalSKS, cd.SKSTeori, 
                                           cd.SKSPraktikum, cd.SKSPraktikLapangan,
                                           em.Name AS NameLecturer
                                                FROM db_akademik.curriculum_details cd 
                                                LEFT JOIN db_akademik.mata_kuliah mk ON (cd.MKID = mk.ID)
                                                LEFT JOIN db_akademik.program_study ps ON (cd.ProdiID = ps.ID)
                                                LEFT JOIN db_employees.employees em ON (cd.LecturerNIP = em.NIP)
                                                WHERE cd.CurriculumID="'.$CurriculumID.'" 
                                                AND cd.Semester="'.$Semester.'"
                                                ORDER BY mk.MKCode ASC');
        }


        return $data->result_array();
    }


    public function cekTahunKurikulum($year){
        $data = $this->db->query('SELECT * FROM db_akademik.curriculum WHERE Year = "'.$year.'"');

        return $data->result_array();
    }

    public function __getKurikulumSelectOption(){
        $data = $this->db->query('SELECT ID,Year,Name FROM db_akademik.curriculum ORDER BY Year DESC');

        return $data->result_array();
    }

    public function __geteducationLevel(){
        $data = $this->db->query('SELECT * FROM db_akademik.education_level ORDER BY EducationLevelID DESC');

        return $data->result_array();
    }

    public function __getDosenSelectOption(){
        $data = $this->db->query('SELECT IDEmployee,NIP,NIDN,Name FROM db_employees.employees WHERE PositionMain = "14.7"');
        return $data->result_array();
    }

    public function __getItemKuriklum($table){

        $data = $this->db->query('SELECT * FROM db_akademik.'.$table);
        return $data->result_array();
    }

    public function __getdetailKurikulum($CDID){

        $data = $this->db->query('SELECT cd.*,
                                    ct.Name AS NameCurriculumType,
                                    ps.Name AS NameProdi,
                                    el.Name AS NameEducationLevel,
                                    cg.Name AS NameCoursesGroups,
                                    em.Name AS NameLecturer,
                                    mk.Name AS NameMK
                                    FROM db_akademik.curriculum_details cd
                                    LEFT JOIN db_akademik.curriculum_types ct ON (ct.ID = cd.CurriculumTypeID)
                                    LEFT JOIN db_akademik.program_study ps ON (ps.ID = cd.ProdiID)
                                    LEFT JOIN db_akademik.education_level el ON (el.ID = cd.EducationLevelID)
                                    LEFT JOIN db_akademik.courses_groups cg ON (cg.ID = cd.CoursesGroupsID)
                                    LEFT JOIN db_employees.employees em ON (cd.LecturerNIP = em.NIP)
                                    LEFT JOIN db_akademik.mata_kuliah mk ON (cd.MKID = mk.ID AND cd.MKCode = mk.MKCode)
                                    WHERE cd.ID = "'.$CDID.'" ');

        return $data->result_array();
    }


    public function __genrateMKCode($ID){
        $data = $this->db->query('SELECT count(*) AS TotalMK FROM db_akademik.mata_kuliah WHERE BaseProdiID="'.$ID.'" ');
        return $data->result_array();
    }

    public function __cekMKCode($MKCode){
        $data = $this->db->query('SELECT MKCode FROM db_akademik.mata_kuliah WHERE MKCode LIKE "'.$MKCode.'" ');
        return $data->result_array();
    }

    public function __cekTotalLAD($ladID){
        $data = $this->db->query('SELECT * FROM db_akademik.lecturers_availability_detail 
                                        WHERE LecturersAvailabilityID="'.$ladID.'" ');

        return $data->result_array();
    }

    public function __crudDataDetailTahunAkademik($id){

        $data = $this->db->query('SELECT * FROM db_akademik.semester 
                                    WHERE ID = "'.$id.'"');
        return $data->result_array();

    }

}
