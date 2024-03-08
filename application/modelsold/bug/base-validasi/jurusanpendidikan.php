<? 
  include_once(APPPATH.'/models/Entity.php');

  class JurusanPendidikan extends Entity{ 

	var $query;

    function JurusanPendidikan()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","JURUSAN_PENDIDIKAN")); 
		
		$str = "INSERT INTO JURUSAN_PENDIDIKAN (
				   JURUSAN_PENDIDIKAN_ID, NAMA, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("JURUSAN_PENDIDIKAN_ID").",
				  '".$this->getField("NAMA")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE JURUSAN_PENDIDIKAN
				SET    
					   NAMA= '".$this->getField("NAMA")."',
					  LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE JURUSAN_PENDIDIKAN_ID= ".$this->getField("JURUSAN_PENDIDIKAN_ID")."
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM JURUSAN_PENDIDIKAN
                WHERE 
                  JURUSAN_PENDIDIKAN_ID= '".$this->getField("JURUSAN_PENDIDIKAN_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY NAMA ASC")
	{
		$str = "
		SELECT JURUSAN_PENDIDIKAN_ID, NAMA
		FROM JURUSAN_PENDIDIKAN 
		WHERE 1 = 1
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
		$str = "SELECT COUNT(1) AS ROWCOUNT 
		FROM JURUSAN_PENDIDIKAN
		WHERE 1 = 1  "; 
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