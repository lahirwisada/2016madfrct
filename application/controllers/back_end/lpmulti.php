<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . "controllers/back_end/mslaporan.php";

class Lpmulti extends Mslaporan {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_multi', 'Kekuatan Multikorps');
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
        $records["kategori"] = $this->model_laporan->get_multi_by_kotama_and_golongan($bulan, $tahun);
        $records["tingkat"] = $this->model_laporan->get_multi_by_kotama_and_tingkat($tingkat, $bulan, $tahun);
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
//        var_dump($records);exit();
        $this->set("records", $records);
    }

    function export($bulan = 1, $tahun = 2014) {
        $this->load->library("PHPExcel/PHPExcel");

// Rekapitulasi Multicorps

        $tingkat = 5;
        $records["kategori"] = $this->model_laporan->get_multi_by_kotama_and_golongan($bulan, $tahun);
        $records["tingkat"] = $this->model_laporan->get_multi_by_kotama_and_tingkat($tingkat, $bulan, $tahun);

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $rekap_sheet = $objPHPExcel->getActiveSheet();
        $rekap_sheet->setTitle("REKAPITULASI");
        $rekap_sheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(11);
        $rekap_sheet->getSheetView()->setZoomScale(80);

        $rekap_sheet->getColumnDimension('A')->setWidth(4);
        $rekap_sheet->getColumnDimension('B')->setWidth(30);
        $rekap_sheet->getColumnDimension('C')->setWidth(7);
        $rekap_sheet->getColumnDimension('D')->setWidth(7);
        $rekap_sheet->getColumnDimension('E')->setWidth(7);
        $rekap_sheet->getColumnDimension('F')->setWidth(7);
        $rekap_sheet->getColumnDimension('G')->setWidth(7);
        $rekap_sheet->getColumnDimension('H')->setWidth(7);
        $rekap_sheet->getColumnDimension('I')->setWidth(7);
        $rekap_sheet->getColumnDimension('J')->setWidth(7);
        $rekap_sheet->getColumnDimension('K')->setWidth(7);
        $rekap_sheet->getColumnDimension('L')->setWidth(7);
        $rekap_sheet->getColumnDimension('M')->setWidth(7);
        $rekap_sheet->getColumnDimension('N')->setWidth(7);
        $rekap_sheet->getRowDimension('8')->setRowHeight(30);
        $rekap_sheet->getRowDimension('9')->setRowHeight(30);

        $rekap_sheet->MergeCells('A1:C1')
                ->MergeCells('A2:C2')
                ->MergeCells('A5:N5')
                ->MergeCells('A6:N6')
                ->MergeCells('A8:A9')
                ->MergeCells('B8:B9')
                ->MergeCells('C8:E8')
                ->MergeCells('F8:H8')
                ->MergeCells('I8:K8')
                ->MergeCells('L8:N8');

        $rekap_sheet->getStyle('A1:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $rekap_sheet->getStyle('A5:N6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $rekap_sheet->getStyle('A8:N9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $rekap_sheet->getStyle('A8:N9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(TRUE);

        $rekap_sheet->getStyle('A5:N6')->getFont()->setBold(TRUE);

        $rekap_sheet->getStyle('A2:C2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $rekap_sheet->setCellValue('A1', 'MARKAS BESAR ANGKATAN DARAT')
                ->setCellValue('A2', 'STAFF UMUM PERSONEL');

        $rekap_sheet->setCellValue('A5', 'REKAPITULASI PA ,BA , TA MULTI KORPS PER KOTAMA/BALAKPUS')
                ->setCellValue('A6', 'BULAN ' . strtoupper(array_month($bulan)) . ' TAHUN ' . $tahun);

        $rekap_sheet->setCellValue('A8', 'NO')
                ->setCellValue('B8', 'KOTAMA/BALAKPUS')
                ->setCellValue('C8', 'PERWIRA')
                ->setCellValue('F8', 'BINTARA')
                ->setCellValue('I8', 'TAMTAMA')
                ->setCellValue('L8', 'JUMLAH')
                ->setCellValue('C9', 'TOP/ DSPP')
                ->setCellValue('D9', 'NYT')
                ->setCellValue('E9', '+/-')
                ->setCellValue('F9', 'TOP/ DSPP')
                ->setCellValue('G9', 'NYT')
                ->setCellValue('H9', '+/-')
                ->setCellValue('I9', 'TOP/ DSPP')
                ->setCellValue('J9', 'NYT')
                ->setCellValue('K9', '+/-')
                ->setCellValue('L9', 'TOP/ DSPP')
                ->setCellValue('M9', 'NYT')
                ->setCellValue('N9', '+/-');

        $next_list_number = 1;
        $sum_start = 11;
        $cell = 11;
        foreach ($records["kategori"] as $record) {
            $rekap_sheet->setCellValue("A$cell", $next_list_number++)
                    ->setCellValue("B$cell", beautify_str($record["kotama"]))
                    ->setCellValue("C$cell", $record["perwira_top"])
                    ->setCellValue("D$cell", $record["perwira_nyata"])
                    ->setCellValue("E$cell", "=D$cell-C$cell")
                    ->setCellValue("F$cell", $record["bintara_top"])
                    ->setCellValue("G$cell", $record["bintara_nyata"])
                    ->setCellValue("H$cell", "=G$cell-F$cell")
                    ->setCellValue("I$cell", $record["tamtama_top"])
                    ->setCellValue("J$cell", $record["tamtama_nyata"])
                    ->setCellValue("K$cell", "=K$cell-I$cell")
                    ->setCellValue("L$cell", "=C$cell+F$cell+I$cell")
                    ->setCellValue("M$cell", "=D$cell+G$cell+J$cell")
                    ->setCellValue("N$cell", "=M$cell-L$cell");
        }
        $sum_end = $cell;
        $cell+=2;
        $rekap_sheet->setCellValue("B$cell", "JUMLAH")
                ->setCellValue("C$cell", "=SUM(C$sum_start:C$sum_end)")
                ->setCellValue("D$cell", "=SUM(D$sum_start:D$sum_end)")
                ->setCellValue("E$cell", "=D$cell-C$cell")
                ->setCellValue("F$cell", "=SUM(F$sum_start:F$sum_end)")
                ->setCellValue("G$cell", "=SUM(G$sum_start:G$sum_end)")
                ->setCellValue("H$cell", "=G$cell-F$cell")
                ->setCellValue("I$cell", "=SUM(I$sum_start:I$sum_end)")
                ->setCellValue("J$cell", "=SUM(J$sum_start:J$sum_end)")
                ->setCellValue("K$cell", "=K$cell-I$cell")
                ->setCellValue("L$cell", "=C$cell+F$cell+I$cell")
                ->setCellValue("M$cell", "=D$cell+G$cell+J$cell")
                ->setCellValue("N$cell", "=M$cell-L$cell");

        $rekap_sheet->getStyle("A$cell:N$cell")->getFont()->setBold(TRUE);
        $rekap_sheet->getStyle("C$sum_start:N$cell")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $rekap_sheet->getStyle("C10:D$cell")->getNumberFormat()->setFormatCode('#,##0');
        $rekap_sheet->getStyle("E10:E$cell")->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
        $rekap_sheet->getStyle("F10:G$cell")->getNumberFormat()->setFormatCode('#,##0');
        $rekap_sheet->getStyle("H10:H$cell")->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
        $rekap_sheet->getStyle("I10:J$cell")->getNumberFormat()->setFormatCode('#,##0');
        $rekap_sheet->getStyle("K10:K$cell")->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
        $rekap_sheet->getStyle("L10:M$cell")->getNumberFormat()->setFormatCode('#,##0');
        $rekap_sheet->getStyle("N10:N$cell")->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');

        $rekap_sheet->getStyle("A8:N$cell")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $rekap_sheet->getStyle("A8:N8")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
        $rekap_sheet->getStyle("A10:N" . ($cell - 1))->getBorders()->getHorizontal()->setBorderStyle(PHPExcel_Style_Border::BORDER_HAIR);
        unset($rekap_sheet);

// Detail Multicorp berdasarkan tingkat

        $detail_sheet_number = 1;
        if ($records["tingkat"]) {
            foreach ($records["tingkat"] as $tingkat => $data) {
                $next_list_number = 1;
                $jumlah_pangkat = count($data["pangkat"]);
                $lebar = round(70 / $jumlah_pangkat / 3);
                $total_top = 0;
                $total_nyata = 0;

                $objPHPExcel->createSheet();

                $objPHPExcel->setActiveSheetIndex($detail_sheet_number);
                $detail_sheet = $objPHPExcel->getActiveSheet();
                $detail_sheet->setTitle(strtoupper($tingkat));
                $detail_sheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(11);
                $detail_sheet->getSheetView()->setZoomScale(80);

                $detail_sheet->getColumnDimension("A")->setWidth(4);
                $detail_sheet->getColumnDimension("B")->setWidth(30);
                $col_end = "B";
                for ($i = 0; $i < (($jumlah_pangkat * 3) + 3); $i++) {
                    $col_end = chr(ord($col_end) + 1);
                    $detail_sheet->getColumnDimension($col_end)->setWidth(7);
                }
                $detail_sheet->getRowDimension("8")->setRowHeight(30);
                $detail_sheet->getRowDimension("9")->setRowHeight(30);

                $detail_sheet->mergeCells("A1:C1")
                        ->mergeCells("A2:C2")
                        ->mergeCells("A5:$col_end" . "5")
                        ->mergeCells("A6:$col_end" . "6")
                        ->mergeCells("A8:A9")
                        ->mergeCells("B8:B9");
                $cm = "C";
                for ($i = 0; $i < ($jumlah_pangkat + 1); $i++) {
                    $detail_sheet->mergeCells($cm . "8:" . chr(ord($cm) + 2) . "8");
                    $cm = chr(ord($cm) + 3);
                }

                $detail_sheet->getStyle("A1:C2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $detail_sheet->getStyle("A5:$col_end" . "6")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $detail_sheet->getStyle("A8:$col_end" . "9")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $detail_sheet->getStyle("A8:$col_end" . "9")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(TRUE);
                $detail_sheet->getStyle("A5:$col_end" . "6")->getFont()->setBold(TRUE);
                $detail_sheet->getStyle('A2:C2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                $detail_sheet->setCellValue('A1', 'MARKAS BESAR ANGKATAN DARAT')
                        ->setCellValue('A2', 'STAFF UMUM PERSONEL');

                $detail_sheet->setCellValue('A5', "REKAPITULASI " . strtoupper($tingkat) . " MULTI KORPS PER KOTAMA/BALAKPUS")
                        ->setCellValue('A6', 'BULAN ' . strtoupper(array_month($bulan)) . ' TAHUN ' . $tahun);

                $detail_sheet->setCellValue('A8', 'NO')
                        ->setCellValue('B8', 'KOTAMA/BALAKPUS');

                $i = 0;
                $ha = "C";
                foreach ($data["pangkat"] as $pangkat) {
                    $detail_sheet->setCellValue($ha . "8", strtoupper($pangkat));
                    $detail_sheet->setCellValue($ha . "9", "TOP/ DSP");
                    $ha = chr(ord($ha) + 1);
                    $detail_sheet->setCellValue($ha . "9", "NYT");
                    $ha = chr(ord($ha) + 1);
                    $detail_sheet->setCellValue($ha . "9", "+/-");
                    $ha = chr(ord($ha) + 1);

                    ${"col" . (2 * $i + 1)} = strtolower($pangkat . "_top");
                    ${"col" . (2 * $i + 2)} = strtolower($pangkat . "_nyata");
                    $i++;
                }
                $detail_sheet->setCellValue($ha . "8", "JUMLAH");
                $detail_sheet->setCellValue($ha . "9", "TOP/ DSP");
                $col_top = $ha;
                $ha = chr(ord($ha) + 1);
                $detail_sheet->setCellValue($ha . "9", "NYT");
                $col_nyata = $ha;
                $ha = chr(ord($ha) + 1);
                $detail_sheet->setCellValue($ha . "9", "+/-");

                $next_list_number = 1;
                $sum_start = 11;
                $cell = 11;
                foreach ($data["data"] as $record) {
                    $detail_sheet->setCellValue("A$cell", $next_list_number++)
                            ->setCellValue("B$cell", beautify_str($record["kotama"]));
                    $ca = "C";
                    $cstop = NULL;
                    $csnyata = NULL;
                    for ($i = 1; $i <= ($jumlah_pangkat * 2); $i++) {
                        $detail_sheet->setCellValue($ca . $cell, $record[${"col" . $i}]);
                        $detail_sheet->getStyle($ca . $cell)->getNumberFormat()->setFormatCode('#,##0');
                        if (($i % 2) == 1) {
                            $ctop = $ca;
                            $cstop = is_null($cstop) ? $ca . $cell : $cstop . "+" . $ca . $cell;
                        } else {
                            $cnyata = $ca;
                            $csnyata = is_null($csnyata) ? $ca . $cell : $csnyata . "+" . $ca . $cell;
                            $ca = chr(ord($ca) + 1);
                            $detail_sheet->setCellValue($ca . $cell, "=$cnyata$cell-$ctop$cell");
                            $detail_sheet->getStyle($ca . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
                        }
                        $ca = chr(ord($ca) + 1);
                    }
                    $detail_sheet->setCellValue($ca . $cell, "=$cstop");
                    $detail_sheet->getStyle($ca . $cell)->getNumberFormat()->setFormatCode('#,##0');
                    $ctop = $ca;
                    $ca = chr(ord($ca) + 1);
                    $detail_sheet->setCellValue($ca . $cell, "=$csnyata");
                    $detail_sheet->getStyle($ca . $cell)->getNumberFormat()->setFormatCode('#,##0');
                    $cnyata = $ca;
                    $ca = chr(ord($ca) + 1);
                    $detail_sheet->setCellValue($ca . $cell, "=$cnyata$cell-$ctop$cell");
                    $detail_sheet->getStyle($ca . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');

                    $cell++;
                }

                $sum_end = $cell;
                $cell++;
                $ca = "C";
                $detail_sheet->setCellValue("B$cell", "JUMLAH");
                for ($i = 1; $i <= ($jumlah_pangkat * 2); $i++) {
                    $detail_sheet->setCellValue($ca . $cell, "=SUM($ca$sum_start:$ca$sum_end)");
                    $detail_sheet->getStyle($ca . $cell)->getNumberFormat()->setFormatCode('#,##0');
                    if (($i % 2) == 1) {
                        $ctop = $ca;
                    } else {
                        $cnyata = $ca;
                        $ca = chr(ord($ca) + 1);
                        $detail_sheet->setCellValue($ca . $cell, "=$cnyata$cell-$ctop$cell");
                        $detail_sheet->getStyle($ca . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
                    }
                    $ca = chr(ord($ca) + 1);
                }
                $detail_sheet->setCellValue($ca . $cell, "=SUM($ca$sum_start:$ca$sum_end)");
                $detail_sheet->getStyle($ca . $cell)->getNumberFormat()->setFormatCode('#,##0');
                $ca = chr(ord($ca) + 1);
                $detail_sheet->setCellValue($ca . $cell, "=SUM($ca$sum_start:$ca$sum_end)");
                $detail_sheet->getStyle($ca . $cell)->getNumberFormat()->setFormatCode('#,##0');
                $ca = chr(ord($ca) + 1);
                $cst = chr(ord($ca) - 2);
                $csn = chr(ord($ca) - 1);
                $detail_sheet->setCellValue($ca . $cell, "=$csn$cell-$cst$cell");
                $detail_sheet->getStyle($ca . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');

                $detail_sheet->getStyle("A$cell:$col_end$cell")->getFont()->setBold(TRUE);
                $detail_sheet->getStyle("C$sum_start:$col_end$cell")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $detail_sheet->getStyle("A8:$col_end$cell")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $detail_sheet->getStyle("A8:$col_end" . "8")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
                $detail_sheet->getStyle("A10:$col_end" . ($cell - 1))->getBorders()->getHorizontal()->setBorderStyle(PHPExcel_Style_Border::BORDER_HAIR);

                unset($detail_sheet);
                $detail_sheet_number++;
            }
        }



        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="LaporanMultiCorps.xlsx"');
        $objWriter->save("php://output");
        exit;
    }

}
