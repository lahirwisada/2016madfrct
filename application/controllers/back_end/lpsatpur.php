<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH."controllers/back_end/mslaporan.php";

class Lpsatpur extends Mslaporan {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_satpur', 'Rekapitulasi SATPUR, SATBANPUR dan SATPASSUS');
        $this->load->model('model_laporan');
    }

    public function index($bulan=1, $tahun = 2014) {
        $this->get_attention_message_from_session();
        
        $response = $this->get_bulan_tahun();
        extract($response);
        
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
        $tingkat = 5;
        $records = $this->model_laporan->get_tempur_by_kotama_and_golongan($bulan, $tahun);
//        var_dump($records);
//        exit();
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
    }

}
