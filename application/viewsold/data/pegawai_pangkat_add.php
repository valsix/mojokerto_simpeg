<?
include_once("functions/personal.func.php");

$this->load->model("base-data/PangkatRiwayat");
$this->load->model("base-data/Satker");
$this->load->model("base-data/Pangkat");
$this->load->model("base-data/HapusData");

$reqPegawaiId= $this->input->get('reqPegawaiId');
$reqRowId= $this->input->get('reqRowId');
$reqDetilId= $this->input->get('reqDetilId');
$reqMode= $this->input->get('reqMode');
$reqValidasiHapusId= $this->input->get('reqValidasiHapusId');
$adminuserid= $this->adminuserid;
$folder = $this->config->item('simpeg');


$set= new Pangkat();
$arrgol= [];
$set->selectByParams();
	// echo $set->query;exit;
while($set->nextRow())
{
	$arrdata= [];
	$arrdata["id"]= $set->getField("PANGKAT_ID");
	$arrdata["text"]= $set->getField("KODE");
	array_push($arrgol, $arrdata);
}
unset($set);
if($reqMode == 'edit' || $reqMode == 'cancel' || $reqMode == 'view')
{
	

	$set = new PangkatRiwayat();
	$set->selectByParamsAdmin(array('A.PANGKAT_RIWAYAT_ID'=>$reqRowId));
	// echo $set->query;exit;
	$set->firstRow();
	$reqRowId= $set->getField('PANGKAT_RIWAYAT_ID');
	$reqDataId= $set->getField('TEMP_VALIDASI_ID');
	$reqPerubahanData= $set->getField('PERUBAHAN_DATA');

	$reqPejabatPenetapId= $set->getField('PEJABAT_PENETAP_ID');
	$reqPejabatPenetap	= $set->getField('PEJABAT_PENETAP');
	$reqGolRuang= $set->getField('PANGKAT_ID');$valGolRuang= checkwarna($reqPerubahanData, 'PANGKAT_ID', $arrgol, array("id", "text"));
	$reqTglSTLUD= dateToPageCheck($set->getField('TANGGAL_STLUD'));
	$reqSTLUD= $set->getField('STLUD');
	$reqNoSTLUD= $set->getField('NO_STLUD');
	$reqNoNota= $set->getField('NO_NOTA');$valNoNota= checkwarna($reqPerubahanData, 'NO_NOTA');
	$reqNoSK= $set->getField('NO_SK');
	$reqTh= $set->getField('MASA_KERJA_TAHUN');
	$reqBl= $set->getField('MASA_KERJA_BULAN');
	$reqKredit= $set->getField('KREDIT');
	$reqJenisKP= $set->getField('JENIS_KP');
	$reqKeterangan= $set->getField('KETERANGAN');
	$reqGajiPokok= $set->getField('GAJI_POKOK');
	$reqTglNota= dateToPageCheck($set->getField('TANGGAL_NOTA'));
	$reqTglSK= dateToPageCheck($set->getField('TANGGAL_SK'));
	$reqTMTGol= dateToPageCheck($set->getField('TMT_PANGKAT'));

	$reqFileId= $set->getField('PANGKAT_RIWAYAT_FILE_ID');
	$reqLinkFileSk= $set->getField('LINK_FILE_SK');
	$reqLinkFileStlud= $set->getField('LINK_FILE_STLUD');
}

if($reqRowId == "")
{
	$reqMode = 'insert';
}
else
{
	$reqMode = 'update';
}

