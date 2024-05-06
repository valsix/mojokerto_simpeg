<? 
include_once(APPPATH.'/models/Entity.php');

class TingkatHukuman extends Entity{ 

	var $query;

	function TingkatHukuman()
	{
		$this->Entity(); 
	}

	

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("TINGKAT_HUKUMAN_ID", $this->getNextId("TINGKAT_HUKUMAN_ID","TINGKAT_HUKUMAN")); 

		$str = "INSERT INTO TINGKAT_HUKUMAN (
				   TINGKAT_HUKUMAN_ID, NAMA, PERATURAN_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("TINGKAT_HUKUMAN_ID").",
				  '".$this->getField("NAMA")."',
				  '".$this->getField("PERATURAN_ID")."',				 
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
		$str = "UPDATE TINGKAT_HUKUMAN SET
				  NAMA = '".$this->getField("NAMA")."',
				  PERATURAN_ID = '".$this->getField("PERATURAN_ID")."',
				  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
				  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
				  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE TINGKAT_HUKUMAN_ID = '".$this->getField("TINGKAT_HUKUMAN_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM TINGKAT_HUKUMAN
                WHERE 
                  TINGKAT_HUKUMAN_ID = '".$this->getField("TINGKAT_HUKUMAN_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		
		$str = "
		SELECT TINGKAT_HUKUMAN_ID, A.NAMA TINGKAT_HUKUMAN, A.PERATURAN_ID, 
        (SELECT X.NAMA FROM PERATURAN X WHERE A.PERATURAN_ID = X.PERATURAN_ID) PERATURAN
				FROM TINGKAT_HUKUMAN A WHERE 'PAKBONG' = 'PAKBONG'
		";		
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsStatus($paramsArray=array(),$limit=-1,$from=-1)
	{		
		$str = "
				SELECT PERATURAN_ID, NAMA, KETERANGAN 
				FROM PERATURAN WHERE 1 = 1
				".$statement; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
    }		
    
	
 	function selectByParamsEdit($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
		SELECT TINGKAT_HUKUMAN_ID, NAMA, PERATURAN_ID
                FROM TINGKAT_HUKUMAN WHERE 1 = 1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY TINGKAT_HUKUMAN_ID ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }		
} 
?>