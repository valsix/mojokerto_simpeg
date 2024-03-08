<? 
  include_once(APPPATH.'/models/Entity.php');

  class OrangTua extends Entity{ 

	var $query;

    function OrangTua()
	{
      $this->Entity(); 
    }

   function insert()
	{
		$this->setField("ORANG_TUA_ID", $this->getNextId("ORANG_TUA_ID","ORANG_TUA")); 
		
		$str = "INSERT INTO ORANG_TUA (
				   ORANG_TUA_ID, PEGAWAI_ID, JENIS_KELAMIN, 
				   NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
				   PEKERJAAN, ALAMAT, KODEPOS, 
				   PROPINSI_ID,
				   KABUPATEN_ID,
				   KECAMATAN_ID,
				   KELURAHAN_ID,
				   TELEPON, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
					".$this->getField("ORANG_TUA_ID").",
					'".$this->getField("PEGAWAI_ID")."',
					'".$this->getField("JENIS_KELAMIN")."',
					'".$this->getField("NAMA")."',
					'".$this->getField("TEMPAT_LAHIR")."',
					".$this->getField("TANGGAL_LAHIR").",
					'".$this->getField("PEKERJAAN")."',
					'".$this->getField("ALAMAT")."',
					'".$this->getField("KODEPOS")."',
					".$this->getField("PROPINSI_ID").",
					".$this->getField("KABUPATEN_ID").",
					".$this->getField("KECAMATAN_ID").",
					".$this->getField("KELURAHAN_ID").",
					'".$this->getField("TELEPON")."',
					'".$this->getField("LAST_CREATE_USER")."',
					".$this->getField("LAST_CREATE_DATE").",
					'".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE ORANG_TUA
				SET    
					   PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."',
					   JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."',
					   NAMA= '".$this->getField("NAMA")."',
					   TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."',
					   TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR").",
					   PEKERJAAN= '".$this->getField("PEKERJAAN")."',
					   ALAMAT= '".$this->getField("ALAMAT")."',
					   KODEPOS= '".$this->getField("KODEPOS")."',
					   PROPINSI_ID=  ".$this->getField("PROPINSI_ID").",
					   KABUPATEN_ID= ".$this->getField("KABUPATEN_ID").",
					   KECAMATAN_ID=".$this->getField("KECAMATAN_ID").",
					   KELURAHAN_ID=".$this->getField("KELURAHAN_ID").",
					   TELEPON= '".$this->getField("TELEPON")."',
					   LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE ORANG_TUA_ID= ".$this->getField("ORANG_TUA_ID")."
				"; 
				$this->query = $str;
				// echo $str;exit;
		return $this->execQuery($str);
    }


    function delete()
	{
        $str = "DELETE FROM ORANG_TUA
                WHERE 
                  ORANG_TUA_ID= '".$this->getField("ORANG_TUA_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function selectByParamsAyah($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
    {
    	$str = "
    	SELECT ORANG_TUA_ID, PEGAWAI_ID, JENIS_KELAMIN, AMBIL_UMUR(TANGGAL_LAHIR) USIA,
    	NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
    	PEKERJAAN, ALAMAT, KODEPOS, 
    	TELEPON, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID,
    	ambil_propinsi(PROPINSI_ID) PROPINSI_NAMA,
    	ambil_kabupaten(PROPINSI_ID, KABUPATEN_ID) KABUPATEN_NAMA,
    	ambil_kecamatan(PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID) KECAMATAN_NAMA,
    	ambil_kelurahan(PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID) KELURAHAN_NAMA
    	FROM ORANG_TUA A
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

    function selectByParamsIbu($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
			SELECT ORANG_TUA_ID, PEGAWAI_ID, JENIS_KELAMIN, AMBIL_UMUR(TANGGAL_LAHIR) USIA,
    	NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
    	PEKERJAAN, ALAMAT, KODEPOS, 
    	TELEPON, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID,
    	ambil_propinsi(PROPINSI_ID) PROPINSI_NAMA,
    	ambil_kabupaten(PROPINSI_ID, KABUPATEN_ID) KABUPATEN_NAMA,
    	ambil_kecamatan(PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID) KECAMATAN_NAMA,
    	ambil_kelurahan(PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID) KELURAHAN_NAMA
    	FROM ORANG_TUA A
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