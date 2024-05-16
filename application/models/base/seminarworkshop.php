<? 
include_once(APPPATH.'/models/Entity.php');

class SeminarWorkshop extends Entity{ 

	var $query;

	function SeminarWorkshop()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("SEMINAR_ID", $this->getNextId("SEMINAR_ID","seminar"));

		$str = "
		INSERT INTO seminar
		(
			SEMINAR_ID, PEGAWAI_ID, TEMPAT, PENYELENGGARA, TANGGAL_MULAI, TANGGAL_SELESAI, NO_PIAGAM, TANGGAL_PIAGAM
			, NAMA, JUMLAH_JAM
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES
		(
			".$this->getField("SEMINAR_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("TEMPAT")."'
			, '".$this->getField("PENYELENGGARA")."'
			, ".$this->getField("TANGGAL_MULAI")."
			, ".$this->getField("TANGGAL_SELESAI")."
			, '".$this->getField("NO_PIAGAM")."'
			, ".$this->getField("TANGGAL_PIAGAM")."
			, '".$this->getField("NAMA")."'
			, ".$this->getField("JUMLAH_JAM")."
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)";

		$this->id= $this->getField("SEMINAR_ID");
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("seminar", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE seminar
		SET    
			PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
			, TEMPAT= '".$this->getField("TEMPAT")."'
			, PENYELENGGARA= '".$this->getField("PENYELENGGARA")."'
			, TANGGAL_MULAI= ".$this->getField("TANGGAL_MULAI")."
			, TANGGAL_SELESAI= ".$this->getField("TANGGAL_SELESAI")."
			, NO_PIAGAM= '".$this->getField("NO_PIAGAM")."'
			, TANGGAL_PIAGAM= ".$this->getField("TANGGAL_PIAGAM")."
			, NAMA= '".$this->getField("NAMA")."'
			, JUMLAH_JAM= ".$this->getField("JUMLAH_JAM")."
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE SEMINAR_ID= '".$this->getField("SEMINAR_ID")."'
		"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("seminar", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "
        DELETE FROM seminar
        WHERE 
        SEMINAR_ID = '".$this->getField("SEMINAR_ID")."'";
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("seminar", "DELETE", $str);

        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT
		SEMINAR_ID, PEGAWAI_ID, TEMPAT, NAMA,
		PENYELENGGARA, TANGGAL_MULAI, TANGGAL_SELESAI, 
		NO_PIAGAM, TANGGAL_PIAGAM, FOTO_BLOB, JUMLAH_JAM
		FROM seminar A
		WHERE SEMINAR_ID IS NOT NULL "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}

		$str .= $statement." ORDER BY TANGGAL_MULAI ASC, TANGGAL_PIAGAM ASC ";		
		$this->query = $str;

		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
		SELECT COUNT(1) AS ROWCOUNT 
		FROM seminar A WHERE SEMINAR_ID IS NOT NULL ".$statement; 
				
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