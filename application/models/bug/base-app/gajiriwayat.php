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
		$this->setField("GAJI_RIWAYAT_ID", $this->getNextId("GAJI_RIWAYAT_ID","GAJI_RIWAYAT")); 

		$str = "INSERT INTO GAJI_RIWAYAT (
				   GAJI_RIWAYAT_ID, PEGAWAI_ID, PEJABAT_PENETAP_ID, PEJABAT_PENETAP, 
				   PANGKAT_ID, NO_SK, TANGGAL_SK, 
				   TMT_SK, GAJI_POKOK, JENIS_KENAIKAN, 
				   WILAYAH, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
				   KTUA, BULAN_DIBAYAR, SUDAH_DIBAYAR, POTONGAN_PANGKAT, TANGGAL_UPDATE) 
				VALUES (
				  ".$this->getField("GAJI_RIWAYAT_ID").",
				  ".$this->getField("PEGAWAI_ID").",
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
				  CURRENT_DATE
				)"; 
		//echo $str;
		$this->id= $this->getField("GAJI_RIWAYAT_ID");
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		// jenis cpns
		if($this->getField("JENIS_KENAIKAN") == 3)
		{
			$strCpns= "
					UPDATE SK_CPNS
					SET    
						   PANGKAT_ID= '".$this->getField("PANGKAT_ID")."',
						   NO_SK= '".$this->getField("NO_SK")."',
						   MASA_KERJA_TAHUN= '".$this->getField("MASA_KERJA_TAHUN")."',
						   MASA_KERJA_BULAN= '".$this->getField("MASA_KERJA_BULAN")."',
						   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
						   TMT_CPNS= ".$this->getField("TMT_SK").",
						   GAJI_POKOK= '".$this->getField("GAJI_POKOK")."',
						   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
						   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
						   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
						   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
					WHERE PEGAWAI_ID = '".$this->getField("PEGAWAI_ID")."'
			";
			$this->query = $strCpns;
			$this->execQuery($strCpns);
			
			$strPangkat= "
					UPDATE PANGKAT_RIWAYAT
					SET    
						   PANGKAT_ID= '".$this->getField("PANGKAT_ID")."',
						   NO_SK= '".$this->getField("NO_SK")."',
						   MASA_KERJA_TAHUN= '".$this->getField("MASA_KERJA_TAHUN")."',
						   MASA_KERJA_BULAN= '".$this->getField("MASA_KERJA_BULAN")."',
						   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
						   TMT_PANGKAT= ".$this->getField("TMT_SK").",
						   GAJI_POKOK= '".$this->getField("GAJI_POKOK")."',
						   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
						   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
						   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
						   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
					WHERE JENIS_KP= '9' AND PEGAWAI_ID = '".$this->getField("PEGAWAI_ID")."'
			";
			$this->query = $strPangkat;
			$this->execQuery($strPangkat);
		}
		else// jenis pns
		if($this->getField("JENIS_KENAIKAN") == 4)
		{
			$strPns= "
					UPDATE SK_PNS
					SET    
						   PANGKAT_ID= '".$this->getField("PANGKAT_ID")."',
						   NO_SK= '".$this->getField("NO_SK")."',
						   MASA_KERJA_TAHUN= '".$this->getField("MASA_KERJA_TAHUN")."',
						   MASA_KERJA_BULAN= '".$this->getField("MASA_KERJA_BULAN")."',
						   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
						   TMT_PNS= ".$this->getField("TMT_SK").",
						   GAJI_POKOK= '".$this->getField("GAJI_POKOK")."',
						   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
						   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
						   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
						   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
					WHERE PEGAWAI_ID = '".$this->getField("PEGAWAI_ID")."'
			";
			$this->query = $strPns;
			$this->execQuery($strPns);
			
			$strPangkat= "
					UPDATE PANGKAT_RIWAYAT
					SET    
						   PANGKAT_ID= '".$this->getField("PANGKAT_ID")."',
						   NO_SK= '".$this->getField("NO_SK")."',
						   MASA_KERJA_TAHUN= '".$this->getField("MASA_KERJA_TAHUN")."',
						   MASA_KERJA_BULAN= '".$this->getField("MASA_KERJA_BULAN")."',
						   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
						   TMT_PANGKAT= ".$this->getField("TMT_SK").",
						   GAJI_POKOK= '".$this->getField("GAJI_POKOK")."',
						   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
						   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
						   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
						   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
					WHERE JENIS_KP= '10' AND PEGAWAI_ID = '".$this->getField("PEGAWAI_ID")."'
			";
			$this->query = $strPangkat;
			$this->execQuery($strPangkat);
			
		}
		else// jenis pns
		if($this->getField("JENIS_KENAIKAN") == 1)
		{
			$strPangkat= "
					UPDATE PANGKAT_RIWAYAT
					SET    
						   PANGKAT_ID= '".$this->getField("PANGKAT_ID")."',
						   NO_SK= '".$this->getField("NO_SK")."',
						   MASA_KERJA_TAHUN= '".$this->getField("MASA_KERJA_TAHUN")."',
						   MASA_KERJA_BULAN= '".$this->getField("MASA_KERJA_BULAN")."',
						   TANGGAL_SK= ".$this->getField("TANGGAL_SK").",
						   TMT_PANGKAT= ".$this->getField("TMT_SK").",
						   GAJI_POKOK= '".$this->getField("GAJI_POKOK")."',
						   PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID").",
						   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
						   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
						   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
					WHERE PEGAWAI_ID = '".$this->getField("PEGAWAI_ID")."' AND PANGKAT_ID= '".$this->getField("PANGKAT_ID_LAMA")."'
					AND TMT_PANGKAT = ".$this->getField("TMT_SK_LAMA")."
					AND TANGGAL_SK = ".$this->getField("TANGGAL_SK_LAMA")."
			";
			$this->query = $strPangkat;
			$this->execQuery($strPangkat);
			
		}
		
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE GAJI_RIWAYAT
				SET    
					   PEGAWAI_ID       		= ".$this->getField("PEGAWAI_ID").",
					   PEJABAT_PENETAP_ID    	= ".$this->getField("PEJABAT_PENETAP_ID").",
					   PEJABAT_PENETAP			= '".$this->getField("PEJABAT_PENETAP")."',
					   PANGKAT_ID             	= ".$this->getField("PANGKAT_ID").",
					   NO_SK     				= '".$this->getField("NO_SK")."',
					   TANGGAL_SK    			= ".$this->getField("TANGGAL_SK").",
					   TMT_SK    				= ".$this->getField("TMT_SK").",
					   GAJI_POKOK  				= ".$this->getField("GAJI_POKOK").",
					   JENIS_KENAIKAN 			= ".$this->getField("JENIS_KENAIKAN").",
					   WILAYAH        			= '".$this->getField("WILAYAH")."',
					   MASA_KERJA_TAHUN       	= ".$this->getField("MASA_KERJA_TAHUN").",
					   MASA_KERJA_BULAN      	= ".$this->getField("MASA_KERJA_BULAN").",
					   KTUA   					= '".$this->getField("KTUA")."',
					   BULAN_DIBAYAR            = ".$this->getField("BULAN_DIBAYAR").",
					   SUDAH_DIBAYAR            = ".$this->getField("SUDAH_DIBAYAR").",
					   POTONGAN_PANGKAT         = ".$this->getField("POTONGAN_PANGKAT").",
					   TANGGAL_UPDATE           = CURRENT_DATE
				WHERE  GAJI_RIWAYAT_ID          = ".$this->getField("GAJI_RIWAYAT_ID")."
				"; 
				$this->query = $str;
				//echo $str;
		return $this->execQuery($str);
    }
	
	function update_format()
	{
		$str = "
				UPDATE GAJI_RIWAYAT
				SET
					   UKURAN= ".$this->getField("UKURAN").",
					   FORMAT= '".$this->getField("FORMAT")."'
				WHERE  GAJI_RIWAYAT_ID = ".$this->getField("GAJI_RIWAYAT_ID")." AND PEGAWAI_ID = ".$this->getField("PEGAWAI_ID")."
			 "; 
		$this->query = $str;
		return $this->execQuery($str);
    }
	
	function selectByParamsBlob($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT encode(FOTO_BLOB, 'base64') FOTO_BLOB, FORMAT
				FROM GAJI_RIWAYAT WHERE GAJI_RIWAYAT_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement."";
				
		return $this->selectLimit($str,$limit,$from); 
    }
	
	function upload($table, $column, $blob, $id)
	{
		return $this->uploadBlob($table, $column, $blob, $id);
    }
	
	function delete()
	{
        $str = "DELETE FROM GAJI_RIWAYAT
                WHERE 
                  GAJI_RIWAYAT_ID = ".$this->getField("GAJI_RIWAYAT_ID").""; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    /** 
    * Cari record berdasarkan array parameter dan limit tampilan 
    * @param array paramsArray Array of parameter. Contoh array("id"=>"xxx","PANGKAT_ID"=>"yyy") 
    * @param int limit Jumlah maksimal record yang akan diambil 
    * @param int from Awal record yang diambil 
    * @return boolean True jika sukses, false jika tidak 
    **/ 
    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT GAJI_RIWAYAT_ID, PEGAWAI_ID, 
				   A.PEJABAT_PENETAP_ID, 
				   PEJABAT_PENETAP,
				   PANGKAT_ID, NO_SK, TANGGAL_SK, TMT_SK, GAJI_POKOK, JENIS_KENAIKAN, 
				   (CASE JENIS_KENAIKAN WHEN 1 THEN 'Kenaikan Pangkat' WHEN 2 THEN 'Gaji Berkala' WHEN 3 THEN 'CPNS' WHEN 4 THEN 'PNS' WHEN 5 THEN 'PMK' END) NMJENISKENAIKAN,
				   WILAYAH, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
				   KTUA, BULAN_DIBAYAR, SUDAH_DIBAYAR, POTONGAN_PANGKAT, TANGGAL_UPDATE, 
				   PEJABAT_PENETAP NMPEJABATPENETAP,
                   (SELECT x.KODE FROM PANGKAT x WHERE x.PANGKAT_ID = a.PANGKAT_ID) NMPANGKAT, encode(FOTO_BLOB, 'base64') FOTO_BLOB
				FROM GAJI_RIWAYAT a WHERE 1=1"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TMT_SK ASC";
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
    
	function selectByParamsGajiTerakhir($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT *
				FROM GAJI_TERAKHIR WHERE 1=1"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ";
				
		return $this->selectLimit($str,$limit,$from); 
    }
	
	function selectByParamsLike($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT GAJI_RIWAYAT_ID, PEGAWAI_ID, (CASE PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE a.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
				   PANGKAT_ID, NO_SK, TANGGAL_SK, TMT_SK, GAJI_POKOK, JENIS_KENAIKAN, 
				   WILAYAH, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
				   KTUA, BULAN_DIBAYAR, SUDAH_DIBAYAR, POTONGAN_PANGKAT, TANGGAL_UPDATE, 
				   (SELECT x.JABATAN FROM PEJABAT_PENETAP x WHERE x.PEJABAT_PENETAP_ID = a.PEJABAT_PENETAP_ID) NMPEJABATPENETAP,
                   (SELECT x.KODE FROM PANGKAT x WHERE x.PANGKAT_ID = a.PANGKAT_ID) NMPANGKAT
				FROM GAJI_RIWAYAT a WHERE 1=1"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key LIKE '%$val%' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY TMT_SK ASC";
		return $this->selectLimit($str,$limit,$from); 
    }	
    /** 
    * Hitung jumlah record berdasarkan parameter (array). 
    * @param array paramsArray Array of parameter. Contoh array("id"=>"xxx","PANGKAT_ID"=>"yyy") 
    * @return long Jumlah record yang sesuai kriteria 
    **/ 
	function getCountByParamsGenerate($table, $statement= "")
	{
		$str = "SELECT COUNT(1) AS ROWCOUNT FROM ".$table." WHERE 1=1 ".$statement;
		
		$this->query = $str;
		$this->select($str); 
		if($this->firstRow()) 
			if($this->getField("ROWCOUNT") == 0)
			return "";
			else
			return $this->getField("ROWCOUNT"); 
		else 
			return "";
    }
	
    function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(GAJI_RIWAYAT_ID) AS ROWCOUNT FROM GAJI_RIWAYAT WHERE GAJI_RIWAYAT_ID IS NOT NULL "; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }

    function getCountByParamsLike($paramsArray=array())
	{
		$str = "SELECT COUNT(GAJI_RIWAYAT_ID) AS ROWCOUNT FROM GAJI_RIWAYAT WHERE GAJI_RIWAYAT_ID IS NOT NULL "; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key LIKE '%$val%' ";
		}
		
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }	
        
  } 
?>