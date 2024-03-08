<?php
include_once("functions/date.func.php");
$this->load->model("base-app/Satker");
$this->load->model("base-app/Rekap");
$this->load->model("base-validasi/TipePegawai");
$this->load->model("base-app/Satker");


$reqId= $this->input->get('reqId');
$reqKeterangan = $this->input->get("reqKeterangan");
$reqBulan = $this->input->get("reqBulan");
$reqTahun = $this->input->get("reqTahun");

$reqId=$this->userSatkerId;


$arrdata= array(
      array("label"=>"fieldtipe", "field"=> "TIPE_PEGAWAI_ID", "display"=>"1", "width"=>"")
    , array("label"=>"ID_ROW", "field"=> "ID_ROW", "display"=>"1",  "width"=>"")
    , array("label"=>"CHECK", "field"=> "CHECK", "display"=>"1",  "width"=>"")
    , array("label"=>"Nama", "field"=> "NAMA", "display"=>"",  "width"=>"")
    , array("label"=>"NIP Baru", "field"=> "NIP_BARU", "display"=>"",  "width"=>"")
    , array("label"=>"Gol/Ruang", "field"=> "GOL_RUANG", "display"=>"",  "width"=>"")
    , array("label"=>"Jabatan", "field"=> "JABATAN", "display"=>"",  "width"=>"")
    , array("label"=>"Instansi", "field"=> "SATKER", "display"=>"",  "width"=>"")
    , array("label"=>"No. SK Lama", "field"=> "NO_SK_LAMA", "display"=>"",  "width"=>"")
    , array("label"=>"TMT Lama", "field"=> "TMT_SK_LAMA", "display"=>"",  "width"=>"")
    , array("label"=>"TMT Baru", "field"=> "TMT_SK_BARU", "display"=>"",  "width"=>"")
    , array("label"=>"MK Baru", "field"=> "MASA_KERJA_BARU", "display"=>"",  "width"=>"")
    , array("label"=>"Gaji Baru", "field"=> "GAJI_POKOK_BARU", "display"=>"",  "width"=>"")
    , array("label"=>"TMT Pensiun", "field"=> "TANGGAL_PENSIUN", "display"=>"",  "width"=>"")
    // untuk dua ini kunci, data akhir id, data sebelum akhir untuk order
    , array("label"=>"fieldnomor", "field"=> "NOMOR_GENERATE", "display"=>"1", "width"=>"")
    , array("label"=>"fieldsatker", "field"=> "SATKER_ID", "display"=>"1", "width"=>"")
    , array("label"=>"fieldstatus", "field"=> "STATUS_KGB", "display"=>"1", "width"=>"")

    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"")
);

$aColumns = array("ID_ROW", "CHECK", "NAMA", "NIP_BARU", "GOL_RUANG", "JABATAN", "SATKER", "NO_SK_LAMA", "TMT_SK_LAMA", "TMT_SK_BARU", "MASA_KERJA_BARU", "GAJI_POKOK_BARU", "NOMOR_GENERATE", "SATKER_ID", "STATUS_KGB", "PEGAWAI_ID");

$arrBulan= setBulanLoop();
$arrTahun= setTahunLoop(5,3);
$tempBulanAktif= generateZeroDate(date("n"),2);
$tempTahunAktif= date("Y");


$today= $tempTahunAktif."-".$tempBulanAktif."-01";

$datemonth= strtotime(date("Y-m-d", strtotime($today)) . "+2 month");
$datemonth= date('Y-m-d', $datemonth);

$tempBulanAktif= getMonthNew($datemonth);
$tempTahunAktif= getYearNew($datemonth);

$reqBulan=generateZero($tempBulanAktif,2);
// print_r($tempTahunAktif);exit;

$tempSatuanKerjaParent= 0;
$satker= new Satker();
$statement= "";
if(!empty($reqId))
{
    $statement.= " AND A.SATKER_ID LIKE '".$reqId."%' ";
    $satker->selectByParams(array(),-1,-1, $statement);

}
else
{
    $satker->selectByParams(array("SATKER_ID_PARENT"=>$tempSatuanKerjaParent),-1,-1, $statement);
}
// echo $satker->query;exit;

$arr_json = array();

