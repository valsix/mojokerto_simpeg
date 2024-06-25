<?php
$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$arrtabledata= array(
    array("label"=>"Group", "field"=> "INFO_GROUP", "display"=>"1", "width"=>"", "class"=>"dt-control", "orderable"=>"1")
    , array("label"=>"Satker", "field"=> "SATUAN_KERJA_DETIL", "display"=>"", "width"=>"")
    , array("label"=>"Perubahan", "field"=> "INFO_RIWAYAT", "display"=>"", "width"=>"")
    , array("label"=>"Status Proses", "field"=> "INFO_JENIS_UPDATE", "display"=>"", "width"=>"")
    , array("label"=>"Status Validasi", "field"=> "INFO_STATUS", "display"=>"", "width"=>"")
    , array("label"=>"Tanggal Proses", "field"=> "INFO_CREATE_DATE", "display"=>"", "width"=>"")
    , array("label"=>"Tanggal Validasi", "field"=> "INFO_CREATE_DATE", "display"=>"", "width"=>"")

    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"newlink", "field"=> "NEW_INFO_LINK", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"")
);

$arrBulan= setBulanLoop();
$arrTahun= setTahunLoop(1,1);

if($reqBulan == "") $reqBulan= date("m");
if($reqTahun == "") $reqTahun= date("Y");

$arrsatkertree= $this->sesstree;
$arrsatkerdata= $this->sessdatatree;
?>

<style type="text/css">
/*untuk tambahan scroll*/
/*.dataTables_wrapper{
    *background:black;
    *border:4px solid black;
    height:calc(100% - 80px);
    min-height:calc(100% - 80px);
}
.dataTables_scroll{
    *background:pink;
    *border:4px solid pink;
    height:calc(100% - 80px);
    min-height:calc(100% - 80px);
}
.dataTables_scrollBody{
    *border:1px solid #C6F;
    *height:400px !important;
    
    height:calc(100% - 40px);
    min-height:calc(100% - 40px);
    border:none !important;
}
.nowrap {
    white-space: nowrap;
}

table.dataTable td.dt-control {
  text-align: center;
  cursor: pointer;
}
table.dataTable td.dt-control:before {
  display: inline-block;
  box-sizing: border-box;
  content: "";
  border-top: 5px solid transparent;
  border-left: 10px solid rgba(0, 0, 0, 0.5);
  border-bottom: 5px solid transparent;
  border-right: 0px solid transparent;
}
table.dataTable tr.dt-hasChild td.dt-control:before {
  border-top: 10px solid rgba(0, 0, 0, 0.5);
  border-left: 5px solid transparent;
  border-bottom: 0px solid transparent;
  border-right: 5px solid transparent;
}

html.dark table.dataTable td.dt-control:before,
:root[data-bs-theme=dark] table.dataTable td.dt-control:before {
  border-left-color: rgba(255, 255, 255, 0.5);
}
html.dark table.dataTable tr.dt-hasChild td.dt-control:before,
:root[data-bs-theme=dark] table.dataTable tr.dt-hasChild td.dt-control:before {
  border-top-color: rgba(255, 255, 255, 0.5);
  border-left-color: transparent;
}*/
</style>

