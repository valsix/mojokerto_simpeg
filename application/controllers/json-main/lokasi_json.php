<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class lokasi_json extends CI_Controller {

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

	function getKabupaten()
	{
		$this->load->model("base/Core");
		$kabupaten = new Core();

		$kabupaten->selectByParamsKabupaten(array('PROPINSI_ID'=>$_GET['reqPropinsiId']),-1,-1, '');
		$kab = array();
		$i=0;
		while($kabupaten->nextRow()){
			$kab[$i]['kabupaten_id'] = $kabupaten->getField('KABUPATEN_ID').'*'.$kabupaten->getField('PROPINSI_ID');
			$kab[$i]['kabupaten'] = $kabupaten->getField('NAMA');
			$i++;
		}
		echo json_encode($kab);	
	}

	function getKecamatan()
	{
		$this->load->model("base/Core");
		$kecamatan = new Core();
		$reqKabupatenId= $this->input->get('reqKabupatenId');

		$arrJsonId = explode("*", $reqKabupatenId);
		$reqKabupatenId = $arrJsonId[0];
		$reqPropinsiId = $arrJsonId[1];

		$kecamatan->selectByParamsKecamatan(array('PROPINSI_ID'=>$reqPropinsiId, 'KABUPATEN_ID'=>$reqKabupatenId),-1,-1, '');
		$kab = array();
		$i=0;
		while($kecamatan->nextRow()){
			$kab[$i]['kecamatan_id'] = $kecamatan->getField('KECAMATAN_ID').'*'.$kecamatan->getField('KABUPATEN_ID').'*'.$kecamatan->getField('PROPINSI_ID');
			$kab[$i]['kecamatan'] = $kecamatan->getField('NAMA');
			$i++;
		}
		echo json_encode($kab);
	}

	function getKelurahan()
	{
		$this->load->model("base/Core");
		$kelurahan = new Core();
		$reqKecamatanId= $this->input->get('reqKecamatanId');
		$arrJsonId = explode("*", $reqKecamatanId);
		$reqKecamatanId = $arrJsonId[0];
		$reqKabupatenId = $arrJsonId[1];
		$reqPropinsiId = $arrJsonId[2];

		$kelurahan->selectByParamsKelurahan(array('PROPINSI_ID'=>$reqPropinsiId, 'KABUPATEN_ID'=>$reqKabupatenId,'KECAMATAN_ID'=>$reqKecamatanId),-1,-1, '');
		$kab = array();
		$i=0;
		while($kelurahan->nextRow()){
			$kab[$i]['kelurahan_id'] = $kelurahan->getField('KELURAHAN_ID');
			$kab[$i]['kelurahan'] = $kelurahan->getField('NAMA');
			$i++;
		}
		echo json_encode($kab);
	}
}
?>