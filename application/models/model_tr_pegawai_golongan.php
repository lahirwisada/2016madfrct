<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_pegawai_golongan.php";

class model_tr_pegawai_golongan extends Tr_pegawai_golongan {

    protected $rules = array(
        array("id_pegawai_golongan", ""),
        array("id_golongan", "required|numeric"),
        array("id_pegawai", "required|numeric"),
        array("tgl_ditetapkan", ""), // Mencatat tanggal pertama kali ditetapkan
        array("tgl_berakhir", ""), // Mencatat Tanggal berakhirnya pegawai pada golongan ini
        array("is_active", "numeric"), // Menandakan bahwa golongan ini adalah golongan saat ini
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );

    public function __construct() {
        parent::__construct();
    }

    private function __check_blank_post() {
        $post_null_check = array(
            "tgl_ditetapkan",
            "tgl_berakhir",
        );

        foreach ($post_null_check as $null_post) {
            if ($this->{$null_post} == "") {
                $this->{$null_post} = "NULL";
            } else {
                $this->{$null_post} = "'" . $this->{$null_post} . "'";
            }
        }
    }

    protected function after_get_data_post() {
        $this->__check_blank_post();
    }

    public function insert_pegawai_golongan($id_pegawai = FALSE, $data_pegawai_golongan = FALSE) {
        $id_pegawai_golongan = FALSE;
        if ($id_pegawai && $data_pegawai_golongan &&
                is_array($data_pegawai_golongan) &&
                array_key_exists('id_golongan', $data_pegawai_golongan)) {

            foreach (array_keys($this->attribute_labels) as $attribute_name) {
                if (array_key_exists($attribute_name, $data_pegawai_golongan)) {
                    $this->{$attribute_name} = $data_pegawai_golongan[$attribute_name];
                }
            }

            $this->id_pegawai = $id_pegawai;
            $this->is_active = 1;

            $id_pegawai_golongan = $this->save();
        }
        return $id_pegawai_golongan;
    }

    public function all($id_pegawai = FALSE, $force_limit = FALSE, $force_offset = FALSE) {

        $this->db->where($this->table_name . ".id_pegawai = '" . $id_pegawai . "'");

        return parent::get_all(array(
                    "tgl_ditetapkan",
                    "tgl_berakhir",
                    "kode_golongan",
                    "golongan",
                    "keterangan",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

}

?>