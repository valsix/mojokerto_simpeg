<? 
include_once(APPPATH.'/models/Entity.php');

class Saudara extends Entity{ 

	var $query;

	function Saudara()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("SAUDARA_ID", $this->getNextId("SAUDARA_ID","SAUDARA"));

		$str = "
		INSERT INTO SAUDARA
		(
			SAUDARA_ID, PEGAWAI_ID, NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, JENIS_KELAMIN, PEKERJAAN, ALAMAT
			, KODEPOS, TELEPON, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID
		) 
		VALUES
		(
			".$this->getField("SAUDARA_ID")."
			, ".$this->getField("PEGAWAI_ID")."
			, '".$this->getField("NAMA")."'
			, '".$this->getField("TEMPAT_LAHIR")."'
			, ".$this->getField("TANGGAL_LAHIR")."
			, '".$this->getField("JENIS_KELAMIN")."'
			, '".$this->getField("PEKERJAAN")."'
			, '".$this->getField("ALAMAT")."'
			, '".$this->getField("KODEPOS")."'
			, '".$this->getField("TELEPON")."'
			, ".$this->getField("PROPINSI_ID")."
			, ".$this->getField("KABUPATEN_ID")."
			, ".$this->getField("KECAMATAN_ID")."
			, ".$this->getField("KELURAHAN_ID")."
		)
		"; 	
		// echo $str;exit();
		$this->id = $this->getField("SAUDARA_ID");
		$this->query = $str;
		return $this->execQuery($str);
    }

	function update()
	{
		$str = "		
		UPDATE SAUDARA
		SET 
		PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
		, NAMA= '".$this->getField("NAMA")."'
		, TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."'
		, TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR")."
		, JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."'
		, PEKERJAAN= '".$this->getField("PEKERJAAN")."'
		, ALAMAT= '".$this->getField("ALAMAT")."'
		, KODEPOS= '".$this->getField("KODEPOS")."'
		, TELEPON= '".$this->getField("TELEPON")."'
		, PROPINSI_ID= ".$this->getField("PROPINSI_ID")."
		, KABUPATEN_ID= ".$this->getField("KABUPATEN_ID")."
		, KECAMATAN_ID= ".$this->getField("KECAMATAN_ID")."
		, KELURAHAN_ID= ".$this->getField("KELURAHAN_ID")."
		WHERE SAUDARA_ID= '".$this->getField("SAUDARA_ID")."'
		";
		$this->query = $str;
		// echo $str;exit();
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM SAUDARA
                WHERE 
                  SAUDARA_ID = '".$this->getField("SAUDARA_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT SAUDARA_ID, PEGAWAI_ID, NAMA, 
				   TEMPAT_LAHIR, TANGGAL_LAHIR, JENIS_KELAMIN, 
				   PEKERJAAN, ALAMAT, KODEPOS, AMBIL_UMUR(TANGGAL_LAHIR) USIA,
				   TELEPON, a.PROPINSI_ID, a.KABUPATEN_ID, a.KECAMATAN_ID, a.KELURAHAN_ID,
				   (SELECT x.NAMA FROM PROPINSI x WHERE x.PROPINSI_ID = a.PROPINSI_ID) NMPROPINSI,
				   AMBIL_KABUPATEN(a.PROPINSI_ID, a.KABUPATEN_ID) NMKABUPATEN,
				   AMBIL_KECAMATAN(a.PROPINSI_ID, a.KABUPATEN_ID, a.KECAMATAN_ID) NMKECAMATAN,
				   AMBIL_KELURAHAN(a.PROPINSI_ID, a.KABUPATEN_ID, a.KECAMATAN_ID, a.KELURAHAN_ID) NMKELURAHAN
				FROM SAUDARA a WHERE 1=1"; 

		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TANGGAL_LAHIR asc";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>