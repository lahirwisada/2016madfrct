<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_satminkal.php";

class Model_master_satminkal extends master_satminkal {

    protected $rules = array(
        array("id_kotama", "required|numeric"),
        array("kode_satminkal", "required|min_length[1]|max_length[30]"),
        array("ur_satminkal", "required|min_length[1]|max_length[200]"),
        array("id_kesatuan", "required|numeric"),
        array("id_corps", "required|numeric"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "kode_satminkal",
                    "ur_kotama",
                    "ur_satminkal",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_like($keyword = FALSE) {

        $result = FALSE;
        if ($keyword) {
            $this->db->order_by("kode_satminkal", "asc");
            $this->db->where(" lower(" . $this->table_name . ".ur_satminkal) LIKE lower('%" . $keyword . "%') OR lower(" . $this->table_name . ".kode_satminkal) LIKE lower('%" . $keyword . "%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
    }

}

?>