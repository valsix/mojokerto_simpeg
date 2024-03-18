<? 
include_once(APPPATH.'/models/Entity.php');

class Core extends Entity{ 

	var $query;

	function Core()
	{
		$this->Entity(); 
	}

	function selectByParamsAgama($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT AGAMA_ID, NAMA
				FROM AGAMA WHERE AGAMA_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY AGAMA_ID ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsPropinsi($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT PROPINSI_ID, NAMA
				FROM PROPINSI WHERE PROPINSI_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY NAMA ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsKabupaten($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT KABUPATEN_ID, PROPINSI_ID, NAMA
				FROM KABUPATEN WHERE KABUPATEN_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY NAMA ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsKecamatan($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT KECAMATAN_ID, KABUPATEN_ID, PROPINSI_ID, NAMA
				FROM KECAMATAN WHERE KECAMATAN_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY NAMA ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsKelurahan($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT KELURAHAN_ID, KECAMATAN_ID, KABUPATEN_ID, NAMA, PROPINSI_ID
				FROM KELURAHAN WHERE KELURAHAN_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY NAMA ASC";
		//echo $str;		
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsBank($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT BANK_ID, NAMA
				FROM BANK WHERE BANK_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY NAMA ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsTipePegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT TIPE_PEGAWAI_ID, TIPE_PEGAWAI_ID_PARENT, NAMA
				FROM TIPE_PEGAWAI WHERE TIPE_PEGAWAI_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY TIPE_PEGAWAI_ID ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsStatusPegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT STATUS_PEGAWAI_ID, NAMA
				FROM STATUS_PEGAWAI WHERE STATUS_PEGAWAI_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY STATUS_PEGAWAI_ID ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsJenisPegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT JENIS_PEGAWAI_ID, NAMA
				FROM JENIS_PEGAWAI WHERE JENIS_PEGAWAI_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY NAMA ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsKedudukan($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT KEDUDUKAN_ID, NAMA
				FROM KEDUDUKAN WHERE KEDUDUKAN_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY NAMA ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsPangkat($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		// $str = "SELECT PANGKAT_ID, KODE, NAMA, SUBSTR(KODE, 1, INSTR(KODE, '/') - 1) GOL, SUBSTR(KODE, -1) RUANG
		// 		FROM PANGKAT WHERE PANGKAT_ID IS NOT NULL"; 
		$str = "SELECT PANGKAT_ID, KODE, NAMA, SUBSTR(KODE, -1) RUANG
				FROM PANGKAT WHERE PANGKAT_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY KODE ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsPejabatPenetap($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT PEJABAT_PENETAP_ID, JABATAN, NIP, NAMA
				FROM PEJABAT_PENETAP WHERE PEJABAT_PENETAP_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY NAMA ASC";
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>