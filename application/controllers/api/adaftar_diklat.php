<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adaftar_diklat extends Api {

    public $model = 'model_tr_diklat';

    public function __construct() {
        parent::__construct('api_diklat', 'API Diklat');
        $this->load->model(array(
            'model_ref_kabupaten_kota',
            'model_ref_jenis_diklat',
            'model_tr_diklat_hal_perhatian',
            'model_tr_diklat_tahapan',
        ));
    }

    public function kalender_diklat($crypted_id_diklat = FALSE) {
        $detail_diklat = $this->model_tr_diklat->get_detail_by_crypted($crypted_id_diklat);
        var_dump($detail_diklat);exit;
    }

    public function load_kalender_diklat() {

        $this->model_tr_diklat->change_offset_param('currpage');
        $this->model_tr_diklat->change_limit_param('rowperpage');
        $records = $this->model_tr_diklat->all();
        $this->to_json(array('result' => $records->record_set,
            'rowcount' => $records->record_found,
            'currentpage' => $this->model_tr_diklat->get_current_offset_value(),
            'rowperpage' => $this->model_tr_diklat->get_current_limit_value()));
    }

}
