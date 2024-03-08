<? 
  include_once(APPPATH.'/models/Entity.php');

  class Pendidikan extends Entity{ 

	var $query;

    function Pendidikan()
	{
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT PENDIDIKAN_ID, PANGKAT_MINIMAL, PANGKAT_MAKSIMAL, NAMA, KETERANGAN
		FROM PENDIDIKAN 
		WHERE PENDIDIKAN_ID IS NOT NULL
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