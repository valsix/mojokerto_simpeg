<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class cetak_report_json extends CI_Controller {

	function __construct() {
		parent::__construct();
		//kauth

		$CI =& get_instance();
		$configdata= $CI->config;
        $configvlxsessfolder= $configdata->config["vlxsessfolder"];

        $redirectlogin= "";
        if(!empty($this->session->userdata("adminuserid".$configvlxsessfolder)))
        {
        	$redirectlogin= $this->session->userdata("adminuserid".$configvlxsessfolder);
        }

        if(empty($redirectlogin))
		{
			redirect('login');
		}

		$this->adminuserid= $this->session->userdata("adminuserid".$configvlxsessfolder);
		$this->adminsatkerid= $this->session->userdata("adminsatkerid".$configvlxsessfolder);
		$this->sess_satkerid= $this->adminsatkerid;
		$this->adminuserloginnama= $this->session->userdata("adminuserloginnama".$configvlxsessfolder);
		$this->adminusernama= $this->session->userdata("adminusernama".$configvlxsessfolder);
		$this->adminusergroupid= $this->session->userdata("adminusergroupid".$configvlxsessfolder);
		$this->adminuserpegawaiid= $this->session->userdata("adminuserpegawaiid".$configvlxsessfolder);
	}

	function kel_kawin()
	{
		/* INCLUDE FILE */
		require 'lib/PHPExcel.php';
		include_once("functions/date.func.php");
		include_once("functions/string.func.php");
		include_once("functions/default.func.php");
		//set_time_limit(3);
		ini_set("memory_limit","500M");
		ini_set('max_execution_time', 520);

		$reqId= $this->input->get('reqId');
		$reqFilter= $this->input->get('reqFilter');
		$reqPeriode= $this->input->get('reqPeriode');
		$reqTahun= $this->input->get('reqTahun');

		if($reqPeriode == "1") 
		{
			$infoPeriode= 'Semester I (1 Januari - 30 Juni)';
		}
		elseif($reqPeriode == 2)
		{
			$infoPeriode= 'Semester II (1 Juli - 30 Desember)';
		}
		else
		{
			$infoPeriode= 'Semua Periode';
		}

		$tgl=date('Y-m-d');


		$objPHPexcel= PHPExcel_IOFactory::load('Templates/report/kel_kawin.xlsx');
		$style = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);

		$styleT = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);

		$styleTengah = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);


		$styleTengahC = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '9BC2E6')
			),
		);





		$objWorksheet = $objPHPexcel->getActiveSheet();

		$field= array("NO", "NAMA", "TOT_L", "TOT_P", "TOT_JK", "SUDAH_KAWIN", "BELUM_KAWIN", "JANDA", "DUDA","TOTAL_KAWIN","SD","SMP","SMA","D1","D2","D3","D4","S1","S2","S3","SEKOLAH","ISLAM","KRISTEN","KATOLIK","HINDU","BUDHA","KP","AGAMA");


		if($reqFilter == ""){

		}

		$pesan= "KEADAAN ".strtoupper($infoPeriode)." TAHUN ".$reqTahun;

		$objWorksheet->setCellValue("C4",$pesan);

		$statement = "  ";

		$this->load->model("base/Rekap");
		$set = new Rekap();
		$set->selectByParamsBkppRekapKelKawinPendaga(array(), -1, -1, $statement);	
		// $urut=1;
		$nomor=1;
		$kolomawal=1;
		$row = 9;
		// echo $set->query; exit; 
		while($set->nextRow()){	

			$index_kolom= 0;

			for($i=0; $i<count($field); $i++)
			{
			
				$kolom= toAlpha($index_kolom);	$kolom= toAlpha($index_kolom);
				// print_r($kolom);
				$objWorksheet->getStyle($kolom.$row)->applyFromArray($style);
				if($field[$i] == "NO")
				{
					$objWorksheet->setCellValueExplicit($kolom.$row,$nomor, PHPExcel_Cell_DataType::TYPE_STRING);
					$objWorksheet->getStyle("A".$row)->applyFromArray($styleT);
				}
				else if($field[$i] == "NAMA"  )
				{
					$objWorksheet->setCellValue($kolom.$row,$set->getField($field[$i]));
				}
				else if($field[$i] == "JUMLAH" )
				{
					$objWorksheet->setCellValue($kolom.$row,1);
					$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleT);
				}
				else
				{
					$objWorksheet->setCellValue($kolom.$row,$set->getField($field[$i]));
					$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleT);
				}

				$index_kolom++;
			}


			$nomor++;
			$row++;
		} 
		// print_r($index_kolom);exit;

		$objWorksheet->mergeCells('A'.$row.':'.'B'.$row);
		$objWorksheet->setCellValue("A".$row,"JUMLAH DIPINDAHKAN");
		$objWorksheet->getStyle("A".$row)->getFont()->setBold( true );
		$objWorksheet->getStyle("A".$row)->applyFromArray($styleTengahC);
		
		for($i=2; $i<=$index_kolom-1; $i++)
		{
			// print_r($kolom);
			$kolom= toAlpha($i);
			$rowAwal=setToAlpha($i, 11); $rowAkhir=setToAlpha($i, $row-1);
			// print_r($kolom.$row-1."/"."=SUM(".$rowAwal.":".$rowAkhir.")");
			// $objWorksheet->setCellValue($kolom.$row,"=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleTengahC);
		}

		$rowtotal=$row+1;

		$objWorksheet->mergeCells('A'.$rowtotal.':'.'B'.$rowtotal);
		$objWorksheet->setCellValue("A".$rowtotal,"JUMLAH TOTAL");
		$objWorksheet->getStyle("A".$rowtotal)->getFont()->setBold( true );
		$objWorksheet->getStyle("A".$rowtotal)->applyFromArray($styleTengahC);
		
		for($i=2; $i<=$index_kolom-1; $i++)
		{
			// print_r($kolom);
			$kolom= toAlpha($i);
			$rowAwal=setToAlpha($i, 11); $rowAkhir=setToAlpha($i, $rowtotal-1);
			// print_r($kolom.$row-1."/"."=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->setCellValue($kolom.$rowtotal,"=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->getStyle($kolom.$rowtotal)->applyFromArray($styleTengahC);
		}

		$rowttd=$rowtotal+2;

		// print_r($rowttd);exit;
		$objWorksheet->setCellValue("X".$rowttd,"KEPALA BADAN KEPEGAWAIAN DAN");
		$objWorksheet->getStyle("X".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("X".$rowttd)->applyFromArray($styleTengah);
		$rowttd=$rowtotal+3;
		$objWorksheet->setCellValue("X".$rowttd,"PENGEMBANGAN SUMBER DAYA MANUSIA");
		$objWorksheet->getStyle("X".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("X".$rowttd)->applyFromArray($styleTengah);
		$rowttd=$rowtotal+4;
		$objWorksheet->setCellValue("X".$rowttd,"KABUPATEN MOJOKERTO");
		$objWorksheet->getStyle("X".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("X".$rowttd)->applyFromArray($styleTengah);


		$rowttd=$rowtotal+9;
		$objWorksheet->setCellValue("W".$rowttd,"NIP :");
		$objWorksheet->getStyle("W".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("W".$rowttd)->applyFromArray($styleTengah);


		// exit;

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
		$objWriter->save('Templates/report/laporan_bkpp_rekap_kelkawinpendaga_excel.xls');

		$down= 'Templates/report/laporan_bkpp_rekap_kelkawinpendaga_excel.xls';
		header('Content-Description: File Transfer');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.basename($down));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($down));
		readfile($down);
		unlink($down);
	}


	function eselon_kosong()
	{
		/* INCLUDE FILE */
		require 'lib/PHPExcel.php';
		include_once("functions/date.func.php");
		include_once("functions/string.func.php");
		include_once("functions/default.func.php");
		//set_time_limit(3);
		ini_set("memory_limit","500M");
		ini_set('max_execution_time', 520);

		$reqId= $this->input->get('reqId');
		$reqFilter= $this->input->get('reqFilter');
		$reqPeriode= $this->input->get('reqPeriode');
		$reqTahun= $this->input->get('reqTahun');

		if($reqPeriode == "1") 
		{
			$infoPeriode= 'Semester I';
		}
		elseif($reqPeriode == 2)
		{
			$infoPeriode= 'Semester II';
		}
		else
		{
			$infoPeriode= 'Semua Periode';
		}

		$tgl=date('Y-m-d');


		$objPHPexcel= PHPExcel_IOFactory::load('Templates/report/eselon_kosong.xlsx');
		$style = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);

		$styleT = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);

		$styleTengah = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);


		$styleTengahC = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '9BC2E6')
			),
		);





		$objWorksheet = $objPHPexcel->getActiveSheet();

		$field= array("NO", "UNIT_KERJA", "NAMA_JABATAN", "ESELON21", "ESELON22", "ESELON31", "ESELON32", "ESELON41", "ESELON42","JUMLAH");


		if($reqFilter == ""){

		}

		$pesan= "KEADAAN ".strtoupper($infoPeriode)." TAHUN ".$reqTahun;

		$objWorksheet->setCellValue("C4",$pesan);

		$statement = "  ";

		$this->load->model("base/Rekap");
		$set = new Rekap();
		$set->selectByParamsBkppRekapEselonJabatanKosong(array(), -1, -1, $statement, "");	
		// $urut=1;
		$nomor=1;
		$kolomawal=1;
		$row = 11;
		// echo $set->query; exit; 
		while($set->nextRow()){	

			$index_kolom= 0;

			for($i=0; $i<count($field); $i++)
			{
			
				$kolom= toAlpha($index_kolom);	$kolom= toAlpha($index_kolom);
				// print_r($kolom);
				$objWorksheet->getStyle($kolom.$row)->applyFromArray($style);
				if($field[$i] == "NO")
				{
					$objWorksheet->setCellValueExplicit($kolom.$row,$nomor, PHPExcel_Cell_DataType::TYPE_STRING);
					$objWorksheet->getStyle("A".$row)->applyFromArray($styleT);
				}
				else if($field[$i] == "UNIT_KERJA" ||  $field[$i] == "NAMA_JABATAN" )
				{
					$objWorksheet->setCellValue($kolom.$row,$set->getField($field[$i]));
				}
				else if($field[$i] == "JUMLAH" )
				{
					$objWorksheet->setCellValue($kolom.$row,1);
					$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleT);
				}
				else
				{
					$objWorksheet->setCellValue($kolom.$row,$set->getField($field[$i]));
					$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleT);
				}

				$index_kolom++;
			}


			$nomor++;
			$row++;
		} 
		// print_r($index_kolom);exit;

		$objWorksheet->mergeCells('A'.$row.':'.'C'.$row);
		$objWorksheet->setCellValue("A".$row,"JUMLAH DIPINDAHKAN");
		$objWorksheet->getStyle("A".$row)->getFont()->setBold( true );
		$objWorksheet->getStyle("A".$row)->applyFromArray($styleTengahC);
		
		for($i=3; $i<=$index_kolom-1; $i++)
		{
			// print_r($kolom);
			$kolom= toAlpha($i);
			$rowAwal=setToAlpha($i, 11); $rowAkhir=setToAlpha($i, $row-1);
			// print_r($kolom.$row-1."/"."=SUM(".$rowAwal.":".$rowAkhir.")");
			// $objWorksheet->setCellValue($kolom.$row,"=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleTengahC);
		}

		$rowtotal=$row+1;

		$objWorksheet->mergeCells('A'.$rowtotal.':'.'C'.$rowtotal);
		$objWorksheet->setCellValue("A".$rowtotal,"JUMLAH TOTAL");
		$objWorksheet->getStyle("A".$rowtotal)->getFont()->setBold( true );
		$objWorksheet->getStyle("A".$rowtotal)->applyFromArray($styleTengahC);
		
		for($i=3; $i<=$index_kolom-1; $i++)
		{
			// print_r($kolom);
			$kolom= toAlpha($i);
			$rowAwal=setToAlpha($i, 11); $rowAkhir=setToAlpha($i, $rowtotal-1);
			// print_r($kolom.$row-1."/"."=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->setCellValue($kolom.$rowtotal,"=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->getStyle($kolom.$rowtotal)->applyFromArray($styleTengahC);
		}

		$rowttd=$rowtotal+2;

		// print_r($rowttd);exit;
		$objWorksheet->setCellValue("H".$rowttd,"KEPALA BADAN KEPEGAWAIAN DAN");
		$objWorksheet->getStyle("H".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("H".$rowttd)->applyFromArray($styleTengah);
		$rowttd=$rowtotal+3;
		$objWorksheet->setCellValue("H".$rowttd,"PENGEMBANGAN SUMBER DAYA MANUSIA");
		$objWorksheet->getStyle("H".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("H".$rowttd)->applyFromArray($styleTengah);
		$rowttd=$rowtotal+4;
		$objWorksheet->setCellValue("H".$rowttd,"KABUPATEN MOJOKERTO");
		$objWorksheet->getStyle("H".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("H".$rowttd)->applyFromArray($styleTengah);


		$rowttd=$rowtotal+9;
		$objWorksheet->setCellValue("G".$rowttd,"NIP :");
		$objWorksheet->getStyle("G".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("G".$rowttd)->applyFromArray($styleTengah);


		// exit;

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
		$objWriter->save('Templates/report/laporan_bkpp_rekap_eselon_jabatan_kosong.xls');

		$down= 'Templates/report/laporan_bkpp_rekap_eselon_jabatan_kosong.xls';
		header('Content-Description: File Transfer');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.basename($down));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($down));
		readfile($down);
		unlink($down);
	}

	function golongan()
	{
		/* INCLUDE FILE */
		require 'lib/PHPExcel.php';
		include_once("functions/date.func.php");
		include_once("functions/string.func.php");
		include_once("functions/default.func.php");
		//set_time_limit(3);
		ini_set("memory_limit","500M");
		ini_set('max_execution_time', 520);

		$reqId= $this->input->get('reqId');
		$reqFilter= $this->input->get('reqFilter');
		$reqPeriode= $this->input->get('reqPeriode');
		$reqTahun= $this->input->get('reqTahun');

		if($reqPeriode == "1") 
		{
			$infoPeriode= 'Semester I';
		}
		elseif($reqPeriode == 2)
		{
			$infoPeriode= 'Semester II';
		}
		else
		{
			$infoPeriode= 'Semua Periode';
		}

		$tgl=date('Y-m-d');


		$objPHPexcel= PHPExcel_IOFactory::load('Templates/report/golongan.xlsx');
		$style = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);

		$styleT = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);

		$styleTengah = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);



		$objWorksheet = $objPHPexcel->getActiveSheet();

		$field= array("NO", "NAMA", "TOTCPNS_11", "TOTCPNS_12", "TOTCPNS_13", "TOTCPNS_21", "TOTCPNS_22", "TOTCPNS_23", "TOTCPNS_31", "TOTCPNS_32", "TOTCPNS", "TOT_11", "TOT_12", "TOT_13", "TOT_14", "TOT_GOL1", "TOT_21", "TOT_22", "TOT_23", "TOT_24", "TOT_GOL2", "TOT_31", "TOT_32", "TOT_33", "TOT_34", "TOT_GOL3", "TOT_41", "TOT_42", "TOT_43", "TOT_44", "TOT_GOL4", "TOT");


		if($reqFilter == ""){

		}

		$pesan= "KEADAAN ".strtoupper($infoPeriode)." TAHUN ".$reqTahun;

		$objWorksheet->setCellValue("C4",$pesan);

		$statement = "  ";

		$this->load->model("base/Rekap");
		$set = new Rekap();
		$set->selectByParamsBkppRekapGolongan(array(), -1, -1, $statement, "");	
		// $urut=1;
		$nomor=1;
		$kolomawal=1;
		$row = 8;
		// echo $set->query; exit; 
		while($set->nextRow()){	

			$index_kolom= 0;

			for($i=0; $i<count($field); $i++)
			{
			
			$kolom= toAlpha($index_kolom);	$kolom= toAlpha($index_kolom);
				// print_r($kolom);
				$objWorksheet->getStyle($kolom.$row)->applyFromArray($style);
				if($field[$i] == "NO")
				{
					$objWorksheet->setCellValueExplicit($kolom.$row,$nomor, PHPExcel_Cell_DataType::TYPE_STRING);
					$objWorksheet->getStyle("A".$row)->applyFromArray($styleT);
				}
				else if($field[$i] == "NAMA")
				{
					$objWorksheet->setCellValue($kolom.$row,$set->getField($field[$i]));
				}
				else
				{
					$objWorksheet->setCellValue($kolom.$row,$set->getField($field[$i]));
					$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleT);
				}

				$index_kolom++;
			}


			$nomor++;
			$row++;
		} 
		// print_r($index_kolom);exit;

		$objWorksheet->mergeCells('A'.$row.':'.'B'.$row);
		$objWorksheet->setCellValue("A".$row,"JUMLAH DIPINDAHKAN");
		$objWorksheet->getStyle("A".$row)->getFont()->setBold( true );
		$objWorksheet->getStyle("A".$row)->applyFromArray($styleT);
		
		for($i=2; $i<=$index_kolom-1; $i++)
		{
			// print_r($kolom);
			$kolom= toAlpha($i);
			$rowAwal=setToAlpha($i, 8); $rowAkhir=setToAlpha($i, $row-1);
			// print_r($kolom.$row-1."/"."=SUM(".$rowAwal.":".$rowAkhir.")");
			// $objWorksheet->setCellValue($kolom.$row,"=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleT);
		}

		$rowtotal=$row+1;

		$objWorksheet->mergeCells('A'.$rowtotal.':'.'B'.$rowtotal);
		$objWorksheet->setCellValue("A".$rowtotal,"JUMLAH TOTAL");
		$objWorksheet->getStyle("A".$rowtotal)->getFont()->setBold( true );
		$objWorksheet->getStyle("A".$rowtotal)->applyFromArray($styleT);
		
		for($i=2; $i<=$index_kolom-1; $i++)
		{
			// print_r($kolom);
			$kolom= toAlpha($i);
			$rowAwal=setToAlpha($i, 8); $rowAkhir=setToAlpha($i, $rowtotal-1);
			// print_r($kolom.$row-1."/"."=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->setCellValue($kolom.$rowtotal,"=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->getStyle($kolom.$rowtotal)->applyFromArray($styleT);
		}

		$rowttd=$rowtotal+2;
		$objWorksheet->setCellValue("X".$rowttd,"KEPALA BADAN KEPEGAWAIAN DAN");
		$objWorksheet->getStyle("X".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("X".$rowttd)->applyFromArray($styleTengah);
		$rowttd=$rowtotal+3;
		$objWorksheet->setCellValue("X".$rowttd,"PENGEMBANGAN SUMBER DAYA MANUSIA");
		$objWorksheet->getStyle("X".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("X".$rowttd)->applyFromArray($styleTengah);
		$rowttd=$rowtotal+4;
		$objWorksheet->setCellValue("X".$rowttd,"KABUPATEN MOJOKERTO");
		$objWorksheet->getStyle("X".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("X".$rowttd)->applyFromArray($styleTengah);


		$rowttd=$rowtotal+9;
		$objWorksheet->setCellValue("V".$rowttd,"NIP :");
		$objWorksheet->getStyle("V".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("V".$rowttd)->applyFromArray($styleTengah);


		// exit;

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
		$objWriter->save('Templates/report/laporan_bkpp_rekap_golongan.xls');

		$down= 'Templates/report/laporan_bkpp_rekap_golongan.xls';
		header('Content-Description: File Transfer');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.basename($down));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($down));
		readfile($down);
		unlink($down);
	}

	function eselon_terisi()
	{
		/* INCLUDE FILE */
		require 'lib/PHPExcel.php';
		include_once("functions/date.func.php");
		include_once("functions/string.func.php");
		include_once("functions/default.func.php");
		//set_time_limit(3);
		ini_set("memory_limit","500M");
		ini_set('max_execution_time', 520);

		$reqId= $this->input->get('reqId');
		$reqFilter= $this->input->get('reqFilter');
		$reqPeriode= $this->input->get('reqPeriode');
		$reqTahun= $this->input->get('reqTahun');

		if($reqPeriode == "1") 
		{
			$infoPeriode= 'Semester I (1 Januari - 30 Juni)';
		}
		elseif($reqPeriode == 2)
		{
			$infoPeriode= 'Semester II (1 Juli - 30 Desember)';
		}
		else
		{
			$infoPeriode= 'Semua Periode';
		}

		$tgl=date('Y-m-d');


		$objPHPexcel= PHPExcel_IOFactory::load('Templates/report/eselon_terisi.xlsx');
		$style = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);

		$styleT = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);

		$styleTengah = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);


		$styleTengahC = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '9BC2E6')
			),
		);





		$objWorksheet = $objPHPexcel->getActiveSheet();

		$field= array("NO","NAMA", "TOT21_43", "TOT22_41", "TOT22_42", "TOT22_43", "TOT22_44", "TOT2", "TOT31_34", "TOT31_41","TOT31_42","TOT32_33","TOT32_34","TOT32_41","TOT32_42","TOT3","TOT41_32","TOT41_33","TOT41_34","TOT41_41","TOT41_42","TOT42_31","TOT42_32","TOT42_33","TOT42_34","TOT4","TOT");


		if($reqFilter == ""){

		}

		$pesan= "KEADAAN ".strtoupper($infoPeriode)." TAHUN ".$reqTahun;

		$objWorksheet->setCellValue("C4",$pesan);

		$statement = "  ";

		$this->load->model("base/Rekap");
		$set = new Rekap();
		$set->selectByParamsBkppRekapEselon(array(), -1, -1, $statement, "");	
		// $urut=1;
		$nomor=1;
		$kolomawal=1;
		$row = 12;
		// echo $set->query; exit; 
		while($set->nextRow()){	

			$index_kolom= 0;

			for($i=0; $i<count($field); $i++)
			{
			
				$kolom= toAlpha($index_kolom);	$kolom= toAlpha($index_kolom);
				// print_r($kolom);
				$objWorksheet->getStyle($kolom.$row)->applyFromArray($style);
				if($field[$i] == "NO")
				{
					$objWorksheet->setCellValueExplicit($kolom.$row,$nomor, PHPExcel_Cell_DataType::TYPE_STRING);
					$objWorksheet->getStyle("A".$row)->applyFromArray($styleT);
				}
				else if($field[$i] == "NAMA" )
				{
					$objWorksheet->setCellValue($kolom.$row,$set->getField($field[$i]));
				}
				else if($field[$i] == "JUMLAH" )
				{
					$objWorksheet->setCellValue($kolom.$row,1);
					$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleT);
				}
				else
				{
					$objWorksheet->setCellValue($kolom.$row,$set->getField($field[$i]));
					$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleT);
				}

				$index_kolom++;
			}


			$nomor++;
			$row++;
		} 
		// print_r($index_kolom);exit;

		$objWorksheet->mergeCells('A'.$row.':'.'B'.$row);
		$objWorksheet->setCellValue("A".$row,"JUMLAH DIPINDAHKAN");
		$objWorksheet->getStyle("A".$row)->getFont()->setBold( true );
		$objWorksheet->getStyle("A".$row)->applyFromArray($styleTengahC);
		
		for($i=2; $i<=$index_kolom-1; $i++)
		{
			// print_r($kolom);
			$kolom= toAlpha($i);
			$rowAwal=setToAlpha($i, 11); $rowAkhir=setToAlpha($i, $row-1);
			// print_r($kolom.$row-1."/"."=SUM(".$rowAwal.":".$rowAkhir.")");
			// $objWorksheet->setCellValue($kolom.$row,"=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleTengahC);
		}

		$rowtotal=$row+1;

		$objWorksheet->mergeCells('A'.$rowtotal.':'.'B'.$rowtotal);
		$objWorksheet->setCellValue("A".$rowtotal,"JUMLAH TOTAL");
		$objWorksheet->getStyle("A".$rowtotal)->getFont()->setBold( true );
		$objWorksheet->getStyle("A".$rowtotal)->applyFromArray($styleTengahC);
		
		for($i=2; $i<=$index_kolom-1; $i++)
		{
			// print_r($kolom);
			$kolom= toAlpha($i);
			$rowAwal=setToAlpha($i, 11); $rowAkhir=setToAlpha($i, $rowtotal-1);
			// print_r($kolom.$row-1."/"."=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->setCellValue($kolom.$rowtotal,"=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->getStyle($kolom.$rowtotal)->applyFromArray($styleTengahC);
		}

		$rowttd=$rowtotal+2;

		// print_r($rowttd);exit;
		$objWorksheet->setCellValue("U".$rowttd,"KEPALA BADAN KEPEGAWAIAN DAN");
		$objWorksheet->getStyle("U".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("U".$rowttd)->applyFromArray($styleTengah);
		$rowttd=$rowtotal+3;
		$objWorksheet->setCellValue("U".$rowttd,"PENGEMBANGAN SUMBER DAYA MANUSIA");
		$objWorksheet->getStyle("U".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("U".$rowttd)->applyFromArray($styleTengah);
		$rowttd=$rowtotal+4;
		$objWorksheet->setCellValue("U".$rowttd,"KABUPATEN MOJOKERTO");
		$objWorksheet->getStyle("U".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("U".$rowttd)->applyFromArray($styleTengah);


		$rowttd=$rowtotal+9;
		$objWorksheet->setCellValue("T".$rowttd,"NIP :");
		$objWorksheet->getStyle("T".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("T".$rowttd)->applyFromArray($styleTengah);


		// exit;

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
		$objWriter->save('Templates/report/laporan_bkpp_rekap_eselon.xls');

		$down= 'Templates/report/laporan_bkpp_rekap_eselon.xls';
		header('Content-Description: File Transfer');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.basename($down));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($down));
		readfile($down);
		unlink($down);
	}

	function fungsional()
	{
		/* INCLUDE FILE */
		require 'lib/PHPExcel.php';
		include_once("functions/date.func.php");
		include_once("functions/string.func.php");
		include_once("functions/default.func.php");
		//set_time_limit(3);
		ini_set("memory_limit","500M");
		ini_set('max_execution_time', 520);

		$reqId= $this->input->get('reqId');
		$reqFilter= $this->input->get('reqFilter');
		$reqPeriode= $this->input->get('reqPeriode');
		$reqTahun= $this->input->get('reqTahun');

		if($reqPeriode == "1") 
		{
			$infoPeriode= 'Semester I (1 Januari - 30 Juni)';
		}
		elseif($reqPeriode == 2)
		{
			$infoPeriode= 'Semester II (1 Juli - 30 Desember)';
		}
		else
		{
			$infoPeriode= 'Semua Periode';
		}

		$tgl=date('Y-m-d');


		$objPHPexcel= PHPExcel_IOFactory::load('Templates/report/fungsional.xlsx');
		$style = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);

		$styleT = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);

		$styleTengah = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
		);


		$styleTengahC = array(
			'borders' => array(
				'allborders' => array(

					'style' => PHPExcel_Style_Border::BORDER_THIN
				)				
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'font'  => array(
				'size' => 8,
				'name'  => 'Tahoma'

			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '9BC2E6')
			),
		);





		$objWorksheet = $objPHPexcel->getActiveSheet();

		$field= array("NO","NAMA", "TOT_21", "TOT_22", "TOT_23", "TOT_24", "TOT_GOL2", "TOT_31", "TOT_32", "TOT_33","TOT_34","TOT_GOL3","TOT_41","TOT_42","TOT_43","TOT_44","TOT_GOL4","TOT","TOT_11_STAF","TOT_12_STAF","TOT_13_STAF","TOT_14_STAF","TOT_STAF1","TOT_21_STAF","TOT_22_STAF","TOT_23_STAF","TOT_24_STAF","TOT_STAF2","TOT_31_STAF","TOT_32_STAF","TOT_33_STAF","TOT_34_STAF","TOT_STAF3","TOT_41_STAF","TOT_42_STAF","TOT_43_STAF","TOT_44_STAF","TOT_STAF4","TOT_STAF","TOTAL_NEW");


		if($reqFilter == ""){

		}

		$pesan= "KEADAAN ".strtoupper($infoPeriode)." TAHUN ".$reqTahun;

		$objWorksheet->setCellValue("C4",$pesan);

		$statement = "  ";

		$this->load->model("base/Rekap");
		$set = new Rekap();
		$set->selectByParamsBkppRekapFungsionalStaf(array(), -1, -1, $statement, "");	
		// $urut=1;
		$nomor=1;
		$kolomawal=1;
		$row = 12;
		// echo $set->query; exit; 
		while($set->nextRow()){	

			$index_kolom= 0;

			for($i=0; $i<count($field); $i++)
			{
			
				$kolom= toAlpha($index_kolom);	$kolom= toAlpha($index_kolom);
				// print_r($kolom);
				$objWorksheet->getStyle($kolom.$row)->applyFromArray($style);
				if($field[$i] == "NO")
				{
					$objWorksheet->setCellValueExplicit($kolom.$row,$nomor, PHPExcel_Cell_DataType::TYPE_STRING);
					$objWorksheet->getStyle("A".$row)->applyFromArray($styleT);
				}
				else if($field[$i] == "NAMA" )
				{
					$objWorksheet->setCellValue($kolom.$row,$set->getField($field[$i]));
				}
				else if($field[$i] == "TOTAL_NEW" )
				{
					$objWorksheet->setCellValue($kolom.$row,$set->getField($field[$i])+$set->getField("TOT_STAF"));
					$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleT);
				}
				else
				{
					$objWorksheet->setCellValue($kolom.$row,$set->getField($field[$i]));
					$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleT);
				}

				$index_kolom++;
			}


			$nomor++;
			$row++;
		} 
		// print_r($index_kolom);exit;

		$objWorksheet->mergeCells('A'.$row.':'.'B'.$row);
		$objWorksheet->setCellValue("A".$row,"JUMLAH DIPINDAHKAN");
		$objWorksheet->getStyle("A".$row)->getFont()->setBold( true );
		$objWorksheet->getStyle("A".$row)->applyFromArray($styleTengahC);
		
		for($i=2; $i<=$index_kolom-1; $i++)
		{
			// print_r($kolom);
			$kolom= toAlpha($i);
			$rowAwal=setToAlpha($i, 11); $rowAkhir=setToAlpha($i, $row-1);
			// print_r($kolom.$row-1."/"."=SUM(".$rowAwal.":".$rowAkhir.")");
			// $objWorksheet->setCellValue($kolom.$row,"=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->getStyle($kolom.$row)->applyFromArray($styleTengahC);
		}

		$rowtotal=$row+1;

		$objWorksheet->mergeCells('A'.$rowtotal.':'.'B'.$rowtotal);
		$objWorksheet->setCellValue("A".$rowtotal,"JUMLAH TOTAL");
		$objWorksheet->getStyle("A".$rowtotal)->getFont()->setBold( true );
		$objWorksheet->getStyle("A".$rowtotal)->applyFromArray($styleTengahC);
		
		for($i=2; $i<=$index_kolom-1; $i++)
		{
			// print_r($kolom);
			$kolom= toAlpha($i);
			$rowAwal=setToAlpha($i, 11); $rowAkhir=setToAlpha($i, $rowtotal-1);
			// print_r($kolom.$row-1."/"."=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->setCellValue($kolom.$rowtotal,"=SUM(".$rowAwal.":".$rowAkhir.")");
			$objWorksheet->getStyle($kolom.$rowtotal)->applyFromArray($styleTengahC);
		}

		$rowttd=$rowtotal+2;

		// print_r($rowttd);exit;
		$objWorksheet->setCellValue("AD".$rowttd,"KEPALA BADAN KEPEGAWAIAN DAN");
		$objWorksheet->getStyle("AD".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("AD".$rowttd)->applyFromArray($styleTengah);
		$rowttd=$rowtotal+3;
		$objWorksheet->setCellValue("AD".$rowttd,"PENGEMBANGAN SUMBER DAYA MANUSIA");
		$objWorksheet->getStyle("AD".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("AD".$rowttd)->applyFromArray($styleTengah);
		$rowttd=$rowtotal+4;
		$objWorksheet->setCellValue("AD".$rowttd,"KABUPATEN MOJOKERTO");
		$objWorksheet->getStyle("AD".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("AD".$rowttd)->applyFromArray($styleTengah);


		$rowttd=$rowtotal+9;
		$objWorksheet->setCellValue("AC".$rowttd,"NIP :");
		$objWorksheet->getStyle("AC".$rowttd)->getFont()->setBold( true );
		$objWorksheet->getStyle("AC".$rowttd)->applyFromArray($styleTengah);


		// exit;

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
		$objWriter->save('Templates/report/laporan_bkpp_rekap_fungsional_staf.xls');

		$down= 'Templates/report/laporan_bkpp_rekap_fungsional_staf.xls';
		header('Content-Description: File Transfer');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.basename($down));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($down));
		readfile($down);
		unlink($down);
	}


	

	
}
?>