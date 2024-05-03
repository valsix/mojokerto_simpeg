<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class user_group_json extends CI_Controller {

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
		$this->load->model("base/UserGroup");

		$set= new UserGroup();

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
		$sOrder = " ORDER BY A.NAMA ASC";
		$set->selectByParams(array(), $displaylength, $displaystart, $statement, $sOrder);
		// echo $set->query;exit;
		while ($set->nextRow()) 
		{
			$row= [];
			foreach($columnsDefault as $valkey => $valitem) 
			{
				if ($valkey == "SORDERDEFAULT")
					$row[$valkey]= "1";
				else if ($valkey == "NO")
				{
					$row[$valkey]= $no;
				}
				else if ($valkey == "TANGGAL")
				{
					$row[$valkey]= dateToPageCheck($set->getField($valkey));
				}
				else if ($valkey == "BIDANG_PEMBINAAN" || $valkey == "BIDANG_DOKUMENTASI" || $valkey == "BIDANG_PENDIDIKAN" || $valkey == "BIDANG_MUTASI" || $valkey == "LIHAT_PROSES" || $valkey == "PEGAWAI_PROSES" || $valkey == "DUK_PROSES" || $valkey == "KGB_PROSES" || $valkey == "KP_PROSES" || $valkey == "PENSIUN_PROSES" || $valkey == "ANJAB_PROSES" || $valkey == "MUTASI_PROSES" || $valkey == "HUKUMAN_PROSES" || $valkey == "MASTER_PROSES"   )
				{
					$row[$valkey]= getNameValue($set->getField(trim($valkey)));
				}
				else
				{
					$row[$valkey]= $set->getField($valkey);
				}
				
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

	function add()
	{
		$this->load->model('base/UserGroup');
		
		$set= new UserGroup();
		
		$reqMode= $this->input->post("reqMode");
		$reqId= $this->input->post("reqId");

		$reqNama 			= $this->input->post("reqNama");
		$reqPegawaiProses	= $this->input->post("reqPegawaiProses");
		$reqDUKProses 		= $this->input->post("reqDUKProses");
		$reqKGBProses	 	= $this->input->post("reqKGBProses");
		$reqKPProses 		= $this->input->post("reqKPProses");
		$reqPensiunProses 	= $this->input->post("reqPensiunProses");
		$reqAnjabProses 	= $this->input->post("reqAnjabProses");
		$reqMutasiProses 	= $this->input->post("reqMutasiProses");
		$reqHukumanProses 	= $this->input->post("reqHukumanProses");
		$reqMasterProses 	= $this->input->post("reqMasterProses");
		$reqLihatProses=$this->input->post("reqLihatProses");

		$reqBidangPembinaan=$this->input->post("reqBidangPembinaan");
		$reqBidangDokumentasi=$this->input->post("reqBidangDokumentasi");
		$reqBidangPendidikan=$this->input->post("reqBidangPendidikan");
		$reqBidangMutasi=$this->input->post("reqBidangMutasi");

		
	
		$set->setField("USER_GROUP_ID", $reqId);

		$set->setField('NAMA', $reqNama);
        $set->setField('PEGAWAI_PROSES', $reqPegawaiProses);
        $set->setField('DUK_PROSES', $reqDUKProses);
        $set->setField('KGB_PROSES', $reqKGBProses);
        $set->setField('KP_PROSES', $reqKPProses);
		$set->setField('PENSIUN_PROSES', $reqPensiunProses);
	 	$set->setField('ANJAB_PROSES', $reqAnjabProses);
		$set->setField('MUTASI_PROSES', $reqMutasiProses);
	 	$set->setField('HUKUMAN_PROSES', $reqHukumanProses);
		$set->setField('MASTER_PROSES', $reqMasterProses);
		$set->setField('LIHAT_PROSES', $reqLihatProses);
		
		
		$set->setField('BIDANG_PEMBINAAN', $reqBidangPembinaan);
		$set->setField('BIDANG_DOKUMENTASI', $reqBidangDokumentasi);
		$set->setField('BIDANG_PENDIDIKAN', $reqBidangPendidikan);
		$set->setField('BIDANG_MUTASI', $reqBidangMutasi);
		
		$reqSimpan= "";
		if($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $this->LOGIN_USER);
			$set->setField("LAST_CREATE_DATE", "NOW()");	
			$set->setField("LAST_CREATE_SATKER", $userLogin->userSatkerId);
			if($set->insert())
			{
				$reqId= $set->id;
				$reqSimpan= 1;
			}
		}
		else
		{
			$set->setField("LAST_UPDATE_USER", $this->LOGIN_USER);
			$set->setField("LAST_UPDATE_DATE", "NOW()");	
			$set->setField("LAST_UPDATE_SATKER", $userLogin->userSatkerId);
			if($set->update())
			{
				$reqSimpan= 1;
			}
		}
		
		if($reqSimpan == 1)
		{
			echo json_response(200, $reqId."-Data berhasil disimpan.");
		}
		else
		{
			echo json_response(400, "Data gagal disimpan");
		}
	}


	function delete()
	{
		$this->load->model("base/UserGroup");

		$reqId= $this->input->get("reqId");

		$set= new UserGroup();
		$set->setField("USER_GROUP_ID", $reqId);
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