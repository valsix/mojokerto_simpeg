<?php
include_once("functions/string.func.php");
include_once("functions/date.func.php");

$this->load->model("base-data/InfoData");
$this->load->library('globalmenu');

$adminusernama= $this->adminusernama;

$userpegawaimode= $this->userpegawaimode;
$adminuserid= $this->adminuserid;
$reqId= $this->input->get('reqId');

// if(!empty($userpegawaimode))
//     $reqPegawaiId= $this->userpegawaimode;
// else
//     $reqPegawaiId= $this->pegawaiId;

$reqPegawaiId= $this->userpegawaimode;
// echo  $this->input->get("reqPegawaiHard");exit;

$formulaid= $this->input->get("formulaid");
$reqPegawaiHard= $this->input->get("reqPegawaiHard");
$rencanasuksesiid= $this->input->get("rencanasuksesiid");
$set= new InfoData();
$set->selectbyparamspegawai(array("A.PEGAWAI_ID"=>$reqPegawaiId),-1,-1);
$set->firstRow();
// echo $set->query; exit;
$reqNama= $set->getField('NAMA');
$reqSatker= $set->getField('NMSATKER');
$reqEmail= $set->getField('EMAIL');
$reqLogo= substr($reqNama, 0, 1);

// untuk kondisi file
$vfpeg= new globalmenu();

$index_set=0;
$arrMenu= [];
$arrparam= ["mode"=>"personal", "formulaid"=>$formulaid, "rencanasuksesiid"=>$rencanasuksesiid];
// $arrMenu= harcodemenu($userstatuspegId);
$arrMenu= $vfpeg->harcodemenu($arrparam);
// print_r($arrMenu);exit;

