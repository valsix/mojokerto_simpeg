<?php
include_once("functions/date.func.php");
$this->load->model("base-data/InfoData");
$this->load->model("base-data/FormulaPenilaian");

$set= new FormulaPenilaian();
$set->selectbyparamsformulapenilaiannineboxstandart();
$set->firstRow();
// echo $set->query;exit;
$reqSkpX0= $set->getField("SKP_X0");
$reqSkpY0= $set->getField("SKP_Y0");
$reqGmX0= $set->getField("GM_X0");
$reqGmY0= $set->getField("GM_Y0");
$reqSkpX1= $set->getField("SKP_X1");
$reqSkpY1= $reqSkpX0+1;
$reqGmX1= $set->getField("GM_X1");
$reqGmY1= $set->getField("GM_Y1");
$reqSkpX2= $set->getField("SKP_X2");
$reqSkpY2= $reqSkpX1+1;
$reqGmX2= $set->getField("GM_X2");
$reqGmY2= $set->getField("GM_Y2");

if($reqSkpY0 == "") $reqSkpY0= 0;
if($reqGmX0 == "") $reqGmX0= 0;
if($reqSkpY1 == "") $reqSkpY1= 0;
if($reqGmX1 == "") $reqGmX1= 0;
if($reqSkpY2 == "") $reqSkpY2= 0;
if($reqGmX2 == "") $reqGmX2= 0;


$reqId= $this->input->get('reqId');
$reqSatuanKerja=$this->userSatkerId;

$arrtabledata= array(
    array("label"=>"Nama", "field"=> "NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"NIP Baru", "field"=> "NIP_BARU", "display"=>"",  "width"=>"")
    , array("label"=>"Gol. Ruang", "field"=> "PANGKAT_INFO", "display"=>"",  "width"=>"")
    , array("label"=>"Eselon", "field"=> "ESELON_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Jabatan", "field"=> "LAST_JABATAN", "display"=>"",  "width"=>"")
    , array("label"=>"Unit Kerja", "field"=> "SATKER_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Potensi", "field"=> "NILAI_X", "display"=>"",  "width"=>"")
    , array("label"=>"Kinerja", "field"=> "NILAI_Y", "display"=>"",  "width"=>"")
    , array("label"=>"Kuadran", "field"=> "KODE_KUADRAN", "display"=>"",  "width"=>"")

    // untuk dua ini kunci, data akhir id, data sebelum akhir untuk order
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"statusberlaku", "field"=> "STATUS_BERLAKU", "display"=>"1", "width"=>"")
    , array("label"=>"satuankerjaid", "field"=> "SATKER_ID", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"")
);

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
$arrdata["id"]= "";
$arrdata["text"]= "Semua Jenis Jabatan";
array_push($arrtipepegawai, $arrdata);

$set->selectbytipepegawai();
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
$arrdata["id"]= "";
$arrdata["text"]= "Semua Eselon";
array_push($arreselon, $arrdata);

