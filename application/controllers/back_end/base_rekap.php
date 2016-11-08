<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of base_rekap
 *
 * @author nurfadillah
 */
class Base_rekap extends Back_end {

    public function __construct() {
        parent::__construct('base_kelola_rekap', 'Base Kelola Rekap');
    }
    
    /**
     * lihat upload_data untuk mengetahui nilai balik fungsi upload_data
     * @param type $username
     * @param type $upload_type
     * @param type $detail_application
     * @param type $input_name
     * @return boolean
     */
    private function __upload_file($id_diklat = FALSE, $upload_type = FALSE, $detail_application = FALSE, $input_name = FALSE) {
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

    public function upload($crypted_id_diklat = FALSE) {

        $detail_diklat = $this->model_tr_diklat->get_detail_by_crypted($crypted_id_diklat);

//        var_dump($_FILES);exit;

        if ($detail_diklat) {
            /**
             * Upload Aplikasi
             */
            if (array_key_exists("berkas_peserta_diklat", $_FILES)) {
//                $this->model_tr_peserta_diklat->upload_rule = $this->model_tr_aplikasi->application_upload_rule;
                $application_uploaded = $this->model_tr_peserta_diklat->upload_file($detail_diklat->id_diklat, "berkas_peserta_diklat", $detail_diklat, "berkas_peserta_diklat");

                if ($application_uploaded && is_array($application_uploaded) && !empty($application_uploaded)) {
                    $application_uploaded = current($application_uploaded);
//                var_dump($this->model_tr_aplikasi->attributes);exit;
                    if ($application_uploaded["success_upload"]) {

                        $timpa_daftar_peserta_lama = $this->input->post('timpa_daftar_peserta_lama');

                        $response = $this->read_and_save_excel_content($detail_diklat->id_diklat, $application_uploaded['upload_data_response']['file_info'], $timpa_daftar_peserta_lama);
                    }
                    $this->attention_messages .= $application_uploaded["message"];
                }
                unset($application_uploaded);
            }
        }

        $this->set("additional_js", array(
            "back_end/" . $this->_name . "/js/upload_js",
        ));

        $this->add_jsfiles(array(
            "plugins/lws_excelreader/workbook/jszip.js",
            "plugins/lws_excelreader/workbook/cpexcel.js",
            "plugins/lws_excelreader/workbook/xlsx.core.min.js",
            "plugins/lws_excelreader/workbook/ods.js",
            "plugins/lws_excelreader/lws_excelreader.js",
        ));


        $this->set('id_diklat', $crypted_id_diklat);
        $this->set("detail_diklat", $detail_diklat);

        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Pendaftaran ' . $this->_header_title . ' (Upload Excel)'
        ));
    }

}
