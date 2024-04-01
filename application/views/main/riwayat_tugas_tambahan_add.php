<?
include_once("functions/personal.func.php");

$this->load->model("base/RiwayatTugasTambahan");
$this->load->model("base/Core");

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

$jabatan_tambahan= new RiwayatTugasTambahan();
$jabatan_tambahan->selectByParams(array('JABATAN_TAMBAHAN_ID'=>$reqRowId, 'PEGAWAI_ID'	=> $reqId));
$jabatan_tambahan->firstRow();
// echo $jabatan_tambahan->query; exit;
$reqJABATAN_TAMBAHAN_ID = $jabatan_tambahan->getField('JABATAN_TAMBAHAN_ID');
$reqPjPenetapNama= $jabatan_tambahan->getField('PEJABAT_PENETAP');
$reqPjPenetapId= $jabatan_tambahan->getField('PEJABAT_PENETAP_ID');
$reqSatkerId 			= $jabatan_tambahan->getField('SATKER_ID');
$reqNoSK				= $jabatan_tambahan->getField('NO_SK');
$reqEselon			= $jabatan_tambahan->getField('ESELON_ID');
$reqNamaJabatan	= $jabatan_tambahan->getField('NAMA');
$reqNoPelantikan = $jabatan_tambahan->getField('NO_PELANTIKAN');
$reqTunjangan = $jabatan_tambahan->getField('TUNJANGAN');
$reqTglSK 		= dateToPageCheck($jabatan_tambahan->getField('TANGGAL_SK'));
$reqTMTJabatan	= dateToPageCheck($jabatan_tambahan->getField('TMT_JABATAN'));
$reqTMTEselon	= dateToPageCheck($jabatan_tambahan->getField('TMT_ESELON'));
$reqTglPelantikan = dateToPageCheck($jabatan_tambahan->getField('TANGGAL_PELANTIKAN'));
$reqBlnDibayar = dateToPageCheck($jabatan_tambahan->getField('BULAN_DIBAYAR'));
$reqTMTJabatanFungsional = dateToPageCheck($jabatan_tambahan->getField('TMT_JABATAN_FUNGSIONAL'));
$reqTMTTugasTambahan = dateToPageCheck($jabatan_tambahan->getField('TMT_TUGAS_TAMBAHAN'));
$reqKeteranganBUP = $jabatan_tambahan->getField('KETERANGAN_BUP');
// echo $reqTmtJabatan;exit;

$eselon= new Core();
$eselon->selectByParamsEselon(); 

$pejabat_penetap= new Core();
$pejabat_penetap->selectByParamsPejabatPenetap(); 

$reqMode="update";
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
						<a class="" href="app/index/riwayat_tugas_tambahan?reqId=<?=$reqId?>">Riwayat Tugas Tambahan</a>
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No SK</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoSK" id="reqNoSK" value="<?=$reqNoSK?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tanggal SK
		        		</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" autocomplete="off" class="form-control" id="kttanggallahir" name="reqTglSK" value="<?=$reqTglSK?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama Jabatan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNamaJabatan" id="reqNamaJabatan" value="<?=$reqNamaJabatan?>" />
	        			</div>
	        		</div>
	        		
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Mutasi</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqTMTJabatan" id="reqTMTJabatan" value="<?=$reqTMTJabatan?>" />
	        			</div>
	        		</div>
					<? if($tempTipePegawaiId == 11){?>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Eselon</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<select class="form-control" id="reqEselon" name="reqEselon">
		        					<?while($eselon->nextRow()){?>
					                    <option value="<?=$eselon->getField('ESELON_ID')?>" <? if($tempEselon == $eselon->getField('ESELON_ID')) echo 'selected';?>><?=$eselon->getField('NAMA')?></option>
					                <? }?>
		        				</select>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Eselon</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqTMTEselon" id="reqTMTEselon" value="<?=$reqTMTEselon?>" />
		        			</div>
		        		</div>
		        	<?}
		        	else{?>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Jabatan Fungsional</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqTMTJabatanFungsional" id="reqTMTJabatanFungsional" value="<?=$reqTMTJabatanFungsional?>" />
		        			</div>
		        		</div>
		        	<?}?>
		        	<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Mutasi</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqTMTEselon" id="reqTMTEselon" value="<?=$reqTMTEselon?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Tugas Tambahan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqTMTTugasTambahan" id="reqTMTTugasTambahan" value="<?=$reqTMTTugasTambahan?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tgl. Berakhir	
		        		</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" autocomplete="off" class="form-control" id="kttanggallahir" name="reqTglMulaiKerja" value="<?=$reqTglMulaiKerja?>" />
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
	        			<div class="col-lg-10 col-sm-12">
	        				<select class="form-control" id="reqPejabatPenetap" name="reqPejabatPenetap">
	        					<? while($pejabat_penetap->nextRow()){?>
				                    <option value="<?=$pejabat_penetap->getField('PEJABAT_PENETAP_ID')?>" 
				                        	<? 
				                        	if($reqPjPenetapId == $pejabat_penetap->getField('PEJABAT_PENETAP_ID'))
				                        	{ 
				                        		echo 'selected';
				                        	}
					                        else if($reqPjPenetapId=="")
					                    	{
					                    		if($pejabat_penetap->getField('PEJABAT_PENETAP_ID')==8)
					                    		{
					                    			echo 'selected';
					                    		}
					                    	}
				                        	?>
				                        	><?=$pejabat_penetap->getField('JABATAN')?>
				                        	
				                    </option>
				                <? }?>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. Pelantikan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoPelantikan" id="reqNoPelantikan" value="<?=$reqNoPelantikan?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tgl. Pelantikan	
		        		</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" autocomplete="off" class="form-control" id="kttanggallahir" name="reqTglPelantikan" value="<?=$reqTglPelantikan?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. Pelantikan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoPelantikan" id="reqNoPelantikan" value="<?=$reqNoPelantikan?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tunjangan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqTunjangan" id="reqTunjangan" value="<?=$reqTunjangan?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Bln. Dibayar</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqBlnDibayar" id="reqBlnDibayar" value="<?=$reqBlnDibayar?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Perpanjangan BUP</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqKeteranganBUP" id="reqKeteranganBUP" value="<?=$reqKeteranganBUP?>" />
	        			</div>
	        		</div>
	        		<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
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
		var formSubmitUrl = "json-data/info_data_json/indentitaspegawai";
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
			        		document.location.href = "app/index/pegawai_data";
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

	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#kttanggallahir').datepicker({
		todayHighlight: true
		, autoclose: true
		, orientation: "bottom left"
		, clearBtn: true
		, format: 'dd-mm-yyyy'
		, templates: arrows
	});

</script>