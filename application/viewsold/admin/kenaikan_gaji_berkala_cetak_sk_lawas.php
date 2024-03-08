<?php
require_once 'lib/PHPWord/PHPWord.php';
include_once("functions/date.func.php");
include_once("functions/default.func.php");
include_once("functions/string.func.php");

$this->load->model("base-data/PejabatPenetap");
$this->load->model("base-app/GajiRiwayat");
$this->load->model("base-app/KenaikanGajiBerkala");
$this->load->model("base-app/Pegawai");


$kgb = new KenaikanGajiBerkala();


$reqId= $this->input->get("reqId");
$reqPeriode= $this->input->get("reqPeriode");
$reqMode= $this->input->get("reqMode");
$reqKgb= $this->input->get("reqKgb");

$PHPWord = new PHPWord();
	// cek pegawai dalam periode ada atau tidak di gaji riwayat, kl tidak buat data.
	$statement_gaji= " AND PEGAWAI_ID = ".$reqId." AND TO_CHAR(TMT_SK, 'DDMMYYYY') = '01".$reqPeriode."'";
	$set_gaji_riwayat= new GajiRiwayat();
	$set_gaji_riwayat->selectByParams(array(), -1,-1, $statement_gaji);
	//echo $set_gaji_riwayat->query;exit;
	$set_gaji_riwayat->firstRow();
	$tempGajiRiwayatId= $set_gaji_riwayat->getField("GAJI_RIWAYAT_ID");
	unset($set_gaji_riwayat);
	
	$kenaikan_gaji_berkala= new KenaikanGajiBerkala();
	$kenaikan_gaji_berkala->selectByParams(array("PERIODE" => $reqPeriode),-1,-1," AND A.PEGAWAI_ID = ".$reqId." ".$statement);
	$kenaikan_gaji_berkala->firstRow();
	$tempStatusKgb= $kenaikan_gaji_berkala->getField("STATUS_KGB");
	$tempNoSK= $kenaikan_gaji_berkala->getField('NO_SK');
	$tempNomorGenerate= $kenaikan_gaji_berkala->getField("NOMOR_GENERATE");
	$tempKepalaPejabatNama= $kenaikan_gaji_berkala->getField("PEJABAT_PENETAP");


	if($tempGajiRiwayatId == "" && $tempStatusKgb == 3)
	{
		$set_pimpinan= new Pegawai();
		$statement_pimpinan=" AND SUBSTR(A.SATKER_ID, 0, 2) = '24'";
		$set_pimpinan->selectByParamsMonitoring2(array(),-1,-1,$statement_pimpinan, " ORDER BY C.ESELON_ID ASC, B.PANGKAT_ID DESC,  B.TMT_PANGKAT ASC ");
		$set_pimpinan->firstRow();
		$tempKepala= $set_pimpinan->getField("JABATAN");
		unset($set_pimpinan);
		
		$tempKepala= $tempKepalaPejabatNama;
		
		$tempPjPenetapNama= $tempKepala;
		$tempGolRuang= $kenaikan_gaji_berkala->getField('PANGKAT_ID');
		$tempTglSK = dateToPageCheck($kenaikan_gaji_berkala->getField('TANGGAL_SK'));
		$tempGajiPokok= $kenaikan_gaji_berkala->getField('GAJI_BARU');
		$arrMasaKerja= explode(' - ',$kenaikan_gaji_berkala->getField('MASA_KERJA'));
		$tempTh= $arrMasaKerja[0];
		$tempBl= $arrMasaKerja[1];
		//$tempPjPenetapNama= $kenaikan_gaji_berkala->getField('PEJABAT_PENETAP');
		$tempTMTSK= dateToPageCheck($kenaikan_gaji_berkala->getField('TMT_BARU'));
		$tempJenis= 2;
		$tempPegawaiId= $kenaikan_gaji_berkala->getField('PEGAWAI_ID');
		
		$gaji= new GajiRiwayat();
		$gaji->setField('NO_SK', $tempNoSK);
		$gaji->setField('PANGKAT_ID', $tempGolRuang);
		$gaji->setField('TANGGAL_SK', dateToDBCheck($tempTglSK));
		$gaji->setField('GAJI_POKOK', ValToNullDB($tempGajiPokok));
		$gaji->setField('MASA_KERJA_TAHUN', $tempTh);
		$gaji->setField('MASA_KERJA_BULAN', $tempBl);
		
		if($tempKepala == "")
			$statement= " AND UPPER(JABATAN) IS NULL";
		else
			$statement= " AND UPPER(JABATAN)='".strtoupper($tempKepala)."'";
		
		$statement= " AND UPPER(JABATAN)='BUPATI LAMONGAN'";
		$set=new PejabatPenetap();
		$set->selectByParams(array(),-1,-1,$statement);
		$set->firstRow();
		//echo $set->query;
		$tempPejabatPenetapId= $set->getField("PEJABAT_PENETAP_ID");
		$tempPejabatPenetapNama= $set->getField("JABATAN");
		
		if($tempPejabatPenetapId == "")
		{
			$set=new PejabatPenetap();
			$set->setField('JABATAN', strtoupper($reqPjPenetapNama));	
			$set->setField("LAST_CREATE_USER", $this->idUser);
			$set->setField("LAST_CREATE_DATE", OCI_SYSDATE);	
			$set->setField("LAST_CREATE_SATKER", $this->userSatkerId);
			$set->insert();
			$tempPejabatPenetapNama=$reqPjPenetapNama;
			$tempPejabatPenetapId=$set->id;
			unset($set);
		}
		
		$gaji->setField('JENIS_KENAIKAN', $tempJenis);
		$gaji->setField('PEJABAT_PENETAP_ID', $tempPejabatPenetapId);
		$gaji->setField('PEJABAT_PENETAP', $tempPejabatPenetapNama);
		$gaji->setField('PEGAWAI_ID', $reqId);
		$gaji->setField('TMT_SK', dateToDBCheck($tempTMTSK));
		$gaji->setField("LAST_CREATE_USER", $this->idUser);
		$gaji->setField("LAST_CREATE_DATE", OCI_SYSDATE);	
		$gaji->setField("LAST_CREATE_SATKER", $this->userSatkerId);
		
		$gaji->setField('SUDAH_DIBAYAR', ValToNullDB($req));
		$gaji->setField('POTONGAN_PANGKAT', ValToNullDB($req));
		$gaji->setField('BULAN_DIBAYAR', dateToDBCheck($tempTglSK));
		
		if($gaji->insert())	
		{
			$reqId= $gaji->id;
		}
	}
	else
	{
		if($tempNomorGenerate == "" || $tempNomorGenerate == "0")
		{

			$set_generate= new KenaikanGajiBerkala();
			$tempNomorGenerate=$set_generate->getCountByParamsGenerateNomor($reqPeriode);
			//echo $set_generate->query;exit;
			unset($set_generate);
			$arrNoSk= explode("/",$tempNoSK);
			$tempNoSK= $arrNoSk[0]."/".$tempNomorGenerate."/".romanic_number(substr($reqPeriode, 0,2))."/".$arrNoSk[2]."/".$arrNoSk[3];
			$tempPeriode= $reqPeriode;
			$set_generate= new KenaikanGajiBerkala();
			$set_generate->setField("NO_SK", $tempNoSK);
			$set_generate->setField("NOMOR_GENERATE", $tempNomorGenerate);
			$set_generate->setField("PEGAWAI_ID", $reqId);
			$set_generate->setField("PERIODE", $tempPeriode);
			$set_generate->updateNomorGenerate();
			//echo $set_generate->query;exit;
			unset($set_generate);
		}

		
	
	}

	if($tempGajiRiwayatId == ""){}
	else
	$reqId= $tempGajiRiwayatId;
	// print_r($reqId);exit;
	//exit;


