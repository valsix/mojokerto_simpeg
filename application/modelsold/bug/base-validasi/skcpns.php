<? 
  include_once(APPPATH.'/models/Entity.php');

  class SkCpns extends Entity{ 

	var $query;

    function SkCpns()
	{
      $this->Entity(); 
    }

    function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.SK_CPNS")); 
		
		$str = "INSERT INTO validasi.SK_CPNS (
				   SK_CPNS_ID, PEGAWAI_ID, PANGKAT_ID, 
				   PEJABAT_PENETAP_ID, PEJABAT_PENETAP, TMT_CPNS, TANGGAL_TUGAS, 
				   NO_STTPP, NO_NOTA, TANGGAL_NOTA, 
				   NO_SK,  NAMA_PENETAP, 
				   TANGGAL_SK, NIP_PENETAP, TANGGAL_UPDATE,
				   MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
				VALUES (
				  ".$this->getField("SK_CPNS_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("PANGKAT_ID").",
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  '".$this->getField("PEJABAT_PENETAP")."',
				  ".$this->getField("TMT_CPNS").",
				  ".$this->getField("TANGGAL_TUGAS").",
				  '".$this->getField("NO_STTP")."',
				  '".$this->getField("NO_NOTA")."',
				  ".$this->getField("TANGGAL_NOTA").",
				  '".$this->getField("NO_SK")."',				  
				  '".$this->getField("NAMA_PENETAP")."',
				  ".$this->getField("TANGGAL_SK").",
				  '".$this->getField("NIP_PENETAP")."',
				  NOW(),
				  ".$this->getField("MASA_KERJA_TAHUN").",
				  ".$this->getField("MASA_KERJA_BULAN").",
				  ".$this->getField("GAJI_POKOK").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("TEMP_VALIDASI_ID")."
				)"; 
				
		$this->query = $str;
		$this->tempValidasiId = $this->getField("TEMP_VALIDASI_ID");
		
		return $this->execQuery($str);
    }

    function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE validasi.SK_CPNS
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   PANGKAT_ID    = ".$this->getField("PANGKAT_ID").",
					   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   TMT_CPNS     = ".$this->getField("TMT_CPNS").",
					   TANGGAL_TUGAS    = ".$this->getField("TANGGAL_TUGAS").",					   
					   NO_NOTA  = '".$this->getField("NO_NOTA")."',
					   TANGGAL_NOTA = ".$this->getField("TANGGAL_NOTA").",
					   NO_SK        = '".$this->getField("NO_SK")."',					   
					   NAMA_PENETAP      = '".$this->getField("NAMA_PENETAP")."',
					   TANGGAL_SK   = ".$this->getField("TANGGAL_SK").",
					   NIP_PENETAP             = '".$this->getField("NIP_PENETAP")."',
					   TANGGAL_UPDATE             = NOW(),
					   MASA_KERJA_TAHUN    = ".$this->getField("MASA_KERJA_TAHUN").",
					   MASA_KERJA_BULAN    = ".$this->getField("MASA_KERJA_BULAN").",
					   GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }


    function insertadmin()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("SK_PNS_ID", $this->getNextId("SK_PNS_ID","SK_CPNS")); 
		
		$str = "INSERT INTO SK_CPNS (
				   SK_CPNS_ID, PEGAWAI_ID, PANGKAT_ID, 
				   PEJABAT_PENETAP_ID, PEJABAT_PENETAP, TMT_CPNS, TANGGAL_TUGAS, 
				   NO_STTPP, NO_NOTA, TANGGAL_NOTA, 
				   NO_SK,  NAMA_PENETAP, 
				   TANGGAL_SK, NIP_PENETAP, TANGGAL_UPDATE,
				   MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("SK_CPNS_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("PANGKAT_ID").",
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  '".$this->getField("PEJABAT_PENETAP")."',
				  ".$this->getField("TMT_CPNS").",
				  ".$this->getField("TANGGAL_TUGAS").",
				  '".$this->getField("NO_STTP")."',
				  '".$this->getField("NO_NOTA")."',
				  ".$this->getField("TANGGAL_NOTA").",
				  '".$this->getField("NO_SK")."',				  
				  '".$this->getField("NAMA_PENETAP")."',
				  ".$this->getField("TANGGAL_SK").",
				  '".$this->getField("NIP_PENETAP")."',
				  NOW(),
				  ".$this->getField("MASA_KERJA_TAHUN").",
				  ".$this->getField("MASA_KERJA_BULAN").",
				  ".$this->getField("GAJI_POKOK").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				
				)"; 
				
		$this->query = $str;
		$this->tempValidasiId = $this->getField("SK_CPNS_ID");
		
		return $this->execQuery($str);
    }

    function insertupload()
	{
		$this->setField("SK_CPNS_FILE_ID", $this->getNextId("SK_CPNS_FILE_ID","SK_CPNS_FILE")); 
		
		$str = "INSERT INTO SK_CPNS_FILE(
	            SK_CPNS_FILE_ID, SK_CPNS_ID, PEGAWAI_ID, 
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,LINK_SERVER)
				VALUES (
				  ".$this->getField("SK_CPNS_FILE_ID").",
				  ".$this->getField("SK_CPNS_ID").",
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

    function deletefile()
	{
        $str = "DELETE FROM SK_CPNS_FILE
                  WHERE 
                  SK_CPNS_FILE_ID= ".$this->getField("SK_CPNS_FILE_ID")."
                  AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
                  "; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }


    function updateadmin()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE SK_CPNS
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   PANGKAT_ID    = ".$this->getField("PANGKAT_ID").",
					   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   TMT_CPNS     = ".$this->getField("TMT_CPNS").",
					   TANGGAL_TUGAS    = ".$this->getField("TANGGAL_TUGAS").",					   
					   NO_NOTA  = '".$this->getField("NO_NOTA")."',
					   TANGGAL_NOTA = ".$this->getField("TANGGAL_NOTA").",
					   NO_SK        = '".$this->getField("NO_SK")."',					   
					   NAMA_PENETAP      = '".$this->getField("NAMA_PENETAP")."',
					   TANGGAL_SK   = ".$this->getField("TANGGAL_SK").",
					   NIP_PENETAP             = '".$this->getField("NIP_PENETAP")."',
					   TANGGAL_UPDATE             = NOW(),
					   MASA_KERJA_TAHUN    = ".$this->getField("MASA_KERJA_TAHUN").",
					   MASA_KERJA_BULAN    = ".$this->getField("MASA_KERJA_BULAN").",
					   GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE SK_CPNS_ID= ".$this->getField("SK_CPNS_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }

    
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT SK_CPNS_ID, PEGAWAI_ID, PANGKAT_ID, 
		 	 COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
		    (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
		     COALESCE(A.PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP_INFO,
			 TMT_CPNS, TANGGAL_TUGAS, 
			 NO_STTPP, NO_NOTA, TANGGAL_NOTA, 
			 NO_SK, TANGGAL_STTPP, NAMA_PENETAP, 
			 TANGGAL_SK, NIP_PENETAP, MASA_KERJA_TAHUN, MASA_KERJA_BULAN
			 ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI,
			 CASE WHEN FOTO_BLOB IS NULL THEN NULL ELSE 99 END FOTO_BLOB
			 , A.GAJI_POKOK
		FROM validasi.validasi_pegawai_sk_cpns A
		LEFT JOIN PEJABAT_PENETAP B ON A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID
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

    function selectByParamsAdmin($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.SK_CPNS_ID, A.PEGAWAI_ID, PANGKAT_ID, 
		 	 COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
		    (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
		     COALESCE(A.PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP_INFO,
			 TMT_CPNS, TANGGAL_TUGAS, 
			 NO_STTPP, NO_NOTA, TANGGAL_NOTA, 
			 NO_SK, TANGGAL_STTPP, NAMA_PENETAP, 
			 TANGGAL_SK, NIP_PENETAP, MASA_KERJA_TAHUN, MASA_KERJA_BULAN,
			 CASE WHEN FOTO_BLOB IS NULL THEN NULL ELSE 99 END FOTO_BLOB
			 , A.GAJI_POKOK
			 , K.LINK_FILE
			 , K.SK_CPNS_FILE_ID,K.LINK_SERVER
		FROM SK_CPNS A
		LEFT JOIN PEJABAT_PENETAP B ON A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID
		LEFT JOIN SK_CPNS_FILE K ON K.SK_CPNS_ID = A.SK_CPNS_ID
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
    function getCountByParams($paramsArray=array(), $statement="")
	{
		$str = "SELECT COUNT(A.SK_CPNS_ID) AS ROWCOUNT 
		FROM validasi.validasi_pegawai_sk_cpns A
		LEFT JOIN PEJABAT_PENETAP B ON A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID
		WHERE 1 = 1 "; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement;
		$this->query = $str;
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("rowcount"); 
		else 
			return 0; 
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


    function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY SK_CPNS_FILE_ID")
	{
		$str = "
		SELECT A.SK_CPNS_FILE_ID, A.SK_CPNS_ID, A.PEGAWAI_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE,A.LINK_SERVER
		FROM SK_CPNS_FILE A
		INNER JOIN SK_CPNS B ON A.SK_CPNS_ID = B.SK_CPNS_ID
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