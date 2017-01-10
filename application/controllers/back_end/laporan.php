<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan extends Back_end {

    public $model = 'model_tr_125t_detail';

    public function __construct() {
        parent::__construct('kelola_laporan', 'Laporan');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

//    public function get_like() {
//        $keyword = $this->input->post("keyword");
//
//        $provinsi_found = $this->model_ref_provinsi->get_like($keyword);
//        
//        $this->to_json($provinsi_found);
//    }
}