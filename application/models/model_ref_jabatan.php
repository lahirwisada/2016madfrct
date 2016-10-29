<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/ref_jabatan.php";

class model_ref_jabatan extends ref_jabatan {

    protected $rules = array(
        array("jabatan", "required|min_length[1]|max_length[200]"),
        array("keterangan", ""),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "jabatan",
                    "keterangan",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }
    
    public function get_like($keyword=FALSE){
        
        $result = FALSE;
        if($keyword){
            $this->db->order_by("jabatan", "asc");
            $this->db->where(" lower(".$this->table_name.".jabatan) LIKE lower('%".$keyword."%') OR lower(".$this->table_name.".keterangan) LIKE lower('%".$keyword."%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
        
    }
}

?>