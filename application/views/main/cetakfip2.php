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

$objPHPexcel= PHPExcel_IOFactory::load('Templates/fip02.xlsx');
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

$objWorksheet = $objPHPexcel->getActiveSheet();

$this->load->model("base/RiwayatPangkat");
$RiwayatPangkat= new RiwayatPangkat();
$allrecord = $RiwayatPangkat->getCountByParams(array('PEGAWAI_ID'=>$reqId));
if($allrecord!=0){
	$objWorksheet->removeRow(11);
	$objWorksheet->insertNewRowBefore(11, $allrecord);
}
$urut=1;
$no=11;
$RiwayatPangkat->selectByParams(array('A.PEGAWAI_ID'=>$reqId));
// echo $RiwayatPangkat->query; exit;
while($RiwayatPangkat->nextRow()){
	$objWorksheet->setCellValue("a".$no,$urut);
	$objWorksheet->setCellValue("b".$no,$RiwayatPangkat->getField('NMPANGKAT'))->mergeCells('b'.$no.':f'.$no);
	$objWorksheet->setCellValue("g".$no,$RiwayatPangkat->getField('TMT_PANGKAT'))->mergeCells('g'.$no.':h'.$no);
	$objWorksheet->setCellValue("i".$no,$RiwayatPangkat->getField('NO_SK'))->mergeCells('i'.$no.':n'.$no);
	$objWorksheet->setCellValue("o".$no,$RiwayatPangkat->getField('TANGGAL_SK'))->mergeCells('o'.$no.':p'.$no);
	$objWorksheet->setCellValue("q".$no,$RiwayatPangkat->getField('PEJABAT_PENETAP'))->mergeCells('q'.$no.':t'.$no);
	$no++;
	$urut++;
} 

$this->load->model("base/RiwayatJabatan");
$RiwayatJabatan= new RiwayatJabatan();
$allrecord = $RiwayatJabatan->getCountByParams(array('PEGAWAI_ID'=>$reqId));
if($allrecord!=0){
	$objWorksheet->removeRow($no+5);
	$objWorksheet->insertNewRowBefore($no+5, $allrecord);
}
$urut=1;
$no=$no+5;
$RiwayatJabatan->selectByParams(array('A.PEGAWAI_ID'=>$reqId));
// echo $RiwayatPangkat->query; exit;
while($RiwayatJabatan->nextRow()){
	$objWorksheet->setCellValue("a".$no,$no);
	$objWorksheet->setCellValue("b".$no,$RiwayatJabatan->getField('NAMA').'/'.$RiwayatJabatan->getField('TMT_JABATAN'))->mergeCells('b'.$no.':f'.$no);
	$objWorksheet->setCellValue("g".$no,$RiwayatJabatan->getField('NO_SK'))->mergeCells('g'.$no.':l'.$no);
	$objWorksheet->setCellValue("m".$no,$RiwayatJabatan->getField('TANGGAL_SK'))->mergeCells('m'.$no.':o'.$no);
	$objWorksheet->setCellValue("p".$no,$RiwayatJabatan->getField('PEJABAT_PENETAP'))->mergeCells('p'.$no.':t'.$no);
	$no++;
	$urut++;
} 

$this->load->model("base/PendidikanUmum");
$PendidikanUmum= new PendidikanUmum();
$allrecord = $PendidikanUmum->getCountByParams(array('PEGAWAI_ID'=>$reqId));
if($allrecord!=0){
	$objWorksheet->removeRow($no+6);
	$objWorksheet->insertNewRowBefore($no+6, $allrecord);
	$no=$no+6;
}
else{
	$no=$no+7;
}
$urut=1;
$PendidikanUmum->selectByParams(array('A.PEGAWAI_ID'=>$reqId));
// echo $RiwayatPangkat->query; exit;
while($PendidikanUmum->nextRow()){
	$objWorksheet->setCellValue("a".$no,$urut);
	$objWorksheet->setCellValue("b".$no,$PendidikanUmum->getField('PENDIDIKAN'))->mergeCells('b'.$no.':c'.$no);
	$objWorksheet->setCellValue("d".$no,$PendidikanUmum->getField('NAMA'))->mergeCells('d'.$no.':h'.$no);
	$objWorksheet->setCellValue("i".$no,$PendidikanUmum->getField('KEPALA'))->mergeCells('i'.$no.':m'.$no);
	$objWorksheet->setCellValue("n".$no,$PendidikanUmum->getField('NO_STTB'))->mergeCells('n'.$no.':q'.$no);
	$objWorksheet->setCellValue("r".$no,$PendidikanUmum->getField('TANGGAL_STTB'))->mergeCells('r'.$no.':t'.$no);
	$no++;
	$urut++;
} 

