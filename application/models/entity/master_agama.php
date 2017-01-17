<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Master_agama extends LWS_model {

    public function __construct() {
        parent::__construct("master_agama");
        $this->primary_key = "id_agama";
        
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_agama" => array("id_agama", "Id Agama"),
        "nama_agama" => array("nama_agama", "Nama Agama"),
//        "created_date" => array("created_date", "created_date"),
//        "created_by" => array("created_by", "created_by"),
//        "modified_date" => array("modified_date", "modified_date"),
//        "modified_by" => array("modified_by", "modified_by"),
//        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_agama", ""),
        array("nama_agama", ""),
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