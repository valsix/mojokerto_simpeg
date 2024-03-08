<?
/* INCLUDE FILE */
include_once("functions/date.func.php");
include_once("functions/string.func.php");
include_once("functions/default.func.php");
require_once "lib/excel/class.writeexcel_workbookbig.inc.php";
require_once "lib/excel/class.writeexcel_worksheet.inc.php";


$this->load->model("base-app/KenaikanGajiBerkala");

/* create objects */
$kgb = new KenaikanGajiBerkala();

//set_time_limit(3);
ini_set("memory_limit","500M");
ini_set('max_execution_time', 520);

/* VARIABLE */
$setInfoTampil= $this->input->get("setInfoTampil");
$reqKeterangan = $this->input->get("reqKeterangan");
$reqId = $this->input->get("reqId");
$reqBulan = $this->input->get("reqBulan");
$reqTahun = $this->input->get("reqTahun");
$reqStatusAdministrasi= $this->input->get("reqStatusAdministrasi");
$reqKgb= $this->input->get("reqKgb");


if($reqId == "")
  $filter = array("PERIODE" => $reqBulan.$reqTahun);
else
  $filter = array("SATKER_ID_GENERATE" => $reqId, "PERIODE" => $reqBulan.$reqTahun);

if($reqStatusAdministrasi == ""){}
elseif($reqStatusAdministrasi == "xx")
  $statement= " AND A.STATUS_KGB IS NULL";
else
  $statement= " AND A.STATUS_KGB = '".$reqStatusAdministrasi."'";

// if($this->userlevel == "5")
//   $statement.= " AND TIPE_PEGAWAI_ID = '2102'";
// else
//   $statement.= " AND TIPE_PEGAWAI_ID <> '2102'";
if($reqKgb=="admin"){}
  else if($reqKgb=="guru")
  {
    $statement.= " AND TIPE_PEGAWAI_ID = '2102'";
  }
  else
  {
    $statement.= " AND TIPE_PEGAWAI_ID <> '2102'";
  }

//kl kondisi admin untuk klik semua tidak di tampilkan dulu
if($this->userSatkerId == "" && $reqId == "")
{
  if($setInfoTampil == "1"){}
  else
  {
    $statement= " AND 1 = 2 ";
  }
}

// exit;

$kgb->selectByParams($filter, -1, -1, $statement);
// echo $kgb->query;exit;

$fname = tempnam("/tmp", "kgb_cetak_usulan.xls");
$workbook = & new writeexcel_workbookbig($fname);
$worksheet = &$workbook->addworksheet();

$worksheet->set_column(0, 0, 3.57);
$worksheet->set_column(1, 1, 30.00);
$worksheet->set_column(2, 2, 17.29);
$worksheet->set_column(3, 3, 17.29);
$worksheet->set_column(4, 4, 43.14);
$worksheet->set_column(5, 5, 25.14);

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

$text_format =& $workbook->addformat(array( size => 8, font => 'Arial Narrow'));
$text_format_num =& $workbook->addformat(array( num_format => '###', size => 8, font => 'Arial Narrow', align => 'left'));
$text_format_num->set_left(1);

$text_format_left =& $workbook->addformat(array( size => 8, font => 'Arial Narrow'));
$text_format_left->set_color('black');
$text_format_left->set_size(8);
$text_format_left->set_fg_color('white');
$text_format_left->set_border_color('black');
$text_format_left->set_top(1);
$text_format_left->set_left(1);
$text_format_left->set_right(1);

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

$text_format_right_left =& $workbook->addformat(array(align => 'left', size => 8, font => 'Arial Narrow'));
$text_format_right_left->set_color('black');
$text_format_right_left->set_size(8);
$text_format_right_left->set_fg_color('white');
$text_format_right_left->set_border_color('black');
$text_format_right_left->set_left(1);
$text_format_right_left->set_right(1);

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

$uang =& $workbook->addformat(array(num_format => '#,##0', size => 8, font => 'Arial Narrow', align => 'center'));
$uang->set_color('black');
$uang->set_size(8);
$uang->set_fg_color('white');
$uang->set_border_color('black');
$uang->set_left(1);
$uang->set_right(1);


$worksheet->insert_bitmap('B1', 'images/logo_report.bmp', 8, 8);

$worksheet->write(1, 0, "PEMERINTAH KABUPATEN LAMONGAN", $heading_merge);
$worksheet->write_blank(1, 1,   $heading_merge);
$worksheet->write_blank(1, 2,   $heading_merge);
$worksheet->write_blank(1, 3,   $heading_merge);
$worksheet->write_blank(1, 4,   $heading_merge);
$worksheet->write_blank(1, 5,   $heading_merge);

