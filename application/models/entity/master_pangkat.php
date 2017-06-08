<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Master_pangkat extends LWS_model {

    public function __construct() {
        parent::__construct("master_pangkat");
        $this->primary_key = "id_pangkat";

        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_pangkat" => array("id_pangkat", "ID Pangkat"),
        "kode_pangkat" => array("kode_pangkat", "Kode Pangkat"),
        "ur_pangkat" => array("ur_pangkat", "Uraian Pangkat"),
        "id_kelompok" => array("id_kelompok", "ID Kelompok"),
        "id_golongan" => array("id_golongan", "ID Golongan"),
        "id_tingkat" => array("id_tingkat", "Tingkat Pangkat"),
//        "created_date" => array("created_date", "created_date"),
//        "created_by" => array("created_by", "created_by"),
//        "modified_date" => array("modified_date", "modified_date"),
//        "modified_by" => array("modified_by", "modified_by"),
//        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_pangkat", ""),
        array("kode_pangkat", ""),
        array("ur_pangkat", ""),
        array("id_kelompok", ""),
        array("id_golongan", ""),
        array("id_tingkat", ""),
//        array("created_date", ""),
//        array("created_by", ""),
//        array("modified_date", ""),
//        array("modified_by", ""),
//        array("record_active", ""),
    );
    protected $related_tables = array(
        "master_kelompok_pangkat" => array(
            "fkey" => "id_kelompok",
            "columns" => array(
                "ur_kelompok",
                "kode_kelompok",
            ),
            "referenced" => "LEFT"
        ),
        "master_golongan_pangkat" => array(
            "fkey" => "id_golongan",
            "columns" => array(
                "ur_golongan",
                "kode_golongan",
            ),
            "referenced" => "LEFT"
        ),
        "master_tingkat_pangkat" => array(
            "fkey" => "id_tingkat",
            "columns" => array(
                "ur_tingkat",
                "kode_tingkat",
            ),
            "referenced" => "LEFT"
        ),
    );
    protected $attribute_types = array();

}

?>