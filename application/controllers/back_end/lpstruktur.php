<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH."controllers/back_end/mslaporan.php";

class Lpstruktur extends Mslaporan {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_struktur', 'Kekuatan Dalam Dan Luar Struktur');
        $this->load->model('model_laporan');
//        $this->load->model(array('model_laporan', 'model_master_kotama', 'model_master_satminkal', 'model_master_pangkat'));
    }

    public function index() {
        $this->get_attention_message_from_session();

        $response = $this->get_bulan_tahun();
        extract($response);

//        $tingkat = 5;
        $records['rekap'] = $this->model_laporan->get_by_rekap_structure($bulan, $tahun);
        $records['dalam'] = $this->model_laporan->get_by_in_structure($bulan, $tahun);
        $records['luar'] = $this->model_laporan->get_by_out_structure($bulan, $tahun);
//        var_dump($records);exit();

      
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    function export($tipe = 'rekap',$bulan = 1,$tahun = 2014){     
       $this->load->library("PHPExcel/PHPExcel");
        if($tipe == "rekap"){
        $records['rekap'] = $this->model_laporan->get_by_rekap_structure($bulan, $tahun);          
          $records['luar'] = $this->model_laporan->get_by_out_structure($bulan, $tahun);
            $records['dalam'] = $this->model_laporan->get_by_in_structure($bulan, $tahun);

        }else if($tipe == "dalam"){
            $records['dalam'] = $this->model_laporan->get_by_in_structure($bulan, $tahun);
        }else if($tipe == "luar"){
            $records['luar'] = $this->model_laporan->get_by_out_structure($bulan, $tahun);
        }else{
            redirect('404');
        }
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAPITULASI KEKUATAN PERSONEL DALAM DAN LUAR STRUKTUR TNI AD')->setCellValue('A2', 'Bulan ' . $bulan . ' Tahun ' . $tahun);


        $objPHPExcel->getActiveSheet()->mergeCells('A4:A5');
        $objPHPExcel->getActiveSheet()->mergeCells('B4:B5');
        $objPHPExcel->getActiveSheet()->mergeCells('A4:A5');
        $objPHPExcel->getActiveSheet()->setCellValue('A4', "NO");
        $objPHPExcel->getActiveSheet()->setCellValue('B4', "GOLONGAN/PANGKAT");
         $objPHPExcel->getActiveSheet()->setCellValue('C4', "DALAM STRUKTUR");
        $objPHPExcel->getActiveSheet()->setCellValue('H4', "LUAR STRUKTUR");
        $objPHPExcel->getActiveSheet()->setCellValue('L4', "REKAPITULASI STRUKTUR");
        $objPHPExcel->getActiveSheet()->setCellValue('O4', "KETERANGAN");


        $objPHPExcel->getActiveSheet()->setCellValue('C5', "TOP/DSPP");
        $objPHPExcel->getActiveSheet()->setCellValue('D5', "NYATA");
        $objPHPExcel->getActiveSheet()->setCellValue('E5', "+/-");
        $objPHPExcel->getActiveSheet()->setCellValue('F5', "%");
        $objPHPExcel->getActiveSheet()->setCellValue('G5', "TOP/DSPP");
        $objPHPExcel->getActiveSheet()->setCellValue('H5', "NYATA");
        $objPHPExcel->getActiveSheet()->setCellValue('I5', "+/-");
        $objPHPExcel->getActiveSheet()->setCellValue('J5', "%");
        $objPHPExcel->getActiveSheet()->setCellValue('K5', "TOP/DSPP");
        $objPHPExcel->getActiveSheet()->setCellValue('L5', "NYATA");
        $objPHPExcel->getActiveSheet()->setCellValue('M5', "+/-");
        $objPHPExcel->getActiveSheet()->setCellValue('N5', "%");

        $cell = 7;

        if($records != FALSE){

                $total_dalam_top = 0;
                $total_dalam_nyata = 0;
                $total_luar_top = 0;
                $total_luar_nyata = 0;
                 $total_total_top = 0;
                 $total_total_nyata = 0;

                    foreach ($records['rekap'] as $key => $record):
                                                    $sub_dalam_top = 0;
                                                    $sub_dalam_nyata = 0;
                                                    $sub_luar_top = 0;
                                                    $sub_luar_nyata = 0;
                                                    $sub_total_top = 0;
                                                    $sub_total_nyata = 0;

                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,$key);

                    $cell = $cell + 1;

                    foreach($record as $k => $row):

                         $dalam_top = $row['dalam_top'];
                          $dalam_nyata = $row['dalam_nyata'];
                           $luar_top = array_key_exists('luar_top', $row) ? $row['luar_top'] : 0;
                           $luar_nyata = array_key_exists('luar_nyata', $row) ? $row['luar_nyata'] : 0;
                           $total_top = $dalam_top + $luar_top;
                           $total_nyata = $dalam_nyata + $luar_nyata;
                            $sub_dalam_top += $dalam_top;
                            $sub_dalam_nyata += $dalam_nyata;
                             $sub_luar_top += $luar_top;
                            $sub_luar_nyata += $luar_nyata;
                             $sub_total_top += $total_top;
                            $sub_total_nyata += $total_nyata;

                            $objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,beautify_str($row['pangkat']));
                            $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,$dalam_top);


                            $cell = $cell + 1;


                    endforeach;
                    $total_dalam_top += $sub_dalam_top;
                                                    $total_dalam_nyata += $sub_dalam_nyata;
                                                    $total_luar_top += $sub_luar_top;
                                                    $total_luar_nyata += $sub_luar_nyata;
                                                    $total_total_top += $sub_total_top;
                                                    $total_total_nyata += $sub_total_nyata;

                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,'Jumlah '.beautify_str($key));
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,
                        $sub_dalam_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,
                        $sub_dalam_nyata);
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell,$sub_dalam_nyata - $sub_dalam_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,$sub_dalam_top < 1 ? 0 : $sub_dalam_nyata / $sub_dalam_top * 100);
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$sub_luar_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$cell,$sub_luar_nyata);
                    $objPHPExcel->getActiveSheet()->setCellValue('I'.$cell,$sub_luar_nyata - $sub_luar_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('J'.$cell,$sub_luar_top < 1 ? 0 : $sub_luar_nyata / $sub_luar_top * 100);
                    $objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,$sub_total_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('L'.$cell,$sub_total_nyata);
                    $objPHPExcel->getActiveSheet()->setCellValue('M'.$cell,$sub_total_nyata - $sub_total_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('N'.$cell,$sub_total_top < 1 ? 0 : $sub_total_nyata / $sub_total_top * 100);
                    $cell = $cell + 2;

                    endforeach;

                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,'Jumlah Besar');
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,
                        $total_dalam_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,$total_dalam_nyata);
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell,$total_dalam_nyata - $total_dalam_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,$total_dalam_top < 1 ? 0 : $total_dalam_nyata / $total_dalam_top * 100);
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$total_luar_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$cell,$total_luar_nyata);
                    $objPHPExcel->getActiveSheet()->setCellValue('I'.$cell,$total_luar_nyata - $total_luar_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('J'.$cell,$total_luar_top < 1 ? 0 : $total_luar_nyata / $total_luar_top * 100);
                    $objPHPExcel->getActiveSheet()->setCellValue('K'.$cell,$total_total_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('M'.$cell,$total_total_nyata);
                    $objPHPExcel->getActiveSheet()->setCellValue('N'.$cell,$total_total_nyata - $total_total_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('O'.$cell,$total_total_top < 1 ? 0 : $total_total_nyata / $total_total_top * 100);
        
        $objPHPExcel->getActiveSheet()->setTitle('REKAPITULASI');

    $objPHPExcel->createSheet();

        $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet(1)->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet(1)->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet(1)->setCellValue('A1', 'REKAPITULASI KEKUATAN PERSONEL DALAM STRUKTUR TNI AD
')->setCellValue('A2', 'Bulan ' . $bulan . ' Tahun ' . $tahun);


        $objPHPExcel->getActiveSheet(1)->mergeCells('A4:A5');
        $objPHPExcel->getActiveSheet(1)->mergeCells('B4:B5');
        $objPHPExcel->getActiveSheet(1)->mergeCells('C4:C5');
        $objPHPExcel->getActiveSheet(1)->mergeCells('A4:A5');
        $objPHPExcel->getActiveSheet(1)->setCellValue('A4', "NO");
        $objPHPExcel->getActiveSheet(1)->setCellValue('B4', "GOLONGAN/PANGKAT");
         $objPHPExcel->getActiveSheet(1)->setCellValue('C4', "TOP");
        $objPHPExcel->getActiveSheet(1)->setCellValue('D4', "KEKUATAN NYATA");
        $objPHPExcel->getActiveSheet(1)->setCellValue('I4', "+/-");
        $objPHPExcel->getActiveSheet(1)->setCellValue('J4', "%");


        $objPHPExcel->getActiveSheet(1)->setCellValue('D5', "DINAS");
        $objPHPExcel->getActiveSheet(1)->setCellValue('E5', "MPP");
        $objPHPExcel->getActiveSheet(1)->setCellValue('F5', "LF");
        $objPHPExcel->getActiveSheet(1)->setCellValue('G5', "SKORSING");
        $objPHPExcel->getActiveSheet(1)->setCellValue('H5', "JUMLAH");

        $cell = 7;

        if($records != FALSE){

              $total_top = 0;
              $total_dinas = 0;
              $total_mpp = 0;
               $total_lf = 0;
               $total_skorsing = 0;
               $total_total = 0;

                foreach ($records['dalam'] as $key => $record):
                                                    $sub_top = 0;
                                                    $sub_dinas = 0;
                                                    $sub_mpp = 0;
                                                    $sub_lf = 0;
                                                    $sub_skorsing = 0;
                                                    $sub_total = 0;

                                $objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,beautify_str($key));

                                $cell = $cell + 1;
                                foreach($record as $row):

                                    $total = $row->dinas + $row->mpp + $row->lf + $row->skorsing;
                                                        $sub_top += $row->top;
                                                        $sub_dinas += $row->dinas;
                                                        $sub_mpp += $row->mpp;
                                                        $sub_lf += $row->lf;
                                                        $sub_skorsing += $row->skorsing;
                                                        $sub_total += $total;

                                    $objPHPExcel->getActiveSheet(1)->setCellValue('B'.$cell,beautify_str($row->ur_pangkat));
                                    $objPHPExcel->getActiveSheet(1)->setCellValue('C'.$cell,$row->top);

                                    $objPHPExcel->getActiveSheet(1)->setCellValue('D'.$cell,$row->dinas);
                                    $objPHPExcel->getActiveSheet(1)->setCellValue('E'.$cell,$row->mpp);
                                    $objPHPExcel->getActiveSheet(1)->setCellValue('F'.$cell,$row->lf);
                                    $objPHPExcel->getActiveSheet(1)->setCellValue('G'.$cell,$row->skorsing);
                                    $objPHPExcel->getActiveSheet(1)->setCellValue('H'.$cell,$total);
                                    $objPHPExcel->getActiveSheet(1)->setCellValue('I'.$cell,$total - $row->top);
                                    $objPHPExcel->getActiveSheet(1)->setCellValue('J'.$cell,$row->top == 0 ? 0 : $total / $row->top * 100);
                                    $cell = $cell + 1;

                                endforeach;
                                 $total_top += $sub_top;
                                                    $total_dinas += $sub_dinas;
                                                    $total_mpp += $sub_mpp;
                                                    $total_lf += $sub_lf;
                                                    $total_skorsing += $sub_skorsing;
                                                    $total_total += $sub_total;
                    
                        $objPHPExcel->getActiveSheet(1)->setCellValue('B'.$cell,'JUMLAH '.beautify_str($key));
                        $objPHPExcel->getActiveSheet(1)->setCellValue('C'.$cell,$sub_top);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('D'.$cell,$sub_dinas);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('E'.$cell,$sub_mpp);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('F'.$cell,$sub_lf);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('G'.$cell,$sub_skorsing);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('H'.$cell,$sub_total);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('I'.$cell,$sub_total - $sub_top);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('J'.$cell,$sub_top == 0 ? 0 : $sub_total / $sub_top * 100);

                        $cell = $cell + 2;
                        endforeach;


                        $objPHPExcel->getActiveSheet(1)->setCellValue('B'.$cell,'JUMLAH BESAR');
                        $objPHPExcel->getActiveSheet(1)->setCellValue('C'.$cell,$total_top);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('D'.$cell,$total_dinas);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('E'.$cell,$total_mpp);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('F'.$cell,$total_lf);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('G'.$cell,$total_skorsing);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('H'.$cell,$total_total);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('I'.$cell,$total_total - $total_top);
                        $objPHPExcel->getActiveSheet(1)->setCellValue('J'.$cell,$total_top == 0 ? 0 : $total_total / $total_top * 100);


                            $objPHPExcel->getActiveSheet(1)->setTitle('DALAM STRUKTUR');


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="LaporanStruktur.xlsx"');
        $objWriter->save("php://output");



        }



    }

}
}