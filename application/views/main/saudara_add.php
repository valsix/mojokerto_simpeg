<?
include_once("functions/personal.func.php");

$this->load->model("base/Core");
$this->load->model("base/Saudara");

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

if(empty($reqRowId))
{
	$reqMode="insert";
}
else
{
	$reqMode="update";

	$saudara= new Saudara();
	$saudara->selectByParams(array('SAUDARA_ID'=>$reqRowId));
	$saudara->firstRow();

	$reqRowId= $saudara->getField('SAUDARA_ID');
	$reqNama= $saudara->getField('NAMA');
	$reqTempatLahir= $saudara->getField('TEMPAT_LAHIR');
	$reqTglLahir= dateToPageCheck($saudara->getField('TANGGAL_LAHIR'));
	$reqJenisKelamin = $saudara->getField('JENIS_KELAMIN');
	$reqPekerjaan= $saudara->getField('PEKERJAAN');
	$reqAlamat= $saudara->getField('ALAMAT');
	$reqKodePos= $saudara->getField('KODEPOS');
	$reqTelepon= $saudara->getField('TELEPON');
	$reqPropinsi= $saudara->getField('PROPINSI_ID');
	$reqKabupaten= $saudara->getField('KABUPATEN_ID');
	$reqKecamatan= $saudara->getField('KECAMATAN_ID');
	$reqKelurahan= $saudara->getField('KELURAHAN_ID');
}

$propinsi= new Core();
$propinsi->selectByParamsPropinsi(); 

$kabupaten= new Core();
$kabupaten->selectByParamsKabupaten(array('PROPINSI_ID'=>$reqPropinsi)); 

$kecamatan= new Core();
$kecamatan->selectByParamsKecamatan(array('PROPINSI_ID'=>$reqPropinsi, 'KABUPATEN_ID'=>$reqKabupaten)); 

$kelurahan= new Core();
$kelurahan->selectByParamsKelurahan(array('PROPINSI_ID'=>$reqPropinsi, 'KABUPATEN_ID'=>$reqKabupaten,'KECAMATAN_ID'=>$reqKecamatan));

$readonly = "readonly";
?>

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
						<a class="" href="app/index/saudara?reqId=<?=$reqId?>">Saudara</a>
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
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNama" id="reqNama" value="<?=$reqNama?>" />
	        			</div>
	        		</div>
	        		<div class="row">
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Tempat Lahir</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<input type="text" class="form-control" name="reqTempatLahir" id="reqTempatLahir" value="<?=$reqTempatLahir?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			Tanggal Lahir
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" autocomplete="off" class="form-control kttanggal" name="reqTglLahir" value="<?=$reqTglLahir?>" />
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
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jenis Kelamin</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<select class="form-control" id='reqJenisKelamin' name='reqJenisKelamin'>
	        					<option <?if ($reqJenisKelamin==''){echo "selected";}?> disabled value=''> Pilih Jenis Kelamin</option>
	        					<option value="L" <?if ($reqJenisKelamin=='L'){echo "selected";}?>> Laki laki</option>
	        					<option value="P" <?if ($reqJenisKelamin=='P'){echo "selected";}?>> Perempuan</option>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pekerjaan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqPekerjaan" id="reqPekerjaan" value="<?=$reqPekerjaan?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Alamat</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<textarea class="form-control" id='reqAlamat' name="reqAlamat"  style="height: 90px;"><?=$reqAlamat?></textarea>
	        			</div>
	        		</div>
	        		<div class="row">
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Kode Pos</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<input type="text" class="form-control" name="reqKodePos" id="reqKodePos" value="<?=$reqKodePos?>" />
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Telepon</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<input type="text" class="form-control" name="reqTelepon" id="reqTelepon" value="<?=$reqTelepon?>" />
			        			</div>
			        		</div>
			        	</div>
			        </div>
	        		<div class="row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Propinsi</label>
			        			<div class="col-lg-8 col-sm-12">
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
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Kabupaten</label>
			        			<div class="col-lg-8 col-sm-12">
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
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Kecamatan</label>
			        			<div class="col-lg-8 col-sm-12">
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
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Desa</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<select class="form-control" id="reqKelurahan" name="reqKelurahan">
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

	        		<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
	        				<input type="hidden" name="reqId" value="<?=$reqId?>">
	        				<input type="hidden" name="reqRowId" value="<?=$reqRowId?>">
	        				<input type="hidden" name="reqTempValidasiId" value="<?=$reqTempValidasiId?>">
	        				<button type="submit" id="ktloginformsubmitbutton" class="btn btn-light-success"><i class="fa fa-save" aria-hidden="true"></i> Simpan</button>
	        			</div>
	        		</div>
	        	</div>
	        	</div>
	        </form>
        </div>
    </div>
</div>

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

	$(function () {
		$("[rel=tooltip]").tooltip({ placement: 'right'});
		// $('[data-toggle="tooltip"]').tooltip()
	})

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-main/saudara_json/add";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNama: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqTempatLahir: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqTglLahir: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
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
			        		document.location.href = "app/index/saudara?reqId=<?=$reqId?>";
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

	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('.kttanggal').datepicker({
		todayHighlight: true
		, autoclose: true
		, orientation: "bottom left"
		, clearBtn: true
		, format: 'dd-mm-yyyy'
		, templates: arrows
	});

	$("#reqPropinsi, #reqKabupaten, #reqKecamatan, #reqKelurahan, #reqJenisKelamin").select2({
    	placeholder: "Pilih salah satu data",
    	allowClear: true
  	});

</script>