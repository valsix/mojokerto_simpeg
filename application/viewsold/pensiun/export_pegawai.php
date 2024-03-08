<?php
include_once("functions/string.func.php");
include_once("functions/default.func.php");
include_once("functions/date.func.php");


header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=\"data_pegawai.xls\"");

// $CI =& get_instance();
// $CI->checkUserLogin();
$reqCari= $this->input->get('reqCari');
// print_r($reqCari);exit;

$reqPegawaiId = $this->input->get("reqPegawaiId");
$reqSatuanKerja= $this->input->get('reqSatuanKerja');
$reqTipePegawai= $this->input->get('reqTipePegawai');
$reqStatusPegawai= $this->input->get('reqStatusPegawai');


$this->load->model('base-app/Export');

$statement ="";
if(!empty($reqSatuanKerja))
{
  $statement.= " AND A.SATKER_ID LIKE '".$reqSatuanKerja."%' ";
}

if(!empty($reqTipePegawai))
{
  $statement.= " AND C.TIPE_PEGAWAI_NEW_ID LIKE '".$reqTipePegawai."%'";
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

if ($reqStatusPegawai == 11) {
  $statement.= " AND (STATUS_PEGAWAI = 1 OR STATUS_PEGAWAI = 2 OR STATUS_PEGAWAI = 4 OR STATUS_PEGAWAI = 5)";
}
else if ($reqStatusPegawai == 12) {
  $statement.= " AND (STATUS_PEGAWAI = 3 OR STATUS_PEGAWAI = 6)";
}
else if ($reqStatusPegawai == 13) {
  $statement.= " AND (STATUS_PEGAWAI = 7)";
}
else
{
  $statement.= "AND (STATUS_PEGAWAI = 1 OR STATUS_PEGAWAI = 2 OR STATUS_PEGAWAI = 4 OR STATUS_PEGAWAI = 5)";
}
$judulfield= array();
$judulfield= array("NO.","SAPK ID","NIP Baru", "Nama", "Tempat Lahir", "Tanggal Lahir", "L/P", "Status","Tipe Pegawai","Eselon","Jabatan","TMT Jabatan","Kelas Jabatan","Gol. Ruang","TMT Pangkat","Telepon","Alamat","Unit Kerja","Unit Sub Kerja","Pendidikan","Universitas","Lulus","BUP");

$field= array();
$field= array("NO","NIP_LAMA", "NIP_BARU", "NAMA", "TEMPAT_LAHIR", "TANGGAL_LAHIR", "JENIS_KELAMIN", "STATUS_PEGAWAI_NAMA", "TIPE_PEGAWAI_NAMA", "ESELON","JABATAN","TMT_JABATAN","KELAS_JABATAN","GOL_RUANG","TMT_PANGKAT_P","TELEPON","ALAMAT","SATKER_INDUK_NAMA","SATKER","PENDIDIKAN_NAMA","NAMA_SEKOLAH","LULUS","BUP");
 // echo $reqKodeProv;exit;


$set = new Export();

$set->selectByParamsPegawai(array(), -1,-1, $statement); 
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

    <td colspan="<?=count($judulfield)-1?>" style="font-size:13px;font-weight:bold; text-align: center;">DATA PEGAWAI</td> 
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
      // var_dump( $reqcheckid);
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