<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Master_tingkat_pangkat extends LWS_model {

    public function __construct() {
        parent::__construct("master_tingkat_pangkat");
        $this->primary_key = "id_tingkat";
        
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_tingkat" => array("id_tingkat", "ID Golongan"),
        "kode_tingkat" => array("kode_tingkat", "Kode Golongan"),
        "ur_tingkat" => array("ur_tingkat", "Uraian Golongan"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active")
    );
    protected $rules = array(
        array("id_tingkat", ""),
        array("kode_tingkat", ""),
        array("ur_tingkat", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", "")
    );
    protected $related_tables = array();
    protected $attribute_types = array();

}

?>