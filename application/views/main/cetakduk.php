<?php 
include_once("../WEB-INF/classes/utils/UserLogin.php");
include_once("../WEB-INF/classes/base/Pegawai.php");
include_once("../WEB-INF/classes/base/DiklatStruktural.php");
include_once("../WEB-INF/classes/base/Satker.php");
include_once("../WEB-INF/classes/base/PangkatRiwayat.php");
include_once("../WEB-INF/classes/base/PendidikanRiwayat.php");
include_once("../WEB-INF/classes/base/JabatanRiwayat.php");
include_once("../WEB-INF/functions/date.func.php");
include_once("../WEB-INF/functions/default.func.php");
require_once "excel/class.writeexcel_workbookbig.inc.php";
require_once "excel/class.writeexcel_worksheet.inc.php";

/* create objects */
$pegawai = new Pegawai();
$satker	= new Satker();
$pangkatriwayat = new PangkatRiwayat();

//set_time_limit(3);
ini_set("memory_limit","500M");
ini_set('max_execution_time', 520);

$reqId = httpFilterGet("reqId");
$reqTipePegawaiId = httpFilterGet("reqTipePegawaiId");
$reqBulan = httpFilterGet("reqBulan");
$reqTahun = httpFilterGet("reqTahun");
$reqPangkatId= httpFilterGet("reqPangkatId");

$reqId= $this->input->get('reqId');
$reqTipePegawaiId= $this->input->get('reqTipePegawaiId');
$reqPangkatId= $this->input->get('reqPangkatId');

if($reqPangkatId ==''){}
else{
	$statement .= " AND GOL_RUANG = '".$reqPangkatId."'";
}

if($reqTipePegawaiId == ''){}
else{
	$statement .="AND TIPE_PEGAWAI_ID LIKE '".$reqTipePegawaiId."%' ";
}

$tempReqId= "";
if($userLogin->userSatkerId == "")//kondisi login sebagai admin
{	
	if($reqId == "")
		$statement .= " AND SATKER_ID_GENERATE IS NULL ";
	else
	{
		$tempReqId= $reqId;
		$statement .= " AND SATKER_ID_GENERATE = '".$reqId."' ";
	}
}
else // kondisi login sebagai SKPD
{
	if($reqId == "")
	{
		$tempReqId= $userLogin->userSatkerId;
		$statement .= " AND SATKER_ID_GENERATE = '".$userLogin->userSatkerId."' ";
	}
	else
	{
		$tempReqId= $reqId;
		$statement .= " AND SATKER_ID_GENERATE = '".$reqId."' ";
	}
}

if($reqId == "")
	$statement .= " AND PERIODE = '".$reqBulan.$reqTahun."'";	
else
	$statement .= "AND PERIODE = '".$reqBulan.$reqTahun."'";	


if($tempReqId == "")
	$reqKeterangan= 'Semua Satuan Kerja';
else
{
	$satker->selectByParams(array("A.SATKER_ID"=>$tempReqId),-1,-1);
	$satker->firstRow();
	$reqKeterangan= $satker->getField("NAMA");
}
	
$pegawai->selectByParamsDUK(array(),-1,-1, $statement);

$fname = tempnam("/tmp", "cetak_duk.xls");
$workbook = & new writeexcel_workbookbig($fname);
$worksheet = &$workbook->addworksheet();

$heading =& $workbook->addformat(array(align => 'center', bold => 1, size => 8, font => 'Arial Narrow'));
$heading->set_color('black');
$heading->set_bold();
$heading->set_size(8);
$heading->set_fg_color('white');
$heading->set_border_color('black');
$heading->set_top(1);
$heading->set_left(1);
$heading->set_right(1);
$heading->set_align('center');
$heading->set_align('vcenter');

$heading_merge_top =& $workbook->addformat(array(align => 'center', bold => 1, size => 8, font => 'Arial Narrow'));
$heading_merge_top->set_merge();
$heading_merge_top->set_top(1);

$heading_merge =& $workbook->addformat(array(align => 'center', bold => 1, size => 8, font => 'Arial Narrow'));
$heading_merge->set_merge();

$tanggal =& $workbook->addformat(array(num_format => ' dd mmmm yyy'));
$align =& $workbook->addformat();
$align->set_align('left');
$uang =& $workbook->addformat(array(num_format => '#,##0.00'));

