<?
include_once("functions/personal.func.php");

$this->load->model("base/CatatanPrestasi");
$this->load->model("base/TingkatHukuman");
$this->load->model("base/JenisHukuman");
$this->load->model("base/PejabatPenetap");




$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');


$tingkat_catatan_prestasi = new TingkatHukuman();
$jenis_catatan_prestasi = new JenisHukuman();
$pejabat_penetap = new PejabatPenetap();





if(empty($reqRowId))
{
	$reqMode="insert";
}
else
{

	$prestasi = new CatatanPrestasi();
	$prestasi->selectByParams(array('PRESTASI_KERJA_ID'=>$reqRowId));
	// echo $cuti->query;exit;
	$prestasi->firstRow();
	$reqRowId					= $prestasi->getField('PRESTASI_KERJA_ID');
	if( $prestasi->getField('PEJABAT_PENETAP_ID')==''){
		$reqStatus='baru';
		$reqDisplayBaru='';
		$reqDisplay='none';
	}else{
		$reqDisplayBaru='none';
		$reqDisplay='';
	}
	$reqPjPenetapNama= $prestasi->getField('PEJABAT_PENETAP');
	$reqPjPenetapId= $prestasi->getField('PEJABAT_PENETAP_ID');

	$reqPRESTASI_KERJA_ID = $prestasi->getField('PRESTASI_KERJA_ID');
	$reqTahun 			= $prestasi->getField('TAHUN');
	$reqPrestasi = $prestasi->getField('NAMA');
	$reqTglSK = dateToPageCheck($prestasi->getField('TANGGAL_SK'));
	$reqNoSK				= $prestasi->getField('NO_SK');
	$reqPejabatPenetap				= $prestasi->getField('PEJABAT_PENETAP_ID');
	$reqKeterangan				= $prestasi->getField('KETERANGAN');

	// echo $reqTmtJabatan;exit;
	$reqMode="update";

}

	


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
						<a class="" href="app/index/catatan_prestasi?reqId=<?=$reqId?>">Catatan Prestasi</a>
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
	        			<label  class="col-form-label text-right col-lg-2 col-sm-12">Tahun</label>
	        			<div class="col-lg-3 col-sm-12">
	        				<input type="text" style="width:100px" id="reqTahun" name="reqTahun" <?=$read?> value="<?=$reqTahun?>" title="Tahun harus diisi" required class="form-control" /></td>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label  class="col-form-label text-right col-lg-2 col-sm-12">Prestasi</label>
	        			<div class="col-lg-3 col-sm-12">
	        				<input type="text" id="reqTahun" name="reqPrestasi" <?=$read?> value="<?=$reqPrestasi?>"class="form-control" /></td>
	        			</div>
	        		</div>
	        		
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. SK</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" style="width:250px" <?=$read?> class="form-control" name="reqNoSK" value="<?=$reqNoSK?>" title="No SK harus diisi" class="required" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tgl SK</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" style="width:100px" <?=$read?> id="reqTglSK" class="form-control" name="reqTglSK" maxlength="10"  value="<?=$reqTglSK?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pejabat Penetap</label>
	        			<div class="col-lg-6 col-sm-12">
				        	<input type="hidden" id="reqStatusPejabatPenetap" name="reqStatusPejabatPenetap" value="<?=$reqStatus?>" />
			                <div id="baru_status" style="display:<?=$reqDisplayBaru?>">
			            	<input type="text" style="width:225px;" id="reqPjPenetap_Baru" class="form-control" name="reqPjPenetap_Baru" <?=$read?> value="<?=$reqPjPenetapNama?>" />
			                <? if($disabled == ''){?>
			                	<img src="images/button_cancel.png" style="cursor:pointer" id="image_cancel" onclick="ShowHiddenId('')">
			                <? }?>
			                </div>
			                
			                <div id="select_status" style="display:<?=$reqDisplay?>">
			            	<? $pejabat_penetap->selectByParams(array());?>
			                <select <?=$disabled?> name="reqPjPenetap" id="reqPjPenetap" class="form-control">
			                    <? while($pejabat_penetap->nextRow()){?>
			                        <option value="<?=$pejabat_penetap->getField('PEJABAT_PENETAP_ID')?>" <? if($reqPjPenetapId == $pejabat_penetap->getField('PEJABAT_PENETAP_ID')) echo 'selected';?>><?=$pejabat_penetap->getField('JABATAN')?></option>
			                    <? }?>
			                </select>
			                <? if($disabled == ''){?>
			                	<img src="images/add.png" style="cursor:pointer" title="Tambah Data" id="image_add" height="15" width="15" onclick="ShowHiddenId('baru')">
			                <? }?>
			                </div>
	        			</div>
	        		</div>

	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Keterangan</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<textarea <?=$disabled?> class="form-control" name="reqKeterangan" cols="35"> <?=$reqKeterangan?></textarea>
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

	$("#reqTglSK,#reqTahun").keypress(function(e) {
		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
			return false;
		}
	});

	function ShowHiddenId(status){
		if(status=='baru'){
			document.getElementById('baru_status').style.display = '';
			document.getElementById('select_status').style.display = 'none';
			document.getElementById('image_cancel').style.display = '';
		}else{
			document.getElementById('baru_status').style.display = 'none';
			document.getElementById('select_status').style.display = '';
		}
		document.getElementById('reqStatusPejabatPenetap').value = status;
	}

	$(function () {
		$("[rel=tooltip]").tooltip({ placement: 'right'});
		document.getElementById('image_cancel').style.display = 'none';
		document.getElementById('baru_status').style.display = 'none';
		document.getElementById('select_status').style.display = '';
		document.getElementById('image_add').style.display = '';
	})


	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#reqTglSK').datepicker({
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
		var formSubmitUrl = "json-main/catatan_prestasi_json/add";
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
                                document.location.href = "app/index/catatan_prestasi?reqId=<?=$reqId?>";
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