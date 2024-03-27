<? 
include_once(APPPATH.'/models/Entity.php');

class Kgb extends Entity{ 

	var $query;

	function Kgb()
	{
		$this->Entity(); 
	}

	function callKGB()
	{
        $str = "
        select pinsertkgb('".$this->getField("PERIODE")."', '".$this->getField("SATKERID")."')
		";
		$this->query = $str;
		// echo $str;exit;
        return $this->execQuery($str);
    }

    function selectByParamsMonitoring($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY PANGKAT_ID DESC")
	{
		$str = "
		SELECT
			A.*
		FROM kgb A
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