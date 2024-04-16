<?
$this->load->library("crfs_protect"); $csrf = new crfs_protect('_crfs_login');

// $username= "bag_pemerintahan";
$username= "admin";
$pass= "admin";

$sessinfopesan= $this->sessinfopesan;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?=base_url()?>">
        <meta charset="utf-8" />
        <title>Aplikasi Manajemen Talenta</title>
        <meta name="description" content="Login page example" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="canonical" href="https://keenthemes.com/metronic" />
        <link href="assets/css/pages/login/classic/login-4.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="assets/media/logos/favicon.png" />
        <link href="assets/css/new-style.css" rel="stylesheet" type="text/css" />
        
        <style type="text/css">
            body {
                
                /*background: url(images/bg-login.jpg);*/
                /*background-size: 100% 100%;*/
            }
            #kt_login {
                /*border: 1px solid cyan;*/
                background: url(images/bg-candi.png) bottom right no-repeat;
                background-size: 500px auto;
            }
            .header-fixed.subheader-fixed .header {
                background-color: #FFFFFF;
            }
        </style>
        
    </head>

    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <div class="d-flex flex-column flex-root">
            <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
                <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat">
                    <div class="col-md-7 area-kanan-login">
                        <div class="login-form text-center p-7 position-relative overflow-hidden" style="border-radius: 20px; background-color: #fffdfc; box-shadow: 1px 8px 8px rgba(0,0,0,0.2);">                            
                            <div class="nama-aplikasi">
                                <img src="images/logo-mojokerto.png" style="width: 100px"><br>
                                <h4><strong>Aplikasi Simpeg Mojokerto</strong></h4>
                            </div>
                            <div class="login-signin">
                                <form class="form" id="kt_login_signin_form" action="login/action" method="post">
                                    <div class="form-group mb-5">
                                        <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="NIP Baru" name="reqUser" autocomplete="off" value="<?=$username?>" />
                                    </div>
                                    <div class="form-group mb-5">
                                        <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="reqPasswd" value="<?=$pass?>" />
                                    </div>

                                    <?
                                    if(!empty($sessinfopesan))
                                    {
                                    ?>
                                    <div class="form-group mb-5">
                                        <label class="text-danger"><?=$sessinfopesan?></label>
                                    </div>
                                    <?
                                    }
                                    ?>
                                    <div class="form-group mb-5">
                                        <?=$csrf->echoInputField();?>
                                    </div>
                                    <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">LOGIN</button>

                                    <input type="hidden" name="reqMode" value="submitLogin"/>
                                    <span><?=$pesan?></span>
                                </form>
									
                            </div>
			
                        </div>
                    </div>
                    
                </div>
            </div>
            <? /* ?>
			<footer class="container" style="bottom:0">
                 <center><p id="footer-text"><strong>Copyright &copy; 2024 <br><a href="https://mojokertokab.go.id/">Pemerintah Kabupaten Mojokerto</a></strong></p></center>
            </footer>
            <? */ ?>
        </div>

        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>

    </body>
</html>