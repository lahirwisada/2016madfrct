<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_pegawai_skpd.php";

class model_tr_pegawai_skpd extends Tr_pegawai_skpd {

    protected $rules = array(
        array("id_pegawai_skpd", ""),
        array("id_skpd ", "required|numeric"),
//        array("id_jabatan", "required|numeric"),
        array("id_pegawai", "required|numeric"),
        array("tgl_mulai", ""), // Mencatat Tanggal mulai pegawai pada skpd ini
        array("tgl_berakhir", ""), // Mencatat Tanggal berakhirnya pegawai pada skpd ini
        array("is_active", "numeric"), // Menandakan bahwa SKPD ini adalah golongan saat ini
        array("keterangan", ""),
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
            "tgl_mulai",
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

    public function insert_pegawai_skpd($id_pegawai = FALSE, $data_pegawai_skpd = FALSE) {
        $id_pegawai_skpd = FALSE;
        if ($id_pegawai && $data_pegawai_skpd &&
                is_array($data_pegawai_skpd) &&
                array_key_exists('id_skpd', $data_pegawai_skpd)) {

            foreach (array_keys($this->attribute_labels) as $attribute_name) {
                if (array_key_exists($attribute_name, $data_pegawai_skpd)) {
                    $this->{$attribute_name} = $data_pegawai_skpd[$attribute_name];
                }
            }

            $this->id_pegawai = $id_pegawai;
            $this->is_active = 1;

            $id_pegawai_skpd = $this->save();
        }
        return $id_pegawai_skpd;
    }

    public function all($id_pegawai = FALSE, $force_limit = FALSE, $force_offset = FALSE) {

        $this->db->where($this->table_name . ".id_pegawai = '" . $id_pegawai . "'");

        return parent::get_all(array(
                    "nama_skpd",
                    "abbr_skpd",
                    "alamat_skpd",
                    "kodepos",
                    "no_telp",
                    "email",
                    "website",
                    "jabatan",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

}

?>