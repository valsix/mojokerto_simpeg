<?
include_once("functions/personal.func.php");

$this->load->model("base-validasi/Pegawai");
$this->load->model("base/Core");
$this->load->library('globalfilepegawai');

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');
$p= $this->input->get('p');

$reqFileRowId= -1;

$statement= "";
$set= new Pegawai();
$infoperubahan= "Perubahan Data";
if(!empty($reqRowHapusId))
{
  $infoperubahan= "Hapus Data";
  $set->selectByPersonal(array(), -1, -1, $reqId, $reqRowHapusId, "", $statement);
}
else
  $set->selectByPersonal(array(), -1, -1, $reqId, $reqRowHapusId, $reqRowId, $statement);

// echo $set->query;exit;
$set->firstRow();
$reqTempValidasiId= $set->getField('TEMP_VALIDASI_ID');
$reqTempValidasiHapusId= $set->getField('TEMP_VALIDASI_HAPUS_ID');
$reqValidasi= $set->getField('VALIDASI');
$reqPerubahanData= $set->getField('PERUBAHAN_DATA');

$reqValRowId= $set->getField('PEGAWAI_ID');
if(empty($reqValRowId))
{
  $infoperubahan= "Data Baru";
}

$reqRowId= $set->getField('PEGAWAI_ID');
$reqNIP1= $set->getField('NIP_LAMA');$valNIP1= checkwarna($reqPerubahanData, 'NIP_LAMA');
$reqNIP2= $set->getField('NIP_BARU');
$reqNama= $set->getField('NAMA');
$reqTipePegawai= $set->getField('TIPE_PEGAWAI_ID');$valTipePegawai= checkwarna($reqPerubahanData, 'TIPE_PEGAWAI_ID');
$reqGelarDepan= $set->getField('GELAR_DEPAN');$valGelarDepan= checkwarna($reqPerubahanData, 'GELAR_DEPAN');
$reqGelarBelakang= $set->getField('GELAR_BELAKANG');$valGelarBelakang= checkwarna($reqPerubahanData, 'GELAR_BELAKANG');
$reqStatusPegawai= $set->getField('STATUS_PEGAWAI');$valStatusPegawai= checkwarna($reqPerubahanData, 'STATUS_PEGAWAI');
$reqTempatLahir= $set->getField('TEMPAT_LAHIR');$valTempatLahir= checkwarna($reqPerubahanData, 'TEMPAT_LAHIR');
$reqTanggalLahir= dateToPageCheck($set->getField('TANGGAL_LAHIR'));$valTanggalLahir= checkwarna($reqPerubahanData, 'TANGGAL_LAHIR', "date");
$reqTglPensiun= dateToPageCheck($set->getField('TANGGAL_PENSIUN'));$valTglPensiun= checkwarna($reqPerubahanData, 'TANGGAL_PENSIUN', "date");
$reqTglPindah= dateToPageCheck($set->getField('TANGGAL_PINDAH'));$valTglPindah= checkwarna($reqPerubahanData, 'TANGGAL_PINDAH', "date");
$reqKeteranganPindah= $set->getField('KETERANGAN_PINDAH');$valKeteranganPindah= checkwarna($reqPerubahanData, 'KETERANGAN_PINDAH');
$reqJenisPegawai= $set->getField('JENIS_PEGAWAI_ID');$valJenisPegawai= checkwarna($reqPerubahanData, 'JENIS_PEGAWAI_ID');
$reqKeterangan= $set->getField('KETERANGAN_PINDAH');$valKeterangan= checkwarna($reqPerubahanData, 'KETERANGAN_PINDAH');
$reqKartuPegawai= $set->getField('KARTU_PEGAWAI');$valKartuPegawai= checkwarna($reqPerubahanData, 'KARTU_PEGAWAI');
$reqSukuBangsa= $set->getField('SUKU_BANGSA');$valSukuBangsa= checkwarna($reqPerubahanData, 'SUKU_BANGSA');
$reqAkses= $set->getField('ASKES');$valAkses= checkwarna($reqPerubahanData, 'ASKES');
$reqTaspen= $set->getField('TASPEN');$valTaspen= checkwarna($reqPerubahanData, 'TASPEN');
$reqAlamat= $set->getField('ALAMAT');$valAlamat= checkwarna($reqPerubahanData, 'ALAMAT');
$reqNPWP= $set->getField('NPWP');$valNPWP= checkwarna($reqPerubahanData, 'NPWP');
$reqNIK= $set->getField('NIK');$valNIK= checkwarna($reqPerubahanData, 'NIK');
$reqRT= $set->getField('RT');$valRT= checkwarna($reqPerubahanData, 'RT');
$reqRW= $set->getField('RW');$valRW= checkwarna($reqPerubahanData, 'RW');
$reqEmail= $set->getField('EMAIL');$valEmail= checkwarna($reqPerubahanData, 'EMAIL');
$reqPropinsi= $set->getField('PROPINSI_ID');$valPropinsi= checkwarna($reqPerubahanData, 'PROPINSI_ID');
$reqKabupaten= $set->getField('KABUPATEN_ID');$valKabupaten= checkwarna($reqPerubahanData, 'KABUPATEN_ID');
$reqKecamatan= $set->getField('KECAMATAN_ID');$valKecamatan= checkwarna($reqPerubahanData, 'KECAMATAN_ID');
$reqDesa= $set->getField('KELURAHAN_ID');$valDesa= checkwarna($reqPerubahanData, 'KELURAHAN_ID');
$reqBank= $set->getField('BANK_ID');$valBank= checkwarna($reqPerubahanData, 'BANK_ID');
$reqNoRekening= $set->getField('NO_REKENING');$valNoRekening= checkwarna($reqPerubahanData, 'NO_REKENING');
$reqPangkatTerkahir= $set->getField('GOL_RUANG');$valPangkatTerkahir= checkwarna($reqPerubahanData, 'GOL_RUANG');
$reqTMTPangkat= $set->getField('TMT_PANGKAT');$valTMTPangkat= checkwarna($reqPerubahanData, 'TMT_PANGKAT');
$reqJabatanTerkahir= $set->getField('JABATAN');$valJabatanTerkahir= checkwarna($reqPerubahanData, 'JABATAN');
$reqTMTJabatan= $set->getField('TMT_JABATAN');$valTMTJabatan= checkwarna($reqPerubahanData, 'TMT_JABATAN');
$reqPendidikanTerakhir= $set->getField('PENDIDIKAN');$valPendidikanTerakhir= checkwarna($reqPerubahanData, 'PENDIDIKAN');
$reqJurusanTerakhir= $set->getField('JURUSAN');$valJurusanTerakhir= checkwarna($reqPerubahanData, 'JURUSAN');
$reqTahunLulus= $set->getField('TAHUN');$valTahunLulus= checkwarna($reqPerubahanData, 'TAHUN');
$reqGambar= $set->getField('FOTO_BLOB');$valGambar= checkwarna($reqPerubahanData, 'FOTO_BLOB');
$reqTelepon= $set->getField('TELEPON');$valTelepon= checkwarna($reqPerubahanData, 'TELEPON');
$reqKodePos= $set->getField('KODEPOS');$valKodePos= checkwarna($reqPerubahanData, 'KODEPOS');
$reqKedudukanId= $set->getField('KEDUDUKAN_ID');$valKedudukanId= checkwarna($reqPerubahanData, 'KEDUDUKAN_ID');
$reqSatkerNama= $set->getField('SATKER_FULL');$valSatkerNama= checkwarna($reqPerubahanData, 'SATKER_FULL');
$reqSatkerId= $set->getField('SATKER_ID');$valSatkerId= checkwarna($reqPerubahanData, 'SATKER_ID');
// print_r($valNoRekening);exit;
$reqNikPns= $set->getField('KTP_PNS');$valNikPns= checkwarna($reqPerubahanData, 'KTP_PNS');
$reqDrh= $set->getField('DRH');$valDrh= checkwarna($reqPerubahanData, 'DRH');
$reqNomorKK= $set->getField('KK');$valNomorKK= checkwarna($reqPerubahanData, 'KK');
$reqKtpPasangan= $set->getField('KTP_PASANGAN');$valKtpPasangan= checkwarna($reqPerubahanData, 'KTP_PASANGAN');
$reqTugasTambahan= $set->getField('TUGAS_TAMBAHAN_NEW');$valTugasTambahan= checkwarna($reqPerubahanData, 'TUGAS_TAMBAHAN_NEW');
$reqJenisMapelId= $set->getField('JENIS_MAPEL_ID');$valJenisMapelId= checkwarna($reqPerubahanData, 'JENIS_MAPEL_ID');
$data= $set->getField('FOTO_BLOB');$valdata= checkwarna($reqPerubahanData, 'FOTO_BLOB');
$data_karpeg= $set->getField('DOSIR_KARPEG');$valdata_karpeg= checkwarna($reqPerubahanData, 'DOSIR_KARPEG');
$data_askes= $set->getField('DOSIR_ASKES');$valdata_askes= checkwarna($reqPerubahanData, 'DOSIR_ASKES');
$data_taspen= $set->getField('DOSIR_TASPEN');$valdata_taspen= checkwarna($reqPerubahanData, 'DOSIR_TASPEN');
$data_npwp= $set->getField('DOSIR_NPWP');$valdata_npwp= checkwarna($reqPerubahanData, 'DOSIR_NPWP');

