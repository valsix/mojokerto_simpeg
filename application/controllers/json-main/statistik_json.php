<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once("functions/string.func.php");
include_once("functions/date.func.php");
include_once("functions/class-list-util.php");
include_once("functions/class-list-util-serverside.php");

class statistik_json extends CI_Controller {

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

	function golongan_ruang()
	{
		$this->load->model("base/Statistik");

		$reqSatkerId= $this->input->get("reqSatkerId");
		// $tempSatuanKerjaId= $reqSatkerId;

		$statement= "";

		$vreturn= []; $result= []; $kategori= [];
		$index_data= 0;

		$set = new Statistik();
		$set->selectByParamsGolonganPangkat($statementAktif.$statement);
		// echo $set->query;exit;

		$vtabel='
		<table class="table table-bordered table-hover table-checkable">
		<thead>
			<tr>
				<th>Golongan Ruang</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
		';

		$vtotal= 0;
		while($set->nextRow())
		{
			$vnama= $set->getField("NAMA");
			$vjumlah= $set->getField("JUMLAH");
			$vtabel.='
				<tr class="md-text">
					<td>'.$vnama.'</td>
					<td>'.$vjumlah.'</td>
				</tr>
			';
			$vtotal+= $vjumlah;

			$arrdata= [];
			$arrdata["NAMA"]= $vnama;
			$arrdata["JUMLAH"]= $vjumlah;
			array_push($vreturn, $arrdata);
		}
			
		$vtabel.='
		<tr>
			<td>Total</td>
			<td>'.$vtotal.'</td>
		</tr>
		</tbody>
		</table>
        ';

		$jumlah_data= count($vreturn);
		// print_r($vreturn);exit;
		
		for($index=0; $index < $jumlah_data; $index++)
		{
			$vnama= $vreturn[$index]["NAMA"];
			$vjumlah= $vreturn[$index]["JUMLAH"];

			$kategori[$index]= $vnama;
			
			$vdetildata= [];
			$rows['name']= $vnama;
			for($index_detil=0; $index_detil < $jumlah_data; $index_detil++)
			{
				if($index_detil == $index)
				{
					$vjumlahDetil= (int)$vjumlah;
				}
				else
				$vjumlahDetil= null;
				
				$vdetildata[$index_detil]= $vjumlahDetil;
			}
			
			$rows['data']= $vdetildata;
			array_push($result, $rows);
		}

        // echo $vtabel;exit;
        echo json_encode(array("tabel"=>$vtabel, "kategori"=>$kategori, "result"=>$result));
	}

	function eselon()
	{
		$this->load->model("base/Statistik");

		$reqSatkerId= $this->input->get("reqSatkerId");
		// $tempSatuanKerjaId= $reqSatkerId;

		$statement= "";

		$vreturn= []; $result= []; $kategori= [];
		$index_data= 0;

		$set = new Statistik();
		$set->selectByParamsEselon($statementAktif.$statement);
		// echo $set->query;exit;

		$vtabel='
		<table class="table table-bordered table-hover table-checkable">
		<thead>
			<tr>
				<th>Golongan Ruang</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
		';

		$vtotal= 0;
		while($set->nextRow())
		{
			$vnama= $set->getField("NAMA");
			$vjumlah= $set->getField("JUMLAH");
			$vtabel.='
				<tr class="md-text">
					<td>'.$vnama.'</td>
					<td>'.$vjumlah.'</td>
				</tr>
			';
			$vtotal+= $vjumlah;

			$arrdata= [];
			$arrdata["NAMA"]= $vnama;
			$arrdata["JUMLAH"]= $vjumlah;
			array_push($vreturn, $arrdata);
		}
			
		$vtabel.='
		<tr>
			<td>Total</td>
			<td>'.$vtotal.'</td>
		</tr>
		</tbody>
		</table>
        ';

		$jumlah_data= count($vreturn);
		// print_r($vreturn);exit;
		
		for($index=0; $index < $jumlah_data; $index++)
		{
			$vnama= $vreturn[$index]["NAMA"];
			$vjumlah= $vreturn[$index]["JUMLAH"];

			$kategori[$index]= $vnama;
			
			$vdetildata= [];
			$rows['name']= $vnama;
			for($index_detil=0; $index_detil < $jumlah_data; $index_detil++)
			{
				if($index_detil == $index)
				{
					$vjumlahDetil= (int)$vjumlah;
				}
				else
				$vjumlahDetil= null;
				
				$vdetildata[$index_detil]= $vjumlahDetil;
			}
			
			$rows['data']= $vdetildata;
			array_push($result, $rows);
		}

        // echo $vtabel;exit;
        echo json_encode(array("tabel"=>$vtabel, "kategori"=>$kategori, "result"=>$result));
	}

