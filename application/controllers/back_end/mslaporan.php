<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mslaporan extends Back_end {

    protected $auto_load_model = FALSE;

    public function __construct($cmodul_name = FALSE, $header_title = FALSE) {
        parent::__construct($cmodul_name, $header_title);
//        $this->load->model(array('model_master_kotama', 'model_master_satminkal', 'model_master_pangkat'));
    }
    
    protected function destroy_session_bulan_tahun(){
        $this->session->unset_userdata(array(
            'bulan' => "",
            'tahun' => "",
        ));
    }
    
    protected function get_bulan_tahun(){
        $response = array(
            'bulan' => $this->session->userdata('mslaporan_bulan'),
            'tahun' => $this->session->userdata('mslaporan_tahun'),
        );
        
        $this->destroy_session_bulan_tahun();
        return $response;
    }

    public function index() {
        $this->set("header_title", 'Master Laporan');

        $pilihjenis = $this->input->post('pilihjenis');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $tahun_bulan_is_number = FALSE;
        if ($pilihjenis) {
            $tahun_bulan_is_number = validate_number($pilihjenis, $tahun, $bulan);
        }

        if ($pilihjenis && $tahun_bulan_is_number) {

            $this->destroy_session_bulan_tahun();
            $this->session->set_userdata(array(
                'mslaporan_tahun' => $tahun,
                'mslaporan_bulan' => $bulan,
            ));

            switch ($pilihjenis) {
                case 1:
                    redirect('back_end/lppiramida/' );
                    break;
                case 2:
                    redirect('back_end/lpstruktur/' );
                    break;
                case 3:
                    redirect('back_end/lpkotama/' );
                    break;
                case 4:
                    redirect('back_end/lpkecabangan/' );
                    break;
                case 5:
                    redirect('back_end/lpmulti/' );
                    break;
                case 6:
                    redirect('back_end/lpsatpur/' );
                    break;
                case 7:
                    redirect('back_end/lpsatbalak/' );
                    break;
                case 8:
                    redirect('back_end/lpsatkowil/' );
                    break;
                case 9:
                    redirect('back_end/lpsatop/' );
                    break;
            }
        }
    }

}
