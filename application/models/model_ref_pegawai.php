<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/ref_pegawai.php";

class model_ref_pegawai extends ref_pegawai {

    protected $rules = array(
        array("id_pegawai", ""),
        array("id_status_perkawinan", ""),
        array("gelar_depan", "max_length[20]|alpha_dash"),
        array("gelar_belakang", "max_length[100]|alpha_dash"),
        array("nama_depan", "required|max_length[60]|alpha_dash"),
        array("nama_tengah", "max_length[60]|alpha_dash"),
        array("nama_belakang", "max_length[60]|alpha_dash"),
        array("nama_sambung", "min_length[2]|max_length[200]|alpha_dash"),
        array("tgl_lahir", ""),
        array("tempat_lahir", "max_length[200]"),
        array("nip", "max_length[60]"),
        array("no_kep", "max_length[200]"),
        array("tmt_peg", ""),
    );

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "gelar_depan",
                    "gelar_belakang",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    private function __where_id_skpd($id_skpd = FALSE) {
        if ($id_skpd) {
            $table_pegawai_skpd = $this->get_schema_name("tr_pegawai_skpd");
            $this->db->where($table_pegawai_skpd . ".id_skpd = '" . $id_skpd . "'  ");
        }
    }

    private function __select_tr_pegawai_active_skpd() {
        $this->__join_tr_pegawai_active_skpd();
    }

    /**
     * don't use this function, you should use __join_tr_pegawai_active_skpd
     * 
     * @author Lahir Wisada <lahirwisada@gmail.com>
     * @see __join_tr_pegawai_active_skpd()
     */
    private function __join_tr_pegawai_skpd_ref_skpd($table_pegawai_skpd) {
        $table_skpd = $this->get_schema_name("ref_skpd");
        $this->db->join($table_skpd, $table_skpd . ".id_skpd = " . $table_pegawai_skpd . ".id_skpd");

        $this->db->select(
                $table_skpd . ".id_skpd, " .
                $table_skpd . ".nama_skpd, " .
                $table_skpd . ".abbr_skpd, " .
                $table_skpd . ".alamat_skpd, " .
                $table_skpd . ".kodepos, " .
                $table_skpd . ".no_telp, " .
                $table_skpd . ".email as email_skpd, " .
                $table_skpd . ".website as website_skpd ", FALSE
        );
    }

    private function __join_tr_pegawai_active_skpd() {
        $table_pegawai_skpd = $this->get_schema_name("tr_pegawai_skpd");
        $this->db->join($table_pegawai_skpd, $table_pegawai_skpd . ".id_pegawai = " . $this->table_name . ".id_pegawai AND " . $table_pegawai_skpd . ".is_active = '1'", "LEFT");
        $this->__join_tr_pegawai_skpd_ref_skpd($table_pegawai_skpd);
    }

    private function __remove_non_column_data($data = FALSE) {
        return remove_non_column_data($data, array(
            "id_skpd",
            "id_jabatan",
            "id_golongan",
        ));
    }

    protected function before_data_insert($insert_data = FALSE) {
        $insert_data['nama_sambung'] = produce_nama_sambung($insert_data["nama_depan"], $insert_data["nama_tengah"], $insert_data["nama_belakang"]);
        return $this->__remove_non_column_data($insert_data);
    }

    public function check_and_insert_pegawai_when_not_found($data_pegawai = FALSE) {
        $id_pegawai = FALSE;
        if ($data_pegawai && is_array($data_pegawai) && array_key_exists('nip', $data_pegawai)) {

            $pegawai_found = $this->get_detail($this->table_name . ".nip = '" . $data_pegawai["nip"] . "'");
            if ($pegawai_found) {
                $id_pegawai = $pegawai_found->id_pegawai;
                unset($pegawai_found);
            } else {
                foreach (array_keys($this->attribute_labels) as $attribute_name) {
                    if (array_key_exists($attribute_name, $data_pegawai)) {
                        $this->{$attribute_name} = $data_pegawai[$attribute_name];
                    }
                }

                $id_pegawai = $this->save();

                if ($id_pegawai) {

                    $this->__insert_to_related_table($id_pegawai, $data_pegawai);
                }
            }
        }
        return $id_pegawai;
    }

