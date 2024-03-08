<?
$this->load->model("base-data/Pegawai");

$reqPegawaiId= $this->pegawaiId;


$statementcpns = "AND STATUS_PEGAWAI_ID = 1 ";
$statementpns = "AND STATUS_PEGAWAI_ID = 2 ";
$statementpppk = "AND STATUS_PEGAWAI_ID = 5 ";
$statementasn = " AND (STATUS_PEGAWAI = 1 OR STATUS_PEGAWAI = 2 OR STATUS_PEGAWAI = 4 OR STATUS_PEGAWAI = 5) ";


$set   = new Pegawai();
$jumlahpns = $set->getCountByParamsAsn(array(),$statementpns);
$jumlahcpns = $set->getCountByParamsAsn(array(),$statementcpns);
$jumlahpppk = $set->getCountByParamsAsn(array(),$statementpppk);
$jumlahasn = $set->getCountByParamsAsn(array(),$statementasn);



unset($set);

$set= new Pegawai();
$arrjenis= array();
$set->selectByParamsJumlahPns();
// echo $set->query;exit;
while($set->nextRow())
{
  $arrdata= [];
  $arrdata["id"]= $set->getField("TIPE_PEGAWAI_NEW_ID_PARENT");
  $arrdata["text"]= $set->getField("NAMA");
  $arrdata["JUMLAH"]= $set->getField("JUMLAH");
  array_push($arrjenis, $arrdata);
}
unset($set);


$jumlahstruktural=$arrjenis[0]["JUMLAH"];
$jumlahfungsional=$arrjenis[1]["JUMLAH"];
$jumlahpelaksana=$arrjenis[2]["JUMLAH"];


// $jumlahasn= $jumlahpns + $jumlahpppk;

$i=0;
while($i < 5)
{
    if($i == 0)     
    {
        $tmp = ' AND Y.USIA_TAHUN < 30 '; 
        $tmpNama = '< 30';
    }
    elseif($i == 1) 
    {
        $tmp = ' AND Y.USIA_TAHUN >= 30 AND Y.USIA_TAHUN <= 39 '; 
        $tmpNama = '30 - 39';
    }
    elseif($i == 2) 
    {
        $tmp = ' AND Y.USIA_TAHUN >= 40 AND Y.USIA_TAHUN <= 49 '; 
        $tmpNama = '40 - 49';
    }
    elseif($i == 3) 
    {
        $tmp = ' AND Y.USIA_TAHUN >= 50 AND Y.USIA_TAHUN <= 55 '; 
        $tmpNama = '50 - 55';
    }
    elseif($i == 4) 
    {
        $tmp = ' AND Y.USIA_TAHUN > 55 '; 
        $tmpNama = '> 55';
    }
            
    $gol_ruang[$i] = $tmpNama;
    $getJumlah = new Pegawai();
    $allRecord = $getJumlah->getCountByUmur(array(), $statement.$tmp);              
    unset($getJumlah);
    $val_gol_ruang[$i] = $allRecord;
    $i++;
}

$x=$bts=0;
$state = '';
while($x < count($gol_ruang)){
        $sep = ''; $sep_akhir = ',';
        $bts = $x;
        if($state)  $sep = ',';
        if($bts == (count($gol_ruang)-1))   $sep_akhir = '';
        
        $i=0; 
        $state .= "{name:"."'".$gol_ruang[$x]."'".",data: [";
        $sep_data = $data='';
        while($i < count($gol_ruang)){
            
            if($data || ($i == 1 && $data == 0))            $sep_data = ',';
            
            if($i == $x)            $data = $val_gol_ruang[$i];
            else                    $data = 'null';         
            
            $state .= $sep_data.$data;
            
            $i++;
        }
        $state .= ']}'.$sep_akhir;
    $x++;
}


$statement=" AND STATUS_PEGAWAI IN (1,2)";
$set = new Pegawai();
$set->selectByStatistik(array(),-1,-1,$statement);
$i=0;
while($set->nextRow()){
    $pns[$i] = $set->getField('GOL_RUANG');
    if($set->getField('JML'))   $tmp = $set->getField('JML');
    else                        $tmp = 0;

    $val_pns[$i] = $tmp;
    $i++;
}

