<? 
  include_once(APPPATH.'/models/Entity.php');

  class OrganisasiRiwayat extends Entity{ 

	var $query;

    function OrganisasiRiwayat()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.ORGANISASI_RIWAYAT")); 
		
		$str = "INSERT INTO validasi.ORGANISASI_RIWAYAT (
				   ORGANISASI_RIWAYAT_ID, PEGAWAI_ID, JABATAN, 
				   NAMA, TANGGAL_AWAL, TANGGAL_AKHIR, 
				   PIMPINAN, TEMPAT, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
				VALUES (
				  ".$this->getField("ORGANISASI_RIWAYAT_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("JABATAN")."',
				  '".$this->getField("NAMA")."',
				  ".$this->getField("TANGGAL_AWAL").",
				  ".$this->getField("TANGGAL_AKHIR").",
				  '".$this->getField("PIMPINAN")."',
				  '".$this->getField("TEMPAT")."',
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
				UPDATE validasi.ORGANISASI_RIWAYAT
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   JABATAN= '".$this->getField("JABATAN")."',
					   NAMA= '".$this->getField("NAMA")."',
					   TANGGAL_AWAL= ".$this->getField("TANGGAL_AWAL").",
					   TANGGAL_AKHIR= ".$this->getField("TANGGAL_AKHIR").",
					   PIMPINAN= '".$this->getField("PIMPINAN")."',
					   TEMPAT= '".$this->getField("TEMPAT")."',
					  LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }

    function updatevalidasi()
	{
		$str = "
				UPDATE validasi.ORGANISASI_RIWAYAT
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   JABATAN= '".$this->getField("JABATAN")."',
					   NAMA= '".$this->getField("NAMA")."',
					   TANGGAL_AWAL= ".$this->getField("TANGGAL_AWAL").",
					   TANGGAL_AKHIR= ".$this->getField("TANGGAL_AKHIR").",
					   PIMPINAN= '".$this->getField("PIMPINAN")."',
					   TEMPAT= '".$this->getField("TEMPAT")."',
					   VALIDASI	= ".$this->getField("VALIDASI").",
					   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."',
					   TANGGAL_VALIDASI= NOW()
				WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }


    function delete()
	{
        $str = "DELETE FROM validasi.ORGANISASI_RIWAYAT
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }
	

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT ORGANISASI_RIWAYAT_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, JABATAN, 
		   NAMA, TANGGAL_AWAL, TANGGAL_AKHIR, 
		   PIMPINAN, TEMPAT
		   ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
		FROM validasi.validasi_pegawai_organisasi_riwayat
		WHERE 1 = 1
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