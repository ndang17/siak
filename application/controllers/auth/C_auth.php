
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
        } else if($table=='dosen'){
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
        } else if($table=='cek'){
//            $data = $this->db_server->query('SELECT d.* FROM siak4.dosen d JOIN siak4.karyawan k ON (d.nip=k.nip)')->result_array();
            $data = $this->db->query('SELECT * FROM db_employees.employees')->result_array();
            print_r($data);
        } else if($table=='mhs'){
            $angkatan = 17;
            $data = $this->db_server->query('SELECT * FROM siak4.mahasiswa WHERE substring(NPM,3,2) = '.$angkatan)->result_array();
            for($i=0;$i<count($data);$i++){
                $arr = array(
                    'ProdiID' => $data[$i]['ProdiID'],
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
                    'Email' => $data[$i]['Email'],
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
                    'PhoneFather' => $data[$i]['PhoneAyah'],
                    'PhoneMother' => $data[$i]['PhoneIbu'],
                    'OccupationFather' => $data[$i]['PekerjaanAyah'],
                    'OccupationMother' => $data[$i]['PekerjaanIbu'],
                    'EducationFather' => $data[$i]['PDAyah'],
                    'EducationMother' => $data[$i]['PDIbu'],
                    'AddressFather' => $data[$i]['AlamatAyah'],
                    'AddressMother' => $data[$i]['AlamatIbu'],
                    'EmailFather' => $data[$i]['EmailAyah'],
                    'EmailMother' => $data[$i]['EmailIbu'],
                    'StatusStudent' => $data[$i]['StatusMhswID']

                );

                $this->db->insert('db_students.ta20'.$angkatan,$arr);
            }
        } else if($table=='prodi'){
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
                $this->db->insert('db_akademik.program_study',$arr);
            }
        } else if($table=='mk'){
            $data = $this->db_server->query('SELECT dt.*,mk.nama,k.nama as K FROM siak4.detailkurikulum dt 
                                                  JOIN siak4.matakuliah mk ON (dt.MKID=mk.ID)
                                                  JOIN siak4.kurikulum k ON (dt.KurikulumID = k.ID)')->result_array();

            print_r($data);

        }


    }


}
