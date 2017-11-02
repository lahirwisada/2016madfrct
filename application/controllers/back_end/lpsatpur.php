<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . "controllers/back_end/mslaporan.php";

class Lpsatpur extends Mslaporan {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_satpur', 'Rekapitulasi SATPUR, SATBANPUR dan SATPASSUS');
        $this->load->model('model_laporan');
    }

    public function index($bulan = 1, $tahun = 2014) {
        $this->get_attention_message_from_session();

        $response = $this->get_bulan_tahun();
        extract($response);

        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
        $tingkat = 5;
        $records = $this->model_laporan->get_tempur_by_kotama_and_golongan($bulan, $tahun);
//        var_dump($records);
//        exit();
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
    }

    function export($bulan = 1, $tahun = 2014) {
        $records = $this->model_laporan->get_tempur_by_kotama_and_golongan($bulan, $tahun);

        $this->load->library("PHPExcel/PHPExcel");
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);

        $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
        $objPHPExcel->getActiveSheet()->mergeCells('A2:C2');
        $objPHPExcel->getActiveSheet()
                ->setCellValue('A1', 'MARKAS BESAR ANGKATAN DARAT')
                ->setCellValue('A2', 'STAFF UMUM PERSONEL');

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);

        $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
        $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:G5');
        $objPHPExcel->getActiveSheet()
                ->setCellValue('A4', 'REKAPITULASI KEKUATAN PERSONEL SATPUR, SATBANPUR DAN SATPASSUS')
                ->setCellValue('A5', 'Bulan ' . strtoupper(array_month($bulan)) . ' Tahun ' . $tahun);
        $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE);
        $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE);


        $objPHPExcel->getActiveSheet()->setCellValue('A7', "NO");
        $objPHPExcel->getActiveSheet()->setCellValue('B7', "KOTAMA/GOL");
        $objPHPExcel->getActiveSheet()->setCellValue('C7', "TOP");
        $objPHPExcel->getActiveSheet()->setCellValue('D7', "NYATA");
        $objPHPExcel->getActiveSheet()->setCellValue('E7', "+/-");
        $objPHPExcel->getActiveSheet()->setCellValue('F7', "%");
        $objPHPExcel->getActiveSheet()->setCellValue('G7', "KET");

        $huruf = "A";
        $aa = 1;
        $pp = 8;
        while ($huruf <= "G") {
            $objPHPExcel->getActiveSheet()->setCellValue($huruf . $pp, $aa);
            $huruf = chr(ord($huruf) + 1);
            $aa++;
        }


        $objPHPExcel->getActiveSheet()->getStyle('A7:G8')->getAlignment()->setWrapText(TRUE);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);



        $akhir = 10;
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
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $akhir, beautify_str($kotama))->getStyle('B' . $akhir)->getFont()->setBold(TRUE)->setUnderline(TRUE);
            $next_list_number++;
            foreach ($golongans as $golongan => $data):
                $akhir = $akhir + 1;

                if ($data['nyata'] == 0 OR $data['top'] == 0) {
                    $nyata_per_top = 0;
                } else {
                    $nyata_per_top = ($data['nyata'] / $data['top']) * 100;
                }


                $objPHPExcel->getActiveSheet()->setCellValue('A' . $akhir, '');
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

            $objPHPExcel->getActiveSheet()->setCellValue('B' . $akhir, 'Jumlah')->getStyle('B' . $akhir)->getFont()->setBold(TRUE);
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
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $akhir, 'Rekapitulasi')->getStyle('B' . $akhir)->getFont()->setBold(TRUE)->setUnderline(TRUE);
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

        $objPHPExcel->getActiveSheet()->setCellValue('B' . $akhir, 'Jumlah Besar')->getStyle('B' . $akhir)->getFont()->setBold(TRUE);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $akhir, $total_top);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $akhir, $total_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $akhir, $total_top - $total_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $akhir, ($total_top / $total_nyata) * 100);


        $cell = $akhir;
        $objPHPExcel->getActiveSheet()->getStyle('A7:G' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A7:A' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('B7:B' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('C7:C' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('D7:D' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('E7:E' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('F7:F' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('G7:G' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $cell . ':G' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('A7:G7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);

        $objPHPExcel->getActiveSheet()->getStyle('C10:C' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('E10:E' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
        $objPHPExcel->getActiveSheet()->getStyle('D10:D' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('F10:F' . $cell)->getNumberFormat()->setFormatCode('#,##0.00%');



        //  exit; 
        //    exit;
        $dit = strtotime(date('Y-m-d H:i:s'));
        $dit = 'Laporan Satpur';
        $objPHPExcel->getActiveSheet()->setTitle('Laporan Satpur');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $dit . '.xlsx"');
        $objWriter->save("php://output");
        exit();
    }

}
