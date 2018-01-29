<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Master_satminkal extends LWS_model {

    public function __construct() {
        parent::__construct("master_satminkal");
        $this->primary_key = "id_satminkal";
        $this->sort_by = "kode_satminkal";
        $this->sort_mode = "asc";

        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_satminkal" => array("id_satminkal", "ID Satminkal"),
        "id_kotama" => array("id_kotama", "Id Kotama"),
        "kode_satminkal" => array("kode_satminkal", "Kode"),
        "ur_satminkal" => array("ur_satminkal", "satminkal"),
        "id_kesatuan" => array("id_kesatuan", "ID Kesatuan"),
        "id_corps" => array("id_corps", "ID Corps"),
        "operasional" => array("operasional", "Satuan Operasional"),
        "babinsa" => array("babinsa", "Babinsa"),
//        "created_date" => array("created_date", "created_date"),
//        "created_by" => array("created_by", "created_by"),
//        "modified_date" => array("modified_date", "modified_date"),
//        "modified_by" => array("modified_by", "modified_by"),
//        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_satminkal", ""),
        array("id_kotama", ""),
        array("kode_satminkal", ""),
        array("ur_satminkal", ""),
        array("id_kesatuan", ""),
        array("id_corps", ""),
        array("operasional", ""),
        array("babinsa", "")
    );
    protected $related_tables = array(
        "master_kotama" => array(
            "fkey" => "id_kotama",
            "columns" => array(
                "kode_kotama",
                "nama_kotama",
                "ur_kotama",
            ),
            "referenced" => "LEFT"
        ),
        "master_kesatuan" => array(
            "fkey" => "id_kesatuan",
            "columns" => array(
                "kode_kesatuan",
                "nama_kesatuan",
            ),
            "referenced" => "LEFT"
        ),
        "master_corps" => array(
            "fkey" => "id_corps",
            "columns" => array(
                "kode_corps",
                "init_corps",
                "ur_corps",
            ),
            "referenced" => "LEFT"
        ),
    );
    protected $attribute_types = array();

}

?>