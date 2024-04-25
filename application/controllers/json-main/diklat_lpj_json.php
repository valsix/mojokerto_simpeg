<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class diklat_lpj_json extends CI_Controller {

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
		$this->load->model("base/DiklatLpj");

		$reqId= $this->input->post("reqId");
		$reqRowId= $this->input->post("reqRowId");

		$statement= " AND A.PEGAWAI_ID = ".$reqId;
		$set= new DiklatLpj();
		$set->selectByParams(array(), -1, -1, $statement);
		// echo $set->query;exit;
		$set->firstRow();
		$reqRowId= $set->getField('DIKLAT_LPJ_ID');

		if(empty($reqRowId))
		{
			$reqMode="insert";
		}
		else
		{
			$reqMode="update";
		}

		$reqTempat= $this->input->post("reqTempat");
		$reqPenyelenggara= $this->input->post("reqPenyelenggara");
		$reqTglMulai= $this->input->post("reqTglMulai");
		$reqNoSTTPP= $this->input->post("reqNoSTTPP");
		$reqTglSelesai= $this->input->post("reqTglSelesai");
		$reqTglSTTPP= $this->input->post("reqTglSTTPP");
		$reqJumlahJam= $this->input->post("reqJumlahJam");
		$reqAngkatan= $this->input->post("reqAngkatan");
		$reqTahun= $this->input->post("reqTahun");

		$set = new DiklatLpj();
		$set->setField("DIKLAT_LPJ_ID", $reqRowId);
		$set->setField("PEGAWAI_ID", $reqId);

		$set->setField("NAMA", $reqNamaDiklat);
		$set->setField("TEMPAT", $reqTempat);
		$set->setField("TANGGAL_STTPP", dateToDBCheck($reqTglSTTPP));
		$set->setField("PENYELENGGARA", $reqPenyelenggara);
		$set->setField("NO_STTPP", $reqNoSTTPP);
		$set->setField("TANGGAL_MULAI", dateToDBCheck($reqTglMulai));
		$set->setField("TANGGAL_SELESAI", dateToDBCheck($reqTglSelesai));
		$set->setField("JUMLAH_JAM", ValToNullDB($reqJumlahJam));
		$set->setField("ANGKATAN", ValToNullDB($reqAngkatan));
		$set->setField("TAHUN", ValToNullDB($reqTahun));
		
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