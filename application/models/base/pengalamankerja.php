<? 
include_once(APPPATH.'/models/Entity.php');

class PengalamanKerja extends Entity{ 

	var $query;

	function PengalamanKerja()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT PENGALAMAN_ID, PEGAWAI_ID, JABATAN, 
				   NAMA, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
				   TANGGAL_KERJA, FOTO_BLOB
				FROM PENGALAMAN WHERE PENGALAMAN_ID IS NOT NULL "; 
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY pengalaman_id";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }


	function insert()
	{
		$this->setField("PENGALAMAN_ID", $this->getNextId("PENGALAMAN_ID","PENGALAMAN")); 

		$str = "INSERT INTO PENGALAMAN (
				PENGALAMAN_ID, PEGAWAI_ID, NAMA, 
				JABATAN, MASA_KERJA_TAHUN,MASA_KERJA_BULAN, TANGGAL_KERJA)
				VALUES (
				  ".$this->getField("PENGALAMAN_ID").",
				  ".$this->getField("PEGAWAI_ID").",
				  '".$this->getField("NAMA")."',
				  '".$this->getField("JABATAN")."',
				  ".$this->getField("MASA_KERJA_TAHUN").",
				  ".$this->getField("MASA_KERJA_BULAN").",
				  ".$this->getField("TANGGAL_KERJA")."
				)"; 
				
		$this->id= $this->getField("PENGALAMAN_ID");
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE PENGALAMAN
				SET    
					   NAMA    = '".$this->getField("NAMA")."',
					   JABATAN    = '".$this->getField("JABATAN")."',
					   MASA_KERJA_TAHUN    = ".$this->getField("MASA_KERJA_TAHUN").",
					   MASA_KERJA_BULAN    = ".$this->getField("MASA_KERJA_BULAN").",
					   TANGGAL_KERJA    = ".$this->getField("TANGGAL_KERJA")."
				WHERE  PENGALAMAN_ID          = '".$this->getField("PENGALAMAN_ID")."'
				"; 
				// $this->query = $str;

				// echo $str;exit;
		return $this->execQuery($str);
    }


	function delete()
	{
        $str = "DELETE FROM PENGALAMAN
                WHERE 
                  PENGALAMAN_ID = '".$this->getField("PENGALAMAN_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }
} 
?>