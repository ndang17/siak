<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_api extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        $this->load->model('m_api');
        $this->load->model('akademik/m_tahun_akademik');
        $this->load->library('JWT');
        $this->load->library('google');

        if($this->session->userdata('loggedIn')==false){
            $data = array(
                'Message' => 'Error',
                'Description' => 'Your Session Login Is Destroy'
            );
            print_r(json_encode($data));
            exit;
        }
    }



    public function getKurikulumByYear(){

//        $year = $this->input->get('year');

        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        $result = $this->m_api->__getKurikulumByYear($data_arr['SemesterSearch'],$data_arr['year'],$data_arr['ProdiID']);

        return print_r(json_encode($result));
    }

    public function getProdi(){
        $data = $this->m_api->__getBaseProdi();
        return print_r(json_encode($data));
    }

    public function getProdiSelectOption(){
        $data = $this->m_api->__getBaseProdiSelectOption();
        return print_r(json_encode($data));
    }

    public function getProdiSelectOptionAll(){
        $data = $this->m_api->__getBaseProdiSelectOptionAll();
        return print_r(json_encode($data));
    }

    public function getKurikulumSelectOption(){
        $data = $this->m_api->__getKurikulumSelectOption();
        return print_r(json_encode($data));
    }

    public function getMKByID(){
        $ID = $this->input->post('idMK');
        $data = $this->m_api->__getMKByID($ID);
        return print_r(json_encode($data));
    }

    public function getSemester(){
        $data = $this->m_tahun_akademik->__getSemester();
        return print_r(json_encode($data));
    }

    public function getLecturer(){
        $data = $this->m_api->__getLecturer();
        return print_r(json_encode($data));
    }


    public function getAllMK(){
        $data = $this->m_api->__getAllMK();
        return print_r(json_encode($data));
    }

    public function setLecturersAvailability(){

        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);
//        print_r($data_arr);

        if($data_arr['action']=='add'){
            $dataInsert = (array) $data_arr['dataForm'];
            $this->db->insert('db_academic.lecturers_availability',$dataInsert);
            return print_r($this->db->insert_id());
        } else if($data_arr['action']=='edit'){

            $update_lad = (array) $data_arr['dataForm_lad'];
            $this->db->where('ID', $data_arr['ladID']);
            $this->db->update('db_academic.lecturers_availability_detail',$update_lad);

            return print_r(1);
        } else if($data_arr['action']=='delete'){

            // Cek apakah ID lebih dari satu
            $dataCek = $this->m_api->__cekTotalLAD($data_arr['laID']);


            if(count($dataCek)==1){
//                print_r($data_arr['laID']);
                $this->db->where('ID', $data_arr['ladID']);
                $this->db->delete('db_academic.lecturers_availability_detail');

                $this->db->where('ID', $data_arr['laID']);
                $this->db->delete('db_academic.lecturers_availability');
//

            } else {
//                print_r('delete1');
                $this->db->where('ID', $data_arr['ladID']);
                $this->db->delete('db_academic.lecturers_availability_detail');
            }


            return print_r(1);

        }

    }

    public function setLecturersAvailabilityDetail($action){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = $this->jwt->decode($token,$key);

//        print_r($data_arr);
        if($action=='insert'){
            $this->db->insert('db_academic.lecturers_availability_detail',$data_arr);
            return $this->db->insert_id();
        }
    }

    public function changeTahunAkademik(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);


        $data['department'] = $this->session->userdata('departementNavigation');
        $data['dosen'] = $this->m_tahun_akademik->__getKetersediaanDosenByTahunAkademik($data_arr['ID']);
        print_r(json_encode($data['dosen']));
