<?
include_once("functions/personal.func.php");

$this->load->model("base/Eselon");
$this->load->model("base/Pangkat");


$reqId= $this->input->get('reqId');

$pgtitle= $pg;
$pgtitle= churuf(str_replace("_", " ", str_replace("add", "", $pgtitle)));

$pangkatMin	= new Pangkat();
$pangkatMax	= new Pangkat();
$pangkatMin->selectByParams(array(1=>1),-1,-1,'');
$pangkatMax->selectByParams(array(1=>1),-1,-1,'');



if(empty($reqId))
{
	$reqMode="insert";
}
else
{
	$set = new Eselon();
	$set->selectByParams(array('ESELON_ID'=>$reqId));
	// echo $set->query;exit;
	$set->firstRow();
	$reqId= $set->getField('ESELON_ID');
	
	$reqNamaEselon 		= $set->getField('NAMA');
	$reqTunjangan			= $set->getField('TUNJANGAN');
	$reqPangkatMinimal 	= $set->getField('PANGKAT_MINIMAL');
	$reqPangkatMaksimal	= $set->getField('PANGKAT_MAKSIMAL');

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
						<a class="" href="app/index/master_diklat"><?=$pgtitle?></a>
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" class="form-control" name="reqNamaEselon" id="reqNamaEselon" required value="<?=$reqNamaEselon?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tunjangan</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" class="form-control" name="reqTunjangan" id="reqTunjangan" required value="<?=$reqTunjangan?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pangkat Minimal</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<select name="reqPangkatMinimal" id="reqPangkatMinimal" class="form-control" >
	        					<? while($pangkatMin->nextRow()){?>
	        						<option  value="<?=$pangkatMin->getField('PANGKAT_ID')?>"
	        							<? if($pangkatMin->getField('PANGKAT_ID') == $reqPangkatMinimal) echo 'selected';?>>
	        							<?=$pangkatMin->getField('KODE')?>

	        						</option>
	        					<? }?>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pangkat Maksimal</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<select name="reqPangkatMaksimal" id="reqPangkatMaksimal" class="form-control">
	        					<? while($pangkatMax->nextRow()){?>
	        						<option  value="<?=$pangkatMax->getField('PANGKAT_ID')?>"
	        							<? if($pangkatMax->getField('PANGKAT_ID') == $reqPangkatMaksimal) echo 'selected';?>>
	        							<?=$pangkatMax->getField('KODE')?>

	        						</option>
	        					<? }?>
	        				</select>			
	        			</div>
	        		</div>
	        		
	        		<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
	        				<input type="hidden" name="reqId" value="<?=$reqId?>">
	        				<input type="hidden" name="reqRowId" value="<?=$reqRowId?>">
	        				<button type="button"  onclick="history.back()" class="btn btn-light-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>
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
	});


	$('#reqTunjangan').bind('keyup paste', function(){
		this.value = this.value.replace(/[^0-9]/g, '');
	});

	

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-main/eselon_json/add";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNamaEselon: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi Nama'
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
                                document.location.href = "app/index/master_eselon";
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


</script>