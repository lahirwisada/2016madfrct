<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . "controllers/back_end/mslaporan.php";

class Lpsatkowil extends Mslaporan {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_satbalak', 'Rekapitulasi SATKOWIL/SATINTEL');
        $this->load->model('model_laporan');
    }

    public function index() {
        $this->get_attention_message_from_session();

        $response = $this->get_bulan_tahun();
        extract($response);

        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
        $records = array(
            'golongan' => $this->model_laporan->get_satkowil_by_kotama_and_golongan($bulan, $tahun),
            'detail' => $this->model_laporan->get_satkowil_by_satminkal_and_golongan($bulan, $tahun),
        );
//        var_dump($records);
//        exit();
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
    }
    function export($tipe = "rekap", $bulan = 1, $tahun = 2014){

               $this->load->library("PHPExcel/PHPExcel");
              $records = array(
            'golongan' => $this->model_laporan->get_satkowil_by_kotama_and_golongan($bulan, $tahun),
            'detail' => $this->model_laporan->get_satkowil_by_satminkal_and_golongan($bulan, $tahun),
        );

              $objPHPExcel = new PHPExcel();
              $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAPITULASI KEKUATAN PERSONEL SATKOWIL DAN SATINTEL TNI AD')->setCellValue('A2', 'Bulan ' . $bulan . ' Tahun ' . $tahun);

        $objPHPExcel->getActiveSheet()->setCellValue('A4','NO');
        $objPHPExcel->getActiveSheet()->setCellValue('B4','KESATUAN');
        $objPHPExcel->getActiveSheet()->setCellValue('C4','GOLONGAN');
        $objPHPExcel->getActiveSheet()->setCellValue('D4','TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('E4','NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('F4','+/-');
        $objPHPExcel->getActiveSheet()->setCellValue('G4','%');
        $objPHPExcel->getActiveSheet()->setCellValue('H4','KET');
        $h = "A";
        $i = 1;
        while($i < 9){
            $objPHPExcel->getActiveSheet()->setCellValue($h.'5',$i);
            $h = chr(ord($h) + 1);
            $i++;
        }

        $cell = 7;
           $next_list_number = 1;
                                            $pa_top = 0;
                                            $pa_nyata = 0;
                                            $ba_top = 0;
                                            $ba_nyata = 0;
                                            $ta_top = 0;
                                            $ta_nyata = 0;
                                            $total_top = 0;
                                            $total_nyata = 0;

            foreach ($records['golongan'] as $kotama => $record): 

                 $mulai = TRUE;
                 $sub_top = 0;
                 $sub_nyata = 0;


                foreach ($record as $row) :
                        $objPHPExcel->getActiveSheet()->setCellValue('A'.$cell,$next_list_number);
                        $objPHPExcel->getActiveSheet()->setCellValue('B'.$cell, $mulai ? beautify_str($kotama) :'');
                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell, beautify_str($row['golongan']));
                        $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell, $row['top']);
                        $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell,$row['nyata']);
                        $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,$row['nyata'] - $row['top']);
                        $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$row["top"] > 0 ? number_format($row["nyata"] / $row["top"] * 100, 1, ",", ".") : 0);

                            $cell = $cell + 1;

                $mulai = FALSE;
                 $sub_top += $row["top"];
                  $sub_nyata += $row["nyata"];
                  ${strtolower($row['golongan']) . "_top"} += $row["top"];
                  ${strtolower($row['golongan']) . "_nyata"} += $row["nyata"];

                endforeach;

            
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,beautify_str('JML'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,number_format($sub_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell, number_format($sub_nyata, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,number_format($sub_nyata - $sub_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$sub_top > 0 ? number_format($sub_nyata / $sub_top * 100, 1, ",", ".") : 0);

                    $cell = $cell +2;
                    $next_list_number++;
            endforeach;

         $objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,beautify_str('JUMLAH BESAR'));
         $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,beautify_str('PA'));
         
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,number_format($sub_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell, number_format($sub_nyata, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,number_format($sub_nyata - $sub_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$sub_top > 0 ? number_format($sub_nyata / $sub_top * 100, 1, ",", ".") : 0);



        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="LaporanSatkowil.xlsx"');
        $objWriter->save("php://output");

    }

}
