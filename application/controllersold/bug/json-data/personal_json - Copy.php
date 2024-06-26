<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class personal_json extends CI_Controller {

	function __construct() {
		parent::__construct();
		//kauth
		if($this->session->userdata("userpegawaiId") == "")
		{
			redirect('login');
		}
		
		$this->pegawaiId= $this->session->userdata("userpegawaiId");
		$this->userpegawaiNama= $this->session->userdata("userpegawaiNama");
		$this->adminuserid= $this->session->userdata("adminuserid");
	}

	function jsonpegawaidataadd()
	{
		$this->load->model("base-data/Pegawai");

		$reqMode= $this->input->post("reqMode");
		$reqTempValidasiId= $this->input->post("reqTempValidasiId");
		$reqPegawaiId= $this->pegawaiId;
		$reqNipLama= $this->input->post("reqNipLama");
		$reqNipBaru= $this->input->post("reqNipBaru");
		$reqSatuanKerja= $this->input->post("reqSatuanKerja");
		$reqNama= $this->input->post("reqNama");
		$reqTipePegawai= $this->input->post("reqTipePegawai");
		$reqGelarDepan= $this->input->post("reqGelarDepan");
		$reqGelarBelakang= $this->input->post("reqGelarBelakang");
		$reqStatusPegawai= $this->input->post("reqStatusPegawai");
		$reqTempatLahir= $this->input->post("reqTempatLahir");
		$reqTanggalLahir= $this->input->post("reqTanggalLahir");
		$reqJenisKelamin= $this->input->post("reqJenisKelamin");
		$reqJenisPegawai= $this->input->post("reqJenisPegawai");
		$reqStatusPernikahan= $this->input->post("reqStatusPernikahan");
		$reqKartuPegawai= $this->input->post("reqKartuPegawai");
		$reqSukuBangsa= $this->input->post("reqSukuBangsa");
		$reqGolDarah= $this->input->post("reqGolDarah");
		$reqAkses= $this->input->post("reqAkses");
		$reqTaspen= $this->input->post("reqTaspen");
		$reqAlamat= $this->input->post("reqAlamat");
		$reqNPWP= $this->input->post("reqNPWP");
		$reqNIK= $this->input->post("reqNIK");
		$reqRT= $this->input->post("reqRT");
		$reqRW= $this->input->post("reqRW");
		$reqEmail= $this->input->post("reqEmail");
		$reqPropinsiId= $this->input->post("reqPropinsiId");
		$reqKabupatenId= $this->input->post("reqKabupatenId");
		$reqKecamatanId= $this->input->post("reqKecamatanId");
		$reqDesaId= $this->input->post("reqDesaId");
		$reqBank= $this->input->post("reqBank");
		$reqNoRekening= $this->input->post("reqNoRekening");
		$reqTanggalPensiun= $this->input->post("reqTglPensiun");
		$reqTanggalPindah= $this->input->post("reqTanggalPindah");
		$reqAgamaId= $this->input->post("reqAgamaId");
		$reqTelepon= $this->input->post("reqTelepon");
		$reqKodePos= $this->input->post("reqKodePos");
		$reqKedudukanId= $this->input->post("reqKedudukanId");
		$reqKonversiNIP= $this->input->post("reqKonversiNIP");
		$reqGambar= $_FILES["reqGambar"];
		$reqGambarSetengah= $_FILES["reqGambarSetengah"];
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");
		// print_r($reqTanggalLahir);exit;
		// echo $reqTempValidasiId."--";exit;

		$set= new Pegawai();
		$set->setField("LAST_CREATE_USER", "");
		$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
		$set->setField("LAST_CREATE_SATKER", "");
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('NIP_LAMA', $reqNipLama);
		$set->setField('NIP_BARU', $reqNipBaru);
		$set->setField('SATKER_ID', $reqSatuanKerja);
		$reqNama= str_replace("\'", "''", $reqNama);	
		$set->setField('NAMA', setQuote($reqNama));
		$set->setField('TIPE_PEGAWAI_ID', $reqTipePegawai);
		$set->setField('GELAR_DEPAN', $reqGelarDepan);
		$set->setField('GELAR_BELAKANG', $reqGelarBelakang);
		$set->setField('STATUS_PEGAWAI', ValToNullDB($reqStatusPegawai));
		$set->setField('TEMPAT_LAHIR', $reqTempatLahir);
		$set->setField('TANGGAL_LAHIR', dateToDBCheck($reqTanggalLahir));
		$set->setField('TANGGAL_PENSIUN', dateToDBCheck($reqTanggalPensiun));
		$set->setField('TANGGAL_PINDAH', dateToDBCheck($reqTanggalPindah));
		$set->setField('JENIS_KELAMIN', $reqJenisKelamin);
		$set->setField('JENIS_PEGAWAI_ID', ValToNullDB($reqJenisPegawai));
		$set->setField('STATUS_KAWIN', ValToNullDB($reqStatusPernikahan));
		$set->setField('KARTU_PEGAWAI', $reqKartuPegawai);
		$set->setField('SUKU_BANGSA', $reqSukuBangsa);
		$reqGolDarah = str_replace(" ", "", $reqGolDarah);	
		$set->setField('GOLONGAN_DARAH', $reqGolDarah);
		$set->setField('ASKES', $reqAkses);
		$set->setField('TASPEN', $reqTaspen);
		$set->setField('ALAMAT', setQuote($reqAlamat,1));
		$set->setField('NPWP', $reqNPWP);
		$set->setField('NIK', $reqNIK);
		$set->setField('RT', $reqRT);
		$set->setField('RW', $reqRW);
		$set->setField('EMAIL', $reqEmail);
		$set->setField('SK_KONVERSI_NIP', $reqKonversiNIP);
		$set->setField('TANGGAL_MATI', dateToDBCheck(''));
		$set->setField('TANGGAL_TERUSAN', dateToDBCheck(''));
		$set->setField('TANGGAL_UPDATE',"CURRENT_DATE");
		$set->setField('PROPINSI_ID', ValToNullDB($reqPropinsiId));
		$set->setField('KABUPATEN_ID', ValToNullDB($reqKabupatenId));
		$set->setField('KECAMATAN_ID', ValToNullDB($reqKecamatanId));
		$set->setField('KELURAHAN_ID', ValToNullDB($reqDesaId));
		$set->setField('BANK_ID', ValToNullDB($reqBank));
		$set->setField('NO_REKENING', $reqNoRekening);
		$set->setField('AGAMA_ID', ValToNullDB($reqAgamaId));
		$set->setField('TELEPON', $reqTelepon);
		$set->setField('KODEPOS', $reqKodePos);
		$set->setField('KEDUDUKAN_ID', ValToNullDB($reqKedudukanId));

		$reqSimpan="";
	
		if($reqMode == "insert")
		{
			if($set->insert())
			{
				$reqPegawaiId= $set->pegawai_id;
				$reqSimpan = 1;
			}
		}
		elseif($reqMode == "update")
		{
			$set->setField("LAST_UPDATE_USER", "");
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", "");	
			$set->setField('TEMP_VALIDASI_ID', $reqTempValidasiId);
			if($set->update())
			{
				$reqSimpan = 1;
			}
		}
			
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaiskcpnsadd()
	{
		$this->load->model("base-data/SkCpns");
		$this->load->model("base-data/PejabatPenetap");
		$this->load->model("base-data/TrigerCpnsPnsPangkatGajiTambahan");

		$reqMode= $this->input->post("reqMode");
		$reqPegawaiId= $this->pegawaiId;
		$reqRowId= $this->input->post("reqRowId");
		$reqTempValidasiId= $this->input->post("reqTempValidasiId");
		$reqNoNotaBAKN= $this->input->post("reqNoNotaBAKN");
		$reqTanggalNotaBAKN= $this->input->post("reqTanggalNotaBAKN");
		$reqPejabatPenetapan= $this->input->post("reqPejabatPenetapan");
		$reqPejabatPenetap= $this->input->post("reqPejabatPenetap");
		$reqNamaPejabatPenetap= $this->input->post("reqNamaPejabatPenetap");
		$reqNIPPejabatPenetap= $this->input->post("reqNIPPejabatPenetap");
		$reqNoSuratKeputusan= $this->input->post("reqNoSuratKeputusan");
		$reqTanggalSuratKeputusan= $this->input->post("reqTanggalSuratKeputusan");
		$reqTerhitungMulaiTanggal= $this->input->post("reqTerhitungMulaiTanggal");
		$reqGolRuang= $this->input->post("reqGolRuang");
		$reqTanggalTugas= $this->input->post("reqTanggalTugas");
		$reqSkcpnsId= $this->input->post("reqSkcpnsId");
		$reqTh= $this->input->post("reqTh");
		$reqBl= $this->input->post("reqBl");
		$reqGajiPokok= $this->input->post("reqGajiPokok");
		$reqPejabatPenetapId= $this->input->post("reqPejabatPenetapId");
		$reqPejabatPenetap= $this->input->post("reqPejabatPenetap");
		// var_dump ($reqPejabatPenetap);exit;
		$reqStatusPejabat= $this->input->post("reqStatusPejabat");
		$reqLinkFile= $_FILES["reqLinkFile"];

		$set= new SkCpns();
		$set->setField('PEJABAT_PENETAP_ID', ValToNullDB($reqPejabatPenetapId));	
		$set->setField('PEJABAT_PENETAP', strtoupper($reqPejabatPenetap));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('PANGKAT_ID', ValToNullDB($reqGolRuang));
		$set->setField('TMT_CPNS', dateToDBCheck($reqTerhitungMulaiTanggal));
		$set->setField('TANGGAL_TUGAS', dateToDBCheck($reqTanggalTugas)); 
		$set->setField('NO_STTPP', '');
		$set->setField('NO_NOTA', $reqNoNotaBAKN);
		$set->setField('TANGGAL_NOTA', dateToDBCheck($reqTanggalNotaBAKN));
		$set->setField('NO_SK', $reqNoSuratKeputusan);
		$set->setField('TANGGAL_STTPP', dateToDBCheck($reqTanggalTugas));
		$set->setField('NAMA_PENETAP', $reqNamaPejabatPenetap);
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTanggalSuratKeputusan));
		$set->setField('NIP_PENETAP', $reqNIPPejabatPenetap);
		$set->setField('TANGGAL_UPDATE',$reqTan);
		$set->setField('MASA_KERJA_TAHUN', ValToNullDB($reqTh));
		$set->setField('MASA_KERJA_BULAN', ValToNullDB($reqBl));
		$set->setField('USER_APP_ID', $userLogin->UID);
		$set->setField('GAJI_POKOK', ValToNullDB(dotToNo($reqGajiPokok)));
		$reqSimpan="";
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", "");
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", "");
			if($reqPejabatPenetapId == "")
			{
				$set_pejabat=new PejabatPenetap();
				$set_pejabat->setField('JABATAN', strtoupper($reqPejabatPenetap));
				$set_pejabat->setField("LAST_CREATE_USER", $userLogin->idUser);
				$set_pejabat->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
				$set_pejabat->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
				$set_pejabat->insert();
				$reqPejabatPenetapId=$set_pejabat->id;
				unset($set_pejabat);
			}
			if($set->insertadmin())
			{
				$triger= new TrigerCpnsPnsPangkatGajiTambahan();
				$triger->setField("PEGAWAI_ID", $reqPegawaiId);
				$triger->setField("MODE", "sk_cpns");
				$triger->setTriger();
				unset($triger);
				$reqSimpan = 1;
			}
		}
		elseif($reqMode == "update")
		{
			$set->setField("LAST_UPDATE_USER", "");
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", "");	
			// $set->setField('TEMP_VALIDASI_ID', $reqTempValidasiId);
			$set->setField('SK_CPNS_ID',ValToNullDB($reqRowId));
			//kalau pejabat tidak ada
			if($reqPejabatPenetapId == "")
			{
				$set_pejabat=new PejabatPenetap();
				$set_pejabat->setField('JABATAN', strtoupper($reqPejabatPenetap));
				$set_pejabat->setField("LAST_CREATE_USER", $userLogin->idUser);
				$set_pejabat->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
				$set_pejabat->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
				$set_pejabat->insert();
				$reqPejabatPenetapId=$set_pejabat->id;
				unset($set_pejabat);
			}
			if($set->updateadmin())
			{
				$triger= new TrigerCpnsPnsPangkatGajiTambahan();
				$triger->setField("PEGAWAI_ID", $reqPegawaiId);
				$triger->setField("MODE", "sk_cpns");
				$triger->setTriger();
				unset($triger);
				$reqSimpan = 1 ;
			}
		}

		// echo $set->query;exit;

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaiskpnsadd()
	{
		$this->load->model("base-data/SkPns");
		$this->load->model("base-data/PejabatPenetap");
		$this->load->model("base-data/TrigerCpnsPnsPangkatGajiTambahan");

		$reqMode= $this->input->post("reqMode");
		$reqPegawaiId= $this->pegawaiId;
		$reqRowId= $this->input->post("reqRowId");
		$reqTempValidasiId= $this->input->post("reqTempValidasiId");
		$reqPejabatPenetapan= $this->input->post("reqPejabatPenetapan");
		$reqPejabatPenetap= $this->input->post("reqPejabatPenetap");
		$reqNamaPejabatPenetap= $this->input->post("reqNamaPejabatPenetap");
		$reqNIPPejabatPenetap= $this->input->post("reqNIPPejabatPenetap");
		$reqNoSuratKeputusan= $this->input->post("reqNoSuratKeputusan");
		$reqTanggalSuratKeputusan= $this->input->post("reqTanggalSuratKeputusan");
		$reqTerhitungMulaiTanggal= $this->input->post("reqTerhitungMulaiTanggal");
		$reqGolRuang= $this->input->post("reqGolRuang");
		$reqTanggalTugas= $this->input->post("reqTanggalTugas");
		$reqNoDiklatPrajabatan= $this->input->post("reqNoDiklatPrajabatan");
		$reqTanggalDiklatPrajabatan= $this->input->post("reqTanggalDiklatPrajabatan");
		$reqNoSuratUjiKesehatan= $this->input->post("reqNoSuratUjiKesehatan");
		$reqTanggalSuratUjiKesehatan= $this->input->post("reqTanggalSuratUjiKesehatan");
		$reqPengambilanSumpah= $this->input->post("reqPengambilanSumpah");
		$reqSKPNSId= $this->input->post("reqSKPNSId");
		$reqTanggalSumpah= $this->input->post("reqTanggalSumpah");
		$reqNoSKSumpah= $this->input->post("reqNoSKSumpah");
		$reqPejabatSumpah= $this->input->post("reqPejabatSumpah");
		$reqNamaPejabatPenetapSumpah= $this->input->post("reqNamaPejabatPenetapSumpah");
		$reqTh= $this->input->post("reqTh");
		$reqBl= $this->input->post("reqBl");
		$reqNoBeritaAcara= $this->input->post("reqNoBeritaAcara");
		$reqTanggalBeritaAcara= $this->input->post("reqTanggalBeritaAcara");
		// echo $reqTanggalBeritaAcara;exit;
		$reqKeteranganLPJ= $this->input->post("reqKeteranganLPJ");
		$reqPejabatPenetapId= $this->input->post("reqPejabatPenetapId");
		$reqPejabatPenetap= $this->input->post("reqPejabatPenetap");
		$reqStatusPejabat= $this->input->post("reqStatusPejabat");
		$reqPejabatSumpahId= $this->input->post("reqPejabatSumpahId");
		$reqStatusPejabatSumpah= $this->input->post("reqStatusPejabatSumpah");
		$reqLinkFile= $_FILES["reqLinkFile"];
		$reqLinkFileBeritaAcara= $_FILES["reqLinkFileBeritaAcara"];
		$reqLinkFileSuratUjiKesehatan= $_FILES["reqLinkFileSuratUjiKesehatan"];
		$reqGajiPokok= $this->input->post("reqGajiPokok");
		$reqPejabatPenetapId= $this->input->post("reqPejabatPenetapId");
		$reqPejabatPenetap= $this->input->post("reqPejabatPenetap");

		$set= new SkPns();
		$set->setField('PEJABAT_PENETAP_ID', ValToNullDB($reqPejabatPenetapId));	
		$set->setField('PEJABAT_PENETAP', strtoupper($reqPejabatPenetap));
		$set->setField('PEJABAT_PENETAP_SUMPAH_ID', ValToNullDB($reqPejabatSumpahId));	
		$set->setField('PEJABAT_PENETAP_SUMPAH', strtoupper($reqPejabatSumpah));
		$set->setField('PANGKAT_ID', ValToNullDB($reqGolRuang));
		$set->setField('TMT_PNS', dateToDBCheck($reqTerhitungMulaiTanggal));
		$set->setField('TANGGAL_TUGAS', dateToDBCheck($reqTanggalTugas)); 
		$set->setField('NO_STTPP', '');
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('NO_NOTA', $reqNoNotaBAKN);
		$set->setField('TANGGAL_NOTA', dateToDBCheck($reqTanggalNotaBAKN));
		$set->setField('NO_SK', $reqNoSuratKeputusan);
		$set->setField('TANGGAL_STTPP', dateToDBCheck($reqTanggalTugas));
		$set->setField('NAMA_PENETAP', $reqNamaPejabatPenetap);		
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTanggalSuratKeputusan));
		$set->setField('NIP_PENETAP', $reqNIPPejabatPenetap);
		$set->setField('NO_PRAJAB',$reqNoDiklatPrajabatan);
		$set->setField('NO_UJI_KESEHATAN',$reqNoSuratUjiKesehatan);
		$set->setField('TANGGAL_UJI_KESEHATAN', dateToDBCheck($reqTanggalSuratUjiKesehatan));
		$set->setField('TANGGAL_PRAJAB', dateToDBCheck($reqTanggalDiklatPrajabatan));
		$set->setField('TANGGAL_SUMPAH', dateToDBCheck($reqTanggalSumpah));
		$set->setField('NO_SK_SUMPAH', $reqNoSKSumpah);		
		$set->setField('SUMPAH', ValToNullDB((int)$reqPengambilanSumpah));
		$set->setField('MASA_KERJA_TAHUN', ValToNullDB($reqTh));
		$set->setField('MASA_KERJA_BULAN', ValToNullDB($reqBl));
		$set->setField('USER_APP_ID', $userLogin->UID);
		$set->setField('NOMOR_BERITA_ACARA',$reqNoBeritaAcara);
		$set->setField('TANGGAL_BERITA_ACARA', dateToDBCheck($reqTanggalBeritaAcara));
		$set->setField('KETERANGAN_LPJ',$reqKeteranganLPJ);
		$set->setField('GAJI_POKOK', ValToNullDB(dotToNo($reqGajiPokok)));
		$reqSimpan="";
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", "");
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", "");
			$set->setField('SK_PNS_ID',ValToNullDB($reqRowId));
			if($reqPejabatPenetapId == "")
			{
				$set_pejabat=new PejabatPenetap();
				$set_pejabat->setField('JABATAN', strtoupper($reqPejabatPenetap));
				$set_pejabat->setField("LAST_CREATE_USER", "");
				$set_pejabat->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
				$set_pejabat->setField("LAST_CREATE_SATKER", "");
				$set_pejabat->insert();
				$reqPejabatPenetapId=$set_pejabat->id;
				unset($set_pejabat);
			}
			if($set->insertadmin())
			{
				$triger= new TrigerCpnsPnsPangkatGajiTambahan();
				$triger->setField("PEGAWAI_ID", $reqPegawaiId);
				$triger->setField("MODE", "sk_pns");
				$triger->setTriger();
				unset($triger);
				$reqSimpan = 1;
			}
		}
		elseif($reqMode == "update")
		{
			$set->setField("LAST_UPDATE_USER", "");
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", "");	
			// $set->setField('TEMP_VALIDASI_ID', $reqTempValidasiId);
			$set->setField('SK_PNS_ID',ValToNullDB($reqRowId));
			//kalau pejabat tidak ada
			if($reqPejabatPenetapId == "")
			{
				$set_pejabat=new PejabatPenetap();
				$set_pejabat->setField('JABATAN', strtoupper($reqPejabatPenetap));
				$set_pejabat->setField("LAST_CREATE_USER", "");
				$set_pejabat->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
				$set_pejabat->setField("LAST_CREATE_SATKER", "");
				$set_pejabat->insert();
				$reqPejabatPenetapId=$set_pejabat->id;
				unset($set_pejabat);
			}
			if($set->updateadmin())
			{
				$triger= new TrigerCpnsPnsPangkatGajiTambahan();
				$triger->setField("PEGAWAI_ID", $reqPegawaiId);
				$triger->setField("MODE", "sk_pns");
				$triger->setTriger();
				unset($triger);
				$reqSimpan = 1 ;
			}
		}
		// echo $set->query;exit;;

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaipangkatriwayatadd()
	{
		$this->load->model("base-data/PangkatRiwayat");
		$this->load->model("base-data/TrigerCpnsPnsPangkatGajiTambahan");

		$reqMode= $this->input->post("reqMode");
		$reqPegawaiId= $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqSTLUD= $this->input->post("reqSTLUD");
		$reqNoSTLUD= $this->input->post("reqNoSTLUD");
		$reqTglSTLUD= $this->input->post("reqTglSTLUD");
		$reqTMTGol= $this->input->post("reqTMTGol");
		$reqNoNota= $this->input->post("reqNoNota");
		$reqTglNota= $this->input->post("reqTglNota");
		$reqJenisKP= $this->input->post("reqJenisKP");
		$reqKredit= $this->input->post("reqKredit");
		$reqKeterangan= $this->input->post("reqKeterangan");
		$reqNoSK= $this->input->post("reqNoSK");
		$reqTglSK= $this->input->post("reqTglSK");
		$reqGolRuang= $this->input->post("reqGolRuang");
		$reqTMTSK= $this->input->post("reqTMTSK");
		$reqPjPenetap= $this->input->post("reqPjPenetap");
		$reqStatusPejabatPenetap= $this->input->post("reqStatusPejabatPenetap");
		$reqPjPenetap_Baru= $this->input->post("reqPjPenetap_Baru");
		$reqTh= $this->input->post("reqTh");
		$reqBl= $this->input->post("reqBl");
		$reqGajiPokok= $this->input->post("reqGajiPokok");
		$reqPejabatPenetapId= $this->input->post("reqPejabatPenetapId");
		$reqPejabatPenetap= $this->input->post("reqPejabatPenetap");
		$reqStatusPejabat= $this->input->post("reqStatusPejabat");
		$reqTMTGolLama= $this->input->post("reqTMTGolLama");
		$reqTglSKLama= $this->input->post("reqTglSKLama");
		$reqGolRuangTemp= $this->input->post("reqGolRuangTemp");
		$reqLinkFile= $_FILES["reqLinkFile"];
		$reqLinkFileSTLUD= $_FILES["reqLinkFileSTLUD"];

		$set = new PangkatRiwayat();
		$set->setField('PEJABAT_PENETAP_ID', ValToNullDB($reqPejabatPenetapId));	
		$set->setField('PEJABAT_PENETAP', strtoupper($reqPejabatPenetap));
		$set->setField('PANGKAT_RIWAYAT_ID', ValToNullDB($reqRowId));
		$set->setField('PANGKAT_ID', ValToNullDB($reqGolRuang));
		$set->setField('STLUD', $reqSTLUD);
		$set->setField('NO_STLUD', $reqNoSTLUD);
		$set->setField('NO_NOTA', $reqNoNota);
		$set->setField('NO_SK', $reqNoSK);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('MASA_KERJA_TAHUN', ValToNullDB($reqTh));
		$set->setField('MASA_KERJA_BULAN', ValToNullDB($reqBl));
		$set->setField('GAJI_POKOK', ValToNullDB(dotToNo($reqGajiPokok)));
		$set->setField('KREDIT', ValToNullDB(commaToDot($reqKredit)));
		$set->setField('KETERANGAN', $reqKeterangan);
		$set->setField('JENIS_KP', ValToNullDB($reqJenisKP));
		$set->setField('KETERANGAN', $reqKeterangan);	
		$set->setField('TANGGAL_STLUD', dateToDBCheck($reqTglSTLUD));
		$set->setField('TANGGAL_NOTA', dateToDBCheck($reqTglNota));
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTglSK));
		$set->setField('TMT_PANGKAT', dateToDBCheck($reqTMTGol));
		$set->setField('USER_APP_ID', "");
		$set->setField('TEMP_VALIDASI_ID', $reqDataId);

		$reqSimpan= "";
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", "");
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", "");	

			if($set->insertadmin())
			{
				$triger= new TrigerCpnsPnsPangkatGajiTambahan();
				$triger->setField("PEGAWAI_ID", $reqPegawaiId);
				if($reqJenisKP == "9")
					$triger->setField("MODE", "pangkat_riwayat_sk_cpns");
				else
					$triger->setField("MODE", "pangkat_riwayat_sk_pns");
				$triger->setTriger();
				//echo $triger->query;exit;
				unset($triger);
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", "");
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", "");
			$set->setField('PANGKAT_ID_LAMA', $reqGolRuangTemp);
			$set->setField('TANGGAL_SK_LAMA', dateToDBCheck($reqTglSKLama));
			$set->setField('TMT_PANGKAT_LAMA', dateToDBCheck($reqTMTGolLama));
			if($set->updateadmin())
			{
				$triger= new TrigerCpnsPnsPangkatGajiTambahan();
				$triger->setField("PEGAWAI_ID", $reqPegawaiId);
				if($reqJenisKP == "9")
					$triger->setField("MODE", "pangkat_riwayat_sk_cpns");
				else
					$triger->setField("MODE", "pangkat_riwayat_sk_pns");
				$triger->setTriger();
				//echo $triger->query;exit;
				unset($triger);
				$reqSimpan= 1;
			}
		}

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaijabatanriwayatadd()
	{
		$this->load->model("base-data/JabatanRiwayat");

		$set = new JabatanRiwayat();

		$reqMode= $this->input->post("reqMode");
		// echo $reqMode;exit;
		$reqPegawaiId= $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqNoSK= $this->input->post("reqNoSK");
		$reqTglSK= $this->input->post("reqTglSK");
		$reqNamaJabatan= $this->input->post("reqNamaJabatan");
		// echo $reqNamaJabatan;;exit;
		$reqTMTJabatan= $this->input->post("reqTMTJabatan");
		$reqPejabatPenetap= $this->input->post("reqPejabatPenetap");
		$reqStatusPejabatPenetap= $this->input->post("reqStatusPejabatPenetap");
		$reqPejabatPenetap_Baru= $this->input->post("reqPejabatPenetap_Baru");
		$reqEselon= $this->input->post("reqEselon");
		$reqTMTEselon= $this->input->post("reqTMTEselon");
		$reqTMTJabatanFungsional= $this->input->post("reqTMTJabatanFungsional");
		$reqTMTTugasTambahan= $this->input->post("reqTMTTugasTambahan");
		$reqTglSKBUP= $this->input->post("reqTglSKBUP");
		$reqTMTBatasUsiaPensiun= $this->input->post("reqTMTBatasUsiaPensiun");
		$reqKeteranganBUP= $this->input->post("reqKeteranganBUP");
		$reqNoPelantikan= $this->input->post("reqNoPelantikan");    
		$reqTglPelantikan= $this->input->post("reqTglPelantikan");
		$reqTunjangan= $this->input->post("reqTunjangan");
		$reqBlnDibayar= $this->input->post("reqBlnDibayar");
		$reqSatkerId= $this->input->post("reqSatkerId");
		$reqTipePegawaiId= $this->input->post("reqTipePegawaiId");
		$reqPegawaiId= $this->input->post("reqPegawaiId");
		$reqPejabatPenetapId= $this->input->post("reqPejabatPenetapId");
		$reqStatusPejabat= $this->input->post("reqStatusPejabat");
		$reqLinkFile= $_FILES["reqLinkFile"];
		$reqLinkFilePelantikan= $_FILES["reqLinkFilePelantikan"];
		$reqLinkFileMenduduki= $_FILES["reqLinkFileMenduduki"];
		$reqLinkFileTugas= $_FILES["reqLinkFileTugas"];
		$reqLinkFileTugasTambahan= $_FILES["reqLinkFileTugasTambahan"];
		$reqRowTipePegawaiId= $this->input->post("reqRowTipePegawaiId");

		if($reqRowTipePegawaiId == "11")
		{
			$reqTMTEselon= $reqTMTJabatan;
		}
		else
		{
			$reqTMTEselon= $reqEselon= "";
		}
		$checking_pegawai="";
		if($reqTipePegawaiId == 1)
		{
			$jabatan_cek = new JabatanRiwayat();
			$checking_pegawai = $jabatan_cek->getCountByParamsJabatanTerakhir(array("SATKER_ID" => $reqSatkerId, 'NOT PEGAWAI_ID'=>$reqPegawaiId));
		}
		$reqSimpan =""; 
		if($checking_pegawai == ""){
			$set->setField('PEJABAT_PENETAP_ID', ValToNullDB($reqPejabatPenetapId));	
			$set->setField('PEJABAT_PENETAP', strtoupper($reqPejabatPenetap));
			if($reqTipePegawaiId == 1)
			{
				$set->setField('SATKER_ID', $reqSatkerId);	
				$set->setField('JABATAN_FUNGSIONAL_ID', ValToNullDB($req));	
			}
			else
			{
				$set->setField('SATKER_ID', '');	
				$set->setField('JABATAN_FUNGSIONAL_ID', ValToNullDB($reqSatkerId));
			}

			$set->setField('NO_SK', $reqNoSK);
			$set->setField('ESELON_ID', ValToNullDB($reqEselon));
			$set->setField('NAMA', $reqNamaJabatan);
			$set->setField('NO_PELANTIKAN', $reqNoPelantikan);
			$set->setField('TUNJANGAN', ValToNullDB($reqTunjangan));
			$set->setField('KREDIT', ValToNullDB($req));
			$set->setField('SUDAH_DIBAYAR', ValToNullDB($req));
			$set->setField('TANGGAL_SK', dateToDBCheck($reqTglSK));
			$set->setField('TMT_JABATAN', dateToDBCheck($reqTMTJabatan));
			$set->setField('TMT_ESELON', dateToDBCheck($reqTMTEselon));
			$set->setField('TANGGAL_PELANTIKAN', dateToDBCheck($reqTglPelantikan));
			$set->setField('BULAN_DIBAYAR', dateToDBCheck($reqBlnDibayar));
			$set->setField('TMT_JABATAN_FUNGSIONAL', dateToDBCheck($reqTMTJabatanFungsional));
			$set->setField('TMT_TUGAS_TAMBAHAN', dateToDBCheck($reqTMTTugasTambahan));
			$set->setField('TGL_SK_PERPANJANGAN_BUP', dateToDBCheck($reqTglSKBUP));
			$set->setField('TMT_BATAS_USIA_PENSIUN', dateToDBCheck($reqTMTBatasUsiaPensiun));
			$set->setField('PEGAWAI_ID', $reqPegawaiId);
			$set->setField('USER_APP_ID', $userLogin->UID);
			$set->setField('KETERANGAN_BUP', $reqKeteranganBUP);

			if($reqMode == "insert")
			{
				$set->setField("LAST_CREATE_USER", $userLogin->idUser);
				$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
				$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
				$set->setField('JABATAN_RIWAYAT_ID', ValToNullDB($reqRowId));

				if($set->insertadmin())
				{
					$reqSimpan = 1; 
				}
			}
			elseif ($reqMode == "update") 
			{
				$set->setField('JABATAN_RIWAYAT_ID', $reqRowId);
				$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
				$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
				$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
				$set->setField('TEMP_VALIDASI_ID', $reqDataId);
				if($set->updateadmin())
				{
					$reqSimpan = 1 ;
				}
			}

		}
		else
		{
			echo json_response(400, "'Jabatan telah diduduki : ".$checking_pegawai.".'");
		}

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}
	function jsonriwayatgajiadd()
	{
		$this->load->model("base-data/GajiRiwayat");
		$this->load->model("base-data/TrigerCpnsPnsPangkatGajiTambahan");

		$set = new GajiRiwayat();

		$reqMode= $this->input->post("reqMode");
		$reqMode= $this->input->post("reqMode");
		$reqPegawaiId= $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqNoSK= $this->input->post("reqNoSK");
		$reqTglSK= $this->input->post("reqTglSK");
		$reqGolRuang= $this->input->post("reqGolRuang");
		$reqTMTSK= $this->input->post("reqTMTSK");
		$reqPjPenetap= $this->input->post("reqPjPenetap");
		$reqStatusPejabatPenetap= $this->input->post("reqStatusPejabatPenetap");
		$reqPjPenetap_Baru= $this->input->post("reqPjPenetap_Baru");
		$reqTh= $this->input->post("reqTh");
		$reqBl= $this->input->post("reqBl");
		$reqGajiPokok= $this->input->post("reqGajiPokok");
		$reqJenis= $this->input->post("reqJenis");
		$reqPejabatPenetapId= $this->input->post("reqPejabatPenetapId");
		$reqPejabatPenetap= $this->input->post("reqPejabatPenetap");
		$reqStatusPejabat= $this->input->post("reqStatusPejabat");
		$reqLinkFile = $_FILES["reqLinkFile"];
		$reqSimpan =""; 
		
		$set->setField('PEJABAT_PENETAP_ID', ValToNullDB($reqPejabatPenetapId));	
		$set->setField('PEJABAT_PENETAP', strtoupper($reqPejabatPenetap));
		$set->setField('JENIS_KENAIKAN', ValToNullDB($reqJenis));
		$set->setField('SUDAH_DIBAYAR', ValToNullDB($req));
		$set->setField('POTONGAN_PANGKAT', ValToNullDB($req));
		$set->setField('NO_SK', $reqNoSK);	
		$set->setField('PANGKAT_ID', ValToNullDB($reqGolRuang));
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTglSK));
		$set->setField('GAJI_POKOK', ValToNullDB(dotToNo($reqGajiPokok)));
		$set->setField('MASA_KERJA_TAHUN', ValToNullDB($reqTh));
		$set->setField('MASA_KERJA_BULAN', ValToNullDB($reqBl));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('TMT_SK', dateToDBCheck($reqTMTSK));
		$set->setField('BULAN_DIBAYAR', dateToDBCheck($reqTglSK));
		/*$set->setField('PEKERJAAN', $reqPekerjaan);	
		$set->setField('AKHIR_BAYAR', dateToDBCheck($reqAkhirDibayar));*/
		$set->setField('USER_APP_ID', $userLogin->UID);
		
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set->setField('GAJI_RIWAYAT_ID', ValToNullDB($reqRowId));

			if($set->insertadmin())
			{
				if($reqJenis == "3" || $reqJenis == "4" || $reqJenis == "5")
				{
					$triger= new TrigerCpnsPnsPangkatGajiTambahan();
					$triger->setField("PEGAWAI_ID", $reqPegawaiId);
					if($reqJenis == "3")
						$triger->setField("MODE", "gaji_riwayat_sk_cpns");
					elseif($reqJenis == "4")
						$triger->setField("MODE", "gaji_riwayat_sk_pns");
					else
						$triger->setField("MODE", "gaji_riwayat_tambahan");
					$triger->setTriger();
					//echo $triger->query;exit;
					unset($triger);
				}
				$reqSimpan = 1; 
			}
		}
		elseif ($reqMode == "update") 
		{
			$set->setField('GAJI_RIWAYAT_ID', $reqRowId);
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('TEMP_VALIDASI_ID', $reqDataId);
			if($set->updateadmin())
			{
				if($reqJenis == "3" || $reqJenis == "4" || $reqJenis == "5")
				{
					$triger= new TrigerCpnsPnsPangkatGajiTambahan();
					$triger->setField("PEGAWAI_ID", $reqPegawaiId);
					if($reqJenis == "3")
						$triger->setField("MODE", "gaji_riwayat_sk_cpns");
					elseif($reqJenis == "4")
						$triger->setField("MODE", "gaji_riwayat_sk_pns");
					else
						$triger->setField("MODE", "gaji_riwayat_tambahan");
					$triger->setTriger();
					//echo $triger->query;exit;
					unset($triger);
				}
				$reqSimpan = 1 ;
			}
		}

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpendidikanumumadd()
	{
		$this->load->model("base-data/PendidikanRiwayat");
		$this->load->model("base-data/JurusanPendidikan");

		$reqMode= $this->input->post("reqMode");
		$reqPegawaiId= $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqPendidikan= $this->input->post("reqPendidikan");
		$reqJurusan= $this->input->post("reqJurusan");
		$reqJurusanId= $this->input->post("reqJurusanId");
		$reqNamaSekolah= $this->input->post("reqNamaSekolah");
		$reqAlamatSekolah= $this->input->post("reqAlamatSekolah");
		$reqKepalaSekolah= $this->input->post("reqKepalaSekolah");
		$reqNoSTTB= $this->input->post("reqNoSTTB");
		$reqTglSTTB= $this->input->post("reqTglSTTB");

		$set = new PendidikanRiwayat();
		$set->setField('KEPALA', setQuote($reqKepalaSekolah,1));
		$set->setField('NAMA', setQuote($reqNamaSekolah,1));
		$set->setField('PENDIDIKAN_ID', $reqPendidikan);
		$set->setField('TANGGAL_STTB', dateToDBCheck($reqTglSTTB));
		$set->setField('JURUSAN', $reqJurusan);
		$set->setField('JURUSAN_PENDIDIKAN_ID', ValToNullDB($reqJurusanId));
		$set->setField('TEMPAT', $reqAlamatSekolah);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('NO_STTB', $reqNoSTTB);
		$set->setField('USER_APP_ID', $userLogin->UID);
		
		$reqSimpan= "";
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set->setField('PENDIDIKAN_RIWAYAT_ID', ValToNullDB($reqRowId));	

			if($set->insertadmin())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);	
			$set->setField('TEMP_VALIDASI_ID', $reqDataId);
			$set->setField('PENDIDIKAN_RIWAYAT_ID', $reqRowId);
			if($set->updateadmin())
			{
				$reqSimpan= 1;
			}
		}

		// echo $set->query;exit;

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsondiklatstrukturaladd()
	{
		$this->load->model("base-data/DiklatStruktural");

		$reqMode= $this->input->post("reqMode");
		$reqPegawaiId= $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqDiklat= $this->input->post("reqDiklat");
		$reqTempat= $this->input->post("reqTempat");
		$reqPenyelenggara= $this->input->post("reqPenyelenggara");
		$reqAngkatan= $this->input->post("reqAngkatan");
		$reqTahun= $this->input->post("reqTahun");
		$reqNoSTTPP= $this->input->post("reqNoSTTPP");
		$reqTglMulai= $this->input->post("reqTglMulai");
		$reqTglSTTPP= $this->input->post("reqTglSTTPP");
		$reqTglSelesai= $this->input->post("reqTglSelesai");
		$reqJumlahJam= $this->input->post("reqJumlahJam"); 

		$set = new DiklatStruktural();
		$set->setField('TAHUN', ValToNullDB($reqTahun));
		$set->setField('DIKLAT_ID', $reqDiklat);
		$set->setField('NO_STTPP', $reqNoSTTPP);
		$set->setField('TANGGAL_MULAI', dateToDBCheck($reqTglMulai));
		$set->setField('TANGGAL_SELESAI', dateToDBCheck($reqTglSelesai));
		$set->setField('TANGGAL_STTPP', dateToDBCheck($reqTglSTTPP));
		$set->setField('PENYELENGGARA', $reqPenyelenggara);
		$set->setField('ANGKATAN', $reqAngkatan);
		$set->setField('TEMPAT', $reqTempat);
		$set->setField('JUMLAH_JAM', ValToNullDB($reqJumlahJam));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('USER_APP_ID', $userLogin->UID);
		
		$reqSimpan= "";
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set->setField('DIKLAT_STRUKTURAL_ID', ValToNullDB($reqRowId));

			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('TEMP_VALIDASI_ID', $reqDataId);
			$set->setField('DIKLAT_STRUKTURAL_ID', $reqRowId);
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsondiklatfungsionaladd()
	{
		$this->load->model("base-data/DiklatFungsional");

		$reqMode= $this->input->post("reqMode");
		$reqPegawaiId= $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqNamaDiklat= $this->input->post("reqNamaDiklat");
		$reqTempat= $this->input->post("reqTempat");
		$reqPenyelenggara= $this->input->post("reqPenyelenggara");
		$reqAngkatan= $this->input->post("reqAngkatan");
		$reqTahun= $this->input->post("reqTahun");
		$reqNoSTTPP= $this->input->post("reqNoSTTPP");
		$reqTglMulai= $this->input->post("reqTglMulai");
		$reqTglSTTPP= $this->input->post("reqTglSTTPP");
		$reqTglSelesai= $this->input->post("reqTglSelesai");
		$reqJumlahJam= $this->input->post("reqJumlahJam"); 

		$set = new DiklatFungsional();
		$set->setField('TAHUN', ValToNullDB($reqTahun));
		$set->setField('NAMA', $reqNamaDiklat);
		$set->setField('NO_STTPP', $reqNoSTTPP);
		$set->setField('TANGGAL_MULAI', dateToDBCheck($reqTglMulai));
		$set->setField('TANGGAL_SELESAI', dateToDBCheck($reqTglSelesai));
		$set->setField('TANGGAL_STTPP', dateToDBCheck($reqTglSTTPP));
		$set->setField('PENYELENGGARA', $reqPenyelenggara);
		$set->setField('ANGKATAN', $reqAngkatan);
		$set->setField('TEMPAT', $reqTempat);
		$set->setField('JUMLAH_JAM', ValToNullDB($reqJumlahJam));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('USER_APP_ID', $userLogin->UID);
		
		$reqSimpan= "";
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set->setField('DIKLAT_FUNGSIONAL_ID', ValToNullDB($reqRowId));

			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('TEMP_VALIDASI_ID', $reqDataId);
			$set->setField('DIKLAT_FUNGSIONAL_ID', $reqRowId);
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsondiklatteknisadd()
	{
		$this->load->model("base-data/DiklatTeknis");

		$reqMode= $this->input->post("reqMode");
		$reqPegawaiId= $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqNamaDiklat= $this->input->post("reqNamaDiklat");
		$reqTempat= $this->input->post("reqTempat");
		$reqPenyelenggara= $this->input->post("reqPenyelenggara");
		$reqAngkatan= $this->input->post("reqAngkatan");
		$reqTahun= $this->input->post("reqTahun");
		$reqNoSTTPP= $this->input->post("reqNoSTTPP");
		$reqTglMulai= $this->input->post("reqTglMulai");
		$reqTglSTTPP= $this->input->post("reqTglSTTPP");
		$reqTglSelesai= $this->input->post("reqTglSelesai");
		$reqJumlahJam= $this->input->post("reqJumlahJam"); 

		$set = new DiklatTeknis();
		$set->setField('TAHUN', ValToNullDB($reqTahun));
		$set->setField('NAMA', $reqNamaDiklat);
		$set->setField('NO_STTPP', $reqNoSTTPP);
		$set->setField('TANGGAL_MULAI', dateToDBCheck($reqTglMulai));
		$set->setField('TANGGAL_SELESAI', dateToDBCheck($reqTglSelesai));
		$set->setField('TANGGAL_STTPP', dateToDBCheck($reqTglSTTPP));
		$set->setField('PENYELENGGARA', $reqPenyelenggara);
		$set->setField('ANGKATAN', $reqAngkatan);
		$set->setField('TEMPAT', $reqTempat);
		$set->setField('JUMLAH_JAM', ValToNullDB($reqJumlahJam));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('USER_APP_ID', $userLogin->UID);
		
		$reqSimpan= "";
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set->setField('DIKLAT_TEKNIS_ID', ValToNullDB($reqRowId));

			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('TEMP_VALIDASI_ID', $reqDataId);
			$set->setField('DIKLAT_TEKNIS_ID', $reqRowId);
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaiseminaradd()
	{
		$this->load->model("base-data/Seminar");

		$reqMode= $this->input->post("reqMode");
		$reqPegawaiId= $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqNamaSeminar= $this->input->post("reqNamaSeminar");
		$reqTempat= $this->input->post("reqTempat");
		$reqPenyelenggara= $this->input->post("reqPenyelenggara");
		$reqTglMulai= $this->input->post("reqTglMulai");
		$reqNoPiagam= $this->input->post("reqNoPiagam");
		$reqTglSelesai= $this->input->post("reqTglSelesai"); 

		$set = new Seminar();
		$set->setField('NAMA', $reqNamaSeminar);
		$set->setField('TEMPAT', $reqTempat);
		$set->setField('TANGGAL_PIAGAM', dateToDBCheck($reqTglPiagam));
		$set->setField('PENYELENGGARA', $reqPenyelenggara);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('NO_PIAGAM', $reqNoPiagam);
		$set->setField('TANGGAL_MULAI', dateToDBCheck($reqTglMulai));
		$set->setField('TANGGAL_SELESAI', dateToDBCheck($reqTglSelesai));
		
		$reqSimpan= "";
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set->setField('SEMINAR_ID', ValToNullDB($reqRowId));

			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('TEMP_VALIDASI_ID', $reqDataId);
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}


	function jsontambahanmasakerjaadd()
	{
		$this->load->model("base-data/TambahanMasaKerja");
		$this->load->model("base-data/TrigerCpnsPnsPangkatGajiTambahan");
		$this->load->model("base-data/PejabatPenetap");

		$reqMode= $this->input->post("reqMode");
		$reqPegawaiId= $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqTambMKId= $this->input->post("reqTambMKId");
		$reqNoSK= $this->input->post("reqNoSK");
		$reqTglSK= $this->input->post("reqTglSK");
		$reqTMTSK= $this->input->post("reqTMTSK");
		$reqTambahanMasaKerja= $this->input->post("reqTambahanMasaKerja");
		$reqMasaKerja= $this->input->post("reqMasaKerja");
		$reqThTMK= $this->input->post("reqThTMK");
		$reqThMK= $this->input->post("reqThMK");
		$reqBlTMK= $this->input->post("reqBlTMK");
		$reqBlMK= $this->input->post("reqBlMK");
		$reqLinkFile= $_FILES["reqLinkFile"];
		$reqGajiPokok= $this->input->post("reqGajiPokok");
		$reqPejabatPenetapId= $this->input->post("reqPejabatPenetapId");
		$reqPejabatPenetap= $this->input->post("reqPejabatPenetap");
		$reqGolRuang= $this->input->post("reqGolRuang"); 
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");

		$set = new TambahanMasaKerja();
		$set->setField('BULAN_BARU', $reqBlMK);
		$set->setField('BULAN_TAMBAHAN', $reqBlTMK);
		$set->setField('NO_SK', $reqNoSK);
		$set->setField('TAHUN_BARU', $reqThMK);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('TAHUN_TAMBAHAN', $reqThTMK);
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTglSK));
		$set->setField('TMT_SK', dateToDBCheck($reqTMTSK));
		$set->setField('USER_APP_ID', $userLogin->UID);
		$set->setField('PANGKAT_ID', ValToNullDB($reqGolRuang));
		$set->setField('PEJABAT_PENETAP_ID', ValToNullDB($reqPejabatPenetapId));	
		$set->setField('PEJABAT_PENETAP', strtoupper($reqPejabatPenetap));
		$set->setField('GAJI_POKOK', ValToNullDB(dotToNo($reqGajiPokok)));

		if($reqPejabatPenetapId == "")
		{
			$set_pejabat=new PejabatPenetap();
			$set_pejabat->setField('JABATAN', strtoupper($reqPejabatPenetap));
			$set_pejabat->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set_pejabat->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set_pejabat->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set_pejabat->insert();
			$reqPejabatPenetapId=$set_pejabat->id;
			unset($set_pejabat);
		}

		
		$reqSimpan= "";
		
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			// $set->setField('TAMBAHAN_MASA_KERJA_ID',ValToNullDB($reqRowId));

			if($set->insert())
			{
				$triger= new TrigerCpnsPnsPangkatGajiTambahan();
				$triger->setField("PEGAWAI_ID", $reqPegawaiId);
				$triger->setField("MODE", "tambahan_gaji");
				$triger->setTriger();
					//echo $triger->query;exit;
				unset($triger);
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('TEMP_VALIDASI_ID', $reqDataId);
			$set->setField("TAMBAHAN_MASA_KERJA_ID", $reqRowId);
			if($set->update())
			{

				$triger= new TrigerCpnsPnsPangkatGajiTambahan();
				$triger->setField("PEGAWAI_ID", $reqPegawaiId);
				$triger->setField("MODE", "tambahan_gaji");
				$triger->setTriger();
					//echo $triger->query;exit;
				unset($triger);
				$reqSimpan= 1;
			}
		}
		
		// echo $set->query;exit;

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonorangtuaadd()
	{
		$this->load->model("base-data/OrangTua");

		$reqMode= $this->input->post("reqMode");
		$reqModeAyah= $this->input->post("reqModeAyah");
		$reqModeIbu= $this->input->post("reqModeIbu");
		$reqPegawaiId= $this->input->post('reqPegawaiId');
		$reqRowIdAyah= $this->input->post("reqRowIdAyah");
		$reqDataIdAyah= $this->input->post("reqDataIdAyah");
		$reqRowIdIbu= $this->input->post("reqRowIdIbu");
		$reqDataIdIbu= $this->input->post("reqDataIdIbu");
		$reqAyahId= $this->input->post("reqIdAyah");
		$reqIbuId= $this->input->post("reqIdIbu");
		$reqNamaAyah= $this->input->post("reqNamaAyah");
		$reqNamaIbu= $this->input->post("reqNamaIbu");
		$reqTempatLahirAyah= $this->input->post("reqTempatLahirAyah");
		$reqTempatLahirIbu= $this->input->post("reqTempatLahirIbu");
		$reqTglLahirAyah= $this->input->post("reqTglLahirAyah");
		$reqTglLahirIbu= $this->input->post("reqTglLahirIbu");
		$reqUsiaAyah= $this->input->post("reqUsiaAyah");
		$reqUsiaIbu= $this->input->post("reqUsiaIbu");
		$reqPekerjaanAyah= $this->input->post("reqPekerjaanAyah");
		$reqPekerjaanIbu= $this->input->post("reqPekerjaanIbu");
		$reqAlamatAyah= $this->input->post("reqAlamatAyah");
		$reqAlamatIbu= $this->input->post("reqAlamatIbu");
		$reqPropinsiAyahId= $this->input->post("reqPropinsiAyahId");
		$reqPropinsiIbuId= $this->input->post("reqPropinsiIbuId");
		$reqKabupatenAyahId= $this->input->post("reqKabupatenAyahId");
		$reqKabupatenIbuId= $this->input->post("reqKabupatenIbuId");
		$reqKecamatanAyahId= $this->input->post("reqKecamatanAyahId");
		$reqKecamatanIbuId= $this->input->post("reqKecamatanIbuId");
		$reqDesaAyahId= $this->input->post("reqDesaAyahId");
		$reqDesaIbuId= $this->input->post("reqDesaIbuId");
		$reqKodePosAyah= $this->input->post("reqKodePosAyah");
		$reqKodePosIbu= $this->input->post("reqKodePosIbu");
		$reqTeleponAyah= $this->input->post("reqTeleponAyah");
		$reqTeleponIbu= $this->input->post("reqTeleponIbu");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");
		// echo  $reqStatusValidasi;exit;

		$set = new OrangTua();
		$set->setField("PEGAWAI_ID", $reqPegawaiId);


		$reqSimpan= "";
	
		if($reqModeAyah == "insert" || $reqModeIbu == "insert")
		{
			if($reqModeAyah == "insert")
			{
				$set->setField("JENIS_KELAMIN", "L");
				$set->setField("NAMA", $reqNamaAyah);
				$set->setField("TEMPAT_LAHIR", $reqTempatLahirAyah);
				$set->setField("TANGGAL_LAHIR", dateToDBCheck($reqTglLahirAyah));
				$set->setField("PEKERJAAN", $reqPekerjaanAyah);
				$set->setField("ALAMAT", $reqAlamatAyah);
				$set->setField("KODEPOS", $reqKodePosAyah);
				$set->setField("TELEPON", $reqTeleponAyah);
				$set->setField("PROPINSI_ID", ValToNullDB($reqPropinsiAyahId));
				$set->setField("KABUPATEN_ID", ValToNullDB($reqKabupatenAyahId));
				$set->setField("KECAMATAN_ID", ValToNullDB($reqKecamatanAyahId));
				$set->setField("KELURAHAN_ID", ValToNullDB($reqDesaAyahId));
				$set->setField("LAST_CREATE_USER", $userLogin->idUser);
				$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
				$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
				$set->setField('ORANG_TUA_ID',ValToNullDB($reqRowIdAyah));
				if($set->insert())
				{
					$reqSimpan = 1;
				}
			}
			if($reqModeIbu == "insert")
			{
				$set->setField("JENIS_KELAMIN", "P");
				$set->setField("NAMA", $reqNamaIbu);
				$set->setField("TEMPAT_LAHIR", $reqTempatLahirIbu);
				$set->setField("TANGGAL_LAHIR", dateToDBCheck($reqTglLahirIbu));
				$set->setField("PEKERJAAN", $reqPekerjaanIbu);
				$set->setField("ALAMAT", $reqAlamatIbu);
				$set->setField("KODEPOS", $reqKodePosIbu);
				$set->setField("TELEPON", $reqTeleponIbu);
				$set->setField("PROPINSI_ID", ValToNullDB($reqPropinsiIbuId));
				$set->setField("KABUPATEN_ID", ValToNullDB($reqKabupatenIbuId));
				$set->setField("KECAMATAN_ID", ValToNullDB($reqKecamatanIbuId));
				$set->setField("KELURAHAN_ID", ValToNullDB($reqDesaIbuId));
				$set->setField("LAST_CREATE_USER", $userLogin->idUser);
				$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
				$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
				$set->setField('ORANG_TUA_ID',ValToNullDB($reqRowIdIbu));
				if($set->insert())
				{
					$reqSimpan = 1;
				}
			}
		}
		elseif($reqModeAyah == "update" || $reqModeIbu == "update")
		{
			if($reqModeAyah == "update")
			{
				$set->setField("JENIS_KELAMIN", "L");
				$set->setField("NAMA", $reqNamaAyah);
				$set->setField("TEMPAT_LAHIR", $reqTempatLahirAyah);
				$set->setField("TANGGAL_LAHIR", dateToDBCheck($reqTglLahirAyah));
				$set->setField("PEKERJAAN", $reqPekerjaanAyah);
				$set->setField("ALAMAT", $reqAlamatAyah);
				$set->setField("KODEPOS", $reqKodePosAyah);
				$set->setField("TELEPON", $reqTeleponAyah);
				$set->setField("ORANG_TUA_ID", $reqAyahId);
				$set->setField("PROPINSI_ID", ValToNullDB($reqPropinsiAyahId));
				$set->setField("KABUPATEN_ID", ValToNullDB($reqKabupatenAyahId));
				$set->setField("KECAMATAN_ID", ValToNullDB($reqKecamatanAyahId));
				$set->setField("KELURAHAN_ID", ValToNullDB($reqDesaAyahId));
				$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
				$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
				$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
				$set->setField('ORANG_TUA_ID', $reqRowIdAyah);

				if($set->update())
				{
					$reqSimpan = 1;
				}
			}
			if($reqModeIbu == "update")
			{
				$set->setField("JENIS_KELAMIN", "P");
				$set->setField("NAMA", $reqNamaIbu);
				$set->setField("TEMPAT_LAHIR", $reqTempatLahirIbu);
				$set->setField("TANGGAL_LAHIR", dateToDBCheck($reqTglLahirIbu));
				$set->setField("PEKERJAAN", $reqPekerjaanIbu);
				$set->setField("ALAMAT", $reqAlamatIbu);
				$set->setField("KODEPOS", $reqKodePosIbu);
				$set->setField("TELEPON", $reqTeleponIbu);
				$set->setField("ORANG_TUA_ID", $reqIbuId);
				$set->setField("PROPINSI_ID", ValToNullDB($reqPropinsiIbuId));
				$set->setField("KABUPATEN_ID", ValToNullDB($reqKabupatenIbuId));
				$set->setField("KECAMATAN_ID", ValToNullDB($reqKecamatanIbuId));
				$set->setField("KELURAHAN_ID", ValToNullDB($reqDesaIbuId));
				$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
				$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
				$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
				$set->setField('ORANG_TUA_ID', $reqRowIdIbu);

				if($set->update())
				{
					$reqSimpan = 1;
				}
			}
		}

		

		// echo $set->query;exit;

		

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaisuamiistriadd()
	{
		$this->load->model("base-data/SuamiIstri");

		$reqMode = $this->input->post("reqMode");
		$reqPegawaiId = $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqIdSuamiIstri= $this->input->post("reqIdSuamiIstri");
		$reqNamaSuamiIstri= $this->input->post("reqNamaSuamiIstri");
		$reqTempatLahir= $this->input->post("reqTempatLahir");
		$reqTglLahir= $this->input->post("reqTglLahir");
		$reqNoAktaNikah= $this->input->post("reqNoAktaNikah");
		$reqStatus= $this->input->post("reqStatus");
		$reqNoHp= $this->input->post("reqNoHp");
		$reqTglNikah= $this->input->post("reqTglNikah");
		$reqTglKawin= $this->input->post("reqTglKawin");
		$reqPns= $this->input->post("reqPns");
		$reqNIP= $this->input->post("reqNIP");
		$reqPendidikan= $this->input->post("reqPendidikan");
		$reqPekerjaan= $this->input->post("reqPekerjaan");
		$reqTunjangan= $this->input->post("reqTunjangan");
		$reqSudahDibayar= $this->input->post("reqSudahDibayar");
		$reqBulanDibayar= $this->input->post("reqBulanDibayar");
		$reqKartu= $this->input->post("reqKartu");
		$reqFoto = $_FILES["reqFoto"];
		$reqFotoTmp= $this->input->post("reqFotoTmp");
		$reqDosirKarpeg= $_FILES["reqDosirKarpeg"];
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");

		$set = new SuamiIstri();
		$set->setField("PEGAWAI_ID", $reqPegawaiId);
		$set->setField("PENDIDIKAN_ID", ValToNullDB($reqPendidikan));
		$set->setField("NAMA", $reqNamaSuamiIstri);
		$set->setField("TEMPAT_LAHIR", $reqTempatLahir);
		$set->setField("TANGGAL_LAHIR", dateToDBCheck($reqTglLahir));
		$set->setField("TANGGAL_KAWIN", dateToDBCheck($reqTglKawin));
		$set->setField('SK_CERAI', $reqNoAktaNikah);
		$set->setField('STATUS', ValToNullDB($reqStatus));
		$set->setField('BUKU_NIKAH', $reqNoHp);
		$set->setField("KARTU", $reqKartu);
		$set->setField("STATUS_PNS", ValToNullDB($reqPns));
		$set->setField("NIP_PNS", $reqNIP);
		$set->setField("PEKERJAAN", $reqPekerjaan);
		$set->setField("STATUS_TUNJANGAN", ValToNullDB($reqTunjangan));
		$set->setField("STATUS_BAYAR", ValToNullDB($reqSudahDibayar));
		$set->setField("BULAN_BAYAR", dateToDBCheck($reqBulanDibayar));
		
		$reqSimpan= "";
	
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set->setField('SUAMI_ISTRI_ID',ValToNullDB($reqRowId));

			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('TEMP_VALIDASI_ID', $reqDataId);
			$set->setField("SUAMI_ISTRI_ID", $reqRowId);
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}
		

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaianakadd()
	{
		$this->load->model("base-data/Anak");

		$reqMode = $this->input->post("reqMode");
		$reqPegawaiId = $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqNama = $this->input->post("reqNama");
		$reqTmpLahir = $this->input->post("reqTmpLahir");
		$reqTglLahir = $this->input->post("reqTglLahir");
		$reqLP= $this->input->post("reqLP");
		$reqStatus= $this->input->post("reqStatus");
		$reqDapatTunjangan= $this->input->post("reqDapatTunjangan");
		$reqPendidikan= $this->input->post("reqPendidikan");
		$reqPekerjaan= $this->input->post("reqPekerjaan");
		$reqMulaiDibayar= $this->input->post("reqMulaiDibayar");
		$reqAkhirDibayar= $this->input->post("reqAkhirDibayar");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");

		$set = new Anak();
		$set->setField('NAMA', setQuote($reqNama,1));
		$set->setField('TEMPAT_LAHIR', $reqTmpLahir);
		$set->setField('TANGGAL_LAHIR', dateToDBCheck($reqTglLahir));
		$set->setField('JENIS_KELAMIN', $reqLP);
		$set->setField('STATUS_KELUARGA', ValToNullDB($reqStatus));
		$set->setField('STATUS_TUNJANGAN', ValToNullDB($reqDapatTunjangan));
		$set->setField('PENDIDIKAN_ID', ValToNullDB($reqPendidikan));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('PEKERJAAN', $reqPekerjaan);
		$set->setField('AWAL_BAYAR', dateToDBCheck($reqMulaiDibayar));
		$set->setField('AKHIR_BAYAR', dateToDBCheck($reqAkhirDibayar));
		$set->setField('USER_APP_ID', ValToNullDB($userLogin->UID));
		
		$reqSimpan= "";

		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);	
			$set->setField('ANAK_ID', ValToNullDB($reqRowId));

			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);	
			$set->setField('TEMP_VALIDASI_ID', $reqDataId);
			$set->setField("ANAK_ID", $reqRowId);
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}
		

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaiorganisasiadd()
	{
		$this->load->model("base-data/OrganisasiRiwayat");

		$reqMode =  $this->input->post("reqMode");
		$reqPegawaiId =  $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqNamaOrganisasi= $this->input->post("reqNamaOrganisasi");
		$reqJabatan= $this->input->post("reqJabatan");
		$reqAwal= $this->input->post("reqAwal");
		$reqAkhir= $this->input->post("reqAkhir");
		$reqPimpinan= $this->input->post("reqPimpinan");
		$reqTempat= $this->input->post("reqTempat");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");

		$set = new OrganisasiRiwayat();
		$set->setField('JABATAN', $reqJabatan);
		$set->setField('NAMA', $reqNamaOrganisasi);
		$set->setField('TANGGAL_AWAL', dateToDBCheck($reqAwal));
		$set->setField('TANGGAL_AKHIR', dateToDBCheck($reqAkhir));
		$set->setField('PIMPINAN', $reqPimpinan);
		$set->setField('TEMPAT', $reqTempat);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		
		$reqSimpan= "";

		// if(is_numeric($reqStatusValidasi))
		// {
		// 	$set->setField('VALIDASI', $reqStatusValidasi);
		// 	$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
		// 	$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
		// 	$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
		// 	$set->setField('TEMP_VALIDASI_ID', $reqDataId);

		// 	if($set->updatevalidasi())
		// 	{
		// 		$reqSimpan= "1";
		// 	}
		// }
		// else
		// {
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set->setField('ORGANISASI_RIWAYAT_ID', ValToNullDB($reqRowId));

			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);	
			$set->setField('TEMP_VALIDASI_ID', $reqDataId);
			$set->setField('ORGANISASI_RIWAYAT_ID', $reqRowId);
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}
		// }

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaipenghargaanadd()
	{
		$this->load->model("base-data/Penghargaan");

		$reqMode=  $this->input->post("reqMode");
		$reqPegawaiId=  $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqTahun= $this->input->post("reqTahun");
		$reqNamaPenghargaan= $this->input->post("reqNamaPenghargaan");
		$reqNoSK= $this->input->post("reqNoSK");
		$reqTglSK= $this->input->post("reqTglSK");
		$reqPjPenetap= $this->input->post("reqPjPenetap");
		$reqStatusPejabatPenetap= $this->input->post("reqStatusPejabatPenetap");
		$reqPjPenetap_Baru= $this->input->post("reqPjPenetap_Baru");
		$reqPejabatPenetapId= $this->input->post("reqPejabatPenetapId");
		$reqStatusPejabat= $this->input->post("reqStatusPejabat");
		$reqPejabatPenetap= $this->input->post("reqPejabatPenetap");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");

		$set = new Penghargaan();
		$set->setField('PEJABAT_PENETAP_ID', ValToNullDB($reqPejabatPenetapId));	
		$set->setField('PEJABAT_PENETAP', strtoupper($reqPejabatPenetap));
		$set->setField('NAMA', $reqNamaPenghargaan);
		$set->setField('TAHUN', ValToNullDB($reqTahun));
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTglSK));
		$set->setField('NO_SK', $reqNoSK);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);

		$reqSimpan= "";
		
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set->setField('PENGHARGAAN_ID', ValToNullDB($reqRowId));

			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);	
			$set->setField('TEMP_VALIDASI_ID', $reqDataId);
			$set->setField('PENGHARGAAN_ID', $reqRowId);
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}
		

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaipenilaianpotensiadd()
	{
		$this->load->model("base-data/PotensiDiri");

		$reqMode=  $this->input->post("reqMode");
		$reqPegawaiId=  $this->input->post('reqPegawaiId');
		$reqDataId= $this->input->post("reqDataId");
		$reqTahun= $this->input->post("reqTahun");
		$reqTanggungJawab= $this->input->post("reqTanggungJawab");
		$reqMotivasi= $this->input->post("reqMotivasi");
		$reqMinat= $this->input->post("reqMinat");
		$reqRowId= $this->input->post("reqRowId");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");

		$set = new PotensiDiri();
		$set->setField('TAHUN', $reqTahun);
		$set->setField('TANGGUNG_JAWAB', $reqTanggungJawab);
		$set->setField('MOTIVASI', $reqMotivasi);
		$set->setField('MINAT', $reqMinat);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		
		$reqSimpan= "";
		
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('POTENSI_DIRI_ID', ValToNullDB($reqRowId));
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}
		

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaipenilaianprestasiadd()
	{
		$this->load->model("base-data/PenilaianKerja");

		$reqMode=  $this->input->post("reqMode");
		$reqPegawaiId=  $this->input->post('reqPegawaiId');
		$reqDataId= $this->input->post("reqDataId");
		$reqRowId=  $this->input->post('reqRowId');
		$reqTahun= $this->input->post("reqTahun");
		$reqNilai1= $this->input->post("reqNilai1");
		$reqNilai2= $this->input->post("reqNilai2");
		$reqNilai3= $this->input->post("reqNilai3");
		$reqNilai4= $this->input->post("reqNilai4");
		$reqNilai5= $this->input->post("reqNilai5");
		$reqNilai6= $this->input->post("reqNilai6");
		$reqJumlah= $this->input->post("reqJumlah");
		$reqRataRata= $this->input->post("reqRataRata");
		$reqSasaranKerja= $this->input->post("reqSasaranKerja");
		$reqSasaranKerjaHasil= $this->input->post("reqSasaranKerjaHasil");
		$reqPerilakuHasil= $this->input->post("reqPerilakuHasil");
		$reqNilaiHasil= $this->input->post("reqNilaiHasil");
		$reqTanggalAwal= $this->input->post("reqTanggalAwal");
		$reqTanggalAkhir= $this->input->post("reqTanggalAkhir");
		$reqRekomendasi= $this->input->post("reqRekomendasi");
		$reqPejabatPenetapId= $this->input->post("reqPejabatPenetapId");
		$reqPejabatPenetap= $this->input->post("reqPejabatPenetap");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");


		$set = new PenilaianKerja();
		$set->setField('PEJABAT_PENETAP_ID', ValToNullDB($reqPejabatPenetapId));	
		$set->setField('PEJABAT_PENETAP', strtoupper($reqPejabatPenetap));

		$set->setField('TAHUN', $reqTahun);
		$set->setField('NILAI1', ValToNullDB(commaToDot($reqNilai1)));
		$set->setField('NILAI2', ValToNullDB(commaToDot($reqNilai2)));
		$set->setField('NILAI3', ValToNullDB(commaToDot($reqNilai3)));
		$set->setField('NILAI4', ValToNullDB(commaToDot($reqNilai4)));
		$set->setField('NILAI5', ValToNullDB(commaToDot($reqNilai5)));
		$set->setField('NILAI6', ValToNullDB(commaToDot($reqNilai6)));
		$set->setField('JUMLAH', ValToNullDB(commaToDot($reqJumlah)));
		$set->setField('RATA_RATA', ValToNullDB(commaToDot($reqRataRata)));

		$set->setField('TANGGAL_AWAL', dateToDBCheck($reqTanggalAwal));
		$set->setField('TANGGAL_AKHIR', dateToDBCheck($reqTanggalAkhir));

		$set->setField('SASARAN_KERJA', ValToNullDB(commaToDot($reqSasaranKerja)));
		$set->setField('SASARAN_KERJA_HASIL', ValToNullDB(commaToDot($reqSasaranKerjaHasil)));
		$set->setField('PERILAKU_HASIL', ValToNullDB(commaToDot($reqPerilakuHasil)));
		$set->setField('NILAI_HASIL', ValToNullDB(commaToDot($reqNilaiHasil)));
		$set->setField('REKOMENDASI', $reqRekomendasi);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('USER_APP_ID', $userLogin->UID);
		
		$reqSimpan= "";
		
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('PENILAIAN_KERJA_ID', ValToNullDB($reqRowId));
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}
		
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaihukumanadd()
	{
		$this->load->model("base-data/Hukuman");
		$this->load->model("base-data/PejabatPenetap");

		$reqMode = $this->input->post("reqMode");
		$reqPegawaiId = $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqTingkatHukuman = $this->input->post("reqTingkatHukuman");
		$reqPeraturan = $this->input->post("reqPeraturan");
		$reqMasihBerlaku = $this->input->post("reqMasihBerlaku");
		$reqJenisHukuman= $this->input->post("reqJenisHukuman");
		$reqNoSK= $this->input->post("reqNoSK");
		$reqTanggalSK= $this->input->post("reqTanggalSK");
		$reqTMTSK= $this->input->post("reqTMTSK");
		$reqPermasalahan= $this->input->post("reqPermasalahan");
		$reqPjPenetap= $this->input->post("reqPjPenetap");
		$reqStatusPejabatPenetap= $this->input->post("reqStatusPejabatPenetap");
		$reqPjPenetap_Baru= $this->input->post("reqPjPenetap_Baru");
		$reqTanggalMulai= $this->input->post("reqTanggalMulai");
		$reqTanggalAkhir= $this->input->post("reqTanggalAkhir");
		$reqPejabatPenetapId= $this->input->post("reqPejabatPenetapId");
		$reqPejabatPenetap= $this->input->post("reqPejabatPenetap");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");

		$set = new Hukuman();
		$set->setField('PEJABAT_PENETAP_ID', ValToNullDB($reqPejabatPenetapId));	
		$set->setField('PEJABAT_PENETAP', strtoupper($reqPejabatPenetap));
		$set->setField('TANGGAL_MULAI', dateToDBCheck($reqTanggalMulai));
		$set->setField('TANGGAL_AKHIR', dateToDBCheck($reqTanggalAkhir));
		$set->setField('NO_SK', $reqNoSK);
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTanggalSK));
		$set->setField('TMT_SK', dateToDBCheck($reqTMTSK));
		$set->setField('JENIS_HUKUMAN_ID', ValToNullDB($reqJenisHukuman));
		$set->setField('TINGKAT_HUKUMAN_ID', ValToNullDB($reqTingkatHukuman));
		$set->setField('PERATURAN_ID', ValToNullDB($reqPeraturan));
		$set->setField('KETERANGAN', $reqPermasalahan);
		$set->setField('PEGAWAI_ID',$reqPegawaiId);
		$set->setField('BERLAKU',ValToNullDB((int)$reqMasihBerlaku));

		$statementPejabat = " AND JABATAN = '".strtoupper($reqPejabatPenetap)."'";
		$pejabat_cek =new PejabatPenetap();
		$pejabat_cek->selectByParams(array(), -1, -1, $statementPejabat);
		$pejabat_cek->firstRow();
		$reqPejabatPenetapId = $pejabat_cek->getField("PEJABAT_PENETAP_ID");

		//kalau pejabat tidak ada
		if($reqPejabatPenetapId == "")
		{
			$set_pejabat=new PejabatPenetap();
			$set_pejabat->setField('JABATAN', strtoupper($reqPejabatPenetap));
			$set_pejabat->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set_pejabat->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set_pejabat->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set_pejabat->insert();
			$reqPejabatPenetapId=$set_pejabat->id;
			unset($set_pejabat);
		}

		
		
		$reqSimpan= "";
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set->setField('HUKUMAN_ID', ValToNullDB($reqRowId));
			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('HUKUMAN_ID', ValToNullDB($reqRowId));
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}
		

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaicutiadd()
	{
		$this->load->model("base-data/Cuti");

		$reqMode = $this->input->post("reqMode");
		$reqPegawaiId = $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqTahun= $this->input->post("reqTahun");
		$reqJenisCuti= $this->input->post("reqJenisCuti");
		$reqNoSurat= $this->input->post("reqNoSurat");
		$reqTanggalSurat= $this->input->post("reqTanggalSurat");
		$reqTanggalMulai= $this->input->post("reqTanggalMulai");
		$reqTanggalSelesai= $this->input->post("reqTanggalSelesai");
		$reqTanggalPermohonan= $this->input->post("reqTanggalPermohonan");
		$reqLama= $this->input->post("reqLama");
		$reqCutiKeterangan= $this->input->post("reqCutiKeterangan");
		$reqKeterangan= $this->input->post("reqKeterangan");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");

		$set = new Cuti();
		$set->setField('NO_SURAT', $reqNoSurat);
		$set->setField('JENIS_CUTI', ValToNullDB($reqJenisCuti));
		$set->setField('TANGGAL_PERMOHONAN', dateToDBCheck($reqTanggalPermohonan));
		$set->setField('TANGGAL_SURAT', dateToDBCheck($reqTanggalSurat));
		$set->setField('TANGGAL_MULAI', dateToDBCheck($reqTanggalMulai));
		$set->setField('TANGGAL_SELESAI', dateToDBCheck($reqTanggalSelesai));	
		$set->setField('LAMA', ValToNullDB($reqLama));
		$set->setField("CUTI_KETERANGAN", $reqCutiKeterangan);
		$set->setField('KETERANGAN', $reqKeterangan);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		
		$reqSimpan= "";
		
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);	
			$set->setField('CUTI_ID', ValToNullDB($reqRowId));
			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('CUTI_ID', ValToNullDB($reqRowId));
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}
		

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaibahasaadd()
	{
		$this->load->model("base-data/Bahasa");

		$reqMode = $this->input->post("reqMode");
		$reqPegawaiId = $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqNamaBahasa= $this->input->post("reqNamaBahasa");
		$reqJenisBahasa= $this->input->post("reqJenisBahasa");
		$reqKemampuanBicara= $this->input->post("reqKemampuanBicara");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");
		// echo  $reqStatusValidasi;exit;

		$set = new Bahasa();
		$set->setField('NAMA', $reqNamaBahasa);
		$set->setField('JENIS', $reqJenisBahasa);
		$set->setField('KEMAMPUAN', $reqKemampuanBicara);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);

		$reqSimpan= "";
	
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set->setField('BAHASA_ID', ValToNullDB($reqRowId));
			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('BAHASA_ID', ValToNullDB($reqRowId));
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}

		
		// echo $set->query;exit;
		
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaibahasavalidasi()
	{
		$this->load->model("base-data/Bahasa");

		$reqMode = $this->input->post("reqMode");
		$reqPegawaiId = $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqTempValidasiId= $this->input->post("reqTempValidasiId");
		$reqValidasi= $this->input->post("reqValidasi");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");
		$reqTempValidasiHapusId= $this->input->post("reqTempValidasiHapusId");


		if(empty($reqStatusValidasi))
        {
            echo json_response(400, 'Isikan terlebih dahulu Status Klarifikasi.');
            exit;
        }
        elseif($reqStatusValidasi == "2")
        {
            if(empty($reqTempValidasiId) && !empty($reqTempValidasiHapusId))
            {
                $set->setField('TEMP_VALIDASI_ID', $reqTempValidasiHapusId);
                $reqSimpan= "";
                if($set->deletehapusdata())
                {
                    $reqSimpan= "1";
                }

            }
            else
            {
                $set->setField('VALIDASI', $reqStatusValidasi);
                $set->setField("LAST_LEVEL", $this->LOGIN_LEVEL);
                $set->setField("LAST_USER", $this->LOGIN_USER);
                $set->setField("USER_LOGIN_ID", $this->LOGIN_ID);
                $set->setField("USER_LOGIN_PEGAWAI_ID", ValToNullDB($this->LOGIN_PEGAWAI_ID));
                $set->setField("LAST_DATE", "NOW()");
                $set->setField('TEMP_VALIDASI_ID', $reqTempValidasiId);

                $reqSimpan= "";
                if($set->updatevalidasi())
                {
                    $reqSimpan= "1";
                }

            }

        }
        else
        {
        	$reqNamaBahasa= $this->input->post("reqNamaBahasa");
        	$reqJenisBahasa= $this->input->post("reqJenisBahasa");
        	$reqKemampuanBicara= $this->input->post("reqKemampuanBicara");

			$set = new Bahasa();
			$set->setField('NAMA', $reqNamaBahasa);
			$set->setField('JENIS', $reqJenisBahasa);
			$set->setField('KEMAMPUAN', $reqKemampuanBicara);
			$set->setField('PEGAWAI_ID', $reqPegawaiId);

			$set->setField('BAHASA_ID', $reqRowId);
            $set->setField('VALIDASI', ValToNullDB($reqStatusValidasi));
            $set->setField('TEMP_VALIDASI_ID', $reqTempValidasiId);
			
			$reqSimpan= "";

			if ($reqValidasi ==  1)
			{
				if(!empty($reqTempValidasiId))
				{
					$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
					$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
					$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
					if($set->update())
					{
						$set->updatetanggalvalidasi();
						$reqSimpan= "1";
					}
				}
				elseif(empty($reqTempValidasiId) && !empty($reqTempValidasiHapusId))
				{
					$set->setField('VALIDASI', $reqStatusValidasi);
					$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
					$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
					$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
					$set->setField('TEMP_VALIDASI_ID', $reqTempValidasiHapusId);

					$reqSimpan= "";
					if($set->updatevalidasihapusdata())
					{
						$reqSimpan= "1";
					}
				}

			}
			else
			{
				if($reqMode == "insert")
				{
					$set->setField("LAST_CREATE_USER", $userLogin->idUser);
					$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
					$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
					$set->setField('BAHASA_ID', ValToNullDB($reqRowId));
					if($set->insert())
					{
						$reqSimpan= 1;
					}
				}
				elseif($reqMode == "update")
				{	
					$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
					$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
					$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
					$set->setField('TEMP_VALIDASI_ID', $reqTempValidasiId);
					if($set->update())
					{
						$reqSimpan= 1;
					}
				}
			}
			
		}


		// echo $set->query;exit;

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaikursusadd()
	{
		$this->load->model("base-data/Kursus");

		$reqMode = $this->input->post("reqMode");
		$reqPegawaiId = $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");

		$reqTipeKursus= $this->input->post("reqTipeKursus");
		$reqNamaKursus= $this->input->post("reqNamaKursus");
		$reqLamaKursus= $this->input->post("reqLamaKursus");
		$reqJenisBahasa= $this->input->post("reqJenisBahasa");
		$reqKemampuanBicara= $this->input->post("reqKemampuanBicara");
		$reqTanggalKursus= $this->input->post("reqTanggalKursus");
		$reqTahunKursus= $this->input->post("reqTahunKursus");
		$reqNoSertifikat= $this->input->post("reqNoSertifikat");
		$reqInstansiId= $this->input->post("reqInstansiId");
		$reqInstitusi= $this->input->post("reqInstitusi");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");

		$set = new Kursus();
		$set->setField('NAMA', $reqNamaKursus);
		$set->setField('LAMA', ValToNullDB($reqLamaKursus));
		$set->setField('TANGGAL_MULAI', dateToDBCheck($reqTanggalKursus));
		$set->setField('INSTANSI_ID', ValToNullDB($reqInstansiId));
		$set->setField('TIPE',ValToNullDB($reqTipeKursus));
		$set->setField('NO_PIAGAM', $reqNoSertifikat);
		$set->setField('PENYELENGGARA', $reqInstitusi);
		$set->setField('TAHUN', ValToNullDB($reqTahunKursus));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		
		$reqSimpan= "";
		
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('KURSUS_ID', $reqRowId);
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}
		

		// echo $set->query;exit;

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaidiklatadd()
	{
		$this->load->model("base-data/PegawaiDiklat");

		$reqMode = $this->input->post("reqMode");
		$reqPegawaiId = $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqNomor= $this->input->post("reqNomor");
		$reqTanggal= $this->input->post("reqTanggal");
		$reqTahun= $this->input->post("reqTahun");
		$reqDiklat= $this->input->post("reqDiklat");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");

		$set = new PegawaiDiklat();
		$set->setField('NOMOR', $reqNomor);
		$set->setField('TANGGAL', dateToDBCheck($reqTanggal));
		$set->setField('TAHUN', ValToNullDB($reqTahun));
		$set->setField("DIKLAT_ID", $reqDiklat);
		$set->setField("PEGAWAI_ID", $reqPegawaiId);
		
		$reqSimpan= "";

		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);	
			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('PEGAWAI_DIKLAT_ID', $reqRowId);
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}
		
		// echo $set->query;exit;

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}																												
	
	function jsonpangkatriwayat()
	{
		$this->load->model("base-data/PangkatRiwayat");

		$set= new PangkatRiwayat();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		// print_r($columnsDefault);exit;

		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND A.PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = " ORDER BY A.TMT_PANGKAT ASC";
		$set->selectByParamsAdmin(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function jsonpangkatriwayatdelete()
	{
		$this->load->model("base-data/PangkatRiwayat");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new PangkatRiwayat();
		$set->setField('PANGKAT_RIWAYAT_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
	function jsonpegawaijabatan()
	{
		$this->load->model("base-data/JabatanRiwayat");

		$set= new JabatanRiwayat();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND A.PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = "";
		$set->selectByParamsAdmin(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}
	function jsonjabatanriwayatdelete()
	{
		$this->load->model("base-data/JabatanRiwayat");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new JabatanRiwayat();
		$set->setField('JABATAN_RIWAYAT_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->deleteMaster())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
	function jsonpegawairiwayatgaji()
	{
		$this->load->model("base-data/GajiRiwayat");

		$set= new GajiRiwayat();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND A.PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = " ORDER BY A.TMT_SK ASC";
		$set->selectByParamsAdmin(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}
	function jsonriwayatgajidelete()
	{
		$this->load->model("base-data/GajiRiwayat");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new GajiRiwayat();
		$set->setField('GAJI_RIWAYAT_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}				
	function jsonpendidikanumum()
	{
		$this->load->model("base-data/PendidikanRiwayat");

		$adminuserid= $this->adminuserid;


		$set= new PendidikanRiwayat();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND A.PEGAWAI_ID = ".$this->pegawaiId;
		// if (!empty($adminuserid))
		// {
		// 	$statement.= " AND TEMP_VALIDASI_ID IS NOT NULL";
		// }
		$sOrder = "";
		$set->selectByParamsAdmin(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}
	function jsonpendidikanumumdelete()
	{
		$this->load->model("base-data/PendidikanRiwayat");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new PendidikanRiwayat();
		$set->setField('PENDIDIKAN_RIWAYAT_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
					
	function jsondiklatstruktural()
	{
		$this->load->model("base-data/DiklatStruktural");

		$set= new DiklatStruktural();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}
	function jsondiklatstrukturaldelete()
	{
		$this->load->model("base-data/DiklatStruktural");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new DiklatStruktural();
		$set->setField('TEMP_VALIDASI_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
	function jsondiklatfungsional()
	{
		$this->load->model("base-data/DiklatFungsional");

		$set= new DiklatFungsional();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}
	function jsondiklatfungsionaldelete()
	{
		$this->load->model("base-data/DiklatFungsional");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new DiklatFungsional();
		$set->setField('TEMP_VALIDASI_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
	function jsondiklatteknis()
	{
		$this->load->model("base-data/DiklatTeknis");

		$set= new DiklatTeknis();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function jsondiklatteknisdelete()
	{
		$this->load->model("base-data/DiklatTeknis");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new DiklatTeknis();
		$set->setField('TEMP_VALIDASI_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
	function jsonpegawaiseminar()
	{
		$this->load->model("base-data/Seminar");

		$set= new Seminar();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}
	function jsonpegawaiseminardelete()
	{
		$this->load->model("base-data/Seminar");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new Seminar();
		$set->setField('TEMP_VALIDASI_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
	function jsonpegawaisuamiistri()
	{
		$this->load->model("base-data/SuamiIstri");

		$adminuserid= $this->adminuserid;

		$set= new SuamiIstri();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND A.PEGAWAI_ID = ".$this->pegawaiId;

		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function jsonpegawaisuamiistridelete()
	{
		$this->load->model("base-data/SuamiIstri");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new SuamiIstri();
		$set->setField('SUAMI_ISTRI_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
	function jsonpegawaianak()
	{
		$this->load->model("base-data/Anak");

		$adminuserid= $this->adminuserid;

		$set= new Anak();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;

		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}
	function jsonpegawaianakdelete()
	{
		$this->load->model("base-data/Anak");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new Anak();
		$set->setField('ANAK_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
	function jsonpegawaiorganisasi()
	{
		$this->load->model("base-data/OrganisasiRiwayat");

		$adminuserid= $this->adminuserid;

		$set= new OrganisasiRiwayat();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function jsonpegawaiorganisasidelete()
	{
		$this->load->model("base-data/OrganisasiRiwayat");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new OrganisasiRiwayat();
		$set->setField('TEMP_VALIDASI_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
	function jsonpegawaipenghargaandelete()
	{
		$this->load->model("base-data/Penghargaan");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new Penghargaan();
		$set->setField('PENGHARGAAN_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}

	function jsonpegawaipenilaiandelete()
	{
		$this->load->model("base-data/PotensiDiri");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new PotensiDiri();
		$set->setField('TEMP_VALIDASI_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
	function jsonpegawaipenghargaan()
	{
		$this->load->model("base-data/Penghargaan");

		$adminuserid= $this->adminuserid;

		$set= new Penghargaan();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}
	
	function jsonpegawaipotensidiri()
	{
		$this->load->model("base-data/PotensiDiri");

		$adminuserid= $this->adminuserid;

		$set= new PotensiDiri();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;
		
		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}
	function jsonpegawaiprestasi()
	{
		$this->load->model("base-data/PenilaianKerja");

		$adminuserid= $this->adminuserid;


		$set= new PenilaianKerja();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}
	function jsonpegawaipenilaianprestasidelete()
	{
		$this->load->model("base-data/PenilaianKerja");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new PenilaianKerja();
		$set->setField('PENILAIAN_KERJA_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
	function jsonpegawaihukuman()
	{
		$this->load->model("base-data/Hukuman");
		$adminuserid= $this->adminuserid;

		$set= new Hukuman();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;

		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}
	function jsonriwayathukumandelete()
	{
		$this->load->model("base-data/Hukuman");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new Hukuman();
		$set->setField('HUKUMAN_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
	function jsonpegawaicuti()
	{
		$this->load->model("base-data/Cuti");
		$adminuserid= $this->adminuserid;

		$set= new Cuti();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;

		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function jsonpegawaicutidelete()
	{
		$this->load->model("base-data/Cuti");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new Cuti();
		$set->setField('CUTI_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}
	function jsonpegawaibahasa()
	{
		$this->load->model("base-data/Bahasa");

		$set= new Bahasa();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$adminuserid= $this->adminuserid;


		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;

		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function jsonpegawaibahasadelete()
	{
		$this->load->model("base-data/Bahasa");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new Bahasa();
		$set->setField('BAHASA_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}

	function jsonpegawaikursus()
	{
		$this->load->model("base-data/Kursus");

		$adminuserid= $this->adminuserid;


		$set= new Kursus();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;

		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function jsonpegawaikursusdelete()
	{
		$this->load->model("base-data/Kursus");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new Kursus();
		$set->setField('KURSUS_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}

	function jsonpegawaidiklat()
	{
		$this->load->model("base-data/PegawaiDiklat");

		$set= new PegawaiDiklat();

		$adminuserid= $this->adminuserid;

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		// print_r($columnsDefault);exit;

		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND A.PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = " ORDER BY A.TANGGAL ASC";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else if ($valkey == "TANGGAL")
				{
					$row[$valkey]= dateToPageCheck($set->getField($valkey));
				}
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function jsonpegawaidiklatdelete()
	{
		$this->load->model("base-data/PegawaiDiklat");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new PegawaiDiklat();
		$set->setField('PEGAWAI_DIKLAT_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}

	function jsonpegawaijabatantipe()
	{
		$this->load->model("base-data/PegawaiJabatan");

		$set= new PegawaiJabatan();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND A.PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = "";
		$set->selectByParamsMonitoring(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$jenisjabatan = $set->getField("JENIS_JABATAN_ID");
			// print_r($jenisjabatan);exit;
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{

				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else if ($valkey == "NAMA_FUNGSIONAL")
				{ 
					if ($jenisjabatan == 1)
					{
						$row[$valkey]= $set->getField("NAMA_STRUKTURAL");
					}
					else if ($jenisjabatan == 2 || $jenisjabatan == 4)
					{
						$row[$valkey]= $set->getField("NAMA_FUNGSIONAL");
					}
					else if  ($jenisjabatan == 3)
					{
						$row[$valkey]= $set->getField("NAMA_PELAKSANA");
					}
					
				}
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}
		// print_r($arrinfodata);exit;

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function jsonpegawaijabatanadd()
	{
		$this->load->model("base-data/PegawaiJabatan");

		$reqMode= $this->input->post("reqMode");
		$reqRowId= $this->input->post("reqRowId");
		$reqTempValidasiId= $this->input->post("reqTempValidasiId");
		$reqPegawaiId= $this->pegawaiId;
		$reqJenisJabatan= $this->input->post("reqJenisJabatan");
		$reqKategoriJabatan= $this->input->post("reqKategoriJabatan");
		$reqKategoriJabatanId= $this->input->post("reqKategoriJabatanId");
		$reqJabatanId= $this->input->post("reqJabatanId");
		$reqBup= $this->input->post("reqBup");
		$reqKelJab= $this->input->post("reqKelJab");
		$reqTmtJabatan= $this->input->post("reqTmtJabatan");
		// var_dump ($reqJabatanId);exit;
		$reqTanggalSuratKeputusan= $this->input->post("reqTanggalSuratKeputusan");
		$reqNoSk= $this->input->post("reqNoSk");
		$reqTugasTambahan= $this->input->post("reqTugasTambahan");
		$reqTugasTambahanId= $this->input->post("reqTugasTambahanId");
		$reqEselonId= $this->input->post("reqEselonId");
		$reqUnorId= $this->input->post("reqUnorId");
		

		$set= new PegawaiJabatan();
		$set->setField("LAST_CREATE_USER", "");
		$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
		$set->setField("LAST_CREATE_SATKER", "");
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('JENIS_JABATAN_ID', ValToNullDB($reqJenisJabatan));
		$a="";
		if ($reqJenisJabatan == 1) {
			$set->setField('JABATAN_STRUKTURAL_NEW_ID', $reqJabatanId);
		}
		elseif($reqJenisJabatan == 2 || $reqJenisJabatan == 4)
		{
			$set->setField('JABATAN_FUNGSIONAL_NEW_ID', $reqJabatanId);
			
		}
		elseif ($reqJenisJabatan == 3) {
			$set->setField('JABATAN_PELAKSANA_NEW_ID', $reqJabatanId);
		}

		if($reqJenisJabatan == 4)
		{
			$set->setField('TUGAS_TAMBAHAN_ID', $reqTugasTambahanId);
			$set->setField('TUGAS_TAMBAHAN_NAMA', $reqTugasTambahan);
		}

		$set->setField('ESELON_ID', ValToNullDB($reqEselonId));
		$set->setField('TIPE_PEGAWAI_NEW_ID', $reqKategoriJabatan);
		$set->setField('BUP', ValToNullDB($reqBup));
		$set->setField('KELAS_JABATAN', ValToNullDB($reqKelJab));
		$set->setField('TMT_JABATAN', dateToDBCheck($reqTmtJabatan));
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTanggalSuratKeputusan));
		$set->setField('NO_SK', $reqNoSk);
		$set->setField('USER_APP_ID', ValToNullDB($userLogin->UID));
		$set->setField('UNOR_ID', ValToNullDB($reqUnorId));
		

		$reqSimpan= "";
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('PEGAWAI_JABATAN_ID', $reqRowId);
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}

		// echo $set->query;exit;
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaijabatantipedelete()
	{
		$this->load->model("base-data/PegawaiJabatan");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new PegawaiJabatan();
		$set->setField('PEGAWAI_JABATAN_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}

	function jsonpegawaijabatantambahan()
	{
		$this->load->model("base-data/PegawaiJabatan");

		$set= new PegawaiJabatan();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement.= " AND TIPE_PEGAWAI_NEW_ID = '16' ";
		$sOrder = " ORDER BY JABATAN_STRUKTURAL_NEW_ID";
		$set->selectByParamsJabatanTambahan(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$jenisjabatan = $set->getField("JENIS_JABATAN_ID");
			// print_r($jenisjabatan);exit;
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{

				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}
		// print_r($arrinfodata);exit;

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}


	function monitoringpegawai()
	{
		$this->load->model("base-data/MonitoringPegawai");

		$set= new MonitoringPegawai();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement.= " AND (STATUS_PEGAWAI = 1 OR STATUS_PEGAWAI = 2 OR STATUS_PEGAWAI = 9) ";
		$sOrder = " ORDER BY CASE WHEN COALESCE(C.ESELON_ID,99) = 99 THEN 99 WHEN C.ESELON_ID = 0 THEN 99 ELSE C.ESELON_ID END ASC, B.PANGKAT_ID DESC, B.TMT_PANGKAT ASC";
		$set->selectByParamsMonitoringPegawai(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$jenisjabatan = $set->getField("JENIS_JABATAN_ID");
			// print_r($jenisjabatan);exit;
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{

				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}
		// print_r($arrinfodata);exit;

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function pegawaiverifikator()
	{
		$this->load->model("base-data/Pegawaiverifikator");

		$set= new Pegawaiverifikator();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement.= " AND (STATUS_PEGAWAI = 1 OR STATUS_PEGAWAI = 2 OR STATUS_PEGAWAI = 9) ";
		$sOrder = " ORDER BY CASE WHEN COALESCE(C.ESELON_ID,99) = 99 THEN 99 WHEN C.ESELON_ID = 0 THEN 99 ELSE C.ESELON_ID END ASC, B.PANGKAT_ID DESC, B.TMT_PANGKAT ASC";
		$set->selectByParamsPegawaiVerifikator(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$jenisjabatan = $set->getField("JENIS_JABATAN_ID");
			// print_r($jenisjabatan);exit;
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{

				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}
		// print_r($arrinfodata);exit;

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function jsonpegawaikontrak()
	{
		$this->load->model("base-data/Kontrak");

		$adminuserid= $this->adminuserid;


		$set= new Kontrak();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
				{
					$row[$valkey]= "1";
				}
				else if ($valkey == "TANGGAL_SK" || $valkey == "TMT_SK" || $valkey == "SELESAI_KONTRAK")
				{
					$row[$valkey]= dateToPageCheck($set->getField($valkey));
				}
				else
				{
					$row[$valkey]= $set->getField($valkey);
				}
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function jsonpegawaikontrakdelete()
	{
		$this->load->model("base-data/Kontrak");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new Kontrak();
		$set->setField('RIWAYAT_KONTRAK_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}

	function jsonkontrakadd()
	{
		$this->load->model("base-data/Kontrak");
		$this->load->model("base-data/PejabatPenetap");

		$reqMode= $this->input->post("reqMode");
		$reqPegawaiId= $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");
		$reqTambMKId= $this->input->post("reqTambMKId");
		$reqNoSK= $this->input->post("reqNoSK");
		$reqTglSK= $this->input->post("reqTglSK");
		$reqTMTSK= $this->input->post("reqTMTSK");
		$reqSelesai= $this->input->post("reqSelesai");
		$reqMasaBerlaku= $this->input->post("reqMasaBerlaku");
		$reqMasaKerjaTahun= $this->input->post("reqMasaKerjaTahun");
		$reqMasaKerjaBulan= $this->input->post("reqMasaKerjaBulan");
		$reqGolonganPppkId= $this->input->post("reqGolonganPppkId");
		$reqGajiPokok= $this->input->post("reqGajiPokok");
		$reqPejabatPenetapId= $this->input->post("reqPejabatPenetapId");
		$reqPejabatPenetap= $this->input->post("reqPejabatPenetap");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");

		$set = new Kontrak();
		$set->setField('MASA_KERJA_BULAN', $reqMasaKerjaBulan);
		$set->setField('MASA_KERJA_TAHUN', $reqMasaKerjaTahun);
		$set->setField('NO_SK', $reqNoSK);
		$set->setField('MASA_BERLAKU', ValToNullDB($reqMasaBerlaku));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTglSK));
		$set->setField('SELESAI_KONTRAK', dateToDBCheck($reqSelesai));
		$set->setField('TMT_SK', dateToDBCheck($reqTMTSK));
		$set->setField('USER_APP_ID', $userLogin->UID);
		$set->setField('GOLONGAN_PPPK_ID', ValToNullDB($reqGolonganPppkId));
		$set->setField('PEJABAT_PENETAP_ID', ValToNullDB($reqPejabatPenetapId));	
		$set->setField('PEJABAT_PENETAP', strtoupper($reqPejabatPenetap));
		$set->setField('GAJI_POKOK', ValToNullDB(dotToNo($reqGajiPokok)));

		if($reqPejabatPenetapId == "")
		{
			$set_pejabat=new PejabatPenetap();
			$set_pejabat->setField('JABATAN', strtoupper($reqPejabatPenetap));
			$set_pejabat->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set_pejabat->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set_pejabat->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$set_pejabat->insert();
			$reqPejabatPenetapId=$set_pejabat->id;
			unset($set_pejabat);
		}

		
		$reqSimpan= "";
		
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);

			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField("RIWAYAT_KONTRAK_ID", $reqRowId);
			if($set->update())
			{

				$reqSimpan= 1;
			}
		}
		
		// echo $set->query;exit;

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonriwayatpendidikan()
	{
		$this->load->model("base-data/PegawaiPendidikanRiwayat");

		$adminuserid= $this->adminuserid;


		$set= new PegawaiPendidikanRiwayat();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND PEGAWAI_ID = ".$this->pegawaiId;
		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
				{
					$row[$valkey]= "1";
				}
				else if ($valkey == "TANGGAL_LULUS" || $valkey == "TMT_SK" || $valkey == "SELESAI_KONTRAK")
				{
					$row[$valkey]= dateToPageCheck($set->getField($valkey));
				}
				else
				{
					$row[$valkey]= $set->getField($valkey);
				}
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function jsonriwayatpendidikandelete()
	{
		$this->load->model("base-data/PegawaiPendidikanRiwayat");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new PegawaiPendidikanRiwayat();
		$set->setField('PEGAWAI_PENDIDIKAN_RIWAYAT_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}

	function jsonriwayatpendidikanadd()
	{
		$this->load->model("base-data/PegawaiPendidikanRiwayat");

		$reqMode= $this->input->post("reqMode");
		$reqPegawaiId= $this->input->post('reqPegawaiId');
		$reqRowId= $this->input->post("reqRowId");
		$reqDataId= $this->input->post("reqDataId");

		$reqPendidikanId= $this->input->post("reqPendidikanId");
		$reqPendidikan= $this->input->post("reqPendidikan");
		$reqJurusanId= $this->input->post("reqJurusanId");
		$reqJurusan= $this->input->post("reqJurusan");
		$reqTglSTTB= $this->input->post("reqTglSTTB");
		$reqTahun= $this->input->post("reqTahun");
		$reqNomorIjazah= $this->input->post("reqNomorIjazah");
		$reqNamaSekolah= $this->input->post("reqNamaSekolah");
		$reqGelarDepan= $this->input->post("reqGelarDepan");
		$reqGelarBelakang= $this->input->post("reqGelarBelakang");
		$reqPendidikanCpns= $this->input->post("reqPendidikanCpns");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");
		$reqIdPegawaiPendidikan= $this->input->post("reqIdPegawaiPendidikan");

		$set = new PegawaiPendidikanRiwayat();
		$set->setField('PEGAWAI_PENDIDIKAN_ID', ValToNullDB($reqPendidikanId));
		$set->setField('TINGKAT_PENDIDIKAN_ID', ValToNullDB($reqJurusanId));
		$set->setField('TANGGAL_LULUS', dateToDBCheck($reqTglSTTB));
		$set->setField('TAHUN_LULUS', $reqTahun);
		$set->setField('NOMOR_IJAZAH', $reqNomorIjazah);
		$set->setField('NAMA_SEKOLAH', $reqNamaSekolah);
		$set->setField('GELAR_DEPAN', $reqGelarDepan);
		$set->setField('GELAR_BELAKANG', $reqGelarBelakang);
		$set->setField('PENDIDIKAN_CPNS', ValToNullDB($reqPendidikanCpns));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('USER_APP_ID', $userLogin->UID);
		$set->setField('ID', $reqIdPegawaiPendidikan);

		$reqSimpan= "";
		
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $userLogin->idUser);
			$set->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);

			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		elseif($reqMode == "update")
		{	
			$set->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$set->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$set->setField('TEMP_VALIDASI_ID', $reqDataId);
			$set->setField("PEGAWAI_PENDIDIKAN_RIWAYAT_ID", ValToNullDB($reqRowId));
			if($set->update())
			{

				$reqSimpan= 1;
			}
		}
		
		// echo $set->query;exit;

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}
	
	function jsonpegawaiskp()
	{
		$this->load->model("base-data/PenilaianKerjaPegawai");

		$adminuserid= $this->adminuserid;


		$set= new PenilaianKerjaPegawai();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$statement= " AND A.PEGAWAI_ID = ".$this->pegawaiId;

		// if (!empty($adminuserid))
		// {
		// 	$statement.= " AND TEMP_VALIDASI_ID IS NOT NULL";
		// }
		$sOrder = "";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else
					$row[$valkey]= $set->getField($valkey);
			}
			array_push($arrinfodata, $row);
		}

		// get all raw data
		$alldata = $arrinfodata;
		// print_r($alldata);exit;

		$data = [];
		// internal use; filter selected columns only from raw data
		foreach ( $alldata as $d ) {
			// $data[] = filterArray( $d, $columnsDefault );
			$data[] = $d;
		}

		// count data
		$totalRecords = $totalDisplay = count( $data );

		// filter by general search keyword
		if ( isset( $_REQUEST['search'] ) ) {
			$data         = filterKeyword( $data, $_REQUEST['search'] );
			$totalDisplay = count( $data );
		}

		if ( isset( $_REQUEST['columns'] ) && is_array( $_REQUEST['columns'] ) ) {
			foreach ( $_REQUEST['columns'] as $column ) {
				if ( isset( $column['search'] ) ) {
					$data         = filterKeyword( $data, $column['search'], $column['data'] );
					$totalDisplay = count( $data );
				}
			}
		}

		// sort
		if ( isset( $_REQUEST['order'][0]['column'] ) && $_REQUEST['order'][0]['dir'] ) {
			$column = $_REQUEST['order'][0]['column'];
			if(count($columnsDefault) - 2 == $column){}
			else
			{
				$dir    = $_REQUEST['order'][0]['dir'];
				usort( $data, function ( $a, $b ) use ( $column, $dir ) {
					$a = array_slice( $a, $column, 1 );
					$b = array_slice( $b, $column, 1 );
					$a = array_pop( $a );
					$b = array_pop( $b );

					if ( $dir === 'asc' ) {
						return $a > $b ? true : false;
					}

					return $a < $b ? true : false;
				} );
			}
		}

		// pagination length
		if ( isset( $_REQUEST['length'] ) ) {
			$data = array_splice( $data, $_REQUEST['start'], $_REQUEST['length'] );
		}

		// return array values only without the keys
		if ( isset( $_REQUEST['array_values'] ) && $_REQUEST['array_values'] ) {
			$tmp  = $data;
			$data = [];
			foreach ( $tmp as $d ) {
				$data[] = array_values( $d );
			}
		}

		$result = [
		    'recordsTotal'    => $totalRecords,
		    'recordsFiltered' => $totalDisplay,
		    'data'            => $data,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}

	function jsonpegawaiskpdelete()
	{
		$this->load->model("base-data/PenilaianKerjaPegawai");
		$reqDetilId= $this->input->get("reqDetilId");
		$set= new PenilaianKerjaPegawai();
		$set->setField('PENILAIAN_KERJA_PEGAWAI_ID', $reqDetilId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
		if($set->delete())	
		{
			$reqSimpan=1;
		}
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil dihapus');
		}
		else
		{
			echo json_response(400, 'Data gagal dihapus');
		}
				
	}

	function jsonskpadd()
	{
		$this->load->model("base-data/PenilaianKerjaPegawai");

		$reqMode 			= $this->input->post("reqMode");
		$reqPegawaiId 		= $this->input->post('reqPegawaiId');
		$reqRowId			= $this->input->post("reqRowId");
		$reqDataId			= $this->input->post("reqDataId");

		$reqJenisJabatanId= $this->input->post("reqJenisJabatanId");
		$reqTahun= $this->input->post("reqTahun");
		$reqNilai1= $this->input->post("reqNilai1");
		$reqNilai2= $this->input->post("reqNilai2");
		$reqNilai3= $this->input->post("reqNilai3");
		$reqNilai4= $this->input->post("reqNilai4");
		$reqNilai5= $this->input->post("reqNilai5");
		$reqNilai6= $this->input->post("reqNilai6");
		$reqJumlah= $this->input->post("reqJumlah");
		$reqRataRata= $this->input->post("reqRataRata");
		$reqSasaranKerja= $this->input->post("reqSasaranKerja");
		$reqSasaranKerjaHasil= $this->input->post("reqSasaranKerjaHasil");
		$reqPerilakuHasil= $this->input->post("reqPerilakuHasil");
		$reqNilaiHasil= $this->input->post("reqNilaiHasil");
		$reqPerilakuKinerja= $this->input->post("reqPerilakuKinerja");
		$reqTanggalAwal= $this->input->post("reqTanggalAwal");
		$reqTanggalAkhir= $this->input->post("reqTanggalAkhir");
		$reqRekomendasi= $this->input->post("reqRekomendasi");

		$reqPejabatNipId= $this->input->post("reqPejabatNipId");
		$reqAtasanNipId= $this->input->post("reqAtasanNipId");
		$reqNamaPejabat= $this->input->post("reqNamaPejabat");
		$reqPejabatJabatan= $this->input->post("reqPejabatJabatan");
		$reqPejabatUnor= $this->input->post("reqPejabatUnor");
		$reqPejabatGolongan= $this->input->post("reqPejabatGolongan");
		$reqPejabatTmtGolongan= $this->input->post("reqPejabatTmtGolongan");

		$reqAtasanNipId= $this->input->post("reqAtasanNipId");
		$reqNamaAtasan= $this->input->post("reqNamaAtasan");
		$reqAtasanJabatan= $this->input->post("reqAtasanJabatan");
		$reqAtasanUnor= $this->input->post("reqAtasanUnor");
		$reqAtasanGolongan= $this->input->post("reqAtasanGolongan");
		$reqAtasanTmtGolongan= $this->input->post("reqAtasanTmtGolongan");

		$reqStatusValidasi= $this->input->post("reqStatusValidasi");

		$reqPejabatStatus= $this->input->post("reqPejabatStatus");
		$reqAtasanStatus= $this->input->post("reqAtasanStatus");

		$penilaian_kerja = new PenilaianKerjaPegawai();
		$penilaian_kerja->setField('PEJABAT_PENILAI_ID', ValToNullDB($reqPejabatNipId));
		$penilaian_kerja->setField('ATASAN_PEJABAT_PENILAI_ID', ValToNullDB($reqAtasanNipId));
		$penilaian_kerja->setField('JENIS_JABATAN_ID',  ValToNullDB($reqJenisJabatanId));	

		$penilaian_kerja->setField('TAHUN',  ValToNullDB($reqTahun));
		$penilaian_kerja->setField('NILAI1', ValToNullDB(commaToDot($reqNilai1)));
		$penilaian_kerja->setField('NILAI2', ValToNullDB(commaToDot($reqNilai2)));
		$penilaian_kerja->setField('NILAI3', ValToNullDB(commaToDot($reqNilai3)));
		$penilaian_kerja->setField('NILAI4', ValToNullDB(commaToDot($reqNilai4)));
		$penilaian_kerja->setField('NILAI5', ValToNullDB(commaToDot($reqNilai5)));
		$penilaian_kerja->setField('NILAI6', ValToNullDB(commaToDot($reqNilai6)));
		$penilaian_kerja->setField('JUMLAH', ValToNullDB(commaToDot($reqJumlah)));
		// $penilaian_kerja->setField('RATA_RATA', ValToNullDB(commaToDot($reqRataRata)));
		$penilaian_kerja->setField('JENIS_JABATAN_ID',  ValToNullDB($reqJenisJabatanId));
		$penilaian_kerja->setField('STATUS',  ValToNullDB($reqPejabatStatus));
		$penilaian_kerja->setField('STATUS_ATASAN',  ValToNullDB($reqAtasanStatus));

		$penilaian_kerja->setField('SASARAN_KERJA', ValToNullDB(commaToDot($reqSasaranKerja)));
		$penilaian_kerja->setField('SASARAN_KERJA_HASIL', ValToNullDB(commaToDot($reqSasaranKerjaHasil)));
		$penilaian_kerja->setField('PERILAKU_HASIL', ValToNullDB(commaToDot($reqPerilakuHasil)));
		$penilaian_kerja->setField('NILAI_PERILAKU', ValToNullDB(commaToDot($reqPerilakuKinerja)));
		$penilaian_kerja->setField('NILAI_HASIL', ValToNullDB(commaToDot($reqNilaiHasil)));
		$penilaian_kerja->setField('TMT_GOLONGAN', dateToDBCheck($reqPejabatTmtGolongan));

		$penilaian_kerja->setField('NAMA_ATASAN_PENILAI', strtoupper($reqNamaAtasan));
		$penilaian_kerja->setField('JABATAN_ATASAN_PENILAI', strtoupper($reqAtasanJabatan));
		$penilaian_kerja->setField('UNOR_ATASAN_PENILAI', strtoupper($reqAtasanUnor));
		$penilaian_kerja->setField('GOLONGAN_ATASAN_PENILAI', strtoupper($reqAtasanGolongan));
		$penilaian_kerja->setField('TMT_GOLONGAN_ATASAN', dateToDBCheck($reqAtasanTmtGolongan));

		$penilaian_kerja->setField('REKOMENDASI', $reqRekomendasi);
		$penilaian_kerja->setField('PEGAWAI_ID', $reqPegawaiId);
		$penilaian_kerja->setField('USER_APP_ID', $userLogin->UID);


		$reqSimpan= "";
	
		if($reqMode == "insert")
		{
			$penilaian_kerja->setField("LAST_CREATE_USER", $userLogin->idUser);
			$penilaian_kerja->setField("LAST_CREATE_DATE", "CURRENT_DATE");	
			$penilaian_kerja->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			$penilaian_kerja->setField('PENILAIAN_KERJA_PEGAWAI_ID',ValToNullDB($reqRowId));

			if($penilaian_kerja->insert())
			{
				$reqSimpan= 1;
				$reqSkpId=$penilaian_kerja->id;
			}
		}
		elseif($reqMode == "update")
		{	
			$penilaian_kerja->setField("LAST_UPDATE_USER", $userLogin->idUser);
			$penilaian_kerja->setField("LAST_UPDATE_DATE", "CURRENT_DATE");	
			$penilaian_kerja->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			$penilaian_kerja->setField('TEMP_VALIDASI_ID', $reqDataId);
			$penilaian_kerja->setField("PENILAIAN_KERJA_PEGAWAI_ID", $reqRowId);
			if($penilaian_kerja->update())
			{

				$reqSimpan= 1;
			}
		}
		

		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}
}
?>