<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/ref_tingkat_pendidikan.php";

class model_ref_tingkat_pendidikan extends ref_tingkat_pendidikan {

    protected $rules = array(
        array("kode_tingkat_pendidikan", "required|min_length[2]|max_length[300]|alpha_dash"),
        array("tingkat_pendidikan", "required|min_length[3]"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "kode_tingkat_pendidikan",
                    "tingkat_pendidikan",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }
}

?>