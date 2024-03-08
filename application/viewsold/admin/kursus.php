<?php
$reqPegawaiId= $this->pegawaiId;
$reqIdOrganisasi = $this->input->get("reqIdOrganisasi"); 
$reqBulan= $this->input->get('reqBulan');
$reqTahun= $this->input->get('reqTahun');
$arrdata= array(
    array("label"=>"Nip", "field"=> "NIP_BARU", "display"=>"",  "width"=>"")
    , array("label"=>"Nama", "field"=> "NAMA_PEGAWAI", "display"=>"",  "width"=>"")
    , array("label"=>"OPD", "field"=> "SATKER_INDUK_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Tipe Kursus", "field"=> "TIPE_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Nama Kursus", "field"=> "NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Lamanya Kursus", "field"=> "LAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Tanggal Kursus", "field"=> "TANGGAL_MULAI", "display"=>"",  "width"=>"")
    , array("label"=>"No.Sertifikat", "field"=> "NO_PIAGAM", "display"=>"",  "width"=>"")
    , array("label"=>"Instansi", "field"=> "INSTANSI_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Institusi Penyelenggara", "field"=> "PENYELENGGARA", "display"=>"",  "width"=>"")
    // untuk dua ini kunci, data akhir id, data sebelum akhir untuk order
    , array("label"=>"validasihapusid", "field"=> "TEMP_VALIDASI_HAPUS_ID", "display"=>"1", "width"=>"")
    , array("label"=>"validasiid", "field"=> "TEMP_VALIDASI_ID", "display"=>"1", "width"=>"")
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "KURSUS_ID", "display"=>"1", "width"=>"")
);

$arrBulan=setBulanLoop();
$arrTahun= setTahunLoop(1,1);
if($reqBulan == "")
    $reqBulan= date("m");
elseif($reqBulan == "x")
    $reqBulan= "";
    
if($reqTahun == "")
    $reqTahun= date("Y");
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
                        <a class="text-muted">Export Data</a>
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
                    <h3 class="card-label">Export Data Kursus</h3>
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
                            <label>Bulan:</label>
                            <select name="reqBulan" id="reqBulan" class="form-control datatable-input">
                                <option value="">Semua</option>
                                <?
                                for($i=0;$i<count($arrBulan);$i++)
                                {
                                    ?>
                                    <option value="<?=$arrBulan[$i]?>" <? if(generateZeroDate($reqBulan, 2) == $arrBulan[$i]) { ?> selected <? } ?>><?=getNameMonth($arrBulan[$i])?></option>
                                    <?    
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-4">
                            <label>&nbsp;</label>
                            <select name="reqTahun" id="reqTahun" class="form-control datatable-input">
                                <option value="">Semua</option>
                                <?
                                for($tahun=0;$tahun < count($arrTahun);$tahun++)
                                {
                                    ?>
                                    <option value="<?=$arrTahun[$tahun]?>" <? if($reqTahun == $arrTahun[$tahun]) echo "selected";?>><?=$arrTahun[$tahun]?></option>
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
var indexvalidasiid= arrdata.length - 3;
// console.log(arrdata);
var indexvalidasihapusid= arrdata.length - 4;
var valinfoid = '';
var valinfovalidasiid = '';
var valinfovalidasihapusid = '';

jQuery(document).ready(function() {

     $("#reqSatuanKerja,#reqValidasi,#reqBulan,#reqTahun").change(function() {
      var cari = ''; 
      var reqBulan= $("#reqBulan").val();
      var reqTahun= $("#reqTahun").val();

      jsonurl= "json-admin/export_json/jsonpegawaikursus?reqBulan="+reqBulan+"&reqTahun="+reqTahun;

      datanewtable.DataTable().ajax.url(jsonurl).load();

    });

    var jsonurl= "json-admin/export_json/jsonpegawaikursus?reqBulan=<?=$reqBulan?>&reqTahun=<?=$reqTahun?>";
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
        fieldvalidasiid= arrdata[indexvalidasiid]["field"]
        fieldvalidasihapusid= arrdata[indexvalidasihapusid]["field"]
        valinfoid= dataselected[fieldinfoid];
        valinfovalidasiid= dataselected[fieldvalidasiid];
        valinfovalidasihapusid= dataselected[fieldvalidasihapusid];
        if (valinfovalidasiid == null)
        {
            valinfovalidasiid = '';
        }
    });

    $("#kt_datatable_filter").hide();

    $("#reqExcel").click(function() {
        var reqBulan= $("#reqBulan").val();
        var reqTahun= $("#reqTahun").val();
        if (reqBulan=="")
        {
            var reqBulan= '<?=$reqBulan?>';
        }
        else if (reqTahun=="")
        {
            var reqTahun= '<?=$reqTahun?>';
        }

        urlExcel= "admin/loadUrl/admin/export_kursus?reqBulan="+reqBulan+"&reqTahun="+reqTahun;
        newWindow = window.open(urlExcel, 'Cetak');
        newWindow.focus();
    });


});

function calltriggercari()
{
    $(document).ready( function () {
      $("#triggercari").click();      
    });
}

</script>