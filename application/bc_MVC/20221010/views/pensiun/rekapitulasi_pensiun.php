<?php
include_once("functions/date.func.php");
$this->load->model("base-app/Satker");
$this->load->model("base-app/Rekap");
$this->load->model("base-validasi/TipePegawai");


$reqId= $this->input->get('reqId');

$statement_tipe= " AND ( TIPE_PEGAWAI_NEW_ID_PARENT = '0' OR LENGTH(TIPE_PEGAWAI_NEW_ID) = 2)";
$tipe_pegawai= new Rekap();
$tipe_pegawai->selectByParamsTipePegawai(array(), -1,-1, $statement_tipe);

$arrdata= array(
    array("label"=>"Nama", "field"=> "NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"NIP Baru", "field"=> "NIP_BARU", "display"=>"",  "width"=>"")
    , array("label"=>"Status", "field"=> "STATUS_PEGAWAI_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Tipe Pegawai", "field"=> "TIPE_PEGAWAI_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Gol. Ruang", "field"=> "GOL_RUANG", "display"=>"",  "width"=>"")
    , array("label"=>"Eselon", "field"=> "ESELON", "display"=>"",  "width"=>"")
    , array("label"=>"Jabatan", "field"=> "JABATAN", "display"=>"",  "width"=>"")
    // , array("label"=>"Sub Unit Kerja", "field"=> "SATKER", "display"=>"",  "width"=>"")
    , array("label"=>"Unit Kerja", "field"=> "SATKER_INDUK_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Tmt Pensiun", "field"=> "TANGGAL_PENSIUN", "display"=>"",  "width"=>"")
    // untuk dua ini kunci, data akhir id, data sebelum akhir untuk order
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"statusberlaku", "field"=> "STATUS_BERLAKU", "display"=>"1", "width"=>"")
    , array("label"=>"satuankerjaid", "field"=> "SATKER_ID", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"")
);

$tempSatuanKerjaParent= 0;
$satker= new Satker();
$statement= "";
$satker->selectByParams(array("SATKER_ID_PARENT"=>$tempSatuanKerjaParent),-1,-1, $statement);
// echo $satker->query;exit;

$arr_json = array();

$arr_json[0]['id'] = "";
$arr_json[0]['text'] = "Semua Satker";
$i = 1;

function getChild($id)
{
    $satker= new Satker();
    $satker->selectByParams(array('SATKER_ID_PARENT' => $id), -1, -1);
    
    $arr_json = array();
    $j=0;
    while($satker->nextRow())
    {
        $arr_json[$j]['id'] = $satker->getField("SATKER_ID");
        $arr_json[$j]['text'] = $satker->getField("NAMA");
        
        $set= new Satker();
        $record= $set->getCountByParams(array('SATKER_ID_PARENT' => $satker->getField("SATKER_ID")));
        unset($set);
        
        if($record > 0)
            $arr_json[$j]['children'] = getChild($satker->getField("SATKER_ID"));
            
        $j++;
    }
    return $arr_json;
}

while($satker->nextRow())
{
    $arr_json[$i]['id'] = $satker->getField("satker_id");
    $arr_json[$i]['text'] = $satker->getField("nama");
    //$arr_json[$i]['children'] = getChild($satker->getField("SATKER_ID"));
    $i++;
}

$curYear = date('Y');
$tahunawal=$curYear;
$tahunakhir=$curYear;


// $end = date('Y', strtotime('+5 years'));
// print_r($end);exit;