    private function __insert_to_related_table($id_pegawai, $data_pegawai) {
        $this->load->model(array('model_tr_pegawai_golongan', 'model_tr_pegawai_skpd', 'model_tr_pegawai_skpd_jabatan'));
        $id_pegawai_golongan = $this->model_tr_pegawai_golongan->insert_pegawai_golongan($id_pegawai, $data_pegawai);
        $id_pegawai_skpd = $this->model_tr_pegawai_skpd->insert_pegawai_skpd($id_pegawai, $data_pegawai);
        $id_pegawai_skpd_jabatan = FALSE;
        if ($id_pegawai_skpd) {
            $id_pegawai_skpd_jabatan = $this->model_tr_pegawai_skpd_jabatan->insert_pegawai_skpd_jabatan($id_pegawai_skpd, $data_pegawai);
        }
    }

    public function get_like($keyword = FALSE, $id_skpd = FALSE) {
        $result = FALSE;
        if ($keyword) {

            $id_skpd = $id_skpd == 'false' ? FALSE : $id_skpd;
            $this->__where_id_skpd($id_skpd);
            $this->__select_tr_pegawai_active_skpd();
            $this->select_field();

            $this->db->order_by("nip", "asc");
            $where_keyword = " ( lower(" . $this->table_name . ".nama_depan) LIKE lower('%" . $keyword . "%') OR " .
                    "lower(" . $this->table_name . ".nama_tengah) LIKE lower('%" . $keyword . "%') OR " .
                    "lower(" . $this->table_name . ".nama_belakang) LIKE lower('%" . $keyword . "%') OR " .
                    "lower(" . $this->table_name . ".nama_sambung) LIKE lower('%" . $keyword . "%') OR " .
                    "lower(" . $this->table_name . ".nip) LIKE lower('%" . $keyword . "%') ) ";
            $this->db->where($where_keyword, NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
    }

    protected function after_save($inserted_id_pegawai) {
        $this->__insert_to_related_table($inserted_id_pegawai, $this->attributes);
        $this->__create_username_for_this_pegawai($inserted_id_pegawai, $this->attributes);
        return;
    }

    private function __create_username_for_this_pegawai($inserted_id_pegawai, $data_pegawai) {
        $this->load->library(array('diklat/lib_peserta_diklat', 'lmanuser'));
        $this->load->model(array(
            "model_backbone_user",
            "model_backbone_profil",
            "model_backbone_user_role",
        ));

        list($username, $password) = $this->lib_peserta_diklat->generate_username_password_by_nip($data_pegawai["nip"], $data_pegawai["nama_depan"]);

        if ($username && $password) {
            $_password = $this->lmanuser->generate_password($username, $password);
            $model_user_attributes = array(
                "username" => $username,
                "password" => $_password,
                "nama_profil" => $data_pegawai["nama_depan"],
                "email_profil" => ""
            );

            /**
             * create user beradasarkan NIP dan nama
             */
            $this->model_backbone_user->set_userdata_from_model_user($model_user_attributes);
            $id_user = $this->model_backbone_user->save();

            $_POST['id_pegawai'] = $inserted_id_pegawai;

            /**
             * create profil pada back bone
             */
            $this->model_backbone_profil->set_userdata_from_model_user($model_user_attributes, $id_user);
            $this->model_backbone_profil->save();

            /**
             * berikan role untuk user PNS
             */
            $id_role_pegawai_negeri_sipil = $this->config->item("id_role_pegawai_negeri_sipil");

            if ($id_role_pegawai_negeri_sipil) {
                $this->model_backbone_user_role->save($id_user, $id_role_pegawai_negeri_sipil);
            }
        }
    }

    protected function after_get_data_post() {
        $this->id_status_perkawinan = !$this->id_status_perkawinan || is_null($this->id_status_perkawinan) ? 1 : $this->id_status_perkawinan;
    }

}

?>