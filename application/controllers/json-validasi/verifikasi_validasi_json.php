<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class verifikasi_validasi_json extends CI_Controller {

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
		$this->adminsatkerid= $this->session->userdata("adminsatkerid".$configvlxsessfolder);
		$this->sess_satkerid= $this->adminsatkerid;
		$this->adminuserloginnama= $this->session->userdata("adminuserloginnama".$configvlxsessfolder);
		$this->adminusernama= $this->session->userdata("adminusernama".$configvlxsessfolder);
		$this->adminusergroupid= $this->session->userdata("adminusergroupid".$configvlxsessfolder);
		$this->adminuserpegawaiid= $this->session->userdata("adminuserpegawaiid".$configvlxsessfolder);
	}

	function json()
	{
		ini_set('memory_limit', '-1');
		$this->load->model("base-validasi/Pegawai");

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
		
		/*if(empty($sess_satkerid))//kondisi login sebagai admin
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

		if($reqStatusHukuman == ""){}
		else
		$reqSearch .= " AND CASE WHEN CURRENT_DATE <= G.TANGGAL_AKHIR AND CURRENT_DATE >= G.TANGGAL_MULAI THEN 1 ELSE 0 END = 1 ";

		if(empty($reqId) || $reqId == "-1")
			$statement.= "".$reqSearch;
		else
			$statement.= " AND A.SATKER_ID LIKE '".$reqId."%' ".$reqSearch;*/

		// $statement.= " AND A.PEGAWAI_ID IN (235162200007, 235160100843)";
		// $sOrder= "ORDER BY C.ESELON_ID ASC, A.TUGAS_TAMBAHAN_NEW ASC, B.PANGKAT_ID DESC, B.TMT_PANGKAT ASC";

		/*$searhjson= " AND (UPPER(B.GOL_RUANG) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(TEMPAT_LAHIR) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(NAMA) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(A.NAMA) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(A.NIP_LAMA) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(A.NIP_BARU) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(AMBIL_FORMAT_NIP_BARU(NIP_BARU)) LIKE '%".strtoupper($_GET['sSearch'])."%' ) ";*/

		$set->selectByValidasi(array(), $dsplyRange, $dsplyStart, $statement, $sOrder);
		
		if(!empty($cekquery)){
			echo $set->query;exit;
		}

		$arrtgl= array("TMT_PANGKAT", "TMT_JABATAN", "TMT_JABATAN_AKHIR", "TMT_PENSIUN");
		$arrtimetgl= array("INFO_CREATE_DATE");
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
				else if(in_array($valkey, $arrtimetgl))
				{
					$row[$valkey]= dateToPageCheck(datetimeToPage($set->getField($valkey), "date"));
				}
				else if($valkey == "INFO_GROUP")
				{
					$vreturn= $set->getField("NIP_BARU")." - ".$set->getField("NAMA");
					$row[$valkey]= $vreturn;
				}
				else if($valkey == "FOTO")
				{
					$vpath= $set->getField("FOTO_BLOB");
					if(empty($vpath))
					{
						$vpath= "images/foto-profile.jpg";
					}

					$row[$valkey] = '<img src="'.$vpath.'" style="width:60px;height:90px" />';
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