$blank_format_top =& $workbook->addformat(array( size => 8, font => 'Arial Narrow'));
$blank_format_top->set_color('black');
$blank_format_top->set_size(8);
$blank_format_top->set_fg_color('white');
$blank_format_top->set_border_color('black');
$blank_format_top->set_top(1);

$blank_format_right =& $workbook->addformat(array( size => 8, font => 'Arial Narrow'));
$blank_format_right->set_color('black');
$blank_format_right->set_size(8);
$blank_format_right->set_fg_color('white');
$blank_format_right->set_border_color('black');
$blank_format_right->set_top(1);
$blank_format_right->set_right(1);

$blank_format_left =& $workbook->addformat(array( size => 8, font => 'Arial Narrow'));
$blank_format_left->set_color('black');
$blank_format_left->set_size(8);
$blank_format_left->set_fg_color('white');
$blank_format_left->set_border_color('black');
$blank_format_left->set_left(1);

$blank_format_right =& $workbook->addformat(array( size => 8, font => 'Arial Narrow'));
$blank_format_right->set_color('black');
$blank_format_right->set_size(8);
$blank_format_right->set_fg_color('white');
$blank_format_right->set_border_color('black');
$blank_format_right->set_right(1);

$blank_format_right_left =& $workbook->addformat(array( size => 8, font => 'Arial Narrow'));
$blank_format_right_left->set_color('black');
$blank_format_right_left->set_size(8);
$blank_format_right_left->set_fg_color('white');
$blank_format_right_left->set_border_color('black');
$blank_format_right_left->set_right(1);
$blank_format_right_left->set_left(1);

$blank_format_bottom =& $workbook->addformat(array( size => 8, font => 'Arial Narrow'));
$blank_format_bottom->set_color('black');
$blank_format_bottom->set_size(8);
$blank_format_bottom->set_fg_color('white');
$blank_format_bottom->set_border_color('black');
$blank_format_bottom->set_bottom(1);

$blank_format =& $workbook->addformat(array( size => 8, font => 'Arial Narrow'));
$blank_format->set_color('black');
$blank_format->set_size(8);
$blank_format->set_fg_color('white');
$blank_format->set_border_color('black');

$text_format_num =& $workbook->addformat(array( num_format => '###', size => 8, font => 'Arial Narrow', align => 'left'));

$text_format_left =& $workbook->addformat(array( size => 8, font => 'Arial Narrow'));
$text_format_left->set_color('black');
$text_format_left->set_size(8);
$text_format_left->set_fg_color('white');
$text_format_left->set_border_color('black');
$text_format_left->set_top(1);
$text_format_left->set_left(1);
$text_format_left->set_right(1);
$text_format_left->set_text_wrap();
$text_format_left->set_align("top");

$text_format_center =& $workbook->addformat(array(align => 'center', size => 8, font => 'Arial Narrow'));
$text_format_center->set_color('black');
$text_format_center->set_size(8);
$text_format_center->set_fg_color('white');
$text_format_center->set_border_color('black');

$text_format_center_right_left =& $workbook->addformat(array(align => 'center', size => 8, font => 'Arial Narrow'));
$text_format_center_right_left->set_color('black');
$text_format_center_right_left->set_size(8);
$text_format_center_right_left->set_fg_color('white');
$text_format_center_right_left->set_border_color('black');
$text_format_center_right_left->set_left(1);
$text_format_center_right_left->set_right(1);

$text_format_center_right_left_bottom =& $workbook->addformat(array(align => 'center', size => 8, font => 'Arial Narrow'));
$text_format_center_right_left_bottom->set_color('black');
$text_format_center_right_left_bottom->set_size(8);
$text_format_center_right_left_bottom->set_fg_color('white');
$text_format_center_right_left_bottom->set_border_color('black');
$text_format_center_right_left_bottom->set_left(1);
$text_format_center_right_left_bottom->set_right(1);
$text_format_center_right_left_bottom->set_bottom(1);


$text_format_center_top =& $workbook->addformat(array(align => 'center', size => 8, font => 'Arial Narrow'));
$text_format_center_top->set_color('black');
$text_format_center_top->set_size(8);
$text_format_center_top->set_fg_color('white');
$text_format_center_top->set_border_color('black');
$text_format_center_top->set_top(1);
$text_format_center_top->set_left(1);
$text_format_center_top->set_right(1);
$text_format_center_top->set_align("top");


