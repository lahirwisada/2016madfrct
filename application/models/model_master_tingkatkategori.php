<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_tingkatkategori.php";

class Model_master_tingkatkategori extends Master_tingkatkategori {

    protected $rules = array(
        array("kode_tingkatkategori", "required|min_length[1]"),
        array("nama_tingkatkategori", "required|min_length[3]|max_length[300]"),
    );

    public function __construct() {
        parent::__construct();
    }
    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "nama_tingkatkategori",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

}

?>