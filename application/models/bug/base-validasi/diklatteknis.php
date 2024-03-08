<? 
  include_once(APPPATH.'/models/Entity.php');

  class DiklatTeknis extends Entity{ 

	var $query;

    function DiklatTeknis()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.DIKLAT_TEKNIS")); 
		
		$str = "INSERT INTO validasi.DIKLAT_TEKNIS (
				   DIKLAT_TEKNIS_ID, NAMA, PEGAWAI_ID, TEMPAT, 
				   PENYELENGGARA, ANGKATAN, TAHUN, 
				   NO_STTPP, TANGGAL_MULAI, TANGGAL_SELESAI, 
				   TANGGAL_STTPP, JUMLAH_JAM, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
				VALUES (
				  ".$this->getField("DIKLAT_TEKNIS_ID").",
				  '".$this->getField("NAMA")."',
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("TEMPAT")."',
				  '".$this->getField("PENYELENGGARA")."',
				  '".$this->getField("ANGKATAN")."',
				  ".$this->getField("TAHUN").",
				  '".$this->getField("NO_STTPP")."',
				  ".$this->getField("TANGGAL_MULAI").",
				  ".$this->getField("TANGGAL_SELESAI").",
				  ".$this->getField("TANGGAL_STTPP").",
				  ".$this->getField("JUMLAH_JAM").",
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
				UPDATE validasi.DIKLAT_TEKNIS
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   NAMA= '".$this->getField("NAMA")."',
					   TEMPAT= '".$this->getField("TEMPAT")."',
					   PENYELENGGARA= '".$this->getField("PENYELENGGARA")."',
					   ANGKATAN= '".$this->getField("ANGKATAN")."',
					   TAHUN= ".$this->getField("TAHUN").",
					   NO_STTPP= '".$this->getField("NO_STTPP")."',
					   TANGGAL_MULAI= ".$this->getField("TANGGAL_MULAI").",
					   TANGGAL_SELESAI= ".$this->getField("TANGGAL_SELESAI").",
					   TANGGAL_STTPP= ".$this->getField("TANGGAL_STTPP").",
					   JUMLAH_JAM= ".$this->getField("JUMLAH_JAM").",
					  LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM validasi.DIKLAT_TEKNIS
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT DIKLAT_TEKNIS_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, TEMPAT, 
		   PENYELENGGARA, ANGKATAN, TAHUN, 
		   NO_STTPP, TANGGAL_MULAI, TANGGAL_SELESAI, 
		   TANGGAL_STTPP, JUMLAH_JAM, NAMA
		   ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
		FROM validasi.validasi_pegawai_diklat_teknis 
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