<?php

abstract class field_datatype {

    static function date($dbms = 'mysql') {
        switch ($dbms) {
            default :
                return 'date';
                break;
        }
    }

    static function datetime($dbms = 'mysql') {
        switch ($dbms) {
            default :
                return 'datetime';
                break;
        }
    }

    static function blob($dbms = 'mysql') {
        switch ($dbms) {
            default :
                return 'blob';
                break;
        }
    }

}

class table extends LWS_Model {

    public $fields = array();
    public $fields_data = array();
    public $primary_key_field_name = '';
    public $string_class_model_pattern = '<?php  if (!defined("BASEPATH")){exit("No direct script access allowed");}  class %s extends |PREFIX|Model {  %s  }  ?>';
    public $string_class_model = '';
    public $string_class_body = '';
    public $string_construct_pattern = 'public function __construct()  { parent::__construct("%s"); $this->primary_key = "%s"; } ';
    public $string_construct = '';
    public $string_attribute_label_pattern = '"%s" => array("%s","%s"), ';
    public $string_attribute_label = '';
    public $string_attributes_label_pattern = 'protected $attribute_labels = array( %s ); ';
    public $string_attributes_label = '';
    public $string_rule_pattern = 'array("%s",""), ';
    public $string_rule = '';
    public $string_attributes_rules_pattern = ' protected $rules = array( %s); ';
    public $string_attributes_rules = '';
    public $string_related_tables_pattern = ' protected $related_tables = array(%s); ';
    public $string_related_tables = '';
    public $string_types_pattern = '"%s" => "%s", ';
    public $string_types = '';
    public $string_attribute_types_pattern = ' protected $attribute_types = array(%s); ';
    public $string_attribute_types = '';
    public $subclass_prefix = "LWS_";

    public function __construct($table_name = '') {
        parent::__construct($table_name);

        $this->subclass_prefix = $this->config->item('subclass_prefix');
        $this->string_class_model_pattern = str_replace('|PREFIX|', $this->subclass_prefix, $this->string_class_model_pattern);
    }

    public function get_properties() {
        if ($this->table_exists() && !$this->fields_has_value()) {
            $this->fields = $this->db->list_fields($this->table_name);
        }
        return $this->fields;
    }

    public function table_exists() {
        return $this->db->table_exists($this->table_name);
    }

    private function fields_has_value() {
        return array_have_value($this->fields);
    }

    private function fields_data_has_value() {
        return array_have_value($this->fields_data);
    }

    private function initialize_fields() {
        $this->get_fields();
        $this->get_fields_data();
    }

    private function get_string_construct() {
        if ($this->string_construct == '') {
            $this->string_construct = sprintf($this->string_construct_pattern, $this->table_name, $this->get_primary_key_field_name());
        }
        return $this->string_construct;
    }

    private function set_string_attribute_label_and_rule() {
        foreach ($this->fields as $field) {
            $this->string_attribute_label.=sprintf($this->string_attribute_label_pattern, $field, $field, beautify_str($field));
            $this->string_rule.=sprintf($this->string_rule_pattern, $field);
        }
    }

    private function get_string_attribute_label() {
        if ($this->string_attribute_label == '') {
            $this->set_string_attribute_label_and_rule();
        }
        return $this->string_attribute_label;
    }

    private function get_string_attributes_label() {
        if ($this->string_attributes_label == '') {
            $this->string_attributes_label = sprintf($this->string_attributes_label_pattern, $this->get_string_attribute_label());
        }
        return $this->string_attributes_label;
    }

    private function get_string_rule() {
        if ($this->string_rule == '') {
            $this->set_string_attribute_label_and_rule();
        }
        return $this->string_rule;
    }

    private function get_string_attributes_rules() {
        if ($this->string_attributes_rules == '') {
            $this->string_attributes_rules = sprintf($this->string_attributes_rules_pattern, $this->get_string_rule());
        }
        return $this->string_attributes_rules;
    }

    /**
     * Not Implemented Yet, please do it manually
     * @author Lahir Wisada Santoso <lahirwisada@gmail.com>
     * @return string
     */
    private function get_string_related_tables() {
        if ($this->string_related_tables == '') {
            $this->string_related_tables = sprintf($this->string_related_tables_pattern, "");
        }
        return $this->string_related_tables;
    }

