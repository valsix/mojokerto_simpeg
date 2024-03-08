<? 
  include_once(APPPATH.'/models/Entity.php');

  class Hukuman extends Entity{ 

	var $query;

    function Hukuman()
	{
      $this->Entity(); 
    }


    function insert()
	{
		$this->setField("HUKUMAN_ID", $this->getNextId("HUKUMAN_ID","HUKUMAN")); 
		
		$str = "INSERT INTO HUKUMAN (
				   HUKUMAN_ID, PEGAWAI_ID, PEJABAT_PENETAP_ID, 
				   JENIS_HUKUMAN_ID, NO_SK, TANGGAL_SK, PEJABAT_PENETAP,
				   TMT_SK, KETERANGAN, BERLAKU, TINGKAT_HUKUMAN_ID, PERATURAN_ID,
				   TANGGAL_MULAI, TANGGAL_AKHIR, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("HUKUMAN_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  ".$this->getField("JENIS_HUKUMAN_ID").",
				  '".$this->getField("NO_SK")."',
				  ".$this->getField("TANGGAL_SK").",
				  '".$this->getField("PEJABAT_PENETAP")."',
				  ".$this->getField("TMT_SK").",
				  '".$this->getField("KETERANGAN")."',
				  ".$this->getField("BERLAKU").",
				  ".$this->getField("TINGKAT_HUKUMAN_ID").",
				  ".$this->getField("PERATURAN_ID").",
				  ".$this->getField("TANGGAL_MULAI").",
				  ".$this->getField("TANGGAL_AKHIR").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		$this->id = $this->getField("HUKUMAN_ID");	
		return $this->execQuery($str);
    }

    function insertupload()
	{
		$this->setField("HUKUMAN_FILE_ID", $this->getNextId("HUKUMAN_FILE_ID","HUKUMAN_FILE")); 
		
		$str = "INSERT INTO HUKUMAN_FILE(
	            HUKUMAN_FILE_ID, HUKUMAN_ID, PEGAWAI_ID, 
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,LINK_SERVER)
				VALUES (
				  ".$this->getField("HUKUMAN_FILE_ID").",
				  ".$this->getField("HUKUMAN_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("NAMA_FILE")."',
				  '".$this->getField("LINK_FILE")."',
				  '".$this->getField("TIPE_FILE")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  '".$this->getField("LINK_SERVER")."'
				)"; 
				
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }


    function update()
	{
		$str = "
				UPDATE HUKUMAN
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   PEJABAT_PENETAP_ID    = ".$this->getField("PEJABAT_PENETAP_ID").",
					   JENIS_HUKUMAN_ID             = ".$this->getField("JENIS_HUKUMAN_ID").",
					   TINGKAT_HUKUMAN_ID             = ".$this->getField("TINGKAT_HUKUMAN_ID").",
					   PERATURAN_ID             = ".$this->getField("PERATURAN_ID").",
					   NO_SK     = '".$this->getField("NO_SK")."',
					   TANGGAL_SK    = ".$this->getField("TANGGAL_SK").",
					   TMT_SK    = ".$this->getField("TMT_SK").",
					   KETERANGAN  = '".$this->getField("KETERANGAN")."',
					   BERLAKU  = ".$this->getField("BERLAKU").",
					   TANGGAL_MULAI= ".$this->getField("TANGGAL_MULAI").",
				  	   TANGGAL_AKHIR= ".$this->getField("TANGGAL_AKHIR").",
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE HUKUMAN_ID= ".$this->getField("HUKUMAN_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }


    function delete()
	{
        $str = "DELETE FROM HUKUMAN
                WHERE 
                  HUKUMAN_ID= '".$this->getField("HUKUMAN_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function deletefile()
	{
        $str = "DELETE FROM HUKUMAN_FILE
                  WHERE 
                  HUKUMAN_FILE_ID= ".$this->getField("HUKUMAN_FILE_ID")."
                  AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
                  "; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT 
		   CASE
			WHEN NOW() <= a.TANGGAL_AKHIR AND NOW() >= a.TANGGAL_MULAI
			THEN 'Ya'
			ELSE 'Tidak'
		   END STATUS_BERLAKU,
		   A.HUKUMAN_ID, A.PEGAWAI_ID, 
		   COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
		   (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
		   A.JENIS_HUKUMAN_ID, NO_SK, TANGGAL_SK, A.TINGKAT_HUKUMAN_ID,
		   TMT_SK, A.KETERANGAN, BERLAKU,
		   CASE BERLAKU WHEN 1 THEN 'Ya' ELSE 'Tidak' END LAKU,
		   B.JABATAN NMPEJABATPENETAP, C.NAMA NMTINGKATHUKUMAN, D.NAMA NMPERATURAN,
           E.NAMA NMJENISHUKUMAN, A.TANGGAL_MULAI, A.TANGGAL_AKHIR
           , K.LINK_FILE
		  , K.HUKUMAN_FILE_ID,K.LINK_SERVER
		FROM HUKUMAN A 
        LEFT JOIN PEJABAT_PENETAP B ON A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID
        LEFT JOIN TINGKAT_HUKUMAN C ON A.TINGKAT_HUKUMAN_ID = C.TINGKAT_HUKUMAN_ID
        LEFT JOIN PERATURAN D ON A.PERATURAN_ID = D.PERATURAN_ID
        LEFT JOIN JENIS_HUKUMAN E ON A.JENIS_HUKUMAN_ID = E.JENIS_HUKUMAN_ID
        LEFT JOIN HUKUMAN_FILE K ON K.HUKUMAN_ID = A.HUKUMAN_ID
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


    function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY HUKUMAN_FILE_ID")
	{
		$str = "
		SELECT A.HUKUMAN_FILE_ID, A.HUKUMAN_ID, A.PEGAWAI_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE,A.LINK_SERVER
		FROM HUKUMAN_FILE A
		INNER JOIN HUKUMAN B ON A.HUKUMAN_ID = B.HUKUMAN_ID
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