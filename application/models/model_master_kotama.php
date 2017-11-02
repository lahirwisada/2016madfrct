<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_kotama.php";

class Model_master_kotama extends Master_kotama {

    protected $rules = array(
        array("kode_kotama", "required|min_length[1]"),
        array("nama_kotama", "required|min_length[3]|max_length[300]"),
        array("ur_kotama", "required|min_length[3]|max_length[300]"),
        array("struktur_kotama", "required|numeric"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "nama_kotama",
                    "ur_kotama",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    protected function auto_order__get_all() {
        return FALSE;
    }

    public function get_like($keyword = FALSE) {
        $result = FALSE;
        if ($keyword) {
            $this->db->order_by("kode_kotama", "asc");
            $this->db->where(" lower(" . $this->table_name . ".kode_kotama) LIKE lower('%" . $keyword . "%') OR lower(" . $this->table_name . ".nama_kotama) LIKE lower('%" . $keyword . "%') OR lower(" . $this->table_name . ".ur_kotama) LIKE lower('%" . $keyword . "%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
    }

//    public function check_id_by_nama_and_insert($nama = NULL) {
//        $id_kotama = FALSE;
//        if ($nama) {
//            $kotama_found = $this->get_detail("lower(nama_kotama) LIKE lower('%" . $nama . "%')");
//            if ($kotama_found) {
//                $id_kotama = $kotama_found->id_kotama;
//            } else {
//                $this->nama_kotama = $nama;
//                $id_kotama = $this->save();
//            }
//            unset($kotama_found);
//        }
//        return $id_kotama;
//    }
//
//    public function get_id_by_nama($nama = '') {
//        if ($nama != '') {
//            return $this->get_detail("lower(nama_kotama) LIKE lower('%" . $nama . "%')");
//        }
//        return FALSE;
//    }
}
