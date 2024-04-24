<?
include_once("functions/personal.func.php");

$this->load->model("base/Organisasi");

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

if(empty($reqRowId))
{
	$reqMode="insert";
}
else
{
	$set= new Organisasi();
	$set->selectByParams(array('ORGANISASI_RIWAYAT_ID'=>$reqRowId));
	// echo $organisasi->query;exit;
	$set->firstRow();
	$reqRowId= $set->getField('ORGANISASI_RIWAYAT_ID');
	$reqORGANISASI_RIWAYAT_ID= $set->getField('ORGANISASI_RIWAYAT_ID');
	$reqJabatan= $set->getField('JABATAN');
	$reqNamaOrganisasi= $set->getField('NAMA');
	$reqAwal= dateToPageCheck($set->getField('TANGGAL_AWAL'));
	$reqAkhir= dateToPageCheck($set->getField('TANGGAL_AKHIR'));
	$reqPimpinan= $set->getField('PIMPINAN');
	$reqTempat= $set->getField('TEMPAT');

	$reqMode="update";
}
?>

<!-- Bootstrap core CSS -->
<link href="lib/bootstrap-3.3.7/docs/examples/navbar/navbar.css" rel="stylesheet">

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a class="" href="app/index/pegawai">Data Pegawai</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="" href="app/index/organisasi?reqId=<?=$reqId?>">Organisasi</a>
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama Organisasi</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text"  <?=$read?> class="form-control" name="reqNamaOrganisasi" id="reqNamaOrganisasi" value="<?=$reqNamaOrganisasi?>" title="Nama organisasi harus diisi" required />
	        			</div>
	        		</div>

	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jabatan</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text"  name="reqJabatan" class="form-control"  <?=$read?> value="<?=$reqJabatan?>" title="Jabatan harus diisi" required />
	        			</div>
	        		</div>

	        		<div class="form-group row">
			        	<div class="col-md-6">
			        		<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Awal</label>
			        			<div class="col-lg-4 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" autocomplete="off" class="form-control kttanggal" name="reqAwal" value="<?=$reqAwal?>" />
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
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Akhir</label>
			        			<div class="col-lg-4 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" autocomplete="off" class="form-control kttanggal" name="reqAkhir" value="<?=$reqAkhir?>" />
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pimpinan</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text"  <?=$read?> id="reqPimpinan" class="form-control" name="reqPimpinan" maxlength="10"  value="<?=$reqPimpinan?>" />
	        			</div>
	        		</div>

	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tempat</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" <?=$read?> id="reqTempat" class="form-control" name="reqTempat" maxlength="10"  value="<?=$reqTempat?>" />
	        			</div>
	        		</div>

	        		<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
	        				<input type="hidden" name="reqId" value="<?=$reqId?>">
	        				<input type="hidden" name="reqRowId" value="<?=$reqRowId?>">
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


	$("#reqAwal, #reqAkhir").keypress(function(e) {
		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
			return false;
		}
	});


	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#reqAwal,#reqAkhir').datepicker({
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
		var formSubmitUrl = "json-main/organisasi_json/add";
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
                                document.location.href = "app/index/organisasi?reqId=<?=$reqId?>";
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