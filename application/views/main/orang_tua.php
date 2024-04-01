<?
include_once("functions/personal.func.php");

$this->load->model("base/Pegawai");
$this->load->model("base/Core");

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$reqId= $this->input->get('reqId');

$pegawai= new Pegawai();
$pegawai->selectByParams(array("p.PEGAWAI_ID" => $reqId)); 
$pegawai->firstRow();
// echo $pegawai->query; exit;

$reqNIP1				= $pegawai->getField('NIP_LAMA');
$reqNIP2				= $pegawai->getField('NIP_BARU');
$reqNama				= $pegawai->getField('NAMA');
$reqTipePegawai		= $pegawai->getField('TIPE_PEGAWAI_ID');
$reqGelarDepan			= $pegawai->getField('GELAR_DEPAN');
$reqGelarBelakang		= $pegawai->getField('GELAR_BELAKANG');
$reqStatusPegawai		= $pegawai->getField('STATUS_PEGAWAI');
$reqTempatLahir		= $pegawai->getField('TEMPAT_LAHIR');
$reqTanggalLahir		= dateToPageCheck($pegawai->getField('TANGGAL_LAHIR'));
$reqTglPensiun			= dateToPageCheck($pegawai->getField('TANGGAL_PENSIUN'));
$reqTglPindah			= dateToPageCheck($pegawai->getField('TANGGAL_PINDAH'));
$reqKeteranganPindah	= $pegawai->getField('KETERANGAN_PINDAH');
$reqJenisKelamin		= $pegawai->getField('JENIS_KELAMIN');
$reqJenisPegawai		= $pegawai->getField('JENIS_PEGAWAI_ID');
$reqKeterangan			= $pegawai->getField('KETERANGAN_PINDAH');
$reqStatusPernikahan	= $pegawai->getField('STATUS_KAWIN');
$reqKartuPegawai		= $pegawai->getField('KARTU_PEGAWAI');
$reqSukuBangsa			= $pegawai->getField('SUKU_BANGSA');
$reqGolDarah			= $pegawai->getField('GOLONGAN_DARAH');
$reqAkses				= $pegawai->getField('ASKES');
$reqTaspen				= $pegawai->getField('TASPEN');
$reqAlamat				= $pegawai->getField('ALAMAT');
$reqNPWP				= $pegawai->getField('NPWP');
$reqNIK				= $pegawai->getField('NIK');
$reqRT					= $pegawai->getField('RT');
$reqRW					= $pegawai->getField('RW');
$reqEmail				= $pegawai->getField('EMAIL');
$reqPropinsi			= $pegawai->getField('PROPINSI_ID');
$reqKabupaten			= $pegawai->getField('KABUPATEN_ID');
$reqKecamatan			= $pegawai->getField('KECAMATAN_ID');
$reqDesa				= $pegawai->getField('KELURAHAN_ID');
$reqBank				= $pegawai->getField('BANK_ID');
$reqNoRekening			= $pegawai->getField('NO_REKENING');
$reqPangkatTerkahir	= $pegawai->getField('GOL_RUANG');
$reqTMTPangkat			= $pegawai->getField('TMT_PANGKAT');
$reqJabatanTerkahir	= $pegawai->getField('JABATAN');
$reqTMTJabatan			= $pegawai->getField('TMT_JABATAN');
$reqPendidikanTerakhir	= $pegawai->getField('PENDIDIKAN');
$reqJurusanTerakhir	= $pegawai->getField('JURUSAN');
$reqTahunLulus			= $pegawai->getField('TAHUN');
$reqGambar				= $pegawai->getField('FOTO_BLOB');
$reqAgamaId			= $pegawai->getField('AGAMA_ID');
$reqTelepon			= $pegawai->getField('TELEPON');
$reqKodePos			= $pegawai->getField('KODEPOS');
$reqKedudukanId		= $pegawai->getField('KEDUDUKAN_ID');
$reqSatkerId		= $pegawai->getField('SATKER_FULL');

$reqNikPns				= $pegawai->getField('KTP_PNS');
$reqDrh				= $pegawai->getField('DRH');
$reqNomorKK				= $pegawai->getField('KK');
$reqKtpPasangan				= $pegawai->getField('KTP_PASANGAN');
$reqTugasTambahan			= $pegawai->getField('TUGAS_TAMBAHAN_NEW');
$reqJenisMapelId			= $pegawai->getField('JENIS_MAPEL_ID');
$data = $pegawai->getField('FOTO_BLOB');
$data_karpeg= $pegawai->getField('DOSIR_KARPEG');
$data_askes= $pegawai->getField('DOSIR_ASKES');
$data_taspen= $pegawai->getField('DOSIR_TASPEN');
$data_npwp= $pegawai->getField('DOSIR_NPWP');
			
