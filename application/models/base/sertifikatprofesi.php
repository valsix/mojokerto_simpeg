<? 
include_once(APPPATH.'/models/Entity.php');

class SertifikatProfesi extends Entity{ 

	var $query;

	function SertifikatProfesi()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT 
		SERTIFIKAT_PROFESI_ID, PEGAWAI_ID, NAMA, 
		NOMOR, SERTIFIKAT, LEMBAGA, TANGGAL,
		FORMAT, UKURAN
		FROM SERTIFIKAT_PROFESI
		WHERE 1=1"; 
		
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