$x=$bts=0;
$statepns = '';
while($x < count($pns)){
        $sep = ''; $sep_akhir = ',';
        $bts = $x;
        if($statepns)  $sep = ',';
        if($bts == (count($pns)-1))   $sep_akhir = '';
        
        $i=0; 
        $statepns .= "{name:"."'".$pns[$x]."'".",data: [";
        $sep_data = $data='';
        while($i < count($pns)){
            
            if($data || ($i == 1 && $data == 0))            $sep_data = ',';
            
            if($i == $x)            $data = $val_pns[$i];
            else                    $data = 'null';         
            
            $statepns .= $sep_data.$data;
            
            $i++;
        }
        $statepns .= ']}'.$sep_akhir;
    $x++;
}


$statement=" AND STATUS_PEGAWAI IN (4,5)";
$set = new Pegawai();
$set->selectByStatistik(array(),-1,-1,$statement);
// echo $set->query;exit;
$i=0;
while($set->nextRow()){
    $pppk[$i] = $set->getField('GOL_RUANG');
    if($set->getField('JML'))   $tmp = $set->getField('JML');
    else                        $tmp = 0;

    $val_pppk[$i] = $tmp;
    $i++;
}


$x=$bts=0;
$statepppk = '';
while($x < count($pppk)){
        $sep = ''; $sep_akhir = ',';
        $bts = $x;
        if($statepppk)  $sep = ',';
        if($bts == (count($pppk)-1))   $sep_akhir = '';
        
        $i=0; 
        $statepppk .= "{name:"."'".$pppk[$x]."'".",data: [";

        $sep_data = $data='';
        while($i < count($pppk)){
            
            if($data || ($i == 1 && $data == 0))            $sep_data = ',';
            
            if($i == $x)            $data = $val_pppk[$i];
            else                    $data = 'null';         
            
            $statepppk .= $sep_data.$data;
            
            $i++;
        }

        $statepppk .= ']}'.$sep_akhir;
    $x++;
}



?>
<style type="text/css">
.bg-info, .bg-info > a {
    color: #fff !important;
}
.bg-info {
    /*background-color: #17a2b8 !important;*/
}
.small-box {
    border-radius: .25rem;
    box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
    display: block;
    margin-bottom: 20px;
    position: relative;
}
.small-box > .inner {
    padding: 10px;
}

*, ::after, ::before {
    box-sizing: border-box;
}

.small-box > .small-box-footer {
    background: rgba(0,0,0,.1);
    color: rgba(255,255,255,.8);
    display: block;
    padding: 3px 0;
    position: relative;
    text-align: center;
    text-decoration: none;
    z-index: 10;
    color: #fff !important;
}
</style>


<script src="lib/Highcharts-8.2.2/code/highcharts.js"></script>
<script src="lib/Highcharts-8.2.2/code/modules/data.js"></script>
<script src="lib/Highcharts-8.2.2/code/modules/drilldown.js"></script>
<script src="lib/Highcharts-8.2.2/code/modules/exporting.js"></script>
<script src="lib/Highcharts-8.2.2/code/modules/export-data.js"></script>
<script src="lib/Highcharts-8.2.2/code/modules/accessibility.js"></script>


<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Home</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                </ul>
            </div>
        </div>
    </div>
