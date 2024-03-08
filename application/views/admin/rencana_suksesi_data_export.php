<?php
include_once("functions/string.func.php");
include_once("functions/default.func.php");
include_once("functions/date.func.php");

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=\"data_pegawai.xls\"");

// $CI =& get_instance();
// $CI->checkUserLogin();

$this->load->model("base-data/InfoData");

$reqId= $this->input->get("reqId");

$judulfield= array();
$judulfield= array("NO.","Nama", "NIP Baru", "Gol. Ruang", "Eselon", "Jabatan", "Unit Kerja","Potensi","Kinerja","Kuadran");

$field= array();
$field= array("NO","NAMA", "NIP_BARU", "PANGKAT_INFO", "ESELON_NAMA", "LAST_JABATAN", "SATKER_NAMA", "NILAI_X","NILAI_Y","KODE_KUADRAN");

$statement= " AND RSP.RENCANA_SUKSESI_ID = ".$reqId;
$set= new InfoData();
$sOrder = " ORDER BY ORDER_KUADRAN DESC, RSP.NILAI_X DESC, RSP.NILAI_Y DESC, BK.ORDER_KUADRAN DESC";
$set->selectbyparamsrencanasuksesipegawai(array(), $displaylength, $displaystart, $statement, $sOrder);
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
          elseif ($field[$i] == "TANGGAL_MULAI") {
            $tempValue= dateToPageCheck($set->getField($field[$i]));
          }
          elseif ($field[$i] == "PANGKAT_INFO")
          {
            $tempValue= $set->getField('PANGKAT_KODE')." (".$set->getField('PANGKAT_NAMA').")";
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