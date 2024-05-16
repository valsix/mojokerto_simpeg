<?
include_once("functions/personal.func.php");

$this->load->model("base/RiwayatJabatan");
$this->load->model("base/Core");
$this->load->library('globalfilepegawai');

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

if(empty($reqRowId)) $reqRowId= -1;

if(empty($reqRowId) || $reqRowId== -1)
{
	$reqMode="insert";

	$reqStatus='baru';
	$reqDisplayBaru='';
	$reqDisplay='none';
}
else
{
	$reqMode="update";
	$jabatan_riwayat= new RiwayatJabatan();
	$jabatan_riwayat->selectByParams(array('JABATAN_RIWAYAT_ID'=>$reqRowId, 'PEGAWAI_ID'=> $reqId));
	// $jabatan_riwayat->query;exit;
	$jabatan_riwayat->firstRow();
	if( $jabatan_riwayat->getField('PEJABAT_PENETAP_ID')==''){
		$reqStatus='baru';
		$reqDisplayBaru='';
		$reqDisplay='none';
	}else{
		$reqDisplayBaru='none';
		$reqDisplay='';
	}
	$reqPjPenetapNama= $jabatan_riwayat->getField('PEJABAT_PENETAP');
	$reqPjPenetapId= $jabatan_riwayat->getField('PEJABAT_PENETAP_ID');

	$reqSatkerId= $jabatan_riwayat->getField('SATKER_ID');
	$reqNoSK= $jabatan_riwayat->getField('NO_SK');
	$reqEselon= $jabatan_riwayat->getField('ESELON_ID');
	$reqNamaJabatan= $jabatan_riwayat->getField('NAMA');
	$reqNoPelantikan= $jabatan_riwayat->getField('NO_PELANTIKAN');
	$reqTunjangan= $jabatan_riwayat->getField('TUNJANGAN');
	$reqTglSK= dateToPageCheck($jabatan_riwayat->getField('TANGGAL_SK'));
	$reqTMTJabatan= dateToPageCheck($jabatan_riwayat->getField('TMT_JABATAN'));
	$reqTMTEselon= dateToPageCheck($jabatan_riwayat->getField('TMT_ESELON'));
	$reqTglPelantikan= dateToPageCheck($jabatan_riwayat->getField('TANGGAL_PELANTIKAN'));
	$reqBlnDibayar= dateToPageCheck($jabatan_riwayat->getField('BULAN_DIBAYAR'));
	$reqMataPelajaran= $jabatan_riwayat->getField('MATA_PELAJARAN');
	$reqTMTJabatanFungsional= dateToPageCheck($jabatan_riwayat->getField('TMT_JABATAN_FUNGSIONAL'));
	$reqTMTTugasTambahan= dateToPageCheck($jabatan_riwayat->getField('TMT_TUGAS_TAMBAHAN'));
	$reqKeteranganBUP= $jabatan_riwayat->getField('KETERANGAN_BUP');
	$reqKredit= $jabatan_riwayat->getField('ANGKA_KREDIT');
	$reqJenisJabatan= $jabatan_riwayat->getField('JENIS_JABATAN');
	$reqTentangJabatan= $jabatan_riwayat->getField('TENTANG_JABATAN');
	$reqKodeJabatan= $jabatan_riwayat->getField('KODE_JABATAN');
	$reqSatker= $jabatan_riwayat->getField('SATKER');
}

$eselon= new Core();
$eselon->selectByParamsEselon(array());

$pejabatpenetap= new Core();
$pejabatpenetap->selectByParamsPejabatPenetap(array());
// echo $reqTmtJabatan;exit;
// $reqMode="insert";
$readonly = "readonly";

