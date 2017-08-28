<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lpstruktur extends Back_end {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_struktur', 'Kekuatan Dalam Dan Luar Struktur');
        $this->load->model('model_laporan');
//        $this->load->model(array('model_laporan', 'model_master_kotama', 'model_master_satminkal', 'model_master_pangkat'));
    }

    public function index($bulan=1, $tahun = 2014) {
        $this->get_attention_message_from_session();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
        $tingkat = 5;
//        $bulan = 11;
//        $tahun = 2014;
        $records['rekap'] = $this->model_laporan->get_by_rekap_structure($bulan, $tahun);
        $records['dalam'] = $this->model_laporan->get_by_in_structure($bulan, $tahun);
        $records['luar'] = $this->model_laporan->get_by_out_structure($bulan, $tahun);
//        var_dump($records);exit();
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
    }

    public function detail($id_rekap = FALSE) {
//        $records = $this->model_tr_pasukan_detail->get_by_structure($id_rekap);
//        $this->set('records', $records);
    }

}
