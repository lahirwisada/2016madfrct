<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_diklat.php";

class model_tr_diklat extends tr_diklat {

    protected $rules = array(
        array("id_diklat", ""),
        array("id_kabupaten_kota", "numeric"),
        array("id_jenis_diklat", "numeric|required"),
        array("nama_diklat", "required|max_length[200]"),
        array("angkatan", "required|max_length[20]"),
        array("alamat_lokasi", "required|max_length[500]"),
        array("penyelenggara", "required|max_length[500]"),
        array("tgl_pelaksanaan", ""),
        array("tgl_selesai", ""),
        array("total_jam", "required|numeric"),
        array("postfix_no_sttpp", "required|max_length[60]"),
        array("no_spt_a", "numeric|max_length[60]"),
        array("no_spt_b", "numeric|max_length[60]"),
        array("no_spt_c", "max_length[60]"),
        array("no_spt_d", "max_length[60]"),
        array("tgl_spt", ""),
        array("spt_tembusan", ""),
        array("spt_dasar", ""),
        array("spt_kepada", ""),
        array("id_ref_ttd", ""),
        array("tgl_sttpp", ""),
        array("id_ref_ttd_sttpp", ""),
        array("kuota_diklat", "required|numeric"),
        array("kuota_tersedia", "numeric"),
        array("peserta_terdaftar", "numeric"),
        array("jumlah_waiting_list", "required|numeric"),
        array("is_registration_closed", "required|numeric"),
    );

    public function __construct() {
        parent::__construct();
    }

    protected function before__get_all() {
        $this->db->order_by("id_diklat", "desc");
        $this->db->order_by("tgl_pelaksanaan", "desc");
    }

    private function __convert_to_pg_array() {
        $post_check = array(
            "spt_dasar",
            "spt_tembusan",
            "spt_hal_perhatian",
        );

        foreach ($post_check as $post_key) {
            $posted_data = $this->input->post($post_key);
            if (!$posted_data) {
                $_POST[$post_key] = NULL;
            } else {
                $_POST[$post_key] = to_pg_array($this->input->post($post_key));
            }
        }
    }

    protected function before_get_data_post() {
        $post_check = array(
            "id_kabupaten_kota",
            "id_ref_ttd",
            "id_ref_ttd_sttpp",
        );

        foreach ($post_check as $post_key) {
            $posted_data = $this->input->post($post_key);
            if (!$posted_data) {
                $_POST[$post_key] = NULL;
            }
        }
        $this->__convert_to_pg_array();
    }

    private function __check_blank_post() {
        $post_null_check = array(
            "tgl_pelaksanaan",
            "tgl_selesai",
            "tgl_spt",
            "tgl_sttpp",
        );

        foreach ($post_null_check as $null_post) {
            if ($this->{$null_post} == "") {
                $this->{$null_post} = "NULL";
            } else {
                $this->{$null_post} = "'" . $this->{$null_post} . "'";
            }
        }
    }

    private function __check_array_post() {
        $post_null_check = array(
            "spt_tembusan",
            "spt_dasar",
            "spt_hal_perhatian",
            "spt_tahapan",
        );

        foreach ($post_null_check as $null_post) {
            if ($this->{$null_post} == "") {
                $this->{$null_post} = NULL;
            }
        }
    }

    private function __check_numeric_post() {
        $post_numeric_check = array(
            "id_kabupaten_kota",
            "id_ref_ttd",
            "id_ref_ttd_sttpp",
        );

        foreach ($post_numeric_check as $numeric_post) {
            if ($this->{$numeric_post} == NULL) {
                $this->{$numeric_post} = 0;
            }
        }
    }

    protected function after_get_data_post() {
        $this->__check_numeric_post();
        $this->__check_blank_post();
        $this->__check_array_post();
    }

    protected function after_save($ret = FALSE) {
        if ($ret) {
            $this->model_tr_diklat_tahapan->save_collection($this->spt_tahapan, $this->inserted_id);
            $this->model_tr_diklat_hal_perhatian->save_collection($this->spt_hal_perhatian, $this->inserted_id);
            $this->model_tr_diklat_persyaratan->save_collection($this->persyaratan_diklat, $this->inserted_id);
        }

        return $ret;
    }