$this->load->model("base/PelatihanKepemimpinan");
$PelatihanKepemimpinan= new PelatihanKepemimpinan();
$allrecord = $PelatihanKepemimpinan->getCountByParams(array('PEGAWAI_ID'=>$reqId));
if($allrecord!=0){
	$objWorksheet->removeRow($no+4);
	$objWorksheet->insertNewRowBefore($no+4, $allrecord);
	$no=$no+4;
}
else{
	$no=$no+5;
}
$urut=1;
$PelatihanKepemimpinan->selectByParams(array('A.PEGAWAI_ID'=>$reqId));
// echo $RiwayatPangkat->query; exit;
while($PelatihanKepemimpinan->nextRow()){
	$objWorksheet->setCellValue("a".$no,$urut);
	$objWorksheet->setCellValue("b".$no,$PelatihanKepemimpinan->getField('NAMADIKLAT'))->mergeCells('b'.$no.':e'.$no);
	$objWorksheet->setCellValue("f".$no,$PelatihanKepemimpinan->getField('TEMPAT').'/'.$PelatihanKepemimpinan->getField('PENYELENGGARA'))->mergeCells('f'.$no.':j'.$no);
	$objWorksheet->setCellValue("k".$no,$PelatihanKepemimpinan->getField('ANGKATAN').'/'.$PelatihanKepemimpinan->getField('TANGGAL_MULAI'))->mergeCells('k'.$no.':m'.$no);
	$objWorksheet->setCellValue("n".$no,$PelatihanKepemimpinan->getField('NO_STTPP'))->mergeCells('n'.$no.':q'.$no);
	$objWorksheet->setCellValue("R".$no,$PelatihanKepemimpinan->getField('TANGGAL_STTPP'))->mergeCells('r'.$no.':t'.$no);
	$no++;
	$urut++;
} 

$this->load->model("base/PelatihanFungsional");
$PelatihanFungsional= new PelatihanFungsional();
$allrecord = $PelatihanFungsional->getCountByParams(array('PEGAWAI_ID'=>$reqId));
if($allrecord!=0){
	$objWorksheet->removeRow($no+4);
	$objWorksheet->insertNewRowBefore($no+4, $allrecord);
	$no=$no+4;
}
else{
	$no=$no+5;
}
$urut=1;
$PelatihanFungsional->selectByParams(array('PEGAWAI_ID'=>$reqId));
// echo $PelatihanFungsional->query; exit;
while($PelatihanFungsional->nextRow()){
	$objWorksheet->setCellValue("a".$no,$urut);
	$objWorksheet->setCellValue("b".$no,$PelatihanFungsional->getField('NAMA'))->mergeCells('b'.$no.':e'.$no);
	$objWorksheet->setCellValue("f".$no,$PelatihanFungsional->getField('TEMPAT').'/'.$PelatihanFungsional->getField('PENYELENGGARA'))->mergeCells('f'.$no.':j'.$no);
	$objWorksheet->setCellValue("k".$no,$PelatihanFungsional->getField('ANGKATAN').'/'.$PelatihanFungsional->getField('TANGGAL_MULAI'))->mergeCells('k'.$no.':m'.$no);
	$objWorksheet->setCellValue("n".$no,$PelatihanFungsional->getField('NO_STTPP'))->mergeCells('n'.$no.':q'.$no);
	$objWorksheet->setCellValue("R".$no,$PelatihanFungsional->getField('TANGGAL_STTPP'))->mergeCells('r'.$no.':t'.$no);
	$no++;
	$urut++;
} 

