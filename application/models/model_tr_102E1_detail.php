<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_f126t_detail.php";

class model_tr_102E1_detail extends tr_f126t_detail {

    public function __construct() {
        parent::__construct();
    }

    protected $rules = array(
        array("id_f102E1_detail", ""),
        array("id_f102E1", ""),
        array("id_pangkat", ""),
        array("jumlah_top", ""),
        array("jumlah_myj", ""),
        array("jumlah_brj", ""),
        array("jumlah_kol", ""),
        array("jumlah_ltk", ""),
        array("jumlah_myr", ""),
        array("jumlah_kpt", ""),
        array("jumlah_ltt", ""),
        array("jumlah_ltd", ""),
        array("jumlah_pltu", ""),
        array("jumlah_pltd", ""),
        array("jumlah_srm", ""),
        array("jumlah_srk", ""),
        array("jumlah_srt", ""),
        array("jumlah_srd", ""),
        array("jumlah_kpk", ""),
        array("jumlah_kpu", ""),
        array("jumlah_kpd", ""),
        array("jumlah_prk", ""),
        array("jumlah_prt", ""),
        array("jumlah_prd", ""),
        array("jumlah_subtotal", ""),
        array("jumlah_pns", ""),
        array("jumlah_ksong", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );
    
    public function save_records($response_data){
        /**
         * 
        $response_data_102E1 = array(
            "form_format" => TRUE,
            "read_data" => TRUE,
            "data" => array()
        );
        */
        
        if($response_data["form_format"] && $response_data["read_data"]){
            var_dump($response_data["data"]);
        }
        
    }

}
