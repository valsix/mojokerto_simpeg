<?
include_once("functions/personal.func.php");

$this->load->model("base/RiwayatTugasTambahan");
$this->load->model("base/Pegawai");
$this->load->model("base/Core");

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

if(empty($reqRowId))
{
	$reqMode="insert";

	$tempStatus='baru';
	$tempDisplayBaru='';
	$tempDisplay='none';
}
else
{
	$set= new RiwayatTugasTambahan();
	$set->selectByParams(array('JABATAN_TAMBAHAN_ID'=>$reqRowId, 'PEGAWAI_ID'	=> $reqId));
	$set->firstRow();
	// echo $set->query; exit;
	$reqJABATAN_TAMBAHAN_ID= $set->getField('JABATAN_TAMBAHAN_ID');
	$reqSatkerId= $set->getField('SATKER_ID');
	$reqNoSK= $set->getField('NO_SK');
	$reqEselon= $set->getField('ESELON_ID');
	$reqNamaJabatan= $set->getField('NAMA');
	$reqNoPelantikan= $set->getField('NO_PELANTIKAN');
	$reqTunjangan= $set->getField('TUNJANGAN');
	$reqTglSK= dateToPageCheck($set->getField('TANGGAL_SK'));
	$reqTMTJabatan= dateToPageCheck($set->getField('TMT_JABATAN'));
	$reqTMTEselon= dateToPageCheck($set->getField('TMT_ESELON'));
	$reqTglPelantikan= dateToPageCheck($set->getField('TANGGAL_PELANTIKAN'));
	$reqBlnDibayar= dateToPageCheck($set->getField('BULAN_DIBAYAR'));
	$reqTMTJabatanFungsional= dateToPageCheck($set->getField('TMT_JABATAN_FUNGSIONAL'));
	$reqTMTTugasTambahan= dateToPageCheck($set->getField('TMT_TUGAS_TAMBAHAN'));
	$reqTglBerakhir= dateToPageCheck($set->getField('TANGGAL_BERAKHIR'));
	$reqKeteranganBUP= $set->getField('KETERANGAN_BUP');

	if( $set->getField('PEJABAT_PENETAP_ID')==''){
		$reqStatus='baru';
		$reqDisplayBaru='';
		$reqDisplay='none';
	}else{
		$reqDisplayBaru='none';
		$reqDisplay='';
	}

	$reqPjPenetapNama= $set->getField('PEJABAT_PENETAP');
	$reqPjPenetapId= $set->getField('PEJABAT_PENETAP_ID');
	$reqMode="update";
}

$eselon= new Core();
$eselon->selectByParamsEselon(); 

$pejabat_penetap= new Core();
$pejabat_penetap->selectByParamsPejabatPenetap(); 

$readonly = "readonly";

$pegawai= new Pegawai();
$pegawai->selectByParams(array('P.PEGAWAI_ID'=>$reqId), -1, -1);
$pegawai->firstRow();
// echo $pegawai->query;exit;
$reqTipePegawaiParentId = substr($pegawai->getField('TIPE_PEGAWAI_ID'),0,1);
$reqTipePegawaiId= $pegawai->getField('TIPE_PEGAWAI_ID');
// echo $reqTipePegawaiId;exit;
?>

