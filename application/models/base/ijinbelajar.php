<? 
include_once(APPPATH.'/models/Entity.php');

class IjinBelajar extends Entity{ 

	var $query;

	function IjinBelajar()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT 
                   LINK_FILE_APPS,
                   IJIN_BELAJAR_ID, PEGAWAI_ID,NOMOR_SURAT,TANGGAL_SURAT,NAMA_PERGURUAN,PROGRAM_STUDI,JURUSAN
                  
                FROM IJIN_BELAJAR WHERE IJIN_BELAJAR_ID IS NOT NULL "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement."";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>