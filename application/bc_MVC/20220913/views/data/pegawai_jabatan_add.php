<?
$this->load->model("base-data/JabatanRiwayat");
$this->load->model("base-data/Pangkat");
$this->load->model("base-data/HapusData");
$this->load->model("base-data/Pegawai");
$this->load->model("base-data/Eselon");

$reqPegawaiId= $this->input->get('reqPegawaiId');
$reqRowId= $this->input->get('reqRowId');
$reqDetilId= $this->input->get('reqDetilId');
$reqMode= $this->input->get('reqMode');
$reqValidasiHapusId= $this->input->get('reqValidasiHapusId');
$adminuserid= $this->adminuserid;

$set = new JabatanRiwayat();
if($reqMode == 'edit' || $reqMode == 'cancel' || $reqMode == 'view')
{
	// if($reqDetilId == "")
	// {
	// 	$set->selectByParams(array('A.JABATAN_RIWAYAT_ID'=>$reqRowId));
	// }
	// else
	// {
	// 	$set->selectByParams(array('TEMP_VALIDASI_ID'=>$reqDetilId));
	// }
	$set->selectByParamsAdmin(array('A.JABATAN_RIWAYAT_ID'=>$reqRowId));
	// echo $set->query;exit;
	$set->firstRow();
	$reqRowId= $set->getField('JABATAN_RIWAYAT_ID');
	$reqDataId= $set->getField('TEMP_VALIDASI_ID');
	$reqPejabatPenetap= $set->getField('PEJABAT_PENETAP');
	$reqPejabatPenetapId= $set->getField('PEJABAT_PENETAP_ID');
	$reqSatkerId= $set->getField('SATKER_ID');
	$reqNoSK= $set->getField('NO_SK');
	$reqEselon= $set->getField('ESELON_ID');
	$reqNamaJabatan= $set->getField('NAMA');
	// echo  $reqNamaJabatan;exit;
	$reqNoPelantikan= $set->getField('NO_PELANTIKAN');
	$reqTunjangan= $set->getField('TUNJANGAN');
	$reqTglSK= dateToPageCheck($set->getField('TANGGAL_SK'));
	$reqTMTJabatan= dateToPageCheck($set->getField('TMT_JABATAN'));
	$reqTMTEselon= dateToPageCheck($set->getField('TMT_ESELON'));
	$reqTglPelantikan= dateToPageCheck($set->getField('TANGGAL_PELANTIKAN'));
	$reqBlnDibayar= dateToPageCheck($set->getField('BULAN_DIBAYAR'));
	$reqTMTJabatanFungsional= dateToPageCheck($set->getField('TMT_JABATAN_FUNGSIONAL'));
	$reqTMTTugasTambahan= dateToPageCheck($set->getField('TMT_TUGAS_TAMBAHAN'));
	$reqTglSKBUP= dateToPageCheck($set->getField('TGL_SK_PERPANJANGAN_BUP'));
	$reqTmtBatasUsiaPensiun= dateToPageCheck($set->getField('TMT_BATAS_USIA_PENSIUN'));
	$reqKeteranganBUP= $set->getField('KETERANGAN_BUP');
	$reqPerubahanData= $set->getField('PERUBAHAN_DATA');
	$reqValidasi= $set->getField('VALIDASI');
}
unset($set);
if($reqRowId == "")
{
	$reqMode = 'insert';
}
else
{
	$reqMode = 'update';
}

$set= new Pegawai();
$set->selectByParams(array('P.PEGAWAI_ID'=>$reqPegawaiId), -1, -1);
$set->firstRow();
$reqTipePegawaiParentId = substr($set->getField('TIPE_PEGAWAI_ID'),0,1);
$reqTipePegawaiId = $set->getField('TIPE_PEGAWAI_ID');
// echo $reqTipePegawaiId;exit;
unset($set);

