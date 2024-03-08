<?
/* INCLUDE FILE */
require 'lib/PHPExcel.php';
include_once("functions/date.func.php");
include_once("functions/string.func.php");
include_once("functions/default.func.php");

$this->load->model("base-app/KenaikanGajiBerkala");

// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$kgb = new KenaikanGajiBerkala();

//set_time_limit(3);
ini_set("memory_limit","500M");
ini_set('max_execution_time', 520);


$setInfoTampil= $this->input->get("setInfoTampil");
$reqKeterangan = $this->input->get("reqKeterangan");
$reqId = $this->input->get("reqId");
$reqBulan = $this->input->get("reqBulan");
$reqTahun = $this->input->get("reqTahun");
$reqStatusAdministrasi= $this->input->get("reqStatusAdministrasi");

$objPHPexcel= PHPExcel_IOFactory::load('Templates/daftar_penjagaan_berkala.xlsx');
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

$currencyFormat= '_(Rp* #,##0_);_(Rp* (#,##0);_(Rp* "-"_);_(@_)';
$index_data_array=1;
for($checkbox_index=0;$checkbox_index<$index_data_array;$checkbox_index++)
{
	$sheetIndex= $checkbox_index;
	// set sheet
	$objPHPexcel->setActiveSheetIndex($sheetIndex);
	$objWorksheet = $objPHPexcel->getActiveSheet();
	if($checkbox_index == 0)
	{
		if($reqBulan == "")
		{
			if($reqId == "")
				$filter = array("SUBSTR(PERIODE,3,4)" => $reqTahun);
			else
				$filter = array("A.SATKER_ID" => $reqId, "SUBSTR(PERIODE,3,4)" => $reqTahun);
		}
		else
		{
			if($reqId == "")
				$filter = array("PERIODE" => $reqBulan.$reqTahun);
			else
				$filter = array("A.SATKER_ID" => $reqId, "PERIODE" => $reqBulan.$reqTahun);
		}
		
		$statement= "";
		if($reqStatusAdministrasi == ""){}
		elseif($reqStatusAdministrasi == "xx")
			$statement= " AND A.STATUS_KGB IS NULL";
		else
			$statement= " AND A.STATUS_KGB = '".$reqStatusAdministrasi."'";
		
		$tanggalsekarang= date("Y-m-d");
		$objWorksheet->setCellValue("A2","PER- ".getFormattedDate($tanggalsekarang));
		$row = 7;
		$tempRowAwal= 6;
		
		$field= "";
		$field= array("NO", "NAMA", "NIP_BARU", "GOL_RUANG", "JABATAN", "SATKER", "NO_SK_LAMA", "TANGGAL_SK_LAMA", "TMT_SK_LAMA", "MASA_KERJA_LAMA", "GAJI_POKOK_LAMA", "NO_SK_BARU", "TANGGAL_SK_BARU", "TMT_SK_BARU", "MASA_KERJA_BARU", "GAJI_POKOK_BARU");
		$set= new KenaikanGajiBerkala();
		$allRecord= $set->getCountByParamsBaru($filter, $statement.$searchJson);
		$set->selectByParamsBaru($filter, -1, -1, $statement.$searchJson);
		//echo $set->query;exit;
		$sOrder= "";
		if($allRecord > 1)
		{
			$objWorksheet->insertNewRowBefore($row, $allRecord-1);
		}
		elseif($allRecord > 0)
		{
			$objWorksheet->insertNewRowBefore($row, $allRecord);
		}
		elseif($allRecord == 0)
		{
			$col = 'A';	$objWorksheet->setCellValue($col.$row,'-'); $objWorksheet->mergeCells('A'.$row.':P'.$row.'');
			$i++;
		}
		
		//echo $set->query;exit;
		$nomor=1;
		$tempTotal= $tempProsentase= 0;
		while($set->nextRow())
		{
			$index_kolom= 1;
			for($i=0; $i<count($field); $i++)
			{
				$kolom= getColomsNew($index_kolom);
				if($field[$i] == "NO")
				{
					$objWorksheet->setCellValueExplicit($kolom.$row,$nomor, PHPExcel_Cell_DataType::TYPE_STRING);
				}
				elseif($field[$i] == "NIP_BARU")
				{
					$objWorksheet->setCellValueExplicit($kolom.$row," ".$set->getField($field[$i]), PHPExcel_Cell_DataType::TYPE_STRING);
				}
				elseif($field[$i] == "TANGGAL_SK_BARU" || $field[$i] == "TMT_SK_BARU" || $field[$i] == "TANGGAL_SK_LAMA" || $field[$i] == "TMT_SK_LAMA")
				{
					$objWorksheet->setCellValue($kolom.$row,dateToPageCheck($set->getField($field[$i])));
				}
				else
				{
					$objWorksheet->setCellValue($kolom.$row,$set->getField($field[$i]));
				}
				$index_kolom++;
			}
			
			if($set->getField("STATUS_KGB") == 2)
			$objWorksheet->getStyle("A".$row.":P".$row)->applyFromArray($styleProses);
			elseif($set->getField("STATUS_KGB") == 3)
			$objWorksheet->getStyle("A".$row.":P".$row)->applyFromArray($styleSelesai);
			elseif($set->getField("STATUS_KGB") == 4)
			$objWorksheet->getStyle("A".$row.":P".$row)->applyFromArray($styleTidak);
			
			$nomor++;
			$row++;
		}
		//exit;
		if($allRecord > 1)
		{
			$objWorksheet->removeRow($tempRowAwal, 1);
		}
		elseif($allRecord > 0)
		{
			$objWorksheet->removeRow($tempRowAwal, 1);
			$objWorksheet->removeRow($tempRowAwal+1, 1);
			$objWorksheet->removeRow($tempRowAwal+2, 1);
		}
	}
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
$objWriter->save('Templates/daftar_penjagaan_berkala.xls');

$down= 'Templates/daftar_penjagaan_berkala.xls';
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
