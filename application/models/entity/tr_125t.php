<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class tr_125t extends LWS_Model {

    public function __construct() {
        parent::__construct("tr_125t");
        $this->primary_key = "id_f125t";
        
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_f125t" => array("id_f125t", "id_f125t"),
        "id_bulan" => array("id_bulan", "Bulan"),
        "id_tahun" => array("id_tahun", "Tahun"),
        "id_kotama" => array("id_kotama", "Kotama"),
        "path_excel" => array("path_excel", "Patch Excel"),
        "tanggal_upload" => array("tanggal_upload", "Tanggal Upload"),
        "tanggal_ttd" => array("tanggal_ttd", "Tanggal TTD"),
        "uraian_atas_ttd" => array("uraian_atas_ttd", "Uraian TTD"),
        "jabatan_ttd" => array("jabatan_ttd", "Jabatan TTD"),
        "nama_ttd" => array("nama_ttd", "Nama TTD"),
        "pangkat_ttd" => array("pangkat_ttd", "Pangkat TTD"),
        "nrp_ttd" => array("nrp_ttd", "NRP TTD"),
        "id_kabupaten_kota" => array("id_kabupaten_kota", "Kabupaten/Kota"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_f125t", ""),
        array("id_bulan", ""),
        array("id_tahun", ""),
        array("id_kotama", ""),
        array("path_excel", ""),
        array("tanggal_upload", ""),
        array("tanggal_ttd", ""),
        array("uraian_atas_ttd", ""),
        array("jabatan_ttd", ""),
        array("nama_ttd", ""),
        array("pangkat_ttd", ""),
        array("nrp_ttd", ""),
        array("id_kabupaten_kota", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );
    protected $related_tables = array(
        "master_kotama" => array(
            "fkey" => "id_kotama",
            "columns" => array(
                "kode_kotama",
                "ur_kotama",
            ),
            "referenced" => "LEFT"
        ),
        "master_bulan" => array(
            "fkey" => "id_bulan",
            "columns" => array(
                "nama_bulan",
                "kode_bulan",
           ),
            "referenced" => "LEFT"
        ),
    );
    protected $attribute_types = array(
        "tanggal_upload" => "DATE",
        "tanggal_ttd" => "DATE",
    );

}