$reqGambar= $set->getField('FOTO_BLOB');
$reqGambarSetengah= $set->getField('FOTO_BLOB_OTHER');

$arrJenisKelamin= [];
$arrComboJenisKelamin= [];
$arrComboJenisKelamin= array(
	array("id"=>"L", "text"=>"Laki laki")
	, array("id"=>"P", "text"=>"Perempuan")
);
$reqJenisKelamin= $set->getField("JENIS_KELAMIN");
$valJenisKelamin= checkwarna($reqPerubahanData, 'JENIS_KELAMIN', $arrJenisKelamin, array("id", "text"));

$arrAgama= [];
$arrComboAgama= [];
$agama= new Core();
$agama->selectByParamsAgama(); 
while ($agama->nextRow()){
	array_push($arrComboAgama,array("id"=>$agama->getField('AGAMA_ID') , "text"=>$agama->getField('NAMA')));
}
$reqAgama= $set->getField('AGAMA_ID');
$valAgama= checkwarna($reqPerubahanData, 'AGAMA_ID', $arrAgama, array("id", "text"));

$arrStatusPernikahan= [];
$arrComboStatusPernikahan= [];
$arrComboStatusPernikahan= array(
	array("id"=>"1", "text"=>"Belum Kawin")
	, array("id"=>"2", "text"=>"Kawin")
	, array("id"=>"3", "text"=>"Janda")
	, array("id"=>"4", "text"=>"Duda")
);
$reqStatusPernikahan= $set->getField("STATUS_KAWIN");
$valStatusPernikahan= checkwarna($reqPerubahanData, 'STATUS_KAWIN', $arrStatusPernikahan, array("id", "text"));

