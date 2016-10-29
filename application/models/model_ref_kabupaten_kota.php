<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/ref_kabupaten_kota.php";

class model_ref_kabupaten_kota extends ref_kabupaten_kota {

    protected $rules = array(
        array("id_provinsi", "required|numeric"),
        array("kode_kabupaten", "required|min_length[1]|max_length[30]"),
        array("nama_kabupaten", "required|min_length[1]|max_length[200]"),
        array("is_ibukota", "numeric"),
        array("keterangan", ""),
    );

    public function __construct() {
        parent::__construct();
    }
    
    protected function before_get_data_post() {
        if(!empty($_POST) && !array_key_exists("is_ibukota", $_POST)){
            $_POST["is_ibukota"] = "0";
        }
        if(!empty($_POST) && array_key_exists("is_ibukota", $_POST)){
            $_POST["is_ibukota"] = "1";
        }
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "kode_kabupaten",
                    "nama_provinsi",
                    "nama_kabupaten",
                    "keterangan",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }
    
    public function get_like($keyword=FALSE){
        
        $result = FALSE;
        if($keyword){
            $this->db->order_by("kode_kabupaten", "asc");
            $this->db->where(" lower(".$this->table_name.".nama_kabupaten) LIKE lower('%".$keyword."%') OR lower(".$this->table_name.".kode_kabupaten) LIKE lower('%".$keyword."%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
        
    }
}

?>