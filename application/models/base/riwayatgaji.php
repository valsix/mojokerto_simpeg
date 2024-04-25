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
		$this->setField("GAJI_RIWAYAT_ID", $this->getNextId("GAJI_RIWAYAT_ID","gaji_riwayat")); 

		$str = "
		INSERT INTO gaji_riwayat
		(
			GAJI_RIWAYAT_ID, PEGAWAI_ID, PEJABAT_PENETAP_ID, PEJABAT_PENETAP, PANGKAT_ID, NO_SK, TANGGAL_SK
			, TMT_SK, GAJI_POKOK, JENIS_KENAIKAN, MASA_KERJA_TAHUN, MASA_KERJA_BULAN
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
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
		)";
		// echo $str;exit;
		$this->id= $this->getField("GAJI_RIWAYAT_ID");
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("gaji_riwayat", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE gaji_riwayat
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
		WHERE GAJI_RIWAYAT_ID= '".$this->getField("GAJI_RIWAYAT_ID")."'
		"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("gaji_riwayat", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "
        DELETE FROM gaji_riwayat
        WHERE GAJI_RIWAYAT_ID = '".$this->getField("GAJI_RIWAYAT_ID")."'";
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("gaji_riwayat", "DELETE", $str);

        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT
			GAJI_RIWAYAT_ID, PEGAWAI_ID, A.PEJABAT_PENETAP_ID, PEJABAT_PENETAP, PANGKAT_ID, NO_SK, TANGGAL_SK, TMT_SK
			, GAJI_POKOK, JENIS_KENAIKAN
			, 
			case 
			when JENIS_KENAIKAN= 1 then 'KP' 
			when JENIS_KENAIKAN= 2 then 'KGB'
			when JENIS_KENAIKAN= 3 then 'Penyesuaian' 
			when JENIS_KENAIKAN= 4 then 'SK'
			end NMJENISKENAIKAN
			, WILAYAH, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, KTUA, BULAN_DIBAYAR, SUDAH_DIBAYAR, POTONGAN_PANGKAT, TANGGAL_UPDATE
			, PEJABAT_PENETAP NMPEJABATPENETAP, (SELECT x.KODE FROM PANGKAT x WHERE x.PANGKAT_ID = a.PANGKAT_ID) NMPANGKAT
			, FOTO_BLOB,LINK_FILE_APPS
		FROM gaji_riwayat A
		WHERE 1=1 ";
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY TMT_SK ASC";
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>