$arrgoldarah= [];
$arrComboGoldar= [];
$arrComboGoldar= array(
	array("id"=>"A", "text"=>"A")
	, array("id"=>"B", "text"=>"B")
	, array("id"=>"AB", "text"=>"AB")
	, array("id"=>"O", "text"=>"O")

);
$reqGolDarah= str_replace(" ","",$set->getField('GOLONGAN_DARAH'));
$valGolonganDarah= checkwarna($reqPerubahanData, 'GOLONGAN_DARAH', $arrgoldarah, array("id", "text"));

$bank= new Core();
$bank->selectByParamsBank(); 

$tipepegawai= new Core();
$tipepegawai->selectByParamsTipePegawai(); 

$status_pegawai= new Core();
$status_pegawai->selectByParamsStatusPegawai(); 

$jenis_pegawai= new Core();
$jenis_pegawai->selectByParamsJenisPegawai(); 

$kedudukan= new Core();
$kedudukan->selectByParamsKedudukan(); 

$propinsi= new Core();
$propinsi->selectByParamsPropinsi(); 

$kabupaten= new Core();
$kabupaten->selectByParamsKabupaten(array('PROPINSI_ID'=>$reqPropinsi)); 

$kecamatan= new Core();
$kecamatan->selectByParamsKecamatan(array('PROPINSI_ID'=>$reqPropinsi, 'KABUPATEN_ID'=>$reqKabupaten)); 

$kelurahan= new Core();
$kelurahan->selectByParamsKelurahan(array('PROPINSI_ID'=>$reqPropinsi, 'KABUPATEN_ID'=>$reqKabupaten,'KECAMATAN_ID'=>$reqKecamatan)); 

// echo $reqTmtJabatan;exit;
// $reqMode="update";
$reqMode="insert";
$readonly = "";

if (!empty($reqId)) 
{
	$reqMode="update";
	$readonly = 'readonly style="background-color: #F3F6F9;"';
}

$arrsatkertree= $this->sesstree;
$arrsatkerdata= $this->sessdatatree;

// untuk kondisi file
$vfpeg= new globalfilepegawai();
$riwayattable= "PEGAWAI";
$reqDokumenKategoriFileId= "0"; // ambil dari table KATEGORI_FILE, cek sesuai mode
$arrsetriwayatfield= $vfpeg->setriwayatfield($riwayattable);
// print_r($arrsetriwayatfield);exit;

$arrparam= array("reqId"=>$reqId, "reqRowId"=>$reqFileRowId, "riwayattable"=>$riwayattable, "lihatquery"=>"");
$arrambilfile= $vfpeg->ambilfile($arrparam);
// print_r($arrambilfile);exit;

$keycari= $riwayattable.";".$reqFileRowId;

$infofile= 0;
if(!empty($arrambilfile))
{
	$infofile= count(in_array_column($keycari, "vkey", $arrambilfile));
}
// echo $infofile;exit;

// print_r($arrsatkertree);exit();
?>
<!-- <style type="text/css">
	   select[readonly].select2-hidden-accessible + .select2-container {
        pointer-events: none;
        touch-action: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
        background: #F3F6F9;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
        display: none;
    }

</style>
 -->
<!-- Bootstrap core CSS -->
<!-- <link href="lib/bootstrap-3.3.7/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="lib/bootstrap-3.3.7/docs/examples/navbar/navbar.css" rel="stylesheet">
<!-- <script src="lib/bootstrap-3.3.7/dist/js/bootstrap.min.js"></script> -->

<link href="assets/css/w3.css" rel="stylesheet" type="text/css" />


