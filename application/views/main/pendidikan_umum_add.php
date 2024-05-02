<?
include_once("functions/personal.func.php");

$this->load->model("base/PendidikanUmum");
$this->load->model("base/Core");

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

if(empty($reqRowId))
{
	$reqMode="insert";
}
else
{
	$set= new PendidikanUmum();
	$set->selectByParams(array('PEGAWAI_ID'=>$reqId, 'PENDIDIKAN_RIWAYAT_ID'=>$reqRowId));
	$set->firstRow();
	// echo $set->query;exit;
	$reqPENDIDIKAN_RIWAYAT_ID= $set->getField('PENDIDIKAN_RIWAYAT_ID');
	$reqNamaSekolah= $set->getField('NAMA');
	$reqPendidikan= $set->getField('PENDIDIKAN_ID');
	$reqTglSTTB= dateToPageCheck($set->getField('TANGGAL_STTB'));
	$reqJurusan= $set->getField('JURUSAN');
	$reqAlamatSekolah= $set->getField('TEMPAT');
	$reqKepalaSekolah= $set->getField('KEPALA');
	$reqNoSTTB= $set->getField('NO_STTB');
	$reqMode="update";
}
$pendidikan= new Core();
$pendidikan->selectByParamsPendidikan(array());
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
						<a class="" href="app/index/pendidikan_umum?reqId=<?=$reqId?>">Pendidikan Umum</a>
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pendidikan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<select name="reqPendidikan" class="form-control" >
			                	<?while($pendidikan->nextRow()){?>
									<option value="<?=$pendidikan->getField('PENDIDIKAN_ID')?>" <? if($reqPendidikan == $pendidikan->getField('PENDIDIKAN_ID')) echo 'selected';?>><?=$pendidikan->getField('NAMA')?></option>
								<? }?>
							</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jurusan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqJurusan" id="reqJurusan" value="<?=$reqJurusan?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama Sekolah</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNamaSekolah" id="reqNamaSekolah" value="<?=$reqNamaSekolah?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Alamat Sekolah</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqAlamatSekolah" id="reqAlamatSekolah" value="<?=$reqAlamatSekolah?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Kepala Sekolah</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqKepalaSekolah" id="reqKepalaSekolah" value="<?=$reqKepalaSekolah?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			No. STTB
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<input type="text" class="form-control" name="reqNoSTTB" id="reqNoSTTB" value="<?=$reqNoSTTB?>" />
			        			</div>
			        		</div>
		        		</div>
		        		<div class="col-md-6">
		        			<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			Tgl. STTB
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTglSTTB" value="<?=$reqTglSTTB?>" />
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
		var formSubmitUrl = "json-main/pendidikan_umum_json/add";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqJurusan: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqNamaSekolah: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqTglSTTB: {
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
                                document.location.href = "app/index/pendidikan_umum?reqId=<?=$reqId?>";
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