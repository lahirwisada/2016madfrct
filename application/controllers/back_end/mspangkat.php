<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mspangkat extends Back_end {

    public $model = 'model_master_pangkat';

    public function __construct() {
        parent::__construct('kelola_pustaka_pangkat', 'Master Pangkat');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = FALSE) {
        parent::detail($id, array("kode_pangkat", "ur_pangkat", "id_kelompok", "id_golongan", "id_tingkat",));
        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Detail ' . $this->_header_title
        ));
        $this->set("additional_js", "back_end/" . $this->_name . "/js/detail_js");
        $this->add_cssfiles(array("plugins/select2/select2.min.css"));
        $this->add_jsfiles(array("plugins/select2/select2.full.min.js"));
    }

    public function get_like() {
        $keyword = $this->input->post("keyword");
        $pangkat_found = $this->model_master_pangkat->get_like($keyword);
        $this->to_json($pangkat_found);
    }

}
