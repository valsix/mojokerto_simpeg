<? 
  include_once(APPPATH.'/models/Entity.php');

  class Eselon extends Entity{ 

	var $query;

    function Eselon()
	{
      $this->Entity(); 
    }


    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT ESELON_ID, NAMA, TUNJANGAN, 
		PANGKAT_MINIMAL, PANGKAT_MAKSIMAL
		FROM ESELON WHERE ESELON_ID IS NOT NULL
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