<? 
include_once(APPPATH.'/models/Entity.php');

class PelatihanTeknis extends Entity{ 

	var $query;

	function PelatihanTeknis()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("DIKLAT_TEKNIS_ID", $this->getNextId("DIKLAT_TEKNIS_ID","diklat_teknis"));

		$str = "
		INSERT INTO diklat_teknis
		(
			DIKLAT_TEKNIS_ID, PEGAWAI_ID, TEMPAT, PENYELENGGARA, TANGGAL_MULAI, TANGGAL_SELESAI, NO_STTPP, TANGGAL_STTPP
			, NAMA, ANGKATAN, TAHUN, JUMLAH_JAM
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES
		(
			".$this->getField("DIKLAT_TEKNIS_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("TEMPAT")."'
			, '".$this->getField("PENYELENGGARA")."'
			, ".$this->getField("TANGGAL_MULAI")."
			, ".$this->getField("TANGGAL_SELESAI")."
			, '".$this->getField("NO_STTPP")."'
			, ".$this->getField("TANGGAL_STTPP")."
			, '".$this->getField("NAMA")."'
			, ".$this->getField("ANGKATAN")."
			, ".$this->getField("TAHUN")."
			, ".$this->getField("JUMLAH_JAM")."
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)";

		$this->id= $this->getField("DIKLAT_TEKNIS_ID");
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("diklat_teknis", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE diklat_teknis
		SET    
			PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
			, TEMPAT= '".$this->getField("TEMPAT")."'
			, PENYELENGGARA= '".$this->getField("PENYELENGGARA")."'
			, TANGGAL_MULAI= ".$this->getField("TANGGAL_MULAI")."
			, TANGGAL_SELESAI= ".$this->getField("TANGGAL_SELESAI")."
			, NO_STTPP= '".$this->getField("NO_STTPP")."'
			, TANGGAL_STTPP= ".$this->getField("TANGGAL_STTPP")."
			, NAMA= '".$this->getField("NAMA")."'
			, ANGKATAN= ".$this->getField("ANGKATAN")."
			, TAHUN= ".$this->getField("TAHUN")."
			, JUMLAH_JAM= ".$this->getField("JUMLAH_JAM")."
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE DIKLAT_TEKNIS_ID= '".$this->getField("DIKLAT_TEKNIS_ID")."'
		"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("diklat_teknis", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "
        DELETE FROM diklat_teknis
        WHERE 
        DIKLAT_TEKNIS_ID = '".$this->getField("DIKLAT_TEKNIS_ID")."'";
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("diklat_teknis", "DELETE", $str);

        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT
		DIKLAT_TEKNIS_ID, PEGAWAI_ID, TEMPAT, 
		PENYELENGGARA, ANGKATAN, TAHUN, 
		NO_STTPP, TANGGAL_MULAI, TANGGAL_SELESAI, 
		TANGGAL_STTPP, JUMLAH_JAM, NAMA, FOTO_BLOB
		FROM DIKLAT_TEKNIS A
		WHERE DIKLAT_TEKNIS_ID IS NOT NULL "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TANGGAL_MULAI ASC, TAHUN ";
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
		SELECT COUNT(1) AS ROWCOUNT 
		FROM DIKLAT_TEKNIS A WHERE DIKLAT_TEKNIS_ID IS NOT NULL ".$statement; 
				
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