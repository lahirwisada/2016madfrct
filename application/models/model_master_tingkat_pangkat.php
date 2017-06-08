<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_tingkat_pangkat.php";

class Model_master_tingkat_pangkat extends Master_tingkat_pangkat {

    protected $rules = array(
        array("kode_tingkat", "required|min_length[1]"),
        array("ur_tingkat", "required|min_length[3]|max_length[300]")
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "kode_tingkat", "ur_tingkat"
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_like($keyword = FALSE) {
        $result = FALSE;
        if ($keyword) {
            $this->db->order_by("ur_tingkat", "asc");
            $this->db->where(" lower(" . $this->table_name . ".kode_tingkat) LIKE lower('%" . $keyword . "%') OR lower(" . $this->table_name . ".ur_tingkat) LIKE lower('%" . $keyword . "%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
    }

}