$statement= "";
$field_template = array('REQTANGGAL','REQSKGOL','REQNAMA','REQTGL','REQNIP','REQPANGKAT','REQJABATAN','REQTUGAS','REQSATKER','REQGAJILAMA','REQPENETAP','REQTSKLAMA','REQSKLAMA','REQTMTLAMA','REQTAHUNLAMA','REQBULANLAMA','REQGAJIBARU','REQTAHUNBARU','REQBULANBARU','REQGOLONGAN','REQTMTBARU','REQGAJITERBILANG');
$field = array('','NO_SK','NAMA','TTL','NIP_BARU','PANGKAT','JABATAN','TUGAS_TAMBAHAN_NAMA','SATKER','GAJI_LAMA','PEJABAT_PENETAP_JABATAN','TANGGAL_SK_LAMA','NO_SK_LAMA','TMT_SK_LAMA','MASA_KERJA_LAMA','MASA_KERJA_LAMA','GAJI_BARU','MASA_KERJA','MASA_KERJA','GOL_RUANG','TMT_BARU', 'GAJI_BARU');
if($tempStatusKgb == 3)
{
	$kgb->selectByParamsGajiRiwayat(array('A.GAJI_RIWAYAT_ID'=>$reqId), -1, -1, $reqId, $statement);
}
else
{
	$statement= " AND A.PEGAWAI_ID = '".$reqId."' AND A.PERIODE = '".$reqPeriode."' ";
	$kgb->selectByParamsCetakSK(array(), -1, -1, $statement);
}
// echo $kgb->query;exit;

