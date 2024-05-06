<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once("functions/image.func.php");
include_once("functions/string.func.php");
include_once("functions/date.func.php");
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); 
// include_once("functions/string.func.php");

class Logindata extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		// $CI =& get_instance();
		// $configdata= $CI->config;
        // $configvlxsessfolder= $configdata->config["vlxsessfolder"];
		// parent::__construct();
	}

	public function captcha()
	{
		// session_start();
		$ubah= $this->input->get('ubah');
		// print_r($this->session->userdata("sessvgenertecaptcha"));exit;
		if($ubah==1){
			$vgenertecaptcha= $this->session->userdata("sessvgenertecaptcha");

		}
		else{
			$vgenertecaptcha= $this->session->userdata("sessvgenertecaptcha");

		}
		$image= imagecreatefrompng("lib/captcha/bg.png"); // Generating CAPTCHA
		$foreground= imagecolorallocate($image, 241, 242, 233); // Font Color
		$font= 'lib/captcha/Raleway-Black.ttf';

		imagettftext($image, 20, 0, 20, 30, $foreground, $font, $vgenertecaptcha);

		header('Content-type: image/png');
		imagepng($image);
		imagedestroy($image);
	}
}