<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_corps.php";

class Model_master_corps extends Master_corps {

    protected $rules = array(
        array("kode_corps", "required|min_length[1]"),
        array("init_corps", "required|min_length[3]|max_length[300]"),
        array("ur_corps", "required|min_length[3]|max_length[300]"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "ur_corps",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_like($keyword = FALSE) {

        $result = FALSE;
        if ($keyword) {
            $this->db->order_by("kode_corps", "asc");
            $this->db->where(" lower(" . $this->table_name . ".ur_corps) LIKE lower('%" . $keyword . "%') OR lower(" . $this->table_name . ".kode_corps) LIKE lower('%" . $keyword . "%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
    }

}

?>