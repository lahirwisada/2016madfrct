<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lp125t extends Back_end {

    public $model = 'model_tr_formulir';

    public function __construct() {
        parent::__construct('modul_laporan', 'Laporan 125 T');
        $this->load->model('model_tr_125t_detail');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
        $this->add_cssfiles(array("plugins/select2/select2.min.css"));
        $this->add_jsfiles(array("plugins/select2/select2.full.min.js"));
    }

    public function detail($id_formulir = FALSE) {
        $records = $this->model_tr_125t_detail->get_data($id_formulir);
        $this->set('records', $records);
    }

}
