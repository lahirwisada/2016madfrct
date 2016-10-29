<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cref_pegawai extends Back_end {

    public $model = 'model_ref_pegawai';

    public function __construct() {
        parent::__construct('kelola_pustaka_pegawai', 'Pustaka Data Pegawai');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = FALSE) {
        parent::detail($id, array(
            "nip",
            "no_kep",
            "gelar_depan",
            "gelar_belakang",
            "nama_depan",
            "nama_tengah",
            "nama_belakang",
            "tempat_lahir",
            "tgl_lahir",
            "id_status_perkawinan",
            "id_skpd",
            "id_jabatan",
            "id_golongan",
        ));

        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Pendaftaran ' . $this->_header_title
        ));

        $this->set("additional_js", array(
            "back_end/" . $this->_name . "/js/detail_js",
            "back_end/cpeserta_diklat/js/detail_isian_js",
        ));

        $this->add_cssfiles(array("plugins/select2/select2.min.css"));
        $this->add_jsfiles(array("plugins/select2/select2.full.min.js"));
//        $this->add_jsfiles(array("avant/plugins/form-jasnyupload/fileinput.min.js"));
    }

    public function get_like() {
        $keyword = $this->input->post("keyword");
        $id_skpd = $this->input->post("id_skpd");

        $data_found = $this->{$this->model}->get_like($keyword, $id_skpd);

        $this->to_json($data_found);
    }

    private function load_paging_riwayat_kepangkatan($id_pegawai) {
        $this->load_paging("model_tr_pegawai_golongan", "currpage_riwayat_pegawai_golongan", array(
            "records" => "records_riwayat_pegawai_golongan",
            "keyword" => "keyword_riwayat_pegawai_golongan",
            "field_id" => "field_id_riwayat_pegawai_golongan",
            "paging_set" => "paging_set_riwayat_pegawai_golongan",
            "next_list_number" => "next_list_number_riwayat_pegawai_golongan"), "all", $id_pegawai
        );
    }
    
    private function load_paging_riwayat_jabatan($id_pegawai) {
        $this->load_paging("model_tr_pegawai_skpd_jabatan", "currpage_riwayat_pegawai_jabatan", array(
            "records" => "records_riwayat_pegawai_jabatan",
            "keyword" => "keyword_riwayat_pegawai_jabatan",
            "field_id" => "field_id_riwayat_pegawai_jabatan",
            "paging_set" => "paging_set_riwayat_pegawai_jabatan",
            "next_list_number" => "next_list_number_riwayat_pegawai_jabatan"), "all", $id_pegawai
        );
    }
    
    private function load_paging_riwayat_diklat($id_pegawai) {
        $this->load_paging("model_tr_peserta_diklat", "currpage_riwayat_diklat", array(
            "records" => "records_riwayat_diklat",
            "keyword" => "keyword_riwayat_diklat",
            "field_id" => "field_id_riwayat_diklat",
            "paging_set" => "paging_set_riwayat_diklat",
            "next_list_number" => "next_list_number_riwayat_diklat"), "riwayat_by_id_pegawai", $id_pegawai
        );
    }

    public function history($id = FALSE) {
        $this->set("bread_crumb", array(
            "cref_pegawai" => $this->_header_title,
            "#" => "Detail Sejarah Pegawai"
        ));

        parent::detail($id, array(
            "nip",
            "no_kep",
            "gelar_depan",
            "gelar_belakang",
            "nama_depan",
            "nama_tengah",
            "nama_belakang",
            "tempat_lahir",
            "tgl_lahir",
            "id_status_perkawinan",
            "id_skpd",
            "id_jabatan",
            "id_golongan",
        ));
        
        $this->load_paging_riwayat_kepangkatan($id);
        $this->load_paging_riwayat_jabatan($id);
        $this->load_paging_riwayat_diklat($id);

        $this->set("additional_js", array(
            "back_end/" . $this->_name . "/js/history_js",
        ));
    }

}
