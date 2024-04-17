<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
include_once("functions/string.func.php");

class globaldyna
{
	function getsessionuser()
	{
		$CI = &get_instance();

		$sessionloginlevel= $CI->kauth->getInstance()->getIdentity()->LOGIN_LEVEL;
		$sessionloginuser= $CI->kauth->getInstance()->getIdentity()->LOGIN_USER;
		$sessionloginid= $CI->kauth->getInstance()->getIdentity()->LOGIN_ID;
		$sessionloginpegawaiid= $CI->kauth->getInstance()->getIdentity()->LOGIN_PEGAWAI_ID;

		$sessionsatuankerja= $CI->kauth->getInstance()->getIdentity()->SATUAN_KERJA_ID;
		$sessionusergroup= $CI->kauth->getInstance()->getIdentity()->USER_GROUP;
		$sessionstatussatuankerjabkd= $CI->kauth->getInstance()->getIdentity()->STATUS_SATUAN_KERJA_BKD;
		$sessionaksesappsimpegid= $CI->kauth->getInstance()->getIdentity()->AKSES_APP_SIMPEG_ID;

		$arrreturn= [];
		$arrreturn["sessionloginlevel"]= $sessionloginlevel;
		$arrreturn["sessionloginuser"]= $sessionloginuser;
		$arrreturn["sessionloginid"]= $sessionloginid;
		$arrreturn["sessionloginpegawaiid"]= $sessionloginpegawaiid;
		$arrreturn["sessionsatuankerja"]= $sessionsatuankerja;
		/*$arrreturn["sessionusergroup"]= $sessionusergroup;
		$arrreturn["sessionstatussatuankerjabkd"]= $sessionstatussatuankerjabkd;
		$arrreturn["sessionaksesappsimpegid"]= $sessionaksesappsimpegid;
		$arrreturn["sessioninfosepeta"]= $sessioninfosepeta;
		// print_r($arrreturn);exit;

		$arrreturn["ttd_url"]= $CI->config->item('ttd_url');
		$arrreturn["ttd_username"]= $CI->config->item('ttd_username');
		$arrreturn["ttd_password"]= $CI->config->item('ttd_password');
		$arrreturn["ttd_enkrip"]= $CI->config->item('ttd_enkrip');
		$arrreturn["base_url"]= $CI->config->item('base_report');*/

		return $arrreturn;
	}

	function getinfofiled()
	{
		$vreturn= array(
			array
			(
				"group"=>"Pegawai"
				, "data"=> array(
					array("label"=>"NIP", "field"=> "NIP_LAMA", "n"=> "A.NIP_LAMA", "display"=>"", "width"=>"")
					, array("label"=>"NIP Baru", "field"=> "FORMAT_NIP_BARU", "n"=> "A.FORMAT_NIP_BARU", "display"=>"", "width"=>"")
					, array("label"=>"Nama", "field"=> "VNAMA_LENGKAP", "n"=> "A.VNAMA_LENGKAP", "display"=>"", "width"=>"")
					, array("label"=>"Tempat Lahir Pegawai", "field"=> "TEMPAT_LAHIR", "n"=> "A.TEMPAT_LAHIR", "display"=>"", "width"=>"")
					, array("label"=>"Tanggal Lahir Pegawai", "field"=> "TANGGAL_LAHIR", "n"=> "AMBIL_UMUR(A.TANGGAL_LAHIR)", "display"=>"", "width"=>"")
					, array("label"=>"Umur", "field"=> "UMUR_PEGAWAI", "n"=> "A.UMUR_PEGAWAI", "display"=>"", "width"=>"")
					, array("label"=>"Jenis Kelamin", "field"=> "JENIS_KELAMIN", "n"=> "A.JENIS_KELAMIN", "display"=>"", "width"=>"")
					, array("label"=>"Agama", "field"=> "INFO_AGAMA", "n"=> "D.NAMA", "display"=>"", "width"=>"")
					, array("label"=>"Status Kawin", "field"=> "INFO_STATUS_KAWIN", "n"=> "A.INFO_STATUS_KAWIN", "display"=>"", "width"=>"")
					, array("label"=>"Suku Bangsa", "field"=> "SUKU_BANGSA", "n"=> "A.SUKU_BANGSA", "display"=>"", "width"=>"")
					, array("label"=>"Gol. Darah", "field"=> "GOLONGAN_DARAH", "n"=> "A.GOLONGAN_DARAH", "display"=>"", "width"=>"")
					, array("label"=>"Alamat", "field"=> "ALAMAT", "n"=> "A.ALAMAT", "display"=>"", "width"=>"")
					, array("label"=>"Telepon", "field"=> "TELEPON", "n"=> "A.TELEPON", "display"=>"", "width"=>"")
					, array("label"=>"Kodepos", "field"=> "KODEPOS", "n"=> "A.KODEPOS", "display"=>"", "width"=>"")
					, array("label"=>"Status Pegawai", "field"=> "INFO_STATUS_PEGAWAI", "n"=> "A1.NAMA", "display"=>"", "width"=>"")
					, array("label"=>"NIK", "field"=> "NIK", "n"=> "A.NIK", "display"=>"", "width"=>"")
					, array("label"=>"Karpeg", "field"=> "KARTU_PEGAWAI", "n"=> "A.KARTU_PEGAWAI", "display"=>"", "width"=>"")
					, array("label"=>"Askes", "field"=> "ASKES", "n"=> "A.ASKES", "display"=>"", "width"=>"")
					, array("label"=>"Taspen", "field"=> "TASPEN", "n"=> "A.TASPEN", "display"=>"", "width"=>"")
					, array("label"=>"Tipe Pegawai", "field"=> "INFO_TIPE_PEGAWAI", "n"=> "A2.NAMA", "display"=>"", "width"=>"")
					, array("label"=>"Jenis Pegawai", "field"=> "INFO_JENIS_PEGAWAI", "n"=> "A3.NAMA", "display"=>"", "width"=>"")
					, array("label"=>"Kedudukan", "field"=> "INFO_KEDUDUKAN", "n"=> "A4.NAMA", "display"=>"", "width"=>"")
					, array("label"=>"TMT Pensiun", "field"=> "TANGGAL_PENSIUN", "n"=> "A.TANGGAL_PENSIUN", "display"=>"", "width"=>"")
				)
			)
			, array
			(
				"group"=>"Pangkat"
				, "data"=> array(
					array("label"=>"Gol. Ruang", "field"=> "GOL_RUANG_PANGKAT", "n"=> "B.GOL_RUANG_PANGKAT", "display"=>"", "width"=>"")
					, array("label"=>"TMT Pangkat", "field"=> "TMT_PANGKAT", "n"=> "B.TMT_PANGKAT", "display"=>"", "width"=>"")
					, array("label"=>"Nomor SK Pangkat", "field"=> "NO_SK_PANGKAT", "n"=> "B.NO_SK_PANGKAT", "display"=>"", "width"=>"")
					, array("label"=>"Tanggal SK Pangkat", "field"=> "TANGGAL_SK_PANGKAT", "n"=> "B.TANGGAL_SK_PANGKAT", "display"=>"", "width"=>"")
					, array("label"=>"Pejabat Penetap Pangkat", "field"=> "JABATAN_PENETAP_PANGKAT", "n"=> "B.JABATAN_PENETAP_PANGKAT", "display"=>"", "width"=>"")
					, array("label"=>"Masa Kerja", "field"=> "MASA_KERJA_PANGKAT", "n"=> "B.MASA_KERJA_PANGKAT", "display"=>"", "width"=>"")
				)
			)
		);
		return $vreturn;
	}
	
}