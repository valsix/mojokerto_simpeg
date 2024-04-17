<?
/* INCLUDE FILE */
require 'lib/PHPExcel.php';
include_once("functions/date.func.php");
include_once("functions/string.func.php");
include_once("functions/default.func.php");

$reqId= $this->input->get('reqId');

//set_time_limit(3);
ini_set("memory_limit","500M");
ini_set('max_execution_time', 520);

$objPHPexcel= PHPExcel_IOFactory::load('Templates/fip02.xlsx');
$styleProses= array(
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => '#0000FF')
	)
);

$styleSelesai= array(
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => '#0FF000')
	)
);

$styleTidak= array(
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => '#F9F000')
	)
);

$this->load->model("base/RiwayatPangkat");
$objWorksheet = $objPHPexcel->getActiveSheet();

$RiwayatPangkat= new RiwayatPangkat();
$allrecord = $RiwayatPangkat->getCountByParams(array('PEGAWAI_ID'=>$reqId));
$objWorksheet->insertNewRowBefore(11, $allrecord-1);
$urut=1;
$no=11;
$RiwayatPangkat->selectByParams(array('A.PEGAWAI_ID'=>$reqId));
while($RiwayatPangkat->nextRow()){
	$objWorksheet->setCellValue("a".$no,$urut);
	$objWorksheet->setCellValue("b".$no,$urut);
	$objWorksheet->setCellValue("g".$no,$urut);
	$objWorksheet->setCellValue("i".$no,$urut);
	$objWorksheet->setCellValue("o".$no,$urut);
	$objWorksheet->setCellValue("q".$no,$urut);
	$no++;
	$urut++;
} 

$currencyFormat= '_(Rp* #,##0_);_(Rp* (#,##0);_(Rp* "-"_);_(@_)';
$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
$objWriter->save('Templates/FIP02-'.$reqId.'.xls');

$down= 'Templates/FIP02-'.$reqId.'.xls';
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
