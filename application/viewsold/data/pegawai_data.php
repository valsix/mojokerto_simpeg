<?
include_once("functions/personal.func.php");

$this->load->model("base-data/Pegawai");
$this->load->model("base-data/Satker");
$this->load->model("base-data/Agama");
$this->load->model("base-data/TipePegawai");
$this->load->model("base-data/Kedudukan");
$this->load->model("base-data/JenisPegawai");
$this->load->model("base-data/StatusPegawai");

$reqPegawaiId= $this->pegawaiId;
$reqSatkerId= $this->input->get('reqSatkerId');
// print_r($reqPegawaiId);exit;

$adminuserid= $this->adminuserid;

$folder = $this->config->item('simpeg');


$set= new Agama();
$arragama= [];
$set->selectByParams();
// echo $set->query;exit;
while($set->nextRow())
{
	$arrdata= [];
	$arrdata["id"]= $set->getField("AGAMA_ID");
	$arrdata["text"]= $set->getField("NAMA");
	array_push($arragama, $arrdata);
}
unset($set);

$set= new StatusPegawai();
$arrstatuspegawai= [];
$set->selectByParams();
// echo $set->query;exit;
while($set->nextRow())
{
	$arrdata= [];
	$arrdata["id"]= $set->getField("STATUS_PEGAWAI_ID");
	$arrdata["text"]= $set->getField("NAMA");
	array_push($arrstatuspegawai, $arrdata);
}
unset($set);

$set   = new Pegawai();
$record= $set->getCountByParams(array("PEGAWAI_ID"=>$reqPegawaiId));
$reqMode="";
if($record > 0)
{
	$reqMode="update";
	$set->selectByParams(array("P.PEGAWAI_ID"=>$reqPegawaiId),-1,-1);	
}
else
{
	$reqMode="insert";
}
$set->firstRow();
// echo $set->query;exit;
$reqTempValidasiId= $set->getField('TEMP_VALIDASI_ID');
$reqValidasi= $set->getField('VALIDASI');
$reqPerubahanData= $set->getField('PERUBAHAN_DATA');
if(!empty($reqValidasi))
{
	$reqPerubahanData= "";
}

