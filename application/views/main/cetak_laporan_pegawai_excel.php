<?
/* INCLUDE FILE */
require 'lib/PHPExcel.php';
include_once("functions/date.func.php");
include_once("functions/string.func.php");
include_once("functions/default.func.php");

ini_set("memory_limit","500M");
ini_set('max_execution_time', 520);

$this->load->model("base/CetakModel");
$pegawai = new CetakModel();

$reqKeterangan= $this->input->post('reqKeterangan');
$reqId= $this->input->post('reqId');
$reqDiklat= $this->input->post('reqDiklat');
$reqEselon= $this->input->post('reqEselon');
$reqGolongan= $this->input->post('reqGolongan');
$reqRuang= $this->input->post('reqRuang');
$rdoState= $this->input->post('rdoState');


// echo $rdoState;exit;

if($reqKeterangan == '') $reqKeterangan = 'Semua';
//echo $rdoState.'<>'.$reqKeterangan.'<>'.$reqId.'<>'.$reqDiklat.'<>'.$reqEselon.'<>'.$reqGolongan.'<>'.$reqRuang;
if($rdoState == 'modul1'){
	$LOAD = 'templates/cetak_modul1.xlsx';
	$RESULT = 'hasil_cetak_modul1';
}
elseif($rdoState == 'modul2'){
	$LOAD = 'templates/cetak_modul2.xlsx';
	$RESULT = 'cetak_modul2';
}
elseif($rdoState == 'modul3'){
	$LOAD = 'templates/cetak_modul3.xlsx';
	$RESULT = 'cetak_modul3';
}
else{
	// header('Location: );
	?>
	<meta http-equiv="refresh" content="0; URL='../main/popup_cetak?reqId=<?=$reqId?>&reqEror=1'"/> 
	<?
}

if($reqId == "")	$statement = "";
else				$statement = " AND A.SATKER_ID LIKE '".$reqId."%' ";
		
$objPHPexcel = PHPExcel_IOFactory::load($LOAD);
$objWorksheet = $objPHPexcel->getActiveSheet();
	
