<?php
require 'lib/PHPWord/PHPWord.php';
include_once("functions/date.func.php");
include_once("functions/string.func.php");
include_once("functions/default.func.php");
$this->load->model("base/Kgb");
$this->load->model("base/SatuanKerja");

$kgb = new Kgb();

$reqId = httpFilterGet("reqId");
$PHPWord = new PHPWord();
$arrayId = explode("-",$reqId);
//$reqId = '195912051001';
$document = $PHPWord->loadTemplate('Templates/KGB_BLANKO.docx');

$field_template = array('REQTANGGAL','REQSKGOL','REQNAMA',
						'REQTGL','REQNIP','REQPANGKAT',
						'REQJABATAN','REQSATKER','REQGAJILAMA',
						'REQPENETAP','REQTSKLAMA','REQSKLAMA',
						'REQTMTLAMA','REQTAHUNLAMA','REQBULANLAMA',
						'REQGAJIBARU','REQTAHUNBARU','REQBULANBARU',
						'REQGOLONGAN','REQTMTBARU','REQJUDULSATKER',
						'REQTEMPAT','REQKEPALASATKER','REQALAMATSATKER',
						'','','REQTELEPONSATKER',
						'REQNOMINALGAJIBARU', 'REQNOMOR'
						);//REQPEJABATTTD, REQPEJABATNIPTTD
$field = array('','','NAMA',
			   'TTL','NIP_BARU','PANGKAT',
			   'PANGKATJABATAN','SATKER_INDUK','GAJI_LAMA',
			   'PEJABAT_LAMA','TANGGAL_SK_LAMA','NO_SK_LAMA',
			   'TMT_LAMA','MASA_KERJA_LAMA','MASA_KERJA_LAMA',
			   'GAJI_BARU','MASA_KERJA','MASA_KERJA',
			   'GOL_RUANG','TMT_BARU', 'SATKER_INDUK',
			   'SATKER_INDUK', 'SATKER_INDUK', 'SATKER_ALAMAT',
			   '', '', 'SATKER_TELEPON',
			   'GAJI_BARU', 'NO_SK'
			   );//SATKER_PEJABAT_NAMA, SATKER_PEJABAT_NIP,

// if($arrayId[3] == "")
// 	$statement= " AND SATKER_ID_GENERATE IS NULL";
// else
// 	$statement= " AND SATKER_ID_GENERATE IS NOT NULL";
	
$kgb->selectByParams(array('a.PEGAWAI_ID'=>$arrayId[0], "PERIODE" => "'".$arrayId[1].$arrayId[2]."'"), -1, -1, $statement);
// $kgb->selectByParams(array('a.PEGAWAI_ID'=>$arrayId[0], "PERIODE" => "'".$arrayId[1].$arrayId[2]."'"), -1, -1, $statement." AND NO_SK_LAMA IS NOT NULL");
$kgb->firstRow();
// echo $kgb->query; exit;
//echo $kgb->errorMsg;
$tempSatkerIdParent= $kgb->getField("SATKER_ID_PARENT");

//echo $kgb->query;
for($i=0; $i<count($field_template); $i++)
{
	if($i == 0) {
		// echo $field_template[$i], getNameMonth(date("n"))." ".date("Y"); exit;
		$document->setValue($field_template[$i], getNameMonth(date("n"))." ".date("Y"));
	}
	elseif($i == 13){
		$arrayKGB = explode(' - ',$kgb->getField($field[$i]));
		$document->setValue($field_template[$i], $arrayKGB[0]);
	}
	elseif($i == 14 || $i == 17){
		$arrayKGB = explode(' - ',$kgb->getField($field[$i]));
		$document->setValue($field_template[$i], $arrayKGB[1]);
	}
	elseif($i == 10 || $i == 12 || $i == 19) 
		$document->setValue($field_template[$i], dateToPageCheck($kgb->getField($field[$i])));
	elseif($i == 8 || $i == 15){
		$document->setValue($field_template[$i], currencyToPage($kgb->getField($field[$i]),false));
	}
	elseif($i == 16){
		$arrayKGB = explode(' - ',$kgb->getField($field[$i]));
		$tmp = $arrayKGB[0];
		$document->setValue($field_template[$i], $tmp);
	}
	elseif($i == 27) 
	{
		$document->setValue($field_template[$i], terbilang($kgb->getField($field[$i])));
	}
	else
		$document->setValue($field_template[$i], $kgb->getField($field[$i]));
}

$set_pejabat= new SatuanKerja();
$set_pejabat->selectByParamsUrutanPegawai(array(),-1,-1, " AND SATKER_ID LIKE '".$tempSatkerIdParent."%' AND ROWNUM = 1" );
$set_pejabat->firstRow();
//echo $set_pejabat->query;
//echo $set_pejabat->errorMsg;
$tempNipAtasan= $set_pejabat->getField("NIP_BARU");
$tempNamaAtasan= $set_pejabat->getField("NAMA");
$tempGolRuangNamaAtasan= $set_pejabat->getField("NMGOLRUANG");
$tempGolRuangAtasan= $set_pejabat->getField("GOL_RUANG");
$tempJabatanAtasan= $set_pejabat->getField("JABATAN");

$document->setValue("REQPEJABATTTD", $tempNamaAtasan);
$document->setValue("REQPEJABATNIPTTD", $tempNipAtasan);


$document->save('Templates/KGB_BLANKO_Hasil_SK_'.$arrayId[0].'.docx');
$file = 'Templates/KGB_BLANKO_Hasil_SK_'.$arrayId[0].'.docx';
$down = 'Templates/KGB_BLANKO_Hasil_SK_'.$arrayId[0].'.docx';
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