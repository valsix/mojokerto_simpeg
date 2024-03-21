<? 
include_once(APPPATH.'/models/Entity.php');

class PenguasaanBahasa extends Entity{ 

	var $query;

	function PenguasaanBahasa()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT BAHASA_ID, PEGAWAI_ID, JENIS, NAMA, KEMAMPUAN,
				case when JENIS = '1' then 'Asing' when JENIS = '2' then 'Daerah' end NMJENIS,
				case when KEMAMPUAN =  'A' then 'Aktif' when KEMAMPUAN =  'P' then 'Pasif' end MAMPU, FOTO_BLOB
				FROM BAHASA WHERE BAHASA_ID IS NOT NULL "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY NAMA ASC";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>