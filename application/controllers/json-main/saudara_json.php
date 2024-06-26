<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class saudara_json extends CI_Controller {

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
		$this->load->model("base/Saudara");

		$set= new Saudara();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		$reqId = $this->input->get("reqId");
		$cekquery= $this->input->get("c");
		// print_r($columnsDefault);exit;

		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$userpegawaimode= $this->userpegawaimode;
		$adminuserid= $this->adminuserid;

		// $sOrder = "";
		// $set->selectByParams(array(), $dsplyRange, $dsplyStart, $statement." AND (UPPER(B.GOL_RUANG) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(TEMPAT_LAHIR) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(NAMA) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(A.NAMA) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(A.NIP_LAMA) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(A.NIP_BARU) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(AMBIL_FORMAT_NIP_BARU(NIP_BARU)) LIKE '%".strtoupper($_GET['sSearch'])."%' ) ", $sOrder);
		$statement= " AND A.PEGAWAI_ID = '".$reqId."'" ;
		$set->selectByParams(array(), $dsplyRange, $dsplyStart, $statement, $sOrder);
		
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
		$this->load->model("base/Saudara");

		$reqId= $this->input->post("reqId");
		$reqRowId= $this->input->post("reqRowId");
		$reqMode= $this->input->post("reqMode");
		$reqPOTENSI_DIRI_ID = $this->input->post("reqPOTENSI_DIRI_ID");

		$reqNama= $this->input->post("reqNama");
		$reqTempatLahir= $this->input->post("reqTempatLahir");
		$reqTglLahir= $this->input->post("reqTglLahir");
		$reqJenisKelamin= $this->input->post("reqJenisKelamin");
		$reqPekerjaan= $this->input->post("reqPekerjaan");
		$reqAlamat= $this->input->post("reqAlamat");
		$reqKodePos= $this->input->post("reqKodePos");
		$reqTelepon= $this->input->post("reqTelepon");
		
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

		$reqKelurahan= $this->input->post("reqKelurahan");
		$reqDesaarr=explode("*", $reqKelurahan);
		if (is_array($reqDesaarr)) {
			$reqKelurahan= $reqDesaarr[0];
		}

		$set= new Saudara();	
		$set->setField("SAUDARA_ID", $reqRowId);
		$set->setField("PEGAWAI_ID", $reqId);

		$set->setField("NAMA", setQuote($reqNama));
		$set->setField("TEMPAT_LAHIR", $reqTempatLahir);
		$set->setField("TANGGAL_LAHIR", dateToDBCheck($reqTglLahir));
		$set->setField("JENIS_KELAMIN", $reqJenisKelamin);
		$set->setField("PEKERJAAN", $reqPekerjaan);
		$set->setField("ALAMAT", setQuote($reqAlamat));
		$set->setField("KODEPOS", $reqKodePos);
		$set->setField("TELEPON", $reqTelepon);
		$set->setField("PROPINSI_ID", ValToNullDB($reqPropinsi));
		$set->setField("KABUPATEN_ID", ValToNullDB($reqKabupaten));
		$set->setField("KECAMATAN_ID", ValToNullDB($reqKecamatan));
		$set->setField("KELURAHAN_ID", ValToNullDB($reqKelurahan));

		$adminusernama= $this->adminuserloginnama;
		$userSatkerId= $this->adminsatkerid;
		
		$reqSimpan="";
	
		if ($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $adminusernama);
			$set->setField("LAST_CREATE_DATE", "NOW()");	
			$set->setField("LAST_CREATE_SATKER", $userSatkerId);
	
			if($set->insert())
			{
				$reqSimpan= 1;
			}
		}
		else
		{	
			$set->setField("LAST_UPDATE_USER", $adminusernama);
			$set->setField("LAST_UPDATE_DATE", "NOW()");	
			$set->setField("LAST_UPDATE_SATKER", $userSatkerId);
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}

		// $reqSimpan="1";
		if($reqSimpan == 1 )
		{
			echo json_response(200, 'Data berhasil disimpan');
		}
		else
		{
			echo json_response(400, 'Data gagal disimpan');
		}
				
	}

	function delete()
	{
		$this->load->model("base/Saudara");
		$set = new Saudara();
		
		$reqRowId =  $this->input->get('reqRowId');
		$reqMode =  $this->input->get('reqMode');

		$set->setField("SAUDARA_ID", $reqRowId);
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