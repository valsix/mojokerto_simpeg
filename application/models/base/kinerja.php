<? 
include_once(APPPATH.'/models/Entity.php');

class Kinerja extends Entity{ 

	var $query;

	function Kinerja()
	{
		$this->Entity(); 
	}

	function insert()
	{
		$this->setField("KINERJA_ID", $this->getNextId("KINERJA_ID","kinerja"));

		$str = "
		INSERT INTO kinerja 
		(
			KINERJA_ID, PEGAWAI_ID, TAHUN
			, HASIL_KERJA, PERILAKU_KERJA,PREDIKAT_KINERJA, NIP_PEJABAT_PENILAI
			, NAMA_PEJABAT_PENILAI, LAST_CREATE_USER,LAST_CREATE_DATE, LAST_CREATE_SATKER
		)
		VALUES 
		(
			".$this->getField("KINERJA_ID")."
			, ".$this->getField("PEGAWAI_ID")."
			, ".$this->getField("TAHUN")."
			, '".$this->getField("HASIL_KERJA")."'
			, '".$this->getField("PERILAKU_KERJA")."'
			, '".$this->getField("PREDIKAT_KINERJA")."'
			, ".$this->getField("NIP_PEJABAT_PENILAI")."
			, '".$this->getField("NAMA_PEJABAT_PENILAI")."'
			, '".$this->getField("LAST_CREATE_USER")."'
			, ".$this->getField("LAST_CREATE_DATE")."
			, '".$this->getField("LAST_CREATE_SATKER")."'
		)";
		
		$this->id= $this->getField("KINERJA_ID");	
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("kinerja", "INSERT", $str);

		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
		UPDATE kinerja
		SET    
			PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
			, TAHUN= ".$this->getField("TAHUN")."
			, HASIL_KERJA= '".$this->getField("HASIL_KERJA")."'
			, PERILAKU_KERJA= '".$this->getField("PERILAKU_KERJA")."'
			, PREDIKAT_KINERJA= '".$this->getField("PREDIKAT_KINERJA")."'
			, NIP_PEJABAT_PENILAI= ".$this->getField("NIP_PEJABAT_PENILAI")."
			, NAMA_PEJABAT_PENILAI= '".$this->getField("NAMA_PEJABAT_PENILAI")."'
			, LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."'
			, LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE")."
			, LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
		WHERE KINERJA_ID= '".$this->getField("KINERJA_ID")."'
		"; 
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("kinerja", "UPDATE", $str);

		return $this->execQuery($str);
    }

    function delete()
	{
		$str = "
		DELETE FROM kinerja
		WHERE 
		KINERJA_ID = '".$this->getField("KINERJA_ID")."'"; 
				  
		$this->query = $str;
		// echo $str;exit;

		// untuk buat log data
		// parse pertama sesuai nama table
		// parse ke dua sesuai aksi
		$this->setlogdata("kinerja", "DELETE", $str);

        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT 
			A.*
		FROM kinerja A
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
