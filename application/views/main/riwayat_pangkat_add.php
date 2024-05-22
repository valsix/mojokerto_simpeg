<?
include_once("functions/personal.func.php");

$this->load->model("base/RiwayatPangkat");
$this->load->model("base/Core");
$this->load->library('globalfilepegawai');

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

if(empty($reqRowId)) $reqRowId= -1;

if(empty($reqRowId) || $reqRowId== -1)
{
	$reqMode="insert";
}
else
{
	$reqMode="update";
	$set= new RiwayatPangkat();
	$set->selectByParams(array('PANGKAT_RIWAYAT_ID'=>$reqRowId,'PEGAWAI_ID'=>$reqId));
	$set->firstRow();
	$reqPANGKAT_RIWAYAT_ID= $set->getField('PANGKAT_RIWAYAT_ID');
	$reqGolRuang= $set->getField('PANGKAT_ID');
	$reqPjPenetap= $set->getField('PEJABAT_PENETAP_ID');
	$reqTglSTLUD= dateToPageCheck($set->getField('TANGGAL_STLUD'));
	$reqSTLUD= $set->getField('STLUD');
	$reqNoSTLUD= $set->getField('NO_STLUD');
	$reqNoNota= $set->getField('NO_NOTA');
	$reqNoSK = $set->getField('NO_SK');
	$reqTh= $set->getField('MASA_KERJA_TAHUN');
	$reqBl= $set->getField('MASA_KERJA_BULAN');
	$reqKredit= dotToComma($set->getField('KREDIT'));
	$reqJenisKP= $set->getField('JENIS_KP');
	$reqKeterangan= $set->getField('KETERANGAN');
	$reqGajiPokok= $set->getField('GAJI_POKOK');
	$reqTglNota= dateToPageCheck($set->getField('TANGGAL_NOTA'));
	$reqTglSK= dateToPageCheck($set->getField('TANGGAL_SK'));
	$reqTMTGol= dateToPageCheck($set->getField('TMT_PANGKAT'));
	// echo $set->query;exit;
}

$pangkat= new Core();
$pangkat->selectByParamsPangkat(array());

$pejabatpenetap= new Core();
$pejabatpenetap->selectByParamsPejabatPenetap(array());

// $reqMode="insert";
$readonly = "readonly";

