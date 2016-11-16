<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Master_triwulan extends LWS_model {

    public function __construct() {
        parent::__construct("master_triwulan");
        $this->primary_key = "id_triwulan";
        
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_triwulan" => array("id_triwulan", "Id Modul"),
        "kode_triwulan" => array("kode_triwulan", "kode_triwulan"),
        "nama_triwulan" => array("nama_triwulan", "nama_triwulan"),
    );
    protected $rules = array(
        array("id_triwulan", ""),
        array("kode_triwulan", ""),
        array("nama_triwulan", ""),
    );
    protected $related_tables = array();
    protected $attribute_types = array();

}

?>