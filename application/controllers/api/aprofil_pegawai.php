<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aprofil_pegawai extends Api {

    public $model = 'model_ref_pegawai';

    public function __construct() {
        parent::__construct('api_profil_pegawai', 'API Profil Pegawai');
    }

    public function update_profil($id_pegawai = FALSE) {

        if ($this->{$this->model}->get_data_post(FALSE, array("npwp"))) {
            
        }
        
        $this->to_json(array('result' => $records->record_set,
            'rowcount' => $records->record_found,
            'currentpage' => $this->model_tr_diklat->get_current_offset_value(),
            'rowperpage' => $this->model_tr_diklat->get_current_limit_value()));
    }

}
