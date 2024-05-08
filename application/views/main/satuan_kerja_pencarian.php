<?php
$reqId= $this->input->get('reqId');


$pgtitle= $pg;
$pgtitle= churuf(str_replace("_", " ", str_replace("master_", "", $pgtitle)));

$arrtabledata= array(
     array("label"=>"No", "field"=> "NO", "display"=>"",  "width"=>"5")
    , array("label"=>"Satuan Kerja Detil", "field"=> "SATKER", "display"=>"",  "width"=>"")
    , array("label"=>"Satuan Kerja", "field"=> "NAMA", "display"=>"",  "width"=>"")
   
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "SATKER_ID", "display"=>"1", "width"=>"")
);


?>


<head>
    <base href="<?=base_url()?>">
    <meta charset="utf-8" />
    <title>SIMPEG 2024</title>
    <meta name="description" content="User profile block example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/jstree/jstree.bundle.css" rel="stylesheet" type="text/css" />

    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/brand/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/aside/light.css" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="assets/media/logos/favicon.png" />
    <link href="assets/css/new-style.css" rel="stylesheet" type="text/css" />
    
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>

    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="assets/js/valsix-serverside.js"></script>
    <script src="assets/plugins/custom/jstree/jstree.bundle.js"></script>

    <script src="lib/highcharts/highcharts-spider.js"></script>
    <script src="lib/highcharts/highcharts-more.js"></script>
    <script src="lib/highcharts/exporting-spider.js"></script>
    <script src="lib/highcharts/export-data.js"></script>
    <script src="lib/highcharts/accessibility.js"></script>

    <style type="text/css">
        .brand {
            padding-left: 0px;
        }
        .card.card-custom {
          margin-top: 0%;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="assets/css/gaya.css">
</head>

<!-- SELECT2 -->
<!-- <link href="lib/select2/select2.min.css" rel="stylesheet"> -->
<link href="lib/select2totreemaster/src/select2totree.css" rel="stylesheet">
<script src="lib/select2/select2.min.js"></script>
<script src="lib/select2totreemaster/src/select2totree.js"></script>

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
	            		<button class="btn btn-light-primary" id="btnUbahData"><i class="fa fa-check" aria-hidden="true"></i> Pilih</button>
	            	
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
    var jsonurl= "json-main/satuan_kerja_json/json_pencarian?reqId=<?=$reqId?>";
    ajaxserverselectsingle.init(infotableid, jsonurl, arrdata);

   

});


$(document).ready(function() {
    var table = $('#example').DataTable();

    $('#example tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');

            var dataselected= datanewtable.DataTable().row(this).data();
            fieldinfoid= arrdata[indexfieldid]["field"];
            valinfoid= dataselected[fieldinfoid];

        }
    } );

    $('#'+infotableid+' tbody').on( 'dblclick', 'tr', function () {
        var dataselected= datanewtable.DataTable().row(this).data();
            // console.log(dataselected);
            parent.setSatker(dataselected);
            top.closePopup();
        });

    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );
} );

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