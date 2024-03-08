<? 
  include_once(APPPATH.'/models/Entity.php');

  class PotensiDiri extends Entity{ 

	var $query;

    function PotensiDiri()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.POTENSI_DIRI")); 
		
		$str = "INSERT INTO validasi.POTENSI_DIRI (
				   POTENSI_DIRI_ID, PEGAWAI_ID, TANGGUNG_JAWAB, 
				   MOTIVASI, MINAT,
				   TAHUN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
				VALUES (
				  ".$this->getField("POTENSI_DIRI_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("TANGGUNG_JAWAB")."',
				  '".$this->getField("MOTIVASI")."',
				  '".$this->getField("MINAT")."',
				  ".$this->getField("TAHUN").",				 
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("TEMP_VALIDASI_ID")."
				)"; 
				
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE validasi.POTENSI_DIRI
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   TANGGUNG_JAWAB= '".$this->getField("TANGGUNG_JAWAB")."',
					   MOTIVASI= '".$this->getField("MOTIVASI")."',
					   MINAT= '".$this->getField("MINAT")."',
					   TAHUN= '".$this->getField("TAHUN")."',
					  LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function updatevalidasi()
	{
		$str = "
				UPDATE validasi.POTENSI_DIRI
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   TANGGUNG_JAWAB= '".$this->getField("TANGGUNG_JAWAB")."',
					   MOTIVASI= '".$this->getField("MOTIVASI")."',
					   MINAT= '".$this->getField("MINAT")."',
					   TAHUN= '".$this->getField("TAHUN")."',
					   VALIDASI	= ".$this->getField("VALIDASI").",
					   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
					   TANGGAL_VALIDASI= NOW()
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM validasi.POTENSI_DIRI
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT POTENSI_DIRI_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, TANGGUNG_JAWAB, 
		   MOTIVASI, MINAT, TAHUN
		   ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
		FROM validasi.validasi_pegawai_potensi_diri
        WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
        
  } 
?>