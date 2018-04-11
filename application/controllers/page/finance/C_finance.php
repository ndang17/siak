<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_finance extends MY_Controller {

    private $data = array();

    function __construct()
    {
        parent::__construct();
        $this->data['department'] = parent::__getDepartement();
        $this->load->model('finance/m_finance');
        $this->load->model('m_sendemail');
    }


    public function temp($content)
    {
        parent::template($content);
    }

    public function getInputToken()
    {
        $token = $this->input->post('token');
        $key = "UAP)(*";
        $data_arr = (array) $this->jwt->decode($token,$key);
        return $data_arr;
    }

    public function index()
    {
        $data['department'] = parent::__getDepartement();
        $content = "test";
        $this->temp($content);
    }

    public function verfikasi_pembayaran_registration_online()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/penerimaan_pembayaran/verfikasi_pembayaran_registration_online',$this->data,true);
        $this->temp($content);
    }

    public function confirmed_verfikasi_pembayaran_registration_online()
    {
        $input = $this->getInputToken();
        $arrdata = $input['arrdata'];
        $getEmailnURL = $this->getEmailnURL($arrdata);
        $SendEmail = $this->SendEmailToCandidate($getEmailnURL);
        $saveData = $this->SaveDataVerification($arrdata);
        //return print_r(json_encode($this->data));
    }

    public function getEmailnURL($arrdata)
    {
        $arr = explode(",", $arrdata);
        return $getEmailnURL = $this->m_finance->getEmailnURLCheckbox($arr,";");
        
    }

    public function SendEmailToCandidate($arr_email_url)
    {
        for ($i=0; $i < count($arr_email_url); $i++) {
            if ($arr_email_url[$i]['email'] != "nothing") {
                /*$text = 'Dear Candidate,<br><br>
                            Please click link below to get <strong>Formulir Registration</strong> :<br>
                            '.$this->GlobalVariableAdi['url_registration']."formulir-registration/".$arr_email_url[$i]['url'].'
                        ';*/
                $text = 'Dear Candidate,<br><br>
                            Please click link below to login your portal <br>
                            '.$this->GlobalVariableAdi['url_registration']."login/".'
                        ';        
                $to = $arr_email_url[$i]['email'];
                $subject = "Link Formulir Registration Podomoro University";
                $sendEmail = $this->m_sendemail->sendEmail($to,$subject,null,null,null,null,$text);
                /*if ($sendEmail['status'] == 0) {
                    var_dump($sendEmail['msg']);
                }*/
            }
        }
    }

    public function SaveDataVerification($arrdata)
    {
        $this->m_finance->ProcessSaveDataVerification($arrdata);
    }


}
