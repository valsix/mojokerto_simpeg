<? 
  
  include_once(APPPATH.'/models/Entity.php');

  class UploadFile extends Entity{ 

	var $query;

    function UploadFile()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("UPLOAD_FILE_ID", $this->getNextId("UPLOAD_FILE_ID","UPLOAD_FILE")); 
		
		$str = "INSERT INTO UPLOAD_FILE(
	            UPLOAD_FILE_ID, PEGAWAI_ID, 
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("UPLOAD_FILE_ID").",
				  ".$this->getField("PEGAWAI_ID").",
				  '".$this->getField("NAMA_FILE")."',
				  '".$this->getField("LINK_FILE")."',
				  '".$this->getField("TIPE_FILE")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM UPLOAD_FILE
                  WHERE 
                  UPLOAD_FILE_ID= ".$this->getField("UPLOAD_FILE_ID")."
                  "; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT *
		FROM UPLOAD_FILE A
		WHERE 1 = 1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsCheckFolder($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.LINK_SERVER_ID ASC")
	{
		$str = "
		SELECT *
		FROM LINK_SERVER A
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


    function selectByParamsCheckPegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.PEGAWAI_ID ASC")
	{
		$str = "
		SELECT A.PEGAWAI_ID,A.NIP_BARU 
		FROM PEGAWAI A
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

    function selectByParamsCheckSuamiIstri($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.SUAMI_ISTRI_ID DESC")
	{
		$str = "
		SELECT * 
		FROM SUAMI_ISTRI A
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

    function selectByParamsCheckSuamiIstriFile($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.SUAMI_ISTRI_FILE_ID DESC")
	{
		$str = "
		SELECT * 
		FROM SUAMI_ISTRI_FILE A
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


    function selectByParamsCheckCpns($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.SK_CPNS_ID DESC")
	{
		$str = "
		SELECT * 
		FROM SK_CPNS A
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

    function selectByParamsCheckCpnsFile($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.SK_CPNS_FILE_ID DESC")
	{
		$str = "
		SELECT * 
		FROM SK_CPNS_FILE A
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


	function selectByParamsCheckPns($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.SK_PNS_ID DESC")
	{
		$str = "
		SELECT * 
		FROM SK_PNS A
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

    function selectByParamsCheckPnsFile($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.SK_PNS_FILE_ID DESC")
	{
		$str = "
		SELECT * 
		FROM SK_PNS_FILE A
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


    function selectByParamsCheckJabatan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.PEGAWAI_JABATAN_ID DESC")
	{
		$str = "
		SELECT * 
		FROM PEGAWAI_JABATAN A
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

    function selectByParamsCheckJabatanFile($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.PEGAWAI_JABATAN_FILE_ID DESC")
	{
		$str = "
		SELECT * 
		FROM PEGAWAI_JABATAN_FILE A
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

    function selectByParamsCheckAnak($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.ANAK_ID DESC")
	{
		$str = "
		SELECT * 
		FROM ANAK A
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

    function selectByParamsCheckAnakFile($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.ANAK_FILE_ID DESC")
	{
		$str = "
		SELECT * 
		FROM ANAK_FILE A
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

    function selectByParamsCheckKP($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.PANGKAT_RIWAYAT_ID DESC")
	{
		$str = "
		SELECT * 
		FROM PANGKAT_RIWAYAT A
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

    function selectByParamsCheckKpFile($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.PANGKAT_RIWAYAT_FILE_ID DESC")
	{
		$str = "
		SELECT * 
		FROM PANGKAT_RIWAYAT_FILE A
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

    function selectByParamsCheckPmk($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.TAMBAHAN_MASA_KERJA_ID DESC")
	{
		$str = "
		SELECT * 
		FROM TAMBAHAN_MASA_KERJA A
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

    function selectByParamsCheckPmkFile($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.TAMBAHAN_MASA_KERJA_FILE_ID DESC")
	{
		$str = "
		SELECT * 
		FROM TAMBAHAN_MASA_KERJA_FILE A
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

    function selectByParamsCheckPendidikan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.PEGAWAI_PENDIDIKAN_RIWAYAT_ID DESC")
	{
		$str = "
		SELECT * 
		FROM PEGAWAI_PENDIDIKAN_RIWAYAT A
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

    function selectByParamsCheckPendidikanFile($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.PEGAWAI_PENDIDIKAN_RIWAYAT_FILE_ID DESC")
	{
		$str = "
		SELECT * 
		FROM PEGAWAI_PENDIDIKAN_RIWAYAT_FILE A
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


    function selectByParamsCheckDiklat($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.PEGAWAI_DIKLAT_ID DESC")
	{
		$str = "
		SELECT A.PEGAWAI_DIKLAT_ID, A.DIKLAT_ID, A.PEGAWAI_ID, NOMOR, TANGGAL, TAHUN,B.NAMA DIKLAT_NAMA,B.KETERANGAN DIKLAT_KET
		FROM PEGAWAI_DIKLAT A
		LEFT JOIN DIKLAT B ON B.DIKLAT_ID = A.DIKLAT_ID
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

    function selectByParamsCheckDiklatFile($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.PEGAWAI_DIKLAT_FILE_ID DESC")
	{
		$str = "
		SELECT * 
		FROM PEGAWAI_DIKLAT_FILE A
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


    function selectByParamsCheckSkp($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.PENILAIAN_KERJA_PEGAWAI_ID DESC")
	{
		$str = "
		SELECT * 
		FROM PENILAIAN_KERJA_PEGAWAI A
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

    function selectByParamsCheckSkpFile($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY A.PENILAIAN_KERJA_PEGAWAI_FILE_ID DESC")
	{
		$str = "
		SELECT * 
		FROM PENILAIAN_KERJA_PEGAWAI_FILE A
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