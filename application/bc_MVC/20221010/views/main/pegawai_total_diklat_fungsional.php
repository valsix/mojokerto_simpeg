<?
include_once("functions/personal.func.php");

$this->load->model("base-data/InfoData");


$reqPegawaiId= $this->pegawaiId;
// echo $reqPegawaiId; exit;
$reqRowId= $this->input->get('reqRowId');

$set = new InfoData();
$set->selectbytotalfungsionalstruktural(array('A.PEGAWAI_ID'=>$reqPegawaiId));
// echo $set->query;exit;
$set->firstRow();
$reqKeterampilan= $set->getField('JENJANG_KETERAMPILAN');
$reqAhliPertama= $set->getField('JENJANG_AHLIPERTAMA');
$reqAhliMuda= $set->getField('JENJANG_AHLIMUDA');
$reqAhliMadya= $set->getField('JENJANG_AHLIMADYA');
$reqAhliUtama= $set->getField('JENJANG_AHLIUTAMA');
$reqRowId= $set->getField('TOTAL_DIKLAT_fungsional_ID');
if($reqRowId == "")
{
    $reqMode = 'insert';
}
else
{
    $reqMode = 'update';
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
                        <a class="text-muted">Riwayat Diklat Fungsional</a>
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
                    <h3 class="card-label">Total Diklat Fungsional</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Jenjang Keterampilan</label>
                        <div class="col-lg-4 col-sm-12">
                            <!-- <input type="text" style="margin-left: 11px"  <?=$disabled?> class="form-control" placeholder="Masukkan Total" name="reqTotal" id="reqTotal" value="<?=$reqTotal?>" /> -->
                            <input type="checkbox" name="reqKeterampilan" class="form-control" style="width: 5%;" <?if($reqKeterampilan==1){?>checked<?}?> value="1">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Jenjang Ahli Pertama</label>
                        <div class="col-lg-4 col-sm-12">
                            <!-- <input type="text" style="margin-left: 11px"  <?=$disabled?> class="form-control" placeholder="Masukkan Total" name="reqTotal" id="reqTotal" value="<?=$reqTotal?>" /> -->
                            <input type="checkbox" name="reqAhliPertama" class="form-control" style="width: 5%;" <?if($reqAhliPertama==1){?>checked<?}?> value="1">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Jenjang Ahli Muda</label>
                        <div class="col-lg-4 col-sm-12">
                            <!-- <input type="text" style="margin-left: 11px"  <?=$disabled?> class="form-control" placeholder="Masukkan Total" name="reqTotal" id="reqTotal" value="<?=$reqTotal?>" /> -->
                            <input type="checkbox" name="reqAhliMuda" class="form-control" style="width: 5%;" <?if($reqAhliMuda==1){?>checked<?}?> value="1">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Jenjang Ahli Madya</label>
                        <div class="col-lg-4 col-sm-12">
                            <!-- <input type="text" style="margin-left: 11px"  <?=$disabled?> class="form-control" placeholder="Masukkan Total" name="reqTotal" id="reqTotal" value="<?=$reqTotal?>" /> -->
                            <input type="checkbox" name="reqAhliMadya" class="form-control" style="width: 5%;" <?if($reqAhliMadya==1){?>checked<?}?> value="1">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Jenjang Ahli Utama</label>
                        <div class="col-lg-4 col-sm-12">
                            <!-- <input type="text" style="margin-left: 11px"  <?=$disabled?> class="form-control" placeholder="Masukkan Total" name="reqTotal" id="reqTotal" value="<?=$reqTotal?>" /> -->
                            <input type="checkbox" name="reqAhliUtama" class="form-control" style="width: 5%;" <?if($reqAhliUtama==1){?>checked<?}?> value="1">
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

                            <input type="hidden" name="reqUpload" value="2">
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
        window.location.href='app/index/pegawai_diklat_teknis'
    }

    $('#ktpendidikanid').select2({
        placeholder: "Pilih Pendidikan"
    });

    $('#ktkampusid').select2({
        placeholder: "Pilih Kampus"
    });

    arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
    $('.datepickertanggal').datepicker({
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
        var formSubmitUrl = "json-data/info_data_json/totaldiklatfungsionaladd";
        var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
        if (!form) {
            return;
        }
        FormValidation
        .formValidation(
            form,
            {
                /*fields: {
                    reqPejabatPenetap: {
                        validators: {
                            notEmpty: {
                                message: 'Pejabat Penetap harus diisi'
                            }
                        }
                    },
                },*/
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
                            document.location.href = "app/index/pegawai_total_diklat_fungsional";
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