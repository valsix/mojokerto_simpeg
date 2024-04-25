<? 
include_once(APPPATH.'/models/Entity.php');

class PendidikanUmum extends Entity{ 

	var $query;

	function PendidikanUmum()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("PENDIDIKAN_RIWAYAT_ID", $this->getNextId("PENDIDIKAN_RIWAYAT_ID","pendidikan_riwayat")); 

		$str = "
		INSERT INTO pendidikan_riwayat
		(
			PENDIDIKAN_RIWAYAT_ID, PEGAWAI_ID, PENDIDIKAN_ID, NAMA, JURUSAN, TEMPAT, KEPALA, NO_STTB, TANGGAL_STTB
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES
		(
			".$this->getField("PENDIDIKAN_RIWAYAT_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, ".$this->getField("PENDIDIKAN_ID")."
			, '".$this->getField("NAMA")."'
			, '".$this->getField("JURUSAN")."'
			, '".$this->getField("TEMPAT")."'
			, '".$this->getField("KEPALA")."'
			, '".$this->getField("NO_STTB")."'
			, ".$this->getField("TANGGAL_STTB")."
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)";

		$this->id= $this->getField("PENDIDIKAN_RIWAYAT_ID");
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("pendidikan_riwayat", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE pendidikan_riwayat
		SET    
			PENDIDIKAN_ID= ".$this->getField("PENDIDIKAN_ID")."
			, NAMA= '".$this->getField("NAMA")."'
			, JURUSAN= '".$this->getField("JURUSAN")."'
			, TEMPAT= '".$this->getField("TEMPAT")."'
			, KEPALA= '".$this->getField("KEPALA")."'
			, NO_STTB= '".$this->getField("NO_STTB")."'
			, TANGGAL_STTB= ".$this->getField("TANGGAL_STTB")."
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE PENDIDIKAN_RIWAYAT_ID= '".$this->getField("PENDIDIKAN_RIWAYAT_ID")."'
		AND PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
		";
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("pendidikan_riwayat", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "
        DELETE FROM pendidikan_riwayat
        WHERE PENDIDIKAN_RIWAYAT_ID = '".$this->getField("PENDIDIKAN_RIWAYAT_ID")."'";
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("pendidikan_riwayat", "DELETE", $str);

        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str =  "
		SELECT
			PENDIDIKAN_RIWAYAT_ID, PEGAWAI_ID, a.PENDIDIKAN_ID, A.NAMA, JURUSAN_PENDIDIKAN_ID, TEMPAT, KEPALA, NO_STTB
			, TANGGAL_STTB, b.NAMA as PENDIDIKAN, FOTO_BLOB,a.JURUSAN JURUSAN
			, case when a.PENDIDIKAN_ID is NULL then JURUSAN else (SELECT X.NAMA  FROM JURUSAN_PENDIDIKAN X WHERE X.JURUSAN_PENDIDIKAN_ID = a.JURUSAN_PENDIDIKAN_ID) end NMJURUSAN
			, LINK_FILE_APPS, LINK_FILE_APPS_TRANSKRIP
		FROM pendidikan_riwayat A, pendidikan B WHERE A.PENDIDIKAN_ID = B.PENDIDIKAN_ID "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TANGGAL_STTB DESC";
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from);
    }

    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
		SELECT COUNT(1) AS ROWCOUNT 
		FROM pendidikan_riwayat A, pendidikan B
		WHERE A.PENDIDIKAN_ID = B.PENDIDIKAN_ID ".$statement; 

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