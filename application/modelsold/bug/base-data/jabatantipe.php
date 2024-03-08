<? 
  include_once(APPPATH.'/models/Entity.php');

  class JabatanTipe extends Entity{ 

	var $query;

    function JabatanTipe()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.PEGAWAI_JABATAN")); 
		
		$str = "INSERT INTO validasi.PEGAWAI_JABATAN (
				   PEGAWAI_JABATAN, PEGAWAI_ID, JENIS, 
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
        $str = "DELETE FROM validasi.JABATAN
                WHERE 
                  TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT PEGAWAI_ID, KATEGORI_JABATAN_ID, NAMA_JABATAN_ID, BUP, KELAS_JABATAN, TMT_JABATAN, TANGGAL_SK, NO_SK
			,TEMP_VALIDASI_HAPUS_ID,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
		FROM validasi.validasi_pegawai_jabatan
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