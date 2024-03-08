<? 
  include_once(APPPATH.'/models/Entity.php');

  class Pangkat extends Entity{ 

	var $query;

    function Pangkat()
	{
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY KODE ASC")
	{
		$str = "
		SELECT PANGKAT_ID, KODE, NAMA, SUBSTR(KODE, 1, CASE WHEN position('/' in KODE) IS NULL OR position('/' in KODE) = 0 THEN 1 ELSE position('/' in KODE) END -1) GOL, SUBSTR(KODE, -1) RUANG
		FROM PANGKAT 
		WHERE PANGKAT_ID IS NOT NULL
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
    function getCountByParams($paramsArray=array(), $statement='')
	{
		$str = "SELECT COUNT(1) AS ROWCOUNT FROM PANGKAT A WHERE PANGKAT_ID IS NOT NULL ".$statement; 
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