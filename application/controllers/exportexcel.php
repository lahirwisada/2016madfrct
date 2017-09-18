<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class exportexcel extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library("PHPExcel/PHPExcel");
        $this->load->model('model_laporan');
    }

    public function struktur($bulan = 1, $tahun = 2014) {
        $records['rekap'] = $this->model_laporan->get_by_rekap_structure($bulan, $tahun);
        $records['luar'] = $this->model_laporan->get_by_out_structure($bulan, $tahun);
        $records['dalam'] = $this->model_laporan->get_by_in_structure($bulan, $tahun);

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('REKAPITULASI');

        // Rekapitulasi
//        var_dump($records['rekap']);
//        exit();
        if ($records['rekap']) {

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);

            $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
            $objPHPExcel->getActiveSheet()->mergeCells('A2:C2');
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('A1', 'MARKAS BESAR ANGKATAN DARAT')
                    ->setCellValue('A2', 'STAFF UMUM PERSONEL');
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);

            $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
            $objPHPExcel->getActiveSheet()->getStyle('A2:C2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $objPHPExcel->getActiveSheet()->mergeCells('A4:N4');
            $objPHPExcel->getActiveSheet()->mergeCells('A5:N5');
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('A4', 'REKAPITULASI KEKUATAN PERSONEL DALAM DAN LUAR STRUKTUR TNI AD')
                    ->setCellValue('A5', 'BULAN ' . strtoupper(array_month($bulan)) . ' TAHUN ' . $tahun);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE);
            $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE);

            $objPHPExcel->getActiveSheet()->mergeCells('A7:A8');
            $objPHPExcel->getActiveSheet()->mergeCells('B7:E7');
            $objPHPExcel->getActiveSheet()->mergeCells('F7:I7');
            $objPHPExcel->getActiveSheet()->mergeCells('J7:M7');
            $objPHPExcel->getActiveSheet()->mergeCells('N7:N8');
            $objPHPExcel->getActiveSheet()->setCellValue('A7', "GOLONGAN/PANGKAT");
            $objPHPExcel->getActiveSheet()->setCellValue('B7', "DALAM STRUKTUR");
            $objPHPExcel->getActiveSheet()->setCellValue('F7', "LUAR STRUKTUR");
            $objPHPExcel->getActiveSheet()->setCellValue('J7', "REKAPITULASI STRUKTUR");
            $objPHPExcel->getActiveSheet()->setCellValue('N7', "KETERANGAN");

            $objPHPExcel->getActiveSheet()->setCellValue('B8', "TOP/DSPP");
            $objPHPExcel->getActiveSheet()->setCellValue('C8', "NYATA");
            $objPHPExcel->getActiveSheet()->setCellValue('D8', "+/-");
            $objPHPExcel->getActiveSheet()->setCellValue('E8', "%");
            $objPHPExcel->getActiveSheet()->setCellValue('F8', "TOP/DSPP");
            $objPHPExcel->getActiveSheet()->setCellValue('G8', "NYATA");
            $objPHPExcel->getActiveSheet()->setCellValue('H8', "+/-");
            $objPHPExcel->getActiveSheet()->setCellValue('I8', "%");
            $objPHPExcel->getActiveSheet()->setCellValue('J8', "TOP/DSPP");
            $objPHPExcel->getActiveSheet()->setCellValue('K8', "NYATA");
            $objPHPExcel->getActiveSheet()->setCellValue('L8', "+/-");
            $objPHPExcel->getActiveSheet()->setCellValue('M8', "%");

            $objPHPExcel->getActiveSheet()->getStyle('A7:N8')->getAlignment()->setWrapText(TRUE);
            $objPHPExcel->getActiveSheet()->getStyle('A7:N8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A7:N8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $cell = 10;

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

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $key);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $cell)->getFont()->setBold(TRUE);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $cell)->getFont()->setUnderline(TRUE);

                $cell = $cell + 1;

                foreach ($record as $k => $row):

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

                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, beautify_str($row['pangkat']));
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, $dalam_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $cell, $dalam_nyata);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $cell, $dalam_nyata - $dalam_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $cell, $dalam_top < 1 ? 0 : $dalam_nyata / $dalam_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $cell, $luar_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('G' . $cell, $luar_nyata);
                    $objPHPExcel->getActiveSheet()->setCellValue('H' . $cell, $luar_nyata - $luar_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $cell, $luar_top < 1 ? 0 : $luar_nyata / $luar_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $cell, $total_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('K' . $cell, $total_nyata);
                    $objPHPExcel->getActiveSheet()->setCellValue('L' . $cell, $total_nyata - $total_top);
                    $objPHPExcel->getActiveSheet()->setCellValue('M' . $cell, $total_top < 1 ? 0 : $total_nyata / $total_top);

                    $cell = $cell + 1;

                endforeach;
                $total_dalam_top += $sub_dalam_top;
                $total_dalam_nyata += $sub_dalam_nyata;
                $total_luar_top += $sub_luar_top;
                $total_luar_nyata += $sub_luar_nyata;
                $total_total_top += $sub_total_top;
                $total_total_nyata += $sub_total_nyata;

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, 'JUMLAH ' . beautify_str($key));
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, $sub_dalam_top);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $cell, $sub_dalam_nyata);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $cell, $sub_dalam_nyata - $sub_dalam_top);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $cell, $sub_dalam_top < 1 ? 0 : $sub_dalam_nyata / $sub_dalam_top);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $cell, $sub_luar_top);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $cell, $sub_luar_nyata);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $cell, $sub_luar_nyata - $sub_luar_top);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $cell, $sub_luar_top < 1 ? 0 : $sub_luar_nyata / $sub_luar_top);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $cell, $sub_total_top);
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $cell, $sub_total_nyata);
                $objPHPExcel->getActiveSheet()->setCellValue('L' . $cell, $sub_total_nyata - $sub_total_top);
                $objPHPExcel->getActiveSheet()->setCellValue('M' . $cell, $sub_total_top < 1 ? 0 : $sub_total_nyata / $sub_total_top);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $cell . ':N' . $cell)->getFont()->setBold(TRUE);
                $cell = $cell + 2;

            endforeach;

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, 'JUMLAH BESAR');
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, $total_dalam_top);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $cell, $total_dalam_nyata);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $cell, $total_dalam_nyata - $total_dalam_top);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $cell, $total_dalam_top < 1 ? 0 : $total_dalam_nyata / $total_dalam_top);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $cell, $total_luar_top);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $cell, $total_luar_nyata);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $cell, $total_luar_nyata - $total_luar_top);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $cell, $total_luar_top < 1 ? 0 : $total_luar_nyata / $total_luar_top);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $cell, $total_total_top);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $cell, $total_total_nyata);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $cell, $total_total_nyata - $total_total_top);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $cell, $total_total_top < 1 ? 0 : $total_total_nyata / $total_total_top);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $cell . ':N' . $cell)->getFont()->setBold(TRUE);

            $objPHPExcel->getActiveSheet()->getStyle('A7:N' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('A7:A' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('B7:B' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('C7:C' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('D7:D' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('E7:E' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('F7:F' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('G7:G' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('H7:H' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('I7:I' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('J7:J' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('K7:K' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('L7:L' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('M7:M' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('N7:N' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('A7:N8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $cell . ':N' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('A7:N7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);

            $objPHPExcel->getActiveSheet()->getStyle('B10:C' . $cell)->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->getActiveSheet()->getStyle('D10:D' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
            $objPHPExcel->getActiveSheet()->getStyle('F10:G' . $cell)->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->getActiveSheet()->getStyle('H10:H' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
            $objPHPExcel->getActiveSheet()->getStyle('J10:K' . $cell)->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->getActiveSheet()->getStyle('L10:L' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
            $objPHPExcel->getActiveSheet()->getStyle('E10:E' . $cell)->getNumberFormat()->setFormatCode('#,##0.00%');
            $objPHPExcel->getActiveSheet()->getStyle('I10:I' . $cell)->getNumberFormat()->setFormatCode('#,##0.00%');
            $objPHPExcel->getActiveSheet()->getStyle('M10:M' . $cell)->getNumberFormat()->setFormatCode('#,##0.00%');
        } else {
            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Belum ada data...!');
        }

        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet()->setTitle('DALAM STRUKTUR');

        // Dalam Struktur
//        var_dump($records['dalam']);
//        exit();
        if ($records['dalam']) {

            $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
            $objPHPExcel->getActiveSheet()->mergeCells('A2:C2');
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('A1', 'MARKAS BESAR ANGKATAN DARAT')
                    ->setCellValue('A2', 'STAFF UMUM PERSONEL');

            $objPHPExcel->getActiveSheet()->mergeCells('A4:I4');
            $objPHPExcel->getActiveSheet()->mergeCells('A5:I5');
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('A4', 'REKAPITULASI KEKUATAN PERSONEL DALAM STRUKTUR TNI AD')
                    ->setCellValue('A5', 'BULAN ' . strtoupper(array_month($bulan)) . ' TAHUN ' . $tahun);

            $objPHPExcel->getActiveSheet()->mergeCells('A7:A8');
            $objPHPExcel->getActiveSheet()->mergeCells('B7:B8');
            $objPHPExcel->getActiveSheet()->mergeCells('C7:G7');
            $objPHPExcel->getActiveSheet()->mergeCells('H7:H8');
            $objPHPExcel->getActiveSheet()->mergeCells('I7:I8');
            $objPHPExcel->getActiveSheet()->setCellValue('A7', "GOLONGAN/PANGKAT");
            $objPHPExcel->getActiveSheet()->setCellValue('B7', "TOP");
            $objPHPExcel->getActiveSheet()->setCellValue('C7', "KEKUATAN NYATA");
            $objPHPExcel->getActiveSheet()->setCellValue('H7', "+/-");
            $objPHPExcel->getActiveSheet()->setCellValue('I7', "%");

            $objPHPExcel->getActiveSheet()->setCellValue('C8', "DINAS");
            $objPHPExcel->getActiveSheet()->setCellValue('D8', "MPP");
            $objPHPExcel->getActiveSheet()->setCellValue('E8', "LF");
            $objPHPExcel->getActiveSheet()->setCellValue('F8', "SKORSING");
            $objPHPExcel->getActiveSheet()->setCellValue('G8', "JUMLAH");

            $cell = 10;

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

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, beautify_str($key));

                $cell = $cell + 1;
                foreach ($record as $row):

                    $total = $row['dinas'] + $row['mpp'] + $row['lf'] + $row['skorsing'];
                    $sub_top += $row['top'];
                    $sub_dinas += $row['dinas'];
                    $sub_mpp += $row['mpp'];
                    $sub_lf += $row['lf'];
                    $sub_skorsing += $row['skorsing'];
                    $sub_total += $total;

                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, beautify_str($row['pangkat']));
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, $row['top']);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $cell, $row['dinas']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $cell, $row['mpp']);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $cell, $row['lf']);
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $cell, $row['skorsing']);
                    $objPHPExcel->getActiveSheet()->setCellValue('G' . $cell, $total);
                    $objPHPExcel->getActiveSheet()->setCellValue('H' . $cell, $total - $row['top']);
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $cell, $row['top'] == 0 ? 0 : $total / $row['top'] * 100);
                    $cell = $cell + 1;

                endforeach;
                $total_top += $sub_top;
                $total_dinas += $sub_dinas;
                $total_mpp += $sub_mpp;
                $total_lf += $sub_lf;
                $total_skorsing += $sub_skorsing;
                $total_total += $sub_total;

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, 'JUMLAH ' . beautify_str($key));
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, $sub_top);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $cell, $sub_dinas);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $cell, $sub_mpp);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $cell, $sub_lf);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $cell, $sub_skorsing);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $cell, $sub_total);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $cell, $sub_total - $sub_top);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $cell, $sub_top == 0 ? 0 : $sub_total / $sub_top * 100);

                $cell = $cell + 2;
            endforeach;

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, 'JUMLAH BESAR');
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, $total_top);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $cell, $total_dinas);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $cell, $total_mpp);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $cell, $total_lf);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $cell, $total_skorsing);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $cell, $total_total);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $cell, $total_total - $total_top);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $cell, $total_top == 0 ? 0 : $total_total / $total_top * 100);
        } else {
            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Belum ada data...!');
        }


        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(2);
        $objPHPExcel->getActiveSheet(2)->setTitle('LUAR STRUKTUR');

        // Luar Struktur
        $luar = $records['luar'];
        $kotamas = $luar['kotama'];
        $data = $luar['data'];
        if ($luar) {
            $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
            $objPHPExcel->getActiveSheet()->mergeCells('A2:C2');
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('A1', 'MARKAS BESAR ANGKATAN DARAT')
                    ->setCellValue('A2', 'STAFF UMUM PERSONEL');

            $objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
            $objPHPExcel->getActiveSheet()->mergeCells('A5:G5');
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('A4', 'REKAPITULASI KEKUATAN PERSONEL LUAR STRUKTUR TNI AD')
                    ->setCellValue('A5', 'BULAN ' . strtoupper(array_month($bulan)) . ' TAHUN ' . $tahun);

            $jml_kotama = count($luar['kotama']);
            $ha = "C";

            $next = chr(ord($ha) + $jml_kotama);
            $objPHPExcel->getActiveSheet()->mergeCells('A7:A8');
            $objPHPExcel->getActiveSheet()->mergeCells('B7:B8');
            $objPHPExcel->getActiveSheet()->mergeCells('C7:' . $next . '7');
            $objPHPExcel->getActiveSheet()->mergeCells(chr(ord($next) + 1) . '7:' . chr(ord($next) + 1) . '8');
            $objPHPExcel->getActiveSheet()->mergeCells(chr(ord($next) + 2) . '7:' . chr(ord($next) + 2) . '8');
            $objPHPExcel->getActiveSheet()->setCellValue('A7', "GOLONGAN/PANGKAT");
            $objPHPExcel->getActiveSheet()->setCellValue('B7', "TOP");
            $objPHPExcel->getActiveSheet()->setCellValue('C7', "KEKUATAN NYATA");
            $objPHPExcel->getActiveSheet()->setCellValue(chr(ord($next) + 1) . '7', "+/-");
            $objPHPExcel->getActiveSheet()->setCellValue(chr(ord($next) + 2) . '7', "%");
            foreach ($kotamas as $kotama):
                $objPHPExcel->getActiveSheet()->setCellValue($ha . '8', $kotama);
                $ha = chr(ord($ha) + 1);
            endforeach;
            $objPHPExcel->getActiveSheet()->setCellValue($ha . '8', "JUMLAH");

            $cell = 10;
            $total_top = 0;
            $total_sub = array();
            $total_total = 0;

            foreach ($data as $tingkat => $record):
                $sub_top = 0;
                $sub_sub = array();
                $sub_total = 0;

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, beautify_str($tingkat));

                $cell = $cell + 1;
