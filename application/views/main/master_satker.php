<?


?>


<style type="text/css">
    .menu-text {
        height: auto;
        line-height: normal;
    }
    .menu-item {
        border-width: inherit;
        border-style: inherit;
    }

    #jabatanstruktural.modal-body #kt_subheader.subheader.py-2.py-lg-6.subheader-solid {
        display: none;
    }

    #jabatanstrukturalmodal .modal-dialog.modal-dialog-centered.modal-xl {
        max-width: inherit;
        width: calc(100vw - 60px);
    }
    #jabatanstruktural .panel.datagrid.easyui-fluid {
        width: 100% !important;
        height: calc(100vh - 350px) !important;
    }
    #jabatanstruktural .panel.datagrid.easyui-fluid .datagrid-wrap.panel-body.panel-body-noheader {
        width: 100% !important;
        height: 100% !important;
    }
    #jabatanstruktural .panel.datagrid.easyui-fluid .datagrid-wrap.panel-body.panel-body-noheader .datagrid-view ,
    #jabatanstruktural .panel.datagrid.easyui-fluid .datagrid-wrap.panel-body.panel-body-noheader .datagrid-view .datagrid-view2 ,
    #jabatanstruktural .panel.datagrid.easyui-fluid .datagrid-wrap.panel-body.panel-body-noheader .datagrid-view .datagrid-view2 .datagrid-body {
        height: 100% !important;   
    }

    /*========================*/
    #approval.modal-body #kt_subheader.subheader.py-2.py-lg-6.subheader-solid {
        display: none;
    }

    #approvalmodal .modal-dialog.modal-dialog-centered.modal-xl {
        max-width: inherit;
        width: calc(100vw - 60px);
    }
    #approval .panel.datagrid.easyui-fluid {
        width: 100% !important;
        height: calc(100vh - 350px) !important;
    }
    #approval .panel.datagrid.easyui-fluid .datagrid-wrap.panel-body.panel-body-noheader {
        width: 100% !important;
        height: 100% !important;
    }
    #approval .panel.datagrid.easyui-fluid .datagrid-wrap.panel-body.panel-body-noheader .datagrid-view ,
    #approval .panel.datagrid.easyui-fluid .datagrid-wrap.panel-body.panel-body-noheader .datagrid-view .datagrid-view2 ,
    #approval .panel.datagrid.easyui-fluid .datagrid-wrap.panel-body.panel-body-noheader .datagrid-view .datagrid-view2 .datagrid-body {
        height: 100% !important;   
    }
</style>

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Master Data</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Satker</a>
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
                    <h3 class="card-label">Satuan Kerja</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <button type="button" id="tambah"  class="btn btn-success font-weight-bold mr-2">Tambah Data</button>
                    <div class="dropdown dropdown-inline mr-2" style="display: none">
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
                                        <span class="navi-text">Bobot</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

          

            <div class="card-body">
                <table id="tt" class="easyui-treegrid" style="width:100%; min-height:350px">
                    <thead>
                        <tr>
                            <th field="NAMA_FULL" width="50%">Nama</th>
                            <th field="SIFAT" width="30%">Sifat</th>
                            <th field="ESELON" width="10%">Eselon</th>
                            <th field="LINK_URL_INFO" width="10%" align="center">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
</div>

<a href="#" id="triggercari" style="display:none" title="triggercari">triggercari</a>
<script type="text/javascript">

function reloadsave(id)
{
    selectedNodeId= id;
    var tg = $('#tt');
    // tg.treegrid('expand', selectedNodeId);
    tg.treegrid('reload', selectedNodeId);
    // console.log(selectedNodeId);
}

function adddata(reqId)
{
    vurl= "app/loadUrl/app/master_satker_add?reqId="+reqId;
    // console.log(vurl);
    $('#approvalmodal').modal('show');
    $("#approval").load(vurl);
}

function openurl(varurl)
{
    document.location.href = varurl;
}

$("#tambah").on("click", function () {
    varurl= "app/index/master_satker_add?reqId=0&reqMode=insert";

    document.location.href = varurl;
});



$(function(){

    var tt = $('#tt').treegrid({
        url: 'json-main/satuan_kerja_json/tree_master',
        rownumbers: false,
        pagination: false,
        idField: 'ID',
        treeField: 'NAMA_FULL',
        onBeforeLoad: function(row,param){
        if (!row) { // load top level rows
        param.id = 0; // set id=0, indicate to load new page rows
        }
        }
    });
});
</script>