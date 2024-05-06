<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once("functions/image.func.php");
include_once("functions/string.func.php");
include_once("functions/date.func.php");

class login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		//kauth
		// $this->load->library('session');

		$CI =& get_instance();
		$configdata= $CI->config;
        $configvlxsessfolder= $configdata->config["vlxsessfolder"];

		$this->sessinfopesan= $this->session->userdata("sessinfopesan".$configvlxsessfolder);
		$this->pegawaiId= $this->session->userdata("userpegawaiId".$configvlxsessfolder);
		$this->userpegawaiNama= $this->session->userdata("userpegawaiNama".$configvlxsessfolder);
		$this->userstatuspegId= $this->session->userdata("userstatuspegId".$configvlxsessfolder);
	}

	public function index()
	{
		$CI =& get_instance();
		$configdata= $CI->config;
        $configvlxsessfolder= $configdata->config["vlxsessfolder"];
		$genertecaptcha= $this->genertecaptcha();

		$this->session->set_userdata('sessvgenertecaptcha', $genertecaptcha);
		$this->sessvgenertecaptcha= $this->session->userdata("sessvgenertecaptcha");
		// $_SESSION["sessvgenertecaptcha"]= $genertecaptcha;

		$this->session->set_userdata('sessinfopesan'.$configvlxsessfolder, "");
		$data['pesan']="";
        // echo $genertecaptcha;exit;

		$pg= "login";
		$data = array(
			'content' => $this->load->view("main/".$pg,$view,TRUE),
			'pg' => $pg
		);
		$this->load->view('main/index', $data);
	}

	function action()
	{
		$this->load->library("crfs_protect"); 
		$csrf = new crfs_protect('_crfs_login');
		// print_r($csrf);exit;
		
		if (!$csrf->isTokenValid($_POST['_crfs_login']))
		{
		?>
			<script language="javascript">
				alert('<?=$respon?>');
				document.location.href = 'logout';
			</script>
		<?
			exit();
		}

		$CI =& get_instance();
		$configdata= $CI->config;
        $configvlxsessfolder= $configdata->config["vlxsessfolder"];
		
		$reqUser= $this->input->post("reqUser");
		$reqPasswd= $this->input->post("reqPasswd");
		$reqCaptcha= $this->input->post("reqCaptcha");
		$reqNewCaptcha= $this->input->post("reqNewCaptcha");
		// echo $_SESSION['security_code'];exit;
		
		if($reqCaptcha != $reqNewCaptcha)
    	{
    		$this->session->set_userdata('sessinfopesan'.$configvlxsessfolder, "Captcha tidak sesuai.");
			redirect ('login');
    	}

		if(!empty($reqUser) AND !empty($reqPasswd))
		{
			$respon = $this->kauth->cekuserloginpersonal($reqUser,$reqPasswd);
			// print_r($respon);exit;
			
			if($respon == "0")
			{
				$this->session->set_userdata('sessinfopesan'.$configvlxsessfolder, "Username dan password tidak sesuai.");
				redirect ('login');
			}
			else if($respon == "1")
			{
				redirect('app');
			}
			else
			{
				$this->session->set_userdata('sessinfopesan'.$configvlxsessfolder, $respon);
				redirect ('login');
			}
		}
		else
		{
			$this->session->set_userdata('sessinfopesan'.$configvlxsessfolder, "Masukkan username dan password.");
			// $data['pesan']="Masukkan username dan password.";
			// $this->load->view('main/login', $data);
			redirect ('login');
		}
	}

	public function logout()
	{
		$this->kauth->unsetcekuserloginpersonal();
		// $this->session->sess_destroy();
		redirect ('login');
	}

	function genertecaptcha(){
		$color= substr(uniqid(),-2);
		$vreturn= strtoupper(substr(md5($color), 0,5));
		return $vreturn;
	}

	function captcha(){
		$genertecaptcha= $this->genertecaptcha();
		$this->session->set_userdata("sessvgenertecaptcha", $genertecaptcha);
		echo $genertecaptcha;
	}
}