$this->load->model("base/PelatihanTeknis");
$PelatihanTeknis= new PelatihanTeknis();
$allrecord = $PelatihanTeknis->getCountByParams(array('PEGAWAI_ID'=>$reqId));
if($allrecord!=0){
	$objWorksheet->removeRow($no+4);
	$objWorksheet->insertNewRowBefore($no+4, $allrecord);
	$no=$no+4;
}
else{
	$no=$no+5;
}
$urut=1;
$PelatihanTeknis->selectByParams(array('PEGAWAI_ID'=>$reqId));
// echo $PelatihanFungsional->query; exit;
while($PelatihanTeknis->nextRow()){
	$objWorksheet->setCellValue("a".$no,$urut);
	$objWorksheet->setCellValue("b".$no,$PelatihanTeknis->getField('NAMA'))->mergeCells('b'.$no.':e'.$no);
	$objWorksheet->setCellValue("f".$no,$PelatihanTeknis->getField('TEMPAT').'/'.$PelatihanFungsional->getField('PENYELENGGARA'))->mergeCells('f'.$no.':j'.$no);
	$objWorksheet->setCellValue("k".$no,$PelatihanTeknis->getField('ANGKATAN').'/'.$PelatihanTeknis->getField('TANGGAL_MULAI'))->mergeCells('k'.$no.':m'.$no);
	$objWorksheet->setCellValue("n".$no,$PelatihanTeknis->getField('NO_STTPP'))->mergeCells('n'.$no.':q'.$no);
	$objWorksheet->setCellValue("R".$no,$PelatihanTeknis->getField('TANGGAL_STTPP'))->mergeCells('r'.$no.':t'.$no);
	$no++;
	$urut++;
} 

$this->load->model("base/SeminarWorkshop");
$SeminarWorkshop= new SeminarWorkshop();
$allrecord = $SeminarWorkshop->getCountByParams(array('PEGAWAI_ID'=>$reqId));
if($allrecord!=0){
	$objWorksheet->removeRow($no+9);
	$objWorksheet->insertNewRowBefore($no+9, $allrecord);
	$no=$no+9;
}
else{
	$no=$no+10;
}
$urut=1;
$SeminarWorkshop->selectByParams(array('PEGAWAI_ID'=>$reqId));
// echo $PelatihanFungsional->query; exit;
while($SeminarWorkshop->nextRow()){
	$objWorksheet->setCellValue("a".$no,$urut);
	$objWorksheet->setCellValue("b".$no,$SeminarWorkshop->getField('NAMA'))->mergeCells('b'.$no.':e'.$no);
	$objWorksheet->setCellValue("f".$no,$SeminarWorkshop->getField('TEMPAT').'/'.$PelatihanFungsional->getField('PENYELENGGARA'))->mergeCells('f'.$no.':j'.$no);
	$objWorksheet->setCellValue("k".$no,$SeminarWorkshop->getField('TANGGAL_MULAI'))->mergeCells('k'.$no.':m'.$no);
	$objWorksheet->setCellValue("n".$no,$SeminarWorkshop->getField('NO_PIAGAM'))->mergeCells('n'.$no.':q'.$no);
	$objWorksheet->setCellValue("R".$no,$SeminarWorkshop->getField('TANGGAL_PIAGAM'))->mergeCells('r'.$no.':t'.$no);
	$no++;
	$urut++;
} 

$this->load->model("base/OrangTua");
$OrangTua= new OrangTua();
$OrangTua->selectByParams(array("a.PEGAWAI_ID" => $reqId,"JENIS_KELAMIN" => L),-1,-1, '');
// echo $OrangTua->query; exit;
$OrangTua->firstRow();
// ayah
$objWorksheet->setCellValue("f".($no+7),$OrangTua->getField('NAMA'))->mergeCells('f'.($no+7).':l'.($no+7));
$objWorksheet->setCellValue("f".($no+8),$OrangTua->getField('TEMPAT_LAHIR'))->mergeCells('f'.($no+8).':l'.($no+8));
$objWorksheet->setCellValue("f".($no+9),$OrangTua->getField('TANGGAL_LAHIR'))->mergeCells('f'.($no+9).':l'.($no+9));
$objWorksheet->setCellValue("f".($no+10),$OrangTua->getField('PEKERJAAN'))->mergeCells('f'.($no+10).':l'.($no+10));
$objWorksheet->setCellValue("f".($no+11),$OrangTua->getField('ALAMAT'))->mergeCells('f'.($no+11).':l'.($no+11));
$objWorksheet->setCellValue("f".($no+12),$OrangTua->getField('TELEPON'))->mergeCells('f'.($no+12).':l'.($no+12));
$objWorksheet->setCellValue("f".($no+14),$OrangTua->getField('NAMA_KELURAHAN'))->mergeCells('f'.($no+14).':l'.($no+14));
$objWorksheet->setCellValue("f".($no+15),$OrangTua->getField('NAMA_KECAMATAN'))->mergeCells('f'.($no+15).':l'.($no+15));
$objWorksheet->setCellValue("f".($no+16),$OrangTua->getField('NAMA_KABUPATEN'))->mergeCells('f'.($no+16).':l'.($no+16));
$objWorksheet->setCellValue("f".($no+17),$OrangTua->getField('NAMA_PROPINSI'))->mergeCells('f'.($no+17).':l'.($no+17));
$objWorksheet->setCellValue("f".($no+18),$OrangTua->getField('KODEPOS'))->mergeCells('f'.($no+18).':l'.($no+18));


