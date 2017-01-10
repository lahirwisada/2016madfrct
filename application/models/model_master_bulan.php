<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_bulan.php";

class Model_master_bulan extends Master_bulan{

    protected $rules = array(
        array("kode_bulan", "required|min_length[1]"),
        array("nama_bulan", "required|min_length[3]|max_length[60]"),
//        array("keterangan", "required|min_length[1]|max_length[200]"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "nama_bulan",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_like($keyword = FALSE) {

        $result = FALSE;
        if ($keyword) {
            $this->db->order_by("kode_bulan", "asc");
            $this->db->where(" lower(" . $this->table_name . ".nama_bulan) LIKE lower('%" . $keyword . "%') OR lower(" . $this->table_name . ".kode_bulan) LIKE lower('%" . $keyword . "%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
    }

}

?>
