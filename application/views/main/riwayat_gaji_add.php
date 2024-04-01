<?
include_once("functions/personal.func.php");

$this->load->model("base/RiwayatGaji");
$this->load->model("base/Core");

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

$gaji= new RiwayatGaji();
$gaji->selectByParams(array('GAJI_RIWAYAT_ID'=>$reqRowId,));
$gaji->firstRow();
//echo $gaji->query;
$reqGAJI_RIWAYAT_ID = $gaji->getField('GAJI_RIWAYAT_ID');
$reqNoSK	= $gaji->getField('NO_SK');
$reqGolRuang	= $gaji->getField('PANGKAT_ID');
$reqTglSK = dateToPageCheck($gaji->getField('TANGGAL_SK'));
$reqGajiPokok	= $gaji->getField('GAJI_POKOK');
$reqTh	= $gaji->getField('MASA_KERJA_TAHUN');
$reqBl	= $gaji->getField('MASA_KERJA_BULAN');

if( $gaji->getField('PEJABAT_PENETAP_ID')==''){
	$reqStatus='baru';
	$reqDisplayBaru='';
	$reqDisplay='none';
}else{
	$reqDisplayBaru='none';
	$reqDisplay='';
}
$reqPjPenetapNama= $gaji->getField('PEJABAT_PENETAP');
$reqPjPenetapId= $gaji->getField('PEJABAT_PENETAP_ID');
$reqTMTSK= dateToPageCheck($gaji->getField('TMT_SK'));

$pangkat= new Core();
$pangkat->selectByParamsPangkat(array());

$pejabat_penetap= new Core();
$pejabat_penetap->selectByParamsPejabatPenetap(array());

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
						<a class="" href="app/index/riwayat_gaji?reqId=<?=$reqId?>">Riwayat Gaji</a>
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. SK</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqNoSK" id="reqNoSK" value="<?=$reqNoSK?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			 	Tgl. SK
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Gol/Ruang</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<select class="form-control" name="reqGolRuang" id="reqGolRuang">
	        					<? while($pangkat->nextRow()){?>
			                        <option value="<?=$pangkat->getField('PANGKAT_ID')?>" <? if($reqGolRuang == $pangkat->getField('PANGKAT_ID')) echo 'selected';?>><?=$pangkat->getField('KODE')?></option>
			                    <? }?>
	        				</select>
	        			</div>
	        		</div>

	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			 	TMT SK
		        		</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" autocomplete="off" class="form-control" id="kttanggallahir" name="reqTMTSK" value="<?=$reqTMTSK?>" />
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
	        				<select class="form-control" name="reqPjPenetap" id="reqPjPenetap">
	        					<? while($pejabat_penetap->nextRow()){?>
			                        <option value="<?=$pejabat_penetap->getField('PEJABAT_PENETAP_ID')?>" 
			                        	<? 
			                        	if($reqPjPenetapId == $pejabat_penetap->getField('PEJABAT_PENETAP_ID'))
			                        	{ 
			                        		echo 'selected';
			                        	}
				                        else if($tempPjPenetapId=="")
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Masa Kerja (Th)</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqTh" id="reqTh" value="<?=$reqTh?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Masa Kerja (Bln)</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqBl" id="reqBl" value="<?=$reqBl?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Gaji Pokok</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqGajiPokok" id="reqGajiPokok" value="<?=$reqGajiPokok?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jenis</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<select class="form-control" name="reqJenis" id="reqJenis">
	        					<option value="1" <? if($reqJenis == 1) echo "selected";?>>Kenaikan Pangkat</option>
								<option value="2" <? if($reqJenis == 2) echo "selected";?>>Gaji Berkala</option>
								<option value="3" <? if($reqJenis == 3) echo "selected";?>>Penyesuaian Tabel Gaji Pokok</option>
								<option value="4" <? if($reqJenis == 4) echo "selected";?>>SK Lain-lain</option>
	        				</select>
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