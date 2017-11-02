<?php

class Template extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->library("PHPExcel/PHPExcel");
        //exit;

        $kode_kotama = $_GET['kotama'];
        $kotama = $this->db->query("SELECT * FROM sc_fcstprsn.master_kotama WHERE id_kotama = '$kode_kotama'")->row_array();
        $query_satminkal = $this->db->query("SELECT * FROM sc_fcstprsn.master_satminkal WHERE id_kotama = '$kode_kotama' ORDER BY kode_satminkal ASC");

        $pangkat = $this->db->query("SELECT * FROM sc_fcstprsn.master_pangkat ORDER BY kode_pangkat DESC")->result_array();
        $total = count($pangkat);

        $satminkal = $query_satminkal->result_array();

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $template = $objPHPExcel->getActiveSheet();
        $template->mergeCells('A1:D1');
        $template->mergeCells('A2:D2');

        $template->setCellValue('A1', 'TENTARA NASIONAL INDONESIA ANGKATAN DARAT')
                ->setCellValue('A2', $kotama['ur_kotama'])
                ->setCellValue('A5', 'REKAPITULASI PERUBAHAN KEKUATAN PRAJURIT TNI AD KOTAMA/BALAKPUS')
                ->setCellValue('A6', 'DAN PENDIDIKAN MILITER BULAN MEI TA. 2017');
        $template->mergeCells('A5:I5');
        $template->mergeCells('A6:I6');
        $template->getStyle('A5:I6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $template->getStyle('A5:I6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $template->getColumnDimension('A')->setWidth(6);
        $template->getColumnDimension('B')->setWidth(20);
        $template->getColumnDimension('C')->setWidth(9);
        $template->getColumnDimension('D')->setWidth(9);
        $template->getColumnDimension('E')->setWidth(9);
        $template->getColumnDimension('F')->setWidth(9);
        $template->getColumnDimension('G')->setWidth(9);
        $template->getColumnDimension('H')->setWidth(9);
        $template->getColumnDimension('I')->setWidth(9);
        $template->getColumnDimension('J')->setWidth(9);
        $template->getColumnDimension('K')->setWidth(9);
        $template->getColumnDimension('L')->setWidth(9);
        $template->getColumnDimension('M')->setWidth(9);

        $template->setCellValue('A8', 'Kesatuan : ' . $kotama['nama_kotama']);

        $template->setCellValue('A9', "NO");
        $template->setCellValue('B9', "PANGKAT");
        $template->setCellValue('C9', "TOP");
        $template->setCellValue('D9', "NYATA");
        $template->setCellValue('I9', "STATUS");

        $template->setCellValue('D10', "DINAS AKTIF");
        $template->getStyle('D10')->getAlignment()->setWrapText(TRUE);

        $template->setCellValue('E10', "MPP");
        $template->setCellValue('F10', "LF");
        $template->setCellValue('G10', "SKORSING");
        $template->setCellValue('H10', "JUMLAH");

        $template->mergeCells('A9:A11');
        $template->mergeCells('B9:B11');
        $template->mergeCells('C9:C11');
        $template->mergeCells('D9:H9');
        $template->mergeCells('I9:I11');

        $template->mergeCells('D10:D11');
        $template->mergeCells('E10:E11');
        $template->mergeCells('F10:F11');
        $template->mergeCells('G10:G11');
        $template->mergeCells('H10:H11');

        // Style

        $styleThinBlackBorderOutline = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
            ),
        );

        $styleLeftThinBlackBorderOutline = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
            ),
        );

        $styleRightThinBlackBorderOutline = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
            ),
        );

        $styleCenterThinBlackBorderOutline = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
            ),
        );

        $huruf = "A";
        $aa = 1;
        $pp = 12;

        while ($huruf <= "I") {
            $template->setCellValue($huruf . $pp, $aa);
            $huruf = chr(ord($huruf) + 1);

            $aa++;
        }

        $awalini = 14;
        $template->getStyle('A12:I13')->applyFromArray($styleThinBlackBorderOutline);

        foreach ($pangkat as $p => $pa) {
            $template->setCellValue('A' . $awalini, $p + 1);
            $template->getStyle('A' . $awalini)->applyFromArray($styleRightThinBlackBorderOutline);
            $template->setCellValue('B' . $awalini, $pa['ur_pangkat']);
            $template->getStyle('B' . $awalini)->applyFromArray($styleLeftThinBlackBorderOutline);
            $template->getStyle('C' . $awalini . ':I' . $awalini)->applyFromArray($styleRightThinBlackBorderOutline);
            $template->setCellValue('H' . $awalini, "=SUM(D" . $awalini . ":G" . $awalini . ")");
            $template->setCellValue('I' . $awalini, "=(H" . $awalini . "-C" . $awalini . ")");
            $template->getStyle('I' . $awalini)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');

            $awalini++;
        }









        $template->getStyle('A9:I11')->applyFromArray($styleThinBlackBorderOutline);