$statement="";
$sOrder=" ORDER BY NAMA ASC";
$set= new Eselon();
$arreselon= [];
$set->selectByParams(array(), -1,-1,$statement,$sOrder);
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">No. SK</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" <?=$disabled?> placeholder="Masukkan No. Surat Keputusan"name="reqNoSK" id="reqNoSK" value="<?=$reqNoSK?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tanggal SK</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" class="form-control" <?=$disabled?> id="kttanggalkeputusan" name="reqTglSK" readonly="readonly" placeholder="Masukkan Tanggal Surat Keputusan" value="<?=$reqTglSK?>" />
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
	        				<select class="form-control select2" <?=$disabled?> id="ktnamajabatan" name="reqNamaJabatan">
	        					<option value="<?=$reqNamaJabatan?>"><?=$reqNamaJabatan?></option>
	        				</select>
	        				<span class="form-text text-muted"><label id="jabatandetil"></label></span>
	        				<input type="hidden" name="reqSatkerId" id="reqSatkerId" value="<?=$reqSatkerId?>" >
	        				<input type="hidden" name="reqNamaJabatan" id="reqNamaJabatan" value="<?=$reqNamaJabatan?>" >
	        			</div>
	        			
	        		</div>
	        		<div class="form-group row">
	        			<?
	        			if($reqTipePegawaiId == 11 or $reqTipePegawaiId == 1 or $reqTipePegawaiId == 12 or $reqTipePegawaiId == 0 )
	        			{
	        			?> 
	        				<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Mutasi</label>
	        			<?
	        			}
	        			else
	        			{
	        			?>
	        				<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Jabatan</label>
	        			<?
	        			}
	        			?>
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
	        		<?
	        		if($reqTipePegawaiId == 11)
	        		{
	        		?>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Eselon</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<select class="form-control select2" id="kteselon" <?=$disabled?> name="reqEselon" style="width:30%; ">
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Eselon</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" class="form-control" <?=$disabled?> id="kttmteselon" name="reqTMTEselon" readonly="readonly" placeholder="Masukkan TMT Eselon" value="<?=$reqTMTEselon?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        		</div>
	        		<?
					}
					?>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pejabat Penetap</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<select class="form-control select2" <?=$disabled?> id="ktpejabat" name="reqPejabatPenetap">
	        					<option value="<?=$reqPejabatPenetapId?>"><?=$reqPejabatPenetap?></option>
	        				</select>
	        				<span class="form-text text-muted"><label id="pejabatdetil"></label></span>
	        				<input type="hidden" name="reqPejabatPenetapId" id="reqPejabatPenetapId" value="<?=$reqPejabatPenetapId?>" >
	        				<input type="hidden" name="reqPejabatPenetap" id="reqPejabatPenetap" value="<?=$reqPejabatPenetap?>" >
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tunjangan</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" <?=$disabled?> placeholder="Masukkan Tunjangan"name="reqTunjangan" id="reqTunjangan" value="<?=$reqTunjangan?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">SK Jabatan</label>
	        			<div class="col-lg-4 col-sm-12">
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">SP Pelantikan</label>
	        			<div class="col-lg-4 col-sm-12">
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">SP Menduduki Jabatan</label>
	        			<div class="col-lg-4 col-sm-12">
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Sp Melaksanakan Tugas</label>
	        			<div class="col-lg-4 col-sm-12">
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">SK tugas tambahan</label>
	        			<div class="col-lg-4 col-sm-12">
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
		window.location.href='data/index/pegawai_jabatan'
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

    function tampilSatuanKerja(val) {
        if (val.loading) return val.text;
        var markup = "<div class='select2-result-repository clearfix'>" +
	            "<div class='select2-result-repository__meta'>" +
	            	"<div class='select2-result-repository__title'>" + val.description + "</div>" +
	            "</div>" +
            "</div>";
        return markup;
    }
    function pilihSatuanKerja(val) {
    	$("#jabatandetil").text(val.description);
    	$("#reqSatkerId").val(val.id);
    	$("#reqNamaJabatan").val(val.text);	
        // console.log(val);
        return val.text;
    }
	$('#kteselon').select2({
		placeholder: "Pilih eselon"
	});
	$('#ktjeniskp').select2({
		placeholder: "Pilih jenis kp"
	});
	$("#ktpejabat").select2({
        placeholder: "Pilih pejabat penetap",
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

    $("#ktnamajabatan").select2({
        placeholder: "Pilih satuan kerja",
        allowClear: true,
        ajax: {
            url: "json-data/combo_json/autocompletesatuankerja",
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
        templateResult: tampilSatuanKerja, // omitted for brevity, see the source of this page
        templateSelection: pilihSatuanKerja // omitted for brevity, see the source of this page
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
		var formSubmitUrl = "json-data/personal_json/jsonpegawaijabatanriwayatadd";
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
					reqNoSK: {
						validators: {
							notEmpty: {
								message: 'No SK harus diisi'
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
			        		document.location.href = "data/index/pegawai_jabatan";
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

