<? 
include_once(APPPATH.'/models/Entity.php');

class Pendidikan extends Entity{ 

	var $query;

	function Pendidikan()
	{
		$this->Entity(); 
	}

	

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("PENDIDIKAN_ID", $this->getNextId("PENDIDIKAN_ID","PENDIDIKAN")); 

		$str = "INSERT INTO PENDIDIKAN (
				   PENDIDIKAN_ID, PANGKAT_MINIMAL, PANGKAT_MAKSIMAL, 
				   NAMA, KETERANGAN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER) 
				VALUES (
				  ".$this->getField("PENDIDIKAN_ID").",
				  '".$this->getField("PANGKAT_MINIMAL")."',
				  '".$this->getField("PANGKAT_MAKSIMAL")."',
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
				UPDATE PENDIDIKAN
				SET    
					   PANGKAT_MINIMAL       = '".$this->getField("PANGKAT_MINIMAL")."',
					   PANGKAT_MAKSIMAL    = '".$this->getField("PANGKAT_MAKSIMAL")."',
					   NAMA             = '".$this->getField("NAMA")."',
					   KETERANGAN             = '".$this->getField("KETERANGAN")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  PENDIDIKAN_ID          = '".$this->getField("PENDIDIKAN_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM PENDIDIKAN
                WHERE 
                  PENDIDIKAN_ID = '".$this->getField("PENDIDIKAN_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT PENDIDIKAN_ID, PANGKAT_MINIMAL, PANGKAT_MAKSIMAL, NAMA, KETERANGAN
				FROM PENDIDIKAN A WHERE PENDIDIKAN_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY PENDIDIKAN_ID ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(PENDIDIKAN_ID) AS ROWCOUNT FROM PENDIDIKAN WHERE PENDIDIKAN_ID IS NOT NULL "; 
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