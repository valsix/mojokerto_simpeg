<?
$this->load->model("base-data/InfoData");

$reqPegawaiId= $this->pegawaiId;
$reqRowId= $this->input->get('reqRowId');

$set = new InfoData();
$set->selectbyparamsjabatandata(array('A.RIWAYAT_JABATAN_ID'=>$reqRowId));
// echo $set->query;exit;
$set->firstRow();
$reqRowId= $set->getField('RIWAYAT_JABATAN_ID');
$reqNamaJabatan= $set->getField('JABATAN');
$reqEselon= $set->getField('ESELON_ID');
$reqTMTJabatan= dateToPageCheck(datetimeToPage($set->getField('TMT_JABATAN'), "date"));
$reqTh= $set->getField('MASA_JAB_TAHUN');
$reqBl= $set->getField('MASA_JAB_BULAN');
unset($set);

if($reqRowId == "")
{
	$reqMode = 'insert';
}
else
{
	$reqMode = 'update';
}

$statement="";
$set= new InfoData();
$arreselon= [];
$set->selectbyeselon(array(), -1,-1,$statement,$sOrder);
// echo $set->query;exit;
while($set->nextRow())
{
	$arrdata= [];
	$arrdata["id"]= $set->getField("ESELON_ID");
	$arrdata["text"]= $set->getField("NAMA");
	array_push($arreselon, $arrdata);
}
unset($set);
// print_r($arragama);exit;
// $disabled = "";
// if (!empty($reqRowId))
// {
// 	$disabled = "disabled";	
// }
?>
<script type="text/javascript" src="functions/globalfunction.js"></script>

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Data Riwayat</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Riwayat Jabatan</a>
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
                    <h3 class="card-label">Riwayat Jabatan</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama Jabatan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" <?=$disabled?> placeholder="Masukkan Nama Jabatan"name="reqNamaJabatan" id="reqNamaJabatan" value="<?=$reqNamaJabatan?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Eselon</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<select class="form-control select2" id="kteselon" name="reqEselon">
	        					<option value=""></option>
	        					<?
	        					foreach($arreselon as $item) 
	        					{
	        						$selectvalid= $item["id"];
	        						$selectvaltext= $item["text"];
	        					?>
	        					<option value="<?=$selectvalid?>" <? if($reqEselon == $selectvalid) echo "selected";?>><?=$selectvaltext?></option>
	        					<?
	        					}
	        					?>
	        				</select>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Jabatan</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
	        					<input type="text" class="form-control" <?=$disabled?> id="kttmtjabatan" name="reqTMTJabatan" readonly="readonly" placeholder="Masukkan TMT " value="<?=$reqTMTJabatan?>" />
	        					<div class="input-group-append">
	        						<span class="input-group-text">
	        							<i class="la la-calendar"></i>
	        						</span>
	        					</div>
		        			</div>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Masa Kerja</label>
	        			<div class="form-group col-xs-3 col-xs-offset-1">
	        				<input type="text" style="width:100px;margin-left: 11px"  <?=$disabled?> class="form-control" placeholder="Tahun" maxlength="4" name="reqTh" id="reqTh" value="<?=$reqTh?>" />
	        			</div>
	        			<div class="col-form-label form-group col-xs-3">
	        				&nbsp;&nbsp;&nbsp;Th&nbsp;&nbsp;&nbsp;
	        			</div>
	        			<div class="form-group col-xs-3">
	        				<input type="text" style="width:100px;" class="form-control" <?=$disabled?> placeholder="Bulan" maxlength="2" name="reqBl" id="reqBl" value="<?=$reqBl?>" />
	        			</div>
	        			<div class="col-form-label form-group col-xs-3">
	        				&nbsp;&nbsp;&nbsp;Bl&nbsp;&nbsp;&nbsp;
	        			</div>
	        		</div>
	        	</div>
	        	<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
	        				<input type="hidden" name="reqRowId" value="<?=$reqRowId?>">
	        				<input type="hidden" name="reqDataId" value="<?=$reqDataId?>">
	        				<input type="hidden" name="reqPegawaiId" value="<?=$reqPegawaiId?>">
	        				<input type="hidden" name="reqTipePegawaiId" value="<?=$reqTipePegawaiParentId?>">
	        				<input type="hidden" name="reqRowTipePegawaiId" value="<?=$reqTipePegawaiId?>">
	        				<button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
	        				<button onclick="kembali()" type="button" class="btn btn-warning font-weight-bold mr-2">Kembali</button>
	        			</div>
	        		</div>
	        	</div>
	        </form>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).on("input", "#reqTh,#reqBl,#reqGajiPokok,#reqKredit", function() {
		this.value = this.value.replace(/\D/g,'');
	});

	function kembali() {
		window.location.href='app/index/pegawai_jabatan'
	}
	
	$('#kteselon').select2({
		placeholder: "Pilih eselon"
	});

    arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#kttanggalkeputusan,#kttmtgol,#kttanggalnota,#kttmtjabatan,#kttmteselon').datepicker({
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
		var formSubmitUrl = "json-data/info_data_json/jabatanriwayatadd";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNamaJabatan: {
						validators: {
							notEmpty: {
								message: 'Nama Jabatan harus diisi'
							}
						}
					},
					reqEselon: {
						validators: {
							notEmpty: {
								message: 'Eselon harus diisi'
							}
						}
					},
					reqTMTJabatan: {
						validators: {
							notEmpty: {
								message: 'TMT Jabatan harus diisi'
							}
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
			        		document.location.href = "app/index/pegawai_jabatan";
			        		// window.location.reload();
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