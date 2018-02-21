
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nandang
 * Date: 12/20/2017
 * Time: 1:41 PM
 */


class C_auth extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->db_server = $this->load->database('server', TRUE);
        $this->db = $this->load->database('default', TRUE);
    }

    public function get_auth()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

//        $pas =md5($password);
//        $pass = sha1('jksdhf832746aiH{}{()&(*&(*'.$pas.'HdfevgyDDw{}{}{;;*766&*&*');

        $pass = md5($password);

        $data = $this->db->query('SELECT * FROM siak4.user u JOIN siak4.karyawan k ON() WHERE ');

//        $array = array('Nama' => $username, 'Password' => $pass);
//        $this->db->where($array);
//        $query = $this->db->get('siak4.user');

        print_r($data->result_array());




    }

    public function db($table=''){

//        $this->load->view('md5');

        if($table=='karyawan'){
            $data = $this->db_server->query('SELECT k.*FROM siak4.karyawan k ')->result_array();
//            ,u.password  JOIN siak4.user u ON (k.NIP = u.Nama)
            print_r(count($data));
//            print_r($data);

//            exit;
            for($i=0;$i<count($data);$i++){
                $arr = array(
                    "ReligionID" => $data[$i]['AgamaID'],


                    "CityID" => $data[$i]['KotaID'],
                    "ProvinceID" => $data[$i]['PropinsiID'],
                    "NIP" => $data[$i]['NIP'],
                    "KTP" => $data[$i]['KTP'],
                    "Name" => $data[$i]['Nama'],
                    "TitleAhead" => $data[$i]['Title'],
                    "TitleBehind" => $data[$i]['Gelar'],
                    "Gender" => $data[$i]['Kelamin'],
                    "PlaceOfBirth" => $data[$i]['TempatLahir'],
                    "DateOfBirth" => $data[$i]['TanggalLahir'],
                    "Phone" => $data[$i]['Telepon'],
                    "HP" => $data[$i]['HP'],
                    "Email" => $data[$i]['Email'],
//                    "Password" => $data[$i]['password'],
                    "Address" => $data[$i]['Alamat'],
                    "Photo" => $data[$i]['Foto']

                );

                $this->db->insert('db_employees.employees',$arr);
            }
        }
        else if($table=='dosen'){
            $data = $this->db_server->query('SELECT k.* FROM siak4.dosen k')->result_array();
//            RIGHT JOIN siak4.user u ON (k.NIP = u.Nama)
//            echo count($data);
            $no=1;
            $no_sama = 1;
            for($i=0;$i<count($data);$i++){
                $data_cek = $this->db->query('SELECT * FROM db_employees.employees WHERE NIP = "'.$data[$i]['NIP'].'" ')->result_array();
                if(count($data_cek)>0){
                    print_r($data_cek);
                    $no_sama += 1;
                } else {

                    $Status = ($data[$i]['StatusPegawai']=='Tetap')? 3 : 4;
                    $arr = array(
                        "ReligionID" => $data[$i]['AgamaID'],


                        "PositionMain" => '14.7',
                        "StatusEmployeeID" => $Status,
                        "CityID" => $data[$i]['KotaID'],
                        "ProvinceID" => $data[$i]['PropinsiID'],
                        "NIP" => $data[$i]['NIP'],
                        "KTP" => $data[$i]['KTP'],
                        "Name" => $data[$i]['Nama'],
                        "TitleAhead" => $data[$i]['Title'],
                        "TitleBehind" => $data[$i]['Gelar'],
                        "Gender" => $data[$i]['Kelamin'],
                        "PlaceOfBirth" => $data[$i]['TempatLahir'],
                        "DateOfBirth" => $data[$i]['TanggalLahir'],
                        "Phone" => $data[$i]['Telepon'],
                        "HP" => $data[$i]['HP'],
                        "Email" => $data[$i]['Email'],
//                        "Password" => $data[$i]['password'],
                        "Address" => $data[$i]['Alamat'],
                        "NIDN" => $data[$i]['NIDN'],
                        "Photo" => $data[$i]['Foto']

                    );

                    $no += 1;

//                    print_r($arr);

                    $this->db->insert('db_employees.employees',$arr);
                }
            }

            print_r($no);
            echo "<br/>";
            print_r($no_sama);
        }
        else if($table=='mhs'){
            $angkatan = 17;

            $db_lokal = 'ta_20'.$angkatan;
                $data = $this->db_server->query('SELECT * FROM siak4.mahasiswa WHERE substring(NPM,3,2) = '.$angkatan)->result_array();
            $this->db->truncate($db_lokal.'.students');
//            $this->db->truncate('db_academic.auth_students');
            for($i=0;$i<count($data);$i++){
//                $expPU = explode('@',$data[$i]['Email']);
//                $EmailPU = ($expPU[1]=='podomorouniversity.ac.id') ? $data[$i]['Email'] : '';

//                $expPU = explode('@',$data[$i]['Email']);
                $EmailPU = $data[$i]['Email'];

                $ProdiID = $data[$i]['ProdiID'];

                if($ProdiID=='3') {
                    $ProdiID = 1;
                }
                else if($ProdiID=='4'){
                    $ProdiID = 2;
                }
                else if($ProdiID=='6'){
                    $ProdiID = 3;
                }
                else if($ProdiID=='7'){
                    $ProdiID = 4;
                }
                else if($ProdiID=='13'){
                    $ProdiID = 5;
                }
                else if($ProdiID=='14'){
                    $ProdiID = 6;
                }
                else if($ProdiID=='15'){
                    $ProdiID = 7;
                }
                else if($ProdiID=='16'){
                    $ProdiID = 8;
                }
                else if($ProdiID=='17'){
                    $ProdiID = 9;
                }
                else if($ProdiID=='18'){
                    $ProdiID = 10;
                }
                else if($ProdiID=='19'){
                    $ProdiID = 11;
                }
                $arr = array(
                    'ProdiID' => $ProdiID,
                    'ProgramID' => $data[$i]['ProgramID'],
                    'LevelStudyID' => $data[$i]['JenjangID'],
                    'ReligionID' => $data[$i]['AgamaID'],

                    'ProvinceID' => $data[$i]['PropinsiID'],
                    'CityID' => $data[$i]['KotaID'],
                    'HighSchool' => $data[$i]['NamaSekolah'],
                    'MajorsHighSchool' => $data[$i]['JurusanSekolah'],

                    'NPM' => $data[$i]['NPM'],
                    'Name' => $data[$i]['Nama'],
                    'Address' => $data[$i]['Alamat'],
                    'Photo' => $data[$i]['Foto'],
                    'Gender' => $data[$i]['Kelamin'],
                    'PlaceOfBirth' => $data[$i]['TempatLahir'],
                    'DateOfBirth' => $data[$i]['TanggalLahir'],
                    'Phone' => $data[$i]['Telepon'],
                    'HP' => $data[$i]['HP'],
//                    'Email' => '',
                    'ClassOf' => $data[$i]['TahunMasuk'],
                    'EmailPU' => strtolower($EmailPU),
                    'Jacket' => $data[$i]['Jacket'],
                    'AnakKe' => $data[$i]['AnakKe'],
                    'JumlahSaudara' => $data[$i]['JumlahSaudara'],
                    'NationExamValue' => $data[$i]['Nilaiunas'],
                    'GraduationYear' => $data[$i]['TahunLulus'],
                    'IjazahNumber' => $data[$i]['NoIjazah'],

                    'Father' => $data[$i]['Ayah'],
                    'Mother' => $data[$i]['Ibu'],
                    'StatusFather' => $data[$i]['StatusAyah'],
                    'StatusMother' => $data[$i]['StatusIbu'],
                    'PhoneFather' => str_replace('/','',$data[$i]['PhoneAyah']),
                    'PhoneMother' => str_replace('/','',$data[$i]['PhoneIbu']),
                    'OccupationFather' => $data[$i]['PekerjaanAyah'],
                    'OccupationMother' => $data[$i]['PekerjaanIbu'],
                    'EducationFather' => $data[$i]['PDAyah'],
                    'EducationMother' => $data[$i]['PDIbu'],
                    'AddressFather' => $data[$i]['AlamatAyah'],
                    'AddressMother' => $data[$i]['AlamatIbu'],
                    'EmailFather' => $data[$i]['EmailAyah'],
                    'EmailMother' => $data[$i]['EmailIbu'],
                    'StatusStudentID' => $data[$i]['StatusMhswID']

                );

                $this->db->insert($db_lokal.'.students',$arr);

                $arrAuth = array(
                    'NPM' => $data[$i]['NPM'],
                    'Password' => '57178f8a57dd1c8b1c084a339c433d3569989c44',
                    'Year' => $data[$i]['TahunMasuk'],
                    'EmailPU' => $EmailPU,
                    'StatusStudentID' => $data[$i]['StatusMhswID'],
                    'Status' => '0'
                );

                $this->db->insert('db_academic.auth_students',$arrAuth);
            }
        }
        else if($table=='prodi'){
            $data = $this->db_server->query('SELECT * FROM siak4.programstudi')->result_array();
            for($i=0;$i<count($data);$i++){
                $EducationLevelID = $data[$i]['JenjangID'];
                if($EducationLevelID==8) { $EducationLevelID = 5;}
                else if($EducationLevelID==6) { $EducationLevelID = 4;}
                $arr = array(
                    'EducationLevelID' => $EducationLevelID,
                    'FacultyID' => $data[$i]['FakultasID'],
                    'KaprodiID' => $data[$i]['KaProdiID'],
                    'DiktiID' => $data[$i]['ProdiDiktiID'],
                    'Code' => $data[$i]['Kode'],
                    'Name' => $data[$i]['Nama'],
                    'NameEng' => $data[$i]['NamaInggris'],
                    'Akreditasi' => $data[$i]['Akreditasi'],
                    'AkreditasiDate' => $data[$i]['TglAK'],
                    'NoSK' => $data[$i]['NoSK'],
                    'SKDate' => $data[$i]['TglSK'],
                    'TotalSKS' => $data[$i]['JmlSKS'],
                    'Email' => $data[$i]['Email'],
                    'NoSKBANPT' => $data[$i]['NoSKBAN'],
                    'SKBANPTDate' => $data[$i]['TglSKBAN'],
                    'AkreditasiBANPTDate' => $data[$i]['TglABAN'],
                    'Visi' => $data[$i]['Visi'],
                    'Misi' => $data[$i]['Misi']
                );
                $this->db->insert('db_academic.program_study',$arr);
            }
        }
        else if($table=='mk'){
            $data = $this->db_server->query('SELECT * FROM siak4.matakuliah')->result_array();


            // Double MKCode
            //SELECT * FROM db_academic.mata_kuliah WHERE MKCode IN (SELECT MKCode FROM db_academic.mata_kuliah GROUP BY MKCode HAVING count(*) > 1);

            $this->db->truncate('db_academic.mata_kuliah');
            foreach($data as $item){
                $ProdiID = $item['BaseProdiID'];

                if($ProdiID=='3') {
                    $ProdiID = 1;
                }
                else if($ProdiID=='4'){
                    $ProdiID = 2;
                }
                else if($ProdiID=='6'){
                    $ProdiID = 3;
                }
                else if($ProdiID=='7'){
                    $ProdiID = 4;
                }
                else if($ProdiID=='13'){
                    $ProdiID = 5;
                }
                else if($ProdiID=='14'){
                    $ProdiID = 6;
                }
                else if($ProdiID=='15'){
                    $ProdiID = 7;
                }
                else if($ProdiID=='16'){
                    $ProdiID = 8;
                }
                else if($ProdiID=='17'){
                    $ProdiID = 9;
                }
                else if($ProdiID=='18'){
                    $ProdiID = 10;
                }
                else if($ProdiID=='19'){
                    $ProdiID = 11;
                }
                $arr = array(
                    'ID' => $item['ID'],
                    'MKCode' => $item['MKKode'],
                    'Name' => $item['NamaIndo'],
                    'NameEng' => $item['NamaInggris'],
                    'BaseProdiID' => $ProdiID,
                    'UpdateBy' => '2017090',
                    'UpdateAt' => '2017-01-09 10:10:10'
                );
                print_r($arr);

                $this->db->insert('db_academic.mata_kuliah',$arr);
            }


        }
        else if($table=='kur'){
            $data = $this->db_server->query('SELECT dt.*,mk.nama,k.nama as K,mk.MKKode as MKCode , d.NIP FROM siak4.detailkurikulum dt 
                                                  JOIN siak4.matakuliah mk ON (dt.MKID=mk.ID)
                                                  JOIN siak4.kurikulum k ON (dt.KurikulumID = k.ID)
                                                  LEFT JOIN siak4.dosen d ON (dt.DosenPeng = d.ID)')->result_array();

//            print_r($data);
//exit;
            $this->db->truncate('db_academic.curriculum_details');
            foreach ($data as $item){
                $ProdiID = $item['ProdiID'];

                if($ProdiID=='3') {
                    $ProdiID = 1;
                }
                    else if($ProdiID=='4'){
                    $ProdiID = 2;
                }
                    else if($ProdiID=='6'){
                    $ProdiID = 3;
                }
                    else if($ProdiID=='7'){
                    $ProdiID = 4;
                }
                    else if($ProdiID=='13'){
                    $ProdiID = 5;
                }
                    else if($ProdiID=='14'){
                    $ProdiID = 6;
                }
                    else if($ProdiID=='15'){
                    $ProdiID = 7;
                }
                    else if($ProdiID=='16'){
                    $ProdiID = 8;
                }
                    else if($ProdiID=='17'){
                    $ProdiID = 9;
                }
                    else if($ProdiID=='18'){
                    $ProdiID = 10;
                }
                    else if($ProdiID=='19'){
                    $ProdiID = 11;
                }

//                $PreconditionMKID = ($item['MKIDpra']!=0 && $item['MKIDpra']!=null)?$item['MKIDpra']:'';
                $PreconditionMKID = $item['MKIDpra'];
                $arr = array(
                    'CurriculumID' => $item['KurikulumID'],
                    'CurriculumTypeID' => $item['JenisKurikulumID'],
                    'MKID' => $item['MKID'],
                    'MKCode' => $item['MKCode'],
//                    'ProdiIDBefore' => $item['ProdiID'],
                    'ProdiID' => $ProdiID,
                    'LecturerNIP' => $item['NIP'],
                    'MKType' => $item['JenisMK'],
                    'Semester' => $item['Semester'],
                    'TotalSKS' => $item['TotalSKS'],
                    'SKSTeori' => $item['SKSTatapMuka'],
                    'SKSPraktikum' => $item['SKSPraktikum'],
                    'PreconditionMKID' => $PreconditionMKID,
                    'SKSPraktikLapangan' => $item['SKSPraktekLap'],
                    'StatusSilabus' => $item['Silabus'],
                    'StatusSAP' => $item['SAP'],
                    'UpdateBy' => '2017090',
                    'UpdateAt' => '2018-01-08 10:10:10'
                );


                $this->db->insert('db_academic.curriculum_details',$arr);
            }

            print_r(count($data));


        }
        else if($table=='krs'){
            $angkatan = 14;

            $db_lokal = 'ta_20'.$angkatan;
//            $data = $this->db_server->query('SELECT r.ID,j.TahunID AS SemesterID, th.TahunID AS YearCode,m.NPM,r.JadwalID AS ScheduleID,
//mk.MKKode AS MKCode,mk.Nama AS MKName, mk.NamaInggris AS MKNameEng,
//r.Evaluasi1,r.Evaluasi2,r.Evaluasi3,r.Evaluasi4,r.Evaluasi5,
//r.UTS,r.UAS,r.NilaiAkhir AS Score,r.NilaiHuruf AS Grade,r.approval AS Approval
//from siak4.rencanastudi r
//left JOIN siak4.mahasiswa m ON (r.MhswID=m.ID)
//left join siak4.jadwal j ON (r.JadwalID = j.ID)
//left join siak4.tahun th ON(j.TahunID=th.ID)
//left join siak4.matakuliah mk ON(j.MKID = mk.ID)
//WHERE r.JadwalID!=\'\' AND r.NilaiAkhir!=0.00 AND substring(m.NPM,3,2)='.$angkatan)->result_array();

            $dataMhs = $this->db_server->query('SELECT ID FROM siak4.mahasiswa m where substring(m.NPM,3,2)='.$angkatan)->result_array();
            $this->db->truncate($db_lokal.'.study_planning_old');
            for($m=0;$m<count($dataMhs);$m++){

                $data = $this->db_server->query('SELECT 
                                                r.ID,j.TahunID AS SemesterID, 
                                                r.JadwalID AS ScheduleID,
                                                r.Evaluasi1,r.Evaluasi2,r.Evaluasi3,r.Evaluasi4,r.Evaluasi5,
                                                r.UTS,r.UAS,r.NilaiAkhir AS Score,r.NilaiHuruf AS Grade,r.approval AS Approval,
                                                m.MKKode AS MKCode,m.Nama AS MKName, m.NamaInggris AS MKNameEng,
                                                mhs.NPM,
                                                th.TahunID AS YearCode, dt.TotalSKS AS Credit
                                                                                        
                                                 FROM siak4.rencanastudi r 
                                                JOIN siak4.jadwal j ON (r.JadwalID=j.ID)
                                                JOIN siak4.matakuliah m ON (m.ID=j.MKID)
                                                join siak4.mahasiswa mhs ON(r.MhswID = mhs.ID)
                                                join siak4.tahun th ON(j.TahunID=th.ID)
                                                left JOIN siak4.detailkurikulum dt ON (dt.MKID = j.MKID)
                                                where r.MhswID = '.$dataMhs[$m]['ID'].'
                                                GROUP BY m.ID')->result_array();

                for($i=0;$i<count($data);$i++){
                    $data_insert = array(
                        'SemesterID' => $data[$i]['SemesterID'],
                        'YearCode' => $data[$i]['YearCode'],
                        'NPM' => $data[$i]['NPM'],
                        'ScheduleID' => $data[$i]['ScheduleID'],
                        'MKCode' => $data[$i]['MKCode'],
                        'Credit' => $data[$i]['Credit'],
                        'MKName' => $data[$i]['MKName'],
                        'MKNameEng' => $data[$i]['MKNameEng'],
                        'Evaluasi1' => $data[$i]['Evaluasi1'],
                        'Evaluasi2' => $data[$i]['Evaluasi2'],
                        'Evaluasi3' => $data[$i]['Evaluasi3'],
                        'Evaluasi4' => $data[$i]['Evaluasi4'],
                        'Evaluasi5' => $data[$i]['Evaluasi5'],
                        'UTS' => $data[$i]['UTS'],
                        'UAS' => $data[$i]['UAS'],
                        'Score' => $data[$i]['Score'],
                        'Grade' => $data[$i]['Grade'],
                        'Approval' => $data[$i]['Approval']
                    );
                    $this->db->insert($db_lokal.'.study_planning_old',$data_insert);
                }

            }





        }
        else if($table=='khs'){
            $angkatan = 14;

            $db_lokal = 'ta_20'.$angkatan;

            $data = $this->db_server->query('SELECT hs.TahunID AS SemesterID, m.NPM, hs.SKSIPS AS SKS, hs.IPS, hs.IPK , hs.SKSIPK AS TotalSKS
                                        FROM siak4.hasilstudi hs
                                        LEFT JOIN siak4.mahasiswa m ON(hs.MhswID = m.ID)
                                        WHERE substring(m.NPM,3,2)='.$angkatan)->result_array();

            $this->db->truncate($db_lokal.'.study_results_old');

            for ($i=0;$i<count($data);$i++){
                $dataInsert = array(
                    'NPM' => $data[$i]['NPM'],
                    'SemesterID' => $data[$i]['SemesterID'],
                    'SKS' => $data[$i]['SKS'],
                    'IPS' => $data[$i]['IPS'],
                    'IPK' => $data[$i]['IPK'],
                    'TotalSKS' => $data[$i]['TotalSKS']
                );

                $this->db->insert($db_lokal.'.study_results_old',$dataInsert);
            }



        }

//        else if($table=='gent'){
//            $data = $this->db->query('SELECT * FROM db_academic.auth_students WHERE  Year=2017')->result_array();
//
//            for($i=0;$i<count($data);$i++){
//                $pass = $this->genratePassword($data[$i]['NPM'],123456);
////                echo $pass;
//                $this->db->set('Password', $pass);
//                $this->db->where('ID', $data[$i]['ID']);
//                $this->db->update('db_academic.auth_students');
//            }
////            print_r($data);
//        }

    }

    private function genratePassword($NIP,$Password){

        $plan_password = $NIP.''.$Password;
        $pas = md5($plan_password);
        $pass = sha1('jksdhf832746aiH{}{()&(*&(*'.$pas.'HdfevgyDDw{}{}{;;*766&*&*');

        return $pass;
    }


}
