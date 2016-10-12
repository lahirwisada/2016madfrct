<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('produce_nama_sambung')) {

    function produce_nama_sambung($nama_depan = "", $nama_tengah = "", $nama_belakang = "") {
        $arr_nama_sambung = array($nama_depan, $nama_tengah, $nama_belakang);
        foreach ($arr_nama_sambung as $key => $nama) {
            if (trim($nama) == '') {
                unset($arr_nama_sambung[$key]);
            }
        }
        $nama_sambung = implode(" ", $arr_nama_sambung);
        unset($arr_nama_sambung);
        return $nama_sambung;
    }

}