<link href="lib/select2totreemaster/src/select2totree.css" rel="stylesheet">
<script src="lib/select2/select2.min.js"></script>
<script src="lib/select2totreemaster/src/select2totree.js"></script>

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a class="" href="app/index/pegawai">Data Pegawai</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Identitas Pegawai</a>
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
                    <h3 class="card-label">Profil Pegawai</h3>
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

		        				$vkeydetil= $vriwayattable.";".$reqFileRowId.";".$riwayatfield;
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

	        		<div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">NIP</label>
			        			<div class="col-lg-4 col-sm-12">
			        				<input type="text" class="form-control" <?=$readonly?> name="reqNIP1" id="reqNIP1" value="<?=$reqNIP1?>" />
			        			</div>
			        			<label class="col-form-label ">/</label>
			        			<div class="col-lg-4 col-sm-12">
			        				<input type="text" class="form-control" <?=$readonly?> name="reqNIP2" id="reqNIP2" value="<?=$reqNIP2?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Nama</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" <?=$readonly?> name="reqNama" id="reqNama" value="<?=$reqNama?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
	        					<?
	        					$vpdata= $valGelarDepan['data'];
	        					$vpwarna= $valGelarDepan['warna'];
	        					?>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
			        				Gelar Depan
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
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" name="reqGelarDepan" id="reqGelarDepan" value="<?=$reqGelarDepan?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
	        					<?
	        					$vpdata= $valGelarBelakang['data'];
	        					$vpwarna= $valGelarBelakang['warna'];
	        					?>
	        					<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
	        						Gelar Belakang
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
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqGelarBelakang" id="reqGelarBelakang" value="<?=$reqGelarBelakang?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<?
	        					$vpdata= $valTempatLahir['data'];
	        					$vpwarna= $valTempatLahir['warna'];
	        					?>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
			        				Tempat Lahir
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
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqTempatLahir" id="reqTempatLahir" value="<?=$reqTempatLahir?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
	        					<?
	        					$vpdata= $valTanggalLahir['data'];
	        					$vpwarna= $valTanggalLahir['warna'];
	        					?>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
			        				Tanggal Lahir
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
			        			<div class="col-lg-9 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" autocomplete="off" class="form-control" id="kttanggallahir" name="reqTanggalLahir" value="<?=$reqTanggalLahir?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
			        	</div>
			        </div>


			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<?
	        					$vpdata= $valJenisKelamin['data'];
	        					$vpwarna= $valJenisKelamin['warna'];
	        					?>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
			        				Jenis Kelamin
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
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control" id='reqJenisKelamin' name='reqJenisKelamin'>
										<option value=""></option>
										<?
										foreach($arrComboJenisKelamin as $item) 
										{
											$selectvalid= $item["id"];
											$selectvaltext= $item["text"];
											?>
											<option value="<?=$selectvalid?>" <? if($reqJenisKelamin == $selectvalid) echo "selected";?>><?=$selectvaltext?></option>
											<?
										}
										?>
									</select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<?
	        					$vpdata= $valAgama['data'];
	        					$vpwarna= $valAgama['warna'];
	        					?>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
			        				Agama
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
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control"  id='reqAgama' name='reqAgama'>
			        					<option value=""></option>
										<?
										foreach($arrComboAgama as $item) 
										{
											$selectvalid= $item["id"];
											$selectvaltext= $item["text"];
											?>
											<option value="<?=$selectvalid?>" <? if($reqAgama == $selectvalid) echo "selected";?>><?=$selectvaltext?></option>
											<?
										}
										?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<?
	        					$vpdata= $valStatusPernikahan['data'];
	        					$vpwarna= $valStatusPernikahan['warna'];
	        					?>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
			        				Status Pernikahan
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
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control" id='reqStatusPernikahan' name='reqStatusPernikahan'>
			        					<option value=""></option>
										<?
										foreach($arrComboStatusPernikahan as $item) 
										{
											$selectvalid= $item["id"];
											$selectvaltext= $item["text"];
											?>
											<option value="<?=$selectvalid?>" <? if($reqStatusPernikahan == $selectvalid) echo "selected";?>><?=$selectvaltext?></option>
											<?
										}
										?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<?
	        					$vpdata= $valSukuBangsa['data'];
	        					$vpwarna= $valSukuBangsa['warna'];
	        					?>
	        					<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
	        						Suku Bangsa
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
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqSukuBangsa" id="reqSukuBangsa" value="<?=$reqSukuBangsa?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<?
	        					$vpdata= $valGolonganDarah['data'];
	        					$vpwarna= $valGolonganDarah['warna'];
	        					?>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
			        				Gol Darah
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
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control" id='reqGolDarah' name='reqGolDarah'>
			        					<option value=""></option>
										<?
										foreach($arrComboGoldar as $item) 
										{
											$selectvalid= $item["id"];
											$selectvaltext= $item["text"];
											?>
											<option value="<?=$selectvalid?>" <? if($reqGolDarah == $selectvalid) echo "selected";?>><?=$selectvaltext?></option>
											<?
										}
										?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
	        			<div class="col-md-6">
				        	<div class="form-group row">
				        		<?
	        					$vpdata= $valTelepon['data'];
	        					$vpwarna= $valTelepon['warna'];
	        					?>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
			        				Telpon
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
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqTelepon" id="reqTelepon" value="<?=$reqTelepon?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"/>
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<?
	        					$vpdata= $valEmail['data'];
	        					$vpwarna= $valEmail['warna'];
	        					?>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
			        				Email
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
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqEmail" id="reqEmail" value="<?=$reqEmail?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Pendidikan Terakhir</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" readonly style="background-color: #F3F6F9;" value="<?=$reqPendidikanTerakhir?> <?=$reqJurusanTerakhir?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
	        					<?
	        					$vpdata= $valAlamat['data'];
	        					$vpwarna= $valAlamat['warna'];
	        					?>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
			        				Alamat
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
			        			<div class="col-lg-9 col-sm-12">
			        				<textarea class="form-control" id='reqAlamat' name="reqAlamat"  style="height: 90px;"><?=$reqAlamat?></textarea>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<?
	        					$vpdata= $valRT['data'];
	        					$vpwarna= $valRT['warna'];
	        					?>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>" style="margin-bottom:20px ;">
			        				RT
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
			        			<div class="col-lg-3 col-sm-12">
			        				<input type="text" class="form-control"  name="reqRT" id="reqRT" value="<?=$reqRT?>" />
			        			</div>
			        			<?
	        					$vpdata= $valRW['data'];
	        					$vpwarna= $valRW['warna'];
	        					?>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
			        				RW
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
			        			<div class="col-lg-3 col-sm-12">
			        				<input type="text" class="form-control"  name="reqRW" id="reqRW" value="<?=$reqRW?>" />
			        			</div>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Kode Pos 
				        		</label>
				        		<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqKodePos" id="reqKodePos" value="<?=$reqKodePos?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Propinsi</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control" id='reqPropinsi' name='reqPropinsi'>
			        					<option value="" <?if($reqPropinsi=='') echo 'selected' ?> disabled></option>
										<?while($propinsi->nextRow())
										 {
										?>
											<option value="<?=$propinsi->getField('PROPINSI_ID')?>" <? if($propinsi->getField('PROPINSI_ID') == $reqPropinsi) echo 'selected' ?>>
					                        	<?=$propinsi->getField('NAMA')?>
					                        </option>
					                    <?
										 }
										 ?>

			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Kabupaten</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control" id='reqKabupaten' name='reqKabupaten'>
			        					<option value="" <?if($reqKabupaten=='') echo 'selected' ?> disabled></option>
										<?while($kabupaten->nextRow())
										 {
										?>
											<option value="<?=$kabupaten->getField('KABUPATEN_ID')?>" <? if($kabupaten->getField('KABUPATEN_ID') == $reqKabupaten) echo 'selected' ?>>
					                        	<?=$kabupaten->getField('NAMA')?>
					                        </option>
					                    <?
										 }
										 ?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Kecamatan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control" id="reqKecamatan" name="reqKecamatan">
			        					<option value="" <?if($reqKecamatan=='') echo 'selected' ?> disabled></option>
										<?while($kecamatan->nextRow())
										 {
										?>
											<option value="<?=$kecamatan->getField('KECAMATAN_ID')?>" <? if($kecamatan->getField('KECAMATAN_ID') == $reqKecamatan) echo 'selected' ?>>
					                        	<?=$kecamatan->getField('NAMA')?>
					                        </option>
					                    <?
										 }
										 ?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Desa</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control" id="reqKelurahan" name="reqDesa">
			        					<option value="" <?if($reqKelurahan=='') echo 'selected' ?> disabled></option>
										<?while($kelurahan->nextRow())
										 {
										?>
											<option value="<?=$kelurahan->getField('KELURAHAN_ID')?>" <? if($kelurahan->getField('KELURAHAN_ID') == $reqDesa) echo 'selected' ?>>
					                        	<?=$kelurahan->getField('NAMA')?>
					                        </option>
					                    <?
										 }
										 ?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Bank</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control" id="reqBank" name="reqBank">
			        					<option value="" <?if($reqBank=='') echo 'selected' ?> disabled>Pilih Bank</option>
										<?while($bank->nextRow())
										 {
										?>
											<option value="<?=$bank->getField('BANK_ID')?>" <? if($bank->getField('BANK_ID') == $reqBank) echo 'selected' ?>>
					                        	<?=$bank->getField('NAMA')?>
					                        </option>
					                    <?
										 }
										 ?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<?
	        					$vpdata= $valNoRekening['data'];
	        					$vpwarna= $valNoRekening['warna'];
	        					?>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12 <?=$vpwarna?>">
			        				Telpon
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
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">No Rekening</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqNoRekening" id="reqNoRekening" value="<?=$reqNoRekening?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Foto Seluruh Badan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="file" class="form-control"  name="reqGambar" id="reqGambar" value="<?=$reqGambar?>" accept="image/png, image/jpeg" />
			        				<input type="hidden" class="form-control"  name="reqLinkGambar" id="reqLinkGambar" value="<?=$reqGambar?>" />
			        			</div>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12"></label>
			        			<div class="col-lg-4 col-sm-12">
			        				<?if (file_exists($reqGambar)) {?>
				        				 <img src="<?=$reqGambar?>" width=150 height=200>
									<?}?>
			        			</div>
			        			<?if (file_exists($reqGambar)) {?>
			        			 <a style="margin-top: 170px" onclick='HapusGambar("gambar","<?=$reqId?>")'><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
			        			 <?}?>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Foto Setengah Badan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="file" class="form-control"  name="reqGambarSetengah" id="reqGambarSetengah" value="<?=$reqGambarSetengah?>"  accept="image/png, image/jpeg" />
			        				<input type="hidden" class="form-control"  name="reqLinkGambarSetengah" id="reqLinkGambarSetengah" value="<?=$reqGambarSetengah?>" />
			        			</div>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12"></label>
			        			<div class="col-lg-4 col-sm-12">
			        				<?if (file_exists($reqGambarSetengah)) {?>
				        				 <img src="<?=$reqGambarSetengah?>" width=150 height=200>
									<?}?>
			        			</div>
			        			<?if (file_exists($reqGambarSetengah)) {?>
			        			 <a style="margin-top: 170px" onclick='HapusGambar("setengah","<?=$reqId?>")'><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
			        			 <?}?>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Pangkat Terakhir</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqPangkatTerkahir" id="reqPangkatTerkahir" value="<?=$reqPangkatTerkahir?>" readonly style="background-color: #F3F6F9;" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Jabatan Terakhir</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqJabatanTerkahir" id="reqJabatanTerkahir" value="<?=$reqJabatanTerkahir?>" readonly style="background-color: #F3F6F9;" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Satuan Kerja</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<!-- <textarea  class="form-control" name="reqSatuanKerjaNama"  id="reqSatkerNama"></textarea> -->
			        				<!-- <input type="text" class="form-control" name="reqSatuanKerjaNama"  id="reqSatkerNama"> -->
			        				<select class="js-states form-control" id="reqSatkerId" name="reqSatkerId">
			                            <option value=""></option>
			                        </select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tipe Pegawai</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control" name="reqTipePegawai" id="reqTipePegawai" >
			        					<option value="" <?if($reqBank=='') echo 'selected' ?> disabled>Pilih Bank</option>
			        					
			        					<? while ($tipepegawai->nextRow()){?>
										<option value="<?=$tipepegawai->getField('TIPE_PEGAWAI_ID')?>"
										<? if ($tipepegawai->getField('TIPE_PEGAWAI_ID') == $reqTipePegawai) echo 'selected'?>>
										<?
										if($tipepegawai->getField('TIPE_PEGAWAI_ID_PARENT') == 0)  
											echo $tipepegawai->getField('TIPE_PEGAWAI_ID').'.'.$tipepegawai->getField('NAMA');
										else														
											echo substr($tipepegawai->getField('TIPE_PEGAWAI_ID'),0,1).'.'.substr($tipepegawai->getField('TIPE_PEGAWAI_ID'),1).'.'.$tipepegawai->getField('NAMA');
										?></option>
										<? } ?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tugas Tambahan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control" name="reqTugasTambahan" id="reqTugasTambahan">
			        					<option value="" <? if($reqTugasTambahan == "") echo 'selected'?> disabled>Pilih Tugas Tambahan</option>
										<option value="1" <? if($reqTugasTambahan == "1") echo 'selected'?>>Kepala Sekolah</option>
										<option value="2" <? if($reqTugasTambahan == "2") echo 'selected'?>>Kepala Puskesmas</option>
										<option value="3" <? if($reqTugasTambahan == "3") echo 'selected'?>>Sub Koordinator</option>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Status Pegawai
				        		</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control"  name = "reqStatusPegawai" id="reqStatusPegawai">
			        					<option value="" <? if($reqStatusPegawai == "") echo 'selected'?> disabled>Pilih Status Pegawai</option>
			        					<?
						                while($status_pegawai->nextRow())
										{
										?>
											<option value="<?=$status_pegawai->getField("STATUS_PEGAWAI_ID")?>" <? if($reqStatusPegawai == $status_pegawai->getField("STATUS_PEGAWAI_ID")) echo 'selected' ?>><?=$status_pegawai->getField("NAMA")?></option>
						                <?
										}
										?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tgl Pensiun</label>
			        			<div class="col-lg-9 col-sm-12">
				        			<div class="input-group date">
				        				<input type="text" autocomplete="off" class="form-control" id="kttanggallahir" name="reqTglPensiun" value="<?=$reqTglPensiun?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
				        		</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Jenis Pegawai</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control" name = "reqJenisPegawai" id="reqJenisPegawai">
			        					<option value="" <? if($reqJenisPegawai == "") echo 'selected'?> disabled>Pilih Jenis Pegawai</option>
			        					<? while ($jenis_pegawai->nextRow()){?>
					                        <option value="<?=$jenis_pegawai->getField('JENIS_PEGAWAI_ID')?>"
					                        <? if ($jenis_pegawai->getField('JENIS_PEGAWAI_ID') == $reqJenisPegawai) echo 'selected'?>>
					                        <?=$jenis_pegawai->getField('NAMA')?>
					                        </option>
										<? } ?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Kedudukan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="js-states form-control" name = "reqKedudukanId" id="reqKedudukanId">
			        					<option value="" <? if($reqKedudukanId == "") echo 'selected'?> disabled>Pilih Kedudukan</option>
			        					<? while ($kedudukan->nextRow()){?>
					                        <option value="<?=$kedudukan->getField('KEDUDUKAN_ID')?>"
					                        <? if ($kedudukan->getField('KEDUDUKAN_ID') == $reqKedudukanId) echo 'selected'?>>
					                        <?=$kedudukan->getField('NAMA')?>
					                        </option>
										<? } ?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Kartu Pegawai</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqKartuPegawai" id="reqKartuPegawai" value="<?=$reqKartuPegawai?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">BPJS</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqAkses" id="reqAkses" value="<?=$reqAkses?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Taspen</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqTaspen" id="reqTaspen" value="<?=$reqTaspen?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">NPWP</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqNPWP" id="reqNPWP" value="<?=$reqNPWP?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">NIK</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqNIK" id="reqNIK" value="<?=$reqNIK?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
			        	<div class="col-md-6">
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tahun Lulus</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqTahunLulus" id="reqTahunLulus" value="<?=$reqTahunLulus?>" readonly style="background-color: #F3F6F9;" />
			        			</div>
			        		</div>
	        			</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">KTP PNS</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqNikPns" id="reqNikPns" value="<?=$reqNikPns?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Nomor KK</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqNomorKK" id="reqNomorKK" value="<?=$reqNomorKK?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">KTP Pasangan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqKtpPasangan" id="reqKtpPasangan" value="<?=$reqKtpPasangan?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">TMT Pangkat</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" autocomplete="off" class="form-control" id="kttanggallahir" name="reqTMTPangkat" value="<?=$reqTMTPangkat?>" readonly style="background-color: #F3F6F9;" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">TMT Jabatan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" autocomplete="off" class="form-control" id="kttanggallahir" name="reqTMTJabatan" value="<?=$reqTMTJabatan?>" readonly style="background-color: #F3F6F9;" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
			        	</div>
			        </div>

	        		<div class="row">
	        			<div class="col-md-2" style="max-width: 11%;">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-12 col-sm-12">Daftar Riwayat Hidup</label>			        			
			        		</div>
			        	</div>
	        			<div class="col-md-10">
	        				<div class="col-lg-12 col-sm-12">
		        				<textarea class="form-control" id='reqDrh' name="reqDrh" style="height: 90px;"><?=$reqDrh?></textarea>
		        			</div>
			        	</div>
	        		</div>

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
	        					<input type="hidden" name="reqRowId" value="<?=$reqRowId?>" />
	        					<input type="hidden" name="p" value="<?=$p?>" />
	        					<input type="hidden" name="reqFileRowId" value="<?=$reqFileRowId?>" />
	        					<input type="hidden" name="reqId" value="<?=$reqId?>" />
	        					<button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
	        				</div>
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

        				$vkeydetil= $vriwayattable.";".$reqFileRowId.";".$riwayatfield;
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
	        </form>
        </div>
    </div>