//        $template->getStyle('A9:I11')->applyFromArray($styleThinBlackBorderOutline);
// Per Satminkal        

        $cellawal = 9;
        $cellawal = $awalini + 10;

        $first = $cellawal + 4;
        $fonts = array('font' => array(
                'bold' => true
        ));

        foreach ($satminkal as $s => $val) {
            $template->setCellValue('A' . $first, "KESATUAN  : " . $val['ur_satminkal'])->getStyle('A' . $first)->applyFromArray($fonts);
            $template->mergeCells('A' . $first . ':D' . $first);
            $next = $first + 1;
            $next2 = $first + 2;
            $next4 = $first + 3;
            $template->setCellValue('A' . $next, "NO");
            $template->setCellValue('B' . $next, "PANGKAT");
            $template->setCellValue('C' . $next, "TOP");
            $template->setCellValue('D' . $next, "NYATA");
            $template->setCellValue('I' . $next, "STATUS");
            $template->setCellValue('D' . $next2, "DINAS AKTIF");
            $template->setCellValue('E' . $next2, "MPP");
            $template->setCellValue('F' . $next2, "LF");
            $template->setCellValue('G' . $next2, "SKORSING");
            $template->setCellValue('H' . $next2, "JUMLAH");
            if ($val['babinsa'] == 1) {
                $template->setCellValue('J' . $next, "DANRAMIL");
                $template->setCellValue('J' . $next2, "TOP");
                $template->setCellValue('K' . $next2, "NYATA");
                $template->setCellValue('L' . $next, "BABINSA");
                $template->setCellValue('L' . $next2, "TOP");
                $template->setCellValue('M' . $next2, "NYATA");
            }
            $template->mergeCells('A' . $next . ':A' . $next4);
            $template->mergeCells('B' . $next . ':B' . $next4);
            $template->mergeCells('C' . $next . ':C' . $next4);
            $template->mergeCells('I' . $next . ':I' . $next4);
            $template->mergeCells('D' . $next . ':H' . $next);
            $template->mergeCells('D' . $next2 . ':D' . $next4);
            $template->mergeCells('E' . $next2 . ':E' . $next4);
            $template->mergeCells('F' . $next2 . ':F' . $next4);
            $template->mergeCells('G' . $next2 . ':G' . $next4);
            $template->mergeCells('H' . $next2 . ':H' . $next4);
            if ($val['babinsa'] == 1) {
                $template->mergeCells('J' . $next . ':K' . $next);
                $template->mergeCells('L' . $next . ':M' . $next);
                $template->mergeCells('J' . $next2 . ':J' . $next4);
                $template->mergeCells('K' . $next2 . ':K' . $next4);
                $template->mergeCells('L' . $next2 . ':L' . $next4);
                $template->mergeCells('M' . $next2 . ':M' . $next4);
                $template->getStyle('A' . $next . ':M' . $next4)->applyFromArray($styleThinBlackBorderOutline);
            } else {
                $template->getStyle('A' . $next . ':I' . $next4)->applyFromArray($styleThinBlackBorderOutline);
            }
            $template->getStyle('D' . $next2)->getAlignment()->setWrapText(TRUE);

            $tm = $first + 5;

            foreach ($pangkat as $p => $pa) {
                $template->setCellValue('A' . $tm, $p + 1);
                $template->setCellValue('B' . $tm, $pa['ur_pangkat'])->getStyle()->getFont()->setBold(true);
                $template->setCellValue('H' . $tm, "=SUM(D" . $tm . ":G" . $tm . ")");
                $template->setCellValue('I' . $tm, "=(C" . $tm . "-H" . $tm . ")");
                $tm++;
            }
            $jumlah = $first + ($total + 6);
            $template->setCellValue('B' . $jumlah, "JUMLAH");
            $template->setCellValue('C' . $jumlah, "");
            $template->setCellValue('D' . $jumlah, "");
            $template->setCellValue('E' . $jumlah, "");
            $template->setCellValue('F' . $jumlah, "");
            $template->setCellValue('G' . $jumlah, "");
            $template->setCellValue('H' . $jumlah, "");
            $template->setCellValue('I' . $jumlah, "");
            if ($val['babinsa'] == 1) {
                $template->getStyle('A' . ($first + 1) . ':M' . $jumlah)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            } else {
                $template->getStyle('A' . ($first + 1) . ':I' . $jumlah)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            }
            $first = $first + ($total + 10);
        }



        //			$f = 8;
        // 	$no = 1;
        // foreach($a as $val){ 	
        // 	$template->setCellValue('A'.$f,$no++);
        // 	$template->setCellValue('B'.$f,$val['ur_pangkat']);
        // 	$f++;
        // }
        $dit = strtotime(date('Y-m-d H:i:s'));

        $template->setTitle('Laporan');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $kotama['nama_kotama'] . '-' . $dit . '.xlsx"');
        $objWriter->save("php://output");
    }

}
