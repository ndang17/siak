<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sendemail extends CI_Model {

    private $VariableClass= array('text' => null,
                        'smtp_host' => null,
                        'smtp_port' => null,
                        'smtp_user' => null,
                        'smtp_pass' => null
                        );

    public function __construct()
    {
        parent::__construct();
    }

    public function loadEmailConfig()
    {
        $config_email_db = $this->config_email_db();
        return $config_email_db;
    }

    public function config_email_db()
    {

        if ($this->VariableClass['smtp_host'] != null) {
            $config = array('setting' => array(
                                        'protocol' => 'smtp',
                                        'smtp_host' => $this->VariableClass['smtp_host'],
                                        'smtp_port' => $this->VariableClass['smtp_port'],
                                        'smtp_user' => $this->VariableClass['smtp_user'], 
                                        'smtp_pass' => $this->VariableClass['smtp_pass'],
                                        'mailtype' => 'html',
                                        'charset' => 'iso-8859-1',
                                        'wordwrap' => TRUE
                            ),
                            'text' => $this->VariableClass['text'],
              
            );
        }
        else
        {
            $sql = "select * from db_admission.email_set as a limit 1";
            $query=$this->db->query($sql, array())->result_array();
            $config = array('setting' => array(
                                        'protocol' => 'smtp',
                                        'smtp_host' => $query[0]['smtp_host'],
                                        'smtp_port' => $query[0]['smtp_port'],
                                        'smtp_user' => $query[0]['email'], 
                                        'smtp_pass' => $query[0]['pass'],
                                        'mailtype' => 'html',
                                        'charset' => 'iso-8859-1',
                                        'wordwrap' => TRUE
                            ),
                            'text' => $query[0]['text'],
              
            );
        }
        
        return $config;
    }

    public function textEmail($text = null)
    {
        if ($text == null) {
            $text = '<div style="margin:0;padding:10px 0;background-color:#ebebeb;font-size:14px;line-height:20px;font-family:Helvetica,sans-serif;width:100%;text-align:center">
                    <div class="adM">
                    <br>
                    </div>
                    <table style="width:600px;margin:0 auto;background-color:#ebebeb" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                    <td></td>
                    <td style="background-color:#fff;padding:0 30px;color:#333;vertical-align:top">
                    <br>
                    <div style="font-family:Proxima Nova Semi-bold,Helvetica,sans-serif;font-weight:bold;font-size:24px;line-height:24px;color:#2196f3">
                    Podomoro University Testing Email
                    </div>
                    <div style="font-family:Proxima Nova Reg,Helvetica,sans-serif">
                    <div style="max-width:600px;margin:30px 0;display:block;font-size:14px;text-align:left!important">
                    Testing
                    <br><br>Best Regard, <br> IT Podomoro University (it@podomorouniversity.ac.id)
                    <br><br><br>
                    <p style="color:#EB6936;"><i>*) Do not reply, this email is sent automatically</i> </p>

                    </div>

                    </td>
                    <td></td>
                    </tr>
                    <tr>
                    <td colspan="3">
                    <div style="background-color:#fff;border-top:1px solid #ddd; ">';
        }

        return $this->VariableClass['text'] = $text;
        
    }

    public function sendEmail($to = null,$subject = null,$smtp_host = null,$smtp_port = null,$smtp_user = null,$smtp_pass = null)
    {   
        $arr = array(
            'status' => 1,
            'msg'=>''
            );
        $this->VariableClass['smtp_host'] = $smtp_host;
        $this->VariableClass['smtp_port'] = $smtp_port;
        $this->VariableClass['smtp_user'] = $smtp_user;
        $this->VariableClass['smtp_pass'] = $smtp_pass;

        $config_email = $this->loadEmailConfig();
        $textEmail = $this->textEmail($this->VariableClass['text']);
        $max_execution_time = 630;
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', $max_execution_time); //60 seconds = 1 minutes

        $this->load->library('email', $config_email['setting']);
        $this->email->set_newline("\r\n");
        $this->email->from('it@podomorouniversity.ac.id','IT Podomoro');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($this->VariableClass['text']);
        if($this->email->send())
        {
          $arr['status'] = 1;
          $arr['msg'] = "Email Send";
        }
        else
        {
            $arr['status'] = 0;
            $arr['msg'] = $this->email->print_debugger();
        }
        return $arr;
    }

    public function save_email($smtp_host,$smtp_port,$email,$pwd,$text)
    {
        // check existing email ada atau tidak
        $sql = "select * from db_admission.email_set limit 1";
        $data = array();
        $query=$this->db->query($sql, array())->result();
        
        if ($smtp_host != "" || $smtp_port != "" || $email != "" || $pwd != "") {
            if (count($query) > 0 ) {
                # update
                foreach ($query as $key) {
                    $data = array(
                                    'smtp_host' => $smtp_host,
                                    'smtp_port' => $smtp_port,
                                    'email' => $email,
                                    'pass' => $pwd,
                                    'text' => $text
                                  );
                }

                $this->db->set($data)
                         ->update('db_admission.email_set');
            }
            else
            {
                # insert
                $dataSave = array(
                        'smtp_host' => $smtp_host,
                        'smtp_port' => $smtp_port,
                        'email' => $email,
                        'pass' => $pwd,
                        'text' => $text
                                );

                $this->db->insert('db_admission.email_set', $dataSave);

            }
        }
        return "Done";
    }

    public function getToEmail($function = null)
    {
        $email_to = "it@podomorouniversity.ac.id";
        if ($function != null) {
            $arr_temp = array();
            $sql = "select EmailTo from db_admission.email_to as a where Active = 1 and Function = ?";
            $query=$this->db->query($sql, array($function))->result();
            foreach ($query as $key) {
               $arr_temp[] = $key->EmailTo;
            }
            $email_to = implode($arr_temp, ",");
        }
        return $email_to;
    }

}
