<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Master_corps extends LWS_model {

    public function __construct() {
        parent::__construct("master_corps");
        $this->primary_key = "id_corps";
        $this->sort_by = "kode_corps";
        $this->sort_mode = "asc";
        
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_corps" => array("id_corps", "Id Modul"),
        "kode_corps" => array("kode_corps", "kode_modul"),
        "init_corps" => array("init_corps", "init_modul"),
        "ur_corps" => array("ur_corps", "ur_modul"),
//        "created_date" => array("created_date", "created_date"),
//        "created_by" => array("created_by", "created_by"),
//        "modified_date" => array("modified_date", "modified_date"),
//        "modified_by" => array("modified_by", "modified_by"),
//        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_corps", ""),
        array("kode_corps", ""),
        array("init_corps", ""),
        array("ur_corps", ""),
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