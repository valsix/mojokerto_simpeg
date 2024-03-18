<? 
include_once(APPPATH.'/models/Entity.php');

class SkPns extends Entity{ 

	var $query;

	function SkPns()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $orderby='order by NO_STTPP asc')
	{
		$str = "SELECT SK_CPNS_ID, PEGAWAI_ID, PANGKAT_ID, 					
                   case
                   when PEJABAT_PENETAP_ID is NULL 
                   then (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP)
                   else PEJABAT_PENETAP_ID  end PEJABAT_PENETAP_ID, 
                   TMT_CPNS, TANGGAL_TUGAS, 
                   NO_STTPP, NO_NOTA, TANGGAL_NOTA, 
                   NO_SK, TANGGAL_STTPP, NAMA_PENETAP, 
                   TANGGAL_SK, NIP_PENETAP, TANGGAL_UPDATE, FOTO_BLOB, MASA_KERJA_TAHUN, MASA_KERJA_BULAN,LINK_FILE_APPS, LINK_FILE_APPS_KONVERSI, LINK_FILE_APPS_PENETAPAN_NIP, LINK_FILE_APPS_SPMT, LINK_FILE_APPS_PRAJAB, LINK_FILE_APPS_D2
                FROM SK_CPNS A WHERE SK_CPNS_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ". $orderby;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>