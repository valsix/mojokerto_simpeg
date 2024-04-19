<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once("functions/image.func.php");
include_once("functions/string.func.php");

class Export extends CI_Controller {
	
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

		$this->session->set_userdata("dynatr", $_SESSION["dynatr"]);
		$this->dynatr= $_SESSION["dynatr"];

		$this->session->set_userdata("dynafield", $_SESSION["dynafield"]);
		$this->dynafield= $_SESSION["dynafield"];

		$this->session->set_userdata("dynaorder", $_SESSION["dynaorder"]);
		$this->dynaorder= $_SESSION["dynaorder"];

		$this->session->set_userdata("dynawhere", $_SESSION["dynawhere"]);
		$this->dynawhere= $_SESSION["dynawhere"];
	}
	
	public function index()
	{
		$pg = $this->uri->segment(3, "home");
		$reqId = $this->input->get("reqId");

		$view = array(
			'pg' => $pg
		);	
		// print_r($view);exit;
		$data = array(
			// 'breadcrumb' => $breadcrumb,
			'content' => $this->load->view("main/".$pg,$view,TRUE),
			'pg' => $pg
		);	
		
		$this->load->view('export/index', $data);
	}

	public function loadUrl()
	{
		$reqFolder = $this->uri->segment(3, "");
		$reqFilename = $this->uri->segment(4, "");
		$reqParse1 = $this->uri->segment(5, "");
		$reqParse2 = $this->uri->segment(6, "");
		$reqParse3 = $this->uri->segment(7, "");
		$reqParse4 = $this->uri->segment(8, "");
		$reqParse5 = $this->uri->segment(9, "");
		$data = array(
			'reqParse1' => urldecode($reqParse1),
			'reqParse2' => urldecode($reqParse2),
			'reqParse3' => urldecode($reqParse3),
			'reqParse4' => urldecode($reqParse4),
			'reqParse5' => urldecode($reqParse5)
		);

		// if($reqFolder == "app")
		// 	$this->session->set_userdata('currentUrl', $reqFilename);

		$this->load->view($reqFolder.'/'.$reqFilename, $data);
	}
	
	public function logout()
	{
		// $this->kauth->unsetcekuseradminlogin();
		// redirect ('login');
	}
}