<? 
include_once(APPPATH.'/models/Entity.php');
include_once(APPPATH.'/models/base/DbLog.php');

class Hukuman extends Entity{ 

	var $query;

	function Hukuman()
	{
		$this->Entity(); 
	}

	function setlogdata($infotable, $infoaksi, $query)
    	{
	    	$setlog= new DbLog();
	    	$setlog->insert($infotable, $infoaksi, $query);
    	}
	

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("HUKUMAN_ID", $this->getNextId("HUKUMAN_ID","HUKUMAN")); 

		$str = "INSERT INTO HUKUMAN
		(
			HUKUMAN_ID, PEGAWAI_ID, PEJABAT_PENETAP_ID, JENIS_HUKUMAN_ID, NO_SK, TANGGAL_SK, PEJABAT_PENETAP
			, TMT_SK, KETERANGAN, BERLAKU, TINGKAT_HUKUMAN_ID, PERATURAN_ID
			, TANGGAL_MULAI, TANGGAL_AKHIR, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		) 
		VALUES
		(
			".$this->getField("HUKUMAN_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("PEJABAT_PENETAP_ID")."'
			, '".$this->getField("JENIS_HUKUMAN_ID")."'
			, '".$this->getField("NO_SK")."'
			, ".$this->getField("TANGGAL_SK")."
			, '".$this->getField("PEJABAT_PENETAP")."'
			, ".$this->getField("TMT_SK")."
			, '".$this->getField("KETERANGAN")."'
			, '".$this->getField("BERLAKU")."'
			, '".$this->getField("TINGKAT_HUKUMAN_ID")."'
			, ".$this->getField("PERATURAN_ID")."
			, ".$this->getField("TANGGAL_MULAI")."
			, ".$this->getField("TANGGAL_AKHIR")."
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)";

		// echo $str;exit;
				
		$this->query = $str;
		$this->id= $this->getField("HUKUMAN_ID");

		// untuk buat log data
		$this->setlogdata("HUKUMAN", "INSERT", $str);

		return $this->execQuery($str);
    	}

    	function update()
	{
		$str = "UPDATE HUKUMAN
		SET    
			PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
			, PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."'
			, PEJABAT_PENETAP_ID= '".$this->getField("PEJABAT_PENETAP_ID")."'
			, JENIS_HUKUMAN_ID= '".$this->getField("JENIS_HUKUMAN_ID")."'
			, TINGKAT_HUKUMAN_ID= '".$this->getField("TINGKAT_HUKUMAN_ID")."'
			, PERATURAN_ID= ".$this->getField("PERATURAN_ID")."
			, NO_SK= '".$this->getField("NO_SK")."'
			, TANGGAL_SK= ".$this->getField("TANGGAL_SK")."
			, TMT_SK= ".$this->getField("TMT_SK")."
			, KETERANGAN= '".$this->getField("KETERANGAN")."'
			, BERLAKU= '".$this->getField("BERLAKU")."'
			, TANGGAL_MULAI= ".$this->getField("TANGGAL_MULAI")."
			, TANGGAL_AKHIR= ".$this->getField("TANGGAL_AKHIR")."
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE HUKUMAN_ID= '".$this->getField("HUKUMAN_ID")."'
		"; 
		$this->query = $str;

		// echo $str;exit;

		// untuk buat log data
		$this->setlogdata("HUKUMAN", "UPDATE", $str);

		return $this->execQuery($str);
    	}

    	function delete()
	{
	        $str = "DELETE FROM HUKUMAN
	                WHERE HUKUMAN_ID = '".$this->getField("HUKUMAN_ID")."'";
			$this->query = $str;

			// parse ke dua sesuai aksi
			$this->setlogdata("HUKUMAN", "DELETE", $str);

	        return $this->execQuery($str);
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT 
				   CASE
					WHEN CURRENT_DATE <= a.TANGGAL_AKHIR AND CURRENT_DATE >= a.TANGGAL_MULAI
					THEN 'Ya'
					ELSE 'Tidak'
				   END STATUS_BERLAKU,
				   HUKUMAN_ID, PEGAWAI_ID, 
				   case when PEJABAT_PENETAP_ID =  NULL then (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) else a.PEJABAT_PENETAP_ID end PEJABAT_PENETAP_ID, 
				   JENIS_HUKUMAN_ID, NO_SK, TANGGAL_SK, TINGKAT_HUKUMAN_ID, PERATURAN_ID,
				   TMT_SK, KETERANGAN, BERLAKU,
				   case when BERLAKU = 1 then 'Ya' when BERLAKU =  0 then 'Tidak' end  LAKU,
				   (SELECT x.JABATAN FROM PEJABAT_PENETAP x WHERE x.PEJABAT_PENETAP_ID = a.PEJABAT_PENETAP_ID) NMPEJABATPENETAP,
                   (SELECT x.TINGKAT_HUKUMAN_ID FROM TINGKAT_HUKUMAN x, JENIS_HUKUMAN y WHERE x.TINGKAT_HUKUMAN_ID = y.TINGKAT_HUKUMAN_ID
                    AND y.JENIS_HUKUMAN_ID = a.JENIS_HUKUMAN_ID) TINGKAT_HUKUMAN_ID,
                   (SELECT x.NAMA FROM TINGKAT_HUKUMAN x, JENIS_HUKUMAN y WHERE x.TINGKAT_HUKUMAN_ID = y.TINGKAT_HUKUMAN_ID 
                    AND y.JENIS_HUKUMAN_ID = a.JENIS_HUKUMAN_ID ) NMTINGKATHUKUMAN,
				   (SELECT x.NAMA FROM PERATURAN x WHERE x.PERATURAN_ID = a.PERATURAN_ID) NMPERATURAN,
                   (SELECT y.NAMA FROM JENIS_HUKUMAN y WHERE y.JENIS_HUKUMAN_ID = a.JENIS_HUKUMAN_ID ) NMJENISHUKUMAN, FOTO_BLOB,
				   a.TANGGAL_MULAI, a.TANGGAL_AKHIR
				FROM HUKUMAN a WHERE 1 = 1 "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY JENIS_HUKUMAN_ID ASC";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    	}

    	function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
			SELECT COUNT(1) AS ROWCOUNT 
			FROM HUKUMAN WHERE 1=1 ".$statement; 
				
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		$this->query = $str;
		// echo $str;exit;
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0;  
    	}
} 
?>