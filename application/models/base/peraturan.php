<? 
include_once(APPPATH.'/models/Entity.php');

class Peraturan extends Entity{ 

	var $query;

	function Peraturan()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("PERATURAN_ID", $this->getNextId("PERATURAN_ID","PERATURAN")); 

		$str = "
			INSERT INTO PERATURAN (
			   PERATURAN_ID, NAMA, KETERANGAN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER) 
				VALUES (
				  ".$this->getField("PERATURAN_ID").",
				  '".$this->getField("NAMA")."',
				  '".$this->getField("KETERANGAN")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE PERATURAN
				SET    
					   NAMA       = '".$this->getField("NAMA")."',
					   KETERANGAN    = '".$this->getField("KETERANGAN")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  PERATURAN_ID          = '".$this->getField("PERATURAN_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM PERATURAN
                WHERE 
                  PERATURAN_ID = '".$this->getField("PERATURAN_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }


	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
			SELECT PERATURAN_ID, NAMA, KETERANGAN
			FROM PERATURAN A WHERE 1 = 1		
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY PERATURAN_ID ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(PERATURAN_ID) AS ROWCOUNT FROM PERATURAN WHERE PERATURAN_ID IS NOT NULL "; 
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