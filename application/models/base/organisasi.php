<? 
include_once(APPPATH.'/models/Entity.php');

class Organisasi extends Entity{ 

	var $query;

	function Organisasi()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("ORGANISASI_RIWAYAT_ID", $this->getNextId("ORGANISASI_RIWAYAT_ID","ORGANISASI_RIWAYAT")); 

		$str = "INSERT INTO ORGANISASI_RIWAYAT (
				   ORGANISASI_RIWAYAT_ID, PEGAWAI_ID, JABATAN, 
				   NAMA, TANGGAL_AWAL, TANGGAL_AKHIR, 
				   PIMPINAN, TEMPAT, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER) 
				VALUES (
				  ".$this->getField("ORGANISASI_RIWAYAT_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("JABATAN")."',
				  '".$this->getField("NAMA")."',
				  ".$this->getField("TANGGAL_AWAL").",
				  ".$this->getField("TANGGAL_AKHIR").",
				  '".$this->getField("PIMPINAN")."',
				  '".$this->getField("TEMPAT")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE ORGANISASI_RIWAYAT
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   JABATAN    = '".$this->getField("JABATAN")."',
					   NAMA             = '".$this->getField("NAMA")."',
					   TANGGAL_AWAL     = ".$this->getField("TANGGAL_AWAL").",
					   TANGGAL_AKHIR    = ".$this->getField("TANGGAL_AKHIR").",
					   PIMPINAN    = '".$this->getField("PIMPINAN")."',
					   TEMPAT  = '".$this->getField("TEMPAT")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  ORGANISASI_RIWAYAT_ID          = '".$this->getField("ORGANISASI_RIWAYAT_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM ORGANISASI_RIWAYAT
                WHERE 
                  ORGANISASI_RIWAYAT_ID = '".$this->getField("ORGANISASI_RIWAYAT_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT ORGANISASI_RIWAYAT_ID, PEGAWAI_ID, JABATAN, 
				   NAMA, TANGGAL_AWAL, TANGGAL_AKHIR, 
				   PIMPINAN, TEMPAT, FOTO_BLOB
				FROM ORGANISASI_RIWAYAT WHERE ORGANISASI_RIWAYAT_ID IS NOT NULL "; 
		//, AMBIL_JUMLAH_BULAN(TANGGAL_AWAL, TANGGAL_AKHIR) LAMA
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY NAMA ASC";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }

  function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
				SELECT COUNT(1) AS ROWCOUNT 
				FROM ORGANISASI_RIWAYAT WHERE ORGANISASI_RIWAYAT_ID IS NOT NULL ".$statement; 
				
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