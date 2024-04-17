<? 
include_once(APPPATH.'/models/Entity.php');

class SeminarWorkshop extends Entity{ 

	var $query;

	function SeminarWorkshop()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT SEMINAR_ID, PEGAWAI_ID, TEMPAT, NAMA,
				   PENYELENGGARA, TANGGAL_MULAI, TANGGAL_SELESAI, 
				   NO_PIAGAM, TANGGAL_PIAGAM, FOTO_BLOB,JUMLAH_JAM
				FROM SEMINAR WHERE SEMINAR_ID IS NOT NULL "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}

		$str .= $statement." ORDER BY TANGGAL_MULAI ASC, TANGGAL_PIAGAM ASC ";		
		$this->query = $str;
				
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
				SELECT COUNT(1) AS ROWCOUNT 
				FROM SEMINAR WHERE SEMINAR_ID IS NOT NULL ".$statement; 
				
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		$this->query = $str;
		// echo $str;exit;
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0;  
    }
} 
?>