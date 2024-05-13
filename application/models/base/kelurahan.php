<? 
include_once(APPPATH.'/models/Entity.php');

class Kelurahan extends Entity{ 

	var $query;

	function Kelurahan()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("KELURAHAN_ID", $this->getNextId("KELURAHAN_ID","KELURAHAN")); 

		$str = "INSERT INTO KELURAHAN (
				   KELURAHAN_ID, KECAMATAN_ID, KABUPATEN_ID, 
				   NAMA, PROPINSI_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER) 
				VALUES (
				  ".$this->getField("KELURAHAN_ID").",
				  '".$this->getField("KECAMATAN_ID")."',
				  '".$this->getField("KABUPATEN_ID")."',
				  '".$this->getField("NAMA")."',
				  '".$this->getField("PROPINSI_ID")."',
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
				UPDATE KELURAHAN
				SET    
					   KECAMATAN_ID       = '".$this->getField("KECAMATAN_ID")."',
					   KABUPATEN_ID    = '".$this->getField("KABUPATEN_ID")."',
					   NAMA             = '".$this->getField("NAMA")."',
					   PROPINSI_ID     = '".$this->getField("PROPINSI_ID")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  KELURAHAN_ID          = '".$this->getField("KELURAHAN_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM KELURAHAN
                WHERE 
                  KELURAHAN_ID = '".$this->getField("KELURAHAN_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }


	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT KELURAHAN_ID, KECAMATAN_ID, KABUPATEN_ID, NAMA, PROPINSI_ID
				FROM KELURAHAN WHERE KELURAHAN_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY NAMA ASC";
		//echo $str;		
		return $this->selectLimit($str,$limit,$from); 
    }

	function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(KELURAHAN_ID) AS ROWCOUNT FROM KELURAHAN WHERE KELURAHAN_ID IS NOT NULL "; 
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