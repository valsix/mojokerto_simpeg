<?php
require_once 'lib/PHPWord/PHPWord.php';
include_once("functions/date.func.php");
include_once("functions/default.func.php");
include_once("functions/string.func.php");
$this->load->model("base-app/KenaikanGajiBerkala");


$kgb = new KenaikanGajiBerkala();

$reqId = $this->input->get("reqId");
$reqKeterangan = $this->input->get("reqKeterangan");
$reqKgb= $this->input->get("reqKgb");


$PHPWord = new PHPWord();
$arrayId = explode("-",$reqId);
if($reqKgb=="guru")
	$document = $PHPWord->loadTemplate('Templates/KGB_BLANKOPendidikan.docx');
else
	$document = $PHPWord->loadTemplate('Templates/KGB_BLANKO.docx');

// print_r($document);exit;

$field_template = array('REQTANGGAL','REQSKGOL','REQNAMA','REQTGL','REQNIP','REQPANGKAT','REQJABATAN','REQTUGAS','REQSATKER','REQGAJILAMA','REQPENETAP','REQTSKLAMA','REQSKLAMA','REQTMTLAMA','REQTAHUNLAMA','REQBULANLAMA','REQGAJIBARU','REQTAHUNBARU','REQBULANBARU','REQGOLONGAN','REQTMTBARU');


for($i=0; $i<count($field_template); $i++)
{	
	$document->setValue($field_template[$i], '');
}

$document->save('Templates/KGB_BLANKO_Hasil.docx');
$file = 'Templates/KGB_BLANKO_Hasil.docx';

$down = 'Templates/KGB_BLANKO_Hasil.docx';
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