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
  
}
