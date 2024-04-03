<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class pak_json extends CI_Controller {

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
		$this->load->model("base/PAK");

		$set= new PAK();

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

		
		$statement= "and pegawai_id= '".$reqId."'" ;
		$set->selectByParams(array(), $dsplyRange, $dsplyStart, $statement, $sOrder);

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
				else if ($valkey == "NILAI")
				{
					$row[$valkey]= str_replace(".", ",", $set->getField($valkey));
				}
				else if ($valkey == "BULAN_MULAI" || $valkey == "BULAN_SELESAI" )
				{
					$row[$valkey]= getNameMonth($set->getField($valkey));
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
		$this->load->model("base/Pak");

		$reqId= $this->input->post("reqId");
		$reqRowId= $this->input->post("reqRowId");
		$reqMode= $this->input->post("reqMode");

		$reqPegawaiId	= $this->input->post("reqId");

		$reqNomor				= $this->input->post("reqNomor");
		$reqTglSK				= $this->input->post("reqTglSK");
		$reqKredit				= $this->input->post("reqKredit");
		$reqBulanMulai				= $this->input->post("reqBulanMulai");
		$reqTahunMulai				= $this->input->post("reqTahunMulai");
		$reqBulanSelesai				= $this->input->post("reqBulanSelesai");
		$reqTahunSelesai				= $this->input->post("reqTahunSelesai");

		if(intval($reqTahunMulai) > intval($reqTahunSelesai) )
		{
			echo json_response(400, "Tahun Mulai Penilaian tidak boleh lebih dari tahun selesai");exit;
		}

		if(intval($reqBulanMulai) > intval($reqBulanSelesai) )
		{
			echo json_response(400, "Bulan Mulai Penilaian tidak boleh lebih dari bulan selesai");exit;
		}


		// print_r($reqPejabatId);exit;

		$pak = new Pak();
	
		
		$pak->setField('PAK_ID', $reqRowId);		
		$pak->setField('NOMOR_SK', $reqNomor);
		$pak->setField('TGL_SK', dateToDBCheck($reqTglSK));

		$pak->setField('ANGKA_KREDIT', $reqKredit);
		$pak->setField('BULAN_MULAI', $reqBulanMulai);
		$pak->setField('TAHUN_MULAI', ValToNullDB($reqTahunMulai));
		$pak->setField('BULAN_SELESAI', $reqBulanSelesai);
		$pak->setField('TAHUN_SELESAI', ValToNullDB($reqTahunSelesai));
		$pak->setField('PEGAWAI_ID', $reqId);		

		
		$reqSimpan= "";
		if ($reqMode == "insert")
		{

			$pak->setField("LAST_CREATE_USER", $adminusernama);
			$pak->setField("LAST_CREATE_DATE", "NOW()");	
			$pak->setField("LAST_CREATE_SATKER", $userSatkerId);
	
			if($pak->insert())
			{
				$reqRowId=$pak->id;
				$reqSimpan= 1;
			}
		}
		else
		{	
			$pak->setField("LAST_UPDATE_USER", $adminusernama);
			$pak->setField("LAST_UPDATE_DATE", "NOW()");	
			$pak->setField("LAST_UPDATE_SATKER", $userSatkerId);
			if($pak->update())
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
		$this->load->model("base/Pak");
		$set = new Pak();
		
		$reqRowId =  $this->input->get('reqRowId');
		$reqMode =  $this->input->get('reqMode');

		$set->setField("PAK_ID", $reqRowId);
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