</div>

<script type="text/javascript">

	$(function () {
		$("[rel=tooltip]").tooltip({ placement: 'right'});
		// $('[data-toggle="tooltip"]').tooltip()
	})

	// $('#ktagamaid').select2({
	// 	placeholder: "Pilih agama"
	// });

	// $('#ktsatuankerjad').select2({
	// 	placeholder: "Pilih Satuan Kerja"
	// });
	
	// $('#ktjeniskelamin').select2({
	// 	placeholder: "Pilih jenis kelamin"
	// });

	 function HapusGambar(reqMode,reqId) {
        $.messager.confirm('Konfirmasi',"Hapus Lampiran terpilih?",function(r){
            if (r){
                $.getJSON("json-validasi/pegawai_json/deletegambar?reqMode="+reqMode+"&reqId="+reqId,
                    function(data){
                    // console.log(data);return false;
                    $.messager.alert('Info', data.PESAN, 'info');                    
                    location.reload();
                });
            }
        }); 
    }

	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#kttanggallahir').datepicker({
		todayHighlight: true
		, autoclose: true
		, orientation: "bottom left"
		, clearBtn: true
		, format: 'dd-mm-yyyy'
		, templates: arrows
	});

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-validasi/pegawai_json/add";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNIP2: {
						validators: {
							notEmpty: {
								message: 'NIP harus diisi'
							},
						}
					},
					reqNama: {
						validators: {
							notEmpty: {
								message: 'Nama harus diisi'
							},
						}
					},
					reqAlamat: {
						validators: {
							notEmpty: {
								message: 'Alamat harus diisi'
							},
						}
					},
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
			        	// console.log(response); return false;
			        	// Swal.fire("Good job!", "You clicked the button!", "success");
			        	Swal.fire({
			        		text: response.message,
			        		icon: "success",
			        		buttonsStyling: false,
			        		confirmButtonText: "Ok",
			        		customClass: {
			        			confirmButton: "btn font-weight-bold btn-light-primary"
			        		}
			        	}).then(function() {
			        		vdetil= "";
			        		<?
			        		if(!empty($p))
			        		{
			        		?>
			        		vdetil= "&p=<?=$p?>";
			        		<?
			        		}
			        		?>
			        		document.location.href = "personal/index/pegawai_data_fip?reqId=<?=$reqId?>"+vdetil;
			        	});
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
		

		<?
	    if(empty($arrsatkertree))
	    {
	    ?>
	    arrsatkertree= [];
	    arrsatkerdata= [];
	    <?
	    }
	    else
	    {
	    ?>
	    arrsatkertree= JSON.parse('<?=JSON_encode($arrsatkertree)?>');
	    arrsatkerdata= JSON.parse('<?=JSON_encode($arrsatkerdata)?>');
	    <?
	    }
	    ?>

		$("#reqSatkerId").select2ToTree({treeData: {dataArr: arrsatkertree, dftVal:"<?=$reqSatkerId?>"}, maximumSelectionLength: 3, placeholder: 'Pilih salah satu data'});

	});

