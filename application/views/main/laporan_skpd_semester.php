<?php
$reqId= $this->input->get('reqId');


$pgtitle= $pg;
$pgtitle= churuf(str_replace("_", " ", str_replace("master_", "", $pgtitle)));


$arrtabledata= array(
     array("label"=>"Gol.Ruang", "field"=> "KODE", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"Jenis Kelamin", "field"=> "TOTAL_KELAMIN", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"Status Perkawinan", "field"=> "TOTAL_KAWIN", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"Agama", "field"=> "AGAMA", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
    , array("label"=>"Pendidikan", "field"=> "SEKOLAH", "display"=>"",  "width"=>"", "rowspan"=>"", "colspan"=>"")
);



$arrTahun= setTahunLoop(1,2);

$arrsatkertree= $this->sesstree;
$arrsatkerdata= $this->sessdatatree;

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
                     <button class="btn btn-light-primary" onclick="showhidesatker()" style="margin-right:5px" ><i class="fa fa-sitemap" aria-hidden="true"></i> Satker</button>

                    <div id="divcarisatuankerja" style="display: none; position: absolute; z-index: 1; top: 60px; right: 30px; background-color: #FFFFFF; border: 1px solid #ebedf3; padding: 15px; border-radius: 0.42rem; ">
                        <label><i>Ketikkan nama satker...</i> </label>
                        <div class="clearfix"></div>
                        <select class="form-control" id="reqSatkerId" style="width:56em">
                            <option value=""></option>
                        </select>
                    </div> 

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
    var jsonurl= "json-main/report_json/json_skpd_semester?reqId=<?=$reqId?>";
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

    $("#reqPeriode").change(function() { 
        jsonurl= "json-main/report_json/json_skpd_semester?reqSatkerId=<?=$reqId?>&reqPeriode=" + $("#reqPeriode").val()+"&reqTahun=" + $("#reqTahun").val();
        datanewtable.DataTable().ajax.url(jsonurl).load();
    });

    $("#reqTahun").change(function() { 
        jsonurl= "json-main/report_json/json_skpd_semester?reqSatkerId=<?=$reqId?>&reqPeriode=" + $("#reqPeriode").val()+"&reqTahun=" + $("#reqTahun").val();
        datanewtable.DataTable().ajax.url(jsonurl).load();
    });

    $("#btnCetak").on("click", function () {
        reqPeriode= $("#reqPeriode").val();
        reqTahun= $("#reqTahun").val();
        reqSatkerId= $("#reqSatkerId").val();
        varurl= "json-main/cetak_report_json/skpd_semester?reqPeriode="+reqPeriode+"&reqTahun="+reqTahun+"&reqSatkerId="+reqSatkerId;
        // window.open(varurl, 'window name', 'window settings');
        window.open(varurl, '_blank');
    }); 


    $("#reqSatkerId").change(function() { 
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

    $("#triggercari").on("click", function () {
        if(carijenis == "1")
        {
            pencarian= $('#'+infotableid+'_filter input').val();
            datanewtable.DataTable().search( pencarian ).draw();
        }
        else
        {
            reqSatkerId= $("#reqSatkerId").val();

            jsonurl= "json-main/report_json/json_skpd_semester?reqSatkerId="+reqSatkerId;
            datanewtable.DataTable().ajax.url(jsonurl).load();
        }
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

function showhidesatker() 
{
    var x = document.getElementById("divcarisatuankerja");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}



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