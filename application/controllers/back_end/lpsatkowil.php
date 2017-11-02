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
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
    }

    function export($bulan = 1, $tahun = 2014) {

        $this->load->library("PHPExcel/PHPExcel");
        $records = array(
            'golongan' => $this->model_laporan->get_satkowil_by_kotama_and_golongan($bulan, $tahun),
            'detail' => $this->model_laporan->get_satkowil_by_satminkal_and_golongan($bulan, $tahun),
        );

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $rekapitulasi = $objPHPExcel->getActiveSheet();
        $rekapitulasi->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);

        $rekapitulasi->getColumnDimension('A')->setWidth(4);
        $rekapitulasi->getColumnDimension('B')->setWidth(30);
        $rekapitulasi->getColumnDimension('C')->setWidth(9);
        $rekapitulasi->getColumnDimension('D')->setWidth(9);
        $rekapitulasi->getColumnDimension('E')->setWidth(9);
        $rekapitulasi->getColumnDimension('F')->setWidth(10);
        $rekapitulasi->getColumnDimension('G')->setWidth(17);

        $rekapitulasi->mergeCells('A1:C1');
        $rekapitulasi->mergeCells('A2:C2');
        $rekapitulasi->setCellValue('A1', 'MARKAS BESAR ANGKATAN DARAT')
                ->setCellValue('A2', 'STAFF UMUM PERSONEL');

        $rekapitulasi->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $rekapitulasi->getStyle('A1:A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $rekapitulasi->getStyle('A1:A2')->getFont()->setBold(TRUE);
        $rekapitulasi->getStyle('A2:C2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $rekapitulasi->mergeCells('A4:G4');
        $rekapitulasi->mergeCells('A5:G5');
        $rekapitulasi->setCellValue('A4', 'REKAPITULASI KEKUATAN PERSONEL SATKOWIL DAN SATINTEL TNI AD')
                ->setCellValue('A5', 'BULAN ' . strtoupper(array_month($bulan)) . ' TAHUN ' . $tahun);
        $rekapitulasi->getStyle('A4:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $rekapitulasi->getStyle('A4:A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $rekapitulasi->getStyle('A4:A5')->getFont()->setSize(11)->setBold(TRUE);

        $rekapitulasi->mergeCells('A7:A8');
        $rekapitulasi->mergeCells('B7:B8');
        $rekapitulasi->mergeCells('C7:C8');
        $rekapitulasi->mergeCells('D7:D8');
        $rekapitulasi->mergeCells('E7:E8');
        $rekapitulasi->mergeCells('F7:F8');
        $rekapitulasi->mergeCells('G7:G8');
        $rekapitulasi->setCellValue('A7', 'NO');
        $rekapitulasi->setCellValue('B7', 'KOTAMA/GOL');
        $rekapitulasi->setCellValue('C7', 'DSP');
        $rekapitulasi->setCellValue('D7', 'NYATA');
        $rekapitulasi->setCellValue('E7', '+/-');
        $rekapitulasi->setCellValue('F7', '%');
        $rekapitulasi->setCellValue('G7', 'KET');
        $h = "A";
        $i = 1;
        while ($i < 7) {
            $rekapitulasi->setCellValue($h . '9', $i);
            $h = chr(ord($h) + 1);
            $i++;
        }

        $rekapitulasi->getStyle('A7:G8')->getAlignment()->setWrapText(TRUE);
        $rekapitulasi->getStyle('A7:G8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $rekapitulasi->getStyle('A7:G8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $cell = 11;
        $next_list_number = 1;
        $pa_top = 0;
        $pa_nyata = 0;
        $ba_top = 0;
        $ba_nyata = 0;
        $ta_top = 0;
        $ta_nyata = 0;
        $pns_top = 0;
        $pns_nyata = 0;
        $total_top = 0;
        $total_nyata = 0;

        foreach ($records['golongan'] as $kotama => $record):

            $sub_top = 0;
            $sub_nyata = 0;

            $rekapitulasi->setCellValue('A' . $cell, $next_list_number++);
            $rekapitulasi->setCellValue('B' . $cell, beautify_str($kotama));
            $cell++;

            foreach ($record as $row) :
                $rekapitulasi->setCellValue('B' . $cell, beautify_str($row['golongan']));
                $rekapitulasi->setCellValue('C' . $cell, $row['top']);
                $rekapitulasi->setCellValue('D' . $cell, $row['nyata']);
                $rekapitulasi->setCellValue('E' . $cell, '=D' . $cell . '-C' . $cell);
                $rekapitulasi->setCellValue('F' . $cell, '=IF(C' . $cell . '>0,D' . $cell . '/C' . $cell . ',0)');
                $cell++;
                $sub_top += $row["top"];
                $sub_nyata += $row["nyata"];
                ${strtolower($row['golongan']) . "_top"} += $row["top"];
                ${strtolower($row['golongan']) . "_nyata"} += $row["nyata"];
            endforeach;

            $rekapitulasi->setCellValue('B' . $cell, beautify_str('JUMLAH'));
            $rekapitulasi->setCellValue('C' . $cell, $sub_top);
            $rekapitulasi->setCellValue('D' . $cell, $sub_nyata);
            $rekapitulasi->setCellValue('E' . $cell, '=D' . $cell . '-C' . $cell);
            $rekapitulasi->setCellValue('F' . $cell, '=IF(C' . $cell . '>0,D' . $cell . '/C' . $cell . ',0)');

            $cell += 2;
            $total_top += $sub_top;
            $total_nyata += $sub_nyata;
        endforeach;

        $rekapitulasi->setCellValue('B' . $cell, beautify_str('JUMLAH PERGOLONGAN'));

        $cell++;
        $rekapitulasi->setCellValue('B' . $cell, beautify_str('PA'));
        $rekapitulasi->setCellValue('C' . $cell, $pa_top);
        $rekapitulasi->setCellValue('D' . $cell, $pa_nyata);
        $rekapitulasi->setCellValue('E' . $cell, '=D' . $cell . '-C' . $cell);
        $rekapitulasi->setCellValue('F' . $cell, '=IF(C' . $cell . '>0,D' . $cell . '/C' . $cell . ',0)');

        $cell++;
        $rekapitulasi->setCellValue('B' . $cell, beautify_str('BA'));
        $rekapitulasi->setCellValue('C' . $cell, $ba_top);
        $rekapitulasi->setCellValue('D' . $cell, $ba_nyata);
        $rekapitulasi->setCellValue('E' . $cell, '=D' . $cell . '-C' . $cell);
        $rekapitulasi->setCellValue('F' . $cell, '=IF(C' . $cell . '>0,D' . $cell . '/C' . $cell . ',0)');

        $cell++;
        $rekapitulasi->setCellValue('B' . $cell, beautify_str('TA'));
        $rekapitulasi->setCellValue('C' . $cell, $ta_top);
        $rekapitulasi->setCellValue('D' . $cell, $ta_nyata);
        $rekapitulasi->setCellValue('E' . $cell, '=D' . $cell . '-C' . $cell);
        $rekapitulasi->setCellValue('F' . $cell, '=IF(C' . $cell . '>0,D' . $cell . '/C' . $cell . ',0)');

        $cell++;
        $rekapitulasi->setCellValue('B' . $cell, beautify_str('PNS'));
        $rekapitulasi->setCellValue('C' . $cell, $pns_top);
        $rekapitulasi->setCellValue('D' . $cell, $pns_nyata);
        $rekapitulasi->setCellValue('E' . $cell, '=D' . $cell . '-C' . $cell);
        $rekapitulasi->setCellValue('F' . $cell, '=IF(C' . $cell . '>0,D' . $cell . '/C' . $cell . ',0)');

        $cell += 2;
        $rekapitulasi->setCellValue('B' . $cell, beautify_str('JUMLAH BESAR'));
        $rekapitulasi->setCellValue('C' . $cell, $total_top);
        $rekapitulasi->setCellValue('D' . $cell, $total_nyata);
        $rekapitulasi->setCellValue('E' . $cell, '=D' . $cell . '-C' . $cell);
        $rekapitulasi->setCellValue('F' . $cell, '=IF(C' . $cell . '>0,D' . $cell . '/C' . $cell . ',0)');

        $rekapitulasi->getStyle('A7:G' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_HAIR);
        $rekapitulasi->getStyle('A7:A' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $rekapitulasi->getStyle('B7:B' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $rekapitulasi->getStyle('C7:C' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $rekapitulasi->getStyle('D7:D' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $rekapitulasi->getStyle('E7:E' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $rekapitulasi->getStyle('F7:F' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $rekapitulasi->getStyle('G7:G' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $rekapitulasi->getStyle('A7:G8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $rekapitulasi->getStyle('A9:G9')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $rekapitulasi->getStyle('A9:G9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $rekapitulasi->getStyle('A' . $cell . ':G' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $rekapitulasi->getStyle('A7:G7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);

        $rekapitulasi->getStyle('C10:D' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $rekapitulasi->getStyle('E10:E' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
        $rekapitulasi->getStyle('F10:F' . $cell)->getNumberFormat()->setFormatCode('#,##0.00%');

        $rekapitulasi->setTitle('REKAPITULASI');
        $n = 1;

        foreach ($records['detail'] as $kotama => $datas):
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($n);
            $n++;

            $detail = $objPHPExcel->getActiveSheet();
            $detail->getColumnDimension('A')->setWidth(6);
            $detail->getColumnDimension('B')->setWidth(30);
            $detail->getColumnDimension('C')->setWidth(12);
            $detail->getColumnDimension('D')->setWidth(12);
            $detail->getColumnDimension('E')->setWidth(12);
            $detail->getColumnDimension('F')->setWidth(12);
            $detail->getColumnDimension('G')->setWidth(14);
            $detail->getColumnDimension('H')->setWidth(30);

            $detail->mergeCells('A1:C1');
            $detail->mergeCells('A2:C2');
            $detail->setCellValue('A1', 'MARKAS BESAR ANGKATAN DARAT')
                    ->setCellValue('A2', 'STAFF UMUM PERSONEL');

            $detail->getStyle('A1:A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $detail->getStyle('A1:A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $detail->getStyle('A1:A2')->getFont()->setBold(TRUE);
            $detail->getStyle('A2:C2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $detail->mergeCells('A4:H4');
            $detail->mergeCells('A5:H5');
            $detail->setCellValue('A4', 'DATA KEKUATAN PERSONEL SATKOWIL DAN SATINTEL ' . beautify_str($kotama))
                    ->setCellValue('A5', 'BULAN ' . strtoupper(array_month($bulan)) . ' TAHUN ' . $tahun);
            $detail->getStyle('A4:A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $detail->getStyle('A4:A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $detail->getStyle('A4:A5')->getFont()->setSize(11)->setBold(TRUE);

            $detail->mergeCells('A7:A8');
            $detail->mergeCells('B7:B8');
            $detail->mergeCells('C7:C8');
            $detail->mergeCells('D7:D8');
            $detail->mergeCells('E7:E8');
            $detail->mergeCells('F7:F8');
            $detail->mergeCells('G7:G8');
            $detail->mergeCells('H7:H8');
            $detail->setCellValue('A7', 'NO');
            $detail->setCellValue('B7', 'KESATUAN');
            $detail->setCellValue('C7', 'GOLONGAN');
            $detail->setCellValue('D7', 'TOP');
            $detail->setCellValue('E7', 'NYATA');
            $detail->setCellValue('F7', '+/-');
            $detail->setCellValue('G7', '%');
            $detail->setCellValue('H7', 'KETERANGAN');

            $h = "A";
            $i = 1;
            while ($i < 9) {
                $detail->setCellValue($h . '9', $i);
                $h = chr(ord($h) + 1);
                $i++;
            }

            $detail->getStyle('A7:H9')->getAlignment()->setWrapText(TRUE);
            $detail->getStyle('A7:H9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $detail->getStyle('A7:H9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $cell = 11;
            $next_list_number = 1;
            $pa_top = 0;
            $pa_nyata = 0;
            $ba_top = 0;
            $ba_nyata = 0;
            $ta_top = 0;
            $ta_nyata = 0;
            $pns_top = 0;
            $pns_nyata = 0;
            $total_top = 0;
            $total_nyata = 0;

            foreach ($datas as $kesatuan => $data):

                $detail->setCellValue('B' . $cell, $kesatuan)->getStyle('B' . $cell)->getFont()->setBold(TRUE);
                $cell = $cell + 1;

                foreach ($data as $satminkal => $record) :
                    $mulai = TRUE;
                    $is_korem = substr(strtolower($satminkal), 0, 5) == 'korem';
                    $under_korem = strpos(strtolower($satminkal), 'rem') != FALSE ? TRUE : FALSE;
                    $sub_top = 0;
                    $sub_nyata = 0;

                    foreach ($record as $row) :

                        if ($is_korem && $mulai) {
                            $detail->setCellValue('A' . $cell, $next_list_number++);
                            $detail->setCellValue('B' . $cell, beautify_str($satminkal))->getStyle()->getFont()->setBold(TRUE);
                            $cell = $cell + 1;
                        }

                        $detail->setCellValue('A' . $cell, $mulai && $under_korem == FALSE ? $next_list_number++ : '' );
                        $detail->setCellValue('B' . $cell, $mulai ? $is_korem != FALSE ? 'MAKOREM' : beautify_str($satminkal) : '')->getStyle('B' . $cell);
                        $detail->setCellValue('C' . $cell, beautify_str($row['golongan']));
                        $detail->setCellValue('D' . $cell, $row["top"] - $row["danramil_top"] - $row["babinsa_top"]);
                        $detail->setCellValue('E' . $cell, $row['nyata']);
                        $detail->setCellValue('F' . $cell, '=E' . $cell . '-D' . $cell . '');
                        $detail->setCellValue('G' . $cell, '=IF(D' . $cell . '>0,E' . $cell . '/D' . $cell . ',0)');

                        if ($row['babinsa'] == 1) {
                            if ($row['danramil_top'] > 0 || $row['danramil_nyata'] > 0) {
                                $cell++;
                                $detail->setCellValue('C' . $cell, beautify_str('Danramil'));
                                $detail->setCellValue('D' . $cell, $row['danramil_top']);
                            }
                            if ($row['babinsa_top'] > 0 || $row['babinsa_nyata'] > 0) {
                                $cell++;
                                $detail->setCellValue('C' . $cell, beautify_str('Babinsa'));
                                $detail->setCellValue('D' . $cell, $row['babinsa_top']);
                                $detail->setCellValue('H' . $cell, $row['babinsa_top']);
                            }
                        }
                        $cell++;
                        $mulai = FALSE;
                        $is_korem = FALSE;
                        $sub_top += $row["top"];
                        $sub_nyata += $row["nyata"];
                        ${strtolower($row['golongan']) . "_top"} += $row["top"];
                        ${strtolower($row['golongan']) . "_nyata"} += $row["nyata"];
                    endforeach;

                    $detail->setCellValue('C' . $cell, beautify_str('JML'))->getStyle('B' . $cell)->getFont()->setBold(true);
                    $detail->setCellValue('D' . $cell, $sub_top);
                    $detail->setCellValue('E' . $cell, $sub_nyata);
                    $detail->setCellValue('F' . $cell, '=E' . $cell . '-D' . $cell . '');
                    $detail->setCellValue('G' . $cell, '=IF(D' . $cell . '>0,E' . $cell . '/D' . $cell . ',0)');

                    $cell = $cell + 2;
                    $total_top += $sub_top;
                    $total_nyata += $sub_nyata;
                endforeach;
            endforeach;

            $detail->setCellValue('B' . $cell, beautify_str('REKAPITULASI'))->getStyle()->getFont()->setBold(true);
            $detail->setCellValue('C' . $cell, beautify_str('PA'));
            $detail->setCellValue('D' . $cell, $pa_top);
            $detail->setCellValue('E' . $cell, $pa_nyata);
            $detail->setCellValue('F' . $cell, '=E' . $cell . '-D' . $cell . '');
            $detail->setCellValue('G' . $cell, '=IF(D' . $cell . '>0,E' . $cell . '/D' . $cell . ',0)');

            $cell = $cell + 1;
            $detail->setCellValue('C' . $cell, beautify_str('BA'));
            $detail->setCellValue('D' . $cell, $ba_top);
            $detail->setCellValue('E' . $cell, $ba_nyata);
            $detail->setCellValue('F' . $cell, '=E' . $cell . '-D' . $cell . '');
            $detail->setCellValue('G' . $cell, '=IF(D' . $cell . '>0,E' . $cell . '/D' . $cell . ',0)');

            $cell = $cell + 1;
            $detail->setCellValue('C' . $cell, beautify_str('TA'));
            $detail->setCellValue('D' . $cell, $ta_top);
            $detail->setCellValue('E' . $cell, $ta_nyata);
            $detail->setCellValue('F' . $cell, '=E' . $cell . '-D' . $cell . '');
            $detail->setCellValue('G' . $cell, '=IF(D' . $cell . '>0,E' . $cell . '/D' . $cell . ',0)');

            $cell = $cell + 1;
            $detail->setCellValue('C' . $cell, beautify_str('PNS'));
            $detail->setCellValue('D' . $cell, $pns_top);
            $detail->setCellValue('E' . $cell, $pns_nyata);
            $detail->setCellValue('F' . $cell, '=E' . $cell . '-D' . $cell . '');
            $detail->setCellValue('G' . $cell, '=IF(D' . $cell . '>0,E' . $cell . '/D' . $cell . ',0)');

            $cell = $cell + 1;
            $detail->setCellValue('C' . $cell, beautify_str('JML'));
            $detail->setCellValue('D' . $cell, $total_top);
            $detail->setCellValue('E' . $cell, $total_nyata);
            $detail->setCellValue('F' . $cell, '=E' . $cell . '-D' . $cell . '');
            $detail->setCellValue('G' . $cell, '=IF(D' . $cell . '>0,E' . $cell . '/D' . $cell . ',0)');
            $z = str_replace('/', '-', $kotama);
            $detail->setTitle($z);

            $detail->getStyle('A7:H' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_HAIR);
            $detail->getStyle('A7:A' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $detail->getStyle('B7:B' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $detail->getStyle('C7:C' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $detail->getStyle('D7:D' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $detail->getStyle('E7:E' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $detail->getStyle('F7:F' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $detail->getStyle('G7:G' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $detail->getStyle('H7:H' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $detail->getStyle('A7:H8')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $detail->getStyle('A9:H9')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $detail->getStyle('A' . $cell . ':H' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $detail->getStyle('A7:H7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);

            $detail->getStyle('D10:E' . $cell)->getNumberFormat()->setFormatCode('#,##0');
            $detail->getStyle('F10:F' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
            $detail->getStyle('G10:G' . $cell)->getNumberFormat()->setFormatCode('#,##0.00%');
            $detail->getStyle('H10:H' . $cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        endforeach;

        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="LaporanSatkowil-' . $tahun . '-' . $bulan . '.xlsx"');
        $objWriter->save("php://output");
        exit();
    }

}