$set->selectbyeselon();
// echo $set->query;exit;
while($set->nextRow())
{
    $arrdata= [];
    $arrdata["id"]= $set->getField("ESELON_ID");
    $arrdata["text"]= $set->getField("NAMA");
    array_push($arreselon, $arrdata);
}
unset($set);

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
                        <a class="text-muted">Pegawai</a>
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
                    <h3 class="card-label">Home</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
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

            <div class="card-body">

                <div class="mb-15" style="margin-bottom: 0px !important;">
                </div>

                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <button class="filter btn btn-default pull-right">Filter <i class="fa fa-caret-down" aria-hidden="true"></i></button>

                        <div class="area-filter">
                            <div class="row mb-8">
                                <div class="col-md-12" style="margin-top: 10px">
                                    <label>Formula:</label>
                                    <select name="reqFormulaPenilaianId" id="reqFormulaPenilaianId" class="form-control datatable-input">
                                        <?
                                        foreach($arrformulapenilaian as $item) 
                                        {
                                            $selectvalid= $item["id"];
                                            $selectvaltext= $item["text"];
                                        ?>
                                        <option value="<?=$selectvalid?>"><?=$selectvaltext?></option>
                                        <?
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6" style="margin-top: 10px">
                                    <label>Filter Komponen/Unit Eselon I:</label>
                                    <select name="reqSatuanKerja" id="reqSatuanKerja" class="form-control datatable-input">
                                        <?
                                        foreach($arrsatuankerja as $item) 
                                        {
                                            $selectvalid= $item["id"];
                                            $selectvaltext= $item["text"];
                                        ?>
                                        <option value="<?=$selectvalid?>"><?=$selectvaltext?></option>
                                        <?
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6" style="margin-top: 10px">
                                    <label>Filter Komponen/Unit Eselon II:</label>
                                    <select name="reqSatuanKerjaEs2" id="reqSatuanKerjaEs2" class="form-control datatable-input">
                                        <option value=''>Semua Data</option>
                                    </select>
                                </div>
                                <div class="col-md-6" style="margin-top: 10px">
                                    <label>Jenis Jabatan:</label>
                                    <select name="reqTipePegawaiId" id="reqTipePegawaiId" class="form-control datatable-input">
                                        <?
                                        foreach($arrtipepegawai as $item) 
                                        {
                                            $selectvalid= $item["id"];
                                            $selectvaltext= $item["text"];
                                        ?>
                                        <option value="<?=$selectvalid?>"><?=$selectvaltext?></option>
                                        <?
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6" style="margin-top: 10px">
                                    <label>Pangkat/Golongan:</label>
                                    <select name="reqPangkatId" id="reqPangkatId" class="form-control datatable-input">
                                        <?
                                        foreach($arrpangkat as $item) 
                                        {
                                            $selectvalid= $item["id"];
                                            $selectvaltext= $item["text"];
                                        ?>
                                        <option value="<?=$selectvalid?>"><?=$selectvaltext?></option>
                                        <?
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6" style="margin-top: 10px">
                                    <label>Eselon:</label>
                                    <select name="reqEselonId" id="reqEselonId" class="form-control datatable-input">
                                        <?
                                        foreach($arreselon as $item) 
                                        {
                                            $selectvalid= $item["id"];
                                            $selectvaltext= $item["text"];
                                        ?>
                                        <option value="<?=$selectvalid?>"><?=$selectvaltext?></option>
                                        <?
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- <div class="col-md-6">
                                    <a class="btn btn-light-primary" href="javascript:void(0)">Jenis Jabatan</a>
                                    <a class="btn btn-light-primary" href="javascript:void(0)">Rumpun Jabatan</a>
                                    <a class="btn btn-light-primary" href="javascript:void(0)">Pangkat/Golongan</a>
                                    <a class="btn btn-light-primary" href="javascript:void(0)">Filter Komponen/Unit Eselon I</a>
                                    <a class="btn btn-light-primary" href="javascript:void(0)">Usia</a>
                                    <a class="btn btn-light-primary" href="javascript:void(0)">Filter Komponen/Unit Eselon II</a>
                                </div> -->
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="area-nine-box">
                            <div id="kontenidgrafik" style="width:100%; height: calc(60vh - 10px)"> </div>

                            <input type="hidden" id="reqInfoSkpY0" value="<?=$reqSkpY0?>" />
                            <input type="hidden" id="reqInfoSkpX0" value="<?=$reqSkpX0?>" />
                            <input type="hidden" id="reqInfoGmX0" value="<?=$reqGmX0?>" />
                            <input type="hidden" id="reqInfoGmY0" value="<?=$reqGmY0?>" />
                            <input type="hidden" id="reqInfoSkpY1" value="<?=$reqSkpY1?>" />
                            <input type="hidden" id="reqInfoSkpX1" value="<?=$reqSkpX1?>" />
                            <input type="hidden" id="reqInfoGmX1" value="<?=$reqGmX1?>" />
                            <input type="hidden" id="reqInfoGmY1" value="<?=$reqGmY1?>" />
                            <input type="hidden" id="reqInfoSkpY2" value="<?=$reqSkpY2?>" />
                            <input type="hidden" id="reqInfoSkpX2" value="<?=$reqSkpX2?>" />
                            <input type="hidden" id="reqInfoGmX2" value="<?=$reqGmX2?>" />
                            <input type="hidden" id="reqInfoGmY2" value="<?=$reqGmY2?>" />

                        </div>
                    </div>
                    <div class="col-md-6" id="kontenidtable"></div>
                </div>

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
var datanewtable;
var infotableid= "kt_datatable";
var carijenis= "";
var arrdata= <?php echo json_encode($arrtabledata); ?>;
var indexfieldid= arrdata.length - 1;
var valinfoid = '';
var datainforesponsive= datainfofilter= datainfolengthchange=  "1";

getarrsatuankerjaEs2= JSON.parse('<?=JSON_encode($arrsatuankerjaEs2)?>');

jQuery(document).ready(function() {
    $("#reqSatuanKerja,#reqSatuanKerjaEs2,#reqFormulaPenilaianId,#reqTipePegawaiId,#reqPangkatId,#reqEselonId").change(function() {
        reqFormulaPenilaianId= $("#reqFormulaPenilaianId").val();
        reqTipePegawaiId= $("#reqTipePegawaiId").val();
        reqPangkatId= $("#reqPangkatId").val();
        reqEselonId= $("#reqEselonId").val();
        var cari = ''; //$('div.dataTables_filter input').val();

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

        reqSatuanKerjaEs2= $("#reqSatuanKerjaEs2").val();
        
        jsonurl= "json-data/info_admin_json/jsonformulapenilaiankuadranpegawai?reqFormulaPenilaianId="+reqFormulaPenilaianId+"&reqTipePegawaiId="+reqTipePegawaiId+"&reqPangkatId="+reqPangkatId+"&reqEselonId="+reqEselonId+"&reqSatuanKerja="+reqSatuanKerja+"&reqSatuanKerjaEs2="+reqSatuanKerjaEs2;
        datanewtable.DataTable().ajax.url(jsonurl).load();

        var vgrafik= "potensikompetensi";
        setGrafik("json-data/info_admin_json/formulapenilaiangrafik?reqFormulaPenilaianId="+reqFormulaPenilaianId+"&reqTipePegawaiId="+reqTipePegawaiId+"&reqPangkatId="+reqPangkatId+"&reqEselonId="+reqEselonId+"&reqSatuanKerja="+reqSatuanKerja+"&reqSatuanKerjaEs2="+reqSatuanKerjaEs2+"&m="+vgrafik);
        setModal("kontenidtable", "json-data/info_admin_json/formulapenilaiantable?reqFormulaPenilaianId="+reqFormulaPenilaianId+"&reqTipePegawaiId="+reqTipePegawaiId+"&reqPangkatId="+reqPangkatId+"&reqEselonId="+reqEselonId+"&reqSatuanKerja="+reqSatuanKerja+"&reqSatuanKerjaEs2="+reqSatuanKerjaEs2+"&m="+vgrafik);
    });

    reqFormulaPenilaianId= $("#reqFormulaPenilaianId").val();
    var jsonurl= "json-data/info_admin_json/jsonformulapenilaiankuadranpegawai?reqFormulaPenilaianId="+reqFormulaPenilaianId;
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

                pageUrl= "app/index/pegawai_formula_data?formulaid=1";
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

function calltriggercari()
{
    $(document).ready( function () {
      $("#triggercari").click();      
    });
}

reqFormulaPenilaianId= $("#reqFormulaPenilaianId").val();
var vgrafik= "potensikompetensi";
setGrafik("json-data/info_admin_json/formulapenilaiangrafik?reqFormulaPenilaianId="+reqFormulaPenilaianId+"&m="+vgrafik);
setModal("kontenidtable", "json-data/info_admin_json/formulapenilaiantable?reqFormulaPenilaianId="+reqFormulaPenilaianId+"&m="+vgrafik);

function setModal(target, link_url)
{
    var s_url= link_url;
    var request = $.get(s_url);
    
    request.done(function(msg)
    {
        if(msg == ''){}
        else
        {
            $('#'+target).html(msg);
            // $.messager.progress('close');
        }
    });
}

function setGrafik(link_url)
{
    var s_url= link_url;

    //alert(s_url);return false;
    var request = $.get(s_url);
    request.done(function(dataJson)
    {
        if(dataJson == ''){}
        else
        {
            dataValue= JSON.parse(dataJson);
            // console.log(dataValue);

            if(Array.isArray(dataValue) && dataValue.length)
            {
                nilaix= dataValue[0].x.toFixed(2);
                nilaix= nilaix.replace(".00", "");
                nilaiy= parseFloat(dataValue[0].y);
                // nilaiy= parseFloat(nilaiy) - 7;
                nilaiy= nilaiy.toFixed(2);
                nilaiy= nilaiy.replace(".00", "");
            }

            if(dataValue == null){}
            else
            {
                // console.log("xxx");
                // nilaix= dataValue[0].x.toFixed(2);
                // nilaix= nilaix.replace(".00", "");
                // nilaiy= parseFloat(dataValue[0].y);
                // // nilaiy= parseFloat(nilaiy) - 7;
                // nilaiy= nilaiy.toFixed(2);
                // nilaiy= nilaiy.replace(".00", "");
            }

            var reqSkpY0= reqSkpX0= reqGmY0= reqGmX0=
            reqSkpY1= reqSkpX1= reqGmY1= reqGmX1=
            reqSkpY2= reqSkpX2= reqGmY2= reqGmX2= 0;

            reqSkpY0= parseFloat($("#reqInfoSkpY0").val());
            reqSkpX0= parseFloat($("#reqInfoSkpX0").val());
            reqGmY0= parseFloat($("#reqInfoGmY0").val());
            reqGmX0= parseFloat($("#reqInfoGmX0").val());
            reqSkpY1= parseFloat($("#reqInfoSkpY1").val());
            reqSkpX1= parseFloat($("#reqInfoSkpX1").val());
            reqGmY1= parseFloat($("#reqInfoGmY1").val());
            reqGmX1= parseFloat($("#reqInfoGmX1").val());
            reqSkpY2= parseFloat($("#reqInfoSkpY2").val());
            reqSkpX2= parseFloat($("#reqInfoSkpX2").val());
            reqGmY2= parseFloat($("#reqInfoGmY2").val());
            reqGmX2= parseFloat($("#reqInfoGmX2").val());

            chartkuadran = new Highcharts.Chart({
            chart: {
                    renderTo: 'kontenidgrafik',
                },
                exporting: {
                    enabled: false
                },
                credits: {
                    enabled: false
                },
                legend:{
                    enabled:false
                },
                xAxis: {
                    title:{
                         text:'Potensi'
                         , style: {
                            // color: 'white',
                            // fontSize: '15px'
                         }
                    },
                    min: 0,
                    max: reqSkpX2,
                    tickLength:0,
                    minorTickLength:0,
                    gridLineWidth:0,
                    showLastLabel:true,
                    showFirstLabel:false,
                    // lineColor:'#ccc',
                    // lineWidth:1,
                    lineColor:'white',
                    lineWidth:0,
                    bgColor: "#ff0",
                    labels: {
                        style: {
                            // color: 'white',
                            // fontSize: '15px'
                        }
                    },
                },
                yAxis: {
                    title:{
                        text:'Kinerja'
                        , rotation:270
                        , style: {
                            // color: 'white',
                            // fontSize: '15px'
                        }
                    },
                    min: 0,
                    max: reqGmY2,
                    tickLength:3,
                    minorTickLength:0,
                    gridLineWidth:0,
                    // lineColor:'#ccc',
                    // lineWidth:1
                    lineColor:'white',
                    lineWidth:0,
                    labels: {
                        style: {
                            // color: 'white',
                            // fontSize: '15px'
                        }
                    },
                },
                tooltip: {
                    formatter: function() {
                        var s = this.point.myData;
                        return s;
                    }
                },
                title: {
                    text:''
                },
                series: [
                {
                    type: 'line',
                    name: 'SKP Kurang',
                    lineWidth: 0,
                    // borderWidth: 0,
                    data: [[reqSkpX0, reqSkpY0], [reqSkpX0, reqSkpX2]],
                    marker: {
                        enabled: false
                    },
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    enableMouseTracking: false
                },
                {
                    type: 'line',
                    name: 'GM Kurang',
                    lineWidth: 0,
                    // borderWidth: 0,
                    data: [[reqGmX0, reqGmY0], [reqGmY2, reqGmY0]],
                    marker: {
                        enabled: false
                    },
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    enableMouseTracking: false
                },
                {
                    type: 'line',
                    name: 'SKP Sedang',
                    lineWidth: 0,
                    // borderWidth: 0,
                    data: [[reqSkpX1, reqSkpY1], [reqSkpX1, reqSkpX2]],
                    marker: {
                        enabled: false
                    },
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    enableMouseTracking: false
                },
                {
                    type: 'line',
                    name: 'GM Sedang',
                    lineWidth: 0,
                    // borderWidth: 0,
                    data: [[reqGmX1, reqGmY1], [reqGmY2, reqGmY1]],
                    marker: {
                        enabled: false
                    },
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    enableMouseTracking: false
                },
                {
                    type: 'line',
                    name: 'SKP Baik',
                    lineWidth: 0,
                    // borderWidth: 0,
                    data: [[reqSkpX2, reqSkpY2], [reqSkpX2, reqSkpX2]],
                    marker: {
                        enabled: false
                    },
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    enableMouseTracking: false
                },
                {
                    type: 'line',
                    name: 'GM Baik',
                    lineWidth: 0,
                    // borderWidth: 0,
                    data: [[reqGmX2, reqGmY2], [reqGmY2, reqGmY2]],
                    marker: {
                        enabled: false
                    },
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    enableMouseTracking: false
                },
                {
                    type: 'scatter',
                    name: 'Observations',
                    color: 'blue',
                    //data: [[80,80], [40.5,40.5], [60.8,60.8], [53.5,53.5], [63.9,63.9], [90.2,90.2], [95,95]],
                    data: dataValue,
                    marker: {
                        radius: 8
                    }
                }
                ]

                }
                ,
                function(chart) { // on complete
                    var width= chart.plotBox.width;
                    var height= chart.plotBox.height;
                    var tempplotbox= tempplotboy= tempwidth= tempxwidth= tempheight= 0;
                    var modif= 45;
                    var modif= 55;

                    //garis I
                    //=====================================================================================
                    tempwidth1= tempwidth= parseFloat(width) * (parseFloat(reqSkpX0) / reqSkpX2);
                    tempheight1= tempheight= parseFloat(height) * ((reqGmY2 - parseFloat(reqGmY1)) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) - modif;
                    tempplotbox= chart.plotBox.x;
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y;
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#00b050',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("IV", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================
                    tempwidth2= tempwidth= parseFloat(width) * ((parseFloat(reqSkpX1) - parseFloat(reqSkpX0)) / reqSkpX2);
                    tempheight= parseFloat(height) * ((reqGmY2 - parseFloat(reqGmY1)) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) - modif;
                    tempplotbox= parseFloat(chart.plotBox.x) + parseFloat(tempwidth1);
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y;
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#92d050',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("VII", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================
                    tempwidth= parseFloat(width) * ((reqSkpX2 - parseFloat(reqSkpX1)) / reqSkpX2);
                    tempheight= parseFloat(height) * ((reqGmY2 - parseFloat(reqGmY1)) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) - modif;
                    tempplotbox= chart.plotBox.x + parseFloat(tempwidth1) + parseFloat(tempwidth2);
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y;
                    //alert(tempwidth);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#006600',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("IX", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================

                    //garis II
                    //=====================================================================================
                    tempwidth1= tempwidth= parseFloat(width) * (parseFloat(reqSkpX0) / reqSkpX2);
                    tempheight2= tempheight= parseFloat(height) * ((parseFloat(reqGmY1) - parseFloat(reqGmY0)) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) + parseFloat(tempheight1) - modif;
                    tempplotbox= chart.plotBox.x;
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y + parseFloat(tempheight1);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#ffff00',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("II", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================
                    tempwidth2= tempwidth= parseFloat(width) * ((parseFloat(reqSkpX1) - parseFloat(reqSkpX0)) / reqSkpX2);
                    tempheight= parseFloat(height) * ((parseFloat(reqGmY1) - parseFloat(reqGmY0)) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) + parseFloat(tempheight1) - modif;
                    tempplotbox= parseFloat(chart.plotBox.x) + parseFloat(tempwidth1);
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y + parseFloat(tempheight1);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#c4d79b',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("V", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================
                    tempwidth= parseFloat(width) * ((reqSkpX2 - parseFloat(reqSkpX1)) / reqSkpX2);
                    tempheight= parseFloat(height) * ((parseFloat(reqGmY1) - parseFloat(reqGmY0)) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) + parseFloat(tempheight1) - modif;
                    tempplotbox= chart.plotBox.x + parseFloat(tempwidth1) + parseFloat(tempwidth2);
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y + parseFloat(tempheight1);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#92d050',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("VIII", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================

                    //garis III
                    //=====================================================================================
                    tempwidth1= tempwidth= parseFloat(width) * (parseFloat(reqSkpX0) / reqSkpX2);
                    tempheight3= tempheight= parseFloat(height) * (parseFloat(reqGmY0) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) + parseFloat(tempheight1) + parseFloat(tempheight2) - modif;
                    tempplotbox= chart.plotBox.x;
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y + parseFloat(tempheight1) + parseFloat(tempheight2);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#ff0000',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("I", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================
                    tempwidth2= tempwidth= parseFloat(width) * ((parseFloat(reqSkpX1) - parseFloat(reqSkpX0)) / reqSkpX2);
                    tempheight= parseFloat(height) * (parseFloat(reqGmY0) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) + parseFloat(tempheight1) + parseFloat(tempheight2) - modif;
                    tempplotbox= parseFloat(chart.plotBox.x) + parseFloat(tempwidth1);
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y + parseFloat(tempheight1) + parseFloat(tempheight2);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#ffff00',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("III", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================
                    tempwidth= parseFloat(width) * ((reqSkpX2 - parseFloat(reqSkpX1)) / reqSkpX2);
                    tempheight= parseFloat(height) * (parseFloat(reqGmY0) / reqGmY2);
                    tempyheight= chart.plotBox.x + (parseFloat(tempheight) / 3) + parseFloat(tempheight1) + parseFloat(tempheight2) - modif;
                    tempplotbox= chart.plotBox.x + parseFloat(tempwidth1) + parseFloat(tempwidth2);
                    tempxwidth= tempplotbox + parseFloat(parseFloat(tempwidth) / 2);
                    tempplotboy= chart.plotBox.y + parseFloat(tempheight1) + parseFloat(tempheight2);
                    chart.renderer.rect(tempplotbox,tempplotboy, tempwidth, tempheight, 1).attr({
                        fill: '#00b050',
                        zIndex: 0
                    }).add();

                    var text = chart.renderer.text("VI", tempwidth, tempheight).css({
                        fontSize: '14px'
                        // , color: '#666666'
                    }).add();
                    text.attr({
                        x: tempxwidth,
                        y: tempyheight,
                        zIndex:99
                    });
                    //=====================================================================================

                }

            );

        }

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