<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_pegawai_skpd_jabatan.php";

class model_tr_pegawai_skpd_jabatan extends Tr_pegawai_skpd_jabatan {

    protected $rules = array(
        array("id_pegawai_skpd_jabatan", ""),
        array("id_pegawai_skpd", "required|numeric"),
        array("id_eselon", "required|numeric"),
        array("id_jabatan", "required|numeric"),
        array("tmt_eselon", ""),
        array("is_active", "numeric"),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );

    public function __construct() {
        parent::__construct();
    }

    protected function after_get_data_post() {
        $this->__replace_blank_post_with_null(array("tmt_eselon"));
    }

    public function insert_pegawai_skpd_jabatan($id_pegawai_skpd = FALSE, $data_pegawai_skpd_jabatan = FALSE) {
        $id_pegawai_skpd_jabatan = FALSE;
        if ($id_pegawai_skpd && $data_pegawai_skpd_jabatan &&
                is_array($data_pegawai_skpd_jabatan) &&
                array_key_exists('id_jabatan', $data_pegawai_skpd_jabatan)) {

            foreach (array_keys($this->attribute_labels) as $attribute_name) {
                if (array_key_exists($attribute_name, $data_pegawai_skpd_jabatan)) {
                    $this->{$attribute_name} = $data_pegawai_skpd_jabatan[$attribute_name];
                }
            }

            $this->id_pegawai_skpd = $id_pegawai_skpd;
            $this->is_active = 1;

            $id_pegawai_skpd_jabatan = $this->save();
        }
        return $id_pegawai_skpd_jabatan;
    }

    public function all($id_pegawai = FALSE, $force_limit = FALSE, $force_offset = FALSE) {

//        $this->db->where($this->table_name . ".id_pegawai = '" . $id_pegawai . "'");
        $this->db->where("refpegskpd.id_pegawai = '" . $id_pegawai . "'");

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