<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cref_tingkat_pendidikan extends Back_end {
    
    public $model = 'model_ref_tingkat_pendidikan';

    public function __construct() {
        parent::__construct('kelola_pustaka_tingkat_pendidikan', 'Pustaka Data Tingkat Pendidikan');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = FALSE) {
        parent::detail($id, array("kode_tingkat_pendidikan", "tingkat_pendidikan"));
        
        $this->set("bread_crumb", array(
            "back_end/".$this->_name => $this->_header_title,
            "#" => 'Pendaftaran '.$this->_header_title
        ));
//        $this->add_jsfiles(array("avant/plugins/form-jasnyupload/fileinput.min.js"));
    }

}

?>