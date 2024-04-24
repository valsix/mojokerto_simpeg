<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class suami_istri_json extends CI_Controller {

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
		$this->load->model("base/SuamiIstri");

		$reqId= $this->input->post("reqId");
		$reqRowId= $this->input->post("reqRowId");
		$reqMode= $this->input->post("reqMode");

		$set= new SuamiIstri();
		$set->selectByParams(array("PEGAWAI_ID" => $reqId), -1,-1,' AND A.STATUS = 1');
		// echo $set->query;exit;
		$set->firstRow();
		$reqRowId= (int)$set->getField('SUAMI_ISTRI_ID');

		if(empty($reqRowId))
		{
			$reqMode="insert";
		}
		else
		{
			$reqMode="update";

		}

		$reqNamaSuamiIstri= $this->input->post("reqNamaSuamiIstri");
		$reqTempatLahir= $this->input->post("reqTempatLahir");
		$reqTglLahir= $this->input->post("reqTglLahir");
		$reqTglKawin= $this->input->post("reqTglKawin");
		$reqPNS= $this->input->post("reqPNS");
		$reqNIP= $this->input->post("reqNIP");
		$reqPendidikan= $this->input->post("reqPendidikan");
		$reqPekerjaan= $this->input->post("reqPekerjaan");
		$reqTunjangan= $this->input->post("reqTunjangan");
		$reqSudahDibayar= $this->input->post("reqSudahDibayar");
		$reqBulanDibayar= $this->input->post("reqBulanDibayar");
		$reqKartu= $this->input->post("reqKartu");

		$set = new SuamiIstri();
		$set->setField('SUAMI_ISTRI_ID', $reqRowId);		
		$set->setField('PEGAWAI_ID', $reqId);

		$set->setField("PENDIDIKAN_ID", ValToNullDB($reqPendidikan));
		$set->setField("NAMA", $reqNamaSuamiIstri);
		$set->setField("TEMPAT_LAHIR", $reqTempatLahir);
		$set->setField("TANGGAL_LAHIR", dateToDBCheck($reqTglLahir));
		$set->setField("TANGGAL_KAWIN", dateToDBCheck($reqTglKawin));
		$set->setField("KARTU", $reqKartu);

		$set->setField("STATUS_PNS", ValToNullDB($reqPNS));
		$set->setField("NIP_PNS", $reqNIP);
		$set->setField("PEKERJAAN", $reqPekerjaan);
		$set->setField("STATUS_TUNJANGAN", ValToNullDB($reqTunjangan));
		$set->setField("STATUS_BAYAR", ValToNullDB($reqSudahDibayar));
		$set->setField("BULAN_BAYAR", dateToDBCheck($reqBulanDibayar));
		
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