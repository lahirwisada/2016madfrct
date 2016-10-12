<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Ref_ttd extends LWS_model {

    public function __construct() {
        parent::__construct("ref_ttd");
        $this->primary_key = "id_ref_ttd";
    }

    protected $attribute_labels = array(
        "id_ref_ttd" => array("id_ref_ttd", "Id Ref TTD"),
        "id_pegawai" => array("id_pegawai", "Id Pegawai"),
        "id_skpd" => array("id_skpd", "Id SKPD"),
        "jabatan_ttd" => array("jabatan_ttd", "Jabatan Pegawai"),
        "uraian_atas_ttd" => array("uraian_atas_ttd", "Uraian Atas TTD"),
        "uraian_bawah_ttd" => array("uraian_bawah_ttd", "Uraian Bawah TTD"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_pegawai", ""),
        array("id_skpd", ""),
        array("jabatan_ttd", ""),
        array("uraian_atas_ttd", ""),
        array("uraian_bawah_ttd", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );
    protected $related_tables = array(
        "ref_pegawai" => array(
            "fkey" => "id_pegawai",
            "columns" => array(
                "gelar_depan",
                "gelar_belakang",
                "nama_depan",
                "nama_tengah",
                "nama_belakang",
                "nama_sambung",
                "nip",
            ),
            "referenced" => "LEFT"
        ),
        "ref_skpd" => array(
            "fkey" => "id_skpd",
            "columns" => array(
                "nama_skpd",
                "abbr_skpd",
                "alamat_skpd",
                "kodepos",
                "no_telp",
                "email",
                "website",
            ),
            "referenced" => "LEFT"
        ),
    );
    protected $attribute_types = array();

}

?>