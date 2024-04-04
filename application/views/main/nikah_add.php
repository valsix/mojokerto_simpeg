<?
include_once("functions/personal.func.php");

$this->load->model("base/SuamiIstri");

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

	$suami_istri_cerai = new SuamiIstri();
	$suami_istri_cerai->selectByParams(array('SUAMI_ISTRI_ID'=>$reqRowId));
	// echo $suami_istri_cerai->query;exit;
	$suami_istri_cerai->firstRow();
	$reqRowId					= (int)$suami_istri_cerai->getField('SUAMI_ISTRI_ID');
	$reqNoSKPengadilan	= $suami_istri_cerai->getField('SK_CERAI');
	$reqGajiPokok	= $suami_istri_cerai->getField('GAJI_POKOK');
	$reqNama	= $suami_istri_cerai->getField('NAMA');
	$reqPNS	= $suami_istri_cerai->getField('PNS');
	$reqNIP	= $suami_istri_cerai->getField('NIP');
	$reqPekerjaan = $suami_istri_cerai->getField('PEKERJAAN');

	$reqTanggalSKPengadilan = dateToPageCheck($suami_istri_cerai->getField('SK_CERAI_TANGGAL'));
	$reqTMTSK = dateToPageCheck($suami_istri_cerai->getField('SK_CERAI_TMT'));

	// echo $reqTmtJabatan;exit;
	$reqMode="update";

}

	
$arrTahun= setTahunLoop(3,1);


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
						<a class="" href="app/index/nikah?reqId=<?=$reqId?>">Nikah</a>
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. SK Pengadilan</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoSKPengadilan" id="reqNoSKPengadilan" value="<?=$reqNoSKPengadilan?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tanggal SK</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" style="width:80px" name="reqTanggalSKPengadilan" id="reqTanggalSKPengadilan"  class="form-control" <?=$read?> maxlength="10" value="<?=$reqTanggalSKPengadilan?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT SK</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" style="width:80px" name="reqTMTSK" id="reqTMTSK" <?=$read?>  class="form-control" maxlength="10"  value="<?=$reqTMTSK?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text"  class="form-control" style="width:150px" name="reqNama" <?=$read?> value="<?=$reqNama?>" />
	        				<br/>
	        				<input type="checkbox" id="reqPNS"  name="reqPNS" value="1" <? if($reqPNS == 1) echo 'checked'?> <?=$disabled?>/> PNS &nbsp;
	        				<label id="reqLabelNIP">NIP</label>
	        				<input type="text" id="reqNIP" name="reqNIP" <?=$read?> value="<?=$reqNIP?>" />
	        			</div>

	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pekerjaan</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" class="form-control" name="reqPekerjaan" id="reqPekerjaan" value="<?=$reqPekerjaan?>" />
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

	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#reqTanggalSKPengadilan, #reqTMTSK').datepicker({
		todayHighlight: true
		, autoclose: true
		, orientation: "bottom left"
		, clearBtn: true
		, format: 'dd-mm-yyyy'
		, templates: arrows
	});

	$("#reqLabelNIP").hide();
	$("#reqNIP").hide();

	$("#reqTanggalSKPengadilan, #reqTMTSK, #reqTanggalSKIjin").keypress(function(e) {
		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
			return false;
		}
	});

	function countChecked() {
		var n = $("input:checked").length;
		if(n){
			$("#reqLabelNIP").show(1000);
			$("#reqNIP").show(1000);
		}else{
			$("#reqLabelNIP").hide(1000);
			$("#reqNIP").hide(1000);
			document.getElementById("reqNIP").value = '';
		}
	}
	function defaultNip() {
		var n = document.getElementById("reqNIP").value;
		if(n != ''){
			$("#reqLabelNIP").show(1000);
			$("#reqNIP").show(1000);
		}else{
			$("#reqLabelNIP").hide(1000);
			$("#reqNIP").hide(1000);				
		}			
	}		

	$("#reqPNS").click(countChecked);

	$("#reqNIP").keypress(function(e) {
		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
			return false;
		}
	});


	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-main/nikah_json/add";
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
                                document.location.href = "app/index/nikah?reqId=<?=$reqId?>";
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