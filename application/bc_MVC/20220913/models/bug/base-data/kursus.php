<? 
  
  include_once(APPPATH.'/models/Entity.php');

  class Kursus extends Entity{ 

	var $query;

    function Kursus()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("KURSUS_ID", $this->getNextId("KURSUS_ID","KURSUS")); 
		
		$str = "INSERT INTO KURSUS (
				   KURSUS_ID, PEGAWAI_ID, TIPE, 
				   NAMA, LAMA, TANGGAL_MULAI, NO_PIAGAM, 
				   INSTANSI_ID,PENYELENGGARA,TAHUN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("KURSUS_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("TIPE").",
				  '".$this->getField("NAMA")."',
				  ".$this->getField("LAMA").",
				  ".$this->getField("TANGGAL_MULAI").",
				  '".$this->getField("NO_PIAGAM")."',
				  ".$this->getField("INSTANSI_ID").",
				  '".$this->getField("PENYELENGGARA")."',
				  ".$this->getField("TAHUN").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		$this->id = $this->getField("KURSUS_ID");		
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function insertupload()
	{
		$this->setField("KURSUS_FILE_ID", $this->getNextId("KURSUS_FILE_ID","KURSUS_FILE")); 
		
		$str = "INSERT INTO KURSUS_FILE(
	            KURSUS_FILE_ID, KURSUS_ID, PEGAWAI_ID, 
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,LINK_SERVER)
				VALUES (
				  ".$this->getField("KURSUS_FILE_ID").",
				  ".$this->getField("KURSUS_ID").",
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
				UPDATE KURSUS
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   TIPE= ".$this->getField("TIPE").",
					   NAMA= '".$this->getField("NAMA")."',
					   LAMA= ".$this->getField("LAMA").",
					   TANGGAL_MULAI= ".$this->getField("TANGGAL_MULAI").",
					   NO_PIAGAM= '".$this->getField("NO_PIAGAM")."',
					   INSTANSI_ID= ".$this->getField("INSTANSI_ID").",
					   PENYELENGGARA= '".$this->getField("PENYELENGGARA")."',
					   TAHUN= ".$this->getField("TAHUN").",
					   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE KURSUS_ID= ".$this->getField("KURSUS_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM KURSUS
                WHERE 
                  KURSUS_ID= '".$this->getField("KURSUS_ID")."'"; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function deletefile()
	{
        $str = "DELETE FROM KURSUS_FILE
                  WHERE 
                  KURSUS_FILE_ID= ".$this->getField("KURSUS_FILE_ID")."
                  AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
                  "; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.KURSUS_ID, A.PEGAWAI_ID, A.NAMA,
	    PENYELENGGARA, TANGGAL_MULAI, 
	    NO_PIAGAM
		, TIPE
		, CASE WHEN TIPE = 1 THEN 'DIKLAT TEKNIS' WHEN TIPE = 2 THEN 'DIKLAT FUNGSIONAL' 
		  ELSE  'SEMINAR/WORKSHOP/MAGANG/SEJENISNYA' END TIPE_NAMA
		, LAMA
		, A.INSTANSI_ID
		, B.NAMA INSTANSI_NAMA
		, A.TAHUN
		, K.LINK_FILE
		, K.KURSUS_FILE_ID,K.LINK_SERVER
		FROM KURSUS A
		LEFT JOIN INSTANSI B ON B.INSTANSI_ID = A.INSTANSI_ID
		LEFT JOIN KURSUS_FILE K ON K.KURSUS_ID = A.KURSUS_ID
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


    function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY KURSUS_FILE_ID")
	{
		$str = "
		SELECT A.KURSUS_FILE_ID, A.KURSUS_ID, A.PEGAWAI_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE,A.LINK_SERVER
		FROM KURSUS_FILE A
		INNER JOIN KURSUS B ON A.KURSUS_ID = B.KURSUS_ID
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