$reqNipLama= $set->getField('NIP_LAMA');
$reqNipBaru= $set->getField('NIP_BARU');
$reqNama= $set->getField('NAMA');
$reqTipePegawai= $set->getField('TIPE_PEGAWAI_ID');
$reqGelarDepan= $set->getField('GELAR_DEPAN');
$reqGelarBelakang= $set->getField('GELAR_BELAKANG');
$reqStatusPegawai= $set->getField('STATUS_PEGAWAI');$valStatusPegawai= checkwarna($reqPerubahanData, 'STATUS_PEGAWAI', $arrstatuspegawai, array("id", "text"));
$reqTempatLahir= $set->getField('TEMPAT_LAHIR');$valTempatLahir= checkwarna($reqPerubahanData, 'TEMPAT_LAHIR');
$reqTanggalLahir= dateToPageCheck($set->getField('TANGGAL_LAHIR'));$valTanggalLahir= checkwarna($reqPerubahanData, 'TANGGAL_LAHIR', "date");
$reqTglPensiun= dateToPageCheck($set->getField('TANGGAL_PENSIUN'));
$reqJenisKelamin= $set->getField('JENIS_KELAMIN');
$reqJenisPegawai= $set->getField('JENIS_PEGAWAI_ID');
$reqStatusPernikahan= $set->getField('STATUS_KAWIN');
$reqKartuPegawai= $set->getField('KARTU_PEGAWAI');
$reqSukuBangsa= $set->getField('SUKU_BANGSA');$valSukuBangsa= checkwarna($reqPerubahanData, 'SUKU_BANGSA');
$reqGolDarah= $set->getField('GOLONGAN_DARAH');
$reqAkses= $set->getField('ASKES');
$reqTaspen= $set->getField('TASPEN');
$reqAlamat= $set->getField('ALAMAT');$valAlamat= checkwarna($reqPerubahanData, 'ALAMAT');
$reqNPWP= $set->getField('NPWP');
$reqNIK= $set->getField('NIK');
$reqRT= $set->getField('RT');
$reqRW= $set->getField('RW');
$reqEmail= $set->getField('EMAIL');$valEmail= checkwarna($reqPerubahanData, 'EMAIL');
$reqPropinsiId= $set->getField('PROPINSI_ID');
$reqPropinsi= $set->getField('PROPINSI_NAMA');
$reqKabupatenId= $set->getField('KABUPATEN_ID');
$reqKabupaten= $set->getField('KABUPATEN_NAMA');
$reqKecamatanId= $set->getField('KECAMATAN_ID');
$reqKecamatan= $set->getField('KECAMATAN_NAMA');
$reqDesaId= $set->getField('KELURAHAN_ID');
$reqDesa= $set->getField('KELURAHAN_NAMA');
$reqBank= $set->getField('BANK_ID');
$reqNoRekening= $set->getField('NO_REKENING');
$reqPangkatTerkahir= $set->getField('GOL_RUANG');
$reqTMTPangkat= $set->getField('TMT_PANGKAT');
$reqJabatanTerkahir= $set->getField('JABATAN');
$reqTMTJabatan= $set->getField('TMT_JABATAN');
$reqPendidikanTerkahir= $set->getField('PENDIDIKAN');
$reqJurusanTerkahir= $set->getField('JURUSAN');
$reqTahunLulus= $set->getField('TAHUN');
$reqGambar= $set->getField('FOTO_BLOB');
$reqAgamaId= $set->getField('AGAMA_ID');$valAgamaId= checkwarna($reqPerubahanData, 'AGAMA_ID', $arragama, array("id", "text"));
$reqTelepon= $set->getField('TELEPON');
$reqKodePos= $set->getField('KODEPOS');
$reqKedudukanId= $set->getField('KEDUDUKAN_ID');
$reqKonversiNIP= $set->getField('SK_KONVERSI_NIP');
$reqSatuanKerjaNama= $set->getField('NMSATKER');
$reqSatuanKerja= $set->getField('SATKER_ID');
$reqFotoBlob= $set->getField('FOTO_BLOB');
$reqFotoBlobOther=$set->getField('FOTO_BLOB_OTHER');
$reqFileId= $set->getField('PEGAWAI_FILE_ID');
$reqLinkFileFoto= $set->getField('LINK_FILE_FOTO');
$reqLinkFileKarpeg= $set->getField('LINK_FILE_KARPEG');
$reqLinkFileAskes= $set->getField('LINK_FILE_ASKES');
$reqLinkFileTaspen= $set->getField('LINK_FILE_TASPEN');
$reqLinkFileNpwp= $set->getField('LINK_FILE_NPWP');
$reqLinkFileNik= $set->getField('LINK_FILE_NIK');
$reqLinkFileSk= $set->getField('LINK_FILE_SK');



unset($set);
// print_r($reqPerubahanData);exit;

if($reqStatusPegawai == '6' || $reqStatusPegawai == '5')
	$reqStatusLabelTanggal= 'Wafat';
else
	$reqStatusLabelTanggal= 'Pensiun';
	
if($reqSatkerId == ""){}
else
{
	$satker = new Satker();
	$satker->selectByParams(array("A.SATKER_ID"=> $reqSatkerId),-1,-1,'');
	$satker->firstRow();
	$reqSatuanKerjaNama = $satker->getField('SATKER_FULL');
	$reqSatuanKerja	 = $reqSatkerId;
}

$set= new TipePegawai();
$arrtipepegawai= [];
$set->selectByParams();
// echo $set->query;exit;
while($set->nextRow())
{
	$arrdata= [];
	$arrdata["id"]= $set->getField("TIPE_PEGAWAI_ID");
	$arrdata["text"]= $set->getField("NAMA");
	$arrdata["parent"]= $set->getField("TIPE_PEGAWAI_ID_PARENT");
	array_push($arrtipepegawai, $arrdata);
}
unset($set);

$readonly = "";
// print_r($folder);exit;

?>
<style type="text/css">
	   select[readonly].select2-hidden-accessible + .select2-container {
        pointer-events: none;
        touch-action: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
        background: #F3F6F9;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
        display: none;
    }

