<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admission extends CI_Model {

  public $data = array(
                      'ID_register_document' => null,
                      );

  public function __construct()
    {
        parent::__construct();
    }

    public function count_calon_mahasiswa()
    {
        $sql = "select count(*) as total from (
                select count(*) as total from db_admission.register_formulir as a
                join db_admission.register_document as b ON
                a.ID = b.ID_register_formulir
                where b.Status != 'Done'
                GROUP BY a.ID
                ) as a
                ";          
        $query=$this->db->query($sql, array())->result_array();
        $conVertINT = (int) $query[0]['total'];
        return $conVertINT;
    }

    public function selectDataCalonMahasiswa($limit,$start,$tahun,$nama,$status)
    {
      $arr_temp = array('data' => array());
      if($nama != '%') {
          $nama = '"%'.$nama.'%"'; 
      }
      else
      {
        $nama = '"%"'; 
      }
      if($status == 'Belum Done') {
        $status = 'Status != "Done"';
      }
      else
      {
        $status = 'Status = "Done"';
      }

      $tahun = 'year(RegisterAT) = '.$tahun;
      $sql = "select * from (
              select a.ID,z.name as name_programstudy, 
              (select count(*) as total from db_admission.register_document 
              where ".$status." and ID_register_formulir = a.ID
              GROUP BY ID_register_formulir limit 1) as document_undone,
              (select count(*) as total from db_admission.register_document 
              where Status = 'Progress Checking' and ID_register_formulir = a.ID
              GROUP BY ID_register_formulir limit 1) as document_progress,
              a.ID_program_study,d.Name,a.IdentityCard,e.ctr_name as Nationality,concat(a.PlaceBirth,',',a.DateBirth) as PlaceDateBirth,g.JenisTempatTinggal,
              h.ctr_name as CountryAddress,i.ProvinceName as ProvinceAddress,j.RegionName as RegionAddress,k.DistrictName as DistrictsAddress,
                          a.District as DistrictAddress,a.Address,a.ZipCode,a.PhoneNumber,d.Email,n.SchoolName,l.sct_name_id as SchoolType,m.SchoolMajor,
              n.ProvinceName as SchoolProvince,n.CityName as SchoolRegion,n.SchoolAddress,a.YearGraduate,IF(a.KPSReceiverStatus = 'YA',CONCAT('No KPS : ',a.NoKPS),'Tidak') as KPSReceiver,
              a.UploadFoto,d.RegisterAT
              from db_admission.register_formulir as a
              JOIN db_admission.register_verified as b 
              ON a.ID_register_verified = b.ID
              JOIN db_admission.register_verification as c
              ON b.RegVerificationID = c.ID
              JOIN db_admission.register as d
              ON c.RegisterID = d.ID
              JOIN db_admission.country as e
              ON a.NationalityID = e.ctr_code
              JOIN db_admission.register_jtinggal_m as g
              ON a.ID_register_jtinggal_m = g.ID
              JOIN db_admission.country as h
              ON a.ID_country_address = h.ctr_code
              JOIN db_admission.province as i
              ON a.ID_province = i.ProvinceID
              JOIN db_admission.region as j
              ON a.ID_region = j.RegionID
              JOIN db_admission.district as k
              ON a.ID_districts = k.DistrictID
              JOIN db_admission.school_type as l
              ON l.sct_code = a.ID_school_type
              JOIN db_admission.register_major_school as m
              ON m.ID = a.ID_register_major_school
              JOIN db_admission.school as n
              ON n.ID = d.SchoolID
              JOIN db_academic.program_study as z
              on a.ID_program_study = z.id
              ) as a
              where document_undone > 0 and Name like ".$nama." and ".$tahun."
              order by document_progress desc
              LIMIT ".$start. ", ".$limit; // query undone

        $query=$this->db->query($sql, array())->result();
          $a = 0;
          foreach ($query as $key) { // foreach 1
            $ID_register_formulir = $key->ID;
            $sql2 = "select a.*, b.DocumentChecklist,b.Required from db_admission.register_document as a
              join db_admission.reg_doc_checklist as b
              on a.ID_reg_doc_checklist = b.ID where a.ID_register_formulir = ? ";
              $query2=$this->db->query($sql2, array($ID_register_formulir))->result();
              $arr_document = array();
              $b = 0;
              foreach ($query2 as $row) { // foreach 2
                  $arr_document[$b] = array(
                                          'ID_register_document' => $row->ID,
                                          'DocumentChecklist' => $row->DocumentChecklist,
                                          'Required' => $row->Required,
                                          'Attachment' => $row->Attachment,
                                          'Status' => $row->Status,
                  );
                  $arr_temp['data'][$a] = array(
                              'Name' => $key->Name,
                              'Email' => $key->Email,
                              'PhoneNumber' => $key->PhoneNumber,
                              'Name_programstudy' => $key->name_programstudy,
                              'Alamat' => $key->Address." Kelurahan ".$key->DistrictAddress." ".$key->DistrictsAddress." ".$key->RegionAddress." ".$key->ProvinceAddress,
                              'SMA' => $key->SchoolName." ".$key->SchoolRegion." ".$key->SchoolProvince,
                              'document' => $arr_document,
                  );
                          
                  $b++;
              }  // exit foreach 2
              $a++;
          } // exit foreach 1
          return $arr_temp;
    }

    public function updateStatusVeriDokumen($data_arr,$Status)
    {
        for ($i=0; $i < count($data_arr); $i++) { 
          $arr = explode(";", $data_arr[$i]);
          $ID = $arr[0];
          $NamaFile = ($arr[1] == 'nothing' ? $NamaFile="" : $NamaFile=$arr[1]);
          $VerificationBY = $this->session->userdata('NIP');
          $VerificationAT = date("Y-m-d H:i:s");
          $sql = "update db_admission.register_document set Status = ?,Attachment = ?, VerificationBY = ?, VerificationAT = ? where ID = ?";
          $query=$this->db->query($sql, array($Status,$NamaFile,$VerificationBY,$VerificationAT,$ID));
        } 
        
    }

    public function getKeylinkURLFormulirRegistration($ID_Register = null,$email = null)
    {
      $this->load->model('m_master');
      $ID_register_document = $this->data['ID_register_document'];
      $callback = array();
      switch ($ID_Register) {
        case null:
          $sql = "select a.ID,a.Email from db_admission.register as a
                  join db_admission.register_verification as b 
                  on a.ID = b.RegisterID
                  join db_admission.register_verified as c
                  on b.ID = c.RegVerificationID 
                  join db_admission.register_formulir as d
                  on c.ID = d.ID_register_verified
                  join db_admission.register_document as e
                  on d.ID = e.ID_register_formulir
                  where e.ID = ? LIMIT 1";
          $query=$this->db->query($sql, array($ID_register_document))->result_array();
          $RegisterID = $query[0]['ID'];
          if ($email == null) {
            $query = $this->m_master->caribasedprimary('db_admission.register','ID',$RegisterID);
            $email = $query[0]['Email'];
          }
          $this->getlinkURLFormulirRegistration($RegisterID,$email);
          break;
        
        default:
          $this->load->library('JWT');
          $key = "UAP)(*";
          if ($email == null) {
            $query = $this->m_master->caribasedprimary('db_admission.register','ID',$ID_Register);
            $email = $query[0]['Email'];
          }
          $url = $this->jwt->encode($ID_Register.";".$email,$key);
          $callback = array('url' => $url,'email' => $email);
          $this->data['callback'] = $callback;
          break;
      }

      return $callback;
    }

    private function getlinkURLFormulirRegistration($ID_Register,$email)
    {
      $this->load->library('JWT');
      $key = "UAP)(*";
      if ($email == null) {
        $query = $this->m_master->caribasedprimary('db_admission.register','ID',$ID_Register);
        $email = $query[0]['Email'];
      }
      $url = $this->jwt->encode($ID_Register.";".$email,$key);
      $callback = array('url' => $url,'email' => $email);
      $this->data['callback'] = $callback;
    }

    public function checkAllstatusDoneVeriDoc($ID_register_document)
    {
      $check = TRUE;
      $query = $this->m_master->caribasedprimary('db_admission.register_document','ID',$ID_register_document);
      $ID_register_formulir = $query[0]['ID_register_formulir'];
      $query = $this->m_master->caribasedprimary('db_admission.register_document','ID_register_formulir',$ID_register_formulir);
      for ($i=0; $i < count($query); $i++) { 
        $Status = $query[$i]['Status'];
        if ($Status != 'Done') {
          $check = FALSE;
          break;
        }
      }
      return $check;
    }

    public function totalDataFormulir_offline()
    {
      $sql = "select count(*) as total from (
              select a.Name as NameCandidate,a.Email,z.SchoolName,c.FormulirCode,a.StatusReg
              from db_admission.register as a 
              join db_admission.register_verification as b
              on a.ID = b.RegisterID
              join db_admission.register_verified as c
              on c.RegVerificationID = b.ID
              join db_admission.school as z
              on z.ID = a.SchoolID
              where a.StatusReg = 1
              ) as a right JOIN db_admission.formulir_number_offline_m as b
              on a.FormulirCode = b.FormulirCode
              left join db_employees.employees as c
              on b.SellLinkBy = c.NIP";          
      $query=$this->db->query($sql, array())->result_array();
      $conVertINT = (int) $query[0]['total'];
      return $conVertINT;
    }

    public function selectDataDitribusiFormulirOffline($limit, $start,$tahun,$NomorFormulir,$NamaStaffAdmisi,$status)
    {
      $arr_temp = array('data' => array());
      if($NomorFormulir != '%') {
          $NomorFormulir = '"%'.$NomorFormulir.'%"'; 
      }
      else
      {
        $NomorFormulir = '"%"'; 
      }
      if($NamaStaffAdmisi != '%') {
          $NamaStaffAdmisi = ' and c.Name like "%'.$NamaStaffAdmisi.'%"'; 
      }
      else
      {
        $NamaStaffAdmisi = ''; 
      }
      if($status != '%') {
        // $status = '"%'.$status.'%"'; 
        // $status = 'StatusUsed != '.$status;
        $status = ' and b.Status = '.$status;
      }
      else
      {
        $status = ''; 
      }

        $sql = 'select a.NameCandidate,a.Email,a.SchoolName,b.FormulirCode,a.StatusReg,b.Years,b.Status as StatusUsed, b.StatusJual, C.Name as SellName from (
          select a.Name as NameCandidate,a.Email,z.SchoolName,c.FormulirCode,a.StatusReg
          from db_admission.register as a 
          join db_admission.register_verification as b
          on a.ID = b.RegisterID
          join db_admission.register_verified as c
          on c.RegVerificationID = b.ID
          join db_admission.school as z
          on z.ID = a.SchoolID
          where a.StatusReg = 1
          ) as a right JOIN db_admission.formulir_number_offline_m as b
          on a.FormulirCode = b.FormulirCode
          left join db_employees.employees as c
          on b.SellLinkBy = c.NIP where Years = "'.$tahun.'" and b.FormulirCode like '.$NomorFormulir.$NamaStaffAdmisi.$status.' LIMIT '.$start. ', '.$limit;
           $query=$this->db->query($sql, array())->result_array();
           return $query;
    }

    public function updateSelloutFormulir($data_arr)
    {
      $SellLinkBy = $this->session->userdata('NIP');

      for ($i=0; $i < count($data_arr); $i++) { 
        if ($data_arr == 'nothing') {
          continue;
        }
        $sql = "update db_admission.formulir_number_offline_m set StatusJual = 1,SellLinkBy = ? where FormulirCode = ?";
        $query=$this->db->query($sql, array($SellLinkBy,$data_arr[$i]));
      }
    }

    public function getJadwalUjian()
    {
      $sql = "select C.Name,a.ID_ujian_perprody,DATE(a.DateTimeTest) as tanggal
              ,CONCAT((EXTRACT(HOUR FROM a.DateTimeTest)),':',(EXTRACT(MINUTE FROM a.DateTimeTest))) as jam,
              a.Lokasi from db_admission.register_jadwal_ujian as a 
              join db_admission.ujian_perprody_m as b
              on a.ID_ujian_perprody = b.ID
              join db_academic.program_study as c
              on c.ID = b.ID_ProgramStudy
              GROUP BY C.Name,DATE(a.DateTimeTest)
              ";          
      $query=$this->db->query($sql, array())->result_array();
      return $query;
    }

    public function save_jadwal_ujian($ID_ujian_perprody,$DateTimeTest,$Lokasi)
    {
      $dataSave = array(
              'ID_ujian_perprody' => $ID_ujian_perprody,
              'DateTimeTest' => $DateTimeTest,
              'Lokasi' => $Lokasi,
      );
      $this->db->insert('db_admission.register_jadwal_ujian', $dataSave);
    }

    public function getID_register_formulir_programStudy_arr($arr)
    {
      $arr_temp = array();
      for ($i=0; $i < count($arr); $i++) { 
        $sql = "select ID from db_admission.register_formulir where ID_program_study = ? ";          
        $query=$this->db->query($sql, array($arr[$i]['ID_ProgramStudy']))->result_array();
        for ($j=0; $j < count($query); $j++) { 
          $arr_temp[] = array('ID_register_formulir' => $query[$j]['ID'],'ID_register_jadwal_ujian' => $arr[$i]['ID_register_jadwal_ujian']);
        }
      }
      
      return $arr_temp;
    }

    public function get_arr_ID_ujian_per_prody($arr_ID_ProgramStudy)
    {
      $arr_temp = array('result' => '','data' => array());
      $arr = array();
      $x = 0;
      for ($i=0; $i <  count($arr_ID_ProgramStudy) ; $i++) { 
        $sql = "select ID,ID_ProgramStudy from db_admission.ujian_perprody_m where ID_ProgramStudy = ? ";          
        $query=$this->db->query($sql, array($arr_ID_ProgramStudy[$i]))->result_array();
        // print_r($query);
          if (count($query) == 0) {
            $arr_temp['result'] = 'Ujian Masuk Per Prody belum disetting, silahkan inputkan dulu pada Master Registration Ujian Per Prody';  
            break;
          }
          else
          {
              for ($j=0; $j < count($query); $j++) { 
                $arr[$x] = array('ID_ujian_perprody' =>$query[$j]['ID'], 'ID_ProgramStudy' => $query[$j]['ID_ProgramStudy'] );
                $x++;
              }
          }
      }
      $arr_temp['data'] = $arr;
      return $arr_temp;
    }

    public function saveDataJadwalUjian_returnArr($arr_ID_ujian_per_prody,$DateTimeTest,$Lokasi)
    {
      $arr_temp = array();
      $x = 0;
       // print_r($arr_ID_ujian_per_prody['data']);
      for ($i=0; $i < count($arr_ID_ujian_per_prody['data']); $i++) {
        try{
          $dataSave = array(
                  'ID_ujian_perprody' => $arr_ID_ujian_per_prody['data'][$i]['ID_ujian_perprody'],
                  'DateTimeTest' => $DateTimeTest,
                  'Lokasi' => $Lokasi,
          );
          $this->db->insert('db_admission.register_jadwal_ujian', $dataSave);
        }
        catch(Exception $e)
        {
          continue;
        } 
        
        $sql = "select ID from db_admission.register_jadwal_ujian where ID_ujian_perprody = ? and DateTimeTest = ? and Lokasi = ?";          
        $query=$this->db->query($sql, array($arr_ID_ujian_per_prody['data'][$i]['ID_ujian_perprody'],$DateTimeTest,$Lokasi))->result_array();
        $arr = array();
        for ($j=0; $j < count($query) ; $j++) { 
          $arr_temp[$x] = array('ID_register_jadwal_ujian' => $query[0]['ID'],'ID_ProgramStudy' => $arr_ID_ujian_per_prody['data'][$i]['ID_ProgramStudy'] );
          $x++;
        }
      }

      return $arr_temp;
    }

    public function saveDataregister_formulir_jadwal_ujian($arr_id)
    {
      error_reporting(0);
      for ($i=0; $i < count($arr_id); $i++) { 
        try
        {
          // check ID_register_formulir sudah ada pada jadwal ujian atau belum 
          $sql = 'select count(*) as total from db_admission.register_formulir_jadwal_ujian where ID_register_formulir = ?';
          $query=$this->db->query($sql, array($arr_id[$i]['ID_register_formulir']))->result_array();
          if (count($query) == 0) {
            $dataSave = array(
                    'ID_register_jadwal_ujian' => $arr_id[$i]['ID_register_jadwal_ujian'],
                    'ID_register_formulir' => $arr_id[$i]['ID_register_formulir'],
            );
            $this->db->insert('db_admission.register_formulir_jadwal_ujian', $dataSave);
          }
          
        }
        catch(Exception $e)
        {
          continue;
        }
      }
      
    }

    public function daftar_jadwal_ujian_load_data_now()
    {
      $sql = 'select C.Name as prody,a.ID_ujian_perprody,DATE(a.DateTimeTest) as tanggal
        ,CONCAT((EXTRACT(HOUR FROM a.DateTimeTest)),":",(EXTRACT(MINUTE FROM a.DateTimeTest))) as jam,
        a.Lokasi,
        h.Name as NameCandidate,h.Email,i.SchoolName,f.FormulirCode,e.ID as ID_register_formulir
        from db_admission.register_jadwal_ujian as a 
        join db_admission.ujian_perprody_m as b
        on a.ID_ujian_perprody = b.ID
        join db_academic.program_study as c
        on c.ID = b.ID_ProgramStudy
        join db_admission.register_formulir_jadwal_ujian as d
        ON a.ID = d.ID_register_jadwal_ujian
        JOIN db_admission.register_formulir as e
        on e.ID = d.ID_register_formulir
        join db_admission.register_verified as f
        on e.ID_register_verified = f.ID
        join db_admission.register_verification as g
        on g.ID = f.RegVerificationID
        join db_admission.register as h
        on h.ID = g.RegisterID
        join db_admission.school as i
        on i.ID = h.SchoolID
        where DATE(a.DateTimeTest) = CURDATE()
        GROUP BY C.Name,DATE(a.DateTimeTest),e.ID';
      $query=$this->db->query($sql, array())->result_array();
      return $query;
    }

}
