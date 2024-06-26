<? 
include_once(APPPATH.'/models/Entity.php');

class PenguasaanBahasa extends Entity{ 

	var $query;

	function PenguasaanBahasa()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("BAHASA_ID", $this->getNextId("BAHASA_ID","bahasa"));

		$str = "
		INSERT INTO bahasa
		(
			BAHASA_ID, PEGAWAI_ID, JENIS, NAMA, KEMAMPUAN
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		) 
		VALUES 
		(
			".$this->getField("BAHASA_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("JENIS")."'
			, '".$this->getField("NAMA")."'
			, '".$this->getField("KEMAMPUAN")."'
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)"; 

		$this->id= $this->getField("BAHASA_ID"); 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("bahasa", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE bahasa
		SET    
			PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
			, JENIS= '".$this->getField("JENIS")."'
			, NAMA= '".$this->getField("NAMA")."'
			, KEMAMPUAN= '".$this->getField("KEMAMPUAN")."'
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE BAHASA_ID= '".$this->getField("BAHASA_ID")."'
		"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("bahasa", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "
        DELETE FROM bahasa
        WHERE 
        BAHASA_ID = '".$this->getField("BAHASA_ID")."'"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("bahasa", "DELETE", $str);
		
        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT
			BAHASA_ID, PEGAWAI_ID, JENIS, NAMA, KEMAMPUAN
			, case when JENIS = '1' then 'Asing' when JENIS = '2' then 'Daerah' end NMJENIS
			, case when KEMAMPUAN =  '1' then 'Aktif' when KEMAMPUAN =  '2' then 'Pasif' end MAMPU
			, FOTO_BLOB
		FROM bahasa A WHERE BAHASA_ID IS NOT NULL "; 
		
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
		FROM bahasa A WHERE  BAHASA_ID IS NOT NULL ".$statement; 
				
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