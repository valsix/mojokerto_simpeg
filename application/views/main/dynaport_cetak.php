<?
ini_set('memory_limit', '-1');
$this->load->model("base/Dyna");

header("Content-Type: application/x-msexcel; name=\"dynaport_cetak.xls\"");
header("Content-Disposition: inline; filename=\"dynaport_cetak.xls\"");

$cekquery= $this->input->get("c");

$dynatr= $this->dynatr;
$dynafield= $this->dynafield;
$dynaorder= $this->dynaorder;
$dynawhere= $this->dynawhere;

if($reqSearch == "")
	$reqSearch.= " AND A.STATUS_PEGAWAI IN (1, 2)";

$reqSearch.= " AND A.TANGGAL_LAHIR IS NOT NULL";

if(empty($reqId) || $reqId == "-1")
	$statement.= "".$reqSearch;
else
	$statement.= " AND A.SATKER_ID LIKE '".$reqId."%' ".$reqSearch;

$sOrder= $this->dynaorder;
$dynawhere= $this->dynawhere;
if(!empty($dynawhere))
{
	$statement .= $dynawhere;
}

$set= new Dyna();
$set->selectmonitoring(array(), -1, -1, $statement, $sOrder);
if(!empty($cekquery))
{
	echo $set->query;exit;
}
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
    <tr>
    	<!-- <td rowspan="3"><img src="<?=base_url()."images/logo-mojokerto.png"?>" style="max-width:200px; max-height:200px"/></td> -->
        <td colspan="<?=count($dynafield)-1?>" style="font-size:13px;font-weight:bold; text-align: center;">PEMERINTAH KABUPATEN MOJOKERTO</td>	
    </tr>
</table>

<table style="width:100%" border="1" cellspacing="0" cellpadding="0">
	<thead>
		<?=$dynatr?>
	</thead>
	<tbody>
		<?php

		$arrtgl= array("TANGGAL_LAHIR", "TANGGAL_PENSIUN", "TMT_PANGKAT", "TMT_ESELON", "TMT_JABATAN", "TANGGAL_SK_JABATAN", "TANGGAL_STTB_PENDIDIKAN", "TANGGAL_SK_PENGHARGAAN", "TMT_SK_HUKUMAN", "TANGGAL_LAHIR_ANAK", "AWAL_BAYAR_ANAK", "AKHIR_BAYAR_ANAK", "TANGGAL_LAHIR_SUAMI", "TANGGAL_KAWIN_SUAMI", "TANGGAL_SURAT_CUTI", "TANGGAL_SK_CPNS", "TMT_CPNS", "TANGGAL_TUGAS_CPNS", "TANGGAL_SK_PNS", "TMT_PNS", "TANGGAL_SUMPAH_PNS");
		while($set->nextRow())
        {
		?>
			<tr>
			<?php
			foreach ($dynafield as $k => $v)
			{
				if(in_array($v, $arrtgl))
				{
					$nvalue= dateToPageCheck($set->getField($v));
				}
				else
				{
					$nvalue= $set->getField($v);
				}
			?>
				<td class="str"><?=$nvalue?></td>
			<?php
			}
			?>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>