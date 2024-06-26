<? 
include_once(APPPATH.'/models/Entity.php');

class RiwayatGaji extends Entity{ 

	var $query;

	function RiwayatGaji()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.gaji_riwayat"));

		$str = "
		INSERT INTO validasi.gaji_riwayat
		(
			GAJI_RIWAYAT_ID, PEGAWAI_ID, PEJABAT_PENETAP_ID, PEJABAT_PENETAP, PANGKAT_ID, NO_SK, TANGGAL_SK
			, TMT_SK, GAJI_POKOK, JENIS_KENAIKAN, MASA_KERJA_TAHUN, MASA_KERJA_BULAN
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
			, VALIDASI, TEMP_VALIDASI_ID
		)
		VALUES
		(
			".$this->getField("GAJI_RIWAYAT_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("PEJABAT_PENETAP_ID")."'
			, '".$this->getField("PEJABAT_PENETAP")."'
			, '".$this->getField("PANGKAT_ID")."'
			, '".$this->getField("NO_SK")."'
			, ".$this->getField("TANGGAL_SK")."
			, ".$this->getField("TMT_SK")."
			, ".$this->getField("GAJI_POKOK")."
			, '".$this->getField("JENIS_KENAIKAN")."'
			, ".$this->getField("MASA_KERJA_TAHUN")."
			, ".$this->getField("MASA_KERJA_BULAN")."
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
			, ".$this->getField("VALIDASI")."
			, ".$this->getField("TEMP_VALIDASI_ID")."
		)";
		// echo $str;exit;
		$this->id= $this->getField("TEMP_VALIDASI_ID");
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		// $this->setlogdata("validasi.gaji_riwayat", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE validasi.gaji_riwayat
		SET    
			PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
			, PEJABAT_PENETAP_ID= '".$this->getField("PEJABAT_PENETAP_ID")."'
			, PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."'
			, PANGKAT_ID= '".$this->getField("PANGKAT_ID")."'
			, NO_SK= '".$this->getField("NO_SK")."'
			, TANGGAL_SK= ".$this->getField("TANGGAL_SK")."
			, TMT_SK= ".$this->getField("TMT_SK")."
			, GAJI_POKOK= ".$this->getField("GAJI_POKOK")."
			, JENIS_KENAIKAN= '".$this->getField("JENIS_KENAIKAN")."'
			, MASA_KERJA_TAHUN= ".$this->getField("MASA_KERJA_TAHUN")."
			, MASA_KERJA_BULAN= ".$this->getField("MASA_KERJA_BULAN")."
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
			, VALIDASI= ".$this->getField("VALIDASI")."
		WHERE TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'
		"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		// $this->setlogdata("validasi.gaji_riwayat", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function updatetanggalvalidasi()
	{
		$str = "
		UPDATE validasi.gaji_riwayat
		SET
			TANGGAL_VALIDASI= NOW()
		WHERE TEMP_VALIDASI_ID = ".$this->getField("TEMP_VALIDASI_ID")."
		"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function selectByPersonal($paramsArray=array(),$limit=-1,$from=-1, $pegawaiid, $id="", $rowid="", $statement='', $order='ORDER BY A.TMT_SK ASC')
	{
		$str = "
		SELECT
			(SELECT x.KODE FROM PANGKAT x WHERE x.PANGKAT_ID = a.PANGKAT_ID) NMPANGKAT
			,
			case 
			when JENIS_KENAIKAN= 1 then 'KP' 
			when JENIS_KENAIKAN= 2 then 'KGB'
			when JENIS_KENAIKAN= 3 then 'Penyesuaian' 
			when JENIS_KENAIKAN= 4 then 'SK'
			end NMJENISKENAIKAN
			, A.*
		FROM (select * from validasi.validasi_pegawai_gaji_riwayat('".$pegawaiid."', '".$id."', '".$rowid."')) A
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