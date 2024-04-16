<? 
include_once(APPPATH.'/models/Entity.php');

class JenisHukuman extends Entity{ 

	var $query;

	function JenisHukuman()
	{
		$this->Entity(); 
	}

	

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("JENIS_HUKUMAN_ID", $this->getNextId("JENIS_HUKUMAN_ID","JENIS_HUKUMAN")); 

		$str = "INSERT INTO JENIS_HUKUMAN (
				   JENIS_HUKUMAN_ID, TINGKAT_HUKUMAN_ID, NAMA, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("JENIS_HUKUMAN_ID").",
				  '".$this->getField("TINGKAT_HUKUMAN_ID")."',
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
				UPDATE JENIS_HUKUMAN
				SET    
					   TINGKAT_HUKUMAN_ID       = '".$this->getField("TINGKAT_HUKUMAN_ID")."',
					   NAMA    = '".$this->getField("NAMA")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  JENIS_HUKUMAN_ID          = '".$this->getField("JENIS_HUKUMAN_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM JENIS_HUKUMAN
                WHERE 
                  JENIS_HUKUMAN_ID = '".$this->getField("JENIS_HUKUMAN_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{

		$str = "
		SELECT JENIS_HUKUMAN_ID, A.TINGKAT_HUKUMAN_ID, A.NAMA JENIS_HUKUMAN,
        (SELECT X.NAMA FROM TINGKAT_HUKUMAN X WHERE A.TINGKAT_HUKUMAN_ID = X.TINGKAT_HUKUMAN_ID) TINGKAT_HUKUMAN
				FROM JENIS_HUKUMAN A WHERE 'PAKBONG' = 'PAKBONG'
		";						
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY JENIS_HUKUMAN_ID ASC";
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
	
 	function selectByParamsEdit($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT JENIS_HUKUMAN_ID, TINGKAT_HUKUMAN_ID, NAMA, MASA, TIPE
                FROM JENIS_HUKUMAN WHERE 1 = 1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY JENIS_HUKUMAN_ID ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }	
} 
?>