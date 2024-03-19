<? 
include_once(APPPATH.'/models/Entity.php');

class RiwayatGaji extends Entity{ 

	var $query;

	function RiwayatGaji()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT GAJI_RIWAYAT_ID, PEGAWAI_ID, 
				   A.PEJABAT_PENETAP_ID, 
				   PEJABAT_PENETAP,
				   PANGKAT_ID, NO_SK, TANGGAL_SK, TMT_SK, GAJI_POKOK, JENIS_KENAIKAN, 
				   case 
				   when JENIS_KENAIKAN= 1 then 'KP' 
				   when JENIS_KENAIKAN= 2 then 'KGB'
				   when JENIS_KENAIKAN= 3 then 'Penyesuaian' 
				   when JENIS_KENAIKAN= 4 then 'SK'
				   end NMJENISKENAIKAN,
				   WILAYAH, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
				   KTUA, BULAN_DIBAYAR, SUDAH_DIBAYAR, POTONGAN_PANGKAT, TANGGAL_UPDATE, 
				   PEJABAT_PENETAP NMPEJABATPENETAP,
                   (SELECT x.KODE FROM PANGKAT x WHERE x.PANGKAT_ID = a.PANGKAT_ID) NMPANGKAT, FOTO_BLOB,LINK_FILE_APPS
				FROM GAJI_RIWAYAT a WHERE 1=1"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TMT_SK ASC";
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>