<? 
  include_once(APPPATH.'/models/Entity.php');

  class TingkatHukuman extends Entity{ 

	var $query;

    function TingkatHukuman()
	{
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT TINGKAT_HUKUMAN_ID, A.NAMA TINGKAT_HUKUMAN, A.PERATURAN_ID, 
        			B.NAMA PERATURAN
				FROM TINGKAT_HUKUMAN A
				LEFT JOIN PERATURAN B ON A.PERATURAN_ID = B.PERATURAN_ID 
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
        
  } 
?>