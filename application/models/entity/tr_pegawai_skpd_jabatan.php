<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Tr_pegawai_skpd_jabatan extends LWS_model {

    public function __construct() {
        parent::__construct("tr_pegawai_skpd_jabatan");
        $this->primary_key = "id_pegawai_skpd_jabatan";
    }

    protected $attribute_labels = array(
        "id_pegawai_skpd_jabatan" => array("id_pegawai_skpd_jabatan", "Id Pegawai SKPD"),
        "id_pegawai_skpd " => array("id_pegawai_skpd", "Id Pegawai SKPD"),
        "id_jabatan" => array("id_jabatan", "Id Jabatan"),
        "id_eselon" => array("id_eselon", "Id Eselon"),
        "tmt_eselon" => array("tmt_eselon", "TMT Eselon"),
        "masa_kerja_jabatan_bulan" => array("masa_kerja_jabatan_bulan", "Masa Kerja Jabatan Bulan"),
        "masa_kerja_jabatan_tahun" => array("masa_kerja_jabatan_tahun", "Masa Kerja Jabatan Tahun"),
        "is_active" => array("is_active", "SKPD Saat ini"), // Menandakan bahwa SKPD ini adalah golongan saat ini
        "created_date" => array("created_date", ""),
        "created_by" => array("created_by", ""),
        "modified_date" => array("modified_date", ""),
        "modified_by" => array("modified_by", ""),
        "record_active" => array("record_active", ""),
    );
    protected $rules = array(
        array("id_pegawai_skpd_jabatan", ""),
        array("id_pegawai_skpd ", ""),
        array("id_jabatan", ""),
        array("id_eselon", ""),
        array("tmt_eselon", ""), // Mencatat Tanggal mulai pegawai pada skpd ini
        array("is_active", ""), // Menandakan bahwa SKPD ini adalah golongan saat ini
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );
    protected $related_tables = array(
        "tr_pegawai_skpd" => array(
            "fkey" => "id_pegawai_skpd",
            "table_alias" => "refpegskpd",
            "columns" => array(
                "id_skpd",
                "id_jabatan",
                "id_pegawai",
                "tgl_mulai",
                "tgl_berakhir",
            ),
            "referenced" => "inner"
        ),
        "ref_eselon" => array(
            "fkey" => "id_eselon",
            "table_alias" => "refeselon",
            "columns" => array(
                "nama_eselon",
                "kode_eselon",
            ),
            "referenced" => "LEFT"
        ),
        "ref_pegawai" => array(
            "fkey" => "id_pegawai",
            "reference_to" => "tr_pegawai_skpd",
            "table_alias" => "refpeg",
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
            "reference_to" => "tr_pegawai_skpd",
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
        "ref_jabatan" => array(
            "fkey" => "id_jabatan",
            "table_alias" => "refjabatan",
            "columns" => array(
                "jabatan",
            ),
            "referenced" => "inner"
        ),
    );

}

?>