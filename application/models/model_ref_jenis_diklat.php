<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/ref_jenis_diklat.php";

class model_ref_jenis_diklat extends ref_jenis_diklat {

    protected $rules = array(
        array("jenis_diklat", "required|min_length[3]|max_length[300]"),
        array("keterangan", "min_length[3]"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "jenis_diklat",
                    "keterangan",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }
}

?>