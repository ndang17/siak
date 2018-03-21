<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_finance extends CI_Model {

   private $data = array();
   function __construct()
   {
       parent::__construct();
   }

   public function getEmailnURLCheckbox($arr,$delimiter)
   {
    $this->load->library('JWT');
    $key = "UAP)(*";
    $arr_temp = array();
    for ($i=0; $i < count($arr); $i++) { 
      $temp = explode($delimiter, $arr[$i]);
      $url = $this->jwt->encode($temp[0].";".$temp[2],$key);
      $arr_temp[] = array('email'=>$temp[2],'url' => $url);
    }
    return $arr_temp;
   }

   public function ProcessSaveDataVerification($arrData)
   {
      $arrData = explode(",", $arrData);
      for ($i=0; $i < count($arrData); $i++) { 
        $temp = explode(";", $arrData[$i]);
        if ($temp[0] != 'nothing') {
          if ($temp[1] == null) {
            // insert data ke db register_verification
            $this->saveData_register_verification($temp[0]);
          }
          else
          {
            // dapatkan id register verification dahulu
            $this->load->model('master/m_master');
            $query = $this->m_master->caribasedprimary('db_admission.register_verification','RegisterID',$temp[0]);
            $id_register_verification = $query[0]['ID'];
            $this->saveDataRegisterVerified($id_register_verification);
          }
        }
      }
   }

   public function saveData_register_verification($registerID)
   {
    $dataSave = array(
            'RegisterID' => $registerID,
                    );

    $this->db->insert('db_admission.register_verification', $dataSave);
   }

   public function saveDataRegisterVerified($register_verified)
   {
    $dataSave = array(
            'RegVerificationID' => $register_verified,
            'VerificationBY' => $this->session->userdata('NIP'),
            'VerificationAT' => date('Y-m-d H:i:s'),
                    );
    $this->db->insert('db_admission.register_verified', $dataSave);
   }

}
