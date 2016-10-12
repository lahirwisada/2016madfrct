<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of qr_tes
 *
 * @author nurfadillah
 */
class qr_tes extends LWS_Controller {

    public function __consturct() {
        parent::__construct();
    }

    public function can_access() {
        return TRUE;
    }

    public function index() {

        $this->load->library('lws_qr');

        $code_content = "http://sidika.tangerangselatankota.go.id/spt/andi_baskoro";
        $this->lws_qr->create($code_content, "", 4, 5, 95);
    }
    
    public function test() {

        $this->load->library('lws_qr');

        $code_content = "http://sidika.tangerangselatankota.go.id/spt/aris";
        $this->lws_qr->create($code_content, "", 4, 5, 95);
    }

}
