<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_triwulan.php";

class Model_master_triwulan extends Master_triwulan {

    protected $rules = array(
        array("kode_triwulan", "required"),
        array("nama_triwulan", "required"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "kode_triwulan", "nama_triwulan"
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_like($keyword = FALSE) {

        $result = FALSE;
        if ($keyword) {
            $this->db->order_by("kode_triwulan", "asc");
            $this->db->where(" lower(" . $this->table_name . ".kode_triwulan) LIKE lower('%" . $keyword . "%') OR lower(" . $this->table_name . ".nama_triwulan) LIKE lower('%" . $keyword . "%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
    }

}

?>