$reqGambarTmp   		= $pegawai->getField('FOTO_BLOB');
$reqGambarSetengah		= $pegawai->getField('FOTO_BLOB_OTHER');
$reqGambarTmpSetengah	= $pegawai->getField('FOTO_BLOB_OTHER');


$agama= new Core();
$agama->selectByParamsAgama(); 

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

$kabupaten= new Core();

$kecamatan= new Core();

$kelurahan= new Core();

// echo $reqTmtJabatan;exit;
$reqMode="update";
// $reqMode="insert";
$readonly = "readonly";
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
	        		<div class="row">
	        			<div class="col-md-6">
	        				<div class="card-title">
			                    <h3 class="card-label">Profil Ayah</h3>
			                </div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="card-title">
			                    <h3 class="card-label">Profil Ibu</h3>
			                </div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Nama</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqGelarDepan" id="reqGelarDepan" value="<?=$reqGelarDepan?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Nama</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqGelarBelakang" id="reqGelarBelakang" value="<?=$reqGelarBelakang?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Tempat Lahir
				        		</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqTempatLahir" id="reqTempatLahir" value="<?=$reqTempatLahir?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Tempat Lahir
				        		</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqTempatLahir" id="reqTempatLahir" value="<?=$reqTempatLahir?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Tanggal Lahir
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
			        	
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Tanggal Lahir
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
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Usia</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqGelarDepan" id="reqGelarDepan" value="<?=$reqGelarDepan?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Usia</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqGelarBelakang" id="reqGelarBelakang" value="<?=$reqGelarBelakang?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Pekerjaan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqGelarDepan" id="reqGelarDepan" value="<?=$reqGelarDepan?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Pekerjaan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqGelarBelakang" id="reqGelarBelakang" value="<?=$reqGelarBelakang?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Alamat</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<textarea class="form-control"  name="reqGelarBelakang" id="reqGelarBelakang" ></textarea>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Alamat</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<textarea class="form-control"  name="reqGelarBelakang" id="reqGelarBelakang" ></textarea>
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Propinsi</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id='reqPropinsi' name='reqPropinsi'>
			        					<option value="" <?if($reqPropinsi=='') echo 'selected' ?> disabled></option>
										<?
										$propinsi->selectByParamsPropinsi(); 
										while($propinsi->nextRow())
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
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Propinsi</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id='reqPropinsiIbu' name='reqPropinsi'>
			        					<option value="" <?if($reqPropinsi=='') echo 'selected' ?> disabled></option>
										<?
										$propinsi->selectByParamsPropinsi();
										while($propinsi->nextRow())
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
			        </div>

			        <div class="row">
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Kabupaten</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id='reqKabupaten' name='reqKabupaten'>
			        					<option value="" <?if($reqKabupaten=='') echo 'selected' ?> disabled></option>
										<?
										$kabupaten->selectByParamsKabupaten(array('PROPINSI_ID'=>$reqPropinsi)); 
										while($kabupaten->nextRow())
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
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Kabupaten</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id='reqKabupaten' name='reqKabupaten'>
			        					<option value="" <?if($reqKabupaten=='') echo 'selected' ?> disabled></option>
										<?
										$kabupaten->selectByParamsKabupaten(array('PROPINSI_ID'=>$reqPropinsi)); 
										while($kabupaten->nextRow())
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
			        				<select class="form-control" id="reqKecamatan" name="reqKecamatan">
			        					<option value="" <?if($reqKecamatan=='') echo 'selected' ?> disabled></option>
										<?
										$kecamatan->selectByParamsKecamatan(array('PROPINSI_ID'=>$reqPropinsi, 'KABUPATEN_ID'=>$reqKabupaten)); 
										while($kecamatan->nextRow())
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
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Kecamatan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id="reqKecamatanIbu" name="reqKecamatan">
			        					<option value="" <?if($reqKecamatan=='') echo 'selected' ?> disabled></option>
										<?
										$kecamatan->selectByParamsKecamatan(array('PROPINSI_ID'=>$reqPropinsi, 'KABUPATEN_ID'=>$reqKabupaten)); 
										while($kecamatan->nextRow())
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
			        </div>

			        <div class="row">
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Desa</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id="reqKelurahan" name="reqDesa">
			        					<option value="" <?if($reqKelurahan=='') echo 'selected' ?> disabled></option>
										<?
										$kelurahan->selectByParamsKelurahan(array('PROPINSI_ID'=>$reqPropinsiId, 'KABUPATEN_ID'=>$reqKabupatenId,'KECAMATAN_ID'=>$reqKecamatanId)); 
										while($kelurahan->nextRow())
										 {
										?>
											<option value="<?=$kelurahan->getField('KELURAHAN_ID')?>" <? if($kelurahan->getField('KELURAHAN_ID') == $reqKelurahan) echo 'selected' ?>>
					                        	<?=$kelurahan->getField('NAMA')?>
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
			        				<select class="form-control" id="reqKelurahanIbu" name="reqDesa">
			        					<option value="" <?if($reqKelurahan=='') echo 'selected' ?> disabled></option>
										<?
										$kelurahan->selectByParamsKelurahan(array('PROPINSI_ID'=>$reqPropinsiId, 'KABUPATEN_ID'=>$reqKabupatenId,'KECAMATAN_ID'=>$reqKecamatanId)); 
										while($kelurahan->nextRow())
										 {
										?>
											<option value="<?=$kelurahan->getField('KELURAHAN_ID')?>" <? if($kelurahan->getField('KELURAHAN_ID') == $reqKelurahan) echo 'selected' ?>>
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
	        					<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Kode Pos 
				        		</label>
				        		<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqKodePos" id="reqKodePos" value="<?=$reqKodePos?>" />
			        			</div>
			        		</div>
		        		</div>
			        	<div class="col-md-6">
			        		<div class="form-group row">
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
	        					<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Telepon
				        		</label>
				        		<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqKodePos" id="reqKodePos" value="<?=$reqKodePos?>" />
			        			</div>
			        		</div>
		        		</div>
			        	<div class="col-md-6">
			        		<div class="form-group row">
	        					<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Telepon
				        		</label>
				        		<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqKodePos" id="reqKodePos" value="<?=$reqKodePos?>" />
			        			</div>
			        		</div>
		        		</div>
			        </div>
			    </div>

	        	<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
	        				<input type="hidden" name="reqTempValidasiId" value="<?=$reqTempValidasiId?>">
	        				<button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
	        			</div>
	        		</div>
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

	// $('#ktagamaid').select2({
	// 	placeholder: "Pilih agama"
	// });

	// $('#ktsatuankerjad').select2({
	// 	placeholder: "Pilih Satuan Kerja"
	// });
	
	// $('#ktjeniskelamin').select2({
	// 	placeholder: "Pilih jenis kelamin"
	// });

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
		var formSubmitUrl = "json-data/info_data_json/indentitaspegawai";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					/*reqEmail: {
						validators: {
							notEmpty: {
								message: 'Email is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					},
					reqSatuanKerjaNama: {
						validators: {
							notEmpty: {
								message: 'Please select an option'
							}
						}
					},*/
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
			        		document.location.href = "app/index/pegawai_data";
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
				text: "Sorry, looks like there are some errors detected, please try again.",
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			}).then(function() {
				KTUtil.scrollTop();
			});
		});
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
</script>

