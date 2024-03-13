<?php
$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;

if(!empty($userpegawaimode) && !empty($adminuserid))
    $reqPegawaiId= $userpegawaimode;
else
    $reqPegawaiId= $this->pegawaiId;

$formulaid= $this->input->get('formulaid');

$arrtabledata= array(
    array("label"=>"NIP", "field"=> "NIP_LAMA", "display"=>"",  "width"=>"")
    , array("label"=>"NIP Baru", "field"=> "NIP_BARU", "display"=>"",  "width"=>"")
    , array("label"=>"Nama", "field"=> "NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Tempat Lahir", "field"=> "TEMPAT_LAHIR", "display"=>"",  "width"=>"")
    , array("label"=>"Tanggal Lahir", "field"=> "TANGGAL_LAHIR", "display"=>"",  "width"=>"")
    , array("label"=>"L/P", "field"=> "JENIS_KELAMIN", "display"=>"",  "width"=>"")
    , array("label"=>"Status", "field"=> "STATUS_PEGAWAI", "display"=>"",  "width"=>"")
    , array("label"=>"Gol.Ruang", "field"=> "GOL_RUANG", "display"=>"",  "width"=>"")
    // , array("label"=>"Eselon", "field"=> "ESELON_ID", "display"=>"",  "width"=>"")

    , array("label"=>"Warna", "field"=> "WARNA", "display"=>"1",  "width"=>"")
    , array("label"=>"validasiid", "field"=> "TEMP_VALIDASI_HAPUS_ID", "display"=>"1", "width"=>"")
    , array("label"=>"validasihapusid", "field"=> "TEMP_VALIDASI_ID", "display"=>"1", "width"=>"")
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "RIWAYAT_DIKLAT_TEKNIS_ID", "display"=>"1", "width"=>"")
);
?>

<!-- SELECT2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
<link href="lib/select2totreemaster/src/select2totree.css" rel="stylesheet">
<!-- <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="lib/select2totreemaster/src/select2totree.js"></script>

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Pegawai</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Monitoring Pegawai</a>
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
                                    <a id="btnAdd" class="navi-link">
                                        <span class="navi-icon"><i class="la la-plus"></i></span>
                                        <span class="navi-text">Tambah</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a id="btnUbahData" class="navi-link">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Ubah</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a id="btnUbahData" class="navi-link">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Log</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  id="btnDelete" class="navi-link">
                                        <span class="navi-icon"><i class="la la-trash"></i></span>
                                        <span class="navi-text">Hapus</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a id="btnUbahData" class="navi-link">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Mutasi</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a id="btnUbahData" class="navi-link">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Cetak</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a id="btnUbahData" class="navi-link">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Cari</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- <button class="btn btn-light-primary" onclick="myFunction()"><i class="fa fa-sitemap" aria-hidden="true"></i> Satker</button> -->
                </div>
            </div>

            <div class="card-body">
                <div class="card-title">
                    <h3 class="card-label">Filter</h3>
                </div>
                <div class="row">                        
                    <div class="col-md-2">
                        Satker
                    </div>
                    <div class="col-md-10">
                        <!-- <select id="sel_1" style="width:100%" multiple></select> -->
                    </div>
                    <div class="col-md-2" style="margin-top:20px">
                        Status Pegawai
                    </div>
                    <div class="col-md-4" style="margin-top:20px">
                        <select id='filter'>
                            <option value='AND STATUS_PEGAWAI = 0'>Usulan</option>
                            <option value='AND (STATUS_PEGAWAI = 1 OR STATUS_PEGAWAI = 2)' selected='selected'>CPNS / PNS</option>
                            <option value='AND STATUS_PEGAWAI = 1'>CPNS</option>
                            <option value='AND STATUS_PEGAWAI = 2'>PNS</option>
                            <option value='AND STATUS_PEGAWAI = 12'>PPPK</option>
                            <option value='AND STATUS_PEGAWAI = 3'>Pensiun</option>
                            <option value='AND STATUS_PEGAWAI = 4'>TNI</option>
                            <option value='AND (STATUS_PEGAWAI = 5 OR STATUS_PEGAWAI = 6)'>Tewas / Wafat</option>
                            <option value='AND STATUS_PEGAWAI = 7'>Pindah</option>
                            <option value='AND STATUS_PEGAWAI = 8'>Diberhentikan dengan hormat</option>
                            <option value='AND STATUS_PEGAWAI = 9'>Diberhentikan tidak dengan hormat</option>
                            <option value='AND STATUS_PEGAWAI = 10'>Pensiun BUP</option>
                            <option value='AND STATUS_PEGAWAI = 11'>Pensiun Dini</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="margin-top:20px">
                        Hukuman
                    </div>
                    <div class="col-md-4" style="margin-top:20px">
                        <select id='reqStatusHukuman'>
                            <option></option>
                            <option value='1'>Masih Berlaku</option>
                        </select>
                    </div>
                </div>
                <br>
                <br>
                <div class="card-title">
                    <h3 class="card-label">Data Pegawai</h3>
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

