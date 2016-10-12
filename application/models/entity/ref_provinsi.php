<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Ref_provinsi extends LWS_model {

    public function __construct() {
        parent::__construct("ref_provinsi");
        $this->primary_key = "id_provinsi";
    }

    protected $attribute_labels = array(
        "id_provinsi" => array("id_provinsi", "Id Povinsi"),
        "kode_provinsi" => array("kode_provinsi", "Kode"),
        "nama_provinsi" => array("nama_provinsi", "Nama Provinsi"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active"),
    );
    
    protected $rules = array(
        array("id_provinsi", ""),
        array("kode_provinsi", ""),
        array("nama_provinsi", ""),
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