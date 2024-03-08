<style type="text/css">
    .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice .select2-selection__choice__remove{
        font-size: 15px;
    }
</style>
<?php
include_once("functions/date.func.php");
$this->load->model("base-data/InfoData");
$this->load->model("base-data/FormulaPenilaian");
$this->load->library('globalmenu');

$reqId= $this->input->get('reqId');

$arrtabledata= array(
    array("label"=>"Nama", "field"=> "NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"NIP Baru", "field"=> "NIP_BARU", "display"=>"",  "width"=>"")
    , array("label"=>"Gol. Ruang", "field"=> "PANGKAT_INFO", "display"=>"",  "width"=>"")
    , array("label"=>"Eselon", "field"=> "ESELON_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Jabatan", "field"=> "LAST_JABATAN", "display"=>"",  "width"=>"")
    , array("label"=>"Unit Kerja", "field"=> "SATKER_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Rumpun", "field"=> "RUMPUN_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Sub Rumpun", "field"=> "RUMPUN_SUB_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Potensi", "field"=> "NILAI_X", "display"=>"",  "width"=>"")
    , array("label"=>"Kinerja", "field"=> "NILAI_Y", "display"=>"",  "width"=>"")
    , array("label"=>"Kuadran", "field"=> "ORDER_KUADRAN", "display"=>"",  "width"=>"")

    // untuk dua ini kunci, data akhir id, data sebelum akhir untuk order
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"statusberlaku", "field"=> "STATUS_BERLAKU", "display"=>"1", "width"=>"")
    , array("label"=>"satuankerjaid", "field"=> "SATKER_ID", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"")
);

$vgl= new globalmenu();
$arrdatajabatan= $vgl->getjabatantree([]);
// print_r($arrdatajabatan);exit;

$set= new InfoData();
$arrformulapenilaian= [];
$set->selectbyformulapenilaian();
// echo $set->query;exit;
while($set->nextRow())
{
    $arrdata= [];
    $arrdata["id"]= $set->getField("FORMULA_PENILAIAN_ID");
    $arrdata["text"]= $set->getField("NAMA");
    array_push($arrformulapenilaian, $arrdata);
}
unset($set);

$set= new InfoData();
$arrrumpun= [];
$set->selectbyparamsrumpunsimpegdata(array(), -1, -1, " AND A.RUMPUN_ID_PARENT IN ('0')");
// echo $set->query;exit;
while($set->nextRow())
{
    $arrdata= [];
    $arrdata["id"]= $set->getField("RUMPUN_ID");
    $arrdata["text"]= $set->getField("NAMA");
    array_push($arrrumpun, $arrdata);
}
// print_r($arrrumpun);exit;
unset($set);

$set= new InfoData();
$arrsatuankerja= [];
$arrdata= [];
$arrdata["id"]= "";
$arrdata["text"]= "Semua Data";
array_push($arrsatuankerja, $arrdata);

$set->selectbysatuankerja(array(), -1,-1, " AND A.SATKER_ID_PARENT = '0'");
// echo $set->query;exit;
while($set->nextRow())
{
    $arrdata= [];
    $arrdata["id"]= $set->getField("SATKER_ID");
    $arrdata["text"]= $set->getField("NAMA");
    array_push($arrsatuankerja, $arrdata);
}
unset($set);

$set= new InfoData();
$arrsatuankerjaEs2= [];
$set->selectbysatuankerja(array(), -1,-1, " AND A.SATKER_ID_PARENT != '0'");
// echo $set->query;exit;
while($set->nextRow())
{
    $arrdata= [];
    $arrdata["id"]= $set->getField("SATKER_ID");
    $arrdata["idparent"]= $set->getField("SATKER_ID_PARENT");
    $arrdata["text"]= $set->getField("NAMA");
    array_push($arrsatuankerjaEs2, $arrdata);
}
unset($set);

$set= new InfoData();
$arrtipepegawai= [];
$arrdata= [];
$arrdata["id"]= "0";
$arrdata["text"]= "Semua Jenis Jabatan";
array_push($arrtipepegawai, $arrdata);

$set->selectbytipepegawai(array(), -1,-1, " AND A.TIPE_PEGAWAI_ID NOT IN (3, 5)");
// echo $set->query;exit;
while($set->nextRow())
{
    $arrdata= [];
    $arrdata["id"]= $set->getField("TIPE_PEGAWAI_ID");
    $arrdata["text"]= $set->getField("NAMA");
    array_push($arrtipepegawai, $arrdata);
}
unset($set);

