<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class master_kabupaten_kota extends MY_Model {

    public function __construct() {
        parent::__construct("master_kabupaten_kota");
        $this->primary_key = "";
    }

    protected $attribute_labels = array();
    protected $rules = array(
        
    );
    protected $related_tables = array();
    protected $attribute_types = array();

}

?>