<? 
include_once(APPPATH.'/models/Entity.php');

class Nikah extends Entity{ 

	var $query;

	function Nikah()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT NIKAH_RIWAYAT_ID, PEGAWAI_ID, NO_SK_PENGADILAN, 
				   NO_SK_IJIN, TANGGAL_SK_PENGADILAN, TMT_SK, TANGGAL_SK_IJIN, NAMA, 
				   PNS, NIP, PEKERJAAN, case when PNS = 1 then 'Ya' when PNS = 0 then 'Tidak' end NMPNS, FOTO_BLOB
				FROM NIKAH_RIWAYAT WHERE 1=1 "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TMT_SK ASC";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>