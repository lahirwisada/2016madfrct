<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lpsatbalak extends Back_end {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan', 'Rekapitulasi Dalam Dan Luar Struktur');
        $this->load->model('model_laporan');
    }

    public function index() {
        $this->get_attention_message_from_session();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
        $records = $this->model_laporan->get_by_in_structure();
//        var_dump($records);exit();
        $this->set("records", $records);
    }

    public function detail($id_rekap = FALSE) {
//        $records = $this->model_tr_pasukan_detail->get_by_structure($id_rekap);
//        $this->set('records', $records);
    }

}
