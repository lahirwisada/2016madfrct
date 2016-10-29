<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/ref_golongan.php";

class model_ref_golongan extends ref_golongan {

    protected $rules = array(
        array("kode_golongan", "required|min_length[2]|max_length[300]|alpha_dash"),
        array("golongan", "required|min_length[3]"),
        array("keterangan", "min_length[3]"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        $this->db->order_by("id_golongan", "desc");
        return parent::get_all(array(
                    "kode_golongan",
                    "golongan",
                    "keterangan",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }
    
    public function get_like($keyword=FALSE){
        
        $result = FALSE;
        if($keyword){
            $this->db->order_by("kode_golongan", "asc");
            $this->db->where(" lower(".$this->table_name.".kode_golongan) LIKE lower('%".$keyword."%') OR lower(".$this->table_name.".golongan) LIKE lower('%".$keyword."%') OR lower(".$this->table_name.".keterangan) LIKE lower('%".$keyword."%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
        
    }
}

?>