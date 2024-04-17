<? 
include_once(APPPATH.'/models/Entity.php');

class PendidikanUmum extends Entity{ 

	var $query;

	function PendidikanUmum()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str =  "SELECT PENDIDIKAN_RIWAYAT_ID, PEGAWAI_ID, a.PENDIDIKAN_ID, 
                   a.NAMA, JURUSAN_PENDIDIKAN_ID, TEMPAT, 
                   KEPALA, NO_STTB, TANGGAL_STTB, b.NAMA as PENDIDIKAN, FOTO_BLOB,a.JURUSAN JURUSAN,
				   case when a.PENDIDIKAN_ID is NULL then JURUSAN else (SELECT X.NAMA  FROM JURUSAN_PENDIDIKAN X WHERE X.JURUSAN_PENDIDIKAN_ID = a.JURUSAN_PENDIDIKAN_ID) end NMJURUSAN ,LINK_FILE_APPS,LINK_FILE_APPS_TRANSKRIP
                FROM PENDIDIKAN_RIWAYAT a, PENDIDIKAN b WHERE a.PENDIDIKAN_ID = b.PENDIDIKAN_ID "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TANGGAL_STTB DESC";
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from);
    }

    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
				SELECT COUNT(1) AS ROWCOUNT 
				FROM PENDIDIKAN_RIWAYAT a, PENDIDIKAN b 
				WHERE a.PENDIDIKAN_ID = b.PENDIDIKAN_ID ".$statement; 
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