// untuk kondisi file
$vfpeg= new globalfilepegawai();
$riwayattable= "PANGKAT_RIWAYAT";
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
						<a class="" href="app/index/riwayat_pangkat?reqId=<?=$reqId?>">Riwayat Pangkat</a>
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
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			STLUD
			        		</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<div class="input-group date">
			        				<select class="form-control"  name="reqSTLUD" id='reqSTLUD'>
										<option></option>
					                    <option value="1" <? if($reqSTLUD == 1) echo 'selected'?>>Tingkat I</option>
					                    <option value="2" <? if($reqSTLUD == 2) echo 'selected'?>>Tingkat II</option>
					                    <option value="3" <? if($reqSTLUD == 3) echo 'selected'?>>Tingkat III</option>
									</select>
			        			</div>
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. STLUD</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<input type="text" class="form-control" name="reqNoSTLUD" id="reqNoSTLUD" value="<?=$reqNoSTLUD?>" />
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tgl. STLUD</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<div class="input-group date">
		        					<input type="text" autocomplete="off" class="form-control" id="reqTglSTLUD" name="reqTglSTLUD" value="<?=$reqTglSTLUD?>" />
			        				<div class="input-group-append">
			        					<span class="input-group-text">
			        						<i class="la la-calendar"></i>
			        					</span>
			        				</div>
			        			</div>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Gol/Ruang</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<select name="reqGolRuang" id="reqGolRuang"  class="form-control">
		        					<option value="" <? if($reqGolRuang == '') echo 'selected';?> disabled> Pilih Gol/Ruang</option>
				                    <? while($pangkat->nextRow()){?>
				                        <option value="<?=$pangkat->getField('PANGKAT_ID')?>" <? if($reqGolRuang == $pangkat->getField('PANGKAT_ID')) echo 'selected';?>><?=$pangkat->getField('KODE')?></option>
				                    <? }?>
				                </select>
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Gol</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="input-group date">
		        					<input type="text" autocomplete="off" class="form-control" id="reqTMTGol" name="reqTMTGol" value="<?=$reqTMTGol?>" />
			        				<div class="input-group-append">
			        					<span class="input-group-text">
			        						<i class="la la-calendar"></i>
			        					</span>
			        				</div>
			        			</div>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">No Nota</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<input type="text" class="form-control" name="reqNoNota" id="reqNoNota" value="<?=$reqNoNota?>" />
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tgl Nota</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="input-group date">
		        					<input type="text" autocomplete="off" class="form-control" id="reqTglNota" name="reqTglNota" value="<?=$reqTglNota?>" />
			        				<div class="input-group-append">
			        					<span class="input-group-text">
			        						<i class="la la-calendar"></i>
			        					</span>
			        				</div>
			        			</div>
		        			</div>
		        		</div><div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">No SK</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<input type="text" class="form-control" name="reqNoSK" id="reqNoSK" value="<?=$reqNoSK?>" />
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tgl SK</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="input-group date">
		        					<input type="text" autocomplete="off" class="form-control" id="reqTglSK" name="reqTglSK" value="<?=$reqTglSK?>" />
			        				<div class="input-group-append">
			        					<span class="input-group-text">
			        						<i class="la la-calendar"></i>
			        					</span>
			        				</div>
			        			</div>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pj Penetap</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<select name="reqPjPenetap" id="reqPjPenetap"  class="form-control">
		        					<option value="" <? if($reqPjPenetap == '') echo 'selected';?> disabled> Pilih Pj Penetap</option>
				                    <? while($pejabatpenetap->nextRow()){?>
				                        <option value="<?=$pejabatpenetap->getField('PEJABAT_PENETAP_ID')?>" <? if($reqPjPenetap == $pejabatpenetap->getField('PEJABAT_PENETAP_ID')) echo 'selected';?>><?=$pejabatpenetap->getField('JABATAN')?></option>
				                    <? }?>
				                </select>
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jenis KP</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<select name="reqJenisKP" id="reqJenisKP"  class="form-control">
				                   	<option value=""<? if($reqJenisKP == '') echo 'selected'?>>Pilih</option>
				                   	<option value="1" <? if($reqJenisKP == 1) echo 'selected'?>>Reguler</option>
				                    <option value="2" <? if($reqJenisKP == 2) echo 'selected'?>>Pilihan (Struktural)</option>
				                    <option value="3" <? if($reqJenisKP == 3) echo 'selected'?>>Anumerta</option>
				                    <option value="4" <? if($reqJenisKP == 4) echo 'selected'?>>Pengabdian</option>
				                    <option value="5" <? if($reqJenisKP == 5) echo 'selected'?>>SK lain-lain</option>
				                    <option value="6" <? if($reqJenisKP == 6) echo 'selected'?>>Pilihan (Fungsional)</option>
								</select>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Kredit</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<input placeholder="" type="text" id="reqKredit" name="reqKredit" <?=$read?> class="form-control" value="<?=$reqKredit?>" onkeypress='kreditvalidate(event, this)' />
		        			</div>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="row">
				        			<label class="col-form-label text-right col-lg-4 col-sm-12">Masa Kerja </label>
				        			<div class="col-lg-3 col-sm-12">
				        				<input type="text" class="form-control angkavalsix" name="reqTh" id="reqTh" value="<?=$reqTh?>" />
				        			</div>
				        			<label class="col-form-label">Thn</label>
				        			<div class="col-lg-3 col-sm-12">
				        				<input type="text" class="form-control angkavalsix" name="reqBl" id="reqBl" value="<?=$reqBl?>" />
				        			</div>
				        			<label class="col-form-label">Bln</label>
				        		</div>	        			
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Gaji Pokok</label>
		        			<div class="col-lg-2 col-sm-12">
		        				<input type="text" placeholder class="form-control" id="reqGajiPokok" name="reqGajiPokok" OnFocus="FormatAngka('reqGajiPokok')" OnKeyUp="FormatUang('reqGajiPokok')" OnBlur="FormatUang('reqGajiPokok')" value="<?=numberToIna($reqGajiPokok)?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Keterangan</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<textarea class="form-control" id='reqKeterangan' name="reqKeterangan"><?=$reqKeterangan?></textarea>
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
			        				<input type="hidden" name="reqId" value="<?=$reqId?>">
			        				<input type="hidden" name="reqRowId" value="<?=$reqRowId?>">
			        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
			        				<input type="hidden" name="reqTempValidasiId" value="<?=$reqTempValidasiId?>">
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
		                    <?
		                    if(empty($vframeiframe))
		                    {
		                    ?>
		                    <h3 class="card-label">Belum ada file</h3>
		                    <?
		                    }
		                    else
		                    {
		                    ?>
		                    <iframe id="infonewframe" style="width: 100%; height: 100vh" src="<?=$vframeiframe?>"></iframe>
		                    <?
		                	}
		                    ?>
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

	$(function(){
		$("#reqGolRuang").change(function(){
			$.getJSON("json-main/combo_json/getGaji?reqGolId="+$("#reqGolRuang").val()+"&reqTahun="+$("#reqTh").val(),
				function(data){
					$("#reqGajiPokok").val(data.GAJI);
				});		    		
		});
		
		$("#reqTh").keypress(function(e) {
			if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
			{
				return false;
			}
			else
			{
				return true;
			}
		});
		$("#reqTh").keyup(function(e) {
			if(isNaN($("#reqTh").val()))
			{

			}
			else
			{
				$.getJSON("json-main/combo_json/getGaji?reqGolId="+$("#reqGolRuang").val()+"&reqTahun="+$("#reqTh").val(),
					function(data){
						$("#reqGajiPokok").val(data.GAJI);
					});
			}
		});
		$("#reqBl").keypress(function(e) {
			if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
			{
				return false;
			}

		});
		
		
	});

	$(function () {
		$("[rel=tooltip]").tooltip({ placement: 'right'});
		// $('[data-toggle="tooltip"]').tooltip()
	})

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-main/riwayat_pangkat_json/add";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNoSK: {
						validators: {
							notEmpty: {
								message: 'Area ini harus diisi'
							},
						}
					},
					reqTglSK: {
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
			        			document.location.href = "app/index/riwayat_pangkat?reqId=<?=$reqId?>";
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
	$('#reqTglSTLUD,#reqTglNota,#reqTglSK,#reqTMTGol').datepicker({
		todayHighlight: true
		, autoclose: true
		, orientation: "bottom left"
		, clearBtn: true
		, format: 'dd-mm-yyyy'
		, templates: arrows
	});

	$("#reqSTLUD, #reqGolRuang, #reqPjPenetap, #reqJenisKP").select2({
    	placeholder: "Pilih salah satu data",
    	allowClear: true
  	});

</script>