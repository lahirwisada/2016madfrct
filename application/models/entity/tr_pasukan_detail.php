<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class tr_pasukan_detail extends LWS_Model {

    public function __construct() {
        parent::__construct("tr_pasukan_detail");
        $this->primary_key = "id_detail";

        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_detail" => array("id_detail", "ID Detail"),
        "id_rekap" => array("id_rekap", "ID Rekap"),
        "id_satminkal" => array("id_satminkal", "ID Satminkal"),
        "id_pangkat" => array("id_pangkat", "ID Pangkat"),
        "top" => array("top", "Top"),
        "dinas" => array("dinas", "Dinas"),
        "mpp" => array("mpp", "MPP"),
        "lf" => array("lf", "LF"),
        "skorsing" => array("skorsing", "Skorsing"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_detail", ""),
        array("id_rekap", ""),
        array("id_satminkal", ""),
        array("id_pangkat", ""),
        array("top", ""),
        array("dinas", ""),
        array("mpp", ""),
        array("lf", ""),
        array("skorsing", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );
    protected $related_tables = array(
        "master_satminkal" => array(
            "table_name" => "master_satminkal",
            "fkey" => "id_satminkal",
            "columns" => array(
                "kode_satminkal",
                "ur_satminkal",
            ),
            "referenced" => "LEFT"
        ),
        "master_pangkat" => array(
            "table_name" => "master_pangkat",
            "fkey" => "id_pangkat",
            "columns" => array(
                "kode_pangkat",
                "ur_pangkat",
            ),
            "referenced" => "LEFT"
        ),
//        "tr_formulir" => array(
//            "fkey" => "id_formulir",
//            "columns" => array(
//                "id_bulan",
//                "id_kabupaten_kota",
//                "path_excel",
//                "tanggal_upload",
//                "tanggal_ttd",
//                "uraian_atas_ttd",
//                "jabatan_ttd",
//                "nama_ttd",
//                "pangkat_ttd",
//                "nrp_ttd",
//           ),
//            "referenced" => "LEFT"
//        ),
//        "master_bulan" => array(
//            "fkey" => "id_bulan",
//            "reference_to" => "tr_formulir",
//            "columns" => array(
//                "nama_bulan",
//                "kode_bulan",
//           ),
//            "referenced" => "LEFT"
//        ),
    );
    protected $attribute_types = array(
        "tanggal_upload" => "DATE",
        "tanggal_ttd" => "DATE",
    );
    public $col_map = array(
        "C" => "top",
        "D" => "dinas",
        "E" => "mpp",
        "F" => "lf",
        "G" => "skorsing",
    );

}
