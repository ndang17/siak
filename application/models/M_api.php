<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_api extends CI_Model {


    public function __getGradeByIDKurikulum($CurriculumID){
        $data = $this->db->query('SELECT * FROM db_academic.grade WHERE CurriculumID = "'.$CurriculumID.'" ');
        return $data->result_array();
    }

    public function __getMataKuliahByIDKurikulum($CurriculumID){
        $data = $this->db->query('SELECT ps.Name AS ProdiName, ps.NameEng AS ProdiNameEng, 
                                          mk.MKCode, mk.Name AS NameMK, mk.NameEng AS NameMKEng, 
                                          cd.Semester , cd.TotalSKS,
                                          em.Name AS NameLecturer
                                    FROM db_academic.mata_kuliah mk 
                                    JOIN db_academic.curriculum_details cd ON (mk.ID = cd.MKID)
                                    JOIN db_academic.program_study ps ON (cd.ProdiID = ps.ID)
                                    JOIN db_employees.employees em ON (cd.LecturerNIP = em.NIP)
                                    WHERE cd.CurriculumID="'.$CurriculumID.'" ORDER BY ProdiName');
        return $data->result_array();
    }

    public function __getBaseProdi()
    {
        $data = $this->db->query('SELECT * FROM db_academic.program_study');
        return $data->result_array();
    }

    public function __getBaseProdiSelectOption()
    {
//        $data = $this->db->query('SELECT ID,Code,Name,NameEng FROM db_academic.program_study');
        $data = $this->db->query('SELECT ID,Code,Name,NameEng FROM db_academic.program_study WHERE Status=1');
        return $data->result_array();
    }

    public function __getBaseProdiSelectOptionAll()
    {
        $data = $this->db->query('SELECT ID,Code,Name,NameEng FROM db_academic.program_study');
//        $data = $this->db->query('SELECT ID,Code,Name,NameEng FROM db_academic.program_study WHERE Status=1');
        return $data->result_array();
    }

    public function __getMKByID($ID){
        $data = $this->db->query('SELECT mk.*, ps.Code AS ProdiCode FROM db_academic.mata_kuliah mk
                                    LEFT JOIN db_academic.program_study ps ON (mk.BaseProdiID = ps.ID)
                                    WHERE mk.ID = "'.$ID.'" LIMIT 1');
        return $data->result_array();
    }

    public function __getLecturer(){
        $data = $this->db->query('SELECT * FROM db_employees.employees WHERE PositionMain = "14.7"');
        return $data->result_array();
    }

    public function __getAllMK(){
        $data = $this->db->query('SELECT mk.*,pg.Code, pg.Name AS NameProdi 
                                    FROM db_academic.mata_kuliah mk 
                                    JOIN db_academic.program_study pg 
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

            for($i=0;$i<count($semester);$i++){
                $semester[$i]['DetailSemester'] = $this->DetailMK($detail_kurikulum['ID'],$semester[$i]['Semester'],$ProdiID);
            }

            $result = array(
                'DetailKurikulum' => $detail_kurikulum,
                'MataKuliah' => $semester
            );
        } else {
            $result = false;
        }

        return $result;
    }

    private function Kurikulum($year){
        $data = $this->db->query('SELECT c.*,e.Name AS CreateByName, e2.Name AS UpdateByName FROM db_academic.curriculum c
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
                                      FROM db_academic.curriculum_details cd 
                                      WHERE cd.CurriculumID="'.$CurriculumID.'" GROUP BY cd.Semester;');

        return $data->result_array();
    }


    private function DetailMK($CurriculumID,$Semester,$ProdiID){
        $select = 'SELECT 
                    ps.Name AS ProdiName, ps.NameEng AS ProdiNameEng, 
                    mk.MKCode, mk.Name AS NameMK, mk.NameEng AS NameMKEng, 
                    cd.ID AS CDID, cd.CurriculumID, cd.Semester , cd.TotalSKS, cd.SKSTeori, 
                    cd.SKSPraktikum, cd.SKSPraktikLapangan, cd.MKType, cd.DataPrecondition,
                    cd.StatusSilabus, cd.StatusSAP, cd.StatusMK, cd.StatusPrecondition,
                    em.Name AS NameLecturer,edu.Name AS EducationLevel';

        if($ProdiID!=''){
            $data = $this->db->query($select.' FROM db_academic.curriculum_details cd 
                                                LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID)
                                                LEFT JOIN db_academic.program_study ps ON (cd.ProdiID = ps.ID)
                                                LEFT JOIN db_employees.employees em ON (cd.LecturerNIP = em.NIP)
                                                LEFT JOIN db_academic.education_level edu ON (edu.ID = cd.EducationLevelID)
                                                WHERE cd.CurriculumID="'.$CurriculumID.'" 
                                                AND cd.Semester="'.$Semester.'"
                                                AND cd.ProdiID="'.$ProdiID.'"
                                                ORDER BY mk.MKCode ASC');
        } else {
            $data = $this->db->query($select.' FROM db_academic.curriculum_details cd 
                                                LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID)
                                                LEFT JOIN db_academic.program_study ps ON (cd.ProdiID = ps.ID)
                                                LEFT JOIN db_employees.employees em ON (cd.LecturerNIP = em.NIP)
                                                LEFT JOIN db_academic.education_level edu ON (edu.ID = cd.EducationLevelID)
                                                WHERE cd.CurriculumID="'.$CurriculumID.'" 
                                                AND cd.Semester="'.$Semester.'"
                                                ORDER BY mk.MKCode ASC');
        }


        return $data->result_array();
    }


    public function cekTahunKurikulum($year){
        $data = $this->db->query('SELECT * FROM db_academic.curriculum WHERE Year = "'.$year.'"');

        return $data->result_array();
    }

    public function __getKurikulumSelectOption(){
        $data = $this->db->query('SELECT ID,Year,Name FROM db_academic.curriculum ORDER BY Year DESC');

        return $data->result_array();
    }

    public function __geteducationLevel(){
        $data = $this->db->query('SELECT * FROM db_academic.education_level ORDER BY EducationLevelID DESC');

        return $data->result_array();
    }

    public function __getDosenSelectOption(){
        $data = $this->db->query('SELECT ID,NIP,NIDN,Name FROM db_employees.employees WHERE PositionMain = "14.7"');
        return $data->result_array();
    }

    public function __getItemKuriklum($table){

        $data = $this->db->query('SELECT * FROM db_academic.'.$table);
        return $data->result_array();
    }

    public function __getdetailKurikulum($CDID){

        $data = $this->db->query('SELECT cd.*,
                                    ct.Name AS NameCurriculumType,
                                    ps.Name AS NameProdi,
                                    el.Name AS NameEducationLevel,
                                    cg.Name AS NameCoursesGroups,
                                    em.Name AS NameLecturer,
                                    mk.Name AS NameMK,
                                    mk.NameEng AS NameMKEng
                                    FROM db_academic.curriculum_details cd
                                    LEFT JOIN db_academic.curriculum_types ct ON (ct.ID = cd.CurriculumTypeID)
                                    LEFT JOIN db_academic.program_study ps ON (ps.ID = cd.ProdiID)
                                    LEFT JOIN db_academic.education_level el ON (el.ID = cd.EducationLevelID)
                                    LEFT JOIN db_academic.courses_groups cg ON (cg.ID = cd.CoursesGroupsID)
                                    LEFT JOIN db_employees.employees em ON (cd.LecturerNIP = em.NIP)
                                    LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID AND cd.MKCode = mk.MKCode)
                                    WHERE cd.ID = "'.$CDID.'" ')->result_array();


        if($data[0]['StatusPrecondition']==1){
            $dataPre = json_decode($data[0]['DataPrecondition']);

            $pre_arr = [];
            for($i=0;$i<count($dataPre);$i++){
                $exp = explode('.',$dataPre[$i]);
                $pre = $this->db->query('SELECT ID,MKcode,Name,NameEng FROM db_academic.mata_kuliah 
                                            WHERE ID="'.$exp[0].'" AND MKCode = "'.$exp[1].'" ')->result_array();

                array_push($pre_arr,$pre[0]);
            }

            $data[0]['DetailPrecondition'] = $pre_arr;

        }

//        print_r($data);
//        exit;

        return $data;
    }


    public function __genrateMKCode($ID){
        $data = $this->db->query('SELECT count(*) AS TotalMK FROM db_academic.mata_kuliah WHERE BaseProdiID="'.$ID.'" ');
        return $data->result_array();
    }

    public function __cekMKCode($MKCode){
        $data = $this->db->query('SELECT MKCode FROM db_academic.mata_kuliah WHERE MKCode LIKE "'.$MKCode.'" ');
        return $data->result_array();
    }

    public function __cekTotalLAD($ladID){
        $data = $this->db->query('SELECT * FROM db_academic.lecturers_availability_detail 
                                        WHERE LecturersAvailabilityID="'.$ladID.'" ');

        return $data->result_array();
    }

    public function __crudDataDetailTahunAkademik($id){

        $data = $this->db->query('SELECT * FROM db_academic.semester 
                                    WHERE ID = "'.$id.'"')->result_array();

        if(count($data)>0){
            $dataDetail = $this->db->query('SELECT * FROM db_academic.academic_years 
                                              WHERE SemesterID = "'.$id.'"')->result_array();

            $result['TahunAkademik'] = $data[0];
            $result['DetailTA'] = $dataDetail[0];
        } else {
            $result = false;
        }
        return $result;

    }

    public function __getAcademicYearOnPublish(){
        $data = $this->db->query('SELECT * FROM db_academic.semester s WHERE s.Status=1');

        return $data->result_array();
    }

    public function getMataKuliahSingle($ID,$MKCode){
        $data = $this->db->query('SELECT mk.*,cd.Semester,cd.TotalSKS FROM db_academic.mata_kuliah mk
                                      LEFT JOIN db_academic.curriculum_details cd ON (mk.ID = cd.MKID AND mk.MKCode=cd.MKCode)
                                      WHERE mk.ID="'.$ID.'" AND mk.MKCode = "'.$MKCode.'" ');
        return $data->result_array();
    }

    public function getMatakuliahOfferings($SemesterID,$MKID,$MKCode){

        $data = $this->db->query('SELECT cd.Semester, cd.TotalSKS FROM db_academic.course_offerings co 
                                           LEFT JOIN db_academic.curriculum_details cd ON (co.CurriculumDetailID = cd.ID)
                                           WHERE co.SemesterID = "'.$SemesterID.'" AND cd.MKID = "'.$MKID.'" AND cd.MKCode = "'.$MKCode.'" 
                                           ');

        return $data->result_array();
    }

    public function getProgramCampus(){
        $data = $this->db->query('SELECT * FROM db_academic.programs_campus ORDER BY ID ASC');

        return $data->result_array();
    }

    public function getSemester($order){
        $data = $this->db->query('SELECT * FROM db_academic.semester ORDER BY ID '.$order);

        return $data->result_array();
    }

    public function getSemesterActive($ProdiID){
        $data = $this->db->query('SELECT * FROM db_academic.semester WHERE Status = 1 LIMIT 1')->result_array();

        $result = array(
            'SemesterActive' => $data[0],
            'DetailCourses' => $this->getDetailCourses($data[0]['CurriculumID'],$ProdiID)
        );

        return $result;
    }

    private function getDetailCourses($CurriculumID,$ProdiID){
        $data = $this->db->query('SELECT cd.ID AS CurriculumDetailID,cd.Semester, cd.MKType, cd.MKID, cd.MKCode, cd.TotalSKS, cd.StatusMK, 
                                    mk.Name AS MKName, mk.NameEng AS MKNameEng,
                                    ps.Code AS ProdiCode, ps.Name AS ProdiName, ps.NameEng AS ProdiNameEng
                                    FROM db_academic.curriculum_details cd
                                    LEFT JOIN db_academic.program_study ps ON (cd.ProdiID = ps.ID)
                                    LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID AND cd.MKCode = mk.MKCode)
                                    LEFT JOIN db_academic.course_offerings co ON (cd.ID = co.CurriculumDetailID)
                                    WHERE cd.CurriculumID = "'.$CurriculumID.'" AND cd.ProdiID = "'.$ProdiID.'" AND co.ID IS NULL ORDER BY cd.Semester , ps.Code ASC');
        return $data->result_array();
    }

    public function getAllCourseOfferings($SemesterID,$ProdiID){

        $dataProdi = $this->db->query('SELECT * FROM db_academic.program_study WHERE Status = 1 AND ID = "'.$ProdiID.'" ORDER BY ID ASC ')->result_array();

        $result = [];
        for($i=0;$i<count($dataProdi);$i++){
            $dataOfferings = $this->getDetailOfferings($SemesterID,$dataProdi[$i]['ID']);
            $data = array(
                'Prodi' => array(
                    'ID' => $dataProdi[$i]['ID'],
                    'Code' => $dataProdi[$i]['Code'],
                    'Name' => $dataProdi[$i]['Name'],
                    'NameEng' => $dataProdi[$i]['NameEng'],
                ),
                'Offerings' => $dataOfferings
            );

            array_push($result,$data);
        }

        return $result;
    }

    private function getDetailOfferings($SemesterID,$ProdiID){
        $data = $this->db->query('SELECT co.ID, cd.Semester, cd.MKType, cd.MKID, cd.MKCode, cd.TotalSKS, cd.StatusMK, 
                                          mk.Name AS MKName, mk.NameEng AS MKNameEng, s.ID AS ScheduleID
                                            FROM db_academic.course_offerings co
                                            LEFT JOIN db_academic.curriculum_details cd ON (co.CurriculumDetailID = cd.ID)
                                            LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID AND cd.MKCode = mk.MKCode)
                                            LEFT JOIN db_academic.schedule s ON (s.SemesterID = co.SemesterID AND cd.MKID = s.MKID AND cd.MKCode = s.MKCode)
                                            WHERE  co.SemesterID = "'.$SemesterID.'" AND co.ProdiID = "'.$ProdiID.'"
                                   ');
        return $data->result_array();
    }

    public function getAllCourseOfferingsMKU($SemesterID){

        $data = $this->db->query('SELECT co.ID, cd.Semester, cd.MKType, cd.MKID, cd.MKCode, cd.TotalSKS, cd.StatusMK, 
                                          mk.Name AS MKName, mk.NameEng AS MKNameEng , s.ID AS ScheduleID
                                        FROM db_academic.course_offerings co
                                        LEFT JOIN db_academic.curriculum_details cd ON (co.CurriculumDetailID = cd.ID)
                                        LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID AND cd.MKCode = mk.MKCode)
                                        LEFT JOIN db_academic.schedule s ON (s.SemesterID = co.SemesterID AND cd.MKID = s.MKID AND cd.MKCode = s.MKCode)
                                        WHERE co.SemesterID = "'.$SemesterID.'" AND mk.BaseProdiID = 7 GROUP BY cd.MKCode
                                        ');

        return $data->result_array();

    }



    public function getSchedule($DayID,$dataWhere){

//        $data = $this->db->query('SELECT s.*,
//                                          ses.*,
//                                          mk.Name AS MKName, mk.NameEng AS MKNameEng,
//                                          em.Name AS Lecturer,
//                                          cl.Room
//                                          FROM db_academic.schedule s
//                                              LEFT JOIN db_academic.mata_kuliah mk ON (mk.ID = s.MKID AND mk.MKCode = s.MKCode)
//                                              LEFT JOIN db_employees.employees em ON (em.NIP = s.Coordinator)
//                                              LEFT JOIN db_academic.schedule_details ses ON (ses.ScheduleID = s.ID)
//                                              LEFT JOIN db_academic.classroom cl ON (cl.ID = ses.ClassroomID)
//                                              WHERE ses.DayID = "'.$DayID.'" ');

        $ProgramsCampusID = ($dataWhere['ProgramsCampusID']!='') ? ' AND s.ProgramsCampusID = "'.$dataWhere['ProgramsCampusID'].'" ' : '';
        $SemesterID = ($dataWhere['SemesterID']!='') ? ' AND s.SemesterID = "'.$dataWhere['SemesterID'].'" ' : '';
        $ProdiID = ($dataWhere['ProdiID']!='') ? ' AND s.ProdiID = "'.$dataWhere['ProdiID'].'" ' : '';
        $CombinedClasses = ($dataWhere['CombinedClasses']!='') ? ' AND s.CombinedClasses = "'.$dataWhere['CombinedClasses'].'" ' : '';

        $data = $this->db->query('SELECT s.*,
                                          sd.ClassroomID,sd.Credit,sd.DayID,sd.TimePerCredit,sd.StartSessions,sd.EndSessions,
                                          mk.Name AS MKName, mk.NameEng AS MKNameEng,
                                          em.Name AS Lecturer,
                                          cl.Room 
                                          FROM db_academic.schedule_details sd
                                          LEFT JOIN db_academic.schedule s ON (s.ID=sd.ScheduleID)
                                          LEFT JOIN db_academic.mata_kuliah mk ON (mk.ID = s.MKID AND mk.MKCode = s.MKCode)
                                          LEFT JOIN db_employees.employees em ON (em.NIP = s.Coordinator)
                                          LEFT JOIN db_academic.classroom cl ON (cl.ID = sd.ClassroomID)                                   
                                          WHERE sd.DayID = "'.$DayID.'" '.$ProgramsCampusID.' '.$SemesterID.' '.$ProdiID.' '.$CombinedClasses);

        $result = $data->result_array();


        if(count($result)>0){
            for($i=0;$i<count($result);$i++){
                if($result[$i]['TeamTeaching']==1){
                    $result[$i]['DetailTeamTeaching'] = $this->getTeamTeaching($result[$i]['ID']);
                }

            }
        }

        return $result;

    }

    private function getTeamTeaching($ScheduleID){
        $data = $this->db->query('SELECT stt.ID,stt.NIP,stt.Status,em.Name AS Lecturer FROM db_academic.schedule_team_teaching stt
                                            LEFT JOIN db_employees.employees em ON (em.NIP = stt.NIP)
                                            WHERE stt.ScheduleID = "'.$ScheduleID.'" ');

        return $data->result_array();
    }

    public function getSchedule2($DayID,$dataWhere){

        if(count($DayID)>0){

        } else {
            for($i=0;$i<count();$i++){

            }

        }




        if(count($dataWhere)>0){
            $where = '';
            for($i=0;$i<count($dataWhere);$i++){
                if($dataWhere['ProgramCampusID']!=''){
                    $where = $where.' AND ProgramCampusID='.$dataWhere['ProgramCampusID'];
                }

                if($dataWhere['SemesterID']!=''){
                    $where = $where.' AND SemesterID='.$dataWhere['SemesterID'];
                }
            }
        }

    }


    // Database Mahasiswa
    public function __getTahunAngkatan(){
        $data = $this->db->query('SELECT Year FROM db_academic.auth_students 
                                                GROUP BY Year ORDER BY Year ASC')->result_array();

        $result=[];
        for($i=0;$i<count($data);$i++){
            $DataStudents = $this->__getStudents($data[$i]['Year']);
            $result[$i]['Angkatan'] = $data[$i]['Year'];
            $result[$i]['DataStudents'] = $DataStudents;
        }
        return $result;
    }

    private function __getStudents($ta){
        $db = 'ta_'.$ta;
        $data = $this->db->query('SELECT s.*, au.EmailPU, p.Name AS ProdiName, p.NameEng AS ProdiNameEng,
                                      ss.Description AS StatusStudentDesc
                                      FROM '.$db.'.students s
                                      JOIN db_academic.program_study p ON (s.ProdiID = p.ID)
                                      JOIN db_academic.status_student ss ON (s.StatusStudentID = ss.ID)
                                      JOIN db_academic.auth_students au ON (s.NPM = au.NPM) 
                                      ORDER BY s.NPM ASC ');

        return $data->result_array();
    }

    public function __getStudentByNPM($ta,$NPM){

        $db = 'ta_'.$ta;
        $data = $this->db->query('SELECT s.*, au.EmailPU, p.Name AS ProdiName, p.NameEng AS ProdiNameEng,
                                      ss.Description AS StatusStudentDesc
                                      FROM '.$db.'.students s
                                      JOIN db_academic.program_study p ON (s.ProdiID = p.ID)
                                      JOIN db_academic.status_student ss ON (s.StatusStudentID = ss.ID)
                                      JOIN db_academic.auth_students au ON (s.NPM = au.NPM)
                                      WHERE s.NPM = "'.$NPM.'" LIMIT 1');

        return $data->result_array();
    }

    public function __checkClassGroup($ProgramsCampusID,$SemesterID,$ProdiCode){

        $data = $this->db->query('SELECT * FROM db_academic.schedule_class_group 
                                            WHERE ProgramsCampusID = "'.$ProgramsCampusID.'" AND
                                            SemesterID = "'.$SemesterID.'" AND
                                            ProdiCode = "'.$ProdiCode.'"
                                             ');
        return $data->result_array();
    }

    public function __getAllClassRoom(){
        $data = $this->db->query('SELECT * FROM db_academic.classroom');
        return $data->result_array();
    }

    public function __getAllGrade(){
        $data = $this->db->query('SELECT * FROM db_academic.grade ORDER BY EndRange DESC');
        return $data->result_array();
    }

    public function __getAllTimePerCredit(){
        $data = $this->db->query('SELECT * FROM db_academic.time_per_credits ORDER BY Time DESC');
        return $data->result_array();
    }

    public function __checkSchedule($dataFilter){
//        print_r($dataFilter);
        // Get Jadwal
        $jadwal = $this->db->query('SELECT sd.DayID,sd.StartSessions, sd.EndSessions, cl.Room, mk.NameEng FROM db_academic.schedule s
                                              RIGHT JOIN db_academic.schedule_details sd ON (s.ID=sd.ScheduleID)   
                                              LEFT JOIN db_academic.classroom cl ON (cl.ID = sd.ClassroomID)
                                              LEFT JOIN db_academic.mata_kuliah mk ON (mk.ID = s.MKID AND mk.MKCode = s.MKCode)
                                              WHERE s.SemesterID="'.$dataFilter['SemesterID'].'"
                                              AND sd.ClassroomID="'.$dataFilter['ClassroomID'].'" 
                                              AND sd.DayID="'.$dataFilter['DayID'].'" 
                                              AND (("'.$dataFilter['StartSessions'].'" >= sd.StartSessions  AND "'.$dataFilter['StartSessions'].'" <= sd.EndSessions) OR
                                              ("'.$dataFilter['EndSessions'].'" >= sd.StartSessions AND "'.$dataFilter['EndSessions'].'" <= sd.EndSessions) OR
                                              ("'.$dataFilter['StartSessions'].'" <= sd.StartSessions AND "'.$dataFilter['EndSessions'].'" >= sd.EndSessions)
                                              ) ORDER BY sd.StartSessions ASC 
                                              ')->result_array();

//        if(count($jadwal)>0){
//            $ce
//        }

        return $jadwal;

    }




}
