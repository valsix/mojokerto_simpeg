<?
include_once("functions/string.func.php");
include_once("functions/date.func.php");

$reqFilename = "master_user_group";

$this->load->model("base-app/Menu");

$reqId= $this->input->get("reqId");
$reqMenuGroupId= $this->input->get("reqMenuGroupId");
$reqTable= $this->input->get("reqTable");
$reqRowId= $this->input->get("reqRowId");
$reqJenis= $this->input->get("reqJenis");

$i=0;
if($reqRowId == "")
    $reqMode = "insert";
else
{
    $statement= "";

    $reqMode = "update";
    $menu= new Menu();
    $menu->selectByParams(array("MENU_GROUP_ID" => $reqMenuGroupId), -1, -1, $statement, $reqRowId, $reqTable);
    // echo $menu->errorMsg;exit;
    // echo $menu->query;exit;
    while($menu->nextRow())
    {
        $arrMenu[$i]["MENU_PARENT_ID"] = $menu->getField("MENU_PARENT_ID");
        $arrMenu[$i]["MENU_ID"] = $menu->getField("MENU_ID");
        $arrMenu[$i]["NAMA"] = $menu->getField("NAMA");
        $arrMenu[$i]["AKSES"] = $menu->getField("AKSES");
        $arrMenu[$i]["MENU"] = $menu->getField("MENU");
        $arrMenu[$i]["PANJANG_MENU"] = $menu->getField("PANJANG_MENU");
        $arrMenu[$i]["JUMLAH_CHILD"] = $menu->getField("JUMLAH_CHILD");
        $i++;
    }
}

