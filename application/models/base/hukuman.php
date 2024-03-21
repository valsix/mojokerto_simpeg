<? 
include_once(APPPATH.'/models/Entity.php');

class Hukuman extends Entity{ 

	var $query;

	function Hukuman()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT 
				   CASE
					WHEN CURRENT_DATE <= a.TANGGAL_AKHIR AND CURRENT_DATE >= a.TANGGAL_MULAI
					THEN 'Ya'
					ELSE 'Tidak'
				   END STATUS_BERLAKU,
				   HUKUMAN_ID, PEGAWAI_ID, 
				   case when PEJABAT_PENETAP_ID =  NULL then (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) else a.PEJABAT_PENETAP_ID end PEJABAT_PENETAP_ID, 
				   JENIS_HUKUMAN_ID, NO_SK, TANGGAL_SK, TINGKAT_HUKUMAN_ID, PERATURAN_ID,
				   TMT_SK, KETERANGAN, BERLAKU,
				   case when BERLAKU = 1 then 'Ya' when BERLAKU =  0 then 'Tidak' end  LAKU,
				   (SELECT x.JABATAN FROM PEJABAT_PENETAP x WHERE x.PEJABAT_PENETAP_ID = a.PEJABAT_PENETAP_ID) NMPEJABATPENETAP,
                   (SELECT x.TINGKAT_HUKUMAN_ID FROM TINGKAT_HUKUMAN x, JENIS_HUKUMAN y WHERE x.TINGKAT_HUKUMAN_ID = y.TINGKAT_HUKUMAN_ID
                    AND y.JENIS_HUKUMAN_ID = a.JENIS_HUKUMAN_ID) TINGKAT_HUKUMAN_ID,
                   (SELECT x.NAMA FROM TINGKAT_HUKUMAN x, JENIS_HUKUMAN y WHERE x.TINGKAT_HUKUMAN_ID = y.TINGKAT_HUKUMAN_ID 
                    AND y.JENIS_HUKUMAN_ID = a.JENIS_HUKUMAN_ID ) NMTINGKATHUKUMAN,
				   (SELECT x.NAMA FROM PERATURAN x WHERE x.PERATURAN_ID = a.PERATURAN_ID) NMPERATURAN,
                   (SELECT y.NAMA FROM JENIS_HUKUMAN y WHERE y.JENIS_HUKUMAN_ID = a.JENIS_HUKUMAN_ID ) NMJENISHUKUMAN, FOTO_BLOB,
				   a.TANGGAL_MULAI, a.TANGGAL_AKHIR
				FROM HUKUMAN a WHERE 1 = 1 "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY JENIS_HUKUMAN_ID ASC";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>