<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lpsatbalak extends Back_end {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_satbalak', 'Rekapitulasi Satbalak/Lemdikrah');
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
        $records = array(
            'golongan' => $this->model_laporan->get_satbalak_by_kotama_and_golongan($bulan, $tahun),
            'detail' => $this->model_laporan->get_satbalak_by_satminkal_and_golongan($bulan, $tahun),
        );
//        var_dump($records);
//        exit();
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
    }

}
