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

    function export($bulan = 1, $tahun = 2014) {
        $this->load->library("PHPExcel/PHPExcel");

        $tingkat = 5;
        $records["kategori"] = $this->model_laporan->get_by_corps_and_golongan($bulan, $tahun);
        $records["tingkat"] = $this->model_laporan->get_by_corps_and_tingkat($tingkat, $bulan, $tahun);

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);

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

        $objPHPExcel->getActiveSheet()->mergeCells('A4:O4');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:O5');
        $objPHPExcel->getActiveSheet()
                ->setCellValue('A4', 'REKAPITULASI PA ,BA , TA PERKECABANGAN TNI AD')
                ->setCellValue('A5', 'BULAN ' . strtoupper(array_month($bulan)) . ' TAHUN ' . $tahun);
        $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE);
        $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE);

        $objPHPExcel->getActiveSheet()->mergeCells('A7:A8');
        $objPHPExcel->getActiveSheet()->mergeCells('B7:B8');
        $objPHPExcel->getActiveSheet()->mergeCells('C7:E7');
        $objPHPExcel->getActiveSheet()->mergeCells('F7:H7');
        $objPHPExcel->getActiveSheet()->mergeCells('I7:K7');
        $objPHPExcel->getActiveSheet()->mergeCells('L7:N7');

        $objPHPExcel->getActiveSheet()->mergeCells('O7:O8');

        $objPHPExcel->getActiveSheet()->setCellValue('A7', 'NO');
        $objPHPExcel->getActiveSheet()->setCellValue('B7', 'KECAB');
        $objPHPExcel->getActiveSheet()->setCellValue('C7', 'PERWIRA');
        $objPHPExcel->getActiveSheet()->setCellValue('F7', 'BINTARA');
        $objPHPExcel->getActiveSheet()->setCellValue('I7', 'TAMTAMA');
        $objPHPExcel->getActiveSheet()->setCellValue('L7', 'JUMLAH');
        $objPHPExcel->getActiveSheet()->setCellValue('O7', 'KETERANGAN');

        $objPHPExcel->getActiveSheet()->setCellValue('C8', 'TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('D8', 'NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('E8', '+/-');
        $objPHPExcel->getActiveSheet()->setCellValue('F8', 'TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('G8', 'NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('H8', '+/-');
        $objPHPExcel->getActiveSheet()->setCellValue('I8', 'TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('J8', 'NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('K8', '+/-');
        $objPHPExcel->getActiveSheet()->setCellValue('L8', 'TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('M8', 'NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('N8', '+/-');

        $next_list_number = 1;
        $perwira_top = 0;
        $perwira_nyata = 0;
        $bintara_top = 0;
        $bintara_nyata = 0;
        $tamtama_top = 0;
        $tamtama_nyata = 0;

        $objPHPExcel->getActiveSheet()->getStyle('A7:O8')->getAlignment()->setWrapText(TRUE);
        $objPHPExcel->getActiveSheet()->getStyle('A7:O8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A7:O8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);



        $cell = 10;
        foreach ($records["kategori"] as $record):


            $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $next_list_number);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, beautify_str($record["corps"]));
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $cell, $record['perwira_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $cell, $record['perwira_nyata']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $cell, $record['perwira_nyata'] - $record['perwira_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $cell, $record['bintara_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $cell, $record['bintara_nyata']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $cell, $record['bintara_nyata'] - $record['bintara_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $cell, $record['tamtama_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $cell, $record['tamtama_nyata']);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $cell, $record['tamtama_nyata'] - $record['tamtama_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $cell, $record['perwira_top'] + $record['bintara_top'] + $record['tamtama_top']);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $cell, $record['perwira_nyata'] + $record['bintara_nyata'] + $record['tamtama_nyata']);
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $cell, ($record["perwira_nyata"] + $record["bintara_nyata"] + $record["tamtama_nyata"]) - ($record["perwira_top"] + $record["bintara_top"] + $record["tamtama_top"]));
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

        $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, 'JUMLAH ')->getStyle('B' . $cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $cell, $perwira_top)->getStyle('C' . $cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $cell, $perwira_nyata)->getStyle('D' . $cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $cell, $perwira_nyata - $perwira_top)->getStyle('E' . $cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $cell, $bintara_top)->getStyle('F' . $cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $cell, $bintara_nyata)->getStyle('G' . $cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $cell, $bintara_nyata - $bintara_top)->getStyle('H' . $cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $cell, $tamtama_top)->getStyle('I' . $cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $cell, $tamtama_nyata)->getStyle('J' . $cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $cell, $tamtama_nyata - $tamtama_top)->getStyle('K' . $cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $cell, $perwira_top + $bintara_top + $tamtama_top)->getStyle('L' . $cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('M' . $cell, $perwira_nyata + $bintara_nyata + $tamtama_nyata)->getStyle('M' . $cell)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('N' . $cell, ($perwira_nyata + $bintara_nyata + $tamtama_nyata) - ($perwira_top + $bintara_top + $tamtama_top))->getStyle('N' . $cell)->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle('A7:O' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
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
        $objPHPExcel->getActiveSheet()->getStyle('A7:O8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $cell . ':O' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('A7:O7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);

        $objPHPExcel->getActiveSheet()->getStyle('C10:C' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('E10:E' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
        $objPHPExcel->getActiveSheet()->getStyle('D10:D' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('F10:F' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('G10:G' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('H10:H' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('I10:I' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('J10:J' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('K10:K' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('L10:L' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('M10:M' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('N10:N' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');


        $objPHPExcel->getActiveSheet()->setTitle('REKAPITULASI');
        $angka = 1;
        if ($records['tingkat'] != FALSE) {
            foreach ($records["tingkat"] as $tingkat => $data) :

                $next_list_number = 1;
                $jumlah_pangkat = count($data["pangkat"]);
                $lebar = $jumlah_pangkat > 0 ? round(70 / $jumlah_pangkat / 3) : 0;
                $total_top = 0;
                $total_nyata = 0;


                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($angka);

                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);

                // $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
                // $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
                // $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
                // $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
                // $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
                // $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
                // $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
                // $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
                // $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);
                // $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
                // $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
                // $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
                // $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);


                $angka++;

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


                $objPHPExcel->getActiveSheet()
                        ->setCellValue('A4', 'REKAPITULASI ' . $tingkat . ' PERKECABANGAN TNI AD')
                        ->setCellValue('A5', 'Bulan ' . strtoupper(array_month($bulan)) . ' Tahun ' . $tahun);
                $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE);
                $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE);



                $objPHPExcel->getActiveSheet()->mergeCells('A7:A8');
                $objPHPExcel->getActiveSheet()->mergeCells('B7:B8');
                $objPHPExcel->getActiveSheet()->mergeCells('C7:E7');
                $objPHPExcel->getActiveSheet()->mergeCells('F7:H7');
                $objPHPExcel->getActiveSheet()->mergeCells('I7:K7');
                $objPHPExcel->getActiveSheet()->mergeCells('L7:N7');

                $objPHPExcel->getActiveSheet()->setCellValue('A7', 'NO');
                $objPHPExcel->getActiveSheet()->setCellValue('B7', 'KECAB');
                $ha = "C";
                $habawah = "C";
                $i = 0;


                foreach ($data['pangkat'] as $pangkat):
                    $objPHPExcel->getActiveSheet()->setCellValue($ha . '7', strtoupper($pangkat));

                    $objPHPExcel->getActiveSheet()->setCellValue($habawah . '8', 'TOP');
                    $habawah = chr(ord($habawah) + 1);

                    $objPHPExcel->getActiveSheet()->setCellValue($habawah . '8', 'NYATA');
                    $habawah = chr(ord($habawah) + 1);

                    $objPHPExcel->getActiveSheet()->setCellValue($habawah . '8', '+/-');
                    $habawah = chr(ord($habawah) + 1);
                    $ha = chr(ord($ha) + 3);

                    ${"col" . (2 * $i + 1)} = strtolower($pangkat . "_top");
                    ${"col" . (2 * $i + 2)} = strtolower($pangkat . "_nyata");
                    ${"sub" . (2 * $i + 1)} = 0;
                    ${"sub" . (2 * $i + 2)} = 0;

                    $i++;


                endforeach;
                $objPHPExcel->getActiveSheet()->setCellValue($ha . '7', 'JUMLAH');

                $objPHPExcel->getActiveSheet()->setCellValue($habawah . '8', 'TOP');
                $habawah = chr(ord($habawah) + 1);

                $objPHPExcel->getActiveSheet()->setCellValue($habawah . '8', 'NYATA');
                $habawah = chr(ord($habawah) + 1);

                $objPHPExcel->getActiveSheet()->setCellValue($habawah . '8', '+/-');
                $objPHPExcel->getActiveSheet()->mergeCells($ha . '7:' . $habawah . '7');
                $objPHPExcel->getActiveSheet()->mergeCells('A4:' . $habawah . '4');
                $objPHPExcel->getActiveSheet()->mergeCells('A5:' . $habawah . '5');
                $habawah = chr(ord($habawah) + 1);



                $objPHPExcel->getActiveSheet()->getStyle('A7:' . $habawah . '8')->getAlignment()->setWrapText(TRUE);
                $objPHPExcel->getActiveSheet()->getStyle('A7:' . $habawah . '8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A7:' . $habawah . '8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


                $cell = 10;
                foreach ($data['data'] as $record):
                    $sub_top = 0;
                    $sub_nyata = 0;


                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $next_list_number);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, beautify_str($record["corps"]));
                    $ha = "c";

                    for ($i = 1; $i <= ($jumlah_pangkat * 2); $i++) {

                        $objPHPExcel->getActiveSheet()->setCellValue($ha . $cell, number_format($record[${"col" . $i}], 0, ",", "."));
                        if (($i % 2) == 0) {
                            $ha = chr(ord($ha) + 1);

                            $objPHPExcel->getActiveSheet()->setCellValue($ha . $cell, number_format($record[${"col" . $i}] - $record[${"col" . ($i - 1)}], 0, ",", "."));
                            $sub_nyata += $record[${"col" . $i}];

                            $ha = chr(ord($ha) + 1);
                        } else {
                            $ha = chr(ord($ha) + 1);
                            $sub_top += $record[${"col" . $i}];
                        }


                        ${"sub" . $i} += $record[${"col" . $i}];
                    }

                    $objPHPExcel->getActiveSheet()->setCellValue($ha . $cell, $sub_top);
                    $ha = chr(ord($ha) + 1);

                    $objPHPExcel->getActiveSheet()->setCellValue($ha . $cell, $sub_nyata);
                    $ha = chr(ord($ha) + 1);

                    $objPHPExcel->getActiveSheet()->setCellValue($ha . $cell, $sub_nyata - $sub_top);

                    $ha = chr(ord($ha) + 1);

                    $total_top += $sub_top;
                    $total_nyata += $sub_nyata;


                    $cell = $cell + 1;
                    $next_list_number++;
                endforeach;

                $cell = $cell + 1;

                $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, 'JUMLAH');
                $ha = "C";
                for ($i = 1; $i <= ($jumlah_pangkat * 2); $i++):
                    $objPHPExcel->getActiveSheet()->setCellValue($ha . $cell, number_format(${"sub" . $i}, 0, ",", "."));
                    if (($i % 2) == 0) {
                        $ha = chr(ord($ha) + 1);
                        $objPHPExcel->getActiveSheet()->setCellValue($ha . $cell, number_format(${"sub" . $i} - ${"sub" . ($i - 1)}, 0, ",", "."));
                        $ha = chr(ord($ha) + 1);
                    } else {
                        $ha = chr(ord($ha) + 1);
                    }
                endfor;
                $objPHPExcel->getActiveSheet()->setCellValue($ha . $cell, $total_top);
                $ha = chr(ord($ha) + 1);

                $objPHPExcel->getActiveSheet()->setCellValue($ha . $cell, $total_nyata);
                $ha = chr(ord($ha) + 1);

                $objPHPExcel->getActiveSheet()->setCellValue($ha . $cell, $total_nyata - $total_top);
                // $ha = chr(ord($ha) + 1);


                $objPHPExcel->getActiveSheet()->getStyle('A7:' . $ha . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('A7:A' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
                $objPHPExcel->getActiveSheet()->getStyle('B7:B' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
                $hurufawal = 'C';
                $huruf_akhir = $ha;

                while ($hurufawal < $huruf_akhir) {
                    $objPHPExcel->getActiveSheet()->getStyle($hurufawal . '7:' . $hurufawal . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
                    $objPHPExcel->getActiveSheet()->getStyle($hurufawal . '10:' . $hurufawal . $cell)->getNumberFormat()->setFormatCode('#,##0');

                    $hurufawal = chr(ord($hurufawal) + 1);
                }
                $objPHPExcel->getActiveSheet()->getStyle('A7:' . $ha . '8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $cell . ':' . $ha . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
                $objPHPExcel->getActiveSheet()->getStyle('A7:' . $ha . '7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);


                $objPHPExcel->getActiveSheet()->getStyle($huruf_akhir . '10:' . $huruf_akhir . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');


                $objPHPExcel->getActiveSheet()->setTitle($tingkat);

            endforeach;
        } else {
            
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="LaporanKecabangan.xlsx"');
        $objWriter->save("php://output");
        exit();
    }

}
