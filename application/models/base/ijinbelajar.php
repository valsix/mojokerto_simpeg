<? 
include_once(APPPATH.'/models/Entity.php');

class IjinBelajar extends Entity{ 

	var $query;

	function IjinBelajar()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("IJIN_BELAJAR_ID", $this->getNextId("IJIN_BELAJAR_ID","IJIN_BELAJAR")); 

		$str = "INSERT INTO IJIN_BELAJAR (
				   IJIN_BELAJAR_ID, PEGAWAI_ID,NOMOR_SURAT,TANGGAL_SURAT,NAMA_PERGURUAN,PROGRAM_STUDI,JURUSAN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("IJIN_BELAJAR_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("NOMOR_SURAT")."',
				  ".$this->getField("TANGGAL_SURAT").",
				  '".$this->getField("NAMA_PERGURUAN")."',
				  '".$this->getField("PROGRAM_STUDI")."',
				  '".$this->getField("JURUSAN")."',	 
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)";

		$this->id= $this->getField("IJIN_BELAJAR_ID"); 
				
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }


    function update()
	{
		$str = "
				UPDATE IJIN_BELAJAR
				SET
					   NOMOR_SURAT= '".$this->getField("NOMOR_SURAT")."',
					   TANGGAL_SURAT= ".$this->getField("TANGGAL_SURAT").",
					   NAMA_PERGURUAN= '".$this->getField("NAMA_PERGURUAN")."',
					   PROGRAM_STUDI= '".$this->getField("PROGRAM_STUDI")."',
					   JURUSAN= '".$this->getField("JURUSAN")."',
					   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  IJIN_BELAJAR_ID = '".$this->getField("IJIN_BELAJAR_ID")."'
			 "; 
		$this->query = $str;
		return $this->execQuery($str);
    }


	function delete()
	{
        $str = "DELETE FROM IJIN_BELAJAR
                WHERE 
                  IJIN_BELAJAR_ID = '".$this->getField("IJIN_BELAJAR_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT 
                   LINK_FILE_APPS,
                   IJIN_BELAJAR_ID, PEGAWAI_ID,NOMOR_SURAT,TANGGAL_SURAT,NAMA_PERGURUAN,PROGRAM_STUDI,JURUSAN
                  
                FROM IJIN_BELAJAR WHERE IJIN_BELAJAR_ID IS NOT NULL "; 
		
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