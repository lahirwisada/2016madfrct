<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lpkotama extends Back_end {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_kotama', 'Kekuatan Kotama/Balakpus');
        $this->load->model('model_laporan');
    }

    public function index($bulan=1, $tahun = 2014) {
        $this->get_attention_message_from_session();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
        $tingkat = 5;
//        $bulan = 11;
//        $tahun = 2014;
        $records["kategori"] = $this->model_laporan->get_by_kotama_and_golongan($bulan, $tahun);
        $records["tingkat"] = $this->model_laporan->get_by_kotama_and_tingkat($tingkat, $bulan, $tahun);
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
//        var_dump($records["tingkat"]);
//        exit();
        $this->set("records", $records);
    }

    public function detail($id_rekap = FALSE) {
//        $records = $this->model_tr_pasukan_detail->get_by_structure($id_rekap);
//        $this->set('records', $records);
    }

}
