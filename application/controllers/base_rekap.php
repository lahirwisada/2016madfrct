<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of base_rekap
 *
 * @author nurfadillah
 */
class Base_rekap extends Back_end {

    public function __construct($cmodul_name = 'base_kelola_rekap', $header_title = 'Base Kelola Rekap') {
        parent::__construct($cmodul_name, $header_title);
    }

    public $jenis_formulir_rekap = 'unknown';
    public $upload_rule = array(
        "upload_path" => "",
        "allowed_types" => "xlsx|xls"
    );
    public $data_rekap_excel = array(
        "125t" => NULL,
    );

    /**
     * Ini dilakukan sebelum save data
     * fungsi ini berguna untuk mengupload file excel terlebih dahulu sebelum melakukan simpan data 
     * @param array $posted_data
     * @return mix jika gagal nilai baliknya adalah boolean FALSE
     */
    protected function before_save($posted_data = array()) {
        $application_uploaded = FALSE;

        if (array_key_exists("berkas_excel", $_FILES)) {
//                $this->model_tr_peserta_diklat->upload_rule = $this->model_tr_aplikasi->application_upload_rule;
            $application_uploaded = $this->upload_file_rekap($this->jenis_formulir_rekap, $this->{$this->model}->id_triwulan, $this->{$this->model}->id_kotama, 'berkas_excel', date('Y'));

            if ($application_uploaded && is_array($application_uploaded) && !empty($application_uploaded)) {
                if ($application_uploaded["success_upload"]) {
                    return $application_uploaded;
                }
            }
            unset($application_uploaded);
        }
        return FALSE;
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

    protected function collect_row_data($active_sheet, $slash_index_min, $slash_index_max, $start_row, $col_map) {
        $row = array();
        for ($x = $slash_index_min; $x <= $slash_index_max; $x++) {
            $col_alphabet = chr($x);
            $cell_index = $col_alphabet . $start_row;
            $_row = $active_sheet->getCell($cell_index)->getCalculatedValue();
            $row[$col_map[$col_alphabet]] = $_row;
            if(is_null($_row)){
                $row[$col_map[$col_alphabet]] = 0;
            }
            unset($_row);
        }
        unset($active_sheet, $slash_index_min, $slash_index_max, $start_row, $col_map);
        return $row;
    }

    protected function get_nama_kotama($active_sheet, $start_row) {
        $cell_index = 'A' . $start_row;
        $nama_kotama = '';
        $_nama_kotama = $active_sheet->getCell($cell_index)->getValue();
        if ($_nama_kotama !== NULL || $_nama_kotama !== '') {
            $arr_nama_kotama = explode(':', $_nama_kotama);
            $nama_kotama = trim(end($arr_nama_kotama));
        }
        unset($active_sheet, $start_row);
        return $nama_kotama;
    }

    protected function collect_matrix_data_f125t($active_sheet, $readed_first_row, $_start_row, $last_row) {
        /**
         * cari baris pertama
         */
        $start_row = $this->find_first_row($active_sheet, $readed_first_row, $_start_row, $last_row);

        /**
         * Baca Matrix tabel F125 per Kotama
         */
        $nama_kotama = $this->get_nama_kotama($active_sheet, $start_row);
        $start_row +=5;

        $col_map = $this->model_tr_125t_detail->col_map;

        $slash_index_min = 67; // 65 = A
        $slash_index_max = 73; // 73 = I

        $catch_jumlah_row = FALSE;
        $records = array();
        while (!$catch_jumlah_row && $start_row < $last_row) {
            $cell_index = 'A' . $start_row;
            $is_not_null_row = $active_sheet->getCell($cell_index)->getValue();
            $cell_index = 'B' . $start_row;
            $is_jumlah_row = $active_sheet->getCell($cell_index)->getValue();

            if ($is_not_null_row !== NULL) {
                $records[$is_jumlah_row] = $this->collect_row_data($active_sheet, $slash_index_min, $slash_index_max, $start_row, $col_map);
            }
            $start_row++;

            if (trim(strtolower($is_jumlah_row)) == 'jumlah') {
                $catch_jumlah_row = TRUE;
                $start_row--;
            }
        }
        unset($active_sheet);
        return array(
            $start_row,
            array(
                "nama_kotama" => $nama_kotama,
                "records" => $records
            )
        );
    }

    /**
     * parse excel and collect cells data
     * Form 125 T
     */
    protected function read_excel_data_125t_all() {
        $response_data_125t = array(
            "form_format" => TRUE,
            "read_data" => TRUE,
            "data" => array()
        );

        $active_sheet = $this->excel->setActiveSheetIndexByName('125T');
        if ($active_sheet !== FALSE) {

            $last_row = $active_sheet->getHighestRow();
            $start_row = 48;
            $kotama_kesatuan_awal_row = 1;
            $readed_first_row = FALSE;

            $known_bentuk_formulir_column = $active_sheet->getCell('I10')->getValue();
            $known_judul_tni_column = $active_sheet->getCell('A1')->getValue();
            $known_kesatuan_column = $active_sheet->getCell('A2')->getValue();
            $known_judul_column = $active_sheet->getCell('A6')->getValue();
            $known_bulan_tahun_column = $active_sheet->getCell('A7')->getValue();
            $known_null_column = $active_sheet->getCell('B45')->getValue();
            $known_nama_penandatangan_column = $active_sheet->getCell('F47')->getValue();
            $known_nrp_penandatangan_column = $active_sheet->getCell('F48')->getValue();

//            var_dump(strtolower($known_bentuk_formulir_column) == 'bentuk : pers-125.t*)' ,
//                    strtolower($known_judul_tni_column) == 'tentara nasional indonesia angkatan darat' ,
//                    strtolower($known_kesatuan_column) != '' ,
//                    strtolower($known_judul_column) != '' ,
//                    strtolower($known_bulan_tahun_column) != '' ,
//                    strtolower($known_nama_penandatangan_column) != '' ,
//                    strtolower($known_nrp_penandatangan_column) != '' ,
//                    $known_null_column === NULL);exit;
            
            if (!(strtolower($known_bentuk_formulir_column) == 'bentuk : pers-125.t*)' &&
                    strtolower($known_judul_tni_column) == 'tentara nasional indonesia angkatan darat' &&
                    strtolower($known_kesatuan_column) != '' &&
                    strtolower($known_judul_column) != '' &&
                    strtolower($known_bulan_tahun_column) != '' &&
                    strtolower($known_nama_penandatangan_column) != '' &&
                    strtolower($known_nrp_penandatangan_column) != '' &&
                    $known_null_column === NULL)) {
                
//                    echo "slh";exit;
                /**
                 * WRONG TEMPLATE
                 */
                $response_data_125t = array(
                    "form_format" => FALSE,
                    "read_data" => FALSE,
                    "data" => array()
                );
            } else {
                /**
                 * baca kolom A-J menggunakan ascii
                 */
                $record_found = array();


                $reach_last_row = FALSE;

                while (!$reach_last_row) {
                    if ($start_row >= $last_row) {
                        $reach_last_row = TRUE;
                    } else {
                        list($start_row, $records) = $this->collect_matrix_data_f125t($active_sheet, $readed_first_row, $start_row, $last_row);
                        $record_found[$records["nama_kotama"]] = $records["records"];
                    }
                }
                
                $response_data_125t["data"] = $record_found;
            }
        }
        unset($active_sheet);
        return $response_data_125t;
    }
    
    private function validate_final_response_data($response_data = array()){
        $final_response = array();
        if(is_array($response_data) && !empty($response_data)){
            foreach($response_data as $key => $arr_value){
                if($key !== '' && !empty($arr_value)){
                    $final_response[$key] = $arr_value;
                }
            }
        }
        unset($response_data);
        return $final_response;
    }
    
    /**
     * parse excel and collect cells data
     * Form 125 T
     */
    protected function read_excel_data_125t() {
        $response_data_125t = array(
            "form_format" => TRUE,
            "read_data" => TRUE,
            "data" => array()
        );

        $active_sheet = $this->excel->setActiveSheetIndexByName('125T');
        if ($active_sheet !== FALSE) {

            $last_row = $active_sheet->getHighestRow();
            $start_row = 9;
            $kotama_kesatuan_awal_row = 1;
            $readed_first_row = FALSE;

            $known_bentuk_formulir_column = $active_sheet->getCell('I10')->getValue();
            $known_judul_tni_column = $active_sheet->getCell('A1')->getValue();
            $known_kesatuan_column = $active_sheet->getCell('A2')->getValue();
            $known_judul_column = $active_sheet->getCell('A6')->getValue();
            $known_bulan_tahun_column = $active_sheet->getCell('A7')->getValue();
            $known_null_column = $active_sheet->getCell('B45')->getValue();
            $known_nama_penandatangan_column = $active_sheet->getCell('F47')->getValue();
            $known_nrp_penandatangan_column = $active_sheet->getCell('F48')->getValue();

//            var_dump(strtolower($known_bentuk_formulir_column) == 'bentuk : pers-125.t*)' ,
//                    strtolower($known_judul_tni_column) == 'tentara nasional indonesia angkatan darat' ,
//                    strtolower($known_kesatuan_column) != '' ,
//                    strtolower($known_judul_column) != '' ,
//                    strtolower($known_bulan_tahun_column) != '' ,
//                    strtolower($known_nama_penandatangan_column) != '' ,
//                    strtolower($known_nrp_penandatangan_column) != '' ,
//                    $known_null_column === NULL);exit;
            
            if (!(strtolower($known_bentuk_formulir_column) == 'bentuk : pers-125.t*)' &&
                    strtolower($known_judul_tni_column) == 'tentara nasional indonesia angkatan darat' &&
                    strtolower($known_kesatuan_column) != '' &&
                    strtolower($known_judul_column) != '' &&
                    strtolower($known_bulan_tahun_column) != '' &&
                    strtolower($known_nama_penandatangan_column) != '' &&
                    strtolower($known_nrp_penandatangan_column) != '' &&
                    $known_null_column === NULL)) {
                
//                    echo "slh";exit;
                /**
                 * WRONG TEMPLATE
                 */
                $response_data_125t = array(
                    "form_format" => FALSE,
                    "read_data" => FALSE,
                    "data" => array()
                );
            } else {
                /**
                 * baca kolom A-J menggunakan ascii
                 */
                $record_found = array();


                $reach_last_row = FALSE;

                while (!$reach_last_row) {
                    if ($start_row >= $last_row) {
                        $reach_last_row = TRUE;
                    } else {
                        list($start_row, $records) = $this->collect_matrix_data_f125t($active_sheet, $readed_first_row, $start_row, $last_row);
                        $record_found[$records["nama_kotama"]] = $records["records"];
                    }
                }
                
                $response_data_125t["data"] = $this->validate_final_response_data($record_found);
            }
        }
        unset($active_sheet);
        
        return $response_data_125t;
    }
    /**
     * ini yang dikejakan samsul
     */    
    
    
    protected function collect_matrix_data_f126t($active_sheet, $readed_first_row, $_start_row, $last_row) {
        /**
         * cari baris pertama
         */
        $start_row = $this->find_first_row($active_sheet, $readed_first_row, $_start_row, $last_row);

        /**
         * Baca Matrix tabel F126 per Kotama
         */
        $nama_kotama = $this->get_nama_kotama($active_sheet, $start_row);
        $start_row +=5;

        $col_map = $this->model_tr_126t_detail->col_map;

        $slash_index_min = 67; // 65 = A
        $slash_index_max = 77; // 73 = I

        $catch_jumlah_row = FALSE;
        $records = array();
        while (!$catch_jumlah_row && $start_row < $last_row) {
            $cell_index = 'A' . $start_row;
            $is_not_null_row = $active_sheet->getCell($cell_index)->getValue();
            $cell_index = 'B' . $start_row;
            $is_jumlah_row = $active_sheet->getCell($cell_index)->getValue();

            if ($is_not_null_row !== NULL) {
                $records[$is_jumlah_row] = $this->collect_row_data($active_sheet, $slash_index_min, $slash_index_max, $start_row, $col_map);
            }
            $start_row++;

            if (trim(strtolower($is_jumlah_row)) == 'jumlah') {
                $catch_jumlah_row = TRUE;
                $start_row--;
            }
        }
        unset($active_sheet);
        return array(
            $start_row,
            array(
                "nama_kotama" => $nama_kotama,
                "records" => $records
            )
        );
    }

    /**
     * parse excel and collect cells data
     * Form 126 T
     */
    protected function read_excel_data_126t() {
        $response_data_126t = array(
            "form_format" => TRUE,
            "read_data" => TRUE,
            "data" => array()
        );

        $active_sheet = $this->excel->setActiveSheetIndexByName('126T');
        

        if ($active_sheet !== FALSE) {

            $last_row = $active_sheet->getHighestRow();
            $start_row = 48;
            $kotama_kesatuan_awal_row = 1;
            $readed_first_row = FALSE;

            $known_bentuk_formulir_column = $active_sheet->getCell('M10')->getValue();
            $known_judul_tni_column = $active_sheet->getCell('A1')->getValue();
            $known_kesatuan_column = $active_sheet->getCell('A2')->getValue();
            $known_judul_column = $active_sheet->getCell('A6')->getValue();
            $known_bulan_tahun_column = $active_sheet->getCell('A7')->getValue();
            $known_null_column = $active_sheet->getCell('B45')->getValue();
            $known_nama_penandatangan_column = $active_sheet->getCell('H47')->getValue();
            $known_nrp_penandatangan_column = $active_sheet->getCell('H48')->getValue();
            
            
            
            if (!(strtolower($known_bentuk_formulir_column) == 'bentuk : pers-126.t*)' &&
                    strtolower($known_judul_tni_column) == 'tentara nasional indonesia angkatan darat' &&
                    strtolower($known_kesatuan_column) != '' &&
                    strtolower($known_judul_column) != '' &&
                    strtolower($known_bulan_tahun_column) != '' &&
                    strtolower($known_nama_penandatangan_column) != '' &&
                    strtolower($known_nrp_penandatangan_column) != '' &&
                    $known_null_column === NULL)) {
                /**
                 * WRONG TEMPLATE
                 */
                $response_data_126t = array(
                    "form_format" => FALSE,
                    "read_data" => FALSE,
                    "data" => array()
                );
            } else {
                /**
                 * baca kolom A-N menggunakan ascii
                 */
                $record_found = array();


                $reach_last_row = FALSE;

                while (!$reach_last_row) {
                    if ($start_row >= $last_row) {
                        $reach_last_row = TRUE;
                    } else {
                        list($start_row, $records) = $this->collect_matrix_data_f126t($active_sheet, $readed_first_row, $start_row, $last_row);
                        $record_found[$records["nama_kotama"]] = $records["records"];
                    }
                }
                
                $response_data_126t["data"] = $record_found;
            }
        }
        unset($active_sheet);
        
        return $response_data_126t;
    }
    
    
    //sampai disini
    
    protected function collect_matrix_data_f102E1($active_sheet, $readed_first_row, $_start_row, $last_row) {
        /**
         * cari baris pertama
         */
        $start_row = $this->find_first_row($active_sheet, $readed_first_row, $_start_row, $last_row);

        /**
         * Baca Matrix tabel F102E1 per Kotama
         */
        $nama_kotama = $this->get_nama_kotama($active_sheet, $start_row);
        $start_row +=5;

        $col_map = $this->model_tr_102E1_detail->col_map;

        $slash_index_min = 67; // 65 = A
        $slash_index_max = 91; // 73 = I

        $catch_jumlah_row = FALSE;
        $records = array();
        while (!$catch_jumlah_row && $start_row < $last_row) {
            $cell_index = 'A' . $start_row;
            $is_not_null_row = $active_sheet->getCell($cell_index)->getValue();
            $cell_index = 'B' . $start_row;
            $is_jumlah_row = $active_sheet->getCell($cell_index)->getValue();

            if ($is_not_null_row !== NULL) {
                $records[$is_jumlah_row] = $this->collect_row_data($active_sheet, $slash_index_min, $slash_index_max, $start_row, $col_map);
            }
            $start_row++;

            if (trim(strtolower($is_jumlah_row)) == 'jumlah') {
                $catch_jumlah_row = TRUE;
                $start_row--;
            }
        }
        unset($active_sheet);
        return array(
            $start_row,
            array(
                "nama_kotama" => $nama_kotama,
                "records" => $records
            )
        );
    }

    /**
     * parse excel and collect cells data
     * Form 126 T
     */
    protected function read_excel_data_102E1() {
        $response_data_102E1 = array(
            "form_format" => TRUE,
            "read_data" => TRUE,
            "data" => array()
        );

        $active_sheet = $this->excel->setActiveSheetIndexByName('102E1');
        

        if ($active_sheet !== FALSE) {

            $last_row = $active_sheet->getHighestRow();
            $start_row = 48;
            $kotama_kesatuan_awal_row = 1;
            $readed_first_row = FALSE;

            $known_bentuk_formulir_column = $active_sheet->getCell('Y2')->getValue();
            $known_judul_tni_column = $active_sheet->getCell('A1')->getValue();
            $known_kesatuan_column = $active_sheet->getCell('A2')->getValue();
            $known_judul_column = $active_sheet->getCell('A4')->getValue();
            $known_bulan_tahun_column = $active_sheet->getCell('A5')->getValue();
            $known_null_column = $active_sheet->getCell('B42')->getValue();
            $known_nama_penandatangan_column = $active_sheet->getCell('V44')->getValue();
            $known_nrp_penandatangan_column = $active_sheet->getCell('V45')->getValue();
            
            
            var_dump (strtolower($known_bentuk_formulir_column) == 'bentuk      : pers-102 E1',
                    strtolower($known_judul_tni_column) == 'tentara nasional indonesia angkatan darat',
                    strtolower($known_kesatuan_column) != '',
                    strtolower($known_judul_column) != '',
                    strtolower($known_bulan_tahun_column) != '',
                    strtolower($known_nama_penandatangan_column) != '',
                    strtolower($known_nrp_penandatangan_column) != '',
                    $known_null_column === NULL);exit;
            
            if (!(strtolower($known_bentuk_formulir_column) == 'bentuk      : pers-102 E1' &&
                    strtolower($known_judul_tni_column) == 'tentara nasional indonesia angkatan darat' &&
                    strtolower($known_kesatuan_column) != '' &&
                    strtolower($known_judul_column) != '' &&
                    strtolower($known_bulan_tahun_column) != '' &&
                    strtolower($known_nama_penandatangan_column) != '' &&
                    strtolower($known_nrp_penandatangan_column) != '' &&
                    $known_null_column === NULL)) {
                /**
                 * WRONG TEMPLATE
                 */
                $response_data_102E1 = array(
                    "form_format" => FALSE,
                    "read_data" => FALSE,
                    "data" => array()
                );
            } else {
                /**
                 * baca kolom A-N menggunakan ascii
                 */
                $record_found = array();


                $reach_last_row = FALSE;

                while (!$reach_last_row) {
                    if ($start_row >= $last_row) {
                        $reach_last_row = TRUE;
                    } else {
                        list($start_row, $records) = $this->collect_matrix_data_f126t($active_sheet, $readed_first_row, $start_row, $last_row);
                        $record_found[$records["nama_kotama"]] = $records["records"];
                    }
                }
                
                $response_data_102E1["data"] = $record_found;
            }
        }
        unset($active_sheet);
        
        return $response_data_102E1;
    }
    
    
    
    
    
    //sampai disini
    protected function load_excel_library() {
        if ($this->before_save_response && is_array($this->before_save_response) && array_key_exists('success_upload', $this->before_save_response) && $this->before_save_response['success_upload']) {
            $this->load->library('Excel');
            $this->excel->load($this->before_save_response['upload_data_response']['file_info'], TRUE);
            return TRUE;
        }
        return FALSE;
    }

    protected function save_detail($id = FALSE) {
        return $this->{$this->model}->save($id);
    }

    protected function after_save($id = FALSE, $saved_id = FALSE) {
        ini_set('memory_limit', '-1');
        if ($this->load_excel_library()) {
            $this->load->model(array(
                "model_tr_125t_detail",
                "model_tr_126t_detail",
                "model_tr_102E1_detail"
            ));
            $response_form125t = $this->read_excel_data_125t();
            $this->model_tr_125t_detail->save_records($response_form125t);
            
            
            $response_form126t = $this->read_excel_data_126t();
//            var_dump($response_form126t);exit;
            $this->model_tr_126t_detail->save_records($response_form126t);
            
            
            $response_form102E1 = $this->read_excel_data_102E1();
//            var_dump($response_form102E1);exit;
            $this->model_tr_102E1_detail->save_records($response_form102E1);
       
            
        }
        return TRUE;
//        $this->{$this->model}->read_excel_data($response);
    }

    /**
     * lihat upload_data untuk mengetahui nilai balik fungsi upload_data
     * @param type $username
     * @param type $upload_type
     * @param type $detail_application
     * @param type $input_name
     * @return boolean
     */
    protected function upload_file_rekap($id_jenis_formulir = FALSE, $triwulan = FALSE, $id_kotama = FALSE, $input_name = FALSE, $tahun = FALSE) {
        $file_posted_ok = FALSE;
        $response = array(
            "success_upload" => FALSE,
            "upload_data_response" => FALSE,
            "message" => "Upload gagal dilakukan.",
            "file_uploaded" => "",
        );

        if ($id_jenis_formulir && $input_name &&
                is_array($this->upload_rule) && !empty($this->upload_rule)) {
            $path_upload = join(DIRECTORY_SEPARATOR, array(
                "rekap",
                $id_jenis_formulir,
                $tahun,
                $triwulan,
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

}