</div>

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="small-box bg-info" style="background-color: #2d6fa9 !important;">
                                <div class="row" style=" padding: 10px 10px 10px 13px;">
                                    <div class="col-md-3" style="margin: -10px 0px -10px 0px;background: rgba(0,0,0,0.1);">
                                        <center><img src="images/logo.png" height="75" style="position: absolute;top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></center>
                                    </div>
                                    <div class="col-md-9" style="padding: 0px,0px,0px,10px">
                                        <table style="width: 100%; margin-top: 6px; margin-bottom: 6px;">
                                            <tr>
                                                <td><h4>PEMERINTAH KABUPATEN LAMONGAN</h4></td>
                                            </tr>
                                            <tr>
                                                <td>DASHBOARD KEPEGAWAIAN</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- small box -->
                            <div class="small-box bg-info" style="background-color: #fca12a !important;">
                                <div class="row" style=" padding: 10px 10px 10px 13px;">
                                    <div class="col-md-4" style="margin: -10px 0px -10px 0px;background: rgba(0,0,0,0.1);">
                                        <center><img src="images/diagram_1.png" height="50" style="opacity: 0.5;  position: absolute;top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></center>
                                    </div>
                                    <div class="col-md-8" style="padding: 0px,0px,0px,10px">
                                        <span>Jumlah ASN <b><?=$jumlahasn?></b></span>
                                        <table style="width: 100%">
                                            <tr>
                                                <td style="width: 45%;">PNS</td>
                                                <td style="width: 10%;">:</td>
                                                <td style="width: 45%;"><?=$jumlahpns?></td>
                                            </tr>
                                            <tr>
                                                <td>PPPK</td>
                                                <td>:</td>
                                                <td><?=$jumlahpppk?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- small box -->
                            <div class="small-box bg-info" style="background-color: #dd503f !important;">
                                <div class="row" style=" padding: 10px 10px 10px 13px;">
                                    <div class="col-md-4" style="margin: -10px 0px -10px 0px;background: rgba(0,0,0,0.1);">
                                        <center><img src="images/diagram_2.png" height="50" style="opacity: 0.5;  position: absolute;top: 0; bottom: 0; left: 0; right: 0; margin: auto;"></center>
                                    </div>
                                    <div class="col-md-8" style="padding: 0px,0px,0px,10px">
                                        <span>Jumlah PNS dan CPNS <b></b></span>
                                        <table style="width: 100%">
                                            <tr>
                                                <td style="width: 45%;">PNS</td>
                                                <td style="width: 10%;">:</td>
                                                <td style="width: 45%;"><?=$jumlahpns?></td>
                                            </tr>
                                            <tr>
                                                <td>CPNS</td>
                                                <td>:</td>
                                                <td><?=$jumlahcpns?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <!-- small box -->
                            <div class="small-box bg-info" style="background-color: #37cccc !important;">
                                <div class="row" style="padding: 10px;">
                                    <div class="col-md-6" style="padding: 0px,0px,0px,10px">
                                        <h3><?=$jumlahstruktural?></h3>
                                        <p>Jumlah PNS Struktural</p>
                                    </div>
                                    <div class="col-md-6" style="padding: 0px">
                                        <center><img src="images/pns_struktural.png" height="75" style="opacity: 0.5;"></center>
                                    </div>
                                </div>
                                <a class="small-box-footer">PNS JPT/ Administrator /Pengawas </a>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- small box -->
                            <div class="small-box bg-info" style="background-color: #605ba9 !important;">
                                <div class="row" style="padding: 10px;">
                                    <div class="col-md-6" style="padding: 0px,0px,0px,10px">
                                        <h3><?=$jumlahfungsional?></h3>
                                        <p>Jumlah PNS Fungsional</p>
                                    </div>
                                    <div class="col-md-6" style="padding: 0px">
                                        <center><img src="images/pns_fungsional.png" height="75" style="opacity: 0.5;"></center>
                                    </div>
                                </div>
                                <a class="small-box-footer">PNS Fungsional</a>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- small box -->
                            <div class="small-box bg-info" style="background-color: #00a65a !important;">
                                <div class="row" style="padding: 10px;">
                                    <div class="col-md-6" style="padding: 0px,0px,0px,10px">
                                        <h3><?=$jumlahpelaksana?></h3>
                                        <p>Jumlah PNS Pelaksana</p>
                                    </div>
                                    <div class="col-md-6" style="padding: 0px">
                                        <center><img src="images/pns_pelaksana.png" height="75" style="opacity: 0.5;"></center>
                                    </div>
                                </div>
                                 <a class="small-box-footer">PNS Pelaksana</a>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- small box -->
                            <div class="small-box bg-info" style="background-color: #00c0ef !important;">
                                <div class="row" style="padding: 10px;">
                                    <div class="col-md-6" style="padding: 0px,0px,0px,10px">
                                        <h3><?=$jumlahpppk?></h3>
                                        <p>Jumlah PPPK</p>
                                    </div>
                                    <div class="col-md-6" style="padding: 0px">
                                        <center><img src="images/pppk.png" height="75" style="opacity: 0.5;"></center>
                                    </div>
                                </div>
                                <a class="small-box-footer">Jumlah PPPK</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <figure class="highcharts-figure">
                              <div id="GolRuangPNS"></div>
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <figure class="highcharts-figure">
                              <div id="GolRuangPPPK"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <figure class="highcharts-figure">
                              <div id="JenjangPendidikan"></div>
                            </figure>
                        </div>
                        <div class="col-md-4">
                            <figure class="highcharts-figure">
                              <div id="JenisKelamin"></div>
                            </figure>
                        </div>
                        <div class="col-md-4">
                            <figure class="highcharts-figure">
                              <div id="UmurPegawai"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <figure class="highcharts-figure">
                              <div id="PegawaiStruktural"></div>
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <figure class="highcharts-figure">
                              <div id="TipePegawai"></div>
                            </figure>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
        <!--end::Card-->

    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

