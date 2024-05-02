<?
include_once("functions/personal.func.php");

$this->load->model("base/OrangTua");
$this->load->model("base/Core");

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$reqId= $this->input->get('reqId');

$set = new OrangTua();
$set->selectByParams(array("a.PEGAWAI_ID" => $reqId,"JENIS_KELAMIN" => L),-1,-1, '');
// echo $set->query;exit;
$set->firstRow();

$reqAyahId= (int)$set->getField("ORANG_TUA_ID");
$reqNamaAyah= $set->getField('NAMA');
$reqTempatLahirAyah= $set->getField('TEMPAT_LAHIR');
$reqTglLahirAyah= dateToPageCheck($set->getField('TANGGAL_LAHIR'));
$reqUsiaAyah= $set->getField('');
$reqPekerjaanAyah= $set->getField('PEKERJAAN');
$reqAlamatAyah= $set->getField('ALAMAT');
$reqPropinsiAyah= $set->getField('PROPINSI_ID');
$reqKabupatenAyah= $set->getField('KABUPATEN_ID');
$reqKecamatanAyah= $set->getField('KECAMATAN_ID');
$reqDesaAyah= $set->getField('KELURAHAN_ID');
$reqKodePosAyah= $set->getField('KODEPOS');
$reqTeleponAyah= $set->getField('TELEPON');

$set= new OrangTua();
$set->selectByParams(array("a.PEGAWAI_ID" => $reqId,"JENIS_KELAMIN" => P),-1,-1, '');
$set->firstRow();

