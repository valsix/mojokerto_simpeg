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

$objPHPexcel= PHPExcel_IOFactory::load('Templates/BiodataSingkat.xlsx');
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

$objWorksheet = $objPHPexcel->getActiveSheet();

$this->load->model("base/Cetakan");

$Cetakan= new Cetakan();
$Cetakan->selectByParamsFIP1(array('A.PEGAWAI_ID'=>$reqId));
$Cetakan->firstRow(); 
// echo $Cetakan->query; exit;
$objWorksheet = $objPHPexcel->getActiveSheet();
$objWorksheet->setCellValue("H13",$Cetakan->getField('NIP_LAMA').'/'.$Cetakan->getField('NIP_BARU'));
$objWorksheet->setCellValue("H14",$Cetakan->getField('NAMA'));
$objWorksheet->setCellValue("H15",$Cetakan->getField('TEMPAT_LAHIR'));
$objWorksheet->setCellValue("H16",$Cetakan->getField('TANGGAL_LAHIR'));
$objWorksheet->setCellValue("H17",$Cetakan->getField('AGAMA'));
$objWorksheet->setCellValue("H18",$Cetakan->getField('GOL_RUANG_PNS'));
$objWorksheet->setCellValue("H19",$Cetakan->getField('TMT_PNS'));
$objWorksheet->setCellValue("H21",$Cetakan->getField('PENDIDIKAN'));
$objWorksheet->setCellValue("H22",$Cetakan->getField('JURUSAN'));
$objWorksheet->setCellValue("H23",$Cetakan->getField('NAMA_SEKOLAH'));
$objWorksheet->setCellValue("H25",$Cetakan->getField('JABATAN'));
$objWorksheet->setCellValue("H26",$Cetakan->getField('ALAMATMODEL'));
$objWorksheet->setCellValue("H27",$Cetakan->getField('KARTU_PEGAWAI'));

$currencyFormat= '_(Rp* #,##0_);_(Rp* (#,##0);_(Rp* "-"_);_(@_)';
$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
$objWriter->save('Templates/BiodataSingkat-'.$reqId.'.xls');

$down= 'Templates/BiodataSingkat-'.$reqId.'.xls';
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
