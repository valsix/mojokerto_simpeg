<?
include_once("functions/personal.func.php");

$this->load->model("base/Hukuman");
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


$tingkat_hukuman = new TingkatHukuman();
$jenis_hukuman = new JenisHukuman();
$pejabat_penetap = new PejabatPenetap();



if(empty($reqRowId))
{
	$reqMode="insert";
}
else
{

	$hukuman = new Hukuman();
	$hukuman->selectByParams(array('HUKUMAN_ID'=>$reqRowId));
	// echo $cuti->query;exit;
	$hukuman->firstRow();
	$reqRowId					= $hukuman->getField('HUKUMAN_ID');
	if( $hukuman->getField('PEJABAT_PENETAP_ID')==''){
		$reqStatus='baru';
		$reqDisplayBaru='';
		$reqDisplay='none';
	}else{
		$reqDisplayBaru='none';
		$reqDisplay='';
	}
	$reqPjPenetapNama= $hukuman->getField('PEJABAT_PENETAP');
	$reqPjPenetapId= $hukuman->getField('PEJABAT_PENETAP_ID');

	$reqHUKUMAN_ID = $hukuman->getField('HUKUMAN_ID');
	$reqNoSK	= $hukuman->getField('NO_SK');
	$reqPejabatPenetap = $hukuman->getField('PEJABAT_PENETAP_ID');
	$reqTanggalSK	= dateToPageCheck($hukuman->getField('TANGGAL_SK'));
	$reqTMTSK = dateToPageCheck($hukuman->getField('TMT_SK'));
	$reqJenisHukuman = $hukuman->getField('JENIS_HUKUMAN_ID');
	$reqTingkatHukuman = $hukuman->getField('TINGKAT_HUKUMAN_ID');
	$reqPeraturan = $hukuman->getField('PERATURAN_ID');
	$reqPermasalahan = $hukuman->getField('KETERANGAN');
	$reqMasihBerlaku		= $hukuman->getField('STATUS_BERLAKU');
	if($reqMasihBerlaku == 'Ya')
		$reqMasihBerlaku=1;
	else
		$reqMasihBerlaku=0;

	$reqTanggalMulai= dateToPageCheck($hukuman->getField('TANGGAL_MULAI'));
	$reqTanggalAkhir= dateToPageCheck($hukuman->getField('TANGGAL_AKHIR'));

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
						<a class="" href="app/index/hukuman?reqId=<?=$reqId?>">Hukuman</a>
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
	        			<label  class="col-form-label text-right col-lg-2 col-sm-12">Tingkat Hukuman</label>
	        			<div class="col-lg-3 col-sm-12">
	        				<select <?=$disabled?> name="reqTingkatHukuman" id="reqTingkatHukuman" class="form-control">
	        					<option value=""></option>
	        					<? 
	        					$tingkat_hukuman->selectByParamsEdit(array(),-1,-1, '');
	        					while($tingkat_hukuman->nextRow())
	        					{
	        						?>
	        						<option value="<?=$tingkat_hukuman->getField('TINGKAT_HUKUMAN_ID')?>" <? if($tingkat_hukuman->getField('TINGKAT_HUKUMAN_ID')==$reqTingkatHukuman) echo 'selected'?>><?=$tingkat_hukuman->getField('NAMA')?></option>
	        						<? 
	        					}
	        					?>
	        				</select>
							<input type="checkbox" name="reqMasihBerlaku" disabled="disabled" value="1" <? if($reqMasihBerlaku == 1) echo 'checked'?>/> Masih Berlaku<br />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jenis Hukuman</label>
	        			<div class="col-lg-2 col-sm-12">
					        	<? 
								if($reqJenisHukuman)
								{
								?>
				                <select <?=$disabled?> name="reqJenisHukuman" id="reqJenisHukuman" title="Jenis hukuman harus diisi" class="required form-control"  >
				                	<option value=""></option>
									<? $jenis_hukuman->selectByParamsEdit(array('TINGKAT_HUKUMAN_ID'=>$reqTingkatHukuman),-1,-1, '');
				                        while($jenis_hukuman->nextRow())
										{
									?>
				                        <option value="<?=$jenis_hukuman->getField('JENIS_HUKUMAN_ID')?>" <? if($jenis_hukuman->getField('JENIS_HUKUMAN_ID')==$reqJenisHukuman) echo 'selected'?>><?=$jenis_hukuman->getField('NAMA')?></option>
				                    <? 	
										}
									?>
								</select>
				                <? 
								}
								else{
								?>
				                <select <?=$disabled?> name="reqJenisHukuman" id="reqJenisHukuman" title="Jenis hukuman harus diisi" class=" form-control"  ><option></option></select>
				                <? 
								}
								?>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. SK</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" style="width:250px" <?=$read?> class="form-control" name="reqNoSK" value="<?=$reqNoSK?>" title="No SK harus diisi" class="required" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tanggal SK</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" style="width:100px" <?=$read?> id="reqTanggalSK" class="form-control" name="reqTanggalSK" maxlength="10"  value="<?=$reqTanggalSK?>" />
	        			</div>
	        		</div>
					<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT SK</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" style="width:100px" <?=$read?> id="reqTMTSK" class="form-control" name="reqTMTSK" maxlength="10"  value="<?=$reqTMTSK?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tanggal Mulai</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<input type="text"  name="reqTanggalMulai" class="form-control" id="reqTanggalMulai" class="dateIna" <?=$read?> maxlength="10"  value="<?=$reqTanggalMulai?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tanggal Akhir</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<input type="text"  name="reqTanggalAkhir" class="form-control" id="reqTanggalAkhir" class="dateIna" <?=$read?> maxlength="10"  value="<?=$reqTanggalAkhir?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Permasalahan</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<textarea <?=$disabled?> class="form-control" name="reqPermasalahan" cols="35"> <?=$reqPermasalahan?></textarea>
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

	$('#reqTingkatHukuman').bind('change', function(ev) {		
		var tingkat = $('#reqTingkatHukuman').val();
		$.getJSON('json-main/combo_json/jenishukuman?reqTingkat='+tingkat, function (data) 
        {
			//alert(tingkat);
            Result = data; //Use this data for further creation of your elements.
            var items = "";
			items += "<option></option>";
            $.each(data, function (i, SingleElement) {
				items += "<option value='" + SingleElement.jenis_hukuman_id + "'>" + SingleElement.jenis_hukuman + "</option>";
            });
						
            $("#reqJenisHukuman").html(items);
			// $.uniform.update("#reqJenisHukuman"); 
        });
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

	$("#reqTanggalAkhir, #reqTanggalMulai, #reqTanggalSK,#reqTMTSK").keypress(function(e) {
		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
			return false;
		}
	});


	arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#reqTanggalAkhir,#reqTanggalMulai,#reqTanggalSK,#reqTMTSK').datepicker({
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
		var formSubmitUrl = "json-main/hukuman_json/add";
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
                                document.location.href = "app/index/hukuman?reqId=<?=$reqId?>";
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