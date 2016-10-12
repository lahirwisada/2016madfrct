<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Tr_peserta_diklat extends LWS_model {

    public function __construct() {
        parent::__construct("tr_peserta_diklat");
        $this->primary_key = "id_peserta_diklat";
    }

    protected $attribute_labels = array(
        "id_peserta_diklat" => array("id_peserta_diklat", "Id Diklat"),
        "id_peserta_diklat_crypted" => array("id_peserta_diklat_crypted", "Id Diklat"),
        "id_diklat" => array("id_diklat", "Id Diklat"),
        "id_pegawai" => array("id_pegawai", "Id Pegawai"),
        "id_jabatan" => array("id_jabatan", "Id Jabatan"), // Mencatat Jabatan ketika mengikuti diklat ini
        "id_skpd" => array("id_skpd", "Id SKPD"), // Mencatat SKPD ketika mengikuti diklat ini
        "id_golongan" => array("id_golongan", "Id Golongan"), // Mencatat SKPD ketika mengikuti diklat ini
        "nomor_peserta" => array("nomor_peserta", "Nomor Peserta"),
        "surat_konfirmasi_ok" => array("surat_konfirmasi_ok", "Surat Konfirmasi Ok"),
        "path_scan_surat_konfirmasi" => array("path_scan_surat_konfirmasi", "File Surat Konfirmasi Ok"),
    );
    protected $rules = array(
        array("id_peserta_diklat", ""),
        array("id_peserta_diklat_crypted", ""),
        array("id_diklat", ""),
        array("id_pegawai", ""),
        array("id_jabatan", ""),
        array("id_skpd", ""),
        array("id_golongan", ""),
        array("nomor_peserta", ""),
        array("surat_konfirmasi_ok", ""),
        array("path_scan_surat_konfirmasi", ""),
    );
    protected $related_tables = array(
        "tr_diklat" => array(
            "fkey" => "id_diklat",
            "columns" => array(
                "nama_diklat",
                "angkatan",
                "alamat_lokasi",
                "penyelenggara",
                "tgl_pelaksanaan",
                "tgl_selesai",
                "total_jam"
            ),
            "referenced" => "Inner"
        ),
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
        "ref_status_perkawinan" => array(
            "fkey" => "id_status_perkawinan",
            "reference_to" => "ref_pegawai",
            "columns" => array(
                "status_perkawinan",
                "kode_status_perkawinan",
            ),
            "referenced" => "LEFT"
        ),
        "ref_jabatan" => array(
            "fkey" => "id_jabatan",
            "table_alias" => "trjab",
            "columns" => array(
                "jabatan",
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
        "ref_golongan" => array(
            "fkey" => "id_golongan",
            "table_alias" => "trgol",
            "columns" => array(
                "kode_golongan",
                array("keterangan", "keterangan_golongan"),
                "golongan",
            ),
            "referenced" => "LEFT"
        ),
    );
    
    protected $attribute_types = array(
        "nomor_peserta" => "NUMERIC",
    );

}

?>