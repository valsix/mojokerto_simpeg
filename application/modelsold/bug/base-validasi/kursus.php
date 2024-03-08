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
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.KURSUS")); 
		
		$str = "INSERT INTO validasi.KURSUS (
				   KURSUS_ID, PEGAWAI_ID, TIPE, 
				   NAMA, LAMA, TANGGAL_MULAI, NO_PIAGAM, 
				   INSTANSI_ID,PENYELENGGARA,TAHUN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
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
		$this->setField("KURSUS_FILE_ID", $this->getNextId("KURSUS_FILE_ID","KURSUS_FILE")); 
		
		$str = "INSERT INTO KURSUS_FILE(
	            KURSUS_FILE_ID, KURSUS_ID, PEGAWAI_ID, TEMP_VALIDASI_ID, 
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,LINK_SERVER)
				VALUES (
				  ".$this->getField("KURSUS_FILE_ID").",
				  ".$this->getField("KURSUS_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("TEMP_VALIDASI_ID").",
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
				UPDATE validasi.KURSUS
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
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function updatevalidasi()
	{
		$str = "
				UPDATE validasi.KURSUS
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
        $str = "DELETE FROM validasi.KURSUS
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
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
		SELECT A.KURSUS_ID, A.PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, A.NAMA,
	    PENYELENGGARA, TANGGAL_MULAI, 
	    NO_PIAGAM
		, A.TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
		, TIPE
		, CASE WHEN TIPE = 1 THEN 'DIKLAT TEKNIS' WHEN TIPE = 2 THEN 'DIKLAT FUNGSIONAL' 
		  ELSE  'SEMINAR/WORKSHOP/MAGANG/SEJENISNYA' END TIPE_NAMA
		, LAMA
		, A.INSTANSI_ID
		, B.NAMA INSTANSI_NAMA
		, A.TAHUN
		,COALESCE(PJ.LINK_FILE,PA.LINK_FILE) LINK_FILE,COALESCE(PJ.KURSUS_FILE_ID,PA.KURSUS_FILE_ID)KURSUS_FILE_ID,COALESCE(PJ.LINK_SERVER,PA.LINK_SERVER)LINK_SERVER
		FROM validasi.validasi_pegawai_kursus A
		LEFT JOIN INSTANSI B ON B.INSTANSI_ID = A.INSTANSI_ID
		LEFT JOIN KURSUS_FILE PJ ON PJ.TEMP_VALIDASI_ID = A.TEMP_VALIDASI_ID
		LEFT JOIN KURSUS_FILE PA ON PA.KURSUS_ID = A.KURSUS_ID
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
		SELECT A.KURSUS_FILE_ID, A.KURSUS_ID, A.PEGAWAI_ID, A.TEMP_VALIDASI_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE,A.LINK_SERVER
		FROM KURSUS_FILE A
		LEFT JOIN validasi.KURSUS B ON A.TEMP_VALIDASI_ID = B.TEMP_VALIDASI_ID
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