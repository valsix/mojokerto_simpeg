<? 
  include_once(APPPATH.'/models/Entity.php');

  class GajiRiwayat extends Entity{ 

	var $query;

    function GajiRiwayat()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.GAJI_RIWAYAT")); 
		$str = "INSERT INTO validasi.GAJI_RIWAYAT (
				   GAJI_RIWAYAT_ID, PEGAWAI_ID, PEJABAT_PENETAP_ID, PEJABAT_PENETAP, 
				   PANGKAT_ID, NO_SK, TANGGAL_SK, 
				   TMT_SK, GAJI_POKOK, JENIS_KENAIKAN, 
				   WILAYAH, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
				   KTUA, BULAN_DIBAYAR, SUDAH_DIBAYAR, POTONGAN_PANGKAT, TANGGAL_UPDATE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
				VALUES (
				  ".$this->getField("GAJI_RIWAYAT_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  '".$this->getField("PEJABAT_PENETAP")."',
				  ".$this->getField("PANGKAT_ID").",
				  '".$this->getField("NO_SK")."',
				  ".$this->getField("TANGGAL_SK").",
				  ".$this->getField("TMT_SK").",
				  ".$this->getField("GAJI_POKOK").",
				  ".$this->getField("JENIS_KENAIKAN").",
				  '".$this->getField("WILAYAH")."',
				  ".$this->getField("MASA_KERJA_TAHUN").",
				  ".$this->getField("MASA_KERJA_BULAN").",
				  '".$this->getField("KTUA")."',
				  ".$this->getField("BULAN_DIBAYAR").",
				  ".$this->getField("SUDAH_DIBAYAR").",
				  ".$this->getField("POTONGAN_PANGKAT").",
				  NOW(),
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("TEMP_VALIDASI_ID")."
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

    function insertupload()
	{
		$this->setField("GAJI_RIWAYAT_FILE_ID", $this->getNextId("GAJI_RIWAYAT_FILE_ID","GAJI_RIWAYAT_FILE")); 
		
		$str = "INSERT INTO GAJI_RIWAYAT_FILE(
	            GAJI_RIWAYAT_FILE_ID, GAJI_RIWAYAT_ID,  PEGAWAI_ID, TEMP_VALIDASI_ID, 
	            NAMA_FILE, LINK_FILE, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("GAJI_RIWAYAT_FILE_ID").",
				  ".$this->getField("GAJI_RIWAYAT_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("TEMP_VALIDASI_ID").",
				  '".$this->getField("NAMA_FILE")."',
				  '".$this->getField("LINK_FILE")."',
				  '".$this->getField("TIPE_FILE")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE validasi.GAJI_RIWAYAT
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   PANGKAT_ID= ".$this->getField("PANGKAT_ID").",
					   NO_SK= '".$this->getField("NO_SK")."',
					   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
					   TMT_SK= ".$this->getField("TMT_SK").",
					   GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
					   JENIS_KENAIKAN= ".$this->getField("JENIS_KENAIKAN").",
					   WILAYAH= '".$this->getField("WILAYAH")."',
					   MASA_KERJA_TAHUN= ".$this->getField("MASA_KERJA_TAHUN").",
					   MASA_KERJA_BULAN= ".$this->getField("MASA_KERJA_BULAN").",
					   KTUA= '".$this->getField("KTUA")."',
					   BULAN_DIBAYAR= ".$this->getField("BULAN_DIBAYAR").",
					   SUDAH_DIBAYAR= ".$this->getField("SUDAH_DIBAYAR").",
					   POTONGAN_PANGKAT= ".$this->getField("POTONGAN_PANGKAT").",
					   TANGGAL_UPDATE= NOW(),
					  LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }


     function insertadmin()
	{
		$this->setField("GAJI_RIWAYAT_ID", $this->getNextId("GAJI_RIWAYAT_ID","GAJI_RIWAYAT")); 
		$str = "INSERT INTO GAJI_RIWAYAT (
				   GAJI_RIWAYAT_ID, PEGAWAI_ID, PEJABAT_PENETAP_ID, PEJABAT_PENETAP, 
				   PANGKAT_ID, NO_SK, TANGGAL_SK, 
				   TMT_SK, GAJI_POKOK, JENIS_KENAIKAN, 
				   WILAYAH, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
				   KTUA, BULAN_DIBAYAR, SUDAH_DIBAYAR, POTONGAN_PANGKAT, TANGGAL_UPDATE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("GAJI_RIWAYAT_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  '".$this->getField("PEJABAT_PENETAP")."',
				  ".$this->getField("PANGKAT_ID").",
				  '".$this->getField("NO_SK")."',
				  ".$this->getField("TANGGAL_SK").",
				  ".$this->getField("TMT_SK").",
				  ".$this->getField("GAJI_POKOK").",
				  ".$this->getField("JENIS_KENAIKAN").",
				  '".$this->getField("WILAYAH")."',
				  ".$this->getField("MASA_KERJA_TAHUN").",
				  ".$this->getField("MASA_KERJA_BULAN").",
				  '".$this->getField("KTUA")."',
				  ".$this->getField("BULAN_DIBAYAR").",
				  ".$this->getField("SUDAH_DIBAYAR").",
				  ".$this->getField("POTONGAN_PANGKAT").",
				  NOW(),
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

    function updateadmin()
	{
		$str = "
				UPDATE GAJI_RIWAYAT
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   PANGKAT_ID= ".$this->getField("PANGKAT_ID").",
					   NO_SK= '".$this->getField("NO_SK")."',
					   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
					   TMT_SK= ".$this->getField("TMT_SK").",
					   GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
					   JENIS_KENAIKAN= ".$this->getField("JENIS_KENAIKAN").",
					   WILAYAH= '".$this->getField("WILAYAH")."',
					   MASA_KERJA_TAHUN= ".$this->getField("MASA_KERJA_TAHUN").",
					   MASA_KERJA_BULAN= ".$this->getField("MASA_KERJA_BULAN").",
					   KTUA= '".$this->getField("KTUA")."',
					   BULAN_DIBAYAR= ".$this->getField("BULAN_DIBAYAR").",
					   SUDAH_DIBAYAR= ".$this->getField("SUDAH_DIBAYAR").",
					   POTONGAN_PANGKAT= ".$this->getField("POTONGAN_PANGKAT").",
					   TANGGAL_UPDATE= NOW(),
					   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE GAJI_RIWAYAT_ID= ".$this->getField("GAJI_RIWAYAT_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM GAJI_RIWAYAT
                WHERE 
                  GAJI_RIWAYAT_ID= '".$this->getField("GAJI_RIWAYAT_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function deletefile()
	{
        $str = "DELETE FROM GAJI_RIWAYAT_FILE
                  WHERE 
                  GAJI_RIWAYAT_FILE_ID= ".$this->getField("GAJI_RIWAYAT_FILE_ID")."
                  AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
                  "; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.GAJI_RIWAYAT_ID, A.PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, 
		   COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
		   (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
		   A.PANGKAT_ID, NO_SK, TANGGAL_SK, TMT_SK, GAJI_POKOK, JENIS_KENAIKAN, 
		   (CASE JENIS_KENAIKAN WHEN 1 THEN 'Kenaikan Pangkat' WHEN 2 THEN 'Gaji Berkala' WHEN 3 THEN 'CPNS' WHEN 4 THEN 'PNS' WHEN 5 THEN 'PMK' END) NMJENISKENAIKAN,
		   CASE JENIS_KENAIKAN 
			WHEN 1 THEN 'KP' 
			WHEN 2 THEN 'KGB' 
			WHEN 3 THEN 'Penyesuaian' 
			ELSE 'SK' END NMJENISKENAIKAN1,
		   WILAYAH, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
		   KTUA, BULAN_DIBAYAR, SUDAH_DIBAYAR, POTONGAN_PANGKAT, 
		   B.KODE NMPANGKAT, C.JABATAN PEJABAT
		   ,A.TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI,COALESCE(PJ.GAJI_RIWAYAT_FILE_ID,PA.GAJI_RIWAYAT_FILE_ID)GAJI_RIWAYAT_FILE_ID,COALESCE(PJ.LINK_FILE,PA.LINK_FILE)LINK_FILE
		FROM validasi.validasi_pegawai_gaji_riwayat A 
        LEFT JOIN PANGKAT B ON B.PANGKAT_ID = A.PANGKAT_ID
		LEFT JOIN PEJABAT_PENETAP C ON A.PEJABAT_PENETAP_ID=C.PEJABAT_PENETAP_ID
		LEFT JOIN GAJI_RIWAYAT_FILE PJ ON PJ.TEMP_VALIDASI_ID = A.TEMP_VALIDASI_ID
		LEFT JOIN GAJI_RIWAYAT_FILE PA ON PA.GAJI_RIWAYAT_ID = A.GAJI_RIWAYAT_ID
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
		SELECT A.GAJI_RIWAYAT_ID, A.PEGAWAI_ID,  
		   COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
		   (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
		   A.PANGKAT_ID, NO_SK, TANGGAL_SK, TMT_SK, GAJI_POKOK, JENIS_KENAIKAN, 
		   (CASE JENIS_KENAIKAN WHEN 1 THEN 'Kenaikan Pangkat' WHEN 2 THEN 'Gaji Berkala' WHEN 3 THEN 'CPNS' WHEN 4 THEN 'PNS' WHEN 5 THEN 'PMK' END) NMJENISKENAIKAN,
		   CASE JENIS_KENAIKAN 
			WHEN 1 THEN 'KP' 
			WHEN 2 THEN 'KGB' 
			WHEN 3 THEN 'Penyesuaian' 
			ELSE 'SK' END NMJENISKENAIKAN1,
		   WILAYAH, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
		   KTUA, BULAN_DIBAYAR, SUDAH_DIBAYAR, POTONGAN_PANGKAT, 
		   B.KODE NMPANGKAT, C.JABATAN PEJABAT,D.LINK_FILE,D.GAJI_RIWAYAT_FILE_ID
		FROM GAJI_RIWAYAT A 
        LEFT JOIN PANGKAT B ON B.PANGKAT_ID = A.PANGKAT_ID
		LEFT JOIN PEJABAT_PENETAP C ON A.PEJABAT_PENETAP_ID=C.PEJABAT_PENETAP_ID
		LEFT JOIN GAJI_RIWAYAT_FILE D ON D.GAJI_RIWAYAT_ID = A.GAJI_RIWAYAT_ID
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


    function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY GAJI_RIWAYAT_FILE_ID")
	{
		$str = "
		SELECT A.GAJI_RIWAYAT_FILE_ID, A.GAJI_RIWAYAT_ID,  A.PEGAWAI_ID, A.TEMP_VALIDASI_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE
		FROM GAJI_RIWAYAT_FILE A
		LEFT JOIN validasi.GAJI_RIWAYAT B ON A.TEMP_VALIDASI_ID = B.TEMP_VALIDASI_ID
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