$kgb->firstRow();
$tempSatkerSmaSmp= $kgb->getField("SATKER_SMA_SMP");
$tempSatkerTembusan= ucAddress($kgb->getField("SATKER_TEMBUSAN"));
$tempSatkerIndukNama= ucAddress($kgb->getField("SATKER"));
$tempSatkerId= $kgb->getField("SATKER_ID");
$tempSatkerInduk= substr($tempSatkerId,0,2);
$tempKabupatenLamongan= "Kabupaten Lamongan";


if($tempSatkerInduk == "14")// kondisi dinas sosial d tambahi kabupaten lamongan
	$tempSatkerInstansi=$tempSatkerIndukNama." ".$tempKabupatenLamongan;
elseif($tempSatkerInduk == "02")// kondisi sek DPRD d tambahi kabupaten lamongan
	$tempSatkerInstansi=$tempSatkerIndukNama." ".$tempKabupatenLamongan;
else
	$tempSatkerInstansi=$tempSatkerIndukNama." ".$tempKabupatenLamongan;

if($tempSatkerInduk == "03" && $this->userlevel == "5" || $reqKgb=="guru")
	$document = $PHPWord->loadTemplate('Templates/KGB_BLANKOPendidikan.docx');
else
	$document = $PHPWord->loadTemplate('Templates/KGB_BLANKO.docx');



for($i=0; $i<count($field_template); $i++)
{
	if($field_template[$i] == "REQTANGGAL") 
		$document->setValue($field_template[$i], getFormattedDateJson(date("Y-n-d")));
	elseif($field_template[$i] == "REQTSKLAMA" || $field_template[$i] == "REQTMTLAMA" || $field_template[$i] == "REQTMTBARU") 
		$document->setValue($field_template[$i], dateToPageCheck($kgb->getField($field[$i])));
	elseif($field_template[$i] == "REQPANGKAT") 
		$document->setValue($field_template[$i], str_replace(" /", "", $kgb->getField($field[$i])));
	elseif($field_template[$i] == "REQxPENETAP")
	{
		$document->setValue($field_template[$i], "Bupati Lamongan");
	}
	elseif($field_template[$i] == "REQPENETAP")
	{
		$document->setValue($field_template[$i], ucAddress($kgb->getField($field[$i])));
	}
	elseif($field_template[$i] == "REQJABATAN")
	{
		$tempValue= $kgb->getField($field[$i]);
		$document->setValue($field_template[$i], $tempValue);

	}
	elseif($field_template[$i] == "REQTUGAS")
	{
		$tempValue= $kgb->getField($field[$i]);
		$document->setValue($field_template[$i], $tempValue);

	}
	elseif($field_template[$i] == "REQSATKER") 
	{

		if($tempSatkerInduk == "03" || $tempSatkerInduk == "06")
		{
			$string= ucAddress($kgb->getField("SATKER_NAMA"))." ".ucwords(strtolower($kgb->getField("SATKER")))." ".$tempKabupatenLamongan;
			
		}
		elseif($tempSatkerInduk == "01")
		{
			$string= ucwords(strtolower($kgb->getField("SATKER")))." ".$tempKabupatenLamongan;
		}
		else
		{
			$string= ucAddress($kgb->getField("SATKER"))." ".$tempKabupatenLamongan;
		}
		$string= ucAddress($kgb->getField("SATKER"))." ".$tempKabupatenLamongan;
		$document->setValue($field_template[$i], $string);
		
	}
	elseif($i == 13){
		$arrayKGB = explode(' - ',$kgb->getField($field[$i]));
		$document->setValue($field_template[$i], $arrayKGB[0]);
	}
	elseif($i == 14 || $i == 17){
		$arrayKGB = explode(' - ',$kgb->getField($field[$i]));
		$document->setValue($field_template[$i], $arrayKGB[1]);
	}
	elseif($i == 8 || $i == 15){
		$document->setValue($field_template[$i], currencyToPage($kgb->getField($field[$i]),true));
	}
	elseif($i == 16){
		$arrayKGB = explode(' - ',$kgb->getField($field[$i]));
		$tmp = $arrayKGB[0];
		$document->setValue($field_template[$i], $tmp);
	}
	elseif($field_template[$i] == "REQGAJITERBILANG")
		$document->setValue($field_template[$i], terbilang($kgb->getField($field[$i]))." rupiah");
	else
		$document->setValue($field_template[$i], $kgb->getField($field[$i]));
}

