<? 
include_once(APPPATH.'/models/Entity.php');

class Diklat extends Entity{ 

	var $query;

	function Diklat()
	{
		$this->Entity(); 
	}

	
	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("DIKLAT_ID", $this->getNextId("DIKLAT_ID","DIKLAT")); 

		$str = "INSERT INTO DIKLAT (
				   DIKLAT_ID, NAMA, KETERANGAN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER) 
				VALUES (
				  ".$this->getField("DIKLAT_ID").",
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
				UPDATE DIKLAT
				SET    
					   NAMA       = '".$this->getField("NAMA")."',
					   KETERANGAN    = '".$this->getField("KETERANGAN")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  DIKLAT_ID          = '".$this->getField("DIKLAT_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM DIKLAT
                WHERE 
                  DIKLAT_ID = '".$this->getField("DIKLAT_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }


	function checkDiklatAvalaible()
	{
		$str = "SELECT *
				FROM DIKLAT 
				WHERE DIKLAT_ID IS NOT NULL 
				AND NAMA = '".$this->getField('NAMA')."' "; 
		
		
		$this->select($str); 
		if($this->firstRow()) 
			return 1; 
		else 
			return 0; 
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='',$order=' ORDER BY NAMA ASC')
	{
		$str = "SELECT DIKLAT_ID, NAMA, KETERANGAN
				FROM DIKLAT A WHERE DIKLAT_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ".$order;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(DIKLAT_ID) AS ROWCOUNT FROM DIKLAT WHERE DIKLAT_ID IS NOT NULL "; 
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