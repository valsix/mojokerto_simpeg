<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class general extends CI_Controller {

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

	function hapusdata()
	{
		$this->load->model("base-validasi/DataHapus");

		$reqRowId= $this->input->get("reqRowId");
		$reqPegawaiId= $this->input->get("reqPegawaiId");
		$reqTable= $this->input->get("reqTable");
		$reqStatus= $this->input->get("reqStatus");
		$cekquery= $this->input->get("c");

		$set= new DataHapus();
		if($reqStatus == "1")
        {
            $set->setField("HAPUS_NAMA", strtoupper($reqTable));
            $set->setField("PEGAWAI_ID", $reqPegawaiId);
            $set->setField("TEMP_VALIDASI_ID", $reqRowId);
            $set->setField("LAST_CREATE_USER", $lastuser);
            if($set->inserthapusdata())
            {
                $inforeturn= 1;
                echo json_response(200, 'Data berhasil dihapus');exit;
            }
        }
        elseif($reqStatus == "2")
        {
            $set->setField("HAPUS_NAMA", strtoupper($reqTable));
            $set->setField("TEMP_VALIDASI_ID", $reqRowId);
            if($set->deletehapusdata())
            {
                $inforeturn= 1;
                echo json_response(200, 'Data berhasil di batalkan');exit;
            }
        }
        else
        {
            $set->setField("TABLE", $reqTable);
            $set->setField("TEMP_VALIDASI_ID", $reqRowId);

            if($set->hapusdata())
            {
                $inforeturn= 1;
                echo json_response(200, 'Data berhasil di batalkan');exit;
            }
        }

        if(!empty($cekquery))
        {
        	echo $set->query;exit;
        }

        echo $inforeturn;
	}
}