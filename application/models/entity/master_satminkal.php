<?php
if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}
class Master_satminkal extends LWS_model {
    public function __construct() {
        parent::__construct("master_satminkal");
        $this->primary_key = "id_satminkal";
    }
    protected $attribute_labels = array(
        "id_satminkal" => array("id_satminkal", "Id Satminkal"),
        "id_kotama" => array("id_kotama", "Id Kotama"),
        "kode_satminkal" => array("kode_satminkal", "Kode"),
        "ur_satminkal" => array("ur_satminkal", "satminkal"),
        "created_date" => array("created_date", "created_date"),
        "created_by" => array("created_by", "created_by"),
        "modified_date" => array("modified_date", "modified_date"),
        "modified_by" => array("modified_by", "modified_by"),
        "record_active" => array("record_active", "record_active"),
    );
    protected $rules = array(
        array("id_satminkal", ""),
        array("id_kotama", ""),
        array("kode_satminkal", ""),
        array("ur_satminkal", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );
    protected $related_tables = array(
        "master_kotama" => array(
            "fkey" => "id_kotama",
            "columns" => array(
                "ur_kotama",
                "kode_kotama",
            ),
            "referenced" => "LEFT"
        ),
    );
    protected $attribute_types = array();
}
?>