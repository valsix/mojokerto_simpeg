<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class pendidikan_umum_json extends CI_Controller {

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
		$this->load->model("base-validasi/PendidikanUmum");

		$set= new PendidikanUmum();

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
		$this->load->model("base-validasi/PendidikanUmum");
		$this->load->library('globalfilepegawai');
		$reqLinkFile= $_FILES['reqLinkFile'];

		// start tambahan untuk validasi
		$this->load->model("base-validasi/PendidikanUmum");
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

		$reqNamaSekolah= $this->input->post("reqNamaSekolah");
		$reqPendidikan= $this->input->post("reqPendidikan");
		$reqTglSTTB= $this->input->post("reqTglSTTB");
		$reqJurusan= $this->input->post("reqJurusan");
		$reqAlamatSekolah= $this->input->post("reqAlamatSekolah");
		$reqKepalaSekolah= $this->input->post("reqKepalaSekolah");
		$reqNoSTTB= $this->input->post("reqNoSTTB");
		
		$set = new PendidikanUmum();
		$set->setField("PEGAWAI_ID", $reqId);
		$set->setField("NAMA", $reqNamaSekolah);
		$set->setField("PENDIDIKAN_ID", ValToNullDB($reqPendidikan));
		$set->setField("TANGGAL_STTB", dateToDBCheck($reqTglSTTB));
		$set->setField("JURUSAN", $reqJurusan);
		$set->setField("TEMPAT", $reqAlamatSekolah);
		$set->setField("KEPALA", $reqKepalaSekolah);
		$set->setField("NO_STTB", $reqNoSTTB);

		$adminusernama= $this->adminuserloginnama;
		$userSatkerId= $this->adminsatkerid;

		// start tambahan untuk validasi
		$set->setField('PENDIDIKAN_RIWAYAT_ID', idValidasiDb($reqRowId));
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

		if($reqSimpan == 1)
		{
			// start tambahan untuk validasi
			if($reqStatusValidasi == "1")
			{
				$set->updatetanggalvalidasi();
			}
			// end tambahan untuk validasi

			// untuk simpan file
			// $vpost= $this->input->post();
			// $vsimpanfilepegawai= new globalfilepegawai();
			// $vsimpanfilepegawai->simpanfilepegawai($vpost, $reqRowId, $reqLinkFile);
			
			echo json_response(200, $reqRowId."-Data berhasil disimpan.");
		}
		else
		{
			echo json_response(400, "Data gagal disimpan");
		}
				
	}
}
?>