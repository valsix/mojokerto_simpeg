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
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader" style="display: none;">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5"><i class="fa fa-user" aria-hidden="true"></i> Dashboard Personal</h5>
                <!-- <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                  
                </ul> -->
            </div>

        </div>
    </div>
</div>

<style type="text/css">
    @media screen and (min-width: 768px) {
        .col-sm-push-8 {
            left: 66.66666667%;
        }    
        .col-sm-pull-4 {
            right: 33.33333333%;
        }
    }
    /*@media (min-width: 768px)*/
    

    /*@media (min-width: 768px)*/
    
</style>

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b card-home-personal">
        <!-- <div class="card card-custom gutter-b" style="background: rgba(255,255,255,0.9);"> -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 col-sm-push-8">
                        <div class="area-profil-personal">
                            <div class="biodata">
                                <div class="foto"><img src="images/img-user.png"></div>
                                <div class="data">
                                    <div class="nama">Indah Puspita Ningrum, S.Kom., M.KP.</div>
                                    <div class="jabatan">Pranata Komputer Pertama</div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="logout">
                                    <button><img src="images/icon-logout-putih.png"> Logout</button>
                                </div>
                            </div>
                            <div class="area-info-kehadiran">
                                <div class="judul">
                                    Info Kehadiran
                                    <div class="keterangan">Info Check In & Check Out</div>
                                </div>
                                <div class="inner">
                                    <div class="item">
                                        <div class="ikon">
                                            <img src="images/icon-checkin.png">
                                        </div>
                                        <div class="data">
                                            <div class="title">Check In </div>
                                            <div class="tanggal">04 Jan 24</div>
                                        </div>
                                        <div class="pukul">07:44</div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="item out">
                                        <div class="ikon">
                                            <img src="images/icon-checkout.png">
                                        </div>
                                        <div class="data">
                                            <div class="title">Check Out</div>
                                            <div class="tanggal">04 Jan 24</div>
                                        </div>
                                        <div class="pukul">16:18</div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 col-sm-pull-4">
                        <div class="area-selamat-datang">
                            <div class="judul">
                                Dashboard
                                <div class="keterangan">Selamat datang dihalaman portal pegawai</div>
                            </div>
                            <div class="area-presensi">
                                <div class="area-range-kalendar">
                                    <div id="cal1"></div>
                                </div>
                                <div class="area-presensi-detil">
                                    <section class="vertical slider">
                                        <div>
                                            <div class="item">
                                                <div class="waktu">
                                                    <div class="pukul">07:40</div>
                                                    <div class="keterangan">am</div>
                                                </div>
                                                <div class="info">
                                                    <div class="title">Masuk</div>
                                                    <div class="keterangan">Klarifikasi</div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="item">
                                                <div class="waktu">
                                                    <div class="pukul">07:40</div>
                                                    <div class="keterangan">am</div>
                                                </div>
                                                <div class="info">
                                                    <div class="title">Pulang</div>
                                                    <div class="keterangan">Klarifikasi</div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="item">
                                                <div class="waktu">
                                                    <div class="pukul">07:40</div>
                                                    <div class="keterangan">am</div>
                                                </div>
                                                <div class="info">
                                                    <div class="title">Test 1</div>
                                                    <div class="keterangan">Klarifikasi</div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="item">
                                                <div class="waktu">
                                                    <div class="pukul">07:40</div>
                                                    <div class="keterangan">am</div>
                                                </div>
                                                <div class="info">
                                                    <div class="title">Test 2</div>
                                                    <div class="keterangan">Klarifikasi</div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-8">
                        
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div> -->
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="area-ulasan-data-asn">
                            <div class="judul">
                                Ulasan Data ASN
                                <div class="keterangan">Informasi tentang Ulasan Data ASN</div>
                            </div>
                            <div class="inner">
                                <div class="item">
                                    <a href="#">
                                        <div class="nama">Nilai IP ASN 2022</div>
                                        <div class="tanggal">25 September 2023</div>
                                        <div class="keterangan">Nilai total IP ASN anda 70, dengan rincian nilai kualifikasi 20, kompetensi 10, kinerja 30 dan kedisiplinan...</div>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="#">
                                        <div class="nama">Lorem ipsum dolor sit amet</div>
                                        <div class="tanggal">25 September 2023</div>
                                        <div class="keterangan">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt...</div>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="#">
                                        <div class="nama">Lorem ipsum dolor sit amet</div>
                                        <div class="tanggal">25 September 2023</div>
                                        <div class="keterangan">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt...</div>
                                    </a>
                                </div>
                                <div class="selengkapnya">
                                    <a href="#">Lihat semua data</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="area-biodata-pegawai">
                            <ul class="nav nav-tabs">
                                <li><a class="active" data-toggle="tab" href="#home">Data Pegawai</a></li>
                                <li><a data-toggle="tab" href="#menu1">Data ASN</a></li>
                                <li><a data-toggle="tab" href="#menu2">Data Pribadi</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active show">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-2" for="email">NIP :</label>
                                            <div class="col-sm-4">
                                              <input type="email" class="form-control" id="email" value="190305022033000001">
                                            </div>
                                            <label class="control-label col-sm-2" for="email">Gol :</label>
                                            <div class="col-sm-4">
                                              <input type="email" class="form-control" id="email" value="III/b TMT 01 April 2015">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-2" for="email">TTL :</label>
                                            <div class="col-sm-4">
                                              <input type="email" class="form-control" id="email" value="Mojokerto, 02 Mei 1983">
                                            </div>
                                            <label class="control-label col-sm-2" for="email">Jenis Kelamin :</label>
                                            <div class="col-sm-4">
                                              <input type="email" class="form-control" id="email" value="Perempuan">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-2" for="email">Status / Kedudukan :</label>
                                            <div class="col-sm-10">
                                              <input type="email" class="form-control" id="email" value="PNS / PNS Terkena Hukuman Disiplin">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-2" for="email">OPD :</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</textarea>
                                            </div>
                                        </div>

                                    </form> 
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-2" for="email">Test :</label>
                                            <div class="col-sm-10">
                                              <input type="email" class="form-control" id="email" value="Test Data ASN">
                                            </div>
                                        </div>
                                    </form> 
                                </div>
                                <div id="menu2" class="tab-pane fade">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-2" for="email">Test :</label>
                                            <div class="col-sm-10">
                                              <input type="email" class="form-control" id="email" value="Test Data Pribadi">
                                            </div>
                                        </div>
                                    </form> 
                                </div>
                            </div>
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