$set= new InfoData();
$arreselon= [];
$arrdata= [];
$arrdata["id"]= "0";
$arrdata["text"]= "Semua Eselon";
array_push($arreselon, $arrdata);

$set->selectbyeselon(array(), -1, -1, " AND A.ESELON_ID != 99");
// echo $set->query;exit;
while($set->nextRow())
{
    $arrdata= [];
    $arrdata["id"]= $set->getField("ESELON_ID");
    $arrdata["group"]= "eselon";
    $arrdata["text"]= $set->getField("NAMA");
    array_push($arreselon, $arrdata);
}
unset($set);
// print_r($arreselon);exit;

$arrkuadran= array(
    array("id"=>"7", "text"=>"VII")
  , array("id"=>"8", "text"=>"VIII")
  , array("id"=>"9", "text"=>"IX")
);

$set= new InfoData();
$set->selectbyjenjang();
// echo $set->query;exit;
while($set->nextRow())
{
    $arrdata= [];
    $arrdata["id"]= $set->getField("JENJANG_ID");
    $arrdata["group"]= "jenjang";
    $arrdata["text"]= $set->getField("NAMA");
    array_push($arreselon, $arrdata);
}
unset($set);
// print_r($arreselon);exit;

$set= new InfoData();
$arrpangkat= [];
$arrdata= [];
$arrdata["id"]= "";
$arrdata["text"]= "Semua Pangkat";
array_push($arrpangkat, $arrdata);

$set->selectbypangkat();
// echo $set->query;exit;
while($set->nextRow())
{
    $arrdata= [];
    $arrdata["id"]= $set->getField("PANGKAT_ID");
    $arrdata["text"]= "(".$set->getField("KODE").") ".$set->getField("NAMA");
    array_push($arrpangkat, $arrdata);
}
unset($set);

$statement= " AND 1=2";
if(!empty($reqId))
    $statement= " AND A.RENCANA_SUKSESI_ID = ".$reqId;
$set= new InfoData();
$set->selectbyparamsrencanasuksesi(array(), -1,-1, $statement);
$set->firstRow();
$reqNama= $set->getField("NAMA");

$formulaid= $arrformulapenilaian[0]["id"];

$reqFormulaPenilaianId= $reqJabatanId= $reqSatuanKerja= $reqSatuanKerjaEs2= $reqPangkatId= $reqTipePegawaiId= $reqEselonId= $reqKuadranId= $reqRumpunId= "";
$statement= " AND 1=2";
if(!empty($reqId))
    $statement= " AND A.RENCANA_SUKSESI_ID = ".$reqId;
$set= new InfoData();
$set->selectbyparamsrencanasuksesidetil(array(), -1,-1, $statement);
while($set->nextRow())
{
    $infokey= $set->getField("INFOKEY");
    $infoval= $set->getField("INFOVAL");

    if($infokey == "formulaid")
    {
        $reqFormulaPenilaianId= getconcatseparator($reqFormulaPenilaianId, $infoval);
    }
    else if($infokey == "jabatan")
    {
        $reqJabatanId= getconcatseparator($reqJabatanId, $infoval);
    }
    else if($infokey == "satuankerjaeselon1")
    {
        $reqSatuanKerja= getconcatseparator($reqSatuanKerja, $infoval);
    }
    else if($infokey == "satuankerjaeselon2")
    {
        $reqSatuanKerjaEs2= getconcatseparator($reqSatuanKerjaEs2, $infoval);
    }
    else if($infokey == "pangkat")
    {
        $reqPangkatId= getconcatseparator($reqPangkatId, $infoval);
    }
    else if($infokey == "tipepegawai")
    {
        $reqTipePegawaiId= getconcatseparator($reqTipePegawaiId, $infoval);
    }
    else if($infokey == "eselonid")
    {
        $reqEselonId= getconcatseparator($reqEselonId, $infoval);
    }
    else if($infokey == "kuadran")
    {
        $reqKuadranId= getconcatseparator($reqKuadranId, $infoval);
    }
    else if($infokey == "rumpunid")
    {
        $reqRumpunId= getconcatseparator($reqRumpunId, $infoval);
    }
}

