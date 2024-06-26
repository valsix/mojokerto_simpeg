<?
include_once("functions/personal.func.php");

$this->load->model("base-validasi/RiwayatPangkat");
$this->load->model("base/Core");
$this->load->library('globalfilepegawai');

$adminusergroupid= $this->adminusergroupid;
$adminuserpegawaiid= $this->adminuserpegawaiid;

$menukhususadmin= "";
if($adminusergroupid == 1 && empty($adminuserpegawaiid))
{
    $menukhususadmin= "1";
}

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');
$hakvalidasi= $this->input->get('v');
$reqValId= $this->input->get('reqValId');
$cekquery= $this->input->get('c');

if(empty($menukhususadmin)) $hakvalidasi= "";

$vreturn= "personal/index/riwayat_pangkat?reqId=".$reqId;
$hakstatusvalidasi= ""; $arrstatusvalidasi= [];
if(!empty($hakvalidasi))
{
	$vreturn.= "&v=".$hakvalidasi;
	$arrstatusvalidasi= globalfilepegawai::vstatusvalidasi();
	if(!empty($hakvalidasi) && !empty($menukhususadmin))
	{
		$hakstatusvalidasi= "1";
	}
}

if($reqRowId == "baru") $reqRowId= -1;

$arrpangkat= [];
$pangkat= new Core();
$pangkat->selectByParamsPangkat(array());
while ($pangkat->nextRow()){
	array_push($arrpangkat,array("id"=>$pangkat->getField('PANGKAT_ID') , "text"=>$pangkat->getField('KODE')));
}

$arrpejabatpenetap= [];
$pejabatpenetap= new Core();
$pejabatpenetap->selectByParamsPejabatPenetap(array());
while ($pejabatpenetap->nextRow()){
	array_push($arrpejabatpenetap,array("id"=>$pejabatpenetap->getField('PEJABAT_PENETAP_ID') , "text"=>$pejabatpenetap->getField('JABATAN')));
}

$arrjeniskp= array(
	array("id"=>"1", "text"=>"Reguler")
	, array("id"=>"2", "text"=>"Pilihan (Struktural)")
	, array("id"=>"3", "text"=>"Anumerta")
	, array("id"=>"4", "text"=>"Pengabdian")
	, array("id"=>"5", "text"=>"SK lain-lain")
	, array("id"=>"6", "text"=>"Pilihan (Fungsional)")
);

$arrstlud= array(
	array("id"=>"1", "text"=>"Tingkat I")
	, array("id"=>"2", "text"=>"Tingkat II")
	, array("id"=>"3", "text"=>"Tingkat III")
);

// start tambahan untuk validasi
$statement= " AND A.PEGAWAI_ID = ".$reqId;
$set= new RiwayatPangkat();
$set->selectByPersonal(array(), -1, -1, $reqId, $reqRowId, $reqValId, $statement);
// echo $set->query;exit;
$set->firstRow();
$reqTempValidasiId= $set->getField('TEMP_VALIDASI_ID');
$reqTempValidasiHapusId= $set->getField('TEMP_VALIDASI_HAPUS_ID');
$reqValidasi= $set->getField('VALIDASI');
$reqPerubahanData= $set->getField('PERUBAHAN_DATA');
$reqValRowId= $set->getField('PANGKAT_RIWAYAT_ID');
$reqTable= "PANGKAT_RIWAYAT";

if(!empty($reqValidasi))
{
	redirect($vreturn);
}

$buttonsimpan= "1";
if( (empty($reqCheckPegawaiId) || !empty($reqValidasi) || !empty($reqTempValidasiHapusId)) && $reqId !== "baru")
{
  $buttonsimpan= "";
}
// end tambahan untuk validasi

