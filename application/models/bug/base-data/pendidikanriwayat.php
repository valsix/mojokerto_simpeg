<? 
  include_once(APPPATH.'/models/Entity.php');

  class PendidikanRiwayat extends Entity{ 

	var $query;

    function PendidikanRiwayat()
	{
      $this->Entity(); 
    }

    

   function insertadmin()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("PENDIDIKAN_RIWAYAT_ID", $this->getNextId("PENDIDIKAN_RIWAYAT_ID","PENDIDIKAN_RIWAYAT")); 

		$str = "INSERT INTO PENDIDIKAN_RIWAYAT (
				   PENDIDIKAN_RIWAYAT_ID, PEGAWAI_ID, PENDIDIKAN_ID, 
				   NAMA, JURUSAN, TEMPAT, 
				   KEPALA, NO_STTB, TANGGAL_STTB, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, JURUSAN_PENDIDIKAN_ID)
				VALUES (
				  ".$this->getField("PENDIDIKAN_RIWAYAT_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("PENDIDIKAN_ID")."',
				  '".$this->getField("NAMA")."',
				  '".$this->getField("JURUSAN")."',
				  '".$this->getField("TEMPAT")."',
				  '".$this->getField("KEPALA")."',
				  '".$this->getField("NO_STTB")."',
				  ".$this->getField("TANGGAL_STTB").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("JURUSAN_PENDIDIKAN_ID")."
				)"; 
				
		$this->query = $str;
		$this->id= $this->getField("PENDIDIKAN_RIWAYAT_ID");
		$this->query = $str;
		return $this->execQuery($str);
    }

    function updateadmin()
	{
		$str = "
				UPDATE PENDIDIKAN_RIWAYAT
				SET    
					   PENDIDIKAN_ID    		= ".$this->getField("PENDIDIKAN_ID").",
					   NAMA             		= '".$this->getField("NAMA")."',
					   JURUSAN    				= '".$this->getField("JURUSAN")."',
					   TEMPAT    				= '".$this->getField("TEMPAT")."',
					   KEPALA    				= '".$this->getField("KEPALA")."',
					   NO_STTB  				= '".$this->getField("NO_STTB")."',
					   TANGGAL_STTB 			= ".$this->getField("TANGGAL_STTB").",
				  	   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
					  JURUSAN_PENDIDIKAN_ID= ".$this->getField("JURUSAN_PENDIDIKAN_ID")."
				WHERE  PENDIDIKAN_RIWAYAT_ID    = ".$this->getField("PENDIDIKAN_RIWAYAT_ID")." AND PEGAWAI_ID       = ".$this->getField("PEGAWAI_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM PENDIDIKAN_RIWAYAT
                WHERE 
                  PENDIDIKAN_RIWAYAT_ID= '".$this->getField("PENDIDIKAN_RIWAYAT_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }
    
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT PENDIDIKAN_RIWAYAT_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, A.PENDIDIKAN_ID, 
		   A.NAMA, A.JURUSAN_PENDIDIKAN_ID, 
           TEMPAT, 
		   KEPALA, NO_STTB, TANGGAL_STTB, B.NAMA as PENDIDIKAN, A.JURUSAN JURUSAN,
		   CASE A.PENDIDIKAN_ID WHEN NULL THEN JURUSAN ELSE C.NAMA  END NMJURUSAN
		   ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI,C.JURUSAN_PENDIDIKAN_ID
		FROM validasi.validasi_pegawai_pendidikan_riwayat A
        LEFT JOIN PENDIDIKAN B ON A.PENDIDIKAN_ID = B.PENDIDIKAN_ID
        LEFT JOIN JURUSAN_PENDIDIKAN C ON A.JURUSAN_PENDIDIKAN_ID = C.JURUSAN_PENDIDIKAN_ID
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


    function selectByParamsAdmin($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder= "ORDER BY PENDIDIKAN_ID ASC")
	{
		$str = "SELECT PENDIDIKAN_RIWAYAT_ID, PEGAWAI_ID, a.PENDIDIKAN_ID, 
                   a.NAMA, JURUSAN_PENDIDIKAN_ID, TEMPAT, 
                   KEPALA, NO_STTB, TANGGAL_STTB, b.NAMA as PENDIDIKAN, encode(FOTO_BLOB, 'base64') FOTO_BLOB,a.JURUSAN JURUSAN,
				   (CASE a.PENDIDIKAN_ID WHEN NULL THEN JURUSAN ELSE (SELECT X.NAMA  FROM JURUSAN_PENDIDIKAN X WHERE X.JURUSAN_PENDIDIKAN_ID = a.JURUSAN_PENDIDIKAN_ID) END) NMJURUSAN
				   , A.PENDIDIKAN_JURUSAN_ID, C.NAMA PENDIDIKAN_JURUSAN_NAMA, A.PENDIDIKAN_JURUSAN_PRODI_ID, D.NAMA PENDIDIKAN_JURUSAN_PRODI_NAMA
                FROM PENDIDIKAN_RIWAYAT a
				INNER JOIN PENDIDIKAN b ON a.PENDIDIKAN_ID = b.PENDIDIKAN_ID
				LEFT JOIN PENDIDIKAN_JURUSAN C ON A.PENDIDIKAN_JURUSAN_ID = C.PENDIDIKAN_JURUSAN_ID
				LEFT JOIN PENDIDIKAN_JURUSAN_PRODI D ON A.PENDIDIKAN_JURUSAN_PRODI_ID = D.PENDIDIKAN_JURUSAN_PRODI_ID
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