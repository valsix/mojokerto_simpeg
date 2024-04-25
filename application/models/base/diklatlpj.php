<? 
include_once(APPPATH.'/models/Entity.php');

class DiklatLpj extends Entity{ 

	var $query;

	function DiklatLpj()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("DIKLAT_LPJ_ID", $this->getNextId("DIKLAT_LPJ_ID","diklat_lpj")); 
		// DIKLAT_ID
		$str = "
		INSERT INTO diklat_lpj
		(
			DIKLAT_LPJ_ID, PEGAWAI_ID, TEMPAT, PENYELENGGARA, ANGKATAN, TAHUN, NO_STTPP, TANGGAL_MULAI
			, TANGGAL_SELESAI, TANGGAL_STTPP, JUMLAH_JAM
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES
		(
			".$this->getField("DIKLAT_LPJ_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
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

		$this->id= $this->getField("DIKLAT_LPJ_ID");
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("diklat_lpj", "INSERT", $str);

		return $this->execQuery($str);
    }

	function update()
	{
		$str = "
		UPDATE diklat_lpj
		SET    
			PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
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
		WHERE DIKLAT_LPJ_ID= '".$this->getField("DIKLAT_LPJ_ID")."'
		"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("diklat_lpj", "UPDATE", $str);

		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "
        DELETE FROM diklat_lpj
        WHERE 
        DIKLAT_LPJ_ID = '".$this->getField("DIKLAT_LPJ_ID")."'";
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("diklat_lpj", "DELETE", $str);

        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT
			DIKLAT_LPJ_ID, PEGAWAI_ID, TEMPAT, PENYELENGGARA, ANGKATAN, TAHUN, NO_STTPP, TANGGAL_MULAI, TANGGAL_SELESAI
			, TANGGAL_STTPP, JUMLAH_JAM, A.DIKLAT_ID
			-- , (SELECT x.NAMA FROM DIKLAT x WHERE x.DIKLAT_ID = a.DIKLAT_ID) NAMADIKLAT
			, FOTO_BLOB
		FROM diklat_lpj A
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TANGGAL_MULAI ASC";
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>