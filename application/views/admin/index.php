<?php
include_once("functions/string.func.php");
include_once("functions/date.func.php");

$this->load->library('globalmenu');

$reqId= $this->input->get("reqId");
// echo $reqId;exit;

/*
$this->load->model("base-data/Menu");
$menu= new Menu();
$index_set=0;
$arrMenu= [];
$set = new Menu();
$set->selectByParamsMenu(1, $this->adminuseraksesappmenu, "AKSES_APP_SIMPEG", " AND A.STATUS IS NULL", "ORDER BY A.URUT, A.MENU_ID");
// echo $set->query;exit;
while($set->nextRow())
{
    $infoakses= $set->getField("AKSES");
    $infomenuparentid= $set->getField("MENU_PARENT_ID");
    $infolinkfile= $set->getField("LINK_FILE");

    if($infoakses == "D")
        continue;

    $arrMenu[$index_set]["MENU_ID"]= $set->getField("MENU_ID");
    $arrMenu[$index_set]["MENU_PARENT_ID"]= $infomenuparentid;
    $arrMenu[$index_set]["NAMA"]= $set->getField("NAMA");
    $arrMenu[$index_set]["LINK_FILE"]= $infolinkfile;
    $arrMenu[$index_set]["AKSES"]= $infoakses;
    $arrMenu[$index_set]["JUMLAH_CHILD"]= $set->getField("JUMLAH_CHILD");
    $arrMenu[$index_set]["JUMLAH_MENU"]= $set->getField("JUMLAH_MENU");
    $arrMenu[$index_set]["JUMLAH_DISABLE"]= $set->getField("JUMLAH_DISABLE");
    $index_set++;
}
$tempMenu= $index_set;
unset($set);*/
// print_r($arrMenu);exit;

// untuk kondisi file
$vfpeg= new globalmenu();
$arrparam['mode']='admin';
// $arrMenu= harcodemenu($userstatuspegId);
$arrMenu= $vfpeg->harcodemenu($arrparam);
// print_r($arrMenu);exit;

// untuk mas arik
// $infocari= "0101";
// $arrayKey= [];
// $arrayKey= in_array_column($infocari, "MENU_ID", $arrMenu);
// print_r($arrayKey);exit;

$arrparam= ["pg"=>$pg, "id"=>$reqId];
$arrdetilheader= $vfpeg->menuheader($arrparam);
// print_r($arrdetilheader);exit;