</style>
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Data Pegawai</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Identitas Pegawai</a>
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
                    <h3 class="card-label">Identitas Pegawai</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
	        				NIP Lama
	        			</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" <?=$readonly?>  placeholder="Masukkan NIP lama"name="reqNipLama" id="reqNipLama" value="<?=$reqNipLama?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">NIP Baru</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" <?=$readonly?>  placeholder="Masukkan NIP baru" name="reqNipBaru" id="reqNipBaru" value="<?=$reqNipBaru?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Nama</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" <?=$readonly?>  name="reqNama" id="reqNama" placeholder="Masukkan nama anda" value="<?=$reqNama?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Agama
		        			<?
	        				if(!empty($valAgamaId['data']))
	        				{
	        				?>
	        				<i class="fa fa-question-circle" rel="tooltip" data-html="true" title="<?=$valAgamaId['data']?>"></i>
	        				<?
	        				}
	        				?>
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<select class="form-control select2 <?=$valAgamaId['warna']?>"  <?=$readonly?>  id="ktagamaid" name="reqAgamaId">
	        					<option value=""></option>
	        					<?
	        					// $reqAgamaId= "1";
	        					foreach($arragama as $item) 
	        					{
	        						$selectvalid= $item["id"];
	        						$selectvaltext= $item["text"];
	        					?>
	        					<option value="<?=$selectvalid?>" <? if($reqAgamaId == $selectvalid) echo "selected";?>><?=$selectvaltext?></option>
	        					<?
	        					}
	        					?>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Gelar Depan</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" <?=$readonly?>  placeholder="Masukkan gelar depan" name="reqGelarDepan"  id="reqGelarDepan" value="<?=$reqGelarDepan?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Gelar Belakang</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" <?=$readonly?> placeholder="Masukkan gelar belakang" name="reqGelarBelakang" id="reqGelarBelakang" value="<?=$reqGelarBelakang?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
	        				Tempat Lahir
	        				<?
	        				if(!empty($valTempatLahir['data']))
	        				{
	        				?>
	        				<i class="fa fa-question-circle" rel="tooltip" data-html="true" title="<?=$valTempatLahir['data']?>"></i>
	        				<?
	        				}
	        				?>
	        			</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" <?=$readonly?>  class="form-control <?=$valTempatLahir['warna']?>" placeholder="Masukkan tempat lahir" name="reqTempatLahir"  id="reqTempatLahir" value="<?=$reqTempatLahir?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Tanggal Lahir
		        			<?
	        				if(!empty($valTanggalLahir['data']))
	        				{
	        				?>
	        				<i class="fa fa-question-circle" rel="tooltip" data-html="true" title="<?=$valTanggalLahir['data']?>"></i>
	        				<?
	        				}
	        				?>
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" class="form-control <?=$valTanggalLahir['warna']?>" name="reqTanggalLahir" id="kttanggallahir"   placeholder="Select date" value="<?=$reqTanggalLahir?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jenis Kelamin</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<select class="form-control select2" id="ktjeniskelamin"  name="reqJenisKelamin" >
	        					<option value="L" <? if($reqJenisKelamin == 'L') echo 'selected';?>>L</option>
	        					<option value="P" <? if($reqJenisKelamin == 'P') echo 'selected';?>>P</option>
	        				</select>
	        			</div>
	        			<label class="col-form-label text-right col-lg-4 col-sm-12">Status Pernikahan</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<select class="form-control select2" id="ktstatuspernikahan"  name="reqStatusPernikahan" >
	        					<option value="1" <? if($reqStatusPernikahan == "1") echo 'selected'?>>Belum Kawin</option>
	        					<option value="2" <? if($reqStatusPernikahan == "2") echo 'selected'?>>Kawin</option>
	        					<option value="3" <? if($reqStatusPernikahan == "3") echo 'selected'?>>Janda</option>
	        					<option value="4" <? if($reqStatusPernikahan == "4") echo 'selected'?>>Duda</option>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Suku Bangsa
	        				<?
	        				if(!empty($valSukuBangsa['data']))
	        				{
	        				?>
	        				<i class="fa fa-question-circle" rel="tooltip" data-html="true" title="<?=$valSukuBangsa['data']?>"></i>
	        				<?
	        				}
	        				?>
	        			</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control <?=$valSukuBangsa['warna']?>" placeholder="Masukkan suku bangsa" name="reqSukuBangsa"  id="reqSukuBangsa" value="<?=$reqSukuBangsa?>"/>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Gol Darah</label>
	        			<div class="col-lg-2 col-sm-12">
	        				<select class="form-control select2 " id="ktgoldarah" name="reqGolDarah" >
	        					<option></option>
	        					<option value="A" <? if(trim($reqGolDarah) == "A") echo 'selected'?>>A</option>
	        					<option value="B" <? if(trim($reqGolDarah) == "B") echo 'selected'?>>B</option>
	        					<option value="AB" <? if(trim($reqGolDarah) == "AB") echo 'selected'?>>AB</option>
	        					<option value="O" <? if(trim($reqGolDarah) == "O") echo 'selected'?>>O</option>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">
		        			Alamat
		        			<?
	        				if(!empty($valAlamat['data']))
	        				{
	        				?>
	        				<i class="fa fa-question-circle" rel="tooltip" data-html="true" title="<?=$valAlamat['data']?>"></i>
	        				<?
	        				}
	        				?>
		        		</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<textarea class="form-control <?=$valAlamat['warna']?>" name="reqAlamat" cols="46" placeholder="Masukkan suku alamat" > <?=$reqAlamat?></textarea>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Telepon/HP</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" placeholder="Masukkan kontak"  name="reqTelepon" id="reqTelepon" value="<?=$reqTelepon?>" />
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Email *
	        				<?
	        				if(!empty($valEmail['data']))
	        				{
	        				?>
	        				<i class="fa fa-question-circle" rel="tooltip" data-html="true" title="<?=$valEmail['data']?>"></i>
	        				<?
	        				}
	        				?>
	        			</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control <?=$valEmail['warna']?>" placeholder=" Masukkan email" name="reqEmail" id="reqEmail" value="<?=$reqEmail?>" />
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Foto</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<?if(empty($reqLinkFileFoto))
	        				{
	        					?>
	        					<input type="button" id="upload" class="btn btn-success font-weight-bold mr-2" value="Upload" onclick="document.getElementById('reqLinkFileFoto').click();" />
	        					<input type="file" style="display:none;" id="reqLinkFileFoto" name="reqLinkFileFoto"  accept="image/jpeg"/>
	        					<? 
	        					$file_name_direktori = "../".$folder."/uploads/pegawai/FOTO_BLOB-".$reqPegawaiId.".jpg";
	        					if (file_exists($file_name_direktori)) 
	        					{
	        						?>
	        						<a class="btn btn-primary font-weight-bold mr-2" href="<?=$file_name_direktori?>" target="_blank">Download</a>
	        						<? 
	        					}
	        					?>
	        					<?
	        				}
	        				else
	        				{
	        					?>
	        					<a class="btn btn-primary font-weight-bold mr-2" href="app/loadUrl/admin/viewer?reqForm=pegawai_foto&reqFileId=<?=$reqFileId?>" target="_blank">Download</a>
	        					<a class="btn btn-danger font-weight-bold mr-2" onclick="btndeletefile('<?=$reqFileId?>','<?=$reqPegawaiId?>','pegawai_foto')">Hapus File</a>
	        					<?
	        				}
	        				?>
	        			</div>
	        		</div>
	        		<? 
	        		// if($reqPegawaiId == ""){}
	        		// else
	        		// {
	        		?>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pangkat Terakhir</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<?=$reqPangkatTerkahir?>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Pangkat</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<?=$reqTMTPangkat?>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Jabatan Terakhir</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<?=$reqJabatanTerkahir?>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">TMT Jabatan</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<?=$reqTMTJabatan?>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Pendidikan Terakhir</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<?=$reqPendidikanTerkahir.' '.$reqJurusanTerkahir?>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tahun Lulus</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<?=$reqTahunLulus?>
	        			</div>
	        		</div> 
	        		<? 
	        		// }
	        		?>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Satuan Kerja</label>
	        			<div class="col-lg-10 col-sm-12">
	        				<select class="form-control select2" <?=$readonly?> id="ktsatuankerja" name="reqSatuanKerjaNama">
	        					<option value="<?=$reqSatuanKerja?>"><?=$reqSatuanKerjaNama?></option>
	        				</select>
	        				<span class="form-text text-muted"><label id="satkerdetil"></label></span>
	        				<input type="hidden" name="reqSatuanKerja" id="reqSatuanKerja" value="<?=$reqSatuanKerja?>" >
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12"  style="display: none">Tipe Pegawai</label>
	        			<div class="col-lg-4 col-sm-12"  style="display: none">
	        				<select class="form-control select2" <?=$readonly?> id="kttipepegawai" name="reqTipePegawai">
	        					<?
	        					foreach($arrtipepegawai as $item) 
	        					{
	        						$selectvalid= $item["id"];
	        						$selectvaltext= $item["text"];
	        						$selectvalparent= $item["parent"];
	        						$countid = strlen($selectvalid);
	        					?>
	        					<option value="<?=$selectvalid?>" 
	        						<? if($reqTipePegawaiId == $selectvalid) echo "selected";
	        						?>>
	        						<?
	        							if($selectvalparent == 0)
	        							{
	        								echo $selectvalid.'.'.$selectvaltext;
	        								
	        							}
	        							else if ($countid == 4) 
	        							{
	        								echo substr($selectvalid,0,1).'.'.substr($selectvalid,1,1).'.'.substr($selectvalid,2).'.'.$selectvaltext;
	        							}
	        							else
	        							{
	        								echo substr($selectvalid,0,1).'.'.substr($selectvalid,1).'.'.$selectvaltext;
	        							}
	        						?>
	        						</option>
	        					<?
	        					}
	        					?>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Tanggal Pensiun</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<div class="input-group date">
		        				<input type="text" class="form-control" id="kttanggalpensiun" readonly placeholder="Select date" name="reqTglPensiun" value="<?=$reqTglPensiun?>" />
		        				<div class="input-group-append">
		        					<span class="input-group-text">
		        						<i class="la la-calendar"></i>
		        					</span>
		        				</div>
		        			</div>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Status Pegawai
	        			</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<select class="form-control select2" readonly id="ktstatuspegawai" name="reqStatusPegawai">
	        					<?
	        					foreach($arrstatuspegawai as $item) 
	        					{
	        						$selectvalid= $item["id"];
	        						$selectvaltext= $item["text"];
	        					?>
	        					<option value="<?=$selectvalid?>" <? if($reqStatusPegawai == $selectvalid) echo "selected";?>><?=$selectvaltext?></option>
	        					<?
	        					}
	        					?>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Kartu Pegawai</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqKartuPegawai" id="reqKartuPegawai" value="<?=$reqKartuPegawai?>" />
	        				<br>
	        				<?if(!file_exists($reqLinkFileKarpeg))
	        				{
	        					?>
	        					<input type="button" id="uploadkarpeg" class="btn btn-success font-weight-bold mr-2" value="Upload" onclick="document.getElementById('reqLinkFileKarpeg').click();" />
	        					<input type="file" style="display:none;" id="reqLinkFileKarpeg" name="reqLinkFileKarpeg"  accept=".pdf"/>
	        					<? 
	        					$file_name_direktori = "../".$folder."/uploads/pegawai/DOSIR_KARPEG-".$reqPegawaiId.".pdf";
	        					if (file_exists($file_name_direktori)) 
	        					{
	        						?>
	        						<a class="btn btn-primary font-weight-bold mr-2" href="<?=$file_name_direktori?>" target="_blank">Download</a>
	        						<? 
	        					}
	        					?>
	        					<?
	        				}
	        				else
	        				{
	        					?>
	        					<a class="btn btn-primary font-weight-bold mr-2" href="app/loadUrl/admin/viewer?reqForm=pegawai_karpeg&reqFileId=<?=$reqFileId?>" target="_blank">Download</a>
	        					<a class="btn btn-danger font-weight-bold mr-2" onclick="btndeletefile('<?=$reqFileId?>','<?=$reqPegawaiId?>','pegawai_karpeg')">Hapus File</a>
	        					<?
	        				}
	        				?>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Askes</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqAkses" id="reqAkses" value="<?=$reqAkses?>" />
	        				<br>
	        				<?if(!file_exists($reqLinkFileAskes))
	        				{
	        					?>
	        					<input type="button" id="uploadaskes" class="btn btn-success font-weight-bold mr-2" value="Upload" onclick="document.getElementById('reqLinkFileAskes').click();" />
	        					<input type="file" style="display:none;" id="reqLinkFileAskes" name="reqLinkFileAskes"  accept=".pdf"/>
	        					<? 
	        					$file_name_direktori = "../".$folder."/uploads/pegawai/DOSIR_ASKES-".$reqPegawaiId.".pdf";
	        					if (file_exists($file_name_direktori)) 
	        					{
	        						?>
	        						<a class="btn btn-primary font-weight-bold mr-2" href="<?=$file_name_direktori?>" target="_blank">Download</a>
	        						<? 
	        					}
	        					?>
	        					<?
	        				}
	        				else
	        				{
	        					?>
	        					<a class="btn btn-primary font-weight-bold mr-2" href="app/loadUrl/admin/viewer?reqForm=pegawai_askes&reqFileId=<?=$reqFileId?>" target="_blank">Download</a>
	        					<a class="btn btn-danger font-weight-bold mr-2" onclick="btndeletefile('<?=$reqFileId?>','<?=$reqPegawaiId?>','pegawai_askes')">Hapus File</a>
	        					<?
	        				}
	        				?>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">Taspen</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqTaspen" id="reqTaspen" value="<?=$reqTaspen?>" />
	        				<br>
	        				<?if(!file_exists($reqLinkFileTaspen))
	        				{
	        					?>
	        					<input type="button" id="uploadtaspen" class="btn btn-success font-weight-bold mr-2" value="Upload" onclick="document.getElementById('reqLinkFileTaspen').click();" />
	        					<input type="file" style="display:none;" id="reqLinkFileTaspen" name="reqLinkFileTaspen"  accept=".pdf"/>
	        					<? 
	        					$file_name_direktori = "../".$folder."/uploads/pegawai/DOSIR_TASPEN-".$reqPegawaiId.".pdf";
	        					if (file_exists($file_name_direktori)) 
	        					{
	        						?>
	        						<a class="btn btn-primary font-weight-bold mr-2" href="<?=$file_name_direktori?>" target="_blank">Download</a>
	        						<? 
	        					}
	        					?>
	        					<?
	        				}
	        				else
	        				{
	        					?>
	        					<a class="btn btn-primary font-weight-bold mr-2" href="app/loadUrl/admin/viewer?reqForm=pegawai_taspen&reqFileId=<?=$reqFileId?>" target="_blank">Download</a>
	        					<a class="btn btn-danger font-weight-bold mr-2" onclick="btndeletefile('<?=$reqFileId?>','<?=$reqPegawaiId?>','pegawai_taspen')">Hapus File</a>
	        					<?
	        				}
	        				?>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">NPWP</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqNPWP" id="reqNPWP" value="<?=$reqNPWP?>" />
	        				<br>
	        				<?if(!file_exists($reqLinkFileNpwp))
	        				{
	        					?>
	        					<input type="button" id="uploadnpwp" class="btn btn-success font-weight-bold mr-2" value="Upload" onclick="document.getElementById('reqLinkFileNpwp').click();" />
	        					<input type="file" style="display:none;" id="reqLinkFileNpwp" name="reqLinkFileNpwp"  accept=".pdf"/>
	        					<? 
	        					$file_name_direktori = "../".$folder."/uploads/pegawai/DOSIR_NPWP-".$reqPegawaiId.".pdf";
	        					if (file_exists($file_name_direktori)) 
	        					{
	        						?>
	        						<a class="btn btn-primary font-weight-bold mr-2" href="<?=$file_name_direktori?>" target="_blank">Download</a>
	        						<? 
	        					}
	        					?>
	        					<?
	        				}
	        				else
	        				{
	        					?>
	        					<a class="btn btn-primary font-weight-bold mr-2" href="app/loadUrl/admin/viewer?reqForm=pegawai_npwp&reqFileId=<?=$reqFileId?>" target="_blank">Download</a>
	        					<a class="btn btn-danger font-weight-bold mr-2" onclick="btndeletefile('<?=$reqFileId?>','<?=$reqPegawaiId?>','pegawai_npwp')">Hapus File</a>
	        					<?
	        				}
	        				?>
	        			</div>
	        		</div>
	        		<div class="form-group row">
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">NIK</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqNIK" id="reqNIK" value="<?=$reqNIK?>" />
	        				<br>
	        				<?if(!file_exists($reqLinkFileNik))
	        				{
	        					?>
	        					<input type="button" id="uploadnik" class="btn btn-success font-weight-bold mr-2" value="Upload" onclick="document.getElementById('reqLinkFileNik').click();" />
	        					<input type="file" style="display:none;" id="reqLinkFileNik" name="reqLinkFileNik"  accept=".pdf"/>
	        					<? 
	        					$file_name_direktori = "../".$folder."/uploads/pegawai/DOSIR_NIK-".$reqPegawaiId.".pdf";
	        					if (file_exists($file_name_direktori)) 
	        					{
	        						?>
	        						<a class="btn btn-primary font-weight-bold mr-2" href="<?=$file_name_direktori?>" target="_blank">Download</a>
	        						<? 
	        					}
	        					?>
	        					<?
	        				}
	        				else
	        				{
	        					?>
	        					<a class="btn btn-primary font-weight-bold mr-2" href="app/loadUrl/admin/viewer?reqForm=pegawai_nik&reqFileId=<?=$reqFileId?>" target="_blank">Download</a>
	        					<a class="btn btn-danger font-weight-bold mr-2" onclick="btndeletefile('<?=$reqFileId?>','<?=$reqPegawaiId?>','pegawai_nik')">Hapus File</a>
	        					<?
	        				}
	        				?>
	        			</div>
	        			<label class="col-form-label text-right col-lg-2 col-sm-12">SK Konversi NIP</label>
	        			<div class="col-lg-4 col-sm-12">
	        				<input type="text" class="form-control" name="reqKonversiNIP" id="reqKonversiNIP" value="<?=$reqKonversiNIP?>" />
	        				<br>
	        				<?if(!file_exists($reqLinkFileSk))
	        				{
	        					?>
	        					<input type="button" id="uploadsk" class="btn btn-success font-weight-bold mr-2" value="Upload" onclick="document.getElementById('reqLinkFileSk').click();" />
	        					<input type="file" style="display:none;" id="reqLinkFileSk" name="reqLinkFileSk"  accept=".pdf"/>
	        					<? 
	        					$file_name_direktori = "../".$folder."/uploads/pegawai/DOSIR_SK_KONVERSI-".$reqPegawaiId.".pdf";
	        					if (file_exists($file_name_direktori)) 
	        					{
	        						?>
	        						<a class="btn btn-primary font-weight-bold mr-2" href="<?=$file_name_direktori?>" target="_blank">Download</a>
	        						<? 
	        					}
	        					?>
	        					<?
	        				}
	        				else
	        				{
	        					?>
	        					<a class="btn btn-primary font-weight-bold mr-2" href="app/loadUrl/admin/viewer?reqForm=pegawai_sk&reqFileId=<?=$reqFileId?>" target="_blank">Download</a>
	        					<a class="btn btn-danger font-weight-bold mr-2" onclick="btndeletefile('<?=$reqFileId?>','<?=$reqPegawaiId?>','pegawai_sk')">Hapus File</a>
	        					<?
	        				}
	        				?>
	        			</div>
	        		</div>
	        		
	        	</div>
	        	<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqMode" value="<?=$reqMode?>">
	        				<button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
	        			</div>
	        		</div>
	        	</div>
	        </form>
        </div>
    </div>
