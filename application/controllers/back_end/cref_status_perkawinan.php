<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cref_status_perkawinan extends Back_end {

    public $model = 'model_ref_status_perkawinan';

    public function __construct() {
        parent::__construct('kelola_pustaka_status_perkawinan', 'Pustaka Data Status Perkawinan');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = FALSE) {
        parent::detail($id, array(
            "status_perkawinan",
            "kode_status_perkawinan",
            "keyword",
        ));

        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Pendaftaran ' . $this->_header_title
        ));
//        $this->add_jsfiles(array("avant/plugins/form-jasnyupload/fileinput.min.js"));
    }
    
    public function get_like() {
        $keyword = $this->input->post("keyword");

        $skpd_found = $this->{$this->model}->get_like($keyword);
        
        $this->to_json($skpd_found);
    }

}

?>