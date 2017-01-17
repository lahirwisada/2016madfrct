<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_f126t_detail.php";

class model_tr_126t_detail extends tr_f126t_detail {

    public function __construct() {
        parent::__construct();
    }

    protected $rules = array(
        array("id_f126t_detail", ""),
        array("id_formulir", ""),
        array("id_kotama", ""),
        array("id_pangkat", ""),
        array("jumlah_sd", ""),
        array("jumlah_sltp", ""),
        array("jumlah_slta", ""),
        array("jumlah_d1", ""),
        array("jumlah_d2", ""),
        array("jumlah_d3", ""),
        array("jumlah_d4", ""),
        array("jumlah_s1", ""),
        array("jumlah_s2", ""),
        array("jumlah_s3", ""),
//        array("jumlah_subtotal", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );

    public function save_records($id_form_detail, $response_data) {
        /**
         * 
          $response_data_126t = array(
          "form_format" => TRUE,
          "read_data" => TRUE,
          "data" => array()
          );
         */
        if ($response_data["form_format"] && $response_data["read_data"]) {
            if (!empty($response_data["data"])) {
//                var_dump($response_data["data"]);exit();
                foreach ($response_data["data"] as $satuan_kotama => $array_data_satuan) {
                    $this->save_per_satuan($id_form_detail, $satuan_kotama, $array_data_satuan);
                }
            }
        }
    }

    private function save_per_kelompok_pangkat($id_form_detail, $id_kotama, $kode_pangkat, $array_jumlah = array()) {
        $detail_pangkat = $this->model_master_pangkat->get_detail_by_kode_pangkat(strtolower($kode_pangkat));
        if ($detail_pangkat && !empty($array_jumlah)) {
            $object_tr_126_detail = new model_tr_126t_detail();
            $object_tr_126_detail->id_formulir = $id_form_detail;
            $object_tr_126_detail->id_kotama = $id_kotama;
            $object_tr_126_detail->id_pangkat = $detail_pangkat->id_pangkat;
            foreach ($array_jumlah as $key_field => $value) {
                $object_tr_126_detail->{$key_field} = $value;
            }
//            var_dump($object_tr_126_detail);exit();
            $object_tr_126_detail->save();
        }
        unset($detail_pangkat, $object_tr_126_detail);
    }

    public function save_per_satuan($id_form_detail, $satuan_kotama, $array_data_satuan = array()) {
        if (is_array($array_data_satuan) && !empty($array_data_satuan)) {
            $detail_satuan = $this->model_master_kotama->get_id_by_uraian(strtolower($satuan_kotama));
            if ($detail_satuan) {
                foreach ($array_data_satuan as $kode_pangkat => $array_jumlah) {
                    $this->save_per_kelompok_pangkat($id_form_detail, $detail_satuan->id_kotama, $kode_pangkat, $array_jumlah);
                }
            }
            unset($detail_satuan);
        }
    }

    public function all() {
        return parent::get_all(array(
                    "ur_pangkat",
                        ), FALSE, TRUE, TRUE, 1, TRUE);
    }

    public function arrange_by_kotama($records = FALSE) {
        $result = array();
        if ($records) {
            foreach ($records as $record) {
                $kotama = $record->det_ur_kotama;
                if (isset($result[$kotama])) {
                    $result[$kotama][] = $record;
                } else {
                    $result[$kotama] = array($record);
                }
            }
        }
//        var_dump($result);exit();
        return $result;
    }

    public function get_data($id_formulir = FALSE) {
        $result = FALSE;
        if ($id_formulir) {
            $this->db->where($this->table_name . ".id_formulir", $id_formulir, NULL, FALSE);
            $result = $this->get_all();
        }
//        var_dump($result);exit();
        return $this->arrange_by_kotama($result);
    }

}
