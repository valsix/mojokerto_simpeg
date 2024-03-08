<? 
  include_once(APPPATH.'/models/Entity.php');

  class PegawaiJabatan extends Entity{ 

	var $query;

    function PegawaiJabatan()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.PEGAWAI_JABATAN")); 
		
		$str = "INSERT INTO validasi.PEGAWAI_JABATAN (
						PEGAWAI_JABATAN_ID, PEGAWAI_ID, ESELON_ID, JENIS_JABATAN_ID, 
						TIPE_PEGAWAI_NEW_ID, JABATAN_FUNGSIONAL_NEW_ID, JABATAN_PELAKSANA_NEW_ID, 
						JABATAN_STRUKTURAL_NEW_ID, BUP, KELAS_JABATAN, TMT_JABATAN, TANGGAL_SK, 
						NO_SK, TUGAS_TAMBAHAN_ID, TUGAS_TAMBAHAN_NAMA,USER_APP_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,
						TEMP_VALIDASI_ID,UNOR_ID)
				VALUES (
				  ".$this->getField("PEGAWAI_JABATAN_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("ESELON_ID").",
				  ".$this->getField("JENIS_JABATAN_ID").",
				  '".$this->getField("TIPE_PEGAWAI_NEW_ID")."',
				  '".$this->getField("JABATAN_FUNGSIONAL_NEW_ID")."',
				  '".$this->getField("JABATAN_PELAKSANA_NEW_ID")."',
				  '".$this->getField("JABATAN_STRUKTURAL_NEW_ID")."',
				  ".$this->getField("BUP").",
				  ".$this->getField("KELAS_JABATAN").",
				  ".$this->getField("TMT_JABATAN").",
				  ".$this->getField("TANGGAL_SK").",
				  '".$this->getField("NO_SK")."',
				  '".$this->getField("TUGAS_TAMBAHAN_ID")."',
				  '".$this->getField("TUGAS_TAMBAHAN_NAMA")."',
				  ".$this->getField("USER_APP_ID").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("TEMP_VALIDASI_ID").",
				  ".$this->getField("UNOR_ID")."
				)"; 
				
		$this->query = $str;
		$this->id = $this->getField("TEMP_VALIDASI_ID");
		return $this->execQuery($str);
    }

    function insertupload()
	{
		$this->setField("PEGAWAI_JABATAN_FILE_ID", $this->getNextId("PEGAWAI_JABATAN_FILE_ID","PEGAWAI_JABATAN_FILE")); 
		
		$str = "INSERT INTO PEGAWAI_JABATAN_FILE(
	            PEGAWAI_JABATAN_FILE_ID, PEGAWAI_JABATAN_ID, JENIS_JABATAN_ID, PEGAWAI_ID, TEMP_VALIDASI_ID, 
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,LINK_SERVER)
				VALUES (
				  ".$this->getField("PEGAWAI_JABATAN_FILE_ID").",
				  ".$this->getField("PEGAWAI_JABATAN_ID").",
				  ".$this->getField("JENIS_JABATAN_ID").",
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
				UPDATE validasi.PEGAWAI_JABATAN
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   ESELON_ID    = ".$this->getField("ESELON_ID").",
					   JENIS_JABATAN_ID             = ".$this->getField("JENIS_JABATAN_ID").",
					   TIPE_PEGAWAI_NEW_ID     = '".$this->getField("TIPE_PEGAWAI_NEW_ID")."',
					   JABATAN_FUNGSIONAL_NEW_ID     = '".$this->getField("JABATAN_FUNGSIONAL_NEW_ID")."',
					   JABATAN_PELAKSANA_NEW_ID     = '".$this->getField("JABATAN_PELAKSANA_NEW_ID")."',
					   JABATAN_STRUKTURAL_NEW_ID     = '".$this->getField("JABATAN_STRUKTURAL_NEW_ID")."',
					   BUP     = ".$this->getField("BUP").",
					   KELAS_JABATAN     = ".$this->getField("KELAS_JABATAN").",
					   TMT_JABATAN     = ".$this->getField("TMT_JABATAN").",
					   TANGGAL_SK     = ".$this->getField("TANGGAL_SK").",
					   NO_SK     = '".$this->getField("NO_SK")."',
					   TUGAS_TAMBAHAN_ID     = '".$this->getField("TUGAS_TAMBAHAN_ID")."',
					   TUGAS_TAMBAHAN_NAMA     = '".$this->getField("TUGAS_TAMBAHAN_NAMA")."',
					   LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."',
					   UNOR_ID     = ".$this->getField("UNOR_ID")."
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
				// echo  $str;exit;
		return $this->execQuery($str);
    }

    function updatevalidasi()
    {
    	$str = "
	    	UPDATE validasi.PEGAWAI_JABATAN
	    	SET    
	    	PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
	    	ESELON_ID    = ".$this->getField("ESELON_ID").",
	    	JENIS_JABATAN_ID             = ".$this->getField("JENIS_JABATAN_ID").",
	    	TIPE_PEGAWAI_NEW_ID     = '".$this->getField("TIPE_PEGAWAI_NEW_ID")."',
	    	JABATAN_FUNGSIONAL_NEW_ID     = '".$this->getField("JABATAN_FUNGSIONAL_NEW_ID")."',
	    	JABATAN_PELAKSANA_NEW_ID     = '".$this->getField("JABATAN_PELAKSANA_NEW_ID")."',
	    	JABATAN_STRUKTURAL_NEW_ID     = '".$this->getField("JABATAN_STRUKTURAL_NEW_ID")."',
	    	BUP     = ".$this->getField("BUP").",
	    	KELAS_JABATAN     = ".$this->getField("KELAS_JABATAN").",
	    	TMT_JABATAN     = ".$this->getField("TMT_JABATAN").",
	    	TANGGAL_SK     = ".$this->getField("TANGGAL_SK").",
	    	NO_SK     = '".$this->getField("NO_SK")."',
	    	TUGAS_TAMBAHAN_ID     = '".$this->getField("TUGAS_TAMBAHAN_ID")."',
	    	TUGAS_TAMBAHAN_NAMA     = '".$this->getField("TUGAS_TAMBAHAN_NAMA")."',
	    	LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
	    	LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
	    	LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."',
	    	UNOR_ID     = ".$this->getField("UNOR_ID").",
	    	VALIDASI	= ".$this->getField("VALIDASI").",
	    	TANGGAL_VALIDASI= NOW()
	    	WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
    	"; 
    	$this->query = $str;
				// echo  $str;exit;
    	return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM validasi.PEGAWAI_JABATAN
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function deletefile()
	{
        $str = "DELETE FROM PEGAWAI_JABATAN_FILE
                  WHERE 
                  PEGAWAI_JABATAN_FILE_ID= ".$this->getField("PEGAWAI_JABATAN_FILE_ID")."
                  AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
                  "; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.PEGAWAI_JABATAN_ID, A.PEGAWAI_ID, A.ESELON_ID, A.JENIS_JABATAN_ID, 
		A.TIPE_PEGAWAI_NEW_ID, A.JABATAN_FUNGSIONAL_NEW_ID, A.JABATAN_PELAKSANA_NEW_ID, 
		A.JABATAN_STRUKTURAL_NEW_ID, A.BUP, A.KELAS_JABATAN, TMT_JABATAN, TANGGAL_SK, 
		NO_SK,A.TUGAS_TAMBAHAN_ID,A.TUGAS_TAMBAHAN_NAMA, VALIDASI, 
		VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI, 
		A.TEMP_VALIDASI_ID,B.NAMA KATEGORI_JABATAN,C.NAMA NAMA_FUNGSIONAL,D.NAMA JENIS_JABATAN,E.NAMA NAMA_PELAKSANA,F.NAMA NAMA_STRUKTURAL,H.NAMA ESELON_NAMA,A.UNOR_ID,COALESCE(PJ.LINK_FILE,PA.LINK_FILE) LINK_FILE,COALESCE(PJ.PEGAWAI_JABATAN_FILE_ID,PA.PEGAWAI_JABATAN_FILE_ID)PEGAWAI_JABATAN_FILE_ID,COALESCE(PJ.LINK_SERVER,PA.LINK_SERVER)LINK_SERVER
		FROM validasi.validasi_pegawai_jabatan A
		LEFT JOIN TIPE_PEGAWAI_NEW B ON B.TIPE_PEGAWAI_NEW_ID = A.TIPE_PEGAWAI_NEW_ID
		LEFT JOIN JABATAN_FUNGSIONAL_NEW C ON C.JABATAN_FUNGSIONAL_NEW_ID = A.JABATAN_FUNGSIONAL_NEW_ID
		LEFT JOIN JENIS_JABATAN D ON D.JENIS_JABATAN_ID = A.JENIS_JABATAN_ID
		LEFT JOIN JABATAN_PELAKSANA_NEW E ON E.JABATAN_PELAKSANA_NEW_ID = A.JABATAN_PELAKSANA_NEW_ID
		LEFT JOIN JABATAN_STRUKTURAL_NEW F ON F.JABATAN_STRUKTURAL_NEW_ID = A.JABATAN_STRUKTURAL_NEW_ID
		LEFT JOIN ESELON H ON H.ESELON_ID = A.ESELON_ID
		LEFT JOIN PEGAWAI_JABATAN_FILE PJ ON PJ.TEMP_VALIDASI_ID = A.TEMP_VALIDASI_ID
		LEFT JOIN PEGAWAI_JABATAN_FILE PA ON PA.PEGAWAI_JABATAN_ID = A.PEGAWAI_JABATAN_ID


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
	
	 function selectByParamsMonitoring($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		
		SELECT A.PEGAWAI_JABATAN_ID, A.PEGAWAI_ID, A.ESELON_ID, A.JENIS_JABATAN_ID, 
		A.TIPE_PEGAWAI_NEW_ID, A.JABATAN_FUNGSIONAL_NEW_ID, A.JABATAN_PELAKSANA_NEW_ID, 
		A.JABATAN_STRUKTURAL_NEW_ID, A.BUP, A.KELAS_JABATAN, A.TMT_JABATAN, TANGGAL_SK, 
		NO_SK,A.TUGAS_TAMBAHAN_ID,A.TUGAS_TAMBAHAN_NAMA, VALIDASI, 
		VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI, 
		A.TEMP_VALIDASI_ID,B.NAMA KATEGORI_JABATAN,C.NAMA NAMA_FUNGSIONAL,D.NAMA JENIS_JABATAN,E.NAMA NAMA_PELAKSANA,F.NAMA NAMA_STRUKTURAL,H.NAMA ESELON_NAMA
		,AMBIL_SATKER_INDUK(A.UNOR_ID) SATKER_INDUK_NAMA,  S.NAMA SATKER,COALESCE(PJ.LINK_FILE,PA.LINK_FILE) LINK_FILE,COALESCE(PJ.PEGAWAI_JABATAN_FILE_ID,PA.PEGAWAI_JABATAN_FILE_ID)PEGAWAI_JABATAN_FILE_ID,COALESCE(PJ.LINK_SERVER,PA.LINK_SERVER)LINK_SERVER
		FROM validasi.validasi_pegawai_jabatan A
		LEFT JOIN TIPE_PEGAWAI_NEW B ON B.TIPE_PEGAWAI_NEW_ID = A.TIPE_PEGAWAI_NEW_ID
		LEFT JOIN JABATAN_FUNGSIONAL_NEW C ON C.JABATAN_FUNGSIONAL_NEW_ID = A.JABATAN_FUNGSIONAL_NEW_ID
		LEFT JOIN JENIS_JABATAN D ON D.JENIS_JABATAN_ID = A.JENIS_JABATAN_ID
		LEFT JOIN JABATAN_PELAKSANA_NEW E ON E.JABATAN_PELAKSANA_NEW_ID = A.JABATAN_PELAKSANA_NEW_ID
		LEFT JOIN JABATAN_STRUKTURAL_NEW F ON F.JABATAN_STRUKTURAL_NEW_ID = A.JABATAN_STRUKTURAL_NEW_ID
		LEFT JOIN ESELON H ON H.ESELON_ID = A.ESELON_ID
		LEFT JOIN PEGAWAI P ON P.PEGAWAI_ID = A.PEGAWAI_ID
		LEFT JOIN SATKER S ON S.SATKER_ID = A.UNOR_ID
		LEFT JOIN PEGAWAI_JABATAN_FILE PJ ON PJ.TEMP_VALIDASI_ID = A.TEMP_VALIDASI_ID
		LEFT JOIN PEGAWAI_JABATAN_FILE PA ON PA.PEGAWAI_JABATAN_ID = A.PEGAWAI_JABATAN_ID
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

    function selectByParamsUnitKerja($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT	
			A.SATKER_ID,AMBIL_SATKER_INDUK(A.SATKER_ID) SATKER_INDUK_NAMA,  E.NAMA SATKER
		FROM PEGAWAI A 
		LEFT JOIN TIPE_PEGAWAI TP ON A.TIPE_PEGAWAI_ID = TP.TIPE_PEGAWAI_ID 
		INNER JOIN SATKER E ON A.SATKER_ID = E.SATKER_ID
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


    function selectByParamsJabatanTambahan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY JABATAN_STRUKTURAL_NEW_ID")
	{
		$str = "
		SELECT JABATAN_STRUKTURAL_NEW_ID,JABATAN_STRUKTURAL_NEW_ID_PARENT,A.NAMA,NAMA_UNOR,BUP,TIPE_PEGAWAI_NEW_ID,A.ESELON_ID,B.NAMA NAMA_ESELON 
		FROM JABATAN_STRUKTURAL_NEW A
		LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID 
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


    function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY PEGAWAI_JABATAN_FILE_ID")
	{
		$str = "
		SELECT A.PEGAWAI_JABATAN_FILE_ID, A.PEGAWAI_JABATAN_ID, A.JENIS_JABATAN_ID, A.PEGAWAI_ID, A.TEMP_VALIDASI_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE,A.LINK_SERVER
		FROM PEGAWAI_JABATAN_FILE A
		LEFT JOIN validasi.PEGAWAI_JABATAN B ON A.TEMP_VALIDASI_ID = B.TEMP_VALIDASI_ID

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