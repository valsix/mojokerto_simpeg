<? 
  include_once(APPPATH.'/models/Entity.php');

  class Instansi extends Entity{ 

	var $query;

    function Instansi()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("PEJABAT_PENETAP_ID", $this->getNextId("PEJABAT_PENETAP_ID","PEJABAT_PENETAP")); 

		$str = "INSERT INTO PEJABAT_PENETAP (
				   PEJABAT_PENETAP_ID, JABATAN, NIP, 
				   NAMA) 
				VALUES (
				  ".$this->getField("PEJABAT_PENETAP_ID").",
				  '".$this->getField("JABATAN")."',
				  '".$this->getField("NIP")."',
				  '".$this->getField("NAMA")."'
				)"; 
		
		$this->id = $this->getField("PEJABAT_PENETAP_ID");		
		$this->query = $str;
		return $this->execQuery($str);
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY NAMA ASC")
	{
		$str = "
		SELECT INSTANSI_ID, NAMA
		FROM INSTANSI A WHERE INSTANSI_ID IS NOT NULL
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
    function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(1) AS ROWCOUNT FROM INSTANSI A WHERE INSTANSI_ID IS NOT NULL "; 
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