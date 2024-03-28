<? 
include_once(APPPATH.'/models/Entity.php');

class Kp extends Entity{ 

	var $query;

	function Kp()
	{
		$this->Entity(); 
	}

	function callKP()
	{
        $str = "
        select ".$this->getField("PROCEDURENAME")."('".$this->getField("PERIODE")."', '".$this->getField("SATKERID")."')
		";
		$this->query = $str;
		// echo $str;exit;
        return $this->execQuery($str);
    }

    function selectByParamsMonitoring($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY PANGKAT0 DESC,  MSKERJATH0 DESC  ,  MSKERJABL0 DESC")
	{
		$str = "
		SELECT
			A.*
		FROM kp A
		WHERE 1=1
		";
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
		// echo $str;exit;
		return $this->selectLimit($str,$limit,$from); 
    }
	
} 
?>