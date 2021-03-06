<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . "controllers\back_end\mslaporan.php";

class Lppiramida extends Mslaporan {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_piramida', 'Piramida Kekuatan');
        $this->load->model('model_laporan');
    }

    public function index() {
        $this->get_attention_message_from_session();

        $response = $this->get_bulan_tahun();
        extract($response);

        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
        $dalam_pangkat = $this->model_laporan->get_by_kelompok_for_graph(1, $bulan, $tahun);
        $dalam_tingkat = $this->model_laporan->get_by_tingkat_for_graph(1, $bulan, $tahun);
        $dalam_golongan = $this->model_laporan->get_by_golongan_for_graph(1, $bulan, $tahun);
        $records['dalam_pangkat'] = json_encode($dalam_pangkat);
        $records['dalam_tingkat'] = json_encode($dalam_tingkat);
        $records['dalam_golongan'] = json_encode($dalam_golongan);
        $records['max_dalam'] = $this->_total_max($dalam_pangkat);

        $luar_pangkat = $this->model_laporan->get_by_kelompok_for_graph(2, $bulan, $tahun);
        $luar_tingkat = $this->model_laporan->get_by_tingkat_for_graph(2, $bulan, $tahun);
        $luar_golongan = $this->model_laporan->get_by_golongan_for_graph(2, $bulan, $tahun);
        $records['luar_pangkat'] = json_encode($luar_pangkat);
        $records['luar_tingkat'] = json_encode($luar_tingkat);
        $records['luar_golongan'] = json_encode($luar_golongan);
        $records['max_luar'] = $this->_total_max($luar_pangkat);

        $gabungan_pangkat = $this->model_laporan->get_by_kelompok_for_graph(0, $bulan, $tahun);
        $gabungan_tingkat = $this->model_laporan->get_by_tingkat_for_graph(0, $bulan, $tahun);
        $gabungan_golongan = $this->model_laporan->get_by_golongan_for_graph(0, $bulan, $tahun);
        $records['gabungan_pangkat'] = json_encode($gabungan_pangkat);
        $records['gabungan_tingkat'] = json_encode($gabungan_tingkat);
        $records['gabungan_golongan'] = json_encode($gabungan_golongan);
        $records['max_gabungan'] = $this->_total_max($gabungan_pangkat);

        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
        $this->add_jsfiles(array("mabeschart.js"));
        $this->set("additional_js", "back_end/" . $this->_name . "/js/index_js");
    }

    private function _total_max($data = array()) {
        $result = 0;
        foreach ($data as $record) {
            $nilai = max($record);
            if ($nilai > $result) {
                $result = $nilai;
            }
        }
        return $result;
    }

}