//        $this->load->view('page/'.$data['department'].'/ketersediaan_dosen_detail',$data);
    }


    //-------- Kurikulum -----
    public function insertKurikulum(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        // Cek Tahun
        $data = $this->m_api->cekTahunKurikulum($data_arr['Year']);
        if(count($data)>0){
            return print_r(0);
        } else {
            $this->db->insert('db_academic.curriculum',$data_arr);
            return print_r(1);
        }

    }

    public function geteducationLevel(){
        $data = $this->m_api->__geteducationLevel();
        return print_r(json_encode($data));
    }

    public function getDosenSelectOption(){
        $data = $this->m_api->__getDosenSelectOption();
        return print_r(json_encode($data));
    }

    public function crudKurikulum(){

        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

//        print_r($data_arr);
//        exit;
        if($data_arr['action']=='add'){
            $insert = (array) $data_arr['data_insert'];
            $this->db->insert('db_academic.'.$data_arr['table'],$insert);
            $insert_id = $this->db->insert_id();
            return print_r($insert_id);
        } else if($data_arr['action']=='edit'){
            $dataupdate = (array) $data_arr['data_insert'];
            $this->db->where('ID', $data_arr['ID']);
            $this->db->update('db_academic.'.$data_arr['table'],$dataupdate);
            return print_r(1);
        } else if($data_arr['action']=='delete'){
            $this->db->where('ID', $data_arr['ID']);
            $this->db->delete('db_academic.'.$data_arr['table']);
            return print_r(1);
        } else if($data_arr['action']=='read'){
            $data = $this->m_api->__getItemKuriklum($data_arr['table']);
            return print_r(json_encode($data));
        }
    }

    public function crudDetailMK(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if($data_arr['action']=='add'){
            $insert = (array) $data_arr['dataForm'];

            // Cek apakah sudah dimasukan ke detail kurikulum

            $where = array(
                'CurriculumID' => $insert['CurriculumID'],
                'ProdiID' => $insert['ProdiID'],
                'EducationLevelID' => $insert['EducationLevelID'],
                'MKID' => $insert['MKID']);
            $this->db->select('Semester');
            $dataSmt = $this->db->get_where('db_academic.curriculum_details', $where)->result_array();

            if(count($dataSmt)>0){
                $result = array(
                    'msg' => 0,
                    'Semester' => $dataSmt[0]['Semester']
                );
                return print_r(json_encode($result));

            } else {


                $this->db->insert('db_academic.curriculum_details',$insert);
                $insert_id = $this->db->insert_id();
                $result = array(
                    'msg' => $insert_id
                );
                return print_r(json_encode($result));
            }



        }
        else if($data_arr['action']=='edit'){
            $update = (array) $data_arr['dataForm'];
            $this->db->where('ID', $data_arr['ID']);
            $this->db->update('db_academic.curriculum_details',$update);
//            print_r($data_arr);

//            $this->db->where('CurriculumDetailID', $data_arr['ID']);
//            $this->db->delete('db_academic.precondition');

            $insert_id = $data_arr['ID'];
            return print_r($insert_id);
        }
        else if($data_arr['action']=='delete') {
            $this->db->where('ID', $data_arr['ID']);
            $this->db->delete('db_academic.curriculum_details');
            return print_r(1);
        }

//        if($data_arr['DataPraSyart']!=''){
//            for($i=0;$i<count($data_arr['DataPraSyart']);$i++){
//
//                $ex = explode(".",$data_arr['DataPraSyart'][$i]);
//
//                $data_Pra = array(
//                    'CurriculumDetailID' => $insert_id,
//                    'MKID' => trim($ex[0]),
//                    'MKCode' => trim($ex[1])
//                );
//                $this->db->insert('db_academic.precondition',$data_Pra);
//            }
//        }
    }

    public function getdetailKurikulum(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            $CDID = $data_arr['CDID'];
            $data = $this->m_api->__getdetailKurikulum($CDID);

            return print_r(json_encode($data));
        }

    }

    public function genrateMKCode(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            $ID = $data_arr['ID'];
            $data = $this->m_api->__genrateMKCode($ID);

            return print_r(json_encode($data));
        }

    }

    public function cekMKCode(){
        $MKCode = $this->input->post('MKCode');
        $data = $this->m_api->__cekMKCode($MKCode);
        return print_r(json_encode($data));
    }

    public function crudMataKuliah(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            if($data_arr['action']=='add'){
                $dataInsert = (array) $data_arr['dataForm'];
                $this->db->insert('db_academic.mata_kuliah',$dataInsert);
                $insert_id = $this->db->insert_id();

                return print_r($insert_id);
            }
            else if($data_arr['action']=='edit')
            {
                $dataInsert = (array) $data_arr['dataForm'];
                $this->db->where('ID', $data_arr['ID']);
                $this->db->update('db_academic.mata_kuliah',$dataInsert);

                return print_r(1);
            }
            else if($data_arr['action']=='delete')
            {
                $this->db->where('ID', $data_arr['ID']);
                $this->db->delete('db_academic.mata_kuliah');
                return print_r(1);
            }
            else if($data_arr['action']=='read'){
                $ID = $data_arr['ID'];
                $MKCode = $data_arr['MKCode'];
                $data = $this->m_api->getMataKuliahSingle($ID,$MKCode);

                if(count($data)>0){
                    return print_r(json_encode($data[0]));
                }
            }
            else if($data_arr['action']=='readOfferings') {
                $dataForm = (array) $data_arr['dataForm'];
                $data = $this->m_api->getMatakuliahOfferings($dataForm['SemesterID'],$dataForm['MKID'],$dataForm['MKCode']);

                return print_r(json_encode($data[0]));
            }
        }
    }

    public function crudTahunAkademik(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){

            if($data_arr['action']=='add'){
                $dataForm = (array) $data_arr['dataForm'];
                // Cek
                $check = $this->db->get_where('db_academic.semester',array('Year'=>$dataForm['Year'],'Code'=>$dataForm['Code']))
                    ->result_array();

//                print_r($check);
//                exit;
                if(count($check)>0){
                    return print_r(0);
                } else {
                    $this->db->insert('db_academic.semester',$dataForm);
                    $insert_id = $this->db->insert_id();

                    $this->db->insert('db_academic.academic_years',
                        array('SemesterID' => $insert_id));

                    return print_r($insert_id);
                }

            }
            else if($data_arr['action']=='edit'){
                $dataForm = (array) $data_arr['dataForm'];
                $this->db->where('ID', $data_arr['ID']);
                $this->db->update('db_academic.semester',$dataForm);
                return print_r(1);
            }
            else if($data_arr['action']=='delete'){
                $this->db->where('ID', $data_arr['ID']);
                $this->db->delete('db_academic.semester');
                return print_r(1);
            }
            else if($data_arr['action']=='read'){

                $data = $this->db->order_by('ID', 'DESC')
                    ->get('db_academic.semester')
                    ->result_array();

                return print_r(json_encode($data));

            }

            else if($data_arr['action']=='addSemesterAntara'){
                $dataForm = (array) $data_arr['dataForm'];
                // Cek
                $check = $this->db->get_where('db_academic.semester_antara',array('Year'=>$dataForm['Year'],'Code'=>$dataForm['Code']))
                    ->result_array();

                if(count($check)>0){
                    return print_r(0);
                } else {
                    $this->db->insert('db_academic.semester_antara',$dataForm);
                    $insert_id = $this->db->insert_id();

//                    $this->db->insert('db_academic.academic_years',
//                        array('SemesterID' => $insert_id));

                    return print_r($insert_id);
                }
            }
            else if($data_arr['action']=='readSemesterAntara'){
                $data = $this->db
                    ->select('semester_antara.*')
                    ->join('db_academic.semester','semester.ID = semester_antara.SemesterID')
                    ->order_by('semester_antara.Year', 'DESC')
                    ->get('db_academic.semester_antara')
                    ->result_array();

                return print_r(json_encode($data));
            }
            else if($data_arr['action']=='checkSemesterAntara'){
                $data = $this->db
                    ->get_where('db_academic.semester_antara',array('Status'=>'1'))
                    ->result_array();
                return print_r(json_encode($data));
            }

            else if($data_arr['action']=='DataSemester'){

                $data = $this->m_api->getSemesterCurriculum();

                return print_r(json_encode($data));

            }
        }

    }

    public function crudDataDetailTahunAkademik(){

        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

//        print_r($data_arr);
        if(count($data_arr)>0){
            if($data_arr['action']=='read'){

                $data = $this->m_api->__crudDataDetailTahunAkademik($data_arr['ID']);
                return print_r(json_encode($data));

            }
            else if($data_arr['action']=='edit') {

                $dataForm = (array) $data_arr['dataForm'];
                $this->db->where('SemesterID',$data_arr['SemesterID']);
                $this->db->update('db_academic.academic_years',$dataForm);

                return print_r($data_arr['SemesterID']);
            }
            else if($data_arr['action']=='publish'){
                $ID = $data_arr['ID'];
                $this->db->query('UPDATE db_academic.semester s SET s.Status=IF(s.ID="'.$ID.'",1,0)');
                return print_r($ID);
            }
        }

    }

    public function getAcademicYearOnPublish(){

        $smt = $this->input->get('smt');

        if($smt=='SemesterAntara'){
            $data = $this->db
                ->get_where('db_academic.semester_antara',array('Status'=>'1'))
                ->result_array();
        } else {
            $data = $this->m_api->__getAcademicYearOnPublish();
        }


        return print_r(json_encode($data[0]));
    }

    public function crudSchedule2(){

        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

//        print_r($data_arr);
        if(count($data_arr)>0){

            if($data_arr['action']=='add'){
                $formData = (array) $data_arr['formData'];
                $this->db->insert('db_academic.schedule', $formData);
                $insert_id = $this->db->insert_id();

                // Insert Group Kelas / krs
                $formDataClassGroup = (array) $data_arr['formDataClassGroup'];
                $formDataClassGroup['ScheduleID'] = $insert_id;
                $this->db->insert('db_academic.schedule_class_group',$formDataClassGroup);

                // Insert Base Prodi / Kelas Gabungan
                $formBaseProdi = (array) $data_arr['formBaseProdi'];
                if(count($formBaseProdi['formBaseProdi'])>0){
                    for($i=0;$i<count($formBaseProdi['formBaseProdi']);$i++){
                        $comb_insert = array(
                            'ScheduleID' => $insert_id,
                            'ProgramStudyID' => $formBaseProdi['formBaseProdi'][$i]
                        );
                        $this->db->insert('db_academic.schedule_combinedclasses',$comb_insert);
                    }
                } else {
                    $comb_insert = array(
                        'ScheduleID' => $insert_id,
                        'ProgramStudyID' => $formBaseProdi['formBaseProdi']
                    );
                    $this->db->insert('db_academic.schedule_combinedclasses',$comb_insert);
                }

//                print_r($formData);
                if($formData['TeamTeaching']!=0){
                    // Insert Team Teaching
                    $formTeamTeaching = (array) $data_arr['formTeamTeaching'];
                    if(count($formTeamTeaching['formTeamDosen'])>0){
                        for($i=0;$i<count($formTeamTeaching['formTeamDosen']);$i++){
                            $td_insert = array(
                                'ScheduleID' => $insert_id,
                                'NIP' => $formTeamTeaching['formTeamDosen'][$i],
                                'Status' => 0
                            );
                            $this->db->insert('db_academic.schedule_team_teaching',$td_insert);
                        }
                    } else {
                        $td_insert = array(
                            'ScheduleID' => $insert_id,
                            'NIP' => $formTeamTeaching['formTeamDosen']
                        );
                        $this->db->insert('db_academic.schedule_team_teaching',$td_insert);
                    }
                }
                return print_r($insert_id);

            }

            else if($data_arr['action']=='read'){
                $dataWhere = (array) $data_arr['dataWhere'];

                $days = (count((array) $dataWhere['Days'])>0) ? $dataWhere['Days'] : [1,2,3,4,5,6,7] ;

                $daysName = (array) $dataWhere['DaysName'];

//                return print_r(json_encode($data_arr));
                for($i=0;$i<count($days);$i++){
                    $data[$i]['Day'] = array(
                        'DaysID' => $days[$i],
                        'Eng' => $daysName['Eng'][$i],
                        'Ind' => $daysName['Ind'][$i]
                    );
                    $data[$i]['Details'] = $this->m_api->getSchedule($days[$i],$dataWhere);
                }
//
//
                return print_r(json_encode($data));
            }
        }
    }

    public function crudSchedule(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

//        print_r($data_arr);
        if(count($data_arr)>0){
            if($data_arr['action']=='add'){
                $formData = (array) $data_arr['formData'];

//                print_r($formData);
//                exit;

                // Scedule
                $insertSchedule = (array) $formData['schedule'];
                $this->db->insert('db_academic.schedule',$insertSchedule);
                $insert_id = $this->db->insert_id();

                //schedule_class_group
                $dataGroup = (array) $formData['schedule_class_group'];
                $dataGroup['ScheduleID'] = $insert_id;
                $this->db->insert('db_academic.schedule_class_group',$dataGroup);


                // schedule_details
                $dataScheduleDetails = (array) $formData['schedule_details'];
                for($s=0;$s<count($dataScheduleDetails);$s++){
                    $arr = (array) $dataScheduleDetails[$s];
                    $arr['ScheduleID'] = $insert_id;
                    $this->db->insert('db_academic.schedule_details',$arr);
                }


                // schedule_details_course
                $dataScheduleDetailsCourse = (array) $formData['schedule_details_course'];
                for($sdc=0;$sdc<count($dataScheduleDetailsCourse);$sdc++){
                    $arr = (array) $dataScheduleDetailsCourse[$sdc];
                    $arr['ScheduleID'] = $insert_id;
                    $this->db->insert('db_academic.schedule_details_course',$arr);
                }


                //schedule_team_teaching
                if($insertSchedule['TeamTeaching']==1){
                    $dataTemaTeaching = (array) $formData['schedule_team_teaching'];
                    for($t=0;$t<count($dataTemaTeaching);$t++){
                        $arr = (array) $dataTemaTeaching[$t];
                        $arr['ScheduleID'] = $insert_id;

                        $this->db->insert('db_academic.schedule_team_teaching',$arr);
                    }
                }



                return print_r(1);


            }
            else if($data_arr['action']=='read'){
                $dataWhere = (array) $data_arr['dataWhere'];

                $days = (count((array) $dataWhere['Days'])>0) ? $dataWhere['Days'] : [1,2,3,4,5,6,7] ;

                $daysName = (array) $dataWhere['DaysName'];

//                return print_r(json_encode($data_arr));
                for($i=0;$i<count($days);$i++){
                    $data[$i]['Day'] = array(
                        'DaysID' => $days[$i],
                        'Eng' => $daysName['Eng'][$i],
                        'Ind' => $daysName['Ind'][$i]
                    );
                    $data[$i]['Details'] = $this->m_api->getSchedule($days[$i],$dataWhere);
                }
//
//
                return print_r(json_encode($data));
            }
            else if($data_arr['action']=='readOneSchedule'){

                $data = $this->m_api->getOneSchedule($data_arr['ScheduleID']);

                return print_r(json_encode($data));
            }
            else if($data_arr['action']=='delete'){
                $ID = $data_arr['ScheduleID'];

                $tables = array('db_academic.schedule_class_group', 'db_academic.schedule_details', 'db_academic.schedule_team_teaching');
                $this->db->where('ScheduleID', $ID);
                $this->db->delete($tables);

                $this->db->reset_query();
                $this->db->where('ID', $ID);
                $this->db->delete('db_academic.schedule');

                return print_r(1);

            }
            else if($data_arr['action']=='deleteSubSesi') {
                $ID = $data_arr['sdID'];
                $this->db->where('ID', $ID);
                $this->db->delete('db_academic.schedule_details');

                return print_r(1);
            }
            else if($data_arr['action']=='edit'){
                $formData = (array) $data_arr['formData'];
                $schedule_details = (array) $formData['schedule_details'];


                // Update Schedule
                $ScheduleID = $data_arr['ID'];
                $ScheduleUpdate = (array) $formData['schedule'];
                $this->db->where('ID', $ScheduleID);
                $this->db->update('db_academic.schedule',$ScheduleUpdate);
                $this->db->reset_query();

                // Update Schedule Detail
                $dataScheduleDetailsArray = (array) $schedule_details['dataScheduleDetailsArray'];
                for($d=0;$d<count($dataScheduleDetailsArray);$d++){
                    $ds = (array) $dataScheduleDetailsArray[$d];
                    $this->db->where('ID', $ds['sdID']);
                    $this->db->update('db_academic.schedule_details',(array) $ds['update']);
                    $this->db->reset_query();
                }

                // Insert Schedule Detail
                $dataScheduleDetailsArrayNew = (array) $schedule_details['dataScheduleDetailsArrayNew'];
                for($d2=0;$d2<count($dataScheduleDetailsArrayNew);$d2++){
                    $this->db->insert('db_academic.schedule_details',(array) $dataScheduleDetailsArrayNew[$d2]);
                    $this->db->reset_query();
                }

                $this->db->where('ScheduleID', $ScheduleID);
                $this->db->delete('db_academic.schedule_team_teaching');
                $this->db->reset_query();
                // Team Teaching
                if($ScheduleUpdate['TeamTeaching']==1){
                    $dataTemaTeaching = (array) $formData['schedule_team_teaching'];
                    for($t=0;$t<count($dataTemaTeaching['teamTeachingArray']);$t++){

                        $arr = (array) $dataTemaTeaching['teamTeachingArray'][$t];
                        $this->db->insert('db_academic.schedule_team_teaching',$arr);
                        $this->db->reset_query();

                    }
                }

                return print_r(1);

            }

        }
    }

    public function checkSchedule(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

//        print_r($data_arr);
        if(count($data_arr)>0 && $data_arr['action']=='check'){
            $dataFilter =(array) $data_arr['formData'];
            $data = $this->m_api->__checkSchedule($dataFilter);

            return print_r(json_encode($data));
        }
    }

    public function crudProgramCampus(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            if($data_arr['action']=='read'){
                $data = $this->m_api->getProgramCampus();
                return print_r(json_encode($data));
            }
        }
    }

    public function crudSemester(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            if($data_arr['action']=='read'){
                $data = $this->m_api->getSemester($data_arr['order']);
                return print_r(json_encode($data));
            }
            else if($data_arr['action']=='ReadSemesterActive'){
                $formData = (array) $data_arr['formData'];
                $data = $this->m_api->getSemesterActive($formData['CurriculumID'],$formData['ProdiID'],$formData['Semester'],$formData['IsSemesterAntara']);
                return print_r(json_encode($data));
            }
        }
    }

    public function crudCourseOfferings(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0) {
            if ($data_arr['action'] == 'add') {
                $formData = (array) $data_arr['formData'];
                $this->db->insert('db_academic.course_offerings',$formData);
                $insert_id = $this->db->insert_id();
                return print_r($insert_id);
            }
            else if($data_arr['action']=='edit'){
                $formData = (array) $data_arr['formData'];

                $this->db->where('ID', $data_arr['OfferID']);
                $this->db->update('db_academic.course_offerings',$formData);

                return print_r($data_arr['OfferID']);
            }
            else if($data_arr['action']=='read'){
                $formData = (array) $data_arr['formData'];
                $data = $this->m_api->getAllCourseOfferings($formData['SemesterID'],$formData['CurriculumID'],
                    $formData['ProdiID'],$formData['Semester'],$formData['IsSemesterAntara']);
                return print_r(json_encode($data));
            }
            else if($data_arr['action']=='readgabungan'){
                $formData = (array) $data_arr['formData'];
                $data = $this->m_api->getAllCourseOfferingsMKU($formData['SemesterID']);
                return print_r(json_encode($data));
            }
            else if($data_arr['action']=='editSemester') {
//                $formData = (array) $data_arr['formData'];
                $this->db->set('ToSemester', $data_arr['ToSemester']);
                $this->db->where('ID', $data_arr['ID']);
                $this->db->update('db_academic.course_offerings');

                return print_r(1);
            }
            // Untuk mengecek apakah MK Offering sudah dibuatkan jadwal atau belum
            else if($data_arr['action']=='checkCourse'){
                $dataWhere = (array) $data_arr['dataWhere'];
                $query = $this->db
                    ->get_where('db_academic.schedule', $dataWhere)
                    ->result_array();

                if(count($query)>0){
                    return print_r(0);
                } else {
                    return print_r(1);
                }
            }
            else if($data_arr['action']=='delete'){

                $query = $this->db->get_where('db_academic.course_offerings', array('ID' => $data_arr['OfferID']), 1)->result_array();

                if(count($query)>0){
                    $Arr_CDID = json_decode($query[0]['Arr_CDID']);

//                    print_r($Arr_CDID);
//
//                    exit;

                    if(count($Arr_CDID)>1){
                        $result = [];
                        if (($key = array_search($data_arr['CDID'], $Arr_CDID)) !== false) {
                            for($a=0;$a<count($Arr_CDID);$a++){
                                if($a!=$key){
                                    array_push($result,$Arr_CDID[$a]);
                                }
                            }
                        }

                        $this->db->set('Arr_CDID', json_encode($result));
                        $this->db->where('ID', $data_arr['OfferID']);
                        $this->db->update('db_academic.course_offerings');

                        return print_r(1);


                    } else if(count($Arr_CDID)==1){
                        $this->db->where('ID', $data_arr['OfferID']);
                        $this->db->delete('db_academic.course_offerings');
                        return print_r(1);

                    }


//                    print_r(json_encode($r));


                }

            }
            else if($data_arr['action']=='readToSchedule') {
                $formData = (array) $data_arr['formData'];

                $data = $this->m_api->getOfferingsToSetSchedule($formData);
                return print_r(json_encode($data));

            }
        }
    }


    public function getAllStudents(){

        $data = $this->m_api->__getTahunAngkatan();

        return print_r(json_encode($data));
    }

    public function crudeStudent(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            if($data_arr['action']=='read'){
                $formData = (array) $data_arr['formData'];
                $data = $this->m_api->__getStudentByNPM($formData['ta'],$formData['NPM']);

                return print_r(json_encode($data));

            }
        }
    }

    public function getClassGroup(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        $data = $this->m_api->__checkClassGroup(
            $data_arr['ProgramsCampusID'],
            $data_arr['SemesterID'],
            $data_arr['ProdiCode']
            );

        $result = array(
            'Group' => $data_arr['ProdiCode'].'-'.(count($data)+1)
        );

        return print_r(json_encode($result));
    }

    public function crudClassroom(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0) {
            if($data_arr['action'] == 'read') {
                $data = $this->m_api->__getAllClassRoom();
                return print_r(json_encode($data));
            }
            else if($data_arr['action'] == 'add'){
                $formData = (array) $data_arr['formData'];

                // Cek Apakah ruangan sudah di input
                $this->db->where('Room', $formData['Room']);
                $room = $this->db->get('db_academic.classroom')->result_array();


                if(count($room)>0){
                    $result = array(
                        'inserID' => 0
                    );
                } else {
                    $this->db->insert('db_academic.classroom',$formData);
                    $insert_id = $this->db->insert_id();
                    $result = array(
                        'inserID' => $insert_id
                    );
                }

                return print_r(json_encode($result));
            }
            else if($data_arr['action'] == 'edit'){
                $formData = (array) $data_arr['formData'];

                $ID = $data_arr['ID'];
                $this->db->where('ID', $ID);
                $this->db->update('db_academic.classroom',$formData);
                $result = array(
                    'inserID' => $ID
                );

                return print_r(json_encode($result));

            }
            else if($data_arr['action'] == 'delete'){
                $ID = $data_arr['ID'];
                $this->db->where('ID', $ID);
                $this->db->delete('db_academic.classroom');
                return print_r($ID);
            }

        }

    }

    public function crudGrade(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0) {
            if($data_arr['action'] == 'read') {
                $data = $this->m_api->__getAllGrade();
                return print_r(json_encode($data));
            }
            else if($data_arr['action']=='add'){
                $formData = (array) $data_arr['formData'];
                // Cek grade
                $this->db->where('Grade', $formData['Grade']);
                $grade = $this->db->get('db_academic.grade')->result_array();

                if(count($grade)>0){
                    $result = array(
                        'inserID' => 0
                    );
                } else {
                    $this->db->insert('db_academic.grade',$formData);
                    $insert_id = $this->db->insert_id();
                    $result = array(
                        'inserID' => $insert_id
                    );
                }

                return print_r(json_encode($result));
            }
            else if($data_arr['action']=='edit'){
                $formData = (array) $data_arr['formData'];
                // Cek grade
                $ID = $data_arr['ID'];
                $this->db->where('ID', $ID);
                $this->db->update('db_academic.grade',$formData);
                $result = array(
                    'inserID' => $ID
                );

                return print_r(json_encode($result));

            }
            else if($data_arr['action'] == 'delete'){
                $ID = $data_arr['ID'];
                $this->db->where('ID', $ID);
                $this->db->delete('db_academic.grade');
                return print_r($ID);
            }
        }
    }

    public function crudRangeCredits() {
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            if($data_arr['action'] == 'read') {
                $data = $this->m_api->__getRangeCredits();
                return print_r(json_encode($data));
            }
            else if($data_arr['action'] == 'delete'){
//                print_r($data_arr);
//                exit;
                $this->db->where('ID', $data_arr['ID']);
                $this->db->delete('db_academic.range_credits');
                return print_r(1);
            }
            else if($data_arr['action']=='add'){
                $formData = (array) $data_arr['formData'];
                $this->db->insert('db_academic.range_credits', $formData);
                $insert_id = $this->db->insert_id();
                return print_r($insert_id);
            }
            else if($data_arr['action']=='edit'){
                $ID = $data_arr['ID'];
                $formData = (array) $data_arr['formData'];
                $this->db->where('ID', $ID);
                $this->db->update('db_academic.range_credits',$formData);

                return print_r($ID);
            }
        }
    }

