<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_agama.php";

class Model_master_prpvinsi extends Master_provinsi {

    protected $rules = array(
        array("nama_provinsi", "required|min_length[3]|max_length[300]|alpha_dash"),
    );

    public function __construct() {
        parent::__construct();
    }
    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "nama_provinsi",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

}

?>