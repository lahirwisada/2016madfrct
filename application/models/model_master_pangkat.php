<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_pangkat.php";

class Model_master_pangkat extends Master_pangkat {

    protected $rules = array(
        array("kode_pangkat", "required|min_length[2]"),
        array("ur_pangkat", "required|min_length[3]|max_length[300]"),
        array("kategori_pangkat", "required|integer"),
        array("tingkat_pangkat", "required|integer"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "ur_pangkat",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function check_id_by_kode_pangkat_and_insert($kode_pangkat = NULL) {
        $id_pangkat = FALSE;
        if ($kode_pangkat) {
            $pangkat_found = $this->get_detail("lower(kode_pangkat) LIKE lower('%" . $kode_pangkat . "%')");
            if ($pangkat_found) {
                echo $kode_pangkat . ' - ada ;';
                $id_pangkat = $pangkat_found->id_pangkat;
            } else {
                echo $kode_pangkat . ' - tidak ;';
                $this->kode_pangkat = $kode_pangkat;
//                $id_pangkat = $this->save();
            }
            unset($pangkat_found);
        }
//        return $id_pangkat;
    }

    public function get_detail_by_kode_pangkat($kode_pangkat = '') {
        if ($kode_pangkat != '') {
            return $this->get_detail("lower(kode_pangkat) LIKE lower('%" . $kode_pangkat . "%')");
        }
        return FALSE;
    }

}

?>
