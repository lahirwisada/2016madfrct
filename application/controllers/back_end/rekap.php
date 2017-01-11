<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rekap sdl Satu Dua Lima T
 *
 * @author nurfadillah
 */
class Rekap extends Base_rekap {

    public $model = 'model_tr_125t';
    public $jenis_formulir_rekap = '125t';
    
    //put your code here
    public function __construct() {
        parent::__construct('modul_rekap', 'Rekap 125 T');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = FALSE) {
        parent::detail($id, array(
            "id_triwulan",
            "tanggal_upload",
            "tanggal_ttd",
            "uraian_atas_ttd",
            "jabatan_ttd",
            "nama_ttd",
            "pangkat_ttd",
            "nrp_ttd",
        ));

        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Pendaftaran ' . $this->_header_title
        ));

        $this->set("additional_js", "back_end/" . $this->_name . "/js/detail_js");
        $this->add_cssfiles(array("plugins/select2/select2.min.css"));
        $this->add_jsfiles(array("plugins/select2/select2.full.min.js"));
//        $this->add_jsfiles(array("avant/plugins/form-jasnyupload/fileinput.min.js"));
    }

}
