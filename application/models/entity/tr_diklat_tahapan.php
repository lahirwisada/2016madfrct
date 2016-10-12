<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Tr_diklat_tahapan extends LWS_model {

    public function __construct() {
        parent::__construct("tr_diklat_tahapan");
        $this->primary_key = "id_diklat_tahapan";
    }

    protected $attribute_labels = array(
        "id_diklat_tahapan" => array("id_diklat_tahapan", "Id Diklat Tahapan"),
        "tahapan" => array("tahapan", "Tahapan"),
        "tgl_mulai_tahapan" => array("tgl_mulai_tahapan", "Tgl Mulai Tahapan"),
        "tgl_selesai_tahapan" => array("tgl_selesai_tahapan", "Tgl Selesai Tahapan"),
        "keterangan_tahapan" => array("keterangan_tahapan", "Keterangan"),
        "id_diklat" => array("id_diklat", "Id Diklat"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_diklat_tahapan", ""),
        array("tahapan", ""),
        array("tgl_mulai_tahapan", ""),
        array("tgl_selesai_tahapan", ""),
        array("keterangan_tahapan", ""),
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

?>