<? 
  include_once(APPPATH.'/models/Entity.php');

  class PegawaiPendidikan extends Entity{ 

	var $query;

    function PegawaiPendidikan()
	{
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.*,B.NAMA TINGKAT_PENDIDIKAN
		FROM PEGAWAI_PENDIDIKAN A
		INNER JOIN TINGKAT_PENDIDIKAN B ON B.KODE = A.TINGKAT_PENDIDIKAN_ID
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
		$str = "SELECT COUNT(1) AS ROWCOUNT FROM PEGAWAI_PENDIDIKAN A
		INNER JOIN TINGKAT_PENDIDIKAN B ON B.KODE = A.TINGKAT_PENDIDIKAN_ID 
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