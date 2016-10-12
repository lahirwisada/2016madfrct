<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Ref_status_perkawinan extends LWS_model {

    public function __construct() {
        parent::__construct("ref_status_perkawinan");
        $this->primary_key = "id_status_perkawinan";
    }

    protected $attribute_labels = array(
        "id_status_perkawinan" => array("id_status_perkawinan", "Id Status Perkawinan"),
        "status_perkawinan" => array("status_perkawinan", "Status Perkawinan"),
        "kode_status_perkawinan" => array("kode_status_perkawinan", "Kode"),
        "keyword" => array("keyword", "Kata Kunci"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_status_perkawinan", ""),
        array("status_perkawinan", ""),
        array("kode_status_perkawinan", ""),
        array("keyword", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );
    protected $related_tables = array();
    protected $attribute_types = array();

}

?>