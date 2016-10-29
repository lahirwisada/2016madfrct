<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class tbl_user extends LWS_model {

    public function __construct() {
        parent::__construct("tbl_user");
        $this->primary_key = "is_user";
    }

    protected $attribute_labels = array(
        "id_user_type" => "User Type",
        "fb_id" => "Facebook Id",
        "fb_email" => "Facebook Email",
        "name" => "Nama",
        "email" => "Email",
        "is_active" => "Aktif",
        "registered_on" => "",
        "last_login_on" => "",
        "created_date" => "",
        "created_by" => "",
        "modified_date" => "",
        "modified_by" => "",
        "record_active" => "",
    );
    protected $rules = array(
        array("id_user_type", ""),
        array("fb_id", ""),
        array("fb_email", ""),
        array("name", ""),
        array("email", ""),
        array("is_active", ""),
        array("registered_on", ""),
        array("last_login_on", ""),
        array("created_date", ""),
        array("created_by", ""),
        array("modified_date", ""),
        array("modified_by", ""),
        array("record_active", ""),
    );

}
