<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_pasukan_detail.php";

class model_tr_pasukan_detail extends tr_pasukan_detail {

    public function __construct() {
        parent::__construct();
    }

    protected $rules = array(
        array("id_rekap", "required"),
        array("id_satminkal", "required"),
        array("id_pangkat", "required"),
        array("top", ""),
        array("dinas", ""),
        array("mpp", "required"),
        array("lf", ""),
        array("skorsing", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );

    public function save_records($id_rekap, $response_data) {
        if ($response_data["form_format"] && $response_data["read_data"]) {
            if ($id_rekap !== FALSE) {
                $this->db->delete($this->table_name, "id_rekap = " . $id_rekap);
            }
            if (!empty($response_data["data"])) {
                foreach ($response_data["data"] as $satuan_satminkal => $array_data_satuan) {
                    $this->save_per_satminkal($id_rekap, $satuan_satminkal, $array_data_satuan);
                }
            }
//            exit();
        }
    }

    public function save_per_satminkal($id_rekap, $satuan_satminkal, $array_data_satuan) {
        if (is_array($array_data_satuan) && !empty($array_data_satuan)) {
            $detail_satminkal = $this->model_master_satminkal->get_id_by_uraian(strtolower($satuan_satminkal));
//            var_dump($satuan_satminkal, $detail_satminkal);
            if ($detail_satminkal) {
                foreach ($array_data_satuan as $nama_pangkat => $array_jumlah) {
                    $this->save_per_pangkat($id_rekap, $detail_satminkal->id_satminkal, $nama_pangkat, $array_jumlah);
                }
            }
            unset($detail_satuan);
        }
    }

    public function save_per_pangkat($id_rekap, $id_satminkal, $nama_pangkat, $array_jumlah) {
        $detail_pangkat = $this->model_master_pangkat->get_detail_by_nama_pangkat(strtolower($nama_pangkat));
        if ($detail_pangkat && !empty($array_jumlah)) {
            $data = array(
                "id_rekap" => $id_rekap,
                "id_satminkal" => $id_satminkal,
                "id_pangkat" => $detail_pangkat->id_pangkat,
                "top" => $array_jumlah["top"],
                "dinas" => $array_jumlah["dinas"],
                "mpp" => $array_jumlah["mpp"],
                "lf" => $array_jumlah["lf"],
                "skorsing" => $array_jumlah["skorsing"],
                "created_date" => date('Y-m-d'),
                "created_by" => ""
            );
//            var_dump($data);
            $this->db->insert($this->table_name, $data);
        }
        unset($detail_pangkat);
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "id_detail",
                    "id_rekap",
                    "id_pangkat",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_data($id_rekap = FALSE) {
        $result = FALSE;
        if ($id_rekap) {
            $this->db->where($this->table_name . ".id_rekap", $id_rekap, NULL, FALSE);
            $result = $this->get_all();
        }
        return $this->arrange_by_satminkal($result);
    }

    public function arrange_by_satminkal($records = FALSE) {
        $result = array();
        if ($records) {
            foreach ($records as $record) {
                $satminkal = $record->ur_satminkal;
                if (isset($result[$satminkal])) {
                    $result[$satminkal][] = $record;
                } else {
                    $result[$satminkal] = array($record);
                }
            }
        }
        return $result;
    }

}