<div style="height:0px;overflow:hidden">
    <form id="ktloginform" method="POST" enctype="multipart/form-data" autocomplete="off">
        <input type="file" id="reqLinkFileSk" name="reqLinkFileSk" accept=".pdf" onchange="submitForm();"/>
        <input type="file" id="reqLinkFileStlud" name="reqLinkFileStlud" accept=".pdf" onchange="submitForm();"/>
        <input type="hidden" id="reqDetilId" name="reqDetilId" />
        <input type="hidden" id="reqPegawaiId" name="reqPegawaiId" />
        <input type="hidden" id="reqRowId" name="reqRowId" />
        <button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
    </form>
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
    var jsonurl= "json-main/pegawai_json/json";
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
            urlAjax= "json-data/info_data_json/jsondiklatteknisdelete?&reqDetilId="+valinfoid;
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
                                position: 'top-right',
                                icon: "success",
                                type: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                document.location.href = "app/index/pegawai_diklat_teknis?formulaid=<?=$formulaid?>";
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

        if(btnid == "btnUbahData")
            vpilihid= valinfoid;
        else
            vpilihid= "";

        // varurl= "app/index/pegawai_diklat_teknis_add?formulaid=<?=$formulaid?>&reqRowId="+vpilihid;
        varurl= "app/index/pegawai_data_fip?formulaid=<?=$formulaid?>&reqRowId="+vpilihid;
        
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

var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';

jQuery(document).ready(function(){
    jQuery('#ktloginform').submit(function(event){ 
        event.preventDefault();
           var formData = new FormData(document.querySelector('form'));
           var form = KTUtil.getById('ktloginform');
           var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
                KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
               $.ajax({
                url: 'json-data/info_data_json/jsondiklatteknisupload', 
                dataType: 'json', 
                cache: false,
                contentType: false,
                processData: false,
                data: formData,                         
                type: 'POST',
                beforeSend: function() {
                    swal.fire({
                        title: 'Mohon tunggu sebentar..',
                        text: 'File sedang dalam proses upload..',
                        onOpen: function() {
                            swal.showLoading()
                        }
                    })
                },
                success: function (response) {
                // console.log(response); return false;
                Swal.fire({
                    text: response.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                    }).then(function() {
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    Swal.fire("Error", err.message, "error");
                   
                },
                complete: function () {
                    KTUtil.btnRelease(formSubmitButton);
                }
            });   
       }); 
});

function btnUploadSk(reqPegawaiId,reqRowId)
{
    $("#reqLinkFileSk").click();
    $('#reqPegawaiId').val(reqPegawaiId);
    $('#reqRowId').val(reqRowId);
}

function btnUploadStlud(reqPegawaiId,reqRowId)
{
    $("#reqLinkFileStlud").click();
    $('#reqPegawaiId').val(reqPegawaiId);
    $('#reqRowId').val(reqRowId);
}


function btnDeleteFile (fileid,reqPegawaiId,reqRowId,reqMode) {
    if(fileid !== "")
    {
        urlAjax= "json-data/info_data_json/jsondiklatteknisdeletefile?reqFileId="+fileid+"&reqPegawaiId="+reqPegawaiId+"&reqRowId="+reqRowId+"&reqMode="+reqMode;
        swal.fire({
            title: 'Apakah anda yakin untuk hapus file?',
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
                            location.reload();
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
}
   var mydata = [
       {id:1, text:"Sekretariat Daerah", inc:[
            {id:11, text:"ASISTEN PEREKONOMIAN & PEMBANGUNAN", inc:[
                {id:11, text:"ASISTEN PEREKONOMIAN & PEMBANGUNAN"},
                {id:12, text:"ASISTEN TATA PEMERINTAHAN & KESRA"},
                {id:13, text:"ASISTEN ADMINISTRASI UMUM"},
                {id:14, text:"STAF AHLI BID. HUKUM & POLITIK"},
                {id:15, text:"STAF AHLI BID PEMBANGUNAN"},
                {id:16, text:"STAF AHLI BID. KEMASYARAKATAN & SUMBER DAYA MANUSIA"}
            ]},
            {id:12, text:"ASISTEN TATA PEMERINTAHAN & KESRA"},
            {id:13, text:"ASISTEN ADMINISTRASI UMUM"},
            {id:14, text:"STAF AHLI BID. HUKUM & POLITIK"},
            {id:15, text:"STAF AHLI BID PEMBANGUNAN"},
            {id:16, text:"STAF AHLI BID. KEMASYARAKATAN & SUMBER DAYA MANUSIA"}
       ]},
       {id:2, text:"Badan Lingkungan Hidup"},
       {id:3, text:"Badan Pelayanan Perizinan"},
       {id:3, text:"Badan Pelayanan Perizinan Test kalimat panjang sekali"}
    ];
    $("#sel_1").select2ToTree({
        treeData: {dataArr: mydata}, 
        maximumSelectionLength: 1,
        // placeholder: 'Select an option',
        placeholder: "pilih satker",
        // allowClear: true
    });

    $("#filter,#reqStatusHukuman").change(function() { 

        jsonurl= "json-main/pegawai_json/json?reqStatusHukuman=" + $("#reqStatusHukuman").val() + "&reqSearch=" + $("#filter").val() + "&reqId=<?=$reqId?>";
        // jsonurl= "json-admin/export_json/jsonpegawaidiklat?reqBulan="+reqBulan+"&reqTahun="+reqTahun;
        datanewtable.DataTable().ajax.url(jsonurl).load();
    })
</script>
                