if($rdoState == 'modul1'){	
	$allrecord = $pegawai->getCountByCetakLaporanModel1(array('DIKLAT_ID'=>$reqDiklat));
	$pegawai->selectByParamsCetakLaporanModel1(array('DIKLAT_ID'=>$reqDiklat),-1,-1);
	// echo $pegawai->query;exit;
	
	$i = 7;	$z=1;
	if($allrecord > 1){
		$objWorksheet->insertNewRowBefore($i+1, $allrecord-1);
		while($pegawai->nextRow())
		{
			$col = 'A'; 	$objWorksheet->setCellValue($col.$i,$z);
			$col = 'B'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('NIP_LAMA'));
			$col = 'C'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('NAMA'));
			$col = 'D'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('PANGKAT'));
			$col = 'E'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('ESELON'));
			$col = 'F'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('JABATAN'));
			$col = 'G'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('PENYELENGGARA'));		
			$i++; $z++;
		}
	}
	elseif($allrecord == 0){
		$col = 'A';	$objWorksheet->setCellValue($col.$i,'-'); $objWorksheet->mergeCells('A'.$i.':G'.$i.'');
		$i++;
	}
}
elseif($rdoState == 'modul2'){
	$reqEselon		= httpFilterRequest("reqEselon");
	$reqGolongan		= httpFilterRequest("reqGolongan");
	$reqRuang		= httpFilterRequest("reqRuang");
	
	if($reqEselon)	$statement .= " AND ESELON_ID = '".$reqEselon."'";
	if($reqGolongan)	$statement .= " AND strpos(substr(GOL_RUANG, strpos(GOL_RUANG, '/')), '1') + strpos(GOL_RUANG, '/') - 1  = '".$reqGolongan."'";
	if($reqRuang)	$statement .= " AND SUBSTR(GOL_RUANG, -1) = '".$reqRuang."'";
	
	$allrecord = $pegawai->getCountByCetakLaporanModel2(array(),$statement);
	$pegawai->selectByParamsCetakLaporanModel2(array(),-1,-1,$statement);
	
	$objWorksheet->setCellValue('A6','Satuan Kerja : '.$reqKeterangan); $objWorksheet->mergeCells('A6:M6');
	
	$i = 9;	$z=1;
	if($allrecord > 1){
		$objWorksheet->insertNewRowBefore($i+1, $allrecord-1);
		while($pegawai->nextRow())
		{
			$col = 'A'; 	$objWorksheet->setCellValue($col.$i,$z);
			$col = 'B'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('NAMA'));
			$col = 'C'; 	$objWorksheet->setCellValue($col.$i,getFormattedDateJson($pegawai->getField('TANGGAL_LAHIR')));
			$col = 'D'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('NIP_LAMA'));
			$col = 'E'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('PANGKAT'));
			$col = 'F'; 	$objWorksheet->setCellValue($col.$i,getFormattedDateJson($pegawai->getField('TMT_PANGKAT')));
			$col = 'G'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('JABATAN'));
			$col = 'H'; 	$objWorksheet->setCellValue($col.$i,getFormattedDateJson($pegawai->getField('TMT_JABATAN')));		
			$col = 'I'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('MASA_KERJA_TAHUN'));		
			$col = 'J'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('MASA_KERJA_BULAN'));		
			$col = 'K'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('DIKLAT'));		
			$col = 'L'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('PENDIDIKAN'));		
			$col = 'M'; 	$objWorksheet->setCellValue($col.$i,$pegawai->getField('USIA'));		
			$i++; $z++;
		}
	}
	elseif($allrecord == 0){
		$col = 'A';	$objWorksheet->setCellValue($col.$i,'-'); $objWorksheet->mergeCells('A'.$i.':M'.$i.'');
		$i++;
	}	
}
elseif($rdoState == 'modul3'){		
	$allrecord = $pegawai->getCountByCetakLaporanModel3(array(),$statement);
	$pegawai->selectByParamsCetakLaporanModel3(array(),-1,-1,$statement);
	// echo $pegawai->query; exit;
	$objWorksheet->setCellValue('A3','Satuan Kerja : '.$reqKeterangan); $objWorksheet->mergeCells('A3:G3');
	
	$i = 5;	$z=1;
	if($allrecord > 1){
		$objWorksheet->insertNewRowBefore($i+1, $allrecord-1);
		while($pegawai->nextRow())
		{
			// echo $pegawai->getField('DATA_DIKLAT');exit;

			$objWorksheet->getRowDimension($i)->setRowHeight(52);		
			$col = 'A'; 	
			$objWorksheet->setCellValue($col.$i,$z);	$objWorksheet->getStyle('A'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			$col = 'B'; 	
			$objWorksheet->setCellValue($col.$i,$pegawai->getField('NAMA')."\n".$pegawai->getField('NIP_BARU'));
			$objWorksheet->getStyle('B'.$i)->getAlignment()->setWrapText(true);	$objWorksheet->getStyle('B'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			$col = 'C'; 	
			$objWorksheet->setCellValue($col.$i,$pegawai->getField('TTL'));	$objWorksheet->getStyle('C'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			$col = 'D'; 	
			$objWorksheet->setCellValue($col.$i,$pegawai->getField('GOL_RUANG')."\n".$pegawai->getField('TMT_PANGKAT'));
			$objWorksheet->getStyle('D'.$i)->getAlignment()->setWrapText(true); $objWorksheet->getStyle('D'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			// $data_diklat = explode('*',$pegawai->getField('DATA_DIKLAT'));
			$col = 'E'; 	
			// $objWorksheet->setCellValue($col.$i,$pegawai->getField('PENDIDIKAN')."\n".getValueArrayCetakBr($data_diklat));
			$objWorksheet->setCellValue($col.$i,$pegawai->getField('PENDIDIKAN'));
			// $objWorksheet->setCellValue($col.$i,$pegawai->getField('PENDIDIKAN')."\n".$data_diklat);
			$objWorksheet->getStyle('E'.$i)->getAlignment()->setWrapText(true); $objWorksheet->getStyle('E'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			$col = 'F'; 	
			$objWorksheet->setCellValue($col.$i,$pegawai->getField('JABATAN')); $objWorksheet->getStyle('F'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			$col = 'G'; 	
			$objWorksheet->setCellValue($col.$i,$pegawai->getField('ALAMAT')); $objWorksheet->getStyle('G'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			$i++; $z++;
		}
	}
	elseif($allrecord == 0){
		$col = 'A';	$objWorksheet->setCellValue($col.$i,'-'); $objWorksheet->mergeCells('A'.$i.':G'.$i.'');
		$i++;
	}
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
$objWriter->save('templates/'.$RESULT.'.xls');

$down = 'templates/'.$RESULT.'.xls';
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.ms-excel');
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