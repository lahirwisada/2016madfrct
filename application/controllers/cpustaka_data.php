<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cpustaka_data extends Main {

    protected $_header_title = '';
    protected $cmodul_name = '';
    protected $auto_load_model = TRUE;
    public $model = '';
    private $loaded_model = array();

    public function __construct($cmodul_name = FALSE, $header_title = FALSE) {
        if ($this->auto_load_model && ($this->model == '' || !$cmodul_name || !$header_title)) {
            show_404();
        }

        $this->cmodul_name = $cmodul_name;
        $this->_header_title = $header_title;

        $this->set("header_title", $this->_header_title);

        parent::__construct();

        if ($this->model != '') {
            $this->load_model($this->model);
        }
    }

    protected function load_model($model_name) {
        if (!in_array($model_name, $this->loaded_model)) {
            $this->load->model($model_name);
            $this->loaded_model[] = $model_name;
        }
    }

    protected function load_paging($model_name, $modul_name, $array_record_attribute = array("records" => "records", "keyword" => "keyword", "field_id" => "field_id", "paging_set" => "paging_set", "next_list_number" => "next_list_number"), $get_all_function_name = "all", $get_all_param = NULL) {
        $this->load_model($model_name);
        $this->{$model_name}->change_offset_param($modul_name);
        $records = $this->{$model_name}->{$get_all_function_name}($get_all_param);
        $paging_set = $this->get_paging($this->get_current_location(), $records->record_found, $this->default_limit_paging, $this->cmodul_name);
        $this->set($array_record_attribute['records'], $records->record_set);
        $this->set($array_record_attribute["keyword"], $records->keyword);
        $this->set($array_record_attribute["field_id"], $this->{$model_name}->primary_key);
        $this->set($array_record_attribute["paging_set"], $paging_set);

        $this->set($array_record_attribute["next_list_number"], $this->{$model_name}->get_next_record_number_list());
    }

    public function index() {
        $this->get_attention_message_from_session();
        $this->load_paging($this->model, "currpage_" . $this->cmodul_name);
        $this->set("additional_js", "back_end/" . $this->_name . "/js/index_js");
    }

    protected function detail($id = FALSE, $posted_data = array()) {
//        var_dump(array_diff(array_keys($_POST), $posted_data), $this->{$this->model}->get_data_post(FALSE, $posted_data), $this->{$this->model}->is_valid(), $this->{$this->model});exit;
        if ($this->{$this->model}->get_data_post(FALSE, $posted_data)) {
            if ($this->{$this->model}->is_valid()) {

                $saved_id = $this->{$this->model}->save($id);

                if (!$id) {
                    $id = $saved_id;
                }

                $this->attention_messages = "Data baru telah disimpan.";
                if ($id) {
                    $this->attention_messages = "Perubahan telah disimpan.";
                }
                redirect('back_end/' . $this->_name);
            } else {
                $this->attention_messages = $this->{$this->model}->errors->get_html_errors("<br />", "line-wrap");
            }
        }

        $detail = $this->{$this->model}->show_detail($id);
//        var_dump($this->db->last_query(), $detail);exit;
        $this->set("detail", $detail);

//        $this->set("bread_crumb", array(
//            "back_end/cjenis_diklat" => 'Jenis Diklat',
//            "#" => 'Pendaftaran Jenis Diklat'
//        ));
//        $this->add_jsfiles(array("avant/plugins/form-jasnyupload/fileinput.min.js"));
    }

    public function delete($id = FALSE) {
        if ($id) {
            $this->{$this->model}->set_non_active($id);
            $this->store_attention_message_to_session("Data berhasil dihapus.");
        } else {
            $this->store_attention_message_to_session("Data tidak ditemukan.");
        }
        redirect($this->my_location . $this->_name . "/index/");
    }

}

?>