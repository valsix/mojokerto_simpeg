<html lang="en">
<head>
	<base href="<?=base_url()?>">
	<meta charset="utf-8" />
	<title>SiMEGILAN | Admin</title>
	<meta name="description" content="User profile block example" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	
</head>
</html>
<?
//Load file content
$this->load->model("base-data/PegawaiJabatan");
$reqPegawaiJabatanFileId= $this->input->get("reqPegawaiJabatanFileId");

$set_upload= new PegawaiJabatan();
$set_upload->selectByParamsUpload(array("A.PEGAWAI_JABATAN_FILE_ID"=>$reqPegawaiJabatanFileId),-1,-1,$statement);
			//echo $set_upload->query;exit;
$set_upload->firstRow();
$tempLinkFile=$set_upload->getField("LINK_SERVER");
unset($set_upload);

//print_r($tempLinkFile);exit;

if(!empty($tempLinkFile))
{
	$pdf_content = file_get_contents($tempLinkFile );
	//Specify that the content has PDF Mime Type
	header("Content-Type: application/pdf");
	//Display it
	echo $pdf_content;
}
else
{
	echo "File Tidak Ditemukan";
}


?>

