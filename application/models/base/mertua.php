<? 
include_once(APPPATH.'/models/Entity.php');

class Mertua extends Entity{ 

	var $query;

    function Mertua()
	{
		$this->Entity(); 
    }

    function insert()
	{
		$this->setField("MERTUA_ID", $this->getNextId("MERTUA_ID","mertua"));

		$str = "
		INSERT INTO mertua
		(
			MERTUA_ID, PEGAWAI_ID, JENIS_KELAMIN, NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, PEKERJAAN, ALAMAT, KODEPOS
			, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID, TELEPON
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES 
		(
			".$this->getField("MERTUA_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("JENIS_KELAMIN")."'
			, '".$this->getField("NAMA")."'
			, '".$this->getField("TEMPAT_LAHIR")."'
			, ".$this->getField("TANGGAL_LAHIR")."
			, '".$this->getField("PEKERJAAN")."'
			, '".$this->getField("ALAMAT")."'
			, '".$this->getField("KODEPOS")."'
			, ".$this->getField("PROPINSI_ID")."
			, ".$this->getField("KABUPATEN_ID")."
			, ".$this->getField("KECAMATAN_ID")."
			, ".$this->getField("KELURAHAN_ID")."
			, '".$this->getField("TELEPON")."'
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'	
		)";
		
		$this->id= $this->getField("MERTUA_ID");
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("mertua", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE mertua
		SET
			PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
			, JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."'
			, NAMA= '".$this->getField("NAMA")."'
			, TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."'
			, TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR")."
			, PEKERJAAN= '".$this->getField("PEKERJAAN")."'
			, ALAMAT= '".$this->getField("ALAMAT")."'
			, KODEPOS= '".$this->getField("KODEPOS")."'
			, PROPINSI_ID= ".$this->getField("PROPINSI_ID")."
			, KABUPATEN_ID= ".$this->getField("KABUPATEN_ID")."
			, KECAMATAN_ID= ".$this->getField("KECAMATAN_ID")."
			, KELURAHAN_ID= ".$this->getField("KELURAHAN_ID")."
			, TELEPON= '".$this->getField("TELEPON")."'
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE MERTUA_ID= '".$this->getField("MERTUA_ID")."'
		"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("mertua", "UPDATE", $str);

		return $this->execQuery($str);
    }
	
	function delete()
	{
		$str = "
		DELETE FROM mertua
		WHERE 
		MERTUA_ID = '".$this->getField("MERTUA_ID")."'";
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("mertua", "DELETE", $str);
		
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
			MERTUA_ID, PEGAWAI_ID, JENIS_KELAMIN, 
			NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, 
			PEKERJAAN, ALAMAT, KODEPOS, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID,
			TELEPON
		FROM MERTUA A WHERE MERTUA_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}

		$str .= $statement." ORDER BY a.PEGAWAI_ID ASC";
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from);  
    }
        
} 
?>