<? 
include_once(APPPATH.'/models/Entity.php');

class GajiPeraturan extends Entity{ 

	var $query;

	function GajiPeraturan()
	{
		$this->Entity(); 
	}

	
	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("GAJI_PERATURAN_ID", $this->getNextId("GAJI_PERATURAN_ID","GAJI_PERATURAN")); 

		$str = "INSERT INTO GAJI_PERATURAN (
				   GAJI_PERATURAN_ID, NAMA, KETERANGAN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("GAJI_PERATURAN_ID").",
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
				UPDATE GAJI_PERATURAN
				SET    
					   NAMA		       	 	= '".$this->getField("NAMA")."',
					   KETERANGAN    		= '".$this->getField("KETERANGAN")."', 
					   LAST_UPDATE_USER		= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE		= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  GAJI_PERATURAN_ID    = '".$this->getField("GAJI_PERATURAN_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }

    function updateStatus()
	{
		$str= "
				UPDATE GAJI_PERATURAN
				SET    
					   AKTIF= '0', 
					   LAST_UPDATE_USER		= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE		= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  GAJI_PERATURAN_ID NOT IN ('".$this->getField("GAJI_PERATURAN_ID")."') ;
				"; 
				// $this->query = $str1;
		// $this->execQuery($str1);
		
		$str .= "
				UPDATE GAJI_PERATURAN
				SET    
					   AKTIF= '1', 
					   LAST_UPDATE_USER		= '".$this->getField("LAST_UPDATE_USER")."',
					   LAST_UPDATE_DATE		= ".$this->getField("LAST_UPDATE_DATE").",
					   LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  GAJI_PERATURAN_ID    = '".$this->getField("GAJI_PERATURAN_ID")."';
				"; 

				// echo $str;exit;
		$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM GAJI_PERATURAN
                WHERE 
                  GAJI_PERATURAN_ID = '".$this->getField("GAJI_PERATURAN_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }


	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT GAJI_PERATURAN_ID, NAMA, KETERANGAN,
		CASE WHEN A.AKTIF = '1' THEN 'Aktif'
		WHEN  A.AKTIF = '0' THEN 'TIDAK AKTIF'
		END STATUS_AKTIF
				, AKTIF 
				FROM GAJI_PERATURAN A WHERE GAJI_PERATURAN_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
				
		$str .= $statement." ORDER BY GAJI_PERATURAN_ID ASC";
		$this->query = $str;		
		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(GAJI_PERATURAN_ID) AS ROWCOUNT FROM GAJI_PERATURAN WHERE GAJI_PERATURAN_ID IS NOT NULL "; 
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