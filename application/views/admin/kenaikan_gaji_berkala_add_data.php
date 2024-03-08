<?php
include_once("functions/date.func.php");
include_once("functions/string.func.php");

$this->load->model("base-app/Satker");
$this->load->model("base-app/Rekap");
$this->load->model("base-validasi/TipePegawai");

$reqGAJI_RIWAYAT_ID = $this->input->get("reqGAJI_RIWAYAT_ID");
$reqMode = $this->input->get("reqMode");
$reqPegawaiId = $this->input->get("reqPegawaiId");
$reqBulan= $this->input->get("reqBulan");
$reqTahun= $this->input->get("reqTahun");
$reqSatkerId= $this->input->get("reqSatkerId");
$reqGaji= $this->input->get("reqGaji");
$reqTipePegawai= $this->input->get("reqTipePegawai");
$reqKgb= $this->input->get("reqKgb");



$tempTanggalTmt= "01-".generateZero($reqBulan,2)."-".$reqTahun;

$arrdata= array(
    array("label"=>"No. SK", "field"=> "NO_SK", "display"=>"",  "width"=>"")
    , array("label"=>"Tgl. SK", "field"=> "TANGGAL_SK", "display"=>"",  "width"=>"")
    , array("label"=>"TMT SK", "field"=> "TMT_SK", "display"=>"",  "width"=>"")
    , array("label"=>"Pangkat", "field"=> "NMPANGKAT", "display"=>"",  "width"=>"")
    , array("label"=>"Gaji Pokok", "field"=> "GAJI_POKOK", "display"=>"",  "width"=>"")
    , array("label"=>"Masa Kerja", "field"=> "MASA_KERJA", "display"=>"",  "width"=>"")
    , array("label"=>"Jenis Kenaikan", "field"=> "NMJENISKENAIKAN", "display"=>"",  "width"=>"")
    , array("label"=>"Pejabat Penetap", "field"=> "NMPEJABATPENETAP", "display"=>"",  "width"=>"")
    , array("label"=>"Gaji Riwayat Id", "field"=> "GAJI_RIWAYAT_ID", "display"=>"1",  "width"=>"")
   
    // untuk dua ini kunci, data akhir id, data sebelum akhir untuk order
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"")
);



