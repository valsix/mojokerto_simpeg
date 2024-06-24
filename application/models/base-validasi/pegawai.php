<? 
include_once(APPPATH.'/models/Entity.php');

class Pegawai extends Entity{ 

	var $query;

	function Pegawai()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.PEGAWAI"));

		$str = "
		INSERT INTO validasi.PEGAWAI
		(
			PEGAWAI_ID, NIP_LAMA, NIP_BARU, NAMA, GELAR_DEPAN, GELAR_BELAKANG, TEMPAT_LAHIR
			, TANGGAL_LAHIR, JENIS_KELAMIN, AGAMA_ID, STATUS_KAWIN, SUKU_BANGSA, GOLONGAN_DARAH
			, TELEPON, EMAIL, ALAMAT, RT, RW, KODEPOS, PROPINSI_ID, KABUPATEN_ID, KECAMATAN_ID
			, KELURAHAN_ID, BANK_ID, NO_REKENING, SATKER_ID, TIPE_PEGAWAI_ID, TUGAS_TAMBAHAN_NEW
			, STATUS_PEGAWAI, TANGGAL_PENSIUN, JENIS_PEGAWAI_ID, KEDUDUKAN_ID, KARTU_PEGAWAI, ASKES
			, TASPEN, NPWP, NIK, KTP_PNS, KK, KTP_PASANGAN, DRH
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, FOTO_BLOB, FOTO_BLOB_OTHER
			, VALIDASI, TEMP_VALIDASI_ID
		) 
		VALUES
		(
			'".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("NIP_LAMA")."'
			, '".$this->getField("NIP_BARU")."'
			, '".$this->getField("NAMA")."'
			, '".$this->getField("GELAR_DEPAN")."'
			, '".$this->getField("GELAR_BELAKANG")."'
			, '".$this->getField("TEMPAT_LAHIR")."'
			, ".$this->getField("TANGGAL_LAHIR")."
			, '".$this->getField("JENIS_KELAMIN")."'
			, ".$this->getField("AGAMA_ID")."
			, '".$this->getField("STATUS_KAWIN")."'
			, '".$this->getField("SUKU_BANGSA")."'
			, '".$this->getField("GOLONGAN_DARAH")."'
			, '".$this->getField("TELEPON")."'
			, '".$this->getField("EMAIL")."'
			, '".$this->getField("ALAMAT")."'
			, '".$this->getField("RT")."'
			, '".$this->getField("RW")."'
			, '".$this->getField("KODEPOS")."'
			, ".$this->getField("PROPINSI_ID")."
			, ".$this->getField("KABUPATEN_ID")."
			, ".$this->getField("KECAMATAN_ID")."
			, ".$this->getField("KELURAHAN_ID")."
			, ".$this->getField("BANK_ID")."
			, '".$this->getField("NO_REKENING")."'
			, '".$this->getField("SATKER_ID")."'
			, ".$this->getField("TIPE_PEGAWAI_ID")."
			, '".$this->getField("TUGAS_TAMBAHAN_NEW")."'
			, '".$this->getField("STATUS_PEGAWAI")."'
			, ".$this->getField("TANGGAL_PENSIUN")."
			, ".$this->getField("JENIS_PEGAWAI_ID")."
			, ".$this->getField("KEDUDUKAN_ID")."
			, '".$this->getField("KARTU_PEGAWAI")."'
			, '".$this->getField("ASKES")."'
			, '".$this->getField("TASPEN")."'
			, '".$this->getField("NPWP")."'
			, '".$this->getField("NIK")."'
			, '".$this->getField("KTP_PNS")."'
			, '".$this->getField("KK")."'
			, '".$this->getField("KTP_PASANGAN")."'
			, '".$this->getField("DRH")."'
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
			, '".$this->getField("FOTO_BLOB")."'
			, '".$this->getField("FOTO_BLOB_OTHER")."'
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
		UPDATE validasi.PEGAWAI
		SET    
		GELAR_DEPAN= '".$this->getField("GELAR_DEPAN")."'
		, GELAR_BELAKANG= '".$this->getField("GELAR_BELAKANG")."'
		, TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."'
		, TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR")."
		, JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."'
		, AGAMA_ID= ".$this->getField("AGAMA_ID")."
		, STATUS_KAWIN= ".$this->getField("STATUS_KAWIN")."
		, SUKU_BANGSA= '".$this->getField("SUKU_BANGSA")."'
		, GOLONGAN_DARAH= '".$this->getField("GOLONGAN_DARAH")."'
		, TELEPON= '".$this->getField("TELEPON")."'
		, EMAIL= '".$this->getField("EMAIL")."'
		, ALAMAT= '".$this->getField("ALAMAT")."'
		, RT= '".$this->getField("RT")."'
		, RW= '".$this->getField("RW")."'
		, KODEPOS= '".$this->getField("KODEPOS")."'
		, PROPINSI_ID= ".$this->getField("PROPINSI_ID")."
		, KABUPATEN_ID= ".$this->getField("KABUPATEN_ID")."
		, KECAMATAN_ID= ".$this->getField("KECAMATAN_ID")."
		, KELURAHAN_ID= ".$this->getField("KELURAHAN_ID")."
		, BANK_ID= ".$this->getField("BANK_ID")."
		, NO_REKENING= '".$this->getField("NO_REKENING")."'
		, SATKER_ID= '".$this->getField("SATKER_ID")."'
		, TIPE_PEGAWAI_ID= ".$this->getField("TIPE_PEGAWAI_ID")."
		, TUGAS_TAMBAHAN_NEW= '".$this->getField("TUGAS_TAMBAHAN_NEW")."'
		, STATUS_PEGAWAI= '".$this->getField("STATUS_PEGAWAI")."'
		, TANGGAL_PENSIUN= ".$this->getField("TANGGAL_PENSIUN")."
		, JENIS_PEGAWAI_ID= ".$this->getField("JENIS_PEGAWAI_ID")."
		, KEDUDUKAN_ID= ".$this->getField("KEDUDUKAN_ID")."
		, KARTU_PEGAWAI= '".$this->getField("KARTU_PEGAWAI")."'
		, ASKES= '".$this->getField("ASKES")."'
		, TASPEN= '".$this->getField("TASPEN")."'
		, NPWP= '".$this->getField("NPWP")."'
		, NIK= '".$this->getField("NIK")."'
		, KTP_PNS= '".$this->getField("KTP_PNS")."'
		, KK= '".$this->getField("KK")."'
		, KTP_PASANGAN= '".$this->getField("KTP_PASANGAN")."'
		, DRH= '".$this->getField("DRH")."'
		, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
		, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
		, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		, FOTO_BLOB= '".$this->getField("FOTO_BLOB")."'
		, FOTO_BLOB_OTHER= '".$this->getField("FOTO_BLOB_OTHER")."'
		, VALIDASI= ".$this->getField("VALIDASI")."
		WHERE TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'
		";
		$this->query = $str;
		// echo $str;exit();
		// $this->setlogdata("pegawai", "UPDATE", $str);
		return $this->execQuery($str);
    }