    private function get_string_attributes_types() {
        if ($this->string_attribute_types == '') {
            $this->string_attribute_types = sprintf($this->string_attribute_types_pattern, $this->get_string_types());
        }
        return $this->string_attribute_types;
    }

    /**
     * not implemented yet
     * support : MYSQL
     * @author Lahir Wisada Santoto <lahirwisada@gmail.com>
     * @return array
     */
    private function get_string_types() {
        /**
          if ($this->string_types == '') {
          $this->initialize_fields();

          function get_types($item) {
          return $item->type == field_datatype::datetime() ||
          $item->type == field_datatype::date() ||
          $item->type == field_datatype::blob();
          }

          //            public $string_types_pattern = '"%s" => "%s", ';
          $arr_field_types = array_filter($this->fields_data, 'get_types');
          if (array_have_value($arr_field_types)) {
          foreach($arr_field_types as $key => $field){
          if($field->type == field_datatype::datetime()){
          $this->string_types .= sprintf($this->string_types_pattern, $field->name, 'DATETIME');
          }elseif($field->type == field_datatype::date()){
          $this->string_types .= sprintf($this->string_types_pattern, $field->name, 'DATE');
          }elseif($field->type == field_datatype::blob()){
          $this->string_types .= sprintf($this->string_types_pattern, $field->name, 'CLOB');
          }
          }
          }
          unset($arr_field_types);
          }
         * 
         */
        return $this->string_types;
    }

    private function get_string_class_body() {
        if ($this->string_class_body == '') {
            $this->string_class_body .= $this->get_string_construct();
            $this->string_class_body .= $this->get_string_attributes_label();
            $this->string_class_body .= $this->get_string_attributes_rules();
            $this->string_class_body .= $this->get_string_related_tables();
            $this->string_class_body .= $this->get_string_attributes_types();
        }
        return $this->string_class_body;
    }

    public function get_string_class() {
        $this->initialize_fields();
        if ($this->string_class_model == '') {
            $this->string_class_model = sprintf($this->string_class_model_pattern, $this->table_name, $this->get_string_class_body());
        }
        return $this->string_class_model;
    }

    public function get_fields() {
        if (!$this->fields_has_value()) {
            $this->fields = $this->db->list_fields($this->table_name);
        }
        return $this->fields;
    }

    private function get_primary_key_field_name() {
        if ($this->primary_key_field_name == '') {
            $this->initialize_fields();

            if (!function_exists('get_arr_key')) {

                function get_arr_key($item) {
                    return $item->primary_key == 1;
                }

            }

            $arr_primary_key = array_filter($this->fields_data, 'get_arr_key');
            $obj_primary_key = FALSE;
            if (array_have_value($arr_primary_key)) {
                $obj_primary_key = array_shift($arr_primary_key);
                $this->primary_key_field_name = $obj_primary_key->name;
            }
            unset($arr_primary_key, $obj_primary_key);
        }
        return $this->primary_key_field_name;
    }

    /**
     * 
     * @param type $field_name
     * @return type array('name'=>'', 'type'=>'', 'max_length'=>'', 'primary_key'=>'')
     */
    private function _get_field_data($field_name = '') {
        if ($field_name != '' && $this->table_exists() && $this->db->field_exists($field_name, $this->table_name)) {
            $this->fields_data[$field_name] = $this->db->field_data($field_name);
        }

        if ($this->fields_data_has_value() && array_key_exists($field_name, $this->fields_data)) {
            return $this->fields_data[$field_name];
        }
        return array();
    }

    private function _get_fields_data() {
        if ($this->fields_data_has_value()) {
            //ensure $this->fields have values
            $this->get_properties();

            if ($this->fields_has_value()) {
                foreach ($this->fields as $field_name) {
                    $this->fields_data[$field_name] = $this->_get_field_data($field_name);
                }
            }
        }
        return $this->fields_data;
    }

    public function get_fields_data($field_name = FALSE) {
        if ($field_name) {
            return $this->_get_field_data($field_name);
        }

        return $this->_get_fields_data();
    }

}
