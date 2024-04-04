<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class sertifikat_profesi_json extends CI_Controller {

	function __construct() {
		parent::__construct();
		//kauth

		session_start();
		
		$CI =& get_instance();
		$configdata= $CI->config;
        $configvlxsessfolder= $configdata->config["vlxsessfolder"];
		$reqPegawaiHard=$this->input->get('reqPegawaiHard');

        $redirectlogin= "";
        if(!empty($_SESSION["vuserpegawaimode".$configvlxsessfolder]) && !empty($this->session->userdata("adminuserid".$configvlxsessfolder)))
        {
        	$this->session->set_userdata("userpegawaimode".$configvlxsessfolder, $_SESSION["vuserpegawaimode".$configvlxsessfolder]);
        	$redirectlogin= "";
        }

		if(!empty($this->session->userdata("userpegawaiId".$configvlxsessfolder)) && !empty($redirectlogin))
		{
        	$redirectlogin= "";
        }

        if(!empty($reqPegawaiHard)){
        	$redirectlogin= "";
        }
        // echo $redirectlogin."xx".$this->session->userdata("userpegawaimode".$configvlxsessfolder)."xx".$this->session->userdata("adminuserid".$configvlxsessfolder)."xx".$_SESSION["vuserpegawaimode".$configvlxsessfolder];exit;
        // echo $redirectlogin."xx".$this->session->userdata("userpegawaiId".$configvlxsessfolder);exit;

        if(!empty($redirectlogin))
		{
			redirect('login');
		}

		$this->pegawaiId= $this->session->userdata("userpegawaiId".$configvlxsessfolder);
		$this->userpegawaiNama= $this->session->userdata("userpegawaiNama".$configvlxsessfolder);
		// echo $this->userpegawaiNama; exit;
		$this->userstatuspegId= $this->session->userdata("userstatuspegId".$configvlxsessfolder);
		$this->userpegawaimode= $this->session->userdata("userpegawaimode".$configvlxsessfolder);

		$this->adminuserid= $this->session->userdata("adminuserid".$configvlxsessfolder);
		$this->adminusernama= $this->session->userdata("adminusernama".$configvlxsessfolder);
		$this->adminuserloginnama= $this->session->userdata("adminuserloginnama".$configvlxsessfolder);
		$this->adminuseraksesappmenu= $this->session->userdata("adminuseraksesappmenu".$configvlxsessfolder);

		$this->userlevel= $this->session->userdata("userlevel".$configvlxsessfolder);


        if(!empty($reqPegawaiHard)){
        	$this->userpegawaimode=$reqPegawaiHard;
        }
	}

	function json()
	{
		ini_set('memory_limit', '-1');
		$this->load->model("base/SertifikatProfesi");

		$set= new SertifikatProfesi();

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
		$statement= "and pegawai_id= '".$reqId."'" ;
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
		$this->load->model("base/SertifikatProfesi");

		$reqId= $this->input->post("reqId");
		$reqRowId= $this->input->post("reqRowId");
		$reqMode= $this->input->post("reqMode");

		$reqNama= $this->input->post("reqNama");
		$reqNomor= $this->input->post("reqNomor");
		$reqSertifikat= $this->input->post("reqSertifikat");
		$reqTanggal= $this->input->post("reqTanggal");
		$reqLembaga= $this->input->post("reqLembaga");
		

		$sertifikat = new SertifikatProfesi();
	

		$sertifikat->setField('PEGAWAI_ID', $reqId);
		$sertifikat->setField('NAMA', $reqNama);
		$sertifikat->setField('NOMOR', $reqNomor);
		$sertifikat->setField('LEMBAGA', $reqLembaga);
		$sertifikat->setField('SERTIFIKAT', $reqSertifikat);
		$sertifikat->setField('TANGGAL', dateToDBCheck($reqTanggal));


		$sertifikat->setField('SERTIFIKAT_PROFESI_ID', $reqRowId);

		$reqSimpan= "";
		if ($reqMode == "insert")
		{

			$sertifikat->setField("LAST_CREATE_USER", $adminusernama);
			$sertifikat->setField("LAST_CREATE_DATE", "NOW()");	
			$sertifikat->setField("LAST_CREATE_SATKER", $userSatkerId);
	
			if($sertifikat->insert())
			{
				$reqSimpan= 1;
			}
		}
		else
		{	
			$sertifikat->setField("LAST_UPDATE_USER", $adminusernama);
			$sertifikat->setField("LAST_UPDATE_DATE", "NOW()");	
			$sertifikat->setField("LAST_UPDATE_SATKER", $userSatkerId);
			if($sertifikat->update())
			{
				$reqSimpan= 1;
			}
		}


		if($reqSimpan == 1)
		{
			echo json_response(200, $reqRowId."-Data berhasil disimpan.");
		}
		else
		{
			echo json_response(400, "Data gagal disimpan");
		}
				
	}


	function delete()
	{
		$this->load->model("base/SertifikatProfesi");
		$set = new SertifikatProfesi();
		
		$reqRowId =  $this->input->get('reqRowId');
		$reqMode =  $this->input->get('reqMode');

		$set->setField("SERTIFIKAT_PROFESI_ID", $reqRowId);
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