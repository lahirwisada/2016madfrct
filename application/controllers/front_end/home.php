<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends Front_end {

    public function __construct() {
        parent::__construct('lobi_sidika_front_end', 'Lobi Si Dika');
//        $this->load->model(array("model_ref_petak","model_ref_gambar_petak"));
//        $this->_layout = "backend";
    }

    public function index() {

        $this->set("additional_js", array(
            "front_end/" . $this->_name . "/js/calender_diklat_js",
            "front_end/" . $this->_name . "/js/index_js",
        ));

        $this->add_cssfiles(array("atlant_front_end/traditional_table.css"));
        $this->add_jsfiles(array(
            "plugins/lws/template/atlant/lws.grid.template.js",
            "plugins/lws/lws.pager.js",
            "plugins/lws/lws.master.form.js",
        ));
    }

}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */