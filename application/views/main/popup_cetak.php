<head>
    <base href="<?=base_url()?>">
    <meta charset="utf-8" />
    <title>SIMPEG 2024</title>
    <meta name="description" content="User profile block example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/jstree/jstree.bundle.css" rel="stylesheet" type="text/css" />

    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/brand/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/aside/light.css" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="assets/media/logos/favicon.png" />
    <link href="assets/css/new-style.css" rel="stylesheet" type="text/css" />
    
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>

    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="assets/js/valsix-serverside.js"></script>
    <script src="assets/plugins/custom/jstree/jstree.bundle.js"></script>

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
    </style>

    <link rel="stylesheet" type="text/css" href="assets/css/gaya.css">
</head>
<?
include_once("functions/personal.func.php");

$this->load->model("base/Core");

$reqKeterangan= $this->input->get('reqKeterangan');
$reqId= $this->input->get('reqId');
$reqEror= $this->input->get('reqEror');

$diklat= new Core();
$diklat->selectByParamsDiklat(); 

$eselon= new Core();
$eselon->selectByParamsEselon(); 

$golongan= new Core();
$golongan->selectByGolongan(); 
// echo $golongan->query;exit;

$pangkat= new Core();
$pangkat->selectByParamsPangkat(); 
?>
<!-- Bootstrap core CSS -->
<!-- <link href="lib/bootstrap-3.3.7/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="lib/bootstrap-3.3.7/docs/examples/navbar/navbar.css" rel="stylesheet">
<!-- <script src="lib/bootstrap-3.3.7/dist/js/bootstrap.min.js"></script> -->

<link href="lib/select2totreemaster/src/select2totree.css" rel="stylesheet">
<script src="lib/select2/select2.min.js"></script>
<script src="lib/select2totreemaster/src/select2totree.js"></script>

<div class="d-flex flex-column-fluid">
    <div class="container">
    	<!-- <div class="area-menu-fip">
    		ffffj hai
    	</div> -->
        <div class="card card-custom">
        	<!-- <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-notepad text-primary"></i>
                    </span>
                    <h3 class="card-label">Profil Pegawai</h3>
                </div>
            </div> -->
            <!-- <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data"> -->
           	<form action="app/loadUrl/main/cetak_laporan_pegawai_excel" name="frmDaftarAlamat" method="post">
	        	<div class="card-body">
	        		<div class="row">
	        			<div class="col-md-1">
	        				<div class="form-group row">
		        				<input type="radio" class="form-control" style="height: 30px;" <?=$readonly?> name="rdoState" value="modul1" />	
			        		</div>
	        			</div>
	        			<div class="col-md-10">
	        				<div class="form-group row">
			        			 <h3 class="card-label">Profil Pegawai</h3>
			        		</div>
	        			</div>
	        			<div class="col-md-1">
	        			</div>

	        			<div class="col-md-1">
	        			</div>
			        	<div class="col-md-5">
	        				<div class="form-group row">
			        			<label class="text-right col-lg-2">Diklat</label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" name="reqDiklat">
			        					<?
											while($diklat->nextRow()){
										?>
					                    	<option value="<?=$diklat->getField('DIKLAT_ID')?>"><?=$diklat->getField('DIKLAT_ID').' '.$diklat->getField('NAMA')?></option>
					                    <? }?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-1">
	        				<div class="form-group row">
		        				<input type="radio" class="form-control" style="height: 30px;" <?=$readonly?> name="rdoState" value="modul2" />	
			        		</div>
	        			</div>
	        			<div class="col-md-10">
	        				<div class="form-group row">
			        			 <h3 class="card-label">Pegawai Eselon</h3>
			        		</div>
	        			</div>
	        			<div class="col-md-1">
	        			</div>

	        			<div class="col-md-1">
	        			</div>
			        	<div class="col-md-5">
	        				<div class="form-group row">
			        			<label class="text-right col-lg-2">Eselon </label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" name="reqEselon">
					                    <option value="">Semua Eselon</option>
			        					<?
											while($eselon->nextRow()){
										?>
					                    	<option value="<?=$eselon->getField('ESELON_ID')?>"><?=$eselon->getField('NAMA')?></option>
					                    <? }?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-5">
			        	</div>
	        			<div class="col-md-1">
	        			</div>

			       		<div class="col-md-1">
	        			</div>
			        	<div class="col-md-5">
	        				<div class="form-group row">
			        			<label class="text-right col-lg-2">Golongan </label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" name="reqGolongan">
					                    <option value="">Semua Golongan</option>
			        					<?
											while($golongan->nextRow()){
										?>
					                    	<option value="<?=$golongan->getField('GOL')?>"><?=$golongan->getField('GOL')?></option>
					                    <? }?>
			        				</select>
			        			</div>
			        		</div>
			        	</div>
			        	<div class="col-md-5">
	        				<div class="form-group row">
			        			<label class="text-right col-lg-2">Ruang </label>
			        			<div class="col-lg-9 col-sm-12">
			        				<select class="form-control" name="reqRuang">
                    					<option value="">Semua Ruang</option>
				                    <?
										while($pangkat->nextRow()){
									?>
				                    	<option value="<?=$pangkat->getField('RUANG')?>"><?=$pangkat->getField('RUANG')?></option>
				                    <? }?>
				                    </select>
			        			</div>
			        		</div>
			        	</div>
	        			<div class="col-md-1">
	        			</div>
			        </div>

			        <div class="row">
	        			<div class="col-md-1">
	        				<div class="form-group row">
		        				<input type="radio" class="form-control" style="height: 30px;" <?=$readonly?> name="rdoState" value="modul3" />	
			        		</div>
	        			</div>
	        			<div class="col-md-11">
	        				<div class="form-group row">
			        			 <h3 class="card-label">Daftar Pegawai Pemda</h3>
			        		</div>
	        			</div>
			        </div>
			    </div>

	        	<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" value="<?=$reqId?>" name="reqId"> 
	        				<input type="hidden" value="<?=$reqKeterangan?>" name="reqKeterangan">
	        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
	        				<input type="hidden" name="reqPegawaiId" value="<?=$reqId?>">
	        				<input type="hidden" name="reqTempValidasiId" value="<?=$reqTempValidasiId?>">
	        				<button onclick="document.frmDaftarAlamat.submit()" class="btn btn-primary font-weight-bold mr-2">Simpan</button>
	        			</div>
	        		</div>
	        	</div>
	        </form>
        </div>
    </div>
</div>

<?
if($reqEror==1){
	?>
	<script type="text/javascript">
		alert("Pilih satu Radio Button");
	</script>
	<?
}
?>