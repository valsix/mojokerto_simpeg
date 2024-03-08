<?
include_once("functions/personal.func.php");

$this->load->model("base-data/Pangkat");
$this->load->model("base-data/PejabatPenetap");
$this->load->model("base-app/KenaikanGajiBerkala");
$this->load->model("base-app/GajiRiwayat");


$reqGAJI_RIWAYAT_ID = $this->input->get("reqGAJI_RIWAYAT_ID");
$reqMode = $this->input->get("reqMode"); 
$reqPegawaiId = $this->input->get("reqPegawaiId"); 
$reqMode    = $this->input->get("reqMode");

$reqBulan= $this->input->get("reqBulan");
$reqTahun= $this->input->get("reqTahun");
$reqSatkerId= $this->input->get("reqSatkerId");
          
$reqNoSK        = $this->input->get("reqNoSK");
$reqTglSK       = $this->input->get("reqTglSK");
$reqGolRuang    = $this->input->get("reqGolRuang");
$reqTMTSK       = $this->input->get("reqTMTSK");
$reqPjPenetap   = $this->input->get("reqPjPenetap");
$reqPjPenetapNama= $this->input->get("reqPjPenetapNama");
$reqTh          = $this->input->get("reqTh");
$reqBl          = $this->input->get("reqBl");
$reqGajiPokok   = $this->input->get("reqGajiPokok");
$reqJenis       = $this->input->get("reqJenis");
$reqPegawaiId   = $this->input->get("reqPegawaiId");


$gaji = new GajiRiwayat();
$kenaikan_gaji_berkala= new KenaikanGajiBerkala();
$pangkat = new Pangkat();
$pejabat_penetap = new PejabatPenetap();

$statement="";
$sOrder="";
$arrPangkat= [];
$pangkat->selectByParams(array(), -1,-1,$statement,$sOrder);
// echo $set->query;exit;
while($pangkat->nextRow())
{
    $arrdata= [];
    $arrdata["id"]= $pangkat->getField("PANGKAT_ID");
    $arrdata["text"]= $pangkat->getField("KODE");
    array_push($arrPangkat, $arrdata);
}
unset($pangkat);

$reqTitle="";
if($reqMode == 'edit' || $reqMode == 'cancel' || $reqMode == 'view')
{
    $reqTitle="Ubah Kenaikan Gaji Berkala";
    if($reqGAJI_RIWAYAT_ID == "")
    {
        $reqPeriode= "01".$reqBulan."".$reqTahun;
        $statement= " AND A.PEGAWAI_ID= '".$reqPegawaiId."' AND TO_CHAR(TMT_SK, 'DDMMYYYY') = '".$reqPeriode."'";
        $gaji->selectByParams(array(), -1,-1, $statement);
        $gaji->firstRow();
        $reqGAJI_RIWAYAT_ID= $gaji->getField("GAJI_RIWAYAT_ID");
        //echo $gaji->query;
    }
    $gaji->selectByParams(array('GAJI_RIWAYAT_ID'=>$reqGAJI_RIWAYAT_ID));
    $gaji->firstRow();

    $reqGAJI_RIWAYAT_ID = $gaji->getField('GAJI_RIWAYAT_ID');
    $reqNoSK   = $gaji->getField('NO_SK');
    $reqGolRuang   = $gaji->getField('PANGKAT_ID');
    $reqTglSK = dateToPageCheck($gaji->getField('TANGGAL_SK'));
    $reqGajiPokok  = $gaji->getField('GAJI_POKOK');
    $reqTh = $gaji->getField('MASA_KERJA_TAHUN');
    $reqBl = $gaji->getField('MASA_KERJA_BULAN');
    $reqPjPenetapNama= $gaji->getField('NMPEJABATPENETAP');

    $reqPejabatPenetapId= $gaji->getField('PEJABAT_PENETAP_ID');
    $reqPejabatPenetap= $gaji->getField('NMPEJABATPENETAP');
    
    $reqJenis= $gaji->getField('JENIS_KENAIKAN');
    $reqTMTSK= dateToPageCheck($gaji->getField('TMT_SK'));
    $reqPegawaiId      = $gaji->getField('PEGAWAI_ID');

}

    
if($reqRowId == "")
{
    $reqMode = 'insert';
}
else
{
    $reqMode = 'update';
}


