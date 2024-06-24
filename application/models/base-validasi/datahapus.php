<? 
include_once(APPPATH.'/models/Entity.php');

class DataHapus extends Entity{ 

	var $query;

	function DataHapus()
	{
		$this->Entity(); 
	}

	function inserthapusdata()
	{
		$this->setField("HAPUS_DATA_ID", $this->getNextId("HAPUS_DATA_ID","validasi.HAPUS_DATA")); 
        $str = "
        INSERT INTO validasi.HAPUS_DATA
        (
	        HAPUS_DATA_ID, PEGAWAI_ID, TEMP_VALIDASI_ID, HAPUS_NAMA
	        , LAST_CREATE_USER, LAST_CREATE_DATE, LAST_USER, LAST_DATE
        )
        VALUES 
        (
	        ".$this->getField("HAPUS_DATA_ID")."
	        , ".$this->getField("PEGAWAI_ID")."
	        , ".$this->getField("TEMP_VALIDASI_ID")."
	        , '".$this->getField("HAPUS_NAMA")."'
	        , '".$this->getField("LAST_CREATE_USER")."'
	        , NOW()
	        , '".$this->getField("LAST_CREATE_USER")."'
	        , NOW()
	    )";
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function deletehapusdata()
	{
        $str = "
        DELETE FROM validasi.HAPUS_DATA
        WHERE 
        TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
        AND HAPUS_NAMA= '".$this->getField("HAPUS_NAMA")."'
        AND VALIDASI IS NULL
        ";
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

	function hapusdata()
	{
		$str = "
		DELETE FROM validasi.".$this->getField("TABLE")."
		WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
		";
		$this->query = $str;
		return $this->execQuery($str);
    }
} 
?>