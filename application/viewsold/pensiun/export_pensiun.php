<?php
include_once("functions/string.func.php");
include_once("functions/default.func.php");
include_once("functions/date.func.php");


header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=\"data_pegawai_pensiun.xls\"");

// $CI =& get_instance();
// $CI->checkUserLogin();
$reqCari= $this->input->get('reqCari');
// print_r($reqCari);exit;

$reqPegawaiId = $this->input->get("reqPegawaiId");
$reqSatuanKerja= $this->input->get('reqSatuanKerja');
$reqTipePegawai= $this->input->get('reqTipePegawai');
$reqStatusPegawai= $this->input->get('reqStatusPegawai');
$reqTahunAwal= $this->input->get('reqTahunAwal');
$reqTahunAkhir= $this->input->get('reqTahunAkhir');


$this->load->model('base-app/Rekap');

$statement ="";
if(!empty($reqSatuanKerja))
{
  $statement.= " AND A.SATKER_ID LIKE '".$reqSatuanKerja."%' ";
}

if(!empty($reqTipePegawai))
{
  $statement.= " AND A.TIPE_PEGAWAI_NEW_ID LIKE '".$reqTipePegawai."%'";
}

if(!empty($reqCari))
{
  if (is_numeric($reqCari))
  {
    $statement.= " AND (UPPER(A.NIP_BARU) LIKE '%".strtoupper($reqCari)."%')";
  }
  else
  {
    $statement.= " AND (UPPER(A.NAMA) LIKE '%".strtoupper($reqCari)."%')";
  }
}


		if(!empty($reqTahunAwal) && empty($reqTahunAkhir) )
		{
			$statement.= " AND  TO_DATE(A.TANGGAL_PENSIUN,'DD-MM-YYYY') = TO_DATE('01-01-".$reqTahunAwal."', 'DD-MM-YYYY')  ";
		}

		if(empty($reqTahunAwal) && !empty($reqTahunAkhir) )
		{
			$statement.= " AND  TO_DATE(A.TANGGAL_PENSIUN,'DD-MM-YYYY') = TO_DATE('01-01-".$reqTahunAkhir."', 'DD-MM-YYYY')  ";
		}

		if(!empty($reqTahunAwal) && !empty($reqTahunAkhir) )
		{
			$statement.= " AND  TO_DATE(A.TANGGAL_PENSIUN,'DD-MM-YYYY') BETWEEN  TO_DATE('01-01-".$reqTahunAwal."', 'DD-MM-YYYY') AND  TO_DATE('31-12-".$reqTahunAkhir."', 'DD-MM-YYYY')  ";
		}

$judulfield= array();
$judulfield= array("NO.","Nama","NIP Baru", "Status", "Tipe Pegawai", "Gol Ruang", "Eselon", "Jabatan","Unit Kerja","Tmt Pensiun");

$field= array();
$field= array("NO","NAMA", "NIP_BARU", "STATUS_PEGAWAI_NAMA", "TIPE_PEGAWAI_NAMA", "GOL_RUANG", "ESELON", "JABATAN", "SATKER_INDUK_NAMA", "TANGGAL_PENSIUN");
 // echo $reqKodeProv;exit;

$sOrder = " ORDER BY A.TANGGAL_PENSIUN::DATE ASC";
$set = new Rekap();

$set->selectByParamsPegawai(array(), -1,-1, $statement, $sOrder); 
  // echo $set->query;exit; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
  <style>
    body, table{
      font-size:12px;
      font-family:Arial, Helvetica, sans-serif
    }
    th {
      text-align:center;
      font-weight: bold;
    }
    td {
      vertical-align: top;
      text-align: left;
    }
    .str{
      mso-number-format:"\@";/*force text*/
    }
  </style>
  <table style="width:100%">

    <td colspan="<?=count($judulfield)-1?>" style="font-size:13px;font-weight:bold; text-align: center;">Rekapitulasi Pensiun Pegawai</td> 
  </tr>
</table>
<br/>
<br/>
<table style="width:100%" border="1" cellspacing="0" cellpadding="0">
  <thead>
    <tr>
      <?
      for($i=0; $i < count($judulfield); $i++)
      {
        ?>
        <th style="text-align: center;"><?=$judulfield[$i]?></th>
        <?
      }
      ?>
    </tr>
  </thead>
  <tbody>
    <?
    $nomor = 1;
    while($set->nextRow())
    {
      $reqcheckid = $set->getField("STATUS_PEGAWAI");
      ?>
      <tr>
        <?
        for($i=0; $i<count($field); $i++)
        {
          $tempValue= "";
          if($field[$i] == "NO")
          {
            $tempValue= $nomor;
          }
          elseif ($field[$i] == "TANGGAL_LAHIR" || $field[$i] == "TMT_JABATAN" || $field[$i] == "TMT_PANGKAT_P") {
            $tempValue= dateToPageCheck($set->getField($field[$i]));
          }
          else if ($field[$i] == "GOL_RUANG")
          {
            if ($reqcheckid == 4 || $reqcheckid == 5)
            {
              $tempValue= $set->getField("GOLONGAN_PPPK");
            }
            else
            {
              $tempValue= $set->getField($field[$i]);
            }
            
          }
          else
          {
            $tempValue= $set->getField($field[$i]);
          }
          ?>
          <td class="str"><?=$tempValue?></td>
          <?
        }
        ?>
      </tr>
      <?
      $nomor++;
    }
    ?>    
  </tbody>
</table>
</body>
</html>