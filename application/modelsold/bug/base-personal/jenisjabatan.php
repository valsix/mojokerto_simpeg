<? 
  include_once(APPPATH.'/models/Entity.php');

  class JenisJabatan extends Entity{ 

	var $query;

    function JenisJabatan()
	{
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT JENIS_JABATAN_ID, NAMA
		FROM JENIS_JABATAN WHERE JENIS_JABATAN_ID IS NOT NULL
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