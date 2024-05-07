<?
include_once("functions/personal.func.php");

$this->load->model("base/RiwayatPangkat");
$this->load->model("base/Core");

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

$pangkat_riwayat= new RiwayatPangkat();
$pangkat_riwayat->selectByParams(array('PANGKAT_RIWAYAT_ID'=>$reqRowId,'PEGAWAI_ID'=>$reqId));
$pangkat_riwayat->firstRow();
$reqPANGKAT_RIWAYAT_ID = $pangkat_riwayat->getField('PANGKAT_RIWAYAT_ID');
$reqGolRuang 			= $pangkat_riwayat->getField('PANGKAT_ID');
$reqPjPenetap 		= $pangkat_riwayat->getField('PEJABAT_PENETAP_ID');
$reqTglSTLUD = dateToPageCheck($pangkat_riwayat->getField('TANGGAL_STLUD'));
$reqSTLUD				= $pangkat_riwayat->getField('STLUD');
$reqNoSTLUD			= $pangkat_riwayat->getField('NO_STLUD');
$reqNoNota = $pangkat_riwayat->getField('NO_NOTA');
$reqNoSK = $pangkat_riwayat->getField('NO_SK');
$reqTh		= $pangkat_riwayat->getField('MASA_KERJA_TAHUN');
$reqBl		= $pangkat_riwayat->getField('MASA_KERJA_BULAN');
$reqKredit		= $pangkat_riwayat->getField('KREDIT');
$reqJenisKP		= $pangkat_riwayat->getField('JENIS_KP');
$reqKeterangan		= $pangkat_riwayat->getField('KETERANGAN');
$reqGajiPokok		= $pangkat_riwayat->getField('GAJI_POKOK');
$reqTglNota= dateToPageCheck($pangkat_riwayat->getField('TANGGAL_NOTA'));
$reqTglSK = dateToPageCheck($pangkat_riwayat->getField('TANGGAL_SK'));
$reqTMTGol = dateToPageCheck($pangkat_riwayat->getField('TMT_PANGKAT'));
// echo $pangkat_riwayat->query;exit;

$pangkat= new Core();
$pangkat->selectByParamsPangkat(array());

$pejabatpenetap= new Core();
$pejabatpenetap->selectByParamsPejabatPenetap(array());