</script>

<script type="text/javascript">
	$(function(){
		$('#reqPropinsi').bind('change', function(ev) {
			var propinsi = $('#reqPropinsi').val();
			$.getJSON('json-main/lokasi_json/getKabupaten?reqPropinsiId='+propinsi, function (data) 
	        {
	            Result = data; //Use this data for further creation of your elements.
	            var items = "";
				items += "<option value='' disabled selected>Pilih Kabupaten</option>";
	            $.each(data, function (i, SingleElement) {

					items += "<option value='" + SingleElement.kabupaten_id + "'>" + SingleElement.kabupaten + "</option>";
	            });
				$("#reqKabupaten").html(items);
				// $.uniform.update("#reqKecamatan"); 
				// $.uniform.update("#reqKelurahan");             
	        });
		});
		$('#reqKabupaten').bind('change', function(ev) {
			var kabupaten = $('#reqKabupaten').val();
			//alert(kabupaten);
			$.getJSON('json-main/lokasi_json/getKecamatan?reqKabupatenId='+kabupaten, function (data) 
	        {
	            Result = data; //Use this data for further creation of your elements.
	            var items = "";
				items += "<option value='' disabled selected>Pilih Kecamatan</option>";
	            $.each(data, function (i, SingleElement) {
					items += "<option value='" + SingleElement.kecamatan_id + "'>" + SingleElement.kecamatan + "</option>";
					//alert(SingleElement.kecamatan);
	            });
				$("#reqKecamatan").html(items);
				$.uniform.update("#reqKecamatan");
				
				var items = "";			
				$("#reqKelurahan").html(items); 
				// $.uniform.update("#reqKelurahan"); 
	        });
		});
		$('#reqKecamatan').bind('change', function(ev) {
			//$("#reqKabupaten").reset(); 
			var kecamatan = $('#reqKecamatan').val();
			$.getJSON('json-main/lokasi_json/getKelurahan?reqKecamatanId='+kecamatan, function (data) 
	        {
	            Result = data; //Use this data for further creation of your elements.
	            var items = "";
				items += "<option value='' disabled selected>Pilih Desa</option>";
	            //items += "<option value=0> -- </option>";
	            $.each(data, function (i, SingleElement) {
					items += "<option value='" + SingleElement.kelurahan_id + "'>" + SingleElement.kelurahan + "</option>";
	            });
	            $("#reqKelurahan").html(items);
				// $.uniform.update("#reqKecamatan"); 

	        });
		});	
	})

	$("#reqPropinsi, #reqJenisKelamin, #reqAgama, #reqStatusPernikahan, #reqGolDarah, #reqKecamatan, #reqKabupaten, #reqKecamatan, #reqKelurahan, #reqTugasTambahan, #reqTipePegawai, #reqStatusPegawai, #reqJenisPegawai, #reqKedudukanId, #reqBank").select2({
    	placeholder: "Pilih salah satu data",
    	allowClear: true
  	});
</script>