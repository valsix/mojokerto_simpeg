<? 
include_once(APPPATH.'/models/Entity.php');

class PelatihanKepemimpinan extends Entity{ 

	var $query;

	function PelatihanKepemimpinan()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("DIKLAT_STRUKTURAL_ID", $this->getNextId("DIKLAT_STRUKTURAL_ID","diklat_struktural")); 

		$str = "
		INSERT INTO diklat_struktural
		(
			DIKLAT_STRUKTURAL_ID, PEGAWAI_ID, DIKLAT_ID, TEMPAT, PENYELENGGARA, ANGKATAN, TAHUN, NO_STTPP, TANGGAL_MULAI
			, TANGGAL_SELESAI, TANGGAL_STTPP, JUMLAH_JAM
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES
		(
			".$this->getField("DIKLAT_STRUKTURAL_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, ".$this->getField("DIKLAT_ID")."
			, '".$this->getField("TEMPAT")."'
			, '".$this->getField("PENYELENGGARA")."'
			, ".$this->getField("ANGKATAN")."
			, ".$this->getField("TAHUN")."
			, '".$this->getField("NO_STTPP")."'
			, ".$this->getField("TANGGAL_MULAI")."
			, ".$this->getField("TANGGAL_SELESAI")."
			, ".$this->getField("TANGGAL_STTPP")."
			, ".$this->getField("JUMLAH_JAM")."
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)";

		$this->id= $this->getField("DIKLAT_STRUKTURAL_ID");
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("diklat_struktural", "INSERT", $str);

		return $this->execQuery($str);
    }

	function update()
	{
		$str = "
		UPDATE diklat_struktural
		SET    
			PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
			, DIKLAT_ID= ".$this->getField("DIKLAT_ID")."
			, TEMPAT= '".$this->getField("TEMPAT")."'
			, PENYELENGGARA= '".$this->getField("PENYELENGGARA")."'
			, ANGKATAN= ".$this->getField("ANGKATAN")."
			, TAHUN= ".$this->getField("TAHUN")."
			, NO_STTPP= '".$this->getField("NO_STTPP")."'
			, TANGGAL_MULAI= ".$this->getField("TANGGAL_MULAI")."
			, TANGGAL_SELESAI= ".$this->getField("TANGGAL_SELESAI")."
			, TANGGAL_STTPP= ".$this->getField("TANGGAL_STTPP")."
			, JUMLAH_JAM= ".$this->getField("JUMLAH_JAM")."
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE DIKLAT_STRUKTURAL_ID= '".$this->getField("DIKLAT_STRUKTURAL_ID")."'
		"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("diklat_struktural", "UPDATE", $str);

		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "
        DELETE FROM diklat_struktural
        WHERE 
        DIKLAT_STRUKTURAL_ID = '".$this->getField("DIKLAT_STRUKTURAL_ID")."'";
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("diklat_struktural", "DELETE", $str);

        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT
			DIKLAT_STRUKTURAL_ID, PEGAWAI_ID, TEMPAT,  PENYELENGGARA, ANGKATAN, TAHUN, NO_STTPP, TANGGAL_MULAI
			, TANGGAL_SELESAI, TANGGAL_STTPP, JUMLAH_JAM, A.DIKLAT_ID
			, (SELECT x.NAMA FROM DIKLAT x WHERE x.DIKLAT_ID = a.DIKLAT_ID) NAMADIKLAT, FOTO_BLOB
		FROM diklat_struktural A
		WHERE 1=1"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TANGGAL_MULAI";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
		SELECT COUNT(1) AS ROWCOUNT 
		FROM DIKLAT_STRUKTURAL A WHERE 1=1 ".$statement; 
				
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