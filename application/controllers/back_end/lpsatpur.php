<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lpsatpur extends Back_end {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_satpur', 'Rekapitulasi Satpur, Satbanpur dan Satpassus');
        $this->load->model('model_laporan');
    }

    public function index() {
        $this->get_attention_message_from_session();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
        $tingkat = 5;
        $bulan = 1;
        $tahun = 2014;
        $records = $this->model_laporan->get_tempur_by_kotama_and_golongan($bulan, $tahun);
//        var_dump($records);
//        exit();
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
    }

}