$reqMode="update";
// $reqMode="insert";
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
						<a class="" href="app/index/riwayat_pangkat?reqId=<?=$reqId?>">Riwayat Pangkat</a>
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			STLUD
		        		</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<div class="input-group date">
		        				<select class="form-control"  name="reqSTLUD" id='reqSTLUD'>
									<option></option>
				                    <option value="1" <? if($reqSTLUD == 1) echo 'selected'?>>Tingkat I</option>
				                    <option value="2" <? if($reqSTLUD == 2) echo 'selected'?>>Tingkat II</option>
				                    <option value="3" <? if($reqSTLUD == 3) echo 'selected'?>>Tingkat III</option>
								</select>
		        			</div>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. STLUD</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoSTLUD" id="reqNoSTLUD" value="<?=$reqNoSTLUD?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tgl. STLUD</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<div class="input-group date">
	        					<input type="text" autocomplete="off" class="form-control" id="reqTglSTLUD" name="reqTglSTLUD" value="<?=$reqTglSTLUD?>" />
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
	        				<select name="reqGolRuang" id="reqGolRuang"  class="form-control">
	        					<option value="" <? if($reqGolRuang == '') echo 'selected';?> disabled> Pilih Gol/Ruang</option>
			                    <? while($pangkat->nextRow()){?>
			                        <option value="<?=$pangkat->getField('PANGKAT_ID')?>" <? if($reqGolRuang == $pangkat->getField('PANGKAT_ID')) echo 'selected';?>><?=$pangkat->getField('KODE')?></option>
			                    <? }?>
			                </select>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Gol</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
	        					<input type="text" autocomplete="off" class="form-control" id="reqTMTGol" name="reqTMTGol" value="<?=$reqTMTGol?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No Nota</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoNota" id="reqNoNota" value="<?=$reqNoNota?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tgl Nota</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
	        					<input type="text" autocomplete="off" class="form-control" id="reqTglNota" name="reqTglNota" value="<?=$reqTglNota?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        		</div><div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No SK</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoSK" id="reqNoSK" value="<?=$reqNoSK?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tgl SK</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
	        					<input type="text" autocomplete="off" class="form-control" id="reqTglSK" name="reqTglSK" value="<?=$reqTglSK?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pj Penetap</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<select name="reqPjPenetap" id="reqPjPenetap"  class="form-control">
	        					<option value="" <? if($reqPjPenetap == '') echo 'selected';?> disabled> Pilih Pj Penetap</option>
			                    <? while($pejabatpenetap->nextRow()){?>
			                        <option value="<?=$pejabatpenetap->getField('PEJABAT_PENETAP_ID')?>" <? if($reqPjPenetap == $pejabatpenetap->getField('PEJABAT_PENETAP_ID')) echo 'selected';?>><?=$pejabatpenetap->getField('JABATAN')?></option>
			                    <? }?>
			                </select>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jenis KP</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<select name="reqJenisKP" id="reqJenisKP"  class="form-control">
			                   	<option value=""<? if($reqJenisKP == '') echo 'selected'?>>Pilih</option>
			                   	<option value="1" <? if($reqJenisKP == 1) echo 'selected'?>>Reguler</option>
			                    <option value="2" <? if($reqJenisKP == 2) echo 'selected'?>>Pilihan (Struktural)</option>
			                    <option value="3" <? if($reqJenisKP == 3) echo 'selected'?>>Anumerta</option>
			                    <option value="4" <? if($reqJenisKP == 4) echo 'selected'?>>Pengabdian</option>
			                    <option value="5" <? if($reqJenisKP == 5) echo 'selected'?>>SK lain-lain</option>
			                    <option value="6" <? if($reqJenisKP == 6) echo 'selected'?>>Pilihan (Fungsional)</option>
							</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Kredit</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<input type="text" class="form-control" name="reqKredit" id="reqKredit" value="<?=$reqKredit?>" />
	        			</div>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">Masa Kerja </label>
			        			<div class="col-lg-3 col-sm-12">
			        				<input type="text" class="form-control" name="reqTh" id="reqTh" value="<?=$reqTh?>" />
			        			</div>
			        			<label class="col-form-label">Tahun </label>
			        			<div class="col-lg-3 col-sm-12">
			        				<input type="text" class="form-control" name="reqBl" id="reqBl" value="<?=$reqBl?>" />
			        			</div>
			        			<label class="col-form-label">Bulan</label>
			        		</div>	        			
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Gaji Pokok</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<input type="text" class="form-control" name="reqGajiPokok" id="reqGajiPokok" value="<?=$reqGajiPokok?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Keterangan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<textarea class="form-control" id='reqKeterangan' name="reqKeterangan"><?=$reqKeterangan?></textarea>
	        			</div>
	        		</div>
	        		<div class="card-footer">
		        		<div class="row">
		        			<div class="col-lg-9">
		        				<input type="hidden" name="reqId" value="<?=$reqId?>">
		        				<input type="hidden" name="reqRowId" value="<?=$reqRowId?>">
		        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
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
		var formSubmitUrl = "json-main/riwayat_pangkat_json/add";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNoSK: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqTglSK: {
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
			        			document.location.href = "app/index/riwayat_pangkat?reqId=<?=$reqId?>";
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
	$('#reqTglSTLUD,#reqTglNota,#reqTglSK,#reqTMTGol').datepicker({
		todayHighlight: true
		, autoclose: true
		, orientation: "bottom left"
		, clearBtn: true
		, format: 'dd-mm-yyyy'
		, templates: arrows
	});

	$("#reqSTLUD, #reqGolRuang, #reqPjPenetap, #reqJenisKP").select2({
    	placeholder: "Pilih salah satu data",
    	allowClear: true
  	});

</script>