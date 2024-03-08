<? 
  include_once(APPPATH.'/models/Entity.php');

  class Seminar extends Entity{ 

	var $query;

    function Seminar()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.SEMINAR")); 
		
		$str = "INSERT INTO validasi.SEMINAR (
				   SEMINAR_ID, PEGAWAI_ID, TEMPAT, 
				   PENYELENGGARA, TANGGAL_MULAI, TANGGAL_SELESAI, 
				   NO_PIAGAM, TANGGAL_PIAGAM, NAMA, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
				VALUES (
				  ".$this->getField("SEMINAR_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("TEMPAT")."',
				  '".$this->getField("PENYELENGGARA")."',
				  ".$this->getField("TANGGAL_MULAI").",
				  ".$this->getField("TANGGAL_SELESAI").",
				  '".$this->getField("NO_PIAGAM")."',
				  ".$this->getField("TANGGAL_PIAGAM").",
				  '".$this->getField("NAMA")."',				 
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
				UPDATE validasi.SEMINAR
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   TEMPAT    = '".$this->getField("TEMPAT")."',
					   PENYELENGGARA             = '".$this->getField("PENYELENGGARA")."',
					   TANGGAL_MULAI     = ".$this->getField("TANGGAL_MULAI").",
					   TANGGAL_SELESAI    = ".$this->getField("TANGGAL_SELESAI").",
					   NO_PIAGAM    = '".$this->getField("NO_PIAGAM")."',
					   TANGGAL_PIAGAM  = ".$this->getField("TANGGAL_PIAGAM").",
					   NAMA = '".$this->getField("NAMA")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM validasi.SEMINAR
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT SEMINAR_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, TEMPAT, NAMA,
			   PENYELENGGARA, TANGGAL_MULAI, TANGGAL_SELESAI, 
			   NO_PIAGAM, TANGGAL_PIAGAM
			   ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
		FROM validasi.validasi_pegawai_seminar
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