$this->load->model("base/OrangTua");
$OrangTua= new OrangTua();
$OrangTua->selectByParams(array("a.PEGAWAI_ID" => $reqId,"JENIS_KELAMIN" => P),-1,-1, '');
// echo $OrangTua->query; exit;
$OrangTua->firstRow();
// Ibu
$objWorksheet->setCellValue("n".($no+7),$OrangTua->getField('NAMA'))->mergeCells('n'.($no+7).':t'.($no+7));
$objWorksheet->setCellValue("n".($no+8),$OrangTua->getField('TEMPAT_LAHIR'))->mergeCells('n'.($no+8).':t'.($no+8));
$objWorksheet->setCellValue("n".($no+9),$OrangTua->getField('TANGGAL_LAHIR'))->mergeCells('n'.($no+9).':t'.($no+9));
$objWorksheet->setCellValue("n".($no+10),$OrangTua->getField('PEKERJAAN'))->mergeCells('n'.($no+10).':t'.($no+10));
$objWorksheet->setCellValue("n".($no+11),$OrangTua->getField('ALAMAT'))->mergeCells('n'.($no+11).':t'.($no+11));
$objWorksheet->setCellValue("n".($no+12),$OrangTua->getField('TELEPON'))->mergeCells('n'.($no+12).':t'.($no+12));
$objWorksheet->setCellValue("n".($no+14),$OrangTua->getField('NAMA_KELURAHAN'))->mergeCells('n'.($no+14).':t'.($no+14));
$objWorksheet->setCellValue("n".($no+15),$OrangTua->getField('NAMA_KECAMATAN'))->mergeCells('n'.($no+15).':t'.($no+15));
$objWorksheet->setCellValue("n".($no+16),$OrangTua->getField('NAMA_KABUPATEN'))->mergeCells('n'.($no+16).':t'.($no+16));
$objWorksheet->setCellValue("n".($no+17),$OrangTua->getField('NAMA_PROPINSI'))->mergeCells('n'.($no+17).':t'.($no+17));
$objWorksheet->setCellValue("n".($no+18),$OrangTua->getField('KODEPOS'))->mergeCells('n'.($no+18).':t'.($no+18));

$no=$no+23;
$this->load->model("base/SuamiIstri");
$SuamiIstri= new SuamiIstri();
$SuamiIstri->selectByParams(array("a.PEGAWAI_ID" => $reqId),-1,-1, '');
// echo $OrangTua->query; exit;
$SuamiIstri->firstRow();
if($SuamiIstri->getField('NAMA')!=''){
	$objWorksheet->insertNewRowBefore($no,1);
// echo $no;exit;
	$objWorksheet->setCellValue("a".$no,'1');
	$objWorksheet->setCellValue("b".$no,$SuamiIstri->getField('NAMA'))->mergeCells('b'.$no.':d'.$no);
	$objWorksheet->setCellValue("e".$no,$SuamiIstri->getField('TEMPAT_LAHIR').','.$SuamiIstri->getField('TANGGAL_LAHIR'))->mergeCells('e'.$no.':h'.$no);
	$objWorksheet->setCellValue("i".$no,$SuamiIstri->getField('NMPENDIDIKAN'))->mergeCells('i'.$no.':k'.$no);
	$objWorksheet->setCellValue("l".$no,$SuamiIstri->getField('TANGGAL_KAWIN'))->mergeCells('l'.$no.':n'.$no);
	$objWorksheet->setCellValue("o".$no,$SuamiIstri->getField('STATUS_TUNJANGAN'))->mergeCells('o'.$no.':p'.$no);
	$objWorksheet->setCellValue("q".$no,$SuamiIstri->getField('PEKERJAAN'))->mergeCells('q'.$no.':t'.$no);
	$objWorksheet->removeRow($no+1);
}

