<? 
  include_once(APPPATH.'/models/Entity.php');

  class Penghargaan extends Entity{ 

	var $query;

    function Penghargaan()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.PENGHARGAAN")); 
		
		$str = "INSERT INTO validasi.PENGHARGAAN (
				   PENGHARGAAN_ID, PEGAWAI_ID, PEJABAT_PENETAP_ID, PEJABAT_PENETAP,
				   NAMA, NO_SK, TANGGAL_SK, 
				   TAHUN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
				VALUES (
				  ".$this->getField("PENGHARGAAN_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  '".$this->getField("PEJABAT_PENETAP")."',
				  '".$this->getField("NAMA")."',
				  '".$this->getField("NO_SK")."',
				  ".$this->getField("TANGGAL_SK").",
				  ".$this->getField("TAHUN").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("TEMP_VALIDASI_ID")."
				)"; 
				
		$this->query = $str;
		$this->id = $this->getField("TEMP_VALIDASI_ID");	
		return $this->execQuery($str);
    }

    function insertupload()
	{
		$this->setField("PENGHARGAAN_FILE_ID", $this->getNextId("PENGHARGAAN_FILE_ID","PENGHARGAAN_FILE")); 
		
		$str = "INSERT INTO PENGHARGAAN_FILE(
	            PENGHARGAAN_FILE_ID, PENGHARGAAN_ID, PEGAWAI_ID, TEMP_VALIDASI_ID, 
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,LINK_SERVER)
				VALUES (
				  ".$this->getField("PENGHARGAAN_FILE_ID").",
				  ".$this->getField("PENGHARGAAN_ID").",
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
				UPDATE validasi.PENGHARGAAN
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   NAMA= '".$this->getField("NAMA")."',
					   NO_SK= '".$this->getField("NO_SK")."',
					   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
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
				UPDATE validasi.PENGHARGAAN
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   NAMA= '".$this->getField("NAMA")."',
					   NO_SK= '".$this->getField("NO_SK")."',
					   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
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
        $str = "DELETE FROM validasi.PENGHARGAAN
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function deletefile()
	{
        $str = "DELETE FROM PENGHARGAAN_FILE
                  WHERE 
                  PENGHARGAAN_FILE_ID= ".$this->getField("PENGHARGAAN_FILE_ID")."
                  AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
                  "; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.PENGHARGAAN_ID, A.PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, 
		   COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
		   (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
		   A.NAMA, NO_SK, TANGGAL_SK, 
		   TAHUN, B.NAMA NMPEJABAT,
		   CASE A.NAMA 
			WHEN '1' THEN 'Satya Lencana Karya Satya X (Perunggu)' 
			WHEN '2' THEN 'Satya Lencana Karya Satya XX (Perak)' 
			WHEN '3' THEN 'Satya Lencana Karya Satya XXX (Emas)' 
			ELSE A.NAMA END NMPENGHARGAAN,
		    A.TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
		     ,COALESCE(PJ.LINK_FILE,PA.LINK_FILE) LINK_FILE
		     ,COALESCE(PJ.PENGHARGAAN_FILE_ID,PA.PENGHARGAAN_FILE_ID)PENGHARGAAN_FILE_ID
		     ,COALESCE(PJ.LINK_SERVER,PA.LINK_SERVER)LINK_SERVER
		FROM validasi.validasi_pegawai_penghargaan A
        LEFT JOIN PEJABAT_PENETAP B ON (A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID)
        LEFT JOIN PENGHARGAAN_FILE PJ ON PJ.TEMP_VALIDASI_ID = A.TEMP_VALIDASI_ID
		LEFT JOIN PENGHARGAAN_FILE PA ON PA.PENGHARGAAN_ID = A.PENGHARGAAN_ID
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

     function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY PENGHARGAAN_FILE_ID")
	{
		$str = "
		SELECT A.PENGHARGAAN_FILE_ID, A.PENGHARGAAN_ID, A.PEGAWAI_ID, A.TEMP_VALIDASI_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE,A.LINK_SERVER
		FROM PENGHARGAAN_FILE A
		LEFT JOIN validasi.PENGHARGAAN B ON A.TEMP_VALIDASI_ID = B.TEMP_VALIDASI_ID
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