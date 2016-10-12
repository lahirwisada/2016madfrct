<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists("build_atlant_menu")) {

    function build_atlant_menu(array $array_menu = array(), $active_modul = "") {
        if (!empty($array_menu)) {
            $_menu = "";
            foreach ($array_menu as $top_parent => $menu) {
                $sub_url_location = $menu->turunan_dari == "sistem" ? "back_bone/" : "back_end/";
                $menu_uri = $sub_url_location . $menu->nama_modul;
                
                $active_class = "";
                if(strtolower(trim($menu->nama_modul)) == strtolower(trim($active_modul))){
                    $active_class = " active ";
                }
                
                $_menu_child = "";
                if (property_exists($menu, "child")) {
                    $_menu_child .= "<ul>";
                    $_menu_child .= build_atlant_menu($menu->child, $active_modul);
                    $_menu_child .= "</ul>";
                }
                
                $pos = strpos($_menu_child, "active");
                
                if($pos){
                    $active_class = " active ";
                }
                
                $active_class .= ($_menu_child == "" ? "" : "xn-openable");
                
                if($active_class != ""){
                    $active_class = "class=\"".$active_class."\"";
                }

                $_menu .= "<li " . $active_class . ">";
                $_open_tag_span_last_child = ($_menu_child == "" ? "" : "<span class=\"xn-text\">");
                $_close_tag_span_last_child = ($_menu_child == "" ? "" : "</span>");
                $_menu .= "<a href=\"" . ($_menu_child == "" ? base_url($menu_uri) : "#") . "\"><span class=\"fa fa-circle-o\"></span> " . $_open_tag_span_last_child . $menu->deskripsi_modul . $_close_tag_span_last_child . "</span></a>";
                $_menu .= $_menu_child;
                $_menu .= "</li>";
            }

            return $_menu;
        }
        return "";
    }

}