<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lib_peserta_diklat
 *
 * @author nurfadillah
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class lib_peserta_diklat {

    public function __construct() {
        
    }

    /**
     * men generate password beradasarkan NIP
     * password akan dibuat dari acakan nip pegawai negeri sipil di kota tangerang selatan
     * contoh NIP adalah sbb : 1234567890abcdefgh
     * maka password adalah 1234567890abhgfedc
     * 
     * Aturan :
     * panjang NIP adalah 18 karakter
     * panjang password minimal 6 karakter
     * 
     * panjang Nama tidak diketahui
     * panjang Username minimal 6 karakter
     * 
     * akan mengembalikan nilai FALSE jika $nip dan $nama_depan kosong
     * 
     * @param string $nip
     * @param string $nama_depan
     * @return array array($username, $password) dalam hal ini $username adalah string dan password adalah string sebelum di encode
     */
    public function generate_username_password_by_nip($nip = "", $nama_depan = "") {
        if ($nip && $nama_depan && strlen($nip) == 18 && $nama_depan !== "") {
            $username = $this->generate_username_by_nama_depan($nip, $nama_depan);
            $password = $this->generate_password_by_nip($nip);
            return array($username, $password);
        }
        return FALSE;
    }
    
    private function generate_username_by_nama_depan($nip = "", $nama_depan = ""){
        $username = FALSE;
        $nama_depan = str_replace(" ", ".", trim($nama_depan));
        
        $len_nama_depan = is_string_not_empty($nama_depan);
        $prefix_username = $this->is_nip_not_empty($nip) ? substr($nip, 0, 8) : FALSE;
        if($len_nama_depan && $prefix_username){
            $username = $prefix_username.$nama_depan;
        }
        return $username;
    }
    
    public function is_nip_not_empty($nip = ""){
        if ($nip && strlen($nip) == 18) {
            return $nip;
        }
        return FALSE;
    }
    
    private function generate_password_by_nip($nip = ""){
        $password = FALSE;
        if ($this->is_nip_not_empty($nip)) {
            $prefix_nip = substr($nip, 0, -6);
            $postfix_nip = substr($nip, -6);
            $arr_post_fix_nip = str_split($postfix_nip);
            krsort($arr_post_fix_nip);
            $postfix_nip = implode("", $arr_post_fix_nip);
            $password = $prefix_nip . $postfix_nip;
            unset($prefix_nip, $postfix_nip, $arr_post_fix_nip);
        }
        return $password;
    }

}
