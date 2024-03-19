<? 
include_once(APPPATH.'/models/Entity.php');

class RiwayatPangkat extends Entity{ 

	var $query;

	function RiwayatPangkat()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT PANGKAT_RIWAYAT_ID, PEGAWAI_ID, a.PANGKAT_ID, 
				   case 
				   when b.JABATAN is NULL then a.PEJABAT_PENETAP
				   else b.JABATAN end PEJABAT_PENETAP, a.PEJABAT_PENETAP_ID, STLUD, NO_STLUD, 
				   TANGGAL_STLUD, NO_NOTA, TANGGAL_NOTA, a.GAJI_POKOK,
				   NO_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
				   TANGGAL_SK, TMT_PANGKAT, KREDIT, JENIS_KP, KETERANGAN, TANGGAL_UPDATE,
				   (SELECT x.KODE FROM PANGKAT x WHERE x.PANGKAT_ID = a.PANGKAT_ID) NMPANGKAT,
				   case
				   when JENIS_KP = 1 then 'Reguler'
				   when JENIS_KP = 2 then 'Pilihan' 
				   when JENIS_KP = 3 then 'Anumerta' 
				   when JENIS_KP = 4 then 'Pengabdian' 
				   when JENIS_KP = 5 then 'SK lain-lain' 
				   when JENIS_KP = 6 then 'Pilihan (Fungsional)'
				   end  NMJENIS, FOTO_BLOB,LINK_FILE_APPS,LINK_FILE_APPS_STLUD
				FROM PANGKAT_RIWAYAT a LEFT JOIN PEJABAT_PENETAP b ON a.PEJABAT_PENETAP_ID = b.PEJABAT_PENETAP_ID WHERE PANGKAT_RIWAYAT_ID IS NOT NULL "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		$str .= $statement." ORDER BY TMT_PANGKAT ";
		
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>