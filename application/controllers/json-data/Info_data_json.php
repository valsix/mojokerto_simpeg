<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class info_data_json extends CI_Controller {

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

	function indentitaspegawai()
	{
		$this->load->model("base/Pegawai");

		$reqPegawaiId= $this->input->post("reqPegawaiId");

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

		$adminusernama= $this->adminuserloginnama;
		$userSatkerId= $this->adminsatkerid;		
	
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $adminusernama);
			$set->setField("LAST_CREATE_DATE", "NOW()");	
			$set->setField("LAST_CREATE_SATKER", $userSatkerId);
			if($set->insert())
			{
				$reqPegawaiId= $set->id;
				$reqSimpan = 1;
			}
		}
		elseif($reqMode == "update")
		{
			$set->setField("LAST_UPDATE_USER", $adminusernama);
			$set->setField("LAST_UPDATE_DATE", "NOW()");	
			$set->setField("LAST_UPDATE_SATKER", $userSatkerId);
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

	function jsonpangkatriwayat()
	{
		$this->load->model("base-data/InfoData");

		$set= new InfoData();

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

		$userpegawaimode= $this->userpegawaimode;
		$adminuserid= $this->adminuserid;

		if(!empty($userpegawaimode) && !empty($adminuserid))
		    $reqPegawaiId= $userpegawaimode;
		else
		    $reqPegawaiId= $this->pegawaiId;

		$statement= " AND A.PEGAWAI_ID = ".$reqPegawaiId;
		// $sOrder = "";
		$set->selectbyparamspangkat(array(), $displaylength, $displaystart, $statement);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$reqRowId= $set->getField("RIWAYAT_PANGKAT_ID");
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
				{
					$row[$valkey]= "1";
				}
				else if ($valkey == "PANGKAT_INFO")
				{
					$row[$valkey]= $set->getField('PANGKAT_KODE')." (".$set->getField('PANGKAT_NAMA').")";
				}
				else if ($valkey == "TMT_PANGKAT")
				{
					$row[$valkey]= getFormattedDateTime($set->getField($valkey), false);
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

	function riwayatpangkatadd()
	{
		$this->load->model("base-data/RiwayatPangkat");

		$reqMode= $this->input->post("reqMode");
		$reqGolRuang= $this->input->post("reqGolRuang");
		$reqTMTGol= $this->input->post("reqTMTGol");
		$reqTh= $this->input->post("reqTh");
		$reqBl= $this->input->post("reqBl");
		$reqRowId= $this->input->post("reqRowId");
		
		// ambil pegawai id
		$reqPegawaiId= $this->getpegawaiid();

		$set= new RiwayatPangkat();
		$set->setField('RIWAYAT_PANGKAT_ID', $reqRowId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('PANGKAT_ID', $reqGolRuang);
		$set->setField('TMT_PANGKAT', dateToDBCheck($reqTMTGol));
		$set->setField('MK_TAHUN', ValToNullDB($reqTh));
		$set->setField('MK_BULAN', ValToNullDB($reqBl));

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
			if($set->update())
			{
				$reqSimpan = 1;
			}
		}

		$reqSimpan="1";
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function jsonpegawaijabatan()
	{
		$this->load->model("base-data/InfoData");

		$set= new InfoData();

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

		$userpegawaimode= $this->userpegawaimode;
		$adminuserid= $this->adminuserid;

		if(!empty($userpegawaimode) && !empty($adminuserid))
		    $reqPegawaiId= $userpegawaimode;
		else
		    $reqPegawaiId= $this->pegawaiId;

		$statement= " AND A.PEGAWAI_ID = ".$reqPegawaiId;
		// $sOrder = "";
		$set->selectbyparamsjabatandata(array(), $displaylength, $displaystart, $statement);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$reqRowId= $set->getField("RIWAYAT_JABATAN_ID");
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
				{
					$row[$valkey]= "1";
				}
				else if ($valkey == "TMT_JABATAN")
				{
					$row[$valkey]= getFormattedDateTime($set->getField($valkey), false);
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

	function jabatanriwayatadd()
	{
		$this->load->model("base-data/InfoData");

		$reqMode= $this->input->post("reqMode");
		$reqRowId= $this->input->post("reqRowId");
		$reqNamaJabatan= $this->input->post("reqNamaJabatan");
		$reqEselon= $this->input->post("reqEselon");
		$reqTh= $this->input->post("reqTh");
		$reqBl= $this->input->post("reqBl");
		$reqTMTJabatan= $this->input->post("reqTMTJabatan");
		
		// ambil pegawai id
		$reqPegawaiId= $this->getpegawaiid();

		$set= new InfoData();
		$set->setField('RIWAYAT_JABATAN_ID', $reqRowId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('ESELON_ID', $reqEselon);	
		$set->setField('JABATAN', setQuote($reqNamaJabatan));
		$set->setField('MASA_JAB_TAHUN', ValToNullDB($reqTh));
		$set->setField('MASA_JAB_BULAN', ValToNullDB($reqBl));
		$set->setField('TMT_JABATAN', dateToDBCheck($reqTMTJabatan));

		$reqSimpan="";
	
		if($reqRowId == "")
		{
			if($set->jabatanriwayatinsert())
			{
				$reqPegawaiId= $set->pegawai_id;
				$reqSimpan = 1;
			}
		}
		else
		{
			if($set->jabatanriwayatupdate())
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

	function jsonpendidikanriwayat()
	{

		ini_set('memory_limit', -1);
		ini_set('max_execution_time', -1);
		
		$this->load->model("base-data/InfoData");
		$set= new InfoData();

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

		$userpegawaimode= $this->userpegawaimode;
		$adminuserid= $this->adminuserid;

		if(!empty($userpegawaimode) && !empty($adminuserid))
		    $reqPegawaiId= $userpegawaimode;
		else
		    $reqPegawaiId= $this->pegawaiId;
		
		$statement= " AND A.PEGAWAI_ID = ".$reqPegawaiId;
		// $sOrder = "";
		$set->selectbyparamspendidikandata(array(), $displaylength, $displaystart, $statement);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$reqRowId= $set->getField("RIWAYAT_PENDIDIKAN_ID");
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
				{
					$row[$valkey]= "1";
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

	function pendidikanriwayatadd()
	{
		$this->load->model("base-data/InfoData");

		$reqMode= $this->input->post("reqMode");
		$reqRowId= $this->input->post("reqRowId");
		$reqPendidikanId= $this->input->post("reqPendidikanId");
		$reqKampusId= $this->input->post("reqKampusId");
		$reqJurusan= $this->input->post("reqJurusan");
		$reqJurusanNama= $this->input->post("reqJurusanNama");
		$reqTanggal= $this->input->post("reqTanggal");
		
		// ambil pegawai id
		$reqPegawaiId= $this->getpegawaiid();

		$set= new InfoData();
		$set->setField('RIWAYAT_PENDIDIKAN_ID', $reqRowId);
		$set->setField('PENDIDIKAN_ID', ValToNullDB($reqPendidikanId));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		// $set->setField('KODE_JURUSAN', ValToNullDB($reqJurusan));
		$set->setField('JURUSAN', $reqJurusanNama);
		$set->setField('KAMPUS_ID', ValToNullDB($reqKampusId));
		$set->setField('TANGGAL', dateToDBCheck($reqTanggal));

		$reqSimpan="";
	
		if($reqRowId == "")
		{
			if($set->pendidikanriwayatinsert())
			{
				$reqPegawaiId= $set->pegawai_id;
				$reqSimpan = 1;
			}
		}
		else
		{
			if($set->pendidikanriwayatupdate())
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

	function jsondiklatstruktural()
	{
		$this->load->model("base-data/InfoData");

		$set= new InfoData();

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

		$userpegawaimode= $this->userpegawaimode;
		$adminuserid= $this->adminuserid;

		if(!empty($userpegawaimode) && !empty($adminuserid))
		    $reqPegawaiId= $userpegawaimode;
		else
		    $reqPegawaiId= $this->pegawaiId;
		
		$statement= " AND A.PEGAWAI_ID = ".$reqPegawaiId;
		// $sOrder = "";
		$set->selectbyparamsdiklatstrukturaldata(array(), $displaylength, $displaystart, $statement);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$reqRowId= $set->getField("RIWAYAT_PENDIDIKAN_ID");
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
				{
					$row[$valkey]= "1";
				}
				else if ($valkey == "TANGGAL_INFO")
				{
					$row[$valkey]= dateToPageCheck($set->getField("TANGGAL_MULAI"))." s/d ".dateToPageCheck($set->getField("TANGGAL_AKHIR"));
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

	function diklatstrukturaladd()
	{
		$this->load->model("base-data/InfoData");

		$reqMode= $this->input->post("reqMode");
		$reqRowId= $this->input->post("reqRowId");
		$reqNama= $this->input->post("reqNama");
		$reqTanggalMulai= $this->input->post("reqTanggalMulai");
		$reqTanggalAkhir= $this->input->post("reqTanggalAkhir");
		$reqPenyelenggara= $this->input->post("reqPenyelenggara");
		
		// ambil pegawai id
		$reqPegawaiId= $this->getpegawaiid();

		$set= new InfoData();
		$set->setField('RIWAYAT_DIKLAT_STRUKTURAL_ID', $reqRowId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('NAMA', $reqNama);
		$set->setField('PENYELENGGARA', $reqPenyelenggara);
		$set->setField('TANGGAL_MULAI', dateToDBCheck($reqTanggalMulai));
		$set->setField('TANGGAL_AKHIR', dateToDBCheck($reqTanggalAkhir));

		$reqSimpan="";
	
		if($reqRowId == "")
		{
			if($set->diklatstrukturalriwayatinsert())
			{
				$reqPegawaiId= $set->pegawai_id;
				$reqSimpan = 1;
			}
		}
		else
		{
			if($set->diklatstrukturalriwayatupdate())
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

	function jsondiklatfungsional()
	{
		$this->load->model("base-data/InfoData");

		$set= new InfoData();

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

		$userpegawaimode= $this->userpegawaimode;
		$adminuserid= $this->adminuserid;

		if(!empty($userpegawaimode) && !empty($adminuserid))
		    $reqPegawaiId= $userpegawaimode;
		else
		    $reqPegawaiId= $this->pegawaiId;
		
		$statement= " AND A.PEGAWAI_ID = ".$reqPegawaiId;
		// $sOrder = "";
		$set->selectbyparamsdiklatfungsionaldata(array(), $displaylength, $displaystart, $statement);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$reqRowId= $set->getField("RIWAYAT_PENDIDIKAN_ID");
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
				{
					$row[$valkey]= "1";
				}
				else if ($valkey == "TANGGAL_INFO")
				{
					$row[$valkey]= dateToPageCheck($set->getField("TANGGAL_MULAI"))." s/d ".dateToPageCheck($set->getField("TANGGAL_AKHIR"));
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

	function diklatfungsionaladd()
	{
		$this->load->model("base-data/InfoData");

		$reqMode= $this->input->post("reqMode");
		$reqRowId= $this->input->post("reqRowId");
		$reqNama= $this->input->post("reqNama");
		$reqTanggalMulai= $this->input->post("reqTanggalMulai");
		$reqTanggalAkhir= $this->input->post("reqTanggalAkhir");
		$reqPenyelenggara= $this->input->post("reqPenyelenggara");
		
		// ambil pegawai id
		$reqPegawaiId= $this->getpegawaiid();

		$set= new InfoData();
		$set->setField('RIWAYAT_DIKLAT_FUNGSIONAL_ID', $reqRowId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('NAMA', $reqNama);
		$set->setField('PENYELENGGARA', $reqPenyelenggara);
		$set->setField('TANGGAL_MULAI', dateToDBCheck($reqTanggalMulai));
		$set->setField('TANGGAL_AKHIR', dateToDBCheck($reqTanggalAkhir));

		$reqSimpan="";
	
		if($reqRowId == "")
		{
			if($set->diklatfungsionalriwayatinsert())
			{
				$reqPegawaiId= $set->pegawai_id;
				$reqSimpan = 1;
			}
		}
		else
		{
			if($set->diklatfungsionalriwayatupdate())
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

	function jsondiklatteknis()
	{
		$this->load->model("base-data/InfoData");

		$set= new InfoData();

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

		$userpegawaimode= $this->userpegawaimode;
		$adminuserid= $this->adminuserid;

		if(!empty($userpegawaimode) && !empty($adminuserid))
		    $reqPegawaiId= $userpegawaimode;
		else
		    $reqPegawaiId= $this->pegawaiId;
		
		$statement= " AND A.PEGAWAI_ID = ".$reqPegawaiId;
		// $sOrder = "";
		$set->selectbyparamsdiklatteknisdata(array(), $displaylength, $displaystart, $statement);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$reqRowId= $set->getField("RIWAYAT_PENDIDIKAN_ID");
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
				{
					$row[$valkey]= "1";
				}
				else if ($valkey == "TANGGAL_INFO")
				{
					$row[$valkey]= dateToPageCheck($set->getField("TANGGAL_MULAI"))." s/d ".dateToPageCheck($set->getField("TANGGAL_AKHIR"));
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

	function diklatteknisadd()
	{
		$this->load->model("base-data/InfoData");

		$reqMode= $this->input->post("reqMode");
		$reqRowId= $this->input->post("reqRowId");
		$reqNama= $this->input->post("reqNama");
		$reqTanggalMulai= $this->input->post("reqTanggalMulai");
		$reqTanggalAkhir= $this->input->post("reqTanggalAkhir");
		$reqPenyelenggara= $this->input->post("reqPenyelenggara");
		
		// ambil pegawai id
		$reqPegawaiId= $this->getpegawaiid();

		$set= new InfoData();
		$set->setField('RIWAYAT_DIKLAT_TEKNIS_ID', $reqRowId);
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$set->setField('NAMA', $reqNama);
		$set->setField('PENYELENGGARA', $reqPenyelenggara);
		$set->setField('TANGGAL_MULAI', dateToDBCheck($reqTanggalMulai));
		$set->setField('TANGGAL_AKHIR', dateToDBCheck($reqTanggalAkhir));

		$reqSimpan="";
	
		if($reqRowId == "")
		{
			if($set->diklatteknisriwayatinsert())
			{
				$reqPegawaiId= $set->pegawai_id;
				$reqSimpan = 1;
			}
		}
		else
		{
			if($set->diklatteknisriwayatupdate())
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

	function totaldiklatteknisadd()
	{
		$this->load->model("base-data/InfoData");
		$reqMode= $this->input->post("reqMode");
		$reqRowId= $this->input->post("reqRowId");
		$reqTotal= $this->input->post("reqTotal");

		// ambil pegawai id
		$reqPegawaiId= $this->getpegawaiid();
		
		$set= new InfoData();
		$set->setField('RIWAYAT_DIKLAT_TEKNIS_ID', $reqRowId);
		$set->setField('JUMLAH', ValToNullDB($reqTotal));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
	
		if($reqRowId == "")
		{
			if($set->totaldiklatteknisriwayatinsert())
			{
				$reqPegawaiId= $set->pegawai_id;
				$reqSimpan = 1;
			}
		}
		else
		{
			if($set->totaldiklatteknisriwayatupdate())
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

	function totaldiklatstrukturaladd()
	{
		$this->load->model("base-data/InfoData");
		$reqMode= $this->input->post("reqMode");
		$reqRowId= $this->input->post("reqRowId");
		$reqPim1= $this->input->post("reqPim1");
		$reqPim2= $this->input->post("reqPim2");
		$reqPim3= $this->input->post("reqPim3");
		$reqPim4= $this->input->post("reqPim4");

		// ambil pegawai id
		$reqPegawaiId= $this->getpegawaiid();
		
		$set= new InfoData();
		$set->setField('RIWAYAT_DIKLAT_STRUKTURAL_ID', $reqRowId);
		$set->setField('PIM1', ValToNullDB($reqPim1));
		$set->setField('PIM2', ValToNullDB($reqPim2));
		$set->setField('PIM3', ValToNullDB($reqPim3));
		$set->setField('PIM4', ValToNullDB($reqPim4));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
	
		if($reqRowId == "")
		{
			if($set->totaldiklatstrukturalriwayatinsert())
			{
				$reqPegawaiId= $set->pegawai_id;
				$reqSimpan = 1;
			}
		}
		else
		{
			if($set->totaldiklatstrukturalriwayatupdate())
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

	function totaldiklatfungsionaladd()
	{
		$this->load->model("base-data/InfoData");
		$reqMode= $this->input->post("reqMode");
		$reqRowId= $this->input->post("reqRowId");
		$reqKeterampilan= $this->input->post("reqKeterampilan");
		$reqAhliPertama= $this->input->post("reqAhliPertama");
		$reqAhliMuda= $this->input->post("reqAhliMuda");
		$reqAhliMadya= $this->input->post("reqAhliMadya");
		$reqAhliUtama= $this->input->post("reqAhliUtama");
		$reqJenjangId= $this->input->post("reqJenjangId");
		
		if($reqJenjangId == "0")
			$reqJenjangId= "0";
		else if($reqJenjangId == "xxx")
			$reqJenjangId= "";
		// echo $reqJenjangId;exit;

		// ambil pegawai id
		$reqPegawaiId= $this->getpegawaiid();
		
		$set= new InfoData();
		$set->setField('RIWAYAT_DIKLAT_FUNGSIONAL_ID', $reqRowId);
		$set->setField('JENJANG_KETERAMPILAN', ValToNullDB($reqKeterampilan));
		$set->setField('JENJANG_AHLIPERTAMA', ValToNullDB($reqAhliPertama));
		$set->setField('JENJANG_AHLIMUDA', ValToNullDB($reqAhliMuda));
		$set->setField('JENJANG_AHLIMADYA', ValToNullDB($reqAhliMadya));
		$set->setField('JENJANG_AHLIUTAMA', ValToNullDB($reqAhliUtama));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
	
		if($reqRowId == "")
		{
			if($set->totaldiklatfungsionalriwayatinsert())
			{
				$reqPegawaiId= $set->pegawai_id;
				$reqSimpan = 1;
			}
		}
		else
		{
			if($set->totaldiklatfungsionalriwayatupdate())
			{
				$reqSimpan = 1;
			}
		}

		if($reqSimpan == 1 )
		{
			$set= new InfoData();
			$set->setField('PEGAWAI_ID', $reqPegawaiId);
			$set->setField('LAST_JENJANG_ID', ValToNullDB($reqJenjangId));
			$set->totaldiklatfungsionalriwayatlast();

			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}					
	}

	function jsonjabatanriwayatdelete()
	{
		$this->load->model("base-data/infodata");

		$reqId= $this->input->get("reqDetilId");

		$set= new infodata();
		$set->setField("RIWAYAT_JABATAN_ID", $reqId);
		$set->jabatanriwayatdelete();

		echo json_response(200, $reqId.'-Data berhasil disimpan');
	}

	function jsonpendidikanriwayatdelete()
	{
		$this->load->model("base-data/infodata");

		$reqId= $this->input->get("reqDetilId");

		$set= new infodata();
		$set->setField("RIWAYAT_PENDIDIKAN_ID", $reqId);
		$set->pendidikanriwayatdelete();

		echo json_response(200, $reqId.'-Data berhasil disimpan');
	}

	function jsondiklatstrukturaldelete()
	{
		$this->load->model("base-data/infodata");

		$reqId= $this->input->get("reqDetilId");

		$set= new infodata();
		$set->setField("RIWAYAT_DIKLAT_STRUKTURAL_ID", $reqId);
		$set->strukturalriwayatdelete();

		echo json_response(200, $reqId.'-Data berhasil disimpan');
	}

	function jsondiklatfungsionaldelete()
	{
		$this->load->model("base-data/infodata");

		$reqId= $this->input->get("reqDetilId");

		$set= new infodata();
		$set->setField("RIWAYAT_DIKLAT_FUNGSIONAL_ID", $reqId);
		$set->fungsionalriwayatdelete();

		echo json_response(200, $reqId.'-Data berhasil disimpan');
	}

	function jsondiklatteknisdelete()
	{
		$this->load->model("base-data/infodata");

		$reqId= $this->input->get("reqDetilId");

		$set= new infodata();
		$set->setField("RIWAYAT_DIKLAT_TEKNIS_ID", $reqId);
		$set->teknisriwayatdelete();

		echo json_response(200, $reqId.'-Data berhasil disimpan');
	}

	function totalpltplhadd()
	{
		$this->load->model("base-data/InfoData");
		$reqTipe= $this->input->post("reqTipe");
		$reqJumlah= $this->input->post("reqJumlah");
		$reqId= $this->input->post("reqId");

		// ambil pegawai id
		$reqPegawaiId= $this->getpegawaiid();

		for ($i=0;$i<count($reqId);$i++){

			$set= new InfoData();
			$set->setField('TOTAL_PLT_PLH_ID', $reqId[$i]);
			$set->setField('TIPE', ValToNullDB($reqTipe[$i]));
			$set->setField('JUMLAH', ValToNullDB($reqJumlah[$i]));
			$set->setField('PEGAWAI_ID', $reqPegawaiId);

			if($reqId[$i]==''){
				$set->totalpltplhinsert();
			}
			else{
				$set->totalpltplhupdate();
			}
			
		}

		// echo json_response(400, 'Data gagal disimpan');
		echo json_response(200, 'Data berhasil disimpan');

	
	}

	function totalpltplhdel()
	{
		$this->load->model("base-data/infodata");

		$reqId= $this->input->get("reqId");

		$set= new infodata();
		$set->setField("TOTAL_PLT_PLH_ID", $reqId);
		$set->pltplhdelete();

		echo json_response(200, $reqId.'-Data berhasil disimpan');
	}

	function totalkedudukantimadd()
	{
		$this->load->model("base-data/InfoData");
		$reqMode= $this->input->post("reqMode");
		$reqRowId= $this->input->post("reqRowId");
		$reqKetua= $this->input->post("reqKetua");
		$reqAnggota= $this->input->post("reqAnggota");

		// ambil pegawai id
		$reqPegawaiId= $this->getpegawaiid();
		
		$set= new InfoData();
		$set->setField('TOTAL_KEDUDUKAN_TIM_ID', $reqRowId);
		$set->setField('KETUA', ValToNullDB($reqKetua));
		$set->setField('ANGGOTA', ValToNullDB($reqAnggota));
		$set->setField('PEGAWAI_ID', $reqPegawaiId);
		$reqSimpan="";
	
		if($reqRowId == "")
		{
			if($set->totalkedudukantiminsert())
			{
				$reqPegawaiId= $set->pegawai_id;
				$reqSimpan = 1;
			}
		}
		else
		{
			if($set->totalkedudukantimupdate())
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

	function getpegawaiid()
	{
		$userpegawaimode= $this->userpegawaimode;
		$adminuserid= $this->adminuserid;
		if(!empty($userpegawaimode) && !empty($adminuserid))
		    $reqPegawaiId= $userpegawaimode;
		else
		    $reqPegawaiId= $this->pegawaiId;

		return $reqPegawaiId;
	}

	function skCpnsAdd()
	{
		$this->load->model("base/SkCpns");

		$reqSkCpnsId= $this->input->post("reqSkCpnsId");
		$reqId= $this->input->post("reqId");
		$reqNoNotaBAKN= $this->input->post("reqNoNotaBAKN");
		$reqTanggalNotaBAKN= $this->input->post("reqTanggalNotaBAKN");
		$reqNamaPejabatPenetap= $this->input->post("reqNamaPejabatPenetap");
		$reqNIPPejabatPenetap= $this->input->post("reqNIPPejabatPenetap");
		$reqNoSuratKeputusan= $this->input->post("reqNoSuratKeputusan");
		$reqTanggalSuratKeputusan= $this->input->post("reqTanggalSuratKeputusan");
		$reqTerhitungMulaiTanggal= $this->input->post("reqTerhitungMulaiTanggal");
		$reqGolRuang= $this->input->post("reqGolRuang");
		$reqTanggalTugas= $this->input->post("reqTanggalTugas");
		$reqTh= $this->input->post("reqTh");
		$reqBl= $this->input->post("reqBl");

		$set= new SkCpns();
		$set->setField('PEGAWAI_ID', $reqId);
		$set->setField('NO_NOTA', $reqNoNotaBAKN);
		$set->setField('TANGGAL_NOTA', dateToDBCheck($reqTanggalNotaBAKN));
		$set->setField('NAMA_PENETAP', $reqNamaPejabatPenetap);
		$set->setField('NIP_PENETAP', $reqNIPPejabatPenetap);
		$set->setField('NO_SK', $reqNoSuratKeputusan);
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTanggalSuratKeputusan));
		$set->setField('TMT_CPNS', dateToDBCheck($reqTerhitungMulaiTanggal));
		$set->setField('PANGKAT_ID', $reqGolRuang);
		$set->setField('TANGGAL_TUGAS', dateToDBCheck($reqTanggalTugas));
		$set->setField('MASA_KERJA_TAHUN', $reqTh);
		$set->setField('MASA_KERJA_BULAN', $reqBl);
		$set->setField('SK_CPNS_ID', $reqSkCpnsId);

		$adminusernama= $this->adminuserloginnama;
		$userSatkerId= $this->adminsatkerid;

		if($reqSkCpnsId == "")
		{

			$set->setField("LAST_CREATE_USER", $adminusernama);
			$set->setField("LAST_CREATE_DATE", "NOW()");	
			$set->setField("LAST_CREATE_SATKER", $userSatkerId);

			if($set->insert())
			{
				$reqPegawaiId= $set->pegawai_id;
				$reqSimpan = 1;
			}
		}
		else
		{
			$set->setField("LAST_UPDATE_USER", $adminusernama);
			$set->setField("LAST_UPDATE_DATE", "NOW()");	
			$set->setField("LAST_UPDATE_SATKER", $userSatkerId);

			if($set->update())
			{
				$reqSimpan = 1;
			}
		}

		$reqSimpan="1";
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function SkPnsAdd()
	{
		$this->load->model("base/SkPns");

		$reqPejabatPenetapan= $this->input->post('reqPejabatPenetapan');
		$reqNamaPejabatPenetap= $this->input->post('reqNamaPejabatPenetap');
		$reqNIPPejabatPenetap= $this->input->post('reqNIPPejabatPenetap');
		$reqNoSuratKeputusan= $this->input->post('reqNoSuratKeputusan');
		$reqTanggalSuratKeputusan= $this->input->post('reqTanggalSuratKeputusan');
		$reqTerhitungMulaiTanggal= $this->input->post('reqTerhitungMulaiTanggal');
		$reqNoDiklatPrajabatan= $this->input->post('reqNoDiklatPrajabatan');
		$reqTanggalDiklatPrajabatan= $this->input->post('reqTanggalDiklatPrajabatan');
		$reqNoSuratUjiKesehatan= $this->input->post('reqNoSuratUjiKesehatan');
		$reqTanggalSuratUjiKesehatan= $this->input->post('reqTanggalSuratUjiKesehatan');
		$reqGolRuang= $this->input->post('reqGolRuang');
		$reqPengambilanSumpah= $this->input->post('reqPengambilanSumpah');
		$reqSkPnsId= $this->input->post('reqSkPnsId');
		$reqTanggalSumpah= $this->input->post('reqTanggalSumpah');
		$reqNoSuratjiKesehatan= $this->input->post('reqNoSuratjiKesehatan');
		$reqNoDiklatPrajabatan= $this->input->post('reqNoDiklatPrajabatan');
		$reqTh= $this->input->post('reqTh');
		$reqBl= $this->input->post('reqBl');
		$reqNoBeritaAcara= $this->input->post('reqNoBeritaAcara');
		$reqTanggalBeritaAcara= $this->input->post('reqTanggalBeritaAcara');
		$reqKeteranganLPJ= $this->input->post('reqKeteranganLPJ');
		$reqId= $this->input->post('reqId');


		$set= new SkPns();
		$set->setField('PEGAWAI_ID', $reqId);
		$set->setField('PEJABAT_PENETAP_ID', $reqPejabatPenetapan);
		$set->setField('NAMA_PENETAP', $reqNamaPejabatPenetap);
		$set->setField('NIP_PENETAP', $reqNIPPejabatPenetap);
		$set->setField('NO_SK', $reqNoSuratKeputusan);
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTanggalSuratKeputusan));
		$set->setField('TMT_PNS', dateToDBCheck($reqTerhitungMulaiTanggal));
		$set->setField('NOMOR_BERITA_ACARA', $reqNoBeritaAcara);
		$set->setField('TANGGAL_BERITA_ACARA', dateToDBCheck($reqTanggalBeritaAcara));
		$set->setField('NO_PRAJAB', $reqNoDiklatPrajabatan);
		$set->setField('TANGGAL_PRAJAB', dateToDBCheck($reqTanggalDiklatPrajabatan));
		$set->setField('NO_UJI_KESEHATAN', $reqNoSuratUjiKesehatan);
		$set->setField('TANGGAL_UJI_KESEHATAN', dateToDBCheck($reqTanggalSuratUjiKesehatan));
		$set->setField('PANGKAT_ID', $reqGolRuang);
		$set->setField('SUMPAH', $reqPengambilanSumpah);
		$set->setField('TANGGAL_SUMPAH', dateToDBCheck($reqTanggalSumpah));
		$set->setField('MASA_KERJA_TAHUN', $reqTh);
		$set->setField('MASA_KERJA_BULAN', $reqBl);
		$set->setField('KETERANGAN_LPJ', $reqKeteranganLPJ);
		$set->setField('SK_PNS_ID', $reqSkPnsId);

		$adminusernama= $this->adminuserloginnama;
		$userSatkerId= $this->adminsatkerid;	
		
		if($reqSkPnsId == "")
		{

			$set->setField("LAST_CREATE_USER", $adminusernama);
			$set->setField("LAST_CREATE_DATE", "NOW()");	
			$set->setField("LAST_CREATE_SATKER", $userSatkerId);
	
			if($set->insert())
			{
				$reqPegawaiId= $set->pegawai_id;
				$reqSimpan = 1;
			}
		}
		else
		{	
			$set->setField("LAST_UPDATE_USER", $adminusernama);
			$set->setField("LAST_UPDATE_DATE", "NOW()");	
			$set->setField("LAST_UPDATE_SATKER", $userSatkerId);

			if($set->update())
			{
				$reqSimpan = 1;
			}
		}

		$reqSimpan="1";
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