$text_format_left_top =& $workbook->addformat(array(align => 'left', size => 8, font => 'Arial Narrow'));
$text_format_left_top->set_color('black');
$text_format_left_top->set_size(8);
$text_format_left_top->set_fg_color('white');
$text_format_left_top->set_border_color('black');
$text_format_left_top->set_top(1);

$text_format_wrapping =& $workbook->addformat(array( size => 8, font => 'Arial Narrow'));
$text_format_wrapping->set_text_wrap();
$text_format_wrapping->set_color('black');
$text_format_wrapping->set_size(8);
$text_format_wrapping->set_fg_color('white');
$text_format_wrapping->set_border_color('black');
$text_format_wrapping->set_left(1);
$text_format_wrapping->set_right(1);


//$text_format_line_bold_bottom =& $workbook->addformat(array(align => 'center', size => 8, font => 'Calibri'));
$text_format_line_bold_bottom =& $workbook->addformat(array(align => 'center', size => 8, font => 'Arial'));
$text_format_line_bold_bottom->set_color('black');
$text_format_line_bold_bottom->set_size(10);
$text_format_line_bold_bottom->set_border_color('black');
$text_format_line_bold_bottom->set_bold(1);
$text_format_line_bold_bottom->set_left(1);
$text_format_line_bold_bottom->set_right(1);
$text_format_line_bold_bottom->set_bottom(1);
$text_format_line_bold_bottom->set_fg_color('white');

$text_format_merge_line_bold_top_bottom =& $workbook->addformat(array(size => 8, font => 'Arial'));
$text_format_merge_line_bold_top_bottom->set_color('black');
$text_format_merge_line_bold_top_bottom->set_size(10);
$text_format_merge_line_bold_top_bottom->set_border_color('black');
$text_format_merge_line_bold_top_bottom->set_merge(1);
$text_format_merge_line_bold_top_bottom->set_bold(1);
$text_format_merge_line_bold_top_bottom->set_left(1);
$text_format_merge_line_bold_top_bottom->set_right(1);
$text_format_merge_line_bold_top_bottom->set_top(1);
$text_format_merge_line_bold_top_bottom->set_bottom(1);
$text_format_merge_line_bold_top_bottom->set_fg_color('white');

$text_format_line_bold_top =& $workbook->addformat(array(align => 'center', size => 8, font => 'Arial'));
$text_format_line_bold_top->set_color('black');
$text_format_line_bold_top->set_size(10);
$text_format_line_bold_top->set_border_color('black');
$text_format_line_bold_top->set_bold(1);
$text_format_line_bold_top->set_left(1);
$text_format_line_bold_top->set_right(1);
$text_format_line_bold_top->set_top(1);
$text_format_line_bold_top->set_fg_color('white');
$text_format_line_bold_top->set_text_wrap();

$text_format_line_bold =& $workbook->addformat(array(align => 'center', size => 8, font => 'Arial'));
$text_format_line_bold->set_color('black');
$text_format_line_bold->set_size(10);
$text_format_line_bold->set_border_color('black');
$text_format_line_bold->set_bold(1);
$text_format_line_bold->set_left(1);
$text_format_line_bold->set_right(1);
$text_format_line_bold->set_top(1);
$text_format_line_bold->set_bottom(1);
$text_format_line_bold->set_fg_color('white');

$text_format_line =& $workbook->addformat(array(align => 'center', size => 8, font => 'Arial'));
$text_format_line->set_color('black');
$text_format_line->set_size(8);
$text_format_line->set_border_color('black');
$text_format_line->set_left(1);
$text_format_line->set_right(1);
$text_format_line->set_top(1);
$text_format_line->set_bottom(1);
$text_format_line->set_fg_color('white');

$col=0;
$worksheet->set_column($col, $col, 4.43);$col++;
$worksheet->set_column($col, $col, 33.43);$col++;
$worksheet->set_column($col, $col, 15);$col++;
$worksheet->set_column($col, $col, 7.14);$col++;
$worksheet->set_column($col, $col, 23.29);$col++;
$worksheet->set_column($col, $col, 9.43);$col++;
$worksheet->set_column($col, $col, 46.86);$col++;
$worksheet->set_column($col, $col, 24.57);$col++;
$worksheet->set_column($col, $col, 4.29);$col++;
$worksheet->set_column($col, $col, 8);$col++;
$worksheet->set_column($col, $col, 6.29);$col++;
$worksheet->set_column($col, $col, 6.29);$col++;
$worksheet->set_column($col, $col, 4.57);$col++;
$worksheet->set_column($col, $col, 4.57);

