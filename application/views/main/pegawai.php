<?php
$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$arrtabledata= array(
    array("label"=>"NIP", "field"=> "NIP_LAMA", "display"=>"", "width"=>"")
    , array("label"=>"NIP Baru", "field"=> "NIP_BARU", "display"=>"", "width"=>"")
    , array("label"=>"Nama", "field"=> "NAMA", "display"=>"", "width"=>"")
    , array("label"=>"Tempat Lahir", "field"=> "TEMPAT_LAHIR", "display"=>"", "width"=>"")
    , array("label"=>"Tanggal Lahir", "field"=> "TANGGAL_LAHIR", "display"=>"", "width"=>"")
    , array("label"=>"L/P", "field"=> "JENIS_KELAMIN", "display"=>"", "width"=>"")
    , array("label"=>"Status", "field"=> "STATUS_PEGAWAI", "display"=>"", "width"=>"")
    , array("label"=>"Gol.Ruang", "field"=> "GOL_RUANG", "display"=>"", "width"=>"")
    , array("label"=>"TMT Pangkat", "field"=> "TMT_PANGKAT", "display"=>"", "width"=>"")
    , array("label"=>"Eselon", "field"=> "ESELON", "display"=>"", "width"=>"")
    , array("label"=>"Jabatan", "field"=> "JABATAN", "display"=>"", "width"=>"")
    , array("label"=>"TMT Jabatan", "field"=> "TMT_JABATAN", "display"=>"", "width"=>"")
    , array("label"=>"Mata Pelajaran", "field"=> "JENIS_MAPEL", "display"=>"", "width"=>"")
    , array("label"=>"Agama", "field"=> "AGAMA", "display"=>"", "width"=>"")
    , array("label"=>"Jabatan Tambahan", "field"=> "JABATAN_TAMBAHAN_NAMA", "display"=>"", "width"=>"")
    , array("label"=>"TMT Jabatan Tambahan", "field"=> "TMT_JABATAN_AKHIR", "display"=>"", "width"=>"")
    , array("label"=>"Telepon", "field"=> "TELEPON", "display"=>"", "width"=>"")
    , array("label"=>"Alamat", "field"=> "ALAMAT", "display"=>"", "width"=>"")
    , array("label"=>"Satuan Kerja", "field"=> "SATKER", "display"=>"", "width"=>"")
    , array("label"=>"TMT Pensiun", "field"=> "TMT_PENSIUN", "display"=>"", "width"=>"")
    , array("label"=>"Pendidikan", "field"=> "PENDIDIKAN", "display"=>"", "width"=>"")
    , array("label"=>"Lulus", "field"=> "LULUS", "display"=>"", "width"=>"")

    , array("label"=>"tugas tambahan", "field"=> "TUGAS_TAMBAHAN_NEW", "display"=>"1", "width"=>"")
    , array("label"=>"hukuman status", "field"=> "HUKUMAN_STATUS_TERAKHIR", "display"=>"1", "width"=>"")
    , array("label"=>"status warna", "field"=> "STATUS_ESELON", "display"=>"1", "width"=>"")
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"")
);

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
                        <a class="text-muted">Pegawai</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Monitoring Pegawai</a>
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
                        <a class="filter btn btn-light-primary pull-right" id='btnAdd'>Tambah </a>
                        <a class="filter btn btn-light-primary pull-right" id='btnUbahData'>Ubah</a>
                        <a class="filter btn btn-light-primary pull-right" id='btnDelete'>Hapus </a>

                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                    <a id="" class="navi-link">
                                        <!-- <span class="navi-icon"><i class="la la-edit"></i></span> -->
                                        <span class="navi-text">FIP 02</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  id="" class="navi-link">
                                        <span class="navi-text">Biodata Lengkap</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  id="" class="navi-link">
                                        <span class="navi-text">Biodata Singkat</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  id="" class="navi-link">
                                        <span class="navi-text">Model C</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  id="" class="navi-link">
                                        <span class="navi-text">SPMT</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  id="" class="navi-link">
                                        <span class="navi-text">Cetak</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  id="" class="navi-link">
                                        <span class="navi-text">CetakPegawai</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
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
                        <div class="col-md-6" style="margin-top: 10px">
                            <label>Status Pegawai:</label>
                            <select id='filter' class="form-control datatable-input">
                                <option value='AND STATUS_PEGAWAI = 0'>Usulan</option>
                                <option value='AND (STATUS_PEGAWAI = 1 OR STATUS_PEGAWAI = 2)' selected='selected'>CPNS / PNS</option>
                                <option value='AND STATUS_PEGAWAI = 1'>CPNS</option>
                                <option value='AND STATUS_PEGAWAI = 2'>PNS</option>
                                <option value='AND STATUS_PEGAWAI = 12'>PPPK</option>
                                <option value='AND STATUS_PEGAWAI = 3'>Pensiun</option>
                                <option value='AND STATUS_PEGAWAI = 4'>TNI</option>
                                <option value='AND (STATUS_PEGAWAI = 5 OR STATUS_PEGAWAI = 6)'>Tewas / Wafat</option>
                                <option value='AND STATUS_PEGAWAI = 7'>Pindah</option>
                                <option value='AND STATUS_PEGAWAI = 8'>Diberhentikan dengan hormat</option>
                                <option value='AND STATUS_PEGAWAI = 9'>Diberhentikan tidak dengan hormat</option>
                                <option value='AND STATUS_PEGAWAI = 10'>Pensiun BUP</option>
                                <option value='AND STATUS_PEGAWAI = 11'>Pensiun Dini</option>
                            </select>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px">
                            <label>Hukuman:</label>
                            <select id='reqStatusHukuman' class="form-control datatable-input">
                                <option></option>
                                <option value='1'>Masih Berlaku</option>
                            </select>
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
var valinfovalidasiid = '';

