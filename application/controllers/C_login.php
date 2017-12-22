
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Nandang
 * Date: 12/20/2017
 * Time: 1:41 PM
 */


class C_login extends MY_Controller {



    public function temp($content)
    {

        parent::blank_temp($content);
    }

    public function index()
    {
        $content = $this->load->view('auth/login','',true);
        $this->temp($content);
    }


}
