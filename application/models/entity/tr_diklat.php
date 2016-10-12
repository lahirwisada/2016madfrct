<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Tr_diklat extends LWS_model {

    public function __construct() {
        parent::__construct("tr_diklat");
        $this->primary_key = "id_diklat";
    }

    protected $attribute_labels = array(
        "id_diklat" => array("id_diklat", "Id Diklat"),
        "id_kabupaten_kota" => array("id_kabupaten_kota", "Kota Pelaksanaan"),
        "id_jenis_diklat" => array("id_jenis_diklat", "Jenis Diklat"),
        "nama_diklat" => array("nama_diklat", "Nama Diklat"),
        "angkatan" => array("angkatan", "Angkatan"),
        "alamat_lokasi" => array("alamat_lokasi", "Alamat Lokasi"),
        "penyelenggara" => array("penyelenggara", "Penyelenggara"),
        "tgl_pelaksanaan" => array("tgl_pelaksanaan", "Tgl. Pelaksanaan"),
        "tgl_selesai" => array("tgl_selesai", "Tgl. Selesai"),
        "total_jam" => array("total_jam", "Total Jam"),
        "postfix_no_sttpp" => array("postfix_no_sttpp", "Akiran No. STTPP"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active"),
        "no_spt_a" => array("no_spt_a", "no_spt_a"),
        "no_spt_b" => array("no_spt_b", "no_spt_b"),
        "no_spt_c" => array("no_spt_c", "no_spt_c"),
        "no_spt_d" => array("no_spt_d", "no_spt_d"),
        "tgl_spt" => array("tgl_spt", "Tanggal SPT"),
        "spt_tembusan" => array("spt_tembusan", "Tembusan"),
        "spt_dasar" => array("spt_dasar", "Dasar SPT"),
        "spt_kepada" => array("spt_kepada", "SPT Kepada"),
        "id_ref_ttd" => array("id_ref_ttd", "Penandatangan SPT"),
        "id_diklat_crypted" => array("id_diklat_crypted", "Id Diklat Crypted"),
        "tgl_sttpp" => array("tgl_sttpp", "tgl sttpp"),
        "id_ref_ttd_sttpp" => array("id_ref_ttd_sttpp", "Penandatangan STTPP"),
        "kuota_diklat" => array("kuota_diklat", "Kuota Diklat"),
        "kuota_tersedia" => array("kuota_tersedia", "Kuota Tersedia"),
        "peserta_terdaftar" => array("peserta_terdaftar", "Peserta Terdaftar"),
        "jumlah_waiting_list" => array("jumlah_waiting_list", "Jumlah Waiting List"),
        "is_registration_closed" => array("is_registration_closed", "Pendaftaran ditutup"),
    );
    
    protected $rules = array(
        array("id_diklat", ""),
        array("id_kabupaten_kota", ""),
        array("id_jenis_diklat", ""),
        array("nama_diklat", ""),
        array("angkatan", ""),
        array("alamat_lokasi", ""),
        array("penyelenggara", ""),
        array("tgl_pelaksanaan", ""),
        array("tgl_selesai", ""),
        array("total_jam", ""),
        array("postfix_no_sttpp", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
        array("no_spt_a", ""),
        array("no_spt_b", ""),
        array("no_spt_c", ""),
        array("no_spt_d", ""),
        array("tgl_spt", ""),
        array("spt_tembusan", ""),
        array("spt_dasar", ""),
        array("spt_kepada", ""),
        array("id_ref_ttd", ""),
        array("id_diklat_crypted", ""),
        array("tgl_sttpp", ""),
        array("id_ref_ttd_sttpp", ""),
        array("kuota_diklat", ""),
        array("kuota_tersedia", ""),
        array("peserta_terdaftar", ""),
        array("jumlah_waiting_list", ""),
        array("is_registration_closed", ""),
    );
    
    protected $related_tables = array(
        "ref_kabupaten_kota" => array(
            "fkey" => "id_kabupaten_kota",
            "columns" => array(
                "nama_kabupaten",
                "kode_kabupaten",
                "is_ibukota",
            ),
            "referenced" => "LEFT"
        ),
        "ref_jenis_diklat" => array(
            "fkey" => "id_jenis_diklat",
            "columns" => array(
                "jenis_diklat",
            ),
            "referenced" => "inner"
        ),
        "ref_provinsi" => array(
            "fkey" => "id_provinsi",
            "reference_to" => "ref_kabupaten_kota",
            "columns" => array(
                "nama_provinsi",
                "kode_provinsi",
            ),
            "referenced" => "LEFT"
        ),
        "ref_ttd" => array(
            "fkey" => "id_ref_ttd",
            "columns" => array(
                "jabatan_ttd",
                "uraian_atas_ttd",
                "uraian_bawah_ttd",
            ),
            "referenced" => "LEFT"
        ),
        "rts" => array(
            "table_name"=>"ref_ttd",
            "fkey" => array("id_ref_ttd_sttpp", "id_ref_ttd"),
            "table_alias" => "rts",
            "columns" => array(
                array("jabatan_ttd", "jabatan_ttd_sttpp"),
                array("uraian_atas_ttd", "uraian_atas_ttd_sttpp"),
                array("uraian_bawah_ttd", "uraian_bawah_ttd_sttpp"),
            ),
            "referenced" => "LEFT"
        ),
        "rps" => array(
            "table_name"=>"ref_pegawai",
            "fkey" => "id_pegawai",
            "reference_to" => "rts",
            "table_alias" => "rps",
            "columns" => array(
                array("gelar_depan","gelar_depan_ttd_sttpp"),
                array("gelar_belakang", "gelar_belakang_sttpp"),
                array("nama_sambung", "nama_sambung_sttpp"),
                array("nip", "nip_sttpp"),
            ),
            "referenced" => "LEFT"
        ),
        "ref_pegawai" => array(
            "fkey" => "id_pegawai",
            "reference_to" => "ref_ttd",
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
        "tr_pegawai_golongan" => array(
            "fkey" => "id_pegawai",
            "table_alias" => "tpg",
            "reference_to" => "ref_pegawai",
            "columns" => array(
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
            "reference_to" => "tr_pegawai_golongan",
            "columns" => array(
                "kode_golongan",
                "golongan",
                "keterangan",
            ),
            "referenced" => "LEFT"
        ),
        "ref_skpd" => array(
            "fkey" => "id_skpd",
            "reference_to" => "ref_ttd",
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
    
    protected $attribute_types = array(
        "tgl_spt" => "DATE",
        "tgl_pelaksanaan" => "DATE",
        "tgl_selesai" => "DATE",
        "tgl_sttpp" => "DATE",
        "total_jam" => "NUMERIC",
        "kuota_diklat" => "NUMERIC",
        "kuota_tersedia" => "NUMERIC",
        "peserta_terdaftar" => "NUMERIC",
        "jumlah_waiting_list" => "NUMERIC",
        "is_registration_closed" => "NUMERIC",
    );

}

?>