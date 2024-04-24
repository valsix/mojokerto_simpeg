<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class masa_kerja_json extends CI_Controller {

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

	function add()
	{
		$this->load->model("base/TambahanMasaKerja");

		$reqId= $this->input->post("reqId");
		$reqRowId= $this->input->post("reqRowId");
		$reqMode= $this->input->post("reqMode");

		$reqPegawaiId= $this->input->post("reqId");

		$reqNoSK= $this->input->post("reqNoSK");
		$reqTglSK= $this->input->post("reqTglSK");
		$reqTMTSK= $this->input->post("reqTMTSK");
		$reqTambahanMasaKerja= $this->input->post("reqTambahanMasaKerja");
		$reqMasaKerja= $this->input->post("reqMasaKerja");
		$reqThTMK= $this->input->post("reqThTMK");
		$reqThMK= $this->input->post("reqThMK");
		$reqBlTMK= $this->input->post("reqBlTMK");
		$reqBlMK= $this->input->post("reqBlMK");

		$set = new TambahanMasaKerja();
		$set->setField('TAMBAHAN_MASA_KERJA_ID', $reqRowId);		
		$set->setField('NO_SK', $reqNoSK);
		$set->setField('PEGAWAI_ID', $reqId);		
		$set->setField('TANGGAL_SK', dateToDBCheck($reqTglSK));		
		$set->setField('TMT_SK', dateToDBCheck($reqTMTSK));
		$set->setField('TAHUN_TAMBAHAN', $reqThTMK);
		$set->setField('TAHUN_BARU', $reqThMK);
		$set->setField('BULAN_TAMBAHAN', $reqBlTMK);
		$set->setField('BULAN_BARU', $reqBlMK);
		
		$adminusernama= $this->adminuserloginnama;
		$userSatkerId= $this->adminsatkerid;
		
		$reqSimpan= "";
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

		if($reqSimpan == 1)
		{
			echo json_response(200, $reqRowId."-Data berhasil disimpan.");
		}
		else
		{
			echo json_response(400, "Data gagal disimpan");
		}
				
	}

}
?>