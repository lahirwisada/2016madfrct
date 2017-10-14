<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once APPPATH . "controllers/back_end/mslaporan.php";

class Lpsatbalak extends Mslaporan {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct('modul_laporan_satbalak', 'Rekapitulasi SATBALAK/LEMDIKRAH');
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
            'golongan' => $this->model_laporan->get_satbalak_by_kotama_and_golongan($bulan, $tahun),
            'detail' => $this->model_laporan->get_satbalak_by_satminkal_and_golongan($bulan, $tahun),
        );
//        var_dump($records);
//        exit();
        $this->set('bulan', $bulan);
        $this->set('tahun', $tahun);
        $this->set("records", $records);
    }


    function export($tipe = "rekap", $bulan = 1, $tahun = 2014){
               $this->load->library("PHPExcel/PHPExcel");

         $records = array(
            'golongan' => $this->model_laporan->get_satbalak_by_kotama_and_golongan($bulan, $tahun),
            'detail' => $this->model_laporan->get_satbalak_by_satminkal_and_golongan($bulan, $tahun),
        );


           $objPHPExcel = new PHPExcel();
              $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        
        // $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
        // $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
        // $objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAPITULASI KEKUATAN PERSONEL SATBALAK/LEMDIKRAH TNI AD')->setCellValue('A2', 'Bulan ' . $bulan . ' Tahun ' . $tahun);

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

        $objPHPExcel->getActiveSheet()->mergeCells('A4:H4');
        $objPHPExcel->getActiveSheet()->mergeCells('A5:H5');
        $objPHPExcel->getActiveSheet()
                ->setCellValue('A4', 'REKAPITULASI KEKUATAN PERSONEL SATBALAK/LEMDIKRAH TNI AD')
                ->setCellValue('A5', 'Bulan ' . strtoupper(array_month($bulan)) . ' Tahun ' . $tahun);
        $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE);
        $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE);

        $objPHPExcel->getActiveSheet()->setCellValue('A7','NO');
        $objPHPExcel->getActiveSheet()->setCellValue('B7','KESATUAN');
        $objPHPExcel->getActiveSheet()->setCellValue('C7','GOLONGAN');
        $objPHPExcel->getActiveSheet()->setCellValue('D7','TOP');
        $objPHPExcel->getActiveSheet()->setCellValue('E7','NYATA');
        $objPHPExcel->getActiveSheet()->setCellValue('F7','+/-');
        $objPHPExcel->getActiveSheet()->setCellValue('G7','%');
        $objPHPExcel->getActiveSheet()->setCellValue('H7','KETERANGAN');


        $h = "A";
        $i = 1;
        while($i < 9){
            $objPHPExcel->getActiveSheet()->setCellValue($h.'8',$i);
            $h = chr(ord($h) + 1);
            $i++;
        }


        
        $objPHPExcel->getActiveSheet()->getStyle('A7:H8')->getAlignment()->setWrapText(TRUE);
        $objPHPExcel->getActiveSheet()->getStyle('A7:H8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A7:H8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


        $cell = 10;
           $next_list_number = 1;
                                            $pa_top = 0;
                                            $pa_nyata = 0;
                                            $ba_top = 0;
                                            $ba_nyata = 0;
                                            $ta_top = 0;
                                            $ta_nyata = 0;
                                            $total_top = 0;
                                            $total_nyata = 0;

            foreach ($records['golongan'] as $kotama => $record):

                 $mulai = 'a';
                 $sub_top = 0;
                 $sub_nyata = 0;


                foreach ($record as $row) :
                        $objPHPExcel->getActiveSheet()->setCellValue('A'.$cell,$mulai == 'a' ? $next_list_number : '');
                        $objPHPExcel->getActiveSheet()->setCellValue('B'.$cell, $mulai == 'a' ? beautify_str($kotama) :'');
                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell, beautify_str($row['golongan']));
                        $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell, $row['top']);
                        $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell,$row['nyata']);
                        $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,$row['nyata'] - $row['top']);
                        $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$row["top"] > 0 ? number_format($row["nyata"] / $row["top"] * 100, 1, ",", ".") : 0);

                            $cell = $cell + 1;

                $mulai = 'b';
                 $sub_top += $row["top"];
                  $sub_nyata += $row["nyata"];
                  ${strtolower($row['golongan']) . "_top"} += $row["top"];
                  ${strtolower($row['golongan']) . "_nyata"} += $row["nyata"];

                endforeach;


            $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,beautify_str('JML'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,number_format($sub_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell, number_format($sub_nyata, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,number_format($sub_nyata - $sub_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$sub_top > 0 ? number_format($sub_nyata / $sub_top * 100, 1, ",", ".") : 0);

                    $cell = $cell +2;
                    $next_list_number++;
            endforeach;

         $objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,beautify_str('JUMLAH BESAR'));
         $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,beautify_str('PA'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,number_format($pa_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell, number_format($pa_nyata, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,number_format($pa_nyata - $pa_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$pa_top > 0 ? number_format($pa_nyata / $pa_top * 100, 1, ",", ".") : 0);

            $cell = $cell + 1;

                $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,beautify_str('BA'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,number_format($ba_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell, number_format($ba_nyata, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,number_format($ba_nyata - $ba_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$ba_top > 0 ? number_format($ba_nyata / $ba_top * 100, 1, ",", ".") : 0);

             $cell = $cell + 1;

               $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,beautify_str('TA'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,number_format($ta_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell, number_format($ta_nyata, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,number_format($ta_nyata - $ta_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$ta_top > 0 ? number_format($ta_nyata / $ta_top * 100, 1, ",", ".") : 0);

            $cell = $cell + 1;

              $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,beautify_str('JML'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,$pa_top + $ba_top + $ta_top);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell,$pa_nyata + $ba_nyata + $ta_nyata);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,
                ($pa_nyata + $ba_nyata + $ta_nyata) - ($pa_top + $ba_top + $ba_nyata));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,($pa_top + $ba_top + $ta_top) > 0 ? number_format(($pa_nyata + $ba_nyata + $ta_nyata) / ($pa_top + $ba_top + $ta_top) * 100, 1, ",", ".") : 0);



            $objPHPExcel->getActiveSheet()->getStyle('A7:H' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('A7:A' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('B7:B' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('C7:C' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('D7:D' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('E7:E' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('F7:F' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('G7:G' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('H7:H' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('A7:H8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $cell . ':H' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
            $objPHPExcel->getActiveSheet()->getStyle('A7:H7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
    
            
        $objPHPExcel->getActiveSheet()->getStyle('D10:D' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('E10:E' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('F10:F' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('G10:G' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
        

        $objPHPExcel->getActiveSheet()->setTitle('REKAPITULASI');
            $n = 1;
            foreach ($records['detail'] as $kotama => $datas):


            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($n);
            $n++;

            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
            
            // $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
            // $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
            // $objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAPITULASI KEKUATAN PERSONEL SATBALAK/LEMDIKRAH TNI AD')->setCellValue('A2', 'Bulan ' . $bulan . ' Tahun ' . $tahun);
    
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
    
            $objPHPExcel->getActiveSheet()->mergeCells('A4:H4');
            $objPHPExcel->getActiveSheet()->mergeCells('A5:H5');
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('A4', 'DATA KEKUATAN PERSONEL SATBALAK/LEMDIKRAH '.beautify_str($kotama))
                    ->setCellValue('A5', 'Bulan ' . strtoupper(array_month($bulan)) . ' Tahun ' . $tahun);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE);
            $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE);
    
            $objPHPExcel->getActiveSheet()->setCellValue('A7','NO');
            $objPHPExcel->getActiveSheet()->setCellValue('B7','KESATUAN');
            $objPHPExcel->getActiveSheet()->setCellValue('C7','GOLONGAN');
            $objPHPExcel->getActiveSheet()->setCellValue('D7','TOP');
            $objPHPExcel->getActiveSheet()->setCellValue('E7','NYATA');
            $objPHPExcel->getActiveSheet()->setCellValue('F7','+/-');
            $objPHPExcel->getActiveSheet()->setCellValue('G7','%');
            $objPHPExcel->getActiveSheet()->setCellValue('H7','KETERANGAN');
    
    
            $h = "A";
            $i = 1;
            while($i < 9){
                $objPHPExcel->getActiveSheet()->setCellValue($h.'8',$i);
                $h = chr(ord($h) + 1);
                $i++;
            }
    
    
            
            $objPHPExcel->getActiveSheet()->getStyle('A7:H8')->getAlignment()->setWrapText(TRUE);
            $objPHPExcel->getActiveSheet()->getStyle('A7:H8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A7:H8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    
    
            $cell = 10;
           $next_list_number = 1;
                                            $pa_top = 0;
                                            $pa_nyata = 0;
                                            $ba_top = 0;
                                            $ba_nyata = 0;
                                            $ta_top = 0;
                                            $ta_nyata = 0;
                                            $total_top = 0;
                                            $total_nyata = 0;
                                            $na = 1;

        foreach ($datas as $kesatuan => $data):

            $mulai = TRUE;
            
            foreach ($data as $satminkal => $row) :
                  $sub_top = 0;
                   $sub_nyata = 0;
                     $objPHPExcel->getActiveSheet()->setCellValue('A'.$cell,$mulai ? $next_list_number++ : '');
                     $objPHPExcel->getActiveSheet()->setCellValue('B'.$cell, $mulai ? beautify_str($kesatuan) :'');


                        $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell, beautify_str($row['golongan']));
                        $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell, $row['top']);
                        $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell,$row['nyata']);
                        $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,$row['nyata'] - $row['top']);
                        $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$row["top"] > 0 ? number_format($row["nyata"] / $row["top"] * 100, 1, ",", ".") : 0);

                            $cell = $cell + 1;
                $mulai = FALSE;
                 $sub_top += $row["top"];
                  $sub_nyata += $row["nyata"];
                  ${strtolower($row['golongan']) . "_top"} += $row["top"];
                  ${strtolower($row['golongan']) . "_nyata"} += $row["nyata"];



            endforeach;
              $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,beautify_str('JML'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,number_format($sub_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell, number_format($sub_nyata, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,number_format($sub_nyata - $sub_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$sub_top > 0 ? number_format($sub_nyata / $sub_top * 100, 1, ",", ".") : 0);
                    $cell = $cell +2;





            endforeach;


         $objPHPExcel->getActiveSheet()->setCellValue('B'.$cell,beautify_str('JUMLAH BESAR'));
         $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,beautify_str('PA'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,number_format($pa_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell, number_format($pa_nyata, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,number_format($pa_nyata - $pa_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$pa_top > 0 ? number_format($pa_nyata / $pa_top * 100, 1, ",", ".") : 0);

            $cell = $cell + 1;

                $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,beautify_str('BA'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,number_format($ba_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell, number_format($ba_nyata, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,number_format($ba_nyata - $ba_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$ba_top > 0 ? number_format($ba_nyata / $ba_top * 100, 1, ",", ".") : 0);

             $cell = $cell + 1;

               $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,beautify_str('TA'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,number_format($ta_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell, number_format($ta_nyata, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,number_format($ta_nyata - $ta_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$ta_top > 0 ? number_format($ta_nyata / $ta_top * 100, 1, ",", ".") : 0);

            $cell = $cell + 1;


    $objPHPExcel->getActiveSheet()->setCellValue('C'.$cell,beautify_str('JML'));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$cell,number_format($pa_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$cell, number_format($pa_nyata, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$cell,number_format($pa_nyata - $pa_top, 0, ",", "."));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$cell,$total_top > 0 ? number_format($total_nyata / $total_top * 100, 1, ",", ".") : 0);
           $z = str_replace('/','-',$kotama);
        $objPHPExcel->getActiveSheet()->setTitle($z);


        $objPHPExcel->getActiveSheet()->getStyle('A7:H' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()->getStyle('A7:A' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('B7:B' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('C7:C' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('D7:D' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('E7:E' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('F7:F' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('G7:G' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('H7:H' . $cell)->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('A7:H8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $cell . ':H' . $cell)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $objPHPExcel->getActiveSheet()->getStyle('A7:H7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);

        $objPHPExcel->getActiveSheet()->getStyle('D10:D' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('E10:E' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('F10:F' . $cell)->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->getActiveSheet()->getStyle('G10:G' . $cell)->getNumberFormat()->setFormatCode('+#,##0;-#,##0;0');
        


        endforeach;


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="LaporanSatbalak.xlsx"');
        $objWriter->save("php://output");


    }

}
