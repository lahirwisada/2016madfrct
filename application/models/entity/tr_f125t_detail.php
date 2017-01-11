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
    protected $related_tables = array();
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
