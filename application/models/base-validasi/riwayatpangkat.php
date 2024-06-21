<? 
include_once(APPPATH.'/models/Entity.php');

class RiwayatPangkat extends Entity{ 

	var $query;

	function RiwayatPangkat()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.PANGKAT_RIWAYAT"));

		$str = "
		INSERT INTO validasi.PANGKAT_RIWAYAT
		(
			PANGKAT_RIWAYAT_ID, PEGAWAI_ID, PANGKAT_ID, PEJABAT_PENETAP_ID, PEJABAT_PENETAP, STLUD, NO_STLUD
			, TANGGAL_STLUD, NO_NOTA, TANGGAL_NOTA, NO_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK
			, TANGGAL_SK, TMT_PANGKAT, KREDIT, JENIS_KP, KETERANGAN, TANGGAL_UPDATE
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
			, VALIDASI, TEMP_VALIDASI_ID
		) 
		VALUES
		(
			".$this->getField("PANGKAT_RIWAYAT_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, ".$this->getField("PANGKAT_ID")."
			, ".$this->getField("PEJABAT_PENETAP_ID")."
			, '".$this->getField("PEJABAT_PENETAP")."'
			, '".$this->getField("STLUD")."'
			, '".$this->getField("NO_STLUD")."'
			, ".$this->getField("TANGGAL_STLUD")."
			, '".$this->getField("NO_NOTA")."'
			, ".$this->getField("TANGGAL_NOTA")."
			, '".$this->getField("NO_SK")."'
			, ".$this->getField("MASA_KERJA_TAHUN")."
			, ".$this->getField("MASA_KERJA_BULAN")."
			, ".$this->getField("GAJI_POKOK")."
			, ".$this->getField("TANGGAL_SK")."
			, ".$this->getField("TMT_PANGKAT")."
			, ".$this->getField("KREDIT")."
			, ".$this->getField("JENIS_KP")."
			, '".$this->getField("KETERANGAN")."'
			, CURRENT_DATE
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
			, ".$this->getField("VALIDASI")."
			, ".$this->getField("TEMP_VALIDASI_ID")."
		)
		"; 	
		// echo $str;exit();
		$this->id = $this->getField("PEGAWAI_ID");
		$this->query = $str;
		// $this->setlogdata("pegawai", "INSERT", $str);
		return $this->execQuery($str);
    }

	function update()
	{
		$str = "		
		UPDATE validasi.PANGKAT_RIWAYAT
		SET
		PANGKAT_ID= ".$this->getField("PANGKAT_ID")."
		, PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID")."
		, PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."'
		, STLUD= '".$this->getField("STLUD")."'
		, NO_STLUD= '".$this->getField("NO_STLUD")."'
		, TANGGAL_STLUD= ".$this->getField("TANGGAL_STLUD")."
		, NO_NOTA= '".$this->getField("NO_NOTA")."'
		, TANGGAL_NOTA= ".$this->getField("TANGGAL_NOTA")."
		, NO_SK= '".$this->getField("NO_SK")."'
		, MASA_KERJA_TAHUN= ".$this->getField("MASA_KERJA_TAHUN")."
		, MASA_KERJA_BULAN= ".$this->getField("MASA_KERJA_BULAN")."
		, TANGGAL_SK= ".$this->getField("TANGGAL_SK")."
		, TMT_PANGKAT= ".$this->getField("TMT_PANGKAT")."
		, KREDIT= ".$this->getField("KREDIT")."
		, JENIS_KP= ".$this->getField("JENIS_KP")."
		, KETERANGAN= '".$this->getField("KETERANGAN")."'
		, TANGGAL_UPDATE= current_date
		, GAJI_POKOK= ".$this->getField("GAJI_POKOK")."
		, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
		, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
		, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		, VALIDASI= ".$this->getField("VALIDASI")."
		WHERE TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'
		";
		$this->query = $str;
		// echo $str;exit();
		// $this->setlogdata("pegawai", "UPDATE", $str);
		return $this->execQuery($str);
    }

    function updatetanggalvalidasi()
	{
		$str = "		
		UPDATE validasi.PANGKAT_RIWAYAT 
		SET
			TANGGAL_VALIDASI= NOW()
		WHERE TEMP_VALIDASI_ID = ".$this->getField("TEMP_VALIDASI_ID")."
		"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function updatevalidasi()
	{
		$str = "		
		UPDATE validasi.PANGKAT_RIWAYAT 
		SET
			VALIDASI= ".$this->getField("VALIDASI").",
			LAST_USER= '".$this->getField("LAST_USER")."',
			LAST_DATE= ".$this->getField("LAST_DATE").",
			USER_LOGIN_ID= ".$this->getField("USER_LOGIN_ID").",
			USER_LOGIN_PEGAWAI_ID= ".$this->getField("USER_LOGIN_PEGAWAI_ID").",
			LAST_LEVEL= ".$this->getField("LAST_LEVEL")."
		WHERE TEMP_VALIDASI_ID = ".$this->getField("TEMP_VALIDASI_ID")."
		"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function updatevalidasihapusdata()
	{
        $str = "
        UPDATE validasi.HAPUS_DATA
        SET
	        VALIDASI= ".$this->getField("VALIDASI").",
	        TANGGAL_VALIDASI= NOW()
        WHERE 
        TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
        AND HAPUS_NAMA= 'PEGAWAI' AND VALIDASI IS NULL
        ";
				  
		$this->query = $str;
		// echo $str;exit;
        return $this->execQuery($str);
    }

    function deletehapusdata()
	{
        $str = "
        DELETE FROM validasi.HAPUS_DATA
        WHERE 
        TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
        AND HAPUS_NAMA= 'PANGKAT_RIWAYAT' AND VALIDASI IS NULL
        ";
				  
		$this->query = $str;
		// echo $str;exit;
        return $this->execQuery($str);
    }

	function selectByPersonal($paramsArray=array(),$limit=-1,$from=-1, $pegawaiid, $id="", $rowid="", $statement='', $order='ORDER BY A.TMT_PANGKAT ASC')
	{
		$str = "
		SELECT
			(SELECT x.KODE FROM PANGKAT x WHERE x.PANGKAT_ID = a.PANGKAT_ID) NMPANGKAT
			,
			case
			when JENIS_KP = 1 then 'Reguler'
			when JENIS_KP = 2 then 'Pilihan' 
			when JENIS_KP = 3 then 'Anumerta' 
			when JENIS_KP = 4 then 'Pengabdian' 
			when JENIS_KP = 5 then 'SK lain-lain' 
			when JENIS_KP = 6 then 'Pilihan (Fungsional)'
			end  NMJENIS
			, A.*
		FROM (select * from validasi.validasi_pegawai_pangkat_riwayat('".$pegawaiid."', '".$id."', '".$rowid."')) A
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