	function pendidikan()
	{
		$this->load->model("base/Statistik");

		$reqSatkerId= $this->input->get("reqSatkerId");
		// $tempSatuanKerjaId= $reqSatkerId;

		$statement= "";

		$vreturn= []; $result= []; $kategori= [];
		$index_data= 0;

		$set = new Statistik();
		$set->selectByParamsPendidikan($statementAktif.$statement);
		// echo $set->query;exit;

		$vtabel='
		<table class="table table-bordered table-hover table-checkable">
		<thead>
			<tr>
				<th>Golongan Ruang</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
		';

		$vtotal= 0;
		while($set->nextRow())
		{
			$vnama= $set->getField("NAMA");
			$vjumlah= $set->getField("JUMLAH");
			$vtabel.='
				<tr class="md-text">
					<td>'.$vnama.'</td>
					<td>'.$vjumlah.'</td>
				</tr>
			';
			$vtotal+= $vjumlah;

			$arrdata= [];
			$arrdata["NAMA"]= $vnama;
			$arrdata["JUMLAH"]= $vjumlah;
			array_push($vreturn, $arrdata);
		}
			
		$vtabel.='
		<tr>
			<td>Total</td>
			<td>'.$vtotal.'</td>
		</tr>
		</tbody>
		</table>
        ';

		$jumlah_data= count($vreturn);
		// print_r($vreturn);exit;
		
		for($index=0; $index < $jumlah_data; $index++)
		{
			$vnama= $vreturn[$index]["NAMA"];
			$vjumlah= $vreturn[$index]["JUMLAH"];

			$kategori[$index]= $vnama;
			
			$vdetildata= [];
			$rows['name']= $vnama;
			for($index_detil=0; $index_detil < $jumlah_data; $index_detil++)
			{
				if($index_detil == $index)
				{
					$vjumlahDetil= (int)$vjumlah;
				}
				else
				$vjumlahDetil= null;
				
				$vdetildata[$index_detil]= $vjumlahDetil;
			}
			
			$rows['data']= $vdetildata;
			array_push($result, $rows);
		}

        // echo $vtabel;exit;
        echo json_encode(array("tabel"=>$vtabel, "kategori"=>$kategori, "result"=>$result));
	}

