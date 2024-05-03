<?
include_once("functions/personal.func.php");

$this->load->model("base/UserGroup");

$reqId= $this->input->get('reqId');

$pgtitle= $pg;
$pgtitle= churuf(str_replace("_", " ", str_replace("add", "", $pgtitle)));

if(empty($reqId))
{
	$reqMode="insert";
}
else
{
	$set = new UserGroup();
	$set->selectByParams(array('USER_GROUP_ID'=>$reqId));
	// echo $set->query;exit;
	$set->firstRow();
	$reqId= $set->getField('USER_GROUP_ID');
	
	$reqNama 			= $set->getField('NAMA');
	$reqPegawaiProses	= $set->getField('PEGAWAI_PROSES');
	$reqDUKProses 		= $set->getField('DUK_PROSES');
	$reqKGBProses 		= $set->getField('KGB_PROSES');
	$reqKPProses  		= $set->getField('KP_PROSES');
	$reqPensiunProses	= $set->getField('PENSIUN_PROSES');
	$reqAnjabProses 	= $set->getField('ANJAB_PROSES');
	$reqMutasiProses  	= $set->getField('MUTASI_PROSES');
	$reqHukumanProses 	= $set->getField('HUKUMAN_PROSES');
	$reqMasterProses  	= $set->getField('MASTER_PROSES');
	$reqLihatProses= $set->getField('LIHAT_PROSES');

	$reqBidangPembinaan= $set->getField('BIDANG_PEMBINAAN');
	$reqBidangDokumentasi= $set->getField('BIDANG_DOKUMENTASI');
	$reqBidangPendidikan= $set->getField('BIDANG_PENDIDIKAN');
	$reqBidangMutasi=$set->getField('BIDANG_MUTASI');

	$reqMode="update";
}
$arrTahun= setTahunLoop(3,1);
?>

<!-- Bootstrap core CSS -->
<link href="lib/bootstrap-3.3.7/docs/examples/navbar/navbar.css" rel="stylesheet">

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a class="" href="app/index/master_user_group"><?=$pgtitle?></a>
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
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data" autocomplete="off">
	        	<div class="card-body">
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama</label>
	        			<div class="col-lg-6 col-sm-12">
	        				<input type="text" class="form-control" name="reqNama" id="reqNama" required value="<?=$reqNama?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">Lihat Proses</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqLihatProses== '1') echo 'checked';?>  name="reqLihatProses" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqLihatProses== '0') echo 'checked';?> name="reqLihatProses" value="0" /> Tidak
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">Pegawai Proses</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqPegawaiProses== '1') echo 'checked';?>  name="reqPegawaiProses" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqPegawaiProses== '0') echo 'checked';?> name="reqPegawaiProses" value="0" /> Tidak
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">DUK Proses</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqDUKProses== '1') echo 'checked';?>  name="reqDUKProses" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqDUKProses== '0') echo 'checked';?> name="reqDUKProses" value="0" /> Tidak
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">KGB Proses</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqKGBProses== '1') echo 'checked';?>  name="reqKGBProses" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqKGBProses== '0') echo 'checked';?> name="reqKGBProses" value="0" /> Tidak
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">KP Proses</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqKPProses== '1') echo 'checked';?>  name="reqKPProses" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqKPProses== '0') echo 'checked';?> name="reqKPProses" value="0" /> Tidak
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">Pensiun Proses</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqPensiunProses== '1') echo 'checked';?>  name="reqPensiunProses" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqPensiunProses== '0') echo 'checked';?> name="reqPensiunProses" value="0" /> Tidak
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">Anjab Proses</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqAnjabProses== '1') echo 'checked';?>  name="reqAnjabProses" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqAnjabProses== '0') echo 'checked';?> name="reqAnjabProses" value="0" /> Tidak
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">Mutasi Proses</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqMutasiProses== '1') echo 'checked';?>  name="reqMutasiProses" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqMutasiProses== '0') echo 'checked';?> name="reqMutasiProses" value="0" /> Tidak
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">Hukuman Proses</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqHukumanProses== '1') echo 'checked';?>  name="reqHukumanProses" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqHukumanProses== '0') echo 'checked';?> name="reqHukumanProses" value="0" /> Tidak
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">Master  Proses</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqMasterProses== '1') echo 'checked';?>  name="reqMasterProses" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqMasterProses== '0') echo 'checked';?> name="reqMasterProses" value="0" /> Tidak
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">Bidang Pembinaan dan Pengembangan Aparatur</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqBidangPembinaan== '1') echo 'checked';?>  name="reqBidangPembinaan" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqBidangPembinaan== '0') echo 'checked';?> name="reqBidangPembinaan" value="0" /> Tidak
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">Bidang Dokumentasi dan Informasi</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqBidangDokumentasi== '1') echo 'checked';?>  name="reqBidangDokumentasi" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqBidangDokumentasi== '0') echo 'checked';?> name="reqBidangDokumentasi" value="0" /> Tidak
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">Bidang Pendidikan dan Pelatihan</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqBidangPendidikan== '1') echo 'checked';?>  name="reqBidangPendidikan" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqBidangPendidikan== '0') echo 'checked';?> name="reqBidangPendidikan" value="0" /> Tidak
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12 ">Bidang Mutasi</label>
	        			<div class="col-lg-2 col-sm-12" style="margin-top: 10px">
	        				<input type="radio" <? if($reqBidangMutasi== '1') echo 'checked';?>  name="reqBidangMutasi" value="1" /> Ya &nbsp;&nbsp;&nbsp;
	        				<input type="radio" <? if($reqBidangMutasi== '0') echo 'checked';?> name="reqBidangMutasi" value="0" /> Tidak
	        			</div>
	        		</div>
	        		
	        		
	        		<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
	        				<input type="hidden" name="reqId" value="<?=$reqId?>">
	        				<input type="hidden" name="reqRowId" value="<?=$reqRowId?>">
	        				<button type="button"  onclick="history.back()" class="btn btn-light-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>
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

	

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-main/user_group_json/add";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNama: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi Nama'
							},
						}
					},
					reqPegawaiProses: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi Pegawai Proses'
							},
						}
					},
					reqDUKProses: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi DUK Proses'
							},
						}
					},
					reqKGBProses: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi KGB Proses'
							},
						}
					},
					reqKPProses: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi KP Proses'
							},
						}
					},
					reqPensiunProses: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi Pensiun Proses'
							},
						}
					},
					reqAnjabProses: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi Anjab Proses'
							},
						}
					},
					reqMutasiProses: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi  Mutasi Proses'
							},
						}
					},
					reqHukumanProses: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi Hukuman Proses'
							},
						}
					},
					reqMasterProses: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi Master Proses'
							},
						}
					},
					reqLihatProses: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi Lihat Proses'
							},
						}
					},
					reqBidangPembinaan: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi BidangPembinaan'
							},
						}
					},
					reqBidangDokumentasi: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi Bidang Dokumentasi'
							},
						}
					},
					reqBidangPendidikan: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi Bidang Pendidikan'
							},
						}
					},
					reqBidangMutasi: {
						validators: {
							notEmpty: {
								message: 'Anda belum mengisi Bidang Mutasi'
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
                                document.location.href = "app/index/master_user_group";
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


</script>