$this->load->model("base/Anak");
$Anak= new Anak();
$allrecord = $Anak->getCountByParams(array('PEGAWAI_ID'=>$reqId));
if($allrecord!=0){
	$objWorksheet->removeRow($no+5);
	$objWorksheet->insertNewRowBefore($no+5, $allrecord);
	$no=$no+5;
}
else{
	$no=$no+6;
}
$urut=1;
$Anak->selectByParams(array('PEGAWAI_ID'=>$reqId));
// echo $Anak->query; exit;
while($Anak->nextRow()){
	$objWorksheet->setCellValue("a".$no,$urut);
	$objWorksheet->setCellValue("b".$no,$Anak->getField('NAMA'))->mergeCells('b'.$no.':d'.$no);
	$objWorksheet->setCellValue("e".$no,$Anak->getField('TEMPAT_LAHIR').'/'.$Anak->getField('TANGGAL_LAHIR'))->mergeCells('e'.$no.':h'.$no);
	$objWorksheet->setCellValue("i".$no,$Anak->getField('JENIS_KELAMIN'));
	$objWorksheet->setCellValue("j".$no,$Anak->getField('KELUARGA'))->mergeCells('j'.$no.':k'.$no);
	$objWorksheet->setCellValue("l".$no,$Anak->getField('TUNJANGAN'))->mergeCells('l'.$no.':n'.$no);
	$objWorksheet->setCellValue("o".$no,$Anak->getField('NMPENDIDIKAN'))->mergeCells('o'.$no.':p'.$no);
	$objWorksheet->setCellValue("q".$no,$Anak->getField('PEKERJAAN'))->mergeCells('q'.$no.':t'.$no);
	$no++;
	$urut++;
} 

$this->load->model("base/Organisasi");
$set= new Organisasi();
$allrecord = $set->getCountByParams(array('PEGAWAI_ID'=>$reqId));
if($allrecord!=0){
	$objWorksheet->removeRow($no+5);
	$objWorksheet->insertNewRowBefore($no+5, $allrecord);
	$no=$no+5;
}
else{
	$no=$no+6;
}
$urut=1;
$set->selectByParams(array('PEGAWAI_ID'=>$reqId));
// echo $Anak->query; exit;
while($set->nextRow()){
	$objWorksheet->setCellValue("a".$no,$urut);
	$objWorksheet->setCellValue("b".$no,$set->getField('NAMA'))->mergeCells('b'.$no.':e'.$no);
	$objWorksheet->setCellValue("f".$no,$set->getField('JABATAN'))->mergeCells('f'.$no.':j'.$no);
	$objWorksheet->setCellValue("k".$no,$set->getField('TANGGAL_AWAL').'-'.$set->getField('TANGGAL_AKHIR'))->mergeCells('k'.$no.':m'.$no);
	$objWorksheet->setCellValue("n".$no,$set->getField('PIMPINAN'))->mergeCells('n'.$no.':p'.$no);
	$objWorksheet->setCellValue("q".$no,$set->getField('TEMPAT'))->mergeCells('q'.$no.':t'.$no);
	$no++;
	$urut++;
} 

$this->load->model("base/Penghargaan");
$set= new Penghargaan();
$allrecord = $set->getCountByParams(array('PEGAWAI_ID'=>$reqId));
if($allrecord!=0){
	$objWorksheet->removeRow($no+5);
	$objWorksheet->insertNewRowBefore($no+5, $allrecord);
	$no=$no+5;
}
else{
	$no=$no+6;
}
$urut=1;
$set->selectByParams(array('PEGAWAI_ID'=>$reqId));
// echo $set->query; exit;
while($set->nextRow()){
	$objWorksheet->setCellValue("a".$no,$urut);
	$objWorksheet->setCellValue("b".$no,$set->getField('NAMA'))->mergeCells('b'.$no.':e'.$no);
	$objWorksheet->setCellValue("f".$no,$set->getField('NO_SK'))->mergeCells('f'.$no.':i'.$no);
	$objWorksheet->setCellValue("j".$no,$set->getField('TANGGAL_SK'))->mergeCells('j'.$no.':l'.$no);
	$objWorksheet->setCellValue("m".$no,$set->getField('NMPEJABATPENETAP'))->mergeCells('m'.$no.':q'.$no);
	$objWorksheet->setCellValue("r".$no,$set->getField('TAHUN'))->mergeCells('r'.$no.':t'.$no);
	$no++;
	$urut++;
} 

