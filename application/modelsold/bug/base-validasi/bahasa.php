<? 
  include_once(APPPATH.'/models/Entity.php');

  class Bahasa extends Entity{ 

	var $query;

    function Bahasa()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.BAHASA")); 
		
		$str = "INSERT INTO validasi.BAHASA (
				   BAHASA_ID, PEGAWAI_ID, JENIS, 
				   NAMA, KEMAMPUAN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
				VALUES (
				  ".$this->getField("BAHASA_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("JENIS")."',
				  '".$this->getField("NAMA")."',
				  '".$this->getField("KEMAMPUAN")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."',
				  ".$this->getField("TEMP_VALIDASI_ID")."
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE validasi.BAHASA
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   JENIS    = '".$this->getField("JENIS")."',
					   NAMA             = '".$this->getField("NAMA")."',
					   KEMAMPUAN     = '".$this->getField("KEMAMPUAN")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
				// echo  $str;exit;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM validasi.BAHASA
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }


    function updatetanggalvalidasi()
	{
		$str = "		
		UPDATE validasi.BAHASA 
		SET
			TANGGAL_VALIDASI= NOW()
		WHERE TEMP_VALIDASI_ID = ".$this->getField("TEMP_VALIDASI_ID")."
		"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function updatevalidasi()
	{
		$str = "		
		UPDATE validasi.BAHASA
		SET    
		PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
		JENIS    = '".$this->getField("JENIS")."',
		NAMA             = '".$this->getField("NAMA")."',
		KEMAMPUAN     = '".$this->getField("KEMAMPUAN")."',
		VALIDASI	= ".$this->getField("VALIDASI").",
		LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
		LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
		LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."',
		TANGGAL_VALIDASI= NOW()
		WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
		"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function updatevalidasihapusdata()
	{
        $str = "
        UPDATE validasi.HAPUS_DATA
        SET
	        VALIDASI= ".$this->getField("VALIDASI").",
	        TANGGAL_VALIDASI= NOW()
        WHERE 
        TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
        AND HAPUS_NAMA= 'BAHASA' AND VALIDASI IS NULL
        ";
				  
		$this->query = $str;
		// echo $str;exit;
        return $this->execQuery($str);
    }

    function deletehapusdata()
	{
        $str = "
        DELETE FROM validasi.HAPUS_DATA
        WHERE 
        TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
        AND HAPUS_NAMA= 'BAHASA' AND VALIDASI IS NULL
        ";
				  
		$this->query = $str;
		// echo $str;exit;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT BAHASA_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, JENIS, NAMA, KEMAMPUAN,
			CASE WHEN JENIS = '1' THEN 'Asing' ELSE 'Daerah' END NMJENIS, 
			CASE WHEN KEMAMPUAN = '1' THEN 'Aktif' ELSE 'Pasif' END MAMPU
			,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
		FROM validasi.validasi_pegawai_bahasa 
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