	function jenis_kelamin()
	{
		$this->load->model("base/Statistik");

		$reqSatkerId= $this->input->get("reqSatkerId");
		// $tempSatuanKerjaId= $reqSatkerId;

		$statement= "";

		$vreturn= []; $result= []; $kategori= [];
		$index_data= 0;

		$set = new Statistik();
		$set->selectByParamsJenisKelamin($statementAktif.$statement);
		// echo $set->query;exit;

		$vtabel='
		<table class="table table-bordered table-hover table-checkable">
		<thead>
			<tr>
				<th>Golongan Ruang</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
		';

		$vtotal= 0;
		while($set->nextRow())
		{
			$vnama= $set->getField("NAMA");
			$vjumlah= $set->getField("JUMLAH");
			$vtabel.='
				<tr class="md-text">
					<td>'.$vnama.'</td>
					<td>'.$vjumlah.'</td>
				</tr>
			';
			$vtotal+= $vjumlah;

			$arrdata= [];
			$arrdata["NAMA"]= $vnama;
			$arrdata["JUMLAH"]= $vjumlah;
			array_push($vreturn, $arrdata);
		}
			
		$vtabel.='
		<tr>
			<td>Total</td>
			<td>'.$vtotal.'</td>
		</tr>
		</tbody>
		</table>
        ';

		$jumlah_data= count($vreturn);
		// print_r($vreturn);exit;
		
		for($index=0; $index < $jumlah_data; $index++)
		{
			$vnama= $vreturn[$index]["NAMA"];
			$vjumlah= $vreturn[$index]["JUMLAH"];

			$kategori[$index]= $vnama;
			
			$vdetildata= [];
			$rows['name']= $vnama;
			for($index_detil=0; $index_detil < $jumlah_data; $index_detil++)
			{
				if($index_detil == $index)
				{
					$vjumlahDetil= (int)$vjumlah;
				}
				else
				$vjumlahDetil= null;
				
				$vdetildata[$index_detil]= $vjumlahDetil;
			}
			
			$rows['data']= $vdetildata;
			array_push($result, $rows);
		}

        // echo $vtabel;exit;
        echo json_encode(array("tabel"=>$vtabel, "kategori"=>$kategori, "result"=>$result));
	}

	function agama()
	{
		$this->load->model("base/Statistik");

		$reqSatkerId= $this->input->get("reqSatkerId");
		// $tempSatuanKerjaId= $reqSatkerId;

		$statement= "";

		$vreturn= []; $result= []; $kategori= [];
		$index_data= 0;

		$set = new Statistik();
		$set->selectByParamsAgama($statementAktif.$statement);
		// echo $set->query;exit;

		$vtabel='
		<table class="table table-bordered table-hover table-checkable">
		<thead>
			<tr>
				<th>Golongan Ruang</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
		';

		$vtotal= 0;
		while($set->nextRow())
		{
			$vnama= $set->getField("NAMA");
			$vjumlah= $set->getField("JUMLAH");
			$vtabel.='
				<tr class="md-text">
					<td>'.$vnama.'</td>
					<td>'.$vjumlah.'</td>
				</tr>
			';
			$vtotal+= $vjumlah;

			$arrdata= [];
			$arrdata["NAMA"]= $vnama;
			$arrdata["JUMLAH"]= $vjumlah;
			array_push($vreturn, $arrdata);
		}
			
		$vtabel.='
		<tr>
			<td>Total</td>
			<td>'.$vtotal.'</td>
		</tr>
		</tbody>
		</table>
        ';

		$jumlah_data= count($vreturn);
		// print_r($vreturn);exit;
		
		for($index=0; $index < $jumlah_data; $index++)
		{
			$vnama= $vreturn[$index]["NAMA"];
			$vjumlah= $vreturn[$index]["JUMLAH"];

			$kategori[$index]= $vnama;
			
			$vdetildata= [];
			$rows['name']= $vnama;
			for($index_detil=0; $index_detil < $jumlah_data; $index_detil++)
			{
				if($index_detil == $index)
				{
					$vjumlahDetil= (int)$vjumlah;
				}
				else
				$vjumlahDetil= null;
				
				$vdetildata[$index_detil]= $vjumlahDetil;
			}
			
			$rows['data']= $vdetildata;
			array_push($result, $rows);
		}

        // echo $vtabel;exit;
        echo json_encode(array("tabel"=>$vtabel, "kategori"=>$kategori, "result"=>$result));
	}

