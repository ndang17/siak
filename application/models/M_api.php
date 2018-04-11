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
    public function __getKurikulumByYear($SemesterSearch,$year,$ProdiID){

        // Mendapatkan Kurikulum
        $detail_kurikulum = $this->Kurikulum($year);

        if($detail_kurikulum!=''){

            // Mendapatkan Total Semester Yang ada dalam kurikulum ini
            $semester = $this->Semester($detail_kurikulum['ID']);

            for($i=0;$i<count($semester);$i++){
                $semester[$i]['DetailSemester'] = $this->DetailMK($SemesterSearch,$detail_kurikulum['ID'],$ProdiID,$semester[$i]['Semester']);
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


    private function DetailMK($SemesterSearch,$CurriculumID,$ProdiID,$Semester){
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
                                                ORDER BY mk.MKCode ASC')->result_array();
        } else {
            $data = $this->db->query($select.' FROM db_academic.curriculum_details cd 
                                                LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID)
                                                LEFT JOIN db_academic.program_study ps ON (cd.ProdiID = ps.ID)
                                                LEFT JOIN db_employees.employees em ON (cd.LecturerNIP = em.NIP)
                                                LEFT JOIN db_academic.education_level edu ON (edu.ID = cd.EducationLevelID)
                                                WHERE cd.CurriculumID="'.$CurriculumID.'" 
                                                AND cd.Semester="'.$Semester.'"
                                                ORDER BY mk.MKCode ASC')->result_array();
        }

        if(count($data)>0 && $SemesterSearch!=''){
            $dataSMT = $this->db->query('SELECT * FROM db_academic.semester WHERE Status = 1 LIMIT 1')->result_array();
            for($i=0;$i<count($data);$i++){
                $data[$i]['Offering'] = false;
                $dataOffering = $this->db->query('SELECT co.Arr_CDID FROM db_academic.course_offerings co
                                    WHERE
                                    co.SemesterID = "'.$dataSMT[0]['ID'].'"
                                    AND co.CurriculumID = "'.$CurriculumID.'"
                                    AND co.ProdiID = "'.$ProdiID.'"
                                    AND co.Semester = "'.$SemesterSearch.'" LIMIT 1 ')->result_array();


                if(count($dataOffering)){
                    $dataCourse = json_decode($dataOffering[0]['Arr_CDID']);

                    if(in_array($data[$i]['CDID'],$dataCourse)){
                        $data[$i]['Offering'] = true;
                    }

                }

            }
        }


        return $data;
    }


    public function cekTahunKurikulum($year){
        $data = $this->db->query('SELECT * FROM db_academic.curriculum WHERE Year = "'.$year.'"');

        return $data->result_array();
    }

    public function __getKurikulumSelectOption(){
        $data = $this->db->query('SELECT * FROM db_academic.curriculum ORDER BY Year DESC');

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
                                    LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID)
                                    WHERE cd.ID = "'.$CDID.'" ')->result_array();


        if($data[0]['StatusPrecondition']==1){
            $dataPre = json_decode($data[0]['DataPrecondition']);

            $pre_arr = [];
            for($i=0;$i<count($dataPre);$i++){
                $exp = explode('.',$dataPre[$i]);
                $pre = $this->db->query('SELECT ID,MKcode,Name,NameEng FROM db_academic.mata_kuliah 
                                            WHERE ID="'.$exp[0].'"')->result_array();

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

//            $dt = (count($dataDetail)>0) ? $dataDetail[0] : '';

            if(count($dataDetail)>0){
                $result['DetailTA'] = $dataDetail[0];
            }

            $result['TahunAkademik'] = $data[0];
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

    public function getSemesterActive($CurriculumID,$ProdiID,$Semester,$IsSemesterAntara){
        $data = $this->db->query('SELECT * FROM db_academic.semester WHERE Status = 1 LIMIT 1')->result_array();

        $result = array(
            'SemesterActive' => $data[0],
            'DetailCourses' => $this->getDetailCourses($data[0]['ID'],$CurriculumID,$ProdiID,$Semester,$IsSemesterAntara)
        );

        return $result;
    }

    private function getDetailCourses($SemesterID,$CurriculumID,$ProdiID,$Semester,$IsSemesterAntara){
//        $data = $this->db->query('SELECT cd.ID AS CurriculumDetailID,cd.Semester, cd.MKType, cd.MKID, mk.MKCode, cd.TotalSKS, cd.StatusMK,
//                                    mk.Name AS MKName, mk.NameEng AS MKNameEng,
//                                    ps.Code AS ProdiCode, ps.Name AS ProdiName, ps.NameEng AS ProdiNameEng
//                                    FROM db_academic.curriculum_details cd
//                                    LEFT JOIN db_academic.program_study ps ON (cd.ProdiID = ps.ID)
//                                    LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID)
//                                    LEFT JOIN db_academic.course_offerings co ON (cd.ID = co.CurriculumDetailID)
//                                    WHERE cd.CurriculumID = "'.$CurriculumID.'"
//                                    AND cd.ProdiID = "'.$ProdiID.'"
//                                    AND cd.Semester = "'.$Semester.'"
//                                    AND co.ID IS NULL
//                                    ORDER BY cd.Semester , ps.Code ASC');

        $data = $this->db->query('SELECT cd.ID AS CurriculumDetailID,cd.Semester, cd.MKType, cd.MKID, mk.MKCode, cd.TotalSKS, cd.StatusMK, 
                                    mk.Name AS MKName, mk.NameEng AS MKNameEng,
                                    ps.Code AS ProdiCode, ps.Name AS ProdiName, ps.NameEng AS ProdiNameEng
                                    FROM db_academic.curriculum_details cd
                                    LEFT JOIN db_academic.program_study ps ON (cd.ProdiID = ps.ID)
                                    LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID)
                                    
                                    WHERE cd.CurriculumID = "'.$CurriculumID.'" 
                                    AND cd.ProdiID = "'.$ProdiID.'" 
                                    AND cd.Semester = "'.$Semester.'" 
                                     
                                    ORDER BY cd.Semester , ps.Code ASC')->result_array();



        if(count($data)>0){
            for($i=0;$i<count($data);$i++){
                $data[$i]['Offering'] = false;
                $dataOffering = $this->db->query('SELECT co.Arr_CDID FROM db_academic.course_offerings co
                                    WHERE 
                                    co.SemesterID = "'.$SemesterID.'" 
                                    AND co.CurriculumID = "'.$CurriculumID.'" 
                                    AND co.ProdiID = "'.$ProdiID.'" 
                                    AND co.Semester = "'.$Semester.'"
                                    AND co.IsSemesterAntara = "'.$IsSemesterAntara.'" LIMIT 1 ')->result_array();

                if(count($dataOffering)){
                    $dataCourse = json_decode($dataOffering[0]['Arr_CDID']);

                    if(in_array($data[$i]['CurriculumDetailID'],$dataCourse)){
                        $data[$i]['Offering'] = true;
                    }

                }


            }
        }

//        print_r($data);





        return $data;
    }

    public function getAllCourseOfferings($SemesterID,$CurriculumID,$ProdiID,$Semester,$IsSemesterAntara){

        $dataProdi = $this->db->query('SELECT * FROM db_academic.program_study WHERE Status = 1 AND ID = "'.$ProdiID.'" ORDER BY ID ASC ')->result_array();

        $result = [];
        for($i=0;$i<count($dataProdi);$i++){
            $dataOfferings = $this->getDetailAllOfferings($SemesterID,$CurriculumID,$ProdiID,$Semester,$IsSemesterAntara);
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

    private function getDetailAllOfferings($SemesterID,$CurriculumID,$ProdiID,$Semester,$IsSemesterAntara){

        $data = $this->db->query('SELECT * FROM db_academic.course_offerings co 
                                        WHERE co.SemesterID = "'.$SemesterID.'" 
                                        AND co.CurriculumID = "'.$CurriculumID.'" 
                                        AND co.ProdiID = "'.$ProdiID.'" 
                                        AND co.Semester = "'.$Semester.'"
                                        AND co.IsSemesterAntara = "'.$IsSemesterAntara.'"
                                         LIMIT 1 ')->result_array();

        $result = [];
        if(count($data)>0){
            $Course = json_decode($data[0]['Arr_CDID']);

            $CourseArr = [];

            for($i=0;$i<count($Course);$i++){
                $dataCourse = $this->db->query('SELECT cd.ID AS CDID, cd.ProdiID, cd.Semester, cd.MKType, cd.TotalSKS, cd.StatusMK, cd.MKID,
						                              mk.NameEng AS MKNameEng,
                                                      mk.Name AS MKName, mk.MKCode
                                                      FROM db_academic.curriculum_details cd
                                                      LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID)
                                                      WHERE cd.ID = "'.$Course[$i].'" 
                                                      LIMIT 1')->result_array()[0];

                $dataCekInSchedule = $this->db->query('SELECT s1.ID AS ScheduleID
                                                      FROM db_academic.curriculum_details cd
                                                      LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID)
                                                      LEFT JOIN db_academic.schedule_details_course sdc1 ON (sdc1.MKID = mk.ID)
                                                      LEFT JOIN db_academic.schedule s1 ON (sdc1.ScheduleID = s1.ID)
                                                      WHERE cd.ID = "'.$Course[$i].'" 
                                                      AND cd.MKID IN (
                                                            SELECT sdc.MKID FROM db_academic.schedule_details_course sdc 
                                                            LEFT JOIN db_academic.Schedule s ON (sdc.ScheduleID = s.ID) 
                                                            ) 
                                                      LIMIT 1')->result_array();

                $dataCourse['ScheduleID'] = (count($dataCekInSchedule)>0) ? $dataCekInSchedule[0]['ScheduleID'] : null;

                array_push($CourseArr,$dataCourse);



            }

            $result = $data;

            $result[0]['Details'] = $CourseArr;
        }

        return $result;

    }

    private function getDetailOfferings($SemesterID,$ProdiID){

//        $data = $this->db->query('SELECT co.ID, cd.Semester, cd.MKType, cd.MKID, cd.MKCode, cd.TotalSKS, cd.StatusMK,
//                                          mk.Name AS MKName, mk.NameEng AS MKNameEng, s.ID AS ScheduleID
//                                            FROM db_academic.course_offerings co
//                                            LEFT JOIN db_academic.curriculum_details cd ON (co.CurriculumDetailID = cd.ID)
//                                            LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID AND cd.MKCode = mk.MKCode)
//                                            LEFT JOIN db_academic.schedule s ON (s.SemesterID = co.SemesterID AND cd.MKID = s.MKID AND cd.MKCode = s.MKCode)
//                                            WHERE  co.SemesterID = "'.$SemesterID.'" AND co.ProdiID = "'.$ProdiID.'"
//                                   ');

        // Load Mata Kuliah Saat Input Jadwal Tanpa Mata Kuliah Umum
        $data = $this->db->query('SELECT co.ID, co.ToSemester, cd.ProdiID, cd.Semester, cd.MKType, cd.MKID, mk.MKCode, cd.TotalSKS, cd.StatusMK, 
                                          mk.Name AS MKName, mk.NameEng AS MKNameEng, s.ID AS ScheduleID
                                            FROM db_academic.course_offerings co
                                            LEFT JOIN db_academic.curriculum_details cd ON (co.CurriculumDetailID = cd.ID)
                                            LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID)
                                            LEFT JOIN db_academic.schedule s ON (s.SemesterID = co.SemesterID AND cd.MKID = s.MKID)
                                            WHERE  co.SemesterID = "'.$SemesterID.'" AND co.ProdiID = "'.$ProdiID.'" AND mk.BaseProdiID != 7
                                   ');
        return $data->result_array();
    }

    public function getAllCourseOfferingsMKU($SemesterID){

        $data = $this->db->query('SELECT co.ID, cd.Semester, cd.MKType, cd.MKID, mk.MKCode, cd.TotalSKS, cd.StatusMK, 
                                          mk.Name AS MKName, mk.NameEng AS MKNameEng , s.ID AS ScheduleID
                                        FROM db_academic.course_offerings co
                                        LEFT JOIN db_academic.curriculum_details cd ON (co.CurriculumDetailID = cd.ID)
                                        LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID)
                                        LEFT JOIN db_academic.schedule s ON (s.SemesterID = co.SemesterID AND cd.MKID = s.MKID AND cd.MKCode = s.MKCode)
                                        WHERE co.SemesterID = "'.$SemesterID.'" AND mk.BaseProdiID = 7 GROUP BY cd.MKCode
                                        ');

        return $data->result_array();

    }


    public function getOfferingsToSetSchedule($dataForm){

//        print_r($dataForm);

        $query = $this->db
            ->get_where('db_academic.course_offerings', $dataForm)->result_array();

        $result = [];
        if(count($query)>0){
            for($i=0;$i<count($query);$i++){
                $dt = $this->getOfferingsToSetScheduleDetails($query[$i],$query[$i]['Arr_CDID']);
                $dataRes = array(
                    'Offerings' => $query[$i],
                    'Details' => $dt
                );

                array_push($result,$dataRes);
            }
        }

        return $result;
    }

    private function getOfferingsToSetScheduleDetails($query,$Arr_CDID){
        $data_CDID = json_decode($Arr_CDID);
        $result = [];
        for($i=0;$i<count($data_CDID);$i++){
            $data = $this->db->query('SELECT cd.ID AS CDID, cd.TotalSKS, mk.ID,mk.MKCode,mk.Name AS MKName, mk.NameEng AS MKNameEng, cd.Semester 
                                                FROM db_academic.curriculum_details cd 
                                                LEFT JOIN db_academic.mata_kuliah mk ON (cd.MKID = mk.ID)
                                                WHERE cd.ID = "'.$data_CDID[$i].'" LIMIT 1')->result_array();



            if(count($data)>0){
                $sc = $this->db->query('SELECT s.ID AS ScheduleID FROM db_academic.schedule_details_course sdc
                                                  JOIN db_academic.schedule s ON (s.ID=sdc.ScheduleID)
                                                  WHERE s.SemesterID = "'.$query['SemesterID'].'" 
                                                  AND s.ProgramsCampusID = "'.$query['ProgramsCampusID'].'"
                                                  AND sdc.ProdiID = "'.$query['ProdiID'].'"
                                                  AND sdc.CDID = "'.$data_CDID[$i].'"
                                                  AND sdc.MKID = "'.$data[0]['ID'].'"
                                                  LIMIT 1
                                                   ')->result_array();
                $data[0]['ScheduleID'] = '';
                if(count($sc)>0){
                    $data[0]['ScheduleID'] = $sc[0]['ScheduleID'];
                }
                array_push($result,$data[0]);
            }


        }

        return $result;
    }

    public function getSemesterCurriculum($SemesterID,$IsSemesterAntara){

        $where = ($SemesterID!='' && $SemesterID!=0) ? 's.ID = '.$SemesterID : 's.Status = 1';

        $dataCurriculum = $this->db->query('SELECT * FROM db_academic.curriculum c 
                                                    WHERE c.Year <= (
                                                      SELECT Year FROM db_academic.semester s WHERE '.$where.' LIMIT 1) 
                                                      ORDER BY c.Year DESC ')
                                ->result_array();

        $result=[];

        for($s=0;$s<count($dataCurriculum);$s++){
            $data = $this->db->query('SELECT s.* FROM db_academic.semester s 
                                                    WHERE s.Year>="'.$dataCurriculum[$s]['Year'].'" ')
                                ->result_array();

            $smt=1;


            for($i=0;$i<count($data);$i++){

                if($SemesterID!='' && $SemesterID!=0){
                    if($data[$i]['ID']!=$SemesterID){
                        $smt = $smt + 1;
                    } else {
                        break;
                    }
                } else {
                    if($data[$i]['Status']==0){
                        $smt = $smt + 1;
                    } else {
                        break;
                    }
                }




            }

            $d = array(
                'Curriculum' => $dataCurriculum[$s],
                'Semester' => $smt
            );


            array_push($result,$d);

        }





        return $result;
    }


    public function getSchedule($DayID,$dataWhere){


        $ProgramsCampusID = ($dataWhere['ProgramsCampusID']!='') ? ' AND s.ProgramsCampusID = "'.$dataWhere['ProgramsCampusID'].'" ' : '';
        $SemesterID = ($dataWhere['SemesterID']!='') ? ' AND s.SemesterID = "'.$dataWhere['SemesterID'].'" ' : '';
        $CombinedClasses = ($dataWhere['CombinedClasses']!='') ? ' AND s.CombinedClasses = "'.$dataWhere['CombinedClasses'].'" ' : '';
        $IsSemesterAntara = ($dataWhere['IsSemesterAntara']!='') ? ' AND s.IsSemesterAntara = "'.$dataWhere['IsSemesterAntara'].'" ' : '';

        $data = $this->db->query('SELECT s.*,
                                          sd.ClassroomID,sd.Credit,sd.DayID,sd.TimePerCredit,sd.StartSessions,sd.EndSessions,
                                          em.Name AS Lecturer,
                                          cl.Room 
                                          FROM db_academic.schedule_details sd
                                          LEFT JOIN db_academic.schedule s ON (s.ID=sd.ScheduleID)
                                          LEFT JOIN db_employees.employees em ON (em.NIP = s.Coordinator)
                                          LEFT JOIN db_academic.classroom cl ON (cl.ID = sd.ClassroomID)                                   
                                          WHERE sd.DayID = "'.$DayID.'" '.$ProgramsCampusID.' '.$SemesterID.' '.$CombinedClasses.' '.$IsSemesterAntara.' ORDER BY sd.StartSessions ASC ');

        $result = $data->result_array();


        if(count($result)>0){

            $CO_SemesterID = ($dataWhere['SemesterID']!='') ? ' AND co.SemesterID = "'.$dataWhere['SemesterID'].'" ' : '';
            $CO_ProdiID = ($dataWhere['ProdiID']!='') ? ' AND co.ProdiID = "'.$dataWhere['ProdiID'].'" ' : '';
            $CO_IsSemesterAntara = ($dataWhere['IsSemesterAntara']!='') ? ' AND co.IsSemesterAntara = "'.$dataWhere['IsSemesterAntara'].'" ' : '';
            $CO_Semester = ($dataWhere['Semester']!='') ? ' AND co.Semester = "'.$dataWhere['Semester'].'" ' : '';


            // Get Course
            for($c=0;$c<count($result);$c++){
                $ProdiIDsdc = ($dataWhere['ProdiID']!='') ? ' AND sdc.ProdiID = "'.$dataWhere['ProdiID'].'" ' : '';



                $dataOffering = $this->db->query('SELECT * FROM db_academic.course_offerings co 
                                                          WHERE co.ProgramsCampusID = "'.$dataWhere['ProgramsCampusID'].'" '.$CO_Semester.' 
                                                           '.$CO_SemesterID.' '.$CO_ProdiID.' '.$CO_IsSemesterAntara.' ')->result_array();


                $dataCourse = [];

                if(count($dataOffering)>0){
                    for($f=0;$f<count($dataOffering);$f++){
                        $Arr_CDID = json_decode($dataOffering[$f]['Arr_CDID']);

                        for($s=0;$s<count($Arr_CDID);$s++){

                            $__course = $this->db->query('SELECT sdc.CDID, mk.ID, mk.MKCode, mk.NameEng AS MKNameEng, mk.Name AS MKName,
                                                          ps.NameEng AS ProdiEng, ps.name AS Prodi, ps.Code AS ProdiCode, cd.Semester AS BaseSemester
                                                          FROM db_academic.schedule_details_course sdc
                                                          LEFT JOIN db_academic.mata_kuliah mk ON (mk.ID = sdc.MKID)
                                                          LEFT JOIN db_academic.program_study ps ON (ps.ID = sdc.ProdiID)
                                                          LEFT JOIN db_academic.curriculum_details cd ON (cd.ID = sdc.CDID)
                                                          WHERE sdc.ScheduleID="'.$result[$c]['ID'].'" AND sdc.CDID = "'.$Arr_CDID[$s].'" LIMIT 1')->result_array();

                            if(count($__course)>0){
                                $__course[0]['Semester'] = $dataWhere['Semester'];
                                array_push($dataCourse,$__course[0]);
                            }
                        }

                    }
                }

//                $dataCourse = $this->db->query('SELECT sdc.CDID, mk.ID, mk.MKCode, mk.NameEng AS MKNameEng, mk.Name AS MKName,
//                                                          ps.NameEng AS ProdiEng, ps.name AS Prodi, ps.Code AS ProdiCode,
//                                                          co.Semester
//                                                          FROM db_academic.schedule_details_course sdc
//                                                          LEFT JOIN db_academic.mata_kuliah mk ON (mk.ID = sdc.MKID)
//                                                          LEFT JOIN db_academic.program_study ps ON (ps.ID = sdc.ProdiID)
//                                                          LEFT JOIN db_academic.course_offerings co ON (ps.ID = co.ProdiID)
//                                                          WHERE sdc.ScheduleID="'.$result[$c]['ID'].'" AND co.ProgramsCampusID = "'.$dataWhere['ProgramsCampusID'].'"
//                                                          '.$CO_Semester.'  '.$CO_SemesterID.' '.$CO_IsSemesterAntara.'
//                                                           '.$ProdiIDsdc);

//                for($s=0;$s<count($dataOffering);$s++){
//                    $mk = json_decode($dataOffering[$s]['Arr_CDID']);
//
//                }

                $result[$c]['SemesterDetails'] = $dataOffering;
                $result[$c]['DetailCourse'] = $dataCourse;

            }


            for($i=0;$i<count($result);$i++){
                if($result[$i]['TeamTeaching']==1){
                    $result[$i]['DetailTeamTeaching'] = $this->getTeamTeaching($result[$i]['ID']);
                }

            }
        }

        return $result;

    }

    public function getOneSchedule($ScheduleID){
//        $data = $this->db->query('SELECT s.ID,sm.Name AS semesterName,sm.ID AS SemesterID, pc.Name AS viewProgramsCampus,
//                                          s.CombinedClasses,
//                                          ps.NameEng AS ProgramStudy,
//                                          s.ClassGroup AS viewClassGroup,
//                                          mk.ID AS MKID, mk.MKCode, mk.Name AS viewMataKuliah, mk.NameEng AS viewMataKuliahEng,
//                                          cd.Semester, cd.TotalSKS,
//                                          em.Name AS Coordinator,
//                                          em.NIP,
//                                          s.TeamTeaching,
//                                          s.SubSesi
//                                          FROM  db_academic.schedule s
//                                          LEFT JOIN db_academic.semester sm ON (s.SemesterID = sm.ID)
//                                          LEFT JOIN db_academic.programs_campus pc ON (s.ProgramsCampusID = pc.ID)
//                                          LEFT JOIN db_academic.program_study ps ON (s.ProdiID = ps.ID)
//                                          LEFT JOIN db_academic.mata_kuliah mk ON (mk.ID = s.MKID)
//                                          LEFT JOIN db_academic.curriculum_details cd ON (sm.CurriculumID = cd.CurriculumID AND cd.MKID = s.MKID)
//                                          LEFT JOIN db_employees.employees em ON (em.NIP = s.Coordinator)
//                                          WHERE s.ID = "'.$ScheduleID.'" LIMIT 1');
        $data = $this->db->query('SELECT s.ID,sm.Name AS semesterName,
                                          sm.ID AS SemesterID, pc.Name AS viewProgramsCampus,
                                          s.CombinedClasses,
                                          s.ClassGroup AS viewClassGroup,
                                          
                                          em.Name AS Coordinator,
                                          em.NIP,
                                          s.TeamTeaching,
                                          s.SubSesi                                          
                                          FROM  db_academic.schedule s 
                                          LEFT JOIN db_academic.semester sm ON (s.SemesterID = sm.ID)
                                          LEFT JOIN db_academic.programs_campus pc ON (s.ProgramsCampusID = pc.ID)
                                          
                                          LEFT JOIN db_employees.employees em ON (em.NIP = s.Coordinator)
                                          WHERE s.ID = "'.$ScheduleID.'" LIMIT 1');

        $result = $data->result_array();

        if(count($result)>0){
            if($result[0]['TeamTeaching']==1){
                $dataTeam = $this->getTeamTeaching($result[0]['ID']);
                for($i2=0;$i2<count($dataTeam);$i2++){
                    $result[0]['DetailTeamTeaching'][$i2] = $dataTeam[$i2]['NIP'];
                }
            }

            // Get Sesi
            $dataSesi = $this->db->query('SELECT sd.ID AS sdID ,sd.ClassroomID,sd.Credit,sd.DayID,sd.TimePerCredit,sd.StartSessions,sd.EndSessions,
                                          cl.Room  FROM db_academic.schedule_details sd LEFT JOIN db_academic.classroom cl ON (cl.ID = sd.ClassroomID)
                                          WHERE sd.ScheduleID = "'.$ScheduleID.'" ');
            $result[0]['SubSesiDetails'] = $dataSesi->result_array();

            $dataCourse = $this->db->query('SELECT sdc.CDID, mk.ID AS MKID, mk.MKCode, mk.Name, mk.NameEng, 
                                                      ps.ID AS ProdiID, ps.Code, ps.Name AS Prodi, ps.NameEng AS ProdiEng
                                                      FROM db_academic.schedule_details_course sdc 
                                                      LEFT JOIN db_academic.program_study ps ON (ps.ID = sdc.ProdiID)
                                                      LEFT JOIN db_academic.mata_kuliah mk ON (mk.ID = sdc.MKID)
                                                      WHERE sdc.ScheduleID = "'.$ScheduleID.'" ');
            $result[0]['Courses'] = $dataCourse->result_array();
        }

        return $result[0];
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

    public function __checkClassGroup($ProgramsCampusID,$SemesterID,$ProdiCode,$IsSemesterAntara){


        $data = $this->db->query('SELECT scg.* FROM db_academic.schedule s 
                                                LEFT JOIN db_academic.schedule_class_group scg ON (s.ID=scg.ScheduleID) 
                                                WHERE s.ProgramsCampusID = "'.$ProgramsCampusID.'" AND
                                                    s.SemesterID = "'.$SemesterID.'" AND
                                                    s.IsSemesterAntara = "'.$IsSemesterAntara.'" AND
                                                    scg.ProdiCode = "'.$ProdiCode.'"  ');

//        $data = $this->db->query('SELECT * FROM db_academic.schedule_class_group
//                                            WHERE ProgramsCampusID = "'.$ProgramsCampusID.'" AND
//                                            SemesterID = "'.$SemesterID.'" AND
//                                            ProdiCode = "'.$ProdiCode.'"
//                                             ');
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

    public function __getRangeCredits(){
        $data = $this->db->query('SELECT * FROM db_academic.range_credits ORDER BY Credit DESC');
        return $data->result_array();
    }

    public function __getAllTimePerCredit(){
        $data = $this->db->query('SELECT * FROM db_academic.time_per_credits ORDER BY Time DESC');
        return $data->result_array();
    }

    public function __getLecturerDetail($NIP){

//        $data = $this->db->query('SELECT e.* FROM db_employees.employees e WHERE e.NIP="'.$NIP.'" AND e.PositionMain = "14.7"');
        $data = $this->db->query('SELECT e.* FROM db_employees.employees e WHERE e.NIP="'.$NIP.'" LIMIT 1 ');

        return $data->result_array()[0];
    }

    public function __checkSchedule($dataFilter){
//        print_r($dataFilter);
        // Get Jadwal
//        $jadwal = $this->db->query('SELECT s.ID AS ScheduleID, sd.ID AS sdID, sd.DayID,sd.StartSessions, sd.EndSessions, cl.Room,
//                                              mk.NameEng, mk.ID AS MKID, mk.MKCode
//                                              FROM db_academic.schedule s
//                                              RIGHT JOIN db_academic.schedule_details sd ON (s.ID=sd.ScheduleID)
//                                              LEFT JOIN db_academic.classroom cl ON (cl.ID = sd.ClassroomID)
//                                              LEFT JOIN db_academic.mata_kuliah mk ON (mk.ID = s.MKID)
//                                              WHERE s.SemesterID="'.$dataFilter['SemesterID'].'"
//                                              AND sd.ClassroomID="'.$dataFilter['ClassroomID'].'"
//                                              AND sd.DayID="'.$dataFilter['DayID'].'"
//                                              AND (("'.$dataFilter['StartSessions'].'" >= sd.StartSessions  AND "'.$dataFilter['StartSessions'].'" <= sd.EndSessions) OR
//                                              ("'.$dataFilter['EndSessions'].'" >= sd.StartSessions AND "'.$dataFilter['EndSessions'].'" <= sd.EndSessions) OR
//                                              ("'.$dataFilter['StartSessions'].'" <= sd.StartSessions AND "'.$dataFilter['EndSessions'].'" >= sd.EndSessions)
//                                              ) ORDER BY sd.StartSessions ASC
//                                              ')->result_array();

        $jadwal = $this->db->query('SELECT s.ID AS ScheduleID,s.ClassGroup , sd.ID AS sdID, sd.DayID,sd.StartSessions, sd.EndSessions, cl.Room                                               
                                              FROM db_academic.schedule s
                                              RIGHT JOIN db_academic.schedule_details sd ON (s.ID=sd.ScheduleID)   
                                              LEFT JOIN db_academic.classroom cl ON (cl.ID = sd.ClassroomID)
                                              WHERE s.SemesterID="'.$dataFilter['SemesterID'].'"
                                              AND s.IsSemesterAntara="'.$dataFilter['IsSemesterAntara'].'" 
                                              AND sd.ClassroomID="'.$dataFilter['ClassroomID'].'" 
                                              AND sd.DayID="'.$dataFilter['DayID'].'" 
                                              AND (("'.$dataFilter['StartSessions'].'" >= sd.StartSessions  AND "'.$dataFilter['StartSessions'].'" <= sd.EndSessions) OR
                                              ("'.$dataFilter['EndSessions'].'" >= sd.StartSessions AND "'.$dataFilter['EndSessions'].'" <= sd.EndSessions) OR
                                              ("'.$dataFilter['StartSessions'].'" <= sd.StartSessions AND "'.$dataFilter['EndSessions'].'" >= sd.EndSessions)
                                              ) ORDER BY sd.StartSessions ASC 
                                              ')->result_array();

        if(count($jadwal)>0){
            for($i=0;$i<count($jadwal);$i++){
                $dataCourse = $this->db->query('SELECT sdc.*,mk.NameEng, mk.ID AS MKID, mk.MKCode FROM db_academic.schedule_details_course sdc
                                                        LEFT JOIN db_academic.mata_kuliah mk ON (mk.ID = sdc.MKID)
                                                        WHERE sdc.ScheduleID = "'.$jadwal[$i]['ScheduleID'].'" ')->result_array();

                $jadwal[$i]['DetailsCourse'] = $dataCourse;
            }
        }

//        if(count($jadwal)>0){
//            $ce
//        }

        return $jadwal;

    }

    public function saveDataWilayah($arr)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 600); //600 seconds = 10 minutes
        $data = $arr['data'];
        $arr_temp = array();
        $sql ="select RegionID from db_admission.region";
        $query=$this->db->query($sql, array())->result();
        foreach ($query as $key) {
            $arr_temp[] =  $key->RegionID;
        }

        $kode_wilayah_arr = array();
        for ($i=0; $i < count($data); $i++) {
            // find data in array
            $kode_wilayah = $data[$i]['kode_wilayah'];
            $kode_wilayah_arr[] = $kode_wilayah;
            if (!in_array($kode_wilayah, $arr_temp)) {
                $dataSave = array(
                        'RegionID' => $data[$i]['kode_wilayah'],
                        'RegionName' => $data[$i]['nama'],
                        'RegionCodeMst' => $data[$i]['mst_kode_wilayah']
                );

                $this->db->insert('db_admission.region', $dataSave);
            }
            
        }

        return $kode_wilayah_arr;
    }

    public function saveDataSchool($arr)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 600); //600 seconds = 10 minutes
        $data = $arr['data'];
        $arr_temp = array();
        $sql ="select SchoolID from db_admission.school";
        $query=$this->db->query($sql, array())->result();
        foreach ($query as $key) {
            $arr_temp[] =  $key->SchoolID;
        }

        $kode_school_arr = array();
        for ($i=0; $i < count($data); $i++) {
            // find data in array
            $kode_school = $data[$i]['id'];
            $kode_school_arr[] = $kode_school;
            if (!in_array($kode_school, $arr_temp)) {
                $dataSave = array(
                        'ProvinceID' => $data[$i]['kode_prop'],
                        'ProvinceName' => $data[$i]['propinsi'],
                        'CityID' => $data[$i]['kode_kab_kota'],
                        'CityName' => $data[$i]['kabupaten_kota'],
                        'DistrictID' => $data[$i]['kode_kec'],
                        'DistrictName' => $data[$i]['kecamatan'],
                        'SchoolID' => $data[$i]['id'],
                        'npsn' => $data[$i]['npsn'],
                        'SchoolName' => $data[$i]['sekolah'],
                        'SchoolType' => $data[$i]['bentuk'],
                        'Status' => $data[$i]['status'],
                        'SchoolAddress' => $data[$i]['alamat_jalan'],
                        'Latitude' => $data[$i]['lintang'],
                        'Longitude' => $data[$i]['bujur'],
                );

                $this->db->insert('db_admission.school', $dataSave);
            }
            
        }

        //return $kode_school_arr;
        return "Done";
    }

    public function getdataWilayah()
    {
        $sql = "select * from db_admission.region";
        $query=$this->db->query($sql, array())->result_array();
        return $query;
    }

    public function __getSMAWilayah($kode_wilayah)
    {
        $sql = "select * from db_admission.school as a where a.CityID = ? ";
        $query=$this->db->query($sql, array($kode_wilayah))->result_array();
        return $query;
    }

    public function getDataRegisterUpload()
    {
        $sql = "select a.* from (
                select a.ID,a.Name,a.Email,b.SchoolName,a.PriceFormulir,a.RegisterAT,c.FileUpload,c.CreateAT as uploadAT,c.ID as ver_id
                    from db_admission.register as a LEFT JOIN db_admission.school as b
                    on a.SchoolID = b.ID
                    LEFT JOIN db_admission.register_verification as c
                    on a.ID = c.RegisterID
                ) as a
                where a.ver_id not in (select RegVerificationID from db_admission.register_verified)
                UNION
                select a.ID,a.Name,a.Email,b.SchoolName,a.PriceFormulir,a.RegisterAT,null,null,null
                from db_admission.register as a LEFT JOIN db_admission.school as b
                on a.SchoolID = b.ID
                where a.ID not in(select RegisterID from db_admission.register_verification)
                ORDER BY uploadAT desc";        
        $query=$this->db->query($sql, array())->result_array();
        return $query;
    }

    public function getDataRegisterVerified()
    {
        $sql = "select a.ID,a.Name,a.Email,b.SchoolName,a.PriceFormulir,a.RegisterAT,c.FileUpload,c.CreateAT as uploadAT,c.ID as ver_id,d.FormulirCode,d.VerificationAT,e.name as VerificationBY,
                d.ID as verified_id
                from db_admission.register as a LEFT JOIN db_admission.school as b
                on a.SchoolID = b.ID
                JOIN db_admission.register_verification as c
                on a.ID = c.RegisterID
                join db_admission.register_verified as d
                on c.ID = d.RegVerificationID
                LEFT JOIN db_employees.employees as e
                on e.NIP = d.VerificationBY";        
        $query=$this->db->query($sql, array())->result_array();
        return $query;
    }

    public function __checkDateKRS($date){
        $data = $this->db->query('SELECT ay.krsStart,ay.krsEnd,ay.SemesterID FROM db_academic.semester s 
                                            JOIN db_academic.academic_years ay ON (ay.SemesterID = s.ID)
                                            WHERE ay.krsStart <= "'.$date.'" AND ay.krsEnd >= "'.$date.'" AND s.Status = 1 ');

        return $data->result_array();
    }

    public function getScheduleDetails($ScheduleID){
        $dataSchedule = $this->db
                            ->select('db_academic.schedule.*, db_academic.programs_campus.Name AS ProgramCampus, db_employees.employees.Name AS CoordinatorName')
                            ->join('db_academic.programs_campus','db_academic.programs_campus.ID = db_academic.schedule.ProgramsCampusID')
                            ->join('db_employees.employees','db_employees.employees.NIP = db_academic.schedule.Coordinator')
                            ->get_where('db_academic.schedule',array('db_academic.schedule.ID'=>$ScheduleID),1)->result_array()[0];

        $result = $dataSchedule;

        // Detail Course
        $dataCourse = $this->db->query('SELECT sdc.*, mk.Name AS MKName, mk.NameEng AS MKNameEng, mk.MKCode,
                                                  ps.Name AS Prodi, ps.NameEng AS ProdiEng, ps.Code AS ProdiCode
                                                  FROM db_academic.schedule_details_course sdc
                                                  LEFT JOIN db_academic.program_study ps ON (sdc.ProdiID = ps.ID)
                                                  LEFT JOIN db_academic.curriculum_details cd ON (cd.ID = sdc.CDID)
                                                  LEFT JOIN db_academic.mata_kuliah mk ON (mk.ID = sdc.MKID)
                                                  WHERE sdc.ScheduleID = "'.$ScheduleID.'"
                                                   ')->result_array();
        $result['DetailCourse'] = $dataCourse;

        // Daata Sesi
        $dataSubSesi = $this->db->query('SELECT sd.*, cl.Room, cl.Seat, cl.SeatForExam FROM db_academic.schedule_details sd
                                                  LEFT JOIN db_academic.classroom cl ON (cl.ID = sd.ClassroomID)
                                                  LEFT JOIN db_academic.days d ON (d.ID = sd.DayID)
                                                  WHERE sd.ScheduleID = "'.$ScheduleID.'"
                                                  ')->result_array();

        $result['DetailSubSesi'] = $dataSubSesi;

        $dataTeamTeaching = $this->db->query('SELECT stt.*,e.Name AS Lecturer FROM db_academic.schedule_team_teaching stt
                                                        LEFT JOIN db_employees.employees e ON (stt.NIP = e.NIP)
                                                        WHERE stt.ScheduleID = "'.$ScheduleID.'"
                                                        ')->result_array();

        $result['DetailTeamTeaching'] = $dataTeamTeaching;

        if($result['IsSemesterAntara']=='0'){
            $dataCurriculum = $this->db->select('Name')->get_where('db_academic.semester',array('ID'=>$result['SemesterID']),1)->result_array();
        } else {
            $dataCurriculum = $this->db->select('Name')->get_where('db_academic.semester_antara',array('SemesterID'=>$result['SemesterID']),1)->result_array();
        }

        $result['DataCurriculum'] = $dataCurriculum[0];

        return $result;

    }

    public function __checkCourse($SemesterID,$MKID){
        $data = $this->db->query('SELECT * FROM db_academic.schedule s 
                                  JOIN db_academic.schedule_details_course sdc 
                                  ON (s.ID = sdc.ScheduleID)
                                  WHERE s.SemesterID = "'.$SemesterID.'" 
                                  AND sdc.MKID = "'.$MKID.'" ');
        return $data->result_array();
    }

    private function _getSemesterActive(){
        $data = $this->db->get_where('db_academic.semester', array('Status'=>'1'),1);

        return $data->result_array()[0];
    }

    public function __getStudyPlanning($dataWhere){

        $db_ta = 'ta_'.$dataWhere['ClassOf'];

        $data = $this->db->query('SELECT s.Name,s.NPM,s.ClassOf,ast.EmailPU FROM '.$db_ta.'.Students s 
                                                    LEFT JOIN db_academic.auth_students ast ON (ast.NPM = s.NPM)
                                                    WHERE s.ProdiID = "'.$dataWhere['ProdiID'].'" 
                                                    AND s.ProgramID = "'.$dataWhere['ProgramID'].'" ')
                        ->result_array();
        $result = [];
        if(count($data)>0){
            for($i=0;$i<count($data);$i++){
                $data_stdCourse = $this->db->query('SELECT cd.Semester FROM db_academic.std_krs sk 
                                                      LEFT JOIN db_academic.curriculum_details cd ON (cd.ID = sk.CDID)
                                                      WHERE sk.NPM = "'.$data[$i]['NPM'].'" ')
                                        ->result_array();

                $data[$i]['DetailSemester'] = $this->getMaxCredit($db_ta,$data[$i]['NPM'],$dataWhere['ClassOf']);

                $dataRes = array(
                    'Student' => $data[$i],
                    'StudyPlanning' => $data_stdCourse
                );

                array_push($result,$dataRes);
            }
        }

        return $result;

    }

    private function getMaxCredit($db_ta,$NPM,$ClassOf){

        $dataSemester = $this->db->query('SELECT ID FROM db_academic.semester s1 
                                            WHERE s1.ID < (SELECT ID FROM db_academic.semester s WHERE s.Status=1) 
                                            ORDER BY s1.ID DESC LIMIT 1')->result_array()[0];

        $dataResult = $this->db->query('SELECT * FROM '.$db_ta.'.study_results s 
                                                WHERE s.NPM = "'.$NPM.'" 
                                                AND s.SemesterID = "'.$dataSemester['ID'].'" LIMIT 1')->result_array();

        $dataMakCredit = $this->db->query('SELECT * FROM db_academic.range_credits WHERE 
                                                      IPSStart <= '.$dataResult[0]['IPS'].' 
                                                      AND IPSEnd >= '.$dataResult[0]['IPS'].' LIMIT 1')->result_array();


        // Semester Saat Ini
        $dataTotalSmt = $this->db->query('SELECT s.Status FROM db_academic.semester s 
                                                    WHERE s.ID >= (SELECT ID FROM db_academic.semester s2 
                                                    WHERE s2.Year="'.$ClassOf.'" 
                                                    LIMIT 1)')->result_array();

        $smt = 0;
        for($s=0;$s<count($dataTotalSmt);$s++){
            if($dataTotalSmt[$s]['Status']=='1'){
                $smt += 1;
                break;
            } else {
                $smt += 1;
            }
        }

        $result = array(
            'LastIPS' => $dataResult[0],
            'MaxCredit' => $dataMakCredit[0],
            'Semester' => $smt
        );
        return $result;
    }

    public function getDetailStudyPlanning($NPM,$ta){
        $db_ta = 'ta_'.$ta;
        $data = $this->db->query('SELECT s.NPM,s.Name, s.Photo, s.AcademicMentor,s.Gender,
                                    ast.EmailPU ,
                                    em.Name AS Mentor, em.EmailPU AS MentorEmailPU
                                    FROM '.$db_ta.'.students s 
                                    LEFT JOIN db_academic.auth_students ast ON (s.NPM = ast.NPM)
                                    LEFT JOIN db_employees.employees em ON (s.AcademicMentor = em.NIP)
                                    WHERE s.NPM = "'.$NPM.'" AND s.StatusStudentID = "3" ')
                            ->result_array();

        $data[0]['DetailSemester'] = $this->getMaxCredit($db_ta,$NPM,$ta);

        $smtActive = $this->_getSemesterActive();
        $dataPlanning = $this->db->query('SELECT s.ID AS ScheduleID, mk.ID AS MKID, 
                                                    mk.Name, mk.NameEng, mk.MKCode, 
                                                    cd.Semester, cd.TotalSKS AS Credit, 
                                                    s.ClassGroup,
                                                    sk.ID AS KRSID
                                                    FROM db_academic.std_krs sk 
                                                    LEFT JOIN db_academic.curriculum_details cd ON (cd.ID = sk.CDID)
                                                    LEFT JOIN db_academic.mata_kuliah mk ON (mk.ID = cd.MKID)
                                                    LEFT JOIN db_academic.schedule s ON (s.ID = sk.ScheduleID)
                                                    WHERE sk.SemesterID = "'.$smtActive['ID'].'" AND sk.NPM = "'.$NPM.'" ')->result_array();

        for($i=0;$i<count($dataPlanning);$i++){

            $dataPlanning[$i]['DetailSchedule'] = $this->db->query('SELECT sd.*,cl.Room,d.NameEng AS DayNameEng FROM db_academic.schedule_details sd
                                                                              LEFT JOIN db_academic.classroom cl ON (cl.ID = sd.ClassroomID)
                                                                              LEFT JOIN db_academic.days d ON (d.ID = sd.DayID)
                                                                              WHERE sd.ScheduleID = "'.$dataPlanning[$i]['ScheduleID'].'" ')
                                                            ->result_array();

        }

        $data[0]['Schedule'] = $dataPlanning;

        return $data[0];
    }




}
