<?php
$adminusergroupid= $this->adminusergroupid;
$adminuserpegawaiid= $this->adminuserpegawaiid;

$menukhususadmin= "";
if($adminusergroupid == 1 && empty($adminuserpegawaiid))
{
    $menukhususadmin= "1";
}

$reqId= $this->input->get('reqId');
$hakvalidasi= $this->input->get('v');
$cekquery= $this->input->get('c');

if(empty($reqId)) $reqId= -1;
if(empty($menukhususadmin)) $hakvalidasi= "";
$reqTable= "PANGKAT_RIWAYAT";

$arrtabledata= array(
    array("label"=>"Pangkat", "field"=> "PANGKAT_ID", "display"=>"",  "width"=>"")
    , array("label"=>"TMT Pangkat", "field"=> "TMT_PANGKAT", "display"=>"",  "width"=>"")
    , array("label"=>"No. Nota", "field"=> "NO_NOTA", "display"=>"",  "width"=>"")
    , array("label"=>"Tgl. Nota", "field"=> "TANGGAL_NOTA", "display"=>"",  "width"=>"")
    , array("label"=>"No. SK", "field"=> "NO_SK", "display"=>"",  "width"=>"")
    , array("label"=>"Tgl. SK", "field"=> "TANGGAL_SK", "display"=>"",  "width"=>"")
    , array("label"=>"Pejabat Penetap", "field"=> "PEJABAT_PENETAP", "display"=>"",  "width"=>"")
    , array("label"=>"Jenis KP", "field"=> "NMJENIS", "display"=>"",  "width"=>"")
    , array("label"=>"Kredit", "field"=> "KREDIT", "display"=>"",  "width"=>"")
    , array("label"=>"Masa Kerja", "field"=> "MASA_KERJA", "display"=>"",  "width"=>"")
    , array("label"=>"Keterangan", "field"=> "KETERANGAN", "display"=>"",  "width"=>"")

    , array("label"=>"vperubahandata", "field"=> "PERUBAHAN_DATA", "display"=>"1",  "width"=>"")
    , array("label"=>"validasihapusid", "field"=> "TEMP_VALIDASI_HAPUS_ID", "display"=>"1", "width"=>"")
    , array("label"=>"validasiid", "field"=> "TEMP_VALIDASI_ID", "display"=>"1", "width"=>"")
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PANGKAT_RIWAYAT_ID", "display"=>"1", "width"=>"")
);
?>

<!-- SELECT2 -->
<link href="lib/select2totreemaster/src/select2totree.css" rel="stylesheet">
<script src="lib/select2/select2.min.js"></script>
<script src="lib/select2totreemaster/src/select2totree.js"></script>

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Data Pegawai</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Riwayat Pangkat</a>
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
                    <h3 class="card-label">Riwayat Pangkat</h3>
                </div>
                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline mr-2">

                        <?
                        if(!empty($hakvalidasi))
                        {
                        ?>
                            <button class="btn btn-light-warning" id="btnUbahData"><i class="fa fa-pen" aria-hidden="true"></i> Validasi</button>
                        <?
                        }
                        else
                        {
                        ?>
                        	<button class="btn btn-light-primary" id="btnAdd"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
    	            		<button class="btn btn-light-warning" id="btnUbahData"><i class="fa fa-pen" aria-hidden="true"></i> Edit</button>
    	            		<button class="btn btn-light-danger" id="btnDelete"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</button>
                        <?
                        }
                        ?>
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
// console.log(arrdata);
var indexfieldid= arrdata.length - 1;
var indexvalidasiid= arrdata.length - 3;
var indexvalidasihapusid= arrdata.length - 4;
var valinfoid = '';
var valinfovalidasiid = '';
var valinfovalidasihapusid = '';

infocolormode= 'validasi';
indexperubahandata= arrdata.length - 5;

jQuery(document).ready(function() {
    var jsonurl= "json-validasi/riwayat_pangkat_json/json?reqId=<?=$reqId?>&c=<?=$cekquery?>";
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

        if (valinfovalidasihapusid == null)
        {
            valinfovalidasihapusid = '';
        }
        
    });

    <?
    if(empty($hakvalidasi))
    {
    ?>
    $('#btnDelete').on('click', function (e) {
        if(valinfoid == "")
        {
            Swal.fire({
                text: "Pilih salah satu data Riwayat terlebih dahulu.",
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

            reqStatus= 1;
            if(valinfovalidasiid !== "") reqStatus= "";
            else if(valinfovalidasihapusid !== "") reqStatus= 2;

            vrowid= valinfovalidasiid;
            if(reqStatus == 1 || reqStatus == 2) vrowid= valinfoid;

            urlAjax= "json-validasi/general/hapusdata?reqRowId="+vrowid+"&reqTable=<?=$reqTable?>&reqPegawaiId=<?=$reqId?>&reqStatus="+reqStatus;
            // console.log(urlAjax);return false;
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
                                // position: 'top-right',
                                icon: "success",
                                type: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                document.location.href = "personal/index/riwayat_pangkat?reqId=<?=$reqId?>";
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
    <?
    }
    ?>

    $('#'+infotableid+' tbody').on( 'dblclick', 'tr', function () {
      $("#btnUbahData").click();    
    });

    $("#btnAdd, #btnUbahData").on("click", function () {
        btnid= $(this).attr('id');

        if(valinfoid == "" && btnid == "btnUbahData")
        {
            Swal.fire({
                text: "Pilih salah satu data Riwayat terlebih dahulu.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                }
            });
            return false;
        }

        varurl= "personal/index/riwayat_pangkat_add?reqId=<?=$reqId?>";
        if(btnid == "btnUbahData")
        {
            if(valinfovalidasiid !== "")
                varurl+= "&reqValId="+valinfovalidasiid;
            else
                varurl+= "&reqRowId="+valinfoid;
        }
        else
        {
            varurl+= "&reqRowId=baru";
        }

        <?
        if(!empty($hakvalidasi))
        {
        ?>
            reqStatus= 1;
            if(valinfovalidasiid !== "") reqStatus= "";
            else if(valinfovalidasihapusid !== "") reqStatus= 2;

            // console.log(valinfovalidasiid+"&&"+valinfovalidasihapusid+";"+reqStatus);return false;
            varurl+= "&v=<?=$hakvalidasi?>";
            if(reqStatus == "1")
            {
                Swal.fire({
                    text: "Pilih salah satu data riwayat, yang perlu di validasi terlebih dahulu.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                });
                return false;
            }
        <?
        }
        ?>

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