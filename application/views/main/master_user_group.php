<?php
$reqId= $this->input->get('reqId');


$pgtitle= $pg;
$pgtitle= churuf(str_replace("_", " ", str_replace("master_", "", $pgtitle)));

$arrtabledata= array(
    array("label"=>"No", "field"=> "NO", "display"=>"",  "width"=>"5")
    , array("label"=>"Nama", "field"=> "NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Lihat Proses", "field"=> "LIHAT_PROSES", "display"=>"",  "width"=>"")
    , array("label"=>"Pegawai Proses", "field"=> "PEGAWAI_PROSES", "display"=>"",  "width"=>"")
    , array("label"=>"DUK Proses", "field"=> "DUK_PROSES", "display"=>"",  "width"=>"")
    , array("label"=>"KGB Proses", "field"=> "KGB_PROSES", "display"=>"",  "width"=>"")
    , array("label"=>"KP Proses", "field"=> "KP_PROSES", "display"=>"",  "width"=>"")
    , array("label"=>"Pensiun Proses", "field"=> "PENSIUN_PROSES", "display"=>"",  "width"=>"")
    , array("label"=>"Anjab Proses", "field"=> "ANJAB_PROSES", "display"=>"",  "width"=>"")
    , array("label"=>"Mutasi Proses", "field"=> "MUTASI_PROSES", "display"=>"",  "width"=>"")
    , array("label"=>"Hukuman Proses", "field"=> "HUKUMAN_PROSES", "display"=>"",  "width"=>"")
    , array("label"=>"Master Proses", "field"=> "MASTER_PROSES", "display"=>"",  "width"=>"")
    , array("label"=>"Bidang Pembinaan dan Pengembangan Aparatur", "field"=> "BIDANG_PEMBINAAN", "display"=>"",  "width"=>"")
    , array("label"=>"Bidang Dokumentasi dan Informasi", "field"=> "BIDANG_DOKUMENTASI", "display"=>"",  "width"=>"")
    , array("label"=>"Bidang Pendidikan dan Pelatihan", "field"=> "BIDANG_PENDIDIKAN", "display"=>"",  "width"=>"")
    , array("label"=>"Bidang Mutasi", "field"=> "BIDANG_MUTASI", "display"=>"",  "width"=>"")
   
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "USER_GROUP_ID", "display"=>"1", "width"=>"")
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
                    	<button class="btn btn-light-primary" id="btnAdd"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
	            		<button class="btn btn-light-warning" id="btnUbahData"><i class="fa fa-pen" aria-hidden="true"></i> Edit</button>
	            		<button class="btn btn-light-danger" id="btnDelete"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</button>
	            	
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

jQuery(document).ready(function() {
    var jsonurl= "json-main/user_group_json/json?reqId=<?=$reqId?>";
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
            urlAjax= "json-main/user_group_json/delete?reqId="+valinfoid;
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
                                position: 'center',
                                icon: "success",
                                type: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                document.location.href = "app/index/master_user_group";
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

        varurl= "app/index/user_group_add?reqId="+vpilihid;
        
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