<!-- SLICK -->
<link rel="stylesheet" type="text/css" href="lib/slick-1.8.1/slick/slick.css">
<link rel="stylesheet" type="text/css" href="lib/slick-1.8.1/slick/slick-theme.css">
<style type="text/css">
/*html, body {
  margin: 0;
  padding: 0;
}

* {
  box-sizing: border-box;
}
*/
.slider {
    width: 100%;
    margin: 0px auto;
}

.slick-slide {
  margin: 0px 0px;
}

.slick-slide img {
  width: 100%;
}

.slick-prev:before,
.slick-next:before {
  color: black;
}


.slick-slide {
  transition: all ease-in-out .3s;
  opacity: 1;
}

.slick-active {
  opacity: 1;
}

.slick-current {
  opacity: 1;
}
</style>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="lib/slick-1.8.1/slick/slick.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(document).on('ready', function() {
        $(".vertical").slick({
            dots: false,
            arrows: false,
            vertical: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true
        });
    });
</script>

<!-- RANGE CALENDAR -->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment-with-langs.min.js"></script>
<script type="text/javascript" src="lib/Range-Calendar/js/jquery.rangecalendar.js"></script>
<!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->
<link rel="stylesheet" id="rangecalendar-style-css" href="lib/Range-Calendar/css/rangecalendar.css" type="text/css" media="all">
<link rel="stylesheet" id="rangecalendar-style-css" href="lib/Range-Calendar/css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css"> 
<script>
    $(document).ready(function(){
        
        var defaultCalendar = $("#cal1").rangeCalendar();
        
        
        $("#setDateBt").click(function () {
            var newDate = new Date(2014, 4, 24);
            rangeCalendar.setStartDate(newDate);
            
            rangeCalendar.update();
        });
        
        $("#addMonthBt").click(function () {
        
            var newDate = moment().add('months', 1);
            rangeCalendar.setStartDate(newDate);
        });
        
        
        
        
        var customizedRangeCalendar = $("#cal2").rangeCalendar({theme:"full-green-theme"});
        var languageCalendar = $("#cal3").rangeCalendar({lang:"it"});
        var rangeCalendar =  $("#cal4").rangeCalendar({weekends:false});
        var callbackRangeCalendar =  $("#cal5").rangeCalendar({changeRangeCallback: rangeChanged,weekends:false});
        
        function rangeChanged(target,range){
        
            
            console.log(range);
            var startDay = moment(range.start).format('DD');
            var startMonth = moment(range.start).format('MMM');
            var startYear = moment(range.start).format('YY');
            var endDay = moment(range.end).format('DD');
            var endMonth = moment(range.end).format('MMM');
            var endYear = moment(range.end).format('YY');
            
            
            $(".calendar-values .start-date .value").html(startDay);
            $(".calendar-values .start-date .label").html("");
            $(".calendar-values .start-date .label").append(startMonth);
            $(".calendar-values .start-date .label").append("<small>"+startYear+"</small>");
            $(".calendar-values .end-date .value").html(endDay);
            $(".calendar-values .end-date .label").html("");
            $(".calendar-values .end-date .label").append(endMonth);
            $(".calendar-values .end-date .label").append("<small>"+endYear+"</small>");
            $(".calendar-values .days-width .value").html(range.width);
            $(".calendar-values .from-now .label").html(range.fromNow);
            
        }
    
        function ragneChanged(target,range) {
            
            console.log(range);
        }
    
    });
</script>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">


