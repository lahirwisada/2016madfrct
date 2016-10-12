<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends Back_end {

    protected $auto_load_model = FALSE;
    
    public function can_access() {
        return TRUE;
    }

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->set("header_title", 'Home');
//        echo "eko dipanggil";exit;
//        $this->load->model(array("model_tr_pembayaran", "model_ref_penghuni"));
//        $terbayar_perbulan = toJsonString($this->model_tr_pembayaran->get_record_terbayar_perbulan(), FALSE);
//        $pendaftar_perbulan = toJsonString($this->model_ref_penghuni->get_record_pendaftar_perbulan(), FALSE);
//        $this->set("terbayar_perbulan", $terbayar_perbulan);
//        $this->set("pendaftar_perbulan", $pendaftar_perbulan);
//        $this->set("var_bulan", $this->month());
//        $this->set("additional_js", "back_end/home/js/index_js");
//        $this->add_jsfiles(array(
//            "avant/plugins/charts-flot/jquery.flot.min.js",
//            "avant/plugins/charts-flot/jquery.flot.resize.min.js",
//        ));
    }

    private function month() {
        $month = array_month(FALSE, TRUE);

        foreach ($month as $key => $val) {
            $month[$key] = array($key, $val);
        }
        return toJsonString($month, FALSE);
    }

}

?>