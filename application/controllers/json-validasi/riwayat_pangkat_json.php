<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class riwayat_pangkat_json extends CI_Controller {

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

	function json()
	{
		ini_set('memory_limit', '-1');
		$this->load->model("base-validasi/RiwayatPangkat");

		$set= new RiwayatPangkat();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}

		$reqId= $this->input->get("reqId");
		$cekquery= $this->input->get("c");
		// print_r($columnsDefault);exit;

		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$userpegawaimode= $this->userpegawaimode;
		$adminuserid= $this->adminuserid;

		$statement= " AND A.PEGAWAI_ID = ".$reqId;
		$set->selectByPersonal(array(), $dsplyRange, $dsplyStart, $reqId, "", "", $statement);
		
		if(!empty($cekquery)){
			echo $set->query;exit;
		}
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
				{
					$row[$valkey]= "1";
				}
				else if ($valkey == "MASA_KERJA")
				{
					$row[$valkey]= $set->getField('MASA_KERJA_TAHUN').'-'.$set->getField('MASA_KERJA_BULAN');
				}
				else if ($valkey == "PANGKAT_ID")
				{
					$row[$valkey]= $set->getField("NMPANGKAT");
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

	function add()
	{
		$this->load->library('globalfilepegawai');
		$reqLinkFile= $_FILES['reqLinkFile'];

		$this->load->model("base/PejabatPenetap");

		// start tambahan untuk validasi
		$this->load->model("base-validasi/RiwayatPangkat");
		$reqId= $this->input->post("reqId");
		$reqRowId= $this->input->post("reqRowId");
		$reqTempValidasiHapusId= $this->input->post("reqTempValidasiHapusId");
		$reqTable= $this->input->post("reqTable");
		$reqTempValidasiId= $this->input->post("reqTempValidasiId");
		$reqStatusValidasi= $this->input->post("reqStatusValidasi");
		$reqFileRowId= $this->input->post("reqFileRowId");
		$cekquery= $this->input->post("cekquery");

		if(empty($reqTempValidasiId) && !empty($reqTempValidasiHapusId))
		{
			$this->load->model("base-validasi/DataHapus");
			$setdetil= new DataHapus();
			$setdetil->setField('TEMP_VALIDASI_ID', $reqTempValidasiHapusId);
			$setdetil->setField('HAPUS_NAMA', $reqTable);
			$setdetil->setField('VALIDASI', $reqStatusValidasi);

			$reqsimpan= "";
			if($reqStatusValidasi == "2")
			{
				if($setdetil->deletehapusdata())
				{
					$reqsimpan= "1";
				}
			}
			else if($reqStatusValidasi == "1")
			{
				if($setdetil->updatevalidasihapusdata())
				{
					$reqsimpan= "1";
				}
			}

			if($reqsimpan == "1")
			{
				echo json_response(200, $reqRowId."-Data berhasil disimpan.");
			}
			else
			{
				echo json_response(400, "Data gagal disimpan");
			}
			exit;
		}
		// end tambahan untuk validasi

		$reqGolRuang= $this->input->post("reqGolRuang");
		$reqPjPenetap= $this->input->post("reqPjPenetap");
		$reqSTLUD= $this->input->post("reqSTLUD");
		$reqNoSTLUD= $this->input->post("reqNoSTLUD");
		$reqNoNota= $this->input->post("reqNoNota");
		$reqNoSK= $this->input->post("reqNoSK");
		$reqTh= $this->input->post("reqTh");
		$reqBl= $this->input->post("reqBl");
		$reqKredit= $this->input->post("reqKredit");
		$reqJenisKP= $this->input->post("reqJenisKP");
		$reqKeterangan= $this->input->post("reqKeterangan");
		$reqTglSTLUD= $this->input->post("reqTglSTLUD");
		$reqTglNota= $this->input->post("reqTglNota");
		$reqTglSK= $this->input->post("reqTglSK");
		$reqTMTGol= $this->input->post("reqTMTGol");
		$reqGajiPokok= $this->input->post("reqGajiPokok");

		if($reqStatusPejabatPenetap=='baru'){
			$stat= " AND UPPER(JABATAN)='".strtoupper($reqPjPenetap_Baru)."'";
			$cek_set=new PejabatPenetap();
			$cek_set->selectByParams(array(),-1,-1,$stat);
			$cek_set->firstRow();

			if($cek_set->getField("JABATAN") == ''){
				$setdetil=new PejabatPenetap();
				$setdetil->setField('JABATAN', strtoupper($reqPjPenetap_Baru));	
				$setdetil->setField("LAST_CREATE_USER", $adminusernama);
				$setdetil->setField("LAST_CREATE_DATE", "NOW()");	
				$setdetil->setField("LAST_CREATE_SATKER", $userSatkerId);

				$setdetil->insert();
				$reqPjPenetap=$reqPjPenetap_Baru;
				$reqTemp=$setdetil->id;
			}else{
				$reqPjPenetap=$reqPjPenetap_Baru;
				$reqTemp=$cek_set->getField("PEJABAT_PENETAP_ID");
			}
			unset($setdetil);unset($cek_set);
		}else{
			$reqTemp=$reqPjPenetap;
			if(!empty($reqTemp))
			{
				$setdetil=new PejabatPenetap();
				$setdetil->selectByParams(array("PEJABAT_PENETAP_ID"=>$reqPjPenetap));
				$setdetil->firstRow();
				$reqPjPenetap=strtoupper($setdetil->getField('JABATAN'));
				unset($setdetil);
			}
		}

		$set = new RiwayatPangkat();
		$set->setField('PANGKAT_ID', ValToNullDB($reqGolRuang));
		$set->setField("PEJABAT_PENETAP_ID", ValToNullDB($reqTemp));
		$set->setField("PEJABAT_PENETAP", strtoupper($reqPjPenetap));
		$set->setField('STLUD', $reqSTLUD);
		$set->setField('NO_STLUD', $reqNoSTLUD);
		$set->setField('NO_NOTA', $reqNoNota);
		$set->setField('NO_SK', $reqNoSK);
		$set->setField('PEGAWAI_ID', $reqId);
		$set->setField('MASA_KERJA_TAHUN', ValToNullDB($reqTh));
		$set->setField('MASA_KERJA_BULAN', ValToNullDB($reqBl));
		$set->setField('KREDIT', ValToNullDB(CommaToDot($reqKredit)));
		$set->setField('JENIS_KP', ValToNullDB($reqJenisKP));
		$set->setField('KETERANGAN', $reqKeterangan);
		$set->setField('GAJI_POKOK', ValToNullDB(dotToNo($reqGajiPokok)));
		$set->setField('TANGGAL_STLUD', dateToDBCheck($reqTglSTLUD));
		$set->setField('TANGGAL_NOTA', dateToDBCheck($reqTglNota));
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTglSK));
		$set->setField('TMT_PANGKAT', dateToDBCheck($reqTMTGol));

		$adminusernama= $this->adminuserloginnama;
		$userSatkerId= $this->adminsatkerid;

		// start tambahan untuk validasi
		$set->setField('PANGKAT_RIWAYAT_ID', idValidasiDb($reqRowId));
		$set->setField('TANGGAL_VALIDASI', tglvalidasiDb($reqStatusValidasi));

		$set->setField('VALIDASI', ValToNullDB($reqStatusValidasi));
		$set->setField('TEMP_VALIDASI_ID', $reqTempValidasiId);
		$set->setField("LAST_CREATE_USER", $adminusernama);
		$set->setField("LAST_CREATE_DATE", "NOW()");	
		$set->setField("LAST_CREATE_SATKER", $userSatkerId);
		$set->setField("LAST_UPDATE_USER", $adminusernama);
		$set->setField("LAST_UPDATE_DATE", "NOW()");	
		$set->setField("LAST_UPDATE_SATKER", $userSatkerId);

		$reqSimpan= "";
		if(empty($reqTempValidasiId))
		{
			if($set->insert())
			{
				$reqRowId= $set->id;
				$reqSimpan= 1;
			}
		}
		else
		{
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}

		if($cekquery == "1")
		{
			echo $set->query;exit;
		}
		// end tambahan untuk validasi

		if($reqSimpan == 1)
		{
			// start tambahan untuk validasi
			if($reqStatusValidasi == "1")
			{
				$set->updatetanggalvalidasi();
			}
			// end tambahan untuk validasi

			// untuk simpan file
			/*$vpost= $this->input->post();
			$vsimpanfilepegawai= new globalfilepegawai();
			$vsimpanfilepegawai->simpanfilepegawai($vpost, $reqRowId, $reqLinkFile);*/

			echo json_response(200, $reqRowId."-Data berhasil disimpan.");
		}
		else
		{
			echo json_response(400, "Data gagal disimpan");
		}
	}

	function delete()
	{
		$this->load->model("base-validasi/RiwayatPangkat");
		$set = new RiwayatPangkat();
		
		$reqRowId= $this->input->get('reqRowId');

		$set->setField("PANGKAT_RIWAYAT_ID", $reqRowId);
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
}
?>