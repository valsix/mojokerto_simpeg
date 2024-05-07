<? 
include_once(APPPATH.'/models/Entity.php');

class JabatanFungsional extends Entity{ 

	var $query;

	function JabatanFungsional()
	{
		$this->Entity(); 
	}

	function insert()
	{
		/*Auto-generate primary key(s) by next max value (integer) */
		$this->setField("JABATAN_FUNGSIONAL_ID", $this->getNextId("JABATAN_FUNGSIONAL_ID","JABATAN_FUNGSIONAL")); 

		$str = "INSERT INTO JABATAN_FUNGSIONAL (
				   JABATAN_FUNGSIONAL_ID, JABATAN_FUNGSIONAL_ID_PARENT, 
				   NAMA, KETERANGAN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("JABATAN_FUNGSIONAL_ID").",
				  '".$this->getField("JABATAN_FUNGSIONAL_ID_PARENT")."',
				  '".$this->getField("NAMA")."',
				  '".$this->getField("KETERANGAN")."',
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
				UPDATE JABATAN_FUNGSIONAL
				SET    
					   JABATAN_FUNGSIONAL_ID_PARENT       = '".$this->getField("JABATAN_FUNGSIONAL_ID_PARENT")."',
					   NAMA             = '".$this->getField("NAMA")."',
					   KETERANGAN     = '".$this->getField("KETERANGAN")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE  JABATAN_FUNGSIONAL_ID          = '".$this->getField("JABATAN_FUNGSIONAL_ID")."'
				"; 
				$this->query = $str;
		return $this->execQuery($str);
    }
	
	function delete()
	{
        $str = "DELETE FROM JABATAN_FUNGSIONAL
                WHERE 
                  JABATAN_FUNGSIONAL_ID = '".$this->getField("JABATAN_FUNGSIONAL_ID")."'"; 
				  
		$this->query = $str;
        return $this->execQuery($str);
    }

	function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "SELECT JABATAN_FUNGSIONAL_ID, JABATAN_FUNGSIONAL_ID_PARENT, 
				CASE WHEN LENGTH(JABATAN_FUNGSIONAL_ID) = 8 THEN
				ambil_jabatan_fungsional_nama(JABATAN_FUNGSIONAL_ID) || ' ' || NAMA
				ELSE NAMA END NAMAbak, NAMA NAMA_ASLI,
				KETERANGAN, AMBIL_JAB_FUNG_NAMA(JABATAN_FUNGSIONAL_ID) NAMA
				FROM JABATAN_FUNGSIONAL WHERE JABATAN_FUNGSIONAL_ID IS NOT NULL"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$this->query = $str;
		$str .= $statement." ORDER BY NAMA ASC";
				
		return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array())
	{
		$str = "SELECT COUNT(JABATAN_FUNGSIONAL_ID) AS ROWCOUNT FROM JABATAN_FUNGSIONAL WHERE JABATAN_FUNGSIONAL_ID IS NOT NULL "; 
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