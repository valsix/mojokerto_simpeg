<?php
include_once("functions/date.func.php");
$this->load->model("base-data/InfoData");

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$formulaid= $this->input->get('formulaid');

$reqId= $this->input->get('reqId');
$reqSatuanKerja=$this->userSatkerId;

$arrtabledata= array(
    array("label"=>"Tanggal", "field"=> "tanggal", "display"=>"",  "width"=>"")
    ,array("label"=>"Acara", "field"=> "Acara", "display"=>"",  "width"=>"")
    ,array("label"=>"Nilai Kompetensi", "field"=> "JPM1", "display"=>"",  "width"=>"")
    ,array("label"=>"Nilai Potensi", "field"=> "JPM2", "display"=>"",  "width"=>"")

    // untuk dua ini kunci, data akhir id, data sebelum akhir untuk order
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"statusberlaku", "field"=> "STATUS_BERLAKU", "display"=>"1", "width"=>"")
    , array("label"=>"satuankerjaid", "field"=> "SATKER_ID", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "RIWAYAT_SKP_ID", "display"=>"1", "width"=>"")
);

$set= new InfoData();
$arrsatuankerja= [];

$arrdata= [];
$arrdata["id"]= "";
$arrdata["text"]= "Semua Satker";
array_push($arrsatuankerja, $arrdata);

$set->selectbysatuankerja();
// echo $set->query;exit;
while($set->nextRow())
{
    $arrdata= [];
    $arrdata["id"]= $set->getField("SATUAN_KERJA_ID");
    $arrdata["text"]= $set->getField("NAMA");
    array_push($arrsatuankerja, $arrdata);
}
unset($set);
?>
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Data Riwayat</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Riwayat Kinerja</a>
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
                    <h3 class="card-label">Riwayat Kinerja</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                  <!--   <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md"></span>Aksi
                        </button>

                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-item">
                                    <a id="btnAdd" class="navi-link">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Tambah Data</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a id="btnUbahData" class="navi-link">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Edit Data</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a id="btnDelete" class="navi-link">
                                        <span class="navi-icon"><i class="la la-trash"></i></span>
                                        <span class="navi-text">Hapus</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div> -->

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
var indexfieldid= arrdata.length - 1;
var valinfoid = '';

jQuery(document).ready(function() {
    $("#reqSatuanKerja,#reqStatusPegawai,#reqBulan,#reqTipePegawai").change(function() {
      var satuanKerja = $("#reqSatuanKerja").val();
      var cari = ''; //$('div.dataTables_filter input').val();
      var bulan = $("#reqBulan").val();
      var reqTipePegawai = $("#reqTipePegawai").val();
      var reqStatusPegawai = $("#reqStatusPegawai").val();
      
      // document.location.href = "admin/index/validator.php?reqBulan="+bulan+'&reqTahun='+tahun+"&reqValidasi="+$("#reqValidasi").val()+"&reqSatuanKerja="+satuanKerja;

      jsonurl= "json-data/pegawai_kinerja_json/json?reqTipePegawai="+reqTipePegawai+"&reqStatusPegawai="+reqStatusPegawai+"&reqSatuanKerja="+satuanKerja;
      // datanewtable.DataTable().filter.reqValidasi = 1;
      // datanewtable.DataTable().draw();
      datanewtable.DataTable().ajax.url(jsonurl).load();
    });

    var jsonurl= "json-data/pegawai_kinerja_json/json?reqBulan=<?=$reqBulan?>&reqTahun=<?=$reqTahun?>&reqValidasi=<?=$reqValidasi?>&reqSatuanKerja=<?=$reqSatuanKerja?>";
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

        if(valinfoid == "" && btnid == "btnUbahData")
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

        if(btnid == "btnUbahData")
            vpilihid= valinfoid;
        else
            vpilihid= "";

        varurl= "app/index/pegawai_skp_data?formulaid=<?=$formulaid?>&reqId="+vpilihid;
        document.location.href = varurl;
    });
    
    $('#'+infotableid+' tbody').on( 'dblclick', 'tr', function () {
      // $("#btnUbahData").click();    
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
        urlAjax= "json-data/pegawai_huknis_json/delete?&reqDetilId="+valinfoid;
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
                            position: 'top-right',
                            icon: "success",
                            type: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function() {
                            document.location.href = "app/index/pegawai_skp?formulaid=<?=$formulaid?>";
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
</script>