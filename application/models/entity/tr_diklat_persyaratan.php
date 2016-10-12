<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Tr_diklat_persyaratan extends LWS_model {

    public function __construct() {
        parent::__construct("tr_diklat_persyaratan");
        $this->primary_key = "id_diklat_persyaratan";
    }

    protected $attribute_labels = array(
        "id_diklat_persyaratan" => array("id_diklat_persyaratan", "Id Diklat Persyaratan"),
        "level" => array("level", "Level"),
        "uraian" => array("uraian", "Uraian"),
        "id_diklat" => array("id_diklat", "Id Diklat"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_diklat_persyaratan", ""),
        array("level", ""),
        array("uraian", ""),
        array("id_diklat", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );
    protected $related_tables = array();
    protected $attribute_types = array();

}