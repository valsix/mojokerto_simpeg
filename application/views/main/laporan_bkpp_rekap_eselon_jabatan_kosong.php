<?php
$reqId= $this->input->get('reqId');


$pgtitle= $pg;
$pgtitle= churuf(str_replace("_", " ", str_replace("master_", "", $pgtitle)));

$arrtabledatath1= array(
     array("label"=>"UNIT KERJA", "field"=> "UNIT_KERJA", "display"=>"",  "width"=>"", "rowspan"=>"2", "colspan"=>"")
    , array("label"=>"JABATAN", "field"=> "NAMA_JABATAN", "display"=>"",  "width"=>"", "rowspan"=>"2", "colspan"=>"")
    , array("label"=>"ESELON", "field"=> "", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"9")
);

$arrtabledatath2= array(
     array("label"=>"IIA", "field"=> "ESELON21", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IIB", "field"=> "ESELON22", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IIIA", "field"=> "ESELON31", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IIIB", "field"=> "ESELON32", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IVA", "field"=> "ESELON41", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IVB", "field"=> "ESELON42", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"VA", "field"=> "ESELON51", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"VB", "field"=> "ESELON52", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
   
);


$arrtabledata= array(
     array("label"=>"UNIT KERJA", "field"=> "UNIT_KERJA", "display"=>"",  "width"=>"", "rowspan"=>"2", "colspan"=>"")
    , array("label"=>"JABATAN", "field"=> "NAMA_JABATAN", "display"=>"",  "width"=>"", "rowspan"=>"2", "colspan"=>"")
    , array("label"=>"IIA", "field"=> "ESELON21", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IIB", "field"=> "ESELON22", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IIIA", "field"=> "ESELON31", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IIIB", "field"=> "ESELON32", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IVA", "field"=> "ESELON41", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"IVB", "field"=> "ESELON42", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"VA", "field"=> "ESELON51", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"VB", "field"=> "ESELON52", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
);



$arrTahun= setTahunLoop(1,2);



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

            <div class="col-md-12">
                <div class="area-filter">
                    <div class="row mb-8">
                        <div class="col-md-6" style="margin-top: 10px">
                            <label>Periode:</label>
                            <select name="reqPeriode" id="reqPeriode" class="form-control">
                              <option value="1">Semester I (1 Januari - 30 Juni)</option>
                              <option value="2">Semester II (1 Juli - 30 Desember)</option>          
                          </select>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px">
                            <label>Tahun:</label>
                            <select name="reqTahun" id="reqTahun" class="form-control">
                              <?
                              for($i=0;$i<count($arrTahun);$i++)
                              {
                                  ?>
                                  <option value="<?=$arrTahun[$i]?>" <? if($reqTahun == $arrTahun[$i]) { ?> selected <? } ?>><?=$arrTahun[$i]?></option>
                                  <?      
                              }
                              ?>    
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
                            foreach($arrtabledatath1 as $valkey => $valitem) 
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

                        <tr>
                            <?php
                            foreach($arrtabledatath2 as $valkeyn => $valitemn) 
                            {
                                $infotablelabel= $valitemn["label"];
                                $infotablecolspan= $valitemn["colspan"];
                                $infotablerowspan= $valitemn["rowspan"];
                                $infowidth= $valitemn["width"];

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
    var jsonurl= "json-main/report_json/json_rekap_eselon_kosong?reqId=<?=$reqId?>";
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

    $("#btnCetak").on("click", function () {
        reqPeriode= $("#reqPeriode").val();
        reqTahun= $("#reqTahun").val();
        varurl= "json-main/cetak_report_json/eselon_kosong?reqPeriode="+reqPeriode+"&reqTahun="+reqTahun;
        // window.open(varurl, 'window name', 'window settings');
        window.open(varurl, '_blank');
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