// print_r($arragama);exit;

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
                        <a class="text-muted">Kenaikan Gaji Berkala</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Detail Kenaikan Gaji Berkala</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted"><?=$reqTitle?></a>
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
                    <h3 class="card-label"><?=$reqTitle?></h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">No. Sk</label>
                        <div class="col-lg-4 col-sm-12">
                            <input type="text" class="form-control"  id="reqNoSK" name="reqNoSK" value="<?=$reqNoSK?>" />
                        </div>
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Tgl. SK :</label>
                        <div class="col-lg-4 col-sm-12">
                            <div class="input-group date">
                                <input type="text" class="form-control" <?=$disabled?> id="reqTglSK" name="reqTglSK" value="<?=$reqTglSK?>" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Gol/Ruang
                        </label>
                        <div class="col-lg-4 col-sm-12">
                            <select class="form-control select2 " id="reqGolRuang" name="reqGolRuang" >
                                <option value=""></option>
                                <?
                                foreach($arrPangkat as $item) 
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
                        <label class="col-form-label text-right col-lg-2 col-sm-12">TMT. SK :</label>
                        <div class="col-lg-4 col-sm-12">
                            <div class="input-group date">
                                <input type="text" class="form-control" <?=$disabled?> id="reqTMTSK" name="reqTMTSK" value="<?=$reqTMTSK?>" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>                  
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Pejabat Penetap
                        </label>
                        <div class="col-lg-10 col-sm-12">
                            <select class="form-control select2" id="ktsatuankerja" name="reqPejabatPenetap">
                                <option value="<?=$reqPejabatPenetapId?>"><?=$reqPejabatPenetap?></option>
                            </select>
                            <span class="form-text text-muted"><label id="pejabatdetil"></label></span>
                            <input type="hidden" name="reqPejabatPenetapId" id="reqPejabatPenetapId" value="<?=$reqPejabatPenetapId?>" >
                            <input type="hidden" name="reqPejabatPenetap" id="reqPejabatPenetap" value="<?=$reqPejabatPenetap?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Masa Kerja</label>
                        <div class="form-group col-xs-3 col-xs-offset-1">
                            <input type="text" style="width:100px;margin-left: 11px" <?=$disabled?> class="form-control" placeholder="Tahun" maxlength="4" name="reqTh" id="reqTh" value="<?=$reqTh?>" />
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
                        <label class="col-form-label text-right col-lg-3 col-sm-12">Gaji Pokok</label>
                        <div class="col-lg-4 col-sm-12">
                            <input type="text" class="form-control" style="margin-left: 13px" <?=$disabled?>   OnFocus="FormatAngka('reqGajiPokok')" OnKeyUp="FormatUang('reqGajiPokok')" OnBlur="FormatUang('reqGajiPokok')" placeholder="Masukkan Gaji Pokok" name="reqGajiPokok" id="reqGajiPokok" value="<?=numberToIna($reqGajiPokok)?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Jenis</label>
                        <div class="col-lg-3 col-sm-8">
                            <select <?=$disabled?> name="reqJenis" class="form-control">
                                <option value="1"  <? if($reqJenis == 1) echo "selected";?>>Kenaikan Pangkat</option>
                                <option value="2" <? if($reqJenis == 2) echo "selected";?>>Gaji Berkala</option>
                                <option value="3" <? if($reqJenis == 3) echo "selected";?>>Penyesuaian Tabel Gaji Pokok</option>
                                <option value="4" <? if($reqJenis == 4) echo "selected";?>>SK Lain-lain</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-9">
                            <input type="hidden" name="reqMode" value="<?=$reqMode?>">
                            <input type="hidden" name="reqRowId" value="<?=$reqRowId?>">
                            <input type="hidden" name="reqGAJI_RIWAYAT_ID" value="<?=$reqGAJI_RIWAYAT_ID?>">
                            <input type="hidden" name="reqPegawaiId" value="<?=$reqPegawaiId?>">
                            <input type="hidden" name="reqBulan" value="<?=$reqBulan?>">
                            <input type="hidden" name="reqTahun" value="<?=$reqTahun?>">
                            <input type="hidden" name="reqSatkerId" value="<?=$reqSatkerId?>">
                            <input type="hidden" name="reqPeriode" value="<?=$reqPeriode?>">
                            <button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>>

<script type="text/javascript">
    $(document).on("input", "#reqThTMK,#reqTh,#reqBl,#reqGajiPokok", function() {
        this.value = this.value.replace(/\D/g,'');
    });
    function kembali() {
        window.location.href='data/index/riwayat_pendidikan'
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
        // console.log(val.id);
        return val.text;
    }

    $('#reqGolRuang').select2({
        placeholder: "Pilih Gol/Ruang"
    });

    $("#ktsatuankerja").select2({
        placeholder: "Pilih pejabat penetap",
        allowClear: true,
        ajax: {
            url: "json-admin/combo_json/autocompletepejabatpenetap",
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
    $('#reqTglSK,#reqTMTSK').datepicker({
        todayHighlight: true
        , autoclose: true
        , orientation: "bottom left"
        , clearBtn: true
        , format: 'dd-mm-yyyy'
        , templates: arrows
    }).on("changeDate", function (e) {
        var date = $(this).datepicker('getDate'),
        day  = date.getDate(),  
        month = date.getMonth() + 1,              
        year =  date.getFullYear();
        setTahun(year);
    });

    function setTahun(val) {
        $("#reqTahun").val(val);
    }

    var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
    jQuery(document).ready(function() {
        var form = KTUtil.getById('ktloginform');
        var formSubmitUrl = "json-admin/kenaikan_gaji_berkala_json/jsonkgbadd";
        var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
        if (!form) {
            return;
        }
        FormValidation
        .formValidation(
            form,
            {
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
                            location.reload();
                            btnCetak();
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


function btnCetak()
{
    opUrl= 'admin/loadUrl/admin/kenaikan_gaji_berkala_cetak_sk.php?reqId=<?=$reqPegawaiId?>';
    newWindow = window.open(opUrl, 'Cetak');
    newWindow.focus();
}
</script>

