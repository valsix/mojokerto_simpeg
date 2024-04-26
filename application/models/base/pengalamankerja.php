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
		$this->setlogdata("pengalaman_kerja", "INSERT", $str);
		// echo $str;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }


	function insert()
	{
		$this->setField("PENGALAMAN_ID", $this->getNextId("PENGALAMAN_ID","PENGALAMAN")); 

		$str = "INSERT INTO PENGALAMAN (
				PENGALAMAN_ID, PEGAWAI_ID, NAMA, 
				JABATAN, MASA_KERJA_TAHUN,MASA_KERJA_BULAN, TANGGAL_KERJA
				, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
				)
				VALUES (
				  ".$this->getField("PENGALAMAN_ID")."
				  ,".$this->getField("PEGAWAI_ID")."
				  ,'".$this->getField("NAMA")."'
				  ,'".$this->getField("JABATAN")."'
				  ,".$this->getField("MASA_KERJA_TAHUN")."
				  ,".$this->getField("MASA_KERJA_BULAN")."
				  ,".$this->getField("TANGGAL_KERJA")."
					, '".$this->getField("LAST_CREATE_USER")."'
					, ".$this->getField("LAST_CREATE_DATE")."
					, '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->id= $this->getField("PENGALAMAN_ID");
		$this->query = $str;
		$this->setlogdata("pengalaman_kerja", "UPDATE", $str);
		// echo $str;exit;
		return $this->execQuery($str);
  }

  function update()
	{
		$str = "
				UPDATE PENGALAMAN
				SET    
					   NAMA    = '".$this->getField("NAMA")."'
					  ,JABATAN    = '".$this->getField("JABATAN")."'
					  ,MASA_KERJA_TAHUN    = ".$this->getField("MASA_KERJA_TAHUN")."
					  ,MASA_KERJA_BULAN    = ".$this->getField("MASA_KERJA_BULAN")."
					  ,TANGGAL_KERJA    = ".$this->getField("TANGGAL_KERJA")."
					  , LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
						, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
						, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
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