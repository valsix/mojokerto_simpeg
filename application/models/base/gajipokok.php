<? 
include_once(APPPATH.'/models/Entity.php');

class GajiPokok extends Entity{ 

	var $query;

	function GajiPokok()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("GAJI_POKOK_ID", $this->getNextId("GAJI_POKOK_ID","GAJI_POKOK")); 

		$str = "INSERT INTO GAJI_POKOK (
				   GAJI_POKOK_ID, MASA_KERJA, GAJI, PANGKAT_ID, GAJI_PERATURAN_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("GAJI_POKOK_ID").",
				  '".$this->getField("MASA_KERJA")."',
				  '".$this->getField("GAJI")."',
				  '".$this->getField("PANGKAT_ID")."',
				  '".$this->getField("GAJI_PERATURAN_ID")."',
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
				UPDATE GAJI_POKOK
				SET    
					   MASA_KERJA       = '".$this->getField("MASA_KERJA")."',
					   GAJI    = '".$this->getField("GAJI")."',
					   PANGKAT_ID = '".$this->getField("PANGKAT_ID")."',
					   GAJI_PERATURAN_ID = '".$this->getField("GAJI_PERATURAN_ID")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  GAJI_POKOK_ID          = '".$this->getField("GAJI_POKOK_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM GAJI_POKOK
                WHERE 
                  GAJI_POKOK_ID = '".$this->getField("GAJI_POKOK_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }


	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT GAJI_POKOK_ID, MASA_KERJA, GAJI, A.PANGKAT_ID, B.KODE, A.GAJI_PERATURAN_ID, C.NAMA GAJI_PERATURAN
				FROM GAJI_POKOK A
				LEFT JOIN PANGKAT B ON A.PANGKAT_ID = B.PANGKAT_ID
				INNER JOIN GAJI_PERATURAN C ON A.GAJI_PERATURAN_ID = C.GAJI_PERATURAN_ID 
                WHERE GAJI_POKOK_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
				
		$str .= $statement." ORDER BY PANGKAT_ID ASC";
		$this->query = $str;		
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsOnly($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT GAJI_POKOK_ID, MASA_KERJA, GAJI, PANGKAT_ID
				FROM GAJI_POKOK WHERE 1=1"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
				
		$str .= $statement." ORDER BY PANGKAT_ID ASC";
		$this->query = $str;		
		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(GAJI_POKOK_ID) AS ROWCOUNT FROM GAJI_POKOK WHERE GAJI_POKOK_ID IS NOT NULL "; 
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