<?php
$reqId= $this->input->get('reqId');


$pgtitle= $pg;
$pgtitle= churuf(str_replace("_", " ", str_replace("master_", "", $pgtitle)));

$arrtabledata= array(
     // array("label"=>"No", "field"=> "NO", "display"=>"",  "width"=>"5", "rowspan"=>"2", "colspan"=>"")
     array("label"=>"UNIT KERJA", "field"=> "NAMA", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"CPNS", "field"=> "", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"Gol I", "field"=> "", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"Gol II", "field"=> "", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"Gol III", "field"=> "", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>">Gol IV", "field"=> "", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"TOTAL", "field"=> "TOT", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")


    , array("label"=>"IA", "field"=> "TOTCPNS_11", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IB", "field"=> "TOTCPNS_12", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IC", "field"=> "TOTCPNS_13", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IIA", "field"=> "TOTCPNS_21", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IIB", "field"=> "TOTCPNS_22", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IIC", "field"=> "TOTCPNS_23", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IIIA", "field"=> "TOTCPNS_31", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IIIB", "field"=> "TOTCPNS_32", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")

    , array("label"=>"JUMLAH", "field"=> "TOTCPNS", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"JUMLAH", "field"=> "TOT_GOL1", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"JUMLAH", "field"=> "TOT_GOL2", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"JUMLAH", "field"=> "TOT_GOL3", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"JUMLAH", "field"=> "TOT_GOL4", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
   
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"fieldid", "field"=> "PANGKAT_ID", "display"=>"1", "width"=>"", "rowspan"=>"", "colspan"=>"")
);


?>

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
                        <a class="text-muted">Master Data</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted"><?=$pgtitle?></a>
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
                    <h3 class="card-label"><?=$pgtitle?></h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                    	<button class="btn btn-light-success" id="btnCetak"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Cetak</button>
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
                                $infotablelabel= $valitem["label"];
                                $infotablecolspan= $valitem["colspan"];
                                $infotablerowspan= $valitem["rowspan"];
                                $infowidth= $valitem["width"];

                                if(!empty($infotablecolspan))
                                {
                                }

                                if(!empty($infotablelabel))
                                {
                                    ?>
                                    <th style="text-align:center; width: <?=$infowidth?>%" colspan='<?=$infotablecolspan?>' rowspan='<?=$infotablerowspan?>'><?=$infotablelabel?></th>
                                    <?
                                }
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
var indexvalidasiid= arrdata.length - 3;
var indexvalidasihapusid= arrdata.length - 4;
var valinfoid = '';
var valinfovalidasiid = '';
var valinfovalidasihapusid = '';


jQuery(document).ready(function() {
    var jsonurl= "json-main/report_json/json_rekap_golongan?reqId=<?=$reqId?>";
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

    $('#'+infotableid+' tbody').on( 'dblclick', 'tr', function () {
      $("#btnUbahData").click();    
    });

    $("#btnAdd, #btnUbahData").on("click", function () {
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

        varurl= "app/index/master_pangkat_add?reqId="+vpilihid;
        
        document.location.href = varurl;
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

});

function calltriggercari()
{
    $(document).ready( function () {
      $("#triggercari").click();      
    });
}

function submitForm() {
   $("#ktloginformsubmitbutton").click(); 
}
</script>