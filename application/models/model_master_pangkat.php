<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_pangkat.php";

class Model_master_pangkat extends Master_pangkat {

    protected $rules = array(
        array("kode_pangkat", "required|min_length[2]"),
        array("ur_pangkat", "required|min_length[3]|max_length[300]"),
    );

    public function __construct() {
        parent::__construct();
    }
    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "ur_pangkat",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }
    
    public function get_detail_by_kode_pangkat($kode_pangkat = ''){
        if($kode_pangkat != ''){
            return $this->get_detail("kode_pangkat LIKE '%".$kode_pangkat."%'");
        }
        return FALSE;
    }

}

?>