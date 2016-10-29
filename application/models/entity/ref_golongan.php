<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Ref_golongan extends LWS_model {

    public function __construct() {
        parent::__construct("ref_golongan");
        $this->primary_key = "id_golongan";
    }

    protected $attribute_labels = array(
        "id_golongan"        => array("id_golongan", "Id Golongan"),
        "kode_golongan"      => array("kode_golongan", "Kode Golongan"),
        "golongan"      => array("golongan", "Golongan"),
        "keterangan" => array("keterangan", "Keterangan"),
        "created_date"    => array("created_date", "created_date"),
        "created_by"      => array("created_by", "created_by"),
        "modified_date"   => array("modified_date", "modified_date"),
        "modified_by"     => array("modified_by", "modified_by"),
        "record_active"   => array("record_active", "record_active"),
    );
    protected $rules = array(array("id_golongan", ""), array("kode_golongan", ""), array("golongan", ""), array("keterangan", ""), array("created_date", ""), array("created_by", ""), array("modified_date", ""), array("modified_by", ""), array("record_active", ""),);
    protected $related_tables = array();
    protected $attribute_types = array();

}

?>