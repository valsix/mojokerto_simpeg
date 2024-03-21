<? 
include_once(APPPATH.'/models/Entity.php');

class PenilaianPotensiDiri extends Entity{ 

	var $query;

	function PenilaianPotensiDiri()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT POTENSI_DIRI_ID, PEGAWAI_ID, TANGGUNG_JAWAB, 
				   MOTIVASI, MINAT, 
				   TAHUN, FOTO_BLOB
				FROM POTENSI_DIRI WHERE POTENSI_DIRI_ID IS NOT NULL "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY MOTIVASI ASC";		
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>