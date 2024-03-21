<?php
$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$arrsatkertree= $this->sesstree;
$arrsatkerdata= $this->sessdatatree;

$arrstatistik= array(
    array("c"=> "golongan_ruang", "h"=> "Golongan Ruang", "jg"=> "Grafik Pegawai Berdasarkan Golongan Ruang", "xg"=> "Jumlah Pegawai", "yg"=> "Jumlah Pegawai")
    , array("c"=> "eselon", "h"=> "Eselon", "jg"=> "Grafik Pegawai Berdasarkan Eselon", "xg"=> "Jumlah Pegawai", "yg"=> "Jumlah Pegawai")
    , array("c"=> "pendidikan", "h"=> "Pendidikan", "jg"=> "Grafik Pegawai Berdasarkan Pendidikan", "xg"=> "Jumlah Pegawai", "yg"=> "Jumlah Pegawai")
    , array("c"=> "jenis_kelamin", "h"=> "Jenis Kelamin", "jg"=> "Grafik Pegawai Berdasarkan Jenis Kelamin", "xg"=> "Jumlah Pegawai", "yg"=> "Jumlah Pegawai")
    , array("c"=> "agama", "h"=> "Agama", "jg"=> "Grafik Pegawai Berdasarkan Agama", "xg"=> "Jumlah Pegawai", "yg"=> "Jumlah Pegawai")
    , array("c"=> "umur", "h"=> "Golongan Umur", "jg"=> "Grafik Pegawai Berdasarkan Golongan Umur", "xg"=> "Jumlah Pegawai", "yg"=> "Jumlah Pegawai")
    , array("c"=> "tipe_pegawai", "h"=> "Tipe Pegawai", "jg"=> "Grafik Pegawai Berdasarkan Tipe Pegawai", "xg"=> "Jumlah Pegawai", "yg"=> "Jumlah Pegawai")
    /*, array("c"=> "struktural_eselon", "h"=> "Jabatan Struktural Eselon", "jg"=> "Grafik Pegawai Berdasarkan Jabatan Struktural Eselon", "xg"=> "Jumlah Pegawai", "yg"=> "Jumlah Pegawai")*/
);
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
                        <a class="text-muted">Statistik</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Monitoring Statistik</a>
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
                        Statistik<br/>
                        <label id="infodetilsatkernama">Pemerintah Kabupaten Mojokerto</label>
                    </h3>
                </div>

                <div class="card-toolbar">
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

            <div class="card-body">
                <div class="row">
                    <div class="area-biodata-pegawai col-md-12">
                        <ul class="nav nav-tabs">
                            <?
                            foreach ($arrstatistik as $k => $v) 
                            {
                                $class= "";
                                if($k == 0)
                                {
                                    $class= "active";
                                }

                                $vid= $v["c"];
                                $vnama= $v["h"];
                            ?>
                                <li><a class="<?=$class?>" data-toggle="tab" href="#<?=$vid?>"><?=$vnama?></a></li>
                            <?
                            }
                            ?>
                        </ul>

                        <div class="tab-content" style="background-color: inherit !important;">
                            <?
                            foreach ($arrstatistik as $k => $v) 
                            {
                                $class= "";
                                if($k == 0)
                                {
                                    $class= "in active show";
                                }

                                $vid= $v["c"];
                            ?>
                            <div id="<?=$vid?>" class="tab-pane fade <?=$class?>">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div id="tabel<?=$vid?>"></div>
                                    </div>
                                    <div class="col-md-8">
                                        <div id="grafik<?=$vid?>" style="min-width: 100%; height: 60vh; margin: 0 auto"></div>
                                        <!-- <div id="container-kepegawaian" style="min-width: 0; height: 300px; margin: 0 auto"></div> -->
                                    </div>
                                </div>
                            </div>
                            <?
                            }
                            ?>
                        </div>

                    </div>

                    
                </div>
            </div>
            
        </div>

    </div>
</div>

<a href="#" id="triggercari" style="display:none" title="triggercari">triggercari</a>

<script type="text/javascript">
jQuery(document).ready(function() {

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

    $("#reqSatkerId").change(function() { 
        btnid= $(this).attr('id');

        carijenis= "2";
        if(btnid == "reqSatkerId")
        {
            setinfosatkerdetil();
        }
    });

    $("#reqSatkerId").select2ToTree({treeData: {dataArr: arrsatkertree, dftVal:"<?=$reqSatkerId?>"}, maximumSelectionLength: 3, placeholder: 'Pilih salah satu data'});

    // $(".area-filter").hide();
    $("button.filter").click(function(){
        $(".area-filter").toggle();
    });

    arrstatistik= JSON.parse('<?=JSON_encode($arrstatistik)?>');
    setCariInfo();
    $("#triggercari").on("click", function () {
        // console.log(arrstatistik);
        reqSatkerId= $("#reqSatkerId").val();

        $.each(arrstatistik, function( index, value ) {
            // console.log(value);
            ctrl= value["c"];
            vjg= value["jg"];
            vxg= value["xg"];
            vyg= value["yg"];

            var s_url= "json-main/statistik_json/"+ctrl+"?reqSatkerId="+reqSatkerId;
            $.ajax({async: false, 'url': s_url,'success': function(data) {
                // console.log(data);
                var data= JSON.parse(data);
                // console.log(data);

                tabel= data["tabel"];
                // console.log(tabel);
                $("#tabel"+ctrl).html(tabel);

                // grafik
                jsonkategori= data["kategori"];
                jsonresult= data["result"];
                vgrafik= "grafik"+ctrl;
                setgrafik(vgrafik, vjg, vxg, vyg, jsonkategori, jsonresult);
            }});

        });
    });

});

function setCariInfo()
{
    $(document).ready( function () {
        $("#triggercari").click();          
    });
}

function setgrafik(target, judul, yaxisinfo, tooltipinfo, kategori, serialjson)
{
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: target,
            defaultSeriesType: 'column'
        },
        title:{
            text:judul
        },
        xAxis: {
            categories: kategori
        },
        yAxis: {
            title: {
                text: yaxisinfo
            }
        },
        credits: {
            enabled: false
        },
        legend: false,
        tooltip: {
            formatter: function() {
                return '<b>'+tooltipinfo+' '+ this.x +'</b>'+': '+ this.y +'<br/>';
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        if(this.y == null)
                            return '';
                        else
                            return this.y;
                    },
                    color: 'black'
                }
            }
        },
        series: serialjson
    });
    
}
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
    setCariInfo();
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

<script type="text/javascript">
    Highcharts.chart('container-kepegawaian', {
        chart: {
            type: 'column',
            backgroundColor: null
        },
        exporting: {
            enabled: false
        },
        title: {
            text: null,
            align: 'left'
        },
        subtitle: {
            text: null,
            align: 'left'
        },
        xAxis: {
            categories: ['Test 1', 'Test 2', 'Test 3', 'Test 4', 'Test 5', 'Test 6'],
            crosshair: true,
            accessibility: {
                description: 'Countries'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: null
            }
        },
        tooltip: {
            valueSuffix: ' (1000 MT)'
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
            {
                name: 'Struktural',
                data: [406292, 260000, 107000, 68300, 27500, 14500],
                color: '#1a1a1a'
            },
            {
                name: 'Fungsional',
                data: [51086, 136000, 5500, 141000, 107180, 77000],
                color: '#f4953f'
            }
        ]
    });

</script>
<!-- <div class="loading" id='vlsxloading'>Loading&#8230;</div> -->