<? 
include_once(APPPATH.'/models/Entity.php');

class Eselon extends Entity{ 

	var $query;

	function Eselon()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("ESELON_ID", $this->getNextId("ESELON_ID","ESELON")); 

		$str = "INSERT INTO ESELON (
				   ESELON_ID, NAMA, TUNJANGAN, 
				   PANGKAT_MINIMAL, PANGKAT_MAKSIMAL, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("ESELON_ID").",
				  '".$this->getField("NAMA")."',
				  '".$this->getField("TUNJANGAN")."',
				  '".$this->getField("PANGKAT_MINIMAL")."',
				  '".$this->getField("PANGKAT_MAKSIMAL")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }


	function update()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$str = "
				UPDATE ESELON
				SET    
					   NAMA       = '".$this->getField("NAMA")."',
					   TUNJANGAN    = '".$this->getField("TUNJANGAN")."',
					   PANGKAT_MINIMAL             = '".$this->getField("PANGKAT_MINIMAL")."',
					   PANGKAT_MAKSIMAL     = '".$this->getField("PANGKAT_MAKSIMAL")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  ESELON_ID          = '".$this->getField("ESELON_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	
	function delete()
	{
        $str = "DELETE FROM ESELON
                WHERE 
                  ESELON_ID = '".$this->getField("ESELON_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }


	function checkEselonAvalaible()
	{
		$str = "SELECT * AS ROWCOUNT 
				FROM ESELON 
				WHERE ESELON_ID IS NOT NULL 
				AND NAMA = '".$this->getField('NAMA')."'"; 		
		
		$this->select($str); 
		if($this->firstRow()) 
			return 1; 
		else 
			return 0; 
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='',$order=' ORDER BY NAMA ASC')
	{
		$str = "SELECT ESELON_ID, NAMA, TUNJANGAN, 
				   PANGKAT_MINIMAL, PANGKAT_MAKSIMAL
				FROM ESELON A WHERE ESELON_ID IS NOT NULL"; 
		
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ".$order;
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function selectByStatistik($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT COUNT(A.ESELON) JML, ESELON 
				FROM(
					SELECT  A.PEGAWAI_ID, B.ESELON
					FROM PEGAWAI A, (SELECT PEGAWAI_ID, TMT_JABATAN, ESELON, JABATAN, ESELON_ID FROM JABATAN_TERAKHIR) B
					WHERE A.PEGAWAI_ID = B.PEGAWAI_ID(+) AND STATUS_PEGAWAI IN (1, 2)
						  ".$statement." ORDER BY B.ESELON
				) A
				WHERE 1=1
				"; 
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= " GROUP BY ESELON";
		return $this->selectLimit($str,$limit,$from); 
    }

    
	function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(ESELON_ID) AS ROWCOUNT FROM ESELON WHERE ESELON_ID IS NOT NULL "; 
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