<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/tr_peserta_diklat.php";

class model_tr_peserta_diklat extends Tr_peserta_diklat {

    protected $rules = array(
        array("id_peserta_diklat", ""),
        array("id_diklat", "numeric"),
        array("id_pegawai", "numeric"),
        array("id_skpd", "required|numeric"),
        array("id_jabatan", "required|numeric"),
        array("id_golongan", "required|numeric"),
        array("nomor_peserta", "numeric"),
        array("surat_konfirmasi_ok", "numeric"),
        array("path_scan_surat_konfirmasi", ""),
    );
    public $upload_rule = array(
        "upload_path" => "",
        "allowed_types" => "xlsx|xls"
    );
    public $col_map = array(
        "B" => "gelar_depan",
        "C" => "nama_depan",
        "D" => "nama_tengah",
        "E" => "nama_belakang",
        "F" => "gelar_belakang",
        "G" => "nip",
        "H" => "tgl_lahir",
        "I" => "jabatan",
        "J" => "tmt_eselon",
        "K" => "nama_skpd",
        "L" => "golongan",
        "M" => "masa_kerja_jabatan_tahun",
        "N" => "masa_kerja_jabatan_bulan",
        "O" => "kode_eselon",
        "P" => "kode_tingkat_pendidikan",
    );
    public $searchable_fields = array(
        "nama_diklat",
        "angkatan",
        "alamat_lokasi",
        "penyelenggara",
        "tgl_pelaksanaan",
        "tgl_selesai",
        "total_jam",
        "gelar_depan",
        "gelar_belakang",
        "nama_depan",
        "nama_tengah",
        "nama_belakang",
        "nama_sambung",
        "tgl_lahir",
        "tempat_lahir",
        "nip",
        "no_kep",
        "tmt_peg",
        "status_perkawinan",
        "kode_status_perkawinan",
        "tgl_ditetapkan",
        "tgl_berakhir",
        "kode_golongan",
        "golongan",
        "keterangan",
    );

    public function __construct() {
        parent::__construct();
    }

    private function __check_blank_post() {
        $post_null_check = array(
            "tgl_lahir",
        );

        foreach ($post_null_check as $null_post) {
            if ($this->{$null_post} == "") {
                $this->{$null_post} = "NULL";
            } else {
                $this->{$null_post} = "'" . $this->{$null_post} . "'";
            }
        }
    }

    protected function after_get_data_post() {
        $this->__check_blank_post();
//        var_dump($this->attributes);exit;
    }

    private function __remove_non_column_data($data = FALSE) {
        if ($data) {
            $array_key_to_unset = array(
                "nip",
                "no_kep",
                "gelar_depan",
                "nama_depan",
                "nama_tengah",
                "nama_sambung",
                "nama_belakang",
                "gelar_belakang",
                "tempat_lahir",
                "tgl_lahir",
            );

            foreach ($array_key_to_unset as $key_to_unset) {
                if (array_key_exists($key_to_unset, $data)) {
                    unset($data[$key_to_unset]);
                }
            }
        }
        return $data;
    }

    protected function before_data_update($update_data = FALSE) {
        return $this->__remove_non_column_data($update_data);
    }

