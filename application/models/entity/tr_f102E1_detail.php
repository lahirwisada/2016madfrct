<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

/**
 * Description of tr_f102E1_detail
 *
 * @author nurfadillah
 */
class tr_f102E1_detail extends LWS_Model {

    //put your code here

    public function __construct() {
        parent::__construct("tr_102E1_detail");
        $this->primary_key = "id_f102E1_detail";

        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_f102E1_detail" => array("id_f102E1_detail", "id_f126t_detail"),
        "id_f102E1" => array("id_f102E1", "id_f102E1"),
        "id_pangkat" => array("id_pangkat", "id_pangkat"),
        "jumlah_top" => array("jumlah_top", "jumlah_top/dspp"),
        "jumlah_myj" => array("jumlah_myj", "jumlah_myj"),
        "jumlah_brj" => array("jumlah_brj", "jumlah_brj"),
        "jumlah_kol" => array("jumlah_kol", "jumlah_kol"),
        "jumlah_ltk" => array("jumlah_ltk", "jumlah_ltk"),
        "jumlah_myr" => array("jumlah_myr", "jumlah_myr"),
        "jumlah_kpt" => array("jumlah_kpt", "jumlah_kpt"),
        "jumlah_ltt" => array("jumlah_ltt", "jumlah_ltt"),
        "jumlah_ltd" => array("jumlah_ltd", "jumlah_ltd"),
        "jumlah_pltu" => array("jumlah_pltu", "jumlah_pltu"),
        "jumlah_pltd" => array("jumlah_pltd", "jumlah_pltd"),
        "jumlah_srm" => array("jumlah_srm", "jumlah_srm"),
        "jumlah_srk" => array("jumlah_srk", "jumlah_srk"),
        "jumlah_srt" => array("jumlah_srt", "jumlah_srt"),
        "jumlah_srd" => array("jumlah_srd", "jumlah_srd"),
        "jumlah_kpk" => array("jumlah_kpk", "jumlah_kpk"),
        "jumlah_kpu" => array("jumlah_kpu", "jumlah_kpu"),
        "jumlah_kpd" => array("jumlah_kpd", "jumlah_kpd"),
        "jumlah_prk" => array("jumlah_prk", "jumlah_prk"),
        "jumlah_prt" => array("jumlah_prt", "jumlah_prt"),
        "jumlah_prd" => array("jumlah_prd", "jumlah_prd"),
        "jumlah_subtotal" => array("jumlah_subtotal", "jumlah_subtotal"),
        "jumlah_pns" => array("jumlah_pns", "jumlah_pns"),
        "jumlah_ksong" => array("jumlah_ksong", "jumlah_ksong"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_f102E1_detail", ""),
        array("id_f102E1", ""),
        array("id_pangkat", ""),
        array("jumlah_top", ""),
        array("jumlah_myj", ""),
        array("jumlah_brj", ""),
        array("jumlah_kol", ""),
        array("jumlah_ltk", ""),
        array("jumlah_myr", ""),
        array("jumlah_kpt", ""),
        array("jumlah_ltt", ""),
        array("jumlah_ltd", ""),
        array("jumlah_pltu", ""),
        array("jumlah_pltd", ""),
        array("jumlah_srm", ""),
        array("jumlah_srk", ""),
        array("jumlah_srt", ""),
        array("jumlah_srd", ""),
        array("jumlah_kpk", ""),
        array("jumlah_kpu", ""),
        array("jumlah_kpd", ""),
        array("jumlah_prk", ""),
        array("jumlah_prt", ""),
        array("jumlah_prd", ""),
        array("jumlah_subtotal", ""),
        array("jumlah_pns", ""),
        array("jumlah_ksong", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );
    protected $related_tables = array();
    protected $attribute_types = array();
    public $col_map = array(
        
        "C" => "jumlah_top",
        "D" => "jumlah_myj",
        "E" => "jumlah_brj",
        "F" => "jumlah_kol",
        "G" => "jumlah_ltk",
        "H" => "jumlah_myr",
        "I" => "jumlah_kpt",
        "J" => "jumlah_ltt",
        "K" => "jumlah_ltd",
        "L" => "jumlah_pltu",
        "M" => "jumlah_pltd",
        "N" => "jumlah_srm",
        "O" => "jumlah_srk",
        "P" => "jumlah_srt",
        "Q" => "jumlah_srd",
        "R" => "jumlah_kpk",
        "S" => "jumlah_kpu",
        "T" => "jumlah_kpd",
        "U" => "jumlah_prk",
        "V" => "jumlah_prt",
        "W" => "jumlah_prd",
        "X" => "jumlah_subtotal",
        "Z" => "jumlah_pns",
        "AA" => "jumlah_ksong",
    );

}
