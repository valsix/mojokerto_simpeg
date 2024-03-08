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
		$this->setField("ORGANISASI_RIWAYAT_ID", $this->getNextId("ORGANISASI_RIWAYAT_ID","ORGANISASI_RIWAYAT")); 
		
		$str = "INSERT INTO ORGANISASI_RIWAYAT (
				   ORGANISASI_RIWAYAT_ID, PEGAWAI_ID, JABATAN, 
				   NAMA, TANGGAL_AWAL, TANGGAL_AKHIR, 
				   PIMPINAN, TEMPAT, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
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
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE ORGANISASI_RIWAYAT
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
				WHERE ORGANISASI_RIWAYAT_ID= ".$this->getField("ORGANISASI_RIWAYAT_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }


    function delete()
	{
        $str = "DELETE FROM ORGANISASI_RIWAYAT
                WHERE 
                  ORGANISASI_RIWAYAT_ID= '".$this->getField("ORGANISASI_RIWAYAT_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }
	

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT ORGANISASI_RIWAYAT_ID, PEGAWAI_ID, JABATAN, 
		   NAMA, TANGGAL_AWAL, TANGGAL_AKHIR, 
		   PIMPINAN, TEMPAT
		FROM ORGANISASI_RIWAYAT
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