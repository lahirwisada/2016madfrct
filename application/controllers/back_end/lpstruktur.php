<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . "controllers/back_end/mslaporan.php";

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

        $records['rekap'] = $this->model_laporan->get_by_rekap_structure($bulan, $tahun);
        $records['dalam'] = $this->model_laporan->get_by_in_structure($bulan, $tahun);
        $records['luar'] = $this->model_laporan->get_by_out_structure($bulan, $tahun);

        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    function export($bulan = 1, $tahun = 2014) {
        $this->load->library("PHPExcel/PHPExcel");
        $records['rekap'] = $this->model_laporan->get_by_rekap_structure($bulan, $tahun);
        $records['luar'] = $this->model_laporan->get_by_out_structure($bulan, $tahun);
        $records['dalam'] = $this->model_laporan->get_by_in_structure($bulan, $tahun);

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // Rekapitulasi

        $asrekap = $objPHPExcel->getActiveSheet();
        $asrekap->setTitle('REKAPITULASI');
        $asrekap->getDefaultStyle()->getFont()->setName('Arial')->setSize(12);
        $asrekap->getSheetView()->setZoomScale(70);

        if ($records['rekap']) {
            $asrekap->getColumnDimension('A')->setWidth(25.43);
            $asrekap->getColumnDimension('B')->setWidth(9.86);
            $asrekap->getColumnDimension('C')->setWidth(9.86);
            $asrekap->getColumnDimension('D')->setWidth(9.86);
            $asrekap->getColumnDimension('E')->setWidth(9.86);
            $asrekap->getColumnDimension('F')->setWidth(9.86);
            $asrekap->getColumnDimension('G')->setWidth(9.86);
            $asrekap->getColumnDimension('H')->setWidth(9.86);
            $asrekap->getColumnDimension('I')->setWidth(9.86);
            $asrekap->getColumnDimension('J')->setWidth(9.86);
            $asrekap->getColumnDimension('K')->setWidth(9.86);
            $asrekap->getColumnDimension('L')->setWidth(9.86);
            $asrekap->getColumnDimension('M')->setWidth(9.86);
            $asrekap->getColumnDimension('N')->setWidth(17.86);

            $asrekap->mergeCells('A1:C1');
            $asrekap->mergeCells('A2:C2');
            $asrekap->setCellValue('A1', 'MARKAS BESAR ANGKATAN DARAT')
                    ->setCellValue('A2', 'STAFF UMUM PERSONEL');
            $asrekap->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $asrekap->getStyle('A1:A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $asrekap->getStyle('A1:A2')->getFont()->setBold(TRUE);

            $asrekap->getStyle('A2:C2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $asrekap->mergeCells('A4:N4');
            $asrekap->mergeCells('A5:N5');
            $asrekap->setCellValue('A4', 'REKAPITULASI KEKUATAN PERSONEL DALAM DAN LUAR STRUKTUR TNI AD')
                    ->setCellValue('A5', 'BULAN ' . strtoupper(array_month($bulan)) . ' TAHUN ' . $tahun);
            $asrekap->getStyle('A4:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $asrekap->getStyle('A4:A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $asrekap->getStyle('A4:A5')->getFont()->setBold(TRUE);

            $asrekap->mergeCells('A7:A8');
            $asrekap->mergeCells('B7:E7');
            $asrekap->mergeCells('F7:I7');
            $asrekap->mergeCells('J7:M7');
            $asrekap->mergeCells('N7:N8');
            $asrekap->setCellValue('A7', "GOLONGAN/PANGKAT");
            $asrekap->setCellValue('B7', "DALAM STRUKTUR");
            $asrekap->setCellValue('F7', "LUAR STRUKTUR");
            $asrekap->setCellValue('J7', "REKAPITULASI STRUKTUR");
            $asrekap->setCellValue('N7', "KETERANGAN");
            $asrekap->setCellValue('B8', "TOP/DSPP");
            $asrekap->setCellValue('C8', "NYATA");
            $asrekap->setCellValue('D8', "+/-");
            $asrekap->setCellValue('E8', "%");
            $asrekap->setCellValue('F8', "TOP/DSPP");
            $asrekap->setCellValue('G8', "NYATA");
            $asrekap->setCellValue('H8', "+/-");
            $asrekap->setCellValue('I8', "%");
            $asrekap->setCellValue('J8', "TOP/DSPP");
            $asrekap->setCellValue('K8', "NYATA");
            $asrekap->setCellValue('L8', "+/-");
            $asrekap->setCellValue('M8', "%");

            $asrekap->getStyle('A7:N8')->getAlignment()->setWrapText(TRUE);
            $asrekap->getStyle('A7:N8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $asrekap->getStyle('A7:N8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $cell = 10;

            $fn_total_dalam_top = '';
            $fn_total_dalam_nyata = '';
            $fn_total_luar_top = '';
            $fn_total_luar_nyata = '';
            $fn_total_rekap_top = '';
            $fn_total_rekap_nyata = '';

            foreach ($records['rekap'] as $key => $record):

                $asrekap->setCellValue('A' . $cell, $key);
                $asrekap->getStyle('A' . $cell)->getFont()->setBold(TRUE);
                $asrekap->getStyle('A' . $cell)->getFont()->setUnderline(TRUE);

                $cell = $cell + 1;
                $cella = $cell;

                foreach ($record as $k => $row):

                    $dalam_top = array_key_exists('dalam_top', $row) ? $row['dalam_top'] : 0;
                    $dalam_nyata = array_key_exists('dalam_nyata', $row) ? $row['dalam_nyata'] : 0;
                    $luar_top = array_key_exists('luar_top', $row) ? $row['luar_top'] : 0;
                    $luar_nyata = array_key_exists('luar_nyata', $row) ? $row['luar_nyata'] : 0;

                    $asrekap->setCellValue('A' . $cell, beautify_str($row['pangkat']));
                    $asrekap->setCellValue('B' . $cell, $dalam_top);
                    $asrekap->setCellValue('C' . $cell, $dalam_nyata);
                    $asrekap->setCellValue('D' . $cell, '=C' . $cell . '-B' . $cell);
                    $asrekap->setCellValue('E' . $cell, '=IF(B' . $cell . '>0,C' . $cell . '/B' . $cell . ',0)');
                    $asrekap->setCellValue('F' . $cell, $luar_top);
                    $asrekap->setCellValue('G' . $cell, $luar_nyata);
                    $asrekap->setCellValue('H' . $cell, '=G' . $cell . '-F' . $cell);
                    $asrekap->setCellValue('I' . $cell, '=IF(F' . $cell . '>0,G' . $cell . '/F' . $cell . ',0)');
                    $asrekap->setCellValue('J' . $cell, '=B' . $cell . '+F' . $cell);
                    $asrekap->setCellValue('K' . $cell, '=C' . $cell . '+G' . $cell);
                    $asrekap->setCellValue('L' . $cell, '=K' . $cell . '-J' . $cell);
                    $asrekap->setCellValue('M' . $cell, '=IF(J' . $cell . '>0,K' . $cell . '/J' . $cell . ',0)');

                    $cell = $cell + 1;

                endforeach;
                $fn_total_dalam_top .= $fn_total_dalam_top == '' ? '=B' . $cell : '+B' . $cell;
                $fn_total_dalam_nyata .= $fn_total_dalam_nyata == '' ? '=C' . $cell : '+C' . $cell;
                $fn_total_luar_top .= $fn_total_luar_top == '' ? '=F' . $cell : '+F' . $cell;
                $fn_total_luar_nyata .= $fn_total_luar_nyata == '' ? '=G' . $cell : '+G' . $cell;
                $fn_total_rekap_top .= $fn_total_rekap_top == '' ? '=J' . $cell : '+J' . $cell;
                $fn_total_rekap_nyata .= $fn_total_rekap_nyata == '' ? '=K' . $cell : '+K' . $cell;

                $asrekap->setCellValue('A' . $cell, 'JUMLAH ' . beautify_str($key));
                $asrekap->setCellValue('B' . $cell, '=SUM(B' . $cella . ':B' . ($cell - 1) . ')');
                $asrekap->setCellValue('C' . $cell, '=SUM(C' . $cella . ':C' . ($cell - 1) . ')');
                $asrekap->setCellValue('D' . $cell, '=C' . $cell . '-B' . $cell);
                $asrekap->setCellValue('E' . $cell, '=IF(B' . $cell . '>0,C' . $cell . '/B' . $cell . ',0)');
                $asrekap->setCellValue('F' . $cell, '=SUM(F' . $cella . ':F' . ($cell - 1) . ')');
                $asrekap->setCellValue('G' . $cell, '=SUM(G' . $cella . ':G' . ($cell - 1) . ')');
                $asrekap->setCellValue('H' . $cell, '=G' . $cell . '-F' . $cell);
                $asrekap->setCellValue('I' . $cell, '=IF(F' . $cell . '>0,G' . $cell . '/F' . $cell . ',0)');
                $asrekap->setCellValue('J' . $cell, '=SUM(J' . $cella . ':J' . ($cell - 1) . ')');
                $asrekap->setCellValue('K' . $cell, '=SUM(K' . $cella . ':K' . ($cell - 1) . ')');
                $asrekap->setCellValue('L' . $cell, '=K' . $cell . '-J' . $cell);
                $asrekap->setCellValue('M' . $cell, '=IF(J' . $cell . '>0,K' . $cell . '/J' . $cell . ',0)');
                $asrekap->getStyle('A' . $cell . ':N' . $cell)->getFont()->setBold(TRUE);
                $cell = $cell + 2;

            endforeach;

            $asrekap->setCellValue('A' . $cell, 'JUMLAH BESAR');
            $asrekap->setCellValue('B' . $cell, $fn_total_dalam_top);
            $asrekap->setCellValue('C' . $cell, $fn_total_dalam_nyata);
            $asrekap->setCellValue('D' . $cell, '=C' . $cell . '-B' . $cell);
            $asrekap->setCellValue('E' . $cell, '=IF(B' . $cell . '>0,C' . $cell . '/B' . $cell . ',0)');
            $asrekap->setCellValue('F' . $cell, $fn_total_luar_top);
            $asrekap->setCellValue('G' . $cell, $fn_total_luar_nyata);
            $asrekap->setCellValue('H' . $cell, '=G' . $cell . '-F' . $cell);
            $asrekap->setCellValue('I' . $cell, '=IF(F' . $cell . '>0,G' . $cell . '/F' . $cell . ',0)');
            $asrekap->setCellValue('J' . $cell, $fn_total_rekap_top);
            $asrekap->setCellValue('K' . $cell, $fn_total_rekap_nyata);
            $asrekap->setCellValue('L' . $cell, '=K' . $cell . '-J' . $cell);
            $asrekap->setCellValue('M' . $cell, '=IF(J' . $cell . '>0,K' . $cell . '/J' . $cell . ',0)');
            $asrekap->getStyle('A' . $cell . ':N' . $cell)->getFont()->setBold(TRUE);

            $asrekap->getStyle('A7:N' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_HAIR);
            $asrekap->getStyle('A7:A' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('B7:B' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('C7:C' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('D7:D' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('E7:E' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('F7:F' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('G7:G' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('H7:H' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('I7:I' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('J7:J' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('K7:K' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('L7:L' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('M7:M' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('N7:N' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('A7:N8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('A' . $cell . ':N' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asrekap->getStyle('A7:N7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);

            $asrekap->getStyle('B10:C' . $cell)->getNumberFormat()->setFormatCode('#,##0');
            $asrekap->getStyle('D10:D' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
            $asrekap->getStyle('F10:G' . $cell)->getNumberFormat()->setFormatCode('#,##0');
            $asrekap->getStyle('H10:H' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
            $asrekap->getStyle('J10:K' . $cell)->getNumberFormat()->setFormatCode('#,##0');
            $asrekap->getStyle('L10:L' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
            $asrekap->getStyle('E10:E' . $cell)->getNumberFormat()->setFormatCode('#,##0.00%');
            $asrekap->getStyle('I10:I' . $cell)->getNumberFormat()->setFormatCode('#,##0.00%');
            $asrekap->getStyle('M10:M' . $cell)->getNumberFormat()->setFormatCode('#,##0.00%');
        } else {
            $asrekap->setCellValue('A1', 'Belum ada data...!');
        }

        // Dalam Struktur

        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(1);
        $asdalam = $objPHPExcel->getActiveSheet();
        $asdalam->setTitle('DALAM STRUKTUR');
        $asdalam->getSheetView()->setZoomScale(70);

        if ($records['dalam']) {
            $asdalam->getColumnDimension('A')->setWidth(29.29);
            $asdalam->getColumnDimension('B')->setWidth(12.86);
            $asdalam->getColumnDimension('C')->setWidth(12.86);
            $asdalam->getColumnDimension('D')->setWidth(12.86);
            $asdalam->getColumnDimension('E')->setWidth(12.86);
            $asdalam->getColumnDimension('F')->setWidth(12.86);
            $asdalam->getColumnDimension('G')->setWidth(12.86);
            $asdalam->getColumnDimension('H')->setWidth(12.86);
            $asdalam->getColumnDimension('I')->setWidth(12.86);

            $asdalam->mergeCells('A1:C1');
            $asdalam->mergeCells('A2:C2');
            $asdalam->setCellValue('A1', 'MARKAS BESAR ANGKATAN DARAT')
                    ->setCellValue('A2', 'STAFF UMUM PERSONEL');
            $asdalam->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $asdalam->getStyle('A1:A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $asdalam->getStyle('A1:A2')->getFont()->setBold(TRUE);
            $asdalam->getStyle('A2:C2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $asdalam->mergeCells('A4:I4');
            $asdalam->mergeCells('A5:I5');
            $asdalam->setCellValue('A4', 'REKAPITULASI KEKUATAN PERSONEL DALAM DAN LUAR STRUKTUR TNI AD')
                    ->setCellValue('A5', 'BULAN ' . strtoupper(array_month($bulan)) . ' TAHUN ' . $tahun);
            $asdalam->getStyle('A4:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $asdalam->getStyle('A4:A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $asdalam->getStyle('A4:A5')->getFont()->setBold(TRUE);

            $asdalam->mergeCells('A7:A8');
            $asdalam->mergeCells('B7:B8');
            $asdalam->mergeCells('C7:G7');
            $asdalam->mergeCells('H7:H8');
            $asdalam->mergeCells('I7:I8');
            $asdalam->setCellValue('A7', "GOLONGAN/PANGKAT");
            $asdalam->setCellValue('B7', "TOP");
            $asdalam->setCellValue('C7', "KEKUATAN NYATA");
            $asdalam->setCellValue('H7', "+/-");
            $asdalam->setCellValue('I7', "%");

            $asdalam->setCellValue('C8', "DINAS");
            $asdalam->setCellValue('D8', "MPP");
            $asdalam->setCellValue('E8', "LF");
            $asdalam->setCellValue('F8', "SKORSING");
            $asdalam->setCellValue('G8', "JUMLAH");

            $asdalam->getStyle('A7:I8')->getAlignment()->setWrapText(TRUE);
            $asdalam->getStyle('A7:I8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $asdalam->getStyle('A7:I8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

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

                $asdalam->setCellValue('A' . $cell, beautify_str($key));

                $asdalam->getStyle('A' . $cell)->getFont()->setBold(TRUE);
                $asdalam->getStyle('A' . $cell)->getFont()->setUnderline(TRUE);
                $cell = $cell + 1;
                foreach ($record as $row):

                    $total = $row['dinas'] + $row['mpp'] + $row['lf'] + $row['skorsing'];
                    $sub_top += $row['top'];
                    $sub_dinas += $row['dinas'];
                    $sub_mpp += $row['mpp'];
                    $sub_lf += $row['lf'];
                    $sub_skorsing += $row['skorsing'];
                    $sub_total += $total;

                    $asdalam->setCellValue('A' . $cell, beautify_str($row['pangkat']));
                    $asdalam->setCellValue('B' . $cell, $row['top']);
                    $asdalam->setCellValue('C' . $cell, $row['dinas']);
                    $asdalam->setCellValue('D' . $cell, $row['mpp']);
                    $asdalam->setCellValue('E' . $cell, $row['lf']);
                    $asdalam->setCellValue('F' . $cell, $row['skorsing']);
                    $asdalam->setCellValue('G' . $cell, '=SUM(C' . $cell . ':F' . $cell . ')');
                    $asdalam->setCellValue('H' . $cell, '=G' . $cell . '-B' . $cell);
                    $asdalam->setCellValue('I' . $cell, '=IF(B' . $cell . '>0,G' . $cell . '/B' . $cell . ',0)');
                    $cell = $cell + 1;

                endforeach;
                $total_top += $sub_top;
                $total_dinas += $sub_dinas;
                $total_mpp += $sub_mpp;
                $total_lf += $sub_lf;
                $total_skorsing += $sub_skorsing;
                $total_total += $sub_total;

                $asdalam->setCellValue('A' . $cell, 'JUMLAH ' . beautify_str($key))->getStyle('A' . $cell);
                $asdalam->setCellValue('B' . $cell, $sub_top)->getStyle('B' . $cell);
                $asdalam->setCellValue('C' . $cell, $sub_dinas)->getStyle('C' . $cell);
                $asdalam->setCellValue('D' . $cell, $sub_mpp)->getStyle('D' . $cell);
                $asdalam->setCellValue('E' . $cell, $sub_lf)->getStyle('E' . $cell);
                $asdalam->setCellValue('F' . $cell, $sub_skorsing)->getStyle('F' . $cell);
                $asdalam->setCellValue('G' . $cell, $sub_total)->getStyle('G' . $cell);
                $asdalam->setCellValue('H' . $cell, $sub_total - $sub_top)->getStyle('H' . $cell);
                $asdalam->setCellValue('I' . $cell, '=IF(B' . $cell . '>0,G' . $cell . '/B' . $cell . ',0)')->getStyle('I' . $cell);
                $asdalam->getStyle('A' . $cell . ':I' . $cell)->getFont()->setBold(TRUE);

                $cell = $cell + 2;

            endforeach;

            $asdalam->setCellValue('A' . $cell, 'JUMLAH BESAR')->getStyle('A' . $cell);
            $asdalam->setCellValue('B' . $cell, $total_top)->getStyle('B' . $cell);
            $asdalam->setCellValue('C' . $cell, $total_dinas)->getStyle('C' . $cell);
            $asdalam->setCellValue('D' . $cell, $total_mpp)->getStyle('D' . $cell);
            $asdalam->setCellValue('E' . $cell, $total_lf)->getStyle('E' . $cell);
            $asdalam->setCellValue('F' . $cell, $total_skorsing)->getStyle('F' . $cell);
            $asdalam->setCellValue('G' . $cell, $total_total)->getStyle('G' . $cell);
            $asdalam->setCellValue('H' . $cell, $total_total - $total_top)->getStyle('H' . $cell);
            $asdalam->setCellValue('I' . $cell, '=IF(B' . $cell . '>0,G' . $cell . '/B' . $cell . ',0)')->getStyle('I' . $cell);
            $asdalam->getStyle('A' . $cell . ':I' . $cell)->getFont()->setBold(TRUE);

            $asdalam->getStyle('A7:I' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_HAIR);
            $asdalam->getStyle('A7:A' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asdalam->getStyle('B7:B' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asdalam->getStyle('C7:C' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asdalam->getStyle('D7:D' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asdalam->getStyle('E7:E' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asdalam->getStyle('F7:F' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asdalam->getStyle('G7:G' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asdalam->getStyle('H7:H' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asdalam->getStyle('I7:I' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asdalam->getStyle('A7:I8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asdalam->getStyle('A' . $cell . ':I' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asdalam->getStyle('A7:I7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);

            $asdalam->getStyle('B10:C' . $cell)->getNumberFormat()->setFormatCode('#,##0');
            $asdalam->getStyle('D10:D' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
            $asdalam->getStyle('E10:F' . $cell)->getNumberFormat()->setFormatCode('#,##0');
            $asdalam->getStyle('F10:G' . $cell)->getNumberFormat()->setFormatCode('#,##0');
            $asdalam->getStyle('H10:H' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
            $asdalam->getStyle('I10:I' . $cell)->getNumberFormat()->setFormatCode('#,##0.00%');
        } else {
            $asdalam->setCellValue('A1', 'Belum ada data...!');
        }

        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(2);
        $asluar = $objPHPExcel->getActiveSheet();
        $asluar->setTitle('LUAR STRUKTUR');
        $asluar->getSheetView()->setZoomScale(70);

        // Luar Struktur
        $luar = $records['luar'];
        $kotamas = $luar['kotama'];
        $jml_kotama = count($luar['kotama']);
        $jml_column = $jml_kotama + 5;
        $golongan_column = 'A';
        $top_column = chr(ord('A') + 1);
        $jumlah_column = chr(ord('A') + $jml_column - 3);
        $plus_column = chr(ord('A') + $jml_column - 2);
        $persen_column = chr(ord('A') + $jml_column - 1);
        $data = $luar['data'];
        if ($luar) {
            $asluar->getColumnDimension($golongan_column)->setWidth(29.29);
            $asluar->getColumnDimension($top_column)->setWidth(12.86);
            for ($i = 0; $i < $jml_kotama; $i++) {
                $asluar->getColumnDimension(chr(ord('B') + $i))->setWidth(12.86);
            }
            $asluar->getColumnDimension($jumlah_column)->setWidth(12.86);
            $asluar->getColumnDimension($plus_column)->setWidth(12.86);
            $asluar->getColumnDimension($persen_column)->setWidth(12.86);

            $asluar->mergeCells('A1:C1');
            $asluar->mergeCells('A2:C2');
            $asluar->setCellValue('A1', 'MARKAS BESAR ANGKATAN DARAT')
                    ->setCellValue('A2', 'STAFF UMUM PERSONEL');
            $asluar->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $asluar->getStyle('A1:A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $asluar->getStyle('A1:A2')->getFont()->setBold(TRUE);
            $asluar->getStyle('A2:C2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $asluar->mergeCells('A4:' . $persen_column . '4');
            $asluar->mergeCells('A5:' . $persen_column . '5');
            $asluar->setCellValue('A4', 'REKAPITULASI KEKUATAN PERSONEL LUAR STRUKTUR TNI AD')
                    ->setCellValue('A5', 'BULAN ' . strtoupper(array_month($bulan)) . ' TAHUN ' . $tahun);
            $asluar->getStyle('A4:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $asluar->getStyle('A4:A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $asluar->getStyle('A4:A5')->getFont()->setBold(TRUE);

            $ha = "C";

            $next = chr(ord($ha) + $jml_kotama);
            $asluar->mergeCells('A7:A8');
            $asluar->mergeCells('B7:B8');
            $asluar->mergeCells('C7:' . $next . '7');
            $asluar->mergeCells(chr(ord($next) + 1) . '7:' . chr(ord($next) + 1) . '8');
            $asluar->mergeCells(chr(ord($next) + 2) . '7:' . chr(ord($next) + 2) . '8');
            $asluar->setCellValue('A7', "GOLONGAN/PANGKAT");
            $asluar->setCellValue('B7', "TOP");
            $asluar->setCellValue('C7', "KEKUATAN NYATA");
            $asluar->setCellValue(chr(ord($next) + 1) . '7', "+/-");
            $asluar->setCellValue(chr(ord($next) + 2) . '7', "%");
            foreach ($kotamas as $kotama):
                $asluar->setCellValue($ha . '8', $kotama);
                $ha = chr(ord($ha) + 1);
            endforeach;
            $asluar->setCellValue($ha . '8', "JUMLAH");
            $asluar->getStyle('A7:' . $ha . '7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $asluar->getStyle('A7:' . $ha . '7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $cell = 10;
            $total_top = 0;
            $total_sub = array();
            $total_total = 0;

            foreach ($data as $tingkat => $record):
                $sub_top = 0;
                $sub_sub = array();
                $sub_total = 0;

                $asluar->setCellValue('A' . $cell, beautify_str($tingkat));

                $cell = $cell + 1;
                foreach ($record as $row):
                    $asluar->setCellValue('A' . $cell, beautify_str($row['pangkat']));
                    $asluar->setCellValue('B' . $cell, $row['top']);
                    $aw = 'C';
                    $jml = 0;
                    foreach ($row['jml'] as $key => $value) :
                        $asluar->setCellValue($aw . $cell, $value);
                        $jml += $value;
                        $sub_sub[$key] = isset($sub_sub[$key]) ? $sub_sub[$key] + $value : $value;
                        $total_sub[$key] = isset($total_sub[$key]) ? $total_sub[$key] + $value : $value;
                        $aw = chr(ord($aw) + 1);
                    endforeach;
                    $asluar->setCellValue(chr(ord($aw) + 0) . $cell, $jml);
                    $asluar->setCellValue(chr(ord($aw) + 1) . $cell, $jml - $row['top']);
                    $asluar->setCellValue(chr(ord($aw) + 2) . $cell, $row['top'] == 0 ? 0 : $jml / $row['top']);
                    $cell += 1;
                    $sub_top += $row['top'];
                    $sub_total += $jml;
                endforeach;
                $asluar->setCellValue('A' . $cell, 'JUMLAH ' . beautify_str($tingkat));
                $asluar->setCellValue('B' . $cell, $sub_top);
                $as = 'C';
                foreach ($sub_sub as $row) {
                    $asluar->setCellValue($as . $cell, $row);
                    $as = chr(ord($as) + 1);
                }
                $asluar->setCellValue(chr(ord($as) + 0) . $cell, $sub_total);
                $asluar->setCellValue(chr(ord($as) + 1) . $cell, $sub_total - $sub_top);
                $asluar->setCellValue(chr(ord($as) + 2) . $cell, $sub_top == 0 ? 0 : $sub_total / $sub_top);
                $asluar->getStyle('A' . $cell . ':' . chr(ord($as) + 2) . $cell)->getFont()->setBold(TRUE);
//
                $cell += 2;
                $total_top += $sub_top;
                $total_total += $sub_total;
                unset($sub_sub);
            endforeach;

            $asluar->setCellValue('A' . $cell, 'JUMLAH BESAR');
            $asluar->setCellValue('B' . $cell, $total_top);
            $ah = 'C';
            foreach ($total_sub as $row) {
                $asluar->setCellValue($ah . $cell, $row);
                $ah = chr(ord($ah) + 1);
            }
            $asluar->setCellValue(chr(ord($ah) + 0) . $cell, $total_total);
            $asluar->setCellValue(chr(ord($ah) + 1) . $cell, $total_total - $total_top);
            $asluar->setCellValue(chr(ord($ah) + 2) . $cell, $total_top == 0 ? 0 : $total_total / $total_top);
            $asluar->getStyle('A' . $cell . ':' . chr(ord($ah) + 2) . $cell)->getFont()->setBold(TRUE);
            unset($total_sub);

            $asluar->getStyle('A7:' . $persen_column . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_HAIR);
            $asluar->getStyle('A7:A' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $asluar->getStyle('B7:B' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $aj = 'C';
            for ($i = 0; $i < $jml_kotama + 3; $i++) {
                $asluar->getStyle($aj . '7:' . $aj . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $asluar->getStyle($aj . '10:' . $aj . $cell)->getNumberFormat()->setFormatCode('#,##0');
                $aj = chr(ord($aj) + 1);
            }
            $asluar->getStyle('A7:' . $persen_column . '7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);

            $asluar->getStyle('B10:B' . $cell)->getNumberFormat()->setFormatCode('#,##0');
            $asluar->getStyle($plus_column . '10:' . $plus_column . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
            $asluar->getStyle($persen_column . '10:' . $persen_column . $cell)->getNumberFormat()->setFormatCode('#,##0.00%');
        } else {
            $asluar->setCellValue('A1', 'Belum ada data...!');
        }
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="LaporanStruktur.xlsx"');
        $objWriter->save("php://output");
        exit();
    }

}
