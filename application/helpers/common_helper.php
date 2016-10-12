<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!function_exists("build_backend_menu")) {

    function build_backend_menu(array $array_menu = array()) {
        if (!empty($array_menu)) {
            $_menu = "";
            foreach ($array_menu as $menu) {
                $menu_uri = "back_end/" . $menu->nama_modul;
                $_menu_child = "";
                if (property_exists($menu, "child")) {
                    $_menu_child .= "<ul class=\"dropdown-menu\">";
                    $_menu_child .= build_backend_menu($menu->child);
                    $_menu_child .= "</ul>";
                }

                $_menu .= "<li id=\"li-" . $menu->nama_modul . "\"  class=\"" . ($_menu_child == "" ? "" : "dropdown") . "\"><a href=\"" . ($_menu_child == "" ? base_url($menu_uri) : "#") . "\" " . ($_menu_child == "" ? "" : "class=\"dropdown-toggle\" data-toggle=\"dropdown\"") . "><i class=\"fa \"></i><span>" . $menu->deskripsi_modul . "</span></a>";
                $_menu .= $_menu_child;
                $_menu .= "</li>";
            }
            return $_menu;
        }
        return "";
    }

}

if (!function_exists("show_tipe_kontrak")) {

    function show_tipe_kontrak($tipe_kontrak = FALSE) {

        if ($tipe_kontrak == 1) {
            return "Harian";
        } elseif ($tipe_kontrak == 2) {
            return "Mingguan";
        } elseif ($tipe_kontrak == 3) {
            return "Bulanan";
        }
        return "";
    }

}

if (!function_exists('convert_bool_to_word')) {

    function convert_bool_to_word($bool = NULL, $type = 'bool') {
        if ($bool != NULL && strtolower($bool) != "null") {

            switch ($type) {
                case 'sex': {
                        $the_false = 'sex_female';
                        $the_true = 'sex_male';
                        break;
                    }
                case 'marriage': {
                        $the_false = 'marriage_single';
                        $the_true = 'marriage_married';
                        break;
                    }
                default: {
                        $the_true = 'bool_yes';
                        $the_false = 'bool_no';
                        break;
                    }
            }
            return ($bool) ? t('common_' . $the_true, 'common') : t('common_' . $the_false, 'common');
        }
        return "";
    }

}


if(!function_exists('read_fasilitas_inti_petak')){
    function read_fasilitas_inti_petak($array_fasilitas=array("tidak_ada"=>"1"), $implode_glue = ", "){
        $fasilitas = array();
        foreach($array_fasilitas as $nama_fasilitas => $bool_ada){
            if($bool_ada){
                $fasilitas[] = beautify_str($nama_fasilitas);
            }
        }
        return implode($implode_glue,$fasilitas);
    }
}
?>
