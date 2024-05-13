<? 
include_once(APPPATH.'/models/Entity.php');

class Kecamatan extends Entity{ 

	var $query;

	function Kecamatan()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("KECAMATAN_ID", $this->getNextId("KECAMATAN_ID","KECAMATAN")); 

		$str = "INSERT INTO KECAMATAN (
				   KECAMATAN_ID, KABUPATEN_ID, PROPINSI_ID, 
				   NAMA, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER) 
				VALUES (
				  ".$this->getField("KECAMATAN_ID").",
				  '".$this->getField("KABUPATEN_ID")."',
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
				UPDATE KECAMATAN
				SET    
					   KABUPATEN_ID       = '".$this->getField("KABUPATEN_ID")."',
					   PROPINSI_ID    = '".$this->getField("PROPINSI_ID")."',
					   NAMA             = '".$this->getField("NAMA")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  KECAMATAN_ID          = '".$this->getField("KECAMATAN_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM KECAMATAN
                WHERE 
                  KECAMATAN_ID = '".$this->getField("KECAMATAN_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }


	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT KECAMATAN_ID, KABUPATEN_ID, PROPINSI_ID, NAMA
				FROM KECAMATAN WHERE KECAMATAN_ID IS NOT NULL"; 
		
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
		$str = "SELECT COUNT(KECAMATAN_ID) AS ROWCOUNT FROM KECAMATAN WHERE KECAMATAN_ID IS NOT NULL "; 
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