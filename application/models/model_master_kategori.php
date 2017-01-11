<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_kategori.php";

class Model_master_kategori extends Master_kategori {

    protected $rules = array(
        array("kode_kategori", "required|min_length[1]"),
        array("nama_kategori", "required|min_length[3]|max_length[300]"),
    );

    public function __construct() {
        parent::__construct();
    }
    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "nama_kategori",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

}

?>