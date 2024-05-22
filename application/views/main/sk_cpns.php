<?
include_once("functions/personal.func.php");

$this->load->model("base/SkCpns");
$this->load->model("base/Core");

$reqId= $this->input->get('reqId');

$skcpns= new SkCpns();
$skcpns->selectByParams(array("PEGAWAI_ID" => $reqId));
$skcpns->firstRow();
// echo $skcpns->query; exit;

$reqNoNotaBAKN= $skcpns->getField('NO_NOTA');
$reqTanggalNotaBAKN		= dateToPageCheck($skcpns->getField('TANGGAL_NOTA'));
$reqPejabatPenetapan		= $skcpns->getField('PEJABAT_PENETAP_ID');
$reqNamaPejabatPenetap		= $skcpns->getField('NAMA_PENETAP');
$reqNIPPejabatPenetap		= $skcpns->getField('NIP_PENETAP');
$reqNoSuratKeputusan		= $skcpns->getField('NO_SK');
$reqTanggalSuratKeputusan	= dateToPageCheck($skcpns->getField('TANGGAL_SK'));
$reqTerhitungMulaiTanggal	= dateToPageCheck($skcpns->getField('TMT_CPNS'));
$reqGolRuang				= $skcpns->getField('PANGKAT_ID');
$reqTanggalTugas			= dateToPageCheck($skcpns->getField('TANGGAL_TUGAS'));
$reqSkCpnsId			= $skcpns->getField('SK_CPNS_ID');
$reqTh 					= $skcpns->getField('MASA_KERJA_TAHUN');
$reqBl 					= $skcpns->getField('MASA_KERJA_BULAN');
$pangkat= new Core();
$pangkat->selectByParamsPangkat(array());
// echo $pangkat->query;exit;
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
						<a class="text-muted">SK CPNS</a>
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
                    <h3 class="card-label">SK CPNS</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. Nota BAKN</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoNotaBAKN" id="reqNoNotaBAKN" value="<?=$reqNoNotaBAKN?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tanggal Nota BAKN</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" autocomplete="off" class="form-control" id="reqTanggalNotaBAKN" name="reqTanggalNotaBAKN" value="<?=$reqTanggalNotaBAKN?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama Pejabat Penetap</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNamaPejabatPenetap" id="reqNamaPejabatPenetap" value="<?=$reqNamaPejabatPenetap?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">NIP Pejabat Penetap</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNIPPejabatPenetap" id="reqNIPPejabatPenetap" value="<?=$reqNIPPejabatPenetap?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. Surat Keputusan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoSuratKeputusan" id="reqNoSuratKeputusan" value="<?=$reqNoSuratKeputusan?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tanggal Surat Keputusan</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" autocomplete="off" class="form-control" id="reqTerhitungMulaiTanggal" name="reqTerhitungMulaiTanggal" value="<?=$reqTerhitungMulaiTanggal?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tanggal Surat Keputusan</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" autocomplete="off" class="form-control" id="reqTanggalSuratKeputusan" name="reqTanggalSuratKeputusan" value="<?=$reqTanggalSuratKeputusan?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Gol/Ruang</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<select class="form-control" id='reqGolRuang' name="reqGolRuang">
	        					<option></option>
	        					<? while ($pangkat->nextRow()){ ?>
								<option value="<?=$pangkat->getField('PANGKAT_ID')?>"
								<? if($pangkat->getField('PANGKAT_ID') == $reqGolRuang) echo 'selected'?>><?=$pangkat->getField('KODE')?></option>					
								<? } ?>
	        				</select>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tanggal Tugas</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" autocomplete="off" class="form-control" id="reqTanggalTugas" name="reqTanggalTugas" value="<?=$reqTanggalTugas?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Masa Kerja </label>
	        			<div class="col-lg-1 col-sm-12">
	        				<input type="text" class="form-control" name="reqTh" id="reqTh" value="<?=$reqTh?>" />
	        			</div>
	        			<label class="col-form-label">Tahun </label>
	        			<div class="col-lg-1 col-sm-12">
	        				<input type="text" class="form-control" name="reqBl" id="reqBl" value="<?=$reqBl?>" />
	        			</div>
	        			<label class="col-form-label">Bulan</label>
	        			
	        		</div>
	        	</div>
	        	<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
	        				<input type="hidden" name="reqSkCpnsId" value="<?=$reqSkCpnsId?>">
	        				<input type="hidden" name="reqId" value="<?=$reqId?>">
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

	$("#reqTh,#reqBl").keypress(function(e) {
		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
			return false;
		}
	});

	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#reqTanggalNotaBAKN,#reqTerhitungMulaiTanggal,#reqTanggalSuratKeputusan,#reqTanggalTugas').datepicker({
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
		var formSubmitUrl = "json-data/info_data_json/skCpnsAdd";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNoNotaBAKN: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqTanggalNotaBAKN: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqPejabatPenetapan: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqNamaPejabatPenetap: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqNIPPejabatPenetap: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqNoSuratKeputusan: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqTanggalSuratKeputusan: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqTerhitungMulaiTanggal: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqGolRuang: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqTanggalTugas: {
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
			        		document.location.href = "app/index/sk_cpns?reqId=<?=$reqId?>";
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