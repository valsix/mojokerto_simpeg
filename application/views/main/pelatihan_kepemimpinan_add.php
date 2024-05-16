<?
include_once("functions/personal.func.php");

$this->load->model("base/PelatihanKepemimpinan");
$this->load->model("base/Core");
$this->load->library('globalfilepegawai');

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

if(empty($reqRowId))
{
	$reqMode="insert";
}
else
{
	$set= new PelatihanKepemimpinan();
	$set->selectByParams(array('DIKLAT_STRUKTURAL_ID'=>$reqRowId));
	$set->firstRow();
	$reqDIKLAT_STRUKTURAL_ID = $set->getField('DIKLAT_STRUKTURAL_ID');
	$reqDiklat= $set->getField('DIKLAT_ID');
	$reqTahun= $set->getField('TAHUN');
	$reqNoSTTPP= $set->getField('NO_STTPP');
	$reqPenyelenggara= $set->getField('PENYELENGGARA');
	$reqAngkatan= $set->getField('ANGKATAN');
	$reqTglMulai= dateToPageCheck($set->getField('TANGGAL_MULAI'));
	$reqTglSelesai= dateToPageCheck($set->getField('TANGGAL_SELESAI'));
	$reqTglSTTPP= dateToPageCheck($set->getField('TANGGAL_STTPP'));
	$reqTempat= $set->getField('TEMPAT');
	$reqJumlahJam= $set->getField('JUMLAH_JAM');
	$reqMode="update";
}

$diklat= new Core();
$diklat->selectByParamsDiklat();
$readonly = "readonly";

// untuk kondisi file
$vfpeg= new globalfilepegawai();
$riwayattable= "DIKLAT_STRUKTURAL";
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

<link href="assets/css/w3.css" rel="stylesheet" type="text/css" />
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
						<a class="" href="app/index/pelatihan_kepemimpinan?reqId=<?=$reqId?>">Pelatihan Kepemimpinan</a>
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
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Diklat</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<select class="form-control" name="reqDiklat" id="reqDiklat">
		        					<option value="" <? if($reqDiklat=='') echo 'selected' ?>>pilih</option>
		        					<?while($diklat->nextRow()){?>
					            		<option <?=$read?> value="<?=$diklat->getField('DIKLAT_ID')?>" <? if($diklat->getField('DIKLAT_ID')==$reqDiklat) echo 'selected'?>><?=$diklat->getField('NAMA')?></option>
									<? }?>
		        				</select>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tempat</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqTempat" id="reqTempat" value="<?=$reqTempat?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Penyelenggara</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqPenyelenggara" id="reqPenyelenggara" value="<?=$reqPenyelenggara?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Angkatan</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<input type="text" class="form-control valsixnumbering" name="reqAngkatan" id="reqAngkatan" value="<?=$reqAngkatan?>" />
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tahun</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<input type="text" class="form-control valsixnumbering" name="reqTahun" id="reqTahun" value="<?=$reqTahun?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			No. STTPP
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<input type="text" class="form-control" name="reqNoSTTPP" id="reqNoSTTPP" value="<?=$reqNoSTTPP?>" />
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Tgl. STTPP
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="input-group date">
			        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTglSTTPP" value="<?=$reqTglSTTPP?>" />
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
			        			Tgl Mulai
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="input-group date">
			        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTglMulai" value="<?=$reqTglMulai?>" />
			        				<div class="input-group-append">
			        					<span class="input-group-text">
			        						<i class="la la-calendar"></i>
			        					</span>
			        				</div>
			        			</div>
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Tgl Selesai
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="input-group date">
			        				<input type="text" <?=$read?> autocomplete="off" class="form-control kttanggal" name="reqTglSelesai" value="<?=$reqTglSelesai?>" />
			        				<div class="input-group-append">
			        					<span class="input-group-text">
			        						<i class="la la-calendar"></i>
			        					</span>
			        				</div>
			        			</div>
		        			</div>
		        		</div>

		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jumlah Jam</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<input type="text" class="form-control valsixnumbering" name="reqJumlahJam" id="reqJumlahJam" value="<?=$reqJumlahJam?>" />
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
		        					<i class="mdi-file-file-upload" style="font-family: "Roboto",sans-serif,Material-Design-Icons !important; font-size: 14px !important;"><?=$vlabelupload?></i>
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
			        				<input type="hidden" name="reqMode" value="<?=$reqMode?>" />
			        				<input type="hidden" name="reqId" value="<?=$reqId?>" />
			        				<input type="hidden" name="reqRowId" value="<?=$reqRowId?>" />
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

	$(function () {
		$("[rel=tooltip]").tooltip({ placement: 'right'});
		// $('[data-toggle="tooltip"]').tooltip()
	})

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-main/pelatihan_kepemimpinan_json/add";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqTglSTTPP: {
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
                                document.location.href = "app/index/pelatihan_kepemimpinan?reqId=<?=$reqId?>";
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

	$('.valsixnumbering').bind('keyup paste', function(){
		this.value = this.value.replace(/[^0-9]/g, '');
		// this.value = this.value.replace(/[^0-9\.]/g, '');
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

	$("#reqDiklat").select2({
    	placeholder: "Pilih salah satu data",
    	allowClear: true
  	});

</script>