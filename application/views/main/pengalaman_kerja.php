<?
include_once("functions/personal.func.php");

$this->load->model("base/Pegawai");

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$reqId= $this->input->get('reqId');

$set= new Pegawai();
$set->selectByParamsForm(array("A.PEGAWAI_ID"=>$reqId),-1,-1);
// echo $set->query;exit;
$set->firstRow();
$reqNipBaru= $set->getField('NIP_BARU');
$reqNama= $set->getField('NAMA');
$reqEmail= $set->getField('EMAIL');
$reqAlamat= $set->getField('ALAMAT');
$reqPangkatTerkahir= $set->getField('PANGKAT_KODE')." (".$set->getField('PANGKAT_NAMA').")";
$reqTmtPangkat= datetimeTodatePageCheck($set->getField('LAST_TMT_PANGKAT'));
$reqJabatanTerkahir= $set->getField('LAST_JABATAN');
$reqSatker= $set->getField('SATKER_ID');
$reqTmtJabatan= datetimeTodatePageCheck($set->getField('LAST_TMT_JABATAN'));
$reqTanggalLahir= datetimeTodatePageCheck($set->getField('TGL_LAHIR'));
$reqPendidikanTerkahir= $set->getField('PENDIDIKAN_NAMA');
$reqJurusanTerkahir= $set->getField('LAST_DIK_JURUSAN');
$reqTahunLulus= $set->getField('LAST_DIK_TAHUN');

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

	table {
	  border-collapse: collapse;
	  width: 100%;
	}

	th{
		background-color: #BD1007;
		text-align: center;
		color: white;
	}
	td{
		text-align: left;
	}
	th, td {
	  padding: 8px;
	  border-bottom: 1px solid #ddd;
	}

	tr:hover {background-color: #ee9d01;}
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
						<a class="text-muted">Pengalaman Kerja</a>
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
                    <h3 class="card-label">Pengalaman Kerja</h3>
                </div>
            </div>
            <table>
            	<table style="width:100%; text-align:center;">
            		<tr>
            			<th>Tgl. Mulai Kerja</th>
            			<th>Instansi</th>
            			<th>Jabatan</th>
            			<th>Masa Kerja(Th)</th>
            			<th>Masa Kerja(Bl)</th>
            			<th>Hapus</th>
            		</tr>
            		<tr onclick="apply(1)">
            			<td id='t11'>a</td>
            			<td id='t21'>b</td>
            			<td id='t31'>c</td>
            			<td id='t41'>d</td>
            			<td id='t51'>e</td>
            			<td><i class="fa fa-trash" aria-hidden="true" style="color:#BD1007;" ></td>
            		</tr>
            	</table>
            </table>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tgl. Mulai Kerja</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" <?=$readonly?> style="background-color: #F3F6F9;" placeholder="Masukkan NIP baru" name="reqNipBaru" id="a1"/>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Instansi</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" <?=$readonly?> style="background-color: #F3F6F9;" placeholder="Masukkan NIP baru" name="reqNipBaru" id="a2" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jabatan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" <?=$readonly?> style="background-color: #F3F6F9;" placeholder="Masukkan NIP baru" name="reqNipBaru" id="a3" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Masa Kerja(Th)</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" <?=$readonly?> style="background-color: #F3F6F9;" placeholder="Masukkan NIP baru" name="reqNipBaru" id="a4" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Masa Kerja(Bl)</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" <?=$readonly?> style="background-color: #F3F6F9;" placeholder="Masukkan NIP baru" name="reqNipBaru" id="a5" />
	        			</div>
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
	        </form>
        </div>
    </div>
</div>

<script type="text/javascript">

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

	function apply(x) {
		$("#a1").val($("#t1"+x).html());
		$("#a2").val($("#t2"+x).html());
		$("#a3").val($("#t3"+x).html());
		$("#a4").val($("#t4"+x).html());
		$("#a5").val($("#t5"+x).html());
		// body...
	}

</script>

<!-- <button onclick="tes()">tesss</button>
<script>
    function tes() {
        // pageUrl= "app/loadUrl/main/pegawai_data";
        pageUrl= "iframe/index/pegawai_data";
        openAdd(pageUrl);
    }
</script> -->