$worksheet->write(2, 0, "DAFTAR URUT KEPANGKATAN PEGAWAI NEGERI SIPIL", $heading_merge);
$worksheet->write_blank(2, 1,   $heading_merge);
$worksheet->write_blank(2, 2,   $heading_merge);
$worksheet->write_blank(2, 3,   $heading_merge);
$worksheet->write_blank(2, 4,   $heading_merge);
$worksheet->write_blank(2, 5,   $heading_merge);

$worksheet->write(3, 0, "KEADAAN AKHIR TAHUN 2012", $heading_merge);
$worksheet->write_blank(3, 1,   $heading_merge);
$worksheet->write_blank(3, 2,   $heading_merge);
$worksheet->write_blank(3, 3,   $heading_merge);
$worksheet->write_blank(3, 4,   $heading_merge);
$worksheet->write_blank(3, 5,   $heading_merge);

$worksheet->write(5, 0, " ", $heading);
$worksheet->write(5, 1, "Nama Pegawai", $heading);
$worksheet->write(5, 2, "Gol. Ruang / Masa Kerja",  $heading);
$worksheet->write(5, 3, "Masa Kerja KGB", $heading);
$worksheet->write(5, 4, "Jabatan", $heading);
$worksheet->write(5, 5, " ", $heading);

$worksheet->write(6, 0, "No.", $heading);
$worksheet->write(6, 1, "NIP", $heading);
$worksheet->write(6, 2, "TMT Lama",  $heading);
$worksheet->write(6, 3, "TMT SK", $heading);
$worksheet->write(6, 4, "Satuan Kerja", $heading);
$worksheet->write(6, 5, "Keterangan", $heading);

$worksheet->write(7, 0, "", $heading);
$worksheet->write(7, 1, "Tempat, Tgl Lahir", $heading);
$worksheet->write(7, 2, "Gaji Lama",  $heading);
$worksheet->write(7, 3, "Gaji Baru", $heading);
$worksheet->write(7, 4, "Eselon", $heading);
$worksheet->write(7, 5, " ", $heading);

$i=1;
$row = 8;
while($kgb->nextRow())
{
  $worksheet->write($row, 0, $i ,$text_format_center_top);  
  $worksheet->write($row, 1, $kgb->getField('NAMA') ,$text_format_left_top);
  $worksheet->write($row, 2, $kgb->getField('GOL_RUANG')." / ".$kgb->getField('MASA_KERJA_LAMA') ,$text_format_center_top);
  $worksheet->write($row, 3, $kgb->getField('MASA_KERJA') ,$text_format_center_top);
  $worksheet->write($row, 4, $kgb->getField('JABATAN') ,$text_format_center_top);
  $worksheet->write($row, 5, " " ,$text_format_center_top);
  $row++;
  
  $worksheet->write($row, 0, "" ,$blank_format_left); 
  $worksheet->write($row, 1, $kgb->getField('NIP_BARU') ,$text_format_num);
  $worksheet->write($row, 2, $kgb->getField('TMT_LAMA') ,$text_format_center_right_left);
  $worksheet->write($row, 3, $kgb->getField('TMT_BARU') ,$text_format_center_right_left);
  $worksheet->write($row, 4, $kgb->getField('SATKER') ,$text_format_center_right_left);
  $worksheet->write($row, 5, " " ,$text_format_center_right_left);
  $row++;
  
  $worksheet->write($row, 0, "" ,$blank_format_left); 
  $worksheet->write($row, 1, $kgb->getField('TEMPAT_LAHIR')." , ". dateToPage($kgb->getField('TANGGAL_LAHIR')) ,$text_format_right_left);
  $worksheet->write($row, 2, $kgb->getField('GAJI_LAMA') ,$uang);
  $worksheet->write($row, 3, $kgb->getField('GAJI_BARU') ,$uang);
  $worksheet->write($row, 4, $kgb->getField('ESELON') ,$text_format_center_right_left);
  $worksheet->write($row, 5, " " ,$text_format_center_right_left);
  $row++;   

  $i++;
}

$worksheet->write_blank($row, 0,$blank_format_top);
$worksheet->write_blank($row, 1,$blank_format_top);
$worksheet->write_blank($row, 2,$blank_format_top);
$worksheet->write_blank($row, 3,$blank_format_top);
$worksheet->write_blank($row, 4,$blank_format_top);
$worksheet->write_blank($row, 5,$blank_format_top);

$workbook->close();

header("Content-Type: application/x-msexcel; name=\"kgb_cetak_usulan.xls\"");
header("Content-Disposition: inline; filename=\"kgb_cetak_usulan.xls\"");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
?>
