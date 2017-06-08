<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_golongan_pangkat.php";

class Model_master_golongan_pangkat extends Master_golongan_pangkat {

    protected $rules = array(
        array("kode_golongan", "required|min_length[1]"),
        array("ur_golongan", "required|min_length[3]|max_length[300]")
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "kode_golongan", "ur_golongan"
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_like($keyword = FALSE) {
        $result = FALSE;
        if ($keyword) {
            $this->db->order_by("ur_golongan", "asc");
            $this->db->where(" lower(" . $this->table_name . ".kode_golongan) LIKE lower('%" . $keyword . "%') OR lower(" . $this->table_name . ".ur_golongan) LIKE lower('%" . $keyword . "%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
    }

}
