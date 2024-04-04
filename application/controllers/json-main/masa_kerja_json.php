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

	

	function add()
	{
		$this->load->model("base/TambahanMasaKerja");

		$reqId= $this->input->post("reqId");
		$reqRowId= $this->input->post("reqRowId");
		$reqMode= $this->input->post("reqMode");

		$reqPegawaiId	= $this->input->post("reqId");

		$reqNoSK				= $this->input->post("reqNoSK");
		$reqTglSK				= $this->input->post("reqTglSK");
		$reqTMTSK				= $this->input->post("reqTMTSK");
		$reqTambahanMasaKerja	= $this->input->post("reqTambahanMasaKerja");
		$reqMasaKerja			= $this->input->post("reqMasaKerja");
		$reqThTMK				= $this->input->post("reqThTMK");
		$reqThMK				= $this->input->post("reqThMK");
		$reqBlTMK				= $this->input->post("reqBlTMK");
		$reqBlMK				= $this->input->post("reqBlMK");


		// print_r($reqPejabatId);exit;

		$tamb_masa_kerja = new TambahanMasaKerja();
	
		$tamb_masa_kerja->setField('TAMBAHAN_MASA_KERJA_ID', $reqRowId);		
		$tamb_masa_kerja->setField('NO_SK', $reqNoSK);
		$tamb_masa_kerja->setField('PEGAWAI_ID', $reqId);		
		$tamb_masa_kerja->setField('TANGGAL_SK', dateToDBCheck($reqTglSK));		
		$tamb_masa_kerja->setField('TMT_SK', dateToDBCheck($reqTMTSK));
		$tamb_masa_kerja->setField('TAHUN_TAMBAHAN', $reqThTMK);
		$tamb_masa_kerja->setField('TAHUN_BARU', $reqThMK);
		$tamb_masa_kerja->setField('BULAN_TAMBAHAN', $reqBlTMK);
		$tamb_masa_kerja->setField('BULAN_BARU', $reqBlMK);
		
		$reqSimpan= "";
		if ($reqMode == "insert")
		{

			$tamb_masa_kerja->setField("LAST_CREATE_USER", $adminusernama);
			$tamb_masa_kerja->setField("LAST_CREATE_DATE", "NOW()");	
			$tamb_masa_kerja->setField("LAST_CREATE_SATKER", $userSatkerId);
	
			if($tamb_masa_kerja->insert())
			{
				$reqSimpan= 1;
			}
		}
		else
		{	
			$tamb_masa_kerja->setField("LAST_UPDATE_USER", $adminusernama);
			$tamb_masa_kerja->setField("LAST_UPDATE_DATE", "NOW()");	
			$tamb_masa_kerja->setField("LAST_UPDATE_SATKER", $userSatkerId);
			if($tamb_masa_kerja->update())
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