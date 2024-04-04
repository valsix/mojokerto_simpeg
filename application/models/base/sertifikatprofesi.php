<? 
include_once(APPPATH.'/models/Entity.php');

class SertifikatProfesi extends Entity{ 

	var $query;

	function SertifikatProfesi()
	{
		$this->Entity(); 
	}



	function insert()
	{
		$this->setField("SERTIFIKAT_PROFESI_ID", $this->getNextId("SERTIFIKAT_PROFESI_ID","SERTIFIKAT_PROFESI")); 

		$str = "INSERT INTO SERTIFIKAT_PROFESI (
				   SERTIFIKAT_PROFESI_ID, PEGAWAI_ID,NAMA,NOMOR,SERTIFIKAT,TANGGAL,LEMBAGA,LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("SERTIFIKAT_PROFESI_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("NAMA")."',	
				  '".$this->getField("NOMOR")."',
				  '".$this->getField("SERTIFIKAT")."', 
				  ".$this->getField("TANGGAL").", 
				  '".$this->getField("LEMBAGA")."', 
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->id= $this->getField("PAK_ID");
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE SERTIFIKAT_PROFESI
				SET    
					   NAMA    = '".$this->getField("NAMA")."',
					   NOMOR    = '".$this->getField("NOMOR")."',
					   SERTIFIKAT    = '".$this->getField("SERTIFIKAT")."',
					   TANGGAL    = ".$this->getField("TANGGAL").",
					   LEMBAGA    = '".$this->getField("LEMBAGA")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  SERTIFIKAT_PROFESI_ID          = '".$this->getField("SERTIFIKAT_PROFESI_ID")."'
				"; 
				$this->query = $str;

				// echo $str;exit;
		return $this->execQuery($str);
    }


	function delete()
	{
        $str = "DELETE FROM SERTIFIKAT_PROFESI
                WHERE 
                  SERTIFIKAT_PROFESI_ID = '".$this->getField("SERTIFIKAT_PROFESI_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT 
		SERTIFIKAT_PROFESI_ID, PEGAWAI_ID, NAMA, 
		NOMOR, SERTIFIKAT, LEMBAGA, TANGGAL,
		FORMAT, UKURAN
		FROM SERTIFIKAT_PROFESI
		WHERE 1=1"; 
		
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