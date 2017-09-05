<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH."controllers/back_end/mslaporan.php";

class Lpstruktur extends Mslaporan {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_struktur', 'Kekuatan Dalam Dan Luar Struktur');
        $this->load->model('model_laporan');
//        $this->load->model(array('model_laporan', 'model_master_kotama', 'model_master_satminkal', 'model_master_pangkat'));
    }

    public function index() {
        $this->get_attention_message_from_session();

        $response = $this->get_bulan_tahun();
        extract($response);

//        $tingkat = 5;
        $records['rekap'] = $this->model_laporan->get_by_rekap_structure($bulan, $tahun);
        $records['dalam'] = $this->model_laporan->get_by_in_structure($bulan, $tahun);
        $records['luar'] = $this->model_laporan->get_by_out_structure($bulan, $tahun);
//        var_dump($records);exit();
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

}
