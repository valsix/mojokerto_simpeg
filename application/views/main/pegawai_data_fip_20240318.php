<?
include_once("functions/personal.func.php");

$this->load->model("base/Pegawai");

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$reqId= $this->input->get('reqId');

$set= new Pegawai();
// $pegawai->selectByParams(array("P.PEGAWAI_ID" => $reqPegawaiId)); 
// $pegawai->firstRow();

// $reqNIP1				= $pegawai->getField('NIP_LAMA');
// $reqNIP2				= $pegawai->getField('NIP_BARU');
// $reqNama				= $pegawai->getField('NAMA');
// $reqTipePegawai		= $pegawai->getField('TIPE_PEGAWAI_ID');
// $reqGelarDepan			= $pegawai->getField('GELAR_DEPAN');
// $reqGelarBelakang		= $pegawai->getField('GELAR_BELAKANG');
// $reqStatusPegawai		= $pegawai->getField('STATUS_PEGAWAI');
// $reqTempatLahir		= $pegawai->getField('TEMPAT_LAHIR');
// $reqTanggalLahir		= dateToPageCheck($pegawai->getField('TANGGAL_LAHIR'));
// $reqTglPensiun			= dateToPageCheck($pegawai->getField('TANGGAL_PENSIUN'));
// $reqTglPindah			= dateToPageCheck($pegawai->getField('TANGGAL_PINDAH'));
// $reqKeteranganPindah	= $pegawai->getField('KETERANGAN_PINDAH');
// $reqJenisKelamin		= $pegawai->getField('JENIS_KELAMIN');
// $reqJenisPegawai		= $pegawai->getField('JENIS_PEGAWAI_ID');
// $reqKeterangan			= $pegawai->getField('KETERANGAN_PINDAH');
// $reqStatusPernikahan	= $pegawai->getField('STATUS_KAWIN');
// $reqKartuPegawai		= $pegawai->getField('KARTU_PEGAWAI');
// $reqSukuBangsa			= $pegawai->getField('SUKU_BANGSA');
// $reqGolDarah			= $pegawai->getField('GOLONGAN_DARAH');
// $reqAkses				= $pegawai->getField('ASKES');
// $reqTaspen				= $pegawai->getField('TASPEN');
// $reqAlamat				= $pegawai->getField('ALAMAT');
// $reqNPWP				= $pegawai->getField('NPWP');
// $reqNIK				= $pegawai->getField('NIK');
// $reqRT					= $pegawai->getField('RT');
// $reqRW					= $pegawai->getField('RW');
// $reqEmail				= $pegawai->getField('EMAIL');
// $reqPropinsi			= $pegawai->getField('PROPINSI_ID');
// $reqKabupaten			= $pegawai->getField('KABUPATEN_ID');
// $reqKecamatan			= $pegawai->getField('KECAMATAN_ID');
// $reqDesa				= $pegawai->getField('KELURAHAN_ID');
// $reqBank				= $pegawai->getField('BANK_ID');
// $reqNoRekening			= $pegawai->getField('NO_REKENING');
// $reqPangkatTerkahir	= $pegawai->getField('GOL_RUANG');
// $reqTMTPangkat			= $pegawai->getField('TMT_PANGKAT');
// $reqJabatanTerkahir	= $pegawai->getField('JABATAN');
// $reqTMTJabatan			= $pegawai->getField('TMT_JABATAN');
// $reqPendidikanTerkahir	= $pegawai->getField('PENDIDIKAN');
// $reqJurusanTerkahir	= $pegawai->getField('JURUSAN');
// $reqTahunLulus			= $pegawai->getField('TAHUN');
// $reqGambar				= $pegawai->getField('FOTO_BLOB');
// $reqAgamaId			= $pegawai->getField('AGAMA_ID');
// $reqTelepon			= $pegawai->getField('TELEPON');
// $reqKodePos			= $pegawai->getField('KODEPOS');
// $reqKedudukanId		= $pegawai->getField('KEDUDUKAN_ID');

