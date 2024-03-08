<? 
  include_once(APPPATH.'/models/Entity.php');

  class Anak extends Entity{ 

	var $query;

    function Anak()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("ANAK_ID", $this->getNextId("ANAK_ID","ANAK")); 
		
		$str = "INSERT INTO ANAK (
				   ANAK_ID, PEGAWAI_ID, PENDIDIKAN_ID, 
				   NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
				   JENIS_KELAMIN, STATUS_KELUARGA, STATUS_TUNJANGAN, 
				   PEKERJAAN, AWAL_BAYAR, AKHIR_BAYAR, 
				   TANGGAL_UPDATE, FOTO, USER_APP_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("ANAK_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("PENDIDIKAN_ID").",
				  '".$this->getField("NAMA")."',
				  '".$this->getField("TEMPAT_LAHIR")."',
				  ".$this->getField("TANGGAL_LAHIR").",
				  '".$this->getField("JENIS_KELAMIN")."',
				  ".$this->getField("STATUS_KELUARGA").",
				  ".$this->getField("STATUS_TUNJANGAN").",
				  '".$this->getField("PEKERJAAN")."',
				  ".$this->getField("AWAL_BAYAR").",
				  ".$this->getField("AKHIR_BAYAR").",
				  NOW() ,
				  '".$this->getField("FOTO")."',
				  ".$this->getField("USER_APP_ID").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		$this->id = $this->getField("ANAK_ID");
		// echo $str;exit;

		return $this->execQuery($str);
    }

    function insertupload()
	{
		$this->setField("ANAK_FILE_ID", $this->getNextId("ANAK_FILE_ID","ANAK_FILE")); 
		
		$str = "INSERT INTO ANAK_FILE(
	            ANAK_FILE_ID, ANAK_ID, PEGAWAI_ID, 
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,LINK_SERVER)
				VALUES (
				  ".$this->getField("ANAK_FILE_ID").",
				  ".$this->getField("ANAK_ID").",
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
				UPDATE ANAK
				SET    
				PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
				PENDIDIKAN_ID= ".$this->getField("PENDIDIKAN_ID").",
				NAMA= '".$this->getField("NAMA")."',
				TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."',
				TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR").",
				JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."',
				STATUS_KELUARGA= ".$this->getField("STATUS_KELUARGA").",
				STATUS_TUNJANGAN= ".$this->getField("STATUS_TUNJANGAN").",
				PEKERJAAN= '".$this->getField("PEKERJAAN")."',
				AWAL_BAYAR= ".$this->getField("AWAL_BAYAR").",
				AKHIR_BAYAR= ".$this->getField("AKHIR_BAYAR").",
				TANGGAL_UPDATE= NOW() ,
				FOTO= '".$this->getField("FOTO")."',
				USER_APP_ID= ".$this->getField("USER_APP_ID").",
				LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
				LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
				LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE ANAK_ID= ".$this->getField("ANAK_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

   	function updateupload()
 	{
 		$str = "
 		UPDATE ANAK_FILE
 		SET    
 		LINK_FILE = '".$this->getField("LINK_FILE")."',
 		LINK_SERVER = '".$this->getField("LINK_SERVER")."',
 		NAMA_FILE = '".$this->getField("NAMA_FILE")."',
 		TIPE_FILE = '".$this->getField("TIPE_FILE")."',
 		LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
 		LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
 		LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
 		WHERE ANAK_ID= ".$this->getField("ANAK_ID")."
 		"; 
 		$this->query = $str;
				// echo $str;exit;
 		return $this->execQuery($str);
 	}


    function delete()
	{
        $str = "DELETE FROM ANAK
                WHERE 
                  ANAK_ID= '".$this->getField("ANAK_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function deletefile()
	{
        $str = "DELETE FROM ANAK_FILE
                  WHERE 
                  ANAK_FILE_ID= ".$this->getField("ANAK_FILE_ID")."
                  AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
                  "; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.ANAK_ID, A.PEGAWAI_ID,  A.PENDIDIKAN_ID, 
			A.NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
			JENIS_KELAMIN, STATUS_KELUARGA, STATUS_TUNJANGAN, 
			PEKERJAAN, AWAL_BAYAR, AKHIR_BAYAR, 
			B.NAMA NMPENDIDIKAN,
			CASE WHEN STATUS_KELUARGA = 1 THEN 'Kandung' WHEN STATUS_KELUARGA = 2 THEN 'Tiri' ELSE  'Angkat' END KELUARGA,
			CASE WHEN STATUS_KELUARGA = 1 THEN 'AK' WHEN STATUS_KELUARGA = 2 THEN 'AT' ELSE 'AA' END KELUARGA_LAP,
			CASE WHEN STATUS_TUNJANGAN = 1 THEN 'Dapat' ELSE 'Tidak' END TUNJANGAN,
			CASE WHEN JENIS_KELAMIN = 'L' THEN 'Laki-Laki' ELSE 'Perempuan' END KELAMIN,
			C.ANAK_FILE_ID,
			C.LINK_FILE, C.TIPE_FILE,C.LINK_SERVER
			
		FROM ANAK A
		LEFT JOIN PENDIDIKAN B ON A.PENDIDIKAN_ID = B.PENDIDIKAN_ID
		LEFT JOIN ANAK_FILE C ON C.ANAK_ID = A.ANAK_ID
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


    function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY ANAK_FILE_ID")
	{
		$str = "
		SELECT A.ANAK_FILE_ID, A.ANAK_ID, A.PEGAWAI_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE,A.LINK_SERVER
		FROM ANAK_FILE A
		INNER JOIN ANAK B ON A.ANAK_ID = B.ANAK_ID
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