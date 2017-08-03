<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lppiramida extends Back_end {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_piramida', 'Piramida Kekuatan');
        $this->load->model('model_laporan');
    }

    public function index($bulan = 1, $tahun = 2014) {
        parent::index();
        $this->get_attention_message_from_session();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
//        $bulan = 11;
//        $tahun = 2014;
        $records['dalam_pangkat'] = json_encode($this->model_laporan->get_by_kelompok_for_graph(1, $bulan, $tahun));
        $records['dalam_tingkat'] = json_encode($this->model_laporan->get_by_tingkat_for_graph(1, $bulan, $tahun));
        $records['dalam_golongan'] = json_encode($this->model_laporan->get_by_golongan_for_graph(1, $bulan, $tahun));
        $records['luar_pangkat'] = json_encode($this->model_laporan->get_by_kelompok_for_graph(2, $bulan, $tahun));
        $records['luar_tingkat'] = json_encode($this->model_laporan->get_by_tingkat_for_graph(2, $bulan, $tahun));
        $records['luar_golongan'] = json_encode($this->model_laporan->get_by_golongan_for_graph(2, $bulan, $tahun));
        $records['gabungan_pangkat'] = json_encode($this->model_laporan->get_by_kelompok_for_graph(0, $bulan, $tahun));
        $records['gabungan_tingkat'] = json_encode($this->model_laporan->get_by_tingkat_for_graph(0, $bulan, $tahun));
        $records['gabungan_golongan'] = json_encode($this->model_laporan->get_by_golongan_for_graph(0, $bulan, $tahun));
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
        $this->add_jsfiles(array("mabeschart.js"));
    }

    public function detail($id_rekap = FALSE) {
//        $records = $this->model_tr_pasukan_detail->get_by_structure($id_rekap);
//        $this->set('records', $records);
    }

}