$reqIbuId= (int)$set->getField("ORANG_TUA_ID");
$reqNamaIbu= $set->getField('NAMA');
$reqTempatLahirIbu= $set->getField('TEMPAT_LAHIR');
$reqTglLahirIbu= dateToPageCheck($set->getField('TANGGAL_LAHIR'));
$reqUsiaIbu= $set->getField('');
$reqPekerjaanIbu= $set->getField('PEKERJAAN');
$reqAlamatIbu= $set->getField('ALAMAT');
$reqPropinsiIbu= $set->getField('PROPINSI_ID');
$reqKabupatenIbu= $set->getField('KABUPATEN_ID');
$reqKecamatanIbu= $set->getField('KECAMATAN_ID');
$reqDesaIbu= $set->getField('KELURAHAN_ID');
$reqKodePosIbu= $set->getField('KODEPOS');
$reqTeleponIbu= $set->getField('TELEPON');

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
						<a class="text-muted">Identitas Orangtua</a>
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
                    <h3 class="card-label">Profil Orangtua</h3>
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
			        				<input type="text" class="form-control"  name="reqNamaAyah" id="reqNamaAyah" value="<?=$reqNamaAyah?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Nama</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqNamaIbu" id="reqNamaIbu" value="<?=$reqNamaIbu?>" />
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
			        				<input type="text" class="form-control"  name="reqTempatLahirAyah" id="reqTempatLahirAyah" value="<?=$reqTempatLahirAyah?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Tempat Lahir
				        		</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqTempatLahirIbu" id="reqTempatLahirIbu" value="<?=$reqTempatLahirIbu?>" />
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
				        				<input type="text" autocomplete="off" class="form-control" id="reqTglLahirAyah" name="reqTglLahirAyah" value="<?=$reqTglLahirAyah?>" />
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
				        				<input type="text" autocomplete="off" class="form-control" id="reqTglLahirIbu" name="reqTglLahirIbu" value="<?=$reqTglLahirIbu?>" />
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
			        				<input type="text" class="form-control"  name="reqUsiaAyah" id="reqUsiaAyah" value="<?=$reqUsiaAyah?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Usia</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqUsiaIbu" id="reqUsiaIbu" value="<?=$reqUsiaIbu?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Pekerjaan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqPekerjaanAyah" id="reqPekerjaanAyah" value="<?=$reqPekerjaanAyah?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Pekerjaan</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqPekerjaanIbu" id="reqPekerjaanIbu" value="<?=$reqPekerjaanIbu?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Alamat</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<textarea class="form-control"  name="reqAlamatAyah" id="reqAlamatAyah" ><?=$reqAlamatAyah?></textarea>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Alamat</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<textarea class="form-control"  name="reqAlamatIbu" id="reqAlamatIbu" ><?=$reqAlamatIbu?></textarea>
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">Propinsi</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" id='reqPropinsi' name='reqPropinsiAyah'>
			        					<option value="" <?if($reqPropinsiAyah=='') echo 'selected' ?> disabled></option>
										<?
										$propinsi->selectByParamsPropinsi(); 
										while($propinsi->nextRow())
										 {
										?>
											<option value="<?=$propinsi->getField('PROPINSI_ID')?>" <? if($propinsi->getField('PROPINSI_ID') == $reqPropinsiAyah) echo 'selected' ?>>
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
			        				<select class="form-control" id='reqPropinsiIbu' name='reqPropinsiIbu'>
			        					<option value="" <?if($reqPropinsiIbu=='') echo 'selected' ?> disabled></option>
										<?
										$propinsi->selectByParamsPropinsi();
										while($propinsi->nextRow())
										 {
										?>
											<option value="<?=$propinsi->getField('PROPINSI_ID')?>" <? if($propinsi->getField('PROPINSI_ID') == $reqPropinsiIbu) echo 'selected' ?>>
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
			        				<select class="form-control" id='reqKabupaten' name='reqKabupatenAyah'>
			        					<option value="" <?if($reqKabupatenAyah=='') echo 'selected' ?> disabled></option>
										<?
										$kabupaten->selectByParamsKabupaten(array('PROPINSI_ID'=>$reqPropinsiAyah)); 
										while($kabupaten->nextRow())
										 {
										?>
											<option value="<?=$kabupaten->getField('KABUPATEN_ID')?>" <? if($kabupaten->getField('KABUPATEN_ID') == $reqKabupatenAyah) echo 'selected' ?>>
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
			        				<select class="form-control" id='reqKabupatenIbu' name='reqKabupatenIbu'>
			        					<option value="" <?if($reqKabupatenIbu=='') echo 'selected' ?> disabled></option>
										<?
										$kabupaten->selectByParamsKabupaten(array('PROPINSI_ID'=>$reqPropinsiIbu)); 
										while($kabupaten->nextRow())
										 {
										?>
											<option value="<?=$kabupaten->getField('KABUPATEN_ID')?>" <? if($kabupaten->getField('KABUPATEN_ID') == $reqKabupatenIbu) echo 'selected' ?>>
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
			        				<select class="form-control" id="reqKecamatan" name="reqKecamatanAyah">
			        					<option value="" <?if($reqKecamatanAyah=='') echo 'selected' ?> disabled></option>
										<?
										$kecamatan->selectByParamsKecamatan(array('PROPINSI_ID'=>$reqPropinsiAyah, 'KABUPATEN_ID'=>$reqKabupatenAyah)); 
										while($kecamatan->nextRow())
										 {
										?>
											<option value="<?=$kecamatan->getField('KECAMATAN_ID')?>" <? if($kecamatan->getField('KECAMATAN_ID') == $reqKecamatanAyah) echo 'selected' ?>>
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
			        				<select class="form-control" id="reqKecamatanIbu" name="reqKecamatanIbu">
			        					<option value="" <?if($reqKecamatanIbu=='') echo 'selected' ?> disabled></option>
										<?
										$kecamatan->selectByParamsKecamatan(array('PROPINSI_ID'=>$reqPropinsiIbu, 'KABUPATEN_ID'=>$reqKabupatenIbu)); 
										while($kecamatan->nextRow())
										 {
										?>
											<option value="<?=$kecamatan->getField('KECAMATAN_ID')?>" <? if($kecamatan->getField('KECAMATAN_ID') == $reqKecamatanIbu) echo 'selected' ?>>
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
			        				<select class="form-control" id="reqKelurahan" name="reqDesaAyah">
			        					<option value="" <?if($reqDesaAyah=='') echo 'selected' ?> disabled></option>
										<?
										$kelurahan->selectByParamsKelurahan(array('PROPINSI_ID'=>$reqPropinsiAyah, 'KABUPATEN_ID'=>$reqKabupatenAyah,'KECAMATAN_ID'=>$reqKecamatanAyah)); 
										while($kelurahan->nextRow())
										 {
										?>
											<option value="<?=$kelurahan->getField('KELURAHAN_ID')?>" <? if($kelurahan->getField('KELURAHAN_ID') == $reqDesaAyah) echo 'selected' ?>>
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
			        				<select class="form-control" id="reqKelurahanIbu" name="reqDesaIbu">
			        					<option value="" <?if($reqDesaIbu=='') echo 'selected' ?> disabled></option>
										<?
										$kelurahan->selectByParamsKelurahan(array('PROPINSI_ID'=>$reqPropinsiIbu, 'KABUPATEN_ID'=>$reqKabupatenIbu,'KECAMATAN_ID'=>$reqKecamatanIbu));
										while($kelurahan->nextRow())
										 {
										?>
											<option value="<?=$kelurahan->getField('KELURAHAN_ID')?>" <? if($kelurahan->getField('KELURAHAN_ID') == $reqDesaIbu) echo 'selected' ?>>
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
			        				<input type="text" class="form-control"  name="reqKodePosAyah" id="reqKodePosAyah" value="<?=$reqKodePosAyah?>" />
			        			</div>
			        		</div>
		        		</div>
			        	<div class="col-md-6">
			        		<div class="form-group row">
	        					<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Kode Pos 
				        		</label>
				        		<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqKodePosIbu" id="reqKodePosIbu" value="<?=$reqKodePosIbu?>" />
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
			        				<input type="text" class="form-control"  name="reqTeleponAyah" id="reqTeleponAyah" value="<?=$reqTeleponAyah?>" />
			        			</div>
			        		</div>
		        		</div>
			        	<div class="col-md-6">
			        		<div class="form-group row">
	        					<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Telepon
				        		</label>
				        		<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control"  name="reqTeleponIbu" id="reqTeleponIbu" value="<?=$reqTeleponIbu?>" />
			        			</div>
			        		</div>
		        		</div>
			        </div>
			    </div>

	        	<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqId" value="<?=$reqId?>" />
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
		var formSubmitUrl = "json-main/orang_tua_json/add";
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
                                document.location.href = "app/index/orang_tua?reqId=<?=$reqId?>";
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