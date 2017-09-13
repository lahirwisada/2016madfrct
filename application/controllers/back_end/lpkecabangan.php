<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . "controllers/back_end/mslaporan.php";

class Lpkecabangan extends Mslaporan {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_kecabangan', 'Kekuatan Perkecabangan');
        $this->load->model('model_laporan');
//        $this->load->model(array('model_laporan', 'model_master_kotama', 'model_master_satminkal', 'model_master_pangkat'));
    }

    public function index() {
        $this->get_attention_message_from_session();

        $response = $this->get_bulan_tahun();
        extract($response);

        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
        $tingkat = 5;
        $records["kategori"] = $this->model_laporan->get_by_corps_and_golongan($bulan, $tahun);
        $records["tingkat"] = $this->model_laporan->get_by_corps_and_tingkat($tingkat, $bulan, $tahun);
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
    }

    function export($tipe = "rekap",$bulan = 1, $tahun = 2014){
       $this->load->library("PHPExcel/PHPExcel");

               $tingkat = 5;
        $records["kategori"] = $this->model_laporan->get_by_corps_and_golongan($bulan, $tahun);
        $records["tingkat"] = $this->model_laporan->get_by_corps_and_tingkat($tingkat, $bulan, $tahun);

         $objPHPExcel = new PHPExcel();
        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAPITULASI PA ,BA , TA PERKECABANGAN TNI AD')->setCellValue('A2', 'Bulan ' . $bulan . ' Tahun ' . $tahun);

        $objPHPExcel->getActiveSheet()->mergeCells('A4:A5');
        $objPHPExcel->getActiveSheet()->mergeCells('B4:B5');
        $objPHPExcel->getActiveSheet()->mergeCells('C4:E4');
        $objPHPExcel->getActiveSheet()->mergeCells('F4:H4');
        $objPHPExcel->getActiveSheet()->mergeCells('I4:K4');
        $objPHPExcel->getActiveSheet()->mergeCells('L4:N4');

        $objPHPExcel->getActiveSheet()->setCellValue('A4','NO');
        $objPHPExcel->getActiveSheet()->setCellValue('B4','KECAB');
        $objPHPExcel->getActiveSheet()->setCellValue('C4','PERWIRA');
        $objPHPExcel->getActiveSheet()->setCellValue('F4','BINTARA');
        $objPHPExcel->getActiveSheet()->setCellValue('I4','TAMTAMA');
        $objPHPExcel->getActiveSheet()->setCellValue('L4','JUMLAH');

        $objPHPExcel->getActiveSheet()->setCellValue('C5','TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('D5','NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('E5','+/-');
        $objPHPExcel->getActiveSheet()->setCellValue('F5','TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('G5','NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('H5','+/-');
        $objPHPExcel->getActiveSheet()->setCellValue('I5','TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('J5','NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('K5','+/-');
        $objPHPExcel->getActiveSheet()->setCellValue('L5','TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('M5','NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('N5','+/-');

         $next_list_number = 1;
                                            $perwira_top = 0;
                                            $perwira_nyata = 0;
                                            $bintara_top = 0;
                                            $bintara_nyata = 0;
                                            $tamtama_top = 0;
                                            $tamtama_nyata = 0;


        $cell = 7;
        foreach ($records["kategori"] as $record):


            $objPHPExcel->getActiveSheet()->setCellValue('A'.$cell,$next_list_number);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,beautify_str($record["corps"]));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,$record['perwira_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,$record['perwira_nyata']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell,$record['perwira_nyata'] - $record['perwira_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,$record['bintara_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$record['bintara_nyata']);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$cell,$record['bintara_nyata'] - $record['bintara_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$cell,$record['tamtama_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$cell,$record['tamtama_nyata']);
            $objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,$record['tamtama_nyata'] - $record['tamtama_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('L'.$cell,$record['perwira_top'] + $record['bintara_top'] + $record['tamtama_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('M'.$cell,$record['perwira_nyata'] + $record['bintara_nyata'] + $record['tamtama_nyata']);
            $objPHPExcel->getActiveSheet()->setCellValue('N'.$cell,($record["perwira_nyata"] + $record["bintara_nyata"] + $record["tamtama_nyata"]) - ($record["perwira_top"] + $record["bintara_top"] + $record["tamtama_top"]));
            $cell = $cell + 1;

            $next_list_number++;
                $perwira_top += $record["perwira_top"];
                                                $perwira_nyata += $record["perwira_nyata"];
                                                $bintara_top += $record["bintara_top"];
                                                $bintara_nyata += $record["bintara_nyata"];
                                                $tamtama_top += $record["tamtama_top"];
                                                $tamtama_nyata += $record["tamtama_nyata"];
        endforeach;
        $cell = $cell + 1;

        $objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,'JUMLAH ');
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,$perwira_top);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,$perwira_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell,$perwira_nyata - $perwira_top);
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,$bintara_top);
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$bintara_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$cell,$bintara_nyata - $bintara_top);
        $objPHPExcel->getActiveSheet()->setCellValue('I'.$cell,$tamtama_top);
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$cell,$tamtama_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,$tamtama_nyata - $tamtama_top);
        $objPHPExcel->getActiveSheet()->setCellValue('L'.$cell,$perwira_top + $bintara_top + $tamtama_top);
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,$perwira_nyata + $bintara_nyata + $tamtama_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,($perwira_nyata + $bintara_nyata + $tamtama_nyata) - ($perwira_top + $bintara_top + $tamtama_top));


        $objPHPExcel->getActiveSheet()->setTitle('REKAPITULASI');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="LaporanKecabangan.xlsx"');
        $objWriter->save("php://output");

    }

}
