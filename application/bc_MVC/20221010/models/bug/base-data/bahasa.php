<? 
  include_once(APPPATH.'/models/Entity.php');

  class Bahasa extends Entity{ 

	var $query;

    function Bahasa()
	{
      $this->Entity(); 
    }

    function insert()
	{
		$this->setField("BAHASA_ID", $this->getNextId("BAHASA_ID","BAHASA")); 
		
		$str = "INSERT INTO BAHASA (
				   BAHASA_ID, PEGAWAI_ID, JENIS, 
				   NAMA, KEMAMPUAN, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
				VALUES (
				  ".$this->getField("BAHASA_ID").",
				  '".$this->getField("PEGAWAI_ID")."',
				  '".$this->getField("JENIS")."',
				  '".$this->getField("NAMA")."',
				  '".$this->getField("KEMAMPUAN")."',
				  '".$this->getField("LAST_CREATE_USER")."',
				  ".$this->getField("LAST_CREATE_DATE").",
				  '".$this->getField("LAST_CREATE_SATKER")."'
				)"; 
				
		$this->query = $str;
		return $this->execQuery($str);
    }

    function update()
	{
		$str = "
				UPDATE BAHASA
				SET    
					   PEGAWAI_ID       = '".$this->getField("PEGAWAI_ID")."',
					   JENIS    = '".$this->getField("JENIS")."',
					   NAMA             = '".$this->getField("NAMA")."',
					   KEMAMPUAN     = '".$this->getField("KEMAMPUAN")."',
					  LAST_UPDATE_USER	= '".$this->getField("LAST_UPDATE_USER")."',
					  LAST_UPDATE_DATE	= ".$this->getField("LAST_UPDATE_DATE").",
					  LAST_UPDATE_SATKER	= '".$this->getField("LAST_UPDATE_SATKER")."'
				WHERE BAHASA_ID= ".$this->getField("BAHASA_ID")."
				"; 
				$this->query = $str;
				// echo  $str;exit;
		return $this->execQuery($str);
    }

    function delete()
	{
        $str = "DELETE FROM BAHASA
                WHERE 
                  BAHASA_ID= '".$this->getField("BAHASA_ID")."'"; 
				  
		$this->query = $str;
		// echo($str);exit;
        return $this->execQuery($str);
    }


  

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT BAHASA_ID, PEGAWAI_ID,JENIS, NAMA, KEMAMPUAN,
			CASE WHEN JENIS = '1' THEN 'Asing' ELSE 'Daerah' END NMJENIS, 
			CASE WHEN KEMAMPUAN = '1' THEN 'Aktif' ELSE 'Pasif' END MAMPU
		FROM BAHASA 
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
        
  } 
?>