<!-- SELECT2 -->
<!-- <link href="lib/select2/select2.min.css" rel="stylesheet"> -->
<link href="lib/select2totreemaster/src/select2totree.css" rel="stylesheet">
<!-- <link href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css" rel="stylesheet"> -->
<script src="lib/select2/select2.min.js"></script>
<script src="lib/select2totreemaster/src/select2totree.js"></script>

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Validator</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Monitoring Validator</a>
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
                    <h3 class="card-label">
                        Pegawai<br/>
                        <label id="infodetilsatkernama">Pemerintah Kabupaten Mojokerto</label>
                    </h3>
                </div>

                <div class="card-toolbar">

                    <div class="dropdown dropdown-inline mr-2">
                        <button class="filter btn btn-light-primary pull-right">Filter <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                        <a class="filter btn btn-light-primary pull-right" id='btnUbahData' style="margin-right:5px">Lihat Perubahan</a>

                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right:5px">
                            <span class="svg-icon svg-icon-md"></span>Cetak
                        </button>

                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-item">
                                    <a id="btnLembarFIP01Row" class="navi-link">
                                        <span class="navi-text">FIP 01</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a id="btnLembarFIP02Row" class="navi-link">
                                        <!-- <span class="navi-icon"><i class="la la-edit"></i></span> -->
                                        <span class="navi-text">FIP 02</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  id="btnBiodataLengkap" class="navi-link">
                                        <span class="navi-text">Biodata Lengkap</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  id="btnBiodataSingkat" class="navi-link">
                                        <span class="navi-text">Biodata Singkat</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  id="btnModelC" class="navi-link">
                                        <span class="navi-text">Model C</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  id="btnSPMT" class="navi-link">
                                        <span class="navi-text">SPMT</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  id="btnCetak" class="navi-link">
                                        <span class="navi-text">Cetak</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  id="btnPegawaiExcel" class="navi-link">
                                        <span class="navi-text">CetakPegawai</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <button class="btn btn-light-primary" onclick="showhidesatker()" style="margin-right:5px" ><i class="fa fa-sitemap" aria-hidden="true"></i> Satker</button>

                    <div id="divcarisatuankerja" style="display: none; position: absolute; z-index: 1; top: 60px; right: 30px; background-color: #FFFFFF; border: 1px solid #ebedf3; padding: 15px; border-radius: 0.42rem; ">
                        <label><i>Ketikkan nama satker...</i> </label>
                        <div class="clearfix"></div>
                        <select class="form-control" id="reqSatkerId" style="width:56em">
                            <option value=""></option>
                        </select>
                    </div> 

                </div>
            </div>

            <div class="col-md-12">
                <div class="area-filter">
                    <div class="row mb-8">
                        <div class="col-md-6" style="margin-top: 10px">
                            <label>Status : </label>
                            <select name="reqValidasi" id="reqValidasi" class="form-control datatable-input">
                                <option value="" <? if($reqValidasi == "") echo "selected";?>>Belum divalidasi</option>
                                <option value="2" <? if($reqValidasi == "2") echo "selected";?>>Ditolak</option>
                                <option value="1" <? if($reqValidasi == "1") echo "selected";?>>Validasi</option>        
                            </select>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px">

                            <label>Bulan : </label>
                            <div class="row">
                                <div class="col-lg-3 col-sm-12">
                                    <select name="reqBulan" id="reqBulan" class="form-control datatable-input">
                                        <option value="-1">Semua</option>
                                        <?
                                        for($i=0;$i<count($arrBulan);$i++)
                                        {
                                        ?>
                                            <option value="<?=$arrBulan[$i]?>" <? if(generateZeroDate($reqBulan, 2) == $arrBulan[$i]) { ?> selected <? } ?>><?=getNameMonth($arrBulan[$i])?></option>
                                        <?    
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-sm-12">
                                    <select name="reqTahun" id="reqTahun" class="form-control datatable-input">
                                        <?
                                        for($tahun=0;$tahun < count($arrTahun);$tahun++)
                                        {
                                        ?>
                                            <option value="<?=$arrTahun[$tahun]?>" <? if($reqTahun == $arrTahun[$tahun]) echo "selected";?>><?=$arrTahun[$tahun]?></option>
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
var datanewtable;
var infotableid= "kt_datatable";
var carijenis= "";
var arrdata= <?php echo json_encode($arrtabledata); ?>;
// console.log(arrdata);
var indexfieldid= arrdata.length - 1;
var valinfoid = '';
var valinfolink = '';

var datainforesponsive= "1";
var valgroup= "1";

jQuery(document).ready(function() {
    var jsonurl= "json-validasi/verifikasi_validasi_json/json?reqBulan=<?=$reqBulan?>&reqTahun=<?=$reqTahun?>&reqValidasi=<?=$reqValidasi?>";
    ajaxserverselectsingle.init(infotableid, jsonurl, arrdata, valgroup);
        $('#vlsxloading').hide();

    var infoid= [];
    $('#'+infotableid+' tbody').on( 'click', 'tr', function () {
        // untuk pilih satu data, kalau untuk multi comman saja
        $('#'+infotableid+' tbody tr').removeClass('selected');

        var el= $(this);
        el.addClass('selected');

        var dataselected= datanewtable.DataTable().row(this).data();
        // console.log(dataselected);
        // console.log(Object.keys(dataselected).length);
        fieldinfoid= arrdata[indexfieldid]["field"];
        valinfoid= dataselected[fieldinfoid];
        valinfolink= dataselected[arrdata[indexfieldid-1]["field"]];
        // console.log(valinfolink);
    });

    $('#'+infotableid+' tbody').on( 'dblclick', 'tr', function () {
      $("#btnUbahData").click();    
    });

    $("#btnAdd, #btnUbahData").on("click", function () {
        btnid= $(this).attr('id');

        if(valinfoid == "" && btnid == "btnUbahData")
        {
            Swal.fire({
                text: "Pilih salah satu data Riwayat terlebih dahulu.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                }
            });
            return false;
        }

        if(btnid == "btnUbahData")
            vpilihid= valinfoid;
        else
            vpilihid= "";

        varurl= "personal/index/"+valinfolink+"&v=1";
        document.location.href = varurl;
    });

    $("#triggercari").on("click", function () {
        if(carijenis == "1")
        {
            pencarian= $('#'+infotableid+'_filter input').val();
            datanewtable.DataTable().search( pencarian ).draw();
        }
        else
        {
            reqId= $("#reqSatkerId").val();
            reqValidasi= $("#reqValidasi").val();
            reqBulan= $("#reqBulan").val();
            reqTahun= $("#reqTahun").val();

            jsonurl= "json-validasi/verifikasi_validasi_json/json?reqValidasi="+reqValidasi+"&reqBulan="+reqBulan+"&reqTahun="+reqTahun+"&reqId="+reqId;
            datanewtable.DataTable().ajax.url(jsonurl).load();
        }
    });

    $("#reqValidasi, #reqBulan, #reqTahun, #reqSatkerId").change(function() { 
        btnid= $(this).attr('id');

        carijenis= "2";
        if(btnid == "reqSatkerId")
        {
            setinfosatkerdetil();
        }

        calltriggercari();
    });

    <?
    if(empty($arrsatkertree))
    {
    ?>
    arrsatkertree= [];
    arrsatkerdata= [];
    <?
    }
    else
    {
    ?>
    arrsatkertree= JSON.parse('<?=JSON_encode($arrsatkertree)?>');
    arrsatkerdata= JSON.parse('<?=JSON_encode($arrsatkerdata)?>');
    <?
    }
    ?>

    $("#reqSatkerId").select2ToTree({treeData: {dataArr: arrsatkertree, dftVal:"<?=$reqSatkerId?>"}, maximumSelectionLength: 3, placeholder: 'Pilih salah satu data'});

    $(".area-filter").hide();
    $("button.filter").click(function(){
        $(".area-filter").toggle();
    });

});

// untuk otomatisasi jabatan
function setinfosatkerdetil()
{
    reqSatkerId= $("#reqSatkerId").val();

    if(Array.isArray(arrsatkerdata) && arrsatkerdata.length)
    {
        vsatkerdata= arrsatkerdata.filter(item => item.id === reqSatkerId);
        // console.log(reqSatkerId);
        // console.log(vsatkerdata);return false;
        // console.log(vsatkerdata[0]);
        // console.log(vsatkerdata);

        infodetilsatkernama= "";
        if(Array.isArray(vsatkerdata) && vsatkerdata.length)
        {
            infodetilsatkernama= vsatkerdata[0]["namadetil"];
        }
        $("#infodetilsatkernama").text(infodetilsatkernama);
    }
}

function calltriggercari()
{
    $(document).ready( function () {
      $("#triggercari").click();      
    });
}

function showhidesatker() 
{
    var x = document.getElementById("divcarisatuankerja");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>