<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mssatuan extends Back_end {

    public $model = 'model_master_satuan';

    public function __construct() {
        parent::__construct('kelola_pusataka_satuan', 'Pustaka Satuan');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = FALSE) {
        parent::detail($id, array(
            "kode_satuan",
            "nama_satuan"
        ));

        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Pendaftaran ' . $this->_header_title
        ));
//        $this->add_jsfiles(array("avant/plugins/form-jasnyupload/fileinput.min.js"));
    }
    
    public function get_like() {
        $keyword = $this->input->post("keyword");

        $provinsi_found = $this->model_ref_provinsi->get_like($keyword);
        
        $this->to_json($provinsi_found);
    }
}