<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/ref_skpd.php";

class model_ref_skpd extends ref_skpd {

    protected $rules = array(
        array("nama_skpd", "required|min_length[2]|max_length[300]"),
        array("col_order", "numeric"),
        array("abbr_skpd", "min_length[2]|max_length[100]"),
        array("alamat_skpd", "min_length[2]|max_length[300]"),
        array("kodepos", "min_length[4]|max_length[60]|numeric"),
        array("no_telp", "min_length[5]|max_length[100]|numeric"),
        array("email", "min_length[4]|max_length[100]|valid_email"),
        array("website", "min_length[4]|max_length[200]"),
    );

    public function __construct() {
        parent::__construct();
    }
    
    protected function after_get_data_post() {
        if(!is_numeric($this->col_order) || $this->col_order = ""){
            $this->col_order = 0;
        }
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        $this->db->order_by("col_order", "asc");
        return parent::get_all(array(
                    "nama_skpd",
//                    "col_order",
                    "abbr_skpd",
                    "alamat_skpd",
                    "kodepos",
                    "no_telp",
                    "email",
                    "website",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }
    
    public function get_like($keyword = FALSE) {

        $result = FALSE;
        if ($keyword) {
            $this->db->order_by("col_order", "asc");
            $where_keyword = "lower(" . $this->table_name . ".nama_skpd) LIKE lower('%" . $keyword . "%') OR ".
                    "lower(" . $this->table_name . ".abbr_skpd) LIKE lower('%" . $keyword . "%') ";
            $this->db->where($where_keyword, NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
    }
}

?>