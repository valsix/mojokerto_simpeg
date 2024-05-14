<? 
include_once(APPPATH.'/models/Entity.php');

class PegawaiFile extends Entity{ 

	var $query;

	function PegawaiFile()
	{
		$this->Entity(); 
	}

	function newinsert()
	{
		$this->setField("PEGAWAI_FILE_ID", $this->getNextId("PEGAWAI_FILE_ID","pegawai_file")); 

     	$str = "
		INSERT INTO pegawai_file
		(
			PEGAWAI_FILE_ID, PEGAWAI_ID, RIWAYAT_TABLE, RIWAYAT_FIELD, RIWAYAT_ID, FILE_KUALITAS_ID, KATEGORI_FILE_ID
			, PATH
			, LAST_USER, LAST_DATE, LAST_LEVEL, USER_LOGIN_ID
			, USER_LOGIN_PEGAWAI_ID, IPCLIENT, MACADDRESS, NAMACLIENT, PATH_ASLI, EXT, CREATE_USER, PRIORITAS
		) 
		VALUES 
		(
			".$this->getField("PEGAWAI_FILE_ID")."
			, ".$this->getField("PEGAWAI_ID")."
			, '".$this->getField("RIWAYAT_TABLE")."'
			, '".$this->getField("RIWAYAT_FIELD")."'
			, ".$this->getField("RIWAYAT_ID")."
			, ".$this->getField("FILE_KUALITAS_ID")."
			, ".$this->getField("KATEGORI_FILE_ID")."
			, '".$this->getField("PATH")."'
			, '".$this->getField("LAST_USER")."'
			, ".$this->getField("LAST_DATE")."
			, ".$this->getField("LAST_LEVEL")."
			, ".$this->getField("USER_LOGIN_ID")."
			, ".$this->getField("USER_LOGIN_PEGAWAI_ID")."
			, '".$this->getField("IPCLIENT")."'
			, '".$this->getField("MACADDRESS")."'
			, '".$this->getField("NAMACLIENT")."'
			, '".$this->getField("PATH_ASLI")."'
			, '".$this->getField("EXT")."'
			, '".$this->getField("CREATE_USER")."'
			, '".$this->getField("PRIORITAS")."'
		)
		"; 	
		$this->id = $this->getField("PEGAWAI_FILE_ID");
		$this->query = $str;
		// echo $str;exit;
		$this->execQuery($str);

		if($this->getField("RIWAYAT_ID") == "NULL")
		{
			$str1= "
			UPDATE PEGAWAI_FILE
			SET    
				PRIORITAS= ''
			WHERE PEGAWAI_ID = ".$this->getField("PEGAWAI_ID")."
			AND KATEGORI_FILE_ID = ".$this->getField("KATEGORI_FILE_ID")."
			AND RIWAYAT_ID IS NULL
			AND RIWAYAT_FIELD = '".$this->getField("RIWAYAT_FIELD")."'
			AND PEGAWAI_FILE_ID != ".$this->id."
			AND PRIORITAS = '".$this->getField("PRIORITAS")."'
			";
		}
		else
		{
			$str1= "
			UPDATE PEGAWAI_FILE
			SET    
				PRIORITAS= ''
			WHERE PEGAWAI_ID = ".$this->getField("PEGAWAI_ID")."
			AND KATEGORI_FILE_ID = ".$this->getField("KATEGORI_FILE_ID")."
			AND RIWAYAT_ID = ".$this->getField("RIWAYAT_ID")."
			AND RIWAYAT_FIELD = '".$this->getField("RIWAYAT_FIELD")."'
			AND PEGAWAI_FILE_ID != ".$this->id."
			AND PRIORITAS = '".$this->getField("PRIORITAS")."'
			";
		}
		$this->query = $str1;
		// echo $str1;exit();
		return $this->execQuery($str1);
    }

	function selectnip($paramsArray=array(),$limit=-1,$from=-1, $statement="", $sorder="")
	{
		$str = "
		SELECT
			A.NIP_BARU
		FROM pegawai A
		WHERE 1 = 1"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sorder;
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsFile($paramsArray=array(),$limit=-1,$from=-1, $statement='', $pegawaiid="", $order=' ORDER BY A.PEGAWAI_FILE_ID ASC', $riwayattable= "")
	{
		if(empty($pegawaiid)) $pegawaiid= -1;
		
		$str = "
		SELECT
			CASE WHEN A.RIWAYAT_TABLE = 'PERSURATAN.SURAT_MASUK_PEGAWAI' THEN
			CONCAT(CAST(A.KATEGORI_FILE_ID AS TEXT),'-',CAST(A.PEGAWAI_ID AS TEXT),'-',CAST(A.RIWAYAT_TABLE AS TEXT),'-','','-',CAST(A.RIWAYAT_ID AS TEXT))
			ELSE
			CONCAT(CAST(A.KATEGORI_FILE_ID AS TEXT),'-',CAST(A.PEGAWAI_ID AS TEXT),'-',CAST(A.RIWAYAT_TABLE AS TEXT),'-',CAST(A.RIWAYAT_FIELD AS TEXT),'-',CAST(A.RIWAYAT_ID AS TEXT)) 
			END P_ID_ROW
			, A.PEGAWAI_FILE_ID, A.PEGAWAI_ID, A.RIWAYAT_TABLE, A.RIWAYAT_FIELD, A.RIWAYAT_ID, A.FILE_KUALITAS_ID, 'Scan Asli' FILE_KUALITAS_NAMA, A.PATH, 
			A.STATUS_VERIFIKASI, A.KETERANGAN, A.STATUS
			, CASE A.STATUS WHEN '1' THEN 'Tidak Aktif' ELSE 'Aktif' END STATUS_NAMA
			, A.KATEGORI_FILE_ID, A.PATH_ASLI, A.EXT, A.PRIORITAS, A.TEMP_VALIDASI_BELUM_ID
		FROM PEGAWAI_FILE A
		WHERE 1=1 AND A.PEGAWAI_ID = ".$pegawaiid."
		"; 
		
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$order;
		$this->query = $str;
		// echo $str;exit;
		return $this->selectLimit($str,$limit,$from); 
		
    }
} 
?>