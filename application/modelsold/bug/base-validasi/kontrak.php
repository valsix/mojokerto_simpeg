<? 
  
  include_once(APPPATH.'/models/Entity.php');

  class Kontrak extends Entity{ 

	var $query;

    function Kontrak()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.RIWAYAT_KONTRAK")); 
		
		$str = "INSERT INTO validasi.RIWAYAT_KONTRAK (
				   RIWAYAT_KONTRAK_ID, PEGAWAI_ID, NO_SK, TANGGAL_SK, TMT_SK, SELESAI_KONTRAK, 
				   MASA_BERLAKU, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK, 
				   PEJABAT_PENETAP_ID, PEJABAT_PENETAP, GOLONGAN_PPPK_ID,
				   LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
				   VALUES (
					   ".$this->getField("RIWAYAT_KONTRAK_ID").",
					   '".$this->getField("PEGAWAI_ID")."',
					   '".$this->getField("NO_SK")."',
					   ".$this->getField("TANGGAL_SK").",
					   ".$this->getField("TMT_SK").",
					   ".$this->getField("SELESAI_KONTRAK").",
					   ".$this->getField("MASA_BERLAKU").",
					   ".$this->getField("MASA_KERJA_TAHUN").",
					   ".$this->getField("MASA_KERJA_BULAN").",
					   ".$this->getField("GAJI_POKOK").",
					   ".$this->getField("PEJABAT_PENETAP_ID").",
					   '".$this->getField("PEJABAT_PENETAP")."',
					   ".$this->getField("GOLONGAN_PPPK_ID").",
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
		$this->setField("RIWAYAT_KONTRAK_FILE_ID", $this->getNextId("RIWAYAT_KONTRAK_FILE_ID","RIWAYAT_KONTRAK_FILE")); 
		
		$str = "INSERT INTO RIWAYAT_KONTRAK_FILE(
	            RIWAYAT_KONTRAK_FILE_ID, RIWAYAT_KONTRAK_ID, PEGAWAI_ID, TEMP_VALIDASI_ID, 
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER,LINK_SERVER)
				VALUES (
				  ".$this->getField("RIWAYAT_KONTRAK_FILE_ID").",
				  ".$this->getField("RIWAYAT_KONTRAK_ID").",
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
				UPDATE validasi.RIWAYAT_KONTRAK
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   NO_SK= '".$this->getField("NO_SK")."',
					   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
					   TMT_SK= ".$this->getField("TMT_SK").",
					   SELESAI_KONTRAK= ".$this->getField("SELESAI_KONTRAK").",
					   MASA_BERLAKU= ".$this->getField("MASA_BERLAKU").",
					   MASA_KERJA_TAHUN= ".$this->getField("MASA_KERJA_TAHUN").",
					   MASA_KERJA_BULAN= ".$this->getField("MASA_KERJA_BULAN").",
					   GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
					   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   GOLONGAN_PPPK_ID= ".$this->getField("GOLONGAN_PPPK_ID").",
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
				UPDATE validasi.RIWAYAT_KONTRAK
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   NO_SK= '".$this->getField("NO_SK")."',
					   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
					   TMT_SK= ".$this->getField("TMT_SK").",
					   SELESAI_KONTRAK= ".$this->getField("SELESAI_KONTRAK").",
					   MASA_BERLAKU= ".$this->getField("MASA_BERLAKU").",
					   MASA_KERJA_TAHUN= ".$this->getField("MASA_KERJA_TAHUN").",
					   MASA_KERJA_BULAN= ".$this->getField("MASA_KERJA_BULAN").",
					   GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
					   VALIDASI	= ".$this->getField("VALIDASI").",
					   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   GOLONGAN_PPPK_ID= ".$this->getField("GOLONGAN_PPPK_ID").",
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
        $str = "DELETE FROM validasi.RIWAYAT_KONTRAK
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function deletefile()
	{
        $str = "DELETE FROM RIWAYAT_KONTRAK_FILE
                  WHERE 
                  RIWAYAT_KONTRAK_FILE_ID= ".$this->getField("RIWAYAT_KONTRAK_FILE_ID")."
                  AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
                  "; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.RIWAYAT_KONTRAK_ID, A.PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, A.NO_SK,
	    A.TANGGAL_SK, A.TMT_SK, A.MASA_BERLAKU,
	    A.SELESAI_KONTRAK,COALESCE( A.MASA_BERLAKU, 0 ) ||' Tahun ' MASA_BERLAKU_TAHUN,A.MASA_KERJA_TAHUN,A.MASA_KERJA_BULAN
		, A.GAJI_POKOK
		, A.PEJABAT_PENETAP_ID
		, A.PEJABAT_PENETAP
		, A.GOLONGAN_PPPK_ID
		, A.TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
		, B.KODE
		, COALESCE( A.MASA_KERJA_TAHUN, 0 ) ||' Tahun '|| '- ' || COALESCE( A.MASA_KERJA_BULAN, 0 ) || ' Bulan' MASA_KERJA
		 ,COALESCE(PJ.LINK_FILE,PA.LINK_FILE) LINK_FILE,COALESCE(PJ.RIWAYAT_KONTRAK_FILE_ID,PA.RIWAYAT_KONTRAK_FILE_ID)RIWAYAT_KONTRAK_FILE_ID,COALESCE(PJ.LINK_SERVER,PA.LINK_SERVER)LINK_SERVER

		FROM validasi.validasi_pegawai_kontrak A
		LEFT JOIN GOLONGAN_PPPK B ON B.GOLONGAN_PPPK_ID = A.GOLONGAN_PPPK_ID
		LEFT JOIN RIWAYAT_KONTRAK_FILE PJ ON PJ.TEMP_VALIDASI_ID = A.TEMP_VALIDASI_ID
		LEFT JOIN RIWAYAT_KONTRAK_FILE PA ON PA.RIWAYAT_KONTRAK_ID = A.RIWAYAT_KONTRAK_ID
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

     function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY RIWAYAT_KONTRAK_FILE_ID")
	{
		$str = "
		SELECT A.RIWAYAT_KONTRAK_FILE_ID, A.RIWAYAT_KONTRAK_ID, A.PEGAWAI_ID, A.TEMP_VALIDASI_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE,A.LINK_SERVER
		FROM RIWAYAT_KONTRAK_FILE A
		LEFT JOIN validasi.RIWAYAT_KONTRAK B ON A.TEMP_VALIDASI_ID = B.TEMP_VALIDASI_ID
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