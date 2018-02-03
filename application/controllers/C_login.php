
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

    private function setSession($ID,$NIP){

        $dataSession = $this->m_auth->__getUserAuth($ID,$NIP);
        $timePerCredits = $this->m_auth->__getTimePerCredits();

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
            'loggedIn' => true
        );

        $this->session->set_userdata($setSession);

    }

    public function gen_pass(){
        $username = '2017090';
        $password = $username.'nandang123';
        $pas = md5($password);
        $pass = sha1('jksdhf832746aiH{}{()&(*&(*'.$pas.'HdfevgyDDw{}{}{;;*766&*&*');

        print_r($pass);
    }


}
