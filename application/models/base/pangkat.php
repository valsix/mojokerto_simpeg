<? 
include_once(APPPATH.'/models/Entity.php');

class Pangkat extends Entity{ 

	var $query;

	function Pangkat()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("PANGKAT_ID", $this->getNextId("PANGKAT_ID","PANGKAT")); 

		$str = "INSERT INTO PANGKAT (
				   PANGKAT_ID, KODE, NAMA, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER) 
				VALUES (
				  ".$this->getField("PANGKAT_ID").",
				  '".$this->getField("KODE")."',
				  '".$this->getField("NAMA")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;

		// echo $str;exit;
		return $this->execQuery($str);
    }

    function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE PANGKAT
				SET    
					   KODE       = '".$this->getField("KODE")."',
					   NAMA    = '".$this->getField("NAMA")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  PANGKAT_ID          = '".$this->getField("PANGKAT_ID")."'
				"; 
				$this->query = $str;
				//echo $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM PANGKAT
                WHERE 
                  PANGKAT_ID = '".$this->getField("PANGKAT_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='',$order=' ORDER BY A.PANGKAT_ID ASC')
	{
		$str = "
		SELECT
			A.*
		FROM pangkat A
		WHERE 1 = 1
		"; 
		
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$order;
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
		
    }

    function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(PANGKAT_ID) AS ROWCOUNT FROM PANGKAT WHERE PANGKAT_ID IS NOT NULL "; 
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