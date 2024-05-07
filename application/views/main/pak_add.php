<?
include_once("functions/personal.func.php");

$this->load->model("base/Pak");

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

if(empty($reqRowId))
{
	$reqMode="insert";
}
else
{

	$set = new Pak();
	$set->selectByParams(array('PAK_ID'=>$reqRowId));
	// echo $set->query;exit;
	$set->firstRow();
	$reqRowId= (int)$set->getField('PAK_ID');
	$reqNomor= $set->getField('NOMOR_SK');
	$reqTahun= $set->getField('TAHUN');
	$reqKredit= $set->getField('ANGKA_KREDIT');
	$reqBulanMulai= $set->getField('BULAN_MULAI');
	$reqTahunMulai= $set->getField('TAHUN_MULAI');
	$reqBulanSelesai= $set->getField('BULAN_SELESAI');
	$reqTahunSelesai= $set->getField('TAHUN_SELESAI');
	$reqTglSK= dateToPageCheck($set->getField('TGL_SK'));

	$reqMode="update";

}
	
$arrBulan= setBulanLoop();
$arrTahun= setTahunLoop(6,22);
$reqBulanAktif= generateZeroDate(date("n"),2);
$reqTahunAktif= date("Y");
?>

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
						<a class="" href="app/index/pak?reqId=<?=$reqId?>">Pak</a>
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nomor SK PAK</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" class="form-control" name="reqNomor" id="reqNomor" value="<?=$reqNomor?>" required />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tgl SK PAK</label>
	        			<div class="col-lg-6 col-sm-12">
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Total Angka Kredit</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" class="form-control" name="reqKredit" id="reqKredit" value="<?=$reqKredit?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Bulan Mulai Penilaian</label>
	        			<div class="col-lg-2 col-sm-12">
				        		<select name="reqBulanMulai" id="reqBulanMulai"  readonly class="form-control datatable-input">
									<option value="" <? if($reqBulanMulai == '') echo "selected";?>>Pilih</option>
								<?
								for($bulan=0;$bulan < count($arrBulan);$bulan++)
								{
									?>
									<option value="<?=generateZero($arrBulan[$bulan],2)?>" <? if($reqBulanMulai == $arrBulan[$bulan]) echo "selected";?>><?=getNameMonth(generateZero($arrBulan[$bulan],2))?></option>
									<?
								}
								?>
							</select>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Bulan Selesai Penilaian</label>
	        			<div class="col-lg-2 col-sm-12">
				        		<select name="reqBulanSelesai" id="reqBulanSelesai"  readonly class="form-control datatable-input">
									<option value="" <? if($reqBulanSelesai == '') echo "selected";?>>Pilih</option>
								<?
								for($bulan=0;$bulan < count($arrBulan);$bulan++)
								{
									?>
									<option value="<?=generateZero($arrBulan[$bulan],2)?>" <? if($reqBulanSelesai == $arrBulan[$bulan]) echo "selected";?>><?=getNameMonth(generateZero($arrBulan[$bulan],2))?></option>
									<?
								}
								?>
							</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tahun Mulai Penilaian</label>
	        			<div class="col-lg-2 col-sm-12">
				        		<select name="reqTahunMulai" id="reqTahunMulai"  readonly class="form-control datatable-input">
									<option value="" <? if($reqTahunMulai == '') echo "selected";?>>Pilih</option>
								<?
								for($tahun=0;$tahun < count($arrTahun);$tahun++)
								{
									?>
									<option value="<?=$arrTahun[$tahun]?>" <? if($reqTahunMulai == $arrTahun[$tahun]) echo "selected";?>><?=$arrTahun[$tahun]?></option>
									<?
								}
								?>
							</select>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tahun Selesai Penilaian</label>
	        			<div class="col-lg-2 col-sm-12">
				        		<select name="reqTahunSelesai" id="reqTahunSelesai"  readonly class="form-control datatable-input">
									<option value="" <? if($reqTahunSelesai == '') echo "selected";?>>Pilih</option>
								<?
								for($tahun=0;$tahun < count($arrTahun);$tahun++)
								{
									?>
									<option value="<?=$arrTahun[$tahun]?>" <? if($reqTahunSelesai == $arrTahun[$tahun]) echo "selected";?>><?=$arrTahun[$tahun]?></option>
									<?
								}
								?>
							</select>
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

	$(function () {
		$("[rel=tooltip]").tooltip({ placement: 'right'});
		// $('[data-toggle="tooltip"]').tooltip()
	})

	$("#reqTglSK").keypress(function(e) {
		if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
		{
		return false;
		}
	});


	var kredit = document.getElementById('reqKredit');


	kredit.addEventListener('keydown', function(event)
	{
		limitCharacter(event);
	});
	
	function limitCharacter(event)
	{
		key = event.which || event.keyCode;
		console.log(key);
		if (  // 188 Comma
			 key != 8 // Backspace
			 && key != 17
			 && key != 190
			 && (key < 48 || key > 57) // Non digit
			 // Dan masih banyak lagi seperti tombol del, panah kiri dan kanan, tombol tab, dll
			) 
		{
			event.preventDefault();
			return false;
		}
	}

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
		var formSubmitUrl = "json-main/pak_json/add";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNomor: {
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
                                document.location.href = "app/index/pak?&reqId=<?=$reqId?>";
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

	$("#reqBulanMulai, #reqBulanSelesai, #reqTahunMulai, #reqTahunSelesai").select2({
    	placeholder: "Pilih salah satu data",
    	allowClear: true
  	});

</script>