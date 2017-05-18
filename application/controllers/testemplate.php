<?php 

	class testemplate extends CI_Controller {


		function __construct(){
			parent::__construct();
		}

		function index(){
           $this->load->library("PHPExcel/PHPExcel");
           //exit;

           $kode_kotama = $_GET['kotama'];
           $kotama = $this->db->query("SELECT * FROM sc_fcstprsn.master_kotama WHERE id_kotama = '$kode_kotama'")->row_array();
           $query_satminkal = $this->db->query("SELECT * FROM sc_fcstprsn.master_satminkal WHERE id_kotama = '$kode_kotama'");

           $pangkat = $this->db->query("SELECT * FROM sc_fcstprsn.master_pangkat ORDER BY kode_pangkat DESC")->result_array();
           $total = count($pangkat);



           $satminkal = $query_satminkal->result_array();

           

			//echo "<pre>";
			//print_r($a);
			//exit;

			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
						$objPHPExcel->getActiveSheet()->mergeCells('A2:E2');

			$objPHPExcel->getActiveSheet()->setCellValue('A1','TENTARA NASIONAL INDONESIA ANGKATAN DARAT')
										  ->setCellValue('A2',$kotama['ur_kotama'])
										  ->setCellValue('A5','REKAPITULASI PERUBAHAN KEKUATAN PRAJURIT TNI AD KOTAMA/BALAKPUS')
										  ->setCellValue('A6','DAN PENDIDIKAN MILITER BULAN MEI TA. 2017');

			$objPHPExcel->getActiveSheet()->setCellValue('A8','Kesatuan : '.$kotama['ur_kotama']);

			 $objPHPExcel->getActiveSheet()->setCellValue('A9',"NO");
					 $objPHPExcel->getActiveSheet()->setCellValue('B9',"PANGKAT");
					 $objPHPExcel->getActiveSheet()->setCellValue('C9',"TOP");
					 $objPHPExcel->getActiveSheet()->setCellValue('D9',"NYATA");
					 $objPHPExcel->getActiveSheet()->setCellValue('I9',"STATUS");

					 $objPHPExcel->getActiveSheet()->setCellValue('D10',"DINAS AKTIF");

					 $objPHPExcel->getActiveSheet()->setCellValue('E10',"MPP");
					 $objPHPExcel->getActiveSheet()->setCellValue('F10',"LF");
					 $objPHPExcel->getActiveSheet()->setCellValue('G10',"SKORSING");
					 $objPHPExcel->getActiveSheet()->setCellValue('H10',"JUMLAH");

			$objPHPExcel->getActiveSheet()->mergeCells('A9:A11');
			$objPHPExcel->getActiveSheet()->mergeCells('B9:B11');
			$objPHPExcel->getActiveSheet()->mergeCells('C9:C11');
			$objPHPExcel->getActiveSheet()->mergeCells('D9:H9');
			$objPHPExcel->getActiveSheet()->mergeCells('I9:I11');

				$objPHPExcel->getActiveSheet()->mergeCells('D10:D11');
				$objPHPExcel->getActiveSheet()->mergeCells('E10:E11');
				$objPHPExcel->getActiveSheet()->mergeCells('F10:F11');
				$objPHPExcel->getActiveSheet()->mergeCells('G10:G11');
				$objPHPExcel->getActiveSheet()->mergeCells('H10:H11');
					
				$styleThinBlackBorderOutline = array(
'alignment' => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
),
	'borders' => array(	

		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF000000'),
		),
	),
);
$objPHPExcel->getActiveSheet()->getStyle('A9:I11')->applyFromArray($styleThinBlackBorderOutline);




					$huruf = "A";
					$aa = 1;
					$pp = 12;

					while($huruf <= "I"){


						        $objPHPExcel->getActiveSheet()->setCellValue($huruf.$pp,$aa);
						        						        $huruf = chr(ord($huruf) + 1);

						        $aa++;



					}

				$awalini = 14;
										$objPHPExcel->getActiveSheet()->getStyle('A12:I12')->applyFromArray($styleThinBlackBorderOutline);

				foreach($pangkat as $p => $pa){ 


						$objPHPExcel->getActiveSheet()->setCellValue('A'.$awalini,$p + 1);
						$objPHPExcel->getActiveSheet()->setCellValue('B'.$awalini, $pa['ur_pangkat']);
						$objPHPExcel->getActiveSheet()->setCellValue('H'.$awalini,"=SUM(D".$awalini.":G".$awalini.")");
						$objPHPExcel->getActiveSheet()->setCellValue('I'.$awalini,"=(C".$awalini."-H".$awalini.")");



						$awalini++;
				}



				$cellawal= 9;
				$cellawal = $awalini + 10;



				$first = $cellawal + 4;
				$fonts = array(	'font'    => array(
				'bold'      => true
			));

				foreach($satminkal as $s => $val){


					$objPHPExcel->getActiveSheet()->setCellValue('A'.$first,"Kesatuan  : ".$val['ur_satminkal'])->getStyle('A'.$first)->applyFromArray($fonts);
					$objPHPExcel->getActiveSheet()->mergeCells('A'.$first.':D'.$first);
					$next = $first + 1;
					$next2 = $first + 2;
					$next4 = $first + 3;					
					 $objPHPExcel->getActiveSheet()->setCellValue('A'.$next,"NO");
					 $objPHPExcel->getActiveSheet()->setCellValue('B'.$next,"PANGKAT");
					 $objPHPExcel->getActiveSheet()->setCellValue('C'.$next,"TOP");
					 $objPHPExcel->getActiveSheet()->setCellValue('D'.$next,"NYATA");
					 $objPHPExcel->getActiveSheet()->setCellValue('I'.$next,"STATUS");

					 $objPHPExcel->getActiveSheet()->setCellValue('D'.$next2,"DINAS AKTIF");

					 $objPHPExcel->getActiveSheet()->setCellValue('E'.$next2,"MPP");
					 $objPHPExcel->getActiveSheet()->setCellValue('F'.$next2,"LF");
					 $objPHPExcel->getActiveSheet()->setCellValue('G'.$next2,"SKORSING");
					 $objPHPExcel->getActiveSheet()->setCellValue('H'.$next2,"JUMLAH");

				 $objPHPExcel->getActiveSheet()->mergeCells('A'.$next.':A'.$next4);
				 $objPHPExcel->getActiveSheet()->mergeCells('B'.$next.':B'.$next4);
				 $objPHPExcel->getActiveSheet()->mergeCells('C'.$next.':C'.$next4);
				 $objPHPExcel->getActiveSheet()->mergeCells('I'.$next.':I'.$next4);
				 $objPHPExcel->getActiveSheet()->mergeCells('D'.$next.':H'.$next);
				 $objPHPExcel->getActiveSheet()->mergeCells('D'.$next2.':D'.$next4);
				 $objPHPExcel->getActiveSheet()->mergeCells('E'.$next2.':E'.$next4);
				 $objPHPExcel->getActiveSheet()->mergeCells('F'.$next2.':F'.$next4);
				 $objPHPExcel->getActiveSheet()->mergeCells('G'.$next2.':G'.$next4);
				 $objPHPExcel->getActiveSheet()->mergeCells('H'.$next2.':H'.$next4);
$objPHPExcel->getActiveSheet()->getStyle('A'.$next.':I'.$next4)->applyFromArray($styleThinBlackBorderOutline);

					$tm = $first + 5;

					foreach($pangkat as $p => $pa){


						$objPHPExcel->getActiveSheet()->setCellValue('A'.$tm,$p + 1);
						$objPHPExcel->getActiveSheet()->setCellValue('B'.$tm, $pa['ur_pangkat'])->getStyle()->getFont()	->setBold(true);
						$objPHPExcel->getActiveSheet()->setCellValue('H'.$tm,"=SUM(D".$tm.":G".$tm.")");
						$objPHPExcel->getActiveSheet()->setCellValue('I'.$tm,"=(C".$tm."-H".$tm.")");
						$tm++;

					}
					$jumlah = $first + ($total + 6);
										$objPHPExcel->getActiveSheet()->setCellValue('B'.$jumlah,"Jumlah");
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$jumlah,"");
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$jumlah,"");
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$jumlah,"");
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$jumlah,"");
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$jumlah,"");
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$jumlah,"");
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$jumlah,"");






					$first = $first  + ($total + 10);



				}



						//			$f = 8;
			// 	$no = 1;
			// foreach($a as $val){ 	

			// 	$objPHPExcel->getActiveSheet()->setCellValue('A'.$f,$no++);
			// 	$objPHPExcel->getActiveSheet()->setCellValue('B'.$f,$val['ur_pangkat']);

			// 	$f++;

			// }
				$dit = strtotime(date('Y-m-d H:i:s'));

			  $objPHPExcel->getActiveSheet()->setTitle('Excel Pertama');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$dit.'.xlsx"');
            $objWriter->save("php://output");




				}

	}