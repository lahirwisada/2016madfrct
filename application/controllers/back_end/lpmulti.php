<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH."controllers/back_end/mslaporan.php";

class Lpmulti extends Mslaporan {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_multi', 'Kekuatan Multikorps');
        $this->load->model('model_laporan');
//        $this->load->model(array('model_laporan', 'model_master_kotama', 'model_master_satminkal', 'model_master_pangkat'));
    }

    public function index() {
        $this->get_attention_message_from_session();
        
        $response = $this->get_bulan_tahun();
        extract($response);
        
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
        $tingkat = 5;
        $records["kategori"] = $this->model_laporan->get_multi_by_kotama_and_golongan($bulan, $tahun);
        $records["tingkat"] = $this->model_laporan->get_multi_by_kotama_and_tingkat($tingkat, $bulan, $tahun);
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
//        var_dump($records);exit();
        $this->set("records", $records);
    }

}