$reqPANGKAT_RIWAYAT_ID= $set->getField('PANGKAT_RIWAYAT_ID');
$reqGolRuang= $set->getField('PANGKAT_ID'); $valGolRuang= checkwarna($reqPerubahanData, 'PANGKAT_ID', $arrpangkat, array("id", "text"), $reqTempValidasiHapusId);
$reqPjPenetap= $set->getField('PEJABAT_PENETAP_ID'); $valPjPenetap= checkwarna($reqPerubahanData, 'PEJABAT_PENETAP_ID', $arrpejabatpenetap, array("id", "text"), $reqTempValidasiHapusId);
$reqTglSTLUD= dateToPageCheck($set->getField('TANGGAL_STLUD')); $valTglSTLUD= checkwarna($reqPerubahanData, 'TANGGAL_STLUD', "date", array(), $reqTempValidasiHapusId);
$reqSTLUD= $set->getField('STLUD'); $valSTLUD= checkwarna($reqPerubahanData, 'STLUD', $arrstlud, array("id", "text"), $reqTempValidasiHapusId);
$reqNoSTLUD= $set->getField('NO_STLUD'); $valNoSTLUD= checkwarna($reqPerubahanData, 'NO_STLUD', "", array(), $reqTempValidasiHapusId);
$reqNoNota= $set->getField('NO_NOTA'); $valNoNota= checkwarna($reqPerubahanData, 'NO_NOTA', "", array(), $reqTempValidasiHapusId);
$reqNoSK = $set->getField('NO_SK'); $valNoSK= checkwarna($reqPerubahanData, 'NO_SK', "", array(), $reqTempValidasiHapusId);
$reqTh= $set->getField('MASA_KERJA_TAHUN'); $valTh= checkwarna($reqPerubahanData, 'MASA_KERJA_TAHUN', "", array(), $reqTempValidasiHapusId);
$reqBl= $set->getField('MASA_KERJA_BULAN'); $valBl= checkwarna($reqPerubahanData, 'MASA_KERJA_BULAN', "", array(), $reqTempValidasiHapusId);
$reqKredit= dotToComma($set->getField('KREDIT')); $valKredit= checkwarna($reqPerubahanData, 'KREDIT', "comaformat", array(), $reqTempValidasiHapusId);
$reqJenisKP= $set->getField('JENIS_KP'); $valJenisKP= checkwarna($reqPerubahanData, 'JENIS_KP', $arrjeniskp, array("id", "text"), $reqTempValidasiHapusId);

$reqKeterangan= $set->getField('KETERANGAN'); $valKeterangan= checkwarna($reqPerubahanData, 'KETERANGAN', "", array(), $reqTempValidasiHapusId);
$reqGajiPokok= $set->getField('GAJI_POKOK'); $valGajiPokok= checkwarna($reqPerubahanData, 'GAJI_POKOK', "numberformat", array(), $reqTempValidasiHapusId);
$reqTglNota= dateToPageCheck($set->getField('TANGGAL_NOTA')); $valTglNota= checkwarna($reqPerubahanData, 'TANGGAL_NOTA', "date", array(), $reqTempValidasiHapusId);
$reqTglSK= dateToPageCheck($set->getField('TANGGAL_SK')); $valTglSK= checkwarna($reqPerubahanData, 'TANGGAL_SK', "date", array(), $reqTempValidasiHapusId);
$reqTMTGol= dateToPageCheck($set->getField('TMT_PANGKAT')); $valTMTGol= checkwarna($reqPerubahanData, 'TMT_PANGKAT', "date", array(), $reqTempValidasiHapusId);


// $reqMode="insert";
$readonly = "readonly";

// untuk kondisi file
$vfpeg= new globalfilepegawai();
$riwayattable= "PANGKAT_RIWAYAT";
$reqDokumenKategoriFileId= "0"; // ambil dari table KATEGORI_FILE, cek sesuai mode
$arrsetriwayatfield= $vfpeg->setriwayatfield($riwayattable);
// print_r($arrsetriwayatfield);exit;

// start tambahan untuk validasi
$arrsetriwayatfield= [];
// end tambahan untuk validasi

$arrparam= array("reqId"=>$reqId, "reqRowId"=>$reqRowId, "riwayattable"=>$riwayattable, "lihatquery"=>"");
$arrambilfile= $vfpeg->ambilfile($arrparam);
// print_r($arrambilfile);exit;

$keycari= $riwayattable.";".$reqRowId;

$infofile= 0;
if(!empty($arrambilfile))
{
	$infofile= count(in_array_column($keycari, "vkey", $arrambilfile));
}
// echo $infofile;exit;
?>

