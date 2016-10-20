<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mskabupaten_kota extends Back_end {

    public $model = 'model_master_kabupaten_kota';

    public function __construct() {
        parent::__construct('kelola_pustaka_kabupaten_kota', 'Pustaka Kabupaten Kota');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = FALSE) {
        parent::detail($id, array(
            "id_provinsi","kode_kabupaten","nama_kabupaten",
        ));

        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Pendaftaran ' . $this->_header_title
        ));
//        $this->add_jsfiles(array("avant/plugins/form-jasnyupload/fileinput.min.js"));
    }
    
    public function get_like() {
        $keyword = $this->input->post("keyword");

        $provinsi_found = $this->model_ref_kabupaten_kota->get_like($keyword);
        
        $this->to_json($kabupaten_kota_found);
    }
}