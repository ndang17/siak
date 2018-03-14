<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_master extends MY_Controller {

    function __construct()
    {
        parent::__construct();
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

    public function sma()
    {
        $data['department'] = parent::__getDepartement();
        $content = $this->load->view('page/'.$data['department'].'/master/sma',$data,true);
        $this->temp($content);
    }

    public function sma_integration()
    {
        $data['department'] = parent::__getDepartement();
        $content = $this->load->view('page/'.$data['department'].'/master/sma_integration',$data,true);
        $this->temp($content);

    }

    public function sma_table()
    {
        $token = $this->input->post('token');
        $data['department'] = parent::__getDepartement();
        $data['token'] = $token;
        $this->load->view('page/'.$data['department'].'/master/sma_table',$data);
    }

    public function config_set_email()
    {
            $data['department'] = parent::__getDepartement();
            $getEmailConfig = $this->m_sendemail->loadEmailConfig();
            $data['email'] = $getEmailConfig['setting'];
            $content = $this->load->view('page/'.$data['department'].'/master/set_email',$data,true);
            $this->temp($content);
    }

    public function testing_email()
    {
        $input = $this->getInputToken();
        $email = $input['email'];
        $pwd = $input['pwd'];
        $smtp_port = $input['smtp_port'];
        $smtp_host = $input['smtp_host'];
        $to = "alhadi.rahman@podomorouniversity.ac.id";
        $subject = "Testemail";
        $sendEmail = $this->m_sendemail->sendEmail($to,$subject,$smtp_host,$smtp_port,$email,$pwd);
        return print_r(json_encode($sendEmail));
    }

    public function save_email()
    {
        $input = $this->getInputToken();
        $email = $input['email'];
        $pwd = $input['pwd'];
        $smtp_port = $input['smtp_port'];
        $smtp_host = $input['smtp_host'];
        $save_email = $this->m_sendemail->save_email($smtp_host,$smtp_port,$email,$pwd);
        
    }

}