if($this->userLevel == "5")
{
	$tempSatkerPenandatangan= "0301";
	$statement_pimpinan=" AND A.SATKER_ID = '".$tempSatkerPenandatangan."'";
}
else
{
	$tempSatkerPenandatangan= "24";
	$statement_pimpinan=" AND A.SATKER_ID LIKE '".$tempSatkerPenandatangan."%'";
}
	
include_once("classes/base/Pegawai.php");
$set_pimpinan= new Pegawai();
$set_pimpinan->selectByParamsMonitoring2(array(),1,0,$statement_pimpinan, " ORDER BY C.ESELON_ID ASC, B.PANGKAT_ID DESC,  B.TMT_PANGKAT ASC ");
//echo $set_pimpinan->query;exit;
$set_pimpinan->firstRow();
$tempParentSatuanKerja= $set_pimpinan->getField("SATKER");
$tempKepala= $set_pimpinan->getField("JABATAN");
$tempNamaKepala= $set_pimpinan->getField("NAMA");
$tempGolRuangKepala= $set_pimpinan->getField("NMGOLRUANG");
$tempNipBaruKepala= $set_pimpinan->getField("NIP_BARU_CARI");
$tempNipBaruFormatKepala= $set_pimpinan->getField("NIP_BARU");
unset($set_pimpinan);

$document->setValue("REQTTD", $tempNamaKepala);
$document->setValue("REQTPANG", $tempGolRuangKepala);
$document->setValue("REQNPANG", $tempNipBaruFormatKepala);
$document->setValue("REQKEPALA", str_replace("(INDUK)", "", strtoupper($tempKepala)));

if($this->userLevel == "5")
	$tempKepala= "Kepala Badan Kepegawaian Daerah Kabupaten Lamongan";
else
{
	$tempKondisi= "";
	
	$tempCari= strtolower($tempSatkerInstansi);
	$tempDiCari= strtolower("Inspektorat");
	
	if(isStrContain($tempCari, $tempDiCari) == true)
		$tempKondisi= 1;
	
	$tempCari= strtolower($tempSatkerInstansi);
	$tempDiCari= strtolower("RSUD");
	
	if(isStrContain($tempCari, $tempDiCari) == true)
		$tempKondisi= 2;
	
	$tempCari= strtolower($tempSatkerInstansi);
	$tempDiCari= strtolower("KECAMATAN");
	
	if(isStrContain($tempCari, $tempDiCari) == true)
		$tempKondisi= 3;
	
	$tempCari= strtolower($tempSatkerInstansi);
	$tempDiCari= strtolower("Sekretariat");
	
	if(isStrContain($tempCari, $tempDiCari) == true)
		$tempKondisi= 4;
			
	if($tempKondisi == 1)
		$tempKepala= str_replace("Inspektorat", "Inspektur", $tempSatkerInstansi);
	elseif($tempKondisi == 2)
		$tempKepala= "Direktur ".$tempSatkerInstansi;
	elseif($tempKondisi == 3)
		$tempKepala= str_replace("Kecamatan", "Camat", $tempSatkerInstansi);
	elseif($tempKondisi == 4)
		$tempKepala= str_replace("Sekretariat", "Sekretariat", $tempSatkerInstansi);
	else
		$tempKepala= "Kepala ".$tempSatkerInstansi;
}

if($tempSatkerSmaSmp == 1)
	$tempSatkerTembusan= "Kepala ".ucAddress($kgb->getField("SATKER_NAMA"));
else
	$tempSatkerTembusan= $tempSatkerTembusan;

$document->setValue("REQTEMBUSANDISPEN", $tempSatkerTembusan);

if($this->userLevel == "5")
{
	$document->setValue("REQTEMBUSANKEPALA", ucAddress($tempKepala));
}
else
	$document->setValue("REQTEMBUSANKEPALA", ucAddress($tempKepala));

$document->save('Templates/KGB_BLANKO_Hasil_SK.docx');
$file = 'Templates/KGB_BLANKO_Hasil_SK.docx';

$down = 'Templates/KGB_BLANKO_Hasil_SK.docx';
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