?>
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Menu</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Data Pegawai</a>
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
                    <h3 class="card-label">Rekapitulasi Pensiun</h3>
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
                                    <a id="reqExcel" class="navi-link">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Export</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <div class="mb-15">
                    <div class="row mb-8">
                        <div class="col-lg-3 mb-lg-0 mb-4">
                            <label>Tipe Pegawai:</label>
                            <select name="reqTipePegawai" id="reqTipePegawai" class="form-control datatable-input">
                                <option value="">Semua</option>
                                <?
                                while($tipe_pegawai->nextRow())
                                {
                                    ?>
                                    <option value="<?=$tipe_pegawai->getField("TIPE_PEGAWAI_NEW_ID")?>"><?=$tipe_pegawai->getField("NAMA")?></option>
                                    <?
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-lg-0 mb-4">
                            <label>Masukkan Tahun:</label>
                            <select name="reqTahunAwal" id="reqTahunAwal" class="form-control datatable-input">
                                <option value="<?=$curYear?>"><?=$curYear?></option>
                                <?
                                foreach(range($curYear+1, $curYear + 5) as $year) {
                                    echo "<option value='$year'>$year</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm--1"style="margin-top: 32px">
                            <label>S/D</label>
                        </div>
                        <div class="col-lg-2 mb-lg-0 mb-4" style="margin-top: 24px">

                            <select name="reqTahunAkhir" id="reqTahunAkhir" class="form-control datatable-input">
                                <option value="<?=$curYear?>"><?=$curYear?></option>
                                <?
                                foreach(range($curYear+1, $curYear + 5) as $year) {
                                    echo "<option value='$year'>$year</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-4">
                            <br>
                           <button type="button" class="btn btn-primary btn-sm" id="reqProses" style="margin-top:3px; ">Proses</button>
                        </div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-12 mb-lg-0 mb-6">
                            <label>Satuan Kerja:</label>
                            <select name="reqSatuanKerja" id="reqSatuanKerja" class="form-control datatable-input">
                                <?
                                for($i=0; $i < count($arr_json); $i++)
                                {
                                    $infoid= $arr_json[$i]['id'];
                                    $infotext= $arr_json[$i]['text'];
                                ?>
                                <option value="<?=$infoid?>" <? if($infoid == $reqSatuanKerja) echo "selected";?>><?=$infotext?></option>
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

<a href="#" id="triggercari" style="display:none" title="triggercari">triggercari</a>
<script type="text/javascript">
var datanewtable;
var infotableid= "kt_datatable";
var carijenis= "";
var arrdata= <?php echo json_encode($arrdata); ?>;
var indexfieldid= arrdata.length - 1;
var valinfoid = '';
function popupnew(url, width, height) {
    var leftPosition, topPosition;
    //Allow for borders.
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    //Allow for title and status bars.
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
    //Open the window.
    window.open(url, "Window2",
    "status=no,height=" + height + ",width=" + width + ",resizable=yes,left="
    + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY="
    + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no");
}


jQuery(document).ready(function() {
    $("#reqSatuanKerja,#reqStatusPegawai,#reqBulan,#reqTipePegawai").change(function() {
       var satuanKerja = cari= bulan=reqTipePegawai=reqStatusPegawai=reqTahunAwal=reqTahunAkhir="";
       var satuanKerja = $("#reqSatuanKerja").val();
      var cari = ''; //$('div.dataTables_filter input').val();
      var bulan = $("#reqBulan").val();
      var reqTipePegawai = $("#reqTipePegawai").val();
      var reqStatusPegawai ="";
      var reqTahunAwal = $("#reqTahunAwal").val();
      var reqTahunAkhir = $("#reqTahunAkhir").val();
      // console.log(reqTipePegawai);
      
      // document.location.href = "admin/index/validator.php?reqBulan="+bulan+'&reqTahun='+tahun+"&reqValidasi="+$("#reqValidasi").val()+"&reqSatuanKerja="+satuanKerja;

      jsonurl= "json-admin/rekap_json/json_pegawai?reqTipePegawai="+reqTipePegawai+"&reqStatusPegawai="+reqStatusPegawai+"&reqSatuanKerja="+satuanKerja+"&reqTahunAwal="+reqTahunAwal+"&reqTahunAkhir="+reqTahunAkhir;
      // datanewtable.DataTable().filter.reqValidasi = 1;
      // datanewtable.DataTable().draw();
      datanewtable.DataTable().ajax.url(jsonurl).load();
    });

    var jsonurl= "json-admin/rekap_json/json_pegawai?reqBulan=<?=$reqBulan?>&reqTahun=<?=$reqTahun?>&reqValidasi=<?=$reqValidasi?>&reqSatuanKerja=<?=$reqSatuanKerja?>&reqTahunAwal=<?=$tahunawal?>&reqTahunAkhir=<?=$tahunakhir?>";
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

    $("#reqExcel").click(function() {
        var satuanKerja = cari= bulan=reqTipePegawai=reqStatusPegawai=reqTahunAwal=reqTahunAkhir="";
        var satuanKerja = $("#reqSatuanKerja").val();
        var cari =  $('div.dataTables_filter input').val();
        var bulan = $("#reqBulan").val();
        var reqTipePegawai = $("#reqTipePegawai").val();
        var reqStatusPegawai ="";
        var reqTahunAwal = $("#reqTahunAwal").val();
        var reqTahunAkhir = $("#reqTahunAkhir").val();

        urlExcel= "admin/loadUrl/admin/export_pensiun?reqTipePegawai="+reqTipePegawai+"&reqStatusPegawai="+reqStatusPegawai+"&reqSatuanKerja="+satuanKerja+"&reqCari="+cari+"&reqTahunAwal="+reqTahunAwal+"&reqTahunAkhir="+reqTahunAkhir;
        newWindow = window.open(urlExcel, 'Cetak');
        newWindow.focus();
    });

    $("#reqProses").click(function() {
        var satuanKerja = cari= bulan=reqTipePegawai=reqStatusPegawai=reqTahunAwal=reqTahunAkhir="";
        var satuanKerja = $("#reqSatuanKerja").val();
        var cari =  $('div.dataTables_filter input').val();
        var bulan = $("#reqBulan").val();
        var reqTipePegawai = $("#reqTipePegawai").val();
        var reqStatusPegawai ="";
        var reqTahunAwal = $("#reqTahunAwal").val();
        var reqTahunAkhir = $("#reqTahunAkhir").val();
         // console.log(reqTahunAwal);return false;

         jsonurl= "json-admin/rekap_json/json_pegawai?reqTipePegawai="+reqTipePegawai+"&reqTahunAwal="+reqTahunAwal+"&reqSatuanKerja="+satuanKerja+"&reqTahunAkhir="+reqTahunAkhir;
    
        datanewtable.DataTable().ajax.url(jsonurl).load();
    });

});

function calltriggercari()
{
    $(document).ready( function () {
      $("#triggercari").click();      
    });
}

 $('#reqTahunAwal,#reqTahunAkhir').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  });

</script>