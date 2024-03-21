<? 
include_once(APPPATH.'/models/Entity.php');

class SKP extends Entity{ 

	var $query;

	function SKP()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT 
			A.SKP_ID, A.PEGAWAI_ID, A.PEJABAT_ID, 
			A.ATASAN_PEJABAT_ID, A.TAHUN,A.NILAI, A.ORIENTASI_PELAYANAN, 
			A.INTEGRITAS, A.KOMITMEN, A.DISIPLIN, 
			A.KERJASAMA, A.KEPEMIMPINAN, A.FORMAT, 
			A.UKURAN,A.LINK_FILE_APPS,B.NAMA PEJABAT_NAMA,C.NAMA ATASAN_NAMA,B.NIP_BARU PEJABAT_NIP,C.NIP_BARU ATASAN_NIP,A.INISIATIF_KERJA
			FROM SKP A
			LEFT JOIN PEGAWAI B  ON B.PEGAWAI_ID = A.PEJABAT_ID
			LEFT JOIN PEGAWAI C  ON C.PEGAWAI_ID = A.ATASAN_PEJABAT_ID 
			WHERE 1=1 "; 

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