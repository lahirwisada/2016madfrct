<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends Cpustaka_data {

    public function __construct($cmodul_name = FALSE, $header_title = FALSE) {
        $this->is_front_end = FALSE;
        parent::__construct($cmodul_name, $header_title);
        $this->_layout = "atlant";
        $this->my_location = "api/";
        $this->init_api();
    }
    
    public function can_access() {
        return TRUE;
    }

    private function init_api() {
        $this->set("controller_location", $this->my_location . $this->_name);
    }

}

?>