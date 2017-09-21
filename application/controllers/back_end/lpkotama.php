<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . "controllers/back_end/mslaporan.php";

class Lpkotama extends Mslaporan {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_kotama', 'Kekuatan KOTAMA/BALAKPUS');
        $this->load->model('model_laporan');
    }

    public function index() {
        $this->get_attention_message_from_session();

        $response = $this->get_bulan_tahun();
        extract($response);

        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
        $tingkat = 5;
        $records["kategori"] = $this->model_laporan->get_by_kotama_and_golongan($bulan, $tahun);
        $records["tingkat"] = $this->model_laporan->get_by_kotama_and_tingkat($tingkat, $bulan, $tahun);
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
    }

    function export($tipe = "rekap", $bulan = 1, $tahun = 2014) {
        $this->load->library("PHPExcel/PHPExcel");

        $tingkat = 5;

        $records["kategori"] = $this->model_laporan->get_by_kotama_and_golongan($bulan, $tahun);
        $records["tingkat"] = $this->model_laporan->get_by_kotama_and_tingkat($tingkat, $bulan, $tahun);

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAPITULASI PA ,BA , TA PER KOTAMA/BALAKPUS TNI AD')->setCellValue('A2', 'Bulan ' . $bulan . ' Tahun ' . $tahun);

        $objPHPExcel->getActiveSheet()->mergeCells('A4:A5');
        $objPHPExcel->getActiveSheet()->mergeCells('B4:B5');
        $objPHPExcel->getActiveSheet()->mergeCells('C4:E4');
        $objPHPExcel->getActiveSheet()->mergeCells('F4:H4');
        $objPHPExcel->getActiveSheet()->mergeCells('I4:K4');
        $objPHPExcel->getActiveSheet()->mergeCells('L4:N4');

        $objPHPExcel->getActiveSheet()->setCellValue('A4', 'NO');
        $objPHPExcel->getActiveSheet()->setCellValue('B4', 'KOTAMA/BALAKPUS');
        $objPHPExcel->getActiveSheet()->setCellValue('C4', 'PERWIRA');
        $objPHPExcel->getActiveSheet()->setCellValue('F4', 'BINTARA');
        $objPHPExcel->getActiveSheet()->setCellValue('I4', 'TAMTAMA');
        $objPHPExcel->getActiveSheet()->setCellValue('L4', 'JUMLAH');

        $objPHPExcel->getActiveSheet()->setCellValue('C5', 'TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('D5', 'NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('E5', '+/-');
        $objPHPExcel->getActiveSheet()->setCellValue('F5', 'TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('G5', 'NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('H5', '+/-');
        $objPHPExcel->getActiveSheet()->setCellValue('I5', 'TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('J5', 'NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('K5', '+/-');
        $objPHPExcel->getActiveSheet()->setCellValue('L5', 'TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('M5', 'NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('N5', '+/-');

        $next_list_number = 1;
        $perwira_top = 0;
        $perwira_nyata = 0;
        $bintara_top = 0;
        $bintara_nyata = 0;
        $tamtama_top = 0;
        $tamtama_nyata = 0;


        $cell = 7;
        foreach ($records["kategori"] as $record):


            $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $next_list_number);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, beautify_str($record["kotama"]));
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
            $next_list_number = $next_list_number + 1;
        endforeach;
        $cell = $cell + 1;

        $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, 'JUMLAH ');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $cell, $perwira_top);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $cell, $perwira_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $cell, $perwira_nyata - $perwira_top);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $cell, $bintara_top);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $cell, $bintara_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $cell, $bintara_nyata - $bintara_top);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $cell, $tamtama_top);
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $cell, $tamtama_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $cell, $tamtama_nyata - $tamtama_top);
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $cell, $perwira_top + $bintara_top + $tamtama_top);
        $objPHPExcel->getActiveSheet()->setCellValue('M' . $cell, $perwira_nyata + $bintara_nyata + $tamtama_nyata);
        $objPHPExcel->getActiveSheet()->setCellValue('N' . $cell, ($perwira_nyata + $bintara_nyata + $tamtama_nyata) - ($perwira_top + $bintara_top + $tamtama_top));

        $objPHPExcel->getActiveSheet()->setTitle('REKAPITULASI');
        $angka = 1;
        if ($records['tingkat'] != FALSE) {
            foreach ($records["tingkat"] as $tingkat => $data) :

                $next_list_number = 1;
                $jumlah_pangkat = count($data["pangkat"]);
                $lebar = round(70 / $jumlah_pangkat / 3);
                $total_top = 0;
                $total_nyata = 0;

                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($angka);
                $angka++;
                $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
                $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
                $objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAPITULASI ' . $tingkat . ' PER KOTAMA/BALAKPUS TNI AD')->setCellValue('A2', 'Bulan ' . $bulan . ' Tahun ' . $tahun);

                $objPHPExcel->getActiveSheet()->mergeCells('A4:A5');
                $objPHPExcel->getActiveSheet()->mergeCells('B4:B5');
                $objPHPExcel->getActiveSheet()->mergeCells('C4:E4');
                $objPHPExcel->getActiveSheet()->mergeCells('F4:H4');
                $objPHPExcel->getActiveSheet()->mergeCells('I4:K4');
                $objPHPExcel->getActiveSheet()->mergeCells('L4:N4');

                $objPHPExcel->getActiveSheet()->setCellValue('A4', 'NO');
                $objPHPExcel->getActiveSheet()->setCellValue('B4', 'KECAB');
                $ha = "C";
                $habawah = "C";
                $i = 0;
                foreach ($data['pangkat'] as $pangkat):
                    $objPHPExcel->getActiveSheet()->setCellValue($ha . '4', strtoupper($pangkat));

                    $objPHPExcel->getActiveSheet()->setCellValue($habawah . '5', 'TOP');
                    $habawah = chr(ord($habawah) + 1);

                    $objPHPExcel->getActiveSheet()->setCellValue($habawah . '5', 'NYATA');
                    $habawah = chr(ord($habawah) + 1);

                    $objPHPExcel->getActiveSheet()->setCellValue($habawah . '5', '+/-');
                    $habawah = chr(ord($habawah) + 1);


                    $ha = chr(ord($ha) + 3);

                    ${"col" . (2 * $i + 1)} = strtolower($pangkat . "_top");
                    ${"col" . (2 * $i + 2)} = strtolower($pangkat . "_nyata");
                    ${"sub" . (2 * $i + 1)} = 0;
                    ${"sub" . (2 * $i + 2)} = 0;

                    $i++;


                endforeach;
                $objPHPExcel->getActiveSheet()->setCellValue($ha . '4', 'JUMLAH');

                $objPHPExcel->getActiveSheet()->setCellValue($habawah . '5', 'TOP');
                $habawah = chr(ord($habawah) + 1);

                $objPHPExcel->getActiveSheet()->setCellValue($habawah . '5', 'NYATA');
                $habawah = chr(ord($habawah) + 1);

                $objPHPExcel->getActiveSheet()->setCellValue($habawah . '5', '+/-');
                $habawah = chr(ord($habawah) + 1);

                $cell = 7;
                foreach ($data['data'] as $record):
                    $sub_top = 0;
                    $sub_nyata = 0;


                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $next_list_number);
                    $next_list_number = $next_list_number + 1;
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $cell, beautify_str($record["kotama"]));
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
                $ha = chr(ord($ha) + 1);


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
        header('Content-Disposition: attachment;filename="LaporanKotama.xlsx"');
        $objWriter->save("php://output");
        exit;
    }

}
