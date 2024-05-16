<? 
include_once(APPPATH.'/models/Entity.php');

class CatatanPrestasi extends Entity{ 

	var $query;

	function CatatanPrestasi()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("PRESTASI_KERJA_ID", $this->getNextId("PRESTASI_KERJA_ID","prestasi_kerja")); 

		$str = "
		INSERT INTO prestasi_kerja 
		(
			PRESTASI_KERJA_ID, PEGAWAI_ID, KETERANGAN, NAMA, NO_SK, TANGGAL_SK, PEJABAT_PENETAP, TAHUN, PEJABAT_PENETAP_ID
			, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER
		) 
		VALUES 
		(
			".$this->getField("PRESTASI_KERJA_ID")."
			, '".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("KETERANGAN")."'
			, '".$this->getField("NAMA")."'
			, '".$this->getField("NO_SK")."'
			, ".$this->getField("TANGGAL_SK")."
			, '".$this->getField("PEJABAT_PENETAP")."'
			, '".$this->getField("TAHUN")."'
			, ".$this->getField("PEJABAT_PENETAP_ID")."
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)"; 
		
		$this->id= $this->getField("PRESTASI_KERJA_ID");
		$this->query = $str;
		// echo$str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("prestasi_kerja", "INSERT", $str);
		
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE prestasi_kerja
		SET    
			PEGAWAI_ID= '".$this->getField("PEGAWAI_ID")."'
			, KETERANGAN= '".$this->getField("KETERANGAN")."'
			, NAMA= '".$this->getField("NAMA")."'
			, NO_SK= '".$this->getField("NO_SK")."'
			, TANGGAL_SK= ".$this->getField("TANGGAL_SK")."
			, TAHUN= '".$this->getField("TAHUN")."'
			, PEJABAT_PENETAP= '".$this->getField("PEJABAT_PENETAP")."'
			, PEJABAT_PENETAP_ID= ".$this->getField("PEJABAT_PENETAP_ID")."
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE PRESTASI_KERJA_ID= '".$this->getField("PRESTASI_KERJA_ID")."'
		"; 
		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("prestasi_kerja", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "
        DELETE FROM prestasi_kerja
        WHERE 
        PRESTASI_KERJA_ID = '".$this->getField("PRESTASI_KERJA_ID")."'"; 

        // untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("prestasi_kerja", "DELETE", $str);
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT
			PRESTASI_KERJA_ID, PEGAWAI_ID, KETERANGAN, 
			a.NAMA, NO_SK, TANGGAL_SK, TAHUN, 
			case when a.PEJABAT_PENETAP_ID = NULL then (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP)
			else a.PEJABAT_PENETAP_ID 
			end PEJABAT_PENETAP_ID, 
			(SELECT x.NAMA 
			FROM PEJABAT_PENETAP x
			WHERE x.PEJABAT_PENETAP_ID = a.PEJABAT_PENETAP_ID OR x.JABATAN = a.PEJABAT_PENETAP
			) NMPEJABATPENETAP, FOTO_BLOB,
			case when b.JABATAN = NULL then a.PEJABAT_PENETAP else b.JABATAN end PEJABAT_PENETAP
		FROM PRESTASI_KERJA a
		LEFT JOIN PEJABAT_PENETAP b ON a.PEJABAT_PENETAP_ID = b.PEJABAT_PENETAP_ID
		WHERE 1=1 "; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY NAMA ASC";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>