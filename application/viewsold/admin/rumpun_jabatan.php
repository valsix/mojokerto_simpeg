<?
$this->load->model("base-data/RumpunJabatan");
$set= new RumpunJabatan();
$arrperusahaanperaturan= [];
$set->selectparam(array(), -1,-1, "", "");
// echo $set->query;exit;
while($set->nextRow())
{
    $arrdata= [];
    $arrdata["id"]= $set->getField("RUMPUN_ID");
    $arrdata["text"]= $set->getField("NAMA");
    $arrdata["keterangan"]= $set->getField("Definisi");
    array_push($arrperusahaanperaturan, $arrdata);
}
unset($set);
$reqPerusahaanPeraturanId= $arrperusahaanperaturan[0]["id"];
// print_r($arrperusahaanperaturan);exit;
?>
<link rel="stylesheet" type="text/css" href="lib/jquery-easyui-1.4.2/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="lib/jquery-easyui-1.4.2/themes/icon.css">

<script type="text/javascript" src="lib/jquery-easyui-1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="lib/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
<!-- <link href="assets/plugins/custom/jstree/jstree.bundle.css" rel="stylesheet" type="text/css" /> -->

<style type="text/css">
    .menu-text {
        height: auto;
        line-height: normal;
    }
    .menu-item {
        border-width: inherit;
        border-style: inherit;
    }
</style>

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Monitoring</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Rumpun Jabatan</a>
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
                    <h3 class="card-label">Rumpun Jabatan</h3>
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
                                        <span class="navi-icon"><i class="la la-plus-circle"></i></span>
                                        <span class="navi-text">Tambah Data</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a id="btnBobot" class="navi-link">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <!-- <span class="navi-text">Bobot</span> -->
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <!-- <div class="form-group row">
                    <label class="col-form-label text-right col-lg-2 col-sm-12">Peraturan</label>
                    <div class="col-lg-10 col-sm-12">
                        <select name="reqPerusahaanPeraturanId" id="reqPerusahaanPeraturanId" class="form-control datatable-input">
                            <?
                            foreach($arrperusahaanperaturan as $item) 
                            {
                                $selectvalid= $item["id"];
                                $selectvaltext= $item["text"];
                                $selectvalselected= "";

                                if($selectvalid == $reqPerusahaanPeraturanId)
                                    $selectvalselected= "selected";
                            ?>
                                <option value="<?=$selectvalid?>" <?=$selectvalselected?>><?=$selectvaltext?></option>
                            <?
                            }
                            ?>
                        </select>
                    </div>
                </div> -->

                <table id="tt" class="easyui-treegrid" style="width:100%; min-height:350px">
                    <thead>
                        <tr>
                            <th field="NAMA" width="90%">Nama</th>
                            <!-- <th field="DEFINISI">definisi</th> -->
                            <th field="AKSI" width="10%" align="center">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
</div>

<input type="hidden" id="reqPerusahaanId" value="1" />
<a href="#" id="triggercari" style="display:none" title="triggercari">triggercari</a>
<script type="text/javascript">

function adddata(id, mode)
{
    varurl= "app/index/indikator_add?reqId="+id+"&reqMode="+mode;
    // if(id == 0)
    // {
        varurl+= '&reqPerusahaanPeraturanId='+$("#reqPerusahaanPeraturanId").val()+'&reqPerusahaanId='+$("#reqPerusahaanId").val();
    // }

    document.location.href = varurl;
}

function hapusdata(id)
{
    reqPerusahaanPeraturanId= $("#reqPerusahaanPeraturanId").val();
    reqPerusahaanId= $("#reqPerusahaanId").val();

    Swal.fire({
        title: "Apakah anda yakin hapus data?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yakin",
        cancelButtonText: "Batal",
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {

            vurl= "json-admin/rumpun_jabatan_json/delete/?reqId="+id+"&reqPerusahaanPeraturanId="+reqPerusahaanPeraturanId+"&reqPerusahaanId="+reqPerusahaanId;
            $.ajax({'url': vurl,'success': function(response){
                response= JSON.parse(response);
                // console.log(response.PESAN);return false;
                Swal.fire({
                    title: response.PESAN,
                    text: "",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "OK",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function(result) {
                    reloadtree();
                });
            }});
        } else if (result.dismiss === "cancel") {
            Swal.fire(
                "Batal hapus data",
                "",
                "error"
            )
        }
    });
}

function reloadtree()
{
    reqPerusahaanPeraturanId= $("#reqPerusahaanPeraturanId").val();
    reqPerusahaanId= $("#reqPerusahaanId").val();
    vurl= 'json-app/indikator_json/tree?reqPerusahaanId='+reqPerusahaanId+'&reqPerusahaanPeraturanId='+reqPerusahaanPeraturanId;

    $('#tt').treegrid({url:vurl});
}

$(function(){
    $("#btnAdd").on("click", function () {
        btnid= $(this).attr('id');
        adddata("0", "insert");
    });

    $("#btnBobot").on("click", function () {
        btnid= $(this).attr('id');

        varurl= "app/index/indikator_bobot?reqPerusahaanPeraturanId="+$("#reqPerusahaanPeraturanId").val()+'&reqPerusahaanId='+$("#reqPerusahaanId").val();
        document.location.href = varurl;
    });

    $("#reqPerusahaanPeraturanId").change(function() {
        reloadtree();
    });
    
    var tt = $('#tt').treegrid({
        url: 'json-admin/rumpun_jabatan_json/tree?reqPerusahaanId='+$("#reqPerusahaanId").val()+'&reqPerusahaanPeraturanId='+$("#reqPerusahaanPeraturanId").val(),
        rownumbers: false,
        pagination: false,
        idField: 'ID',
        treeField: 'NAMA',
        onBeforeLoad: function(row,param){
        if (!row) { // load top level rows
        param.id = 0; // set id=0, indicate to load new page rows
        }
        }
    });
});
</script>