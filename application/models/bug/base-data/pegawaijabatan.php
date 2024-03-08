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
		$this->setField("PEGAWAI_JABATAN_ID", $this->getNextId("PEGAWAI_JABATAN_ID","PEGAWAI_JABATAN")); 
		
		$str = "INSERT INTO PEGAWAI_JABATAN (
						PEGAWAI_JABATAN_ID, PEGAWAI_ID, ESELON_ID, JENIS_JABATAN_ID, 
						TIPE_PEGAWAI_NEW_ID, JABATAN_FUNGSIONAL_NEW_ID, JABATAN_PELAKSANA_NEW_ID, 
						JABATAN_STRUKTURAL_NEW_ID, BUP, KELAS_JABATAN, TMT_JABATAN, TANGGAL_SK, 
						NO_SK, TUGAS_TAMBAHAN_ID, TUGAS_TAMBAHAN_NAMA,USER_APP_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,UNOR_ID)
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
				  ".$this->getField("UNOR_ID")."
				)"; 
			
		$this->id = $this->getField("PEGAWAI_JABATAN_ID");					
		$this->query = $str;
		return $this->execQuery($str);
    }

    function insertupload()
	{
		$this->setField("PEGAWAI_JABATAN_FILE_ID", $this->getNextId("PEGAWAI_JABATAN_FILE_ID","PEGAWAI_JABATAN_FILE")); 
		
		$str = "INSERT INTO PEGAWAI_JABATAN_FILE(
	            PEGAWAI_JABATAN_FILE_ID, PEGAWAI_JABATAN_ID, JENIS_JABATAN_ID, PEGAWAI_ID, 
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,LINK_SERVER)
				VALUES (
				  ".$this->getField("PEGAWAI_JABATAN_FILE_ID").",
				  ".$this->getField("PEGAWAI_JABATAN_ID").",
				  ".$this->getField("JENIS_JABATAN_ID").",
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

    function updateupload()
	{
		$str = "
				UPDATE PEGAWAI_JABATAN_FILE
				SET    
				  	   LINK_FILE = '".$this->getField("LINK_FILE")."',
				  	   LINK_SERVER = '".$this->getField("LINK_SERVER")."',
					   NAMA_FILE = '".$this->getField("NAMA_FILE")."',
					   TIPE_FILE = '".$this->getField("TIPE_FILE")."',
				  	   LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
				  	   LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
				  	   LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE PEGAWAI_JABATAN_FILE_ID= ".$this->getField("PEGAWAI_JABATAN_FILE_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }


    function update()
	{
		$str = "
				UPDATE PEGAWAI_JABATAN
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
					   WHERE PEGAWAI_JABATAN_ID= ".$this->getField("PEGAWAI_JABATAN_ID")."
				"; 
				$this->query = $str;
				// echo  $str;exit;
		return $this->execQuery($str);
    }

    function updatepegawai()
	{
		$str = "
				UPDATE PEGAWAI
				SET    
					   PEGAWAI_JABATAN_ID    = ".$this->getField("PEGAWAI_JABATAN_ID")."
					  
					   WHERE PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
				"; 
				$this->query = $str;
				// echo  $str;exit;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM PEGAWAI_JABATAN
                WHERE 
                  PEGAWAI_JABATAN_ID= '".$this->getField("PEGAWAI_JABATAN_ID")."'"; 
				  
		$this->query = $str;
		// echo $str;exit;
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
		NO_SK,A.TUGAS_TAMBAHAN_ID,A.TUGAS_TAMBAHAN_NAMA,B.NAMA KATEGORI_JABATAN,C.NAMA NAMA_FUNGSIONAL,D.NAMA JENIS_JABATAN,E.NAMA NAMA_PELAKSANA,F.NAMA NAMA_STRUKTURAL,H.NAMA ESELON_NAMA,A.UNOR_ID,PJ.LINK_FILE
		,PJ.PEGAWAI_JABATAN_FILE_ID,PJ.LINK_SERVER
		FROM PEGAWAI_JABATAN A
		LEFT JOIN TIPE_PEGAWAI_NEW B ON B.TIPE_PEGAWAI_NEW_ID = A.TIPE_PEGAWAI_NEW_ID
		LEFT JOIN JABATAN_FUNGSIONAL_NEW C ON C.JABATAN_FUNGSIONAL_NEW_ID = A.JABATAN_FUNGSIONAL_NEW_ID
		LEFT JOIN JENIS_JABATAN D ON D.JENIS_JABATAN_ID = A.JENIS_JABATAN_ID
		LEFT JOIN JABATAN_PELAKSANA_NEW E ON E.JABATAN_PELAKSANA_NEW_ID = A.JABATAN_PELAKSANA_NEW_ID
		LEFT JOIN JABATAN_STRUKTURAL_NEW F ON F.JABATAN_STRUKTURAL_NEW_ID = A.JABATAN_STRUKTURAL_NEW_ID
		LEFT JOIN ESELON H ON H.ESELON_ID = A.ESELON_ID
		LEFT JOIN PEGAWAI_JABATAN_FILE PJ ON PJ.PEGAWAI_JABATAN_ID = A.PEGAWAI_JABATAN_ID
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
		NO_SK,A.TUGAS_TAMBAHAN_ID,A.TUGAS_TAMBAHAN_NAMA, B.NAMA KATEGORI_JABATAN,C.NAMA NAMA_FUNGSIONAL,D.NAMA JENIS_JABATAN,E.NAMA NAMA_PELAKSANA,F.NAMA NAMA_STRUKTURAL,H.NAMA ESELON_NAMA
		,AMBIL_SATKER_INDUK(A.UNOR_ID) SATKER_INDUK_NAMA,  S.NAMA SATKER
		,AMBIL_SATKER_INDUK(P.UNOR_ID) SATKER_INDUK_NAMA_INFO,  Z.NAMA SATKER_INFO,PJ.LINK_FILE,PJ.PEGAWAI_JABATAN_FILE_ID,PJ.LINK_SERVER
		FROM PEGAWAI_JABATAN A
		LEFT JOIN TIPE_PEGAWAI_NEW B ON B.TIPE_PEGAWAI_NEW_ID = A.TIPE_PEGAWAI_NEW_ID
		LEFT JOIN JABATAN_FUNGSIONAL_NEW C ON C.JABATAN_FUNGSIONAL_NEW_ID = A.JABATAN_FUNGSIONAL_NEW_ID
		LEFT JOIN JENIS_JABATAN D ON D.JENIS_JABATAN_ID = A.JENIS_JABATAN_ID
		LEFT JOIN JABATAN_PELAKSANA_NEW E ON E.JABATAN_PELAKSANA_NEW_ID = A.JABATAN_PELAKSANA_NEW_ID
		LEFT JOIN JABATAN_STRUKTURAL_NEW F ON F.JABATAN_STRUKTURAL_NEW_ID = A.JABATAN_STRUKTURAL_NEW_ID
		LEFT JOIN ESELON H ON H.ESELON_ID = A.ESELON_ID
		LEFT JOIN PEGAWAI P ON P.PEGAWAI_ID = A.PEGAWAI_ID
		LEFT JOIN SATKER S ON S.SATKER_ID = A.UNOR_ID
		LEFT JOIN SATKER Z ON Z.SATKER_ID = P.UNOR_ID
		LEFT JOIN PEGAWAI_JABATAN_FILE PJ ON PJ.PEGAWAI_JABATAN_ID = A.PEGAWAI_JABATAN_ID
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
		SELECT A.PEGAWAI_JABATAN_FILE_ID, A.PEGAWAI_JABATAN_ID, A.JENIS_JABATAN_ID, A.PEGAWAI_ID, A.PEGAWAI_JABATAN_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE,A.LINK_SERVER
		FROM PEGAWAI_JABATAN_FILE A
		INNER JOIN PEGAWAI_JABATAN B ON A.PEGAWAI_JABATAN_ID = B.PEGAWAI_JABATAN_ID
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