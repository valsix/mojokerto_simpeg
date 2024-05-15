<? 
include_once(APPPATH.'/models/Entity.php');

class RiwayatPangkat extends Entity{ 

	var $query;

	function RiwayatPangkat()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT PANGKAT_RIWAYAT_ID, PEGAWAI_ID, a.PANGKAT_ID, 
				case 
					when b.JABATAN is NULL then a.PEJABAT_PENETAP
					else b.JABATAN 
				end PEJABAT_PENETAP, 
				a.PEJABAT_PENETAP_ID, STLUD, NO_STLUD, 
				TANGGAL_STLUD, NO_NOTA, TANGGAL_NOTA, a.GAJI_POKOK,
				NO_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
				TANGGAL_SK, TMT_PANGKAT, KREDIT, JENIS_KP, KETERANGAN, TANGGAL_UPDATE,
				(SELECT x.KODE FROM PANGKAT x WHERE x.PANGKAT_ID = a.PANGKAT_ID) NMPANGKAT,
				case
					when JENIS_KP = 1 then 'Reguler'
					when JENIS_KP = 2 then 'Pilihan' 
					when JENIS_KP = 3 then 'Anumerta' 
					when JENIS_KP = 4 then 'Pengabdian' 
					when JENIS_KP = 5 then 'SK lain-lain' 
					when JENIS_KP = 6 then 'Pilihan (Fungsional)'
				end  NMJENIS, 
				FOTO_BLOB,LINK_FILE_APPS,LINK_FILE_APPS_STLUD
				FROM PANGKAT_RIWAYAT a 
				LEFT JOIN PEJABAT_PENETAP b ON a.PEJABAT_PENETAP_ID = b.PEJABAT_PENETAP_ID 
				WHERE PANGKAT_RIWAYAT_ID IS NOT NULL "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		$str .= $statement." ORDER BY TMT_PANGKAT ";
		
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "
				SELECT COUNT(1) AS ROWCOUNT 
				FROM PANGKAT_RIWAYAT a 
				LEFT JOIN PEJABAT_PENETAP b ON a.PEJABAT_PENETAP_ID = b.PEJABAT_PENETAP_ID 
				WHERE PANGKAT_RIWAYAT_ID IS NOT NULL ".$statement; 
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

    function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("PANGKAT_RIWAYAT_ID", $this->getNextId("PANGKAT_RIWAYAT_ID","PANGKAT_RIWAYAT")); 

		$str = "INSERT INTO PANGKAT_RIWAYAT
		(
			PANGKAT_RIWAYAT_ID, PEGAWAI_ID, PANGKAT_ID, PEJABAT_PENETAP_ID, PEJABAT_PENETAP, STLUD, NO_STLUD
			, TANGGAL_STLUD, NO_NOTA, TANGGAL_NOTA, NO_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK
			, TANGGAL_SK, TMT_PANGKAT, KREDIT, JENIS_KP, KETERANGAN, TANGGAL_UPDATE
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		) 
		VALUES 
		(
			".$this->getField("PANGKAT_RIWAYAT_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("PANGKAT_ID")."'
			, '".$this->getField("PEJABAT_PENETAP_ID")."'
			, '".$this->getField("PEJABAT_PENETAP")."'
			, '".$this->getField("STLUD")."'
			, '".$this->getField("NO_STLUD")."'
			, ".$this->getField("TANGGAL_STLUD")."
			, '".$this->getField("NO_NOTA")."'
			, ".$this->getField("TANGGAL_NOTA")."
			, '".$this->getField("NO_SK")."'
			, '".$this->getField("MASA_KERJA_TAHUN")."'
			, '".$this->getField("MASA_KERJA_BULAN")."'
			, '".$this->getField("GAJI_POKOK")."'
			, ".$this->getField("TANGGAL_SK")."
			, ".$this->getField("TMT_PANGKAT")."
			, '".$this->getField("KREDIT")."'
			, '".$this->getField("JENIS_KP")."'
			, '".$this->getField("KETERANGAN")."'
			, current_date
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)";
		$this->id= $this->getField("PANGKAT_RIWAYAT_ID");		
		$this->query = $str;
		// echo $str; exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("PANGKAT_RIWAYAT", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "UPDATE PANGKAT_RIWAYAT
		SET    
			PANGKAT_ID= '".$this->getField("PANGKAT_ID")."'
			, PEJABAT_PENETAP_ID= '".$this->getField("PEJABAT_PENETAP_ID")."'
			, PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."'
			, STLUD= '".$this->getField("STLUD")."'
			, NO_STLUD= '".$this->getField("NO_STLUD")."'
			, TANGGAL_STLUD= ".$this->getField("TANGGAL_STLUD")."
			, NO_NOTA= '".$this->getField("NO_NOTA")."'
			, TANGGAL_NOTA= ".$this->getField("TANGGAL_NOTA")."
			, NO_SK= '".$this->getField("NO_SK")."'
			, MASA_KERJA_TAHUN= '".$this->getField("MASA_KERJA_TAHUN")."'
			, MASA_KERJA_BULAN= '".$this->getField("MASA_KERJA_BULAN")."'
			, TANGGAL_SK= ".$this->getField("TANGGAL_SK")."
			, TMT_PANGKAT= ".$this->getField("TMT_PANGKAT")."
			, KREDIT= ".$this->getField("KREDIT")."
			, JENIS_KP= '".$this->getField("JENIS_KP")."'
			, KETERANGAN= '".$this->getField("KETERANGAN")."'
			, TANGGAL_UPDATE= current_date
			, GAJI_POKOK= ".$this->getField("GAJI_POKOK")."
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE PANGKAT_RIWAYAT_ID= '".$this->getField("PANGKAT_RIWAYAT_ID")."' AND PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
		"; 
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("PANGKAT_RIWAYAT", "UPDATE", $str);

		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM PANGKAT_RIWAYAT
        WHERE PANGKAT_RIWAYAT_ID= '".$this->getField("PANGKAT_RIWAYAT_ID")."'";
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("PANGKAT_RIWAYAT", "DELETE", $str);

        return $this->execQuery($str);
    }
} 
?>