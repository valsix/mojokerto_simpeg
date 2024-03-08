<? 
  include_once(APPPATH.'/models/Entity.php');

  class JenisHukuman extends Entity{ 

	var $query;

    function JenisHukuman()
	{
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT JENIS_HUKUMAN_ID, TINGKAT_HUKUMAN_ID, NAMA
                FROM JENIS_HUKUMAN WHERE 1 = 1
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