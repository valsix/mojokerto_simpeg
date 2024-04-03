<?
include_once("functions/personal.func.php");

$this->load->model("base-data/InfoData");

$reqPegawaiId= $this->pegawaiId;
$reqSatkerId= $this->input->get('reqSatkerId');

$set= new InfoData();
$set->selectbyparamspegawai(array("A.PEGAWAI_ID"=>$reqPegawaiId),-1,-1);
// echo $set->query;exit;
$set->firstRow();
$reqNIPBaru= $set->getField('NIP_BARU');
$reqNama= $set->getField('NAMA');
$reqEmail= $set->getField('EMAIL');
$reqAlamat= $set->getField('ALAMAT');
$reqPangkatTerkahir= $set->getField('PANGKAT_KODE')." (".$set->getField('PANGKAT_NAMA').")";
$reqTmtPangkat= getFormattedDateTime($set->getField('LAST_TMT_PANGKAT'), false);
$reqJabatanTerkahir= $set->getField('LAST_JABATAN');
$reqTmtJabatan= getFormattedDateTime($set->getField('LAST_TMT_JABATAN'), false);

$reqGelarDepan= $set->getField('GELAR_DEPAN');
$reqGelarBelakang= $set->getField('GELAR_BELAKANG');
$reqJurusanTerkahir= $set->getField('JURUSAN');
$reqSatker= $set->getField('NMSATKER');

$set= new InfoData();
$set->selectbyparamspendidikan(array("A.PEGAWAI_ID"=>$reqPegawaiId),-1,-1);
// echo $set->query;exit;
$set->firstRow();
$reqPendidikanTerkahir= $set->getField('PENDIDIKAN_NAMA');
$reqTahunLulus= $set->getField('TAHUN');
?>
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5"><i class="fa fa-home" aria-hidden="true"></i> Home</h5>
                <!-- <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                  
                </ul> -->
            </div>
        </div>
    </div>
</div>

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b card-home">
        <!-- <div class="card card-custom gutter-b" style="background: rgba(255,255,255,0.9);"> -->
            <div class="card-body">

                <div class="row">
                    <div class="col-md-3">
                        <div class="area-total-pegawai">
                            <div class="ikon">
                                <img src="images/img-asn.png" width="105">   
                            </div>
                            <div class="data">
                                <div class="title">Total Pegawai</div>
                                <div class="nilai">1024</div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="area-total-jenis-kelamin">
                            <div class="inner">
                                <div class="item">
                                    <div class="ikon">
                                        <img src="images/img-pria.png">  
                                    </div>
                                    <div class="data">
                                        <div class="title">Laki-laki</div>
                                        <div class="nilai">3114</div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="ikon">
                                        <img src="images/img-wanita.png">    
                                    </div>
                                    <div class="data">
                                        <div class="title">Perempuan</div>
                                        <div class="nilai">389</div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="area-live-date">
                            <h1 id="time" class="time"></h1>
                            <h1 id="date" class="date"></h1>
                        </div>
                    </div>
                </div>

                <div class="row row-grafik">
                    <div class="col-md-3">
                        <div class="judul">
                            Jenis Kelamin
                            <div class="keterangan">Jumlah pegawai berdasarkan jenis kelamin</div>
                        </div>
                        <div class="area-grafik-pegawai">
                            <div id="container-jenis-kelamin" style="min-width: 0; height: 300px; margin: 0 auto"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="judul">
                            Status Pegawai
                            <div class="keterangan">Jumlah pegawai berdasarkan status kepegawaian</div>
                        </div>
                        <div class="area-grafik-pegawai">
                            <div id="container" style="min-width: 0; height: 300px; margin: 0 auto"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="judul">
                                    Grafik
                                    <div class="keterangan">Grafik</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="area-filter">

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3" for="email">Filter :</label>
                                        <div class="col-sm-9">
                                            <select class="form-control">
                                                <option>Pilih 1</option>
                                                <option>Pilih 2</option>
                                                <option>Pilih 3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- <label>Filter :</label> -->
                                    <!-- <select class="form-control">
                                        <option>Pilih 1</option>
                                        <option>Pilih 2</option>
                                        <option>Pilih 3</option>
                                    </select> -->
                                </div>
                            </div>
                        </div>
                        <div class="area-grafik-pegawai">
                            <div id="container-kepegawaian" style="min-width: 0; height: 300px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

<!-- LIVE TIME -->
<script type="text/javascript">
    var today = new Date();
    var day = today.getDate();
    var month = today.getMonth() + 1;

    function appendZero(value) {
        return "0" + value;
    }

    function theTime() {
        var d = new Date();
        document.getElementById("time").innerHTML = d.toLocaleTimeString("en-US");
    }

    if (day < 10) {
        day = appendZero(day);
    }

    if (month < 10) {
        month = appendZero(month);
    }

    today = day + "/" + month + "/" + today.getFullYear();

    document.getElementById("date").innerHTML = today;

    var myVar = setInterval(function () {
        theTime();
    }, 1000);
</script>

<!-- HIGHCHARTS -->
<script src="lib/highcharts/highcharts.js"></script>
<script src="lib/highcharts/exporting.js"></script>
<script type="text/javascript">
    $(function() {
        // Create the chart
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'pie',
                backgroundColor: null
            },
            exporting: {
                enabled: false
            },
            title: {
                text: null
            },
            yAxis: {
                title: {
                    text: 'Total percent market share'
                }
            },
            plotOptions: {
                pie: {
                    shadow: false
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
                }
            },
            series: [{
                name: 'Browsers',
                data: [["CPNS",6],["PNS",4],["PPPK",7]],
                colors: ['#f9292a','#9c1a09','#f4953f'],
                size: '90%',
                innerSize: '65%',
                showInLegend:true,
                dataLabels: {
                    enabled: false
                }
            }]
        });
    });
</script>

<!-- GRAFIK JENIS KELAMIN -->
<script type="text/javascript">
    Highcharts.chart('container-jenis-kelamin', {
        chart: {
            type: 'pie',
            backgroundColor: null
        },
        exporting: {
            enabled: false
        },
        title: {
            text: null
        },
        tooltip: {
            valueSuffix: '%'
        },
        subtitle: {
            text: null
        },
        plotOptions: {
            pie: {
                size: 150
            },
            series: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: [{
                    enabled: true,
                    distance: 20
                }, {
                    enabled: true,
                    distance: -40,
                    format: '{point.percentage:.1f}%',
                    style: {
                        fontSize: '1.2em',
                        textOutline: 'none',
                        opacity: 0.7
                    },
                    filter: {
                        operator: '>',
                        property: 'percentage',
                        value: 10
                    }
                }]
            }
        },
        series: [
            {
                name: 'Percentage',
                colorByPoint: true,
                data: [
                    {
                        name: 'Laki-laki',
                        y: 55.02,
                        color: '#f9292a'
                    },
                    {
                        name: 'Perempuan',
                        sliced: true,
                        selected: true,
                        y: 26.71,
                        color: '#9c1a09'
                    }
                ],
                showInLegend:true,
            }
        ]
    });

</script>

<!-- GRAFIK KEPEGAWAIAN -->
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

