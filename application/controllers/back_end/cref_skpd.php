<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cref_skpd extends Back_end {

    public $model = 'model_ref_skpd';

    public function __construct() {
        parent::__construct('kelola_pustaka_skpd', 'Pustaka Data SKPD');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = FALSE) {
        parent::detail($id, array(
            "nama_skpd",
            "col_order",
            "abbr_skpd",
            "alamat_skpd",
            "kodepos",
            "no_telp",
            "email",
            "website",
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