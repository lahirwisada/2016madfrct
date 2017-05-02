<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mskotama extends Back_end {

    public $model = 'model_master_kotama';

    public function __construct() {
        parent::__construct('kelola_pustaka_kotama', 'Pustaka Kotama');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = FALSE) {
        parent::detail($id, array("kode_kotama", "ur_kotama", "struktur_kotama"));

        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Pendaftaran ' . $this->_header_title
        ));
//        $this->add_jsfiles(array("avant/plugins/form-jasnyupload/fileinput.min.js"));
    }

    public function get_like() {
        $keyword = $this->input->post("keyword");

        $kotama_found = $this->model_master_kotama->get_like($keyword);

        $this->to_json($kotama_found);
    }

}
