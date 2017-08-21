<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class exportexcel extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("PHPExcel/PHPExcel");
        $this->load->model('model_laporan');
    }

    function laporan($temp = "satpur", $bulan = 1, $tahun = 2014) {

        return $this->$temp($bulan, $tahun);
    }

    function multikorps($bulan, $tahun) {
        
    }

    function satpur($bulan, $tahun) {

        $records = $this->model_laporan->get_tempur_by_kotama_and_golongan($bulan, $tahun);
        // echo "<pre>";
        // print_r($records);
        // //exit;

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAPITULASI KEKUATAN PERSONEL SATPUR, SATBANPUR DAN SATPASSUS')->setCellValue('A2', 'Triwulan ' . $bulan . ' Tahun ' . $tahun);

        $objPHPExcel->getActiveSheet()->setCellValue('A4', "NO");
        $objPHPExcel->getActiveSheet()->setCellValue('B4', "KOTAMA/GOL");
        $objPHPExcel->getActiveSheet()->setCellValue('C4', "TOP");
        $objPHPExcel->getActiveSheet()->setCellValue('D4', "NYATA");
        $objPHPExcel->getActiveSheet()->setCellValue('E4', "+/-");
        $objPHPExcel->getActiveSheet()->setCellValue('F4', "%");
        $objPHPExcel->getActiveSheet()->setCellValue('G4', "KET");

        $huruf = "A";
        $aa = 1;
        $pp = 5;
        while ($huruf <= "G") {
            $objPHPExcel->getActiveSheet()->setCellValue($huruf . $pp, $aa);
            $huruf = chr(ord($huruf) + 1);
            $aa++;
        }

        $akhir = 7;
        $angkat = 1;
        $next_list_number = 1;
        $pa_top = 0;
        $pa_nyata = 0;
        $ba_top = 0;
        $ba_nyata = 0;
        $ta_top = 0;
        $ta_nyata = 0;
        $total_top = 0;
        $total_nyata = 0;

        foreach ($records as $kotama => $golongans):

            $sub_top = 0;
            $sub_nyata = 0;
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $akhir, $next_list_number);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $akhir, beautify_str($kotama));

            foreach ($golongans as $golongan => $data):
                $akhir = $akhir + 1;

                if ($data['nyata'] == 0 OR $data['top'] == 0) {
                    $nyata_per_top = 0;
                } else {
                    $nyata_per_top = ($data['nyata'] / $data['top']) * 100;
                }

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $akhir, $next_list_number++);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $akhir, beautify_str($golongan));
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $akhir, $data['top']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $akhir, $data['nyata']);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $akhir, $data['nyata'] - $data['top']);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $akhir, $nyata_per_top);

                $sub_top += $data["top"];
                $sub_nyata += $data["nyata"];
                ${strtolower($golongan) . "_top"} += $data["top"];
                ${strtolower($golongan) . "_nyata"} += $data["nyata"];

            endforeach;
            $akhir = $akhir + 1;

            $objPHPExcel->getActiveSheet()->setCellValue('B' . $akhir, 'Jumlah');
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $akhir, $sub_top);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $akhir, $sub_nyata);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $akhir, $sub_nyata - $sub_top);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $akhir, ($sub_nyata / $sub_top) * 100);
            $akhir = $akhir + 2;

            //   $akhir = $akhir + 2;

            $total_top += $sub_top;
            $total_nyata += $sub_nyata;


        endforeach;

        $akhir = $akhir + 2;
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $akhir, 'Rekapitulasi');
        $akhir = $akhir + 1;
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $akhir, 'PA');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $akhir, $pa_top);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $akhir, $pa_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $akhir, $pa_nyata - $pa_top);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $akhir, ($pa_nyata / $pa_top) * 100);

        $akhir = $akhir + 1;

        $objPHPExcel->getActiveSheet()->setCellValue('B' . $akhir, 'BA');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $akhir, $ba_top);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $akhir, $ba_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $akhir, $ba_nyata - $ba_top);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $akhir, ($ba_nyata / $ba_top) * 100);

        $akhir = $akhir + 1;

        $objPHPExcel->getActiveSheet()->setCellValue('B' . $akhir, 'TA');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $akhir, $ta_top);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $akhir, $ta_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $akhir, $ta_nyata - $ta_top);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $akhir, ($ta_nyata / $ta_top) * 100);



        $akhir = $akhir + 1;

        $objPHPExcel->getActiveSheet()->setCellValue('B' . $akhir, 'Jumlah Besar');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $akhir, $total_top);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $akhir, $total_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $akhir, $total_top - $total_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $akhir, ($total_top / $total_nyata) * 100);


        //  exit; 
        //    exit;
        $dit = strtotime(date('Y-m-d H:i:s'));

        $objPHPExcel->getActiveSheet()->setTitle('Laporan Satpur');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $dit . '.xlsx"');
        $objWriter->save("php://output");
    }

}
