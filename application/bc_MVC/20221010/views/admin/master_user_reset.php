<?
include_once("functions/string.func.php");
include_once("functions/date.func.php");

$reqFilename = "master_user";

$this->load->model("base-app/Users");
$this->load->model("base-app/UserGroup");


$set = new Users();
$user_grup  = new UserGroup();


$reqId= $this->input->get("reqId");
$reqAksesAppSimpegId= $this->input->get("reqAksesAppSimpegId");

if($reqId == ""){
    $reqMode = "insert";
}
else
{
    $reqMode = "update";
    $set->selectByParamsMonitoring(array("A.USER_APP_ID"=>$reqId));
    // echo $set->query;exit;
    $set->firstRow();
    
    $reqNama= $set->getField("NAMA");
    $reqNama       = $set->getField('NAMA');
    $reqNamaLogin  = $set->getField('USER_LOGIN');
    $reqUserGroup  = $set->getField('USER_GROUP_ID');
    $reqSatkerNama = $set->getField('SATKER');
    $reqSatkerId   = $set->getField('SATKER_ID');

}

$user_grup->selectByParamsUser(array(),-1,-1);
// echo $user_grup->query;exit;

?>
<script type="text/javascript" src="functions/globalfunction.js"></script>

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Reset Passwordr </a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Detil </a>
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
                    <h3 class="card-label">Reset Password </h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Nama Login</label>
                        <div class="col-lg-4 col-sm-12">
                            <input type="text" class="form-control" disabled name="reqNamaLogin" id="reqNamaLogin" value="<?=$reqNamaLogin?>" />
                        </div>
                    </div>
             
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Password</label>
                        <div class="col-lg-4 col-sm-12">
                            <input type="password" class="form-control" name="reqPassword" id="reqPassword" autocomplete="off" readonly 
                            onfocus="this.removeAttribute('readonly');" value="<?=$reqPassword?>" />
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-9">
                            <input type="hidden" name="reqMode" value="<?=$reqMode?>">
                            <input type="hidden" name="reqId" value="<?=$reqId?>">
                            <button onclick="kembali()" type="button" class="btn btn-warning font-weight-bold mr-2">Kembali</button>
                            <button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("input", "#reqJumlahJam,#reqTahun", function() {
        this.value = this.value.replace(/\D/g,'');
    });

    function kembali() {
        window.location.href='admin/index/master_user'
    }
    
    var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
    jQuery(document).ready(function() {
        var form = KTUtil.getById('ktloginform');
        var formSubmitUrl = "json-admin/user_json/reset";
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
                                message: 'Nama harus diisi'
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
                                document.location.href = "admin/index/master_user";
                                // window.location.reload();
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // var err = JSON.parse(xhr.responseText);
                        // Swal.fire("Error", err.message, "error");
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
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                }
            }).then(function() {
                KTUtil.scrollTop();
            });
        });
    });
</script>