<?php
include_once("functions/date.func.php");
$this->load->model("base-data/InfoData");

$reqId= $this->input->get('reqId');
$reqSatuanKerja=$this->userSatkerId;

$arrtabledata= array(
    array("label"=>"Nama", "field"=> "NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"NIP Baru", "field"=> "NIP_BARU", "display"=>"",  "width"=>"")
    , array("label"=>"Gol. Ruang", "field"=> "PANGKAT_INFO", "display"=>"",  "width"=>"")
    // , array("label"=>"Eselon", "field"=> "ESELON", "display"=>"",  "width"=>"")
    , array("label"=>"Jabatan", "field"=> "LAST_JABATAN", "display"=>"",  "width"=>"")
    , array("label"=>"Unit Kerja", "field"=> "SATKER_NAMA", "display"=>"",  "width"=>"")

    // untuk dua ini kunci, data akhir id, data sebelum akhir untuk order
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"statusberlaku", "field"=> "STATUS_BERLAKU", "display"=>"1", "width"=>"")
    , array("label"=>"satuankerjaid", "field"=> "SATKER_ID", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"")
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
                        <i class="flaticon2-notepad text-primary"></i>
                    </span>
                    <h3 class="card-label">Pegawai</h3>
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

                <div class="mb-15">
                    <!-- <div class="row mb-8">
                        <div class="col-lg-3 mb-lg-0 mb-4">
                            <label>Status Pegawai:</label>
                            <select name="reqStatusPegawai" id="reqStatusPegawai" class="form-control datatable-input">
                             <option value='11' selected='selected' >AKTIF</option>
                             <option value='12' >NON AKTIF</option>
                             <option value='13' >MUTASI</option>
                            </select>
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-4">
                            <label>Tipe Pegawai:</label>
                            <select name="reqTipePegawai" id="reqTipePegawai" class="form-control datatable-input">
                                <option value="">Semua</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="row mb-8">
                        <div class="col-lg-12 mb-lg-0 mb-6">
                            <label>Satuan Kerja:</label>
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
                    </div>
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

jQuery(document).ready(function() {
    $("#reqSatuanKerja,#reqStatusPegawai,#reqBulan,#reqTipePegawai").change(function() {
      var satuanKerja = $("#reqSatuanKerja").val();
      var cari = ''; //$('div.dataTables_filter input').val();
      var bulan = $("#reqBulan").val();
      var reqTipePegawai = $("#reqTipePegawai").val();
      var reqStatusPegawai = $("#reqStatusPegawai").val();
      
      // document.location.href = "admin/index/validator.php?reqBulan="+bulan+'&reqTahun='+tahun+"&reqValidasi="+$("#reqValidasi").val()+"&reqSatuanKerja="+satuanKerja;

      jsonurl= "json-data/info_admin_json/jsonpegawai?reqTipePegawai="+reqTipePegawai+"&reqStatusPegawai="+reqStatusPegawai+"&reqSatuanKerja="+satuanKerja;
      // datanewtable.DataTable().filter.reqValidasi = 1;
      // datanewtable.DataTable().draw();
      datanewtable.DataTable().ajax.url(jsonurl).load();
    });

    var jsonurl= "json-data/info_admin_json/jsonpegawai?reqBulan=<?=$reqBulan?>&reqTahun=<?=$reqTahun?>&reqValidasi=<?=$reqValidasi?>&reqSatuanKerja=<?=$reqSatuanKerja?>";
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

                pageUrl= "app/index/pegawai_data";
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

</script>