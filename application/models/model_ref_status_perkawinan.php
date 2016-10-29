<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/ref_provinsi.php";

class model_ref_status_perkawinan extends ref_provinsi {
    
    protected $rules = array(
        array("id_status_perkawinan", ""),
        array("status_perkawinan", "required|min_length[1]|max_length[150]"),
        array("kode_status_perkawinan", "min_length[1]|max_length[150]"),
        array("keyword", "max_length[1000]"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "status_perkawinan",
                    "kode_status_perkawinan",
                    "keyword",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }
    
    public function get_like($keyword=FALSE){
        
        $result = FALSE;
        if($keyword){
            $this->db->order_by("status_perkawinan", "asc");
            $this->db->where(" lower(".$this->table_name.".status_perkawinan) LIKE lower('%".$keyword."%') OR lower(".$this->table_name.".kode_status_perkawinan) LIKE lower('%".$keyword."%') OR lower(".$this->table_name.".keyword) LIKE lower('%".$keyword."%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
        
    }
}

?>