if(empty($reqId))
{
   $arr_json[0]['id'] = "";
   $arr_json[0]['text'] = "Semua Satker";
   $i = 1;

}
else
{
  $i = 0; 
}


while($satker->nextRow())
{
    $arr_json[$i]['id'] = $satker->getField("satker_id");
    $arr_json[$i]['text'] = $satker->getField("nama");
    //$arr_json[$i]['children'] = getChild($satker->getField("SATKER_ID"));
    $i++;
}


?>
<style type="text/css">
    .hukumanStyle { background-color:#FC7370; }
    .oddWarna { background-color:#E2E4FF; }
    .evenWarna { background-color:#white; }
    .usulanWarna { background-color:#0F0; }
    .prosesWarna { background-color:#00F; }
    .selesaiWarna { background-color:#0FF; }
    .tidakWarna { background-color:#F9F; }
</style>
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Menu</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted">Data Pegawai</a>
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
                    <h3 class="card-label">Kenaikan Gaji Berkala Guru</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-success font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md"></span>Cetak
                        </button>

                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-item">
                                    <a id="btnCetaUsulan" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-excel-o"></i></span>
                                        <span class="navi-text">Cetak Usulan</span>
                                    </a>
                                    <a id="btncetakblankokgb" class="navi-link">
                                        <span class="navi-icon"><i class="la la-file-word-o"></i></span>
                                        <span class="navi-text">Cetak SK KGB(Blanko)</span>
                                    </a>
                                    <a id="btnCetakKgbLengkap" class="navi-link">
                                        <span class="navi-icon"><i class="la la-file-word-o"></i></span>
                                        <span class="navi-text">Cetak SK KGB(Lengkap)</span>
                                    </a>
                                    <a id="btnCetakPenjagaanBerkala" class="navi-link">
                                        <span class="navi-icon"><i class="la la-file-excel-o"></i></span>
                                        <span class="navi-text">Cetak penjagaan berkala</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md"></span>Aksi
                        </button>

                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-item">
                                    <?
                                    if($this->userlevel == "1")
                                    {
                                        ?>
                                        <a id="btnValidasiPegawai" class="navi-link">
                                            <span class="navi-icon"><i class="la la-edit"></i></span>
                                            <span class="navi-text">Ubah Kgb</span>
                                        </a>
                                        <?
                                    }
                                    elseif($this->userlevel == "2")
                                    {
                                        ?>

                                        <?
                                    }
                                    elseif($this->userlevel == "3" || $this->userlevel == "5")
                                    {
                                        ?>
                                        <a id="btnProses" class="navi-link">
                                            <span class="navi-icon"><i class="la la-edit"></i></span>
                                            <span class="navi-text">Proses</span>
                                        </a>
                                        <a id="btnSelesai" class="navi-link">
                                            <span class="navi-icon"><i class="la la-edit"></i></span>
                                            <span class="navi-text">Selesai</span>
                                        </a>
                                        <a id="btnTidakKgb" class="navi-link">
                                            <span class="navi-icon"><i class="la la-edit"></i></span>
                                            <span class="navi-text">Tidak Kgb</span>
                                        </a>
                                        <a id="btnValidasiPegawai" class="navi-link">
                                            <span class="navi-icon"><i class="la la-edit"></i></span>
                                            <span class="navi-text">Ubah Kgb</span>
                                        </a>
                                        <a id="btnBatal" class="navi-link">
                                            <span class="navi-icon"><i class="la la-undo"></i></span>
                                            <span class="navi-text">Batal</span>
                                        </a>
                                        <?
                                    }
                                    ?>

                                    <?
                                    if($this->userSatkerId == "" && $reqId == "")
                                    {
                                        ?>
                                        <a id="btnTampilkanSemuaData" class="navi-link">
                                            <span class="navi-icon"><i class="la la-exclamation-circle"></i></span>
                                            <span class="navi-text">Tampilkan Semua Data</span>
                                        </a>
                                        <?
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="mb-15">
                    <div class="row mb-8">
                        <div class="col-lg-2 mb-lg-0 mb-4">
                            <label>Periode:</label>
                            <select name="reqBulan" id="reqBulan"  class="form-control datatable-input">
                                <option value="">Semua</option>
                                <?
                                for($bulan=0;$bulan < count($arrBulan);$bulan++)
                                {
                                    ?>
                                    <option value="<?=generateZero($arrBulan[$bulan],2)?>" <? if($tempBulanAktif == $arrBulan[$bulan]) echo "selected";?>><?=getNameMonth(generateZero($arrBulan[$bulan],2))?></option>
                                    <?
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-lg-0 mb-4">
                            <label>Tahun</label>
                            <select name="reqTahun" id="reqTahun"  class="form-control datatable-input">
                                <option value="">Semua</option>
                                <?
                                for($tahun=0;$tahun < count($arrTahun);$tahun++)
                                {
                                    ?>
                                    <option value="<?=$arrTahun[$tahun]?>" <? if($tempTahunAktif == $arrTahun[$tahun]) echo "selected";?>><?=$arrTahun[$tahun]?></option>
                                    <?
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-lg-0 mb-4">
                            <label> Status Administrasi:</label>
                            <select name="reqStatusAdministrasi" id="reqStatusAdministrasi" class="form-control datatable-input">
                                <option value="">Semua</option>
                                <option value="xx">Belum</option>
                                <option value="2" class="prosesWarna">Proses</option>
                                <option value="3" class="selesaiWarna">Selesai</option>
                                <option value="4" class="tidakWarna">Tidak Kgb</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-12 mb-lg-0 mb-6">
                            <label>Satuan Kerja:</label>
                            <select name="reqSatuanKerja" id="reqSatuanKerja" class="form-control datatable-input">
                                <?
                                for($i=0; $i < count($arr_json); $i++)
                                {
                                    $infoid= $arr_json[$i]['id'];
                                    $infotext= $arr_json[$i]['text'];
                                ?>
                                <option value="<?=$infoid?>" <? if($infoid == $reqId) echo "selected";?>><?=$infotext?></option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

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
<input type="hidden" id="setInfoTampil" />

<a href="#" id="triggercari" style="display:none" title="triggercari">triggercari</a>
<script type="text/javascript">
var datanewtable;
var infotableid= "kt_datatable";
var carijenis= "";
var arrdata= <?php echo json_encode($arrdata); ?>;
var indexfieldid= arrdata.length - 1;
var indexfieldstatus= arrdata.length - 3;
var indexfieldnomor= arrdata.length - 5;
var indexfieldsatker= arrdata.length - 4;
var indexfieldidrow= arrdata.length - 18;
var indexfieldtipe= arrdata.length - 19;
infoscrolly= 50;


// console.log(arrdata);

// console.log(indexfieldtipe);

var aktifwarna= "STATUS_KGB";


var valinfoid = anSelectedStatusKgb=anSelectedNomorGenerate= anSelectedSatkerId= valreqId= '';

jQuery(document).ready(function() {

    var jsonurl= "json-admin/kenaikan_gaji_berkala_json/json_pegawai?reqMode=proses&reqType=A&reqId=<?=$reqId?>&reqBulan=<?=$reqBulan?>&reqTahun=<?=$tempTahunAktif?>&reqKgb=guru";
    ajaxserverselectsingle.init(infotableid, jsonurl, arrdata);

    var infoid= [];
    $('#'+infotableid+' tbody').on( 'click', 'tr', function () {
        // untuk pilih satu data, kalau untuk multi comman saja
        $('#'+infotableid+' tbody tr').removeClass('selected');

        var el= $(this);
        el.addClass('selected');

        var dataselected= datanewtable.DataTable().row(this).data();

        fieldinfoid= arrdata[indexfieldid]["field"];
        fieldinfostatus= arrdata[indexfieldstatus]["field"];
        fieldinfonomor= arrdata[indexfieldnomor]["field"];
        fieldinfosatker= arrdata[indexfieldsatker]["field"];
        fieldinfotipe= arrdata[indexfieldtipe]["field"];
        valinfoid= dataselected[fieldinfoid];
        valinfoidrow= arrdata[indexfieldidrow]["field"];
        anSelectedStatusKgb= dataselected[fieldinfostatus];
        anSelectedNomorGenerate= dataselected[fieldinfonomor];
        anSelectedSatkerId= dataselected[fieldinfosatker];
        valinfoidrow= dataselected[valinfoidrow];
        valinfotipe= dataselected[fieldinfotipe];
        if (valinfoid == null)
        {
            valinfoid = '';
        }
        if (anSelectedStatusKgb == null)
        {
            anSelectedStatusKgb = '';
        }
        if (anSelectedNomorGenerate == null)
        {
            anSelectedNomorGenerate = '';
        }
        if (anSelectedSatkerId == null)
        {
            anSelectedSatkerId = '';
        }
        if (valinfoidrow == null)
        {
            valinfoidrow = '';
        }
        if (valinfotipe == null)
        {
            valinfotipe = '';
        }
        // console.log(valinfotipe);
        valreqId =anSelectedSatkerId;
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

    $("#reqSatuanKerja").change(function() {
       var setInfoTampil= reqBulan= reqTahun= reqStatusAdministrasi= reqSatuanKerjaId= "";
       setInfoTampil= $("#setInfoTampil").val();
       reqBulan= $("#reqBulan").val();
       reqTahun= $("#reqTahun").val();
       reqStatusAdministrasi= $("#reqStatusAdministrasi").val();
       reqSatuanKerjaId= $("#reqSatuanKerja").val();
       jsonurl= "json-admin/kenaikan_gaji_berkala_json/json_pegawai?reqMode=proses&reqType=A&reqId="+reqSatuanKerjaId+"&reqBulan="+reqBulan+"&reqTahun=" + reqTahun+"&reqStatusAdministrasi=" + reqStatusAdministrasi+"&setInfoTampil="+setInfoTampil+"&reqKgb=guru";

        datanewtable.DataTable().ajax.url(jsonurl).load();
    });

    $("#reqBulan,#reqTahun").change(function() {
     var setInfoTampil= reqBulan= reqTahun= reqStatusAdministrasi= reqSatuanKerjaId= "";
     setInfoTampil= $("#setInfoTampil").val();
     reqBulan= $("#reqBulan").val();
     reqTahun= $("#reqTahun").val();
     reqStatusAdministrasi= $("#reqStatusAdministrasi").val();
     reqSatuanKerjaId= $("#reqSatuanKerja").val();
   
     jsonurl= "json-admin/kenaikan_gaji_berkala_json/json_pegawai?reqMode=proses&reqType=A&reqId="+reqSatuanKerjaId+"&reqBulan="+reqBulan+"&reqTahun=" + reqTahun+"&reqStatusAdministrasi=" + reqStatusAdministrasi+"&setInfoTampil="+setInfoTampil+"&reqKgb=guru";
   
     datanewtable.DataTable().ajax.url(jsonurl).load();
    });

    $("#reqStatusAdministrasi").change(function() {
     var setInfoTampil= reqBulan= reqTahun= reqStatusAdministrasi= reqSatuanKerjaId= "";
     setInfoTampil= $("#setInfoTampil").val();
     reqBulan= $("#reqBulan").val();
     reqTahun= $("#reqTahun").val();
     reqStatusAdministrasi= $("#reqStatusAdministrasi").val();
     reqSatuanKerjaId= $("#reqSatuanKerja").val();
                 
     jsonurl= "json-admin/kenaikan_gaji_berkala_json/json_pegawai?reqMode=proses&reqType=A&reqId="+reqSatuanKerjaId+"&reqBulan="+reqBulan+"&reqTahun=" + reqTahun+"&reqStatusAdministrasi=" + reqStatusAdministrasi+"&setInfoTampil="+setInfoTampil+"&reqKgb=guru";
   
     datanewtable.DataTable().ajax.url(jsonurl).load();
    });

    $("#btnTampilkanSemuaData").on('click', function () {
       $("#setInfoTampil").val("1");
       var setInfoTampil= reqBulan= reqTahun= reqStatusAdministrasi= reqSatuanKerjaId= "";
       setInfoTampil= $("#setInfoTampil").val();
       reqBulan= $("#reqBulan").val();
       reqTahun= $("#reqTahun").val();
       reqStatusAdministrasi= $("#reqStatusAdministrasi").val();
       var reqSatuanKerjaId = $("#reqSatuanKerja").val();
                 
       jsonurl= "json-admin/kenaikan_gaji_berkala_json/json_pegawai?reqId="+reqSatuanKerjaId+"&reqBulan="+reqBulan+"&reqTahun=" + reqTahun+"&reqStatusAdministrasi=" + reqStatusAdministrasi+"&setInfoTampil="+setInfoTampil+"&reqKgb=guru";
   
       datanewtable.DataTable().ajax.url(jsonurl).load();
    });

    $("#btncetakblankokgb").click(function() {
        var setInfoTampil= reqBulan= reqTahun= reqStatusAdministrasi= reqSatuanKerjaId= "";
        setInfoTampil= $("#setInfoTampil").val();
        reqBulan= $("#reqBulan").val();
        reqTahun= $("#reqTahun").val();
        reqStatusAdministrasi= $("#reqStatusAdministrasi").val();
        var reqSatuanKerjaId = $("#reqSatuanKerja").val();

        opUrl= 'admin/loadUrl/admin/kenaikan_gaji_berkala_cetak_sk_blanko?reqId='+reqSatuanKerjaId+'&reqKeterangan<?=$reqKeterangan?>'+'&reqKgb=guru&reqTipePegawai='+valinfotipe;
        newWindow = window.open(opUrl, 'Cetak');
        newWindow.focus();
    });

    $("#btnCetaUsulan").click(function() {
        var setInfoTampil= reqBulan= reqTahun= reqStatusAdministrasi= reqSatuanKerjaId= "";
        setInfoTampil= $("#setInfoTampil").val();
        reqBulan= $("#reqBulan").val();
        reqTahun= $("#reqTahun").val();
        reqStatusAdministrasi= $("#reqStatusAdministrasi").val();
        var reqSatuanKerjaId = $("#reqSatuanKerja").val();

        opUrl= 'admin/loadUrl/admin/kenaikan_gaji_berkala_cetak_usulan?reqId='+reqSatuanKerjaId+'&reqBulan='+reqBulan+'&reqTahun=' + reqTahun+'&reqStatusAdministrasi=' + reqStatusAdministrasi+"&setInfoTampil="+setInfoTampil+"&reqKgb=guru&reqTipePegawai="+valinfotipe;
        newWindow = window.open(opUrl, 'Cetak');
        newWindow.focus();
    });

    $('#btnCetakPenjagaanBerkala').click(function() {
        var setInfoTampil= reqBulan= reqTahun= reqStatusAdministrasi= reqSatuanKerjaId= "";
        setInfoTampil= $("#setInfoTampil").val();
        reqBulan= $("#reqBulan").val();
        reqTahun= $("#reqTahun").val();
        reqStatusAdministrasi= $("#reqStatusAdministrasi").val();
        var reqSatuanKerjaId = $("#reqSatuanKerja").val();

        opUrl= 'admin/loadUrl/admin/kenaikan_gaji_berkala_cetak_penjagaan.php?reqId='+reqSatuanKerjaId+'&reqBulan='+reqBulan+'&reqTahun='+reqTahun+'&reqStatusAdministrasi='+reqStatusAdministrasi+"&setInfoTampil="+setInfoTampil;
        newWindow = window.open(opUrl, 'Cetak');
        newWindow.focus();
    });


    $('#btnProses').click(function() {
        var reqStatusAdministrasi= reqSatuanKerjaId= "";
        reqStatusAdministrasi= $("#reqStatusAdministrasi").val();
        var reqSatuanKerjaId = $("#reqSatuanKerja").val();

        $("#setInfoTampil").val("1");
        setInfoTampil= $("#setInfoTampil").val();
        jsonproses= 'json-admin/kenaikan_gaji_berkala_json/proses_kgb?reqMode=proses_usulan&reqId='+reqSatuanKerjaId+'&reqRowId='+valinfoid+'&reqBulan='+$("#reqBulan").val()+'&reqTahun=' + $("#reqTahun").val()+'&reqStatusAdministrasi=' + reqStatusAdministrasi+'&setInfoTampil=' + setInfoTampil;

        var reqMode="proses_usulan";
        var reqId=reqSatuanKerjaId;
        var reqRowId=valinfoid;
        var reqBulan=$("#reqBulan").val();
        var reqTahun=$("#reqTahun").val();

        var jsonurl= "json-admin/kenaikan_gaji_berkala_json/json_pegawai?reqMode=proses&reqType=A&reqId="+reqSatuanKerjaId+"&reqBulan="+reqBulan+"&reqTahun="+reqTahun+"&reqStatusAdministrasi="+reqStatusAdministrasi+"&setInfoTampil=" + setInfoTampil+"&reqKgb=guru";

        $.ajax({
              type: "POST",
              url: jsonproses,
              data: {reqMode : reqMode,reqId : reqId,reqRowId : reqRowId,reqBulan : reqBulan,reqTahun : reqTahun,reqStatusAdministrasi : reqStatusAdministrasi},
              cache: false,
              success: function(data){
                datanewtable.DataTable().ajax.url(jsonurl).load();

              }
        });
       
    });

    $('#btnSelesai').on('click', function () {
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
            return false;
        }
        else
        {
            var reqStatusAdministrasi= reqSatuanKerjaId= "";
            reqStatusAdministrasi= $("#reqStatusAdministrasi").val();
            var reqSatuanKerjaId = $("#reqSatuanKerja").val();
            $("#setInfoTampil").val("1");
            setInfoTampil= $("#setInfoTampil").val();

            jsonproses= 'json-admin/kenaikan_gaji_berkala_json/proses_kgb?reqMode=proses_selesai&reqId='+reqSatuanKerjaId+'&reqRowId='+valinfoid+'&reqBulan='+$("#reqBulan").val()+'&reqTahun=' + $("#reqTahun").val()+'&reqStatusAdministrasi=' + reqStatusAdministrasi+'&setInfoTampil=' + setInfoTampil;

            var reqMode="proses_selesai";
            var reqId=reqSatuanKerjaId;
            var reqRowId=valinfoid;
            var reqBulan=$("#reqBulan").val();
            var reqTahun=$("#reqTahun").val();

            var jsonurl= "json-admin/kenaikan_gaji_berkala_json/json_pegawai?reqMode=proses&reqType=A&reqId="+reqSatuanKerjaId+"&reqBulan="+reqBulan+"&reqTahun="+reqTahun+"&reqStatusAdministrasi="+ reqStatusAdministrasi+"&setInfoTampil=" + setInfoTampil+"&reqKgb=guru";

            $.ajax({
                  type: "POST",
                  url: jsonproses,
                  data: {reqMode : reqMode,reqId : reqId,reqRowId : reqRowId,reqBulan : reqBulan,reqTahun : reqTahun,reqStatusAdministrasi : reqStatusAdministrasi},
                  cache: false,
                  success: function(data){
                    datanewtable.DataTable().ajax.url(jsonurl).load();

                  }
            });

        }
    });

    $('#btnTidakKgb').on('click', function () {
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
            return false;
        }
        else
        {
            var reqStatusAdministrasi= reqSatuanKerjaId= "";
            reqStatusAdministrasi= $("#reqStatusAdministrasi").val();
            $("#setInfoTampil").val("1");
            setInfoTampil= $("#setInfoTampil").val();
            var reqSatuanKerjaId = $("#reqSatuanKerja").val();
          
            var reqMode="proses_tidak";
            var reqId=reqSatuanKerjaId;
            var reqRowId=valinfoid;
            var reqBulan=$("#reqBulan").val();
            var reqTahun=$("#reqTahun").val();

            jsonproses= 'json-admin/kenaikan_gaji_berkala_json/proses_kgb?reqMode='+reqMode+'&reqId='+reqSatuanKerjaId+'&reqRowId='+valinfoid+'&reqBulan='+reqBulan+'&reqTahun=' +reqTahun+'&reqStatusAdministrasi='+reqStatusAdministrasi+'&setInfoTampil=' + setInfoTampil;

            var jsonurl= "json-admin/kenaikan_gaji_berkala_json/json_pegawai?reqMode=proses&reqType=A&reqId="+reqSatuanKerjaId+"&reqBulan="+reqBulan+"&reqTahun="+reqTahun+"&reqStatusAdministrasi="+ reqStatusAdministrasi+"&setInfoTampil=" + setInfoTampil+"&reqKgb=guru";

            $.ajax({
                  type: "POST",
                  url: jsonproses,
                  data: {reqMode : reqMode,reqId : reqId,reqRowId : reqRowId,reqBulan : reqBulan,reqTahun : reqTahun,reqStatusAdministrasi : reqStatusAdministrasi},
                  cache: false,
                  success: function(data){
                    datanewtable.DataTable().ajax.url(jsonurl).load();

                  }
            });

        }
    });

    $('#btnBatal').on('click', function () {
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
            return false;
        }
        else
        {
            var reqStatusAdministrasi= reqSatuanKerjaId= "";
            reqStatusAdministrasi= $("#reqStatusAdministrasi").val();
            $("#setInfoTampil").val("1");
            setInfoTampil= $("#setInfoTampil").val();
            var reqSatuanKerjaId = $("#reqSatuanKerja").val();
          
            var reqMode="proses_batal";
            var reqId=reqSatuanKerjaId;
            var reqRowId=valinfoid;
            var reqBulan=$("#reqBulan").val();
            var reqTahun=$("#reqTahun").val();

            var jsonurl= "json-admin/kenaikan_gaji_berkala_json/json_pegawai?reqMode=proses&reqType=A&reqId="+reqSatuanKerjaId+"&reqBulan="+reqBulan+"&reqTahun="+reqTahun+"&reqStatusAdministrasi="+ reqStatusAdministrasi+"&setInfoTampil=" + setInfoTampil+"&reqKgb=guru";

            jsonproses= 'json-admin/kenaikan_gaji_berkala_json/proses_kgb?reqMode='+reqMode+'&reqId='+reqSatuanKerjaId+'&reqRowId='+valinfoid+'&reqBulan='+reqBulan+'&reqTahun=' +reqTahun+'&reqStatusAdministrasi='+reqStatusAdministrasi+'&setInfoTampil=' + setInfoTampil;

            $.ajax({
                  type: "POST",
                  url: jsonproses,
                  data: {reqMode : reqMode,reqId : reqId,reqRowId : reqRowId,reqBulan : reqBulan,reqTahun : reqTahun,reqStatusAdministrasi : reqStatusAdministrasi},
                  cache: false,
                  success: function(data){
                    datanewtable.DataTable().ajax.url(jsonurl).load();

                  }
            });

        }
    });

    $('#btnCetakKgbLengkap').on('click', function () {
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
            return false;
        }
        else
        {

            if(parseInt(anSelectedStatusKgb) < 1 || anSelectedStatusKgb == "")
            {
                alert("proses Kgb terlebih dahulu, kemudian pastikan pilih salah satu pegawai");
                return false;
            }
            else
            {
                var reqBulan= reqTahun= reqPeriode= "";
                reqBulan= $("#reqBulan").val();
                reqTahun= $("#reqTahun").val();
                reqPeriode= reqBulan+""+reqTahun;

                opUrl= 'admin/loadUrl/admin/kenaikan_gaji_berkala_cetak_sk.php?reqId='+valinfoid+'&reqPeriode='+reqPeriode+"&reqKgb=guru";
                newWindow = window.open(opUrl, 'Cetak');
                newWindow.focus();
            }       

        }         
       
    });
            

    $('#btnValidasiPegawai').on('click', function () {
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
            return false;
        }
        else
        {

            if(anSelectedStatusKgb == 3)
            {
                var reqMode= reqBulan= reqTahun= reqPeriode= "";
                reqBulan= $("#reqBulan").val();
                reqTahun= $("#reqTahun").val();
                reqPeriode= reqBulan+""+reqTahun;
                reqMode="tambah";
                if(anSelectedNomorGenerate == ""){}
                else
                {
                    reqMode="view";
                }
                var reqPecah = valinfoidrow.split('-');
                var   url    = 'admin/index/kenaikan_gaji_berkala_add_data.php?reqPegawaiId='+reqPecah[0]+'&reqBulan='+reqPecah[1]+"&reqTahun="+reqPecah[2]+"&reqSatkerId="+anSelectedSatkerId+"&reqGaji="+reqPecah[1]+"&reqTipePegawai="+valinfotipe;

                window.location.href = url; 
            }
            else
            {
                alert("Untuk validasi kgb, tunggu sampai proses selesai");
                return false;
            }

        }
        });


});

function calltriggercari()
{
    $(document).ready( function () {
      $("#triggercari").click();      
    });
}

</script>