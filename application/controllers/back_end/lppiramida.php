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
        $dalam_pangkat = $this->model_laporan->get_by_kelompok_for_graph(1, $bulan, $tahun);
        $dalam_tingkat = $this->model_laporan->get_by_tingkat_for_graph(1, $bulan, $tahun);
        $dalam_golongan = $this->model_laporan->get_by_golongan_for_graph(1, $bulan, $tahun);
        $max_dalam = max(max($dalam_pangkat));

        $records['dalam_pangkat'] = json_encode($dalam_pangkat);
        $records['dalam_tingkat'] = json_encode($dalam_tingkat);
        $records['dalam_golongan'] = json_encode($dalam_golongan);
        $records['max_dalam'] = $max_dalam;
        
        $luar_pangkat = $this->model_laporan->get_by_kelompok_for_graph(2, $bulan, $tahun);
        $luar_tingkat = $this->model_laporan->get_by_tingkat_for_graph(2, $bulan, $tahun);
        $luar_golongan = $this->model_laporan->get_by_golongan_for_graph(2, $bulan, $tahun);
        $max_luar = max(max($luar_pangkat));

        $records['luar_pangkat'] = json_encode($luar_pangkat);
        $records['luar_tingkat'] = json_encode($luar_tingkat);
        $records['luar_golongan'] = json_encode($luar_golongan);
        $records['max_luar'] = $max_luar;

        $gabungan_pangkat = $this->model_laporan->get_by_kelompok_for_graph(0, $bulan, $tahun);
        $gabungan_tingkat = $this->model_laporan->get_by_tingkat_for_graph(0, $bulan, $tahun);
        $gabungan_golongan = $this->model_laporan->get_by_golongan_for_graph(0, $bulan, $tahun);
        $max_gabungan = max(max($gabungan_pangkat));

        $records['gabungan_pangkat'] = json_encode($gabungan_pangkat);
        $records['gabungan_tingkat'] = json_encode($gabungan_tingkat);
        $records['gabungan_golongan'] = json_encode($gabungan_golongan);
        $records['max_gabungan'] = $max_gabungan;

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
