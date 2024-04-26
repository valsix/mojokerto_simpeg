<?
include_once("functions/personal.func.php");

$this->load->model("base/SkPns");
$this->load->model("base/Core");

$reqId= $this->input->get('reqId');

$pejabat_penetap= new Core();
$pejabat_penetap->selectByParamsPejabatPenetap();

$pangkat= new Core();
$pangkat->selectByParamsPangkat(array());

$skpns= new SkPns();
$skpns->selectByParams(array("PEGAWAI_ID" => $reqId), -1,-1,'');
// echo $skpns->query;exit;
$skpns->firstRow();
			   
$reqPejabatPenetapan			= $skpns->getField('PEJABAT_PENETAP_ID');
$reqNamaPejabatPenetap			= $skpns->getField('NAMA_PENETAP');
$reqNIPPejabatPenetap			= $skpns->getField('NIP_PENETAP');
$reqNoSuratKeputusan			= $skpns->getField('NO_SK');
$reqTanggalSuratKeputusan		= dateToPageCheck($skpns->getField('TANGGAL_SK'));
$reqTerhitungMulaiTanggal		= dateToPageCheck($skpns->getField('TMT_PNS'));
$reqNoDiklatPrajabatan			= $skpns->getField('NO_PRAJAB');
$reqTanggalDiklatPrajabatan	= dateToPageCheck($skpns->getField('TANGGAL_PRAJAB'));
$reqNoSuratUjiKesehatan		= $skpns->getField('NO_UJI_KESEHATAN');
$reqTanggalSuratUjiKesehatan	= dateToPageCheck($skpns->getField('TANGGAL_UJI_KESEHATAN'));
$reqGolRuang					= $skpns->getField('PANGKAT_ID');
$reqPengambilanSumpah			= $skpns->getField('SUMPAH');
$reqSkPnsId					= (int)$skpns->getField('SK_PNS_ID');
$reqTanggalSumpah				= $skpns->getField('TANGGAL_SUMPAH');
$reqTh 						= $skpns->getField('MASA_KERJA_TAHUN');
$reqBl 						= $skpns->getField('MASA_KERJA_BULAN');
$reqNoBeritaAcara				= $skpns->getField('NOMOR_BERITA_ACARA');
$reqTanggalBeritaAcara			= dateToPageCheck($skpns->getField('TANGGAL_BERITA_ACARA'));
$reqKeteranganLPJ				= $skpns->getField('KETERANGAN_LPJ');

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
						<a class="text-muted">SK PNS</a>
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
                    <h3 class="card-label">SK PNS</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Pejabat Penetapan
		        		</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<select class="form-control" id="reqPejabatPenetapan" name="reqPejabatPenetapan">
	        					<option <? if($reqPejabatPenetapan=='') echo 'selected'?> disabled>Pilih Pejabat Penetapan</option>					
        						<? while($pejabat_penetap->nextRow()){?>
			                        <option value="<?=$pejabat_penetap->getField('PEJABAT_PENETAP_ID')?>"
			                        <? if ($pejabat_penetap->getField('PEJABAT_PENETAP_ID') == $tempPejabatPenetapan) echo 'selected'?>><?=$pejabat_penetap->getField('JABATAN')?></option>
								<? }?>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Nama Pejabat Penetap
		        		</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNamaPejabatPenetap" id="reqNamaPejabatPenetap" value="<?=$reqNamaPejabatPenetap?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			NIP Pejabat Penetap
		        		</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNIPPejabatPenetap" id="reqNIPPejabatPenetap" value="<?=$reqNIPPejabatPenetap?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			No. Surat Keputusan
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoSuratKeputusan" id="reqNoSuratKeputusan" value="<?=$reqNoSuratKeputusan?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tanggal Surat Keputusan
		        		</label>
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Terhitung Mulai Tanggal
		        		</label>
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
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			No. Berita Acara
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoBeritaAcara" id="reqNoBeritaAcara" value="<?=$reqNoBeritaAcara?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tanggal Berita Acara
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" autocomplete="off" class="form-control" id="reqTanggalBeritaAcara" name="reqTanggalBeritaAcara" value="<?=$reqTanggalBeritaAcara?>" />
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
		        			No. Diklat Prajabatan
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoDiklatPrajabatan" id="reqNoDiklatPrajabatan" value="<?=$reqNoDiklatPrajabatan?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tanggal Diklat Prajabatan
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" autocomplete="off" class="form-control" id="reqTanggalDiklatPrajabatan" name="reqTanggalDiklatPrajabatan" value="<?=$reqTanggalDiklatPrajabatan?>" />
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
		        			No. Surat Uji Kesehatan
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoSuratUjiKesehatan" id="reqNoSuratUjiKesehatan" value="<?=$reqNoSuratUjiKesehatan?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tanggal Surat Uji Kesehatan
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" autocomplete="off" class="form-control" id="reqTanggalSuratUjiKesehatan" name="reqTanggalSuratUjiKesehatan" value="<?=$reqTanggalSuratUjiKesehatan?>" />
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
		        			Pengkat/Gol.Ruang
		        		</label>
	        			<div class="col-lg-8 col-sm-12">
	        				<select class="form-control" id="reqGolRuang" name="reqGolRuang">
	        					<option <? if($tempGolRuang=='') echo 'selected'?> disabled>Pilih Pengkat/Gol.Ruang</option>					
	        					<? while ($pangkat->nextRow()){?>
								<option value="<?=$pangkat->getField('PANGKAT_ID')?>"
								<? if($pangkat->getField('PANGKAT_ID') == $reqGolRuang) echo 'selected'?>><?=$pangkat->getField('KODE')?></option>					
								<? }?>		
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Pengambilan Sumpah
		        		</label>
	        			<div class="col-lg-1 col-sm-12">
	        				<input type="checkbox" <?if($reqPengambilanSumpah==1){ echo "checked";}?> class="form-control" name="reqPengambilanSumpah" id="reqPengambilanSumpah" value="<?=$reqPengambilanSumpah?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Latihan Pra Jabatan(LPJ)
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqKeteranganLPJ" id="reqKeteranganLPJ" value="<?=$reqKeteranganLPJ?>" />
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
	        				<input type="hidden" name="reqSkPnsId" value="<?=$reqSkPnsId?>">
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

	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#reqTanggalSuratKeputusan,#reqTerhitungMulaiTanggal,#reqTanggalDiklatPrajabatan,#reqTanggalSuratUjiKesehatan,#reqTanggalBeritaAcara').datepicker({
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
		var formSubmitUrl = "json-data/info_data_json/SkPnsAdd";
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
			        	Swal.fire({
			        		text: response.message,
			        		icon: "success",
			        		buttonsStyling: false,
			        		confirmButtonText: "Ok",
			        		customClass: {
			        			confirmButton: "btn font-weight-bold btn-light-primary"
			        		}
			        	}).then(function() {
			        		document.location.href = "app/index/sk_pns?reqId=<?=$reqId?>";
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

</script>

<!-- <button onclick="tes()">tesss</button>
<script>
    function tes() {
        // pageUrl= "app/loadUrl/main/pegawai_data";
        pageUrl= "iframe/index/pegawai_data";
        openAdd(pageUrl);
    }
</script> -->