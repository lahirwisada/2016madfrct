<?php
class model_upload extends CI_Model {

    var $tabel = 'transaksi_upload';

    function __construct() {
        parent::__construct();
    }
    
    //fungsi untuk menampilkan semua data dari tabel database
 function get_allexcel() {
        $this->db->from($this->tabel);
  $query = $this->db->get();
        return $query->result();
 }

    //fungsi insert ke database
    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }

}

?>