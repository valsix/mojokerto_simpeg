<? 
include_once(APPPATH.'/models/Entity.php');

class PelatihanTeknis extends Entity{ 

	var $query;

	function PelatihanTeknis()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT DIKLAT_TEKNIS_ID, PEGAWAI_ID, TEMPAT, 
				   PENYELENGGARA, ANGKATAN, TAHUN, 
				   NO_STTPP, TANGGAL_MULAI, TANGGAL_SELESAI, 
				   TANGGAL_STTPP, JUMLAH_JAM, NAMA, FOTO_BLOB
				FROM DIKLAT_TEKNIS WHERE DIKLAT_TEKNIS_ID IS NOT NULL "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TANGGAL_MULAI ASC, TAHUN ";
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>