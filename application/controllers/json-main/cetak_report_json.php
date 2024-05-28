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

	function golongan()
	{
		/* INCLUDE FILE */
		require 'lib/PHPExcel.php';
		include_once("functions/date.func.php");
		include_once("functions/string.func.php");
		include_once("functions/default.func.php");

		$reqId= $this->input->get('reqId');
		$reqFilter= $this->input->get('reqFilter');
		$reqBulan= date('m');
		$reqTahun= date('y');

		//set_time_limit(3);
		ini_set("memory_limit","500M");
		ini_set('max_execution_time', 520);

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



		$objWorksheet = $objPHPexcel->getActiveSheet();

		$field= array("NO", "NAMA", "TOTCPNS_11", "TOTCPNS_12", "TOTCPNS_13", "TOTCPNS_21", "TOTCPNS_22", "TOTCPNS_23", "TOTCPNS_31", "TOTCPNS_32", "TOTCPNS", "TOT_11", "TOT_12", "TOT_13", "TOT_14", "TOT_GOL1", "TOT_21", "TOT_22", "TOT_23", "TOT_24", "TOT_GOL2", "TOT_31", "TOT_32", "TOT_33", "TOT_34", "TOT_GOL3", "TOT_41", "TOT_42", "TOT_43", "TOT_44", "TOT_GOL4", "TOT");


		if($reqFilter == ""){

		}

		$statement = "  ";

		$this->load->model("base/Rekap");
		$set = new Rekap();
		$set->selectByParamsBkppRekapGolongan(array(), -1, -1, $statement, "");	
		// $urut=1;
		$nomor=1;
		$kolomawal=1;
		$row = 5;
		// echo $set->query; exit; 
		while($set->nextRow()){	

			$index_kolom= 0;

			for($i=0; $i<count($field); $i++)
			{
				$kolom= toAlpha($index_kolom);
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

			// $objWorksheet->getStyle("A".$no)->applyFromArray($styleT);
			// $objWorksheet->getStyle("A".$no.':'."AF".$no)->applyFromArray($style);

			$nomor++;
			$row++;
		} 

		// exit;

		// exit;

		$currencyFormat= '_(Rp* #,##0_);_(Rp* (#,##0);_(Rp* "-"_);_(@_)';
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

	

	
}
?>