<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class satuan_kerja_json extends CI_Controller {

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
	
	function treepilih() 
	{
		$this->load->model("base/SatuanKerja");
		$set = new SatuanKerja();

		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;//
		$id = isset($_POST['id']) ? $_POST['id'] : 0;//
		$result = array();
		
		$reqId =  $this->input->get('reqId');
		//$statement = " AND A.SATKER_ID = '".$reqId."'";
		
		if($reqSatuanKerjaId == "")
		{
			$reqSatuanKerjaId= $this->SATUAN_KERJA_ID;
		}
		
		$statementAktif= "";
		if($reqSatuanKerjaId == "")
		{
			if(isStrContain(strtoupper($this->USER_GROUP), "TEKNIS") == "1")
			{
				$statementAktif= " AND EXISTS(
				SELECT 1 FROM SATUAN_KERJA S WHERE 1=1 AND COALESCE(MASA_BERLAKU_AWAL,CURRENT_DATE) <= CURRENT_DATE AND COALESCE(MASA_BERLAKU_AKHIR,CURRENT_DATE) >= CURRENT_DATE
				AND A.SATUAN_KERJA_ID = S.SATUAN_KERJA_ID
				)";
			}
		}
		else
		{

			$statementAktif= " AND EXISTS(
			SELECT 1 FROM SATUAN_KERJA S WHERE 1=1 AND COALESCE(MASA_BERLAKU_AWAL,CURRENT_DATE) <= CURRENT_DATE AND COALESCE(MASA_BERLAKU_AKHIR,CURRENT_DATE) >= CURRENT_DATE
			AND A.SATUAN_KERJA_ID = S.SATUAN_KERJA_ID
			)";

			if(isStrContain(strtoupper($this->USER_GROUP), "TEKNIS") == "1" || $this->STATUS_SATUAN_KERJA_BKD == 1)
			{
				$reqSatuanKerjaId= "";
				// if($tempSatuanKerjaId == ""){}
				// else
				// {
				// 	$reqSatuanKerjaId= $tempSatuanKerjaId;
				// 	$skerja= new SatuanKerja();
				// 	$reqSatuanKerjaId= $skerja->getSatuanKerja($reqSatuanKerjaId);
				// 	unset($skerja);
				// 	//echo $reqSatuanKerjaId;exit;
				// 	$statement= " AND A.SATUAN_KERJA_ID IN (".$reqSatuanKerjaId.")";
				// }
			}
			// else
			// {
			// 	$skerja= new SatuanKerja();
			// 	$reqSatuanKerjaId= $skerja->getSatuanKerja($reqSatuanKerjaId);
			// 	unset($skerja);
			// 	//echo $reqSatuanKerjaId;exit;
			// 	$statement= " AND A.SATUAN_KERJA_ID IN (".$reqSatuanKerjaId.")";
			// 	//$statement= " AND ( A.SATUAN_KERJA_ID = ANY( AMBIL_ID_SATUAN_KERJA_TREE_ARRAY(".$reqSatuanKerjaId.") ) OR A.SATUAN_KERJA_ID = ".$reqSatuanKerjaId." )";
			// }
		}
		// echo $statementAktif;exit();

		$i=0;
		// echo $id;
		if ($id == 0)
		{
			$result["total"] = 0;
			//$set->selectByParamsTreeMonitoring(array("A.SATUAN_KERJA_PARENT_ID" => 0), $rows, $offset, $statement);

			if($reqSatuanKerjaId == "")
			{
				$statement.= " AND A.satker_id_parent = '0'";
			}
			else
			{
				$statement.= " AND A.satker_id = ".$reqSatuanKerjaId;
			}
			
			$tempSatuanKerjaInduk= "Pemerintah Kabupaten Mojokerto";
			$tempSatuanKerjaIndukInfo= "Semua Satuan Kerja";
			$i=0;
			$items[$i]['ID'] = "0";
			$items[$i]['NAMA'] = "<a onclick=\"calltreeid('', '".$tempSatuanKerjaIndukInfo."')\">".$tempSatuanKerjaInduk."</a>";
			// $items[$i]['state'] = $this->has_child("", $statement) ? 'closed' : 'open';
			$i++;

			$set->selectByParamsTreeMonitoring(array(), -1, -1, $statementAktif.$statement);
			// echo $set->query;exit;
			//echo $set->errorMsg;exit;
			while($set->nextRow())
			{
				$items[$i]['ID'] = $set->getField("satker_id");
				$items[$i]['NAMA'] = "<a onclick=\"calltreeid('".$set->getField("satker_id")."', '".$set->getField("NAMA")."')\">".$set->getField("NAMA")."</a>";
				$items[$i]['state'] = $this->has_child($set->getField("satker_id"), $statementAktif) ? 'closed' : 'open';
				$i++;
			}
			$result["rows"] = $items;
		} 
		else 
		{
			$set->selectByParamsTreeMonitoring(array("A.satker_id_parent" => $id), -1, -1, $statementAktif.$statement);
			//echo $set->query;exit;
			while($set->nextRow())
			{
				$result[$i]['ID'] = $set->getField("satker_id");
				$result[$i]['NAMA'] = "<a onclick=\"calltreeid('".$set->getField("satker_id")."', '".$set->getField("NAMA")."')\">".$set->getField("NAMA")."</a>";
				$result[$i]['state'] = $this->has_child($set->getField("satker_id"), $statementAktif) ? 'closed' : 'open';
				$i++;
			}
		}
		
		echo json_encode($result);
	}
	
	function tree() 
	{
		$this->load->model("SatuanKerja");
		$set = new SatuanKerja();

		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;//
		$id = isset($_POST['id']) ? $_POST['id'] : 0;//
		$result = array();
		
		$reqId =  $this->input->get('reqId');
		//$statement = " AND A.SATKER_ID = '".$reqId."'";
		
		if($reqSatuanKerjaId == "")
		{
			$reqSatuanKerjaId= $this->SATUAN_KERJA_ID;
		}
		
		$statementAktif= "";
		if($reqSatuanKerjaId == "")
		{
			if(isStrContain(strtoupper($this->USER_GROUP), "TEKNIS") == "1")
			{
				$statementAktif= " AND EXISTS(
				SELECT 1 FROM SATUAN_KERJA S WHERE 1=1 AND COALESCE(MASA_BERLAKU_AWAL,CURRENT_DATE) <= CURRENT_DATE AND COALESCE(MASA_BERLAKU_AKHIR,CURRENT_DATE) >= CURRENT_DATE
				AND A.SATUAN_KERJA_ID = S.SATUAN_KERJA_ID
				)";
			}
		}
		else
		{

			$statementAktif= " AND EXISTS(
			SELECT 1 FROM SATUAN_KERJA S WHERE 1=1 AND COALESCE(MASA_BERLAKU_AWAL,CURRENT_DATE) <= CURRENT_DATE AND COALESCE(MASA_BERLAKU_AKHIR,CURRENT_DATE) >= CURRENT_DATE
			AND A.SATUAN_KERJA_ID = S.SATUAN_KERJA_ID
			)";

			if(isStrContain(strtoupper($this->USER_GROUP), "TEKNIS") == "1")
			{
				$reqSatuanKerjaId= "";
			}
		}
		// echo $statement;exit();

		if ($id == 0)
		{
			$result["total"] = 0;
			//$set->selectByParamsTreeMonitoring(array("A.SATUAN_KERJA_PARENT_ID" => 0), $rows, $offset, $statement);
			$set->selectByParamsTreeMonitoring(array("A.SATUAN_KERJA_PARENT_ID" => 0), -1, -1, $statementAktif.$statement);
			//echo $set->query;exit;
			//echo $set->errorMsg;exit;
			$i=0;
			while($set->nextRow())
			{
				$items[$i]['ID'] = $set->getField("SATUAN_KERJA_ID");
				$items[$i]['NAMA'] = $set->getField("NAMA");
				$items[$i]['LINK_URL_INFO'] = $set->getField("LINK_URL_INFO");
				$items[$i]['state'] = $this->has_child($set->getField("SATUAN_KERJA_ID"), $statementAktif) ? 'closed' : 'open';
				$i++;
			}
			$result["rows"] = $items;
		} 
		else 
		{
			$set->selectByParamsTreeMonitoring(array("A.SATUAN_KERJA_PARENT_ID" => $id), -1, -1, $statementAktif.$statement);
			//echo $set->query;exit;
			$i=0;
			while($set->nextRow())
			{
				$result[$i]['ID'] = $set->getField("SATUAN_KERJA_ID");
				$result[$i]['NAMA'] = $set->getField("NAMA");
				$result[$i]['LINK_URL_INFO'] = $set->getField("LINK_URL_INFO");
				$result[$i]['state'] = $this->has_child($set->getField("SATUAN_KERJA_ID"), $statementAktif) ? 'closed' : 'open';
				$i++;
			}
		}
		
		echo json_encode($result);
	}	
	
	function has_child($id, $stat)
	{
		$child = new SatuanKerja();
		$child->selectByParamsTreeMonitoring(array("satker_id_parent" => $id), -1,-1, $stat);
		// echo $child->query;exit;
		$child->firstRow();
		$tempId= $child->getField("satker_id");
		//echo $child->errorMsg;exit;
		//echo $tempId;exit;
		if($tempId == "")
		return false;
		else
		return true;
		unset($child);
	}

	function json_pencarian()
	{
		$this->load->model("base/SatuanKerja");

		$set= new SatuanKerja();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}
		// print_r($columnsDefault);exit;

		$displaystart= -1;
		$displaylength= -1;
		$no=1;

		$arrinfodata= [];

		$statement= "";
		// $sOrder = " ORDER BY A.TANGGAL ASC";
		$sOrder = "  ORDER BY SATKER_ID  ";
		$set->selectByParamsSatker(array(), $displaylength, $displaystart, $statement, $sOrder);
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
				else if ($valkey == "NO")
				{
					$row[$valkey]= $no;
				}
				else
					$row[$valkey]= $set->getField($valkey);
			}
			$no++;
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