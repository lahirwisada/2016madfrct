<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_kesatuan.php";

class Model_master_kesatuan extends Master_kesatuan {

    protected $rules = array(
        array("kode_kesatuan", "required|min_length[1]|max_length[20]"),
        array("nama_kesatuan", "required|min_length[3]|max_length[200]"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "nama_kesatuan",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_like($keyword = FALSE) {

        $result = FALSE;
        if ($keyword) {
            $this->db->order_by("kode_kesatuan", "asc");
            $this->db->where(" lower(" . $this->table_name . ".kode_kesatuan) LIKE lower('%" . $keyword . "%') OR lower(" . $this->table_name . ".nama_kesatuan) LIKE lower('%" . $keyword . "%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
    }

}

?>