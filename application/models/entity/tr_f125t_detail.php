<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

/**
 * Description of tr_f125t_detail
 *
 * @author nurfadillah
 */
class tr_f125t_detail extends LWS_Model {

    //put your code here

    public function __construct() {
        parent::__construct("tr_125t_detail");
        $this->primary_key = "id_f125t_detail";

        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_f125t_detail" => array("id_f125t_detail", "id_f125t_detail"),
        "id_f125t" => array("id_f125t", "id_f125t"),
        "id_kotama" => array("id_kotama", "id_kotama"),
        "id_pangkat" => array("id_pangkat", "id_pangkat"),
        "jumlah_secata" => array("jumlah_secata", "jumlah_secata"),
        "jumlah_secaba" => array("jumlah_secaba", "jumlah_secaba"),
        "jumlah_sesarcab" => array("jumlah_sesarcab", "jumlah_sesarcab"),
        "jumlah_selapa_setingkat" => array("jumlah_selapa_setingkat", "jumlah_selapa_setingkat"),
        "jumlah_sesko_angkatan_setingkat" => array("jumlah_sesko_angkatan_setingkat", "jumlah_sesko_angkatan_setingkat"),
        "jumlah_sesko_tni" => array("jumlah_sesko_tni", "jumlah_sesko_tni"),
        "jumlah_subtotal" => array("jumlah_subtotal", "jumlah_subtotal"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_f125t_detail", ""),
        array("id_f125t", ""),
        array("id_kotama", ""),
        array("id_pangkat", ""),
        array("jumlah_secata", ""),
        array("jumlah_secaba", ""),
        array("jumlah_sesarcab", ""),
        array("jumlah_selapa_setingkat", ""),
        array("jumlah_sesko_angkatan_setingkat", ""),
        array("jumlah_sesko_tni", ""),
        array("jumlah_subtotal", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );
    protected $related_tables = array(
        "mskot" => array(
            "table_name" => "master_kotama",
            "fkey" => "id_kotama",
            "table_alias" => "mskot",
            "columns" => array(
                array("kode_kotama","det_kode_kotama"),
                array("ur_kotama","det_ur_kotama"),
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
        "tr_125t" => array(
            "fkey" => "id_f125t",
            "columns" => array(
                "id_triwulan",
                "id_kabupaten_kota",
                "path_excel",
                "tanggal_upload",
                "tanggal_ttd",
                "uraian_atas_ttd",
                "jabatan_ttd",
                "nama_ttd",
                "pangkat_ttd",
                "nrp_ttd",
           ),
            "referenced" => "LEFT"
        ),
        "master_triwulan" => array(
            "fkey" => "id_triwulan",
            "reference_to" => "tr_125t",
            "columns" => array(
                "nama_triwulan",
                "kode_triwulan",
           ),
            "referenced" => "LEFT"
        ),
        "master_kotama" => array(
            "fkey" => "id_kotama",
            "reference_to" => "tr_125t",
            "columns" => array(
                "kode_kotama",
                "ur_kotama",
            ),
            "referenced" => "LEFT"
        ),
    );
    protected $attribute_types = array();
    public $col_map = array(
        "C" => "jumlah_secata",
        "D" => "jumlah_secaba",
        "E" => "jumlah_sesarcab",
        "F" => "jumlah_selapa_setingkat",
        "G" => "jumlah_sesko_angkatan_setingkat",
        "H" => "jumlah_sesko_tni",
        "I" => "jumlah_subtotal",
    );

}