    private function __remove_non_column_data($data = FALSE) {
        if ($data) {
            unset($data["spt_tahapan"]);
            unset($data["spt_hal_perhatian"]);
            unset($data["persyaratan_diklat"]);
        }
        return $data;
    }

    private function __remove_null_data($data = FALSE) {

        if ($data) {
            foreach ($data as $key => $val) {
                if ($val == NULL || $val == 'NULL') {
                    unset($data[$key]);
                }
            }
        }
        return $data;
    }

    protected function before_data_update($update_data = FALSE) {
        $update_data = $this->__remove_non_column_data($update_data);
        return $this->__remove_null_data($update_data);
    }

    protected function before_data_insert($insert_data = FALSE) {
        $insert_data = $this->__remove_non_column_data($insert_data);
        return $this->__remove_null_data($insert_data);
    }

    public function get_tahapan_diklat_by_id_diklat($id_diklat = FALSE) {
        if ($id_diklat) {
            $tr_diklat_tahapan_table_name = $this->model_tr_diklat_tahapan->get_table_name();
            return $this->model_tr_diklat_tahapan->get_all(array(), $tr_diklat_tahapan_table_name . ".id_diklat = '" . $id_diklat . "'", FALSE);
        }
        return FALSE;
    }

    public function get_diklat_hal_perhatian_by_id_diklat($id_diklat = FALSE) {
        if ($id_diklat) {
            $tr_diklat_hal_perhatian_table_name = $this->model_tr_diklat_hal_perhatian->get_table_name();
            return $this->model_tr_diklat_hal_perhatian->get_all(array(), $tr_diklat_hal_perhatian_table_name . ".id_diklat = '" . $id_diklat . "'", FALSE);
        }
        return FALSE;
    }

    public function get_diklat_persyaratan_by_id_diklat($id_diklat = FALSE) {
        if ($id_diklat) {
            $tr_diklat_persyaratan_table_name = $this->model_tr_diklat_persyaratan->get_table_name();
            return $this->model_tr_diklat_persyaratan->get_all(array(), $tr_diklat_persyaratan_table_name . ".id_diklat = '" . $id_diklat . "'", FALSE);
        }
        return FALSE;
    }

    public function after_show_detail($record_found = FALSE) {
        $array_check = array(
            "spt_tembusan",
            "spt_dasar",
        );

        foreach ($array_check as $array_data) {
            if ($record_found && $record_found->{$array_data} != NULL) {
                pg_array_parse($record_found->{$array_data}, $record_found->{$array_data});
            }
        }

        if ($record_found) {
            $record_found->tahapan_diklat = $this->get_tahapan_diklat_by_id_diklat($record_found->id_diklat);
            $record_found->hal_perhatian = $this->get_diklat_hal_perhatian_by_id_diklat($record_found->id_diklat);
            $record_found->persyaratan_diklat = $this->get_diklat_persyaratan_by_id_diklat($record_found->id_diklat);
        }

        return $record_found;
    }

    public function get_id_by_crypted($crypted_id_diklat = FALSE) {
        $id_found = FALSE;
        if ($crypted_id_diklat) {
            $detail_found = $this->get_detail_by_crypted($crypted_id_diklat);
            if ($detail_found) {
                $id_found = $detail_found->id_diklat;
            }
            unset($detail_found);
        }
        return $id_found;
    }

    public function get_detail_by_crypted($crypted_id_diklat = FALSE) {
        if ($crypted_id_diklat) {
            return $this->get_detail($this->table_name . ".id_diklat_crypted = '" . $crypted_id_diklat . "'");
        }
        return FALSE;
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "nama_diklat",
                    "angkatan",
                    "alamat_lokasi",
                    "penyelenggara",
                    "tgl_pelaksanaan",
                    "tgl_selesai",
                    "total_jam",
                    "postfix_no_sttpp",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

}