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
		$this->setField("PEGAWAI_DIKLAT_ID", $this->getNextId("PEGAWAI_DIKLAT_ID","PEGAWAI_DIKLAT")); 
		
		$str = "INSERT INTO PEGAWAI_DIKLAT (
				   PEGAWAI_DIKLAT_ID, PEGAWAI_ID, NOMOR, 
				   TANGGAL, TAHUN, DIKLAT_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("PEGAWAI_DIKLAT_ID").",
				  ".$this->getField("PEGAWAI_ID").",
				  '".$this->getField("NOMOR")."',
				  ".$this->getField("TANGGAL").",
				  ".$this->getField("TAHUN").",
				  ".$this->getField("DIKLAT_ID").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		$this->id = $this->getField("PEGAWAI_DIKLAT_ID");	
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function insertupload()
	{
		$this->setField("PEGAWAI_DIKLAT_FILE_ID", $this->getNextId("PEGAWAI_DIKLAT_FILE_ID","PEGAWAI_DIKLAT_FILE")); 
		
		$str = "INSERT INTO PEGAWAI_DIKLAT_FILE(
	            PEGAWAI_DIKLAT_FILE_ID, PEGAWAI_DIKLAT_ID, PEGAWAI_ID, 
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("PEGAWAI_DIKLAT_FILE_ID").",
				  ".$this->getField("PEGAWAI_DIKLAT_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
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
				UPDATE PEGAWAI_DIKLAT
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   NOMOR= '".$this->getField("NOMOR")."',
					   TANGGAL= ".$this->getField("TANGGAL").",
					   TAHUN= ".$this->getField("TAHUN").",
					   DIKLAT_ID= ".$this->getField("DIKLAT_ID").",
					   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE PEGAWAI_DIKLAT_ID= ".$this->getField("PEGAWAI_DIKLAT_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function updateupload()
    {
    	$str = "
    	UPDATE PEGAWAI_DIKLAT_FILE
    	SET    
    	LINK_FILE = '".$this->getField("LINK_FILE")."',
    	LINK_SERVER = '".$this->getField("LINK_SERVER")."',
    	NAMA_FILE = '".$this->getField("NAMA_FILE")."',
    	TIPE_FILE = '".$this->getField("TIPE_FILE")."',
    	LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
    	LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
    	LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
    	WHERE PEGAWAI_DIKLAT_FILE_ID= ".$this->getField("PEGAWAI_DIKLAT_FILE_ID")."
    	"; 
    	$this->query = $str;
				// echo $str;exit;
    	return $this->execQuery($str);
    }


    function delete()
	{
        $str = "DELETE FROM PEGAWAI_DIKLAT
                WHERE 
                  PEGAWAI_DIKLAT_ID= '".$this->getField("PEGAWAI_DIKLAT_ID")."'"; 
				  
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
		SELECT A.PEGAWAI_DIKLAT_ID, A.DIKLAT_ID, A.PEGAWAI_ID, NOMOR, TANGGAL, TAHUN,B.NAMA DIKLAT_NAMA,D.LINK_FILE,D.PEGAWAI_DIKLAT_FILE_ID,B.KETERANGAN DIKLAT_KET
		FROM PEGAWAI_DIKLAT A
		LEFT JOIN DIKLAT B ON B.DIKLAT_ID = A.DIKLAT_ID
		LEFT JOIN PEGAWAI_DIKLAT_FILE D ON D.PEGAWAI_DIKLAT_ID = A.PEGAWAI_DIKLAT_ID
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
		SELECT A.PEGAWAI_DIKLAT_FILE_ID,A.PEGAWAI_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE
		FROM PEGAWAI_DIKLAT_FILE A
		INNER JOIN PEGAWAI_DIKLAT B ON A.PEGAWAI_DIKLAT_ID = B.PEGAWAI_DIKLAT_ID
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