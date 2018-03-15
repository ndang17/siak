<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_master extends MY_Controller {

    private $data = array();

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_sendemail');
        $this->load->model('master/m_master');
        $this->data['department'] = parent::__getDepartement();
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
        $content = $this->load->view('page/'.$this->data['department'].'/master/sma',$this->data,true);
        $this->temp($content);
    }

    public function sma_integration()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/sma_integration',$this->data,true);
        $this->temp($content);

    }

    public function sma_table()
    {
        $token = $this->input->post('token');
        $this->data['token'] = $token;
        $this->load->view('page/'.$this->data['department'].'/master/sma_table',$this->data);
    }

    public function config_set_email()
    {
            $getEmailConfig = $this->m_sendemail->loadEmailConfig();
            $this->data['email'] = $getEmailConfig;
            $content = $this->load->view('page/'.$this->data['department'].'/master/set_email',$this->data,true);
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
        $text = $input['text'];
        $save_email = $this->m_sendemail->save_email($smtp_host,$smtp_port,$email,$pwd,$text);
        return print_r(json_encode($save_email));
    }

    public function total_account()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/total_account',$this->data,true);
        $this->temp($content);
    }

    public function load_table_total_account()
    {
        $this->data['getColoumn'] = $this->m_master->getColumnTable('db_admission.count_account');
        $this->data['getData'] = $this->m_master->showData('db_admission.count_account');
        echo $this->load->view('page/'.$this->data['department'].'/master/table_total_account',$this->data,true);
        
    }

    public function modalform($table)
    {
        $input = $this->getInputToken();
        $this->data['action'] = $input['Action'];
        $this->data['id'] = $input['CDID'];
        $this->data['getColoumn'] = $this->m_master->getColumnTable('db_admission.'.$table);
        $this->data['getData'] = null;
        if ($this->data['id'] != '') {
            $this->data['getData'] = $this->m_master->caribasedprimary('db_admission.'.$table,'ID',$this->data['id']);
        }
        echo $this->load->view('page/'.$this->data['department'].'/master/modalform',$this->data,true);
    }

    public function submit_count_account()
    {
        $input = $this->getInputToken();

        switch ($input['Action']) {
            case 'add':
                $this->m_master->inserData_count_account($input['CountAccount']);
                break;
            case 'edit':
                $this->m_master->editData_count_account($input['CountAccount'],$input['CDID']);
                break;
            case 'delete':
                $this->m_master->delete_count_account($input['CDID']);
                break;        
            case 'getactive':
                $this->m_master->getActive_count_account($input['CDID'],$input['Active']);
                break;    
            default:
                # code...
                break;
        }
    }

}
