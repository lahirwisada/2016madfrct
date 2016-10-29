<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Ref_pegawai extends LWS_model {

    public function __construct() {
        parent::__construct("ref_pegawai");
        $this->primary_key = "id_pegawai";
    }

    protected $attribute_labels = array(
        "id_pegawai" => array("id_pegawai", ""),
        "id_status_perkawinan" => array("id_status_perkawinan", ""),
        "gelar_depan" => array("gelar_depan", ""),
        "gelar_belakang" => array("gelar_belakang", ""),
        "nama_depan" => array("nama_depan", ""),
        "nama_tengah" => array("nama_tengah", ""),
        "nama_belakang" => array("nama_belakang", ""),
        "nama_sambung" => array("nama_sambung", ""),
        "tgl_lahir" => array("tgl_lahir", ""),
        "tempat_lahir" => array("tempat_lahir", ""),
        "nip" => array("nip", ""),
        "no_kep" => array("no_kep", ""),
        "tmt_peg" => array("tmt_peg", ""),
        "created_date" => array("created_date", ""),
        "created_by" => array("created_by", ""),
        "modified_date" => array("modified_date", ""),
        "modified_by" => array("modified_by", ""),
        "record_active" => array("record_active", ""),
    );
    protected $rules = array(
        array("id_pegawai", ""),
        array("id_status_perkawinan", ""),
        array("gelar_depan", ""),
        array("gelar_belakang", ""),
        array("nama_depan", ""),
        array("nama_tengah", ""),
        array("nama_belakang", ""),
        array("nama_sambung", ""),
        array("tgl_lahir", ""),
        array("tempat_lahir", ""),
        array("nip", ""),
        array("no_kep", ""),
        array("tmt_peg", ""),
        array("created_date", ""), array("created_by", ""), array("modified_date", ""), array("modified_by", ""), array("record_active", ""),);
    
    protected $related_tables = array(
        "ref_status_perkawinan" => array(
            "fkey" => "id_status_perkawinan",
            "reference_to" => "ref_pegawai",
            "columns" => array(
                "id_status_perkawinan",
                "status_perkawinan",
                "kode_status_perkawinan",
            ),
            "referenced" => "LEFT"
        ),
        "tr_pegawai_skpd" => array(
            "fkey" => "id_pegawai",
            "table_alias" => "trpegskpd",
            "columns" => array(
                "id_pegawai_skpd",
                array("tgl_mulai", "tgl_mulai_peg_skpd"),
                array("tgl_berakhir", "tgl_berakhir_peg_skpd"),
                array("keterangan", "keterangan_peg_skpd"),
            ),
            "conditions"=>array(
                "is_active = '1'",
                "record_active = '1'",
            ),
            "referenced" => "LEFT"
        ),
        "ref_skpd" => array(
            "fkey" => "id_skpd",
            "reference_to" => "tr_pegawai_skpd",
            "columns" => array(
                "id_skpd",
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
        "tr_pegawai_skpd_jabatan" => array(
            "fkey" => "id_pegawai_skpd",
            "table_alias" => "trpegskpdjab",
            "reference_to" => "tr_pegawai_skpd",
            "columns" => array(
                "id_pegawai_skpd_jabatan",
                "masa_kerja_jabatan_bulan",
                "masa_kerja_jabatan_tahun",
                "tmt_eselon",
            ),
            "conditions"=>array(
                "is_active = '1'",
                "record_active = '1'",
            ),
            "referenced" => "LEFT"
        ),
        "ref_jabatan" => array(
            "fkey" => "id_jabatan",
            "table_alias" => "trjab",
            "reference_to" => "tr_pegawai_skpd_jabatan",
            "columns" => array(
                "id_jabatan",
                "jabatan",
            ),
            "referenced" => "LEFT"
        ),
        "tr_pegawai_golongan" => array(
            "fkey" => "id_pegawai",
            "table_alias" => "trpeggol",
            "columns" => array(
                "id_pegawai_golongan",
                "tgl_ditetapkan",
                "tgl_berakhir",
            ),
            "conditions"=>array(
                "is_active = '1'",
                "record_active = '1'",
            ),
            "referenced" => "LEFT"
        ),
        "ref_golongan" => array(
            "fkey" => "id_golongan",
            "table_alias" => "trgol",
            "reference_to" => "tr_pegawai_golongan",
            "columns" => array(
                "id_golongan",
                "kode_golongan",
                array("keterangan", "keterangan_golongan"),
                "golongan",
            ),
            "referenced" => "LEFT"
        ),
    );
    protected $attribute_types = array();

}
