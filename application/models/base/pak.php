<? 
include_once(APPPATH.'/models/Entity.php');

class PAK extends Entity{ 

	var $query;

	function PAK()
	{
		$this->Entity(); 
	}


	function insert()
	{
		$this->setField("PAK_ID", $this->getNextId("PAK_ID","pak"));

		$str = "
		INSERT INTO pak
		(
			PAK_ID, PEGAWAI_ID, NOMOR_SK, TGL_SK, ANGKA_KREDIT, BULAN_MULAI, TAHUN_MULAI, BULAN_SELESAI, TAHUN_SELESAI
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES 
		(
			".$this->getField("PAK_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("NOMOR_SK")."'
			, ".$this->getField("TGL_SK")."
			, '".$this->getField("ANGKA_KREDIT")."'
			, '".$this->getField("BULAN_MULAI")."'
			, ".$this->getField("TAHUN_MULAI")."
			, '".$this->getField("BULAN_SELESAI")."'
			, ".$this->getField("TAHUN_SELESAI")."
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)";
				
		$this->id= $this->getField("PAK_ID");
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("pak", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE pak
		SET    
			NOMOR_SK= '".$this->getField("NOMOR_SK")."'
			, TGL_SK= ".$this->getField("TGL_SK")."
			, ANGKA_KREDIT= '".$this->getField("ANGKA_KREDIT")."'
			, BULAN_MULAI= '".$this->getField("BULAN_MULAI")."'
			, TAHUN_MULAI= ".$this->getField("TAHUN_MULAI")."
			, BULAN_SELESAI= '".$this->getField("BULAN_SELESAI")."'
			, TAHUN_SELESAI= ".$this->getField("TAHUN_SELESAI")."
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
			WHERE PAK_ID = '".$this->getField("PAK_ID")."'
		"; 
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("pak", "UPDATE", $str);

		return $this->execQuery($str);
    }


	function delete()
	{
        $str = "
        DELETE FROM pak
        WHERE 
        PAK_ID = '".$this->getField("PAK_ID")."'";
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("pak", "DELETE", $str);

        return $this->execQuery($str);
    }
	

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT
		A.*
		FROM pak A
		WHERE PAK_ID IS NOT NULL "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement."";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>