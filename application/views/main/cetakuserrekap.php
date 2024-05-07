<?
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

$objPHPexcel= PHPExcel_IOFactory::load('Templates/cetakuserrekap.xls');
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


if($reqFilter == ""){
   
}

$statement = " AND B.USER_GROUP_ID = '6' ";

$this->load->model("base/Cetakan");
$set = new Cetakan();
$set->selectByParamsMonitorRekap(array(), -1, -1, $statement, " ORDER BY JUMLAH_AKSI DESC");	
$urut=1;
$no=6;
$kolomawal=1;
// echo $set->query; exit; 
while($set->nextRow()){	

	// $kolom= toAlpha($kolomawal);
	// print_r($kolom.$no);
	$objWorksheet->setCellValue("b".$no, $urut);
	$objWorksheet->setCellValue("c".$no, $set->getField('NAMA'));
	$objWorksheet->setCellValue("d".$no, $set->getField('USER_LOGIN'));
	$objWorksheet->setCellValue("e".$no, $set->getField('SATKER'));
	$objWorksheet->setCellValue("f".$no, $set->getField('USER_GROUP'));
	$objWorksheet->setCellValue("g".$no, $set->getField('JUMLAH_AKSI'));
	$objWorksheet->getStyle("B".$no)->applyFromArray($styleT);
	$objWorksheet->getStyle("C".$no.':'."G".$no)->applyFromArray($style);
	
	$no++;
	$urut++;
} 

// exit;

$currencyFormat= '_(Rp* #,##0_);_(Rp* (#,##0);_(Rp* "-"_);_(@_)';
$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
$objWriter->save('Templates/laporan_user_rekap_excel.xls');

$down= 'Templates/laporan_user_rekap_excel.xls';
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
?>