$arrparam= ["pg"=>$pg, "arrMenu"=>$arrMenu];
$arrcarimenuparent= $vfpeg->cariparentmenu($arrparam);
// echo $arrcarimenuparent;exit;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?=base_url()?>">
        <meta charset="utf-8" />
        <title>Manajemen Talenta | Admin</title>
        <meta name="description" content="User profile block example" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
        <!-- <link href="assets/plugins/custom/jstree/jstree.bundle.css" rel="stylesheet" type="text/css" /> -->

        <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/brand/light.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/aside/light.css" rel="stylesheet" type="text/css" />

        <link rel="shortcut icon" href="images/favicon" />
        <link href="assets/css/new-style.css" rel="stylesheet" type="text/css" />

        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>

        <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
        <script src="assets/js/valsix-serverside.js"></script>
        <script src="assets/plugins/custom/jstree/jstree.bundle.js"></script>
         <link href="lib/select2totreemaster/src/select2totree.css" rel="stylesheet">
        <script src="lib/select2totreemaster/src/select2totree.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="assets/emodal/eModal.min.js"></script>
        <script>
            function openAdd(pageUrl) {
                eModal.iframe(pageUrl, 'Aplikasi')
            }
        </script>

        <script script type="text/javascript" src="js/highcharts.js"></script>

        <style type="text/css">
            .modal-dialog.modal-xl {
                /*border: 1px solid red;*/
                width: calc(100vw - 60px);
                height: calc(100vh - 60px);
                max-width: inherit;
            }
            .modal-dialog.modal-xl .modal-content .modal-header ~ div {
                /*height: calc(100vh - 110px);*/
                /*border: 1px solid red;*/
            }
            .container {
                margin-bottom: 40px;
            }
        </style>

        <script src="lib/select2/select2.min.js"></script>
        <!-- <link href="lib/select2/select2.min.css" rel="stylesheet"/> -->
        <link href="lib/select2totreemaster/src/select2totree.css" rel="stylesheet">
        <script src="lib/select2totreemaster/src/select2totree.js"></script>
        
    </head>

    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

        <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">

            <a href="admin">
                <img alt="Logo" src="assets/media/logos/logo-aplikasi.png" />
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

        <div class="d-flex flex-column flex-root">

            <div class="">
                <!--end::Aside-->
                <!--begin::Wrapper-->
                <div class="" id="kt_wrapper">
                    <div id="kt_header" class="header header-fixed">
                        <div class="container-fluid d-flex align-items-stretch">
                            <a href="admin">
                                <img alt="Logo" src="assets/media/logos/logo-aplikasi.png" style="width: 40%;" />
                            </a>
                        </div>
                        <div class="container-fluid d-flex align-items-stretch justify-content-between">
                            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                                <div class="header-menu header-menu-mobile header-menu-layout-default"></div>
                            </div>
                            <div class="topbar">
                                <?
                                $arrayKey= [];
                                $arrayKey= in_array_column("0", "MENU_PARENT_ID", $arrMenu);
                                // print_r($arrayKey);exit;
                                if(!empty($arrayKey))
                                {
                                    for($index_detil=0; $index_detil < count($arrayKey); $index_detil++)
                                    {
                                        $index_row= $arrayKey[$index_detil];
                                        $tempMenuId= $arrMenu[$index_row]["MENU_ID"];
                                        // print_r($arrMenu[$index_row]);exit;
                                        $tempNama= $arrMenu[$index_row]["NAMA"];
                                        $tempLinkFile= $arrMenu[$index_row]["LINK_FILE"];
                                        $tempAkses= $arrMenu[$index_row]["AKSES"];
                                        $tempJumlahChild= $arrMenu[$index_row]["JUMLAH_CHILD"];
                                        $tempJumlahMenu= $arrMenu[$index_row]["JUMLAH_MENU"];
                                        $tempJumlahDisable= $arrMenu[$index_row]["JUMLAH_DISABLE"];

                                        $menuopen= "";
                                        // if($index_detil == 0 && $pg == "home")
                                        if($tempMenuId == $arrcarimenuparent)
                                            $menuopen= "menu-item-open";
                                    ?>

                                    <div class="topbar-item">
                                        <div class="card-toolbar">
                                        <!--begin::Dropdown-->
                                            <div class="dropdown dropdown-inline mr-2">
                                                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="svg-icon svg-icon-md"></span><?=$tempNama?>
                                                </button>
 
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <ul class="navi flex-column navi-hover py-2">
                                                        <?
                                                        for($ii=0 ; $ii< count($arrMenu) ; $ii++)
                                                        {
                                                            if($arrMenu[$ii]['MENU_PARENT_ID']==$tempMenuId)
                                                            {
                                                        ?>
                                                                <li class="navi-item">
                                                                    <a href="admin/index/<?=$arrMenu[$ii]['LINK_FILE']?>" class="navi-link">
                                                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                                                        <span class="navi-text"><?=$arrMenu[$ii]['NAMA']?></span>
                                                                    </a>
                                                                </li>              
                                                        <?
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                    }
                                }
                                ?>
                                <div class="topbar-item">
                                    <div class="xxxtes btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                                        <!-- <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hai,</span>
                                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?=$this->adminusernama?></span> -->
                                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                            <span class="symbol-label font-size-h5 font-weight-bold"><i class="fa fa-user-circle-o" style="color: #009f3b;"></i></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                        <?
                        if(!empty($arrdetilheader))
                        {
                        ?>
                        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
                            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                <div class="d-flex align-items-center flex-wrap mr-1">
                                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                                        
                                        <ul class="nav nav-tabs nav-tabs-line">
                                            <?
                                            function getheaderdetil($arrparam)
                                            {
                                                $headerid= $arrparam["headerid"];
                                                $arrdetilheader= $arrparam["arrdetilheader"];
                                                $pg= $arrparam["pg"];
                                                $reqId= $arrparam["reqId"];

                                                $arrkey= [];
                                                $arrkey= in_array_column($headerid, "idparent", $arrdetilheader);
                                                // print_r($arrkey);exit;
                                                if(!empty($arrkey))
                                                {
                                                    foreach($arrkey as $valkey) 
                                                    {
                                                        $indexdetil= $valkey;
                                                        $headerid= $arrdetilheader[$indexdetil]["id"];
                                                        $headernama= $arrdetilheader[$indexdetil]["nama"];
                                                        $headerlinkfile= $arrdetilheader[$indexdetil]["linkfile"];
                                                        $headerjumlahanak= $arrdetilheader[$indexdetil]["jumlah_anak"];

                                                        $urllink= "";
                                                        if(!empty($headerlinkfile))
                                                        {
                                                            $urllink= "admin/index/".$headerlinkfile."?reqId=".$reqId;
                                                        }

                                                        $active= "";
                                                        if($headerlinkfile == $pg)
                                                            $active= "active";

                                                        echo '<a class="dropdown-item '.$active.'" data-toggle="tab" href="javascript:void(0)" onclick=\'setreload("'.$urllink.'")\'>'.$headernama.'</a>';
                                                    }
                                                }
                                            }

                                            $arrkey= [];
                                            $arrkey= in_array_column("0", "idparent", $arrdetilheader);
                                            // print_r($arrkey);exit;
                                            if(!empty($arrkey))
                                            {
                                                foreach($arrkey as $valkey) 
                                                {
                                                    $indexdetil= $valkey;
                                                    $headerid= $arrdetilheader[$indexdetil]["id"];
                                                    $headeridparent= $arrdetilheader[$indexdetil]["idparent"];
                                                    $headernama= $arrdetilheader[$indexdetil]["nama"];
                                                    $headerlinkfile= $arrdetilheader[$indexdetil]["linkfile"];

                                                    $urllink= "";
                                                    if(!empty($headerlinkfile))
                                                    {
                                                        if($headerid == "01")
                                                            $urllink= "admin/index/".$headerlinkfile;
                                                        else
                                                            $urllink= "admin/index/".$headerlinkfile."?reqId=".$reqId;
                                                    }

                                                    $headerjumlahanak= $arrdetilheader[$indexdetil]["jumlah_anak"];
                                                    
                                                    $active= "";
                                                    if($headerlinkfile == $pg)
                                                        $active= "active";

                                                    if($headerjumlahanak == 0)
                                                    {
                                            ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link <?=$active?>" href="javascript:void(0)" onclick="setreload('<?=$urllink?>')">
                                                            <?=$headernama?>
                                                        </a>
                                                    </li>
                                            <?
                                                    }
                                                    else
                                                    {
                                                        $headerdetilparentid= "";
                                                        $arractivekey= in_array_column($pg, "linkfile", $arrdetilheader);
                                                        if(!empty($arractivekey))
                                                        {
                                                            // print_r($arrdetilheader[$arractivekey[0]]);exit;
                                                            $headerdetilparentid= $arrdetilheader[$arractivekey[0]]["idparent"];
                                                        }

                                                        $active= "";
                                                        if($headerid == $headerdetilparentid)
                                                            $active= "active";
                                            ?>
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle <?=$active?>" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <?=$headernama?>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <?
                                                            $arrparam= ["headerid"=>$headerid, "arrdetilheader"=>$arrdetilheader, "pg"=>$pg, "reqId"=>$reqId];
                                                            getheaderdetil($arrparam);
                                                            ?>
                                                        </div>
                                                    </li>
                                            <?
                                                    }
                                                }
                                            }
                                            ?>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?
                        }
                        ?>

                        <?=$content?>
                    </div>
                    <!--end::Content-->
                    <!--begin::Footer-->
                    <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer" style="bottom: 0px;position: fixed;width: 100%;">
                        <!--begin::Container-->
                        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <!--begin::Copyright-->
                            <div class="text-dark order-2 order-md-1" style="width: 100%;text-align: center;">
                                <span class="text-muted font-weight-bold mr-2">2023©</span>
                                <a class="text-dark-75 text-hover-primary">Badan Kepegawaian Daerah Provinsi Kalimantan Timur</a>
                            </div>
                            <!--end::Copyright-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Footer-->
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
                        <div class="symbol-label" style="background-image:url('assets/media/users/blank.png')"></div>
                        <i class="symbol-badge bg-success"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">James Jones</a>
                        <div class="text-muted mt-1">Application Developer</div>
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
                                    <span class="navi-text text-muted text-hover-primary">jm@softplus.com</span>
                                </span>
                            </a>
                            <!-- <a href="adminlogin/logout" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a> -->
                            <a href="../../kaltim_new_2023/assesment" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Admin Cat</a>
                        </div>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Separator-->
                <div class="separator separator-dashed mt-8 mb-5"></div>
                <!--end::Separator-->
                <!--begin::Nav-->
                <div class="navi navi-spacer-x-0 p-0">
                    <!--begin::Item-->
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

        <script type="text/javascript">
            function setreload(varurl)
            {
                if(varurl == ""){}
                else
                document.location.href = varurl;
            }
        </script>

    </body>
</html>