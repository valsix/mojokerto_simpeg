<? 
  include_once(APPPATH.'/models/Entity.php');

  class Unor extends Entity{ 

	var $query;

    function Unor()
	{
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT  A.SATKER_ID, SATKER_INDUK_NAMA ||' - '|| SATKER UNOR,SATKER FROM
		(		
			SELECT
			S.SATKER_ID,AMBIL_SATKER_INDUK(S.SATKER_ID) SATKER_INDUK_NAMA, S.NAMA SATKER
			FROM SATKER S
		) A
		WHERE 1=1
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
		$str = "SELECT COUNT(1) AS ROWCOUNT FROM SATKER A
		WHERE 1=1 ".$statement; 
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