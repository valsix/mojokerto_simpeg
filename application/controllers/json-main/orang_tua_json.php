<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class orang_tua_json extends CI_Controller {

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
		$this->load->model("base/OrangTua");

		$jumlahsimpan= 0;
		$reqId= $this->input->post("reqId");
		$adminusernama= $this->adminuserloginnama;
		$userSatkerId= $this->adminsatkerid;

		$vjeniskelamin= "L";
		$statement= " AND A.PEGAWAI_ID = ".$reqId." AND A.JENIS_KELAMIN = '".$vjeniskelamin."'";
		$set= new OrangTua();
		$set->selectByParams(array(), -1, -1, $statement);
		// echo $set->query;exit;
		$set->firstRow();
		$reqAyahId= $set->getField('ORANG_TUA_ID');

		if(empty($reqAyahId))
		{
			$reqMode="insert";
		}
		else
		{
			$reqMode="update";
		}

		$reqNamaAyah= $this->input->post("reqNamaAyah");
		$reqTempatLahirAyah= $this->input->post("reqTempatLahirAyah");
		$reqTglLahirAyah= $this->input->post("reqTglLahirAyah");
		$reqUsiaAyah= $this->input->post("reqUsiaAyah");
		$reqPekerjaanAyah= $this->input->post("reqPekerjaanAyah");
		$reqAlamatAyah= $this->input->post("reqAlamatAyah");
		$reqPropinsiAyah= $this->input->post("reqPropinsiAyah");
		$reqKabupatenAyah= $this->input->post("reqKabupatenAyah");
		$reqKecamatanAyah= $this->input->post("reqKecamatanAyah");
		$reqDesaAyah= $this->input->post("reqDesaAyah");
		$reqKodePosAyah= $this->input->post("reqKodePosAyah");
		$reqTeleponAyah= $this->input->post("reqTeleponAyah");

		$reqKabupatenarr=explode("*", $reqKabupatenAyah);
		if (is_array($reqKabupatenarr)) {
			$reqKabupatenAyah= $reqKabupatenarr[0];
		}

		$reqKecamatanarr=explode("*", $reqKecamatanAyah);
		if (is_array($reqKecamatanarr)) {
			$reqKecamatanAyah= $reqKecamatanarr[0];
		}

		$reqDesaarr=explode("*", $reqDesaAyah);
		if (is_array($reqDesaarr)) {
			$reqDesaAyah= $reqDesaarr[0];
		}

		$set = new OrangTua();
		$set->setField('PEGAWAI_ID', $reqId);
		$set->setField("ORANG_TUA_ID", (int)$reqAyahId);
		$set->setField("JENIS_KELAMIN", $vjeniskelamin);
		$set->setField("NAMA", setQuote($reqNamaAyah));
		$set->setField("TEMPAT_LAHIR", $reqTempatLahirAyah);
		$set->setField("TANGGAL_LAHIR", dateToDBCheck($reqTglLahirAyah));
		$set->setField("PEKERJAAN", setQuote($reqPekerjaanAyah));
		$set->setField("ALAMAT", setQuote($reqAlamatAyah));
		$set->setField("KODEPOS", $reqKodePosAyah);
		$set->setField("TELEPON", $reqTeleponAyah);
		$set->setField("PROPINSI_ID", ValToNullDB($reqPropinsiAyah));
		$set->setField("KABUPATEN_ID", ValToNullDB($reqKabupatenAyah));
		$set->setField("KECAMATAN_ID", ValToNullDB($reqKecamatanAyah));
		$set->setField("KELURAHAN_ID", ValToNullDB($reqDesaAyah));

		if ($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $adminusernama);
			$set->setField("LAST_CREATE_DATE", "NOW()");	
			$set->setField("LAST_CREATE_SATKER", $userSatkerId);
	
			if($set->insert())
			{
				$jumlahsimpan++;
			}
		}
		else
		{	
			$set->setField("LAST_UPDATE_USER", $adminusernama);
			$set->setField("LAST_UPDATE_DATE", "NOW()");	
			$set->setField("LAST_UPDATE_SATKER", $userSatkerId);
			if($set->update())
			{
				$jumlahsimpan++;
			}
		}

		$vjeniskelamin= "P";
		$statement= " AND A.PEGAWAI_ID = ".$reqId." AND A.JENIS_KELAMIN = '".$vjeniskelamin."'";
		$set= new OrangTua();
		$set->selectByParams(array(), -1, -1, $statement);
		// echo $set->query;exit;
		$set->firstRow();
		$reqIbuId= $set->getField('ORANG_TUA_ID');

		if(empty($reqIbuId))
		{
			$reqMode="insert";
		}
		else
		{
			$reqMode="update";
		}

		$reqNamaIbu= $this->input->post("reqNamaIbu");
		$reqTempatLahirIbu= $this->input->post("reqTempatLahirIbu");
		$reqTglLahirIbu= $this->input->post("reqTglLahirIbu");
		$reqUsiaIbu= $this->input->post("reqUsiaIbu");
		$reqPekerjaanIbu= $this->input->post("reqPekerjaanIbu");
		$reqAlamatIbu= $this->input->post("reqAlamatIbu");
		$reqPropinsiIbu= $this->input->post("reqPropinsiIbu");
		$reqKabupatenIbu= $this->input->post("reqKabupatenIbu");
		$reqKecamatanIbu= $this->input->post("reqKecamatanIbu");
		$reqDesaIbu= $this->input->post("reqDesaIbu");
		$reqKodePosIbu= $this->input->post("reqKodePosIbu");
		$reqTeleponIbu= $this->input->post("reqTeleponIbu");

		$reqKabupatenarr=explode("*", $reqKabupatenIbu);
		if (is_array($reqKabupatenarr)) {
			$reqKabupatenIbu= $reqKabupatenarr[0];
		}

		$reqKecamatanarr=explode("*", $reqKecamatanIbu);
		if (is_array($reqKecamatanarr)) {
			$reqKecamatanIbu= $reqKecamatanarr[0];
		}

		$reqDesaarr=explode("*", $reqDesaIbu);
		if (is_array($reqDesaarr)) {
			$reqDesaIbu= $reqDesaarr[0];
		}

		$set = new OrangTua();
		$set->setField('PEGAWAI_ID', $reqId);
		$set->setField("ORANG_TUA_ID", (int)$reqIbuId);
		$set->setField("JENIS_KELAMIN", $vjeniskelamin);
		$set->setField("NAMA", setQuote($reqNamaIbu));
		$set->setField("TEMPAT_LAHIR", $reqTempatLahirIbu);
		$set->setField("TANGGAL_LAHIR", dateToDBCheck($reqTglLahirIbu));
		$set->setField("PEKERJAAN", setQuote($reqPekerjaanIbu));
		$set->setField("ALAMAT", setQuote($reqAlamatIbu));
		$set->setField("KODEPOS", $reqKodePosIbu);
		$set->setField("TELEPON", $reqTeleponIbu);
		$set->setField("PROPINSI_ID", ValToNullDB($reqPropinsiIbu));
		$set->setField("KABUPATEN_ID", ValToNullDB($reqKabupatenIbu));
		$set->setField("KECAMATAN_ID", ValToNullDB($reqKecamatanIbu));
		$set->setField("KELURAHAN_ID", ValToNullDB($reqDesaIbu));
		
		if ($reqMode == "insert")
		{
			$set->setField("LAST_CREATE_USER", $adminusernama);
			$set->setField("LAST_CREATE_DATE", "NOW()");	
			$set->setField("LAST_CREATE_SATKER", $userSatkerId);
	
			if($set->insert())
			{
				$jumlahsimpan++;
			}
		}
		else
		{	
			$set->setField("LAST_UPDATE_USER", $adminusernama);
			$set->setField("LAST_UPDATE_DATE", "NOW()");	
			$set->setField("LAST_UPDATE_SATKER", $userSatkerId);
			if($set->update())
			{
				$jumlahsimpan++;
			}
		}

		if($jumlahsimpan == 2)
		{
			echo json_response(200, $reqId."-Data berhasil disimpan.");
		}
		else
		{
			echo json_response(400, "Data gagal disimpan");
		}
				
	}

}
?>