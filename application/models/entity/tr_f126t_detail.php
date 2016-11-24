<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

/**
 * Description of tr_f126t_detail
 *
 * @author nurfadillah
 */
class tr_f126t_detail extends LWS_Model {

    //put your code here

    public function __construct() {
        parent::__construct("tr_126t_detail");
        $this->primary_key = "id_f126t_detail";

        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_f126t_detail" => array("id_f126t_detail", "id_f126t_detail"),
        "id_f126t" => array("id_f126t", "id_f125t"),
        "id_pangkat" => array("id_pangkat", "id_pangkat"),
        "jumlah_sd" => array("jumlah_sd", "jumlah_sd"),
        "jumlah_sltp" => array("jumlah_sltp", "jumlah_sltp"),
        "jumlah_slta" => array("jumlah_slta", "jumlah_slta"),
        "jumlah_d1" => array("jumlah_d1", "jumlah_d1"),
        "jumlah_d2" => array("jumlah_d2", "jumlah_d2"),
        "jumlah_d3" => array("jumlah_d3", "jumlah_d3"),
        "jumlah_d4" => array("jumlah_d4", "jumlah_d4"),
        "jumlah_s1" => array("jumlah_s1", "jumlah_s1"),
        "jumlah_s2" => array("jumlah_s2", "jumlah_s2"),
        "jumlah_s3" => array("jumlah_s3", "jumlah_s3"),
        "jumlah_subtotal" => array("jumlah_subtotal", "jumlah_subtotal"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_f126t_detail", ""),
        array("id_f126t", ""),
        array("id_pangkat", ""),
        array("jumlah_sd", ""),
        array("jumlah_sltp", ""),
        array("jumlah_slta", ""),
        array("jumlah_d1", ""),
        array("jumlah_d2", ""),
        array("jumlah_d3", ""),
        array("jumlah_d4", ""),
        array("jumlah_s1", ""),
        array("jumlah_s2", ""),
        array("jumlah_s3", ""),
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
        "C" => "jumlah_sd",
        "D" => "jumlah_sltp",
        "E" => "jumlah_slta",
        "F" => "jumlah_d1",
        "G" => "jumlah_d2",
        "H" => "jumlah_d3",
        "I" => "jumlah_d4",
        "J" => "jumlah_s1",
        "K" => "jumlah_s2",
        "L" => "jumlah_s3",
        "M" => "jumlah_subtotal",
    );

}