$jumlah_menu= $i;
// print_r($arrMenu);exit;
?>
<script type="text/javascript" src="functions/globalfunction.js"></script>

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Data User Group</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Detil Kelola Menu Akses</a>
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
                    <h3 class="card-label">Kelola Menu Akses</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Nama</label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" placeholder="Masukkan Nama" name="reqNama" id="reqNama" value="<?=$arrMenu[0]["NAMA"]?>" />
                        </div>
                    </div>

                    <?
                        $tempJumlahData= 0;
                        for($i=0;$i<count($arrMenu);$i++)
                        {
                            $tempId= $arrMenu[$i]["MENU_ID"];
                            $tempParentId= $arrMenu[$i]["MENU_PARENT_ID"];
                            $tempJumlahChild= $arrMenu[$i]["JUMLAH_CHILD"];
                            $tempPanjangMenu= $arrMenu[$i]["PANJANG_MENU"];

                            if($tempJumlahChild == '0')
                            {
                        ?>
                            <div class="row" style="background-color: #d9edf7;">
                                <div class="col-lg-4 col-sm-12" style="padding-left:<?=$tempPanjangMenu?>%">
                                    <?=$arrMenu[$i]["MENU"]?>
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <span>
                                        <input type="radio" <? if($arrMenu[$i]["AKSES"] == 'A') echo 'checked'; else echo 'checked'; ?> name="reqCheck<?=$i?>" id="reqRadioCheck-A-<?=$tempId?>-<?=$i?>" value="A" />  
                                        <label for="reqRadioCheck-A-<?=$tempId?>-<?=$i?>">All</label>
                                    </span>

                                    <span>
                                        <input type="radio" <? if($arrMenu[$i]["AKSES"] == 'R') echo 'checked';?> name="reqCheck<?=$i?>" id="reqRadioCheck-R-<?=$tempId?>-<?=$i?>" value="R" />  
                                        <label for="reqRadioCheck-R-<?=$tempId?>-<?=$i?>">Readonly</label>
                                    </span>

                                    <span>
                                        <input type="radio" <? if($arrMenu[$i]["AKSES"] == 'D') echo 'checked';?> name="reqCheck<?=$i?>" id="reqRadioCheck-D-<?=$tempId?>-<?=$i?>" value="D" /> 
                                        <label for="reqRadioCheck-D-<?=$tempId?>-<?=$i?>">Disabled</label>
                                    </span>

                                    <input type="hidden" name="reqMenuId[]" value="<?=$arrMenu[$i]["MENU_ID"]?>">
                                    <input type="hidden" name="reqCheck[]" id="reqCheck<?=$tempId?>" value="<?=$arrMenu[$i]["AKSES"]?>">
                                </div>
                            </div>
                        <?
                            }
                            else
                            {
                        ?>
                            <div class="row">
                                <div class="col-lg-4 col-sm-12" style="padding-left:<?=$tempPanjangMenu?>%">
                                    <?=$arrMenu[$i]["MENU"]?>
                                </div>
                                <div class="col-lg-8 col-sm-12">
                                    <span>
                                        <input type="radio" <? if($arrMenu[$i]["AKSES"] == 'A') echo 'checked'; else echo 'checked'; ?> name="reqCheck<?=$i?>" id="reqRadioCheck-A-<?=$tempId?>-<?=$i?>" value="A" />  
                                        <label for="reqRadioCheck-A-<?=$tempId?>-<?=$i?>">All</label>
                                    </span>

                                    <span>
                                        <input type="radio" <? if($arrMenu[$i]["AKSES"] == 'R') echo 'checked';?> name="reqCheck<?=$i?>" id="reqRadioCheck-R-<?=$tempId?>-<?=$i?>" value="R" />  
                                        <label for="reqRadioCheck-R-<?=$tempId?>-<?=$i?>">Readonly</label>
                                    </span>

                                    <span>
                                        <input type="radio" <? if($arrMenu[$i]["AKSES"] == 'D') echo 'checked';?> name="reqCheck<?=$i?>" id="reqRadioCheck-D-<?=$tempId?>-<?=$i?>" value="D" /> 
                                        <label for="reqRadioCheck-D-<?=$tempId?>-<?=$i?>">Disabled</label>
                                    </span>

                                    <input type="hidden" name="reqMenuId[]" value="<?=$arrMenu[$i]["MENU_ID"]?>">
                                    <input type="hidden" name="reqCheck[]" id="reqCheck<?=$tempId?>" value="<?=$arrMenu[$i]["AKSES"]?>">
                                </div>
                            </div>
                        <?
                                $tempJumlahData++;
                            }
                        }
                        ?>

                    <!-- <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Pengaturan</label>
                        <div class="col-lg-10 col-sm-12">
                        </div>
                    </div> -->

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-9">
                            <input type="hidden" name="reqRowId" value="<?=$reqRowId?>">
                            <input type="hidden" name="reqId" value="<?=$reqId?>" />
                            <input type="hidden" name="reqMode" value="<?=$reqMode?>" />
                            <input type="hidden" name="reqTable" value="<?=$reqTable?>">
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

    $(function(){
        $('input:radio[id^="reqRadioCheck"]').click(function() {

            var tempId= $(this).attr('id');

            arrTempId= String(tempId);
            arrTempId= arrTempId.split('-');
            // reqRadioCheck-R-<?=$tempId?>-<?=$i?>


            reqCheckInfo= arrTempId[1];
            reqCheckMenuIndex= arrTempId[2];
            reqCheckIndex= arrTempId[3];
            reqCheckMenuIndexPanjang= reqCheckMenuIndex.length;

            // console.log(reqCheckInfo+"-"+reqCheckMenuIndex+"-"+reqCheckIndex+"-"+reqCheckMenuIndexPanjang);

            // $("#reqCheck"+reqCheckIndex).val(reqCheckInfo);
            $('input[id^="reqCheck'+reqCheckMenuIndex+'"]').val(reqCheckInfo);
            if(reqCheckMenuIndexPanjang == 2 || reqCheckMenuIndexPanjang == 4)
            {
                // $('input[id^="reqRadioCheck-'+reqCheckInfo+'-'+reqCheckMenuIndex+'"]').removeAttr('checked');
                $('input:radio[id^="reqRadioCheck-'+reqCheckInfo+'-'+reqCheckMenuIndex+'"]').prop("checked", true);
                $('input:radio[id^="reqRadioCheck-'+reqCheckInfo+'-'+reqCheckMenuIndex+'"]').attr('checked', true);

                // console.log("reqRadioCheck-"+reqCheckInfo+"-"+reqCheckMenuIndex+"xx");
                // $('input:radio[id^="reqRadioCheck-'+reqCheckInfo+'-'+reqCheckMenuIndex+'"]').attr('checked', true);
            }

        });

    });

    function OpenDHTML(url)
    {
        document.location.href= url;
    }

    function kembali() {
        document.location.href= "admin/index/master_user_group_add?reqId=<?=$reqId?>&reqAksesAppSimpegId=<?=$reqRowId?>";
    }
    
    var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
    jQuery(document).ready(function() {
        var form = KTUtil.getById('ktloginform');
        var formSubmitUrl = "json-admin/user_group_json/add_menu";
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
                                document.location.href = "admin/index/akses_administrasi_add/?reqId=<?=$reqId?>&reqMenuGroupId=<?=$reqMenuGroupId?>&reqTable=<?=$reqTable?>&reqRowId="+rowid;
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