?>
<style type="text/css">
.warningstyle { background-color:#ffeeba }
.alertstyle { background-color:#b8b8b8 }

</style>
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Menu</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Kenaikan Gaji Berkala</a>
                    </li>
                     <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Detail Kenaikan Gaji Berkala</a>
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
                    <h3 class="card-label">Detail Kenaikan Gaji Berkala</h3>
                </div>
                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-success font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md"></span>Aksi
                        </button>

                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-item">
                                    <a id="btnCetak" onclick="btnCetak()" class="navi-link">
                                        <span class="navi-icon"><i class="la la-file-excel-o"></i></span>
                                        <span class="navi-text">Cetak SK</span>
                                    </a>
                                    <a id="btnUbahData" class="navi-link">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Edit</span>
                                    </a>
                                    <a id="btnDelete" class="navi-link">
                                        <span class="navi-icon"><i class="la la-trash"></i></span>
                                        <span class="navi-text">Hapus</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                        <tr>
                            <?php
                            foreach($arrdata as $valkey => $valitem) 
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
<input type="hidden" id="setInfoTampil" />

<a href="#" id="triggercari" style="display:none" title="triggercari">triggercari</a>
<script type="text/javascript">
var datanewtable;
var infotableid= "kt_datatable";
var carijenis= "";
var arrdata= <?php echo json_encode($arrdata); ?>;
var indexfieldidrow= arrdata.length - 1;
var indexfieldid= arrdata.length - 1;
var indexfieldtmt= arrdata.length - 9;
var indexfieldgaji= arrdata.length - 3;

var datainfopage= 25;

var dataTablewarna= "TMT_SK";
var tempTanggalTmt= '<?=$tempTanggalTmt?>';
// console.log(tempTanggalTmt);

var valinfoid = anSelectedStatusKgb=anSelectedNomorGenerate= anSelectedSatkerId='';

jQuery(document).ready(function() {

    var jsonurl= "json-admin/kenaikan_gaji_berkala_json/json_detail?reqMode=proses&reqType=A&reqPegawaiId=<?=$reqPegawaiId?>&reqBulan=<?=$reqBulan?>&reqTahun=<?=$reqTahun?>&reqSatkerId=<?=$reqSatkerId?>&reqGaji=<?=$reqGaji?>";
    ajaxserverselectsingle.init(infotableid, jsonurl, arrdata);

    var infoid= [];
    $('#'+infotableid+' tbody').on( 'click', 'tr', function () {
        // untuk pilih satu data, kalau untuk multi comman saja
        $('#'+infotableid+' tbody tr').removeClass('selected');

        var el= $(this);
        el.addClass('selected');

        var dataselected= datanewtable.DataTable().row(this).data();

        fieldinfoid= arrdata[indexfieldid]["field"];
        fieldinfotmt= arrdata[indexfieldtmt]["field"];
        fieldinfogaji= arrdata[indexfieldgaji]["field"];
        valinfoid= dataselected[fieldinfoid];
        valinfogaji= dataselected[fieldinfogaji];
        valinfotmt= dataselected[fieldinfotmt];
       
        if (valinfoid == null)
        {
            valinfoid = '';
        }
        if (valinfogaji == null)
        {
            valinfogaji = '';
        }
        if (valinfotmt == null)
        {
            valinfotmt = '';
        }
      
    });

    $("#buttoncaridetil").on("click", function () {
        carijenis= "2";
        calltriggercari();
    });

    $("#triggercari").on("click", function () {

        if(carijenis == "1")
        {
            pencarian= $('#'+infotableid+'_filter input').val();
            datanewtable.DataTable().search( pencarian ).draw();
        }
        else
        {
            
        }
    });

    $('#'+infotableid+' tbody').on( 'dblclick', 'tr', function () {
      $("#btnUbahData").click();    
    });

    $("#btnAdd").on("click", function () {
       var url = "admin/index/pegawai_riwayat_kontrak_add?reqPegawaiId=<?=$reqPegawaiId?>";
       window.location.href = url;
    });

  
    $('#btnUbahData').on('click', function () {

        if(tempTanggalTmt != valinfotmt)
        {

            var text ="Data tidak bisa di ubah.<br> Data bulan dan tahun pada kolom TMT SK, tidak seusai dengan filter bulan dan tahun"
            Swal.fire({
               html: text,
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                }
            });
            return false;
        }
        else
        {
            var url = "admin/index/kenaikan_gaji_berkala_add_data_detil?reqGAJI_RIWAYAT_ID="+valinfogaji+"&reqPegawaiId=<?=$reqPegawaiId?>&reqBulan=<?=$reqBulan?>&reqTahun=<?=$reqTahun?>&reqSatkerId=<?=$reqSatkerId?>&reqMode=view";
            window.location.href = url;
        }

    });

    $('#btnDelete').on('click', function (e) {
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
        }
        else
        {
            urlAjax= "json-admin/kenaikan_gaji_berkala_json/delete?reqGAJI_RIWAYAT_ID="+valinfogaji;
            swal.fire({
                title: 'Apakah anda yakin untuk hapus data?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then(function(result) { 
                if (result.value) {
                    $.ajax({
                        url : urlAjax,
                        type : 'DELETE',
                        dataType:'json',
                        beforeSend: function() {
                            swal.fire({
                                title: 'Please Wait..!',
                                text: 'Is working..',
                                onOpen: function() {
                                    swal.showLoading()
                                }
                            })
                        },
                        success : function(data) { 
                            swal.fire({
                                position: 'center',
                                icon: "success",
                                type: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                document.location.href = "admin/index/kenaikan_gaji_berkala_add_data.php?reqPegawaiId=<?=$reqPegawaiId?>&reqBulan=<?=$reqBulan?>&reqTahun=<?=$reqTahun?>&reqSatkerId=<?=$reqSatkerId?>&reqGaji=<?=$reqGaji?>&reqKgb=<?=$reqKgb?>";
                            });
                        },
                        complete: function() {
                            swal.hideLoading();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            swal.hideLoading();
                            var err = JSON.parse(jqXHR.responseText);
                            Swal.fire("Error", err.message, "error");
                        }
                    });
                }
            });
        }
    });


});

function calltriggercari()
{
    $(document).ready( function () {
      $("#triggercari").click();      
    });
}

function btnCetak()
{
    opUrl= 'admin/loadUrl/admin/kenaikan_gaji_berkala_cetak_sk.php?reqId=<?=$reqPegawaiId?>&reqTipePegawai=<?=$reqTipePegawai?>&reqKgb=<?=$reqKgb?>';
    newWindow = window.open(opUrl, 'Cetak');
    newWindow.focus();
}

</script>