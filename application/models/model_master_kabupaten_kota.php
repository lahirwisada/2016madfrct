<?php if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_kabupaten_kota.php";

class Model_master_kabupaten_kota extends Master_kabupaten_kota {

     protected $rules = array(
        array("kode_kabupaten", "required|min_length[3]"),
        array("nama_kabupaten", "required|min_length[3]|max_length[300]"),
    );

    public function __construct() {
        parent::__construct();
    }
    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "nama_kabupaten",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

} ?>