<? 
include_once(APPPATH.'/models/Entity.php');

class PenilaianPotensiDiri extends Entity{ 

	var $query;

	function PenilaianPotensiDiri()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("POTENSI_DIRI_ID", $this->getNextId("POTENSI_DIRI_ID","potensi_diri")); 

		$str = "
		INSERT INTO potensi_diri 
		(
			POTENSI_DIRI_ID, PEGAWAI_ID, TANGGUNG_JAWAB, MOTIVASI, MINAT,TAHUN
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES 
		(
			".$this->getField("POTENSI_DIRI_ID").",
			'".$this->getField("PEGAWAI_ID")."',
			'".$this->getField("TANGGUNG_JAWAB")."',
			'".$this->getField("MOTIVASI")."',
			'".$this->getField("MINAT")."',
			'".$this->getField("TAHUN")."',				 
			'".$this->getField("LAST_CREATE_USER")."',
			".$this->getField("LAST_CREATE_DATE").",
			'".$this->getField("LAST_CREATE_SATKER")."'	
		)";	

		$this->id= $this->getField("POTENSI_DIRI_ID");
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("potensi_diri", "INSERT", $str);
		
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE potensi_diri
		SET    
			PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
			, TANGGUNG_JAWAB= '".$this->getField("TANGGUNG_JAWAB")."'
			, MOTIVASI= '".$this->getField("MOTIVASI")."'
			, MINAT= '".$this->getField("MINAT")."'
			, TAHUN= '".$this->getField("TAHUN")."'
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE POTENSI_DIRI_ID= '".$this->getField("POTENSI_DIRI_ID")."'
		"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("potensi_diri", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "
        DELETE FROM potensi_diri
        WHERE 
        POTENSI_DIRI_ID = '".$this->getField("POTENSI_DIRI_ID")."'"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("potensi_diri", "DELETE", $str);

        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT
			POTENSI_DIRI_ID, PEGAWAI_ID, TANGGUNG_JAWAB, 
			MOTIVASI, MINAT, 
			TAHUN, FOTO_BLOB
		FROM potensi_diri A WHERE POTENSI_DIRI_ID IS NOT NULL "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY MOTIVASI ASC";		
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>