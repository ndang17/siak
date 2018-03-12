
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nandang
 * Date: 12/20/2017
 * Time: 1:41 PM
 */


class C_login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('JWT');
        $this->load->library('google');
        $this->load->model('m_auth');


    }

    public function temp($content){

        $data['include'] = $this->load->view('template/include','',true);
        $data['content'] = $content;


        $this->load->view('template/blank',$data);
    }

    public function index()
    {
        $data['loginURL'] = $this->google->loginURL();
        $content = $this->load->view('auth/login',$data,true);
        $this->temp($content);
    }

    public function authGoogle(){
        if(isset($_GET['code'])){

            try{
                //authenticate user
                $this->google->getAuthenticate();

                //get user info from google
                $gpInfo = $this->google->getUserInfo();

                //preparing data for database insertion
                $userData['oauth_provider'] = 'google';
                $userData['oauth_uid'] 		= $gpInfo['id'];
                $userData['first_name'] 	= $gpInfo['given_name'];
                $userData['last_name'] 		= $gpInfo['family_name'];
                $userData['email'] 			= $gpInfo['email'];
                $userData['gender'] 		= !empty($gpInfo['gender'])?$gpInfo['gender']:'';
                $userData['locale'] 		= !empty($gpInfo['locale'])?$gpInfo['locale']:'';
                $userData['profile_url'] 	= !empty($gpInfo['link'])?$gpInfo['link']:'';
                $userData['picture_url'] 	= !empty($gpInfo['picture'])?$gpInfo['picture']:'';


                // Cek Userdata
                $dataUser = $this->m_auth->__getUserByEmailPU($userData['email'] );

                if(count($dataUser)>0) {
                    $this->setSession($dataUser[0]['ID'],$dataUser[0]['NIP']);
                    redirect(base_url('dashboard'));
                } else {
                    redirect(base_url());
                }

            } catch (Exception $err){
                redirect(base_url());
            }


        }
    }

    public function authUserPassword(){
        $token = $this->input->post('token');
        $key = "L06M31N";
        $data_arr = (array) $this->jwt->decode($token,$key);

        if(count($data_arr)>0){

            $NIP = $data_arr['nip'];
            $Password = $this->genratePassword($NIP,$data_arr['password']);

            $dataUser = $this->m_auth->__getauthUserPassword($NIP,$Password);

            if(count($dataUser)>0){
                $this->setSession($dataUser[0]['ID'],$dataUser[0]['NIP']);
                return print_r(1);
            } else {
                return print_r(0);
            }
        } else {
            return print_r(0);
        }
    }

    private function setSession($ID,$NIP){

        $dataSession = $this->m_auth->__getUserAuth($ID,$NIP);
        $timePerCredits = $this->m_auth->__getTimePerCredits();

        $ruleUser = $this->m_auth->__getRuleUser($NIP);

        // Super Divisi -- Lihat ID Di table db_employees.division
        // 1 (Yayasan), 2 (Rectore) , 12 (IT)
        $superDivision = [1,2,12];

        $setSession = array(
            'ID'  => $dataSession[0]['ID'],
            'NIP'  => $dataSession[0]['NIP'],
            'Name'  => $dataSession[0]['Name'],
            'FullNameTitle'  => $dataSession[0]['TitleAhead'].' '.$dataSession[0]['Name'].' '.$dataSession[0]['TitleBehind'],
            'Email'  => $dataSession[0]['Email'],
            'EmailPU'  => $dataSession[0]['EmailPU'],
            'Address'  => $dataSession[0]['Address'],
            'Photo'  => $dataSession[0]['Photo'],
            'PositionMain'  => array(
                'IDDivision' => $dataSession[0]['IDDivision'],
                'Division' => $dataSession[0]['Division'],
                'IDPosition' => $dataSession[0]['IDPosition'],
                'Position' => $dataSession[0]['Position']
            ),
            'PositionOther1' => array(
                'IDDivisionOther1' => $dataSession[0]['IDDivisionOther1'],
                'DivisionOther1' => $dataSession[0]['DivisionOther1'],
                'IDPositionOther1' => $dataSession[0]['IDPositionOther1'],
                'PositionOther1' => $dataSession[0]['PositionOther1']
            ),
            'PositionOther2' => array(
                'IDDivisionOther2' => $dataSession[0]['IDDivisionOther2'],
                'DivisionOther2' => $dataSession[0]['DivisionOther2'],
                'IDPositionOther2' => $dataSession[0]['IDPositionOther2'],
                'PositionOther2' => $dataSession[0]['PositionOther2']
            ),
            'PositionOther3' => array(
                'IDDivisionOther3' => $dataSession[0]['IDDivisionOther3'],
                'DivisionOther3' => $dataSession[0]['DivisionOther3'],
                'IDPositionOther3' => $dataSession[0]['IDPositionOther3'],
                'PositionOther3' => $dataSession[0]['PositionOther3']
            ),
            'timePerCredits' => $timePerCredits['time'],
            'ruleUser' => $ruleUser,
            'menuDepartement' => (count($ruleUser)>1) ? false : true ,
            'departementNavigation' => $dataSession[0]['MenuNavigation'],
            'loggedIn' => true
        );

        $this->session->set_userdata($setSession);
    }

    private function genratePassword($NIP,$Password){

        $plan_password = $NIP.''.$Password;
        $pas = md5($plan_password);
        $pass = sha1('jksdhf832746aiH{}{()&(*&(*'.$pas.'HdfevgyDDw{}{}{;;*766&*&*');

        return $pass;
    }



    public function logMeOut(){
        $this->session->sess_destroy();
        return 1;
    }

    public function gen($NIP,$Password){
        $plan_password = $NIP.''.$Password;
        $pas = md5($plan_password);
        $pass = sha1('jksdhf832746aiH{}{()&(*&(*'.$pas.'HdfevgyDDw{}{}{;;*766&*&*');

        print_r($pass);
    }


    public function genratePassword2($NIP,$Password){

        $plan_password = $NIP.''.$Password;
        $pas = md5($plan_password);
        $pass = sha1('jksdhf832746aiH{}{()&(*&(*'.$pas.'HdfevgyDDw{}{}{;;*766&*&*');

        print_r($pass);
    }

    public function sendmail($to='it@podomorouniversity.ac.id'){
        $ci = get_instance();

        $config['protocol'] = "smtp";
        $config['smtp_host'] = "mail.smtp2go.com";
        $config['smtp_port'] = "2525";
        $config['smtp_user'] = "email.insw@gmail.com";
        $config['smtp_pass'] = "WySUCXipf0Pw";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $ci->load->library('email',$config);
//        $ci->email->initialize($config);
        $mesg = '
        <div style="margin:0;padding:10px 0;background-color:#ebebeb;font-size:14px;line-height:20px;font-family:Helvetica,sans-serif;width:100%;text-align:center">
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
                                HORE BERHASIL KIRIM EMAIL HTML
                            </div>
                            <div style="font-family:Proxima Nova Reg,Helvetica,sans-serif">
                                <div style="max-width:600px;margin:30px 0;display:block;font-size:14px;text-align:left!important">
                                    Hai Nandang Mulyadi,<br><br>

                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    <br/>
                                    <a href="https://gist.github.com/ndang17/a787a7d4ef571753b04e551af95c4903" style="text-decoration:none;color:#fff;background-color:#337ab7;border:0;line-height:2;font-weight:bold;margin-right:10px;text-align:center;display:inline-block;border-radius:3px;padding:6px 12px;font-size:14px" target="_blank">Log Me In</a>
                                    <br><br>
                                    Atau klik link di bawah ini :
                                    <br>
                                    <a href="https://gist.github.com/ndang17/a787a7d4ef571753b04e551af95c4903" target="_blank">https://gist.github.com/ndang17/a787a7d4ef571753b04e551af95c4903</a>
                                    <br><br><br>
                                    <p style="color:#EB6936;"><i>*) Jangan dibalas, e-mail ini dikirim secara otomatis</i> </p>

                                </div>

                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div style="background-color:#fff;border-top:1px solid #ddd; ">
                                    <p style="color:#b7b0b0;font-size:0.9em;padding-bottom:10px;">NANDANG MULYADI
                                    </p>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        ';


        $ci->email->from('dari@gmail.com', 'Dari');
        //------------ Kirim ke beberapa email -------
//        $list = array('mail_1@gmail.com','mail_2@yahoo.com','mail_3@email_apa_aja.com');
//        $ci->email->to($list);
        //--------------------------------------------
        $ci->email->to($to);

        $ci->email->subject('TES EMAIL CUY');
        $ci->email->message(''.$mesg);
        $ci->email->send();
    }

}
