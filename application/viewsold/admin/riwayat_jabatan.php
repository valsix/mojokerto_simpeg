<?php
$reqPegawaiId= $this->pegawaiId;
$reqIdOrganisasi = $this->input->get("reqIdOrganisasi"); 
$arrdata= array(
    array("label"=>"Group", "field"=> "GROUP_NAMA", "display"=>"1",  "width"=>"")
    // , array("label"=>"NIP", "field"=> "NAMA_PEGAWAI", "display"=>"",  "width"=>"")
    // , array("label"=>"Nama Pegawai", "field"=> "NAMA_PEGAWAI", "display"=>"",  "width"=>"")
    , array("label"=>"Jenis Jabatan", "field"=> "JENIS_JABATAN", "display"=>"",  "width"=>"")
    , array("label"=>"Kategori Jabatan", "field"=> "KATEGORI_JABATAN", "display"=>"",  "width"=>"")
    , array("label"=>"Eselon", "field"=> "ESELON_NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"Nama Jabatan", "field"=> "NAMA_FUNGSIONAL", "display"=>"",  "width"=>"")
    , array("label"=>"Bup", "field"=> "BUP", "display"=>"",  "width"=>"")
    , array("label"=>"TMT Jabatan", "field"=> "TMT_JABATAN", "display"=>"",  "width"=>"")
    // untuk dua ini kunci, data akhir id, data sebelum akhir untuk order
    , array("label"=>"validasihapusid", "field"=> "TEMP_VALIDASI_HAPUS_ID", "display"=>"1", "width"=>"")
    , array("label"=>"validasiid", "field"=> "TEMP_VALIDASI_ID", "display"=>"1", "width"=>"")
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_JABATAN_ID", "display"=>"1", "width"=>"")
);
?>
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Data Riwayat</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Jabatan</a>
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
                    <h3 class="card-label">Jabatan</h3>
                </div>

                <div class="modal fade" id="jabatanstrukturalmodal" tabindex="-1" role="dialog" aria-labelledby="jabatanstrukturalmodal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Jabatan Struktural</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="modal-body" id="jabatanstruktural">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="jabatanpelaksanamodal" tabindex="-1" role="dialog" aria-labelledby="jabatanpelaksanamodal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Jabatan Pelaksana</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="modal-body" id="jabatanpelaksana">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="jabatanfungsionalmodal" tabindex="-1" role="dialog" aria-labelledby="jabatanfungsionalmodal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Jabatan Fungsional</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="modal-body" id="jabatanfungsional">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="jabatanfungsionaltambahanmodal" tabindex="-1" role="dialog" aria-labelledby="jabatanfungsionaltambahanmodal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Jabatan Fungsional Tambahan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="modal-body" id="jabatanfungsionaltambahan">
                            </div>
                        </div>
                    </div>
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
                                    <a  class="navi-link" onclick="popupstruktural();"   data-toggle="modal" data-target="#jabatanstrukturalmodal">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Import Struktural</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a  class="navi-link" onclick="popuppelaksana();"  data-toggle="modal" data-target="#jabatanpelaksanamodal">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Import Pelaksana</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link" onclick="popupfungsional();"  data-toggle="modal" data-target="#jabatanfungsionalmodal">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Import Fungsional</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link"  onclick="popuptambahan();" data-toggle="modal" data-target="#jabatanfungsionaltambahanmodal">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Import Fungsional Dengan Tambahan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                        <tr>
                            <?php
                            foreach($arrdata as $valkey => $valitem) 
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
var arrdata= <?php echo json_encode($arrdata); ?>;
var indexfieldid= arrdata.length - 1;
var indexvalidasiid= arrdata.length - 3;
// console.log(indexvalidasiid);
var indexvalidasihapusid= arrdata.length - 4;
var valinfoid = '';
var valinfovalidasiid = '';
var valinfovalidasihapusid = '';

jQuery(document).ready(function() {
    var jsonurl= "json-admin/import_json/jsonpegawaijabatantipe";
    ajaxserverselectsingle.init(infotableid, jsonurl, arrdata,1);

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
        if (dataselected)
        {
            valinfoid= dataselected[fieldinfoid];
            valinfovalidasiid= dataselected[fieldvalidasiid];
            valinfovalidasihapusid= dataselected[fieldvalidasihapusid];
        }
        // console.log(valinfovalidasiid);
        if (valinfovalidasiid == null)
        {
            valinfovalidasiid = '';
        }
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

function popupstruktural()
{
   $('#jabatanstrukturalmodal').modal('show');
   $("#jabatanstruktural").load("admin/loadUrl/admin/import_jabatan.php?reqJenisJabatan=1");
}

function popupfungsional()
{
   $('#jabatanfungsionalmodal').modal('show');
   $("#jabatanfungsional").load("admin/loadUrl/admin/import_jabatan.php?reqJenisJabatan=2");
}

function popuppelaksana()
{
   $('#jabatanpelaksanamodal').modal('show');
   $("#jabatanpelaksana").load("admin/loadUrl/admin/import_jabatan.php?reqJenisJabatan=3");
}

function popuptambahan()
{
   $('#jabatanfungsionaltambahanmodal').modal('show');
   $("#jabatanfungsionaltambahan").load("admin/loadUrl/admin/import_jabatan.php?reqJenisJabatan=4");
}

</script>