<!-- Bootstrap core CSS -->
<link href="lib/bootstrap-3.3.7/docs/examples/navbar/navbar.css" rel="stylesheet">
<script type="text/javascript" src="lib/easyui/globalfunction.js"></script>

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
	        			<div class="col-md-8">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			No. SK
				        		</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="text" class="form-control" name="reqNoSK" id="reqNoSK" value="<?=$reqNoSK?>" />
			        			</div>
			        		</div>
		        		</div>
		        		<div class="col-md-4">
		        			<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			Tanggal SK
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTglSK" value="<?=$reqTglSK?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
		        		</div>
	        		</div>

	        		<div class="form-group row">
	        			<div class="col-md-8">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-3 col-sm-12">
				        			Nama Jabatan
				        		</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<input type="hidden" name="reqTipePegawaiId" value="<?=$reqTipePegawaiParentId?>" />
			        				<input type="hidden" name="reqSatkerId" id="reqSatkerId" value="<?=$reqSatkerId?>" />
			        				<input type="text" class="form-control" name="reqNamaJabatan" id="reqNamaJabatan" value="<?=$reqNamaJabatan?>" />
			        			</div>
			        		</div>
		        		</div>
		        		<div class="col-md-4">
		        			<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			TMT Mutasi
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTMTJabatan" value="<?=$reqTMTJabatan?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
		        		</div>
	        		</div>

					<?
					if($reqTipePegawaiId == 11)
					{
					?>
					<div class="form-group row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			Eselon
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<select class="form-control" id="reqEselon" name="reqEselon">
			        					<?while($eselon->nextRow()){?>
						                    <option value="<?=$eselon->getField('ESELON_ID')?>" <? if($reqEselon == $eselon->getField('ESELON_ID')) echo 'selected';?>><?=$eselon->getField('NAMA')?></option>
						                <? }?>
			        				</select>
			        			</div>
			        		</div>
		        		</div>
		        		<div class="col-md-6">
		        			<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			TMT Eselon
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTMTEselon" value="<?=$reqTMTEselon?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
		        		</div>
	        		</div>
	        		<div class="form-group row">
	        			<div class="col-md-6">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			TMT Tugas Tambahan
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTMTTugasTambahan" value="<?=$reqTMTTugasTambahan?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
		        		</div>
		        		<div class="col-md-6">
		        			<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			Tgl. Berakhir
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTglBerakhir" value="<?=$reqTglBerakhir?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
		        		</div>
	        		</div>
		        	<?
		        	}
		        	else
		        	{
		        	?>
		        	<div class="form-group row">
	        			<div class="col-md-4">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-6 col-sm-12">
				        			TMT Jabatan Fungsional
				        		</label>
			        			<div class="col-lg-6 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTMTJabatanFungsional" value="<?=$reqTMTJabatanFungsional?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
		        		</div>
		        		<div class="col-md-4">
		        			<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-5 col-sm-12">
				        			TMT Tugas Tambahan
				        		</label>
			        			<div class="col-lg-7 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTMTTugasTambahan" value="<?=$reqTMTTugasTambahan?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
		        		</div>
		        		<div class="col-md-4">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			Tgl. Berakhir
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTglBerakhir" value="<?=$reqTglBerakhir?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
		        		</div>
	        		</div>
		        	<?
		        	}
		        	?>

		        	<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pj Penetap</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="hidden" id="reqStatusPejabatPenetap" name="reqStatusPejabatPenetap" value="<?=$reqStatus?>" />
			                <div id="baru_status" style="display:<?=$reqDisplayBaru?>">
			            	<input type="text" style="width:225px;" id="reqPjPenetap_Baru" class="form-control" name="reqPjPenetap_Baru" <?=$read?> value="<?=$reqPjPenetapNama?>" />
			                <? if($disabled == ''){?>
			                	<img src="images/button_cancel.png" style="cursor:pointer" id="image_cancel" onclick="ShowHiddenId('')">
			                <? }?>
			                </div>
			                
			                <div id="select_status" style="display:<?=$reqDisplay?>">
				            	<? $pejabat_penetap->selectByParamsPejabatPenetap(array());?>
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
	        			<div class="col-md-4">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-6 col-sm-12">
				        			No. Pelantikan
				        		</label>
			        			<div class="col-lg-6 col-sm-12">
			        				<input type="text" class="form-control" name="reqNoPelantikan" id="reqNoPelantikan" value="<?=$reqNoPelantikan?>" />
			        			</div>
			        		</div>
		        		</div>
		        		<div class="col-md-4">
		        			<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			Tgl. Pelantikan
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTglPelantikan" value="<?=$reqTglPelantikan?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
		        		</div>
		        		<div class="col-md-4">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-4 col-sm-12">
				        			Tunjangan
				        		</label>
			        			<div class="col-lg-8 col-sm-12">
			        				<input type="text" placeholder class="form-control" id="reqTunjangan" name="reqTunjangan" OnFocus="FormatAngka('reqTunjangan')" OnKeyUp="FormatUang('reqTunjangan')" OnBlur="FormatUang('reqTunjangan')" value="<?=numberToIna($reqTunjangan)?>" />
			        			</div>
			        		</div>
		        		</div>
	        		</div>

	        		<div class="form-group row">
	        			<div class="col-md-4">
	        				<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-6 col-sm-12">
				        			Bln. Dibayar
				        		</label>
			        			<div class="col-lg-6 col-sm-12">
			        				<div class="input-group date">
				        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqBlnDibayar" value="<?=$reqBlnDibayar?>" />
				        				<div class="input-group-append">
				        					<span class="input-group-text">
				        						<i class="la la-calendar"></i>
				        					</span>
				        				</div>
				        			</div>
			        			</div>
			        		</div>
		        		</div>
		        		<div class="col-md-8">
		        			<div class="form-group row">
			        			<label class="col-form-label text-right col-lg-2 col-sm-12">
				        			Perpanjangan BUP
				        		</label>
			        			<div class="col-lg-10 col-sm-12">
			        				<input type="text" class="form-control" name="reqKeteranganBUP" id="reqKeteranganBUP" value="<?=$reqKeteranganBUP?>" />
			        			</div>
			        		</div>
		        		</div>
	        		</div>

	        		<div class="card-footer">
	        			<div class="row">
	        				<div class="col-lg-9">
	        					<input type="hidden" name="reqMode" value="<?=$reqMode?>" />
	        					<input type="hidden" name="reqId" value="<?=$reqId?>" />
	        					<input type="hidden" name="reqRowId" value="<?=$reqRowId?>" />
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

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-main/riwayat_tugas_tambahan_json/add";
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
                                document.location.href = "app/index/riwayat_tugas_tambahan?reqId=<?=$reqId?>";
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

	$('#reqPjPenetap').select2({
		placeholder: "Pilih Pejabat Penetap"
	});

	$('#reqEselon').select2({
		placeholder: "Pilih Eselon"
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