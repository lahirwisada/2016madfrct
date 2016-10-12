<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Ref_tingkat_pendidikan extends LWS_model {

    public function __construct() {
        parent::__construct("ref_tingkat_pendidikan");
        $this->primary_key = "id_tingkat_pendidikan";
    }

    protected $attribute_labels = array(
        "id_tingkat_pendidikan"        => array("id_tingkat_pendidikan", "Id Tingkat Pendidikan"),
        "kode_tingkat_pendidikan"      => array("kode_tingkat_pendidikan", "Kode"),
        "tingkat_pendidikan" => array("tingkat_pendidikan", "Tingkat Pendidikan"),
        "created_date"    => array("created_date", "created_date"),
        "created_by"      => array("created_by", "created_by"),
        "modified_date"   => array("modified_date", "modified_date"),
        "modified_by"     => array("modified_by", "modified_by"),
        "record_active"   => array("record_active", "record_active"),
    );
    protected $rules = array(array("id_tingkat_pendidikan", ""), array("kode_tingkat_pendidikan", ""), array("tingkat_pendidikan", ""), array("created_date", ""), array("created_by", ""), array("modified_date", ""), array("modified_by", ""), array("record_active", ""),);
    protected $related_tables = array();
    protected $attribute_types = array();

}

?>