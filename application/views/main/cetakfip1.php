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

$objPHPexcel= PHPExcel_IOFactory::load('Templates/fip01.xlsx');
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

$this->load->model("base/Cetakan");

$Cetakan= new Cetakan();
$Cetakan->selectByParamsFIP1(array('A.PEGAWAI_ID'=>$reqId));
$Cetakan->firstRow(); 
$objWorksheet = $objPHPexcel->getActiveSheet();
$objWorksheet->setCellValue("H11",$Cetakan->getField('KECAMATAN_SATKER'));
$objWorksheet->setCellValue("H12",$Cetakan->getField('KELURAHAN_SATKER'));
$objWorksheet->setCellValue("H13",$Cetakan->getField('ALAMAT_SATKER'));
$objWorksheet->setCellValue("H14",$Cetakan->getField('TELEPON_SATKER'));
$objWorksheet->setCellValue("H15",$Cetakan->getField('KODEPOS_SATKER'));
$objWorksheet->setCellValue("H16",$Cetakan->getField('NAMA_SATKER'));
$objWorksheet->setCellValue("H21",$Cetakan->getField('SATKER_INDUK'));
$objWorksheet->setCellValue("H22",$Cetakan->getField('NIP_LAMA'));
$objWorksheet->setCellValue("H23",$Cetakan->getField('NIP_BARU'));
$objWorksheet->setCellValue("H24",$Cetakan->getField('NAMA'));
$objWorksheet->setCellValue("H25",$Cetakan->getField('GELAR_DEPAN'));
$objWorksheet->setCellValue("H26",$Cetakan->getField('GELAR_BELAKANG'));
$objWorksheet->setCellValue("H27",$Cetakan->getField('TEMPAT_LAHIR'));
$objWorksheet->setCellValue("H28",$Cetakan->getField('TANGGAL_LAHIR'));
$objWorksheet->setCellValue("H29",$Cetakan->getField('JENIS_KELAMIN'));
$objWorksheet->setCellValue("H30",$Cetakan->getField('AGAMA'));
$objWorksheet->setCellValue("H31",$Cetakan->getField('STATUS_PEGAWAI'));
$objWorksheet->setCellValue("H32",$Cetakan->getField('JENIS_PEGAWAI'));
$objWorksheet->setCellValue("H33",$Cetakan->getField('KEDUDUKAN'));
$objWorksheet->setCellValue("H34",$Cetakan->getField('STATUS_KAWIN'));
$objWorksheet->setCellValue("H35",$Cetakan->getField('SUKU_BANGSA'));
$objWorksheet->setCellValue("H36",$Cetakan->getField('GOLONGAN_DARAH'));
$objWorksheet->setCellValue("H37",$Cetakan->getField('ALAMAT'));
$objWorksheet->setCellValue("H38",$Cetakan->getField('RTRW'));
$objWorksheet->setCellValue("H39",$Cetakan->getField('KELURAHAN'));
$objWorksheet->setCellValue("H40",$Cetakan->getField('KECAMATAN'));
$objWorksheet->setCellValue("H41",$Cetakan->getField('KABUPATEN'));
$objWorksheet->setCellValue("H42",$Cetakan->getField('PROPINSI'));
$objWorksheet->setCellValue("H43",$Cetakan->getField('KODEPOS'));
$objWorksheet->setCellValue("H44",$Cetakan->getField('KARTU_PEGAWAI'));
$objWorksheet->setCellValue("H45",$Cetakan->getField('ASKES'));
$objWorksheet->setCellValue("H46",$Cetakan->getField('TASPEN'));
$objWorksheet->setCellValue("H47",$Cetakan->getField('SUAMIISTRI'));
$objWorksheet->setCellValue("H48",$Cetakan->getField('NPWP'));
$objWorksheet->setCellValue("H49",$Cetakan->getField('NIK'));
$objWorksheet->setCellValue("H54",$Cetakan->getField('NAMA_INSTANSI'));
$objWorksheet->setCellValue("H55",$Cetakan->getField('JABATAN_INSTANSI'));
$objWorksheet->setCellValue("H56",$Cetakan->getField('MASA_KERJA_INSTANSI'));
$objWorksheet->setCellValue("H57",$Cetakan->getField('TANGGAL_KERJA'));
$objWorksheet->setCellValue("H63",$Cetakan->getField('NOTA_CPNS'));
$objWorksheet->setCellValue("H64",$Cetakan->getField('TANGGAL_NOTA_CPNS'));
$objWorksheet->setCellValue("H65",$Cetakan->getField('PEJABAT_PENETAP_CPNS'));
$objWorksheet->setCellValue("H66",$Cetakan->getField('NO_SK_CPNS'));
$objWorksheet->setCellValue("H67",$Cetakan->getField('TANGGAL_SK_CPNS'));
$objWorksheet->setCellValue("H68",$Cetakan->getField('TMT_CPNS'));
$objWorksheet->setCellValue("H69",$Cetakan->getField('GOL_RUANG_CPNS'));
$objWorksheet->setCellValue("H70",$Cetakan->getField('TANGGAL_TUGAS_CPNS'));
$objWorksheet->setCellValue("H71",$Cetakan->getField('NO_STTPP'));
$objWorksheet->setCellValue("H72",$Cetakan->getField('TANGGAL_STTPP_CPNS'));
$objWorksheet->setCellValue("H77",$Cetakan->getField('PEJABAT_PENETAP_PNS'));
$objWorksheet->setCellValue("H78",$Cetakan->getField('NO_SK_PNS'));
$objWorksheet->setCellValue("H79",$Cetakan->getField('TANGGAL_SK_PNS'));
$objWorksheet->setCellValue("H80",$Cetakan->getField('TMT_PNS'));
$objWorksheet->setCellValue("H81",$Cetakan->getField('GOL_RUANG_PNS'));
$objWorksheet->setCellValue("H82",$Cetakan->getField('TANGGAL_SUMPAH'));
$objWorksheet->setCellValue("H87",$Cetakan->getField('STLUD'));
$objWorksheet->setCellValue("H88",$Cetakan->getField('NO_STLUD'));
$objWorksheet->setCellValue("H89",$Cetakan->getField('TANGGAL_STLUD'));
$objWorksheet->setCellValue("H90",$Cetakan->getField('NO_NOTA'));
$objWorksheet->setCellValue("H91",$Cetakan->getField('TANGGAL_NOTA'));
$objWorksheet->setCellValue("H92",$Cetakan->getField('KREDIT'));
$objWorksheet->setCellValue("H93",$Cetakan->getField('JABATANPENETAP'));
$objWorksheet->setCellValue("H94",$Cetakan->getField('SK_PANGKAT'));
$objWorksheet->setCellValue("H95",$Cetakan->getField('TANGGAL_SK_PANGKAT'));
$objWorksheet->setCellValue("H96",$Cetakan->getField('TMT_PANGKAT'));
$objWorksheet->setCellValue("H97",$Cetakan->getField('GOL_RUANG_PANGKAT'));
$objWorksheet->setCellValue("H98",$Cetakan->getField('JENIS_KP'));
$objWorksheet->setCellValue("H99",$Cetakan->getField('MASA_KERJA_PANGKAT'));
$objWorksheet->setCellValue("H105",$Cetakan->getField('NO_SK_KGB'));
$objWorksheet->setCellValue("H106",$Cetakan->getField('TANGGAL_SK_KGB'));
$objWorksheet->setCellValue("H107",$Cetakan->getField('TMT_SK_KGB'));
$objWorksheet->setCellValue("H108",$Cetakan->getField('GOL_RUANG_KGB'));
$objWorksheet->setCellValue("H109",$Cetakan->getField('GAJI_POKOK'));
$objWorksheet->setCellValue("H110",$Cetakan->getField('WILAYAH'));
$objWorksheet->setCellValue("H111",$Cetakan->getField('KTUA'));
$objWorksheet->setCellValue("H116",$Cetakan->getField('PENDIDIKAN'));
$objWorksheet->setCellValue("H117",$Cetakan->getField('JURUSAN'));
$objWorksheet->setCellValue("H118",$Cetakan->getField('NAMA_SEKOLAH'));
$objWorksheet->setCellValue("H119",$Cetakan->getField('TEMPAT'));
$objWorksheet->setCellValue("H120",$Cetakan->getField('NAMA_DIK_STRUK'));
$objWorksheet->setCellValue("H121",$Cetakan->getField('NAMA_DIK_FUNGS'));
$objWorksheet->setCellValue("H122",$Cetakan->getField('NAMA_DIK_TEKNIS'));
$objWorksheet->setCellValue("H123",$Cetakan->getField('PENATARAN'));
$objWorksheet->setCellValue("H124",$Cetakan->getField('SEMINAR'));
$objWorksheet->setCellValue("H129",$Cetakan->getField('PENETAP_JABATAN'));
$objWorksheet->setCellValue("H130",$Cetakan->getField('NO_SK_JABATAN'));
$objWorksheet->setCellValue("H131",$Cetakan->getField('TANGGAL_SK_JABATAN'));
$objWorksheet->setCellValue("H132",$Cetakan->getField('JABATAN'));
$objWorksheet->setCellValue("H133",$Cetakan->getField('ESELON'));
$objWorksheet->setCellValue("H135",$Cetakan->getField('TMT_ESELON'));
$objWorksheet->setCellValue("H137",$Cetakan->getField('NO_PELANTIKAN'));
$objWorksheet->setCellValue("H138",$Cetakan->getField('TANGGAL_PELANTIKAN'));

$currencyFormat= '_(Rp* #,##0_);_(Rp* (#,##0);_(Rp* "-"_);_(@_)';
$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
$objWriter->save('Templates/FIP01-'.$reqId.'.xls');

$down= 'Templates/FIP01-'.$reqId.'.xls';
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
