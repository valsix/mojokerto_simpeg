<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class combo_json extends CI_Controller {

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
	
	function autocompletepejabat()
	{
		$this->load->model("base/Core");

		$set= new Core();

		$q= $this->input->get('q');
		$page= $this->input->get('page');

		$search_term= !empty($q) ? $q : "";

		$limit= 50;
		if(empty($page))
		{
			$from= 0;
		}
		else
		{
			$from= 30*$page;
		}

		$jumlahdata= 0;
		$arrdetildata= [];
		$sorder= "ORDER BY NIP_BARU";

		$statement.= " AND NIP_BARU LIKE '%".strtoupper($search_term)."%' OR UPPER(NAMA) LIKE '%".strtoupper($search_term)."%' ";
		$jumlahdata= "";
		$set->selectByParamsPegawaiAutoComplete(array(), $limit, $from, $statement, $sorder);
		// echo $set->query;exit;
		while($set->nextRow())
		{
			$arrdata= [];
			$arrdata["id"]= $set->getField("PEGAWAI_ID");
			$arrdata["text"]= $set->getField("NIP_BARU");
			$arrdata["description"]= $set->getField("NIP_BARU");
			array_push($arrdetildata, $arrdata);
		}

		$result = [
		    'total_count' => $jumlahdata,
		    'items' => $arrdetildata,
		];

		header('Content-Type: application/json');
		echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);	
	}



}
?>