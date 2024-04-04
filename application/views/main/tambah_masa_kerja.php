<?
include_once("functions/personal.func.php");

$this->load->model("base/TambahanMasaKerja");

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');


$tamb_masa_kerja= new TambahanMasaKerja();
$tamb_masa_kerja->selectByParams(array("PEGAWAI_ID" => $reqId), -1,-1,'');

// echo $tamb_masa_kerja->query;exit;
$tamb_masa_kerja->firstRow();
			   
$reqRowId			= (int)$tamb_masa_kerja->getField('TAMBAHAN_MASA_KERJA_ID');
$reqNoSK				= $tamb_masa_kerja->getField('NO_SK');
$reqTglSK				= dateToPageCheck($tamb_masa_kerja->getField('TANGGAL_SK'));
$reqTMTSK				= dateToPageCheck($tamb_masa_kerja->getField('TMT_SK'));
$reqTambahanMasaKerja	= $tamb_masa_kerja->getField('TAMBAHAN_MASA_KERJA_ID');
$reqMasaKerja			= $tamb_masa_kerja->getField('TAMBAHAN_MASA_KERJA_ID');
$reqThTMK				= $tamb_masa_kerja->getField('TAHUN_TAMBAHAN');
$reqThMK				= $tamb_masa_kerja->getField('TAHUN_BARU');
$reqBlTMK				= $tamb_masa_kerja->getField('BULAN_TAMBAHAN');
$reqBlMK				= $tamb_masa_kerja->getField('BULAN_BARU');


if(empty($reqRowId))
{
	$reqMode="insert";
}
else
{
	$reqMode="update";

}
// echo $reqTmtJabatan;exit;
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
						<a class="text-muted">Tambahan Masa Kerja</a>
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
                    <h3 class="card-label">Tambahan Masa Kerja</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			No. SK
		        		</label>
		        		<div class="col-lg-10 col-sm-12">
		        			<input type="text" style="width:150px" class="form-control" name="reqNoSK" value="<?=$reqNoSK?>" required title="No SK harus diisi" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tgl. SK
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" style="width:150px"  class="form-control" name="reqTglSK" id="reqTglSK" maxlength="10" value="<?=$reqTglSK?>" required />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			TMT SK
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" style="width:150px"  class="form-control" name="reqTMTSK" id="reqTMTSK" maxlength="10" value="<?=$reqTMTSK?>" required />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tambahan Masa Kerja
		        		</label>
		        		<label class="col-form-label text-right col-lg-1 col-sm-12">
		        			Th
		        		</label>
	        			<div class="col-lg-1 col-sm-12">
	        				<input type="text" class="form-control" name="reqThTMK" id="reqThTMK" value="<?=$reqThTMK?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-1 col-sm-12">
		        			Bl
		        		</label>
	        			<div class="col-lg-1 col-sm-12">
	        				<input type="text" class="form-control" name="reqBlTMK" id="reqBlTMK" value="<?=$reqBlTMK?>" />
	        			</div>
	        		</div>

	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Masa Kerja
		        		</label>
		        		<label class="col-form-label text-right col-lg-1 col-sm-12">
		        			Th
		        		</label>
	        			<div class="col-lg-1 col-sm-12">
	        				<input type="text" class="form-control" name="reqThMK" id="reqThMK" value="<?=$reqThMK?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-1 col-sm-12">
		        			Bl
		        		</label>
	        			<div class="col-lg-1 col-sm-12">
	        				<input type="text" class="form-control" name="reqBlMK" id="reqBlMK" value="<?=$reqBlMK?>" />
	        			</div>
	        		</div>
	        		
	        	</div>
	        	<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
	        				<input type="hidden" name="reqId" value="<?=$reqId?>">
	        				<input type="hidden" name="reqRowId" value="<?=$reqRowId?>">
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


	$("#reqThMK, #reqBlMK, #reqThTMK, #reqBlTMK, #reqTglSK, #reqTMTSK").keypress(function(e) {
		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
		return false;
		}
	});

	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#reqTglSK, #reqTMTSK').datepicker({
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
		var formSubmitUrl = "json-main/masa_kerja_json/add";
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
                                document.location.href = "app/index/tambah_masa_kerja?reqId=<?=$reqId?>";
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


</script>
