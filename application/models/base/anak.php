<? 
include_once(APPPATH.'/models/Entity.php');

class Anak extends Entity{ 

	var $query;

	function Anak()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("ANAK_ID", $this->getNextId("ANAK_ID","anak")); 

		$str = "
		INSERT INTO anak
		(
			ANAK_ID, PEGAWAI_ID, PENDIDIKAN_ID, NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR
			, JENIS_KELAMIN, STATUS_KELUARGA, STATUS_TUNJANGAN, PEKERJAAN, AWAL_BAYAR, AKHIR_BAYAR
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES
		(
			".$this->getField("ANAK_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, ".$this->getField("PENDIDIKAN_ID")."
			, '".$this->getField("NAMA")."'
			, '".$this->getField("TEMPAT_LAHIR")."'
			, ".$this->getField("TANGGAL_LAHIR")."
			, '".$this->getField("JENIS_KELAMIN")."'
			, '".$this->getField("STATUS_KELUARGA")."'
			, '".$this->getField("STATUS_TUNJANGAN")."'
			, '".$this->getField("PEKERJAAN")."'
			, ".$this->getField("AWAL_BAYAR")."
			, ".$this->getField("AKHIR_BAYAR")."
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)";

		// , TANGGAL_UPDATE, FOTO, USER_APP_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER

		/*, SYSDATE
		, '".$this->getField("FOTO")."'
		, '".$this->getField("USER_APP_ID")."'*/

		$this->id= $this->getField("ANAK_ID"); 
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("anak", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE anak
		SET    
			PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
			, PENDIDIKAN_ID= ".$this->getField("PENDIDIKAN_ID")."
			, NAMA= '".$this->getField("NAMA")."'
			, TEMPAT_LAHIR= '".$this->getField("TEMPAT_LAHIR")."'
			, TANGGAL_LAHIR= ".$this->getField("TANGGAL_LAHIR")."
			, JENIS_KELAMIN= '".$this->getField("JENIS_KELAMIN")."'
			, STATUS_KELUARGA= '".$this->getField("STATUS_KELUARGA")."'
			, STATUS_TUNJANGAN= '".$this->getField("STATUS_TUNJANGAN")."'
			, PEKERJAAN= '".$this->getField("PEKERJAAN")."'
			, AWAL_BAYAR= ".$this->getField("AWAL_BAYAR")."
			, AKHIR_BAYAR= ".$this->getField("AKHIR_BAYAR")."
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE ANAK_ID= '".$this->getField("ANAK_ID")."'
		";
		$this->query = $str;

		/*, TANGGAL_UPDATE= SYSDATE
		, FOTO= '".$this->getField("FOTO")."'
		, USER_APP_ID= '".$this->getField("USER_APP_ID")."'*/

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("anak", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "
        DELETE FROM anak WHERE ANAK_ID = '".$this->getField("ANAK_ID")."'";
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("anak", "DELETE", $str);

        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT
			ANAK_ID, PEGAWAI_ID, a.PENDIDIKAN_ID
			, a.NAMA, TEMPAT_LAHIR, TANGGAL_LAHIR
			, JENIS_KELAMIN, STATUS_KELUARGA, STATUS_TUNJANGAN
			, PEKERJAAN, AWAL_BAYAR, AKHIR_BAYAR
			, TANGGAL_UPDATE, FOTO
			, B.NMPENDIDIKAN
			, 
			case when STATUS_KELUARGA = 1 then 'Kandung'
			when STATUS_KELUARGA = 2 then 'Tiri'
			when STATUS_KELUARGA = 3 then 'Angkat'
			end KELUARGA
			,
			case when STATUS_KELUARGA = 1 then 'AK'
			when STATUS_KELUARGA = 2 then 'AT'
			when STATUS_KELUARGA = 3 then 'AA'
			end KELUARGA_LAP
			,
			case when STATUS_TUNJANGAN = 1 then 'Dapat'
			when STATUS_TUNJANGAN = 2 then 'Tidak'
			end TUNJANGAN
			,
			case when JENIS_KELAMIN = 'L' then 'Laki-Laki' 
			when JENIS_KELAMIN = 'P' then 'Perempuan'
			end KELAMIN, FOTO_BLOB,LINK_FILE_APPS
		FROM ANAK a
		LEFT JOIN
		(
			SELECT x.NAMA NMPENDIDIKAN, x.PENDIDIKAN_ID
			FROM PENDIDIKAN x
		) B ON B.PENDIDIKAN_ID = A.PENDIDIKAN_ID
		WHERE 1 = 1 "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TANGGAL_LAHIR ASC ";
		$this->query = $str;
				
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
				SELECT COUNT(1) AS ROWCOUNT 
				FROM ANAK WHERE 1=1 ".$statement; 
				
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		$this->query = $str;
		// echo $str;exit;
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0;  
    }
} 
?>