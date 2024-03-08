<?php
include_once("functions/string.func.php");
include_once("functions/default.func.php");
include_once("functions/date.func.php");


header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=\"data_diklat.xls\"");

// $CI =& get_instance();
// $CI->checkUserLogin();

$reqPegawaiId = $this->input->get("reqPegawaiId");
$reqBulan= $this->input->get('reqBulan');
$reqTahun= $this->input->get('reqTahun');

$this->load->model('base-app/Export');

$statement ="";
if(!empty($reqBulan))
{
  $statement .= " AND TO_CHAR(A.LAST_CREATE_DATE, 'MM') = '".$reqBulan."'"; 
}

if(!empty($reqTahun))
{
  $statement .= " AND TO_CHAR(A.LAST_CREATE_DATE, 'YYYY') = '".$reqTahun."'"; 
}

$judulfield= array();
$judulfield= array("NO.","NIP","NAMA", "OPD", "NOMOR", "TANGGAL", "TAHUN", "NAMA DIKLAT");

$field= array();
$field= array("NO","NIP_BARU", "NAMA_PEGAWAI", "SATKER_INDUK_NAMA", "NOMOR", "TANGGAL", "TAHUN", "DIKLAT_NAMA");
 // echo $reqKodeProv;exit;


$set = new Export();

$set->selectByParamsDiklat(array(), -1,-1, $statement); 
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

    <td colspan="<?=count($judulfield)-1?>" style="font-size:13px;font-weight:bold; text-align: center;">DATA DIKLAT</td> 
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
          elseif ($field[$i] == "TANGGAL") {
            $tempValue= dateToPageCheck($set->getField($field[$i]));
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