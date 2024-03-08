<? 
  include_once(APPPATH.'/models/Entity.php');

  class SkPns extends Entity{ 

	var $query;

    function SkPns()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.SK_PNS")); 
		
		$str = "INSERT INTO validasi.SK_PNS (
				   SK_PNS_ID, PEGAWAI_ID, PANGKAT_ID, 
				   PEJABAT_PENETAP_ID, PEJABAT_PENETAP, TMT_PNS, SUMPAH, 
				   NO_UJI_KESEHATAN, NO_PRAJAB, TANGGAL_UJI_KESEHATAN, 
				   NO_SK, TANGGAL_PRAJAB, NAMA_PENETAP, 
				   TANGGAL_SUMPAH, NO_SK_SUMPAH, PEJABAT_PENETAP_SUMPAH_ID, PEJABAT_PENETAP_SUMPAH,
				   TANGGAL_SK, NIP_PENETAP, NOMOR_BERITA_ACARA, TANGGAL_BERITA_ACARA, KETERANGAN_LPJ,
				   MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
				VALUES (
				  ".$this->getField("SK_PNS_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("PANGKAT_ID").",
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  '".$this->getField("PEJABAT_PENETAP")."',
				  ".$this->getField("TMT_PNS").",
				  ".$this->getField("SUMPAH").",
				  '".$this->getField("NO_UJI_KESEHATAN")."',
				  '".$this->getField("NO_PRAJAB")."',
				  ".$this->getField("TANGGAL_UJI_KESEHATAN").",
				  '".$this->getField("NO_SK")."',
				  ".$this->getField("TANGGAL_PRAJAB").",
				  '".$this->getField("NAMA_PENETAP")."',				  
				  ".$this->getField("TANGGAL_SUMPAH").",
				  '".$this->getField("NO_SK_SUMPAH")."',
				  ".$this->getField("PEJABAT_PENETAP_SUMPAH_ID").",
				  '".$this->getField("PEJABAT_PENETAP_SUMPAH")."',
				  ".$this->getField("TANGGAL_SK").",
				  '".$this->getField("NIP_PENETAP")."',
				  '".$this->getField("NOMOR_BERITA_ACARA")."',
				  ".$this->getField("TANGGAL_BERITA_ACARA").",
				  '".$this->getField("KETERANGAN_LPJ")."',
				  ".$this->getField("MASA_KERJA_TAHUN").",
				  ".$this->getField("MASA_KERJA_BULAN").",
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

    function update()
	{
		$str = "
				UPDATE validasi.SK_PNS
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   PANGKAT_ID    = ".$this->getField("PANGKAT_ID").",
					   PEJABAT_PENETAP_ID             = ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   TMT_PNS     = ".$this->getField("TMT_PNS").",
					   SUMPAH    = ".$this->getField("SUMPAH").",
					   NO_UJI_KESEHATAN    = '".$this->getField("NO_UJI_KESEHATAN")."',
					   NO_PRAJAB  = '".$this->getField("NO_PRAJAB")."',
					   TANGGAL_UJI_KESEHATAN = ".$this->getField("TANGGAL_UJI_KESEHATAN").",
					   NO_SK        = '".$this->getField("NO_SK")."',
					   TANGGAL_PRAJAB       = ".$this->getField("TANGGAL_PRAJAB").",
					   NAMA_PENETAP      = '".$this->getField("NAMA_PENETAP")."',
					   TANGGAL_SK   = ".$this->getField("TANGGAL_SK").",
					   NIP_PENETAP             = '".$this->getField("NIP_PENETAP")."',					   				  
					   TANGGAL_SUMPAH =  ".$this->getField("TANGGAL_SUMPAH").",
				  	   NO_SK_SUMPAH = '".$this->getField("NO_SK_SUMPAH")."',
					   PEJABAT_PENETAP_SUMPAH_ID = ".$this->getField("PEJABAT_PENETAP_SUMPAH_ID").",
					   PEJABAT_PENETAP_SUMPAH = '".$this->getField("PEJABAT_PENETAP_SUMPAH")."',
					   MASA_KERJA_TAHUN    = ".$this->getField("MASA_KERJA_TAHUN").",
					   MASA_KERJA_BULAN    = ".$this->getField("MASA_KERJA_BULAN").",
					   GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
					   NOMOR_BERITA_ACARA= '".$this->getField("NOMOR_BERITA_ACARA")."',
				  	   TANGGAL_BERITA_ACARA= ".$this->getField("TANGGAL_BERITA_ACARA").",
				  	   KETERANGAN_LPJ= '".$this->getField("KETERANGAN_LPJ")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function insertadmin()
	{
		$this->setField("SK_PNS_ID", $this->getNextId("SK_PNS_ID","SK_PNS")); 
		
		$str = "INSERT INTO SK_PNS (
				   SK_PNS_ID, PEGAWAI_ID, PANGKAT_ID, 
				   PEJABAT_PENETAP_ID, PEJABAT_PENETAP, TMT_PNS, SUMPAH, 
				   NO_UJI_KESEHATAN, NO_PRAJAB, TANGGAL_UJI_KESEHATAN, 
				   NO_SK, TANGGAL_PRAJAB, NAMA_PENETAP, 
				   TANGGAL_SUMPAH, NO_SK_SUMPAH, PEJABAT_PENETAP_SUMPAH_ID, PEJABAT_PENETAP_SUMPAH,
				   TANGGAL_SK, NIP_PENETAP, NOMOR_BERITA_ACARA, TANGGAL_BERITA_ACARA, KETERANGAN_LPJ,
				   MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("SK_PNS_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  ".$this->getField("PANGKAT_ID").",
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  '".$this->getField("PEJABAT_PENETAP")."',
				  ".$this->getField("TMT_PNS").",
				  ".$this->getField("SUMPAH").",
				  '".$this->getField("NO_UJI_KESEHATAN")."',
				  '".$this->getField("NO_PRAJAB")."',
				  ".$this->getField("TANGGAL_UJI_KESEHATAN").",
				  '".$this->getField("NO_SK")."',
				  ".$this->getField("TANGGAL_PRAJAB").",
				  '".$this->getField("NAMA_PENETAP")."',				  
				  ".$this->getField("TANGGAL_SUMPAH").",
				  '".$this->getField("NO_SK_SUMPAH")."',
				  ".$this->getField("PEJABAT_PENETAP_SUMPAH_ID").",
				  '".$this->getField("PEJABAT_PENETAP_SUMPAH")."',
				  ".$this->getField("TANGGAL_SK").",
				  '".$this->getField("NIP_PENETAP")."',
				  '".$this->getField("NOMOR_BERITA_ACARA")."',
				  ".$this->getField("TANGGAL_BERITA_ACARA").",
				  '".$this->getField("KETERANGAN_LPJ")."',
				  ".$this->getField("MASA_KERJA_TAHUN").",
				  ".$this->getField("MASA_KERJA_BULAN").",
				  ".$this->getField("GAJI_POKOK").",
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
		$this->query = $str;
		// echo $str;exit;
		$this->tempValidasiId = $this->getField("SK_PNS_ID");
		return $this->execQuery($str);
    }

    function updateadmin()
	{
		$str = "
				UPDATE SK_PNS
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   PANGKAT_ID    = ".$this->getField("PANGKAT_ID").",
					   PEJABAT_PENETAP_ID             = ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."',
					   TMT_PNS     = ".$this->getField("TMT_PNS").",
					   SUMPAH    = ".$this->getField("SUMPAH").",
					   NO_UJI_KESEHATAN    = '".$this->getField("NO_UJI_KESEHATAN")."',
					   NO_PRAJAB  = '".$this->getField("NO_PRAJAB")."',
					   TANGGAL_UJI_KESEHATAN = ".$this->getField("TANGGAL_UJI_KESEHATAN").",
					   NO_SK        = '".$this->getField("NO_SK")."',
					   TANGGAL_PRAJAB       = ".$this->getField("TANGGAL_PRAJAB").",
					   NAMA_PENETAP      = '".$this->getField("NAMA_PENETAP")."',
					   TANGGAL_SK   = ".$this->getField("TANGGAL_SK").",
					   NIP_PENETAP             = '".$this->getField("NIP_PENETAP")."',					   				  
					   TANGGAL_SUMPAH =  ".$this->getField("TANGGAL_SUMPAH").",
				  	   NO_SK_SUMPAH = '".$this->getField("NO_SK_SUMPAH")."',
					   PEJABAT_PENETAP_SUMPAH_ID = ".$this->getField("PEJABAT_PENETAP_SUMPAH_ID").",
					   PEJABAT_PENETAP_SUMPAH = '".$this->getField("PEJABAT_PENETAP_SUMPAH")."',
					   MASA_KERJA_TAHUN    = ".$this->getField("MASA_KERJA_TAHUN").",
					   MASA_KERJA_BULAN    = ".$this->getField("MASA_KERJA_BULAN").",
					   GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
					   NOMOR_BERITA_ACARA= '".$this->getField("NOMOR_BERITA_ACARA")."',
				  	   TANGGAL_BERITA_ACARA= ".$this->getField("TANGGAL_BERITA_ACARA").",
				  	   KETERANGAN_LPJ= '".$this->getField("KETERANGAN_LPJ")."',
				  	   LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
				  	   LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
				  	   LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE SK_PNS_ID= ".$this->getField("SK_PNS_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

     function insertupload()
	{
		$this->setField("SK_PNS_FILE_ID", $this->getNextId("SK_PNS_FILE_ID","SK_PNS_FILE")); 
		
		$str = "INSERT INTO SK_PNS_FILE(
	            SK_PNS_FILE_ID, SK_PNS_ID, PEGAWAI_ID, 
	            NAMA_FILE, LINK_FILE, LINK_FILE_BERITA,LINK_FILE_SURAT,LINK_FILE_SPMT, TIPE_FILE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("SK_PNS_FILE_ID").",
				  ".$this->getField("SK_PNS_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("NAMA_FILE")."',
				  '".$this->getField("LINK_FILE")."',
				  '".$this->getField("LINK_FILE_BERITA")."',
				  '".$this->getField("LINK_FILE_SURAT")."',
				  '".$this->getField("LINK_FILE_SPMT")."',
				  '".$this->getField("TIPE_FILE")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				  
				)"; 
				
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function updateupload()
	{
		$str = "
				UPDATE SK_PNS_FILE
				SET    
				  	   LINK_FILE = '".$this->getField("LINK_FILE")."',
					   NAMA_FILE = '".$this->getField("NAMA_FILE")."',
					   TIPE_FILE = '".$this->getField("TIPE_FILE")."',
				  	   LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
				  	   LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
				  	   LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE SK_PNS_ID= ".$this->getField("SK_PNS_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function updateuploadberita()
	{
		$str = "
				UPDATE SK_PNS_FILE
				SET    
				  	   LINK_FILE_BERITA = '".$this->getField("LINK_FILE_BERITA")."',
					   NAMA_FILE_BERITA = '".$this->getField("NAMA_FILE_BERITA")."',
					   TIPE_FILE = '".$this->getField("TIPE_FILE")."',
				  	   LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
				  	   LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
				  	   LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE SK_PNS_ID= ".$this->getField("SK_PNS_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function updateuploadsurat()
	{
		$str = "
				UPDATE SK_PNS_FILE
				SET    
				  	   LINK_FILE_SURAT = '".$this->getField("LINK_FILE_SURAT")."',
					   NAMA_FILE_SURAT = '".$this->getField("NAMA_FILE_SURAT")."',
					   TIPE_FILE = '".$this->getField("TIPE_FILE")."',
				  	   LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
				  	   LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
				  	   LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE SK_PNS_ID= ".$this->getField("SK_PNS_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function updateuploadsmpt()
	{
		$str = "
				UPDATE SK_PNS_FILE
				SET    
				  	   LINK_FILE_SPMT = '".$this->getField("LINK_FILE_SPMT")."',
					   NAMA_FILE_SPMT = '".$this->getField("NAMA_FILE_SPMT")."',
					   TIPE_FILE = '".$this->getField("TIPE_FILE")."',
				  	   LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
				  	   LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
				  	   LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE SK_PNS_ID= ".$this->getField("SK_PNS_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function deletefileupdate($kolom,$nama)
	{
        $str = "
				UPDATE SK_PNS_FILE
				SET    
				  	   ".$kolom." = '',
					   ".$nama." = ''
				WHERE SK_PNS_FILE_ID= ".$this->getField("SK_PNS_FILE_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function deletefile()
	{
        $str = "DELETE FROM SK_PNS_FILE
                  WHERE 
                  SK_PNS_FILE_ID= ".$this->getField("SK_PNS_FILE_ID")."
                  AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
                  "; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }
    
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT SK_PNS_ID, PEGAWAI_ID, PANGKAT_ID, 
		 COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
		 (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
		 TMT_PNS, SUMPAH, 
		 NO_UJI_KESEHATAN, NO_PRAJAB, TANGGAL_UJI_KESEHATAN, 
		 TANGGAL_SUMPAH, NO_SK_SUMPAH, 
		 PEJABAT_PENETAP_SUMPAH_ID,
		 C.JABATAN PEJABAT_PENETAP_SUMPAH_NAMA,
		 NO_SK, TANGGAL_PRAJAB, NAMA_PENETAP, NOMOR_BERITA_ACARA, TANGGAL_BERITA_ACARA, KETERANGAN_LPJ,
		 TANGGAL_SK, NIP_PENETAP, TANGGAL_SUMPAH, MASA_KERJA_TAHUN, MASA_KERJA_BULAN
		 ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI,
		 CASE WHEN FOTO_BLOB IS NULL THEN NULL ELSE 99 END FOTO_BLOB
		 , A.GAJI_POKOK
		FROM validasi.validasi_pegawai_sk_pns A
		LEFT JOIN PEJABAT_PENETAP B ON A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID
		LEFT JOIN PEJABAT_PENETAP C ON A.PEJABAT_PENETAP_SUMPAH_ID = C.PEJABAT_PENETAP_ID
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
		SELECT A.SK_PNS_ID, A.PEGAWAI_ID, PANGKAT_ID, 
		 COALESCE(PEJABAT_PENETAP, (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID)) PEJABAT_PENETAP,
		 (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
		 TMT_PNS, SUMPAH, 
		 NO_UJI_KESEHATAN, NO_PRAJAB, TANGGAL_UJI_KESEHATAN, 
		 TANGGAL_SUMPAH, NO_SK_SUMPAH, 
		 PEJABAT_PENETAP_SUMPAH_ID,
		 C.JABATAN PEJABAT_PENETAP_SUMPAH_NAMA,
		 NO_SK, TANGGAL_PRAJAB, NAMA_PENETAP, NOMOR_BERITA_ACARA, TANGGAL_BERITA_ACARA, KETERANGAN_LPJ,
		 TANGGAL_SK, NIP_PENETAP, TANGGAL_SUMPAH, MASA_KERJA_TAHUN, MASA_KERJA_BULAN,
		 CASE WHEN FOTO_BLOB IS NULL THEN NULL ELSE 99 END FOTO_BLOB
		 , A.GAJI_POKOK
		 , K.LINK_FILE
		 , K.LINK_FILE_BERITA
		 , K.LINK_FILE_SURAT
		 , K.LINK_FILE_SPMT
		 , K.SK_PNS_FILE_ID
		FROM SK_PNS A
		LEFT JOIN PEJABAT_PENETAP B ON A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID
		LEFT JOIN PEJABAT_PENETAP C ON A.PEJABAT_PENETAP_SUMPAH_ID = C.PEJABAT_PENETAP_ID
		LEFT JOIN SK_PNS_FILE K ON K.SK_PNS_ID = A.SK_PNS_ID
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
		$str = "SELECT COUNT(A.SK_PNS_ID) AS ROWCOUNT 
		FROM validasi.validasi_pegawai_sk_pns A
		LEFT JOIN PEJABAT_PENETAP B ON A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID
		LEFT JOIN PEJABAT_PENETAP C ON A.PEJABAT_PENETAP_SUMPAH_ID = C.PEJABAT_PENETAP_ID
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


    function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY SK_PNS_FILE_ID")
	{
		$str = "
		SELECT A.SK_PNS_FILE_ID, A.SK_PNS_ID, A.PEGAWAI_ID, 
		A.NAMA_FILE, A.LINK_FILE, A.TIPE_FILE, A.LINK_FILE_BERITA
		 , A.LINK_FILE_SURAT
		 , A.LINK_FILE_SPMT
		FROM SK_PNS_FILE A
		INNER JOIN SK_PNS B ON A.SK_PNS_ID = B.SK_PNS_ID
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