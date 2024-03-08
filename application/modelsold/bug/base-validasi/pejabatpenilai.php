<? 
  include_once(APPPATH.'/models/Entity.php');

  class PejabatPenilai extends Entity{ 

	var $query;

    function PejabatPenilai()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("PEJABAT_PENILAI_ID", $this->getNextId("PEJABAT_PENILAI_ID","PEJABAT_PENILAI")); 

		$str = "INSERT INTO PEJABAT_PENILAI (
				   PEJABAT_PENILAI_ID, PENILAIAN_KERJA_PEGAWAI_ID, NAMA, JABATAN, 
				   UNOR,GOLONGAN,TMT_GOLONGAN,STATUS) 
				VALUES (
				  ".$this->getField("PEJABAT_PENILAI_ID").",
				  ".$this->getField("PENILAIAN_KERJA_PEGAWAI_ID").",
				  '".$this->getField("NAMA")."',
				  '".$this->getField("JABATAN")."',
				  '".$this->getField("UNOR")."',
				  '".$this->getField("GOLONGAN")."',
				  ".$this->getField("TMT_GOLONGAN").",
				  ".$this->getField("STATUS")."
				)"; 
		
		$this->id = $this->getField("PEJABAT_PENILAI_ID");		
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY NAMA ASC")
	{
		$str = "
		SELECT *
		FROM PEJABAT_PENILAI A WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
    function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(1) AS ROWCOUNT FROM PEJABAT_PENILAI A WHERE 1=1 "; 
		while(list($key,$val)=each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->select($str); 
		if($this->firstRow()) 
			return $this->getField("ROWCOUNT"); 
		else 
			return 0; 
    }
        
  } 
?>