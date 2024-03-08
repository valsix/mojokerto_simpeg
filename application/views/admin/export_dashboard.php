<?php
include_once("functions/string.func.php");
include_once("functions/default.func.php");
include_once("functions/date.func.php");

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=\"data_pegawai.xls\"");

// $CI =& get_instance();
// $CI->checkUserLogin();

ini_set('memory_limit', -1);
ini_set('max_execution_time', -1);

$this->load->model("base-data/FormulaPenilaian");

$reqFormulaPenilaianId= $this->input->get("reqFormulaPenilaianId");
$reqTipePegawaiId= $this->input->get("reqTipePegawaiId");
$reqPangkatId= $this->input->get("reqPangkatId");
$reqEselonId= $this->input->get("reqEselonId");
$reqSatuanKerja= $this->input->get("reqSatuanKerja");
$reqSatuanKerjaEs2= $this->input->get("reqSatuanKerjaEs2");
$reqKuadranId= $this->input->get("reqKuadranId");

$statement ="";
// if(!empty($reqBulan))
// {
//   $statement .= " AND TO_CHAR(A.LAST_CREATE_DATE, 'MM') = '".$reqBulan."'"; 
// }

// if(!empty($reqTahun))
// {
//   $statement .= " AND TO_CHAR(A.LAST_CREATE_DATE, 'YYYY') = '".$reqTahun."'"; 
// }

$judulfield= array();
$judulfield= array("NO.","Nama", "NIP Baru", "Gol. Ruang", "Eselon", "Jabatan", "Unit Kerja","Potensi","Kinerja","Kuadran");

$field= array();
$field= array("NO","NAMA", "NIP_BARU", "PANGKAT_INFO", "ESELON_NAMA", "LAST_JABATAN", "SATKER_NAMA", "NILAI_X","NILAI_Y","KODE_KUADRAN");


$set = new FormulaPenilaian();

if(!empty($reqTipePegawaiId) || !empty($reqEselonId))
{
  if(!empty($reqTipePegawaiId) && !empty($reqEselonId))
  {
    $arrTipePegawaiId= explode(",", $reqTipePegawaiId);
    $arrEselonId= explode(",", $reqEselonId);
      // print_r($arrTipePegawaiId);
      // print_r($arrEselonId);
      // exit();

      $statementkhusus= "";
      $statementdetil.= "
      AND
      (
      ";
      foreach($arrTipePegawaiId as $vtipepegawai)
      {
        $infokondisitipe= "";
      foreach($arrEselonId as $veselonid)
      {
            $veselonid= explode("-", $veselonid);
            // print_r($veselonid);exit;
            $infoeselonid= $veselonid[0];
            $infoeselongroup= $veselonid[1];

            if($infoeselongroup == "eselon")
            {
              if($vtipepegawai == "1")
              {
            $statementeselon= "
            (
            A.TIPE_PEGAWAI_ID in(".$vtipepegawai.")
            ";

            $statementeselon.= "AND A.LAST_ESELON_ID in(".$infoeselonid.")";

            $statementeselon.= "
            )
            ";
                  $statementkhusus= getconcatseparator($statementkhusus, $statementeselon, "OR");
          }
            }
            else
            {
              if($vtipepegawai !== "1" && $vtipepegawai !== "2")
              {
                if($infoeselongroup !== "eselon")
                {
                  $infokondisitipe= "1";
                  $statementeselon= "
                  (
                  A.TIPE_PEGAWAI_ID in(".$vtipepegawai.")
                  ";

                  $statementeselon.= "AND A.LAST_JENJANG_ID in(".$infoeselonid.")";

                  $statementeselon.= "
                  )
                  ";

                  $statementkhusus= getconcatseparator($statementkhusus, $statementeselon, "OR"); 
                }
              }
              elseif($vtipepegawai == "2")
              {
                if($infoeselongroup !== "eselon")
                {
                  $infokondisitipe= "1";
                  $statementeselon= "
                  (
                  A.TIPE_PEGAWAI_ID in(".$vtipepegawai.")
                  ";

                  // $statementeselon.= "AND A.LAST_JENJANG_ID in(".$infoeselonid.")";

                  $statementeselon.= "
                  )
                  ";

                  $statementkhusus= getconcatseparator($statementkhusus, $statementeselon, "OR"); 
                }
              }
            }
          }

          if(empty($infokondisitipe) && $vtipepegawai !== "1")
          {
            $statementeselon= "
            (
            A.TIPE_PEGAWAI_ID in(".$vtipepegawai.")
            ";

            $statementeselon.= "
            )
            ";
            $statementkhusus= getconcatseparator($statementkhusus, $statementeselon, "OR");
          }
      }
      // echo $statementkhusus;exit;
      $statementdetil.= $statementkhusus.")";
      // echo $statementdetil;exit;
  }
  else if(!empty($reqTipePegawaiId))
  {
    $statementdetil.= " AND A.TIPE_PEGAWAI_ID in(".$reqTipePegawaiId.")";
  }
  else if(!empty($reqEselonId))
  {
    $statementdetil.= " AND A.LAST_ESELON_ID in( ".$reqEselonId.")";
  }
}

if(!empty($reqPangkatId))
{
  $statementdetil.= " AND A.LAST_PANGKAT_ID = ".$reqPangkatId;
}

if(!empty($reqSatuanKerjaEs2))
{
  $statementdetil.= " AND A.SATKER_ID = '".$reqSatuanKerjaEs2."'";
}

if(!empty($reqSatuanKerja) && empty($reqSatuanKerjaEs2))
{
  $statementdetil.= " AND A.SATKER_ID LIKE '".$reqSatuanKerja."%'";
}

if(!empty($reqKuadranId))
{
  $statement.= " AND A.KUADRAN_PEGAWAI_ID = '".$reqKuadranId."'";
}

$sOrder = " ORDER BY A.NILAI_X DESC, A.NILAI_Y DESC, B.ORDER_KUADRAN DESC";
$set->selectbyparamskuadranpegawai(array(), $displaylength, $displaystart, $statement, $statementdetil, $sOrder, $reqFormulaPenilaianId);
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