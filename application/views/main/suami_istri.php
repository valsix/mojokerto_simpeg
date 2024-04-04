<link href="assets/css/w3.css" rel="stylesheet" type="text/css" />

<?
include_once("functions/personal.func.php");

$this->load->model("base/SuamiIstri");
$this->load->model("base/Core");

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$reqId= $this->input->get('reqId');

$suami_istri= new SuamiIstri();
$suami_istri->selectByParams(array("PEGAWAI_ID" => $reqId, "STATUS"=>1), -1,-1,'');
$suami_istri->firstRow();
// echo $suami_istri->query; exit;
$reqIdSuamiIstri	= (int)$suami_istri->getField('SUAMI_ISTRI_ID');
$reqNamaSuamiIstri	= $suami_istri->getField('NAMA');
$reqTempatLahir	= $suami_istri->getField('TEMPAT_LAHIR');
$reqTglLahir		= dateToPageCheck($suami_istri->getField('TANGGAL_LAHIR'));
$reqTglKawin		= dateToPageCheck($suami_istri->getField('TANGGAL_KAWIN'));
$reqPNS			= $suami_istri->getField('STATUS_PNS');
$reqNIP			= $suami_istri->getField('NIP_PNS');
$reqPendidikan		= $suami_istri->getField('PENDIDIKAN_ID');
$reqPekerjaan		= $suami_istri->getField('PEKERJAAN');
$reqTunjangan		= $suami_istri->getField('STATUS_TUNJANGAN');
$reqSudahDibayar	= $suami_istri->getField('STATUS_BAYAR');
$reqBulanDibayar	= dateToPageCheck($suami_istri->getField('BULAN_BAYAR'));
$reqKartu	= $suami_istri->getField('KARTU');
$reqPegawaiId= $suami_istri->getField('PEGAWAI_ID');

$reqFoto			= $suami_istri->getField('FOTO');
$reqFotoTmp			= $suami_istri->getField('FOTO');

$pendidikan= new Core();
$pendidikan->selectByParamsPendidikan(); 

// echo $reqTmtJabatan;exit;
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
						<a class="text-muted">Suami Istri</a>
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
                    <h3 class="card-label">Suami Istri</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="w3-bar w3-black">
					    <a class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event,'London')">Suami/Istri</a>
					    <a class="w3-bar-item w3-button tablink" onclick="openCity(event,'Paris')">Kartu Pegawai</a>
					</div>
					  
					<div id="London" class="w3-container w3-border city">
				        <div class="card-title">
		                    <h3 class="card-label">Suami/Istri</h3>
		                </div>
			            <div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Foto
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<input type="file" class="form-control" name="reqNamaPejabatPenetap" id="reqNamaPejabatPenetap" value="<?=$reqNamaPejabatPenetap?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Nama Suami/Istri
			        		</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqNamaSuamiIstri" id="reqNamaSuamiIstri" value="<?=$reqNamaSuamiIstri?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Tempat Lahir
			        		</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqTempatLahir" id="reqTempatLahir" value="<?=$reqTempatLahir?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Kartu
			        		</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqKartu" id="reqKartu" value="<?=$reqKartu?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Tgl Lahir
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="input-group date">
			        				<input type="text" autocomplete="off" class="form-control" id="reqTglLahir" name="reqTglLahir" value="<?=$reqTglLahir?>" />
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
			        			Tgl Kawin
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="input-group date">
			        				<input type="text" autocomplete="off" class="form-control" id="reqTglKawin" name="reqTglKawin" value="<?=$reqTglKawin?>" />
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
			        			PNS
			        		</label>
		        			<div style="margin-left: 10px;">
		        				<input type="checkbox" name="reqPNS"  id="reqPNS" class="form-control" style="width: 20px;" value="1" <? if($reqPNS == 1) echo 'checked'?> >
		        			</div>
		        		</div>
		        		<div id='reqNIPField' class="form-group row" <? if($reqPNS != 1) echo 'style="display:none"'?> >
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			NIP(PNS)
			        		</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqNIP" id="reqNIP" value="<?=$reqNIP?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Pendidikan
			        		</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<select class="form-control" id="reqPendidikan" name="reqPendidikan">
		        					 <? while($pendidikan->nextRow()){?>
					                    <option value="<?=$pendidikan->getField('PENDIDIKAN_ID')?>" <? if($reqPendidikan == $pendidikan->getField('PENDIDIKAN_ID')) echo 'selected';?>><?=$pendidikan->getField('NAMA')?></option>
					                <? }?>
		        				</select>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Pekerjaan
			        		</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqPekerjaan" id="reqPekerjaan" value="<?=$reqPekerjaan?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Tunjangan
			        		</label>
		        			<div style="margin-left: 10px;">
		        				<input type="checkbox" name="reqTunjangan" id='reqTunjangan' class="form-control" style="width: 20px;" value="1" <? if($reqTunjangan == 1) echo 'checked'?>>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Sudah Dibayar
			        		</label>
		        			<div style="margin-left: 10px;">
		        				<input type="checkbox" name="reqSudahDibayar" id='reqSudahDibayar' class="form-control" style="width: 20px;" value="1" <? if($reqSudahDibayar == 1) echo 'checked'?> >
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Bulan Dibayar
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<input type="text" class="form-control" name="reqBulanDibayar" id="reqBulanDibayar" value="<?=$reqBulanDibayar?>" />
		        			</div>
		        		</div>

		        		<div class="card-footer">
			        		<div class="row">
			        			<div class="col-lg-9">
			        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
			        				<input type="hidden" name="reqTempValidasiId" value="<?=$reqTempValidasiId?>">
			        				<button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
			        			</div>
			        		</div>
			        	</div>
					</div>

					<div id="Paris" class="w3-container w3-border city" style="display:none">
					    <div class="card-title">
		                    <h3 class="card-label">Kartu Pegawai</h3>
		                </div>
					    <!-- <p>Paris is the capital of France.</p>  -->
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
	$('#kttanggallahir').datepicker({
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

</script>

<!-- <button onclick="tes()">tesss</button>
<script>
    function tes() {
        // pageUrl= "app/loadUrl/main/pegawai_data";
        pageUrl= "iframe/index/pegawai_data";
        openAdd(pageUrl);
    }
</script> -->

<script>
	function openCity(evt, cityName) {
	  var i, x, tablinks;
	  x = document.getElementsByClassName("city");
	  for (i = 0; i < x.length; i++) {
	    x[i].style.display = "none";
	  }
	  tablinks = document.getElementsByClassName("tablink");
	  for (i = 0; i < x.length; i++) {
	    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
	  }
	  document.getElementById(cityName).style.display = "block";
	  evt.currentTarget.className += " w3-red";
	}

	$("#reqPNS").change(function(){
		var pns = $("#reqPNS:checked").length;
		document.getElementById("reqNIP").value = '';

		if(pns==1){
			$("#reqNIPField").show();				
		}
		else{
		    $("#reqNIPField").hide();			
		}
	});
</script>