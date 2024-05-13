<? 
include_once(APPPATH.'/models/Entity.php');

class Kabupaten extends Entity{ 

	var $query;

	function Kabupaten()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("KABUPATEN_ID", $this->getNextId("KABUPATEN_ID","KABUPATEN")); 

		$str = "INSERT INTO KABUPATEN (
				   KABUPATEN_ID, PROPINSI_ID, NAMA, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER) 
				VALUES (
				  ".$this->getField("KABUPATEN_ID").",
				  '".$this->getField("PROPINSI_ID")."',
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
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE KABUPATEN
				SET    
					   PROPINSI_ID       = '".$this->getField("PROPINSI_ID")."',
					   NAMA    = '".$this->getField("NAMA")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  KABUPATEN_ID          = '".$this->getField("KABUPATEN_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM KABUPATEN
                WHERE 
                  KABUPATEN_ID = '".$this->getField("KABUPATEN_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }


	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT KABUPATEN_ID, PROPINSI_ID, NAMA
				FROM KABUPATEN WHERE KABUPATEN_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY NAMA ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

	function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(KABUPATEN_ID) AS ROWCOUNT FROM KABUPATEN WHERE KABUPATEN_ID IS NOT NULL "; 
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