//                var_dump($record);
//                exit();
                foreach ($record as $row):
                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, beautify_str($row['pangkat']));
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, $row['top']);
                    $aw = 'C';
                    $jml = 0;
                    foreach ($row['jml'] as $key => $value) :
                        $objPHPExcel->getActiveSheet()->setCellValue($aw . $cell, $value);
                        $jml += $value;
                        $sub_sub[$key] = isset($sub_sub[$key]) ? $sub_sub[$key] + $value : $value;
                        $total_sub[$key] = isset($total_sub[$key]) ? $total_sub[$key] + $value : $value;
                        $aw = chr(ord($aw) + 1);
                    endforeach;
                    $objPHPExcel->getActiveSheet()->setCellValue(chr(ord($aw) + 0) . $cell, $jml);
                    $objPHPExcel->getActiveSheet()->setCellValue(chr(ord($aw) + 1) . $cell, $jml - $row['top']);
                    $objPHPExcel->getActiveSheet()->setCellValue(chr(ord($aw) + 2) . $cell, $row['top'] == 0 ? 0 : $jml / $row['top'] * 100);
                    $cell += 1;
                    $sub_top += $row['top'];
                    $sub_total += $jml;
                endforeach;

                $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, 'JUMLAH ' . beautify_str($tingkat));
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, $sub_top);
                $as = 'C';
                for ($i = 1; $i <= $jml_kotama; $i++) :
                    $objPHPExcel->getActiveSheet()->setCellValue($as . $cell, $sub_sub[$i]);
                    $as = chr(ord($as) + 1);
                endfor;
                $objPHPExcel->getActiveSheet()->setCellValue(chr(ord($aw) + 0) . $cell, $sub_total);
                $objPHPExcel->getActiveSheet()->setCellValue(chr(ord($aw) + 1) . $cell, $sub_total - $sub_top);
                $objPHPExcel->getActiveSheet()->setCellValue(chr(ord($aw) + 2) . $cell, $sub_top == 0 ? 0 : $sub_total / $sub_top * 100);

                $cell += 2;
                $total_top += $sub_top;
                $total_total += $sub_total;
                unset($sub_sub);
            endforeach;

            $objPHPExcel->getActiveSheet(2)->setCellValue('A' . $cell, 'JUMLAH BESAR');
            $objPHPExcel->getActiveSheet(2)->setCellValue('B' . $cell, $total_top);

            $ah = 'C';
            for ($i = 1; $i <= $jml_kotama; $i++) :
                $objPHPExcel->getActiveSheet()->setCellValue($ah . $cell, $total_sub[$i]);
                $ah = chr(ord($ah) + 1);
            endfor;
            $objPHPExcel->getActiveSheet()->setCellValue(chr(ord($ah) + 0) . $cell, $total_total);
            $objPHPExcel->getActiveSheet()->setCellValue(chr(ord($ah) + 1) . $cell, $total_total - $total_top);
            $objPHPExcel->getActiveSheet()->setCellValue(chr(ord($ah) + 2) . $cell, $total_top == 0 ? 0 : $total_total / $total_top * 100);
            unset($total_sub);
        } else {
            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Belum ada data...!');
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="LaporanStruktur.xlsx"');
        $objWriter->save("php://output");
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