    private function __produce_nama_sambung($nama_depan = "", $nama_tengah = "", $nama_belakang = "") {
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

    protected function before_data_insert($insert_data = FALSE) {
        $this->load->model('model_ref_pegawai');
        $insert_data['nama_sambung'] = $this->__produce_nama_sambung($insert_data["nama_depan"], $insert_data["nama_tengah"], $insert_data["nama_belakang"]);
        $insert_data['nip'] = $this->clean_nip($insert_data['nip']);
        $id_pegawai = $this->model_ref_pegawai->check_and_insert_pegawai_when_not_found($insert_data);
        $insert_data['id_pegawai'] = $id_pegawai;

        return $this->__remove_non_column_data($insert_data);
    }

    protected function before_get_data_post() {
        
    }

    public function all_without_paging($id_diklat = FALSE, $id_pegawai = FALSE) {
        $this->db->where($this->table_name . ".id_diklat = '" . $id_diklat . "'");

        if ($id_pegawai) {
            $this->db->where($this->table_name . ".id_pegawai = '" . $id_pegawai . "'");
        }

        return parent::get_all(array(), FALSE, FALSE, TRUE, 1, TRUE);
    }

    public function all($id_diklat = FALSE, $force_limit = FALSE, $force_offset = FALSE) {

        $this->db->where($this->table_name . ".id_diklat = '" . $id_diklat . "'");

        return parent::get_all($this->searchable_fields, FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    /**
     * lihat upload_data untuk mengetahui nilai balik fungsi upload_data
     * @param type $username
     * @param type $upload_type
     * @param type $detail_application
     * @param type $input_name
     * @return boolean
     */
    private function _upload_file($id_diklat = FALSE, $upload_type = FALSE, $detail_application = FALSE, $input_name = FALSE) {
        $file_posted_ok = FALSE;
        $response = array(
            "success_upload" => FALSE,
            "upload_data_response" => FALSE,
            "message" => "Upload gagal dilakukan.",
            "file_uploaded" => "",
        );
        if ($id_diklat && $input_name &&
                $detail_application && $upload_type !== FALSE &&
                is_array($this->upload_rule) && !empty($this->upload_rule)) {
            $upload_location = get_upload_location("diklat/" . $id_diklat);
//            var_dump($upload_location);exit;
            if ($upload_location) {
                $cfg = $this->upload_rule;
                $cfg["upload_path"] = $upload_location;
                $cfg["ignore_mime_check"] = TRUE;
                $response["upload_data_response"] = upload_data($input_name, $cfg, $id_diklat, TRUE);
                $response["message"] = $response["upload_data_response"]["message"];
                $response["success_upload"] = !$response["upload_data_response"]["uploadfailed"];
                if (!$response["upload_data_response"]["uploadfailed"]) {
                    $response["file_uploaded"] = $upload_location . "/" . $response["upload_data_response"]["file_name_uploaded"];
                }
            } else {
                $response["message"].="<br />Lokasi tidak dikenali.";
            }
        }
        return $response;
    }

    public function upload_file($id_diklat = FALSE, $upload_type = FALSE, $detail_application = FALSE, $input_name = FALSE) {
        $response = FALSE;
        if ($id_diklat && $input_name && $detail_application && $upload_type !== FALSE) {
            $response = array();
            if (is_array($input_name)) {
                foreach ($input_name as $_input_name) {
                    $response[] = $this->_upload_file($id_diklat, $upload_type, $detail_application, $_input_name);
                }
            } else {
                $response[] = $this->_upload_file($id_diklat, $upload_type, $detail_application, $input_name);
            }
        }
        return $response;
    }

    public function clean_nip($nip) {
        return str_replace(".", "", str_replace(" ", "", $nip));
    }

    public function save_from_excel($id_diklat, $record_found, $timpa = FALSE) {
        $this->load->model(array('model_ref_golongan', 'model_ref_jabatan', 'model_ref_skpd'));

        if ($timpa) {
            $this->remove_by_foreign_key($id_diklat, "id_diklat");
        }

        foreach ($record_found as $key => $record) {
            $this->nip = $record["nip"];
            $this->gelar_depan = $record["gelar_depan"];
            $this->gelar_belakang = $record["gelar_belakang"];
            $this->nama_depan = $record["nama_depan"];
            $this->nama_tengah = $record["nama_tengah"];
            $this->nama_belakang = $record["nama_belakang"];

            $detail_golongan = $this->model_ref_golongan->get_detail("lower(golongan) = lower('" . trim($this->clean_golongan($record["golongan"])) . "')");
            $this->id_golongan = NULL;
            if ($detail_golongan) {
                $this->id_golongan = $detail_golongan->id_golongan;
            }

            $detail_jabatan = $this->model_ref_jabatan->get_detail("lower(jabatan) = lower('" . trim($record["jabatan"]) . "')");
            $this->id_jabatan = NULL;
            if ($detail_jabatan) {
                $this->id_jabatan = $detail_jabatan->id_jabatan;
            }

            $detail_skpd = $this->model_ref_skpd->get_detail("lower(nama_skpd) = lower('" . trim($record["nama_skpd"]) . "')");
            $this->id_skpd = NULL;
            if ($detail_skpd) {
                $this->id_skpd = $detail_skpd->id_skpd;
            }
            $this->id_diklat = $id_diklat;
            unset($detail_golongan, $detail_jabatan, $detail_skpd);

            $this->save();
        }
        return 1;
    }

    public function clean_golongan($gol) {
        return str_replace(")", "", str_replace("(", "", $gol));
    }

    public function riwayat_by_id_pegawai($id_pegawai = FALSE, $force_limit = FALSE, $force_offset = FALSE) {
        $this->db->where($this->table_name . ".id_pegawai = '" . $id_pegawai . "'");

        return parent::get_all($this->searchable_fields, FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_peserta_diklat_by_id_pegawai_id_diklat($id_peserta_diklat = FALSE, $id_diklat = FALSE) {
        if ($id_diklat && $id_peserta_diklat && is_numeric($id_diklat) && is_numeric($id_peserta_diklat)) {
            $this->db->where($this->table_name . ".id_peserta_diklat = '" . $id_peserta_diklat . "' and ".$this->table_name . ".id_diklat = '" . $id_diklat . "' ");

            return parent::get_detail();
        }
        return FALSE;
    }
    
    public function set_non_active($id_peserta_diklat_crypted_value = FALSE, $flag_del_name = 'record_active', $using_where = FALSE) {

        if ($flag_del_name == 'record_active') {
            $flag_del_name = $this->record_active_column_name;
        }

        $active_value = $this->get_active_value(FALSE);
//        $data[$flag_del_name] = "'" . $this->get_active_value(FALSE) . "'";
        $data[$flag_del_name] = $this->get_active_value(FALSE);
        if (array_key_exists($flag_del_name, $this->attribute_types)) {
            if (strtolower($this->attribute_types[$flag_del_name]) == 'bit') {
                $data[$flag_del_name] = ($active_value) ? TRUE : FALSE;
            }
        }

        if ($id_peserta_diklat_crypted_value) {
            $this->db->where("id_peserta_diklat_crypted", $id_peserta_diklat_crypted_value);
            $this->db->update($this->table_name, $data);
        } elseif ($using_where) {
            $this->db->update($this->table_name, $data);
        }
        
        unset($data);
        return;
    }

}

?>