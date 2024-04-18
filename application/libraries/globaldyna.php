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

	function getinfofield()
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

	function getinfooperator()
	{
		$vreturn= array(
			array("label"=>" = ", "n"=> "=", "opt"=>"1")
			, array("label"=>" != ", "n"=> "!=", "opt"=>"2")
			, array("label"=>" < ", "n"=> "<", "opt"=>"3")
			, array("label"=>" <= ", "n"=> "<=", "opt"=>"4")
			, array("label"=>" > ", "n"=> ">", "opt"=>"5")
			, array("label"=>" >= ", "n"=> ">=", "opt"=>"6")
			, array("label"=>" LIKE ", "n"=> "LIKE", "opt"=>"7")
			, array("label"=>" IN ", "n"=> "IN", "opt"=>"8")
			, array("label"=>" BETWEEN ", "n"=> "BETWEEN", "opt"=>"9")
			, array("label"=>" NOT IN ", "n"=> "NOT IN", "opt"=>"10")
			, array("label"=>" NOT BETWEEN ", "n"=> "NOT BETWEEN", "opt"=>"11")
		);

		return $vreturn;
	}

	function getinfoselect()
	{
		$CI = &get_instance();
		$CI->load->model("base/Core");

		$arrjeniskelamin= [];
		$arrdata= [];
		$arrdata["id"]= "L";
		$arrdata["text"]= "Laki laki";
		array_push($arrjeniskelamin, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "P";
		$arrdata["text"]= "Perempuan";
		array_push($arrjeniskelamin, $arrdata);

		$arragama= [];
		$set= new Core();
		$set->selectByParamsAgama();
		while($set->nextRow())
		{
			$arrdata= [];
			$arrdata["id"]= $set->getField("AGAMA_ID");
			$arrdata["text"]= $set->getField("NAMA");
			array_push($arragama, $arrdata);
		}

		$arrstatuskawin= [];
		$arrdata= [];
		$arrdata["id"]= "1";
		$arrdata["text"]= "Belum Kawin";
		array_push($arrstatuskawin, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "2";
		$arrdata["text"]= "Kawin";
		array_push($arrstatuskawin, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "3";
		$arrdata["text"]= "Janda";
		array_push($arrstatuskawin, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "4";
		$arrdata["text"]= "Duda";
		array_push($arrstatuskawin, $arrdata);

		$arrgoldarah= [];
		$arrdata= [];
		$arrdata["id"]= "A";
		$arrdata["text"]= "A";
		array_push($arrgoldarah, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "B";
		$arrdata["text"]= "B";
		array_push($arrgoldarah, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "AB";
		$arrdata["text"]= "AB";
		array_push($arrgoldarah, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "O";
		$arrdata["text"]= "O";
		array_push($arrgoldarah, $arrdata);

		$vreturn= array(
			array("label"=>"NIP", "n"=> "A.NIP_LAMA", "opt"=>"1", "upper"=>"", "mode"=>"")
			// , array("label"=>"NIP Baru", "n"=> "A.FORMAT_NIP_BARU", "upper"=>"1", "opt"=>"2", "mode"=>"")
			, array("label"=>"NIP Baru", "n"=> "A.NIP_BARU", "upper"=>"", "opt"=>"2", "mode"=>"")
			, array("label"=>"Nama", "n"=> "A.VNAMA_LENGKAP", "opt"=>"3", "upper"=>"1", "mode"=>"")
			, array("label"=>"Gelar Depan", "n"=> "A.GELAR_DEPAN", "opt"=>"4", "upper"=>"1", "mode"=>"")
			, array("label"=>"Gelar Belakang", "n"=> "A.GELAR_BELAKANG", "opt"=>"5", "upper"=>"1", "mode"=>"")
			, array("label"=>"Tempat Lahir", "n"=> "A.TEMPAT_LAHIR", "opt"=>"6", "upper"=>"1", "mode"=>"")
			, array("label"=>"Umur", "n"=> "AMBIL_UMUR(A.TANGGAL_LAHIR)", "opt"=>"7", "upper"=>"", "mode"=>"")
			, array("label"=>"Tanggal Lahir", "n"=> "A.TANGGAL_LAHIR", "opt"=>"8", "upper"=>"", "mode"=>"date")
			, array("label"=>"Bulan Lahir", "n"=> "TO_CHAR(A.TANGGAL_LAHIR, 'MM')", "opt"=>"9", "upper"=>"", "mode"=>"numeric")
			, array("label"=>"Tahun Lahir", "n"=> "TO_CHAR(A.TANGGAL_LAHIR, 'YYYY')", "opt"=>"10", "upper"=>"", "mode"=>"numeric")
			, array("label"=>"Jenis Kelamin", "n"=> "A.JENIS_KELAMIN", "opt"=>"11", "upper"=>"1", "mode"=>"select", "vdata"=>$arrjeniskelamin)
			, array("label"=>"Agama", "n"=> "A.AGAMA_ID", "opt"=>"12", "upper"=>"", "mode"=>"select", "vdata"=>$arragama)
			, array("label"=>"Status Kawin", "n"=> "A.STATUS_KAWIN", "opt"=>"13", "upper"=>"", "mode"=>"select", "vdata"=>$arrstatuskawin)
			, array("label"=>"Suku Bangsa", "n"=> "A.SUKU_BANGSA", "opt"=>"14", "upper"=>"1", "mode"=>"")
			, array("label"=>"Gol Darah", "n"=> "A.GOLONGAN_DARAH", "opt"=>"15", "upper"=>"", "mode"=>"select", "vdata"=>$arrgoldarah)
			, array("label"=>"Satker", "n"=> "A.SATKER_ID", "opt"=>"100", "upper"=>"", "mode"=>"satker")
		);
		return $vreturn;
	}

/*	
	<option value="Alamat">Alamat</option>
	<option value="Telepon">Telepon</option>
	<option value="Kode Pos">Kode Pos</option>
	<option value="Status Pegawai">Status Pegawai</option>
	<option value="NIK">NIK</option>
	<option value="Karpeg">Karpeg</option>
	<option value="Askes">Askes</option>
	<option value="Taspen">Taspen</option>
	<option value="Tipe Pegawai">Tipe Pegawai</option>
	<option value="Jenis Pegawai">Jenis Pegawai</option>
	<option value="Kedudukan Pegawai">Kedudukan Pegawai</option>
	<option value="TMT Pensiun">TMT Pensiun</option>

	<option value="Golongan Ruang">Golongan Ruang</option><option value="TMT Pangkat">TMT Pangkat</option><option value="Masa Kerja">Masa Kerja</option><option value="Jabatan">Jabatan</option><option value="Eselon">Eselon</option><option value="TMT Eselon">TMT Eselon</option><option value="TMT Jabatan">TMT Jabatan</option><option value="Nomor SK Jabatan">Nomor SK Jabatan</option><option value="Tanggal SK Jabatan">Tanggal SK Jabatan</option><option value="Satker">Satker</option><option value="Pendidikan">Pendidikan</option><option value="Jurusan">Jurusan</option><option value="Nama Sekolah">Nama Sekolah</option><option value="Tempat Sekolah">Tempat Sekolah</option><option value="Nomor STTB">Nomor STTB</option><option value="Tanggal STTB">Tanggal STTB</option><option value="Penghargaan">Penghargaan</option><option value="Nomor SK Penghargaan">Nomor SK Penghargaan</option><option value="Tanggal SK Penghargaan">Tanggal SK Penghargaan</option><option value="Tahun Penghargaan">Tahun Penghargaan</option><option value="Nama Diklat Fungsional">Nama Diklat Fungsional</option><option value="Tempat Diklat Fungsional">Tempat Diklat Fungsional</option><option value="Penyelenggara Diklat Fungsional">Penyelenggara Diklat Fungsional</option><option value="Angkatan Diklat Fungsional">Angkatan Diklat Fungsional</option><option value="Tahun Diklat Fungsional">Tahun Diklat Fungsional</option><option value="Nama Diklat Teknis">Nama Diklat Teknis</option><option value="Tempat Diklat Teknis">Tempat Diklat Teknis</option><option value="Penyelenggara Diklat Teknis">Penyelenggara Diklat Teknis</option><option value="Angkatan Diklat Teknis">Angkatan Diklat Teknis</option><option value="Tahun Diklat Teknis">Tahun Diklat Teknis</option><option value="Nama Diklat Teknis">Nama Diklat Teknis</option><option value="Tempat Diklat Teknis">Tempat Diklat Teknis</option><option value="Penyelenggara Diklat Teknis">Penyelenggara Diklat Teknis</option><option value="Angkatan Diklat Teknis">Angkatan Diklat Teknis</option><option value="Tahun Diklat Teknis">Tahun Diklat Teknis</option><option value="No SK Hukuman">No SK Hukuman</option><option value="Tgl SK Hukuman">Tgl SK Hukuman</option><option value="Pejabat Penetap Hukuman">Pejabat Penetap Hukuman</option><option value="TMT SK Hukuman">TMT SK Hukuman</option><option value="Tingkat Hukuman">Tingkat Hukuman</option><option value="Tahun Hukuman">Tahun Hukuman</option>  <option value="Jenis Cuti">Jenis Cuti</option><option value="Lama Cuti">Lama Cuti</option><option value="TMT CPNS">TMT CPNS</option><option value="Tgl. Tugas CPNS">Tgl. Tugas CPNS</option><option value="TMT PNS">TMT PNS</option>*/
	
}