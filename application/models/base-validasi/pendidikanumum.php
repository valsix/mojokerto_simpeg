<? 
include_once(APPPATH.'/models/Entity.php');

class PendidikanUmum extends Entity{ 

	var $query;

	function PendidikanUmum()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.pendidikan_riwayat"));

		$str = "
		INSERT INTO validasi.pendidikan_riwayat
		(
			PENDIDIKAN_RIWAYAT_ID, PEGAWAI_ID, PENDIDIKAN_ID, NAMA, JURUSAN, TEMPAT, KEPALA, NO_STTB, TANGGAL_STTB
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
			, VALIDASI, TEMP_VALIDASI_ID
		)
		VALUES
		(
			".$this->getField("PENDIDIKAN_RIWAYAT_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, ".$this->getField("PENDIDIKAN_ID")."
			, '".$this->getField("NAMA")."'
			, '".$this->getField("JURUSAN")."'
			, '".$this->getField("TEMPAT")."'
			, '".$this->getField("KEPALA")."'
			, '".$this->getField("NO_STTB")."'
			, ".$this->getField("TANGGAL_STTB")."
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
			, ".$this->getField("VALIDASI")."
			, ".$this->getField("TEMP_VALIDASI_ID")."
		)";

		$this->id= $this->getField("PENDIDIKAN_RIWAYAT_ID");
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		// $this->setlogdata("validasi.pendidikan_riwayat", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE validasi.pendidikan_riwayat
		SET    
			PENDIDIKAN_ID= ".$this->getField("PENDIDIKAN_ID")."
			, NAMA= '".$this->getField("NAMA")."'
			, JURUSAN= '".$this->getField("JURUSAN")."'
			, TEMPAT= '".$this->getField("TEMPAT")."'
			, KEPALA= '".$this->getField("KEPALA")."'
			, NO_STTB= '".$this->getField("NO_STTB")."'
			, TANGGAL_STTB= ".$this->getField("TANGGAL_STTB")."
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
			, VALIDASI= ".$this->getField("VALIDASI")."
		WHERE TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'
		";
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		// $this->setlogdata("validasi.pendidikan_riwayat", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function updatetanggalvalidasi()
	{
		$str = "
		UPDATE validasi.pendidikan_riwayat
		SET
			TANGGAL_VALIDASI= NOW()
		WHERE TEMP_VALIDASI_ID = ".$this->getField("TEMP_VALIDASI_ID")."
		"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function selectByPersonal($paramsArray=array(),$limit=-1,$from=-1, $pegawaiid, $id="", $rowid="", $statement='', $order='ORDER BY A.TANGGAL_STTB DESC')
	{
		$str = "
		SELECT
			case when a.PENDIDIKAN_ID is NULL then JURUSAN else (SELECT X.NAMA  FROM JURUSAN_PENDIDIKAN X WHERE X.JURUSAN_PENDIDIKAN_ID = a.JURUSAN_PENDIDIKAN_ID) end NMJURUSAN
			, A.*
		FROM (select * from validasi.validasi_pegawai_pendidikan_riwayat('".$pegawaiid."', '".$id."', '".$rowid."')) A
		WHERE 1 = 1
		"; 

		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		$this->query = $str;
			
		$str .= $statement."  ".$order;
		// echo $str;exit;
		return $this->selectLimit($str,$limit,$from); 
		
    }
} 
?>