<? 
  include_once(APPPATH.'/models/Entity.php');

  class PegawaiDiklat extends Entity{ 

	var $query;

    function PegawaiDiklat()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.PEGAWAI_DIKLAT")); 
		
		$str = "INSERT INTO validasi.PEGAWAI_DIKLAT (
				   PEGAWAI_DIKLAT_ID, PEGAWAI_ID, NOMOR, 
				   TANGGAL, TAHUN, DIKLAT_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
				VALUES (
				  ".$this->getField("PEGAWAI_DIKLAT_ID").",
				  ".$this->getField("PEGAWAI_ID").",
				  '".$this->getField("NOMOR")."',
				  ".$this->getField("TANGGAL").",
				  ".$this->getField("TAHUN").",
				  ".$this->getField("DIKLAT_ID").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("TEMP_VALIDASI_ID")."
				)"; 
				
		$this->query = $str;
		$this->id = $this->getField("TEMP_VALIDASI_ID");	
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function insertupload()
	{
		$this->setField("PEGAWAI_DIKLAT_FILE_ID", $this->getNextId("PEGAWAI_DIKLAT_FILE_ID","PEGAWAI_DIKLAT_FILE")); 
		
		$str = "INSERT INTO PEGAWAI_DIKLAT_FILE(
	            PEGAWAI_DIKLAT_FILE_ID, PEGAWAI_DIKLAT_ID, PEGAWAI_ID, TEMP_VALIDASI_ID,
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("PEGAWAI_DIKLAT_FILE_ID").",
				  ".$this->getField("PEGAWAI_DIKLAT_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				   ".$this->getField("TEMP_VALIDASI_ID").",
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

    function update()
	{
		$str = "
				UPDATE validasi.PEGAWAI_DIKLAT
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   NOMOR= '".$this->getField("NOMOR")."',
					   TANGGAL= ".$this->getField("TANGGAL").",
					   TAHUN= ".$this->getField("TAHUN").",
					   DIKLAT_ID= ".$this->getField("DIKLAT_ID").",
					   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function updatevalidasi()
	{
		$str = "
				UPDATE validasi.PEGAWAI_DIKLAT
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   NOMOR= '".$this->getField("NOMOR")."',
					   TANGGAL= ".$this->getField("TANGGAL").",
					   TAHUN= ".$this->getField("TAHUN").",
					   DIKLAT_ID= ".$this->getField("DIKLAT_ID").",
					   VALIDASI	= ".$this->getField("VALIDASI").",
					   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
					   TANGGAL_VALIDASI= NOW()
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM validasi.PEGAWAI_DIKLAT
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function deletefile()
	{
        $str = "DELETE FROM PEGAWAI_DIKLAT_FILE
                  WHERE 
                  PEGAWAI_DIKLAT_FILE_ID= ".$this->getField("PEGAWAI_DIKLAT_FILE_ID")."
                  AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
                  "; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.PEGAWAI_DIKLAT_ID, A.DIKLAT_ID, A.PEGAWAI_ID, NOMOR, TANGGAL, TAHUN,B.NAMA DIKLAT_NAMA
		, A.TEMP_VALIDASI_ID
		, A.PERUBAHAN_DATA
		, A.TIPE_PERUBAHAN_DATA
		, A.TANGGAL_VALIDASI
		, A.VALIDASI
		, A.VALIDATOR
		,COALESCE(PJ.PEGAWAI_DIKLAT_FILE_ID,PA.PEGAWAI_DIKLAT_FILE_ID)PEGAWAI_DIKLAT_FILE_ID,COALESCE(PJ.LINK_FILE,PA.LINK_FILE)LINK_FILE,B.KETERANGAN DIKLAT_KET
		FROM validasi.validasi_pegawai_diklat A
		LEFT JOIN DIKLAT B ON B.DIKLAT_ID = A.DIKLAT_ID
		LEFT JOIN PEGAWAI_DIKLAT_FILE PJ ON PJ.TEMP_VALIDASI_ID = A.TEMP_VALIDASI_ID
		LEFT JOIN PEGAWAI_DIKLAT_FILE PA ON PA.PEGAWAI_DIKLAT_ID = A.PEGAWAI_DIKLAT_ID
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

     function selectByParamsCheckPegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
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


    function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY PEGAWAI_DIKLAT_FILE_ID")
	{
		$str = "
		SELECT A.PEGAWAI_DIKLAT_FILE_ID, A.PEGAWAI_DIKLAT_ID,  A.PEGAWAI_ID, A.TEMP_VALIDASI_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE
		FROM PEGAWAI_DIKLAT_FILE A
		LEFT JOIN validasi.PEGAWAI_DIKLAT B ON A.TEMP_VALIDASI_ID = B.TEMP_VALIDASI_ID
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

    function selectByParamsServer($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY LINK_SERVER_ID")
	{
		$str = "
		SELECT LINK_SERVER_ID, LINK_SERVER, FOLDER, JENIS
		FROM LINK_SERVER
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