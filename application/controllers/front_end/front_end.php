<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Front_end extends Cpustaka_data {

    protected $auto_load_model = FALSE;

    public function __construct($cmodul_name = FALSE, $header_title = FALSE) {
        $this->is_front_end = TRUE;
        $this->_layout = 'atlant_frontend';
        parent::__construct($cmodul_name, $header_title);
        $this->init_front_end();
    }

    private function init_front_end() {
        $this->my_location = "front_end/";
    }

}