// $reqNikPns				= $pegawai->getField('KTP_PNS');
// $reqDrh				= $pegawai->getField('DRH');
// $reqNomorKK				= $pegawai->getField('KK');
// $reqKtpPasangan				= $pegawai->getField('KTP_PASANGAN');
// $reqTugasTambahan			= $pegawai->getField('TUGAS_TAMBAHAN_NEW');
// $reqJenisMapelId			= $pegawai->getField('JENIS_MAPEL_ID');
// $data = $pegawai->getField('FOTO_BLOB');
// $data_karpeg= $pegawai->getField('DOSIR_KARPEG');
// $data_askes= $pegawai->getField('DOSIR_ASKES');
// $data_taspen= $pegawai->getField('DOSIR_TASPEN');
// $data_npwp= $pegawai->getField('DOSIR_NPWP');
			
// $reqGambarTmp   		= $pegawai->getField('FOTO_BLOB');
// $reqGambarSetengah		= $pegawai->getField('FOTO_BLOB_OTHER');
// $reqGambarTmpSetengah	= $pegawai->getField('FOTO_BLOB_OTHER');

// echo $reqTmtJabatan;exit;
$reqMode="update";
// $reqMode="insert";
$readonly = "readonly";
?>
<style type="text/css">
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
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Nama</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" readonly style="background-color: #F3F6F9;" name="reqNama" id="reqNama" value="<?=$reqNama?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Gelar Depan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqGelarDepan" id="reqGelarDepan" value="<?=$reqGelarDepan?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Gelar Belakang</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqGelarBelakang" id="reqGelarBelakang" value="<?=$reqGelarBelakang?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Tempat Lahir
				        		</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqTempatLahir" id="reqTempatLahir" value="<?=$reqTempatLahir?>" />
			        			</div>
			        		</div>
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
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Jenis Kelamin</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id='reqJenisKelamin' name='reqJenisKelamin'>
			        					<option></option>
			        				</select>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Agama
				        		</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control"  id='reqAgama' name='reqAgama'>
			        					<option value=""></option>
			        				</select>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Status Pernikahan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id='reqStatusPernikahan' name='reqStatusPernikahan'>
			        					<option></option>
			        				</select>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Suku Bangsa</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqSukuBangsa" id="reqSukuBangsa" value="<?=$reqSukuBangsa?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Gol Darah 
				        		</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id='reqGolDarah' name='reqGolDarah'>
			        					<option value=""></option>
			        				</select>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Alamat</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<textarea class="form-control" id='reqAlamat' name="reqAlamat"></textarea>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">RT</label>
			        			<div class="col-lg-3 col-sm-12">
			        				<input type="text" class="form-control"  name="reqRT" id="reqRT" value="<?=$reqRT?>" />
			        			</div>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			RW 
				        		</label>
			        			<div class="col-lg-3 col-sm-12">
			        				<input type="text" class="form-control"  name="reqRW" id="reqRW" value="<?=$reqRW?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Telpon</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqTelepon" id="reqTelepon" value="<?=$reqTelepon?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Kode Pos 
				        		</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqKodePos" id="reqKodePos" value="<?=$reqKodePos?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Email</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqEmail" id="reqEmail" value="<?=$reqEmail?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Propinsi</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id='reqPropinsi' name='reqPropinsi'>
			        					<option value=""></option>
			        				</select>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Kabupaten</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id='reqKabupaten' name='reqKabupaten'>
			        					<option value=""></option>
			        				</select>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Kecamatan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id="reqKecamatan" name="reqKecamatan">
			        					<option value=""></option>
			        				</select>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Desa</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id="reqKelurahan" name="reqDesa">
			        					<option value=""></option>
			        				</select>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Bank</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id="reqBank" name="reqBank">
			        					<option value=""></option>
			        				</select>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">No Rekening</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqNoRekening" id="reqNoRekening" value="<?=$reqNoRekening?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Foto Setengah Badan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="file" class="form-control"  name="reqGambar" id="reqGambar" value="<?=$reqGambar?>" />
			        			</div>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12"></label>
			        			<div class="col-lg-4 col-sm-12">
			        				<img src="http://192.168.88.100/mojokerto/simpeg_online/main/image_script.php?reqPegawaiId=235164100003&reqMode=pegawai">
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Pangkat Terakhir</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqPangkatTerkahir" id="reqPangkatTerkahir" value="<?=$reqPangkatTerkahir?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Jabatan Terakhir</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqJabatanTerkahir" id="reqJabatanTerkahir" value="<?=$reqJabatanTerkahir?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Pendidikan Terakhir</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" value="<?=$reqPendidikanTerkahir?> <?=$reqJurusanTerkahir?>" />
			        			</div>
			        		</div>
	        			</div>
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Satuan Kerja</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<!-- <textarea  class="form-control" name="reqSatuanKerjaNama"  id="reqSatkerNama"></textarea> -->
			        				<input type="text" class="form-control" name="reqSatuanKerjaNama"  id="reqSatkerNama">
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tipe Pegawai</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" name="reqTipePegawai" id="reqTipePegawai">
			        					<option value=""></option>
			        				</select>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tugas Tambahan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" name="reqTugasTambahan" id="reqTugasTambahan">
			        					<option value=""></option>
			        				</select>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Status Pegawai
				        		</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control"  name = "reqStatusPegawai" id="reqStatusPegawai">
			        					<option value=""></option>
			        				</select>
			        			</div>
			        		</div>
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
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Jenis Pegawai</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" name = "reqJenisPegawai" id="reqJenisPegawai">
			        					<option value=""></option>
			        				</select>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Kedudukan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" name = "reqKedudukanId" id="reqKedudukanId">
			        					<option value=""></option>
			        				</select>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Kartu Pegawai</label>
			        			<div class="col-lg-4 col-sm-12">
			        				<input type="text" class="form-control"  name="reqKartuPegawai" id="reqKartuPegawai" value="<?=$reqKartuPegawai?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">BPJS</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqAkses" id="reqAkses" value="<?=$reqAkses?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Taspen</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqTaspen" id="reqTaspen" value="<?=$reqTaspen?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">NPWP</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqNPWP" id="reqNPWP" value="<?=$reqNPWP?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">NIK</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqNIK" id="reqNIK" value="<?=$reqNIK?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Daftar Riwayat Hidup</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<textarea class="form-control" id='reqDrh' name="reqDrh"></textarea>
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">KTP PNS</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqNikPns" id="reqNikPns" value="<?=$reqNikPns?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Nomor KK</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqNomorKK" id="reqNomorKK" value="<?=$reqNomorKK?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">KTP Pasangan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqKtpPasangan" id="reqKtpPasangan" value="<?=$reqKtpPasangan?>" />
			        			</div>
			        		</div>
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Foto Seluruh Badan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="file" class="form-control"  name="reqGambarSetengah" id="reqGambarSetengah" value="<?=$reqGambarSetengah?>" />
			        			</div>
			        			<label class="col-form-label text-right col-lg-3 col-sm-12"></label>
			        			<div class="col-lg-4 col-sm-12">
			        				<img src="http://192.168.88.100/mojokerto/simpeg_online/main/image_script.php?reqPegawaiId=235164100003&reqMode=pegawai">
			        			</div>
			        		</div>
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
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Tahun Lulus</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqTahunLulus" id="reqTahunLulus" value="<?=$reqTahunLulus?>" />
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

	$('#ktagamaid').select2({
		placeholder: "Pilih agama"
	});

	$('#ktsatuankerjad').select2({
		placeholder: "Pilih Satuan Kerja"
	});
	
	$('#ktjeniskelamin').select2({
		placeholder: "Pilih jenis kelamin"
	});

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

</script>

<!-- <button onclick="tes()">tesss</button>
<script>
    function tes() {
        // pageUrl= "app/loadUrl/main/pegawai_data";
        pageUrl= "iframe/index/pegawai_data";
        openAdd(pageUrl);
    }
</script> -->