<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_f125t_detail.php";

class model_tr_125t_detail extends tr_f125t_detail {

    public function __construct() {
        parent::__construct();
    }

    protected $rules = array(
        array("id_f125t_detail", ""),
        array("id_f125t", ""),
        array("id_pangkat", ""),
        array("jumlah_secata", ""),
        array("jumlah_secaba", ""),
        array("jumlah_sesarcab", ""),
        array("jumlah_selapa_setingkat", ""),
        array("jumlah_sesko_angkatan_setingkat", ""),
        array("jumlah_sesko_tni", ""),
        array("jumlah_subtotal", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );
    
    public function save_records($response_data){
        /**
         * 
        $response_data_125t = array(
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
