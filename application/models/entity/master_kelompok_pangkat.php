<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Master_kelompok_pangkat extends LWS_model {

    public function __construct() {
        parent::__construct("master_kelompok_pangkat");
        $this->primary_key = "id_kelompok";

        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_kelompok" => array("id_kelompok", "ID Kelompok"),
        "kode_kelompok" => array("kode_kelompok", "Kode Kelompok"),
        "ur_kelompok" => array("ur_kelompok", "Uraian Kelompok"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active")
    );
    protected $rules = array(
        array("id_kelompok", ""),
        array("kode_kelompok", ""),
        array("ur_kelompok", ""),
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