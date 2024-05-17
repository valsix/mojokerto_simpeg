<? 
include_once(APPPATH.'/models/Entity.php');

class SKP extends Entity{ 

	var $query;

	function SKP()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("SKP_ID", $this->getNextId("SKP_ID","skp")); 

		$str = "
		INSERT INTO skp
		(
			SKP_ID, PEGAWAI_ID, PEJABAT_ID
			, ATASAN_PEJABAT_ID, TAHUN,NILAI, ORIENTASI_PELAYANAN
			, INTEGRITAS, KOMITMEN, DISIPLIN
			, KERJASAMA, KEPEMIMPINAN, INISIATIF_KERJA, LAST_CREATE_USER,LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES 
		(
			".$this->getField("SKP_ID")."
			, ".$this->getField("PEGAWAI_ID")."
			, ".$this->getField("PEJABAT_ID")."
			, ".$this->getField("ATASAN_PEJABAT_ID")."
			, ".$this->getField("TAHUN")."
			, ".$this->getField("NILAI")."
			, '".$this->getField("ORIENTASI_PELAYANAN")."'
			, '".$this->getField("INTEGRITAS")."'
			, '".$this->getField("KOMITMEN")."'
			, '".$this->getField("DISIPLIN")."'
			, '".$this->getField("KERJASAMA")."'
			, '".$this->getField("KEPEMIMPINAN")."'
			, '".$this->getField("INISIATIF_KERJA")."'
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)"; 
				
		$this->id= $this->getField("SKP_ID");
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("skp", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE skp
		SET    
			PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
			, PEJABAT_ID= ".$this->getField("PEJABAT_ID")."
			, ATASAN_PEJABAT_ID= ".$this->getField("ATASAN_PEJABAT_ID")."
			, TAHUN= ".$this->getField("TAHUN")."
			, NILAI= ".$this->getField("NILAI")."
			, ORIENTASI_PELAYANAN= '".$this->getField("ORIENTASI_PELAYANAN")."'
			, INTEGRITAS= '".$this->getField("INTEGRITAS")."'
			, KOMITMEN= '".$this->getField("KOMITMEN")."'
			, DISIPLIN= '".$this->getField("DISIPLIN")."'
			, KERJASAMA= '".$this->getField("KERJASAMA")."'
			, KEPEMIMPINAN= '".$this->getField("KEPEMIMPINAN")."'
			, INISIATIF_KERJA= '".$this->getField("INISIATIF_KERJA")."'
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE SKP_ID= '".$this->getField("SKP_ID")."'
		"; 
		$this->query = $str;

		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("skp", "UPDATE", $str);

		return $this->execQuery($str);
    }


	function delete()
	{
        $str = "
        DELETE FROM skp
        WHERE 
        SKP_ID = '".$this->getField("SKP_ID")."'";

		$this->query = $str;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("skp", "DELETE", $str);

        return $this->execQuery($str);
    }
	

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT 
			A.SKP_ID, A.PEGAWAI_ID, A.PEJABAT_ID
			, A.ATASAN_PEJABAT_ID, A.TAHUN,A.NILAI, A.ORIENTASI_PELAYANAN
			, A.INTEGRITAS, A.KOMITMEN, A.DISIPLIN
			,  A.KERJASAMA, A.KEPEMIMPINAN, A.FORMAT, A.UKURAN,A.LINK_FILE_APPS
			, B.NAMA PEJABAT_NAMA, C.NAMA ATASAN_NAMA, B.NIP_BARU PEJABAT_NIP, C.NIP_BARU ATASAN_NIP, A.INISIATIF_KERJA
		FROM skp A
		LEFT JOIN pegawai B ON B.PEGAWAI_ID = A.PEJABAT_ID
		LEFT JOIN pegawai C ON C.PEGAWAI_ID = A.ATASAN_PEJABAT_ID 
		WHERE 1=1 "; 

    	while(list($key,$val) = each($paramsArray))
    	{
    		$str .= " AND $key = '$val' ";
    	}

		$str .= $statement."";
		$this->query = $str;
		// echo $statement;exit;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>