$disabled = "";
if (empty($adminuserid))
{
	$disabled = "disabled";	
}
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
						<a class="text-muted">Riwayat Pangkat</a>
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
                    <h3 class="card-label">Riwayat Pangkat</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jenis KP</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<select <?=$disabled?> class="form-control select2" id="ktjeniskp" name="reqJenisKP" style="width:auto; ">
	        					<option value="1" <? if($reqJenisKP == 1) echo 'selected'?>>Reguler</option>
	        					<option value="2" <? if($reqJenisKP == 2) echo 'selected'?>>Pilihan (Jabatan Struktural)</option>
	        					<option value="3" <? if($reqJenisKP == 3) echo 'selected'?>>Pilihan (Jabatan Fungsional Tertentu)</option>
	        					<option value="4" <? if($reqJenisKP == 4) echo 'selected'?>>Pilihan (Memperoleh Ijazah/KPPI)</option>
	        					<option value="5" <? if($reqJenisKP == 5) echo 'selected'?>>Pilihan (Tugas Belajar)</option>
	        					<option value="6" <? if($reqJenisKP == 6) echo 'selected'?>>Pilihan (Prestasi Luar Biasa)</option>
	        					<option value="7" <? if($reqJenisKP == 7) echo 'selected'?>>Anumerta</option>
	        					<option value="8" <? if($reqJenisKP == 8) echo 'selected'?>>Pengabdian</option>
	        					<option value="9" <? if($reqJenisKP == 9) echo 'selected'?>>CPNS</option>
	        					<option value="10" <? if($reqJenisKP == 10) echo 'selected'?>>PNS</option>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Gol/Ruang
		        			<?
	        				if(!empty($valGolRuang['data']))
	        				{
	        				?>
	        				<i class="fa fa-question-circle" rel="tooltip" data-html="true" title="<?=$valGolRuang['data']?>"></i>
	        				<?
	        				}
	        				?>
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<select class="form-control select2 <?=$valGolRuang['warna']?>" <?=$disabled?> id="ktgolid" name="reqGolRuang" style="width:30%; ">
	        					<option value=""></option>
	        					<?
	        					foreach($arrgol as $item) 
	        					{
	        						$selectvalid= $item["id"];
	        						$selectvaltext= $item["text"];
	        					?>
	        					<option value="<?=$selectvalid?>" <? if($reqGolRuang == $selectvalid) echo "selected";?>><?=$selectvaltext?></option>
	        					<?
	        					}
	        					?>
	        				</select>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Gol</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" class="form-control" <?=$disabled?> id="kttmtgol" name="reqTMTGol" placeholder="Masukkan TMT Gol" value="<?=$reqTMTGol?>" />
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
		        			No. Nota BKN
		        			<?
	        				if(!empty($valNoNota['data']))
	        				{
	        				?>
	        				<i class="fa fa-question-circle" rel="tooltip" data-html="true" title="<?=$valNoNota['data']?>"></i>
	        				<?
	        				}
	        				?>
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control <?=$valNoNota['warna']?>" <?=$disabled?> placeholder="Masukkan No. Nota BKN"name="reqNoNota" id="reqNoNota" value="<?=$reqNoNota?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tanggal Nota BKN</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" class="form-control" id="kttanggalnota" <?=$disabled?> name="reqTglNota" placeholder="Masukkan Tanggal Nota" value="<?=$reqTglNota?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. SK</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" <?=$disabled?> placeholder="Masukkan No. Surat Keputusan"name="reqNoSK" id="reqNoSK" value="<?=$reqNoSK?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tanggal SK</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" class="form-control" <?=$disabled?> id="kttanggalkeputusan" name="reqTglSK" placeholder="Masukkan Tanggal Surat Keputusan" value="<?=$reqTglSK?>" />
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
	        			<div class="col-lg-10 col-sm-12">
	        				<select class="form-control select2" id="ktsatuankerja" <?=$disabled?> name="reqPejabatPenetap">
	        					<option value="<?=$reqPejabatPenetapId?>"><?=$reqPejabatPenetap?></option>
	        				</select>
	        				<span class="form-text text-muted"><label id="pejabatdetil"></label></span>
	        				<input type="hidden" name="reqPejabatPenetapId" id="reqPejabatPenetapId" value="<?=$reqPejabatPenetapId?>" >
	        				<input type="hidden" name="reqPejabatPenetap" id="reqPejabatPenetap" value="<?=$reqPejabatPenetap?>" >
	        			</div>
	        		</div>
	        		
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Kredit</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" <?=$disabled?> placeholder="Masukkan Kredit"name="reqKredit" id="reqKredit" value="<?=$reqKredit?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Masa Kerja</label>
	        			<div class="form-group col-xs-3 col-xs-offset-1">
	        				<input type="text" style="width:100px;margin-left: 11px"  <?=$disabled?> class="form-control" placeholder="Tahun" maxlength="4" name="reqTh" id="reqTh" value="<?=$reqTh?>" />
	        			</div>
	        			<div class="form-group col-xs-3">
	        				Th
	        			</div>
	        			<div class="form-group col-xs-3">
	        				<input type="text" style="width:100px;" class="form-control" <?=$disabled?> placeholder="Bulan" maxlength="2" name="reqBl" id="reqBl" value="<?=$reqBl?>" />
	        			</div>
	        			<div class="form-group col-xs-3">
	        				Bl
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Gaji Pokok</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" <?=$disabled?> OnFocus="FormatAngka('reqGajiPokok')" OnKeyUp="FormatUang('reqGajiPokok')" OnBlur="FormatUang('reqGajiPokok')" placeholder="Masukkan Gaji Pokok" name="reqGajiPokok" id="reqGajiPokok" value="<?=numberToIna($reqGajiPokok)?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">File Arsip SK</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<br>
	        				<?if(!file_exists($reqLinkFileSk))
	        				{
	        					?>
	        					<input type="button" id="uploadsk" class="btn btn-success font-weight-bold mr-2" value="Upload" onclick="document.getElementById('reqLinkFileSk').click();" />
	        					<input type="file" style="display:none;" id="reqLinkFileSk" name="reqLinkFileSk"  accept=".pdf"/>
	        					<? 
	        					$file_name_direktori = "../".$folder."/uploads/PANGKAT_RIWAYAT/FOTO_BLOB-".$reqRowId.".pdf";
	        					if (file_exists($file_name_direktori)) 
	        					{
	        						?>
	        						<a class="btn btn-primary font-weight-bold mr-2" href="<?=$file_name_direktori?>" target="_blank">Download</a>
	        						<? 
	        					}
	        					?>
	        					<?
	        				}
	        				else
	        				{
	        					?>
	        					<a class="btn btn-primary font-weight-bold mr-2" href="app/loadUrl/admin/viewer?reqForm=pangkat_sk&reqFileId=<?=$reqFileId?>" target="_blank">Download</a>
	        					<a class="btn btn-danger font-weight-bold mr-2" onclick="btndeletefile('<?=$reqFileId?>','<?=$reqPegawaiId?>','pangkat_sk')">Hapus File</a>
	        					<?
	        				}
	        				?>
	        			</div>
	        			<!-- <label class="col-form-label text-right col-lg-2 col-sm-12">File Arsip STLUD</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<br>
	        				<?if(!file_exists($reqLinkFileStlud))
	        				{
	        					?>
	        					<input type="button" id="uploadstlud" class="btn btn-success font-weight-bold mr-2" value="Upload" onclick="document.getElementById('reqLinkFileStlud').click();" />
	        					<input type="file" style="display:none;" id="reqLinkFileStlud" name="reqLinkFileStlud"  accept=".pdf"/>
	        					<? 
	        					$file_name_direktori = "../".$folder."/uploads/PANGKAT_RIWAYAT/FOTO_BLOB_STLUD-".$reqRowId.".pdf";
	        					if (file_exists($file_name_direktori)) 
	        					{
	        						?>
	        						<a class="btn btn-primary font-weight-bold mr-2" href="<?=$file_name_direktori?>" target="_blank">Download</a>
	        						<? 
	        					}
	        					?>
	        					<?
	        				}
	        				else
	        				{
	        					?>
	        					<a class="btn btn-primary font-weight-bold mr-2" href="app/loadUrl/admin/viewer?reqForm=pangkat_stlud&reqFileId=<?=$reqFileId?>" target="_blank">Download</a>
	        					<a class="btn btn-danger font-weight-bold mr-2" onclick="btndeletefile('<?=$reqFileId?>','<?=$reqPegawaiId?>','pangkat_stlud')">Hapus File</a>
	        					<?
	        				}
	        				?>
	        			</div> -->
	        		</div>
	        	</div>
	        	<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
	        				<input type="hidden" name="reqRowId" value="<?=$reqRowId?>">
	        				<input type="hidden" name="reqDataId" value="<?=$reqDataId?>">
	        				<input type="hidden" name="reqPegawaiId" value="<?=$reqPegawaiId?>">
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

	$(document).ready(function() {
		$('#reqLinkFileSk').change(function() {
			var reqLinkFileSk = $('#reqLinkFileSk').val().split('\\').pop();
			var lastIndex = reqLinkFileSk.lastIndexOf("\\");   
			$('#uploadsk').val(reqLinkFileSk);
		});
		$('#reqLinkFileStlud').change(function() {
			var reqLinkFileStlud = $('#reqLinkFileStlud').val().split('\\').pop();
			var lastIndex = reqLinkFileStlud.lastIndexOf("\\");   
			$('#uploadstlud').val(reqLinkFileStlud);
		});
		
	});
	$(document).on("input", "#reqTh,#reqBl,#reqGajiPokok,#reqKredit", function() {
		this.value = this.value.replace(/\D/g,'');
	});
	function kembali() {
		window.location.href='data/index/pegawai_pangkat'
	}

	function tampilPejabatPenetap(val) {
        if (val.loading) return val.text;
        var markup = "<div class='select2-result-repository clearfix'>" +
	            "<div class='select2-result-repository__meta'>" +
	            	"<div class='select2-result-repository__title'>" + val.description + "</div>" +
	            "</div>" +
            "</div>";
        return markup;
    }
    function pilihPejabatPenetap(val) {
    	$("#pejabatdetil").text(val.description);
    	$("#reqPejabatPenetapId").val(val.id);
    	$("#reqPejabatPenetap").val(val.text);	
        // console.log(val);
        return val.text;
    }
	$('#ktgolid').select2({
		placeholder: "Pilih gol"
	});
	$('#ktjeniskp').select2({
		placeholder: "Pilih jenis kp"
	});
	
	$("#ktsatuankerja").select2({
        placeholder: "Pilih pejabatpenetap",
        allowClear: true,
        ajax: {
            url: "json-data/combo_json/autocompletepejabatpenetap",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                    , page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data.items
                    , pagination: {
                        more: (params.page * 30) < data.total_count && data.items != ""
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: tampilPejabatPenetap, // omitted for brevity, see the source of this page
        templateSelection: pilihPejabatPenetap // omitted for brevity, see the source of this page
    });
    arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#kttanggalkeputusan,#kttmtgol,#kttanggalnota').datepicker({
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
		var formSubmitUrl = "json-data/personal_json/jsonpegawaipangkatriwayatadd";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqPejabatPenetap: {
						validators: {
							notEmpty: {
								message: 'Pejabat Penetap harus diisi'
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
			        		document.location.href = "data/index/pegawai_pangkat";
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

	function btndeletefile(fileid,reqPegawaiId,reqMode) {
		if(fileid !== "")
        {
            urlAjax= "json-data/personal_json/jsonpangkatriwayatdeletefile?reqFileId="+fileid+"&reqPegawaiId="+reqPegawaiId+"&reqMode="+reqMode;
            swal.fire({
                title: 'Apakah anda yakin untuk hapus file?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then(function(result) { 
                if (result.value) {
                    $.ajax({
                        url : urlAjax,
                        type : 'DELETE',
                        dataType:'json',
                        beforeSend: function() {
                            swal.fire({
                                title: 'Please Wait..!',
                                text: 'Is working..',
                                onOpen: function() {
                                    swal.showLoading()
                                }
                            })
                        },
                        success : function(data) { 
                            swal.fire({
                                position: 'center',
                                icon: "success",
                                type: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                location.reload();
                            });
                        },
                        complete: function() {
                            swal.hideLoading();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            swal.hideLoading();
                            var err = JSON.parse(jqXHR.responseText);
                            Swal.fire("Error", err.message, "error");
                        }
                    });
                }
            });
        }
	}
</script>

