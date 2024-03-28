<?php
$this->load->model('base/Pangkat');

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$arrtabledata= array(
    array("label"=>"NIP", "field"=> "NIP_LAMA", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"2")
    , array("label"=>"NIP Baru", "field"=> "NIP_BARU", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"2")
    , array("label"=>"Nama", "field"=> "NAMA", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"2")
    , array("label"=>"Gol/Ruang", "field"=> "GOL_RUANG", "display"=>"", "width"=>"", "colspan"=>"2", "rowspan"=>"")
    , array("label"=>"", "field"=> "GOL_RUANG_LAMA", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"")
    , array("label"=>"TMT", "field"=> "TMT_BARU", "display"=>"", "width"=>"", "colspan"=>"2", "rowspan"=>"")
    , array("label"=>"", "field"=> "TMT_LAMA", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"")
    , array("label"=>"Masa Kerja", "field"=> "MASA_KERJA", "display"=>"", "width"=>"", "colspan"=>"2", "rowspan"=>"")
    , array("label"=>"", "field"=> "MASA_KERJA_LAMA", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"")
    , array("label"=>"Gaji", "field"=> "GAJI_BARU", "display"=>"", "width"=>"", "colspan"=>"2", "rowspan"=>"")
    , array("label"=>"", "field"=> "GAJI_LAMA", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"")
    , array("label"=>"Pejabat Penetap", "field"=> "PEJABAT_PENETAP", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"2")
    , array("label"=>"No. SK", "field"=> "NO_SK", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"2")
    , array("label"=>"Tanggal SK", "field"=> "NO_SK", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"2")
    , array("label"=>"Pendidikan", "field"=> "PENDIDIKAN", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"2")
    , array("label"=>"STLUD", "field"=> "NO_SK", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"2")
    , array("label"=>"No. STLUD", "field"=> "NO_SK", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"2")
    , array("label"=>"Tanggal STLUD", "field"=> "NO_SK", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"2")
    , array("label"=>"No. Nota BKN", "field"=> "NO_SK", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"2")
    , array("label"=>"Tanggal Nota BKN", "field"=> "NO_SK", "display"=>"", "width"=>"", "colspan"=>"", "rowspan"=>"2")

    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"", "colspan"=>"", "rowspan"=>"2")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"", "colspan"=>"", "rowspan"=>"2")
);

$reqTahun= date("Y");
$reqBulan= date("m");
$reqBulan= setBulanKp($reqBulan);

$pangkat= new Pangkat();
$pangkat->selectByParams();

$arrsatkertree= $this->sesstree;
$arrsatkerdata= $this->sessdatatree;
?>

