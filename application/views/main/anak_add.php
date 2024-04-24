<?
include_once("functions/personal.func.php");

$this->load->model("base/Anak");
$this->load->model("base/Core");

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

if(empty($reqRowId))
{
	$reqMode="insert";
}
else
{
	$reqMode="update";
	$set= new Anak();
	$set->selectByParams(array('ANAK_ID'=>$reqRowId));
	// echo $set->query;exit;
	$set->firstRow();
	$reqRowId= $set->getField('ANAK_ID');
	$reqNama= $set->getField('NAMA');
	$reqTmpLahir= $set->getField('TEMPAT_LAHIR');
	$reqTglLahir= dateToPageCheck($set->getField('TANGGAL_LAHIR'));
	$reqLP= $set->getField('JENIS_KELAMIN');
	$reqStatus= $set->getField('STATUS_KELUARGA');
	$reqDapatTunjangan= $set->getField('STATUS_TUNJANGAN');
	$reqPendidikan= $set->getField('PENDIDIKAN_ID');
	$reqPekerjaan= $set->getField('PEKERJAAN');
	$reqMulaiDibayar= dateToPageCheck($set->getField('AWAL_BAYAR'));
	$reqAkhirDibayar= dateToPageCheck($set->getField('AKHIR_BAYAR'));
}

$statement="";
$sOrder=" ORDER BY COALESCE(PANGKAT_MINIMAL,0)";
$set= new Core();
$arrpendidikan= [];
$set->selectByParamsPendidikan(array(), -1,-1,$statement,$sOrder);
// echo $set->query;exit;
while($set->nextRow())
{
	$arrdata= [];
	$arrdata["id"]= $set->getField("PENDIDIKAN_ID");
	$arrdata["text"]= $set->getField("NAMA");
	array_push($arrpendidikan, $arrdata);
}
unset($set);
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
						<a class="" href="app/index/anak?reqId=<?=$reqId?>">Anak</a>
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
	        		<div class="form-group row">
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Tempat Lahir</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<input type="text" class="form-control" name="reqTmpLahir" id="reqTmpLahir" value="<?=$reqTmpLahir?>" />
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
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Jenis Kelamin</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<select class="form-control" id='reqLP' name='reqLP'>
			        					<option <?if ($reqLP==''){echo "selected";}?> disabled> Pilih Jenis Kelamin</option>
			        					<option value="L" <?if ($reqLP=='L'){echo "selected";}?>> Laki laki</option>
			        					<option value="P" <?if ($reqLP=='P'){echo "selected";}?>> Perempuan</option>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Tunjangan</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<select class="form-control" id='reqDapatTunjangan' name='reqDapatTunjangan'>
			        					<option value="1" <?if ($reqDapatTunjangan=='1'){echo "selected";}?>> Dapat</option>
			        					<option value="2" <?if ($reqDapatTunjangan=='2'){echo "selected";}?>> Tidak</option>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
	        		</div>

	        		<div class="form-group row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Pendidikan</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<select class="form-control select2" id="ktpendidikan" <?=$disabled?> name="reqPendidikan" >
			        					<option value=""></option>
			        					<?
			        					foreach($arrpendidikan as $item) 
			        					{
			        						$selectvalid= $item["id"];
			        						$selectvaltext= $item["text"];
			        					?>
			        					<option value="<?=$selectvalid?>" <? if($reqPendidikan == $selectvalid) echo "selected";?>><?=$selectvaltext?></option>
			        					<?
			        					}
			        					?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-6">
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Status</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<select class="form-control" id='reqStatus' name='reqStatus'>
			        					<option value="1" <? if($reqStatus == 1) echo 'selected';?>>Kandung</option>
			        					<option value="2" <? if($reqStatus == 2) echo 'selected';?>>Tiri</option>
			        					<option value="3" <? if($reqStatus == 3) echo 'selected';?>>Angkat</option>
			        				</select>
			        			</div>
			        		</div>
		        		</div>
	        		</div>

	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pekerjaan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqPekerjaan" id="reqPekerjaan" value="<?=$reqPekerjaan?>" />
	        			</div>
	        		</div>

	        		<div class="form-group row">
			        	<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			Mulai Dibayar
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" autocomplete="off" class="form-control kttanggal" name="reqMulaiDibayar" value="<?=$reqMulaiDibayar?>" />
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
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			Akhir Dibayar
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" autocomplete="off" class="form-control kttanggal" name="reqAkhirDibayar" value="<?=$reqAkhirDibayar?>" />
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

	$(function () {
		$("[rel=tooltip]").tooltip({ placement: 'right'});
		// $('[data-toggle="tooltip"]').tooltip()
	})

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-main/anak_json/add";
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
								message: 'Nama is required'
							}
						}
					},
					reqTmpLahir: {
						validators: {
							notEmpty: {
								message: 'Tempat Lahir is required'
							}
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
			        		document.location.href = "app/index/anak?reqId=<?=$reqId?>";
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

	$('#ktpendidikan').select2({
		placeholder: "Pilih Pendidikan"
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

</script>