$arrparam= ["pg"=>$pg, "arrMenu"=>$arrMenu];
$arrcarimenuparent= $vfpeg->cariparentmenu($arrparam);
// echo $arrcarimenuparent;exit;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?=base_url()?>">
        <meta charset="utf-8" />
        <title>SIMPEG 2024</title>
        <meta name="description" content="User profile block example" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/custom/jstree/jstree.bundle.css" rel="stylesheet" type="text/css" />

        <!-- FOnt Awesome -->
        <link rel="stylesheet" href="assets/css/css-beautify-minify.css" rel="stylesheet" type="text/css" >

        <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/brand/light.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/aside/light.css" rel="stylesheet" type="text/css" />

        <link rel="shortcut icon" href="assets/media/logos/favicon.png" />
        <link href="assets/css/new-style.css" rel="stylesheet" type="text/css" />
        <!-- easy ui -->
        <!-- <link rel="stylesheet" type="text/css" href="lib/easyui/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="lib/easyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="lib/easyui/demo/demo.css">

        <script type="text/javascript" src="lib/easyui/jquery-easyui-1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="lib/easyui/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="lib/easyui/breadcrum.js"></script> -->
        <!-- easy ui -->
        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>

    
        <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
        <script src="assets/js/valsix-serverside.js"></script>
        <script type="text/javascript" src="functions/globalfunction.js"></script>
        <script src="assets/plugins/custom/jstree/jstree.bundle.js"></script>

        <script src="assets/emodal/eModal.min.js"></script>

        <link rel="stylesheet" type="text/css" href="lib/jquery-easyui-1.4.2/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="lib/jquery-easyui-1.4.2/themes/icon.css">

        <script type="text/javascript" src="lib/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>

        <script>
            function openAdd(pageUrl) {
                eModal.iframe(pageUrl, 'Aplikasi')
            }
            function closePopup() {
                eModal.close();
            }

            function opennewtab(evt, cityName) {
                var i, x, tablinks;
                x = document.getElementsByClassName("city");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < x.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " w3-red";
            }

        </script>

        <!-- <script script type="text/javascript" src="js/highcharts.js"></script> -->
        <!-- <script src="lib/highcharts/jquery-3.1.1.min.js"></script> -->
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
            .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
             background-color: #EBEBE4;
            }
        </style>

        <link rel="stylesheet" type="text/css" href="assets/css/gaya.css">


        
        
    </head>

    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!-- <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable aside-minimize"> -->
        <?if($pg != "login"){?>
            <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">

                <a href="app">
                    <img alt="Logo" src="images/logo.png" />
                </a>

                <div class="d-flex align-items-center">
                    <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                        <span></span>
                    </button>

                    <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                        <span class="svg-icon svg-icon-xl">

                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>

                        </span>
                    </button>
                </div>

            </div>
        <?}?>

        <div class="d-flex flex-column flex-root">

            <div class="d-flex flex-row flex-column-fluid page">

                <?
                if($pg == "login"){}
                else 
                {
                ?>
                <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">

                    <div class="brand flex-column-auto" id="kt_brand">

                        <a href="app" class="brand-logo">
                            <img alt="Logo" src="images/logo-aplikasi.png" />
                        </a>

                        <button class="brand-toggle btn btn-sm px-0 active" id="kt_aside_toggle">
                            <span class="svg-icon svg-icon svg-icon-xl">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                                        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                                    </g>
                                </svg>

                            </span>
                        </button>
                    </div>

                    <?
                    $arrmenupegawaidetil= array("pegawai_data_fip", "lokasi_kerja", "pengalaman_kerja", "pengalaman_kerja_add", "sk_pns", "sk_cpns", "riwayat_pangkat", "riwayat_pangkat_add", "riwayat_jabatan", "riwayat_jabatan_add", "riwayat_tugas_tambahan", "riwayat_tugas_tambahan_add", "riwayat_gaji", "riwayat_gaji_add", "pendidikan_umum", "pendidikan_umum_add", "pelatihan_kepemimpinan", "pelatihan_kepemimpinan_add", "pelatihan_fungsional", "pelatihan_fungsional_add", "diklat_lpj", "diklat_lpj_add", "pelatihan_teknis", "pelatihan_teknis_add", "seminar_workshop", "seminar_workshop_add", "pelatihan_non_klasikal", "pelatihan_non_klasikal_add", "orang_tua", "mertua", "suami_istri", "anak", "anak_add", "saudara", "saudara_add", "organisasi", "organisasi_add", "penghargaan", "penghargaan_add", "penilaian_potensi_diri", "penilaian_potensi_diri_add", "catatan_prestasi", "catatan_prestasi_add", "hukuman", "hukuman_add", "cuti", "cuti_add", "tambah_masa_kerja", "tambah_masa_kerja_add", "ijin_belajar", "ijin_belajar_add", "sertifikat_pendidikan", "sertifikat_pendidikan_add", "sertifikat_prestasi", "sertifikat_prestasi_add", "pak", "pak_add", "skp", "skp_add", "kinerja", "kinerja_add", "komparasi_data", "komparasi_data_add", "penguasaan_bahasa", "penguasaan_bahasa_add", "nikah", "nikah_add");

                    $arrmenuMaster= array("master_diklat","master_diklat_add","master_eselon","master_eselon_add","master_peraturan_gaji","master_peraturan_gaji_add","master_gaji_pokok","master_gaji_pokok_add","master_peraturan","master_peraturan_add","master_tingkat_hukuman","master_tingkat_hukuman_add","master_jenis_hukuman","master_jenis_hukuman_add","master_jurusan_pendidikan","master_jurusan_pendidikan_add","master_pangkat","master_pangkat_add","master_satker","master_satker_add","master_user","master_user_add","master_satker","master_pejabat_penetap","master_pejabat_penetap_add","master_pendidikan","master_pendidikan_add","master_user_group","master_user_group_add","master_user_rekap","master_jabatan_fungsional","master_jabatan_fungsional_add","master_user_reset_password","master_user_log");

                    $arrmenuReport= array("laporan_skpd_tribulan","laporan_bkpp_rekap_golongan","laporan_bkpp_rekap_eselon_jabatan_kosong");

                    if(in_array($pg, $arrmenupegawaidetil))
                    {
                    ?>
                        <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                            <!--begin::Menu Container-->
                            <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="border: 0px solid red; margin-top: 0px !important; margin-bottom: 0px !important;">
                                <!--begin::Menu Nav-->
                                <ul class="menu-nav">
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app/index/pegawai" class="menu-link menu-toggle">
                                            <span class="menu-text"><i class="fa fa-arrow-left" aria-hidden="true" style="color: #FFFFFF; margin-right: 10px;"></i>Kembali</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" style="background-color: white;">
                                        <a disabled class="menu-link menu-toggle" style="cursor: context-menu;">
                                            <span class="menu-text" style="color: #bd1007;">FIP - 01</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='lokasi_kerja'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/lokasi_kerja?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Lokasi Kerja</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pegawai_data_fip'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pegawai_data_fip?reqId=<?=$reqId?>"  class="menu-link menu-toggle">
                                            <span class="menu-text">Identitas Pegawai</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover"<?if($pg=='pengalaman_kerja'||$pg=='pengalaman_kerja_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pengalaman_kerja?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Pengalaman Kerja</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='sk_cpns'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/sk_cpns?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">SK CPNS</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='sk_pns'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/sk_pns?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">SK PNS</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" style="background-color: white;">
                                        <a disabled class="menu-link menu-toggle" style="cursor: context-menu;">
                                            <span class="menu-text" style="color: #bd1007;">FIP - 02</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='riwayat_pangkat'||$pg=='riwayat_pangkat_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/riwayat_pangkat?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Riwayat Pangkat</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='riwayat_jabatan'||$pg=='riwayat_jabatan_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/riwayat_jabatan?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Riwayat Jabatan</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='riwayat_tugas_tambahan'||$pg=='riwayat_tugas_tambahan_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/riwayat_tugas_tambahan?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Riwayat Tugas Tambahan</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='riwayat_gaji'||$pg=='riwayat_gaji_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/riwayat_gaji?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Riwayat Gaji</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pendidikan_umum'||$pg=='pendidikan_umum_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pendidikan_umum?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Pendidikan Umum</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pelatihan_kepemimpinan'||$pg=='pelatihan_kepemimpinan_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pelatihan_kepemimpinan?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Pelatihan Kepemimpinan</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pelatihan_fungsional'||$pg=='pelatihan_fungsional_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pelatihan_fungsional?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Pelatihan Fungsional</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='diklat_lpj'||$pg=='diklat_lpj_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/diklat_lpj?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Diklat Lpj</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pelatihan_teknis'||$pg=='pelatihan_teknis_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pelatihan_teknis?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Pelatihan Teknis</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='seminar_workshop'||$pg=='seminar_workshop_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/seminar_workshop?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Seminar/Workshop</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pelatihan_non_klasikal'||$pg=='pelatihan_non_klasikal_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pelatihan_non_klasikal?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Pelatihan Non Klasikal</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='orang_tua'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/orang_tua?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Orang Tua</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='mertua'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/mertua?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Mertua</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='suami_istri'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/suami_istri?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Suami Istri</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='anak'||$pg=='anak_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/anak?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Anak</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='saudara'||$pg=='saudara_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/saudara?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Saudara</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='organisasi'||$pg=='organisasi_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/organisasi?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Organisasi</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='penghargaan'||$pg=='penghargaan_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/penghargaan?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Penghargaan</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='penilaian_potensi_diri'||$pg=='penilaian_potensi_diri_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/penilaian_potensi_diri?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Penilaian Potensi Diri</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='catatan_prestasi'||$pg=='catatan_prestasi_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/catatan_prestasi?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Catatan Prestasi</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='hukuman'||$pg=='hukuman_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/hukuman?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Hukuman</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='cuti'||$pg=='cuti_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/cuti?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Cuti</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='penguasaan_bahasa'||$pg=='penguasaan_bahasa_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/penguasaan_bahasa?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Penguasaan Bahasa</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='nikah'||$pg=='nikah_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/nikah?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Nikah</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='tambah_masa_kerja'||$pg=='tambah_masa_kerja_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/tambah_masa_kerja?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Tambahan Masa Kerja</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='ijin_belajar'||$pg=='ijin_belajar_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/ijin_belajar?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Ijin Belajar</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='sertifikat_pendidikan'||$pg=='sertifikat_pendidikan_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/sertifikat_pendidikan?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Sertifikat Pendidikan</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='sertifikat_prestasi'||$pg=='sertifikat_prestasi_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/sertifikat_prestasi?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Sertifikat Profesi</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pak'||$pg=='pak_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pak?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">P.A.K</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='skp'||$pg=='skp_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/skp?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">SKP</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='kinerja'||$pg=='kinerja_add'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/kinerja?reqId=<?=$reqId?>" class="menu-link menu-toggle">
                                            <span class="menu-text">Kinerja</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?
                    }
                    else if(in_array($pg, $arrmenuMaster))
                    {
                        if($this->adminuserMasterProses == 1 && $this->adminuserpegawaiid == "") 
                        {?>
                            <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                                <!--begin::Menu Container-->
                                <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="border: 0px solid red; margin-top: 0px !important; margin-bottom: 0px !important;">
                                    <!--begin::Menu Nav-->
                                    <ul class="menu-nav">
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                            <a href="app/index/home" class="menu-link menu-toggle">
                                                <span class="menu-text"><i class="fa fa-arrow-left" aria-hidden="true" style="color: #FFFFFF; margin-right: 10px;"></i>Kembali</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" style="background-color: white;">
                                            <a disabled class="menu-link menu-toggle" style="cursor: context-menu;">
                                                <span class="menu-text" style="color: #bd1007;">Menu Master</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_diklat'||$pg=='master_diklat_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_diklat" class="menu-link ">
                                                <span class="menu-text">Diklat</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_eselon'||$pg=='master_eselon_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_eselon" class="menu-link ">
                                                <span class="menu-text">Eselon</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_jabatan_fungsional'||$pg=='master_jabatan_fungsional_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_jabatan_fungsional" class="menu-link ">
                                                <span class="menu-text" >Jabatan Fungsional</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover"<?if($pg=='master_peraturan_gaji'||$pg=='master_peraturan_gaji_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_peraturan_gaji" class="menu-link ">
                                                <span class="menu-text" >Peraturan Gaji</span>
                                            </a>
                                        </li>
                                        
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_gaji_pokok'||$pg=='master_gaji_pokok_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_gaji_pokok" class="menu-link ">
                                                <span class="menu-text" >Gaji Pokok</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_peraturan'||$pg=='master_peraturan_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_peraturan" class="menu-link ">
                                                <span class="menu-text" >Peraturan</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_tingkat_hukuman'||$pg=='master_tingkat_hukuman_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_tingkat_hukuman" class="menu-link ">
                                                <span class="menu-text" >Tingkat Hukuman</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_jenis_hukuman'||$pg=='master_jenis_hukuman_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_jenis_hukuman" class="menu-link ">
                                                <span class="menu-text" >Jenis Hukuman</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_jurusan_pendidikan'||$pg=='master_jurusan_pendidikan_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_jurusan_pendidikan" class="menu-link ">
                                                <span class="menu-text" >Jurusan Pendidikan</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_pangkat'||$pg=='master_pangkat_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_pangkat" class="menu-link ">
                                                <span class="menu-text" >Pangkat</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_pejabat_penetap'||$pg=='master_pejabat_penetap_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_pejabat_penetap" class="menu-link ">
                                                <span class="menu-text" >Pejabat Penetap</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_pendidikan'||$pg=='master_pendidikan_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_pendidikan" class="menu-link ">
                                                <span class="menu-text" >Pendidikan</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_satker'||$pg=='master_satker_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_satker" class="menu-link ">
                                                <span class="menu-text" >Satker</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_user'||$pg=='master_user_add' ||$pg=='master_user_reset_password' ||$pg=='master_user_log'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_user" class="menu-link ">
                                                <span class="menu-text" >User</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_user_rekap'||$pg=='master_user_rekap_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_user_rekap" class="menu-link ">
                                                <span class="menu-text" >User Rekap</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='master_user_group'||$pg=='master_user_group_add'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/master_user_group" class="menu-link ">
                                                <span class="menu-text" >User Group</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?
                        }
                    }
                    else if(in_array($pg, $arrmenuReport))
                    {
                    ?>

                      <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                                <!--begin::Menu Container-->
                                <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="border: 0px solid red; margin-top: 0px !important; margin-bottom: 0px !important;">
                                    <!--begin::Menu Nav-->
                                    <ul class="menu-nav">
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                            <a href="app/index/home" class="menu-link menu-toggle">
                                                <span class="menu-text"><i class="fa fa-arrow-left" aria-hidden="true" style="color: #FFFFFF; margin-right: 10px;"></i>Kembali</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" style="background-color: white;">
                                            <a disabled class="menu-link menu-toggle" style="cursor: context-menu;">
                                                <span class="menu-text" style="color: #bd1007;">Laporan Semester</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='laporan_skpd_tribulan'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/laporan_skpd_tribulan" class="menu-link ">
                                                <span class="menu-text">KelKawinPendaga</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='laporan_bkpp_rekap_eselon_jabatan_kosong'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/laporan_bkpp_rekap_eselon_jabatan_kosong" class="menu-link ">
                                                <span class="menu-text">Rekap Eselon Kosong</span>
                                            </a>
                                        </li>
                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='laporan_bkpp_rekap_golongan'){?>style="background-color: #EE9D01;"<?}?>>
                                            <a href="app/index/laporan_bkpp_rekap_golongan" class="menu-link ">
                                                <span class="menu-text">Rekap Golongan</span>
                                            </a>
                                        </li>
                                       
                                       
                                    </ul>
                                </div>
                            </div>
                    <?
                    }
                    else
                    {
                    ?>
                        <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">

                            <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="border: 0px solid red; margin-top: 0px !important; margin-bottom: 0px !important;">
                                <!--begin::Menu Nav-->
                                <ul class="menu-nav">
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app/index/home" class="menu-link menu-toggle">
                                            <span class="menu-text"><i class="fa fa-home" aria-hidden="true" style="color: #FFFFFF;margin-right: 10px;"></i> Home</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app/index/pegawai_dashboard" class="menu-link menu-toggle">
                                            <span class="menu-text">Dashboard Personal</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Kelengkapan (bantuan)</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Validator</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app/index/dynaport" class="menu-link menu-toggle">
                                            <span class="menu-text">Dynaport</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Rekap Pensiun</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Ultah</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app/index/pensiun" class="menu-link menu-toggle">
                                            <span class="menu-text">Pensiun</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app/index/kenaikan_pangkat" class="menu-link menu-toggle">
                                            <span class="menu-text">KP</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app/index/kenaikan_gaji_berkala" class="menu-link menu-toggle">
                                            <span class="menu-text">KGB</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app/index/daftar_urutan_pegawai" class="menu-link menu-toggle">
                                            <span class="menu-text">DUK</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app/index/statistik" class="menu-link menu-toggle">
                                            <span class="menu-text">Statistik</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover" <?if($pg=='pegawai'){?>style="background-color: #EE9D01;"<?}?>>
                                        <a href="app/index/pegawai" class="menu-link menu-toggle">
                                            <span class="menu-text"><i class="fa fa-user" aria-hidden="true" style="color: #FFFFFF;margin-right: 10px;"></i>Pegawai</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Anjab</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <span class="menu-text">Profil Kompetensi</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app/index/laporan_bkpp_rekap_golongan" class="menu-link menu-toggle">
                                            <span class="menu-text"><i class="fa fa-file" aria-hidden="true" style="color: #FFFFFF;margin-right: 10px;"></i>Report</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>

                                    <?
                                    if($this->adminuserMasterProses == 1 && $this->adminuserpegawaiid == "") 
                                    {
                                        ?>

                                        <li class="menu-item menu-item-submenu  menu-item-here" aria-haspopup="true" data-menu-toggle="hover">
                                            <a href="app/index/master_diklat" class="menu-link menu-toggle">
                                                <span class="menu-text"><i class="fa fa-database" aria-hidden="true" style="color: #FFFFFF;margin-right: 10px;"></i>Master Menu</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                        </li>
                                      
                                        <?
                                    }
                                    ?>

                                </ul>

                            </div>

                        </div>

                    <?
                    }
                    ?>
                </div>
                <? 
                } 
                ?>

                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper" <? if($pg == "login"){ ?> style="padding-left: 0px;"<? } ?>>

                    <div id="kt_header" class="header header-fixed">
                        <div class="container-fluid d-flex align-items-stretch justify-content-between">
                            <div class="logo-header"><img src="images/logo-aplikasi-hide.png" height="70"></div>
                            <?
                            if($pg == "login"){} 
                            else 
                            { 
                            ?>
                            <? 
                            }
                            ?>

                            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                                <?
                                if($pg == "pegawai_data_fip")
                                {
                                ?>
                                <div class="area-menu-fip">
                                    <nav class="navbar navbar-default">
                                        <div class="container-fluid">
                                            <div class="navbar-header">
                                                <button type="button" class="navbar-toggle collapsed btn btn-warning" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i class="fa fa-id-card" aria-hidden="true"></i> <span>Menu&nbsp;FIP</span>
                                                    <span class="sr-only">Toggle navigation</span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                    <span class="icon-bar"></span>
                                                </button>
                                            </div>
                                            <div id="navbar" class="navbar-collapse collapse">

                                                <div class="panel-group" id="accordion">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">FIP 01</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse1" class="panel-collapse collapse in">
                                                            <div class="panel-body">
                                                                <ul class="nav navbar-nav">
                                                                    <li><a href="#">Lokasi Kerja</a></li>
                                                                    <li><a href="#">Identitas Pegawai</a></li>
                                                                    <li><a href="#">Pengalaman Kerja</a></li>
                                                                    <li><a href="#">SK PNS</a></li>
                                                                    <li><a href="#">SK CPNS</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">FIP 02</a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse2" class="panel-collapse collapse">
                                                            <div class="panel-body">
                                                                <ul class="nav navbar-nav">
                                                                    <li><a href="#">Riwayat Pangkat</a></li>
                                                                    <li><a href="#">Riwayat Jabatan</a></li>
                                                                    <li><a href="#">Riwayat Tugas Tambahan</a></li>
                                                                    <li><a href="#">Riwayat Gaji</a></li>
                                                                    <li><a href="#">Pendidikan Umum</a></li>
                                                                    <li><a href="#">Pelatihan Kepemimpinan</a></li>
                                                                    <li><a href="#">Pelatihan Fungsional</a></li>
                                                                    <li><a href="#">Diklat Lpj</a></li>
                                                                    <li><a href="#">Pelatihan Teknis</a></li>
                                                                    <li><a href="#">Seminar/Workshop</a></li>
                                                                    <li><a href="#">Pelatihan Non Klasikal</a></li>
                                                                    <li><a href="#">Orang Tua</a></li>
                                                                    <li><a href="#">Mertua</a></li>
                                                                    <li><a href="#">Suami Istri</a></li>
                                                                    <li><a href="#">Anak</a></li>
                                                                    <li><a href="#">Saudara</a></li>
                                                                    <li><a href="#">Organisasi</a></li>
                                                                    <li><a href="#">Penghargaan</a></li>
                                                                    <li><a href="#">Penilaian Potensi Diri</a></li>
                                                                    <li><a href="#">Catatan Prestasi</a></li>
                                                                    <li><a href="#">Hukuman</a></li>
                                                                    <li><a href="#">Cuti</a></li>
                                                                    <li><a href="#">Tambahan Masa Kerja</a></li>
                                                                    <li><a href="#">Ijin Belajar</a></li>
                                                                    <li><a href="#">Sertifikat Pendidik</a></li>
                                                                    <li><a href="#">Sertifikat Profesi</a></li>
                                                                    <li><a href="#">P.A.K</a></li>
                                                                    <li><a href="#">SKP</a></li>
                                                                    <li><a href="#">Kinerja</a></li>
                                                                    <li><a href="#">Komparasi Data SIMPEG & SIASN</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </nav>    
                                </div>
                                <? 
                                }
                                ?>
                                <div class="header-menu header-menu-mobile header-menu-layout-default"></div>
                            </div>

                            <?
                            if($pg == "login"){}
                            else
                            { 
                            ?>
                            <div class="topbar">
                                <div class="topbar-item">
                                    <div class="xxxtes btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1"></span>
                                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?=$reqNama?></span>
                                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                            <span class="symbol-label font-size-h5 font-weight-bold">
                                                <i class="fa fa-user" aria-hidden="true" style="color: #FFFFFF;"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <? 
                            }
                            ?>
                        </div>
                    </div>

                    <?
                    if($pg == "login"){?>
                        <div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="background: url(images/bg-login.jpg); background-size: 100% 100%; padding: 0px;">
                            <?=$content?>
                        </div>
                    <?}
                    else 
                    {
                    ?>
                        <div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="background: url(images/bg-login.jpg); background-size: 100% 100%; padding-bottom: 0px;">
                            <?=$content?>
                        </div>
                    <?}?>

                    <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <div class="text-dark order-2 order-md-1">
                                <span class="text-muted font-weight-bold mr-2">© 2024</span>
                                <a class="text-dark-75 text-hover-primary">Pemerintah Kabupaten Mojokerto</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Main-->

        <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
            <!--begin::Header-->
            <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
                <h3 class="font-weight-bold m-0">User Profile
                <small class="text-muted font-size-sm ml-2"></small></h3>
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="offcanvas-content pr-5 mr-n5">
                <!--begin::Header-->
                <div class="d-flex align-items-center mt-5">
                    <div class="symbol symbol-100 mr-5">
                        <? 
                        $file_name_direktori ='C:\xampp\htdocs\simpeg_v2\uploads\pegawai\FOTO_BLOB-'.$reqPegawaiId.'.jpg';
						$file_name_url= 'http://220.247.172.178:7179/simpeg_v2/uploads/pegawai/FOTO_BLOB-'.$reqPegawaiId.'.jpg';
                        if (file_exists($file_name_direktori)) 
                        {
                            ?>
                            <img src="\simpeg_v2\uploads\pegawai\FOTO_BLOB-<?=$reqPegawaiId?>.jpg" alt="image" />
                            <? 
                        }
                        else
                        {
                            ?>
                            <div class="symbol-label" style="background-image:url('assets/media/users/blank.png')"></div>
                            <?
                        }
                        ?>
                        <i class="symbol-badge bg-success"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?=$adminusernama?></a>
                        <div class="text-muted mt-1"><?=$reqSatker?></div>
                        <div class="navi mt-2">
                            <a href="#" class="navi-item">
                                <span class="navi-link p-0 pb-2">
                                    <span class="navi-icon mr-1">
                                        <span class="svg-icon svg-icon-lg svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                                    <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text text-muted text-hover-primary"><?=$reqEmail?></span>
                                </span>
                            </a>
                            <?
                            if(!empty($adminuserid))
                            {
                            ?>
                            <a href="login/logout" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
                            <?
                            }
                            else
                            {
                            ?>
                            <a href="javascript:void(0);" onclick="setkembali()" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Kembali</a>
                            <?  
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="separator separator-dashed mt-8 mb-5"></div>

                <div class="navi navi-spacer-x-0 p-0">

                    <a class="navi-item">
                        <div class="navi-link">
                            <div class="navi-text">
                                <div class="font-weight-bold">My Profile</div>
                                <div class="text-muted">Account settings and more
                            </div>
                        </div>
                    </a>
                    <!--end:Item-->
                </div>
                <!--end::Nav-->
            </div>
            <!--end::Content-->
        </div>
        <!-- end::User Panel-->

    </body>
</html>