<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admission extends CI_Model {

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

    public function selectDataCalonMahasiswa($limit,$start)
    {
      $arr_temp = array('data' => array());
      $sql = "select * from (
              select a.ID,z.name as name_programstudy, 
              (select count(*) as total from db_admission.register_document 
              where Status != 'Done' and ID_register_formulir = a.ID
              GROUP BY ID_register_formulir limit 1) as document_undone,
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
              where document_undone > 0
              LIMIT ".$start. ", ".$limit; // query undone
        $query=$this->db->query($sql, array())->result();
          $a = 0;
          $b = 0;
          foreach ($query as $key) { // foreach 1
            $ID_register_formulir = $key->ID;
            $sql2 = "select a.*, b.DocumentChecklist,b.Required from db_admission.register_document as a
              join db_admission.reg_doc_checklist as b
              on a.ID_reg_doc_checklist = b.ID where a.ID_register_formulir = ? ";
              $query2=$this->db->query($sql2, array($ID_register_formulir))->result();
              $arr_document = array();
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
  
}
