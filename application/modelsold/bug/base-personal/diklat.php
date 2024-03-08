<? 
  include_once(APPPATH.'/models/Entity.php');

  class Diklat extends Entity{ 

	var $query;

    function Diklat()
	{
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT DIKLAT_ID, NAMA, KETERANGAN
		FROM DIKLAT WHERE DIKLAT_ID IS NOT NULL
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