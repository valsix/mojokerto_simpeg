<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #053968;
  color: white;
}
</style>
<?
include_once("functions/personal.func.php");

$this->load->model("base-data/InfoData");

$reqPegawaiId= $this->pegawaiId;

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
                        <a class="text-muted">PLT PLH</a>
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
                    <h3 class="card-label">PLT PLH</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <table class="formstyle">
                        <tr>
                            <td>
                            <button type="button" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2" onclick="TambahSub()" >Tambah</button>
                            </td>
                        </tr>
                    </table>
                    <div style="overflow: scroll;" class="formstyle">
                        <table id='customers'>
                            <thead>
                                <tr>
                                    <th style="width: 1000px"><center>Tipe</center></th>
                                    <th style="width: 1000px"><center>Jumlah</center></th>
                                    <th style="width: 1000px"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody id="tbodyObyek">
                                <?
                                $set = new InfoData();
                                $set->selectbytotalpltplh(array('A.PEGAWAI_ID'=>$reqPegawaiId));
                                // echo $set->query;exit;
                                while($set->nextRow()){
                                    $reqTipe= $set->getField('TIPE');
                                    $reqId= $set->getField('TOTAL_PLT_PLH_ID');
                                    $reqJumlah= $set->getField('JUMLAH');
                                ?>
                                    <tr>
                                        <td>
                                            <input type="hidden" name="reqId[]" class="form-control"  value='<?=$reqId?>'>
                                            <select name="reqTipe[]" class="form-control">
                                                <option <?if($reqTipe==1){echo "selected";}?> value="1">PLH Setara</option>
                                                <option <?if($reqTipe==2){echo "selected";}?> value="2">PLH Lebih Tinggi</option>
                                                <option <?if($reqTipe==3){echo "selected";}?> value="3">PLT Lebih Tinggi</option>
                                                <option <?if($reqTipe==4){echo "selected";}?> value="4">PLT Setara</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="reqJumlah[]" class="form-control" value="<?=$reqJumlah?>">
                                        </td>
                                        <td><button class='btn btn-outline-secondary border--Green' type='button' id='license-category-search' onclick='HapusDb(<?=$reqId?>)' style='background-color: red; color: white'><i class='fa fa-trash fa-lg'></i></button></td>
                                    </tr>
                                <?}?>
                            </tbody>
                        </table>
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
        var formSubmitUrl = "json-data/info_data_json/totalpltplhadd";
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
                            document.location.href = "app/index/pegawai_total_plt_plh";
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

    function TambahSub(array) {
        // console.log("masuk");
        test =` <tr>
                    <td>
                        <input type="hidden" name="reqId[]" class="form-control"  value=''>
                        <select name="reqTipe[]">
                            <option <?if($reqTipe==1){echo "selected";}?> value="1">PLH Setara</option>
                            <option <?if($reqTipe==2){echo "selected";}?>value="2">PLH Lebih Tinggi</option>
                            <option <?if($reqTipe==3){echo "selected";}?>value="3">PLT Lebih Tinggi</option>
                            <option <?if($reqTipe==4){echo "selected";}?>value="4">PLT Setara</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="reqJumlah[]" class="form-control">
                    </td>
                    <td><button class='btn btn-outline-secondary border--Green' type='button' id='license-category-search' onclick='Hapussparepart(this)' style='background-color: red; color: white'><i class='fa fa-trash fa-lg'></i></button></td>
                </tr>`;
        $("#tbodyObyek").append(test);
    }

    function Hapussparepart(ctl) {
        $(ctl).parents("tr").remove();
    }

    function HapusDb(val){       
        urlAjax= "json-data/info_data_json/totalpltplhdel?&reqId="+val;
        swal.fire({
            title: 'Apakah anda yakin untuk hapus data?',
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
                            position: 'top-right',
                            icon: "success",
                            type: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function() {
                            document.location.href = "app/index/pegawai_total_plt_plh";
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
</script>