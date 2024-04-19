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
			, array
			(
				"group"=>"Jabatan"
				, "data"=> array(
					array("label"=>"Jabatan", "field"=> "JABATAN_NAMA", "n"=> "C.JABATAN_NAMA", "display"=>"", "width"=>"")
					, array("label"=>"Eselon", "field"=> "JABATAN_ESELON", "n"=> "C.JABATAN_ESELON", "display"=>"", "width"=>"")
					, array("label"=>"TMT Eselon", "field"=> "TMT_ESELON", "n"=> "C.TMT_ESELON", "display"=>"", "width"=>"")
					, array("label"=>"TMT Jabatan", "field"=> "TMT_JABATAN", "n"=> "C.TMT_JABATAN", "display"=>"", "width"=>"")
					, array("label"=>"Nomor SK Jabatan", "field"=> "NO_SK_JABATAN", "n"=> "C.NO_SK_JABATAN", "display"=>"", "width"=>"")
					, array("label"=>"Tanggal SK Jabatan", "field"=> "TANGGAL_SK_JABATAN", "n"=> "C.TANGGAL_SK_JABATAN", "display"=>"", "width"=>"")
					, array("label"=>"Pejabat Penetap Jabatan", "field"=> "JABATAN_PENETAP_JABATAN", "n"=> "C.JABATAN_PENETAP_JABATAN", "display"=>"", "width"=>"")
				)
			)
			, array
			(
				"group"=>"Pendidikan"
				, "data"=> array(
					array("label"=>"Pendidikan", "field"=> "PENDIDIKAN", "n"=> "F.PENDIDIKAN", "display"=>"", "width"=>"")
					, array("label"=>"Jurusan", "field"=> "JURUSAN_PENDIDIKAN", "n"=> "F.JURUSAN_PENDIDIKAN", "display"=>"", "width"=>"")
					, array("label"=>"Nama Sekolah", "field"=> "NAMA_SEKOLAH_PENDIDIKAN", "n"=> "F.NAMA_SEKOLAH_PENDIDIKAN", "display"=>"", "width"=>"")
					, array("label"=>"Tempat Sekolah", "field"=> "TEMPAT_PENDIDIKAN", "n"=> "F.TEMPAT_PENDIDIKAN", "display"=>"", "width"=>"")
					, array("label"=>"Kepala Sekolah", "field"=> "KEPALA_PENDIDIKAN", "n"=> "F.KEPALA_PENDIDIKAN", "display"=>"", "width"=>"")
					, array("label"=>"Nomor STTB", "field"=> "NO_STTB_PENDIDIKAN", "n"=> "F.NO_STTB_PENDIDIKAN", "display"=>"", "width"=>"")
					, array("label"=>"Tanggal STTB", "field"=> "TANGGAL_STTB_PENDIDIKAN", "n"=> "F.TANGGAL_STTB_PENDIDIKAN", "display"=>"", "width"=>"")
				)
			)
			, array
			(
				"group"=>"Penghargaan"
				, "data"=> array(
					array("label"=>"Nomor SK Penghargaan", "field"=> "NO_SK_PENGHARGAAN", "n"=> "A5.NO_SK_PENGHARGAAN", "display"=>"", "width"=>"")
					, array("label"=>"Tanggal SK Penghargaan", "field"=> "TANGGAL_SK_PENGHARGAAN", "n"=> "A5.TANGGAL_SK_PENGHARGAAN", "display"=>"", "width"=>"")
					, array("label"=>"Nama Penghargaan", "field"=> "NAMA_PENGHARGAAN", "n"=> "A5.NAMA_PENGHARGAAN", "display"=>"", "width"=>"")
					, array("label"=>"Penghargaan Dari", "field"=> "PENGHARGAAN_DARI", "n"=> "A5.PENGHARGAAN_DARI", "display"=>"", "width"=>"")
					, array("label"=>"Tahun Penghargaan", "field"=> "TAHUN_PENGHARGAAN", "n"=> "A5.TAHUN_PENGHARGAAN", "display"=>"", "width"=>"")
				)
			)
			, array
			(
				"group"=>"Diklat Fungsional"
				, "data"=> array(
					array("label"=>"Nama Diklat Fungsional", "field"=> "NAMA_FUNGSIONAL", "n"=> "A6.NAMA_FUNGSIONAL", "display"=>"", "width"=>"")
					, array("label"=>"Tempat Diklat Fungsional", "field"=> "TEMPAT_FUNGSIONAL", "n"=> "A6.TEMPAT_FUNGSIONAL", "display"=>"", "width"=>"")
					, array("label"=>"Penyelenggara Diklat Fungsional", "field"=> "PENYELENGGARA_FUNGSIONAL", "n"=> "A6.PENYELENGGARA_FUNGSIONAL", "display"=>"", "width"=>"")
					, array("label"=>"Angkatan Diklat Fungsional", "field"=> "ANGKATAN_FUNGSIONAL", "n"=> "A6.ANGKATAN_FUNGSIONAL", "display"=>"", "width"=>"")
					, array("label"=>"Tahun Diklat Fungsional", "field"=> "TAHUN_FUNGSIONAL", "n"=> "A6.TAHUN_FUNGSIONAL", "display"=>"", "width"=>"")
				)
			)
			, array
			(
				"group"=>"Diklat Teknis"
				, "data"=> array(
					array("label"=>"Nama Diklat Teknis", "field"=> "NAMA_TEKNIS", "n"=> "A7.NAMA_TEKNIS", "display"=>"", "width"=>"")
					, array("label"=>"Tempat Diklat Teknis", "field"=> "TEMPAT_TEKNIS", "n"=> "A7.TEMPAT_TEKNIS", "display"=>"", "width"=>"")
					, array("label"=>"Penyelenggara Diklat Teknis", "field"=> "PENYELENGGARA_TEKNIS", "n"=> "A7.PENYELENGGARA_TEKNIS", "display"=>"", "width"=>"")
					, array("label"=>"Angkatan Diklat Teknis", "field"=> "ANGKATAN_TEKNIS", "n"=> "A7.ANGKATAN_TEKNIS", "display"=>"", "width"=>"")
					, array("label"=>"Tahun Diklat Teknis", "field"=> "TAHUN_TEKNIS", "n"=> "A7.TAHUN_TEKNIS", "display"=>"", "width"=>"")
				)
			)
			, array
			(
				"group"=>"Diklat Struktural"
				, "data"=> array(
					array("label"=>"Nama Diklat Struktural", "field"=> "NAMA_STRUKTURAL", "n"=> "A8.NAMA_STRUKTURAL", "display"=>"", "width"=>"")
					, array("label"=>"Tempat Diklat Struktural", "field"=> "TEMPAT_STRUKTURAL", "n"=> "A8.TEMPAT_STRUKTURAL", "display"=>"", "width"=>"")
					, array("label"=>"Penyelenggara Diklat Struktural", "field"=> "PENYELENGGARA_STRUKTURAL", "n"=> "A8.PENYELENGGARA_STRUKTURAL", "display"=>"", "width"=>"")
					, array("label"=>"Angkatan Diklat Struktural", "field"=> "ANGKATAN_STRUKTURAL", "n"=> "A8.ANGKATAN_STRUKTURAL", "display"=>"", "width"=>"")
					, array("label"=>"Tahun Diklat Struktural", "field"=> "TAHUN_STRUKTURAL", "n"=> "A8.TAHUN_STRUKTURAL", "display"=>"", "width"=>"")
				)
			)
			, array
			(
				"group"=>"Hukuman"
				, "data"=> array(
					array("label"=>"No SK Hukuman", "field"=> "NO_SK_HUKUMAN", "n"=> "G.NO_SK_HUKUMAN", "display"=>"", "width"=>"")
					, array("label"=>"Tgl SK Hukuman", "field"=> "TANGGAL_SK_HUKUMAN", "n"=> "G.TANGGAL_SK_HUKUMAN", "display"=>"", "width"=>"")
					, array("label"=>"Pejabat Penetap Hukuman", "field"=> "PEJABAT_PENETAP_HUKUMAN", "n"=> "G.PEJABAT_PENETAP_HUKUMAN", "display"=>"", "width"=>"")
					, array("label"=>"Permasalahan", "field"=> "PERMASALAHAN", "n"=> "G.PERMASALAHAN", "display"=>"", "width"=>"")
					, array("label"=>"TMT SK Hukuman", "field"=> "TMT_SK_HUKUMAN", "n"=> "G.TMT_SK_HUKUMAN", "display"=>"", "width"=>"")
					, array("label"=>"Tingkat Hukuman", "field"=> "NAMA_TINGKAT_HUKUMAN", "n"=> "G.NAMA_TINGKAT_HUKUMAN", "display"=>"", "width"=>"")
					, array("label"=>"Jenis Hukuman", "field"=> "NAMA_JENIS_HUKUMAN", "n"=> "G.NAMA_JENIS_HUKUMAN", "display"=>"", "width"=>"")
				)
			)
			, array
			(
				"group"=>"Anak"
				, "data"=> array(
					array("label"=>"Nama Anak", "field"=> "NAMA_ANAK", "n"=> "A9.NAMA_ANAK", "display"=>"", "width"=>"")
					, array("label"=>"Tempat Lahir Anak", "field"=> "TEMPAT_LAHIR_ANAK", "n"=> "A9.TEMPAT_LAHIR_ANAK", "display"=>"", "width"=>"")
					, array("label"=>"Tgl Lahir Anak", "field"=> "TANGGAL_LAHIR_ANAK", "n"=> "A9.TANGGAL_LAHIR_ANAK", "display"=>"", "width"=>"")
					, array("label"=>"Jenis Kelamin Anak", "field"=> "JENIS_KELAMIN_ANAK", "n"=> "A9.JENIS_KELAMIN_ANAK", "display"=>"", "width"=>"")
					, array("label"=>"Status Keluarga Anak", "field"=> "STATUS_KELUARGA_NAMA", "n"=> "A9.STATUS_KELUARGA_NAMA", "display"=>"", "width"=>"")
					, array("label"=>"Bln Dibayar", "field"=> "AWAL_BAYAR_ANAK", "n"=> "A9.AWAL_BAYAR_ANAK", "display"=>"", "width"=>"")
					, array("label"=>"Bln Akhir Dibayar", "field"=> "AKHIR_BAYAR_ANAK", "n"=> "A9.AKHIR_BAYAR_ANAK", "display"=>"", "width"=>"")
				)
			)
			, array
			(
				"group"=>"Istri/Suami"
				, "data"=> array(
					array("label"=>"Nama Istri/Suami", "field"=> "NAMA_SUAMI", "n"=> "A10.NAMA_SUAMI", "display"=>"", "width"=>"")
					, array("label"=>"Tempat Lahir Istri/Suami", "field"=> "TEMPAT_LAHIR_SUAMI", "n"=> "A10.TEMPAT_LAHIR_SUAMI", "display"=>"", "width"=>"")
					, array("label"=>"Tgl Lahir Istri/Suami", "field"=> "TANGGAL_LAHIR_SUAMI", "n"=> "A10.TANGGAL_LAHIR_SUAMI", "display"=>"", "width"=>"")
					, array("label"=>"Tgl Kawin", "field"=> "TANGGAL_KAWIN_SUAMI", "n"=> "A10.TANGGAL_KAWIN_SUAMI", "display"=>"", "width"=>"")
					, array("label"=>"Tingkat Pendidikan", "field"=> "TINGKAT_PENDIDIKAN_SUAMI", "n"=> "A10.TINGKAT_PENDIDIKAN_SUAMI", "display"=>"", "width"=>"")
					, array("label"=>"NIP PNS", "field"=> "NIP_PNS_SUAMI", "n"=> "A10.NIP_PNS_SUAMI", "display"=>"", "width"=>"")
					, array("label"=>"Pekerjaan", "field"=> "PEKERJAAN_SUAMI", "n"=> "A10.PEKERJAAN_SUAMI", "display"=>"", "width"=>"")
					, array("label"=>"Karcis/Karsu", "field"=> "KARTU_SUAMI", "n"=> "A10.KARTU_SUAMI", "display"=>"", "width"=>"")
				)
			)
			, array
			(
				"group"=>"Cuti"
				, "data"=> array(
					array("label"=>"Tahun Cuti", "field"=> "TAHUN_CUTI", "n"=> "A11.TAHUN_CUTI", "display"=>"", "width"=>"")
					, array("label"=>"Jenis Cuti", "field"=> "JENIS_CUTI", "n"=> "A11.JENIS_CUTI", "display"=>"", "width"=>"")
					, array("label"=>"No Surat Cuti", "field"=> "NO_SURAT_CUTI", "n"=> "A11.NO_SURAT_CUTI", "display"=>"", "width"=>"")
					, array("label"=>"Tgl Surat Cuti", "field"=> "TANGGAL_SURAT_CUTI", "n"=> "A11.TANGGAL_SURAT_CUTI", "display"=>"", "width"=>"")
					, array("label"=>"Lama Cuti", "field"=> "LAMA_CUTI", "n"=> "A11.LAMA_CUTI", "display"=>"", "width"=>"")
					, array("label"=>"Keterangan Cuti", "field"=> "KETERANGAN_CUTI", "n"=> "A11.KETERANGAN_CUTI", "display"=>"", "width"=>"")
				)
			)
			, array
			(
				"group"=>"SK CPNS"
				, "data"=> array(
					array("label"=>"No SK CPNS", "field"=> "NO_SK_CPNS", "n"=> "SCP.NO_SK_CPNS", "display"=>"", "width"=>"")
					, array("label"=>"Tgl SK CPNS", "field"=> "TANGGAL_SK_CPNS", "n"=> "SCP.TANGGAL_SK_CPNS", "display"=>"", "width"=>"")
					, array("label"=>"TMT CPNS", "field"=> "TMT_CPNS", "n"=> "SCP.TMT_CPNS", "display"=>"", "width"=>"")
					, array("label"=>"Pejabat Penetap CPNS", "field"=> "PEJABAT_PENETAP_CPNS", "n"=> "SCP.PEJABAT_PENETAP_CPNS", "display"=>"", "width"=>"")
					, array("label"=>"Golongan Ruang CPNS", "field"=> "GOL_RUANG_CPNS", "n"=> "SCP.GOL_RUANG_CPNS", "display"=>"", "width"=>"")
					, array("label"=>"Tgl Tugas CPNS", "field"=> "TANGGAL_TUGAS_CPNS", "n"=> "SCP.TANGGAL_TUGAS_CPNS", "display"=>"", "width"=>"")
				)
			)
			, array
			(
				"group"=>"SK PNS"
				, "data"=> array(
					array("label"=>"No SK PNS", "field"=> "NO_SK_PNS", "n"=> "SPN.NO_SK_PNS", "display"=>"", "width"=>"")
					, array("label"=>"Tgl SK PNS", "field"=> "TANGGAL_SK_PNS", "n"=> "SPN.TANGGAL_SK_PNS", "display"=>"", "width"=>"")
					, array("label"=>"TMT PNS", "field"=> "TMT_PNS", "n"=> "SPN.TMT_PNS", "display"=>"", "width"=>"")
					, array("label"=>"Pejabat Penetap PNS", "field"=> "PEJABAT_PENETAP_PNS", "n"=> "SPN.PEJABAT_PENETAP_PNS", "display"=>"", "width"=>"")
					, array("label"=>"Golongan Ruang PNS", "field"=> "GOL_RUANG_PNS", "n"=> "SPN.GOL_RUANG_PNS", "display"=>"", "width"=>"")
					, array("label"=>"Tgl Sumpah PNS", "field"=> "TANGGAL_SUMPAH_PNS", "n"=> "SPN.TANGGAL_SUMPAH_PNS", "display"=>"", "width"=>"")
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

		$arrpangkat= [];
		$set= new Core();
		$set->selectByParamsPangkat();
		while($set->nextRow())
		{
			$arrdata= [];
			$arrdata["id"]= $set->getField("PANGKAT_ID");
			$arrdata["text"]= $set->getField("KODE");
			array_push($arrpangkat, $arrdata);
		}

		$arreselon= [];
		$set= new Core();
		$set->selectByParamsEselon();
		while($set->nextRow())
		{
			$arrdata= [];
			$arrdata["id"]= $set->getField("ESELON_ID");
			$arrdata["text"]= $set->getField("NAMA");
			array_push($arreselon, $arrdata);
		}

		$arrpendidikan= [];
		$set= new Core();
		$set->selectByParamsPendidikan();
		while($set->nextRow())
		{
			$arrdata= [];
			$arrdata["id"]= $set->getField("PENDIDIKAN_ID");
			$arrdata["text"]= $set->getField("NAMA");
			array_push($arrpendidikan, $arrdata);
		}

		$arrdiklat= [];
		$set= new Core();
		$set->selectByParamsDiklat();
		while($set->nextRow())
		{
			$arrdata= [];
			$arrdata["id"]= $set->getField("DIKLAT_ID");
			$arrdata["text"]= $set->getField("NAMA");
			array_push($arrdiklat, $arrdata);
		}

		$arrtingkathukuman= [];
		$set= new Core();
		$set->selectByParamsDiklat();
		while($set->nextRow())
		{
			$arrdata= [];
			$arrdata["id"]= $set->getField("TINGKAT_HUKUMAN_ID");
			$arrdata["text"]= $set->getField("NAMA");
			array_push($arrtingkathukuman, $arrdata);
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

		$arrpenghargaan= [];
		$arrdata= [];
		$arrdata["id"]= "1";
		$arrdata["text"]= "Satya Lencana Karya Satya X (Perunggu)";
		array_push($arrpenghargaan, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "2";
		$arrdata["text"]= "Satya Lencana Karya Satya XX (Perak)";
		array_push($arrpenghargaan, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "3";
		$arrdata["text"]= "Satya Lencana Karya Satya XXX (Emas)";
		array_push($arrpenghargaan, $arrdata);

		$arrjeniscuti= [];
		$arrdata= [];
		$arrdata["id"]= "1";
		$arrdata["text"]= "Cuti Tahunan";
		array_push($arrjeniscuti, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "2";
		$arrdata["text"]= "Cuti Besar";
		array_push($arrjeniscuti, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "3";
		$arrdata["text"]= "Cuti Sakit";
		array_push($arrjeniscuti, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "4";
		$arrdata["text"]= "Cuti Bersalin";
		array_push($arrjeniscuti, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "5";
		$arrdata["text"]= "CTLN";
		array_push($arrjeniscuti, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "6";
		$arrdata["text"]= "Perpanjangan CTLN";
		array_push($arrjeniscuti, $arrdata);
		$arrdata= [];
		$arrdata["id"]= "7";
		$arrdata["text"]= "Cuti Menikah";
		array_push($arrjeniscuti, $arrdata);

		$vreturn= array(
			// pegawai
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

			// pangkat
			, array("label"=>"Gol. Ruang Pangkat", "n"=> "B.PANGKAT_ID", "opt"=>"16", "upper"=>"", "mode"=>"select", "vdata"=>$arrpangkat)
			, array("label"=>"TMT Pangkat", "n"=> "B.TANGGAL_SK_PANGKAT", "opt"=>"17", "upper"=>"", "mode"=>"date")
			, array("label"=>"Masa Kerja Tahun Pangkat", "n"=> "B.MASA_KERJA_TAHUN_PANGKAT", "opt"=>"18", "upper"=>"", "mode"=>"numeric")
			, array("label"=>"Masa Kerja Bulan Pangkat", "n"=> "B.MASA_KERJA_BULAN_PANGKAT", "opt"=>"19", "upper"=>"", "mode"=>"numeric")

			// jabatan
			, array("label"=>"Nama Jabatan", "n"=> "C.JABATAN_NAMA", "opt"=>"20", "upper"=>"1", "mode"=>"")
			, array("label"=>"Eselon Jabatan", "n"=> "C.ESELON_ID", "opt"=>"21", "upper"=>"", "mode"=>"select", "vdata"=>$arreselon)
			, array("label"=>"TMT Eselon", "n"=> "C.TMT_ESELON", "opt"=>"22", "upper"=>"", "mode"=>"date")
			, array("label"=>"TMT Jabatan", "n"=> "C.TMT_JABATAN", "opt"=>"23", "upper"=>"", "mode"=>"date")
			, array("label"=>"Nomor SK Jabatan", "n"=> "C.NO_SK_JABATAN", "opt"=>"24", "upper"=>"1", "mode"=>"")
			, array("label"=>"Tanggal SK Jabatan", "n"=> "C.TANGGAL_SK_JABATAN", "opt"=>"25", "upper"=>"", "mode"=>"date")

			// satker
			, array("label"=>"Satker", "n"=> "A.SATKER_ID", "opt"=>"26", "upper"=>"", "mode"=>"satker")

			// pendidikan
			, array("label"=>"Pendidikan", "n"=> "F.PENDIDIKAN_ID", "opt"=>"27", "upper"=>"", "mode"=>"select", "vdata"=>$arrpendidikan)
			, array("label"=>"Jurusan Pendidikan", "n"=> "F.JURUSAN_PENDIDIKAN", "opt"=>"28", "upper"=>"1", "mode"=>"")
			, array("label"=>"Nama Sekolah", "n"=> "F.NAMA_SEKOLAH_PENDIDIKAN", "opt"=>"29", "upper"=>"1", "mode"=>"")
			, array("label"=>"Tempat Sekolah", "n"=> "F.TEMPAT_PENDIDIKAN", "opt"=>"30", "upper"=>"1", "mode"=>"")
			, array("label"=>"Nomor STTB", "n"=> "F.NO_STTB_PENDIDIKAN", "opt"=>"31", "upper"=>"1", "mode"=>"")
			, array("label"=>"Tanggal STTB", "n"=> "F.TANGGAL_STTB_PENDIDIKAN", "opt"=>"32", "upper"=>"", "mode"=>"date")

			// penghargaan
			, array("label"=>"Penghargaan", "n"=> "A5.NAMA_PENGHARGAAN_KODE", "opt"=>"33", "upper"=>"", "mode"=>"select", "vdata"=>$arrpenghargaan)
			, array("label"=>"Nomor SK Penghargaan", "n"=> "A5.NO_SK_PENGHARGAAN", "opt"=>"34", "upper"=>"1", "mode"=>"")
			, array("label"=>"Tanggal SK Penghargaan", "n"=> "A5.TANGGAL_SK_PENGHARGAAN", "opt"=>"35", "upper"=>"", "mode"=>"date")
			, array("label"=>"Tahun Penghargaan", "n"=> "A5.TAHUN_PENGHARGAAN", "opt"=>"36", "upper"=>"", "mode"=>"numeric")

			// diklat fungsional
			, array("label"=>"Nama Diklat Fungsional", "n"=> "A6.NAMA_FUNGSIONAL", "opt"=>"37", "upper"=>"1", "mode"=>"")
			, array("label"=>"Tempat Diklat Fungsional", "n"=> "A6.TEMPAT_FUNGSIONAL", "opt"=>"38", "upper"=>"1", "mode"=>"")
			, array("label"=>"Penyelenggara Diklat Fungsional", "n"=> "A6.PENYELENGGARA_FUNGSIONAL", "opt"=>"39", "upper"=>"1", "mode"=>"")
			, array("label"=>"Angkatan Diklat Fungsional", "n"=> "A6.ANGKATAN_FUNGSIONAL", "opt"=>"40", "upper"=>"1", "mode"=>"")
			, array("label"=>"Tahun Diklat Fungsional", "n"=> "A6.TAHUN_FUNGSIONAL", "opt"=>"41", "upper"=>"", "mode"=>"numeric")

			// diklat teknis
			, array("label"=>"Nama Diklat Teknis", "n"=> "A7.NAMA_TEKNIS", "opt"=>"42", "upper"=>"1", "mode"=>"")
			, array("label"=>"Tempat Diklat Teknis", "n"=> "A7.TEMPAT_TEKNIS", "opt"=>"43", "upper"=>"1", "mode"=>"")
			, array("label"=>"Penyelenggara Diklat Teknis", "n"=> "A7.PENYELENGGARA_TEKNIS", "opt"=>"44", "upper"=>"1", "mode"=>"")
			, array("label"=>"Angkatan Diklat Teknis", "n"=> "A7.ANGKATAN_TEKNIS", "opt"=>"45", "upper"=>"1", "mode"=>"")
			, array("label"=>"Tahun Diklat Teknis", "n"=> "A7.TAHUN_TEKNIS", "opt"=>"46", "upper"=>"", "mode"=>"numeric")

			// diklat struktural
			, array("label"=>"Nama Diklat Struktural", "n"=> "A8.DIKLAT_ID", "opt"=>"47", "upper"=>"", "mode"=>"select", "vdata"=>$arrdiklat)
			, array("label"=>"Tempat Diklat Struktural", "n"=> "A8.TEMPAT_STRUKTURAL", "opt"=>"48", "upper"=>"1", "mode"=>"")
			, array("label"=>"Penyelenggara Diklat Struktural", "n"=> "A8.PENYELENGGARA_STRUKTURAL", "opt"=>"49", "upper"=>"1", "mode"=>"")
			, array("label"=>"Angkatan Diklat Struktural", "n"=> "A8.ANGKATAN_STRUKTURAL", "opt"=>"50", "upper"=>"1", "mode"=>"")
			, array("label"=>"Tahun Diklat Struktural", "n"=> "A8.TAHUN_STRUKTURAL", "opt"=>"51", "upper"=>"", "mode"=>"numeric")

			// hukuman
			, array("label"=>"No SK Hukuman", "n"=> "G.NO_SK_HUKUMAN", "opt"=>"52", "upper"=>"1", "mode"=>"")
			, array("label"=>"Tgl SK Hukuman", "n"=> "G.TANGGAL_SK_HUKUMAN", "opt"=>"53", "upper"=>"", "mode"=>"numeric")
			, array("label"=>"Pejabat Penetap Hukuman", "n"=> "G.PEJABAT_PENETAP_HUKUMAN", "opt"=>"54", "upper"=>"1", "mode"=>"")
			, array("label"=>"TMT SK Hukuman", "n"=> "G.TMT_SK_HUKUMAN", "opt"=>"55", "upper"=>"", "mode"=>"numeric")
			, array("label"=>"Tingkat Hukuman", "n"=> "A.TINGKAT_HUKUMAN_ID", "opt"=>"56", "upper"=>"", "mode"=>"select", "vdata"=>$arrtingkathukuman)
			, array("label"=>"Tahun Hukuman", "n"=> "G.TAHUN_HUKUMAN", "opt"=>"57", "upper"=>"", "mode"=>"numeric")

			// cuti
			, array("label"=>"Jenis Cuti", "n"=> "A11.JENIS_CUTI_ID", "opt"=>"58", "upper"=>"", "mode"=>"select", "vdata"=>$arrjeniscuti)
			, array("label"=>"Lama Cuti", "n"=> "A11.LAMA_CUTI", "opt"=>"59", "upper"=>"", "mode"=>"numeric")

			// cpns
			, array("label"=>"TMT CPNS", "n"=> "SCP.TMT_CPNS", "opt"=>"60", "upper"=>"", "mode"=>"date")
			, array("label"=>"Tgl Tugas CPNS", "n"=> "SCP.TANGGAL_TUGAS_CPNS", "opt"=>"61", "upper"=>"", "mode"=>"date")

			// pns
			, array("label"=>"TMT PNS", "n"=> "SPN.TMT_PNS", "opt"=>"62", "upper"=>"", "mode"=>"date")

		);
		return $vreturn;
	}

	// , array("label"=>"Nama", "n"=> "A.VNAMA_LENGKAP", "opt"=>"3", "upper"=>"1", "mode"=>"")
	// , array("label"=>"Tahun", "n"=> "A.TANGGAL_LAHIR", "opt"=>"10", "upper"=>"", "mode"=>"numeric")
	// , array("label"=>"Tanggal", "n"=> "A.TANGGAL_LAHIR", "opt"=>"8", "upper"=>"", "mode"=>"date")
	// , array("label"=>"Agama", "n"=> "A.AGAMA_ID", "opt"=>"12", "upper"=>"", "mode"=>"select", "vdata"=>$arragama)	
}