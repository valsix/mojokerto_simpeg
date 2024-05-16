<?
include_once("functions/personal.func.php");

$this->load->model("base/CatatanPrestasi");
$this->load->model("base/Core");
$this->load->library('globalfilepegawai');


$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

$pejabat_penetap = new Core();

if(empty($reqRowId))
{
	$reqMode="insert";
}
else
{
	$set = new CatatanPrestasi();
	$set->selectByParams(array('PRESTASI_KERJA_ID'=>$reqRowId));
	// echo $set->query;exit;
	$set->firstRow();
	$reqRowId= $set->getField('PRESTASI_KERJA_ID');
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

	$reqPRESTASI_KERJA_ID= $set->getField('PRESTASI_KERJA_ID');
	$reqTahun= $set->getField('TAHUN');
	$reqPrestasi= $set->getField('NAMA');
	$reqTglSK= dateToPageCheck($set->getField('TANGGAL_SK'));
	$reqNoSK= $set->getField('NO_SK');
	$reqPejabatPenetap= $set->getField('PEJABAT_PENETAP_ID');
	$reqKeterangan= $set->getField('KETERANGAN');
	$reqMode="update";
}

// untuk kondisi file
$vfpeg= new globalfilepegawai();
$riwayattable= "PRESTASI_KERJA";
$reqDokumenKategoriFileId= "0"; // ambil dari table KATEGORI_FILE, cek sesuai mode
$arrsetriwayatfield= $vfpeg->setriwayatfield($riwayattable);
// print_r($arrsetriwayatfield);exit;

$arrparam= array("reqId"=>$reqId, "reqRowId"=>$reqRowId, "riwayattable"=>$riwayattable, "lihatquery"=>"");
$arrambilfile= $vfpeg->ambilfile($arrparam);
// print_r($arrambilfile);exit;

$keycari= $riwayattable.";".$reqRowId;

$infofile= 0;
if(!empty($arrambilfile))
{
	$infofile= count(in_array_column($keycari, "vkey", $arrambilfile));
}
// echo $infofile;exit;



?>

