<?php
require 'lib/PHPWord/PHPWord.php';
include_once("functions/date.func.php");
include_once("functions/string.func.php");
include_once("functions/default.func.php");
$this->load->model("base/Cetakan");

$PHPWord = new PHPWord();

$reqId= $this->input->get('reqId');

//$reqId = '195912051001';
$set= new Cetakan();
$allrecord = $set->getCountByParamsSuamiIstriAnak(array(), " AND PEGAWAI_ID ='".$reqId."'");
$i = $allrecord;
// echo $allrecord.'--';
switch ($i){
	case 1: $document = $PHPWord->loadTemplate('Templates/model1.docx'); 	break;
	case 2: $document = $PHPWord->loadTemplate('Templates/model2.docx'); 	break;
	case 3: $document = $PHPWord->loadTemplate('Templates/model3.docx'); 	break;
	case 4: $document = $PHPWord->loadTemplate('Templates/model4.docx'); 	break;
	case 5: $document = $PHPWord->loadTemplate('Templates/model5.docx'); 	break;
	case 6: $document = $PHPWord->loadTemplate('Templates/model6.docx'); 	break;
	case 7: $document = $PHPWord->loadTemplate('Templates/model7.docx'); 	break;
	case 8: $document = $PHPWord->loadTemplate('Templates/model8.docx'); 	break;
	case 9: $document = $PHPWord->loadTemplate('Templates/model9.docx'); 	break;
	case 10: $document = $PHPWord->loadTemplate('Templates/model10.docx'); 	break;
	default: $document = $PHPWord->loadTemplate('Templates/model0.docx');
}

$set->selectByParamsSuamiIstriAnak(array('PEGAWAI_ID'=>$reqId), -1, -1);
// echo $set->query;
$i=1;
while($set->nextRow()){
	$data1 = 'REQNM'.$i;	$data2 = 'REQUMR'.$i;	$data3 = 'REQKWN'.$i;	$data4 = 'REQKERJA'.$i;	$data5 = 'REQKET'.$i;	
	$document->setValue($data1, $set->getField('NAMA'));	
	$document->setValue($data2, dateToPageCheck($set->getField('TANGGAL_LAHIR')));	
	$document->setValue($data3, dateToPageCheck($set->getField('TANGGAL_KAWIN')));
	$document->setValue($data4, $set->getField('PEKERJAAN'));	
	$document->setValue($data5, $set->getField('KELUARGA_LAP'));	
	$i++;
}

$set->selectByParamsFIP1(array('A.PEGAWAI_ID'=>$reqId),-1,-1);
$set->firstRow();
//echo $pegawai->query;
$tempNama = $set->getField('NAMA');
$tempNip = $set->getField('NIP_LAMA');
$tempTmpt = $set->getField('TEMPAT_LAHIR');
$tempTgl = $set->getField('TANGGAL_LAHIR');
$tempJenis = $set->getField('JENIS_KELAMIN');
$tempAgama = $set->getField('AGAMA');
//if($pegawai->getField('STATUS_PEGAWAI') == 1)
$tempStatus = 'Calon Pegawai / PNS / Pegawai bulanan * )';
$tempJabatan = $set->getField('JABATAN');
$tempSatker = $set->getField('NAMA_SATKER');
$tempPangGol = $set->getField('GOL_RUANG_PANGKAT');
$tempTahun = $set->getField('MASA_KERJA_TAHUN');
$tempBulan = $set->getField('MASA_KERJA_BULAN');
$tempAlamat = $set->getField('ALAMATMODEL');

$document->setValue('REQNAMA', $tempNama);
$document->setValue('REQNIP', $tempNip);
$document->setValue('TTL', $tempTmpt.' / '.$tempTgl);
$document->setValue('JNS', $tempJenis);
$document->setValue('AGM', $tempAgama);
$document->setValue('REQSTATUS', $tempStatus);
$document->setValue('REQJABATAN', $tempJabatan);
$document->setValue('REQPANGKAT', $tempPangGol);
$document->setValue('REQSATKER', $tempSatker);
$document->setValue('REQALMT', $tempAlamat);
$document->setValue('REQCETAK', date('d-m-Y'));//'SURABAYA'.
$document->setValue('REQTAHUN', $tempTahun);
$document->setValue('REQBULAN', $tempBulan);
$document->setValue('REQANAK', $allrecord_anak);
$document->setValue('REQNAMA1', $tempNama);
$document->setValue('REQNIP1', $tempNip);

$document->save('Templates/model-'.$reqId.'.docx');
$file = 'Templates/model-'.$reqId.'.docx';

$down = 'Templates/model-'.$reqId.'.docx';
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