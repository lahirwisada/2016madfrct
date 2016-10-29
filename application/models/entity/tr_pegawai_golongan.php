<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Tr_pegawai_golongan extends LWS_model {

    public function __construct() {
        parent::__construct("tr_pegawai_golongan");
        $this->primary_key = "id_pegawai_golongan";
    }

    protected $attribute_labels = array(
        "id_pegawai_golongan" => array("id_pegawai_golongan", "Id Pegawai Golongan"),
        "id_golongan" => array("id_golongan", "Id Golongan"),
        "id_pegawai" => array("id_pegawai", "Id Pegawai"),
        "tgl_ditetapkan" => array("tgl_ditetapkan", "Tgl Ditetapkan"), // Mencatat tanggal pertama kali ditetapkan
        "tgl_berakhir" => array("tgl_berakhir", "Tgl Berakhir"), // Mencatat Tanggal berakhirnya pegawai pada golongan ini
        "is_active" => array("is_active", "Golongan Saat ini"), // Menandakan bahwa golongan ini adalah golongan saat ini
        "created_date" => array("created_date", ""),
        "created_by" => array("created_by", ""),
        "modified_date" => array("modified_date", ""),
        "modified_by" => array("modified_by", ""),
        "record_active" => array("record_active", ""),
    );
    protected $rules = array(
        array("id_pegawai_golongan", ""),
        array("id_golongan", ""),
        array("id_pegawai", ""),
        array("tgl_ditetapkan", ""), // Mencatat tanggal pertama kali ditetapkan
        array("tgl_berakhir", ""), // Mencatat Tanggal berakhirnya pegawai pada golongan ini
        array("is_active", ""), // Menandakan bahwa golongan ini adalah golongan saat ini
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
                "tgl_lahir",
                "tempat_lahir",
                "nip",
                "no_kep",
                "tmt_peg",
                "foto_profil",
            ),
            "referenced" => "inner"
        ),
        "ref_golongan" => array(
            "fkey" => "id_golongan",
            "table_alias" => "trgol",
            "columns" => array(
                "kode_golongan",
                "golongan",
                array("keterangan", "keterangan_golongan"),
            ),
            "referenced" => "LEFT"
        ),
    );

}

?>