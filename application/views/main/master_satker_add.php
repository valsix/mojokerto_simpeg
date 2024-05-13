<?
include_once("functions/personal.func.php");

$this->load->model("base/SatuanKerja");
$this->load->model("base/Eselon");
$this->load->model("base/Propinsi");
$this->load->model("base/Kabupaten");
$this->load->model("base/Kecamatan");
$this->load->model("base/Kelurahan");




$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$reqId= $this->input->get('reqId');
$reqMode= $this->input->get('reqMode');



$satker	= new SatuanKerja();
$eselon	= new Eselon();

$propinsi	= new Propinsi();
$kabupaten	= new Kabupaten();
$kecamatan	= new Kecamatan();
$kelurahan	= new Kelurahan();


$eselon->selectByParams(array(), -1, -1);


$satker->selectByParamsMaster(array("A.SATKER_ID"=>$reqId),-1,-1, '');

// echo $satker->query;exit;
$satker->firstRow();

$reqNamaJabatan = $satker->getField('NAMA_JABATAN');
$reqNamaSatker	 = $satker->getField('NAMA');
$reqKode	 	 = $satker->getField('KODE_SATKER');
$reqSifat	 	 = $satker->getField('SIFAT');
$reqEselon	 	 = $satker->getField('ESELON_ID');
$reqAlamat		 = $satker->getField('ALAMAT');
$reqKodepos	 = $satker->getField('KODEPOS');
$reqTelepon 	 = $satker->getField('TELEPON');
$reqFaximile 	 = $satker->getField('FAXIMILE');
$reqEmail 		 = $satker->getField('EMAIL');
$reqPropinsi 	 = $satker->getField('PROPINSI_ID');
$reqKabupaten 	 = $satker->getField('KABUPATEN_ID');
$reqKecamatan 	 = $satker->getField('KECAMATAN_ID');
$reqKelurahan 	 = $satker->getField('KELURAHAN_ID');

$reqPegawaiId= $satker->getField('PEGAWAI_ID');

$reqNama=$satker->getField("NAMA_PEGAWAI");
$reqNip= $satker->getField("NIP_BARU");
$reqPangkatId= $satker->getField("PANGKAT_ID");
$reqTmt= dateToPage($satker->getField("TMT_JABATAN"));


// echo $reqTmtJabatan;exit;
// $reqMode="update";
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
<link href="assets/css/w3.css" rel="stylesheet" type="text/css" />

