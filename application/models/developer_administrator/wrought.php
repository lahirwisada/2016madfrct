<?php

include_once APPPATH . 'models/developer_administrator/table.php';

class wrought extends LWS_Model {

    public $tables = array();
    private $models_content = array();
    private $model_content = "";

    public function __construct() {
        parent::__construct();
        $this->model_content = "";
        $this->models_content = array();
        $this->tables = array();
    }

    private function get_all_tables() {
        if (!$this->is_table_has_value()) {
            $this->tables = $this->db->list_tables();
        }
        return $this->tables;
    }

    private function is_table_has_value() {
        return count($this->tables) > 0;
    }

    public function create_models($just_entity=FALSE) {
        $this->get_models_content();
        foreach (array_keys($this->models_content) as $table_name) {
            $this->create_model_for_table($table_name, $just_entity);
        }
    }

    public function get_models_content() {
        if (!array_have_value($this->models_content)) {
            $this->get_all_tables();
            if ($this->is_table_has_value()) {
                foreach ($this->tables as $table_name) {
                    $this->models_content[$table_name] = $this->create_model_content_for_table($table_name);
                }
            }
        }
        return $this->models_content;
    }

    private function create_file($dir, $content) {
        file_put_contents("$dir", $content);
    }

    public function create_model_for_table($table_name = FALSE, $generate_models = TRUE) {
        $dir = APPPATH . 'models/entity/' . $table_name . '.php';
        $content = $this->create_model_content_for_table($table_name);
        $this->create_file($dir, $content);
        if ($generate_models) {
            $dir = APPPATH . 'models/model_' . $table_name . '.php';
            $content = '<?php  if (!defined("BASEPATH")){exit("No direct script access allowed");}  include_once "entity/' . $table_name . '.php";  class model_' . $table_name . ' extends ' . $table_name . ' {  public function __construct(){ parent::__construct(); }  }  ?>';
            $this->create_file($dir, $content);
        }
    }

    public function create_model_content_for_table($table_name = FALSE) {

        if (array_key_exists($table_name, $this->models_content)) {
            return $this->models_content[$table_name];
        }

        $model_content = "";
        $obj_table = FALSE;
        if ($table_name) {
            $this->get_all_tables();
            $obj_table = new table($table_name);
            $model_content = $obj_table->get_string_class();
        }
        unset($obj_table);
        return $model_content;
    }

    public function dump_models_file() {
        var_dump($this->models_content);
        exit;
    }

}

?>