    function updatefoto()
	{
		$str = "		
		UPDATE validasi.PEGAWAI
		SET    		
		FOTO_BLOB= '".$this->getField("FOTO_BLOB")."'
		WHERE PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
		";
		$this->query = $str;
		// echo $str;exit();
		// $this->setlogdata("pegawai", "UPDATE", $str);
		return $this->execQuery($str);
    }

    function updatefotosetengah()
	{
		$str = "		
		UPDATE validasi.PEGAWAI
		SET    		
		FOTO_BLOB_OTHER= '".$this->getField("FOTO_BLOB_OTHER")."'
		WHERE PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
		";
		$this->query = $str;
		// echo $str;exit();
		// $this->setlogdata("pegawai", "UPDATE", $str);
		return $this->execQuery($str);
    }

    function updatetanggalvalidasi()
	{
		$str = "		
		UPDATE validasi.PEGAWAI 
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
		UPDATE validasi.PEGAWAI 
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
        AND HAPUS_NAMA= 'PEGAWAI' AND VALIDASI IS NULL
        ";
				  
		$this->query = $str;
		// echo $str;exit;
        return $this->execQuery($str);
    }

	function selectByPersonal($paramsArray=array(),$limit=-1,$from=-1, $pegawaiid, $id="", $rowid="", $statement='', $order='ORDER BY A.PEGAWAI_ID ASC')
	{
		$str = "
		SELECT
			A.*
		FROM (select * from validasi.validasi_pegawai('".$pegawaiid."', '".$id."', '".$rowid."')) A
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

    function selectByValidasi($paramsArray=array(),$limit=-1,$from=-1, $statement='', $statementdetil="", $order=' ORDER BY A.P_ID ASC')
	{
		$str = "
		SELECT 
		V.INFO_LINK || '?reqId=' || pegawai_id ||'&reqValId=' || TEMP_VALIDASI_ID NEW_INFO_LINK
		, V.*, A.*
		FROM
		(
			SELECT
			A.PEGAWAI_ID P_ID, NIP_LAMA, A.FORMAT_NIP_BARU NIP_BARU, A.VNAMA_LENGKAP NAMA
			, E.VSATKER_NAMA_DETIL SATUAN_KERJA_DETIL
			FROM pegawai A
			INNER JOIN satker E ON A.SATKER_ID = E.SATKER_ID
			WHERE 1 = 1
		"; 
		
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." 
		) A
		INNER JOIN validasi.validasi_perubahandatavalidasi('') V ON A.P_ID = V.PEGAWAI_ID
		WHERE 1=1 ".$statementdetil.$order;
		$this->query = $str;
		// echo $str;exit;
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectById($pid='')
	{
		$str = "
		select
			info_link
		from
		(
			select replace(info_link, '_add', '') info_link
			from validasi.validasi_perubahandatavalidasi('".$pid."')
		) a
		group by info_link
    	";
    	$this->query = $str;
		// echo $str;exit;
		return $this->selectLimit($str,-1,-1); 
    }
} 
?>