	function umur()
	{
		$this->load->model("base/Statistik");

		$reqSatkerId= $this->input->get("reqSatkerId");
		// $tempSatuanKerjaId= $reqSatkerId;

		$statement= "";

		$vreturn= []; $result= []; $kategori= [];
		$index_data= 0;

		$set = new Statistik();
		$set->selectByParamsUmur($statementAktif.$statement);
		// echo $set->query;exit;

		$vtabel='
		<table class="table table-bordered table-hover table-checkable">
		<thead>
			<tr>
				<th>Golongan Ruang</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
		';

		$vtotal= 0;
		while($set->nextRow())
		{
			$vnama= $set->getField("NAMA");
			$vjumlah= $set->getField("JUMLAH");
			$vtabel.='
				<tr class="md-text">
					<td>'.$vnama.'</td>
					<td>'.$vjumlah.'</td>
				</tr>
			';
			$vtotal+= $vjumlah;

			$arrdata= [];
			$arrdata["NAMA"]= $vnama;
			$arrdata["JUMLAH"]= $vjumlah;
			array_push($vreturn, $arrdata);
		}
			
		$vtabel.='
		<tr>
			<td>Total</td>
			<td>'.$vtotal.'</td>
		</tr>
		</tbody>
		</table>
        ';

		$jumlah_data= count($vreturn);
		// print_r($vreturn);exit;
		
		for($index=0; $index < $jumlah_data; $index++)
		{
			$vnama= $vreturn[$index]["NAMA"];
			$vjumlah= $vreturn[$index]["JUMLAH"];

			$kategori[$index]= $vnama;
			
			$vdetildata= [];
			$rows['name']= $vnama;
			for($index_detil=0; $index_detil < $jumlah_data; $index_detil++)
			{
				if($index_detil == $index)
				{
					$vjumlahDetil= (int)$vjumlah;
				}
				else
				$vjumlahDetil= null;
				
				$vdetildata[$index_detil]= $vjumlahDetil;
			}
			
			$rows['data']= $vdetildata;
			array_push($result, $rows);
		}

        // echo $vtabel;exit;
        echo json_encode(array("tabel"=>$vtabel, "kategori"=>$kategori, "result"=>$result));
	}

	function tipe_pegawai()
	{
		$this->load->model("base/Statistik");

		$reqSatkerId= $this->input->get("reqSatkerId");
		// $tempSatuanKerjaId= $reqSatkerId;

		$statement= "";

		$vreturn= []; $result= []; $kategori= [];
		$index_data= 0;

		$set = new Statistik();
		$set->selectByParamsTipePegawai($statementAktif.$statement);
		// echo $set->query;exit;

		$vtabel='
		<table class="table table-bordered table-hover table-checkable">
		<thead>
			<tr>
				<th>Golongan Ruang</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
		';

		$vtotal= 0;
		while($set->nextRow())
		{
			$vnama= $set->getField("NAMA");
			$vjumlah= $set->getField("JUMLAH");
			$vtabel.='
				<tr class="md-text">
					<td>'.$vnama.'</td>
					<td>'.$vjumlah.'</td>
				</tr>
			';
			$vtotal+= $vjumlah;

			$arrdata= [];
			$arrdata["NAMA"]= $vnama;
			$arrdata["JUMLAH"]= $vjumlah;
			array_push($vreturn, $arrdata);
		}
			
		$vtabel.='
		<tr>
			<td>Total</td>
			<td>'.$vtotal.'</td>
		</tr>
		</tbody>
		</table>
        ';

		$jumlah_data= count($vreturn);
		// print_r($vreturn);exit;
		
		for($index=0; $index < $jumlah_data; $index++)
		{
			$vnama= $vreturn[$index]["NAMA"];
			$vjumlah= $vreturn[$index]["JUMLAH"];

			$kategori[$index]= $vnama;
			
			$vdetildata= [];
			$rows['name']= $vnama;
			for($index_detil=0; $index_detil < $jumlah_data; $index_detil++)
			{
				if($index_detil == $index)
				{
					$vjumlahDetil= (int)$vjumlah;
				}
				else
				$vjumlahDetil= null;
				
				$vdetildata[$index_detil]= $vjumlahDetil;
			}
			
			$rows['data']= $vdetildata;
			array_push($result, $rows);
		}

        // echo $vtabel;exit;
        echo json_encode(array("tabel"=>$vtabel, "kategori"=>$kategori, "result"=>$result));
	}
}