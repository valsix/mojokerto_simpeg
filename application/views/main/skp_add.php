<?
include_once("functions/personal.func.php");

$this->load->model("base/Skp");

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$reqId= $this->input->get('reqId');
$reqRowId= $this->input->get('reqRowId');

if(empty($reqRowId))
{
	$reqMode="insert";
}
else
{

	$skp = new Skp();
	$skp->selectByParams(array('SKP_ID'=>$reqRowId));
	$skp->firstRow();

	// echo $skp->query;exit; 

	$reqReqId					= (int)$skp->getField('SKP_ID');
	$reqTahun				= $skp->getField('TAHUN');
	$reqNilai		= str_replace(".", ",", $skp->getField('NILAI'));
	$reqOrientasi		= $skp->getField('ORIENTASI_PELAYANAN');
	$reqIntegritas		= $skp->getField('INTEGRITAS');
	$reqKomitmen		= $skp->getField('KOMITMEN');
	$reqDisiplin		= $skp->getField('DISIPLIN');
	$reqKerjasama		= $skp->getField('KERJASAMA');
	$reqKepemimpinan		= $skp->getField('KEPEMIMPINAN');
	$reqPejabatId		= $skp->getField('PEJABAT_ID');
	$reqAtasanId		= $skp->getField('ATASAN_PEJABAT_ID');
	$reqPejabat		= $skp->getField('PEJABAT_NIP');
	$reqAtasan		= $skp->getField('ATASAN_NIP');
	$reqInisiatif		= $skp->getField('INISIATIF_KERJA');

	$reqMode="update";


}

$readonly = "readonly";




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
						<a class="" href="app/index/skp?reqId=<?=$reqId?>">Skp</a>
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
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tahun</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<input type="text" class="form-control" name="reqTahun" id="reqTahun" value="<?=$reqTahun?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nilai Skp</label>
	        			<div class="col-lg-3 col-sm-12">
	        				<input type="text" class="form-control" name="reqNilai" id="reqNilai" value="<?=$reqNilai?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">NIP Pejabat Penilai</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="hidden" name="reqPejabatId" id="reqPejabatId" style="width:350px;" value="<?=$reqPejabatId?>" />   
	        				<select class="form-control select2"  id="reqPejabat" name="reqPejabat">
	        					<option value="<?=$reqPejabatId?>"><?=$reqPejabat?></option>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">NIP Atasan Pejabat Penilai</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="hidden" name="reqAtasanId" id="reqAtasanId" style="width:350px;" value="<?=$reqAtasanId?>" />   
	        				<select class="form-control select2"  id="reqAtasan" name="reqAtasan">
	        					<option value="<?=$reqAtasanId?>"><?=$reqAtasan?></option>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Orientasi Pelayanan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqOrientasi" id="reqOrientasi" value="<?=$reqOrientasi?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Integritas</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqIntegritas" id="reqIntegritas" value="<?=$reqIntegritas?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Komitmen</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqKomitmen" id="reqKomitmen" value="<?=$reqKomitmen?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Disiplin</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqDisiplin" id="reqDisiplin" value="<?=$reqDisiplin?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Kerjasama</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqKerjasama" id="reqKerjasama" value="<?=$reqKerjasama?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Kepemimpinan</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqKepemimpinan" id="reqKepemimpinan" value="<?=$reqKepemimpinan?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Inisiatif Kerja </label>
	        			<div class="col-lg-10 col-sm-12">
	        				<input type="text" class="form-control" name="reqInisiatif" id="reqInisiatif" value="<?=$reqInisiatif?>" />
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

	$('#reqTahun').bind('keyup paste', function(){
		this.value = this.value.replace(/\D/g,'');
	});

	$('#reqNilai').bind('keyup paste', function(){
		this.value = this.value.replace(/[^0-9\.|\,]/g,'');
	});


	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-main/skp_json/add";
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
                                document.location.href = "app/index/skp?reqId=<?=$reqId?>";
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


	$("#reqPejabat").select2({
        placeholder: "Pilih Pejabat",
        allowClear: true,
        ajax: {
            url: "json-main/combo_json/autocompletepejabat",
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
        templateResult: tampilPejabat, // omitted for brevity, see the source of this page
        templateSelection: pilihPejabat // omitted for brevity, see the source of this page
    });

    $("#reqAtasan").select2({
        placeholder: "Pilih Atasan Pejabat",
        allowClear: true,
        ajax: {
            url: "json-main/combo_json/autocompletepejabat",
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
        templateResult: tampilAtasan, // omitted for brevity, see the source of this page
        templateSelection: pilihAtasan // omitted for brevity, see the source of this page
    });

    function tampilPejabat(val) {
        if (val.loading) return val.text;
        var markup = "<div class='select2-result-repository clearfix'>" +
	            "<div class='select2-result-repository__meta'>" +
	            	"<div class='select2-result-repository__title'>" + val.description + "</div>" +
	            "</div>" +
            "</div>";
        return markup;
    }
    function pilihPejabat(val) {
    	$("#reqPejabatId").val(val.id);
        // console.log(val);
        return val.text;
    }


    function tampilAtasan(val) {
        if (val.loading) return val.text;
        var markup = "<div class='select2-result-repository clearfix'>" +
	            "<div class='select2-result-repository__meta'>" +
	            	"<div class='select2-result-repository__title'>" + val.description + "</div>" +
	            "</div>" +
            "</div>";
        return markup;
    }
    function pilihAtasan(val) {
    	$("#reqAtasanId").val(val.id);
        // console.log(val.id);
        return val.text;
    }




</script>