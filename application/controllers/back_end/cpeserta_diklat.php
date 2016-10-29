<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cpeserta_diklat extends Back_end {

    public $model = 'model_tr_peserta_diklat';

    public function __construct() {
        parent::__construct('kelola_peserta_diklat', 'Peserta Diklat');
        $this->load->model('model_tr_diklat');
    }

    public function index($crypted_id_diklat = FALSE) {
        
        if (!$crypted_id_diklat) {
            redirect('back_end/cdaftar_diklat');
        }

        $detail_diklat = $this->model_tr_diklat->get_detail_by_crypted($crypted_id_diklat);

        $id_diklat = $detail_diklat ? $detail_diklat->id_diklat : FALSE;

        if (!$id_diklat || !$detail_diklat) {
            redirect('back_end/cdaftar_diklat');
        }

        $this->get_attention_message_from_session();
        $this->{$this->model}->change_offset_param("currpage_" . $this->cmodul_name);
        $records = $this->{$this->model}->all($id_diklat);

        $paging_set = $this->get_paging($this->get_current_location(), $records->record_found, $this->default_limit_paging, $this->cmodul_name);
        $this->set('records', $records->record_set);
        $this->set("keyword", $records->keyword);
        $this->set('field_id', $this->{$this->model}->primary_key);
        $this->set("paging_set", $paging_set);
        $this->set("detail_diklat", $detail_diklat);

        $this->set("additional_js", "back_end/" . $this->_name . "/js/index_js");

        $this->set("next_list_number", $this->{$this->model}->get_next_record_number_list());

        $this->set("bread_crumb", array(
            "back_end/cdaftar_diklat" => "Daftar Diklat",
            "#" => $this->_header_title
        ));
    }

    public function detail($crypted_id_diklat = FALSE, $id = FALSE) {
        parent::detail($id, array(
            "nip",
            "no_kep",
            "gelar_depan",
            "gelar_belakang",
            "nama_depan",
            "nama_tengah",
            "nama_belakang",
            "tempat_lahir",
            "tgl_lahir",
            "id_diklat",
            "id_skpd",
            "id_jabatan",
            "id_golongan",
        ));

        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Pendaftaran ' . $this->_header_title
        ));

        $detail_diklat = $this->model_tr_diklat->get_detail_by_crypted($crypted_id_diklat);

        $this->set("additional_js", array(
            "back_end/" . $this->_name . "/js/detail_js",
            "back_end/" . $this->_name . "/js/detail_isian_js",
        ));

        $this->add_cssfiles(array("plugins/select2/select2.min.css"));
        $this->add_jsfiles(array("plugins/select2/select2.full.min.js"));

        $this->set('id_diklat', $crypted_id_diklat);
        $this->set("detail_diklat", $detail_diklat);

//        $this->add_jsfiles(array("avant/plugins/form-jasnyupload/fileinput.min.js"));
    }

    /**
     * return CODE
     * 1: success
     * 2: wrong template
     * 3: excel file empty
     */
    private function read_and_save_excel_content($id_diklat, $file_info, $timpa) {
        $this->load->library('Excel');

        $this->excel->load($file_info, TRUE);

        $active_sheet = $this->excel->get_active_sheet();
//        var_dump($active_sheet->getHighestRow(), $active_sheet->calculateWorksheetDimension(), $active_sheet->getCell('D7')->getValue());

        $last_row = $active_sheet->getHighestRow();
        $start_row = 6;
        $known_no_column = $active_sheet->getCell('A4')->getValue();
        $known_nip_column = $active_sheet->getCell('G4')->getValue();
        $known_null_column = $active_sheet->getCell('G5')->getValue();

        if (!(strtolower($known_no_column) == 'no' && strtolower($known_nip_column) == 'nip' && $known_null_column === NULL)) {
            /**
             * WRONG TEMPLATE
             */
            return 2;
        }

        /**
         * baca kolom A-P menggunakan ascii
         */
        $record_found = array();
        $col_map = $this->model_tr_peserta_diklat->col_map;
        
        $slash_index = array(66,67,68,69,72,73);
        for ($y = $start_row; $y <= $last_row; $y++) {
            $row = array();
            for ($x = 66; $x <= 80; $x++) {
                $col_alphabet = chr($x);
                $cell_index = $col_alphabet . $y;
                $row[$col_map[$col_alphabet]] = $active_sheet->getCell($cell_index)->getValue();
                if(in_array($x, $slash_index)){
                    $row[$col_map[$col_alphabet]] = pg_escape_string($row[$col_map[$col_alphabet]]);
                }
            }
            if (!empty($row)) {
                $record_found[] = $row;
            }
        }
        unset($col_map);
        
        if(!empty($record_found)){
            $this->model_tr_peserta_diklat->save_from_excel($id_diklat, $record_found, $timpa);
            return 1;
        }
        return 3;
        
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

    public function get_like() {
        $keyword = $this->input->post("keyword");

        $provinsi_found = $this->model_ref_provinsi->get_like($keyword);

        $this->to_json($provinsi_found);
    }

}

?>