<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Tr_pegawai_skpd extends LWS_model {

    public function __construct() {
        parent::__construct("tr_pegawai_skpd");
        $this->primary_key = "id_pegawai_skpd";
    }

    /**
     * id_jabatan sudah tidak dipakai lagi
     * @var type 
     */
    protected $attribute_labels = array(
        "id_pegawai_skpd" => array("id_pegawai_skpd", "Id Pegawai SKPD"),
        "id_skpd" => array("id_skpd", "Id SKPD"),
//        "id_jabatan" => array("id_jabatan", "Id Jabatan"),
        "id_pegawai" => array("id_pegawai", "Id Pegawai"), 
        "tgl_mulai" => array("tgl_mulai", "Tgl Mulai"), // Mencatat Tanggal mulai pegawai pada skpd ini
        "tgl_berakhir" => array("tgl_berakhir", "Tgl Berakhir"), // Mencatat Tanggal berakhirnya pegawai pada skpd ini
        "is_active" => array("is_active", "SKPD Saat ini"), // Menandakan bahwa SKPD ini adalah golongan saat ini
        "keterangan" => array("keterangan", "Keterangan"),
        "created_date" => array("created_date", ""),
        "created_by" => array("created_by", ""),
        "modified_date" => array("modified_date", ""),
        "modified_by" => array("modified_by", ""),
        "record_active" => array("record_active", ""),
    );
    protected $rules = array(
        array("id_pegawai_skpd", ""),
        array("id_skpd ", ""),
//        array("id_jabatan", ""),
        array("id_pegawai", ""), 
        array("tgl_mulai", ""), // Mencatat Tanggal mulai pegawai pada skpd ini
        array("tgl_berakhir", ""), // Mencatat Tanggal berakhirnya pegawai pada skpd ini
        array("is_active", ""), // Menandakan bahwa SKPD ini adalah golongan saat ini
        array("keterangan", ""),
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
        "ref_skpd" => array(
            "fkey" => "id_skpd",
            "table_alias" => "refskpd",
            "columns" => array(
                "nama_skpd",
                "abbr_skpd",
                "alamat_skpd",
                "kodepos",
                "no_telp",
                "email",
                "website",
            ),
            "referenced" => "inner"
        ),
//        "ref_jabatan" => array(
//            "fkey" => "id_jabatan",
//            "table_alias" => "refjabatan",
//            "columns" => array(
//                "jabatan",
//            ),
//            "referenced" => "LEFT"
//        ),
    );

}

?>