//    public function crudStdSemester(){
//        $token = $this->input->post('token');
//        $key = "UAP)(*";
//        $data_arr = (array) $this->jwt->decode($token,$key);
//
//        if(count($data_arr)>0) {
//            if($data_arr['action']=='read'){
//                $this->db->order_by('ID', 'ASC');
//                $data = $this->db->get('db_academic.semester')
//                    ->result_array();
//
//                return print_r(json_encode($data));
//            }
//        }
//    }

    public function crudTimePerCredit(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0) {
            if($data_arr['action'] == 'read') {
                $data = $this->m_api->__getAllTimePerCredit();
                return print_r(json_encode($data));
            }
            else if($data_arr['action'] == 'add'){
                $formData = (array) $data_arr['formData'];
                // Cek Time
                $this->db->where('Time', $formData['Time']);
                $time = $this->db->get('db_academic.time_per_credits')->result_array();

                if(count($time)>0){
                    $result = array(
                        'inserID' => 0
                    );
                } else {
                    $this->db->insert('db_academic.time_per_credits',$formData);
                    $insert_id = $this->db->insert_id();
                    $result = array(
                        'inserID' => $insert_id
                    );
                }

                return print_r(json_encode($result));
            }
            else if($data_arr['action'] == 'delete') {
                $time = $this->db->get('db_academic.time_per_credits')->result_array();

                if(count($time)>1){
                    $ID = $data_arr['ID'];
                    $this->db->where('ID', $ID);
                    $this->db->delete('db_academic.time_per_credits');
                    $result = array(
                        'inserID' => $ID
                    );

                } else {
                    $result = array(
                        'inserID' => 0
                    );

                }
                return print_r(json_encode($result));
            }
        }
    }

    public function crudLecturer(){
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){
            if($data_arr['action']=='read'){
                $NIP = $data_arr['NIP'];
                $data = $this->m_api->__getLecturerDetail($NIP);
                return print_r(json_encode($data));
            }
        }

    }

    public function insertWilayahURLJson()
    {
        $data = $this->input->post('data');
        $generate = $this->m_api->saveDataWilayah($data);
        echo json_encode($generate);
    }

    public function insertSchoolURLJson()
    {
        $data = $this->input->post('data');
        $generate = $this->m_api->saveDataSchool($data);
        echo json_encode($generate);
    }

    public function getWilayahURLJson()
    {
        $generate = $this->m_api->getdataWilayah();
        echo json_encode($generate);
    }

     public function getSMAWilayah()
    {
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);

        $result = $this->m_api->__getSMAWilayah($data_arr['wilayah']);

        return print_r(json_encode($result));
    }

    public function getDataRegisterUpload()
    {
        $getData = $this->m_api->getDataRegisterUpload();
        echo json_encode($getData);
    }

    public function getDataRegisterVerified()
    {
        $getData = $this->m_api->getDataRegisterVerified();
        echo json_encode($getData);
    }



}
