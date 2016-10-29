<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/master_provinsi.php";

class Model_master_provinsi extends Master_provinsi {

    protected $rules = array(
        array("kode_provinsi", "required|min_length[3]"),
        array("nama_provinsi", "required|min_length[3]|max_length[300]"),
    );

    public function __construct() {
        parent::__construct();
    }
    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "nama_provinsi",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }
    
    public function get_like($keyword=FALSE){
        
        $result = FALSE;
        if($keyword){
            $this->db->order_by("kode_provinsi", "asc");
            $this->db->where(" lower(".$this->table_name.".nama_provinsi) LIKE lower('%".$keyword."%') OR lower(".$this->table_name.".kode_provinsi) LIKE lower('%".$keyword."%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
        
    }

}

?>