$this->load->model("base/Hukuman");
$set= new Hukuman();
$allrecord = $set->getCountByParams(array('PEGAWAI_ID'=>$reqId));
if($allrecord!=0){
	$objWorksheet->removeRow($no+21);
	$objWorksheet->insertNewRowBefore($no+21, $allrecord);
	$no=$no+21;
}
else{
	$no=$no+22;
}
$urut=1;
$set->selectByParams(array('PEGAWAI_ID'=>$reqId));
// echo $set->query; exit;
while($set->nextRow()){
	$objWorksheet->setCellValue("a".$no,$urut);
	$objWorksheet->setCellValue("b".$no,$set->getField('NMJENISHUKUMAN'))->mergeCells('b'.$no.':g'.$no);
	$objWorksheet->setCellValue("h".$no,$set->getField('NO_SK'))->mergeCells('h'.$no.':l'.$no);
	$objWorksheet->setCellValue("m".$no,$set->getField('TANGGAL_SK'))->mergeCells('m'.$no.':o'.$no);
	$objWorksheet->setCellValue("p".$no,$set->getField('NMPEJABATPENETAP'))->mergeCells('p'.$no.':t'.$no);
	$no++;
	$urut++;
} 


$this->load->model("base/Cuti");
$set= new Cuti();
$allrecord = $set->getCountByParams(array('PEGAWAI_ID'=>$reqId));
if($allrecord!=0){
	$objWorksheet->removeRow($no+5);
	$objWorksheet->insertNewRowBefore($no+5, $allrecord);
	$no=$no+5;
}
else{
	$no=$no+6;
}
$urut=1;
$set->selectByParams(array('PEGAWAI_ID'=>$reqId));
// echo $set->query; exit;
while($set->nextRow()){
	$objWorksheet->setCellValue("a".$no,$urut);
	$exptgl=explode('-', $set->getField('TANGGAL_PERMOHONAN'));

	$objWorksheet->setCellValue("b".$no,$exptgl[0])->mergeCells('b'.$no.':c'.$no);
	$objWorksheet->setCellValue("d".$no,$set->getField('NMCUTI'))->mergeCells('d'.$no.':g'.$no);
	$objWorksheet->setCellValue("h".$no,$set->getField('NO_SURAT'))->mergeCells('h'.$no.':l'.$no);
	$objWorksheet->setCellValue("m".$no,$set->getField('TANGGAL_SURAT'))->mergeCells('m'.$no.':o'.$no);
	$objWorksheet->setCellValue("p".$no,$set->getField('TANGGAL_MULAI').'-'.$set->getField('TANGGAL_SELESAI'))->mergeCells('p'.$no.':q'.$no);
	$objWorksheet->setCellValue("r".$no,$set->getField('KETERANGAN'))->mergeCells('r'.$no.':t'.$no);
	$no++;
	$urut++;
} 

$this->load->model("base/PenguasaanBahasa");
$set= new PenguasaanBahasa();
$allrecord = $set->getCountByParams(array('PEGAWAI_ID'=>$reqId));
if($allrecord!=0){
	$objWorksheet->removeRow($no+11);
	$objWorksheet->insertNewRowBefore($no+11, $allrecord);
	$no=$no+11;
}
else{
	$no=$no+12;
}
$urut=1;
$set->selectByParams(array('PEGAWAI_ID'=>$reqId));
// echo $set->query; exit;
while($set->nextRow()){
	$objWorksheet->setCellValue("a".$no,$urut);
	$objWorksheet->setCellValue("b".$no,$set->getField('NMJENIS'))->mergeCells('b'.$no.':i'.$no);
	$objWorksheet->setCellValue("j".$no,$set->getField('NAMA'))->mergeCells('j'.$no.':o'.$no);
	$objWorksheet->setCellValue("p".$no,$set->getField('MAMPU'))->mergeCells('p'.$no.':t'.$no);
	$no++;
	$urut++;
} 

$currencyFormat= '_(Rp* #,##0_);_(Rp* (#,##0);_(Rp* "-"_);_(@_)';
$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
$objWriter->save('Templates/FIP02-'.$reqId.'.xls');

$down= 'Templates/FIP02-'.$reqId.'.xls';
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
