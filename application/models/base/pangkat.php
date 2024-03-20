<? 
include_once(APPPATH.'/models/Entity.php');

class Pangkat extends Entity{ 

	var $query;

	function Pangkat()
	{
		$this->Entity(); 
	}

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='',$order=' ORDER BY A.PANGKAT_ID ASC')
	{
		$str = "
		SELECT
			A.*
		FROM pangkat A
		WHERE 1 = 1
		"; 
		
		foreach ($paramsArray as $key => $val)
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$order;
		$this->query = $str;
		return $this->selectLimit($str,$limit,$from); 
		
    }

}