<!-- Bootstrap core CSS -->
<link href="lib/bootstrap-3.3.7/docs/examples/navbar/navbar.css" rel="stylesheet">
<link href="assets/css/w3.css" rel="stylesheet" type="text/css" />


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
	        		<?
	        		if($infofile > 0)
	        		{
	        		?>
	        		<div class="w3-bar w3-black">
					    <a class="w3-bar-item w3-button tablink w3-red" onclick="opennewtab(event,'vformdata')">Data</a>
					    <?
			              	// area untuk upload file
		        			foreach ($arrsetriwayatfield as $key => $value)
		        			{
		        				$riwayatfield= $value["riwayatfield"];
		        				$vriwayattable= $value["vriwayattable"];
		        				$infolabel= $value["infolabel"];

		        				$vkeydetil= $vriwayattable.";".$reqRowId.";".$riwayatfield;
		        		?>
					    	<a class="w3-bar-item w3-button tablink" onclick="opennewtab(event, '<?=$vkeydetil?>')"><?=$infolabel?></a>
					    <?
							}
					    ?>
					</div>
					<?
					}
					?>

					<?
	        		if($infofile > 0)
	        		{
	        		?>
	        		<div id="vformdata" class="w3-container w3-border city">
	        		<?
	        		}
	        		?>

	        		<div class="form-group row">
	        			<label  class="col-form-label text-right col-lg-2 col-sm-12">Tahun</label>
	        			<div class="col-lg-3 col-sm-12">
	        				<input type="text" style="width:100px" id="reqTahun" name="reqTahun" <?=$read?> value="<?=$reqTahun?>" title="Tahun harus diisi" required class="form-control" /></td>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label  class="col-form-label text-right col-lg-2 col-sm-12">Prestasi</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" id="reqPrestasi" name="reqPrestasi" <?=$read?> value="<?=$reqPrestasi?>"class="form-control" /></td>
	        			</div>
	        		</div>
	        		
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. SK</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" <?=$read?> class="form-control" name="reqNoSK" value="<?=$reqNoSK?>" title="No SK harus diisi" class="required" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tgl SK
		        		</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" autocomplete="off" class="form-control kttanggal" name="reqTglSK" value="<?=$reqTglSK?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
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
				            	<? $pejabat_penetap->selectByParamsPejabatPenetap(array());?>
				                <select <?=$disabled?> name="reqPjPenetap" id="reqPjPenetap" class="form-control">
				                	<option value="" <? if($reqPjPenetapId == '') echo 'selected';?>>Pilih</option>
				                    <? while($pejabat_penetap->nextRow()){?>
				                        <option value="<?=$pejabat_penetap->getField('PEJABAT_PENETAP_ID')?>" <? if($reqPjPenetapId == $pejabat_penetap->getField('PEJABAT_PENETAP_ID')) echo 'selected';?>><?=$pejabat_penetap->getField('JABATAN')?></option>
				                    <? }?>
				                </select>			                
			                </div>
	        			</div>
	        			<div class="col-lg-1 col-sm-12">
	        				<? if($disabled == ''){?>
			                	<img src="images/add.png" style="cursor:pointer" title="Tambah Data" id="image_add" height="30"onclick="ShowHiddenId('baru')">
			                <? }?>
	        			</div>
	        		</div>

	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Keterangan</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<textarea <?=$disabled?> class="form-control" name="reqKeterangan" cols="35"> <?=$reqKeterangan?></textarea>
	        			</div>
	        		</div>

	        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12"></label>
		        			<?
			              	// area untuk upload file
		        			foreach ($arrsetriwayatfield as $key => $value)
		        			{
		        				$riwayatfield= $value["riwayatfield"];
		        				$riwayatfieldtipe= $value["riwayatfieldtipe"];
		        				$vriwayatfieldinfo= $value["riwayatfieldinfo"];
		        				$riwayatfieldinfo= " - ".$vriwayatfieldinfo;
		        				$riwayatfieldrequired= $value["riwayatfieldrequired"];
		        				$riwayatfieldrequiredinfo= $value["riwayatfieldrequiredinfo"];
		        				$vriwayattable= $value["vriwayattable"];
		        				$vlabelupload= $value["labelupload"];
		        				$vriwayatid= "";
		        				$vpegawairowfile= $reqDokumenKategoriFileId."-".$vriwayattable."-".$riwayatfield."-".$vriwayatid;
		        			?>

		        			<input type="hidden" id="reqDokumenRequired<?=$riwayatfield?>" name="reqDokumenRequired[]" value="<?=$riwayatfieldrequired?>" />
		        			<input type="hidden" id="reqDokumenRequiredNama<?=$riwayatfield?>" name="reqDokumenRequiredNama[]" value="<?=$vriwayatfieldinfo?>" />
		        			<input type="hidden" id="reqDokumenRequiredTable<?=$riwayatfield?>" name="reqDokumenRequiredTable[]" value="<?=$vriwayattable?>" />
		        			<input type="hidden" id="reqDokumenRequiredTableRow<?=$riwayatfield?>" name="reqDokumenRequiredTableRow[]" value="<?=$vpegawairowfile?>" />
		        			<input type="hidden" id="reqDokumenFileId<?=$riwayatfield?>" name="reqDokumenFileId[]" />
		        			<input type="hidden" id="reqDokumenKategoriFileId<?=$riwayatfield?>" name="reqDokumenKategoriFileId[]" value="<?=$reqDokumenKategoriFileId?>" />
		        			<input type="hidden" id="reqDokumenKategoriField<?=$riwayatfield?>" name="reqDokumenKategoriField[]" value="<?=$riwayatfield?>" />
		        			<input type="hidden" id="reqDokumenPath<?=$riwayatfield?>" name="reqDokumenPath[]" value="" />
		        			<input type="hidden" id="reqDokumenTipe<?=$riwayatfield?>" name="reqDokumenTipe[]" value="<?=$riwayatfieldtipe?>" />

		        			<input type="hidden" id="reqDokumenIndexId<?=$riwayatfield?>" name="reqDokumenIndexId[]" value="" />
		        			<input type="hidden" id="reqDokumenPilih<?=$riwayatfield?>" name="reqDokumenPilih[]" value="1" />
		        			<input type="hidden" id="reqDokumenFileKualitasId<?=$riwayatfield?>" name="reqDokumenFileKualitasId[]" value="1" />

		        			<div class="col-form-label col-lg-2 col-sm-12">
		        				<label class="labelupload">
		        					<i class="mdi-file-file-upload" style="font-family: Roboto,sans-serif,Material-Design-Icons !important; font-size: 14px !important;"><?=$vlabelupload?></i>
		        					<input id="file_input_file" name="reqLinkFile[]" class="none" type="file" />
		        				</label>
		        			</div>
		        			<?
		        			}
		        			?>
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
		        	<?
	        		if($infofile > 0)
	        		{
	        		?>
			        </div>
			        <?
			    	}
			        ?>

			        <?
	              	// area untuk upload file
        			foreach ($arrsetriwayatfield as $key => $value)
        			{
        				$riwayatfield= $value["riwayatfield"];
        				$vriwayattable= $value["vriwayattable"];
        				$infolabel= $value["infolabel"];

        				$vkeydetil= $vriwayattable.";".$reqRowId.";".$riwayatfield;
        				$arrcheck= in_array_column($vkeydetil, "vkeydetil", $arrambilfile);

        				$vframeiframe= $arrambilfile[$arrcheck[0]]["vurl"];
        				// $vframeiframe= base_url()."uploads/196212261989032006/fwniFj40ec20240514.pdf";
	        		?>
			        <div id="<?=$vkeydetil?>" class="w3-container w3-border city" style="display:none">
					    <div class="card-title">
		                    <!-- <h3 class="card-label"><?=$infolabel?></h3> -->
		                    <iframe id="infonewframe" style="width: 100%; height: 100vh" src="<?=$vframeiframe?>"></iframe>
		                </div>
					</div>
					<?
					}
					?>

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
					reqTahun: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqNoSK: {
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

	$("#reqPjPenetap").select2({
    	placeholder: "Pilih salah satu data",
    	allowClear: true
  	});

</script>