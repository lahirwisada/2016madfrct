<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_f126t_detail.php";

class model_tr_126t_detail extends tr_f126t_detail {

    public function __construct() {
        parent::__construct();
    }

    protected $rules = array(
        array("id_f126t_detail", ""),
        array("id_f126t", ""),
        array("id_pangkat", ""),
        array("jumlah_sd", ""),
        array("jumlah_sltp", ""),
        array("jumlah_slta", ""),
        array("jumlah_d1", ""),
        array("jumlah_d2", ""),
        array("jumlah_d3", ""),
        array("jumlah_d4", ""),
        array("jumlah_s1", ""),
        array("jumlah_s2", ""),
        array("jumlah_s3", ""),
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
        $response_data_126t = array(
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
