<?php
require 'lib/PHPWord/PHPWord.php';
include_once("functions/date.func.php");
include_once("functions/string.func.php");
include_once("functions/default.func.php");
$this->load->model("base/Cetakan");

$PHPWord = new PHPWord();

$reqId= $this->input->get('reqId');

$document = $PHPWord->loadTemplate('Templates/SPMT.docx');

$pegawai = new Cetakan();
$pegawai->selectByParamsFIP1(array('A.PEGAWAI_ID'=>$reqId),-1,-1);
$pegawai->firstRow();

$document->setValue('REQNAMA', $pegawai->getField('NAMA'));
$document->setValue('REQNIP', $pegawai->getField('NIP_BARU'));
$document->setValue('REQPANGKAT', $pegawai->getField('JABATAN'));
$document->setValue('REQSATKER', $pegawai->getField('NAMA_SATKER'));

$document->setValue('REQPEJABAT', $pegawai->getField('PEJABAT_PENETAP_CPNS'));
$document->setValue('REQNOSK', $pegawai->getField('NO_SK_CPNS'));
$document->setValue('REQTGLSK', getFormattedDateJson($pegawai->getField('TANGGAL_SK_CPNS')));
$document->setValue('REQTMTCPNS', getFormattedDateJson($pegawai->getField('TMT_CPNS')));
$document->setValue('REQTGLTUGAS', getFormattedDateJson($pegawai->getField('TANGGAL_TUGAS_CPNS')));
$document->setValue('REQCETAK', date("d - m - Y"));
$document->setValue('REQSATKERCETAK', $pegawai->getField('NAMA_SATKER'));
$document->setValue('REQNAMATTD', '');
$document->setValue('REQKEPALANIP', '');

$document->save('Templates/SPMT-'.$reqId.'.docx');
$file = 'Templates/SPMT-'.$reqId.'.docx';

$down = 'Templates/SPMT-'.$reqId.'.docx';
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($down));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($down));
ob_clean();
flush();
readfile($down);
unlink($down);
unset($oPrinter);
exit;
		
exit();
?>