<script type="text/javascript">
	$(function(){
		$('#reqPropinsiIbu').bind('change', function(ev) {
			var propinsi = $('#reqPropinsiIbu').val();
			$.getJSON('json-main/lokasi_json/getKabupaten?reqPropinsiId='+propinsi, function (data) 
	        {
	            Result = data; //Use this data for further creation of your elements.
	            var items = "";
				items += "<option value='' disabled selected>Pilih Kabupaten</option>";
	            $.each(data, function (i, SingleElement) {

					items += "<option value='" + SingleElement.kabupaten_id + "'>" + SingleElement.kabupaten + "</option>";
	            });
				$("#reqKabupatenIbu").html(items);
				// $.uniform.update("#reqKecamatan"); 
				// $.uniform.update("#reqKelurahan");             
	        });
		});
		$('#reqKabupatenIbu').bind('change', function(ev) {
			var kabupaten = $('#reqKabupatenIbu').val();
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
				$("#reqKecamatanIbu").html(items);
				$.uniform.update("#reqKecamatanIbu");
				
				var items = "";			
				$("#reqKelurahanIbu").html(items); 
				// $.uniform.update("#reqKelurahan"); 
	        });
		});
		$('#reqKecamatanIbu').bind('change', function(ev) {
			//$("#reqKabupaten").reset(); 
			var kecamatan = $('#reqKecamatanIbu').val();
			$.getJSON('json-main/lokasi_json/getKelurahan?reqKecamatanId='+kecamatan, function (data) 
	        {
	            Result = data; //Use this data for further creation of your elements.
	            var items = "";
				items += "<option value='' disabled selected>Pilih Desa</option>";
	            //items += "<option value=0> -- </option>";
	            $.each(data, function (i, SingleElement) {
					items += "<option value='" + SingleElement.kelurahan_id + "'>" + SingleElement.kelurahan + "</option>";
	            });
	            $("#reqKelurahanIbu").html(items);
				// $.uniform.update("#reqKecamatan"); 
	        });
		});	
	})
</script>