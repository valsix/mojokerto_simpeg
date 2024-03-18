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
$propinsi->selectByParamsPropinsi(); 

$kabupaten= new Core();
$kabupaten->selectByParamsKabupaten(array('PROPINSI_ID'=>$reqPropinsi)); 

$kecamatan= new Core();
$kecamatan->selectByParamsKecamatan(array('PROPINSI_ID'=>$reqPropinsi, 'KABUPATEN_ID'=>$reqKabupaten)); 

$kelurahan= new Core();
$kelurahan->selectByParamsKelurahan(array('PROPINSI_ID'=>$reqPropinsiId, 'KABUPATEN_ID'=>$reqKabupatenId,'KECAMATAN_ID'=>$reqKecamatanId)); 

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
						<a class="" href="app/index/pengalaman_kerja?reqId=<?=$reqId?>">Pengalaman Kerja</a>
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
                    <h3 class="card-label">Profil Pegawai</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">NIP</label>
			        			<div class="col-lg-4 col-sm-12">
			        				<input type="text" class="form-control" readonly style="background-color: #F3F6F9;" name="reqNIP1" id="reqNIP1" value="<?=$reqNIP1?>" />
			        			</div>
			        			<label class="col-form-label ">/</label>
			        			<div class="col-lg-4 col-sm-12">
			        				<input type="text" class="form-control" readonly style="background-color: #F3F6F9;" name="reqNIP2" id="reqNIP2" value="<?=$reqNIP2?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Nama</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" readonly style="background-color: #F3F6F9;" name="reqNama" id="reqNama" value="<?=$reqNama?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Gelar Depan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqGelarDepan" id="reqGelarDepan" value="<?=$reqGelarDepan?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Gelar Belakang</label>
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
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Jenis Kelamin</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id='reqJenisKelamin' name='reqJenisKelamin'>
			        					<option <?if ($reqJenisKelamin==''){echo "selected";}?> disabled> Pilih Jenis Kelamin</option>
			        					<option <?if ($reqJenisKelamin=='L'){echo "selected";}?>> Laki laki</option>
			        					<option <?if ($reqJenisKelamin=='P'){echo "selected";}?>> Perempuan</option>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Agama
				        		</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control"  id='reqAgama' name='reqAgama'>
			        					<option <?if($reqAgamaId==''){echo "selected";}?> disabled>Pilih Agama</option>
			        					<?while ($agama->nextRow()){?>
					                        <option value="<?=$agama->getField('AGAMA_ID')?>"
					                        <? if ($agama->getField('AGAMA_ID') == $reqAgamaId) echo 'selected'?>>
					                        <?=$agama->getField('NAMA')?>
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
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Status Pernikahan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id='reqStatusPernikahan' name='reqStatusPernikahan'>
			        					<option  <? if($reqStatusPernikahan == "") echo 'selected'?> disabled>Pilih Status Pernikahan</option>
			        					<option value="1" <? if($reqStatusPernikahan == "1") echo 'selected'?>>Belum Kawin</option>
										<option value="2" <? if($reqStatusPernikahan == "2") echo 'selected'?>>Kawin</option>
										<option value="3" <? if($reqStatusPernikahan == "3") echo 'selected'?>>Janda</option>
										<option value="4" <? if($reqStatusPernikahan == "4") echo 'selected'?>>Duda</option>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Suku Bangsa</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqSukuBangsa" id="reqSukuBangsa" value="<?=$reqSukuBangsa?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Gol Darah 
				        		</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id='reqGolDarah' name='reqGolDarah'>
			        					<option value=""  <? if($reqGolDarah == "") echo 'selected'?> disabled>Pilih Golongan Darah</option>
			        					<option value="A" <? if($reqGolDarah == "A") echo 'selected'?>>A</option>
										<option value="B" <? if($reqGolDarah == "B") echo 'selected'?>>B</option>
										<option value="AB" <? if($reqGolDarah == "AB") echo 'selected'?>>AB</option>
										<option value="O" <? if($reqGolDarah == "O") echo 'selected'?>>O</option>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
	        			<div class="col-md-6">
				        	<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Telpon</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqTelepon" id="reqTelepon" value="<?=$reqTelepon?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Email</label>
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
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Alamat</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<textarea class="form-control" id='reqAlamat' name="reqAlamat"  style="height: 90px;"><?=$reqAlamat?></textarea>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12" style="margin-bottom:20px ;">RT</label>
			        			<div class="col-lg-3 col-sm-12">
			        				<input type="text" class="form-control"  name="reqRT" id="reqRT" value="<?=$reqRT?>" />
			        			</div>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			RW 
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
			        				<select class="form-control" id='reqPropinsi' name='reqPropinsi'>
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
			        				<select class="form-control" id='reqKabupaten' name='reqKabupaten'>
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
			        				<select class="form-control" id="reqKecamatan" name="reqKecamatan">
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
			        				<select class="form-control" id="reqKelurahan" name="reqDesa">
			        					<option value="" <?if($reqKelurahan=='') echo 'selected' ?> disabled></option>
										<?while($kelurahan->nextRow())
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
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Bank</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id="reqBank" name="reqBank">
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
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Foto Setengah Badan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="file" class="form-control"  name="reqGambar" id="reqGambar" value="<?=$reqGambar?>" />
			        			</div>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12"></label>
			        			<div class="col-lg-4 col-sm-12">
			        				<!-- <img src="http://192.168.88.100/mojokerto/simpeg_online/main/image_script.php?reqPegawaiId=235164100003&reqMode=pegawai"> -->

			        				<?if (file_exists($filename)) {?>
				        				 <img src="image_script.php?reqPegawaiId=<?=$reqPegawaiId?>&reqMode=pegawai" width=150 height=200>

									<?}?>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Foto Seluruh Badan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="file" class="form-control"  name="reqGambarSetengah" id="reqGambarSetengah" value="<?=$reqGambarSetengah?>" />
			        			</div>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12"></label>
			        			<div class="col-lg-4 col-sm-12">
			        				<!-- <img src="http://192.168.88.100/mojokerto/simpeg_online/main/image_script.php?reqPegawaiId=235164100003&reqMode=pegawai"> -->
			        				<?if (file_exists($filename)) {?>
				        				 <img src="image_script.php?reqPegawaiId=<?=$reqPegawaiId?>&reqMode=pegawai_other" width=150 height=200>
									<?}?>
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Pangkat Terakhir</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqPangkatTerkahir" id="reqPangkatTerkahir" value="<?=$reqPangkatTerkahir?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Jabatan Terakhir</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqJabatanTerkahir" id="reqJabatanTerkahir" value="<?=$reqJabatanTerkahir?>" />
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
			        				<input type="text" class="form-control" name="reqSatuanKerjaNama"  id="reqSatkerNama">
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tipe Pegawai</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" name="reqTipePegawai" id="reqTipePegawai">
			        					<? while ($tipepegawai->nextRow()){?>
										<option value="<?=$tipepegawai->getField('TIPE_PEGAWAI_ID')?>"
										<? if ($tipepegawai->getField('TIPE_PEGAWAI_ID') == $reqTipePegawai) echo 'selected'?>>
										<?
										if($tipepegawai->getField('TIPE_PEGAWAI_ID_PARENT') == 0)  echo $tipepegawai->getField('TIPE_PEGAWAI_ID').'.'.$tipepegawai->getField('NAMA');
										else														echo substr($tipepegawai->getField('TIPE_PEGAWAI_ID'),0,1).'.'.substr($tipepegawai->getField('TIPE_PEGAWAI_ID'),1).'.'.$tipepegawai->getField('NAMA');
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
			        				<select class="form-control" name="reqTugasTambahan" id="reqTugasTambahan">
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
			        				<select class="form-control"  name = "reqStatusPegawai" id="reqStatusPegawai">
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
			        				<select class="form-control" name = "reqJenisPegawai" id="reqJenisPegawai">
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
			        				<select class="form-control" name = "reqKedudukanId" id="reqKedudukanId">
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
			        				<input type="text" class="form-control"  name="reqTahunLulus" id="reqTahunLulus" value="<?=$reqTahunLulus?>" />
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
				        				<input type="text" autocomplete="off" class="form-control" id="kttanggallahir" name="reqTMTPangkat" value="<?=$reqTMTPangkat?>" />
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
				        				<input type="text" autocomplete="off" class="form-control" id="kttanggallahir" name="reqTMTJabatan" value="<?=$reqTMTJabatan?>" />
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
		        				<textarea class="form-control" id='reqDrh' name="reqDrh" style="height: 90px;"></textarea>
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

	// arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	// $('#kttanggallahir').datepicker({
	// 	todayHighlight: true
	// 	, autoclose: true
	// 	, orientation: "bottom left"
	// 	, clearBtn: true
	// 	, format: 'dd-mm-yyyy'
	// 	, templates: arrows
	// });

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