<!-- <script src="lib/bootstrap-3.3.7/dist/js/bootstrap.min.js"></script> -->

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a class="" href="app/index/master_satker">Master Satker</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Satuan Kerja</a>
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
                    <h3 class="card-label">Satuan Kerja</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="w3-bar w3-black">
					    <a class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event,'satker')">Satker</a>
					    <a class="w3-bar-item w3-button tablink" onclick="openCity(event,'alamat')">Alamat Satuan Kerja</a>
					   <!--  <a class="w3-bar-item w3-button tablink" onclick="openCity(event,'jabatan')">Profil Jabatan</a>
					    <a class="w3-bar-item w3-button tablink" onclick="openCity(event,'mutasi')">Mutasi</a> -->
					</div>
					<br>
					  
					<div id="satker" class="w3-container w3-border city">
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Nama Satker
			        		</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqNamaSatker" id="reqNamaSatker" value="<?=$reqNamaSatker?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Nama Jabatan
			        		</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqNamaJabatan" id="reqNamaJabatan" value="<?=$reqNamaJabatan?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Sifat
			        		</label>
		        			<div class="col-lg-3 col-sm-12">
		        				<select name = "reqSifat" class="form-control">				 
		        					<option value="1" <? if($satker->getField('SIFAT') == 1) echo 'selected'?>>Struktural<?php /*?>Wakil Kepala<?php */?></option>
		        					<option value="2" <? if($satker->getField('SIFAT') == 2) echo 'selected'?>>Seketariat/TU</option>
		        					<option value="3" <? if($satker->getField('SIFAT') == 3) echo 'selected'?>>Bawahan</option>
		        					<option value="4" <? if($satker->getField('SIFAT') == 4) echo 'selected'?>>Fungsional</option>
		        				</select>
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Eselon
			        		</label>
		        			<div class="col-lg-3 col-sm-12">
		        				<select name="reqEselon" class="form-control">
		        					<? while($eselon->nextRow()){?>
		        						<option  value="<?=$eselon->getField('ESELON_ID')?>"
		        							<? if($eselon->getField('ESELON_ID') == $reqEselon) echo 'selected'?>><?=$eselon->getField('NAMA')?>
		        						</option>
		        					<? }?>
		        				</select>	
		        			</div>
		        		</div>

		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Kode
			        		</label>
		        			<div style="margin-left: 10px;">
		        				<input type="text" class="form-control" name="reqKode" id="reqKode" value="<?=$reqKode?>" />
		        			</div>
		        		</div>

		        		<div class="card-title">
		                    <h3 class="card-label">Data Pejabat</h3>
		                </div>

		                <div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			NIP Baru
			        		</label>
		        			<div  class="col-lg-4 col-sm-12">
		        				<input type="text" class="form-control" name="reqNip" id="reqNip" value="<?=$reqNip?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Nama
			        		</label>
		        			<div  class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" readonly name="reqNama" id="reqNama" value="<?=$reqNama?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			TMT Jabatan
			        		</label>
		        			<div  class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" readonly name="reqTmt" id="reqTmt" value="<?=$reqTmt?>" />
		        			</div>
		        		</div>		        		

		        		
					</div>

					<div id="alamat" class="w3-container w3-border city" style="display:none">
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Alamat
			        		</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<textarea name="reqAlamat" cols="100"  class="form-control" rows="3"><?=$reqAlamat?></textarea>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Kodepos
			        		</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<input type="text" class="form-control" name="reqKodepos" id="reqKodepos" value="<?=$reqKodepos?>" />
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Telepon
			        		</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<input type="text" class="form-control" name="reqTelepon" id="reqTelepon" value="<?=$reqTelepon?>" />
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Faximile
			        		</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<input type="text" class="form-control" name="reqFaximile" id="reqFaximile" value="<?=$reqFaximile?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Email
			        		</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqEmail" id="reqEmail" value="<?=$reqEmail?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Propinsi
			        		</label>
		        			<div class="col-lg-5 col-sm-12">
		        				<select name = "reqPropinsi" id="reqPropinsi" class="form-control">				 
		        					<? 
		        					$propinsi->selectByParams(array(),-1,-1, ''); 
		        					while($propinsi->nextRow()){?>
		        						<option value="<?=$propinsi->getField('PROPINSI_ID')?>"<? if($propinsi->getField('PROPINSI_ID') == $reqPropinsi) echo 'selected'?>>
		        							<?=$propinsi->getField('NAMA')?>
		        						</option>
		        					<? }?>
		        				</select>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Kabupaten
			        		</label>
		        			<div class="col-lg-3 col-sm-12">
		        				<select name="reqKabupaten" id ="reqKabupaten" class="form-control">
		        					<? $kabupaten->selectByParams(array('PROPINSI_ID'=>$reqPropinsi),-1,-1, ''); while($kabupaten->nextRow()){?>
		        						<option  value="<?=$kabupaten->getField('KABUPATEN_ID')?>"
		        							<? if ($kabupaten->getField('KABUPATEN_ID') == $reqKabupaten) echo 'selected'?>><?=$kabupaten->getField('NAMA')?>
		        						</option>
		        					<? }?>
		        				</select>			
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Kecamatan
			        		</label>
		        			<div class="col-lg-3 col-sm-12">
		        				<select name="reqKecamatan" id="reqKecamatan"  class="form-control">
		        					<? $kecamatan->selectByParams(array('PROPINSI_ID'=>$reqPropinsi, 'KABUPATEN_ID'=>$reqKabupaten),-1,-1, ''); while($kecamatan->nextRow()){?>
		        						<option  value="<?=$kecamatan->getField('KECAMATAN_ID')?>"
		        							<? if ($kecamatan->getField('KECAMATAN_ID') == $reqKecamatan) echo 'selected'?>><?=$kecamatan->getField('NAMA')?>
		        						</option>
		        					<? }?>
		        				</select>			
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Kelurahan
			        		</label>
		        			<div class="col-lg-3 col-sm-12">
		        				<select name="reqKelurahan" id="reqKelurahan" class="form-control">
		        					<? $kelurahan->selectByParams(array('PROPINSI_ID'=>$reqPropinsi, 'KABUPATEN_ID'=>$reqKabupaten, 'KECAMATAN_ID'=>$reqKecamatan),-1,-1, ''); while($kelurahan->nextRow()){?>
		        						<option  value="<?=$kelurahan->getField('KELURAHAN_ID')?>"
		        							<? if ($kelurahan->getField('KELURAHAN_ID') == $reqKelurahan) echo 'selected'?>><?=$kelurahan->getField('NAMA')?>
		        						</option>
		        					<? }?>
		        				</select>	
		        			</div>
		        		</div>


		        		
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-lg-9">
								<input type="hidden" name="reqMode" value="<?=$reqMode?>" />
								<input type="hidden" name="reqId" value="<?=$reqId?>" />
								<input type="hidden" name="reqPegawaiId" id="reqPegawaiId" value="<?=$reqPegawaiId?>"/>
								<input type="hidden" name="reqPangkatId" id="reqPangkatId" value="<?=$reqPangkatId?>"/>
								<button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
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

	$("#reqNip, #reqNipLama").keypress(function(e) {
		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
			return false;
		}
	});

	$('#reqPropinsi').bind('change', function(ev) {
		var propinsi = $('#reqPropinsi').val();
		$.getJSON('json-main/lokasi_json/getKabupaten?reqPropinsiId='+propinsi, function (data) 
		{
	            Result = data; //Use this data for further creation of your elements.
	            var items = "";
	            items += "<option value='' disabled selected>Pilih Kabupaten</option>";
	            $.each(data, function (i, SingleElement) {

	            	items += "<option value='" + SingleElement.kabupaten_id + "'>" + SingleElement.kabupaten + "</option>";
	            });
	            $("#reqKabupaten").html(items);
				// $.uniform.update("#reqKecamatan"); 
				// $.uniform.update("#reqKelurahan");             
			});
	});
	$('#reqKabupaten').bind('change', function(ev) {
		var kabupaten = $('#reqKabupaten').val();
			//alert(kabupaten);
			$.getJSON('json-main/lokasi_json/getKecamatan?reqKabupatenId='+kabupaten, function (data) 
			{
	            Result = data; //Use this data for further creation of your elements.
	            var items = "";
	            items += "<option value='' disabled selected>Pilih Kecamatan</option>";
	            $.each(data, function (i, SingleElement) {
	            	items += "<option value='" + SingleElement.kecamatan_id + "'>" + SingleElement.kecamatan + "</option>";
					//alert(SingleElement.kecamatan);
				});
	            $("#reqKecamatan").html(items);

	            var items = "";			
	            $("#reqKelurahan").html(items); 
				// $.uniform.update("#reqKelurahan"); 
			});
		});
	$('#reqKecamatan').bind('change', function(ev) {
			//$("#reqKabupaten").reset(); 
			var kecamatan = $('#reqKecamatan').val();
			$.getJSON('json-main/lokasi_json/getKelurahan?reqKecamatanId='+kecamatan, function (data) 
			{
	            Result = data; //Use this data for further creation of your elements.
	            var items = "";
	            items += "<option value='' disabled selected>Pilih Desa</option>";
	            //items += "<option value=0> -- </option>";
	            $.each(data, function (i, SingleElement) {
	            	items += "<option value='" + SingleElement.kelurahan_id + "'>" + SingleElement.kelurahan + "</option>";
	            });
	            $("#reqKelurahan").html(items);
				// $.uniform.update("#reqKecamatan"); 

			});
		});		
	
	$("#reqNip, #reqNipLama").keyup(function(e) {
		if( $("#reqNip").val() != '' || $("#reqNipLama").val() != '' ){
			$.getJSON('json-main/satuan_kerja_json/get_pejabat/?reqNip='+$("#reqNip").val()+'&reqNipLama='+$("#reqNipLama").val(),
				function(data){
					$("#reqPegawaiId").val(data.pegawai_id);
					$("#reqNama").val(data.pegawai_nama);
					$("#reqPangkatId").val(data.pegawai_pangkat_id);
					$("#reqTmt").val(data.pegawai_tmt_jabatan);
				});
		}
	});


	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-main/satuan_kerja_json/add";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNamaSuamiIstri: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqTglLahir: {
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
                                document.location.href = "app/index/master_satker";
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

	
</script>