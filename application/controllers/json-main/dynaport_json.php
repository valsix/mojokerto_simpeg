<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class dynaport_json extends CI_Controller {

	function __construct() {
		parent::__construct();
		//kauth

		session_start();

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

		$this->configvlxsessfolder= $this->session->userdata("configvlxsessfolder".$configvlxsessfolder);
		$this->adminuserid= $this->session->userdata("adminuserid".$configvlxsessfolder);
		$this->adminsatkerid= $this->session->userdata("adminsatkerid".$configvlxsessfolder);
		$this->sess_satkerid= $this->adminsatkerid;
		$this->adminuserloginnama= $this->session->userdata("adminuserloginnama".$configvlxsessfolder);
		$this->adminusernama= $this->session->userdata("adminusernama".$configvlxsessfolder);
		$this->adminusergroupid= $this->session->userdata("adminusergroupid".$configvlxsessfolder);
		$this->adminuserpegawaiid= $this->session->userdata("adminuserpegawaiid".$configvlxsessfolder);

		$this->session->set_userdata("dynaorder", $_SESSION["dynaorder"]);
		$this->dynaorder= $_SESSION["dynaorder"];

		$this->session->set_userdata("dynawhere", $_SESSION["dynawhere"]);
		$this->dynawhere= $_SESSION["dynawhere"];
		
	}

	function array_value_recursive($key, array $arr){
		$val = array();
		array_walk_recursive($arr, function($v, $k) use($key, &$val){
			if($k == $key) array_push($val, $v);
		});
		return count($val) > 1 ? $val : array_pop($val);
	}

	function setatribut()
	{
		$this->load->library('globaldyna');
		$vdyna= new globaldyna();
		$arrfield= $vdyna->getinfofield();
		$arrselect= $vdyna->getinfoselect();
		$arroperator= $vdyna->getinfooperator();

		$arrcolomfield= array_column($arrfield, 'data');

		$arrdatafield= [];
		foreach ($arrcolomfield as $key => $value) {
			foreach ($value as $k => $v) {
				array_push($arrdatafield, $v);
			}
		}

		$vasc= $this->input->post("vasc");
		$vtr= $this->input->post("vtr");
		$visifield= $this->input->post("visifield");
		$visioperator= $this->input->post("visioperator");
		$visivalue= $this->input->post("visivalue");

		$arrisifield= explode("***", $visifield);
		$arrisioperator= explode("***", $visioperator);
		$arrisivalue= explode("***", $visivalue);

		$dynaorder= $vorder= "";
		$arrasc= explode("***", $vasc);
		// print_r($arrasc);exit;
		foreach ($arrasc as $key => $value) {

			$corder= explode(";", $value);
			$infocarikey= $corder[0];
			$arrcheck= in_array_column($infocarikey, "field", $arrdatafield);
			if(!empty($arrcheck))
			{
				$idx= $arrcheck[0];
				$vfield= $arrdatafield[$idx]["n"];
				$vorder= getconcatseparator($vorder, $vfield, ", ")." ".$corder[1];
			}
		}

		if(!empty($vorder))
		{
			$dynaorder= "ORDER BY ".$vorder;
		}

		$this->session->set_userdata('dynaorder'.$this->configvlxsessfolder, $dynaorder);
		$_SESSION["dynaorder"]= $dynaorder;

		$arrtablehide= array(
			array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
			, array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"")
		);

		$vreturn["arrtablehide"]= $arrtablehide;
		$vreturn["vtr"]= $vtr;

		$operatorwhere= "";
		foreach ($arrisifield as $k => $v)
		{
			$wherefield= "";
			$infocarikey= $v;
			$arrcheck= in_array_column($infocarikey, "opt", $arrselect);
			// print_r($arrcheck);exit;
			if(!empty($arrcheck))
			{
				// set field
				$keyindex= $arrcheck[0];
				$vupper= $arrselect[$keyindex]["upper"];
				$vn= $arrselect[$keyindex]["n"];
				$vmode= $arrselect[$keyindex]["mode"];
				if(!empty($vupper))
					$wherefield= "UPPER(".$vn.")";
				else if($vmode == "date")
				{
					$wherefield= "TO_DATE(TO_CHAR(".$vn.", 'YYYY-MM-DD'), 'YYYY/MM/DD')";
				}
				else
					$wherefield= $vn;

				$infocarikey= $arrisioperator[$k];
				$arrcheck= in_array_column($infocarikey, "opt", $arroperator);
				$keyindex= $arrcheck[0];
				// set operator
				$wherefield.= " ".$arroperator[$keyindex]["n"];

				// set value
				$valueisi= $arrisivalue[$k];
				if(!empty($vupper))
					$valueisi= strtoupper($valueisi);

				// untuk like
				if($infocarikey == 7)
				{
					$wherefield.= "'%".$valueisi."%'";
				}
				else
				{
					if($vmode == "date")
					{
						$wherefield.= "TO_DATE('".dateToPageCheck($valueisi)."','YYYY/MM/DD')";
					}
					else
					{
						$wherefield.= "'".$valueisi."'";
					}
				}
			}

			if(!empty($wherefield))
			{
				$vwhere= $wherefield;
				$operatorwhere= getconcatseparator($operatorwhere, $vwhere, " AND ");
			}
		}

		if(!empty($operatorwhere))
		{
			$operatorwhere= " AND ".$operatorwhere;
		}
		$this->session->set_userdata('dynawhere'.$this->configvlxsessfolder, $operatorwhere);
		$_SESSION["dynawhere"]= $operatorwhere;
		
		echo json_encode( $vreturn, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	function json()
	{
		ini_set('memory_limit', '-1');
		$this->load->model("base/Dyna");

		$set= new Dyna();

		if ( isset( $_REQUEST['columnsDef'] ) && is_array( $_REQUEST['columnsDef'] ) ) {
			$columnsDefault = [];
			foreach ( $_REQUEST['columnsDef'] as $field ) {
				$columnsDefault[ $field ] = "true";
			}
		}

		$cekquery= $this->input->get("c");
		$m= $this->input->get("m");
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

		// $statement.= " AND A.SATKER_ID LIKE '01%' ";

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

		if(empty($m))
		{
			$statement.= " AND 1=2";
		}

		// $sOrder= "ORDER BY C.ESELON_ID ASC, A.TUGAS_TAMBAHAN_NEW ASC, B.PANGKAT_ID DESC, B.TMT_PANGKAT ASC";
		$sOrder= $this->dynaorder;
		$dynawhere= $this->dynawhere;
		if(!empty($dynawhere))
		{
			$statement .= $dynawhere;
		}
		
		// $statement .= " AND A.PEGAWAI_ID IN (995865801606, 995865800180, 235164100003, 235162000001)";

		$searhjson= " AND (UPPER(B.GOL_RUANG) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(TEMPAT_LAHIR) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(NAMA) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(A.NAMA) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(A.NIP_LAMA) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(A.NIP_BARU) LIKE '%".strtoupper($_GET['sSearch'])."%' OR UPPER(AMBIL_FORMAT_NIP_BARU(NIP_BARU)) LIKE '%".strtoupper($_GET['sSearch'])."%' ) ";

		$set->selectmonitoring(array(), $dsplyRange, $dsplyStart, $statement, $sOrder);
		
		// $cekquery= 1;
		if(!empty($cekquery)){
			echo $set->query;exit;
		}

		$arrtgl= array("TANGGAL_LAHIR", "TANGGAL_PENSIUN", "TMT_PANGKAT", "TMT_ESELON", "TMT_JABATAN", "TANGGAL_SK_JABATAN", "TANGGAL_STTB_PENDIDIKAN", "TANGGAL_SK_PENGHARGAAN", "TMT_SK_HUKUMAN", "TANGGAL_LAHIR_ANAK", "AWAL_BAYAR_ANAK", "AKHIR_BAYAR_ANAK", "TANGGAL_LAHIR_SUAMI", "TANGGAL_KAWIN_SUAMI", "TANGGAL_SURAT_CUTI", "TANGGAL_SK_CPNS", "TMT_CPNS", "TANGGAL_TUGAS_CPNS", "TANGGAL_SK_PNS", "TMT_PNS", "TANGGAL_SUMPAH_PNS");
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