if(empty($reqFormulaPenilaianId))
{
    $reqFormulaPenilaianId= $formulaid;
}
?>
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Monitoring</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Rencana Suksesi</a>
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
                        <i class="flaticon-home text-primary"></i>
                    </span>
                    <h3 class="card-label">Rencana Suksesi</h3>
                </div>
                <div class="card-toolbar">

                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md"></span>Aksi
                        </button>

                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-item">
                                    <a id="btnUbahData" class="navi-link">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Lihat Data</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-2 col-sm-12">Nama Jabatan</label>
                        <div class="col-lg-10 col-sm-12">
                            <input type="text" class="form-control" <?=$disabled?> placeholder="Masukkan Nama Jabatan"name="reqNama" id="reqNama" value="<?=$reqNama?>" />
                        </div>
                    </div>

                    <div class="mb-15" style="margin-bottom: 0px !important;">
                    </div>

                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-md-12">
                            <button onclick="return false;" class="filter btn btn-default pull-right">Detil <i class="fa fa-caret-down" aria-hidden="true"></i></button>

                            <div class="area-filter">
                                <div class="row mb-8">
                                    <div class="col-md-12" style="margin-top: 10px">
                                        <label>Jabatan Tujuan:</label>
                                        <input type="hidden" name="reqData[jabatan]" id="reqJabatanDataId" value="<?=$reqJabatanId?>" />
                                        <select class="form-control" id="reqJabatanId">
                                            <option value=""></option>
                                        </select>
                                    </div>

                                    <div class="col-md-12" style="margin-top: 10px">
                                        <label>Formula:</label>
                                        <input type="hidden" name="reqData[formulaid]" id="reqFormulaPenilaianDataId" value="<?=$reqFormulaPenilaianId?>" />
                                        <select id="reqFormulaPenilaianId" class="form-control datatable-input">
                                            <?
                                            $arrselected= explode(",", $reqFormulaPenilaianId);
                                            foreach($arrformulapenilaian as $item) 
                                            {
                                                $selectvalid= $item["id"];
                                                $selectvaltext= $item["text"];
                                                $selected= "";
                                                if(in_array($selectvalid, $arrselected))
                                                {
                                                    $selected= "selected";
                                                }
                                            ?>
                                            <option value="<?=$selectvalid?>" <?=$selected?>><?=$selectvaltext?></option>
                                            <?
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4" style="margin-top: 10px">
                                        <label>Filter Komponen/Unit Eselon I:</label>
                                        <input type="hidden" name="reqData[satuankerjaeselon1]" id="reqSatuanKerjaDataId" value="<?=$reqSatuanKerja?>" />
                                        <select id="reqSatuanKerja" class="form-control datatable-input">
                                            <?
                                            $arrselected= explode(",", $reqSatuanKerja);
                                            foreach($arrsatuankerja as $item) 
                                            {
                                                $selectvalid= $item["id"];
                                                $selectvaltext= $item["text"];
                                                $selected= "";
                                                if(in_array($selectvalid, $arrselected))
                                                {
                                                    $selected= "selected";
                                                }
                                            ?>
                                            <option value="<?=$selectvalid?>" <?=$selected?>><?=$selectvaltext?></option>
                                            <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4" style="margin-top: 10px">
                                        <label>Filter Komponen/Unit Eselon II:</label>
                                        <input type="hidden" name="reqData[satuankerjaeselon2]" id="reqSatuanKerjaEs2DataId" value="<?=$reqSatuanKerjaEs2?>" />
                                        <select id="reqSatuanKerjaEs2" class="form-control datatable-input">
                                            <option value=''>Semua Data</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" style="margin-top: 10px">
                                        <label>Pangkat/Golongan:</label>
                                        <input type="hidden" name="reqData[pangkat]" id="reqPangkatDataId" value="<?=$reqPangkatId?>" />
                                        <select id="reqPangkatId" class="form-control" multiple>
                                            <?
                                            $arrselected= explode(",", $reqPangkatId);
                                            foreach($arrpangkat as $item) 
                                            {
                                                $selectvalid= $item["id"];
                                                $selectvaltext= $item["text"];
                                                $selected= "";
                                                if(in_array($selectvalid, $arrselected))
                                                {
                                                    $selected= "selected";
                                                }
                                            ?>
                                            <option value="<?=$selectvalid?>" <?=$selected?>><?=$selectvaltext?></option>
                                            <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4" style="margin-top: 10px">
                                        <label>Jenis Jabatan:</label>
                                        <input type="hidden" name="reqData[tipepegawai]" id="reqTipePegawaiDataId" value="<?=$reqTipePegawaiId?>" />
                                        <select id="reqTipePegawaiId" class="form-control" multiple>
                                            <?
                                            $arrselected= explode(",", $reqTipePegawaiId);
                                            foreach($arrtipepegawai as $item) 
                                            {
                                                $selectvalid= $item["id"];
                                                $selectvaltext= $item["text"];
                                                $selected= "";
                                                if(in_array($selectvalid, $arrselected))
                                                {
                                                    $selected= "selected";
                                                }
                                            ?>
                                            <option value="<?=$selectvalid?>" <?=$selected?>><?=$selectvaltext?></option>
                                            <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4" style="margin-top: 10px">
                                        <label>Eselon:</label>
                                        <input type="hidden" name="reqData[eselonid]" id="reqEselonDataId" value="<?=$reqEselonId?>" />
                                        <select id="reqEselonId" class="form-control" multiple>
                                            <?
                                            $arrselected= explode(",", $reqEselonId);
                                            foreach($arreselon as $item) 
                                            {
                                                $selectvalid= $item["id"]."-".$item["group"];
                                                $selectvaltext= $item["text"];
                                                $selected= "";
                                                if(in_array($selectvalid, $arrselected))
                                                {
                                                    $selected= "selected";
                                                }
                                            ?>
                                            <option value="<?=$selectvalid?>" <?=$selected?>><?=$selectvaltext?></option>
                                            <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4" style="margin-top: 10px">
                                        <label>Kuadran:</label>
                                        <input type="hidden" name="reqData[kuadran]" id="reqKuadranDataId" value="<?=$reqKuadranId?>" />
                                        <select id="reqKuadranId" class="form-control" multiple>
                                            <?
                                            $arrselected= explode(",", $reqKuadranId);
                                            foreach($arrkuadran as $item) 
                                            {
                                                $selectvalid= $item["id"];
                                                $selectvaltext= $item["text"];
                                                $selected= "";
                                                if(in_array($selectvalid, $arrselected))
                                                {
                                                    $selected= "selected";
                                                }
                                            ?>
                                            <option value="<?=$selectvalid?>" <?=$selected?>><?=$selectvaltext?></option>
                                            <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 10px">
                                        <label>Rumpun:</label>
                                        <input type="hidden" name="reqData[rumpunid]" id="reqRumpunDataId" value="<?=$reqRumpunId?>" />
                                        <select id="reqRumpunId" class="form-control" multiple>
                                            <?
                                            $arrselected= explode(",", $reqRumpunId);
                                            foreach($arrrumpun as $item) 
                                            {
                                                $selectvalid= $item["id"];
                                                $selectvaltext= $item["text"];
                                                $selected= "";
                                                if(in_array($selectvalid, $arrselected))
                                                {
                                                    $selected= "selected";
                                                }
                                            ?>
                                            <option value="<?=$selectvalid?>" <?=$selected?>><?=$selectvaltext?></option>
                                            <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-9">
                            <input type="hidden" name="reqMode" value="<?=$reqMode?>">
                            <input type="hidden" name="reqId" value="<?=$reqId?>">
                            <button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Proses</button>
                            <button onclick="kembali()" type="button" class="btn btn-warning font-weight-bold mr-2">Kembali</button>
                        </div>
                    </div>
                </div>

            </form>

            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon-home text-primary"></i>
                    </span>
                    <h3 class="card-label">Data Pegawai</h3>
                </div>
                <?
                if(!empty($reqId))
                {
                ?>
                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline mr-2">
                        <a id="btnCetak" class="btn btn-light-primary font-weight-bolder dropdown-toggle" >
                            <span class="navi-icon"><i class="la la-edit"></i></span>
                            <span class="navi-text">Cetak</span>
                        </a>
                    </div>
                </div>
                <?
                }
                ?>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                        <tr>
                            <?php
                            foreach($arrtabledata as $valkey => $valitem) 
                            {
                                echo "<th>".$valitem["label"]."</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>

    </div>
</div>

<a href="#" id="triggercari" style="display:none" title="triggercari">triggercari</a>
<script type="text/javascript">
$(function() {
    
    // reqEselonDataId= $("#reqEselonDataId").val().split(',');
    // // console.log(reqEselonDataId);
    // $("#reqEselonId").select2('val',reqEselonDataId);

    $('#reqPangkatId,#reqEselonId,#reqTipePegawaiId,#reqKuadranId,#reqRumpunId').select2();
});

function kembali() {
    window.location.href='admin/index/rencana_suksesi'
}

var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
jQuery(document).ready(function() {
    var form = KTUtil.getById('ktloginform');
    var formSubmitUrl = "json-data/info_admin_json/rencanasuksesiadd";
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
                    data = response.message.split("-");
                    rowid= data[0];
                    infodata= data[1];

                    Swal.fire({
                        text: infodata,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        <?
                        if(empty($reqId))
                        {
                        ?>
                        document.location.href = "admin/index/rencana_suksesi_data?reqId="+rowid;
                        <?
                        }
                        else
                        {
                        ?>
                        jsonurl= "json-data/info_admin_json/jsonrencanasuksesi?reqId="+rowid;
                        datanewtable.DataTable().ajax.url(jsonurl).load();
                        <?
                        }
                        ?>
                        // document.location.href = "admin/index/rencana_suksesi_data?reqId=<?=$reqId?>";
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

var datanewtable;
var infotableid= "kt_datatable";
var carijenis= "";
var arrdata= <?php echo json_encode($arrtabledata); ?>;
var indexfieldid= arrdata.length - 1;
var valinfoid = '';
var datainforesponsive= datainfofilter= datainfolengthchange=  "1";

getarrsatuankerjaEs2= JSON.parse('<?=JSON_encode($arrsatuankerjaEs2)?>');

jQuery(document).ready(function() {
    arrdatajabatan= JSON.parse('<?=JSON_encode($arrdatajabatan)?>');
    // console.log(arrdatajabatan);
    $("#reqJabatanId").select2ToTree({treeData: {dataArr: arrdatajabatan, dftVal:"<?=$reqJabatanId?>"}, maximumSelectionLength: 3, placeholder: 'Pilih salah satu data'});

    infosatkerid= '<?=$reqSatuanKerja?>';
    infosatkerides2= '<?=$reqSatuanKerjaEs2?>';
    if(infosatkerid !== "")
    {
        vlabelid= "reqSatuanKerjaEs2";
        $("#"+vlabelid+" option").remove();
        var voption= "<option value=''>Semua Data</option>";
        if(Array.isArray(getarrsatuankerjaEs2) && getarrsatuankerjaEs2.length)
        {
            varrsatuankerjaEs2= getarrsatuankerjaEs2.filter(item => item.idparent === infosatkerid);
            // console.log(varrsatuankerjaEs2);
            $.each(varrsatuankerjaEs2, function( index, value ) {
                infoid= value["id"];
                infotext= value["text"];
                vselected= "";
                if(infosatkerides2 == infoid)
                    vselected= "selected";

                voption+= "<option value='"+infoid+"' "+vselected+" >"+infotext+"</option>";
            });
        }
        $("#"+vlabelid).html(voption);
    }

    $("#reqJabatanId,#reqFormulaPenilaianId,#reqSatuanKerja,#reqSatuanKerjaEs2,#reqTipePegawaiId,#reqPangkatId,#reqEselonId,#reqKuadranId,#reqRumpunId").change(function() {
        var cari = ''; //$('div.dataTables_filter input').val();
        // console.log("xxx");

        btnid= $(this).attr('id');
        reqSatuanKerja= $("#reqSatuanKerja").val();
        if(btnid == "reqSatuanKerja")
        {
            vlabelid= "reqSatuanKerjaEs2";
            $("#"+vlabelid+" option").remove();
            var voption= "<option value=''>Semua Data</option>";
            if(Array.isArray(getarrsatuankerjaEs2) && getarrsatuankerjaEs2.length)
            {
                varrsatuankerjaEs2= getarrsatuankerjaEs2.filter(item => item.idparent === reqSatuanKerja);
                // console.log(varrsatuankerjaEs2);
                $.each(varrsatuankerjaEs2, function( index, value ) {
                    infoid= value["id"];
                    infotext= value["text"];
                    vselected= "";
                    voption+= "<option value='"+infoid+"' "+vselected+" >"+infotext+"</option>";
                });
            }
            $("#"+vlabelid).html(voption);
        }
        setparamvalue();
    });

    
    var jsonurl= "json-data/info_admin_json/jsonrencanasuksesi?reqId=<?=$reqId?>";
    ajaxserverselectsingle.init(infotableid, jsonurl, arrdata);

    var infoid= [];
    $('#'+infotableid+' tbody').on( 'click', 'tr', function () {
        // untuk pilih satu data, kalau untuk multi comman saja
        $('#'+infotableid+' tbody tr').removeClass('selected');

        var el= $(this);
        el.addClass('selected');

        var dataselected= datanewtable.DataTable().row(this).data();
        // console.log(dataselected);
        // console.log(Object.keys(dataselected).length);

        fieldinfoid= arrdata[indexfieldid]["field"]
        valinfoid= dataselected[fieldinfoid];
        if (valinfoid == null)
        {
            valinfoid = '';
        }
    });

    $("#btnAdd,#btnUbahData").on("click", function () {
        btnid= $(this).attr('id');

        // var infourl= "admin/index/master_user_group_add";
        if(btnid == "btnAdd"){}
        else
        {
            if(valinfoid == "")
            {
                Swal.fire({
                    text: "Pilih salah satu data terlebih dahulu.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                });
                return false;
            }

            // infourl= infourl+"?reqId="+valinfoid;
        }
        // console.log(valinfoid);

        $.ajax({
            url: "admin/setpegawai?reqId="+valinfoid,
            processData: false,
            contentType: false,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                // console.log(response); return false;
                // document.location.href = "data/index";
                // popupnew('data/index', 1000, 700);

                pageUrl= "app/index/pegawai_suksesi_data?rencanasuksesiid=<?=$reqId?>";
                openAdd(pageUrl);
                
                // pageUrl= "app/loadUrl/main/pegawai_data";
            },
            error: function(xhr, status, error) {
                // var err = JSON.parse(xhr.responseText);
                // Swal.fire("Error", err.message, "error");
            },
            complete: function () {
                // KTUtil.btnRelease(formSubmitButton);
            }
        });

        // window.location.href = infourl;
    }); 

    $("#btnCetak").on("click", function () {
        urlExcel= "admin/loadUrl/admin/rencana_suksesi_data_export?reqId=<?=$reqId?>";
        newWindow = window.open(urlExcel, 'Cetak');
        newWindow.focus();
    });
    
    $('#'+infotableid+' tbody').on( 'dblclick', 'tr', function () {
      $("#btnUbahData").click();    
    });

    $("#buttoncaridetil").on("click", function () {
        carijenis= "2";
        calltriggercari();
    });

    $("#triggercari").on("click", function () {
        // kt_tree_6= $("#kt_tree_6").jstree().get_selected("id")[0];
        // console.log(kt_tree_6);return false;

        if(carijenis == "1")
        {
            pencarian= $('#'+infotableid+'_filter input').val();
            datanewtable.DataTable().search( pencarian ).draw();
        }
        else
        {
            
        }
    });
});


function setparamvalue()
{
    reqJabatanId= $("#reqJabatanId").val();
    reqFormulaPenilaianId= $("#reqFormulaPenilaianId").val();
    reqTipePegawaiId= $("#reqTipePegawaiId").val();
    reqPangkatId= $("#reqPangkatId").val();
    reqEselonId= $("#reqEselonId").val();
    reqKuadranId= $("#reqKuadranId").val();
    reqRumpunId= $("#reqRumpunId").val();
    reqSatuanKerja= $("#reqSatuanKerja").val();
    reqSatuanKerjaEs2= $("#reqSatuanKerjaEs2").val();

    $("#reqJabatanDataId").val(reqJabatanId);
    $("#reqFormulaPenilaianDataId").val(reqFormulaPenilaianId);
    $("#reqTipePegawaiDataId").val(reqTipePegawaiId);
    $("#reqPangkatDataId").val(reqPangkatId);
    $("#reqEselonDataId").val(reqEselonId);
    $("#reqKuadranDataId").val(reqKuadranId);
    $("#reqRumpunDataId").val(reqRumpunId);
    $("#reqSatuanKerjaDataId").val(reqSatuanKerja);
    $("#reqSatuanKerjaEs2DataId").val(reqSatuanKerjaEs2);
}

function calltriggercari()
{
    $(document).ready( function () {
      $("#triggercari").click();      
    });
}
</script>

<script>
$(document).ready(function(){
    $(".area-filter").hide();
        $("button.filter").click(function(){
            $(".area-filter").toggle();
        });
    });
</script>