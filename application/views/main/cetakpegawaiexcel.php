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

$objPHPexcel= PHPExcel_IOFactory::load('Templates/CetakPegawaiExcel.xls');
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


if($reqFilter == ""){
   $statement = " AND (STATUS_PEGAWAI = 1 OR STATUS_PEGAWAI = 2) ";
}

$this->load->model("base/Cetakan");
$pegawai = new Cetakan();
$pegawai->selectByParamsPegawai(array(), -1, -1, $statement, " ORDER BY C.ESELON_ID ASC, B.PANGKAT_ID DESC,  B.TMT_PANGKAT ASC");	
$urut=1;
$no=10;
// echo $pegawai->query; exit; 
while($pegawai->nextRow()){	
	$objWorksheet->setCellValue("a".$no, $urut);
	$objWorksheet->setCellValue("b".$no, $pegawai->getField('NIP_LAMA'));
	$objWorksheet->setCellValue("c".$no, $pegawai->getField('NIP_BARU'));
	$objWorksheet->setCellValue("d".$no, $pegawai->getField('NAMA'));
	$objWorksheet->setCellValue("e".$no, $pegawai->getField('TEMPAT_LAHIR'));
	$objWorksheet->setCellValue("f".$no, $pegawai->getField('TANGGAL_LAHIR'));
	$objWorksheet->setCellValue("g".$no, $pegawai->getField('JENIS_KELAMIN'));
	$objWorksheet->setCellValue("h".$no, $pegawai->getField('STATUS_PEGAWAI'));
	$objWorksheet->setCellValue("i".$no, $pegawai->getField('GOL_RUANG'));
	$objWorksheet->setCellValue("j".$no, $pegawai->getField('TMT_PANGKAT'));
	$objWorksheet->setCellValue("k".$no, $pegawai->getField('ESELON'));
	$objWorksheet->setCellValue("l".$no, $pegawai->getField('JABATAN'));
	$objWorksheet->setCellValue("m".$no, $pegawai->getField('TMT_JABATAN'));
	$objWorksheet->setCellValue("n".$no, $pegawai->getField('AGAMA'));
	$objWorksheet->setCellValue("o".$no, $pegawai->getField('TELEPON'));
	$objWorksheet->setCellValue("p".$no, $pegawai->getField('ALAMAT'));
	$objWorksheet->setCellValue("q".$no, $pegawai->getField('TMT_PENSIUN'));
	$objWorksheet->setCellValue("r".$no, $pegawai->getField('PENDIDIKAN'));
	$objWorksheet->setCellValue("s".$no, $pegawai->getField('NMJURUSAN'));
	$objWorksheet->setCellValue("t".$no, $pegawai->getField('LULUS'));
	$objWorksheet->setCellValue("u".$no, $pegawai->getField('SATKER'));	
	$objWorksheet->setCellValue("v".$no, $pegawai->getField('SATKERINDUK'));	
	$no++;
	$urut++;
} 

$currencyFormat= '_(Rp* #,##0_);_(Rp* (#,##0);_(Rp* "-"_);_(@_)';
$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
$objWriter->save('Templates/DataPegawai.xls');

$down= 'Templates/DataPegawai.xls';
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