$worksheet->insert_bitmap('B1', 'images/logo_report.bmp', 8, 8);

$row=1;$col=0;
$worksheet->write($row, $col, "PEMERINTAH KABUPATEN MOJOKERTO", $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;

$row=2;$col=0;
$worksheet->write($row, $col, "DAFTAR URUT KEPANGKATAN PEGAWAI NEGERI SIPIL", $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;

$row=3;$col=0;
//$worksheet->write($row, $col, "UNIT KERJA : ".ucwords(strtolower($reqKeterangan)), $heading_merge);$col++;
$worksheet->write($row, $col, "UNIT KERJA : ".strtoupper($reqKeterangan), $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;

$row=4;$col=0;
$worksheet->write($row, $col, "KEADAAN AKHIR BULAN ".getNameMonth($reqBulan)." TAHUN ".$reqTahun, $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;
$worksheet->write_blank($row, $col,   $heading_merge);$col++;

$row=6;$col=0;
$worksheet->write($row, $col, "NO.", $text_format_line_bold_top);$col++;
$worksheet->write($row, $col, "NAMA", $text_format_line_bold_top);$col++;
$worksheet->write($row, $col, "TEMPAT/", $text_format_line_bold_top);$col++;
$worksheet->write($row, $col, "AGAMA", $text_format_line_bold_top);$col++;
$worksheet->write($row, $col, "PENDIDIKAN/JURUSAN", $text_format_line_bold_top);$col++;
$worksheet->write($row, $col, "GOL./", $text_format_line_bold_top);$col++;
$worksheet->write($row, $col, "JABATAN/ESELON", $text_format_line_bold_top);$col++;
$worksheet->write($row, $col, "DIKLAT STRUKTURAL", $text_format_line_bold_top);$col++;
$worksheet->write($row, $col, "THN", $text_format_line_bold_top);$col++;
$worksheet->write($row, $col, "JML", $text_format_line_bold_top);$col++;
$worksheet->write($row, $col, "MASA KERJA", $text_format_merge_line_bold_top_bottom);$col++;
$worksheet->write_blank($row, $col,   $text_format_merge_line_bold_top_bottom);$col++;
$worksheet->write($row, $col, "USIA", $text_format_merge_line_bold_top_bottom);$col++;
$worksheet->write_blank($row, $col,   $text_format_merge_line_bold_top_bottom);

$row=7;$col=0;
$worksheet->write($row, $col, "", $text_format_line_bold_bottom);$col++;
$worksheet->write($row, $col, "NIP", $text_format_line_bold_bottom);$col++;
$worksheet->write($row, $col, "TANGGAL LAHIR",  $text_format_line_bold_bottom);$col++;
$worksheet->write($row, $col, "", $text_format_line_bold_bottom);$col++;
$worksheet->write($row, $col, "TAHUN", $text_format_line_bold_bottom);$col++;
$worksheet->write($row, $col, "TMT", $text_format_line_bold_bottom);$col++;
$worksheet->write($row, $col, "TMT", $text_format_line_bold_bottom);$col++;
$worksheet->write($row, $col, "", $text_format_line_bold_bottom);$col++;
$worksheet->write($row, $col, "", $text_format_line_bold_bottom);$col++;
$worksheet->write($row, $col, "JAM", $text_format_line_bold_bottom);$col++;
$worksheet->write($row, $col, "THN", $text_format_line_bold_bottom);$col++;
$worksheet->write($row, $col, "BLN", $text_format_line_bold_bottom);$col++;
$worksheet->write($row, $col, "THN", $text_format_line_bold_bottom);$col++;
$worksheet->write($row, $col, "BLN", $text_format_line_bold_bottom);

$row=8;$col=0;
$worksheet->write($row, $col, "1", $text_format_line);$col++;
$worksheet->write($row, $col, "2", $text_format_line);$col++;
$worksheet->write($row, $col, "3",  $text_format_line);$col++;
$worksheet->write($row, $col, "4", $text_format_line);$col++;
$worksheet->write($row, $col, "5", $text_format_line);$col++;
$worksheet->write($row, $col, "6", $text_format_line);$col++;
$worksheet->write($row, $col, "7", $text_format_line);$col++;
$worksheet->write($row, $col, "8", $text_format_line);$col++;
$worksheet->write($row, $col, "9", $text_format_line);$col++;
$worksheet->write($row, $col, "10", $text_format_line);$col++;
$worksheet->write($row, $col, "11", $text_format_line);$col++;
$worksheet->write($row, $col, "12", $text_format_line);$col++;
$worksheet->write($row, $col, "13", $text_format_line);$col++;
$worksheet->write($row, $col, "14", $text_format_line);

$row = 9;
while($pegawai->nextRow())
{
	$worksheet->write($row, 0, $pegawai->getField('DUK') ,$text_format_center_top);	
	$worksheet->write($row, 1, $pegawai->getField('NAMA')." \n".$pegawai->getField('NIP_BARU'),$text_format_left);
	$worksheet->write($row, 2, $pegawai->getField('TEMPAT_LAHIR')." \n".dateToPageCheck($pegawai->getField('TANGGAL_LAHIR')),$text_format_left);
	$worksheet->write($row, 3, $pegawai->getField('AGAMA') ,$text_format_center_top);	
	$worksheet->write($row, 4, $pegawai->getField('PENDIDIKAN')." \n".$pegawai->getField('TAHUN_LULUS'),$text_format_left);
	$worksheet->write($row, 5, $pegawai->getField('GOL_RUANG')." \n".dateToPageCheck($pegawai->getField('TMT_PANGKAT')),$text_format_left);
	
	$tempTipePegawaiId= $pegawai->getField("TIPE_PEGAWAI_ID");
	if($tempTipePegawaiId == "12")
		$worksheet->write($row, 6, $pegawai->getField('JABATAN'),$text_format_left);
	else
		$worksheet->write($row, 6, $pegawai->getField('JABATAN')." \n".$pegawai->getField('ESELON')." \n".dateToPageCheck($pegawai->getField('TMT_JABATAN')),$text_format_left);

	$worksheet->write($row, 7, $pegawai->getField('DIKLAT_STRUKTURAL'),$text_format_left);
	$worksheet->write($row, 8, $pegawai->getField('TAHUN_DIKLAT') ,$text_format_center_top);	
	
	$set= new DiklatStruktural();
	$set->selectByParamsTerakhir(array("PEGAWAI_ID"=>$pegawai->getField("PEGAWAI_ID")));
	$set->firstRow();
	$temp_jml_diklat_struktural= $set->getField("JUMLAH_JAM");
	unset($set);
	//$worksheet->write($row, 9, $pegawai->getField('JUMLAH_JAM_DIKLAT_STRUKTURAL') ,$text_format_center_top);
	$worksheet->write($row, 9, $temp_jml_diklat_struktural ,$text_format_center_top);
	
	$worksheet->write($row, 10, $pegawai->getField('MASA_KERJA_TAHUN') ,$text_format_center_top);
	$worksheet->write($row, 11, $pegawai->getField('MASA_KERJA_BULAN') ,$text_format_center_top);
	$arrUsia= explode(" - ",$pegawai->getField('USIA'));
	$worksheet->write($row, 12, $arrUsia[0] ,$text_format_center_top);
	$worksheet->write($row, 13, $arrUsia[1] ,$text_format_center_top);
	
	$row++;	
}

$worksheet->write_blank($row, 0,$blank_format_top);
$worksheet->write_blank($row, 1,$blank_format_top);
$worksheet->write_blank($row, 2,$blank_format_top);
$worksheet->write_blank($row, 3,$blank_format_top);
$worksheet->write_blank($row, 4,$blank_format_top);
$worksheet->write_blank($row, 5,$blank_format_top);
$worksheet->write_blank($row, 6,$blank_format_top);
$worksheet->write_blank($row, 7,$blank_format_top);
$worksheet->write_blank($row, 8,$blank_format_top);
$worksheet->write_blank($row, 9,$blank_format_top);
$worksheet->write_blank($row, 10,$blank_format_top);
$worksheet->write_blank($row, 11,$blank_format_top);
$worksheet->write_blank($row, 12,$blank_format_top);
$worksheet->write_blank($row, 13,$blank_format_top);

$workbook->close();

header("Content-Type: application/x-msexcel; name=\"cetak_duk.xls\"");
header("Content-Disposition: inline; filename=\"cetak_duk.xls\"");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
?>