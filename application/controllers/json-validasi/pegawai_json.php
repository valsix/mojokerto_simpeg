<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class pegawai_json extends CI_Controller {

	function __construct() {
		parent::__construct();
		//kauth

		$CI =& get_instance();
		$configdata= $CI->config;
        $configvlxsessfolder= $configdata->config["vlxsessfolder"];

        $redirectlogin= "";
        if(!empty($this->session->userdata("adminuserid".$configvlxsessfolder)))
        {
        	$redirectlogin= $this->session->userdata("adminuserid".$configvlxsessfolder);
        }

        if(empty($redirectlogin))
		{
			redirect('login');
		}

		$this->adminuserid= $this->session->userdata("adminuserid".$configvlxsessfolder);
		$this->adminuserloginnama= $this->session->userdata("adminuserloginnama".$configvlxsessfolder);
		$this->adminsatkerid= $this->session->userdata("adminsatkerid".$configvlxsessfolder);
	}

	function add()
	{
		$this->load->model("base-validasi/Pegawai");

		$this->load->library('globalfilepegawai');
		$reqLinkFile= $_FILES['reqLinkFile'];

		$p= $this->input->post("p");
		$reqPegawaiId= $this->input->post("reqPegawaiId");
		$reqId= $this->input->post("reqId");
		$reqRowId= $this->input->post("reqRowId");
		$reqTempValidasiHapusId= $this->input->post("reqTempValidasiHapusId");
		$reqTempValidasiId= $this->input->post("reqTempValidasiId");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");
		$reqFileRowId= $this->input->post("reqFileRowId");

		$reqNIP1= $this->input->post("reqNIP1");
		$reqNIP2= $this->input->post("reqNIP2");
		$reqNama= $this->input->post("reqNama");

		$reqGelarDepan= $this->input->post("reqGelarDepan");
		$reqGelarBelakang= $this->input->post("reqGelarBelakang");
		$reqTempatLahir= $this->input->post("reqTempatLahir");
		$reqTanggalLahir= $this->input->post("reqTanggalLahir");
		$reqJenisKelamin= $this->input->post("reqJenisKelamin");
		$reqAgama= $this->input->post("reqAgama");
		$reqStatusPernikahan= $this->input->post("reqStatusPernikahan");
		$reqSukuBangsa= $this->input->post("reqSukuBangsa");
		$reqGolDarah= $this->input->post("reqGolDarah");
		$reqTelepon= $this->input->post("reqTelepon");
		$reqEmail= $this->input->post("reqEmail");
		$reqAlamat= $this->input->post("reqAlamat");
		$reqRT= $this->input->post("reqRT");
		$reqRW= $this->input->post("reqRW");
		$reqKodePos= $this->input->post("reqKodePos");
		$reqPropinsi= $this->input->post("reqPropinsi");

		$reqKabupaten= $this->input->post("reqKabupaten");
		$reqKabupatenarr=explode("*", $reqKabupaten);
		if (is_array($reqKabupatenarr)) {
			$reqKabupaten= $reqKabupatenarr[0];
		}

		$reqKecamatan= $this->input->post("reqKecamatan");
		$reqKecamatanarr=explode("*", $reqKecamatan);
		if (is_array($reqKecamatanarr)) {
			$reqKecamatan= $reqKecamatanarr[0];
		}

		$reqDesa= $this->input->post("reqDesa");
		$reqDesaarr=explode("*", $reqDesa);
		if (is_array($reqDesaarr)) {
			$reqDesa= $reqDesaarr[0];
		}		

		$reqBank= $this->input->post("reqBank");
		$reqNoRekening= $this->input->post("reqNoRekening");
		$reqSatkerId= $this->input->post("reqSatkerId");
		$reqTipePegawai= $this->input->post("reqTipePegawai");
		$reqTugasTambahan= $this->input->post("reqTugasTambahan");
		$reqStatusPegawai= $this->input->post("reqStatusPegawai");
		$reqTglPensiun= $this->input->post("reqTglPensiun");
		$reqJenisPegawai= $this->input->post("reqJenisPegawai");
		$reqKedudukanId= $this->input->post("reqKedudukanId");
		$reqKartuPegawai= $this->input->post("reqKartuPegawai");
		$reqAkses= $this->input->post("reqAkses");
		$reqTaspen= $this->input->post("reqTaspen");
		$reqNPWP= $this->input->post("reqNPWP");
		$reqNIK= $this->input->post("reqNIK");
		$reqNikPns= $this->input->post("reqNikPns");
		$reqNomorKK= $this->input->post("reqNomorKK");
		$reqKtpPasangan= $this->input->post("reqKtpPasangan");
		$reqDrh= $this->input->post("reqDrh");
		$reqMode= $this->input->post("reqMode");
		$reqLinkGambar= $this->input->post("reqLinkGambar");
		$reqLinkGambarSetengah= $this->input->post("reqLinkGambarSetengah");

		$reqGambar = $_FILES['reqGambar']['name'];
		$reqGambarSetengah = $_FILES['reqGambarSetengah']['name'];

		$CI = &get_instance();
		$configdata= $CI->config;
		$configlokasiupload= $configdata->config["lokasiupload"];

		$set= new Pegawai();	
		$set->setField("PEGAWAI_ID", $reqPegawaiId);
		$set->setField("NIP_LAMA", $reqNIP1);
		$set->setField("NIP_BARU", $reqNIP2);
		$set->setField("NAMA", setQuote($reqNama));
		$set->setField("GELAR_DEPAN", $reqGelarDepan);
		$set->setField("GELAR_BELAKANG", $reqGelarBelakang);
		$set->setField("TEMPAT_LAHIR", $reqTempatLahir);
		$set->setField("TANGGAL_LAHIR", dateToDBCheck($reqTanggalLahir));
		$set->setField("JENIS_KELAMIN", $reqJenisKelamin);
		$set->setField("AGAMA_ID", ValToNullDB($reqAgama));
		$set->setField("STATUS_KAWIN", $reqStatusPernikahan);
		$set->setField("SUKU_BANGSA", $reqSukuBangsa);
		$set->setField("GOLONGAN_DARAH", $reqGolDarah);
		$set->setField("TELEPON", $reqTelepon);
		$set->setField("EMAIL", $reqEmail);
		$set->setField("ALAMAT", $reqAlamat);
		$set->setField("RT", $reqRT);
		$set->setField("RW", $reqRW);
		$set->setField("KODEPOS", $reqKodePos);
		$set->setField("PROPINSI_ID", ValToNullDB($reqPropinsi));
		$set->setField("KABUPATEN_ID", ValToNullDB($reqKabupaten));
		$set->setField("KECAMATAN_ID", ValToNullDB($reqKecamatan));
		$set->setField("KELURAHAN_ID", ValToNullDB($reqDesa));
		$set->setField("BANK_ID", ValToNullDB($reqBank));
		$set->setField("NO_REKENING", $reqNoRekening);
		$set->setField("SATKER_ID", $reqSatkerId);
		$set->setField("TIPE_PEGAWAI_ID", ValToNullDB($reqTipePegawai));
		$set->setField("TUGAS_TAMBAHAN_NEW", $reqTugasTambahan);
		$set->setField("STATUS_PEGAWAI", $reqStatusPegawai);
		$set->setField("TANGGAL_PENSIUN", dateToDBCheck($reqTglPensiun));
		$set->setField("JENIS_PEGAWAI_ID", ValToNullDB($reqJenisPegawai));
		$set->setField("KEDUDUKAN_ID", ValToNullDB($reqKedudukanId));
		$set->setField("KARTU_PEGAWAI", $reqKartuPegawai);
		$set->setField("ASKES", $reqAkses);
		$set->setField("TASPEN", $reqTaspen);
		$set->setField("NPWP", $reqNPWP);
		$set->setField("NIK", $reqNIK);
		$set->setField("KTP_PNS", $reqNikPns);
		$set->setField("KK", $reqNomorKK);
		$set->setField("KTP_PASANGAN", $reqKtpPasangan);
		$set->setField("DRH", setQuote($reqDrh));
		$set->setField("FOTO_BLOB", $reqLinkGambar);
		$set->setField("FOTO_BLOB_OTHER", $reqLinkGambarSetengah);

		$adminusernama= $this->adminuserloginnama;
		$userSatkerId= $this->adminsatkerid;

		if(!empty($reqGambar))
		{
			$reqTipeFile=$_FILES['reqGambar']['type'];

			if(!empty($reqTipeFile))
			{
				$checkfile=checkFile($reqTipeFile,1);

				if(empty($checkfile))
				{
					echo json_response(400, 'File Gagal diupload, Pastikan File berformat png,jpg');exit;
				}
			}

			
			$fileName= basename($_FILES["reqGambar"]["name"]);
			$fileNameInfo = substr($fileName, 0, strpos($fileName, "."));
			$file_name = preg_replace( '/[^a-zA-Z0-9_]+/', '_', $fileNameInfo);
			$infoext= pathinfo($_FILES['reqGambar']['name']);
			$ext= $infoext['extension'];

			$lokasi_folder=$configlokasiupload.$reqNIP2."/";

			$tglnow= date("Ymd");
			$vpathasli= $file_name;
			$namagenerate= generateRandomString().$tglnow.".".$ext;
			$vpathsimpan= $lokasi_folder.$namagenerate;
			// $vnewpathsimpan= str_replace($configlokasiupload, "", $vpathsimpan);

			if (!is_dir($lokasi_folder)) {
				makedirs($lokasi_folder);
			}
			$reqLinkFile=$_FILES['reqGambar']['tmp_name'];
					// print_r($vpathsimpan);exit;
			if(move_uploaded_file($reqLinkFile, $vpathsimpan))
			{
				$set->setField("FOTO_BLOB", $vpathsimpan);
			}
		}

		if(!empty($reqGambarSetengah))
		{
			$reqTipeFile=$_FILES['reqGambarSetengah']['type'];

			if(!empty($reqTipeFile))
			{
				$checkfile=checkFile($reqTipeFile,1);

				if(empty($checkfile))
				{
					echo json_response(400, 'File Gagal diupload, Pastikan File berformat png,jpg');exit;
				}
			}

			$fileName= basename($_FILES["reqGambarSetengah"]["name"]);
			$fileNameInfo = substr($fileName, 0, strpos($fileName, "."));
			$file_name = preg_replace( '/[^a-zA-Z0-9_]+/', '_', $fileNameInfo);
			$infoext= pathinfo($_FILES['reqGambarSetengah']['name']);
			$ext= $infoext['extension'];

			$lokasi_folder=$configlokasiupload.$reqNIP2."/";

			$tglnow= date("Ymd");
			$vpathasli= $file_name;
			$namagenerate= generateRandomString().$tglnow.".".$ext;
			$vpathsimpan= $lokasi_folder.$namagenerate;
			// $vnewpathsimpan= str_replace($configlokasiupload, "", $vpathsimpan);

			if (!is_dir($lokasi_folder)) {
				makedirs($lokasi_folder);
			}
			$reqLinkFile=$_FILES['reqGambarSetengah']['tmp_name'];
					// print_r($vpathsimpan);exit;
			if(move_uploaded_file($reqLinkFile, $vpathsimpan))
			{
				$set->setField("FOTO_BLOB_OTHER", $vpathsimpan);
			}
		}

		$set->setField('PEGAWAI_ID', $reqRowId);
		$set->setField('VALIDASI', ValToNullDB($reqStatusValidasi));
		$set->setField('TEMP_VALIDASI_ID', $reqTempValidasiId);

		$set->setField("LAST_CREATE_USER", $adminusernama);
		$set->setField("LAST_CREATE_DATE", "NOW()");	
		$set->setField("LAST_CREATE_SATKER", $userSatkerId);
		$set->setField("LAST_UPDATE_USER", $adminusernama);
		$set->setField("LAST_UPDATE_DATE", "NOW()");	
		$set->setField("LAST_UPDATE_SATKER", $userSatkerId);

		$reqsimpan= "";
		if(empty($reqTempValidasiId))
        {
            if($set->insert())
            {
                $reqsimpan= "1";
                $reqTempValidasiId= $set->id;
            }
        }
        else
        {
            $set->setField('TEMP_VALIDASI_ID', $reqTempValidasiId);
            if($set->update())
            {
                $reqsimpan= "1";
            }
        }

		// exit;
		if($reqsimpan == 1 )
		{
			if($p == "validasi")
			{
				// untuk mode validasi
				if(!empty($reqTempValidasiId))
				{
					if($set->updatetanggalvalidasi())
					{
					}
				}
				elseif(empty($reqTempValidasiId) && !empty($reqTempValidasiHapusId))
				{
					$set->setField('VALIDASI', $reqStatusValidasi);
					$set->setField("LAST_LEVEL", $this->LOGIN_LEVEL);
					$set->setField("LAST_USER", $this->LOGIN_USER);
					$set->setField("USER_LOGIN_ID", $this->LOGIN_ID);
					$set->setField("USER_LOGIN_PEGAWAI_ID", ValToNullDB($this->LOGIN_PEGAWAI_ID));
					$set->setField("LAST_DATE", "NOW()");
					$set->setField('TEMP_VALIDASI_ID', $reqTempValidasiHapusId);
					if($set->updatevalidasihapusdata())
					{
					}
				}
			}
			// untuk simpan file
			// $vpost= $this->input->post();
			// $vsimpanfilepegawai= new globalfilepegawai();
			// $vsimpanfilepegawai->simpanfilepegawai($vpost, $reqFileRowId, $reqLinkFile);


			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function deletegambar()
	{
		$this->load->model("base-validasi/Pegawai");
		$set = new Pegawai();
		
		$reqId =  $this->input->get('reqId');
		$reqMode =  $this->input->get('reqMode');

		$statement=" AND A.PEGAWAI_ID = ".$reqId." ";

		$setcheck = new Pegawai();
		$setcheck->selectByParamsCheckFoto(array(), -1,-1,$statement);
		$setcheck->firstRow();
		$reqLinkFoto=$setcheck->getField("FOTO_BLOB");
		$reqLinkFotoSetengah=$setcheck->getField("FOTO_BLOB_OTHER");

		// print_r($reqLinkFotoSetengah);exit;

		$set->setField("PEGAWAI_ID", $reqId);
		if($reqMode=="gambar")
		{
			if(!empty($reqLinkFoto))
			{
				unlink($reqLinkFoto);
				$set->setField("FOTO_BLOB", "");
				if($set->updatefoto())
				{
					$reqSimpan = 1;
				}
			}
		}
		else
		{
			if(!empty($reqLinkFotoSetengah))
			{
				unlink($reqLinkFotoSetengah);
				$set->setField("FOTO_BLOB_OTHER", "");
				if($set->updatefotosetengah())
				{
					$reqSimpan = 1;
				}
			}
			
		}

		if($reqSimpan == 1 )
		{
			$arrJson["PESAN"] = "Lampiran berhasil dihapus.";
		}
		else
		{
			$arrJson["PESAN"] = "Lampiran gagal dihapus.";	
		}

		echo json_encode( $arrJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

	}

}
?>