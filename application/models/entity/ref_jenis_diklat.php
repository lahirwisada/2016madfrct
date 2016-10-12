<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Ref_jenis_diklat extends LWS_model {

    public function __construct() {
        parent::__construct("ref_jenis_diklat");
        $this->primary_key = "id_jenis_diklat";
    }

    protected $attribute_labels = array(
        "id_jenis_diklat"        => array("id_jenis_diklat", "Id Jenis Diklat"),
        "jenis_diklat"      => array("jenis_diklat", "Jenis Diklat"),
        "keterangan" => array("keterangan", "Keterangan"),
        "created_date"    => array("created_date", "created_date"),
        "created_by"      => array("created_by", "created_by"),
        "modified_date"   => array("modified_date", "modified_date"),
        "modified_by"     => array("modified_by", "modified_by"),
        "record_active"   => array("record_active", "record_active"),
    );
    protected $rules = array(array("id_jenis_diklat", ""), array("jenis_diklat", ""), array("keterangan", ""), array("created_date", ""), array("created_by", ""), array("modified_date", ""), array("modified_by", ""), array("record_active", ""),);
    protected $related_tables = array();
    protected $attribute_types = array();

}

?>