<style type="text/css">
    .highcharts-figure, .highcharts-data-table table {
      min-width: 310px;
      max-width: 800px;
      margin: 1em auto;
    }

    #container {
      height: 400px;
    }

    .highcharts-data-table table {
      border-collapse: collapse;
      border: 1px solid #ebebeb;
      margin: 10px auto;
      text-align: center;
      width: 100%;
      max-width: 500px;
    }

    .highcharts-data-table caption {
      padding: 1em 0;
      font-size: 1.2em;
      color: #555;
    }

    .highcharts-data-table th {
      font-weight: 600;
      padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
      padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
      background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
      background: #f1f7ff;
    }
    .highcharts-credits{
        display: none;
    }
</style>

<script type="text/javascript">

    getvaluegol();
    getvaluepppk();
    getvalueumur();
    getvaluependidikan();
    getvaluejeniskelamin();
    getvaluetipe();
    getvaluestruktural();

    function getvaluegol(text,name){
        $.post( 'json-admin/home_json/grafik_gol_pns',{reqStatusPegawai:2}, function(data) {
                // console.log(data);return false;
            var object= JSON.parse(data);
            ubahvaluegolpns(object,name);
        });
    }

    function getvaluepppk(text,name){
        $.post( 'json-admin/home_json/grafik_gol_pppk',{}, function(data) {
                // console.log(data);return false;
            var object= JSON.parse(data);
            ubahvaluegolpppk(object,name);
        });
    }

    function getvalueumur(text,name){
        $.post( 'json-admin/home_json/grafik_umur_pegawai',{}, function(data) {
                // console.log(data);return false;
            var object=data;
            ubahvalueumur(object,name);
        });
    }

    function getvaluependidikan(text,name){
        $.post( 'json-admin/home_json/grafik_pendidikan',{}, function(data) {
                // console.log(data);return false;
            var object= JSON.parse(data);
            ubahvaluependidikan(object,name);
        });
    }

    function getvaluejeniskelamin(text,name){
        $.post( 'json-admin/home_json/grafik_jenis_kelamin_pns',{}, function(data) {
                // console.log(data);return false;
            var object= JSON.parse(data);
            ubahvaluejeniskelamin(object,name);
        });
    }

    function getvaluetipe(text,name){
        $.post( 'json-admin/home_json/grafik_tipe',{}, function(data) {
                // console.log(data);return false;
            var object= JSON.parse(data);
            ubahvaluetipe(object,name);
        });
    }

    function getvaluestruktural(text,name){
        $.post( 'json-admin/home_json/grafik_struktural',{}, function(data) {
                // console.log(data);return false;
            var object= JSON.parse(data);
            ubahvaluestruktural(object,name);
        });
    }

    function ubahvaluegolpns(object,name){
        Highcharts.chart('GolRuangPNS', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Statistik Gol/Ruang PNS'
          },
          xAxis: {
            categories: [
            <? 
            $x=0;
            while($x < count($pns)){
                if($x==0)   $sep = '';
                else        $sep = ',';
                ?>
                <? echo $sep."'".$pns[$x]."'"?>
                <? 
                $x++;
            }
            ?>
            ]
         },
         yAxis: {
            title: {
                text: 'Jumlah Pegawai'
            }
         },
          legend: {
            enabled: false
          },
          exporting: {
             enabled: true
          },
          tooltip: {
            formatter: function() {
               return '<b>Jumlah pegawai golongan PNS '+ this.x +'</b>'+': '+ this.y +'<br/>';
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
           colors: [
                '#7cb5ec', '#434348', '#90ed7d', '#f7a35c', '#8085e9', 
                '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'
            ],
         series: [<?=$statepns?>]
        });
    }

    function ubahvaluegolpppk(object,name){
         Highcharts.chart('GolRuangPPPK', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Statistik Gol/Ruang PPPK'
          },
          xAxis: {
            categories: [
            <? 
            $x=0;
            while($x < count($pppk)){
                if($x==0)   $sep = '';
                else        $sep = ',';
                ?>
                <? echo $sep."'".$pppk[$x]."'"?>
                <? 
                $x++;
            }
            ?>
            ]
         },
         yAxis: {
            title: {
                text: 'Jumlah Pegawai'
            }
         },
          legend: {
            enabled: false
          },
          exporting: {
             enabled: true
          },
          tooltip: {
            formatter: function() {
               return '<b>Jumlah pegawai golongan PPPK '+ this.x +'</b>'+': '+ this.y +'<br/>';
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
           colors: [
                '#7cb5ec', '#434348', '#90ed7d', '#f7a35c', '#8085e9', 
                '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'
            ],
         series: [<?=$statepppk?>]
        });
    }

    function ubahvaluependidikan(object,name){
         Highcharts.chart('JenjangPendidikan', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Statistik Jenjang Pendidikan'
          },
          xAxis: {
            type: 'category'
          },
          legend: {
            enabled: false
          },
          exporting: {
             enabled: true
          },
          plotOptions: {
            column: {
                colorByPoint: true
            },
            series: {
              borderWidth: 0,
              dataLabels: {
                enabled: true,
                format: '{point.y}'
              }
            }
          },
           colors: [
                '#7cb5ec', '#434348', '#90ed7d', '#f7a35c', '#8085e9', 
                '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'
            ],
          series: [
            {
              name: "",
              data: object
            }
          ]
        });
    }

    function ubahvaluejeniskelamin(object,name){
        // console.log(object.pns);
        Highcharts.chart('JenisKelamin', {
          chart: {
            type: 'column'
          },

          title: {
            text: 'Statistik Jenis Kelamin'
          },

          xAxis: {
            categories: ['PNS', 'PPPK']
          },

          yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
              text: 'Total'
            }
          },
           series: [{
                        name: 'Laki-Laki',
                        data: object.pns,
                        color: '#0798d8'
                    }, 
                    {
                        name: 'Perempuan',
                        data: object.pppk,
                        color: '#f98605'
                    }],
        });
    }

    function ubahvalueumur(object,name){
         Highcharts.chart('UmurPegawai', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Statistik Umur Pegawai'
          },
          xAxis: {
            categories: [
            <? 
            $x=0;
            while($x < count($gol_ruang)){
                if($x==0)   $sep = '';
                else        $sep = ',';
                ?>
                <? echo $sep."'".$gol_ruang[$x]."'"?>
                <? 
                $x++;
            }
            ?>
            ]
        },
        yAxis: {
            title: {
                text: 'Jumlah Pegawai'
            }
        },
          legend: {
            enabled: false
          },
          exporting: {
             enabled: true
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
           colors: [
                '#7cb5ec', '#434348', '#90ed7d', '#f7a35c', '#8085e9', 
                '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'
            ],
          series: [<?=$state?>]
        });
    }

    function ubahvaluestruktural(object,name){
        Highcharts.chart('PegawaiStruktural', {
           chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
          },
          title: {
            text: 'Statistik Pegawai Struktural'
          },
          tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}</b>'
          },
          accessibility: {
            point: {
              valueSuffix: '%'
            }
          },
          exporting: {
             enabled: true
          },
          plotOptions: {
            pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                enabled: false
              },
              showInLegend: true
            }
          },
          series: [{
            name: '',
            colorByPoint: true,
            data: object
            
          }]
        });
    }

    function ubahvaluetipe(object,name){
        Highcharts.chart('TipePegawai', {
           chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
          },
          title: {
            text: 'Statistik Tipe Pegawai'
          },
          tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}</b>'
          },
          accessibility: {
            point: {
              valueSuffix: '%'
            }
          },
          exporting: {
             enabled: true
          },
          plotOptions: {
            pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                enabled: false
              },
              showInLegend: true
            }
          },
          series: [{
            name: '',
            colorByPoint: true,
            data: object
            
          }]
        });
    }

  
</script>