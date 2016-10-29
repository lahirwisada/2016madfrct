<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/ref_provinsi.php";

class model_ref_provinsi extends ref_provinsi {

    protected $rules = array(
        array("kode_provinsi", "required|min_length[1]|max_length[30]"),
        array("nama_provinsi", "required|min_length[1]|max_length[200]"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "kode_provinsi",
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