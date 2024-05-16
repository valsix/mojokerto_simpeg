<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class riwayat_jabatan_json extends CI_Controller {

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
		$this->load->model("base/RiwayatJabatan");

		$set= new RiwayatJabatan;
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
		$statement= "and PEGAWAI_ID= '".$reqId."'" ;
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
				else if ($valkey == "MASA_KERJA")
				{
					$row[$valkey]= $set->getField('MASA_KERJA_TAHUN').'-'.$set->getField('MASA_KERJA_BULAN');
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
		
		$this->load->model("base/RiwayatJabatan");
		$this->load->model("base/PejabatPenetap");

		$reqId= $this->input->post("reqId");
		$reqRowId= $this->input->post("reqRowId");
		$reqMode= $this->input->post("reqMode");

		$reqNoSK= $this->input->post("reqNoSK");
		$reqTglSK= $this->input->post("reqTglSK");
		$reqNamaJabatan= $this->input->post("reqNamaJabatan");
		$reqTMTJabatan= $this->input->post("reqTMTJabatan");
		$reqEselon= $this->input->post("reqEselon");
		$reqTMTEselon= $this->input->post("reqTMTEselon");
		$reqPjPenetap= $this->input->post("reqPjPenetap");
		$reqNoPelantikan= $this->input->post("reqNoPelantikan");
		$reqTglPelantikan= $this->input->post("reqTglPelantikan");
		$reqTunjangan= $this->input->post("reqTunjangan");
		$reqBlnDibayar= $this->input->post("reqBlnDibayar");
		$reqKeteranganBUP= $this->input->post("reqKeteranganBUP");
		$reqKredit= $this->input->post("reqKredit");
		$reqTentangJabatan= $this->input->post("reqTentangJabatan");
		$reqJenisJabatan= $this->input->post("reqJenisJabatan");
		$reqKodeJabatan= $this->input->post("reqKodeJabatan");
		$reqSatker= $this->input->post("reqSatker");

		$set = new RiwayatJabatan();
		$set->setField('NO_SK', $reqNoSK);
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTglSK));
		$set->setField('NAMA', $reqNamaJabatan);
		$set->setField('TMT_JABATAN', dateToDBCheck($reqTMTJabatan));
		$set->setField('ESELON_ID', $reqEselon);
		$set->setField('TMT_ESELON', dateToDBCheck($reqTMTEselon));
		$set->setField('PEJABAT_PENETAP_ID', $reqPjPenetap);
		$set->setField('NO_PELANTIKAN', $reqNoPelantikan);
		$set->setField('TANGGAL_PELANTIKAN', dateToDBCheck($reqTglPelantikan));
		$set->setField('TUNJANGAN', $reqTunjangan);
		$set->setField('BULAN_DIBAYAR', dateToDBCheck($reqBlnDibayar));			
		$set->setField('KETERANGAN_BUP', $reqKeteranganBUP);
		$set->setField('ANGKA_KREDIT', ValToNullDB(dotToNo($reqKredit)));
		$set->setField('TENTANG_JABATAN', $reqTentangJabatan);
		$set->setField('JENIS_JABATAN', $reqJenisJabatan);
		$set->setField('KODE_JABATAN', $reqKodeJabatan);
		$set->setField('SATKER', $reqSatker);

		$set->setField('PEGAWAI_ID', $reqId);
		$set->setField('JABATAN_RIWAYAT_ID', $reqRowId);

		$adminusernama= $this->adminuserloginnama;
		$userSatkerId= $this->adminsatkerid;

		$reqSimpan= "";
		if ($reqRowId == "")
		{

			$set->setField("LAST_CREATE_USER", $adminusernama);
			$set->setField("LAST_CREATE_DATE", "NOW()");	
			$set->setField("LAST_CREATE_SATKER", $userSatkerId);
	
			if($set->insert())
			{
				$reqRowId=$set->id;
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

		if($reqSimpan == 1)
		{
			// untuk simpan file
			$vpost= $this->input->post();
			$vsimpanfilepegawai= new globalfilepegawai();
			$vsimpanfilepegawai->simpanfilepegawai($vpost, $reqRowId, $reqLinkFile);

			echo json_response(200, $reqRowId."-Data berhasil disimpan.");
		}
		else
		{
			echo json_response(400, "Data gagal disimpan");
		}
	}

	function delete()
	{
		$this->load->model("base/RiwayatJabatan");
		$set = new RiwayatJabatan();
		
		$reqRowId= $this->input->get('reqRowId');
		$reqMode=  $this->input->get('reqMode');

		$set->setField("JABATAN_RIWAYAT_ID", $reqRowId);
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