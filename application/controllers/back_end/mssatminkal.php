<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mssatminkal extends Back_end {

    public $model = 'model_master_satminkal';

    public function __construct() {
        parent::__construct('kelola_pustaka_satminkal', 'Master Satminkal');
        $this->load->model(array('model_master_kotama', 'model_master_kesatuan', 'model_master_corps'));
    }

    public function index() {
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = FALSE) {
        parent::detail($id, array("id_kotama", "kode_satminkal", "ur_satminkal", "id_kesatuan", "id_corps", "operasional", "babinsa"));
        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Detail ' . $this->_header_title
        ));
        $this->set("kotama", $this->model_master_kotama->get_all());
        $this->set("kesatuan", $this->model_master_kesatuan->get_all());
        $this->set("corps", $this->model_master_corps->get_all());
        $this->set("additional_js", "back_end/" . $this->_name . "/js/detail_js");
//        $this->add_cssfiles(array("plugins/select2/select2.min.css"));
//        $this->add_jsfiles(array("plugins/select2/select2.full.min.js"));
    }

    public function get_like() {
        $keyword = $this->input->post("keyword");
        $satminkal_found = $this->model_master_satminkal->get_like($keyword);
        $this->to_json($satminkal_found);
    }

}

?>