<style type="text/css">
/*untuk tambahan scroll*/
.dataTables_wrapper{
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
</style>

<!-- SELECT2 -->
<!-- <link href="lib/select2/select2.min.css" rel="stylesheet"> -->
<link href="lib/select2totreemaster/src/select2totree.css" rel="stylesheet">
<script src="lib/select2/select2.min.js"></script>
<script src="lib/select2totreemaster/src/select2totree.js"></script>

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">KP</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Monitoring KP</a>
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
                        KP<br/>
                        <label id="infodetilsatkernama">Pemerintah Kabupaten Mojokerto</label>
                    </h3>
                </div>

                <div class="card-toolbar">

                    <div class="dropdown dropdown-inline mr-2">
                        <button class="filter btn btn-light-primary pull-right">Filter <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                        <button type="button" id="btnProses" class="btn btn-light-primary font-weight-bolder">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            Proses
                        </button>
                    </div>

                    <button class="btn btn-light-primary" onclick="showhidesatker()"><i class="fa fa-sitemap" aria-hidden="true"></i> Satker</button>

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
                        <div class="col-md-4" style="margin-top: 10px">
                            <label>Jenis KP:</label>
                            <div class="row">
                                <select id='reqType' class="form-control datatable-input">
                                    <option value='REGULER'>Reguler</option>
                                    <option value='PILIHAN_STRUKTURAL'>Pilihan (Struktural)</option>
                                    <option value='PILIHAN_FUNGSIONAL'>Pilihan (Fungsional)</option>
                                    <!-- <option value='ANUMERTA'>Anumerta</option>
                                    <option value='PENGABDIAN'>Pengabdian</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-top: 10px">
                            <label>Periode:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select id='reqBulan' class="form-control datatable-input">
                                        <option value='04' <? if($reqBulan == "04") echo 'selected';?>>April</option>
                                        <option value='10' <? if($reqBulan == "10") echo 'selected';?>>Oktober</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select id='reqTahun' class="form-control datatable-input">
                                        <?
                                            for($i=date("Y"); $i<=date("Y")+10; $i++)
                                            {
                                        ?>
                                            <option value="<?=$i?>" <? if($reqTahun == $i) echo 'selected';?>><?=$i?></option>
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
                                $colspan= $valitem["colspan"];
                                $rowspan= $valitem["rowspan"];

                                if(empty($colspan) && empty($rowspan)){}
                                else
                                {
                                    $vcenter= "";
                                    if(!empty($colspan))
                                    {
                                        $vcenter= "center";
                                    }
                                    echo "<th style='text-align:".$vcenter."' colspan='".$colspan."' rowspan='".$rowspan."'>".$valitem["label"]."</th>";
                                }
                            }
                            ?>
                        </tr>
                        <tr>
                            <?php
                            foreach($arrtabledata as $valkey => $valitem) 
                            {
                                $colspan= $valitem["colspan"];
                                $rowspan= $valitem["rowspan"];
                                if(empty($colspan) && empty($rowspan))
                                {
                                    echo "<th style='text-align:center'>Baru</th>
                                    <th style='text-align:center'>Lama</th>";
                                }
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
var valinfovalidasiid = '';

var datainforesponsive= "1";
var formSubmitButton;
jQuery(document).ready(function() {
    var jsonurl= "json-main/pegawai_json/jsonkp?reqBulan=<?=$reqBulan?>&reqTahun=<?=$reqTahun?>";
    ajaxserverselectsingle.init(infotableid, jsonurl, arrdata);
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

        varurl= "app/index/pegawai_data_fip?reqId="+vpilihid;
        document.location.href = varurl;
    });

    $("#triggercari").on("click", function () {
        reqBulan= $("#reqBulan").val();
        reqTahun= $("#reqTahun").val();
        reqType= $("#reqType").val();
        reqSatkerId= $("#reqSatkerId").val();

        if(carijenis == "1")
        {
            pencarian= $('#'+infotableid+'_filter input').val();
            datanewtable.DataTable().search( pencarian ).draw();
        }
        else if(carijenis == "p")
        {
            jsonurl= "json-main/pegawai_json/jsonkp?reqMode=proses&reqId="+reqSatkerId+"&reqType="+reqType+"&reqBulan="+reqBulan+"&reqTahun="+reqTahun;
            datanewtable.DataTable().ajax.url(jsonurl).load();
        }
        else
        {
            jsonurl= "json-main/pegawai_json/jsonkp?reqId="+reqSatkerId+"&reqType="+reqType+"&reqBulan="+reqBulan+"&reqTahun="+reqTahun;
            datanewtable.DataTable().ajax.url(jsonurl).load();
        }
    });

    $("#reqType, #reqBulan, #reqTahun, #reqSatkerId").change(function() { 
        btnid= $(this).attr('id');

        carijenis= "2";
        if(btnid == "reqSatkerId")
        {
            setinfosatkerdetil();
        }

        calltriggercari();
    });

    $('#btnProses').on('click', function () {
        var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
        formSubmitButton = KTUtil.getById('btnProses');

        Swal.fire({
            title: 'Apakah anda yakin proses kp sesuai filter?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yakin',
            cancelButtonText: 'Tidak',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
                carijenis= "p";
                calltriggercari();
            }
        })
        
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

    // $(".area-filter").hide();
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

function afterreload()
{
    KTUtil.btnRelease(formSubmitButton);
}
</script>

<!-- <div class="loading" id='vlsxloading'>Loading&#8230;</div> -->