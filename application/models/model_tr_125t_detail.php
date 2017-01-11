<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_f125t_detail.php";

class model_tr_125t_detail extends tr_f125t_detail {

    public function __construct() {
        parent::__construct();
    }

    protected $rules = array(
        array("id_f125t_detail", ""),
        array("id_f125t", ""),
        array("id_pangkat", ""),
        array("jumlah_secata", ""),
        array("jumlah_secaba", ""),
        array("jumlah_sesarcab", ""),
        array("jumlah_selapa_setingkat", ""),
        array("jumlah_sesko_angkatan_setingkat", ""),
        array("jumlah_sesko_tni", ""),
        array("jumlah_subtotal", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );

    public function save_records($id_form_detail, $response_data) {
        /**
         * 
          $response_data_125t = array(
          "form_format" => TRUE,
          "read_data" => TRUE,
          "data" => array()
          );
         */
        if ($response_data["form_format"] && $response_data["read_data"]) {

            if (!empty($response_data["data"])) {
                foreach ($response_data["data"] as $satuan_kotama => $array_data_satuan) {
                    $this->save_per_satuan($id_form_detail, $satuan_kotama, $array_data_satuan);
                }
            }
        }
    }

    private function save_per_kelompok_pangkat($id_form_detail, $id_kotama, $kode_pangkat, $array_jumlah = array()) {
        $detail_pangkat = $this->model_master_pangkat->get_detail_by_kode_pangkat(strtolower($kode_pangkat));
        if ($detail_pangkat && !empty($array_jumlah)) {
            $object_tr_125_detail = new model_tr_125t_detail();
            $object_tr_125_detail->id_pangkat = $detail_pangkat->id_pangkat;
            $object_tr_125_detail->id_f125t = $id_form_detail;
            foreach($array_jumlah as $key_field => $value){
                $object_tr_125_detail->{$key_field} = $value;
            }
            $object_tr_125_detail->save();
        }
        unset($detail_pangkat, $object_tr_125_detail);
    }

    public function save_per_satuan($id_form_detail, $satuan_kotama, $array_data_satuan = array()) {
        if (is_array($array_data_satuan) && !empty($array_data_satuan)) {
            $detail_satuan = $this->model_master_kotama->get_id_by_uraian($satuan_kotama);

            if ($detail_satuan) {
                foreach ($array_data_satuan as $kode_pangkat => $array_jumlah) {
                    $this->save_per_kelompok_pangkat($id_form_detail, $detail_satuan->id_kotama, $kode_pangkat, $array_jumlah);
                }
            }
            unset($detail_satuan);
        }
    }

}
