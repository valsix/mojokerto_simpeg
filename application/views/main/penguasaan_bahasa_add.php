<?
include_once("functions/personal.func.php");

$this->load->model("base/PenguasaanBahasa");

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

if(empty($reqRowId))
{
	$reqMode="insert";
}
else
{
	$set = new PenguasaanBahasa();
	$set->selectByParams(array('BAHASA_ID'=>$reqRowId));
	// echo $set->query;exit;
	$set->firstRow();
	$reqRowId= (int)$set->getField('BAHASA_ID');
	$reqNamaBahasa= $set->getField('NAMA');
	$reqJenisBahasa= $set->getField('JENIS');
	$reqKemampuanBicara= $set->getField('KEMAMPUAN');

	$reqMode="update";
}
$arrTahun= setTahunLoop(3,1);
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
						<a class="" href="app/index/penguasaan_bahasa?reqId=<?=$reqId?>">Penguasaan Bahasa</a>
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
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data" autocomplete="off">
	        	<div class="card-body">
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">Jenis Bahasa</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<select <?=$disabled?> name="reqJenisBahasa" class="form-control" id='reqJenisBahasa'>
	        					<option value="" <? if($reqJenisBahasa == '') echo 'selected'?>>Pilih</option>
	        					<option value="1" <? if($reqJenisBahasa == 1) echo 'selected'?>>Asing</option>
	        					<option value="2" <? if($reqJenisBahasa == 2) echo 'selected'?>>Daerah</option>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama Bahasa</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" class="form-control" name="reqNamaBahasa" id="reqNamaBahasa" required value="<?=$reqNamaBahasa?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Kemampuan Bicara</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<select <?=$disabled?> name="reqKemampuanBicara" class="form-control" id='reqKemampuanBicara'>
	        					<option value="" <? if($reqKemampuanBicara == '') echo 'selected'?>>Pilih</option>
	        					<option value="1" <? if($reqKemampuanBicara == 1) echo 'selected'?>>Aktif</option>
	        					<option value="2" <? if($reqKemampuanBicara == 2) echo 'selected'?>>Pasif</option>
	        				</select>
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

	

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-main/penguasaan_bahasa_json/add";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNamaBahasa: {
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
                                document.location.href = "app/index/penguasaan_bahasa?reqId=<?=$reqId?>";
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

	$("#reqJenisBahasa, #reqKemampuanBicara").select2({
    	placeholder: "Pilih salah satu data",
    	allowClear: true
  	});


</script>