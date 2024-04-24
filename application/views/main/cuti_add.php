<?
include_once("functions/personal.func.php");

$this->load->model("base/Cuti");

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

if(empty($reqRowId))
{
	$reqMode="insert";
}
else
{
	$set = new Cuti();
	$set->selectByParams(array('CUTI_ID'=>$reqRowId));
	// echo $set->query;exit;
	$set->firstRow();
	$reqRowId= (int)$set->getField('CUTI_ID');
	$reqNoSurat= $set->getField('NO_SURAT');
	$reqJenisCuti= $set->getField('JENIS_CUTI');
	$reqTanggalPermohonan= dateToPageCheck($set->getField('TANGGAL_PERMOHONAN'));
	$reqTanggalSurat= dateToPageCheck($set->getField('TANGGAL_SURAT'));
	$reqTanggalMulai= dateToPageCheck($set->getField('TANGGAL_MULAI'));
	$reqTanggalSelesai= dateToPageCheck($set->getField('TANGGAL_SELESAI'));
	$reqLama= $set->getField('LAMA');
	$reqKeterangan= $set->getField('KETERANGAN');
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
						<a class="" href="app/index/cuti?reqId=<?=$reqId?>">Cuti</a>
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jenis Cuti</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<select <?=$disabled?> name="reqJenisCuti" class="form-control">
	        					<option value="1" <? if($reqJenisCuti == 1) echo 'selected';?>>Cuti Tahunan</option>				
	        					<option value="2" <? if($reqJenisCuti == 2) echo 'selected';?>>Cuti Besar</option>				
	        					<option value="3" <? if($reqJenisCuti == 3) echo 'selected';?>>Cuti Sakit</option>				
	        					<option value="4" <? if($reqJenisCuti == 4) echo 'selected';?>>Cuti Bersalin</option>				
	        					<option value="5" <? if($reqJenisCuti == 5) echo 'selected';?>>CLTN</option>				
	        					<option value="6" <? if($reqJenisCuti == 6) echo 'selected';?>>Perpanjangan CLTN</option>
	        					<option value="7" <? if($reqJenisCuti == 7) echo 'selected';?>>Cuti Menikah</option>
	        					<option value="10" <? if($reqJenisCuti == 10) echo 'selected';?>>Cuti Alasan Penting</option>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No Surat</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" style="width:250px" <?=$read?> class="form-control" name="reqNoSurat" value="<?=$reqNoSurat?>" title="No surat harus diisi" class="required" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			Tanggal Surat
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTanggalSurat" value="<?=$reqTanggalSurat?>" />
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
				        			Tanggal Mulai
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTanggalMulai" value="<?=$reqTanggalMulai?>" />
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
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			Tanggal Permohonan
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTanggalPermohonan" value="<?=$reqTanggalPermohonan?>" />
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
				        			Tanggal Selesai
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTanggalSelesai" value="<?=$reqTanggalSelesai?>" />
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Lama</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" style="width:250px" <?=$read?> class="form-control" id="reqLama" name="reqLama" value="<?=$reqLama?>" />
	        			</div>
	        		</div>

	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Keterangan</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<textarea <?=$disabled?> class="form-control" name="reqKeterangan" cols="35"> <?=$reqKeterangan?></textarea>
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

	$("#reqTanggalSelesai, #reqTanggalMulai, #reqTanggalMulai, #reqTanggalSurat,#reqLama").keypress(function(e) {
		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
			return false;
		}
	});


	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#reqTanggalSurat,#reqTanggalMulai,#reqTanggalPermohonan,#reqTanggalSelesai').datepicker({
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
		var formSubmitUrl = "json-main/cuti_json/add";
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
                                document.location.href = "app/index/cuti?reqId=<?=$reqId?>";
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