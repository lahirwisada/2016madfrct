<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_diklat_tahapan.php";

class model_tr_diklat_tahapan extends tr_diklat_tahapan {

    protected $rules = array(
        array("tahapan", "min_length[2]|max_length[300]"),
        array("tgl_mulai_tahapan", ""),
        array("tgl_selesai_tahapan", ""),
        array("keterangan_tahapan", ""),
        array("id_diklat", "numeric"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function remove_by_id_diklat($id_diklat = FALSE) {
        if ($id_diklat) {
            return $this->remove_by_foreign_key($id_diklat, $this->table_name . ".id_diklat");
        }
        return FALSE;
    }

    public function save_collection($set_data = FALSE, $id_diklat = FALSE) {
        if ($set_data && $id_diklat) {
            $this->remove_by_id_diklat($id_diklat);
            foreach ($set_data as $key => $row_data) {
                if ($this->set_attribute_data($row_data, $id_diklat)) {
                    $this->save();
                }
            }
        }
        return FALSE;
    }

    public function set_attribute_data($row_data = FALSE, $id_diklat = FALSE) {
        if ($row_data) {

            if (is_object($row_data)) {
                $row_data = (array) $row_data;
            }

            $this->tahapan = $row_data["tahapan"];
            $this->tgl_mulai_tahapan = $row_data["tgl_mulai_tahapan"];
            $this->tgl_selesai_tahapan = $row_data["tgl_selesai_tahapan"];
            $this->keterangan_tahapan = $row_data["keterangan"];
            $this->id_diklat = $id_diklat;
            return TRUE;
        }
        return FALSE;
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        $this->db->order_by("col_order", "asc");
        return parent::get_all(array(
                    "tahapan",
                    "tgl_mulai_tahapan",
                    "tgl_selesai_tahapan",
                    "keterangan_tahapan",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

}

?>