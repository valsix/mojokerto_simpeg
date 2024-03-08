<?php
include_once("functions/date.func.php");

$reqFormulaPenilaianId= $this->input->get("reqFormulaPenilaianId");
$reqTipePegawaiId= $this->input->get("reqTipePegawaiId");
$reqPangkatId= $this->input->get("reqPangkatId");
$reqEselonId= $this->input->get("reqEselonId");
$reqSatuanKerja= $this->input->get("reqSatuanKerja");
$reqSatuanKerjaEs2= $this->input->get("reqSatuanKerjaEs2");
$reqKuadranId= $this->input->get("reqKuadranId");

$arrtabledata= array(
    array("label"=>"Nama", "field"=> "NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"NIP Baru", "field"=> "NIP_BARU", "display"=>"",  "width"=>"")
    , array("label"=>"Gol. Ruang", "field"=> "PANGKAT_INFO", "display"=>"",  "width"=>"")
    , array("label"=>"Eselon", "field"=> "ESELON_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Jabatan", "field"=> "LAST_JABATAN", "display"=>"",  "width"=>"")
    , array("label"=>"Unit Kerja", "field"=> "SATKER_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Potensi", "field"=> "NILAI_X", "display"=>"",  "width"=>"")
    , array("label"=>"Kinerja", "field"=> "NILAI_Y", "display"=>"",  "width"=>"")
    , array("label"=>"Kuadran", "field"=> "KODE_KUADRAN", "display"=>"",  "width"=>"")

    // untuk dua ini kunci, data akhir id, data sebelum akhir untuk order
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"statusberlaku", "field"=> "STATUS_BERLAKU", "display"=>"1", "width"=>"")
    , array("label"=>"satuankerjaid", "field"=> "SATKER_ID", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"")
);
?>

<div class="d-flex flex-column-fluid">
    <div class="container">

        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-notepad text-primary"></i>
                    </span>
                    <h3 class="card-label">Lookup Sesuai pilihan kuadran</h3>
                </div>
                <div class="card-toolbar">

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
var datainforesponsive= datainfofilter= datainfolengthchange=  "1";

jQuery(document).ready(function() {

    vurl= "?reqFormulaPenilaianId=<?=$reqFormulaPenilaianId?>&reqTipePegawaiId=<?=$reqTipePegawaiId?>&reqPangkatId=<?=$reqPangkatId?>&reqEselonId=<?=$reqEselonId?>&reqSatuanKerja=<?=$reqSatuanKerja?>&reqSatuanKerjaEs2=<?=$reqSatuanKerjaEs2?>&reqKuadranId=<?=$reqKuadranId?>";

    var jsonurl= "json-data/info_admin_json/jsonformulapenilaiankuadranpegawai"+vurl;
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

});

function calltriggercari()
{
    $(document).ready( function () {
      $("#triggercari").click();      
    });
}
</script>