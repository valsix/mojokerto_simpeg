<? 
  include_once(APPPATH.'/models/Entity.php');

  class TambahanMasaKerja extends Entity{ 

	var $query;

    function TambahanMasaKerja()
	{
      $this->Entity(); 
    }

   function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.TAMBAHAN_MASA_KERJA")); 
		
		$str = "INSERT INTO validasi.TAMBAHAN_MASA_KERJA (
				   TAMBAHAN_MASA_KERJA_ID, PEGAWAI_ID, PANGKAT_ID, 
				   PEJABAT_PENETAP_ID, PEJABAT_PENETAP, NO_SK, 
				   TANGGAL_SK, TMT_SK, TAHUN_TAMBAHAN, 
				   BULAN_TAMBAHAN, TAHUN_BARU, BULAN_BARU, GAJI_POKOK, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
				VALUES (
				  ".$this->getField("TAMBAHAN_MASA_KERJA_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("PANGKAT_ID").",
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  '".$this->getField("PEJABAT_PENETAP")."',
				  '".$this->getField("NO_SK")."',
				  ".$this->getField("TANGGAL_SK").",
				  ".$this->getField("TMT_SK").",
				  '".$this->getField("TAHUN_TAMBAHAN")."',
				  '".$this->getField("BULAN_TAMBAHAN")."',
				  '".$this->getField("TAHUN_BARU")."',
				  '".$this->getField("BULAN_BARU")."',
				  ".$this->getField("GAJI_POKOK").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("TEMP_VALIDASI_ID")."
				)"; 
				
		$this->query = $str;
		// echo $str;exit;
		$this->tempValidasiId = $this->getField("TEMP_VALIDASI_ID");
		return $this->execQuery($str);
    }

    function insertupload()
	{
		$this->setField("TAMBAHAN_MASA_KERJA_FILE_ID", $this->getNextId("TAMBAHAN_MASA_KERJA_FILE_ID","TAMBAHAN_MASA_KERJA_FILE")); 
		
		$str = "INSERT INTO TAMBAHAN_MASA_KERJA_FILE(
	            TAMBAHAN_MASA_KERJA_FILE_ID, TAMBAHAN_MASA_KERJA_ID, PEGAWAI_ID, TEMP_VALIDASI_ID, 
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,LINK_SERVER)
				VALUES (
				  ".$this->getField("TAMBAHAN_MASA_KERJA_FILE_ID").",
				  ".$this->getField("TAMBAHAN_MASA_KERJA_ID").",
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
				UPDATE validasi.TAMBAHAN_MASA_KERJA
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   PANGKAT_ID= ".$this->getField("PANGKAT_ID").",
					   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   NO_SK= '".$this->getField("NO_SK")."',
					   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
					   TMT_SK= ".$this->getField("TMT_SK").",
					   TAHUN_TAMBAHAN= '".$this->getField("TAHUN_TAMBAHAN")."',
					   BULAN_TAMBAHAN= '".$this->getField("BULAN_TAMBAHAN")."',
					   TAHUN_BARU= '".$this->getField("TAHUN_BARU")."',
					   BULAN_BARU= '".$this->getField("BULAN_BARU")."',
					   GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
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
				UPDATE validasi.TAMBAHAN_MASA_KERJA
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   PANGKAT_ID= ".$this->getField("PANGKAT_ID").",
					   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   NO_SK= '".$this->getField("NO_SK")."',
					   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
					   TMT_SK= ".$this->getField("TMT_SK").",
					   TAHUN_TAMBAHAN= '".$this->getField("TAHUN_TAMBAHAN")."',
					   BULAN_TAMBAHAN= '".$this->getField("BULAN_TAMBAHAN")."',
					   TAHUN_BARU= '".$this->getField("TAHUN_BARU")."',
					   BULAN_BARU= '".$this->getField("BULAN_BARU")."',
					   GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
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
        $str = "DELETE FROM validasi.TAMBAHAN_MASA_KERJA
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function deletefile()
	{
        $str = "DELETE FROM TAMBAHAN_MASA_KERJA_FILE
                  WHERE 
                  TAMBAHAN_MASA_KERJA_FILE_ID= ".$this->getField("TAMBAHAN_MASA_KERJA_FILE_ID")."
                  AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
                  "; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.TAMBAHAN_MASA_KERJA_ID, A.PEGAWAI_ID, A.NO_SK, 
		 A.TANGGAL_SK, A.TMT_SK, A.TAHUN_TAMBAHAN, 
		 A.BULAN_TAMBAHAN, A.TAHUN_BARU, A.BULAN_BARU, 
		 A.TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
		 , PANGKAT_ID, 
		 COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
		(CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
		 COALESCE(A.PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP_INFO
		 , A.GAJI_POKOK
		 ,COALESCE(PJ.LINK_FILE,PA.LINK_FILE) LINK_FILE,COALESCE(PJ.TAMBAHAN_MASA_KERJA_FILE_ID,PA.TAMBAHAN_MASA_KERJA_FILE_ID)TAMBAHAN_MASA_KERJA_FILE_ID,COALESCE(PJ.LINK_SERVER,PA.LINK_SERVER)LINK_SERVER
		FROM validasi.validasi_pegawai_tambahan_masa_kerja A
		LEFT JOIN TAMBAHAN_MASA_KERJA_FILE PJ ON PJ.TEMP_VALIDASI_ID = A.TEMP_VALIDASI_ID
		LEFT JOIN TAMBAHAN_MASA_KERJA_FILE PA ON PA.TAMBAHAN_MASA_KERJA_ID = A.TAMBAHAN_MASA_KERJA_ID
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

     function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY TAMBAHAN_MASA_KERJA_FILE_ID")
	{
		$str = "
		SELECT A.TAMBAHAN_MASA_KERJA_FILE_ID, A.TAMBAHAN_MASA_KERJA_ID, A.PEGAWAI_ID, A.TEMP_VALIDASI_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE,A.LINK_SERVER
		FROM TAMBAHAN_MASA_KERJA_FILE A
		LEFT JOIN validasi.TAMBAHAN_MASA_KERJA B ON A.TEMP_VALIDASI_ID = B.TEMP_VALIDASI_ID
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