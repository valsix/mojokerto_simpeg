<? 
include_once(APPPATH.'/models/Entity.php');

class InfoData extends Entity{ 

	var $query;

	function InfoData()
	{
		$this->Entity(); 
	}

	function selectbyagama($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.agama A
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
	}

	function selectbysatuankerja($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.satker A
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
	}

	function selectbypangkat($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.pangkat A
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
	}

	function selectbyeselon($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.ESELON_ID")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.eselon A
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
	}

	function selectbypendidikan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.PENDIDIKAN_ID")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.pendidikan A
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
	}

	function selectbykampus($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.NAMA")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.kampus A
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
	}

	function selectbyparamspegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		A1.KODE PANGKAT_KODE, A1.NAMA PANGKAT_NAMA
		, A.*
		FROM simpeg.pegawai A
		LEFT JOIN simpeg.pangkat A1 ON A1.PANGKAT_ID = A.LAST_PANGKAT_ID
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
	}

	function selectbyparamspangkat($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.TMT_PANGKAT DESC")
	{
		$str = "
		SELECT
		A1.KODE PANGKAT_KODE, A1.NAMA PANGKAT_NAMA
		, A.*
		FROM simpeg.riwayat_pangkat A
		LEFT JOIN simpeg.pangkat A1 ON A1.PANGKAT_ID = A.PANGKAT_ID
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
	}

	function selectbyparamsjabatan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.TMT_JABATAN DESC")
	{
		$str = "
		SELECT
		A1.NAMA ESELON_NAMA
		, A.*
		FROM simpeg.riwayat_jabatan A
		LEFT JOIN simpeg.eselon A1 ON A1.ESELON_ID = A.ESELON_ID
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
	}

	function selectbyparamspendidikan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.TAHUN::NUMERIC DESC")
	{
		$str = "
		SELECT
		A1.NAMA PENDIDIKAN_NAMA, A2.NAMA KAMPUS_NAMA
		, A.*
		FROM simpeg.riwayat_pendidikan A
		LEFT JOIN simpeg.pendidikan A1 ON A1.PENDIDIKAN_ID = A.PENDIDIKAN_ID
		LEFT JOIN simpeg.kampus A2 ON A2.KAMPUS_ID = A.KAMPUS_ID
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
	}
} 
?>