// untuk kondisi file
$vfpeg= new globalfilepegawai();
$riwayattable= "JABATAN_RIWAYAT";
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
						<a class="" href="app/index/riwayat_jabatan?reqId=<?=$reqId?>">Riwayat Jabatan</a>
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
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">No.SK</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<input type="text" class="form-control" name="reqNoSK" id="reqNoSK" value="<?=$reqNoSK?>" />
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Tanggal SK
			        		</label>
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
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama Jabatan</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqNamaJabatan" id="reqNamaJabatan" value="<?=$reqNamaJabatan?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Mutasi</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<div class="input-group date">
			        				<input type="text" autocomplete="off" class="form-control" id="reqTMTJabatan" name="reqTMTJabatan" value="<?=$reqTMTJabatan?>" />
			        				<div class="input-group-append">
			        					<span class="input-group-text">
			        						<i class="la la-calendar"></i>
			        					</span>
			        				</div>
			        			</div>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Eselon</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<select class="form-control" name="reqEselon" id="reqEselon">
					                   <option value="" <? if($reqEselon =='') echo 'selected';?> disabled> Pilih Eselon</option>
		        					<?while($eselon->nextRow()){?>
					                    <option value="<?=$eselon->getField('ESELON_ID')?>" <? if($reqEselon == $eselon->getField('ESELON_ID')) echo 'selected';?>><?=$eselon->getField('NAMA')?></option>
					                <? }?>
		        				</select>
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Eselon</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="input-group date">
			        				<input type="text" autocomplete="off" class="form-control" id="reqTMTEselon" name="reqTMTEselon" value="<?=$reqTMTEselon?>" />
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
		        			<div class="col-lg-10 col-sm-12">
		        				<select class="form-control" name="reqPjPenetap" id="reqPjPenetap">
				                   <option value="" <? if($reqEselon =='') echo 'selected';?> disabled> Pilih PJ Penetap</option>
	        					<?while($pejabatpenetap->nextRow()){?>
				                    <option value="<?=$pejabatpenetap->getField('PEJABAT_PENETAP_ID')?>" <? if($reqPjPenetapId == $pejabatpenetap->getField('PEJABAT_PENETAP_ID')) echo 'selected';?>><?=$pejabatpenetap->getField('JABATAN')?></option>
				                <? }?>	        					
		        				</select>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. Pelantikan</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<input type="text" class="form-control" name="reqNoPelantikan" id="reqNoPelantikan" value="<?=$reqNoPelantikan?>" />
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">
			        			Tanggal Pelantikan
			        		</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<div class="input-group date">
			        				<input type="text" autocomplete="off" class="form-control" id="reqTglPelantikan" name="reqTglPelantikan" value="<?=$reqTglPelantikan?>" />
			        				<div class="input-group-append">
			        					<span class="input-group-text">
			        						<i class="la la-calendar"></i>
			        					</span>
			        				</div>
			        			</div>
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tunjangan</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<input type="text" class="form-control" name="reqTunjangan" id="reqTunjangan" value="<?=$reqTunjangan?>" />
		        			</div>
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Bln. Dibayar</label>
		        			<div class="col-lg-4 col-sm-12">
		        				<input type="text" class="form-control" name="reqBlnDibayar" id="reqBlnDibayar" value="<?=$reqBlnDibayar?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Perpanjangan BUP</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqKeteranganBUP" id="reqKeteranganBUP" value="<?=$reqKeteranganBUP?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Angka Kredit</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqKredit" id="reqKredit" value="<?=$reqKredit?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tentang Jabatan</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqTentangJabatan" id="reqTentangJabatan" value="<?=$reqTentangJabatan?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jenis Jabatan</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqJenisJabatan" id="reqJenisJabatan" value="<?=$reqJenisJabatan?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Kode Jabatan</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqKodeJabatan" id="reqKodeJabatan" value="<?=$reqKodeJabatan?>" />
		        			</div>
		        		</div>
		        		<div class="form-group row">
		        			<label class="col-form-label text-right col-lg-2 col-sm-12">Satker</label>
		        			<div class="col-lg-10 col-sm-12">
		        				<input type="text" class="form-control" name="reqSatker" id="reqSatker" value="<?=$reqSatker?>" />
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
		var formSubmitUrl = "json-main/riwayat_jabatan_json/add";
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
			        			document.location.href = "app/index/riwayat_jabatan?reqId=<?=$reqId?>";
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
	$('#reqTMTJabatan,#reqTMTEselon,#reqTglPelantikan,#reqTglSK').datepicker({
		todayHighlight: true
		, autoclose: true
		, orientation: "bottom left"
		, clearBtn: true
		, format: 'dd-mm-yyyy'
		, templates: arrows
	});

	$("#reqEselon, #reqPjPenetap").select2({
    	placeholder: "Pilih salah satu data",
    	allowClear: true
  	});

</script>