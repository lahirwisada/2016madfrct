<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_pasukan_rekap.php";

class model_tr_pasukan_rekap extends tr_pasukan_rekap {

    public function __construct() {
        parent::__construct();
    }

    protected $rules = array(
        array("id_rekap", ""),
        array("id_bulan", "required"),
        array("id_tahun", "required"),
        array("id_kotama", ""),
        array("path_excel", ""),
        array("tanggal_upload", "required"),
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

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        $where = FALSE;
        if (!empty($this->user_detail['id_kotama'])) {
            $where = 'sc_fcstprsn.tr_pasukan_rekap.id_kotama = ' . $this->user_detail['id_kotama'];
        }
        return parent::get_all(array(
                    "tanggal_upload",
                    "tanggal_ttd",
                    "nama_ttd",
                    "pangkat_ttd",
                    "nrp_ttd",
                        ), $where, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

}
