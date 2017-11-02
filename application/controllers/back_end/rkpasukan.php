<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rkpasukan extends Back_end {

    public $model = 'model_tr_pasukan_rekap';
    public $jenis_formulir_rekap = 'pasukan';
    public $upload_rule = array(
        "upload_path" => "",
        "allowed_types" => "xlsx|xls"
    );

    /**
     * 
     */
    public function __construct() {
        parent::__construct('modul_rekap', 'Rekap Pasukan');
        $this->load->model(array('model_tr_pasukan_detail', 'model_master_kotama', 'model_master_satminkal', 'model_master_pangkat'));
    }

    /**
     * Melihat daftar rekap
     */
    public function index() {
        $kotama = $this->input->get('kotama');
        if ($this->user_detail['id_kotama'] == 0) {
            $this->set('list_kotama', $this->model_master_kotama->get_all(FALSE, FALSE, TRUE, TRUE)->record_set);
            $this->set('kotama', $kotama);
            $this->set('keyword', $kotama);
        }
        $this->set('id_kotama', $this->user_detail['id_kotama']);
        parent::index();
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    /**
     * Melihat detail dari rekap
     * @param type $id_rekap
     */
    public function detail($id_rekap = FALSE) {
        parent::detail($id_rekap, array(
            "id_bulan",
            "id_tahun",
            "id_kotama",
            "tanggal_upload",
            "tanggal_ttd",
            "uraian_atas_ttd",
            "jabatan_ttd",
            "nama_ttd",
            "pangkat_ttd",
            "nrp_ttd",
        ));
        $this->set('kotama', $this->model_master_kotama->get_all(FALSE, FALSE, TRUE, TRUE)->record_set);
        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Formulir ' . $this->_header_title
        ));
        $this->set("additional_js", "back_end/" . $this->_name . "/js/detail_js");
        $this->add_cssfiles(array("plugins/select2/select2.min.css"));
        $this->add_jsfiles(array("plugins/select2/select2.full.min.js"));
    }

    /**
     * Upload file rekap dalam format Excel untuk dimasukkan ke dalam database
     * @param type $id_jenis_formulir
     * @param type $tahun
     * @param type $bulan
     * @param type $id_kotama
     * @param type $input_name
     * @return string
     */
    protected function upload_file_rekap($id_jenis_formulir = FALSE, $tahun = FALSE, $bulan = FALSE, $id_kotama = FALSE, $input_name = FALSE) {
        $file_posted_ok = FALSE;
        $response = array(
            "success_upload" => FALSE,
            "upload_data_response" => FALSE,
            "message" => "Upload gagal dilakukan.",
            "file_uploaded" => "",
        );

        if ($id_jenis_formulir && $input_name && is_array($this->upload_rule) && !empty($this->upload_rule)) {
            $path_upload = join(DIRECTORY_SEPARATOR, array(
                "rekap",
                $id_jenis_formulir,
                $tahun,
                $bulan,
                $id_kotama
            ));
            $upload_location = get_upload_location($path_upload);

            if ($upload_location) {
                $cfg = $this->upload_rule;
                $cfg["upload_path"] = $upload_location;
                $cfg["ignore_mime_check"] = TRUE;
                $response["upload_data_response"] = upload_data($input_name, $cfg, $id_jenis_formulir, FALSE);
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

    /**
     * Sebelum data disimpan, ada pemeriksaan terhadap file berkas
     * @param type $posted_data
     * @return boolean
     */
    protected function before_save($posted_data = array()) {
        $application_uploaded = FALSE;

        if (array_key_exists("berkas_excel", $_FILES)) {
            $application_uploaded = $this->upload_file_rekap($this->jenis_formulir_rekap, $this->{$this->model}->id_tahun, $this->{$this->model}->id_bulan, $this->{$this->model}->id_kotama, 'berkas_excel');

            if ($application_uploaded && is_array($application_uploaded) && !empty($application_uploaded)) {
                if ($application_uploaded["success_upload"]) {
                    return $application_uploaded;
                }
            }
            unset($application_uploaded);
        }
        return FALSE;
    }

    /**
     * 
     * @param type $id_rekap
     */
    protected function save_detail($id_rekap = FALSE) {
        return $this->{$this->model}->save($id_rekap);
//        return TRUE;
    }

    /**
     * 
     * @param type $id_rekap
     * @param type $id_detail
     */
    protected function after_save($id_rekap = FALSE, $id_detail = FALSE) {
        ini_set('memory_limit', '-1');
        if ($this->load_excel_library()) {
            $this->load->model(array(
                "model_tr_pasukan_detail"
            ));
            $response_pasukan = $this->read_excel_data_pasukan();
//            var_dump($id_rekap);
//            var_dump($response_pasukan['data']['KODIM 0201 BS']);
//            exit();
            $this->model_tr_pasukan_detail->save_records($id_rekap, $response_pasukan);
        }
        return TRUE;
    }

    protected function load_excel_library() {
        if ($this->before_save_response && is_array($this->before_save_response) && array_key_exists('success_upload', $this->before_save_response) && $this->before_save_response['success_upload']) {
            $this->load->library('Excel');
            $this->excel->load($this->before_save_response['upload_data_response']['file_info'], TRUE);
            return TRUE;
        }
        return FALSE;
    }

    protected function read_excel_data_pasukan() {
        $response_data_pasukan = array(
            "form_format" => TRUE,
            "read_data" => TRUE,
            "data" => array()
        );

        $active_sheet = $this->excel->setActiveSheetIndexByName('Laporan');
        if ($active_sheet !== FALSE) {

            $last_row = $active_sheet->getHighestRow();
            $start_row = 67;
            $kotama_kesatuan_awal_row = 1;
            $readed_first_row = FALSE;

//            $known_bentuk_formulir_column = $active_sheet->getCell('I8')->getValue();
            $known_judul_tni_column = $active_sheet->getCell('A1')->getValue();
//            $known_kesatuan_column = $active_sheet->getCell('A2')->getValue();
//            $known_judul_column = $active_sheet->getCell('A5')->getValue();
//            $known_bulan_tahun_column = $active_sheet->getCell('A6')->getValue();
//            $known_null_column = $active_sheet->getCell('B63')->getValue();
//            $known_nama_penandatangan_column = $active_sheet->getCell('F65')->getValue();
//            $known_nrp_penandatangan_column = $active_sheet->getCell('F66')->getValue();

            if (!(
//                    strtolower($known_bentuk_formulir_column) == 'bentuk : pers-001*)' &&
                    strtolower($known_judul_tni_column) == 'tentara nasional indonesia angkatan darat'
//                    strtolower($known_kesatuan_column) != '' &&
//                    strtolower($known_judul_column) != '' &&
//                    strtolower($known_bulan_tahun_column) != '' &&
//                    strtolower($known_nama_penandatangan_column) != '' &&
//                    strtolower($known_nrp_penandatangan_column) != '' &&
//                    $known_null_column === NULL
                    )) {

                /**
                 * WRONG TEMPLATE
                 */
                $response_data_pasukan = array(
                    "form_format" => FALSE,
                    "read_data" => FALSE,
                    "data" => array()
                );
            } else {
                $record_found = array();
                $reach_last_row = FALSE;
                while (!$reach_last_row) {
                    if ($start_row >= $last_row) {
                        $reach_last_row = TRUE;
                    } else {
                        list($start_row, $records) = $this->collect_matrix_data_pasukan($active_sheet, $readed_first_row, $start_row, $last_row);
                        $record_found[$records["nama_satminkal"]] = $records["records"];
                    }
                }
                $response_data_pasukan["data"] = $this->validate_final_response_data($record_found);
            }
        }
        unset($active_sheet);
        return $response_data_pasukan;
    }

    protected function collect_matrix_data_pasukan($active_sheet, $readed_first_row, $_start_row, $last_row) {
        /**
         * cari baris pertama
         */
        $start_row = $this->find_first_row($active_sheet, $readed_first_row, $_start_row, $last_row);

        /**
         * Baca Matrix tabel Pasukan per Satminkal
         */
        $nama_satminkal = trim($this->get_nama_satminkal($active_sheet, $start_row));
        $is_not_jumlah = trim(substr(strtolower($nama_satminkal), 0, 6)) !== 'jumlah';

        $start_row +=5;

        $col_map = $this->model_tr_pasukan_detail->col_map;

        $catch_jumlah_row = FALSE;
        $records = array();
        while (!$catch_jumlah_row && $start_row < $last_row) {
            $cell_index = 'A' . $start_row;
            $is_not_null_row = $active_sheet->getCell($cell_index)->getValue();
            $cell_index = 'B' . $start_row;
            $is_jumlah_row = trim($active_sheet->getCell($cell_index)->getValue());

            if ($is_not_jumlah && $is_not_null_row !== NULL) {
//                $this->model_master_pangkat->check_id_by_kode_pangkat_and_insert($is_jumlah_row);
                $records[$is_jumlah_row] = $this->collect_row_data($active_sheet, $start_row, $col_map);
            }
            $start_row++;

            if (trim(strtolower($is_jumlah_row)) == 'jumlah') {
                $catch_jumlah_row = TRUE;
            }
        }
        unset($active_sheet);
        return array(
            $start_row,
            array(
                "nama_satminkal" => $nama_satminkal,
                "records" => $records
            )
        );
    }

    private function find_first_row($active_sheet, $readed_first_row, $start_row, $last_row) {
        while (!$readed_first_row && $start_row < $last_row) {
            $cell_index = 'A' . $start_row;
            $catch_not_null_row = $active_sheet->getCell($cell_index)->getValue();

            if ($catch_not_null_row !== NULL) {
                $readed_first_row = TRUE;
            } else {
                $start_row++;
            }
        }
        unset($active_sheet);
        return $start_row;
    }

    protected function get_nama_satminkal($active_sheet, $start_row) {
        $cell_index = 'A' . $start_row;
        $nama_satminkal = '';
        $_nama_satminkal = $active_sheet->getCell($cell_index)->getValue();
        if ($_nama_satminkal !== NULL || $_nama_satminkal !== '') {
            $arr_nama_satminkal = explode(':', $_nama_satminkal);
            $nama_satminkal = trim(end($arr_nama_satminkal));
        }
        unset($active_sheet, $start_row);
        return $nama_satminkal;
    }

    protected function collect_row_data($active_sheet, $start_row, $col_map) {
        $row = array();
        foreach ($col_map as $colom => $field) {
            $cell_index = $colom . $start_row;
            $_row = $active_sheet->getCell($cell_index)->getCalculatedValue();
            if (is_null($_row)) {
                $row[$col_map[$colom]] = 0;
            } else {
                $row[$col_map[$colom]] = intval($_row);
            }
            unset($_row);
        }
        unset($active_sheet, $start_row, $col_map);
        return $row;
    }

    private function validate_final_response_data($response_data = array()) {
        $final_response = array();
        if (is_array($response_data) && !empty($response_data)) {
            foreach ($response_data as $key => $arr_value) {
                if ($key !== '' && !empty($arr_value)) {
                    $final_response[$key] = $arr_value;
                }
            }
        }
        unset($response_data);
        return $final_response;
    }

    public function view($id_rekap = FALSE) {
        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Hasil ' . $this->_header_title
        ));
        $records = $this->model_tr_pasukan_detail->get_data($id_rekap);
        $this->set('records', $records);
    }

    /**
     * 
     * @param type $id_kotama
     */
    public function download($id_kotama = FALSE) {
        if (!$id_kotama) {
            $this->attention_messages = "Data kotama tidak ditemukan.";
            redirect('back_end/' . $this->_name);
        }
        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Pendaftaran ' . $this->_header_title
        ));
    }

}
