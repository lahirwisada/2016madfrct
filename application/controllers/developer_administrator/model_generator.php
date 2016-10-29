<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_generator extends LWS_Controller {
    
    public function access_rules() {
        return array(
            array(
                'allow',
                'actions' => array("index", "generate_em", "generate_entities"),
                'users' => array('*')
            ),
            array(
                'allow',
                'users' => array('@')
            )
        );
    }

    public function __construct() {
        parent::__construct();
        $this->load->model('developer_administrator/wrought');
    }

    public function index() {
        echo "halo";exit;
    }

    /**
     * em Entities and Models
     */
    public function generate_em() {

        $generate_model = FALSE;
        if ($this->input->get('generate_model') == 'ok') {
            $generate_model = TRUE;
        }
        $this->wrought->create_models($generate_model);
        $this->wrought->dump_models_file();
    }

    public function generate_entities() {
        $generate_single = TRUE;
        if ($this->input->get('generate_multiple') != FALSE) {
            $generate_single = FALSE;
        }
        $generate_model = TRUE;
        if ($this->input->get('without_model') != FALSE) {
            $generate_model = FALSE;
        }
        $table_name = $this->input->get('table_name');
        if (!$generate_single) {
            $this->wrought->create_models($generate_model);
        } else {
            if ($table_name) {
                $this->wrought->create_model_for_table($table_name, $generate_model);
            }
        }
        $this->wrought->dump_models_file();
        exit;
    }

}