<link href="assets/css/w3.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap core CSS -->
<!-- <link href="lib/bootstrap-3.3.7/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="lib/bootstrap-3.3.7/docs/examples/navbar/navbar.css" rel="stylesheet">
<!-- <script src="lib/bootstrap-3.3.7/dist/js/bootstrap.min.js"></script> -->

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a class="" href="app/index/pegawai">Data Pegawai</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="" href="<?=$vreturn?>">Riwayat Pangkat</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Halaman Input</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
    	<!-- <div class="area-menu-fip">
    		ffffj hai
    	</div> -->
        <div class="card card-custom">
        	<div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-notepad text-primary"></i>
                    </span>
                    <h3 class="card-label">Halaman Input</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">

	        		<?
	        		if($infofile > 0)
	        		{
	        		?>
	        		<div class="w3-bar w3-black">
					    <a class="w3-bar-item w3-button tablink w3-red" onclick="opennewtab(event,'vformdata')">Data</a>
					    <?
			              	// area untuk upload file
		        			foreach ($arrsetriwayatfield as $key => $value)
		        			{
		        				$riwayatfield= $value["riwayatfield"];
		        				$vriwayattable= $value["vriwayattable"];
		        				$infolabel= $value["infolabel"];

		        				$vkeydetil= $vriwayattable.";".$reqRowId.";".$riwayatfield;
		        		?>
					    	<a class="w3-bar-item w3-button tablink" onclick="opennewtab(event, '<?=$vkeydetil?>')"><?=$infolabel?></a>
					    <?
							}
					    ?>
					</div>
					<?
					}
					?>

					<?
	        		if($infofile > 0)
	        		{
	        		?>
	        		<div id="vformdata" class="w3-container w3-border city">
	        		<?
	        		}
	        		?>
		        		<div class="form-group row">
		        			<?
        					$vpdata= $valSTLUD['data'];
        					$vpwarna= $valSTLUD['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
			        			STLUD
			        			<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
			        		</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<div class="input-group date">
			        				<select class="form-control"  name="reqSTLUD" id='reqSTLUD'>
										<option></option>
					                    <option value="1" <? if($reqSTLUD == 1) echo 'selected'?>>Tingkat I</option>
					                    <option value="2" <? if($reqSTLUD == 2) echo 'selected'?>>Tingkat II</option>
					                    <option value="3" <? if($reqSTLUD == 3) echo 'selected'?>>Tingkat III</option>
									</select>
			        			</div>
		        			</div>
		        			<?
        					$vpdata= $valNoSTLUD['data'];
        					$vpwarna= $valNoSTLUD['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
			        			No. STLUD
			        			<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
			        		</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<input type="text" class="form-control" name="reqNoSTLUD" id="reqNoSTLUD" value="<?=$reqNoSTLUD?>" />
		        			</div>
		        			<?
        					$vpdata= $valTglSTLUD['data'];
        					$vpwarna= $valTglSTLUD['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
			        			Tgl. STLUD
			        			<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
			        		</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<div class="input-group date">
		        					<input type="text" autocomplete="off" class="form-control" id="reqTglSTLUD" name="reqTglSTLUD" value="<?=$reqTglSTLUD?>" />
			        				<div class="input-group-append">
			        					<span class="input-group-text">
			        						<i class="la la-calendar"></i>
			        					</span>
			        				</div>
			        			</div>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<?
        					$vpdata= $valGolRuang['data'];
        					$vpwarna= $valGolRuang['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
			        			Gol/Ruang
			        			<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<select name="reqGolRuang" id="reqGolRuang"  class="form-control">
		        					<option value="" <? if($reqGolRuang == '') echo 'selected';?> disabled> Pilih Gol/Ruang</option>
		        					<?
									foreach($arrpangkat as $item) 
									{
										$selectvalid= $item["id"];
										$selectvaltext= $item["text"];
									?>
										<option value="<?=$selectvalid?>" <? if($reqGolRuang == $selectvalid) echo "selected";?>><?=$selectvaltext?></option>
									<?
									}
									?>
				                </select>
		        			</div>
		        			<?
        					$vpdata= $valTMTGol['data'];
        					$vpwarna= $valTMTGol['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
			        			TMT Gol
			        			<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="input-group date">
		        					<input type="text" autocomplete="off" class="form-control" id="reqTMTGol" name="reqTMTGol" value="<?=$reqTMTGol?>" />
			        				<div class="input-group-append">
			        					<span class="input-group-text">
			        						<i class="la la-calendar"></i>
			        					</span>
			        				</div>
			        			</div>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<?
        					$vpdata= $valNoNota['data'];
        					$vpwarna= $valNoNota['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
			        			No Nota
			        			<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<input type="text" class="form-control" name="reqNoNota" id="reqNoNota" value="<?=$reqNoNota?>" />
		        			</div>
		        			<?
        					$vpdata= $valTglNota['data'];
        					$vpwarna= $valTglNota['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
			        			Tgl Nota
			        			<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="input-group date">
		        					<input type="text" autocomplete="off" class="form-control" id="reqTglNota" name="reqTglNota" value="<?=$reqTglNota?>" />
			        				<div class="input-group-append">
			        					<span class="input-group-text">
			        						<i class="la la-calendar"></i>
			        					</span>
			        				</div>
			        			</div>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<?
        					$vpdata= $valNoSK['data'];
        					$vpwarna= $valNoSK['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
		        				No SK
		        				<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
		        			</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<input type="text" class="form-control" name="reqNoSK" id="reqNoSK" value="<?=$reqNoSK?>" />
		        			</div>
		        			<?
        					$vpdata= $valTglSK['data'];
        					$vpwarna= $valTglSK['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
			        			Tgl SK
			        			<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="input-group date">
		        					<input type="text" autocomplete="off" class="form-control" id="reqTglSK" name="reqTglSK" value="<?=$reqTglSK?>" />
			        				<div class="input-group-append">
			        					<span class="input-group-text">
			        						<i class="la la-calendar"></i>
			        					</span>
			        				</div>
			        			</div>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<?
        					$vpdata= $valPjPenetap['data'];
        					$vpwarna= $valPjPenetap['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
			        			Pj Penetap
			        			<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<select name="reqPjPenetap" id="reqPjPenetap"  class="form-control">
		        					<option value="" <? if($reqPjPenetap == '') echo 'selected';?> disabled> Pilih Pj Penetap</option>
		        					<?
									foreach($arrpejabatpenetap as $item) 
									{
										$selectvalid= $item["id"];
										$selectvaltext= $item["text"];
									?>
										<option value="<?=$selectvalid?>" <? if($reqPjPenetap == $selectvalid) echo "selected";?>><?=$selectvaltext?></option>
									<?
									}
									?>
				                </select>
		        			</div>
		        			<?
        					$vpdata= $valJenisKP['data'];
        					$vpwarna= $valJenisKP['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
			        			Jenis KP
			        			<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<select name="reqJenisKP" id="reqJenisKP"  class="form-control">
				                   	<option value=""<? if($reqJenisKP == '') echo 'selected'?>>Pilih</option>
				                   	<?
									foreach($arrjeniskp as $item) 
									{
										$selectvalid= $item["id"];
										$selectvaltext= $item["text"];
									?>
										<option value="<?=$selectvalid?>" <? if($reqJenisKP == $selectvalid) echo "selected";?>><?=$selectvaltext?></option>
									<?
									}
									?>
								</select>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<?
        					$vpdata= $valKredit['data'];
        					$vpwarna= $valKredit['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
			        			Kredit
			        			<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
			        		</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<input placeholder="" type="text" id="reqKredit" name="reqKredit" <?=$read?> class="form-control" value="<?=$reqKredit?>" onkeypress='kreditvalidate(event, this)' />
		        			</div>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="row">
		        					<?
		        					$vpdata= $valTh['data'];
		        					$vpwarnath= $valTh['warna'];
		        					$vpwarnabl= $valBl['warna'];
		        					?>
				        			<label class="col-form-label text-right col-lg-4 col-sm-12 <?=$vpwarnath?> <?=$vpwarnabl?>">
					        			Masa Kerja
					        			<?
				        				if(!empty($vpdata))
				        				{
				        				?>
				        				<a class="tooltipe" href="javascript:void(0)">
				        					<i class="fa fa-question-circle text-white"></i><span class="classic">Th <?=$vpdata?></span>
				        				</a>
				        				<?
				        				}
				        				?>

				        				<?
			        					$vpdata= $valBl['data'];
				        				if(!empty($vpdata))
				        				{
				        				?>
				        				<a class="tooltipe" href="javascript:void(0)">
				        					<i class="fa fa-question-circle text-white"></i><span class="classic">Bl <?=$vpdata?></span>
				        				</a>
				        				<?
				        				}
				        				?>
					        		</label>
				        			<div class="col-lg-3 col-sm-12">
				        				<input type="text" class="form-control angkavalsix" name="reqTh" id="reqTh" value="<?=$reqTh?>" />
				        			</div>
				        			
				        			<label class="col-form-label">Thn</label>
				        			<div class="col-lg-3 col-sm-12">
				        				<input type="text" class="form-control angkavalsix" name="reqBl" id="reqBl" value="<?=$reqBl?>" />
				        			</div>
				        			<label class="col-form-label">Bln</label>
				        		</div>	        			
		        			</div>
		        			<?
        					$vpdata= $valGajiPokok['data'];
        					$vpwarna= $valGajiPokok['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
			        			Gaji Pokok
			        			<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
			        		</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<input type="text" placeholder class="form-control" id="reqGajiPokok" name="reqGajiPokok" OnFocus="FormatAngka('reqGajiPokok')" OnKeyUp="FormatUang('reqGajiPokok')" OnBlur="FormatUang('reqGajiPokok')" value="<?=numberToIna($reqGajiPokok)?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<?
        					$vpdata= $valKeterangan['data'];
        					$vpwarna= $valKeterangan['warna'];
        					?>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12 <?=$vpwarna?>">
			        			Keterangan
			        			<?
		        				if(!empty($vpdata))
		        				{
		        				?>
		        				<a class="tooltipe" href="javascript:void(0)">
		        					<i class="fa fa-question-circle text-white"></i><span class="classic"><?=$vpdata?></span>
		        				</a>
		        				<?
		        				}
		        				?>
			        		</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<textarea class="form-control" id='reqKeterangan' name="reqKeterangan"><?=$reqKeterangan?></textarea>
		        			</div>
		        		</div>

		        		<?
		        		if(!empty($hakstatusvalidasi))
		        		{
		        		?>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Status Validasi
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<select class="form-control" name="reqStatusValidasi" id='reqStatusValidasi'>
		        					<option></option>
		        					<?
		        					foreach($arrstatusvalidasi as $item) 
		        					{
		        						$selectvalid= $item["id"];
		        						$selectvaltext= $item["text"];
		        					?>
		        						<option value="<?=$selectvalid?>" <? if($reqStatusValidasi == $selectvalid) echo "selected";?>><?=$selectvaltext?></option>
		        					<?
		        					}
		        					?>
		        				</select>
		        			</div>
		        		</div>
		        		<!--  -->
		        		<?
		        		}
		        		?>

		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12"></label>
		        			<?
			              	// area untuk upload file
		        			foreach ($arrsetriwayatfield as $key => $value)
		        			{
		        				$riwayatfield= $value["riwayatfield"];
		        				$riwayatfieldtipe= $value["riwayatfieldtipe"];
		        				$vriwayatfieldinfo= $value["riwayatfieldinfo"];
		        				$riwayatfieldinfo= " - ".$vriwayatfieldinfo;
		        				$riwayatfieldrequired= $value["riwayatfieldrequired"];
		        				$riwayatfieldrequiredinfo= $value["riwayatfieldrequiredinfo"];
		        				$vriwayattable= $value["vriwayattable"];
		        				$vlabelupload= $value["labelupload"];
		        				$vriwayatid= "";
		        				$vpegawairowfile= $reqDokumenKategoriFileId."-".$vriwayattable."-".$riwayatfield."-".$vriwayatid;
		        			?>

		        			<input type="hidden" id="reqDokumenRequired<?=$riwayatfield?>" name="reqDokumenRequired[]" value="<?=$riwayatfieldrequired?>" />
		        			<input type="hidden" id="reqDokumenRequiredNama<?=$riwayatfield?>" name="reqDokumenRequiredNama[]" value="<?=$vriwayatfieldinfo?>" />
		        			<input type="hidden" id="reqDokumenRequiredTable<?=$riwayatfield?>" name="reqDokumenRequiredTable[]" value="<?=$vriwayattable?>" />
		        			<input type="hidden" id="reqDokumenRequiredTableRow<?=$riwayatfield?>" name="reqDokumenRequiredTableRow[]" value="<?=$vpegawairowfile?>" />
		        			<input type="hidden" id="reqDokumenFileId<?=$riwayatfield?>" name="reqDokumenFileId[]" />
		        			<input type="hidden" id="reqDokumenKategoriFileId<?=$riwayatfield?>" name="reqDokumenKategoriFileId[]" value="<?=$reqDokumenKategoriFileId?>" />
		        			<input type="hidden" id="reqDokumenKategoriField<?=$riwayatfield?>" name="reqDokumenKategoriField[]" value="<?=$riwayatfield?>" />
		        			<input type="hidden" id="reqDokumenPath<?=$riwayatfield?>" name="reqDokumenPath[]" value="" />
		        			<input type="hidden" id="reqDokumenTipe<?=$riwayatfield?>" name="reqDokumenTipe[]" value="<?=$riwayatfieldtipe?>" />

		        			<input type="hidden" id="reqDokumenIndexId<?=$riwayatfield?>" name="reqDokumenIndexId[]" value="" />
		        			<input type="hidden" id="reqDokumenPilih<?=$riwayatfield?>" name="reqDokumenPilih[]" value="1" />
		        			<input type="hidden" id="reqDokumenFileKualitasId<?=$riwayatfield?>" name="reqDokumenFileKualitasId[]" value="1" />

		        			<div class="col-form-label col-lg-2 col-sm-12">
		        				<label class="labelupload">
		        					<i class="mdi-file-file-upload" style="font-family: "Roboto",sans-serif,Material-Design-Icons !important; font-size: 14px !important;"><?=$vlabelupload?></i>
		        					<input id="file_input_file" name="reqLinkFile[]" class="none" type="file" />
		        				</label>
		        			</div>
		        			<?
		        			}
		        			?>
		        		</div>

		        		<div class="card-footer">
			        		<div class="row">
			        			<div class="col-lg-9">
			        				<input type="hidden" name="reqMode" value="<?=$reqMode?>" />
			        				<input type="hidden" name="reqPegawaiId" value="<?=$reqId?>">
			        				<input type="hidden" name="reqTempValidasiId" value="<?=$reqTempValidasiId?>" />
			        				<input type="hidden" name="reqTempValidasiHapusId" value="<?=$reqTempValidasiHapusId?>" />
			        				<input type="hidden" name="reqTable" value="<?=$reqTable?>" />
			        				<input type="hidden" name="reqRowId" value="<?=$reqRowId?>" />
			        				<input type="hidden" name="p" value="<?=$p?>" />
			        				<input type="hidden" name="reqFileRowId" value="<?=$reqFileRowId?>" />
			        				<input type="hidden" name="reqId" value="<?=$reqId?>" />
			        				<input type="hidden" name="cekquery" value="<?=$cekquery?>" />

			        				<?
			        				if( empty($reqTempValidasiHapusId) || (empty($reqTempValidasiId) && !empty($reqTempValidasiHapusId)) )
			        				{
			        				?>
			        					<button type="submit" id="ktloginformsubmitbutton" class="btn btn-light-success"><i class="fa fa-save" aria-hidden="true"></i> Simpan</button>
			        				<?
			        				}
			        				if(!empty($reqTempValidasiId) && empty($hakstatusvalidasi))
			        				{
			        				?>
			        					<button class="btn btn-danger" type="button" onclick="hapusdata('<?=$reqTempValidasiId?>', 'pangkat_riwayat', '', '<?=$vreturn?>')"><i class="fa fa-close" aria-hidden="true"></i> Batal</button>
			        				<?
			        				}
			        				if(!empty($reqTempValidasiHapusId) && empty($hakstatusvalidasi))
			        				{
			        				?>
			        					<button class="btn btn-danger" type="button" onclick="hapusdata('<?=$reqTempValidasiHapusId?>', 'pangkat_riwayat', '2', '<?=$vreturn?>')"><i class="fa fa-close" aria-hidden="true"></i> Batal</button>
			        				<?
			        				}
			        				?>

			        			</div>
			        		</div>
			        	</div>
			        <?
	        		if($infofile > 0)
	        		{
	        		?>
			        </div>
			        <?
			    	}
			        ?>

			        <?
	              	// area untuk upload file
        			foreach ($arrsetriwayatfield as $key => $value)
        			{
        				$riwayatfield= $value["riwayatfield"];
        				$vriwayattable= $value["vriwayattable"];
        				$infolabel= $value["infolabel"];

        				$vkeydetil= $vriwayattable.";".$reqRowId.";".$riwayatfield;
        				$arrcheck= in_array_column($vkeydetil, "vkeydetil", $arrambilfile);

        				$vframeiframe= $arrambilfile[$arrcheck[0]]["vurl"];
        				// $vframeiframe= base_url()."uploads/196212261989032006/fwniFj40ec20240514.pdf";
	        		?>
			        <div id="<?=$vkeydetil?>" class="w3-container w3-border city" style="display:none">
					    <div class="card-title">
		                    <?
		                    if(empty($vframeiframe))
		                    {
		                    ?>
		                    <h3 class="card-label">Belum ada file</h3>
		                    <?
		                    }
		                    else
		                    {
		                    ?>
		                    <iframe id="infonewframe" style="width: 100%; height: 100vh" src="<?=$vframeiframe?>"></iframe>
		                    <?
		                	}
		                    ?>
		                </div>
					</div>
					<?
					}
					?>

	        	</div>
	        </form>
        </div>
    </div>
</div>

<script type="text/javascript">

	$(function () {
		$("[rel=tooltip]").tooltip({ placement: 'right'});
		// $('[data-toggle="tooltip"]').tooltip()
	})

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-validasi/riwayat_pangkat_json/add";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNoSK: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqTglSK: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					<?
					if(!empty($hakstatusvalidasi))
					{
					?>
					reqStatusValidasi: {
						validators: {
							notEmpty: {
								message: 'Statu Validasi ini harus diisi'
							},
						}
					},
					<?
					}
					?>
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					submitButton: new FormValidation.plugins.SubmitButton(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
			)
		.on('core.form.valid', function() {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				var formData = new FormData(document.querySelector('form'));
				$.ajax({
					url: formSubmitUrl,
					data: formData,
					processData: false,
					contentType: false,
					type: 'POST',
					dataType: 'json',
					success: function (response) {
						<?
						if(!empty($cekquery))
						{
						?>
			        	console.log(response); return false;
						<?
						}
						?>
			        	data= response.message;
			        	data= data.split("-");
			        	rowid= data[0];
			        	infodata= data[1];

			        	if(rowid == "xxx")
                        {
                            Swal.fire("Error", infodata, "error");
                        }
                        else
                        {
                            Swal.fire({
                                text: infodata,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function() {
			        			document.location.href = "<?=$vreturn?>";
                                // window.location.reload();
                            });
                        }
			        },
			        error: function(xhr, status, error) {
			        	var err = JSON.parse(xhr.responseText);
			        	Swal.fire("Error", err.message, "error");
			        },
			        complete: function () {
			        	KTUtil.btnRelease(formSubmitButton);
			        }
			    });
			})
		.on('core.form.invalid', function() {
			Swal.fire({
				text: "Maaf, isi semua form yang disediakan, silahkan coba lagi.",
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Ok, saya mengerti",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			}).then(function() {
				KTUtil.scrollTop();
			});
		});
	});

	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#reqTglSTLUD,#reqTglNota,#reqTglSK,#reqTMTGol').datepicker({
		todayHighlight: true
		, autoclose: true
		, orientation: "bottom left"
		, clearBtn: true
		, format: 'dd-mm-yyyy'
		, templates: arrows
	});

	$("#reqSTLUD, #reqGolRuang, #reqPjPenetap, #reqJenisKP").select2({
    	placeholder: "Pilih salah satu data",
    	allowClear: true
  	});

</script>