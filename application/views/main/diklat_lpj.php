<?
include_once("functions/personal.func.php");

$this->load->model("base/DiklatLpj");

$reqId= $this->input->get('reqId');

$set= new DiklatLpj();
$set->selectByParams(array("PEGAWAI_ID" => $reqId), -1,-1,'');
$set->firstRow();
// echo $set->query; exit;

$reqTahun= $set->getField('TAHUN');
$reqNoSTTPP= $set->getField('NO_STTPP');
$reqPenyelenggara= $set->getField('PENYELENGGARA');
$reqAngkatan= $set->getField('ANGKATAN');
$reqTglMulai= dateToPageCheck($set->getField('TANGGAL_MULAI'));
$reqTglSelesai= dateToPageCheck($set->getField('TANGGAL_SELESAI'));
$reqTglSTTPP= dateToPageCheck($set->getField('TANGGAL_STTPP'));
$reqTempat= $set->getField('TEMPAT');
$reqJumlahJam= $set->getField('JUMLAH_JAM');

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
						<a class="text-muted">Diklat LPJ</a>
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
                    <h3 class="card-label">Diklat LPJ</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tempat
		        		</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqTempat" id="reqTempat" value="<?=$reqTempat?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Penyelenggara
		        		</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqPenyelenggara" id="reqPenyelenggara" value="<?=$reqPenyelenggara?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Angkatan</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control valsixnumbering" name="reqAngkatan" id="reqAngkatan" value="<?=$reqAngkatan?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tahun</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control valsixnumbering" name="reqTahun" id="reqTahun" value="<?=$reqTahun?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			No. STTPP
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoSTTPP" id="reqNoSTTPP" value="<?=$reqNoSTTPP?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tgl. STTPP
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTglSTTPP" value="<?=$reqTglSTTPP?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        		</div>

	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tgl Mulai
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTglMulai" value="<?=$reqTglMulai?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tgl Selesai
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTglSelesai" value="<?=$reqTglSelesai?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        		</div>

	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jumlah Jam</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<input type="text" class="form-control valsixnumbering" name="reqJumlahJam" id="reqJumlahJam" value="<?=$reqJumlahJam?>" />
	        			</div>
	        		</div>

	        		<div class="card-footer">
		        		<div class="row">
		        			<div class="col-lg-9">
		        				<input type="hidden" name="reqMode" value="<?=$reqMode?>" />
		        				<input type="hidden" name="reqId" value="<?=$reqId?>" />
		        				<input type="hidden" name="reqRowId" value="<?=$reqRowId?>" />
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
		var formSubmitUrl = "json-main/diklat_lpj_json/add";
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
                                document.location.href = "app/index/diklat_lpj?reqId=<?=$reqId?>";
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

	$('.valsixnumbering').bind('keyup paste', function(){
		this.value = this.value.replace(/[^0-9]/g, '');
		// this.value = this.value.replace(/[^0-9\.]/g, '');
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