var datainforesponsive= "1";
indextugastambahan= arrdata.length - 5;
indexstatushukuman= arrdata.length - 4;
indexstatuseselon= arrdata.length - 3;
infocolormode= 'pegawai';

jQuery(document).ready(function() {
    var jsonurl= "json-main/pegawai_json/json";
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

    $("#btnLembarFIP01Row").on("click", function () {
        btnid= $(this).attr('id');

        if(valinfoid == "")
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
        else{
            vpilihid= valinfoid;
            varurl= "app/loadUrl/main/cetakfip1?reqId="+vpilihid;
            // window.open(varurl, 'window name', 'window settings');
            window.open(varurl, '_blank');
        }
    });

    $("#btnLembarFIP02Row").on("click", function () {
        btnid= $(this).attr('id');

        if(valinfoid == "")
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
        else{
            vpilihid= valinfoid;
            varurl= "app/loadUrl/main/cetakfip2?reqId="+vpilihid;
            // window.open(varurl, 'window name', 'window settings');
            window.open(varurl, '_blank');
        }
    });

    $("#triggercari").on("click", function () {
        if(carijenis == "1")
        {
            pencarian= $('#'+infotableid+'_filter input').val();
            datanewtable.DataTable().search( pencarian ).draw();
        }
        else
        {
            reqStatusHukuman= $("#reqStatusHukuman").val();
            reqSearch= encodeURIComponent($("#filter").val());
            reqId= $("#reqSatkerId").val();

            jsonurl= "json-main/pegawai_json/json?reqStatusHukuman="+reqStatusHukuman+"&reqSearch="+reqSearch+"&reqId="+reqId;
            datanewtable.DataTable().ajax.url(jsonurl).load();
        }
    });

    $("#filter, #reqStatusHukuman, #reqSatkerId").change(function() { 
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

<!-- <div class="loading" id='vlsxloading'>Loading&#8230;</div> -->