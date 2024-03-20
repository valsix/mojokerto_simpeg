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
		$this->load->model("base/Pegawai");

		$set= new Pegawai();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}

		$reqKeterangan = $this->input->get("reqKeterangan");
		$reqId = $this->input->get("reqId");
		$reqCari = $this->input->get("reqCari");
		$reqSearch = $this->input->get("reqSearch");
		$reqStatusHukuman= $this->input->get("reqStatusHukuman");
		$cekquery= $this->input->get("c");
		// print_r($columnsDefault);exit;

		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$userpegawaimode= $this->userpegawaimode;
		$adminuserid= $this->adminuserid;

		// ambil seseuai login
		$sess_satkerid= $this->sess_satkerid;
		
		if(empty($sess_satkerid))//kondisi login sebagai admin
		{
			$statement= '';
		}
		else // kondisi login sebagai SKPD
		{
			if(empty($reqId))
				$statement.= " AND A.SATKER_ID LIKE '".$sess_satkerid."%' ";
			else
				$statement.= " AND A.SATKER_ID LIKE '".$reqId."%' ";
		}

		if($reqSearch == "")
			$reqSearch.= " AND A.STATUS_PEGAWAI IN (1, 2)";

		$reqSearch.= " AND A.TANGGAL_LAHIR IS NOT NULL";

		/*if($userLogin->userGroupId == 99)
			$reqSearch.= " AND JUMLAH_HUKUMAN > 0 ";*/

		if($reqStatusHukuman == ""){}
		else
		$reqSearch .= " AND CASE WHEN CURRENT_DATE <= G.TANGGAL_AKHIR AND CURRENT_DATE >= G.TANGGAL_MULAI THEN 1 ELSE 0 END = 1 ";

		if(empty($reqId) || $reqId == "-1")
			$statement.= "".$reqSearch;
		else
			$statement.= " AND A.SATKER_ID LIKE '".$reqId."%' ".$reqSearch;

		/*
		if($reqCari == ""){ // tanpa pencarian
			if($reqId == "")
				$statement .= "".$reqSearch;
			else
				$statement .= " AND A.SATKER_ID LIKE '".$reqId."%' ".$reqSearch;
		}
		else // kondisi pencarian
		{
			if($rdoState == "modul1")
			{
				$statement = " AND A.SATKER_ID LIKE '".$userLogin->userSatkerId."%' ".$reqSearch;
			}
			elseif($rdoState == "modul2")
			{
				$statement = " AND A.SATKER_ID LIKE '".$reqId."%' ".$reqSearch;
			}
			
			if($reqNip)
			{
				$statement .= " AND NIP_LAMA LIKE '%".$reqNip."%'";
			}
		    if($reqNipBaru)
			{
				$statement .= " AND NIP_BARU LIKE '%".$reqNipBaru."%'";
			}
			if($reqNama)
			{
				$statement .= " AND UPPER(A.NAMA) LIKE '%".strtoupper($reqNama)."%'";
			}
			if($reqUmurAkhir > $reqUmurAwal)
			{
				$statement .= " AND USIA_TAHUN BETWEEN '".$reqUmurAwal."' AND '".$reqUmurAkhir."'";
			}
		}

		// if (!empty($reqId))
		// {
			$sOrder = "ORDER BY C.ESELON_ID asc,A.TUGAS_TAMBAHAN_NEW asc,B.PANGKAT_ID  DESC,B.TMT_PANGKAT asc";
		// }

		*/

		$sOrder= "ORDER BY C.ESELON_ID ASC, A.TUGAS_TAMBAHAN_NEW ASC, B.PANGKAT_ID DESC, B.TMT_PANGKAT ASC";
		// $statement .= " AND A.PEGAWAI_ID IN (995865801606, 995865800180, 235164100003, 235162000001)";

		$searhjson= " AND (UPPER(B.GOL_RUANG) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(TEMPAT_LAHIR) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(NAMA) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(A.NAMA) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(A.NIP_LAMA) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(A.NIP_BARU) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(AMBIL_FORMAT_NIP_BARU(NIP_BARU)) LIKE '%".strtoupper($_GET['sSearch'])."%' ) ";

		$set->selectmonitoring(array(), $dsplyRange, $dsplyStart, $statement, $sOrder);
		
		if(!empty($cekquery)){
			echo $set->query;exit;
		}

		$arrtgl= array("TMT_PANGKAT", "TMT_JABATAN", "TMT_JABATAN_AKHIR", "TMT_PENSIUN");
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
				{
					$row[$valkey]= "1";
				}
				else if(in_array($valkey, $arrtgl))
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

	function jsonduk()
	{
		ini_set('memory_limit', '-1');
		$this->load->model("base/Pegawai");

		$set= new Pegawai();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}

		$reqKeterangan = $this->input->get("reqKeterangan");
		$reqId = $this->input->get("reqId");
		$reqCari = $this->input->get("reqCari");
		$reqSearch = $this->input->get("reqSearch");
		$reqStatusHukuman= $this->input->get("reqStatusHukuman");
		$reqTipePegawaiId= $this->input->get("reqTipePegawaiId");
		$reqBulan= $this->input->get("reqBulan");
		$reqTahun= $this->input->get("reqTahun");
		$reqPangkatId= $this->input->get("reqPangkatId");
		$reqMode= $this->input->get("reqMode");
		$cekquery= $this->input->get("c");
		// print_r($columnsDefault);exit;

		$displaystart= -1;
		$displaylength= -1;

		$arrinfodata= [];

		$userpegawaimode= $this->userpegawaimode;
		$adminuserid= $this->adminuserid;

		// ambil seseuai login
		$sess_satkerid= $this->sess_satkerid;

		if($sess_satkerid == "")//kondisi login sebagai admin
		{	
			if(empty($reqId))
				$reqRowId= '';
			else
				$reqRowId= $reqId;
		}
		else // kondisi login sebagai SKPD
		{		
			if(empty($reqId))
				$reqRowId= $sess_satkerid;
			else
				$reqRowId= $reqId;
		}

		if($reqMode == "proses")
		{
			$setdetil= new Pegawai();
			$setdetil->setField("PERIODE", $reqBulan.$reqTahun);	
			$setdetil->setField("SATKERID", $reqRowId);	
			$setdetil->setField("TIPEPEGAWAI", $reqTipePegawaiId);	
			$setdetil->callDUK();
		}
		
		$set->selectByParamsDUK(array(), $dsplyRange, $dsplyStart, $statement, $sOrder);
		
		if(!empty($cekquery)){
			echo $set->query;exit;
		}

		$arrtgl= array("TMT_PANGKAT", "TMT_JABATAN", "TMT_JABATAN_AKHIR", "TMT_PENSIUN");
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
				{
					$row[$valkey]= "1";
				}
				else if(in_array($valkey, $arrtgl))
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
}
?>