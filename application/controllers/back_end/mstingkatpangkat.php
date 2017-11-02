<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mstingkatpangkat extends Back_end {

    public $model = 'model_master_tingkat_pangkat';

    public function __construct() {
        parent::__construct('kelola_pustaka_tingkat_pangkat', 'Master Tingkat Pangkat');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = FALSE) {
        parent::detail($id, array(
            "kode_tingkat", "ur_tingkat",
        ));

        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Detail ' . $this->_header_title
        ));
//        $this->add_jsfiles(array("avant/plugins/form-jasnyupload/fileinput.min.js"));
    }

    public function get_like() {
        $keyword = $this->input->post("keyword");
        $kategori_found = $this->model_master_tingkat_pangkat->get_like($keyword);
        $this->to_json($kategori_found);
    }

}
