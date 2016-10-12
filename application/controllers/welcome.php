<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends LWS_Controller {

    public function __consturct() {
        parent::__construct();
    }

    public function access_rules($_rules = array()) {
        /**
         * Basic rules
         * untuk selanjutnya lihat LWmember_Controller.php
         * 
         * akan konek ke basis data, cek : model_ref_modul_role.php->get_access_rule();
         */
        return array(
            array(
                'allow',
                'actions' => array(
                    "index",
                    "terbilang",
                    "captcha",
                    "login",
                    "logout"
                ),
                'users' => array('*')
            ),
            array(
                'allow',
                'users' => array('@')
            )
        );
    }

    public function index() {
        $this->set("header_title", "Ini Header Title");
        $this->set("nama", "Doni");
    }

    public function terbilang() {
        $this->load->library("lterbilang");
        $num1 = rand(1, 8);
        $num2 = rand(2, 6);
        $num3 = rand(2, 4);
        $operation = array(
            '+', '-'
        );
        $op1 = rand(0, 1);
        $op2 = rand(0, 1);
        $calculate = $num1 . ' ' . $operation[$op1] . ' ' . $num2 . ' ' . $operation[$op2] . ' ' . $num3;
        $num = eval('return ' . $calculate . ';');
        echo $calculate . '<br />';
        echo $this->lterbilang->convert_number_to_words($num);
        exit;
    }

    public function captcha() {
        $this->load->library("lcaptcha", array(
            'random_word' => true,
            'img_path' => APPPATH . '../_assets/img/captcha/',
//            'font_path' => APPPATH.'../_assets/font/Mom.ttf',
            'img_url' => img("captcha") . '/',
        ));
        $captcha_result = $this->lcaptcha->generate();
        var_dump($captcha_result);
        $captcha_result = $this->lcaptcha->refresh();
        var_dump($captcha_result);
        exit;
    }

}

?>