</div>

<script type="text/javascript">

	$(document).ready(function() {
		$('#reqLinkFileFoto').change(function() {
			var reqLinkFileFoto = $('#reqLinkFileFoto').val().split('\\').pop();
			var lastIndex = reqLinkFileFoto.lastIndexOf("\\");   
			$('#upload').val(reqLinkFileFoto);
		});
		$('#reqLinkFileKarpeg').change(function() {
			var reqLinkFileKarpeg = $('#reqLinkFileKarpeg').val().split('\\').pop();
			var lastIndex = reqLinkFileKarpeg.lastIndexOf("\\");   
			$('#uploadkarpeg').val(reqLinkFileKarpeg);
		});
		$('#reqLinkFileAskes').change(function() {
			var reqLinkFileAskes = $('#reqLinkFileAskes').val().split('\\').pop();
			var lastIndex = reqLinkFileAskes.lastIndexOf("\\");   
			$('#uploadaskes').val(reqLinkFileAskes);
		});
		$('#reqLinkFileTaspen').change(function() {
			var reqLinkFileTaspen = $('#reqLinkFileTaspen').val().split('\\').pop();
			var lastIndex = reqLinkFileTaspen.lastIndexOf("\\");   
			$('#uploadtaspen').val(reqLinkFileTaspen);
		});
		$('#reqLinkFileNpwp').change(function() {
			var reqLinkFileNpwp = $('#reqLinkFileNpwp').val().split('\\').pop();
			var lastIndex = reqLinkFileNpwp.lastIndexOf("\\");   
			$('#uploadnpwp').val(reqLinkFileNpwp);
		});
		$('#reqLinkFileNik').change(function() {
			var reqLinkFileNik = $('#reqLinkFileNik').val().split('\\').pop();
			var lastIndex = reqLinkFileNik.lastIndexOf("\\");   
			$('#uploadnik').val(reqLinkFileNik);
		});
		$('#reqLinkFileSk').change(function() {
			var reqLinkFileSk = $('#reqLinkFileSk').val().split('\\').pop();
			var lastIndex = reqLinkFileSk.lastIndexOf("\\");   
			$('#uploadsk').val(reqLinkFileSk);
		});
	});

	$(function () {
		$("[rel=tooltip]").tooltip({ placement: 'right'});
		// $('[data-toggle="tooltip"]').tooltip()
	})

	function tampilSatuanKerja(satker) {
        if (satker.loading) return satker.text;
        var markup = "<div class='select2-result-repository clearfix'>" +
	            "<div class='select2-result-repository__meta'>" +
	            	"<div class='select2-result-repository__title'>" + satker.description + "</div>" +
	            "</div>" +
            "</div>";
        return markup;
    }
    function pilihSatuanKerja(satker) {
    	$("#satkerdetil").text(satker.description);
    	$("#reqSatuanKerja").val(satker.id);
        // console.log(satker);
        return satker.text;
    }
	$('#ktagamaid').select2({
		placeholder: "Pilih agama"
	});
	$('#ktjeniskelamin').select2({
		placeholder: "Pilih jenis kelamin"
	});
	$('#ktstatuspernikahan').select2({
		placeholder: "Pilih Status"
	});
	$('#ktgoldarah').select2({
		placeholder: "Piih gol darah"
	});
	$('#kttipepegawai').select2({
		placeholder: "Piih tipe pegawai"
	});
	$('#ktstatuspegawai').select2({
		placeholder: "Piih status pegawai"
	});
	$("#ktsatuankerja").select2({
        placeholder: "Pilih satuan kerja",
        allowClear: true,
        ajax: {
            url: "json-data/combo_json/autocompletesatuankerja",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                    , page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data.items
                    , pagination: {
                        more: (params.page * 30) < data.total_count && data.items != ""
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: tampilSatuanKerja, // omitted for brevity, see the source of this page
        templateSelection: pilihSatuanKerja // omitted for brevity, see the source of this page
    });
    arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
	$('#kttanggallahir').datepicker({
		todayHighlight: true
		, autoclose: true
		, orientation: "bottom left"
		, clearBtn: true
		, format: 'dd-mm-yyyy'
		, templates: arrows
	});
	$('#kttanggalpensiun').datepicker({
		todayHighlight: true
		, autoclose: true
		, orientation: "bottom left"
		, clearBtn: true
		, format: 'dd-mm-yyyy'
		, templates: arrows
	});
	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-data/personal_json/jsonpegawaidataadd";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqEmail: {
						validators: {
							notEmpty: {
								message: 'Email is required'
							},
							emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					},
					reqSatuanKerjaNama: {
						validators: {
							notEmpty: {
								message: 'Please select an option'
							}
						}
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					submitButton: new FormValidation.plugins.SubmitButton(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
			)
		.on('core.form.valid', function() {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				var formData = new FormData(document.querySelector('form'));
				$.ajax({
					url: formSubmitUrl,
					data: formData,
					processData: false,
					contentType: false,
					type: 'POST',
					dataType: 'json',
					success: function (response) {
			        	// console.log(response); return false;
			        	// Swal.fire("Good job!", "You clicked the button!", "success");
			        	Swal.fire({
			        		text: response.message,
			        		icon: "success",
			        		buttonsStyling: false,
			        		confirmButtonText: "Ok",
			        		customClass: {
			        			confirmButton: "btn font-weight-bold btn-light-primary"
			        		}
			        	}).then(function() {
			        		document.location.href = "data/index/pegawai_data";
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
			})
		.on('core.form.invalid', function() {
			Swal.fire({
				text: "Sorry, looks like there are some errors detected, please try again.",
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			}).then(function() {
				KTUtil.scrollTop();
			});
		});
	});

	function btndeletefile(fileid,reqPegawaiId,reqMode) {
		if(fileid !== "")
        {
            urlAjax= "json-data/personal_json/jsonpegawaideletefile?reqFileId="+fileid+"&reqPegawaiId="+reqPegawaiId+"&reqMode="+reqMode;
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
</script>

