<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lpsatkowil extends Back_end {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_satbalak', 'Rekapitulasi Satkowil/Satintel');
        $this->load->model('model_laporan');
    }

    public function index($bulan=1, $tahun = 2014) {
        $this->get_attention_message_from_session();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
        $tingkat = 5;
//        $bulan = 1;
//        $tahun = 2014;
        $records = array(
            'golongan' => $this->model_laporan->get_satkowil_by_kotama_and_golongan($bulan, $tahun),
            'detail' => $this->model_laporan->get_satkowil_by_satminkal_and_golongan($bulan, $tahun),
        );
//        var_dump($records);
//        exit();
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
    }

}
