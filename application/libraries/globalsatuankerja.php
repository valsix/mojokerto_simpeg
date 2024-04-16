<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
include_once("functions/string.func.php");

class globalsatuankerja
{
	function getsessionuser()
	{
		$CI = &get_instance();

		$sessionloginlevel= $CI->kauth->getInstance()->getIdentity()->LOGIN_LEVEL;
		$sessionloginuser= $CI->kauth->getInstance()->getIdentity()->LOGIN_USER;
		$sessionloginid= $CI->kauth->getInstance()->getIdentity()->LOGIN_ID;
		$sessionloginpegawaiid= $CI->kauth->getInstance()->getIdentity()->LOGIN_PEGAWAI_ID;

		$sessionsatuankerja= $CI->kauth->getInstance()->getIdentity()->SATUAN_KERJA_ID;
		$sessionusergroup= $CI->kauth->getInstance()->getIdentity()->USER_GROUP;
		$sessionstatussatuankerjabkd= $CI->kauth->getInstance()->getIdentity()->STATUS_SATUAN_KERJA_BKD;
		$sessionaksesappsimpegid= $CI->kauth->getInstance()->getIdentity()->AKSES_APP_SIMPEG_ID;

		$arrreturn= [];
		$arrreturn["sessionloginlevel"]= $sessionloginlevel;
		$arrreturn["sessionloginuser"]= $sessionloginuser;
		$arrreturn["sessionloginid"]= $sessionloginid;
		$arrreturn["sessionloginpegawaiid"]= $sessionloginpegawaiid;
		$arrreturn["sessionsatuankerja"]= $sessionsatuankerja;
		/*$arrreturn["sessionusergroup"]= $sessionusergroup;
		$arrreturn["sessionstatussatuankerjabkd"]= $sessionstatussatuankerjabkd;
		$arrreturn["sessionaksesappsimpegid"]= $sessionaksesappsimpegid;
		$arrreturn["sessioninfosepeta"]= $sessioninfosepeta;
		// print_r($arrreturn);exit;

		$arrreturn["ttd_url"]= $CI->config->item('ttd_url');
		$arrreturn["ttd_username"]= $CI->config->item('ttd_username');
		$arrreturn["ttd_password"]= $CI->config->item('ttd_password');
		$arrreturn["ttd_enkrip"]= $CI->config->item('ttd_enkrip');
		$arrreturn["base_url"]= $CI->config->item('base_report');*/

		return $arrreturn;
	}

	function getsatuankerjadata($arrparam)
	{
		$CI = &get_instance();
		$CI->load->model("base/SatuanKerja");

		$satkerid= $arrparam["satkerid"];

		$statement="";
		if(!empty($satkerid))
		{
			$statement=" AND A.SATKER_ID LIKE '".$satkerid."%'";
		}

		$set= new SatuanKerja();
		$set->selectdata(array(), -1,-1,$statement);
		// echo $set->query;exit;

		$vreturn= [];

		$vnama= "Pemerintah Kabupaten Mojokerto";
		$arrdata["id"]= "-1";
		$arrdata["text"]= $vnama;
		$arrdata["namadetil"]= $vnama;
		array_push($vreturn, $arrdata);

		while($set->nextRow())
		{
			$vsatkerid= $set->getField("SATKER_ID");
			$arrdata= [];
			$arrdata["id"]= $vsatkerid;

			// if($vsatkerid == $satkerid)
			// 	$arrdata["parentid"]= -1;
			// else
				$arrdata["parentid"]= $set->getField("SATKER_ID_PARENT");
			$arrdata["text"]= $set->getField("NAMA");
			$arrdata["namadetil"]= $set->getField("VSATKER_NAMA_DETIL");
			array_push($vreturn, $arrdata);
		}
		unset($set);
		// print_r($vreturn);exit;
		return $vreturn;
	}

	function getsatuankerjatree($arrparam)
	{
		$CI = &get_instance();
		$CI->load->model("base/SatuanKerja");

		// $arrgetsessionuser= $this->getsessionuser();
		// print_r($arrgetsessionuser);exit;

		$satkerid= $arrparam["satkerid"];

		$statement="";
		if(!empty($satkerid))
		{
			$statement=" AND A.SATKER_ID LIKE '".$satkerid."%'";
		}

		$set= new SatuanKerja();
		$arrsatker= [];
		$set->selectdata(array(), -1,-1,$statement);
		// echo $set->query;exit;
		while($set->nextRow())
		{
			$arrdata= [];
			$arrdata["id"]= $set->getField("SATKER_ID");
			$arrdata["parentid"]= $set->getField("SATKER_ID_PARENT");
			$arrdata["text"]= $set->getField("NAMA");
			array_push($arrsatker, $arrdata);
		}
		unset($set);
		// print_r($arrsatker);exit;

		$vreturn= [];

		$arrdata= [];
		$arrdata["id"]= "-1";
		$arrdata["text"]= "Pemerintah Kabupaten Mojokerto";
		array_push($vreturn, $arrdata);

		if(!empty($satkerid))
		{
			$infocarikey= $satkerid;
			$arrcheck= in_array_column($infocarikey, "id", $arrsatker);
		}
		else
		{
			$infocarikey= "0";
			$arrcheck= in_array_column($infocarikey, "parentid", $arrsatker);
		}

		// print_r($arrcheck);exit;
		foreach ($arrcheck as $vindex)
		{
			$vid= $arrsatker[$vindex]["id"];
			$vtext= $arrsatker[$vindex]["text"];

			$arrdata= [];
			$arrdata["id"]= $vid;
			$arrdata["text"]= $vtext;

			$infocarichildkey= $vid;
			$arrchildcheck= in_array_column($infocarichildkey, "parentid", $arrsatker);
			if(!empty($arrchildcheck))
			{
				$arrdata["inc"]= $this->getchild($vid, $arrsatker);
			}
			array_push($vreturn, $arrdata);
		}
		// print_r($vreturn);exit;

		return $vreturn;
	}

	function getchild($vid, $arrsatker)
	{
		$arrdatachildjabatan= [];
		$infocarikey= $vid;
		$arrcheck= in_array_column($infocarikey, "parentid", $arrsatker);
		// print_r($arrcheck);exit;
		foreach ($arrcheck as $vindex)
		{
			$vid= $arrsatker[$vindex]["id"];
			$vtext= $arrsatker[$vindex]["text"];

			$arrdata= [];
			$arrdata["id"]= $vid;
			$arrdata["text"]= $vtext;

			$infocarichildkey= $vid;
			$arrchildcheck= in_array_column($infocarichildkey, "parentid", $arrsatker);
			if(!empty($arrchildcheck))
			{
				$arrdata["inc"]= $this->getchild($vid, $arrsatker);
			}
			array_push($arrdatachildjabatan, $arrdata);
		}
		return $arrdatachildjabatan;
	}
	
}