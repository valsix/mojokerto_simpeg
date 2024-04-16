<? 
include_once(APPPATH.'/models/Entity.php');

class PejabatPenetap extends Entity{ 

	var $query;

	function PejabatPenetap()
	{
		$this->Entity(); 
	}

	

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("PEJABAT_PENETAP_ID", $this->getNextId("PEJABAT_PENETAP_ID","PEJABAT_PENETAP")); 

		$str = "INSERT INTO PEJABAT_PENETAP (
				   PEJABAT_PENETAP_ID, JABATAN, NIP, 
				   NAMA, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER) 
				VALUES (
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  '".$this->getField("JABATAN")."',
				  '".$this->getField("NIP")."',
				  '".$this->getField("NAMA")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
		
		$this->id = $this->getField("PEJABAT_PENETAP_ID");		
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE PEJABAT_PENETAP
				SET    
					   JABATAN       = '".$this->getField("JABATAN")."',
					   NIP    = '".$this->getField("NIP")."',
					   NAMA             = '".$this->getField("NAMA")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  PEJABAT_PENETAP_ID          = '".$this->getField("PEJABAT_PENETAP_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM PEJABAT_PENETAP
                WHERE 
                  PEJABAT_PENETAP_ID = '".$this->getField("PEJABAT_PENETAP_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT PEJABAT_PENETAP_ID, JABATAN, NIP, NAMA
				FROM PEJABAT_PENETAP WHERE PEJABAT_PENETAP_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ORDER BY NAMA ASC";
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>