<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Ref_kabupaten_kota extends LWS_model {

    public function __construct() {
        parent::__construct("ref_kabupaten_kota");
        $this->primary_key = "id_kabupaten_kota";
    }

    protected $attribute_labels = array(
        "id_kabupaten_kota" => array("id_kabupaten_kota", "Id Tingkat Pendidikan"),
        "id_provinsi" => array("id_provinsi", "Id Povinsi"),
        "kode_kabupaten" => array("kode_kabupaten", "Kode"),
        "nama_kabupaten" => array("nama_kabupaten", "Tingkat Pendidikan"),
        "is_ibukota" => array("is_ibukota", "Tingkat Pendidikan"),
        "keterangan" => array("keterangan", "Tingkat Pendidikan"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_kabupaten_kota", ""),
        array("id_provinsi", ""),
        array("kode_kabupaten", ""),
        array("nama_kabupaten", ""),
        array("is_ibukota", ""),
        array("keterangan", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );
    protected $related_tables = array(
        "ref_provinsi" => array(
            "fkey" => "id_provinsi",
            "columns" => array(
                "nama_provinsi",
                "kode_provinsi",
            ),
            "referenced" => "LEFT"
        ),
    );
    protected $attribute_types = array();

}

?>