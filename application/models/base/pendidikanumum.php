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
		$str = "SELECT PENGALAMAN_ID, PEGAWAI_ID, JABATAN, 
				   NAMA, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
				   TANGGAL_KERJA, FOTO_BLOB
				FROM PENGALAMAN WHERE PENGALAMAN_ID IS NOT NULL "; 
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY pengalaman_id";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>