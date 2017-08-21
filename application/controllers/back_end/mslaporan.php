<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mslaporan extends Back_end {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct();
//        $this->load->model(array('model_master_kotama', 'model_master_satminkal', 'model_master_pangkat'));
    }

    public function index() {
        $this->set("header_title", 'Master Laporan');
//        $this->form_validation->set_rules('jenislaporan', 'Jenis Laporan', 'required|integer');
//        $this->form_validation->set_rules('tahun', 'Tahun Laporan', 'required|integer');
//        $this->form_validation->set_rules('jenislaporan', 'Bulan Laporan', 'required|integer');
//        if ($this->form_validation->run() === FALSE) {
//            echo 'Hallo';
//        } else {
//            echo 'Ada';
//        }
        if (isset($_POST['pilihjenis'])) {
            $jenis = $_POST['pilihjenis'];
            $tahun = $_POST['tahun'];
            $bulan = $_POST['bulan'];
            switch ($jenis) {
                case 1:
                    redirect('back_end/lppiramida/index/' . $bulan . '/' . $tahun);
                    break;
                case 2:
                    redirect('back_end/lpstruktur/index/' . $bulan . '/' . $tahun);
                    break;
                case 3:
                    redirect('back_end/lpkotama/index/' . $bulan . '/' . $tahun);
                    break;
                case 4:
                    redirect('back_end/lpkecabangan/index/' . $bulan . '/' . $tahun);
                    break;
                case 5:
                    redirect('back_end/lpmulti/index/' . $bulan . '/' . $tahun);
                    break;
                case 6:
                    redirect('back_end/lpsatpur/index/' . $bulan . '/' . $tahun);
                    break;
                case 7:
                    redirect('back_end/lpsatbalak/index/' . $bulan . '/' . $tahun);
                    break;
                case 8:
                    redirect('back_end/lpsatkowil/index/' . $bulan . '/' . $tahun);
                    break;
                case 9:
                    redirect('back_end/lpsatop/index/' . $bulan . '/' . $tahun);
                    break;
            }
        }
    }

}
