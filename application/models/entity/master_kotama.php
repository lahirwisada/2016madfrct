<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Master_kotama extends LWS_model {

    public function __construct() {
        parent::__construct("master_kotama");
        $this->primary_key = "id_kotama";
        $this->sort_by = "kode_kotama";
        $this->sort_mode = "asc";
        
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_kotama" => array("id_kotama", "ID Kotama"),
        "kode_kotama" => array("kode_kotama", "Kode Kotama"),
        "nama_kotama" => array("nama_kotama", "Nama Kotama"),
        "ur_kotama" => array("ur_kotama", "Uraian Kotama"),
        "struktur_kotama" => array("struktur_kotama", "Struktur Kotama"),
//        "created_date" => array("created_date", "created_date"),
//        "created_by" => array("created_by", "created_by"),
//        "modified_date" => array("modified_date", "modified_date"),
//        "modified_by" => array("modified_by", "modified_by"),
//        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_kotama", ""),
        array("kode_kotama", ""),
        array("nama_kotama", ""),
        array("ur_kotama", ""),
        array("struktur_kotama", ""),
//        array("created_date", ""),
//        array("created_by", ""),
//        array("modified_date", ""),
//        array("modified_by", ""),
//        array("record_active", ""),
    );
    protected $related_tables = array();
    protected $attribute_types = array();

}

?>