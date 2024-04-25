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
		$this->setField("ORANG_TUA_ID", $this->getNextId("ORANG_TUA_ID","orang_tua"));

		$str = "
		INSERT INTO orang_tua
		(
			ORANG_TUA_ID, PEGAWAI_ID, JENIS_KELAMIN, NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR, PEKERJAAN, ALAMAT, KODEPOS
			, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID, KELURAHAN_ID, TELEPON
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES 
		(
			".$this->getField("ORANG_TUA_ID")."
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
		
		$this->id= $this->getField("ORANG_TUA_ID");
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("orang_tua", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE orang_tua
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
		WHERE ORANG_TUA_ID= '".$this->getField("ORANG_TUA_ID")."'
		"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("orang_tua", "UPDATE", $str);

		return $this->execQuery($str);
    }
	
	function delete()
	{
		$str = "
		DELETE FROM orang_tua
		WHERE 
		ORANG_TUA_ID = '".$this->getField("ORANG_TUA_ID")."'";
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("orang_tua", "DELETE", $str);
		
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		ORANG_TUA_ID, PEGAWAI_ID, JENIS_KELAMIN, A.NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR
		, PEKERJAAN, ALAMAT, KODEPOS, TELEPON, a.PROPINSI_ID, a.KABUPATEN_ID, a.KECAMATAN_ID, a.KELURAHAN_ID
		, (select nama from propinsi b where a.propinsi_id =b.propinsi_id LIMIT 1) nama_propinsi
		, (select nama from kabupaten b where a.kabupaten_id =b.kabupaten_id LIMIT 1) nama_kabupaten
		, (select nama from kecamatan b where a.kecamatan_id =b.kecamatan_id LIMIT 1) nama_kecamatan
		, (select nama from kelurahan b where a.kelurahan_id =b.kelurahan_id LIMIT 1) nama_kelurahan
		FROM ORANG_TUA A
		WHERE ORANG_TUA_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		$str .= $statement." ORDER BY a.PEGAWAI_ID ASC";

		$this->query = $str;
		// echo $str;exit;
				
		return $this->selectLimit($str,$limit,$from);  
    }

} 
?>