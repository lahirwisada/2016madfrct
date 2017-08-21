<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mssatminkal extends Back_end {

    public $model = 'model_master_satminkal';

    public function __construct() {
        parent::__construct('kelola_pustaka_satminkal', 'Pustaka Data Satminkal');
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = FALSE) {
        parent::detail($id, array("id_kotama", "kode_satminkal", "ur_satminkal", "id_kesatuan", "id_corps"));
        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Pendaftaran ' . $this->_header_title
        ));

        $this->set("additional_js", "back_end/" . $this->_name . "/js/detail_js");
        $this->add_cssfiles(array("plugins/select2/select2.min.css"));
        $this->add_jsfiles(array("plugins/select2/select2.full.min.js"));
    }

    public function get_like() {
        $keyword = $this->input->post("keyword");
        $satminkal_found = $this->model_master_satminkal->get_like($keyword);
        $this->to_json($satminkal_found);
    }

}

?>