<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Msbulan extends Back_end {

    public $model = 'model_master_bulan';

    public function __construct() {
        parent::__construct('kelola_pustaka_bulan', 'Pustaka Bulan');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = FALSE) {
        parent::detail($id, array(
            "kode_bulan","nama_bulan"
        ));

        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Pendaftaran ' . $this->_header_title
        ));
//        $this->add_jsfiles(array("avant/plugins/form-jasnyupload/fileinput.min.js"));
    }
    
    public function get_like() {
        $keyword = $this->input->post("keyword");

        $bulan_found = $this->model_master_bulan->get_like($keyword);
        
        $this->to_json($bulan_found);
    }
}