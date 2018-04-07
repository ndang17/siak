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
        $to = $this->m_sendemail->getToEmail('Testing');
        //$to = "alhadi.rahman@podomorouniversity.ac.id";
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
        echo $this->load->view('page/'.$this->data['department'].'/master/table_master_global',$this->data,true);
        
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

    public function email_to()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/email_to',$this->data,true);
        $this->temp($content);
    }

    public function load_table_email_to()
    {
        $this->data['getColoumn'] = $this->m_master->getColumnTable('db_admission.email_to');
        $this->data['getData'] = $this->m_master->showData('db_admission.email_to');
        echo $this->load->view('page/'.$this->data['department'].'/master/table_master_global',$this->data,true);
    }

    public function submit_email_to()
    {
        $input = $this->getInputToken();

        switch ($input['Action']) {
            case 'add':
                $this->m_master->inserData_email_to($input['EmailTo'],$input['fungsi']);
                break;
            case 'edit':
                $this->m_master->editData_email_to($input['EmailTo'],$input['fungsi'],$input['CDID']);
                break;
            case 'delete':
                $this->m_master->delete_email_to($input['CDID']);
                break;        
            case 'getactive':
                $this->m_master->getActive_email_to($input['CDID'],$input['Active']);
                break;    
            default:
                # code...
                break;
        }
    }

    public function lama_pembayaran()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/lama_pembayaran',$this->data,true);
        $this->temp($content);
    }

    public function load_table_master($table)
    {
        $this->data['getColoumn'] = $this->m_master->getColumnTable('db_admission.'.$table);
        $this->data['getData'] = $this->m_master->showData('db_admission.'.$table);
        echo $this->load->view('page/'.$this->data['department'].'/master/table_master_global',$this->data,true);
    }

    public function submit_lama_pembayaran()
    {
        $input = $this->getInputToken();

        switch ($input['Action']) {
            case 'add':
                $this->m_master->inserData_lama_pembayaran($input['Longtime']);
                break;
            case 'edit':
                $this->m_master->editData_lama_pembayaran($input['Longtime'],$input['CDID']);
                break;
            case 'delete':
                $this->m_master->delete_id_table($input['CDID'],'deadline_register');
                break;        
            case 'getactive':
                $this->m_master->getActive_id_active_table($input['CDID'],$input['Active'],'deadline_register');
                break;    
            default:
                # code...
                break;
        }
    }

    public function harga_formulir_online()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/harga_formulir',$this->data,true);
        $this->temp($content);
    }

    public function submit_harga_formulir_online()
    {
        $input = $this->getInputToken();

        switch ($input['Action']) {
            case 'add':
                $this->m_master->inserData_harga_formulir($input['PriceFormulir']);
                break;
            case 'edit':
                $this->m_master->editData_harga_formulir($input['PriceFormulir'],$input['CDID']);
                break;
            case 'delete':
                $this->m_master->delete_id_table($input['CDID'],'price_formulir');
                break;        
            case 'getactive':
                $this->m_master->getActive_id_active_table($input['CDID'],$input['Active'],'price_formulir');
                break;    
            default:
                # code...
                break;
        }
    }

    public function harga_formulir_offline()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/harga_formulir_offline',$this->data,true);
        $this->temp($content);
    }

    public function submit_harga_formulir_offline()
    {
        $input = $this->getInputToken();

        switch ($input['Action']) {
            case 'add':
                $this->m_master->inserData_harga_formulir_offline($input['PriceFormulir']);
                break;
            case 'edit':
                $this->m_master->editData_harga_formulir_offline($input['PriceFormulir'],$input['CDID']);
                break;
            case 'delete':
                $this->m_master->delete_id_table($input['CDID'],'price_formulir_offline');
                break;        
            case 'getactive':
                $this->m_master->getActive_id_active_table($input['CDID'],$input['Active'],'price_formulir_offline');
                break;    
            default:
                # code...
                break;
        }
    }

    public function global_wilayah()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/global_wilayah',$this->data,true);
        $this->temp($content);
    }

    public function loadTableMasterNoAction($table)
    {
        $this->data['getColoumn'] = $this->m_master->getColumnTable('db_admission.'.$table);
        $this->data['getData'] = $this->m_master->showData('db_admission.'.$table);
        echo $this->load->view('page/'.$this->data['department'].'/master/table_master_global_no_action',$this->data,true);
    }

    public function jenis_tempat_tinggal()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/jenis_tempat_tinggal',$this->data,true);
        $this->temp($content);
    }

    public function submit_jenis_tempat_tinggal()
    {
        $input = $this->getInputToken();

        switch ($input['Action']) {
            case 'add':
                $this->m_master->inserData_jenis_tempat_tinggal($input['JenisTempatTinggal']);
                break;
            case 'edit':
                $this->m_master->editData_jenis_tempat_tinggal($input['JenisTempatTinggal'],$input['CDID']);
                break;
            case 'delete':
                $this->m_master->delete_id_table($input['CDID'],'register_jtinggal_m');
                break;        
            case 'getactive':
                $this->m_master->getActive_id_activeAll_table($input['CDID'],$input['Active'],'register_jtinggal_m');
                break;    
            default:
                # code...
                break;
        }
    }

    public function pendapatan()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/pendapatan',$this->data,true);
        $this->temp($content);
    }

    public function submit_pendapatan()
    {
        $input = $this->getInputToken();

        switch ($input['Action']) {
            case 'add':
                $this->m_master->inserData_pendapatan($input['Income']);
                break;
            case 'edit':
                $this->m_master->editData_pendapatan($input['Income'],$input['CDID']);
                break;
            case 'delete':
                $this->m_master->delete_id_table($input['CDID'],'register_income_m');
                break;        
            case 'getactive':
                $this->m_master->getActive_id_activeAll_table($input['CDID'],$input['Active'],'register_income_m');
                break;    
            default:
                # code...
                break;
        }
    }

    public function agama()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/agama',$this->data,true);
        $this->temp($content);
    }

    public function load_table_master_agama()
    {
        $this->data['getColoumn'] = $this->m_master->getColumnTable('siak4.agama');
        $this->data['getData'] = $this->m_master->showData('siak4.agama');
        echo $this->load->view('page/'.$this->data['department'].'/master/table_master_global_no_action',$this->data,true);
    }

    public function tipe_sekolah()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/tipe_sekolah',$this->data,true);
        $this->temp($content);
    }

    public function load_table_tipe_sekolah()
    {
        $this->data['getColoumn'] = $this->m_master->getColumnTable('db_admission.school_type');
        $this->data['getData'] = $this->m_master->showData('db_admission.school_type');
        echo $this->load->view('page/'.$this->data['department'].'/master/table_master_tipe_sekolah',$this->data,true);
    }

    public function  document_checklist()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/document_checklist',$this->data,true);
        $this->temp($content);
    }

    public function submit_document_checklist()
    {
        $input = $this->getInputToken();

        switch ($input['Action']) {
            case 'add':
                $this->m_master->inserData_document_checklist($input['DocumentChecklist']);
                break;
            case 'edit':
                $this->m_master->editData_document_checklist($input['DocumentChecklist'],$input['CDID'],$input['Required']);
                break;
            case 'delete':
                $this->m_master->delete_id_table($input['CDID'],'reg_doc_checklist');
                break;        
            case 'getactive':
                $this->m_master->getActive_id_activeAll_table($input['CDID'],$input['Active'],'reg_doc_checklist');
                break;    
            default:
                # code...
                break;
        }
    }

    public function formulir_online()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/formulir_online',$this->data,true);
        $this->temp($content);
    }

    public function loadDataFormulirOnline()
    {
        $input = $this->getInputToken();
        $this->data['passSelectTahun'] = $input['selectTahun'];
        $content = $this->load->view('page/'.$this->data['department'].'/master/load_formulir_online',$this->data,true);
        echo $content;
    }

    public function get_json_formulir_online()
    {
        $input = $this->getInputToken();
        $data = $this->m_master->getDataFormulirOnline($input['selectTahun']);
        return print_r(json_encode($data));
    }

    public function generate_formulir_online()
    {
        $input = $this->getInputToken();
        $this->m_master->generate_formulir_online($input['selectTahun']);
    }

    public function formulir_offline()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/formulir_offline',$this->data,true);
        $this->temp($content);
    }

    public function loadDataFormulirOffline()
    {
        $input = $this->getInputToken();
        $this->data['passSelectTahun'] = $input['selectTahun'];
        $content = $this->load->view('page/'.$this->data['department'].'/master/load_formulir_offline',$this->data,true);
        echo $content;
    }

    public function get_json_formulir_offline()
    {
        $input = $this->getInputToken();
        $data = $this->m_master->getDataFormulirOffline($input['selectTahun']);
        return print_r(json_encode($data));
    }

    public function generate_formulir_offline()
    {
        $input = $this->getInputToken();
        $this->m_master->generate_formulir_offline($input['selectTahun']);
    }

    public function jacket_size()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/jacket_size',$this->data,true);
        $this->temp($content);
    }

    public function submit_jacket_size()
    {
        $input = $this->getInputToken();

        switch ($input['Action']) {
            case 'add':
                $this->m_master->inserData_Jacket_Size($input['JacketSize']);
                break;
            case 'edit':
                $this->m_master->editData_Jacket_Size($input['JacketSize'],$input['CDID']);
                break;
            case 'delete':
                $this->m_master->delete_id_table($input['CDID'],'register_jacket_size_m');
                break;        
            case 'getactive':
                $this->m_master->getActive_id_activeAll_table($input['CDID'],$input['Active'],'register_jacket_size_m');
                break;    
            default:
                # code...
                break;
        }
    }

    public function jurusan_sekolah()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/jurusan_sekolah',$this->data,true);
        $this->temp($content);
    }

    public function submit_jurusan_sekolah()
    {
        $input = $this->getInputToken();

        switch ($input['Action']) {
            case 'add':
                $this->m_master->inserData_jurusan_sekolah($input['SchoolMajor']);
                break;
            case 'edit':
                $this->m_master->editData_jurusan_sekolah($input['SchoolMajor'],$input['CDID']);
                break;
            case 'delete':
                $this->m_master->delete_id_table($input['CDID'],'register_major_school');
                break;        
            case 'getactive':
                $this->m_master->getActive_id_activeAll_table($input['CDID'],$input['Active'],'register_major_school');
                break;    
            default:
                # code...
                break;
        }
    }

    public function ujian_masuk_per_prody()
    {
        $content = $this->load->view('page/'.$this->data['department'].'/master/ujian_masuk_per_prody',$this->data,true);
        $this->temp($content);
    }

    public function modalform_ujian_masuk_per_prody()
    {
        $input = $this->getInputToken();
        $this->data['action'] = $input['Action'];
        $this->data['id'] = $input['CDID'];
        if ($input['Action'] == 'edit') {
            $this->data['getDataEdit'] =  $this->m_master->caribasedprimary('db_admission.ujian_perprody_m','ID',$input['CDID']);
        }
        echo $this->load->view('page/'.$this->data['department'].'/master/modalform_ujian_masuk_per_prody',$this->data,true);
    }

    public function table_ujian_masuk_per_prody()
    {
        $this->data['getColoumn'] = array('query' => array('ID','Program Study','NamaUjian','Bobot','Active','CreateAT') );
        $this->data['getData'] = $this->m_master->showDataUjianMasukPerPrody();
        echo $this->load->view('page/'.$this->data['department'].'/master/table_ujian_masuk_per_prody',$this->data,true);
    }

    public function submit_ujian_masuk_per_prody()
    {
        $input = $this->getInputToken();

        switch ($input['Action']) {
            case 'add':
                $this->m_master->inserData_ujian_masuk($input['nm_ujian'],$input['selectBobot'],$input['selectPrody']);
                break;
            case 'edit':
                $this->m_master->editData_ujian_masuk($input['nm_ujian'],$input['selectBobot'],$input['selectPrody'],$input['CDID']);
                break;
            case 'delete':
                $this->m_master->delete_id_table($input['CDID'],'ujian_perprody_m');
                break;        
            case 'getactive':
                $this->m_master->getActive_id_activeAll_table($input['CDID'],$input['Active'],'ujian_perprody_m');
                break;    
            default:
                # code...
                break;
        }        
    }

}
