<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admission extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }

    public function count_calon_mahasiswa()
    {
      $sql = "select * from (
              select count(*) as total,(select count(*) as total from db_admission.reg_doc_checklist where Active = 1 limit 1) as total_document,
              (select count(*) as total from db_admission.register_document 
              where Status != 'Done'
              GROUP BY ID_register_formulir limit 1) as document_undone
              from db_admission.register_formulir as a
              JOIN db_admission.register_verified as b 
              ON a.ID_register_verified = b.ID
              JOIN db_admission.register_verification as c
              ON b.RegVerificationID = c.ID
              JOIN db_admission.register as d
              ON c.RegisterID = d.ID
              JOIN db_admission.country as e
              ON a.NationalityID = e.ctr_code
              JOIN db_employees.religion as f
              ON a.ReligionID = f.IDReligion
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
              JOIN db_admission.register_jacket_size_m as o
              ON o.ID = a.ID_register_jacket_size_m
              JOIN db_admission.occupation as p
              ON p.ocu_code = a.Father_ID_occupation
              JOIN db_admission.register_income_m as q
              ON q.ID = a.Father_ID_register_income_m
              JOIN db_admission.country as r
              ON r.ctr_code = a.FatherAddress_ID_country
              JOIN db_admission.province as s
              ON s.ProvinceID = a.FatherAddress_ID_province
              JOIN db_admission.region as t
              ON t.RegionID = a.FatherAddress_ID_region
              JOIN db_admission.occupation as u
              ON u.ocu_code = a.Mother_ID_occupation
              JOIN db_admission.register_income_m as v
              ON v.ID = a.Mother_ID_register_income_m
              JOIN db_admission.country as w
              ON w.ctr_code = a.MotherAddress_ID_country
              JOIN db_admission.province as x
              ON x.ProvinceID = a.MotherAddress_ID_province
              JOIN db_admission.region as y
              ON y.RegionID = a.MotherAddress_ID_region
              limit 1) as a
              where total_document = document_undone
                    ";
        $query=$this->db->query($sql, array())->result_array();
        $conVertINT = (int) $query[0]['total'];
        return $conVertINT;
    }

    public function selectDataCalonMahasiswa($limit,$start)
    {
      $sql = "select * from (
              select a.ID,z.name as name_programstudy, 
              (select count(*) as total from db_admission.reg_doc_checklist where Active = 1 limit 1) as total_document,
              (select count(*) as total from db_admission.register_document 
                where Status != 'Done' and ID_register_formulir = a.ID
                GROUP BY ID_register_formulir limit 1) as document_undone,
              a.ID_program_study,d.Name,a.Gender,a.IdentityCard,e.ctr_name as Nationality,f.Religion,concat(a.PlaceBirth,',',a.DateBirth) as PlaceDateBirth,g.JenisTempatTinggal,
              h.ctr_name as CountryAddress,i.ProvinceName as ProvinceAddress,j.RegionName as RegionAddress,k.DistrictName as DistrictsAddress,
              a.District as DistrictAddress,a.Address,a.ZipCode,a.PhoneNumber,d.Email,n.SchoolName,l.sct_name_id as SchoolType,m.SchoolMajor,e.ctr_name as SchoolCountry,
              n.ProvinceName as SchoolProvince,n.CityName as SchoolRegion,n.SchoolAddress,a.YearGraduate,IF(a.KPSReceiverStatus = 'YA',CONCAT('No KPS : ',a.NoKPS),'Tidak') as KPSReceiver,
              o.JacketSize,a.FatherName,a.FatherNIK,CONCAT(a.FatherPlaceBirth,',',a.FatherDateBirth) as FatherPlaceDateBirth,a.FatherStatus,a.FatherPhoneNumber,p.ocu_name as FatherOccupation,q.Income as FatherIncome,
              r.ctr_name as FatherCountry,s.ProvinceName as FatherProvince,t.RegionName as FatherRegion,a.FatherAddress,
              a.MotherName,a.MotherNik,CONCAT(a.MotherPlaceBirth,',',a.MotherDateBirth) as MotherPlaceDateBirth,a.MotherStatus,a.MotherPhoneNumber,u.ocu_name  as MotherOccupation,v.Income as MotherIncome,
              w.ctr_name as MotherCountry,x.ProvinceName as MotherProvince,y.RegionName as MotherRegion,a.MotherAddress,a.UploadFoto
              from db_admission.register_formulir as a
              JOIN db_admission.register_verified as b 
              ON a.ID_register_verified = b.ID
              JOIN db_admission.register_verification as c
              ON b.RegVerificationID = c.ID
              JOIN db_admission.register as d
              ON c.RegisterID = d.ID
              JOIN db_admission.country as e
              ON a.NationalityID = e.ctr_code
              JOIN db_employees.religion as f
              ON a.ReligionID = f.IDReligion
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
              JOIN db_admission.register_jacket_size_m as o
              ON o.ID = a.ID_register_jacket_size_m
              JOIN db_admission.occupation as p
              ON p.ocu_code = a.Father_ID_occupation
              JOIN db_admission.register_income_m as q
              ON q.ID = a.Father_ID_register_income_m
              JOIN db_admission.country as r
              ON r.ctr_code = a.FatherAddress_ID_country
              JOIN db_admission.province as s
              ON s.ProvinceID = a.FatherAddress_ID_province
              JOIN db_admission.region as t
              ON t.RegionID = a.FatherAddress_ID_region
              JOIN db_admission.occupation as u
              ON u.ocu_code = a.Mother_ID_occupation
              JOIN db_admission.register_income_m as v
              ON v.ID = a.Mother_ID_register_income_m
              JOIN db_admission.country as w
              ON w.ctr_code = a.MotherAddress_ID_country
              JOIN db_admission.province as x
              ON x.ProvinceID = a.MotherAddress_ID_province
              JOIN db_admission.region as y
              ON y.RegionID = a.MotherAddress_ID_region
              JOIN db_academic.program_study as z
              on a.ID_program_study = z.id
              ) as a
              where total_document = document_undone
              LIMIT ".$start. ", ".$limit; // query undone
        // $query=$this->db->query($sql, array($start,$limit))->result();
              //var_dump($limit);
        $query=$this->db->query($sql, array())->result();
        
           $output = '
            <table class="table table-bordered">
             <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>Document</th>
              <th>Status</th>
             </tr>
            ';  
          foreach ($query as $key) { // foreach 1
            $ID_register_formulir = $key->ID;
            $sql2 = "select a.*, b.DocumentChecklist from db_admission.register_document as a
              join db_admission.reg_doc_checklist as b
              on a.ID_reg_doc_checklist = b.ID where a.ID_register_formulir = ? ";
              $query2=$this->db->query($sql2, array($ID_register_formulir))->result();
              foreach ($query2 as $row) { // foreach 2
                  $output .= '<tr>
                                <td>'.$key->Name.'</td>
                                <td>'.$key->Email.'</td>
                                <td>'.$row->DocumentChecklist.'</td>
                                <td>'.$row->Status.'</td>
                              </tr>';
              }  // exit foreach 2
          } // exit foreach 1

          $output .= '</table>';
          return $output;
    }
  
}
